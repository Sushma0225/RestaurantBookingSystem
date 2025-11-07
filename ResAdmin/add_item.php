<?php
include 'db.php';
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];

$sql = "INSERT INTO menu_items (name, price, image) VALUES ('$name', '$price', '$image')";
if ($conn->query($sql) === TRUE) {
  header("Location: dashboard.php");
} else {
  echo "Error: " . $conn->error;
}
?>


