<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//loginFormProcess.php
session_start();
if (isset($_SESSION['customer_id'])) {
    header("Location: /products-services/shoppingCart.php");
    exit();
}
include("connectToDatabase.php");

$query = "SELECT * FROM Customers WHERE login_name = '$_POST[loginName]'";
$rowsWithMatchingLoginName = mysqli_query($db, $query);
$numRecords = mysqli_num_rows($rowsWithMatchingLoginName);

if ($numRecords == 0) {
    header("Location: /products-services/loginForm.php?retrying=true");
    exit();
}

if ($numRecords == 1) {
    $row = mysqli_fetch_array($rowsWithMatchingLoginName, MYSQLI_ASSOC);
    if ($_POST['loginPassword'] == $row['login_password']) {
        $_SESSION['customer_id'] = $row['customer_id'];
        $_SESSION['salutation']  = $row['salutation'];
        $_SESSION['customer_first_name'] = $row['customer_first_name'];
        $_SESSION['customer_middle_initial'] = $row['customer_middle_initial'];
        $_SESSION['customer_last_name'] = $row['customer_last_name'];
        $productID = isset($_SESSION['purchasePending']) ? $_SESSION['purchasePending'] : "";
        if ($productID != "") {
            unset($_SESSION['purchasePending']);
            header("Location: /products-services/shoppingCart.php?productID=$productID");
        } else {
            header("Location: /products-services/catalog.php");
        }
        exit();
    } else {
        header("Location: /products-services/loginForm.php?retrying=true");
        exit();
    }
}
mysqli_close($db);
?>