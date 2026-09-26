<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//checkout.php
session_start();
if (!preg_match('/shoppingCart.php/', $_SERVER['HTTP_REFERER'])) {
    header("Location: /products-services/shoppingCart.php?productID=view");
    exit();
}
$customerID = $_SESSION['customer_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hannah Kat's Vinyl Collective - Checkout</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .checkout-page {
      display: flex;
      justify-content: center;
      padding: 40px 40px;
    }

    .checkout-box {
      background: white;
      max-width: 650px;
      width: 100%;
      padding: 20px 35px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(120, 80, 160, 0.12);
    }

    .checkout-box h2 {
      color: #592f6e;
      margin-bottom: 15px;
    }

    .receipt-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      font-size: 13px;
    }

    .receipt-table th {
      background-color: #f0eaf7;
      color: #4a3f66;
      padding: 10px 14px;
      text-align: left;
      border-bottom: 2px solid rgba(120, 80, 160, 0.2);
    }

    .receipt-table td {
      padding: 10px 14px;
      border-bottom: 1px solid rgba(120, 80, 160, 0.08);
      vertical-align: middle;
    }

    .receipt-table tr:hover td {
      background-color: #faf7ff;
    }

    .receipt-info a {
      color: #592f6e;
      font-weight: 600;
      text-decoration: none;
    }

    .receipt-info a:hover {
      color: #7a5fb0;
    }

    .btn-home {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 22px;
      background-color: #592f6e;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      transition: background-color 0.2s;
    }

    .btn-home:hover {
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
  <main class="content-section">
    <div class="checkout-page">
      <div class="checkout-box">
        <?php
        include("scripts/connectToDatabase.php");
        $customerID = $_SESSION['customer_id'];
        include("scripts/checkoutProcess.php");
        ?>
        <a href="/products-services/catalog.php" class="btn-home">Continue Shopping</a>
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