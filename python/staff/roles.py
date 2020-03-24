from flask import Flask,request,jsonify
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://esd@esd:456852@esd.mysql.database.azure.com:3306/fms'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

class Roles(db.Model):
    __tablename__ = 'roles'
    role_id =  db.Column(db.Integer, primary_key=True)
    type = db.Column(db.String(255),nullable = False)
    def __init__(self,role_id,type):
        self.role_id = role_id
        self.type = type
    def json(self):
        return{"role_id":self.role_id,"type":self.type}

def userRoles(role_id):
    try:
        role_type =Roles.query.filter(Roles.role_id == role_id).first()
        return jsonify({"role_id":role_type.role_id,"type":role_type.type,"result":True})
    except:
        return jsonify({"result":False})

if __name__ == "__main__":
     app.run( port=8003, debug=True)

