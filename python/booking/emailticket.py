from flask import Flask, render_template, request
from flask_mail import Mail, Message
import json
import requests
import traceback

app = Flask(__name__)
mail = Mail(app)

app.config['DEBUG'] = True
app.config['TESTING'] = True
app.config['MAIL_SERVER'] = 'smtp.gmail.com'
app.config['MAIL_PORT'] = 587
app.config['MAIL_USE_TLS'] = True
app.config['MAIL_USE_SSL'] = False
# app.config['MAIL_DEBUG'] = True
app.config['MAIL_USERNAME'] = 'gotrip.esd'
app.config['MAIL_PASSWORD'] = 'esd@esd456852'
app.config['MAIL_DEFAULT_SENDER'] = 'gotrip.esd@gmail.com'
app.config['MAIL_MAX_EMAILS'] = None
# app.config['MAIL_SUPPRESS_SEND'] = False
app.config['MAIL_ASCII_ATTACHMENTS'] = False

mail = Mail(app)

# check data type
@app.route("/ticket/email", methods=['POST'])
def sendmsg():
    try:
        data = request.get_json()
        print('got data:',data)
        subject = 'Ticket issue #'+str(data['ticketID'])
        msg = Message(subject,recipients=data['email'])
        msg.html = render_template('msg.html', prefix=data['prefix'], last_name=data['last_name'], ticket_id=data['ticketID'], issue_date=data['today'], first_name=data['first_name'], middle_name=data['middle_name'], flight_no=data['flight_no'], dep_airport_name=data['departureAirport'], dep_date=data['departDate'], departure_time=data['departureTime'], arr_airport_name=data['arrivalAirport'], arrival_time=data['arrivalTime'])
        print('created content')
        mail.send(msg)
        print('email sent')
        return {"result":True}
    except Exception:
        traceback.print_exc()
        return {"result":False}

if __name__ == "__main__":
     app.run(host='0.0.0.0', port=8302, debug=True)