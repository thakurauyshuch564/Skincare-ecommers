<?php
require ("includes/common.php");
session_start();

$email = mysqli_real_escape_string($con, $_POST['lemail']);
$password = md5($_POST['lpassword']);

$query = "SELECT id, email, password, role FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if($num == 0){
    $m = "Please enter correct E-mail id and Password";
    header('location: index.php?errorl='.$m);
} else {
    $row = mysqli_fetch_array($result);
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['admin'] = ($row['role'] == 'admin') ? 1 : 0;
    
    if($row['role'] == 'admin'){
        header('location: admin/dashboard.php');
    } else {
        header('location: products.php');
    }
}
?>