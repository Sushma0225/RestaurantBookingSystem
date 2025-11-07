<?php 
session_start(); 
include 'birthday_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Diyalo Restaurant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="header-footer.css" />
  <style>

    .blurred {
      filter: blur(6px);
      pointer-events: none;
      user-select: none;
    }

    .overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }

    .form-box {
      background: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      width: 320px;
      text-align: center;
    }

    .form-box h2 {
      color: #c0392b;
      margin-bottom: 20px;
    }

    .form-box input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .form-box button {
      background-color: #c0392b;
      color: #fff;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .form-box button:hover {
      background-color: #a93226;
    }

    .toggle-link {
      margin-top: 15px;
      font-size: 14px;
      color: #333;
    }

    .toggle-link a {
      color: #c0392b;
      text-decoration: none;
      font-weight: bold;
    }

    .hero {
      background: url('image/background.jpeg') no-repeat center center/cover;
      height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      text-align: center;
    }

    .hero-overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
    }

    .hero-content {
      position: relative;
      z-index: 1;
      color: white;
    }

    .hero-content h1 {
      font-size: 42px;
      margin-bottom: 25px;
      font-weight: bold;
    }

    .buttons a {
      display: inline-block;
      margin: 10px 15px;
      padding: 12px 25px;
      border: 2px solid #fff;
      color: #fff;
      text-decoration: none;
      border-radius: 30px;
      transition: background 0.3s, color 0.3s;
    }

    .buttons a:hover {
      background-color: #c0392b;
      border-color: #c0392b;
      color: #fff;
    }

    .about-section {
      padding: 70px 40px;
      background-color: #fceae8;
      text-align: center;
    }

    .about-section h2 {
      font-size: 36px;
      color: #c0392b;
      margin-bottom: 20px;
    }

    .about-section .intro-text {
      max-width: 800px;
      margin: 0 auto 40px;
      font-size: 18px;
      color: #555;
    }

    .about-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      max-width: 1000px;
      margin: 0 auto;
    }

    .about-card {
      background: #fff;
      border-radius: 10px;
      padding: 25px;
      border: 1px solid #ddd;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .about-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .about-card h3 {
      color: #c0392b;
      margin-bottom: 10px;
      font-size: 20px;
    }

    .about-card p {
      color: #333;
      font-size: 16px;
    }

    .map-container {
      margin: 20px auto;
      max-width: 600px;
    }

    iframe {
      width: 100%;
      height: 200px;
      border: 0;
      border-radius: 10px;
    }

    .logout {
      position: fixed;
      bottom: 15px;
      right: 20px;
      z-index: 10000;
      background: white;
      padding: 8px 12px;
      border-radius: 6px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
  </style>
</head>
<body>

<?php if ($isBirthday): ?>
  <div class="birthday-banner">
    🎉 Happy Birthday! Enjoy a special treat at Diyalo Restaurant with 10% discount! 🎂
  </div>
<?php endif; ?>

<?php if (!isset($_SESSION["user_id"])): ?>
  <div class="overlay" id="loginOverlay">
    <div class="form-box" id="formBox">
      <h2 id="formTitle">Login</h2>
      <input type="email" placeholder="Email" id="email" required>
      <input type="date" placeholder="Date of Birth" id="dob" style="display: none;" />
      <input type="password" placeholder="Password" id="password" required>
      <button onclick="submitForm()">Submit</button>
      <p class="toggle-link" id="toggleText">Don't have an account? <a href="#" onclick="toggleForm()">Register</a></p>
    </div>
  </div>
<?php endif; ?>

<div id="mainContent" class="<?php echo isset($_SESSION['user_id']) ? '' : 'blurred'; ?>">
  <header>
    <div class="logo">
      <img src="image/logo.png" alt="Diyalo Logo" />
    </div>
    <nav>
      <a href="index.php" class="active">🏠 Home</a>
      <a href="menu.php">📋 Menu</a>
      <a href="contact.php">📞 Contact</a>
      <a href="gallery.php">🖼️ Gallery</a>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>“Experience the Taste of Kohalpur in Every Bite.”</h1>
      <div class="buttons">
        <a href="order.php">ORDER PICK UP</a>
        <a href="reserve.php">RESERVATION</a>
      </div>
    </div>
  </section>

  <section class="about-section">
    <h2>About Us</h2>
    <p class="intro-text">
      Welcome to <strong>Diyalo Restaurant</strong> – a cozy and elegant place to enjoy authentic Nepalese cuisine, located in the heart of Kohalpur.
    </p>
    <div class="about-grid">
      <div class="about-card">
        <h3><marquee>🍛 Multi-Cuisine Delights</marquee></h3>
        <p>
          Enjoy traditional Nepali & continental dishes prepared fresh daily.
          Savor the authentic taste of home-cooked flavors in every bite.
          Perfect for family dinners, romantic dates, or casual get-togethers
        </p>
        
      </div>
      <div class="about-card">
        <h3><marquee>🌿 Fresh Ingredients</marquee></h3>
        <p>
          Locally sourced and organic ingredients in every dish. 
          We believe great taste starts with quality—our chefs handpick the freshest vegetables, herbs, and spices from trusted local farms.
          From farm to table, every meal is crafted with care to ensure purity, nutrition, and authentic flavor in every bite.
        </p>
      </div>
      <div class="about-card">
        <h3><marquee>👨‍🍳 Expert Chefs</marquee></h3>
        <p>
          Our chefs craft meals to create unforgettable dining experiences.
           With years of experience and a passion for culinary artistry, they blend tradition with innovation to bring you unique flavors.
          Each dish is carefully curated, plated with precision, and infused with love for exceptional taste.
        </p>
      </div>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="logout">
        <a href="logout.php" style="color:#c0392b; font-weight:bold; text-decoration:none;">Logout</a>
      </div>
    <?php endif; ?>
  </section>

  <footer>
    <p>📍 Kohalpur, Banke, Lumbini Province, Nepal</p>
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3516.1589796147196!2d81.67072537548515!3d28.20248207590229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399865564e2ab54d%3A0xa6595cd9d30a1eb!2sKohalpur%20nccn!5e0!3m2!1sen!2snp!4v1750075205717!5m2!1sen!2snp"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
    </div>
    <p>&copy; 2025 Diyalo Restaurant. All rights reserved.</p>
  </footer>
</div>

<script>
  let isLogin = true;

  function isValidEmail(email) {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
  }

  function submitForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const dob = document.getElementById("dob").value;

    if (!isValidEmail(email)) {
      alert("Please enter a valid email address.");
      return;
    }

    if (password.length < 6) {
      alert("Password must be at least 6 characters.");
      return;
    }

    if (!isLogin && !dob) {
      alert("Please enter your date of birth.");
      return;
    }

    const action = isLogin ? "login" : "register";
    const dataToSend = { email, password, action };
    if (!isLogin) dataToSend.dob = dob;

    fetch("login1.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(dataToSend),
    })
      .then(res => res.json())
      .then(data => {
        alert(data.message);
        if (data.status === "success" && isLogin) {
          window.location.reload();
        }
      })
      .catch(() => alert("Server error."));
  }

  function toggleForm() {
    const formTitle = document.getElementById("formTitle");
    const toggleText = document.getElementById("toggleText");
    const dobInput = document.getElementById("dob");
    isLogin = !isLogin;
    formTitle.innerText = isLogin ? "Login" : "Register";
    toggleText.innerHTML = isLogin
      ? `Don't have an account? <a href="#" onclick="toggleForm()">Register</a>`
      : `Already have an account? <a href="#" onclick="toggleForm()">Login</a>`;
    dobInput.style.display = isLogin ? "none" : "block";
  }
</script>

</body>
</html>
