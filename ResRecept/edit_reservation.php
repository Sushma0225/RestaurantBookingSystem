<?php
session_start();
if (!isset($_SESSION['receptionist'])) {
    header("Location: index.php");
    exit;
}

include 'db.php';

// Get reservation ID safely
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Invalid reservation ID!");
}

// Fetch the reservation
$stmt = $conn->prepare("SELECT * FROM reservations WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    die("Reservation not found!");
}

$row = $result->fetch_assoc();

// Pre-fill form values
$reservation_date_for_input = $row['reservation_date'];
$reservation_time_for_input = substr($row['reservation_time'], 0, 5); // HH:MM

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $guests = max(1, (int)$_POST['guests']);
    $message_text = trim($_POST['message']);
    $table_no = trim($_POST['table_no']);
    $status = trim($_POST['status']);

    // Validate date and time
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $reservation_date)) {
        die("Invalid date format! Must be YYYY-MM-DD");
    }
    if (!preg_match('/^\d{2}:\d{2}$/', $reservation_time)) {
        die("Invalid time format! Must be HH:MM");
    }

    // Append :00 for TIME column
    $reservation_time_db = $reservation_time . ':00';

    // Force update by including reservation_time twice
    $update_stmt = $conn->prepare("
        UPDATE reservations
        SET name=?, email=?, phone=?, reservation_date=?, reservation_time=?, guests=?, message=?, table_no=?, status=?, reservation_time=?
        WHERE id=?
    ");

    if (!$update_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $update_stmt->bind_param(
        "ssssisssssi",
        $name,
        $email,
        $phone,
        $reservation_date,
        $reservation_time_db,
        $guests,
        $message_text,
        $table_no,
        $status,
        $reservation_time_db, // bind again to force update
        $id
    );

    $update_stmt->execute();

    // Redirect to dashboard after successful update
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation - Diyalo Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff5f5;
        }
        form {
            max-width: 600px;
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

<h2>Edit Reservation</h2>

<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($row['phone']) ?>" required pattern="\d{7,15}" title="Enter valid phone number">

    <label>Date:</label>
    <input type="date" name="reservation_date" value="<?= $reservation_date_for_input ?>" required>

    <label>Time:</label>
    <input type="time" name="reservation_time" value="<?= $reservation_time_for_input ?>" required>

    <label>Guests:</label>
    <input type="number" name="guests" value="<?= htmlspecialchars($row['guests']) ?>" required min="1">

    <label>Message:</label>
    <textarea name="message"><?= htmlspecialchars($row['message']) ?></textarea>

    <label>Table No:</label>
    <input type="text" name="table_no" value="<?= htmlspecialchars($row['table_no']) ?>" required>

    <label>Status:</label>
    <select name="status" required>
        <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
        <option value="Confirmed" <?= $row['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
        <option value="Completed" <?= $row['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
    </select>

    <button type="submit">Update Reservation</button>
</form>

</body>
</html>
