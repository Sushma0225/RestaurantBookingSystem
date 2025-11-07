<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == 'admin' && $password == 'admin123') {
    $_SESSION['admin'] = true;
    header('Location: dashboard.php');
} else {
    echo "<script>alert('Invalid Credentials'); window.location='index.html';</script>";
}
?>
