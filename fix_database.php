<?php
/**
 * Database Fix Script
 * This script adds the missing TipCuloare column to the products table
 * Run this file once by visiting: http://localhost/SkinCareShop-main/OnlineSkinCareShop/fix_database.php
 */

require "includes/common.php";

echo "<h2>Database Fix Script</h2>";
echo "<p>Attempting to fix the 'TipCuloare' column error...</p>";

// Check if column exists
$check_query = "SHOW COLUMNS FROM products LIKE 'TipCuloare'";
$result = mysqli_query($con, $check_query);

if(mysqli_num_rows($result) > 0) {
    echo "<div style='color: orange; padding: 10px; border: 2px solid orange; margin: 10px 0;'>";
    echo "✓ Column 'TipCuloare' already exists in the products table.";
    echo "</div>";
} else {
    echo "<p>Column 'TipCuloare' not found. Adding it now...</p>";
    
    // Add the missing column
    $alter_query = "ALTER TABLE products ADD COLUMN TipCuloare VARCHAR(50) DEFAULT NULL COMMENT 'Product color type'";
    
    if(mysqli_query($con, $alter_query)) {
        echo "<div style='color: green; padding: 10px; border: 2px solid green; margin: 10px 0;'>";
        echo "✓ SUCCESS! Column 'TipCuloare' has been added to the products table.";
        echo "</div>";
        echo "<p><strong>The error should now be fixed!</strong></p>";
    } else {
        echo "<div style='color: red; padding: 10px; border: 2px solid red; margin: 10px 0;'>";
        echo "✗ ERROR: Could not add column. Error: " . mysqli_error($con);
        echo "</div>";
    }
}

// Display current table structure
echo "<h3>Current Products Table Structure:</h3>";
echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";

$structure_query = "DESCRIBE products";
$structure_result = mysqli_query($con, $structure_query);

while($row = mysqli_fetch_assoc($structure_result)) {
    echo "<tr>";
    echo "<td>" . $row['Field'] . "</td>";
    echo "<td>" . $row['Type'] . "</td>";
    echo "<td>" . $row['Null'] . "</td>";
    echo "<td>" . $row['Key'] . "</td>";
    echo "<td>" . ($row['Default'] ?? 'NULL') . "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<hr>";
echo "<p><a href='products.php' style='padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px;'>Go to Products Page</a></p>";
echo "<p><small>You can delete this file (fix_database.php) after the fix is complete.</small></p>";

mysqli_close($con);
?>
