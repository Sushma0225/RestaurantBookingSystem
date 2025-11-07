<?php
include 'db.php';

$name = $_POST['name'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$phone = $_POST['phone'];

// Prepare SQL
$sql = "INSERT INTO orders (name, item, quantity, phone) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $name, $item, $quantity, $phone);

if ($stmt->execute()) {
    // Redirect with success message
    header("Location: order.php?success=1");
    exit();
} else {
    // Redirect with error message
    header("Location: order.php?error=1");
    exit();
}

$conn->close();
?>
