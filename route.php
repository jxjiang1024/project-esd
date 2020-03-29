<?php
session_start();

//Check if user is admin or not
$user = "admin";
if ($user != "admin") {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROUTES</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
    integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" 
    crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script 
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
    
    <script 
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>
</head>
<body>
    <h1>ENTER ROUTE DETAILS</h1>
    <form id='route-details' method ='get' action='add_route.php'>

      <div class="form-group">
        Flight Number
        <input type="text" id="flight_no" name="flight_no">
        <br/><br/>
        Arrival Airport
        <input type="text" id="arrival_airport_id" name="arrival_airport_id">
        <br/><br/>
        Departure Airport
        <input type="text" id="departure_airport_id" name="departure_airport_id">
        <br/><br/>
        Departure Time
        <input type="time" id="departure_time" name="departure_time">
        <br/><br/>
        Arrival Time
        <input type="time" id="arrival_time" name="arrival_time">
        <br/><br/>
        Next Day
        <input type="number" id="next_day" name="next_day"  min="0" max="10">
                <br/><br/>

        <input id="submit-route"class="btn btn-primary" type="submit" value="Submit">
      </div>

    </form>


</body>

</html>