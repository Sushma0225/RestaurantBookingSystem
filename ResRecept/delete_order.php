<?php
session_start();
if (!isset($_SESSION['receptionist'])) {
  header("Location: index.php");
  exit;
}
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM orders WHERE id=$id");
header("Location: dashboard.php");
exit;
