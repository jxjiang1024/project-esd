<?php
session_start();
$_SESSION["spiderweb"] = [];

$email = $_SESSION['email'];
$flight_no = $_POST["flight_no"];
$flight_departure = $_POST["flight_departure"];
$flight_arrival = $_POST["flight_arrival"];
$tail_no = $_POST["tail_no"];
$econ_sv_price = $_POST["econ_sv_price"];
$econ_sv_seat = $_POST["econ_sv_seat"];
$econ_stnd_price = $_POST["econ_stnd_price"];
$econ_stnd_seat = $_POST["econ_stnd_seat"];
$econ_plus_price = $_POST["econ_plus_price"];
$econ_plus_seat = $_POST["econ_plus_seat"];
$pr_econ_sv_price = $_POST["pr_econ_sv_price"];
$pr_econ_sv_seat = $_POST["pr_econ_sv_seat"];
$pr_econ_stnd_price = $_POST["pr_econ_stnd_price"];
$pr_econ_stnd_seat = $_POST["pr_econ_stnd_seat"];
$pr_econ_plus_price = $_POST["pr_econ_plus_price"];
$pr_econ_plus_seat = $_POST["pr_econ_plus_seat"];
$bus_sv_price = $_POST["bus_sv_price"];
$bus_sv_seat = $_POST["bus_sv_seat"];
$bus_stnd_price = $_POST["bus_stnd_price"];
$bus_stnd_seat = $_POST["bus_stnd_seat"];
$bus_plus_price = $_POST["bus_plus_price"];
$bus_plus_seat = $_POST["bus_plus_seat"];
$first_stnd_price = $_POST["first_stnd_price"];
$first_stnd_seat = $_POST["first_stnd_seat"];


echo "Posted: ";
//var_dump($_POST);

$new_flight = array(

    "email" => $email,
    "flight_no" => $flight_no,
    "flight_departure" => $flight_departure,
    "flight_arrival" => $flight_arrival,
    "tail_no" => $tail_no,
    "econ_sv_price" => $econ_sv_price,
    "econ_sv_seat" => $econ_sv_seat,
    "econ_stnd_price" => $econ_stnd_price,
    "econ_stnd_seat" => $econ_stnd_seat,
    "econ_plus_price" => $econ_plus_price,
    "econ_plus_seat" => $econ_plus_seat,
    "pr_econ_sv_price" => $pr_econ_sv_price,
    "pr_econ_sv_seat" => $pr_econ_sv_seat,
    "pr_econ_stnd_price" => $pr_econ_stnd_price,
    "pr_econ_stnd_seat" => $pr_econ_stnd_seat,
    "pr_econ_plus_price" => $pr_econ_plus_price,
    "pr_econ_plus_seat" => $pr_econ_plus_seat,
    "bus_sv_price" => $bus_sv_price,
    "bus_sv_seat" => $bus_sv_seat,
    "bus_stnd_price" => $bus_stnd_price,
    "bus_stnd_seat" => $bus_stnd_seat,
    "bus_plus_price" => $bus_plus_price,
    "bus_plus_seat" => $bus_plus_seat,
    "first_stnd_price" => $first_stnd_price,
    "first_stnd_seat" => $first_stnd_seat,
);

//var_dump($new_flight);

$payload = json_encode($new_flight, JSON_PRETTY_PRINT);

var_dump($payload);

// Prepare new cURL resource
$ch = curl_init("localhost:8003/flight/add/flights")	;
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

$status = $result['result'];
$msg = $result['message'];

if($status==true){
    header("Location: addflights-success.php");
} else {
    array_push($_SESSION['spiderweb'],$msg);
    header("Location: addflights.php");
}

?>