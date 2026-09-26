<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//category.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hannah Kat's Vinyl Collective - Product Category</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .product-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      font-size: 13px;
    }

    .product-table th {
      background-color: #f0eaf7;
      color: #4a3f66;
      padding: 10px 14px;
      text-align: left;
      border-bottom: 2px solid rgba(120, 80, 160, 0.2);
    }

    .product-table td {
      padding: 10px 14px;
      border-bottom: 1px solid rgba(120, 80, 160, 0.08);
      vertical-align: middle;
    }

    .product-table tr:hover {
      background-color: #faf7ff;
    }

    .btn {
      display: inline-block;
      padding: 6px 12px;
      margin: 3px 0;
      background-color: #592f6e;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 600;
    }

    .back-link {
      display: inline-block;
      margin-bottom: 20px;
      color: #592f6e;
      text-decoration: none;
      font-weight: 600;
      font-size: 13px;
    }

    .btn:hover, .back-link:hover {
      color: #7a5fb0;
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
    <?php
    include("scripts/connectToDatabase.php");
    include("scripts/displayOneCategoryItems.php");
    ?>
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