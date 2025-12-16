<?php
require ("includes/common.php");
session_start();

$user_id = mysqli_real_escape_string($con, $_POST['id']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);

// Check if password is being updated
if(!empty($_POST["pass"])){
    $password = md5($_POST["pass"]);
    $query = "UPDATE users SET email='$email', name='$name', phone='$phone', password='$password' WHERE id='$user_id'";
} else {
    $query = "UPDATE users SET email='$email', name='$name', phone='$phone' WHERE id='$user_id'";
}

if(mysqli_query($con, $query)){
    $_SESSION['email'] = $email;
    header('location: profile.php?success=1');
} else {
    header('location: profile.php?error=1');
}
exit;
?>