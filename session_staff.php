<?php
session_start();
$_SESSION['staff_id'] = $_POST['staff_id'];
$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];
$_SESSION['prefix'] = $_POST['prefix'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['country_code'] = $_POST['country_code'];
$_SESSION['country'] = $_POST['country'];
if (isset($_POST['middle_name'])) {
    $_SESSION['middle_name'] = $_POST['middle_name'];
}
if (isset($_POST['suffix'])) {
    $_SESSION['suffix'] = $_POST['suffix'];
}
$_SESSION['roles'] = $_POST['roles'];

?>
