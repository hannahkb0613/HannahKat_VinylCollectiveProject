<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//checkoutProcess.php
global $db;
global $customerID;
displayReceipt($db, $customerID);

$query =
    "SELECT
        Orders.order_id,
        Orders.customer_id,
        Orders.order_status_code,
        Order_Items.*
    FROM
        Order_Items, Orders
    WHERE
        Orders.order_id = Order_Items.order_id and
        Orders.order_status_code = 'IP'        and
        Orders.customer_id = $customerID";
$orderInProgress = mysqli_query($db, $query);
$orderInProgressArray = mysqli_fetch_array($orderInProgress);
$orderID = $orderInProgressArray[0];

markOrderPaid($db, $customerID, $orderID);
markOrderItemsPaid($db, $orderID);
mysqli_close($db);

function displayReceipt($db, $customerID)
{
    $items = getExistingOrder($db, $customerID);
    $numRecords = mysqli_num_rows($items);
    if($numRecords == 0)
    {
        echo
        "<h4 class='ShoppingCartHeader'>Shopping Cart</h4>
        <p class='Notification'>Your shopping cart is empty.</p>
        <p class='Notification'>To continue shopping, please
        <a class='NoDecoration' href='/products-services/catalog.php'>click here</a>.</p>";
        exit(0);
    }
    else
    {
        displayReceiptHeader();
        $grandTotal = 0;
        for($i=1; $i<=$numRecords; $i++)
        {
            $row = mysqli_fetch_array($items, MYSQLI_ASSOC);
            $grandTotal += displayItemAndReturnTotalPrice($db, $row);
        }
        displayReceiptFooter($grandTotal);
    }
}

function getExistingOrder($db, $customerID)
{
    $query = 
        "SELECT
            Orders.order_id,
            Orders.customer_id,
            Orders.order_status_code,
            Order_Items.*
        FROM
            Order_Items, Orders
        WHERE
            Orders.order_id = Order_Items.order_id and
            Orders.order_status_code = 'IP' and
            Orders.customer_id = '$customerID'";
    $items = mysqli_query($db, $query);
    return $items;
}

function displayReceiptHeader()
{
    echo
    "<table class='receipt-table'>
      <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
      </tr>";
}

function displayItemAndReturnTotalPrice($db, $row)
{
    $productID = $row['product_id'];
    $query = "SELECT * FROM Products WHERE product_id ='$productID'";
    $product = mysqli_query($db, $query);
    $rowProd = mysqli_fetch_array($product, MYSQLI_ASSOC);
    $productPrice = $rowProd['product_price'];
    $productPriceAsString = sprintf("$%1.2f", $productPrice);
    $totalPrice = $row['order_item_quantity'] * $row['order_item_price'];
    $totalPriceAsString = sprintf("$%1.2f", $totalPrice);
    $imageLocation = $rowProd['product_image_url'];
    echo
    "<tr>
      <td class='Centered'>
        <img height='70' width='70'
             src='$imageLocation' alt='Product Image'>
      </td><td class='LeftAligned'>
        $rowProd[product_name]
      </td><td class='RightAligned'>
        $productPriceAsString
      </td><td class='Centered'>
        $row[order_item_quantity]
      </td><td class='RightAligned'>
        $totalPriceAsString
      </td>
    </tr>";
    return $totalPrice;
}

function displayReceiptFooter($grandTotal)
{
    $date = date("F j, Y");
    $time = date('g:ia');
    $grandTotalAsString = sprintf("$%1.2f", $grandTotal);
    echo
    "<tr>
      <td colspan='4'>Grand Total</td>
      <td style='text-align: right;'><strong>$grandTotalAsString</strong></td>
    </tr>
  </table>
  <div class='receipt-info'>
    <h2>Thank you,
    $_SESSION[salutation]
    $_SESSION[customer_first_name]
    $_SESSION[customer_middle_initial]
    $_SESSION[customer_last_name].</h2>
        <br><p>Your order has been processed and an email will be sent shortly with the payment options.
        <br>Thank you very much for shopping with Hannah Kat's Vinyl Collective. We appreciate your purchase of the above product(s). You may print a copy of this page for your permanent record.
        <br>To return to our e-store please <a href='/products-services/catalog.php'>click here</a>. Or, you may choose one of the navigation links from our menu options.</p>
  </div>";
}

function markOrderPaid($db, $customerID, $orderID)
{
    $query =
        "UPDATE Orders
        SET order_status_code = 'PD'
        WHERE customer_id = '$customerID' and
              order_id ='$orderID'";
    $success = mysqli_query($db, $query);
}

function markOrderItemsPaid($db, $orderID)
{
    $query =
        "SELECT *
        FROM Order_Items
        WHERE order_id = '$orderID'";
    $orderItems = mysqli_query($db, $query);
    $numRecords = mysqli_num_rows($orderItems);
    for($i=1; $i<=$numRecords; $i++)
    {
        $row = mysqli_fetch_array($orderItems, MYSQLI_ASSOC);
        $query =
            "UPDATE Order_Items
            SET order_item_status_code = 'PD'
            WHERE order_item_id = $row[order_item_id] and
                  order_id = $row[order_id]";        
        mysqli_query($db, $query);
        reduceInventory($db, $row['product_id'],
                             $row['order_item_quantity']);
    }
}

function reduceInventory($db, $productID, $quantityPurchased)
{
    $query = "SELECT * FROM Products WHERE product_id = '$productID'";
    $product = mysqli_query($db, $query);
    $row = mysqli_fetch_array($product, MYSQLI_ASSOC);
    $row['product_inventory'] -= $quantityPurchased;
    $query =
        "UPDATE Products
        SET product_inventory = $row[product_inventory]
        WHERE product_id = $row[product_id]";
    mysqli_query($db, $query);
}
?>