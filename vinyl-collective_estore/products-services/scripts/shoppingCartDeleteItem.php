<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//shoppingCartDeleteItem.php
session_start();
include("connectToDatabase.php");

$orderItemID = $_GET['orderItemID'];
$orderID = $_GET['orderID'];
$query =
    "DELETE FROM Order_Items
    WHERE order_item_id='$orderItemID'";
$success = mysqli_query($db, $query);
$query =
    "SELECT COUNT(*) AS numItemsStillInOrder
    FROM Order_Items
    WHERE order_id='$orderID'";
$return_value = mysqli_query($db, $query);
$row = mysqli_fetch_array($return_value, MYSQLI_ASSOC);
if ($row['numItemsStillInOrder'] == 0)
{
    $query = "DELETE FROM Orders
                     WHERE order_id='$orderID'";
    $success = mysqli_query($db, $query);
}
header("Location: /products-services/shoppingCart.php?productID=view");
?>
