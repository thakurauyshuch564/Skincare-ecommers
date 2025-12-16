<?php
require "includes/common.php";
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit;
}

$sum = 0;
$user_id = $_SESSION['user_id'];
$query = "SELECT products.price AS Price, products.id, products.name AS Name, users_products.quantity as Quantity 
          FROM users_products 
          JOIN products ON users_products.item_id = products.id 
          WHERE users_products.user_id='$user_id' AND status='Added To Cart'";
$result = mysqli_query($con, $query);

$prodlist = "";
while ($row = mysqli_fetch_array($result)) {
    $sum += $row["Price"] * $row["Quantity"];
    $prodlist .= $row["Name"] . "." . $row["Quantity"] . ",";
}
$prodlist = rtrim($prodlist, ", ");

// Sanitize inputs
$name = mysqli_real_escape_string($con, $_POST["fname"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$phone = mysqli_real_escape_string($con, $_POST["phone"]);
$address = mysqli_real_escape_string($con, $_POST["address"]);
$city = mysqli_real_escape_string($con, $_POST["city"]);
$state = mysqli_real_escape_string($con, $_POST["state"]);
$zip = mysqli_real_escape_string($con, $_POST["zip"]);

// Insert order with user_id
$query = "INSERT INTO orders(user_id, products_order, order_price, name, email, address, city, county, postal_code, status, phone) 
          VALUES('$user_id', '$prodlist', '$sum', '$name', '$email', '$address', '$city', '$state', '$zip', 'Processing', '$phone')";
$result = mysqli_query($con, $query);

if($result){
    // Update cart items status to Confirmed
    mysqli_query($con, "UPDATE users_products SET status='Confirmed' WHERE user_id='$user_id' AND status='Added To Cart'");
    header("location: success.php");
} else {
    header("location: cart.php?error=order_failed");
}
exit;
?>