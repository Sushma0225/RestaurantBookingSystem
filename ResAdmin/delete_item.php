<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM menu_items WHERE id=$id");
header("Location: dashboard.php");
?>

