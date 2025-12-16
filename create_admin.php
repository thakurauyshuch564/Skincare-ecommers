<?php
require "includes/common.php";

// New admin credentials
$admin_email = "admin@skincareshop.com";
$admin_password = "admin123";
$admin_name = "Admin User";
$admin_phone = "0000000000";

// Hash the password
$hashed_password = md5($admin_password);

// Check if admin already exists
$check = mysqli_query($con, "SELECT * FROM users WHERE email='$admin_email'");

if(mysqli_num_rows($check) > 0){
    echo "<h2 style='color:orange;'>⚠️ Admin user already exists!</h2>";
    echo "<p>Email: <strong>$admin_email</strong></p>";
    echo "<p>If you forgot the password, you can update it in phpMyAdmin.</p>";
} else {
    // Insert new admin user
    $query = "INSERT INTO users (name, email, password, phone, role) 
              VALUES ('$admin_name', '$admin_email', '$hashed_password', '$admin_phone', 'admin')";
    
    if(mysqli_query($con, $query)){
        echo "<h2 style='color:green;'>✅ Admin user created successfully!</h2>";
        echo "<div style='background:#f0f0f0; padding:20px; border-radius:10px; max-width:500px;'>";
        echo "<h3>Admin Login Credentials:</h3>";
        echo "<p><strong>Email:</strong> $admin_email</p>";
        echo "<p><strong>Password:</strong> $admin_password</p>";
        echo "<hr>";
        echo "<p><a href='admin/login.php' style='background:#667eea; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;'>Go to Admin Login</a></p>";
        echo "</div>";
        
        echo "<br><br>";
        echo "<p style='color:#666;'>Note: Save these credentials in a safe place!</p>";
    } else {
        echo "<h2 style='color:red;'>❌ Error creating admin user!</h2>";
        echo "<p>Error: " . mysqli_error($con) . "</p>";
    }
}

echo "<br><br>";
echo "<hr>";
echo "<h3>All Users in Database:</h3>";
$users = mysqli_query($con, "SELECT id, name, email, role FROM users");
echo "<table border='1' cellpadding='10' style='border-collapse:collapse;'>";
echo "<tr style='background:#667eea; color:white;'>";
echo "<th>ID</th><th>Name</th><th>Email</th><th>Role</th>";
echo "</tr>";
while($user = mysqli_fetch_assoc($users)){
    $bg = ($user['role'] == 'admin') ? '#ffe6e6' : '#ffffff';
    echo "<tr style='background:$bg;'>";
    echo "<td>" . $user['id'] . "</td>";
    echo "<td>" . $user['name'] . "</td>";
    echo "<td>" . $user['email'] . "</td>";
    echo "<td><strong>" . strtoupper($user['role']) . "</strong></td>";
    echo "</tr>";
}
echo "</table>";
?>

<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        background: #f5f5f5;
    }
    h2 { margin-top: 20px; }
</style>
