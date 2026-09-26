<!--
Author: Hannah Bauer
Course: CGS4183
Date: 4/16/2026
Assignment: Project 10 - PHP E-Store
-->

<?php

$businessEmail = "23014673@sfcollege.edu";

$first = $_POST["firstName"] ?? "";
$last = $_POST["lastName"] ?? "";
$email = $_POST["email"] ?? "";
$comments1 = $_POST["comments1"] ?? "";
$comments2 = $_POST["comments2"] ?? "";
$sat1 = $_POST["satisfaction1"] ?? "";
$sat2 = $_POST["satisfaction2"] ?? "";

$purchased = isset($_POST["purchased"]) ? implode(", ", $_POST["purchased"]) : "";
$services = isset($_POST["accessories"]) ? implode(", ", $_POST["accessories"]) : "";

$date = date("Y-m-d H:i:s");

$message  = "Date: $date\n";
$message .= "Customer: $first $last\n";
$message .= "Email: $email\n\n";
$message .= "Products Purchased: $purchased\n";
$message .= "Product Satisfaction: $sat1\n";
$message .= "Product Comments: $comments1\n\n";
$message .= "Services Used: $services\n";
$message .= "Service Satisfaction: $sat2\n";
$message .= "Service Comments: $comments2\n\n";

mail($businessEmail, "New Feedback Submission", $message, "From: $email");
$confirmation = "Thank you for your feedback!\n\n\n\n$message";
mail($email, "Feedback Confirmation", $confirmation, "From: $businessEmail");

$log = fopen("../data/feedback.txt","a");
fwrite($log, $message);
fwrite($log, "--------------------------\n");
fclose($log);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Feedback Submitted</title>

<style>

html, body {
  height: 100%;
  margin: 0;
  font-family: Avenir, Montserrat, Corbel, 'URW Gothic', source-sans-pro, sans-serif;
  font-size: 12px;
  background-color: rgb(245, 240, 250);
  color: #2f2a33;
}

.page {
  min-height: 100%;
  display: flex;
  flex-direction: column;
  max-width: 871px;
  margin: 0 auto;
  padding: 0 13px;
}

.feedback-box {
  background: white;
  border-radius: 8px;
  padding: 30px;
  box-shadow: 0 4px 12px rgba(120, 80, 160, 0.12);
  border: 1px solid rgba(120, 80, 160, 0.08);
  max-width: 600px;
  margin: 60px auto;
}

.feedback-box h2 {
  margin-top: 0;
  color: #4a3f66;
}

.feedback-box p {
  margin: 10px 0;
  line-height: 1.8;
}

.feedback-box strong {
  color: #4a3f66;
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

<div class="feedback-box">

<h2>Feedback Submitted</h2>

<p>Thank you <?php echo $first; ?>. Your feedback was received.</p>

<p><strong>Name: </strong> <?php echo "$first $last"; ?></p>
<p><strong>Email: </strong> <?php echo $email; ?></p>
<p><strong>Products Purchased: </strong> <?php echo $purchased; ?></p>
<p><strong>Product Satisfaction: </strong> <?php echo $sat1; ?></p>
<p><strong>Product Comments: </strong> <?php echo $comments1; ?></p>
<p><strong>Services Used: </strong> <?php echo $services; ?></p>
<p><strong>Service Satisfaction: </strong> <?php echo $sat2; ?></p>
<p><strong>Service Comments: </strong> <?php echo $comments2; ?></p>
<p><strong>Date Submitted: </strong> <?php echo $date; ?></p>

<a href="../index.php" class="home-button">Return to Home</a>
</div>
</div>
</body>
</html>