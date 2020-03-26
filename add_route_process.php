<?php

$flight_no = $_GET["flight_no"];
$departure_airport_id = $_GET["departure_airport_id"];
$arrival_airport_id = $_GET["arrival_airport_id"];
$departure_time = $_GET["departure_time"];
$arrival_time = $_GET["arrival_time"];

echo "Posted: ";
var_dump($_GET);

$new_route = array(
	"flight_no" => $flight_no,
	"departure_airport_id" => $departure_airport_id,
	"arrival_airport_id" => $arrival_airport_id,
	"departure_time" => $departure_time,
	"arrival_time" => $arrival_time
);

$payload = json_encode($new_route);

// Prepare new cURL resource
$ch = curl_init("localhost:8001/route")	;
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


?>