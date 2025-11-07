<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.html");
  exit;
}
include 'db.php';
$result = $conn->query("SELECT * FROM orders ORDER BY order_time DESC");
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Orders - Diyalo Admin Panel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>Diyalo Admin Panel - Orders</header>
<div class="container">
  <div class="sidebar">
    <a href="dashboard.php">🍽 Menu</a>
    <a href="view_orders.php" class="active">🧾 Orders</a>
    <a href="view_reservations.php">📅 Reservations</a>
    <a href="view_contacts.php">📨 Contacts</a>

  </div>
  <div class="content">
    <div class="card">
      <h3>Customer Orders</h3>
      <table>
        <tr>
          <th>Name</th><th>Phone</th><th>Item</th><th>Qty</th><th>Ordered At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= htmlspecialchars($row['item']) ?></td>
          <td><?= htmlspecialchars($row['quantity']) ?></td>
          <td><?= htmlspecialchars($row['order_time']) ?></td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>
