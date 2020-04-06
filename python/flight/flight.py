from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ
import datetime
import aircraft
import requests
import json
import traceback
from datetime import datetime

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

# Flight class
class Flight(db.Model):
    __tablename__ = 'flight_details'
    flight_details_id = db.Column(db.Integer, primary_key=True , autoincrement=True)
    flight_no = db.Column(db.String(45), nullable=False)
    flight_departure = db.Column(db.Date, nullable=False)
    flight_arrival = db.Column(db.Date, nullable=False)
    tail_no = db.Column(db.String(45), nullable=False)
    econ_sv_price = db.Column(db.Float(precision=2), nullable=False)
    econ_sv_seat = db.Column(db.Integer, nullable=False)
    econ_stnd_price = db.Column(db.Float(precision=2), nullable=False)
    econ_stnd_seat = db.Column(db.Integer, nullable=False)
    econ_plus_price = db.Column(db.Float(precision=2), nullable=False)
    econ_plus_seat = db.Column(db.Integer, nullable=False)
    pr_econ_sv_price = db.Column(db.Float(precision=2), nullable=False)
    pr_econ_sv_seat = db.Column(db.Integer, nullable=False)
    pr_econ_stnd_seat = db.Column(db.Integer, nullable=False)
    pr_econ_stnd_price = db.Column(db.Float(precision=2), nullable=False)
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

    def __init__(self,flight_details_id, flight_no, flight_departure, flight_arrival,
    tail_no, econ_sv_price, econ_sv_seat, econ_stnd_price, econ_stnd_seat,
    econ_plus_price, econ_plus_seat, pr_econ_sv_price, pr_econ_sv_seat,
    pr_econ_stnd_price, pr_econ_stnd_seat, pr_econ_plus_price, pr_econ_plus_seat,
    bus_sv_price, bus_sv_seat, bus_stnd_price, bus_stnd_seat, bus_plus_price,
    bus_plus_seat, first_stnd_price, first_stnd_seat, status_code):
        self.flight_details_id = flight_details_id
        self.flight_no = flight_no
        self.flight_departure = flight_departure
        self.flight_arrival = flight_arrival
        self.tail_no = tail_no
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

    def getflight_details_id(self):
        return self.flight_details_id
    
    def setflight_details_id(self,flight_details_id):
        self.flight_details_id = flight_details_id
    
    def getflight_no(self):
        return self.flight_no
    def setflight_no(self,flight_no):
        self.flight_no = flight_no 
    
    def getflight_departure(self):
        return self.flight_departure
    
    def setflight_departure(self,flight_departure):
        self.flight_departure = flight_departure
    def getflight_arrival(self):
        return self.flight_arrival
    def setflight_arrival(self,flight_arrival):
        self.flight_arrival = flight_arrival
    def gettail_no(self):
        return self.tail_no 
    def settail_no (self,tail_no ):
        self.tail_no  = tail_no 
    def getecon_sv_price(self):
        return self.econ_sv_price
    def setecon_sv_price(self,econ_sv_price):
        self.econ_sv_price = econ_sv_price
    def getecon_sv_seat(self):
        return self.econ_sv_seat
    def setecon_sv_seat(self,econ_sv_seat):
        self.econ_sv_seat = econ_sv_seat
    def getecon_stnd_price(self):
        return self.econ_stnd_price
    def setecon_stnd_price(self,econ_stnd_price):
        self.econ_stnd_price = econ_stnd_price
    def getecon_stnd_seat(self):
        return self.econ_stnd_seat
    def setecon_stnd_seat(self,econ_stnd_seat):
        self.econ_stnd_seat = econ_stnd_seat
    def getecon_plus_price(self):
        return self.econ_plus_price
    def setecon_plus_price(self,econ_plus_price):
        self.econ_plus_price = econ_plus_price
    def getecon_plus_seat(self):
        return self.econ_plus_seat
    def setecon_plus_seat(self,econ_plus_seat):
        self.econ_plus_seat = econ_plus_seat
    def getpr_econ_sv_price(self):
        return self.pr_econ_sv_price
    def setpr_econ_sv_price(self,pr_econ_sv_price):
        self.pr_econ_sv_price =pr_econ_sv_price
    def getpr_econ_sv_seat(self):
        return self.pr_econ_sv_seat
    def setpr_econ_sv_seat(self,pr_econ_sv_seat):
        self.pr_econ_sv_seat =pr_econ_sv_seat
    def getpr_econ_stnd_price(self):
        return self.pr_econ_stnd_price
    def setpr_econ_stnd_price(self,pr_econ_stnd_price):
        self.pr_econ_stnd_price = pr_econ_stnd_price
    def getpr_econ_stnd_seat(self):
        return self.pr_econ_stnd_seat
    def setpr_econ_stnd_seat(self,pr_econ_stnd_seat):
        self.pr_econ_stnd_seat = pr_econ_stnd_seat
    def getpr_econ_plus_price(self):
        return self.pr_econ_plus_price 
    def setpr_econ_plus_price (self,pr_econ_plus_price ):
        self.pr_econ_plus_price  = pr_econ_plus_price 
    def getpr_econ_plus_seat(self):
        return self.pr_econ_plus_seat
    def setpr_econ_plus_seat(self,pr_econ_plus_seat):
        self.pr_econ_plus_seat = pr_econ_plus_seat
    def getbus_sv_price(self):
        return self.bus_sv_price
    def setbus_sv_price(self,bus_sv_price):
        self.bus_sv_price = bus_sv_price
    def getbus_sv_seat(self):
        return self.bus_sv_seat
    def setbus_sv_seat(self,bus_sv_seat):
        self.bus_sv_seat = bus_sv_seat
    def getbus_stnd_price(self):
        return self.bus_stnd_price
    def setbus_stnd_price(self,bus_stnd_price):
        self.bus_stnd_price = bus_stnd_price
    def getbus_stnd_seat(self):
        return self.bus_stnd_seat
    def setbus_stnd_seat(self,bus_stnd_seat):
        self.bus_stnd_seat = bus_stnd_seat
    def getbus_plus_price (self):
        return self.bus_plus_price 
    def setbus_plus_price (self,bus_plus_price ):
        self.bus_plus_price = bus_plus_price 
    def getbus_plus_seat(self):
        return self.bus_plus_seat
    def setbus_plus_seat(self,bus_plus_seat):
        self.bus_plus_seat = bus_plus_seat
    def getfirst_stnd_price(self):
        return self.first_stnd_price
    def setfirst_stnd_price(self,first_stnd_price):
        self.first_stnd_price = first_stnd_price
    def getfirst_stnd_seat(self):
        return self.first_stnd_seat
    def setfirst_stnd_seat(self,first_stnd_seat):
        self.first_stnd_seat = first_stnd_seat
    def getstatus_code(self):
        return self.status_code
    def setstatus_code(self,status_code):
        self.status_code =status_code
    def json(self):
        return {"flight_details_id": self.flight_details_id, "flight_no": self.flight_no,
        "flight_departure": self.flight_departure, "flight_arrival": self.flight_arrival,
        "tail_no": self.tail_no, "econ_sv_price": self.econ_sv_price,
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
    def json_get_flights(self,Status):
        stat = Status.query.filter(Status.status_code ==  self.status_code).first()
        return {"flight_details_id": self.flight_details_id , "flight_no": self.flight_no,
        "flight_departure": self.flight_departure, "flight_arrival": self.flight_arrival,
        "tail_no": self.tail_no,"economy_seats":self.econ_sv_seat+self.econ_stnd_seat+self.econ_plus_seat,"premium_economy_seats":self.pr_econ_sv_seat+self.pr_econ_stnd_seat+self.pr_econ_plus_seat,"business_seats": self.bus_sv_seat+self.bus_stnd_seat+self.bus_plus_seat,"first_class_seats":self.first_stnd_seat,"status": stat.status }

# Route class
class Route(db.Model):
    __tablename__ = 'routes'

    flight_no = db.Column(db.String(45), primary_key=True)
    departure_airport_id = db.Column(db.String(10), nullable=False)
    arrival_airport_id = db.Column(db.String(10), nullable=False)
    departure_time = db.Column(db.TIME, nullable=False)
    arrival_time = db.Column(db.TIME, nullable=False)
    next_day = db.Column(db.SMALLINT, nullable=False)

    def __init__(self,flight_no, departure_airport_id, arrival_airport_id, departure_time, arrival_time, next_day):
        self.flight_no = flight_no
        self.departure_airport_id = departure_airport_id
        self.arrival_airport_id = arrival_airport_id
        self.departure_time = departure_time
        self.arrival_time = arrival_time
        self.next_day = next_day
    
    
    def json(self):
        return {"flight_no": self.flight_no, "departure_airport_id": self.departure_airport_id, "arrival_airport_id": self.arrival_airport_id, "departure_time": str(self.departure_time), "arrival_time":str(self.arrival_time), "next_day": self.next_day}
    def json_set(self,iataCode):
        depAirports = iataCode.query.filter(iataCode.IATA_CODE == self.departure_airport_id).first()
        arrAirports = iataCode.query.filter(iataCode.IATA_CODE == self.arrival_airport_id).first()
        return {"flight_no": self.flight_no, "departure_airport_id": depAirports.airportName+" ("+ self.departure_airport_id+")" , "arrival_airport_id":arrAirports.airportName+" ("+ self.arrival_airport_id+")", "departure_time": str(self.departure_time), "arrival_time": str(self.arrival_time), "next_day": self.next_day}

class iataCode(db.Model):
    __tablename__ = "iata_code"
    IATA_CODE = db.Column(db.String(10), primary_key=True)
    airportName = db.Column(db.String(255), nullable=False)
    COUNTRY_CODE = db.Column(db.String(2), nullable=False)
    CONTINENT_CODE = db.Column(db.String(5), nullable=False)

    def __init__(self,IATA_CODE,airportName,COUNTRY_CODE,CONTINENT_CODE):
        self.IATA_CODE = IATA_CODE
        self.airportName = airportName
        self.COUNTRY_CODE = COUNTRY_CODE
        self.CONTINENT_CODE = CONTINENT_CODE

    def json(self):
        return{"IATA_CODE": self.IATA_CODE,"airportName":self.airportName,"COUNTRY_CODE":self.COUNTRY_CODE,"CONTINENT_CODE":self.CONTINENT_CODE}

class Status(db.Model):
     __tablename__ = 'status'
     status_code = db.Column(db.String(3), primary_key=True)
     status = db.Column(db.String(255),  nullable=False)
     def __init__(self,status_code,status):
         self._status = status
         self._status_code = status_code
     def getstatus_code(self):
         return self._status_code 
     def setstatus_code(self,status_code):
         self._status_code = status_code
     def getstatus(self):
         return self._status
     def setstatus(self,status):
         self._status =status
     def json(self):
         return{"status_code":self.status_code,"status":self.status}

## Retrieve All Flights Routes Listing
@app.route("/flight/route")
def get_all_routes():
    try:
        route_record = Route.query.all()
        return jsonify({"route":[route_record.json_set(iataCode) for route_record in route_record ],"result":True})
    except:
        return jsonify({"result":False,"message":"Database Error"})

@app.route("/flight/details")
def get_all_details():
    try:
        flight_record = Flight.query.all()
        return jsonify({"flight":[flight_record.json_get_flights(Status) for flight_record in flight_record], "result": True})
    except:
        return jsonify({"result":False,"message":"Database Error"})

@app.route("/flight/aircrafts",methods=['POST'])
def get_all_aircrafts():
    aircrafts =  aircraft.getAircrafts()
    return aircrafts
    
@app.route("/flight/add/flights",methods=['POST'])
def addFlightDetails():
    json_1 = request.get_json()
    staffURL = "https://staffesd.azurewebsites.net/staff/check/"+str(json_1['email'])
    r = requests.post(staffURL, json = json_1)
    result = json.loads(r.text.lower())
    if(result['result'] == True):
        ## Check if User is valid
        if(result['role'] == 999 or result['role'] == 2):
            try:
                tail_no = str(json_1['tail_no'])
                aircraftData = aircraft.getSpecificAircraft(tail_no,0)
                economy = int(json_1['econ_sv_seat']) + int(json_1['econ_stnd_seat'])+int(json_1['econ_plus_seat'])
                pr_economy = int(json_1['pr_econ_sv_seat']) + int(json_1['pr_econ_stnd_seat']) + int(json_1['pr_econ_plus_seat'])
                business = int(json_1['bus_sv_seat'])+int(json_1['bus_stnd_seat'])+int(json_1['bus_plus_seat'])
                first = int(json_1['first_stnd_seat'])
                if(economy> int(aircraftData['econ']) or int(business) > int(aircraftData['business']) or int(pr_economy) > int(aircraftData['pre_econ']) or int(first)>int(aircraftData['first'])):
                    message = {"result": False, "message":"Seat amount entered Exceeded"}
                elif (int(economy) < 0 or int(business) < 0 or int(pr_economy) < 0 or int(first) < 0):
                    message = {"result": False, "message":"Seat amount cannot be lower than 0"}
                else:
                    route =  Route.query.filter(Route.flight_no == str(json_1['flight_no'])).first()
                    if(str(json_1['flight_no']) == str(route.flight_no)):
                        flight = Flight(0,json_1['flight_no'],str(json_1['flight_departure']),str(json_1['flight_arrival']),str(json_1['tail_no']),float(json_1['econ_sv_price']),int(json_1['econ_sv_seat']),float(json_1['econ_stnd_price']),int(json_1['econ_stnd_seat']),float(json_1['econ_plus_price']),int(json_1['econ_plus_seat']),float(json_1['pr_econ_sv_price']),int(json_1['pr_econ_sv_seat']),float(json_1['pr_econ_stnd_price']),int(json_1['pr_econ_stnd_seat']),float(json_1['pr_econ_plus_price']),int(json_1['pr_econ_plus_seat']),float(json_1['bus_sv_price']),int(json_1['bus_sv_seat']),float(json_1['bus_stnd_price']),int(json_1['bus_stnd_seat']),float(json_1['bus_plus_price']),int(json_1['bus_plus_seat']),float(json_1['first_stnd_price']),int(json_1['first_stnd_seat']),2)
                        db.session.add(flight)
                        db.session.commit()
                        message = {"result": True,"message":"Data Created"}
                    else:
                        message = {"result": False, "message":"invalid Flight Number"}
            except Exception:
                traceback.print_exc()
                message = {"result": False, "message":"Database Error"}
        else:
            message = {"message":"insufficient Rights","result": False}
    else:
        message = {"result": False,"message":"invald user"}
    return jsonify(message)

@app.route("/aircraft/<string:tail_no>",methods=['GET'])
def get_aircraft(tail_no):
    tail = tail_no
    aircrafts = aircraft.getSpecificAircraft(tail,1)
    return aircrafts

@app.route("/route/add", methods=['POST'])
def add_route():
    try:
        route_json = request.get_json()
        if route_json['departure_airport_id'] == route_json['arrival_airport_id']:
            return jsonify({"result": False,"message":"Departure and Arrical airport cannot be the same"})
        departure_airport = iataCode.query.filter(iataCode.IATA_CODE == route_json['departure_airport_id'] ).first()
        arrival_airport = iataCode.query.filter(iataCode.IATA_CODE == route_json['arrival_airport_id'] ).first()
        if(departure_airport is None or arrival_airport is None):
            return jsonify({"result":False,"message": "Airport Code Error"})
        refl = "SFL"+str(route_json['flight_no'])
        flightNo = Route.query.filter(Route.flight_no == refl).first()
        if(flightNo is not None):
            return jsonify({"result":False,"message":"Similar flight number exist"})
        route = Route(refl,route_json['departure_airport_id'],route_json['arrival_airport_id'],datetime.datetime.strptime(route_json['departure_time'], '%H:%M:%S'),datetime.datetime.strptime(route_json['arrival_time'], '%H:%M:%S'),0)
        db.session.add(route)
        db.session.commit()
        return jsonify({"result":True,"message":"Successfully added to database"})
    except Exception:
        traceback.print_exc()
        return jsonify({"result": False, "message":"Error"})


@app.route("/flight/iata/airports")
def get_all_airport_names():
    iata = iataCode.query.all()
    return jsonify({"airport names":[airport.airportName for airport in iata], "result":True})
    
@app.route("/flight/findFlights", methods=['POST'])
def findFlights():
    data = request.get_json()
    departDate = str(data['departDate'])
    try:
        departureAirport = iataCode.query.filter(iataCode.airportName == data['departureAirport']).first()
        arrivalAirport = iataCode.query.filter(iataCode.airportName == data['arrivalAirport']).first()
        flightNo = Route.query.filter(Route.arrival_airport_id == arrivalAirport.IATA_CODE).filter(Route.departure_airport_id == departureAirport.IATA_CODE).all()
        flightNoList = [flight.flight_no for flight in flightNo]
        flights = Flight.query.filter(Flight.flight_departure == data['departDate']).filter(Flight.flight_no.in_(flightNoList)).all()
        if data['isReturn']:
            flightNo = Route.query.filter(Route.arrival_airport_id == departureAirport.IATA_CODE).filter(Route.departure_airport_id == arrivalAirport.IATA_CODE).all()
            flightNoList = [flight.flight_no for flight in flightNo]
            flights2 = Flight.query.filter(Flight.flight_departure == data['returnDate']).filter(Flight.flight_no.in_(flightNoList)).all()
            return jsonify({"flights": [flight.json() for flight in flights] + [flight.json() for flight in flights2]})
        return jsonify({"flights": [flight.json() for flight in flights]})
    
    except Exception:
        traceback.print_exc()
        return jsonify({"result": False, "message": "No available flights"})


if __name__ == "__main__":
     app.run( port=8003, debug=True)
