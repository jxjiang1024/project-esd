from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ
import requests
import traceback


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
     app.run(host='0.0.0.0', port=8301, debug=True)