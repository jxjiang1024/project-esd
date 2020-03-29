from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
import traceback


app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://esd:456852@database-1.cbchzgfp3eq7.us-east-1.rds.amazonaws.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)
CORS(app)

# Country class
class Country(db.Model):
    
    __tablename__ = 'country'

    COUNTRY_CODE = db.Column(db.String(2), primary_key=True)
    CONTINENT_CODE = db.Column(db.String(2), nullable=False)
    NAME = db.Column(db.String(255), nullable=False)


    def __init__(self,COUNTRY_CODE, CONTINENT_CODE, NAME):
        self.COUNTRY_CODE = COUNTRY_CODE
        self.CONTINENT_CODE = CONTINENT_CODE
        self.NAME = NAME


    def json(self):
        return {"COUNTRY_CODE": self.COUNTRY_CODE, "CONTINENT_CODE": self.CONTINENT_CODE, "NAME": self.NAME}

# Returns JSON list of all countries' names
@app.route("/country-names")
def get_all_names():
    return jsonify({"country names": [country.json()['NAME'] for country in Country.query.all()]})

@app.route("/country/<string:code>", methods = ["GET"])
def getCountryByCode(code):
    country_code = code
    try:
        country_data = Country.query.filter(Country.COUNTRY_CODE == country_code).first()
        return jsonify({"country_name": country_data.NAME,"result":True,"CONTINENT_CODE": country_data.CONTINENT_CODE})
    except Exception:
        traceback.print_exc()
        return jsonify({"results":False,"message":"Database Error"})


if __name__ == "__main__":
     app.run(host='0.0.0.0', port=80, debug=True)