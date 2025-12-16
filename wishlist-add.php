<?php
require("includes/common.php");
session_start();

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    // Check if already in wishlist
    $check = mysqli_query($con, "SELECT * FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'");
    
    if(mysqli_num_rows($check) == 0){
        $query = "INSERT INTO wishlist(user_id, product_id) VALUES('$user_id', '$product_id')";
        mysqli_query($con, $query);
    }
    
    header('location: user/wishlist.php');
}
?>
