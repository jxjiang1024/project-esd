<?php
session_start();
$_SESSION['staff_id'] = $_POST['staff_id'];
$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];
$_SESSION['prefix'] = $_POST['prefix'];
if (isset($_POST['middle_name'])) {
    $_SESSION['middle_name'] = $_POST['middle_name'];
}
if (isset($_POST['suffix'])) {
    $_SESSION['suffix'] = $_POST['suffix'];
}
?>