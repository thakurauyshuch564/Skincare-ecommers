<?php
/**
 * Check and Fix Products Table Structure
 * This will show the actual columns and fix any missing ones
 */

require "includes/common.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Check Products Table</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 3px solid #4CAF50; padding-bottom: 10px; }
        .success { color: green; padding: 10px; background: #e8f5e9; border-left: 4px solid green; margin: 10px 0; }
        .warning { color: orange; padding: 10px; background: #fff3e0; border-left: 4px solid orange; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #ffebee; border-left: 4px solid red; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table th, table td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        table th { background: #4CAF50; color: white; }
        .btn { padding: 15px 30px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #45a049; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔍 Products Table Structure Check</h1>
    
    <h2>Current Table Structure:</h2>
    <?php
    $query = "DESCRIBE products";
    $result = mysqli_query($con, $query);
    
    if($result) {
        echo "<table>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        
        $columns = [];
        while($row = mysqli_fetch_assoc($result)) {
            $columns[] = $row['Field'];
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
        
        // Check for required columns
        $required_columns = [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(100) NOT NULL',
            'brand' => 'varchar(100) DEFAULT NULL',
            'description' => 'text DEFAULT NULL',
            'price' => 'decimal(10,2) NOT NULL',
            'stock' => 'int(11) NOT NULL DEFAULT 100',
            'category' => 'varchar(50) DEFAULT NULL',
            'skin_type' => 'varchar(50) DEFAULT NULL',
            'volume' => 'varchar(20) DEFAULT NULL',
            'image' => 'varchar(255) DEFAULT NULL',
            'TipCuloare' => 'varchar(50) DEFAULT NULL',
            'created_at' => 'timestamp NOT NULL DEFAULT current_timestamp()',
            'updated_at' => 'timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()'
        ];
        
        echo "<h2>Missing Columns Check:</h2>";
        $missing = [];
        foreach($required_columns as $col => $type) {
            if(!in_array($col, $columns)) {
                $missing[$col] = $type;
                echo "<div class='warning'>⚠ Column '<strong>$col</strong>' is missing!</div>";
            }
        }
        
        if(empty($missing)) {
            echo "<div class='success'>✓ All required columns exist!</div>";
        } else {
            echo "<h3>Fix Missing Columns:</h3>";
            echo "<form method='post'>";
            echo "<button type='submit' name='fix_columns' class='btn'>Fix All Missing Columns</button>";
            echo "</form>";
            
            if(isset($_POST['fix_columns'])) {
                echo "<hr><h3>Fixing columns...</h3>";
                
                foreach($missing as $col => $type) {
                    // Special handling for different column types
                    if($col == 'name') {
                        $sql = "ALTER TABLE products ADD COLUMN `name` varchar(100) NOT NULL AFTER `id`";
                    } elseif($col == 'TipCuloare') {
                        $sql = "ALTER TABLE products ADD COLUMN `TipCuloare` varchar(50) DEFAULT NULL";
                    } elseif($col == 'created_at') {
                        $sql = "ALTER TABLE products ADD COLUMN `created_at` timestamp NOT NULL DEFAULT current_timestamp()";
                    } elseif($col == 'updated_at') {
                        $sql = "ALTER TABLE products ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()";
                    } elseif(strpos($type, 'varchar') !== false) {
                        preg_match('/varchar\((\d+)\)/', $type, $matches);
                        $length = $matches[1] ?? 255;
                        $default = strpos($type, 'NOT NULL') !== false ? '' : 'DEFAULT NULL';
                        $sql = "ALTER TABLE products ADD COLUMN `$col` varchar($length) $default";
                    } elseif(strpos($type, 'int') !== false) {
                        $default = strpos($type, 'DEFAULT') !== false ? preg_replace('/.*DEFAULT (\d+).*/', 'DEFAULT $1', $type) : 'DEFAULT NULL';
                        $sql = "ALTER TABLE products ADD COLUMN `$col` int(11) $default";
                    } elseif(strpos($type, 'decimal') !== false) {
                        $sql = "ALTER TABLE products ADD COLUMN `$col` decimal(10,2) NOT NULL DEFAULT 0.00";
                    } elseif(strpos($type, 'text') !== false) {
                        $sql = "ALTER TABLE products ADD COLUMN `$col` text DEFAULT NULL";
                    } else {
                        $sql = "ALTER TABLE products ADD COLUMN `$col` $type";
                    }
                    
                    if(mysqli_query($con, $sql)) {
                        echo "<div class='success'>✓ Added column: <strong>$col</strong></div>";
                    } else {
                        echo "<div class='error'>✗ Error adding $col: " . mysqli_error($con) . "</div>";
                    }
                }
                
                echo "<div class='success' style='font-size: 18px; margin-top: 20px;'><strong>🎉 Table structure fixed!</strong></div>";
                echo "<script>setTimeout(function(){ location.reload(); }, 2000);</script>";
            }
        }
        
    } else {
        echo "<div class='error'>Error: " . mysqli_error($con) . "</div>";
    }
    
    mysqli_close($con);
    ?>
    
    <hr>
    <a href="admin/add_product.php" class="btn">Go to Add Product</a>
    <a href="admin/products.php" class="btn">Go to Products List</a>
</div>
</body>
</html>
