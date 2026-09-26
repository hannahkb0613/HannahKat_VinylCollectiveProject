<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//logoutProcess.php
$query =
    "DELETE FROM Orders
    WHERE
        customer_id = 0 and
        order_status_code = 'IP'";
$success = mysqli_query($db, $query);

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
if ($items != null)
    $numRecords = mysqli_num_rows($items);

if ($numRecords == 0)
{
    $query =
        "SELECT
            order_id,
            customer_id,
            order_status_code
        FROM Orders
        WHERE
            order_status_code = 'IP' and
            customer_id = $customerID";
    $orphanedOrders = mysqli_query($db, $query);
    if ($orphanedOrders != null)
    {
        $numRecords = mysqli_num_rows($orphanedOrders);
        if ($numRecords != 0)
        {
            for ($i=0; $i<$numRecords; $i++)
            {
                $orphanedOrdersArray =
                    mysqli_fetch_array($orphanedOrders, MYSQLI_ASSOC);
                $orphanedOrderID = $orphanedOrdersArray['order_id'];
                $query =
                    "DELETE FROM Orders
                    WHERE
                        order_id = '$orphanedOrderID' and
                        order_status_code = 'IP'      and
                        customer_id = '$customerID'";
                $success = mysqli_query($db, $query);
            }
        }
    }
}
mysqli_close($db);
?>