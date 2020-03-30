<?php
session_start();
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
$_SESSION['prefix'] = $_POST['prefix'];
$_SESSION['payment_type'] = $_POST['payment'];

if (isset($_POST['middle_name'])) {
    $_SESSION['middle_name'] = $_POST['midname'];
}
?>