<?php
include '../../includes/dbconnect.php';

$errors = [];

if (isset($_POST['book_btn'])) {

    // Hidden inputs
    $profession_id = isset($_POST['profession_id']) ? (int)$_POST['profession_id'] : 0;
    $work_id       = isset($_POST['work_id']) ? (int)$_POST['work_id'] : 0;

    // User details
    $fullname = trim($_POST['fullname'] ?? '');
    $phone    = trim($_POST['phone-number'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    // Booking details
    $date         = $_POST['date'] ?? '';
    $timeCategory = $_POST['timeCategory'] ?? '';
    $timeSlot     = $_POST['timeSlot'] ?? '';
    $address      = trim($_POST['servAddress'] ?? '');
    $note         = trim($_POST['note'] ?? '');

    $sql = "INSERT INTO service_booking
            (profession_id, work_id, fullname, phone, email, booking_date,
             time_category, time_slot, address, note)
            VALUES ('$professsion_id', '$work_id', '$fullname', '$phone', '$email', '$date', '$time_category', '$time_slot', '$address', '$note')";
?>
