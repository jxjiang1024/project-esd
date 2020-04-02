from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
import json
import requests
import traceback

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config["SQLALCHEMY_POOL_RECYCLE"] = 299
app.config['CONN_MAX_AGE'] = None
db = SQLAlchemy(app)
CORS(app)

class Staff(db.Model):
    __tablename__ = 'staff'
    staff_id = db.Column(db.Integer, primary_key=True)
    prefix = db.Column(db.String(3),nullable = False)
    first_name = db.Column(db.String(255), nullable=False)
    last_name = db.Column(db.String(255), nullable = False)
    middle_name = db.Column(db.String(255), nullable=True)
    suffix = db.Column(db.String(255), nullable=True)
    email = db.Column(db.String(255), nullable=False)
    contact_hp = db.Column(db.Integer, nullable=False)
    contact_home = db.Column(db.Integer, nullable=True)
    country_code = db.Column(db.String(2), nullable =False)
    address_1 = db.Column(db.String(255), nullable = False)
    address_2 = db.Column(db.String(45), nullable = True)
    state = db.Column(db.String(45), nullable = True)
    city = db.Column(db.String(45), nullable = False)
    postal_code = db.Column(db.String(45), nullable = False)
    ispilot = db.Column(db.Integer, nullable = False)
    isFlightCrew = db.Column(db.Integer, nullable = False)
    password = db.Column(db.String, nullable = False)
    isactive = db.Column(db.Integer, nullable = False)
    hourly_rate = db.Column(db.Float(precision=2),nullable=False)
    roles = db.Column(db.Integer, nullable = False)

    def __init__(self,staff_id,prefix,first_name,last_name,middle_name,suffix,email,contact_hp,contact_home,country_code,address_1,address_2,state,city,postal_code,ispilot,isFlightCrew,password,isactive,hourly_rate,roles):
        self.staff_id = staff_id
        self.prefix = prefix
        self.first_name = first_name
        self.last_name = last_name
        self.middle_name = middle_name
        self.suffix = suffix
        self.email = email
        self.contact_hp = contact_hp
        self.contact_home = contact_home
        self.country_code = country_code
        self.address_1 = address_1
        self.address_2 = address_2
        self.state = state
        self.city = city
        self.postal_code = postal_code
        self.ispilot = ispilot
        self.isFlightCrew = isFlightCrew
        self.password = password
        self.isactive = isactive
        self.hourly_rate = hourly_rate
        self.roles = roles

    def getstaff_id(self):
        return self.staff_id
    def setstaff_id(self,staff_id):
        self.staff_id = staff_id
    
    def json(self):
        return{"staff_id":self.staff_id,"prefix":self.prefix,"first_name":self.first_name,"last_name":self.last_name,"middle_name":self.middle_name,"suffix":self.suffix,"email":self.email,"contact_hp":self.contact_hp,"contact_home":self.contact_home,"country_code":self.country_code,"address_1":self.address_1 ,"address_2":self.address_2 ,"state":self.state,"city":self.city ,"postal_code":self.postal_code ,"ispilot":self.ispilot,"isFlightCrew":self.isFlightCrew,"password":self.password,"isactive":self.isactive,"hourly_rate":self.hourly_rate,"roles":self.roles}

class Roles(db.Model):
    __tablename__ = 'roles'
    role_id =  db.Column(db.Integer, primary_key=True)
    type = db.Column(db.String(255),nullable = False)
    def __init__(self,role_id,type):
        self.role_id = role_id
        self.type = type
    def json(self):
        return{"role_id":self.role_id,"type":self.type}

@app.route("/staff/login/<string:emails>" ,methods=['POST'])
def check_user(emails):

    email = emails
    password = request.get_json()
    try:
        records = Staff.query.filter(Staff.email == email).first()
        if(str(records.password) == password['password']):
            countryURL = "https://countryesd.azurewebsites.net/country/"+str(records.country_code)
            for x in range(2):
                r = requests.get(countryURL)
            result = json.loads(r.text.lower())
            up = str(records.country_code)
            prep_country = result['country_name']+ " ("+ up.upper() +")"
            return jsonify({"result":True,"staff_id":records.staff_id,"prefix":records.prefix,"first_name":records.first_name,"last_name":records.last_name,"middle_name":records.middle_name,"suffix":records.suffix,"roles":records.roles,"country":prep_country.capitalize(),"country_code":records.country_code,"contact_hp":records.contact_hp})
        else:
            return jsonify({"result":False})
    except Exception:
        traceback.print_exc()
        return jsonify({"result":"Database Error"})

@app.route("/staff/roles/<string:role>" ,methods=['GET'])
def getUserRoleName(role):
    role_out = userRoles(role)
    return role_out

@app.route("/staff/check/<string:emails>", methods=['POST'])
def check_userRights(emails):
 
    email = emails
    staff = None
    try:
        if request.is_json:
            staff = request.get_json()
            records = Staff.query.filter(Staff.email == email).first()
            if(records == None):
                replymessage = json.dumps({"message": "Invalid Data Parsed", "data": staff, "result":False}, default=str)
            else:
                replymessage = json.dumps({"role": records.roles, "result":True}, default=str)
            return replymessage, 200
        else:
            staff = request.get_data()
            replymessage = json.dumps({"message": "Order should be in JSON", "data": staff, "result":False}, default=str)
            return replymessage, 400 # Bad Request
    except:
        replymessage = json.dumps({"message":"Error" , "result":False}, default=str)
        return replymessage, 501

def userRoles(role_id):
    try:
        role_type =Roles.query.filter(Roles.role_id == role_id).first()
        return jsonify({"role_id":role_type.role_id,"type":role_type.type,"result":True})
    except:
        return jsonify({"result":False})
    
    
if __name__ == "__main__":
     app.run(host='0.0.0.0', port=80, debug=True)