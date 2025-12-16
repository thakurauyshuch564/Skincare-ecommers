<?php
require "includes/common.php";

echo "<h2>Database Connection Test</h2>";
echo "<p>Connected to database: <strong>glowskin</strong></p>";

// Check tables
echo "<h3>Existing Tables:</h3>";
$tables = mysqli_query($con, "SHOW TABLES");
echo "<ul>";
while($table = mysqli_fetch_array($tables)){
    echo "<li>" . $table[0] . "</li>";
}
echo "</ul>";

// Check users table structure
echo "<h3>Users Table Structure:</h3>";
$columns = mysqli_query($con, "DESCRIBE users");
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
while($col = mysqli_fetch_assoc($columns)){
    echo "<tr>";
    echo "<td>" . $col['Field'] . "</td>";
    echo "<td>" . $col['Type'] . "</td>";
    echo "<td>" . $col['Null'] . "</td>";
    echo "<td>" . $col['Key'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Check if orders table exists
echo "<h3>Checking Required Tables:</h3>";
$required_tables = ['users', 'products', 'orders', 'cart', 'categories'];
foreach($required_tables as $table){
    $check = mysqli_query($con, "SHOW TABLES LIKE '$table'");
    if(mysqli_num_rows($check) > 0){
        echo "<p style='color:green;'>✓ Table '$table' exists</p>";
    } else {
        echo "<p style='color:red;'>✗ Table '$table' MISSING</p>";
    }
}
?>
