#!/usr/bin/env python3
# The above shebang (#!) operator tells Unix-like environments
# to run this file as a python3 script

import json
import sys
import os
import random


# Communication patterns:
# Use a message-broker with 'direct' exchange to enable interaction
import pika


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
    # prepare a queue for receiving messages
    channelqueue = channel.queue_declare(queue="ticketing", durable=True) # 'durable' makes the queue survive broker restarts so that the messages in it survive broker restarts too
    queue_name = channelqueue.method.queue
    channel.queue_bind(exchange=exchangename, queue=queue_name, routing_key='booking.ticketing') # bind the queue to the exchange via the key

    # set up a consumer and start to wait for coming messages
    channel.basic_qos(prefetch_count=1) # The "Quality of Service" setting makes the broker distribute only one message to a consumer if the consumer is available (i.e., having finished processing and acknowledged all previous messages that it receives)
    channel.basic_consume(queue=queue_name, on_message_callback=callback)
    channel.start_consuming() # an implicit loop waiting to receive messages; it doesn't exit by default. Use Ctrl+C in the command window to terminate it.

def callback(channel, method, properties, body): # required signature for the callback; no return
    print("Received an order by " + __file__)
    result = processOrder(json.loads(body))
    # print processing result; not really needed
    json.dump(result, sys.stdout, default=str) # convert the JSON object to a string and print out on screen
    print() # print a new line feed to the previous json dump
    print() # print another new line as a separator

    print("Received an order log by " + __file__)
    processOrder(json.loads(body))
    print() # print a new line feed

def processOrder(order):
    print("Processing an booking:")
    print(order)
    # Can do anything here. E.g., publish a message to the error handler when processing fails.
    resultstatus = bool(random.getrandbits(1)) # simulate success/failure with a random True or False
    result = {'status': resultstatus, 'message': 'Simulated random booking result.', 'booking': order}
    resultmessage = json.dumps(result, default=str) # convert the JSON object to a string
    if not resultstatus: # inform the error handler when shipping fails
        print("Failed shipping.")
    else:
        print("OK shipping.")
    return result


if __name__ == "__main__":  # execute this program only if it is run as a script (not by 'import')
    print("This is " + os.path.basename(__file__) + ": Issue ticket for an booking...")
    receieveTicket()