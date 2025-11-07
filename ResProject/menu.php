<?php session_start(); 
include 'birthday_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Diyalo Restaurant | Menu</title>
   <link rel="stylesheet" href="header-footer.css" />
  <style>
    /* Banner Section */
      .main-section {
      background-image: url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/13fee3a3-25c3-443e-b1d6-dcec2ed3bf26.png');
      background-size: cover;
      background-position: center;
      padding: 100px 20px; /* Increased top and bottom padding */
      color: white;
}

    .main-section-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      max-width: 1200px;
      margin: 0 auto;
      gap: 20px;
    }
    .main-section h1 {
  font-family: 'Arial Black', sans-serif;
  font-size: 3rem;
  font-weight: 800;
  text-align: center;
  line-height: 1.2;
  color: white;
  text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.7);
}
.search-bar {
      display: flex;
    }

    .search-bar input {
      width: 250px;
      padding: 10px 14px;
      border-radius: 14px 0 0 14px;
      border: 2px solid transparent;
      font-size: 1rem;
    }

    .search-bar button {
      padding: 10px 18px;
      border-radius: 0 14px 14px 0;
      border: none;
      background: #ff6347;
      color: white;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
    }

    main {
      flex-grow: 1;
      padding: 48px 24px;
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 32px;
    }

    .menu-item {
      background: #fff;
      padding: 24px;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .menu-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
    }

    .menu-item img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      margin-bottom: 16px;
      border-radius: 20px;
    }

    .menu-item h3 {
      font-weight: 700;
      font-size: 1.4rem;
      margin-bottom: 8px;
      color: #333;
    }

    .menu-item p {
      color: #666;
      font-size: 1rem;
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
      <a href="menu.php" class="active">📋 Menu</a>
      <a href="contact.php">📞 Contact</a>
      <a href="gallery.php">🖼️ Gallery</a>
    </nav>
  </header>

  <div class="main-section">
    <div class="main-section-content">
      <h1>Diyalo Restaurant</h1>
      <form class="search-bar" onsubmit="event.preventDefault();">
        <input type="search" placeholder="Search food..." />
        <button type="submit">Search</button>
      </form>
    </div>
  </div>
<main>
    <article class="menu-item" tabindex="0" >
      <img src="image/pasta.webp" alt="pasta">
      <h3>Pasta</h3>
      <p>Price:  Rs 450</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/sauce.jpeg" alt="sauce">
      <h3>Tomato Soup</h3>
      <p>Price: Rs 300</p>
    </article>
     <article class="menu-item" tabindex="0">
      <img src="image/burger.jpg" alt="burger">
      <h3>Burger</h3> 
      <p>Price: Rs 200</p>
    </article>
     <article class="menu-item" tabindex="0">
      <img src="image/panipuri.jpg" alt="panipuri" >
      <h3>Pani puri</h3>
      <p>Price: Rs 80</p>
    </article>
     <article class="menu-item" tabindex="0" >
      <img src="image/biryani.webp" alt="biryani">
      <h3>Chicken Biryani</h3>
      <p>price: 200</p>
    </article>
     <article class="menu-item" tabindex="0">
      <img src="image/grilledchicken.jpg" alt="grilledchicken">
      <h3>Grilled Chicken</h3>
      <p>Price: 550</p>
    </article>
     <article class="menu-item" tabindex="0">
      <img src="image/chowmein.jpeg" alt="chowmein">
      <h3>Chowmein</h3>
      <p>Price: 95</p>
    </article> 
    <article class="menu-item" tabindex="0">
      <img src="image/manchurian.jpg" alt="veg manchurian" >
      <h3>Veg manchurian</h3>
      <p>Price: 320</p>
    </article> 
    <article class="menu-item" tabindex="0">
      <img src="image/momo.jpeg" alt="momo" >
      <h3>Chicken momo</h3>
      <p>Price:190</p>
    </article>
    <article class="menu-item" tabindex="0" >
      <img src="image/pancake.jpg" alt="pancake" >
      <h3>Pancake</h3>
      <p>Price:120</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/pizza.webp" alt="pizza" >
      <h3>Pizza</h3>
      <p>Price:230</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/samosa.jpg" alt="samosa">
      <h3>Samosa</h3>
      <p>Price:250</p>
    </article>
     <article class="menu-item" tabindex="0">
      <img src="image/sandwich.jpeg" alt="sandwich">
      <h3>sandwich</h3>
      <p>Price:180</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/sekuwa.jpeg" alt="sekuwa">
      <h3>Sekuwa</h3>
      <p>Price:500</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/selroti.jpg" alt="selroti">
      <h3>Selroti</h3>
      <p>Price:100</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/springroll.jpg" alt="springroll">
      <h3>spring Roll</h3>
      <p>Price:230</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/tandorichicken.jpg" alt="tandorichicken">
      <h3>tandoori Chicken</h3>
      <p>Price:230</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/thakali.jpg" alt="thakali">
      <h3>thakali</h3>
      <p>Price:260</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/thupka.jpg" alt="thupka">
      <h3>Chicken Thupka</h3>
      <p>Price:180</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/vegsoup.webp" alt="vegsoup">
      <h3>Veg Soup</h3>
      <p>Price:120</p>
    </article>
    <article class="menu-item" tabindex="0">
      <img src="image/yomari.jpg" alt="yomari">
      <h3>Yomari</h3>
      <p>Price:140</p>
    </article>
    
    <!-- Add more items here similarly -->
  </main>

<script>
  const searchInput = document.querySelector('.search-bar input');
  const menuItems = document.querySelectorAll('.menu-item');

  const noResultMessage = document.createElement('p');
  noResultMessage.textContent = 'No results found';
  noResultMessage.style.fontSize = '1.5rem';
  noResultMessage.style.color = '#c0392b';
  noResultMessage.style.textAlign = 'center';
  noResultMessage.style.gridColumn = '1 / -1';
  noResultMessage.style.display = 'none';
  document.querySelector('main').appendChild(noResultMessage);

  searchInput.addEventListener('input', () => {  
    const searchTerm = searchInput.value.toLowerCase().trim();
    let found = false;

    menuItems.forEach(item => {
      const itemName = item.querySelector('h3').textContent.toLowerCase();
      if (itemName.startsWith(searchTerm)) {
        item.style.display = 'block';
        found = true;
      } else {
        item.style.display = 'none';
      }
    });

    noResultMessage.style.display = found ? 'none' : 'block';
  });
</script>

  <footer>
    <p>📍 Kohalpur, Banke, Lumbini Province, Nepal</p>
    <p>&copy; 2025 Diyalo Restaurant. All rights reserved.</p>
  </footer>
</body>
</html>
