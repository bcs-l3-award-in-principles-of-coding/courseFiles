<?php
include 'db.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];

$stmt = $conn->prepare("INSERT INTO contacts (first_name, last_name, email, phone_number) VALUES (?, ?, ?, ?)");
$stmt->execute([$firstName, $lastName, $email, $phoneNumber]);

// Redirect to the main page with a success message
header('Location: index.php?status=success');
?>
