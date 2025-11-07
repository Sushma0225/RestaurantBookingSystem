<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.html");
  exit;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['contact_id'])) {
    $id = intval($_POST['contact_id']);
    $stmt = $conn->prepare("UPDATE contacts SET status = 'Handled' WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: view_contacts.php");
        exit;
    } else {
        echo "Error updating status.";
    }
    $stmt->close();
}
$conn->close();
?>
