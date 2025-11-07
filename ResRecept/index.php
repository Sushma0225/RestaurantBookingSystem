<?php
session_start();
include 'db.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Simple hardcoded login
  if ($username === 'receptionist' && $password === '1234') {
    $_SESSION['receptionist'] = true;
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Invalid username or password.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Receptionist Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
  <div class="login-box">
    <h2>Receptionist Login</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
      <p style="color:red;"><?= $error ?></p>
    </form>
  </div>
</div>
</body>
</html>
