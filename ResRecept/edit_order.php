<?php
session_start();
if (!isset($_SESSION['receptionist'])) {
    header("Location: index.php");
    exit;
}

include 'db.php';

// Get order ID safely
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Invalid order ID!");
}

// Fetch the order
$stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    die("Order not found!");
}

$row = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $item = trim($_POST['item']);
    $quantity = (int)$_POST['quantity'];
    $phone = trim($_POST['phone']);
    $order_date = $_POST['order_date'];   // YYYY-MM-DD
    $input_time = $_POST['order_time'];   // HH:MM
    $status = $_POST['status'];

    // Combine date and time for TIMESTAMP/DATETIME
    $order_time = $order_date . ' ' . $input_time . ':00';

    $update_stmt = $conn->prepare("UPDATE orders SET name=?, item=?, quantity=?, phone=?, order_time=?, status=? WHERE id=?");
    if (!$update_stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $update_stmt->bind_param("ssisssi", $name, $item, $quantity, $phone, $order_time, $status, $id);

    if ($update_stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        die("Error updating order: " . $update_stmt->error);
    }
}

// Extract date and time for input fields
$order_date_for_input = substr($row['order_time'], 0, 10);  // YYYY-MM-DD
$order_time_for_input = substr($row['order_time'], 11, 5); // HH:MM
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order - Diyalo Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff5f5; /* Page background */
        }
        form {
            max-width: 500px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(183,28,28,0.2);
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin: 8px 0 16px;
            border: 1px solid #b71c1c;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #b71c1c;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #e53935;
        }
        h2 {
            text-align: center;
            color: #b71c1c;
        }
    </style>
</head>
<body>

<h2>Edit Order</h2>

<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>

    <label>Items:</label>
    <textarea name="item" required><?= htmlspecialchars($row['item']) ?></textarea>

    <label>Quantity:</label>
    <input type="number" name="quantity" value="<?= htmlspecialchars($row['quantity']) ?>" required>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($row['phone']) ?>" required>

    <label>Order Date:</label>
    <input type="date" name="order_date" value="<?= $order_date_for_input ?>" required>

    <label>Order Time:</label>
    <input type="time" name="order_time" value="<?= $order_time_for_input ?>" required>

    <label>Status:</label>
    <select name="status" required>
        <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
        <option value="Confirmed" <?= $row['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
        <option value="Completed" <?= $row['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
    </select>

    <button type="submit">Update Order</button>
</form>

</body>
</html>
