<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//registrationFormResponse.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hannah Kat's Vinyl Collective - Registration Response</title>
  <link rel="stylesheet" href="../style.css">
  <script>
    var isShowing = false;
    var dropdownMenu = null;
    function show(id) {
      hide();
      dropdownMenu = document.getElementById(id);
      if (dropdownMenu != null) { dropdownMenu.style.visibility = "visible"; isShowing = true; }
    }
    function hide() {
      if (isShowing && dropdownMenu != null) { dropdownMenu.style.visibility = "hidden"; }
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
          <a href="/products-services/catalog.php">E-Store</a>
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
    <h2>Registration</h2>
    <?php
    include("scripts/connectToDatabase.php");
    include("scripts/registrationFormProcess.php");
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