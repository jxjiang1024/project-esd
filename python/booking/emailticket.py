from flask import Flask, render_template#, request
from flask_mail import Mail, Message
# from flask_cors import CORS
import json
import requests
import traceback
import email_login

import sys
import os
import pika

app = Flask(__name__)
# mail = Mail(app)

app.config['DEBUG'] = True
######### SET TO FALSE AFTER TESTING DONE #############
app.config['TESTING'] = False
app.config['MAIL_SERVER'] = 'smtp.gmail.com'
app.config['MAIL_PORT'] = 587
app.config['MAIL_USE_TLS'] = True
app.config['MAIL_USE_SSL'] = False
# app.config['MAIL_DEBUG'] = True
app.config['MAIL_USERNAME'] = email_login.MAIL_USERNAME
app.config['MAIL_PASSWORD'] = email_login.MAIL_PASSWORD
app.config['MAIL_DEFAULT_SENDER'] = 'gotrip.esd@gmail.com'
app.config['MAIL_MAX_EMAILS'] = None
# app.config['MAIL_SUPPRESS_SEND'] = False
app.config['MAIL_ASCII_ATTACHMENTS'] = False

mail = Mail(app)
# CORS(app)

def receiveBookingLog():
    hostname = "localhost" # default host
    port = 5672 # default port
    # connect to the broker and set up a communication channel in the connection
    connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
    channel = connection.channel()

    # set up the exchange if the exchange doesn't exist
    exchangename="booking"
    channel.exchange_declare(exchange=exchangename, exchange_type='direct')

    # prepare a queue for receiving messages
    channelqueue = channel.queue_declare(queue='', exclusive=True) # '' indicates a random unique queue name; 'exclusive' indicates the queue is used only by this receiver and will be deleted if the receiver disconnects.
        # If no need durability of the messages, no need durable queues, and can use such temp random queues.
    queue_name = channelqueue.method.queue
    channel.queue_bind(exchange=exchangename, queue=queue_name, routing_key='booking.info') # bind the queue to the exchange via the key
        # Can bind the same queue to the same exchange via different keys

    # set up a consumer and start to wait for coming messages
    channel.basic_consume(queue=queue_name, on_message_callback=callback, auto_ack=True)
    channel.start_consuming() # an implicit loop waiting to receive messages; it doesn't exit by default. Use Ctrl+C in the command window to terminate it.

def callback(channel, method, properties, body): # required signature for the callback; no return
    print("Received a booking log by " + __file__)
    # sendmsg(json.loads(body))
    sendmsg(body)
    print() # print a new line feed

# def processBookingLog(booking):
#     print("Recording a booking log:")
#     print(booking)

# check data type
# @app.route("/ticket/email", methods=['POST'])
def sendmsg(data):
    try:
        # data = request.get_json()
        # print(request.is_json)
        # print('got data:',data)
        data = json.loads(data)


        with app.app_context():
            if data['template'] == 'ticket':
                subject = 'Ticket issue #'+str(data['ticketID'])
                msg = Message(subject,recipients=[data['email']])
                msg.html = render_template(data['template']+'_msg.html', prefix=data['prefix'], last_name=data['last_name'], ticket_id=data['ticketID'], issue_date=data['today'], first_name=data['first_name'], middle_name=data['middle_name'], flight_no=data['flight_no'], dep_airport_name=data['departureAirport'], dep_date=data['departDate'], departure_time=data['departureTime'], arr_airport_name=data['arrivalAirport'], arrival_time=data['arrivalTime'])
            else:
                subject = 'Booking confirmation #'+str(data['bookingID'])
                msg = Message(subject,recipients=[data['email']])
                msg.html = render_template(data['template']+'_msg.html', prefix=data['prefix'], last_name=data['last_name'], bookingID=data['bookingID'], first_name=data['first_name'], middle_name=data['middle_name'], flight_no=data['flight_no'], dep_airport_name=data['departureAirport'], dep_date=data['departDate'], departure_time=data['departureTime'], arr_airport_name=data['arrivalAirport'], arrival_time=data['arrivalTime'])
            mail.send(msg)
        return {"result":True, "message":"Email sent successfully"}
    except Exception:
        traceback.print_exc()
        return {"result":False}

# if __name__ == "__main__":
#      app.run(host='0.0.0.0', port=8302, debug=True)

if __name__ == "__main__":  # execute this program only if it is run as a script (not by 'import')
    print("This is " + os.path.basename(__file__) + ": monitoring order creation...")
    receiveBookingLog()