<?php
session_start();
if (!isset($_SESSION['receptionist'])) {
    http_response_code(403);
    echo "Not logged in";
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['status'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE reservations SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "Reservation status updated successfully";
    } else {
        http_response_code(500);
        echo "Error updating reservation status: " . $stmt->error;
    }
} else {
    http_response_code(400);
    echo "Invalid request";
}
?>
