<?php
require "includes/common.php";

if(isset($_POST['email'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    
    // Check if email already exists
    $check = mysqli_query($con, "SELECT * FROM newsletter_subscribers WHERE email='$email'");
    
    if(mysqli_num_rows($check) == 0){
        $query = "INSERT INTO newsletter_subscribers (email) VALUES ('$email')";
        if(mysqli_query($con, $query)){
            echo json_encode(['success' => true, 'message' => 'Mulțumesc că te-ai abonat!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Eroare la abonare.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email-ul este deja abonat!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Email invalid.']);
}
?>
