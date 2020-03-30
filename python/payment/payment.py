from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ
import requests
import traceback
import pika
import json
import random
import sys


app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)
CORS(app)

# Payment class
class Payment(db.Model):
    
    __tablename__ = 'payment'

    payment_id = db.Column(db.Integer, primary_key=True)
    payment_type = db.Column(db.String(10), nullable=False)
    prefix = db.Column(db.String(4), nullable=False)
    first_name = db.Column(db.String(45), nullable=False)
    last_name = db.Column(db.String(45), nullable=False)
    middle_name = db.Column(db.String(255))
    amount = db.Column(db.Float(precision=2), nullable=False)
    status = db.Column(db.String(10), nullable=False)
    last_4_digit = db.Column(db.Integer, nullable=False)

    def __init__(self,payment_id, payment_type, prefix, first_name,
    last_name, middle_name, amount, status, last_4_digit):
        self.payment_id = payment_id
        self.payment_type = payment_type
        self.prefix = prefix
        self.first_name = first_name
        self.last_name = last_name
        self.middle_name = middle_name
        self.amount = amount
        self.status = status
        self.last_4_digit = last_4_digit
        
    def json(self):
        return {"payment_id": self.payment_id, "payment_type": self.payment_type,
        "prefix": self.prefix, "first_name": self.first_name,
        "last_name": self.last_name, "middle_name": self.middle_name,
        "amount": self.amount, "status": self.status,
        "last_4_digit": self.last_4_digit}


# # TEST FUNCTION: returns JSON list of all payments
# @app.route("/payment")
# def get_payments():
#     return jsonify({"payment": [payment.json() for payment in Payment.query.all()]})

hostname = "localhost"
port = 5672

connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
channel = connection.channel()

exchangename="booking_direct"
channel.exchange_declare(exchange=exchangename, exchange_type='direct')

def receivePayment():
    print("receive payment function triggered")
    # prepare a queue for receiving messages
    channelqueue = channel.queue_declare(queue="payment", durable=True) # 'durable' makes the queue survive broker restarts so that the messages in it survive broker restarts too
    queue_name = channelqueue.method.queue
    channel.queue_bind(exchange=exchangename, queue=queue_name, routing_key='payment.info') # bind the queue to the exchange via the key

    # set up a consumer and start to wait for coming messages
    channel.basic_qos(prefetch_count=1) # The "Quality of Service" setting makes the broker distribute only one message to a consumer if the consumer is available (i.e., having finished processing and acknowledged all previous messages that it receives)
    channel.basic_consume(queue=queue_name, on_message_callback=callback)
    channel.start_consuming() # an implicit loop waiting to receive messages; it doesn't exit by default. Use Ctrl+C in the command window to terminate it.

def callback(channel, method, properties, body): # required signature for the callback; no return
    print("Received a payment by " + __file__)
    result = processPayment(json.loads(body))
    # print processing result; not really needed
    json.dump(result, sys.stdout, default=str) # convert the JSON object to a string and print out on screen
    print() # print a new line feed to the previous json dump
    print() # print another new line as a separator

    # # prepare the reply message and send it out
    # replymessage = json.dumps(result, default=str) # convert the JSON object to a string
    # replyqueuename="payment.reply"
    # # A general note about AMQP queues: If a queue or an exchange doesn't exist before a message is sent,
    # # - the broker by default silently drops the message;
    # # - So, if really need a 'durable' message that can survive broker restarts, need to
    # #  + declare the exchange before sending a message, and
    # #  + declare the 'durable' queue and bind it to the exchange before sending a message, and
    # #  + send the message with a persistent mode (delivery_mode=2).
    # channel.queue_declare(queue=replyqueuename, durable=True) # make sure the queue used for "reply_to" is durable for reply messages
    # channel.queue_bind(exchange=exchangename, queue=replyqueuename, routing_key=replyqueuename) # make sure the reply_to queue is bound to the exchange
    # channel.basic_publish(exchange=exchangename,
    #         routing_key=properties.reply_to, # use the reply queue set in the request message as the routing key for reply messages
    #         body=replymessage, 
    #         properties=pika.BasicProperties(delivery_mode = 2, # make message persistent (stored to disk, not just memory) within the matching queues; default is 1 (only store in memory)
    #             correlation_id = properties.correlation_id, # use the correlation id set in the request message
    #         )
    # )
    channel.basic_ack(delivery_tag=method.delivery_tag) # acknowledge to the broker that the processing of the request message is completed

def processPayment(payment):
    print("Processing payment:")
    print(payment)
    # Can do anything here. E.g., publish a message to the error handler when processing fails.
    resultstatus = bool(random.getrandbits(1)) # simulate success/failure with a random True or False
    result = {'status': resultstatus, 'message': 'Simulated random payment result.', 'payment': payment}
    resultmessage = json.dumps(result, default=str) # convert the JSON object to a string
    if not resultstatus: # inform the error handler when shipping fails
        print("Failed payment.")
        send_error(resultmessage)
    else:
        print("OK payment.")
    return result

def send_error(resultmessage):
    # send the message to the error handler
    channel.queue_declare(queue='errorhandler', durable=True) # make sure the queue used by the error handler exist and durable
    channel.queue_bind(exchange=exchangename, queue='errorhandler', routing_key='payment.error') # make sure the queue is bound to the exchange
    channel.basic_publish(exchange=exchangename, routing_key="payment.error", body=resultmessage,
        properties=pika.BasicProperties(delivery_mode = 2) # make message persistent within the matching queues until it is received by some receiver (the matching queues have to exist and be durable and bound to the exchange)
    )


@app.route("/payment/add", methods=['POST'])
def add_transaction():
    try:
        data = request.get_json()
        size = len(Payment.query.all())
        transaction = Payment(size+1,str(data['payment_type']),str(data['prefix']),str(data['first_name']),str(data['last_name']),str(data['middle_name']),float(data['amount']),str(data['status']),int(data['last_4_digit']))

        db.session.add(transaction)
        db.session.commit()
        return {"result":"Success"}
    except Exception:
        traceback.print_exc()
        return {"result":"Error"}


if __name__ == "__main__":
    receivePayment()
    app.run(host='0.0.0.0', port=8301, debug=True)