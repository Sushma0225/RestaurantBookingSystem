<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$isBirthday = false;

if (isset($_SESSION["user_id"])) {
  include 'db.php';

  $user_id = $_SESSION["user_id"];
  $stmt = $conn->prepare("SELECT dob FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $stmt->bind_result($dob);
  $stmt->fetch();
  $stmt->close();

  if ($dob) {
    $today = date("m-d");
    $dobParts = explode("-", $dob);//splits the $dob string into parts by -
    if (count($dobParts) === 3 && $today === $dobParts[1] . '-' . $dobParts[2]) {
      $isBirthday = true;
    }
  }
}
?>
