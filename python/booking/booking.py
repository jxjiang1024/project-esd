from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ
import datetime
from datetime import datetime
import requests
import traceback


app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
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

if __name__ == "__main__":
     app.run(host='0.0.0.0', port=8300, debug=True)