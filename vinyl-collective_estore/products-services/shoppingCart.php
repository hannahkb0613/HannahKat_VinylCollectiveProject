<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//shoppingCart.php
session_start();
$customerID = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "";
$productID = isset($_GET['productID']) ? $_GET['productID'] : 'view';
if ($customerID == "") {
	$_SESSION['purchasePending'] = $productID;
	header("Location: /products-services/loginForm.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hannah Kat's Vinyl Collective - Shopping Cart</title>
	
	<link rel="stylesheet" href="../style.css">
	<style>
		.cart-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
			font-size: 13px;
		}

		.cart-table th {
			background-color: #f0eaf7;
			color: #4a3f66;
			padding: 10px 14px;
			text-align: left;
			border-bottom: 2px solid rgba(120, 80, 160, 0.2);
		}

		.cart-table td {
			padding: 10px 14px;
			border-bottom: 1px solid rgba(120, 80, 160, 0.08);
			vertical-align: middle;
		}

		.cart-table tr:hover td {
			background-color: #faf7ff;
		}

		.btn-cart {
			display: inline-block;
			padding: 8px 16px;
			margin: 3px 0;
			background-color: #592f6e;
			color: white;
			text-decoration: none;
			border-radius: 8px;
			font-size: 12px;
			font-weight: 600;
			border: none;
			cursor: pointer;
			transition: background-color 0.2s;
		}

		.btn-cart:hover {
			background-color: #7a5fb0;
		}
	</style>

	<script src="scripts/shoppingCartAddItemFormValidate.js"></script>
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
		<?php
		include("scripts/connectToDatabase.php");
		include("scripts/shoppingCartProcess.php");
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