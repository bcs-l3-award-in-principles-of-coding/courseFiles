<?php
include 'db.php';

$selectedContacts = $_POST['selectedContacts'];
foreach ($selectedContacts as $contactId) {
    $stmt = $conn->prepare("DELETE FROM contacts WHERE contact_id = ?");
    $stmt->execute([$contactId]);
}

// Redirect to the main page after deletion
header('Location: index.php');
?>
