<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.html");
  exit;
}
include 'db.php';
$result = $conn->query("SELECT * FROM reservations ORDER BY reserved_at DESC");
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reservations</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>Diyalo Admin Panel - Reservations</header>
<div class="container">
  <div class="sidebar">
    <a href="dashboard.php">🍽 Menu</a>
    <a href="view_orders.php">🧾 Orders</a>
    <a href="view_reservations.php">📅 Reservations</a>
    <a href="view_contacts.php">📨 Contacts</a>

  </div>
  <div class="content">
    <div class="card">
      <h3>Table Reservations</h3>
      <table>
        <tr>
          <th>Name</th><th>Email</th><th>Phone</th><th>Guests</th><th>Reservation Date</th><th>Reservation Time</th><th>Message</th><th>Reserved At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= htmlspecialchars($row['guests']) ?></td>
          <td><?= htmlspecialchars($row['reservation_date']) ?></td>
          <td><?= htmlspecialchars($row['reservation_time']) ?></td>
          <td><?= htmlspecialchars($row['message']) ?></td>
          <td><?= htmlspecialchars($row['reserved_at']) ?></td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>
