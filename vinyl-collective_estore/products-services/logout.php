<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//logout.php
session_start();
$needToUseLoggedInMessage = isset($_SESSION['customer_id']) ? true : false;
if (isset($_SESSION['customer_id'])) {
    $customerID = $_SESSION['customer_id'];
    include("scripts/connectToDatabase.php");
    include("scripts/logoutProcess.php");
    session_unset();
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hannah Kat's Vinyl Collective - Logout</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .logout-page {
      display: flex;
      justify-content: center;
      padding: 40px 20px;
    }

    .logout-box {
      background: white;
      max-width: 480px;
      width: 100%;
      padding: 40px 35px;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(120, 80, 160, 0.15);
      border: 1px solid rgba(120, 80, 160, 0.1);
      text-align: center;
    }

    .logout-logo {
      margin-bottom: 20px;
    }

    .logout-logo img {
      width: 80px;
      height: 80px;
    }

    .logout-box h2 {
      color: #4a3f66;
      margin-bottom: 16px;
      font-size: 22px;
    }

    .logout-box p {
      color: #4a3f66;
      font-size: 13px;
      line-height: 1.8;
      margin-bottom: 8px;
    }

    .btn-logout {
      display: inline-block;
      margin-top: 16px;
      padding: 10px 22px;
      background-color: #592f6e;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      transition: background-color 0.2s;
      margin: 8px 4px 0;
    }

    .btn-logout:hover {
      background-color: #7a5fb0;
    }
  </style>
  
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
    <div class="logout-page">
      <div class="logout-box">
        <div class="logout-logo">
          <img src="../images/logo.png" alt="Hannah Kat's Vinyl Collective">
        </div>

        <?php if ($needToUseLoggedInMessage) { ?>
          <h2>You've been logged out!</h2>
          <p>Thank you for visiting Hannah Kat's Vinyl Collective.<br> You have successfully logged out.</p>
          <a href="/products-services/loginForm.php" class="btn-logout">Log Back In</a>
          <a href="/products-services/catalog.php" class="btn-logout btn-logout">Browse Catalog</a>
        <?php } else { ?>
          <h2>You are not logged in</h2>
          <p>Thank you for visiting Hannah Kat's Vinyl Collective.<br> You have not yet logged in.</p>
          <a href="/products-services/loginForm.php" class="btn-logout">Login</a>
          <a href="/products-services/catalog.php" class="btn-logout">Browse Catalog</a>
        <?php } ?>
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