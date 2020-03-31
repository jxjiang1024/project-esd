#!/usr/bin/env python3
# The above shebang (#!) operator tells Unix-like environments
# to run this file as a python3 script

from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
import traceback
import json
import sys
import os
import random
import pika

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://esd:456852@database-1.cbchzgfp3eq7.us-east-1.rds.amazonaws.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config["SQLALCHEMY_POOL_RECYCLE"] = 299
app.config['CONN_MAX_AGE'] = None
db = SQLAlchemy(app)

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

# Communication patterns:
# Use a message-broker with 'direct' exchange to enable interaction

hostname = "localhost" # default hostname
port = 5672 # default port
# connect to the broker and set up a communication channel in the connection
connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
    # Note: various network firewalls, filters, gateways (e.g., SMU VPN on wifi), may hinder the connections;
    # If "pika.exceptions.AMQPConnectionError" happens, may try again after disconnecting the wifi and/or disabling firewalls
channel = connection.channel()
# set up the exchange if the exchange doesn't exist
exchangename="booking"
channel.exchange_declare(exchange=exchangename, exchange_type='direct')

def receieveTicket():
    print('running')
    # prepare a queue for receiving messages
    channelqueue = channel.queue_declare(queue="ticketing", durable=True) # 'durable' makes the queue survive broker restarts so that the messages in it survive broker restarts too
    queue_name = channelqueue.method.queue
    channel.queue_bind(exchange=exchangename, queue=queue_name, routing_key='booking.ticketing') # bind the queue to the exchange via the key

    # set up a consumer and start to wait for coming messages
    channel.basic_qos(prefetch_count=1) # The "Quality of Service" setting makes the broker distribute only one message to a consumer if the consumer is available (i.e., having finished processing and acknowledged all previous messages that it receives)
    channel.basic_consume(queue=queue_name, on_message_callback=callback)
    channel.start_consuming() # an implicit loop waiting to receive messages; it doesn't exit by default. Use Ctrl+C in the command window to terminate it.

def callback(channel, method, properties, body): # required signature for the callback; no return
    print("Received a ticket by " + __file__)
    result = processTicket(json.loads(body))
    # print processing result; not really needed
    json.dump(result, sys.stdout, default=str) # convert the JSON object to a string and print out on screen
    print() # print a new line feed to the previous json dump
    print() # print another new line as a separator

    print("Received a ticket log by " + __file__)
    processTicket(json.loads(body))
    print() # print a new line feed

def processTicket(ticket):
    print("Processing an ticket:")
    print(ticket)
    # Can do anything here. E.g., publish a message to the error handler when processing fails.
    resultstatus = bool(random.getrandbits(1)) # simulate success/failure with a random True or False
    result = {'status': resultstatus, 'message': 'Simulated random booking result.', 'booking': ticket}
    resultmessage = json.dumps(result, default=str) # convert the JSON object to a string
    if not resultstatus: # inform the error handler when shipping fails
        print("Failed ticket.")
    else:
        print("OK ticket.")
        # uncomment following to create ticket in db
        # create_ticket(resultmessage)
    return result

def create_ticket(details):
    try:
        data = json.loads(details)
        size = len(Ticket.query.all())
        ticket = Ticket(str(size+1),int(data['booking_id']), str(data['prefix']),str(data['first_name']), str(data['last_name']), str(data['middle_name']),str(data['suffix']),str(data['ff_id']))

        db.session.add(ticket)
        db.session.commit()
        return {"result":"Success"}
    except Exception:
        traceback.print_exc()
        return {"result":"Error"}

if __name__ == "__main__":  # execute this program only if it is run as a script (not by 'import')
    print("This is " + os.path.basename(__file__) + ": Issue ticket for an booking...")
    receieveTicket()