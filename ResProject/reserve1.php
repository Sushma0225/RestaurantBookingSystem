<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and trim inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $table_no = $_POST['table'] ?? '';
    $guests = $_POST['guests'] ?? '';
    $message = trim($_POST['message'] ?? '');

    // Input Validation
    $error = "";
    if (!$name || !$email || !$phone || !$date || !$time || !$table_no || !$guests) {
        $error = "empty_fields";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "invalid_email";
    } elseif (!preg_match('/^(98|97|96|94)[0-9]{8}$/', $phone)) {
        $error = "invalid_phone";
    } elseif ($date < date('Y-m-d')) {
        $error = "past_date";
    }

    if ($error) {
        header("Location: reserve.php?error=$error");
        exit();
    }

    // -Check Table Availability 
    $check = $conn->prepare("SELECT * FROM reservations WHERE reservation_date = ? AND reservation_time = ? AND table_no = ?");
    $check->bind_param("sss", $date, $time, $table_no);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        header("Location: reserve.php?error=table_taken");
        exit();
    }

    // Insert Reservation
    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, reservation_date, reservation_time, guests, message, table_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $phone, $date, $time, $guests, $message, $table_no);

    if ($stmt->execute()) {
        header("Location: reserve.php?success=1");
        exit();
    } else {
        header("Location: reserve.php?error=save_fail");
        exit();
    }

    // Close Connections 
    $stmt->close();
    $check->close();
    $conn->close();
} else {
    // If accessed directly without POST
    header("Location: reserve.php");
    exit();
}
?>
