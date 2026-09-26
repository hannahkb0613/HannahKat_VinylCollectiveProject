<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//registrationForm.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hannah Kat's Vinyl Collective - Register</title>
    <link rel="stylesheet" href="../style.css">
    <script src="scripts/registrationFormValidate.js"></script>

    <style>
        .login-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-logo img {
            width: 100px;
            height: 100px;
        }

        .reg-page {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .reg-card input::placeholder, .reg-card textarea::placeholder {
            color: #a08cc0;
            font-style: italic;
        }

        .reg-card {
            background-color: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 560px;
            box-shadow: 0 4px 24px rgba(120, 80, 160, 0.15);
            border: 1px solid rgba(120, 80, 160, 0.1);
        }

        .reg-card h2 {
            text-align: center;
            color: #4a3f66;
            margin-bottom: 24px;
            font-size: 22px;
        }

        .reg-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .reg-card td {
            padding: 8px 10px;
            vertical-align: middle;
            font-size: 12px;
            color: #4a3f66;
        }

        .reg-card tr {
            border-bottom: 1px solid rgba(120, 80, 160, 0.08);
        }

        .reg-card tr:last-child {
            border-bottom: none;
        }

        .reg-card tr:last-child td {
            padding-left: 20px;
            text-align: center;
            padding-top: 12px;
        }

        .reg-card input[type="text"], .reg-card input[type="password"], .reg-card textarea, .reg-card select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid rgba(120, 80, 160, 0.2);
            border-radius: 6px;
            font-size: 12px;
            font-family: inherit;
            color: #2f2a33;
            box-sizing: border-box;
            background-color: #faf7ff;
            transition: border-color 0.2s;
        }

        .reg-card input[type="text"]:focus, .reg-card input[type="password"]:focus, .reg-card textarea:focus, .reg-card select:focus {
            outline: none;
            border-color: #592f6e;
        }

        .reg-card input[type="submit"], .reg-card input[type="reset"] {
            padding: 8px 20px;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .reg-card input[type="submit"], .reg-card input[type="reset"] {
            background-color: #592f6e;
        }

        .reg-card input[type="submit"]:hover, .reg-card input[type="reset"]:hover {
            background-color: #7a5fb0;
        }

        .reg-card textarea {
            resize: none;
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
    <main class="content-section">
        <div class="reg-page">
            <div class="reg-card">

                <div style="text-align: right; margin-bottom: 10px;">
                    <a href="../index.php"
                       style="font-size: 12px; color: #592f6e; text-decoration: none; font-weight: 600;">
                        ← Back to Home
                    </a>
                </div>

                <div class="login-logo">
                    <img src="../images/logo.png" alt="Hannah Kat's Vinyl Collective">
                </div>

                <form id="registrationForm"
                      onsubmit="return registrationFormValidate();"
                      action="registrationFormResponse.php"
                      method="post">
                <table>
                <tr>
                    <td>Salutation:</td>
                    <td><select name="salute">
                        <option>&nbsp;</option>
                        <option>Mrs.</option>
                        <option>Ms.</option>
                        <option>Mr.</option>
                        <option>Dr.</option>
                    </select></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input required type="text" name="firstName" title="Initial capital, then lowercase and no spaces" pattern="^[A-Z][a-z]*$" placeholder="Mickey"></td>
                </tr>
                <tr>
                    <td>Middle Initial:</td>
                    <td><input type="text" id="middleInitial" name="middleInitial" title="A capital letter followed by a period" pattern="^[A-Z]\.$" placeholder="M."></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input required type="text" name="lastName" title="Initial capital, then lowercase and no spaces" pattern="^[A-Z][a-z]*$" placeholder="Mouse"></td>
                </tr>
                <tr>
                    <td>E-mail Address:</td>
                    <td><input required type="text" name="email" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})$" placeholder="example@email.com"></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input required type="text" name="phone" pattern="^(\(\d{3}\)\s?)?\d{3}[-.\s]?\d{4}$" placeholder="(123) 123-1234"></td>
                </tr>
                <tr>
                    <td>Street Address:</td>
                    <td><textarea id="address" name="address" rows="2"placeholder="1313 Disneyland Dr"></textarea></td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td><input id="city" name="city" type="text"></td>
                </tr>
                <tr>
                    <td>State/Province:</td> <td><input id="state" name="state" type="text"></td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td><select id="country" name="country">
                        <option>&nbsp;</option>
                        <option>USA</option>
                        <option>Canada</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Preferred Login Name:</td>
                    <td><input required type="text" id="loginName" name="loginName" pattern="^\w{6,}$" placeholder="At least 6 characters"></td>
                </tr>
                <tr>
                    <td>Login Password:</td>
                    <td><input required type="password" id="loginPassword" name="loginPassword" pattern="^\w{6,}$" placeholder="At least 6 characters"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; padding-top: 16px;">
                        <input type="submit" value="Submit Form Data">
                        &nbsp;&nbsp;
                        <input type="reset" value="Reset Form">
                    </td>
                </tr>
                </table>
                </form>
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