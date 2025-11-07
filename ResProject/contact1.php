<?php
include 'db.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare and execute SQL
$sql = "INSERT INTO contacts (name, phone, email, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $phone, $email, $message);

if ($stmt->execute()) {
    // Redirect back with success message
    header("Location: contact.php?success=1");
    exit();
} else {
    // Redirect back with error message
    header("Location: contact.php?error=1");
    exit();
}
?>
