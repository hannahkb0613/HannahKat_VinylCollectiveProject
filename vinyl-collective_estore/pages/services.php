<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hannah Kat's Vinyl Collective - Services</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .quick-links {
      flex: 0 0 auto;
      display: flex;
      flex-direction: column;
      gap: 15px;
      font-weight: bold;
      color: #592f6e;
      align-items: flex-start;
    }

    .quick-links a {
      text-decoration: none;
      color: #592f6e;
    }

    .services-wrapper {
      display: flex;
      gap: 40px;
      align-items: flex-start;
    }

    .content-columns {
      display: flex;
      gap: 40px;
    }

    .services-column {
      display: flex;
      flex-direction: column;
      min-width: 300px;
    }
  </style>

  <script>
    var isShowing = false;
    var dropdownMenu = null;

    function show(id) {
      hide();
      dropdownMenu = document.getElementById(id);
      if (dropdownMenu != null) {
        dropdownMenu.style.visibility = "visible";
        isShowing = true;
      }
    }

    function hide() {
      if (isShowing && dropdownMenu != null) {
        dropdownMenu.style.visibility = "hidden";
      }
      isShowing = false;
    }
  </script>
</head>

<body>
<div class="page">
  <header class="header">
    <img src="../images/logo.png" alt="Logo" class="logo">
<nav class="nav">
  <div class="dropdown">
    <a href="../index.php">Home</a>
  </div>
      <div class="dropdown" onmouseover="show('servicesMenu')" onmouseout="hide()">
        <a href="services.php">Products & Services</a>
        <div class="dropdown-content" id="servicesMenu">
          <a href="services.php">About Our Services</a>
          <a href="../pages-comingsoon/featured.html">Special Features & Vinyl of the Month</a>
          <a href="../pages-comingsoon/suppliers.html">Our Vinyl Suppliers</a>
        </div>
      </div>

      <div class="dropdown" onmouseover="show('estoreMenu')" onmouseout="hide()">
        <a href="online-orders.html">Online Orders</a>
        <div class="dropdown-content" id="estoreMenu">
          <a href="../products-services/catalog.php">E-Store</a>
          <a href="order-form.html">Order Form</a>
        </div>
      </div>

      <div class="dropdown" onmouseover="show('aboutMenu')" onmouseout="hide()">
        <a href="about.html">About Us</a>
        <div class="dropdown-content" id="aboutMenu">
          <a href="mission.html">Our Mission</a>
          <a href="history.html">Our History</a>
          <a href="../pages-comingsoon/locations.html">Our Locations</a>
          <a href="../pages-comingsoon/news.html">News & Community Updates</a>
        </div>
    </div>
  </nav>
</header>

  <main class="content-section">
    <h2>Our Services</h2>
    <p>We have a wide range of vinyl services that include:</p>

    <div class="services-wrapper">
      <aside class="quick-links">
        <a href="../pages-comingsoon/featured.html">Special Features & Vinyl of the Month</a>
        <br>
        <a href="../pages-comingsoon/suppliers.html">Our Suppliers</a>
        <br>
        <a href="../products-services/catalog.php"><br>E-Store | Product Catalog</a>

      </aside>

      <div class="content-columns">
        <div class="services-column">
          <section>
            <h3>Vinyl Library</h3>
            <ul>
              <li>Second-hand vinyls</li>
              <li>Antique vinyls</li>
              <li>Rentable vinyls</li>
              <li>Exclusive vinyls</li>
              <li>Signed vinyls</li>
              <li>Vinyl albums</li>
            </ul>
          </section>

          <section>
            <h3>Vinyl Accessories</h3>
            <ul>
              <li>Vinyl weights</li>
              <li>Vinyl storage</li>
              <li>Vinyl shelving</li>
              <li>Album stands</li>
              <li>Record players</li>
              <li>Polyvinyl sleeves for albums</li>
            </ul>
          </section>
        </div>

        <div class="services-column">
          <section>
            <h3>Vinyl Care</h3>
            <ul>
              <li>Cleaning solutions</li>
              <li>Microfiber cloths</li>
              <li>Stylus brushes</li>
              <li>Scratch repair kit</li>
              <li>Vinyl washer system</li>
              <li>Anti-static vinyl spray</li>
            </ul>
          </section>

          <section>
            <h3>Vinyl Repair</h3>
            <ul>
              <li>Appointment repairs</li>
              <li>Last-minute repairs</li>
              <li>Antique vinyl restoration</li>
              <li>Vinyl resurfacing</li>
              <li>Record player repair</li>
              <li>Antique record player repair</li>
            </ul>
          </section>
        </div>
      </div>
    </div>
  </main>

</div>

<footer id="footer">
  <div class="footer2">
    <a href="contact.html">Contact Us</a>
    <p>© 2026 Hannah Kat's Vinyl Collective. All rights reserved.</p>
    <a href="sitemap.html">Site Map</a>
  </div>
</footer>
</body>
</html>