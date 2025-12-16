<?php
require "includes/common.php";
session_start();

$email = mysqli_real_escape_string($con, $_POST['eMail']);
$pass = md5(mysqli_real_escape_string($con, $_POST['password']));
$first = mysqli_real_escape_string($con, $_POST['firstName']);
$last = mysqli_real_escape_string($con, $_POST['lastName']);
$name = $first . ' ' . $last;

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if ($num != 0) {
    $m = "Email Already Exists";
    header('location: index.php?error=' . $m);
} else {
    $quer = "INSERT INTO users(email, name, password, role) VALUES('$email', '$name', '$pass', 'user')";
    mysqli_query($con, $quer);
    
    $user_id = mysqli_insert_id($con);
    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['admin'] = 0;
    header('location: products.php');
}
?>