<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//displayOneCategoryItems.php
$categoryCode = $_GET['categoryCode'];

$categoryLabels = [
    'vinyl_album'  => 'Vinyl Albums',
    'second_hand'  => 'Second-Hand Vinyls',
    'antique'      => 'Antique Vinyls',
    'exclusive'    => 'Exclusive Vinyls',
    'signed'       => 'Signed Vinyls',
    'rentable'     => 'Rentable Vinyls'
];

$catLabel = isset($categoryLabels[$categoryCode]) ? $categoryLabels[$categoryCode] : ucfirst($categoryCode);

echo "<a class='back-link' href='/products-services/catalog.php'>← Back to Product Catalog</a>";
echo "<h2>" . htmlspecialchars($catLabel) . "</h2>";
echo "<p>All products in this category:</p>";

$query = "SELECT * FROM Products
          WHERE product_category_code = '$categoryCode'
          ORDER BY product_name ASC";
$products = mysqli_query($db, $query);
$numRecords = mysqli_num_rows($products);

if ($numRecords == 0) {
    echo "<p>No products found in this category.</p>";
} else {
    echo "
    <table class='product-table'>
      <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th># in Stock</th>
        <th>Purchase</th>
      </tr>";

    for ($i = 1; $i <= $numRecords; $i++) {
        $row = mysqli_fetch_array($products, MYSQLI_ASSOC);
        $productName  = htmlspecialchars($row['product_name']);
        $productPrice = sprintf("$%.2f", $row['product_price']);
        $productStock = $row['product_inventory'];
        $productID    = $row['product_id'];
        $shoppingCartURL = "/products-services/shoppingCart.php?productID=$productID";
        echo "
        <tr>
          <td>$productName</td>
          <td>$productPrice</td>
          <td>$productStock</td>
          <td>
            <a class='btn' href='$shoppingCartURL'>Add to Cart</a>
          </td>
        </tr>";
    }
    echo "</table>";
}