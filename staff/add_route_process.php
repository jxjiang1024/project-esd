<?php
session_start();
$_SESSION["messages"] = [];

$flight_no = $_GET["flight_no"];
$departure_airport_id = $_GET["departure_airport_id"];
$arrival_airport_id = $_GET["arrival_airport_id"];
$departure_time = $_GET["departure_time"];
$arrival_time = $_GET["arrival_time"];
$next_day = 0;

echo "<br>Arrival time: ".$arrival_time."<br>";
echo "<br>Departure time: ".$departure_time."</br>";

$arrival_time = strval($arrival_time).":00";
$departure_time = strval($departure_time).":00";

//var_dump($times);

echo "Posted: ";
//var_dump($_GET);

$new_route = array(
	"flight_no" => $flight_no,
	"departure_airport_id" => $departure_airport_id,
	"arrival_airport_id" => $arrival_airport_id,
	"departure_time" => $departure_time,
	"arrival_time" => $arrival_time,
	"next_day" => $next_day
);

var_dump($new_route);

$payload = json_encode($new_route);

// Prepare new cURL resource
$ch = curl_init("localhost:8003/route/add")	;
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload))
);

// Submit the POST request
$result = curl_exec($ch);

// Close cURL session handle
curl_close($ch);

//Handle return JSON
$result = json_decode($result, true);
echo "<br>".var_dump($result)."<br>";
var_dump($_SESSION["messages"]);

array_push($_SESSION["messages"], $result["message"]);
header("Location: add_route.php");


?>