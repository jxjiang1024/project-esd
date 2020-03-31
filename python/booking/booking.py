from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ
import datetime
from datetime import datetime
import requests
import traceback
import pika
import uuid
import csv
import json
import payment


app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config["SQLALCHEMY_POOL_RECYCLE"] = 299
app.config['CONN_MAX_AGE'] = None
db = SQLAlchemy(app)

# converts data type time col to make them serializable by json
def jsonTimeConverter(o):
    if isinstance(o, datetime.time):
        return o.__str__()

# Booking class
class Booking(db.Model):
    
    __tablename__ = 'booking'

    booking_id = db.Column(db.String(255), primary_key=True, nullable=False)
    flight_details_id = db.Column(db.Integer, primary_key=True, nullable=False)
    booking_date = db.Column(db.Date, nullable=False)
    payment_id = db.Column(db.Integer, primary_key=True, nullable=False)
    prefix = db.Column(db.String(4), nullable=False)
    first_name = db.Column(db.String(255), nullable=False)
    suffix = db.Column(db.String(45))
    last_name = db.Column(db.String(255), nullable=False)
    middle_name = db.Column(db.String(255))
    email = db.Column(db.TEXT, nullable=False)
    staff_id = db.Column(db.Integer)
    comments = db.Column(db.Text)

    def __init__(self, booking_id, flight_details_id, booking_date, payment_id,
    prefix, first_name, suffix, last_name, middle_name,
    email, staff_id, comments):
        self.booking_id = booking_id
        self.flight_details_id = flight_details_id
        self.booking_date = booking_date
        self.payment_id = payment_id
        self.prefix = prefix
        self.first_name = first_name
        self.suffix = suffix
        self.last_name = last_name
        self.middle_name = middle_name
        self.email = email
        self.staff_id = staff_id
        self.comments = comments

    def json(self):
        return {"booking_id": self.booking_id, "flight_details_id": self.flight_details_id,
        "booking_date": jsonTimeConverter(self.booking_date), "payment_id": self.payment_id,
        "prefix": self.prefix, "first_name": self.first_name,
        "suffix": self.suffix, "last_name": self.last_name,
        "middle_name": self.middle_name, "email": self.email,
        "staff_id": self.staff_id, "comments": self.comments}


# Ticket class
class Ticket(db.Model):
    __tablename__ = 'ticket'

    ticket_id = db.Column(db.String(25), primary_key=True, nullable=False)
    booking_id = db.Column(db.String(255), nullable=False)
    prefix = db.Column(db.String(4), nullable=False)
    first_name = db.Column(db.String(255), nullable=False)
    last_name = db.Column(db.String(255), nullable=False)
    middle_name = db.Column(db.String(45))
    suffix = db.Column(db.String(45))
    ff_id = db.Column(db.String(10))

    def __init__(self, ticket_id, booking_id, prefix, first_name, last_name, middle_name, suffix, ff_id):
        self.ticket_id = ticket_id
        self.booking_id = booking_id
        self.prefix = prefix
        self.first_name = first_name
        self.last_name = last_name
        self.middle_name = middle_name
        self.suffix = suffix
        self.ff_id = ff_id

    
    def json(self):
        return {"ticket_id": self.ticket_id, "booking_id": self.booking_id, 
            "prefix": self.prefix, "first_name": self.first_name, 
            "last_name": self.last_name, "middle_name": self.middle_name, 
            "suffix": self.suffix, "ff_id": self.ff_id}


# # TEST FUNCTION: returns JSON list of all bookings
# @app.route("/booking")
# def get_bookings():
#     return jsonify({"bookings": [booking.json() for booking in Booking.query.all()]})

# # TEST FUNCTION: returns JSON list of all tickets
# @app.route("/ticket")
# def get_tickets():
#     return jsonify({"tickets": [ticket.json() for ticket in Ticket.query.all()]})

@app.route("/booking/add", methods=['POST'])
def add_booking():
    try:
        data = request.get_json()
        size = len(Booking.query.all())
        booking = Booking(str(size+1),int(data['flight_details_id']),datetime.strptime(data['booking_date'], '%Y-%m-%d'), size+1, str(data['prefix']),str(data['first_name']), str(data['suffix']),str(data['last_name']), str(data['middle_name']),str(data['email']), int(data['staff_id']),str(data['comments']))

        db.session.add(booking)
        db.session.commit()
        return {"result":"Success"}
    except Exception:
        traceback.print_exc()
        return {"result":"Error"}

