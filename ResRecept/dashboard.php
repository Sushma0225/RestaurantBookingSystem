<?php
session_start();
if (!isset($_SESSION['receptionist'])) {
    header("Location: index.php");
    exit;
}
include 'db.php';

// Fetch orders
$orders = $conn->query("SELECT * FROM orders ORDER BY order_time DESC");
if (!$orders) {
    die("Orders query failed: " . $conn->error);
}

// Fetch reservations
$reservations = $conn->query("SELECT * FROM reservations ORDER BY reservation_time DESC");
if (!$reservations) {
    die("Reservations query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Receptionist Panel - Diyalo Restaurant</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body { font-family: Arial,sans-serif; margin:0; background:#fff5f5; color:#333; }
    header { background:#b71c1c; color:white; padding:15px; font-size:20px; font-weight:bold; text-align:center; }
    .container { display:flex; }
    .sidebar { width:200px; background:#fff5f5; padding:20px; min-height:100vh; }
    .sidebar a { display:block; padding:10px; margin-bottom:10px; text-decoration:none; color:#b71c1c; font-weight:bold; border-radius:5px; }
    .sidebar a.active, .sidebar a:hover { background:#b71c1c; color:white; }
    .content { flex-grow:1; padding:20px; }
    .card { background:white; padding:20px; margin-bottom:30px; border-radius:8px; box-shadow:0 0 10px rgba(183,28,28,0.2); }
    h3 { color:#b71c1c; margin-bottom:15px; }
    table { width:100%; border-collapse:collapse; margin-bottom:10px; }
    th, td { border:1px solid #f2b5b5; padding:8px; text-align:left; }
    th { background-color:#f8d7da; color:#b71c1c; }
    select { padding:4px; border:1px solid #b71c1c; border-radius:4px; }
    a { color:#b71c1c; text-decoration:none; }
    a:hover { text-decoration:underline; }
    .success-msg { color:green; font-size:14px; display:none; margin-left:10px; }
  </style>
</head>
<body>

<header>🍽 Diyalo Receptionist Panel</header>

<div class="container">
  <div class="sidebar">
    <a href="dashboard.php" class="active">📋 Manage</a>
    <a href="logout.php">🔒 Logout</a>
  </div>

  <div class="content">

    <!-- Orders Section -->
    <div class="card">
      <h3>🧾 Orders</h3>
      <table>
        <tr>
          <th>Name</th><th>Items</th><th>Quantity</th><th>Phone</th><th>Time</th><th>Status</th><th>Actions</th>
        </tr>
        <?php while($row = $orders->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['item'])) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= $row['order_time'] ?></td>
            <td>
              <select onchange="updateOrderStatus(<?= $row['id'] ?>, this.value, this)" <?= $row['status'] === 'Completed' ? 'disabled' : '' ?>>
                <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Confirmed" <?= $row['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                <option value="Completed" <?= $row['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
              </select>
              <span class="success-msg">✔</span>
            </td>
            <td>
              <a href="edit_order.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
              <a href="delete_order.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this order?')">🗑️ Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <!-- Reservations Section -->
    <div class="card">
      <h3>📅 Reservations</h3>
      <table>
        <tr>
          <th>Name</th><th>Email</th><th>Phone</th><th>Date</th><th>Time</th><th>Guests</th><th>Message</th><th>Reserved_at</th><th>Table_no</th><th>Status</th><th>Actions</th>
        </tr>
        <?php while($row = $reservations->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= $row['reservation_date'] ?></td>
            <td><?= $row['reservation_time'] ?></td>
            <td><?= $row['guests'] ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= htmlspecialchars($row['reserved_at']) ?></td>
            <td><?= htmlspecialchars($row['table_no']) ?></td>
            <td>
              <select onchange="updateReservationStatus(<?= $row['id'] ?>, this.value, this)" <?= $row['status'] === 'Completed' ? 'disabled' : '' ?>>
                <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Confirmed" <?= $row['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                <option value="Completed" <?= $row['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
              </select>
              <span class="success-msg">✔</span>
            </td>
            <td>
              <a href="edit_reservation.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
              <a href="delete_reservation.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this reservation?')">🗑️ Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

  </div>
</div>

<script>
function showSuccess(el) {
    const msg = el.nextElementSibling;
    msg.style.display = 'inline';
    setTimeout(() => msg.style.display = 'none', 1000);
}

function updateOrderStatus(id, status, selectEl) {
    fetch('update_order_status.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + id + '&status=' + encodeURIComponent(status)
    })
    .then(res => res.text())
    .then(data => {
        console.log(data);
        showSuccess(selectEl);
        if(status === 'Completed') selectEl.disabled = true;
    })
    .catch(err => console.error(err));
}

function updateReservationStatus(id, status, selectEl) {
    fetch('update_reservation_status.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + id + '&status=' + encodeURIComponent(status)
    })
    .then(res => res.text())
    .then(data => {
        console.log(data);
        showSuccess(selectEl);
        if(status === 'Completed') selectEl.disabled = true;
    })
    .catch(err => console.error(err));
}
</script>

</body>
</html>
