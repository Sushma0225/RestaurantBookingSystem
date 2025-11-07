<?php session_start();
include 'birthday_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Diyalo Restaurant | Gallery</title>
  <link rel="stylesheet" href="header-footer.css" />
  <style>
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
      margin: 0;
    }

    .gallery-wrapper {
      max-width: 1200px;
      margin: 40px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08)
    }

    .gallery-grid {
      column-count: 3;
      column-gap: 20px;
    }

    .gallery-item {
      break-inside: avoid;
      margin-bottom: 20px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .gallery-item img {
      width: 100%;
      display: block;
      height: auto;
      transition: transform 0.3s ease;
      border-radius: 12px;
    }

    .gallery-item img:hover {
      transform: scale(1.03);
    }

    @media (max-width: 768px) {
      .main-section {
        text-align: center;
        padding-left: 20px;
      }

      .main-section h1 {
        font-size: 2.3rem;
      }

      .gallery-grid {
        column-count: 1;
      }
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
    <div class="logo">
      <img src="image/logo.png" alt="Diyalo Logo">
    </div>
    <nav>
      <a href="index.php">🏠 Home</a>
      <a href="menu.php">📋 Menu</a>
      <a href="contact.php">📞 Contact</a>
      <a href="gallery.php" class="active">🖼️ Gallery</a>
    </nav>
  </header>

  <div class="main-section">
    <h1>Diyalo Restaurant</h1>
  </div>

  <div class="gallery-wrapper">
    <div class="gallery-grid">
      <div class="gallery-item">
        <img src="image/gallery1.jpg"alt="Restaurant Photos">
      </div> 
      <div class="gallery-item">
        <img src="image/gallery6.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery2.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery10.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery4.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery11.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery3.jpg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery9.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery5.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery8.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery12.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery7.jpeg" alt="Restaurant Photos">
      </div>
      <div class="gallery-item">
        <img src="image/gallery13.jpeg" alt="Restaurant Photos">
      </div>
    </div>
  </div>
  <footer>
    <p>📍 Kohalpur, Banke, Lumbini Province, Nepal</p>
    <p>&copy; 2025 Diyalo Restaurant. All rights reserved.</p>
  </footer>

</body>
</html>
