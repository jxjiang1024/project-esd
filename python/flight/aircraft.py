from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from datetime import datetime
import traceback

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)
CORS(app)

class Aircrafts(db.Model):
    __tablename__ = 'aircraft'
    tail_no = db.Column(db.String(45), primary_key=True)
    model = db.Column(db.String(45), nullable=False)
    manufacturer = db.Column(db.String(45), nullable=False)
    econ = db.Column(db.Integer, nullable=False)
    pre_econ = db.Column(db.Integer, nullable=False)
    business = db.Column(db.Integer, nullable=False)
    first = db.Column(db.Integer, nullable=False)
    last_maintained = db.Column(db.DateTime, nullable=False)

    def __init__(self,tail_no,model,manufacturer,econ,pre_econ,business,first,last_maintained):

        self.tail_no = tail_no
        self.model = model
        self.manufacturer = manufacturer
        self.econ = econ
        self.pre_econ = pre_econ
        self.business = business
        self.first = first
        self.last_maintained = last_maintained
    def json(self):
        return{"tail_no":self.tail_no,"model":self.model,"manufacturer":self.manufacturer,"econ":self.econ,"pre_econ":self.pre_econ,"business":self.business,"first":self.first,"last_maintained":self.last_maintained}

def getAircrafts():
    try:
        aircraft_record = Aircrafts.query.all()
        return jsonify({"aircraft": [aircraft_record.json() for aircraft_record in aircraft_record],"result":True})
    except Exception:
        traceback.print_exc()
        return jsonify({"results":False,"message":"Database Error"})

def getSpecificAircraft(tail_no):
    tail = tail_no
    try:
        aircraft_record = Aircrafts.query.filter(Aircrafts.tail_no == tail).first()
        return jsonify({"tail_no":aircraft_record.tail_no,"model":aircraft_record.model,"manufacturer":aircraft_record.manufacturer,"econ":aircraft_record.econ,"pre_econ":aircraft_record.pre_econ,"business":aircraft_record.business,"first":aircraft_record.first,"last_maintained":aircraft_record.last_maintained,"result":True})
    except Exception:
        traceback.print_exc()
        return jsonify({"results":False,"message":"Database Error"})


if __name__ == "__main__":
     app.run( port=8004, debug=True)


