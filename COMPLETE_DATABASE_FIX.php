<?php
/**
 * COMPLETE DATABASE FIX
 * This script fixes ALL database issues in one click
 * - Creates missing tables
 * - Adds missing columns
 * - Shows detailed progress
 */

require "includes/common.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Complete Database Fix</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 3px solid #4CAF50; padding-bottom: 10px; }
        .success { color: green; padding: 10px; background: #e8f5e9; border-left: 4px solid green; margin: 10px 0; }
        .warning { color: orange; padding: 10px; background: #fff3e0; border-left: 4px solid orange; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #ffebee; border-left: 4px solid red; margin: 10px 0; }
        .info { color: blue; padding: 10px; background: #e3f2fd; border-left: 4px solid blue; margin: 10px 0; }
        .btn { padding: 15px 30px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px 5px; }
        .btn:hover { background: #45a049; }
        hr { margin: 20px 0; border: none; border-top: 2px solid #eee; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table th, table td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        table th { background: #4CAF50; color: white; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔧 Complete Database Fix</h1>
    <p>This script will fix all database issues automatically.</p>
    <hr>

<?php
$tables_created = 0;
$columns_added = 0;
$already_exist = 0;
$errors = [];

// ============================================
// 1. CREATE REVIEWS TABLE
// ============================================
echo "<h2>1. Reviews Table</h2>";
$check = mysqli_query($con, "SHOW TABLES LIKE 'reviews'");
if(mysqli_num_rows($check) == 0) {
    $sql = "CREATE TABLE `reviews` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `rating` tinyint(1) NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
        `comment` text DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `product_id` (`product_id`),
        KEY `user_id` (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    if(mysqli_query($con, $sql)) {
        echo "<div class='success'>✓ Reviews table created successfully!</div>";
        $tables_created++;
    } else {
        echo "<div class='error'>✗ Error: " . mysqli_error($con) . "</div>";
        $errors[] = "Reviews table";
    }
} else {
    echo "<div class='warning'>✓ Reviews table already exists</div>";
    $already_exist++;
}

// ============================================
// 2. CREATE NEWSLETTER_SUBSCRIBERS TABLE
// ============================================
echo "<h2>2. Newsletter Subscribers Table</h2>";
$check = mysqli_query($con, "SHOW TABLES LIKE 'newsletter_subscribers'");
if(mysqli_num_rows($check) == 0) {
    $sql = "CREATE TABLE `newsletter_subscribers` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `email` varchar(255) NOT NULL,
        `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
        `status` enum('active','unsubscribed') NOT NULL DEFAULT 'active',
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    if(mysqli_query($con, $sql)) {
        echo "<div class='success'>✓ Newsletter subscribers table created successfully!</div>";
        $tables_created++;
    } else {
        echo "<div class='error'>✗ Error: " . mysqli_error($con) . "</div>";
        $errors[] = "Newsletter table";
    }
} else {
    echo "<div class='warning'>✓ Newsletter subscribers table already exists</div>";
    $already_exist++;
}

// ============================================
// 3. CREATE CONTACT_MESSAGES TABLE
// ============================================
echo "<h2>3. Contact Messages Table</h2>";
$check = mysqli_query($con, "SHOW TABLES LIKE 'contact_messages'");
if(mysqli_num_rows($check) == 0) {
    $sql = "CREATE TABLE `contact_messages` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(100) NOT NULL,
        `email` varchar(255) NOT NULL,
        `subject` varchar(255) DEFAULT NULL,
        `message` text NOT NULL,
        `status` enum('new','read','replied') NOT NULL DEFAULT 'new',
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    if(mysqli_query($con, $sql)) {
        echo "<div class='success'>✓ Contact messages table created successfully!</div>";
        $tables_created++;
    } else {
        echo "<div class='error'>✗ Error: " . mysqli_error($con) . "</div>";
        $errors[] = "Contact messages table";
    }
} else {
    echo "<div class='warning'>✓ Contact messages table already exists</div>";
    $already_exist++;
}

// ============================================
// 4. CREATE WISHLIST TABLE
// ============================================
echo "<h2>4. Wishlist Table</h2>";
$check = mysqli_query($con, "SHOW TABLES LIKE 'wishlist'");
if(mysqli_num_rows($check) == 0) {
    $sql = "CREATE TABLE `wishlist` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `product_id` int(11) NOT NULL,
        `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `user_product` (`user_id`, `product_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    if(mysqli_query($con, $sql)) {
        echo "<div class='success'>✓ Wishlist table created successfully!</div>";
        $tables_created++;
    } else {
        echo "<div class='error'>✗ Error: " . mysqli_error($con) . "</div>";
        $errors[] = "Wishlist table";
    }
} else {
    echo "<div class='warning'>✓ Wishlist table already exists</div>";
    $already_exist++;
}

// ============================================
// 5. ADD TIPCULOARE COLUMN TO PRODUCTS
// ============================================
echo "<h2>5. Products Table - TipCuloare Column</h2>";
$check = mysqli_query($con, "SHOW COLUMNS FROM products LIKE 'TipCuloare'");
if(mysqli_num_rows($check) == 0) {
    $sql = "ALTER TABLE products ADD COLUMN TipCuloare VARCHAR(50) DEFAULT NULL COMMENT 'Product color type'";
    if(mysqli_query($con, $sql)) {
        echo "<div class='success'>✓ TipCuloare column added to products table!</div>";
        $columns_added++;
    } else {
        echo "<div class='error'>✗ Error: " . mysqli_error($con) . "</div>";
        $errors[] = "TipCuloare column";
    }
} else {
    echo "<div class='warning'>✓ TipCuloare column already exists</div>";
    $already_exist++;
}

// ============================================
// 6. ADD ORDER_DATE COLUMN TO ORDERS
// ============================================
echo "<h2>6. Orders Table - order_date Column</h2>";
$check = mysqli_query($con, "SHOW COLUMNS FROM orders LIKE 'order_date'");
if(mysqli_num_rows($check) == 0) {
    $sql = "ALTER TABLE orders ADD COLUMN order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
    if(mysqli_query($con, $sql)) {
        echo "<div class='success'>✓ order_date column added to orders table!</div>";
        $columns_added++;
    } else {
        echo "<div class='error'>✗ Error: " . mysqli_error($con) . "</div>";
        $errors[] = "order_date column";
    }
} else {
    echo "<div class='warning'>✓ order_date column already exists</div>";
    $already_exist++;
}

// ============================================
// SUMMARY
// ============================================
echo "<hr>";
echo "<h2>📊 Summary</h2>";
echo "<table>";
echo "<tr><th>Item</th><th>Count</th></tr>";
echo "<tr><td>Tables Created</td><td><strong>$tables_created</strong></td></tr>";
echo "<tr><td>Columns Added</td><td><strong>$columns_added</strong></td></tr>";
echo "<tr><td>Already Existed</td><td><strong>$already_exist</strong></td></tr>";
echo "<tr><td>Errors</td><td><strong>" . count($errors) . "</strong></td></tr>";
echo "</table>";

if(count($errors) > 0) {
    echo "<div class='error'><h3>⚠ Errors Encountered:</h3><ul>";
    foreach($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div>";
} else {
    echo "<div class='success' style='font-size: 18px;'><strong>🎉 ALL DATABASE ISSUES FIXED!</strong><br>Your application is now ready to use.</div>";
}

mysqli_close($con);
?>

    <hr>
    <h3>Next Steps:</h3>
    <div class="info">
        <p>✓ All database tables and columns have been set up</p>
        <p>✓ You can now use all admin features</p>
        <p>✓ Try accessing the admin pages again</p>
    </div>
    
    <a href="admin/orders.php" class="btn">Go to Admin Orders</a>
    <a href="admin/reviews.php" class="btn">Go to Reviews</a>
    <a href="admin/messages.php" class="btn">Go to Messages</a>
    <a href="products.php" class="btn">Go to Products</a>
    
    <hr>
    <p><small><strong>Note:</strong> You can safely delete this file (COMPLETE_DATABASE_FIX.php) after the setup is complete.</small></p>
</div>
</body>
</html>
