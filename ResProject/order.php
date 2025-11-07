<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Diyalo Restaurant | Order Food</title>
  <link rel="stylesheet" href="header-footer.css" />
  <style>
    /* Order container styling */
    .order-container {
      background: white;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      width: 350px;
      margin: 50px auto;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #ff6600;
    }

    form input, form select {
      width: 100%;
      padding: 12px 10px;
      margin: 8px 0 15px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    form input:focus, form select:focus {
      border-color: #ff6600;
      outline: none;
    }

    form button {
      width: 100%;
      padding: 12px 0;
      background-color: #ff6600;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    form button:hover {
      background-color: #e65500;
    }

    /* Popup Messages */
    .popup {
      position: fixed;
      top: -100px;
      right: 20px;
      background-color: #d4edda;
      color: #155724;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      font-weight: 600;
      z-index: 9999;
      opacity: 0;
      transition: all 0.5s ease;
    }
    .popup.show {
      top: 20px;
      opacity: 1;
    }
    .popup.error {
      background-color: #f8d7da;
      color: #721c24;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <img src="image/logo.png" alt="Diyalo Logo" />
  </div>
  <nav>
    <a href="index.php">🏠 Home</a>
    <a href="menu.php">📋 Menu</a>
    <a href="contact.php">📞 Contact</a>
    <a href="gallery.php">🖼️ Gallery</a>
  </nav>
</header>

<?php
// Show popup if redirected from order1.php
$popupMessage = '';
$popupClass = '';
if (isset($_GET['success'])) {
    $popupMessage = "✅ Order placed successfully!";
    $popupClass = "success";
} elseif (isset($_GET['error'])) {
    $popupMessage = "❌ Something went wrong. Please try again.";
    $popupClass = "error";
}
?>
<?php if ($popupMessage): ?>
<div id="popup-message" class="popup <?php echo $popupClass; ?>">
  <?php echo $popupMessage; ?>
</div>
<?php endif; ?>

<div class="order-container">
  <h2>Order Now</h2>
  <form action="order1.php" method="POST">
    <input type="text" name="name" placeholder="Your Name" required />

    <select name="item" required>
      <option value="">-- Select Food Item --</option>
      <?php
      include 'db.php'; 
      $sql = "SELECT name FROM menu_items";  
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
        }
      } else {
        echo "<option disabled>No items found</option>";
      }
      $conn->close();
      ?>
    </select>

    <input type="number" name="quantity" min="1" placeholder="Quantity" required />
    <input type="text" name="phone" placeholder="Phone Number" required />
    <button type="submit">Order Now</button>
  </form>
</div>

<footer>
  <p>📍 Kohalpur, Banke, Lumbini Province, Nepal</p>
  <p>&copy; 2025 Diyalo Restaurant. All rights reserved.</p>
</footer>

<script>
// Phone validation
document.querySelector('form').addEventListener('submit', function(e) {
  const phoneInput = this.phone.value.trim();
  const nepaliPhonePattern = /^(98|97|96|94)[0-9]{8}$/;
  if (!nepaliPhonePattern.test(phoneInput)) {
    e.preventDefault();
    alert("❌ Invalid phone number. It must start with 98, 97, 96, or 94 and be exactly 10 digits.");
    this.phone.focus();
  }
});

// Popup animation
const popup = document.getElementById('popup-message');
if(popup) {
  setTimeout(() => { popup.classList.add('show'); }, 100);
  setTimeout(() => { popup.classList.remove('show'); }, 5100);
}
</script>

</body>
</html>
