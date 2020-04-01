#!/usr/bin/env python3
# The above shebang (#!) operator tells Unix-like environments
# to run this file as a python3 script

from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
import traceback
import json
import sys
import os
import random
import pika
from datetime import date

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
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
    issued_date = db.Column(db.Date, nullable=False)

    def __init__(self, ticket_id, booking_id, prefix, first_name, last_name, middle_name, suffix, ff_id,issued_date):
        self.ticket_id = ticket_id
        self.booking_id = booking_id
        self.prefix = prefix
        self.first_name = first_name
        self.last_name = last_name
        self.middle_name = middle_name
        self.suffix = suffix
        self.ff_id = ff_id
        self.issued_date = issued_date

    
    def json(self):
        return {"ticket_id": self.ticket_id, "booking_id": self.booking_id, 
            "prefix": self.prefix, "first_name": self.first_name, 
            "last_name": self.last_name, "middle_name": self.middle_name, 
            "suffix": self.suffix, "ff_id": self.ff_id,"issued_date":self.issued_date}


def receiveOrderLog():
    hostname = "localhost" # default host
    port = 5672 # default port
    # connect to the broker and set up a communication channel in the connection
    connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
    channel = connection.channel()

    # set up the exchange if the exchange doesn't exist
    exchangename="booking"
    channel.exchange_declare(exchange=exchangename, exchange_type='direct')

    # prepare a queue for receiving messages
    channelqueue = channel.queue_declare(queue='ticketing', durable=True) # '' indicates a random unique queue name; 'exclusive' indicates the queue is used only by this receiver and will be deleted if the receiver disconnects.
        # If no need durability of the messages, no need durable queues, and can use such temp random queues.
    queue_name = channelqueue.method.queue
    channel.queue_bind(exchange=exchangename, queue=queue_name, routing_key='booking.ticketing') # bind the queue to the exchange via the key
        # Can bind the same queue to the same exchange via different keys

    # set up a consumer and start to wait for coming messages
    channel.basic_consume(queue=queue_name, on_message_callback=callback, auto_ack=True)
    channel.start_consuming() # an implicit loop waiting to receive messages; it doesn't exit by default. Use Ctrl+C in the command window to terminate it.

def callback(channel, method, properties, body): # required signature for the callback; no return
    print("Received an order log by " + __file__)
    print()
    print("Issuing ticket into System")
    create_ticket(body)

def create_ticket(details):
    try:
        tickCode = "SA"
        data = json.loads(details)
        flight_details_id = data['flight_details_id']
        today = date.today()
        year = today.year
        month = today.month
        if(month < 10):
            month = "0"+str(month)
        day = today.day
        last_tickets = Ticket.query.filter(Ticket.issued_date == today).order_by(Ticket.ticket_id.desc()).first()
        ticketID = last_tickets.booking_id[10:]
        #ticket = Ticket(str(size+1),int(data['booking_id']), str(data['prefix']),str(data['first_name']), str(data['last_name']), str(data['middle_name']),str(data['suffix']),str(data['ff_id']))

        #db.session.add(ticket)
        #db.session.commit()
        return {"result":True}
    except Exception:
        traceback.print_exc()
        return {"result":False}

if __name__ == "__main__":  # execute this program only if it is run as a script (not by 'import')
    print("This is " + os.path.basename(__file__) + ": Issue ticket for an booking...")
    receiveOrderLog()