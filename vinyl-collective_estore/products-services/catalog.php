<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//catalog.php
session_start();
?>
<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hannah Kat's Vinyl Collective - Product Catalog</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .catalog-page {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .catalog-card {
      background-color: white;
      border-radius: 16px;
      padding: 40px;
      width: 100%;
      max-width: 560px;
      box-shadow: 0 4px 24px rgba(120, 80, 160, 0.15);
      border: 1px solid rgba(120, 80, 160, 0.1);
      align-self: flex-start;
    }

    .catalog-card h2 {
      text-align: center;
      color: #4a3f66;
      margin-bottom: 24px;
      font-size: 22px;
    }

    .catalog-category-link {
      text-decoration: none;
      color: #592f6e;
      font-weight: 600;
      font-size: 13px;
    }

    .catalog-category-link:hover {
      color: #7a5fb0;
    }

    .catalog-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .catalog-table td {
      padding: 12px 16px;
      border-bottom: 1px solid rgba(120, 80, 160, 0.08);
      background-color: white;
      transition: background-color 0.2s;
    }

    .catalog-table tr:first-child td {
      border-radius: 8px 8px 0 0;
    }

    .catalog-table tr:last-child td {
      border-radius: 0 0 8px 8px;
      border-bottom: none;
    }

    .catalog-table tr:hover td {
      background-color: #f5f0ff;
    }

    .catalog-actions {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
    }

    .btn-catalog {
      display: block;
      padding: 10px 20px;
      background-color: #592f6e;
      color: white;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-weight: 600;
      font-size: 13px;
      transition: background-color 0.2s;
    }

    .btn-catalog:hover {
      background-color: #a08cc0;;
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
        <a href="../pages/services.php">Products & Services</a>
        <div class="dropdown-content" id="servicesMenu">
          <a href="../pages/services.php">About Our Services</a>
          <a href="../pages-comingsoon/featured.html">Special Features & Vinyl of the Month</a>
          <a href="../pages-comingsoon/suppliers.html">Our Vinyl Suppliers</a>
        </div>
      </div>
      <div class="dropdown" onmouseover="show('estoreMenu')" onmouseout="hide()">
        <a href="../pages/online-orders.html">Online Orders</a>
        <div class="dropdown-content" id="estoreMenu">
          <a href="../products-services/catalog.php">E-Store</a>
          <a href="../pages/order-form.html">Order Form</a>
        </div>
      </div>
      <div class="dropdown" onmouseover="show('aboutMenu')" onmouseout="hide()">
        <a href="../pages/about.html">About Us</a>
        <div class="dropdown-content" id="aboutMenu">
          <a href="../pages/mission.html">Our Mission</a>
          <a href="../pages/history.html">Our History</a>
          <a href="../pages-comingsoon/locations.html">Our Locations</a>
          <a href="../pages-comingsoon/news.html">News & Community Updates</a>
        </div>
      </div>
    </nav>
  </header>

  <main class="content-section">
    <div class="catalog-page">
      <div class="catalog-card">
        <h2>E-Store | Product Catalog</h2>

        <?php
          include("scripts/connectToDatabase.php");
          include("scripts/displayListOfCategories.php");
        ?>

        <div class="catalog-actions">
          <?php if (isset($_SESSION['customer_id'])): ?>
            <a href="/products-services/logout.php" class="btn-catalog">Logout</a>
          <?php else: ?>
            <a href="/products-services/loginForm.php" class="btn-catalog">Login</a>
            <a href="/products-services/registrationForm.php" class="btn-catalog">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>

</div>
<footer id="footer">
  <div class="footer2">
    <a href="../pages/contact.html">Contact Us</a>
    <p>© 2026 Hannah Kat's Vinyl Collective. All rights reserved.</p>
    <a href="../pages/sitemap.html">Site Map</a>
  </div>
</footer>
</body>
</html>