<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//loginForm.php
session_start();
if (isset($_SESSION['customer_id'])) header('Location: /products-services/catalog.php');
$retrying = isset($_GET['retrying']) ? true : false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hannah Kat's Vinyl Collective - Login</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../style2.css">
<style>
  .login-page {
    padding-top: 50px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    margin-top: 20px;
  }

  .login-card {
    background-color: white;
    border-radius: 16px;
    padding: 20px 30px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 4px 24px rgba(120, 80, 160, 0.15);
    border: 1px solid rgba(120, 80, 160, 0.1);
    align-self: flex-start;
  }

  .login-logo {
    text-align: center;
    margin-bottom: 20px;
  }

  .login-logo img {
    width: 100px;
    height: 100px;
  }

  .login-field {
    margin-bottom: 16px;
  }

  .login-field input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid rgba(120, 80, 160, 0.2);
    border-radius: 8px;
    font-size: 13px;
    font-family: inherit;
    color: #2f2a33;
    box-sizing: border-box;
    background-color: #faf7ff;
    transition: border-color 0.2s;
  }

  .login-field input:focus {
    outline: none;
    border-color: #592f6e;
  }

  .login-field input::placeholder {
    color: #a08cc0;
  }

  .btn-login {
    width: 100%;
    padding: 12px;
    background-color: #592f6e;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
    margin-top: 8px;
    letter-spacing: 0.5px;
  }

  .btn-login:hover {
    background-color: #7a5fb0;
  }

  .login-footer {
    text-align: center;
    margin-top: 20px;
    font-size: 12px;
    color: #4a3f66;
  }

  .login-footer a {
    color: #592f6e;
    font-weight: 600;
    text-decoration: none;
  }

  .login-footer a:hover {
    color: #7a5fb0;
  }

  .error-message {
    color: #c0392b;
    font-size: 12px;
    text-align: center;
    margin-bottom: 14px;
  }
</style>

  <script src="scripts/loginFormValidate.js"></script>
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
    <div class="login-page">
      <div class="login-card">
        <div class="login-logo">
          <img src="../images/logo.png" alt="Hannah Kat's Vinyl Collective">
        </div>
        <?php if ($retrying) { ?>
          <p class="error-message">Invalid username or password. Please try again.</p>
        <?php } ?>
        <form id="loginForm"
              onsubmit="return loginFormValidate();"
              action="scripts/loginFormProcess.php"
              method="post">
          <div class="login-field">
            <input name="loginName" type="text" placeholder="Username">
          </div>
          <div class="login-field">
            <input name="loginPassword" type="password" placeholder="Password">
          </div>
          <input class="btn-login" type="submit" value="Login">
        </form>

        <div class="login-footer">
          <p>Don't have an account? <a href="registrationForm.php">Register here</a>.</p>
          <p><a href="../index.php">← Back to Home</a></p>
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