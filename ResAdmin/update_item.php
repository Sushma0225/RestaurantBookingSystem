<?php
include 'db.php';
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $conn->query("UPDATE menu_items SET name='$name', price='$price', image='$image' WHERE id=$id");
  header("Location: dashboard.php");
  exit;
}

$item = $conn->query("SELECT * FROM menu_items WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Update Item</title><link rel="stylesheet" href="style.css"></head>
<body>
<header>Diyalo Admin Panel - Update Menu</header>
<div class="container">
  <div class="sidebar">
    <a href="dashboard.php">🍽 Menu</a>
    <a href="view_orders.php">🧾 Orders</a>
    <a href="view_reservations.php">📅 Reservations</a>
  </div>
  <div class="content">
    <div class="card">
      <h3>Edit Menu Item</h3>
      <form method="POST">
        <input type="text" name="name" value="<?= $item['name'] ?>" required />
        <input type="number" name="price" value="<?= $item['price'] ?>" required />
        <input type="text" name="image" value="<?= $item['image'] ?>" required />
        <button type="submit">Update</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>

