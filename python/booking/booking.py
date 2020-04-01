from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from datetime import datetime,date
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
CORS(app)

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

    def __init__(self, ticket_id, booking_id, prefix, first_name, last_name, middle_name, suffix, ff_id,comments):
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

def create_ticketing(data,id):
    ticket = dict()
    ticket['booking_id'] = id
    ticket['prefix'] = data['prefix']
    ticket['first_name'] = data['first_name']
    ticket['last_name'] = data['prefix']
    ticket['middle_name'] = data['middle_name']
    if(data['suffix'] == "" or data['suffix'] == None):
        ticket['suffix'] = ""
    else:
        ticket['suffix'] = data['suffix']
    ticket['last_name'] = data['last_name']
    if(data['ff_id'] == "" or data['ff_id'] == None):
        ticket['ff_id'] = ""
    else:
        ticket['ff_id'] = data['ff_id']
    ticket["flight_details_id"] = data['flight_details_id']
    return ticket


# AMQP Check valid payment
@app.route("/payment/check", methods=['POST'])
def check_payment():
    data = request.get_json()
    result = payment.processPayment(data)
    if(result['result'] != False):
        try:
            ccode = "SFA"
            today = date.today()
            year = today.year
            month = today.month
            if(month < 10):
                month = "0"+str(month)
            day = today.day
            last_booking = Booking.query.filter(Booking.booking_date == today).order_by(Booking.booking_id.desc()).first()
            if(last_booking != None):
                bookingID = last_booking.booking_id[11:]
                bookingID = int(bookingID)+1
                bookingID = str(bookingID).zfill(5)
                bookingID = ccode+str(day)+str(month)+str(year)+bookingID
            else:
                bookingID = 1
                bookingID = str(bookingID).zfill(5)
                bookingID = ccode+str(day)+str(month)+str(year)+bookingID
            if (data['staff_id'] == ""):
                staff_id = None
            bookingDetails = Booking(bookingID,data['flight_details_id'],str(today),result['id'],data['prefix'],data['first_name'],data['suffix'],data['last_name'],data['middle_name'],data['email'],staff_id,data['comments'])
            db.session.add(bookingDetails)
            db.session.commit()
            tickets = create_ticketing(data,bookingID)
            hostname = "localhost"
            port = 5672
            # # connect to the broker and set up a communication channel in the connection
            connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
            channel = connection.channel()
            # # set up the exchange if the exchange doesn't exist
            exchangename="booking"
            message = json.dumps(tickets, default=str)
            channel.queue_declare(queue='ticketing', durable=True) # make sure the queue used by Shipping exist and durable
            channel.queue_bind(exchange=exchangename, queue='ticketing', routing_key='booking.ticketing')
            channel.basic_publish(exchange=exchangename, routing_key="booking.ticketing", body=message,
                properties=pika.BasicProperties(delivery_mode = 2) # make message persistent within the matching queues until it is received by some receiver (the matching queues have to exist and be durable and bound to the exchange)
            )
            return jsonify({"result":True,"message":"Ticket will be issued to you shortly"})   
        except Exception:
             traceback.print_exc()
             db.session.rollback()
             db.session.close()
             return jsonify({"result":False,"message":"booking failed please contact our staff with the following transaction ID","id":result['id']})
    else:
        return jsonify({"result":False,"message":"Payment Failed"})
   
    

if __name__ == "__main__":
     app.run(host='0.0.0.0', port=8300, debug=True)