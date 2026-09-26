<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//shoppingCartProcess.php
$retrying = isset($_GET['retrying']) ? true : false;
$items = getExistingOrder($db, $customerID);
$numRecords = mysqli_num_rows($items);

if ($numRecords == 0 && $productID == 'view')
{
    echo
    "<p class='Notification'>Your shopping cart is empty.</p>
    <p class='Notification'>To continue shopping, please
    <a class='NoDecoration' href='/products-services/catalog.php'>click here</a>.</p>";
}
else
{
    displayHeader();
    $grandTotal = 0;
    if ($numRecords == 0)
    {
        createOrder($db, $customerID);
    }
    else
    {
        for ($i=1; $i<=$numRecords; $i++)
        {
            $grandTotal += displayExistingItemColumns($db, $items);
        }
    }
    
    if ($productID != 'view')
    {
        if ($retrying)
        {
            echo
            "<tr>
              <td class='Notification' colspan='7'>Please re-enter a
                product quantity not exceeding the inventory level.
              </td>
             </tr>";
        } 
        displayNewItemColumns($db, $productID);
    }
    displayFooter($grandTotal);
}
mysqli_close($db);

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
            Orders.order_status_code = 'IP'        and
            Orders.customer_id = $customerID";
    $items = mysqli_query($db, $query);
    return $items;
}

function createOrder($db, $customerID)
{
    $query = "INSERT INTO Orders
    (
        customer_id,
        order_status_code,
        date_order_placed,
        order_details
    )
    VALUES
    (
        '$customerID',
        'IP',
        CURDATE(),
        NULL
    )";
    $success = mysqli_query($db, $query);
}

function displayHeader()
{
    echo 
    "<form id='orderForm'
           onsubmit='return shoppingCartAddItemFormValidate();'
           action='/products-services/scripts/shoppingCartAddItem.php'>
      <table class='cart-table'>
        <tr>
          <th>Product Image</th>
          <th>Product Name</th>
          <th>Price</th>
          <th># in Stock</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Action</th>
        </tr>";
}
function displayFirstFourColumns($db, $productID)
{
    $query =
      "SELECT *
      FROM Products
      WHERE product_id='$productID'";
    $product = mysqli_query($db, $query);
    $row = mysqli_fetch_array($product, MYSQLI_ASSOC);
    $productPrice = sprintf("$%1.2f", $row['product_price']);
    echo
    "<tr>
      <td>
        <img height='70' width='70'
             src='$row[product_image_url]' alt='Product Image'>
      </td><td style='text-align: left;'>
        $row[product_name]
      </td><td style='text-align: right;'>
        $productPrice
      </td><td>
        $row[product_inventory]
      </td>";
}

function displayExistingItemColumns($db, $items)
{
    $row = mysqli_fetch_array($items, MYSQLI_ASSOC);
    $productID = $row['product_id'];
    displayFirstFourColumns($db, $productID);
    
    $total = $row['order_item_quantity'] * $row['order_item_price'];
    $totalAsString = sprintf("$%1.2f", $total);
    echo
      "<td>
        $row[order_item_quantity]
       </td><td style='text-align: right;'>
        $totalAsString
       </td><td>
        <a class='btn-cart btn-cart'
            href='/products-services/scripts/shoppingCartDeleteItem.php?orderItemID=$row[order_item_id]&orderID=$row[order_id]'>
            Delete from Cart</a>
        <br>
        <a class='btn-cart' href='/products-services/catalog.php'>
            Continue Shopping</a>
        </td>
      </tr>";
    return $total;
}

function displayNewItemColumns($db, $productID)
{
    displayFirstFourColumns($db, $productID);
    echo
    "<td>
      <input type='hidden' id='productID' name='productID' value=$productID>
      <input type='text' id='quantity' name='quantity' size='3'>
     </td><td style='text-align: right;'>
      TBA
     </td><td>
      <input class='btn-cart' type='submit' value='Add to Cart'>
      <br>
      <a class='btn-cart btn-cart-secondary' href='/products-services/catalog.php'>
        Continue Shopping</a>
     </td>
  </tr>";
}

function displayFooter($grandTotal)
{
    $grandTotalAsString = sprintf("$%1.2f", $grandTotal);
    echo
    "<tr>
      <td colspan='5'>
        Grand Total
      </td><td style='text-align: right;'>
        <strong>$grandTotalAsString</strong>
      </td><td>
        <a class='btn-cart' href='/products-services/checkout.php'> Proceed to Checkout</a>
      </td>
    </tr>
  </table>
</form>";
}