@app.route("/ticket/create", methods=['POST'])
def create_ticket():
    try:
        data = request.get_json()
        size = len(Ticket.query.all())
        ticket = Ticket(str(size+1),int(data['booking_id']), str(data['prefix']),str(data['first_name']), str(data['last_name']), str(data['middle_name']),str(data['suffix']),str(data['ff_id']))

        db.session.add(ticket)
        db.session.commit()
        return {"result":"Success"}
    except Exception:
        traceback.print_exc()
        return {"result":"Error"}

def create_booking(data):
    booking = dict()
    booking['booking_id'] = len(Booking.query.all())+1
    booking['flight_details_id'] = data['payment_type']
    booking['booking_date'] = data['prefix']
    booking['payment_id'] = data['first_name']
    booking['prefix'] = data['last_name']
    booking['first_name'] = data['middle_name']
    booking['suffix'] = data['amount']
    booking['last_name'] = data['status']
    booking['email'] = data['last_4_digit']
    booking['staff_id'] = data['last_4_digit']
    booking['comments'] = data['last_4_digit']
    return payment


# AMQP Check valid payment
@app.route("/payment/check", methods=['POST'])
def check_payment():
    data = request.get_json()
    result = payment.processPayment(data)
    print(result)
    # if(result['result'] != False):
    #     booking = create_booking(data)
    #     hostname = "localhost"
    #     port = 5672
    # # # connect to the broker and set up a communication channel in the connection
    #     connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
    #     channel = connection.channel()

    # # # set up the exchange if the exchange doesn't exist
    #     exchangename="booking_direct"
    #     channel.exchange_declare(exchange=exchangename, exchange_type='direct')

    # # prepare the message body content
    # message = json.dumps(payment, default=str) # convert a JSON object to a string
    # channel.queue_declare(queue='payment', durable=True) # make sure the queue used by the error handler exist and durable
    # channel.queue_bind(exchange=exchangename, queue='payment', routing_key='payment.info') # make sure the queue is bound to the exchange
    # channel.basic_publish(exchange=exchangename, routing_key="payment.info", body=message,
    #     properties=pika.BasicProperties(delivery_mode = 2) # make message persistent within the matching queues until it is received by some receiver (the matching queues have to exist and be durable and bound to the exchange)
    # )
    # # inform Shipping and exit, leaving it to order_reply to handle replies
    # # Prepare the correlation id and reply_to queue and do some record keeping
    # corrid = str(uuid.uuid4())
    # row = {"payment_id": payment["payment_id"], "correlation_id": corrid}
    # csvheaders = ["payment_id", "correlation_id","result"]
    # with open("corrids.csv", "a+", newline='') as corrid_file: # 'with' statement in python auto-closes the file when the block of code finishes, even if some exception happens in the middle
    #     csvwriter = csv.DictWriter(corrid_file, csvheaders)
    #     csvwriter.writerow(row)
    # replyqueuename = "payment.reply"
    # # prepare the channel and send a message to Shipping
    # channel.queue_declare(queue='payment', durable=True) # make sure the queue used by Shipping exist and durable
    # channel.queue_bind(exchange=exchangename, queue='payment', routing_key='payment.booking') # make sure the queue is bound to the exchange
    # channel.basic_publish(exchange=exchangename, routing_key="payment.booking", body=message,
    #     properties=pika.BasicProperties(delivery_mode = 2, # make message persistent within the matching queues until it is received by some receiver (the matching queues have to exist and be durable and bound to the exchange, which are ensured by the previous two api calls)
    #         reply_to=replyqueuename, # set the reply queue which will be used as the routing key for reply messages
    #         correlation_id=corrid # set the correlation id for easier matching of replies
    #     )
    # )
    # # close the connection to the broker
    # connection.close()
    # print()
    # return "payment info sent to payment.py"
    return jsonify({"result":True,"message":"your ticket will be issued shortly"})
    

if __name__ == "__main__":
     app.run(host='0.0.0.0', port=8300, debug=True)