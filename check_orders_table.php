<?php
/**
 * Check Orders Table Structure
 * This will show us what columns actually exist in the orders table
 */

require "includes/common.php";

echo "<h2>Orders Table Structure</h2>";
echo "<p>Checking what columns exist in the orders table...</p>";

// Get table structure
$query = "DESCRIBE orders";
$result = mysqli_query($con, $query);

if($result) {
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><strong>" . $row['Field'] . "</strong></td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . ($row['Default'] ?? 'NULL') . "</td>";
        echo "<td>" . ($row['Extra'] ?? '') . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p style='color: red;'>Error: " . mysqli_error($con) . "</p>";
}

// Check if we need to add the order_date column
echo "<hr>";
echo "<h3>Fix Missing Columns</h3>";

$check_order_date = mysqli_query($con, "SHOW COLUMNS FROM orders LIKE 'order_date'");
if(mysqli_num_rows($check_order_date) == 0) {
    echo "<p style='color: orange;'>⚠ Column 'order_date' is missing!</p>";
    echo "<p>Click the button below to add it:</p>";
    
    if(isset($_POST['fix_order_date'])) {
        $fix_query = "ALTER TABLE orders ADD COLUMN order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
        if(mysqli_query($con, $fix_query)) {
            echo "<p style='color: green;'>✓ Successfully added order_date column!</p>";
            echo "<script>setTimeout(function(){ location.reload(); }, 2000);</script>";
        } else {
            echo "<p style='color: red;'>✗ Error: " . mysqli_error($con) . "</p>";
        }
    } else {
        echo "<form method='post'>";
        echo "<button type='submit' name='fix_order_date' style='padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;'>Add order_date Column</button>";
        echo "</form>";
    }
} else {
    echo "<p style='color: green;'>✓ Column 'order_date' exists!</p>";
}

echo "<hr>";
echo "<p><a href='orders.php' style='padding: 10px 20px; background: #2196F3; color: white; text-decoration: none; border-radius: 5px;'>Go to Orders Page</a></p>";

mysqli_close($con);
?>
