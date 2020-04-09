from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ
from datetime import datetime, date
import requests
import traceback
import pika
import json
import random
import sys
import os


app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config["SQLALCHEMY_POOL_RECYCLE"] = 299
app.config['CONN_MAX_AGE'] = None
db = SQLAlchemy(app)

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
    billing_address = db.Column(db.String(255), nullable=False)
    expiration_date = db.Column(db.Text, nullable=False)

    def __init__(self,payment_id, payment_type, prefix, first_name,
    last_name, middle_name, amount, status, last_4_digit, billing_address, expiration_date):
        self.payment_id = payment_id
        self.payment_type = payment_type
        self.prefix = prefix
        self.first_name = first_name
        self.last_name = last_name
        self.middle_name = middle_name
        self.amount = amount
        self.status = status
        self.last_4_digit = last_4_digit
        self.billing_address = billing_address
        self.expiration_date = expiration_date

        
    def json(self):
        return {"payment_id": self.payment_id, "payment_type": self.payment_type,
        "prefix": self.prefix, "first_name": self.first_name,
        "last_name": self.last_name, "middle_name": self.middle_name,
        "amount": self.amount, "status": self.status,
        "last_4_digit": self.last_4_digit, "billing_address": self.billing_address,
        "expiration_date": self.expiration_date}

def processPayment(payment):
    print("Processing payment:")
    #print(payment)
    # Can do anything here. E.g., publish a message to the error handler when processing fails.
    resultstatus = bool(random.getrandbits(1)) # simulate success/failure with a random True or False
    #result = {'status': resultstatus, 'message': 'Simulated random payment result.', 'payment': payment}
    #resultmessage = json.dumps(result, default=str) # convert the JSON object to a string
    if not resultstatus: # inform the error handler when shipping fails
        print("Failed payment.")
        return {"result":False,"message":"Payment Failed"}
    else:
        print("OK payment.")
        transaction_r = add_transaction(json.loads(json.dumps(payment)))
        if not transaction_r:
            return {"result":False,"message":"Payment Failed"}
        else:
            return {"result":True,"message":"Payment Success","id":transaction_r['id']}

def add_transaction(payment):
    try:
        data = payment
        size = len(Payment.query.all())
        today = date.today()
        if(size == None or size == 0):
            size = 1
        else:
            size+=1
        transaction = Payment(size,str(data['payment_type']),str(data['p_prefix']),str(data['p_first_name']),str(data['p_last_name']),str(data['p_middle_name']),float(data['amount']),str(data['status']),int(data['last_4_digit']), str(data['billing_address']), str(data['expiration_date']))

        db.session.add(transaction)
        db.session.commit()
        return {"result":True,"message":"Successfully committed to database","id":size}
    except Exception:
        db.session.rollback()
        traceback.print_exc()
        db.session.close()
        return {"result":False,"message":"Failed to commit to database"}
