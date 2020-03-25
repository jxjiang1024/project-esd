from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ
import json
import datetime


app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)
app.config['DEBUG'] = False
CORS(app)


# converts data type time col to make them serializable by json
def jsonTimeConverter(o):
    if isinstance(o, datetime.time):
        return o.__str__()

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


# # TEST FUNCTION: returns JSON list of all routes
@app.route("/route")
def get_all():
    return jsonify({"routes": [route.json() for route in Route.query.all()]})


@app.route("/route/add", methods=['POST'])
def add_route():
    try:
        if request.is_json():
            print("is json")
            new_route = request.get_json()
   
#
#


if __name__ == "__main__":
     app.run(host='0.0.0.0', port=8001, debug=True)