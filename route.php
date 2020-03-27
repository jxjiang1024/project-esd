<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Route</title>
</head>
<body>

<?php

$user = "admin";

if ($user!="admin"){
	//Access denied: Redirect user to another page
	header("Location: login.php");	
}

?>

<h1>Add New Flight Route</h1>

<form method="get" action="add_route_process.php">

<label>
Flight Number
<input name="flight_no">
</label>
<label>
Departure Airport ID
<input name="departure_airport_id">
</label>
<label>
Arrival Airport ID
<input name="arrival_airport_id">
</label>
<label>
Departure Time
<input name="departure_time">
</label>
<label>
Arrival Time
<input name="arrival_time">
</label>

<input type="submit" value="Add">

</form>






</body>
</html>