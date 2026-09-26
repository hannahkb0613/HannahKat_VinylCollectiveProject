<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php
//displayListOfCategories.php
$query = "SELECT DISTINCT product_category_code AS category FROM Products ORDER BY category ASC";
$categories = mysqli_query($db, $query);
$numRecords = mysqli_num_rows($categories);

$categoryLabels = [
    'vinyl_album'  => 'Vinyl Albums',
    'second_hand'  => 'Second-Hand Vinyls',
    'antique'      => 'Antique Vinyls',
    'exclusive'    => 'Exclusive Vinyls',
    'signed'       => 'Signed Vinyls',
    'rentable'     => 'Rentable Vinyls'
];

echo "<table class='catalog-table'>";
for ($i = 1; $i <= $numRecords; $i++) {
    $row = mysqli_fetch_array($categories, MYSQLI_ASSOC);
    $catCode = urlencode($row['category']);
    $catLabel = isset($categoryLabels[$row['category']]) ? $categoryLabels[$row['category']] : ucfirst($row['category']);
    echo "<tr><td><a class='catalog-category-link' href='/products-services/category.php?categoryCode=$catCode'>$catLabel</a></td></tr>";
}
echo "</table>";
mysqli_close($db);
?>