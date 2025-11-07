<?php 
session_start();
include 'birthday_check.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Diyalo Restaurant | Contact</title>
  <link rel="stylesheet" href="header-footer.css" />
  
  <!-- Google Fonts for heading -->
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* Main Section */
    .main-section {
      background-image: url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/13fee3a3-25c3-443e-b1d6-dcec2ed3bf26.png');
      background-size: cover;
      background-position: center;
      padding: 100px 20px;
      color: white;
      text-align: left;
      padding-left: 120px;
    }
    .main-section h1 {
      font-family: 'Arial Black', sans-serif;
      font-size: 3rem;
      font-weight: 800;
      text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.7);
    }

    /* Contact Container */
    .contact-wrapper {
      max-width: 900px;     
      margin: 40px auto 0;
      padding: 40px 30px;
      display: flex;
      gap: 40px;
      background-color: #f9f6f1;
      border-radius: 20px;
      border-left: 6px solid #ff6347; 
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 0 15px rgba(255, 99, 71, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      flex-wrap: wrap;
      justify-content: center;
    }
    .contact-wrapper:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15), 0 0 25px rgba(255, 99, 71, 0.3);
    }

    /* Contact Info */
    .contact-info { flex: 1 1 300px; padding: 0; border-radius: 0; }
    .contact-info h2 {
      font-family: 'Merriweather', serif;
      font-size: 2.3rem;
      font-weight: 600;
      color: #e5533a;
      margin-bottom: 15px;
    }
    .contact-info p { color: #555; font-size: 1rem; line-height: 1.6; }

    /* Contact Form */
    .contact-form { flex: 1 1 300px; display: flex; flex-direction: column; gap: 15px; }
    .contact-form input, .contact-form textarea {
      padding: 12px; border: none; background-color: #ffcab5; border-radius: 6px; font-size: 15px; color: #333;
    }
    .contact-form textarea { resize: vertical; height: 100px; }
    .contact-form button {
      padding: 12px; border: none; background-color: #ff6347; color: white; font-size: 16px; border-radius: 6px;
      cursor: pointer; transition: background 0.3s ease;
    }
    .contact-form button:hover { background-color: #e5533a; }

    /* Popup Messages */
    .popup {
      position: fixed;
      top: -100px; /* start hidden above screen */
      right: 20px;
      background-color: #d4edda; /* success default */
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

    @media (max-width: 768px) {
      .main-section h1 { font-size: 2.3rem; }
      .contact-wrapper { flex-direction: column; padding: 30px 15px; max-width: 95%; margin-top: 30px; }
    }
  </style>
</head>
<body>
<?php if ($isBirthday): ?>
  <div class="birthday-banner">
    🎉 Happy Birthday! Enjoy a special treat at Diyalo Restaurant with 10% discount! 🎂
  </div>
<?php endif; ?>

<header>
  <div class="logo"><img src="image/logo.png" alt="Diyalo Logo"></div>
  <nav>
    <a href="index.php">🏠 Home</a>
    <a href="menu.php">📋 Menu</a>
    <a href="contact.php" class="active">📞 Contact</a>
    <a href="gallery.php">🖼️ Gallery</a>
  </nav>
</header>

<div class="main-section">
  <h1>Diyalo Restaurant</h1>
</div>

<?php
$popupMessage = '';
$popupClass = '';
if (isset($_GET['success'])) {
    $popupMessage = "✅ Thank you for contacting us! We will get back to you soon.";
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

<!-- Contact Container -->
<div class="contact-wrapper">
  <div class="contact-info">
    <h2>Get in Touch</h2>
    <p>We'd love to hear from you! Whether you have a question about our dishes, reservations, or anything else — our team is ready to answer all your questions.</p>
  </div>

  <form class="contact-form" action="contact1.php" method="POST">
    <input type="text" name="name" placeholder="Your Name" required />
    <input type="tel" name="phone" placeholder="Phone Number" required />
    <input type="email" name="email" placeholder="Email Address" required />
    <textarea name="message" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
</div>

<footer>
  <p>📍 Kohalpur, Banke, Lumbini Province, Nepal</p>
  <p>&copy; 2025 Diyalo Restaurant. All rights reserved.</p>
</footer>

<script>
  const popup = document.getElementById('popup-message');
  if(popup) {
    // Show popup with animation
    setTimeout(() => {
      popup.classList.add('show');
    }, 100); // slight delay for smooth slide-in

    // Hide after 5 seconds
    setTimeout(() => {
      popup.classList.remove('show');
    }, 5100);
  }
</script>

</body>
</html>
