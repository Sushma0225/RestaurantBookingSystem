<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.html");
  exit;
}
include 'db.php';
$result = $conn->query("SELECT * FROM menu_items");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>Diyalo Admin Panel</header>

<div class="container">
  <div class="sidebar">
    <a href="dashboard.php">🍽 Menu</a>
    <a href="view_orders.php">🧾 Orders</a>
    <a href="view_reservations.php">📅 Reservations</a>
    <a href="view_contacts.php">📨 Contacts</a>
  </div>

  <div class="content">
    <div class="card">
      <h3>Add Menu Item</h3>
      <form action="add_item.php" method="POST">
        <input type="text" name="name" placeholder="Name" required />
        <input type="number" name="price" placeholder="Price" required />
        <input type="text" name="image" placeholder="Image Path (e.g., image/pizza.webp)" required />
        <button type="submit">Add Item</button>
      </form>
    </div>

    <div class="card">
      <h3>Menu Items</h3>
      <table>
        <tr><th>Name</th><th>Price</th><th>Image</th><th>Actions</th></tr>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['name'] ?></td>
            <td>Rs. <?= $row['price'] ?></td>
            <td><img src="../<?= $row['image'] ?>" height="50"/></td>
            <td>
              <a href="update_item.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
              <a href="delete_item.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this item?')">🗑️ Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>
