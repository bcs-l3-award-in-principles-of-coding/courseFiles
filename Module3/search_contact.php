<?php
include 'db.php';

$searchQuery = $_POST['searchQuery'];
$stmt = $conn->prepare("SELECT * FROM contacts WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ?");
$stmt->execute(["%$searchQuery%", "%$searchQuery%", "%$searchQuery%"]);
$results = $stmt->fetchAll();

if ($results) {
    foreach ($results as $row) {
        echo "<p>{$row['first_name']} {$row['last_name']} - {$row['email']}</p>";
    }
} else {
    echo "<p>No contacts found.</p>";
}
?>
