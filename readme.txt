IS213 Enterprise Solution Development
Team: G6T4

Part 1: Set Up Instructions

To set up everything needed to run our flight management system (FMS):
1) Copy the project folder into the Wamp WWW folder on your local machine, located at path C:\wamp64/www
2) Launch WampServer 64
3) Launch RabbitMQ Server Start
4) Open 2 (two) terminal windows in Visual Studio Code or any other terminal of choice
5) In one terminal, go to the path C:\wamp64\www\project-esd\python\booking and run the command py booking.py to launch the Booking microservice
6) In the other terminal, go to the path C:\wamp64\www\project-esd\python\flight and run the command py flight.py to launch the Flight microservice

Our app was developed with the Country and Staff microservices hosted on an Azure cloud web app, but due to credit limitations may no longer be live. To run these microservices locally instead, follow these steps:
7) Run the Dockerfile located within the project folder at python > country
8) Run the Dockerfile located within the project folder at python > staff

The app's database was also hosted on Azure cloud during development, and may no longer be live. To access the database locally:
9) Open the project folder and run the script fms.sql in MySQL Workbench or your database programme of choice


Part 2: Using the FMS App

To visit the customer UI:
1) Go to the URL localhost/project-esd/index.html
2) No login is required to start using the customer UI

To visit the admin staff UI:
1) Go to the URL localhost/project-esd/login.php
2) Log in by using the email dough.t@fms.com and the password 456852



