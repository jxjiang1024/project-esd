from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ
import datetime


app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)
CORS(app)

# converts data type time col to make them serializable by json
def jsonTimeConverter(o):
    if isinstance(o, datetime.time):
        return o.__str__()

# Flight class
class Flight(db.Model):
    
    __tablename__ = 'flight_details'

    flight_details_id = db.Column(db.Integer, primary_key=True)
    flight_no = db.Column(db.String(45), nullable=False)
    flight_departure = db.Column(db.Date, nullable=False)
    flight_arrival = db.Column(db.Date, nullable=False)
    aircraft_tail_no = db.Column(db.String(45), nullable=False)
    econ_sv_price = db.Column(db.Float(precision=2), nullable=False)
    econ_sv_seat = db.Column(db.Integer, nullable=False)
    econ_stnd_price = db.Column(db.Float(precision=2), nullable=False)
    econ_stnd_seat = db.Column(db.Integer, nullable=False)
    econ_plus_price = db.Column(db.Float(precision=2), nullable=False)
    econ_plus_seat = db.Column(db.Integer, nullable=False)
    pr_econ_sv_price = db.Column(db.Float(precision=2), nullable=False)
    pr_econ_sv_seat = db.Column(db.Integer, nullable=False)
    pr_econ_stnd_price = db.Column(db.Float(precision=2), nullable=False)
    pr_econ_stnd_seat = db.Column(db.Integer, nullable=False)
    pr_econ_plus_price = db.Column(db.Float(precision=2), nullable=False)
    pr_econ_plus_seat = db.Column(db.Integer, nullable=False)
    bus_sv_price = db.Column(db.Float(precision=2), nullable=False)
    bus_sv_seat = db.Column(db.Integer, nullable=False)
    bus_stnd_price = db.Column(db.Float(precision=2), nullable=False)
    bus_stnd_seat = db.Column(db.Integer, nullable=False)
    bus_plus_price = db.Column(db.Float(precision=2), nullable=False)
    bus_plus_seat = db.Column(db.Integer, nullable=False)
    first_stnd_price = db.Column(db.Float(precision=2), nullable=False)
    first_stnd_seat = db.Column(db.Integer, nullable=False)
    status_code = db.Column(db.String(3), nullable=False)

    def __init__(flight_details_id, flight_no, flight_departure, flight_arrival,
    aircraft_tail_no, econ_sv_price, econ_sv_seat, econ_stnd_price, econ_stnd_seat,
    econ_plus_price, econ_plus_seat, pr_econ_sv_price, pr_econ_sv_seat,
    pr_econ_stnd_price, pr_econ_stnd_seat, pr_econ_plus_price, pr_econ_plus_seat,
    bus_sv_price, bus_sv_seat, bus_stnd_price, bus_stnd_seat, bus_plus_price,
    bus_plus_seat, first_stnd_price, first_stnd_seat, status_code):
        self.flight_details_id = flight_details_id
        self.flight_no = flight_no
        self.flight_departure = flight_departure
        self.flight_arrival = flight_arrival
        self.aircraft_tail_no = aircraft_tail_no
        self.econ_sv_price = econ_sv_price
        self.econ_sv_seat = econ_sv_seat
        self.econ_stnd_price = econ_stnd_price
        self.econ_stnd_seat = econ_stnd_seat
        self.econ_plus_price = econ_plus_price
        self.econ_plus_seat = econ_plus_seat
        self.pr_econ_sv_price = pr_econ_sv_price
        self.pr_econ_sv_seat = pr_econ_sv_seat
        self.pr_econ_stnd_price = pr_econ_stnd_price
        self.pr_econ_stnd_seat = pr_econ_stnd_seat
        self.pr_econ_plus_price = pr_econ_plus_price
        self.pr_econ_plus_seat = pr_econ_plus_seat
        self.bus_sv_price = bus_sv_price
        self.bus_sv_seat = bus_sv_seat
        self.bus_stnd_price = bus_stnd_price
        self.bus_stnd_seat = bus_stnd_seat
        self.bus_plus_price = bus_plus_price
        self.bus_plus_seat = bus_plus_seat
        self.first_stnd_price = first_stnd_price
        self.first_stnd_seat = first_stnd_seat
        self.status_code = status_code

    def json(self):
        return {"flight_details_id": self.flight_details_id, "flight_no": self.flight_no,
        "flight_departure": self.flight_departure, "flight_arrival": self.flight_arrival,
        "aircraft_tail_no": self.aircraft_tail_no, "econ_sv_price": self.econ_sv_price,
        "econ_sv_seat": self.econ_sv_seat, "econ_stnd_price": self.econ_stnd_price,
        "econ_stnd_seat": self.econ_stnd_seat, "econ_plus_price": self.econ_plus_price,
        "econ_plus_seat": self.econ_plus_seat, "pr_econ_sv_price": self.pr_econ_sv_price,
        "pr_econ_sv_seat": self.pr_econ_sv_seat, "pr_econ_stnd_price": self.pr_econ_stnd_price,
        "pr_econ_stnd_seat": self.pr_econ_stnd_seat, "pr_econ_plus_price": self.pr_econ_plus_price,
        "pr_econ_plus_seat": self.pr_econ_plus_seat, "bus_sv_price": self.bus_sv_price,
        "bus_sv_seat": self.bus_sv_seat, "bus_stnd_price": self.bus_stnd_price,
        "bus_stnd_seat": self.bus_stnd_seat, "bus_plus_price": self.bus_plus_price,
        "bus_plus_seat": self.bus_plus_seat, "first_stnd_price": self.first_stnd_price,
        "first_stnd_seat": self.first_stnd_seat, "status_code": self.status_code}


# Route class
class Route(db.Model):
    __tablename__ = 'routes'

    flight_no = db.Column(db.String(45), primary_key=True)
    departure_airport_id = db.Column(db.String(10), nullable=False)
    arrival_airport_id = db.Column(db.String(10), nullable=False)
    departure_time = db.Column(db.TIME, nullable=False)
    arrival_time = db.Column(db.TIME, nullable=False)
    next_day = db.Column(db.SMALLINT, nullable=False)

    def __init__(flight_no, departure_airport_id, arrival_airport_id, departure_time, arrival_time, next_day):
        self.flight_no = flight_no
        self.departure_airport_id = departure_airport_id
        self.arrival_airport_id = arrival_airport_id
        self.departure_time = departure_time
        self.arrival_time = arrival_time
        self.next_day = next_day

    
    def json(self):
        return {"flight_no": self.flight_no, "departure_airport_id": self.departure_airport_id, "arrival_airport_id": self.arrival_airport_id, "departure_time": jsonTimeConverter(self.departure_time), "arrival_time": jsonTimeConverter(self.arrival_time), "next_day": self.next_day}


# # TEST FUNCTION: returns JSON list of all flights
# @app.route("/flight")
# def get_all():
#     return jsonify({"flights": [flight.json() for flight in Flight.query.all()]})

# # TEST FUNCTION: returns JSON list of all routes
# @app.route("/route")
# def get_all():
#     return jsonify({"routes": [route.json() for route in Route.query.all()]})


if __name__ == "__main__":
     app.run(host='0.0.0.0', port=8001, debug=True)