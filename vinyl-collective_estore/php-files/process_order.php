<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php

$businessEmail = "23014673@sfcollege.edu";

$vinyl = $_POST["mystery_vinyl"] ?? "";
$vinylRequest = $_POST["vinyl_request"] ?? "";
$repair = $_POST["repairs"] ?? "";
$shipping = $_POST["pickup_online"] ?? "";
$taxExempt = isset($_POST["tax_exempt"]);
$careItems = $_POST["care"] ?? [];
$quantities = $_POST["quantity"] ?? [];

$total = 0;
$taxRate = 0.07;

$vinylPrices = [
    "Second-hand Vinyl"=>15, "Antique Vinyl"=>40, "Rentable Vinyl"=>20, "Exclusive Vinyl"=>50, "Signed Vinyl"=>75, "Album Vinyl"=>30];

$repairPrices = [
    "Consultation Appointment"=>50,"Last-Minute Repairs"=>75, "Antique Vinyl Restoration"=>150, "Vinyl Resurfacing"=>120, 
    "Player Player Repair"=>200, "Antique Record Player Repair"=>250, "Not Needed"=>0];

$carePrices = [
    "Cleaning Solution Mix"=>10, "Microfiber Cloth 2-Pack"=>5, "Stylus Brush"=>7, "Scratch Repair Kit"=>20, "Vinyl Washer System"=>100, 
    "Anti-Static Vinyl Spray"=>15, "Vinyl Weights"=>12, "Vinyl Storage"=>35,"Vinyl Shelving"=>100,"Album Stands"=>20, "Record Players"=>150, "Polyvinyl Sleeves"=>15];

$orderSummary = "";

if($vinyl && isset($vinylPrices[$vinyl])){
    $price = $vinylPrices[$vinyl];
    $total += $price;
    $orderSummary .= "$vinyl - $" . number_format($price,2) . "\n";
}

if($repair && isset($repairPrices[$repair])){
    $price = $repairPrices[$repair];
    $total += $price;
    $orderSummary .= "$repair - $" . number_format($price,2) . "\n";
}

foreach($careItems as $item){
    if(isset($carePrices[$item])){
        $price = $carePrices[$item];
        $qty = $quantities[$item] ?? 1;
        if(!is_numeric($qty) || $qty < 1) $qty = 1;
        $itemTotal = $price * $qty;
        $total += $itemTotal;
        $orderSummary .= "$item x$qty - $" . number_format($itemTotal,2) . "\n";
    }
}

if($shipping == "Delivery" && $total < 75){
    $total += 20;
    $orderSummary .= "Delivery Fee - $20.00\n";
}

if(!$taxExempt){
    $tax = $total * $taxRate;
    $total += $tax;
    $orderSummary .= "Sales Tax - $" . number_format($tax,2) . "\n";
}

$orderSummary .= "\nTOTAL: $" . number_format($total,2);

$date = date("Y-m-d H:i:s");

$message  = "Date: $date\n";
$message .= "Requested Vinyl: $vinylRequest\n\n";
$message .= $orderSummary;

mail($businessEmail,"|New Vinyl Order|",$message);

$log = fopen("../data/orders.txt","a");
fwrite($log,$message);
fwrite($log,"\n------------------------\n");
fclose($log);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Submitted</title>
<style>
body{
    font-family:Avenir, Montserrat, sans-serif;
    background:#f5f0fa;
    color:#2f2a33;
    margin:0;
}
.page{
    display:flex;
    justify-content:center;
    padding:50px 20px;
}
.order-box{
    background:white;
    max-width:650px;
    width:100%;
    padding:35px;
    border-radius:12px;
    box-shadow:0 6px 18px rgba(120,80,160,0.12);
}
h2{
    color:#592f6e;
    margin-bottom:15px;
}
p{
    margin:8px 0;
    line-height:1.5;
}
.order-summary{
    background:#f8f6fb;
    padding:15px;
    border-radius:6px;
    margin-top:10px;
    font-family:monospace;
    white-space:pre-line;
}
strong{
    color:#592f6e;
}

.home-button {
display:inline-block;
margin-top:20px;
padding:10px 22px;
background-color:#592f6e;
color:white;
text-decoration:none;
border-radius:6px;
font-size:12px;
}
</style>
</head>
<body>
<div class="page">
<div class="order-box">

<h2>Order Submitted Successfully</h2>

<p>Thank you! We have received your curated vinyl request and will process it soon as possible. Please be 
    on the lookout for a confirmation email shortly. Orders are fulfilled between 3-5 business days.</p>

<p><strong>Selected Vinyl: </strong> <?php echo htmlspecialchars($vinyl); ?></p>
<p><strong>Rquested Vinyl: </strong> <?php echo htmlspecialchars($vinylRequest); ?></p>
<p><strong>Repair Service: </strong> <?php echo htmlspecialchars($repair); ?></p>
<p><strong>Shipping Option: </strong> <?php echo htmlspecialchars($shipping); ?></p>
<p><strong>Tax Exempt: </strong> <?php echo $taxExempt ? "Yes" : "No"; ?></p>
<p><strong>Order Summary: </strong></p>
<div class="order-summary"><?php echo $orderSummary; ?></div>
<p><strong>Date Submitted: </strong> <?php echo $date; ?></p>

<a href="../index.php" class="home-button">Return to Home</a>
</div>
</div>
</body>
</html>