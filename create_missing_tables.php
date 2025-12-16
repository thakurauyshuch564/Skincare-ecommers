<?php
/**
 * Create Missing Database Tables
 * This script will create all missing tables needed for the application
 */

require "includes/common.php";

echo "<h2>Database Setup - Create Missing Tables</h2>";
echo "<hr>";

$tables_created = 0;
$tables_exist = 0;
$errors = [];

// Check and create reviews table
$check_reviews = mysqli_query($con, "SHOW TABLES LIKE 'reviews'");
if(mysqli_num_rows($check_reviews) == 0) {
    echo "<p>Creating <strong>reviews</strong> table...</p>";
    $create_reviews = "CREATE TABLE `reviews` (
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
    
    if(mysqli_query($con, $create_reviews)) {
        echo "<p style='color: green;'>✓ Reviews table created successfully!</p>";
        $tables_created++;
    } else {
        $errors[] = "Reviews table: " . mysqli_error($con);
        echo "<p style='color: red;'>✗ Error creating reviews table</p>";
    }
} else {
    echo "<p style='color: orange;'>✓ Reviews table already exists</p>";
    $tables_exist++;
}

// Check and create newsletter_subscribers table
$check_newsletter = mysqli_query($con, "SHOW TABLES LIKE 'newsletter_subscribers'");
if(mysqli_num_rows($check_newsletter) == 0) {
    echo "<p>Creating <strong>newsletter_subscribers</strong> table...</p>";
    $create_newsletter = "CREATE TABLE `newsletter_subscribers` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `email` varchar(255) NOT NULL,
        `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
        `status` enum('active','unsubscribed') NOT NULL DEFAULT 'active',
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    if(mysqli_query($con, $create_newsletter)) {
        echo "<p style='color: green;'>✓ Newsletter subscribers table created successfully!</p>";
        $tables_created++;
    } else {
        $errors[] = "Newsletter table: " . mysqli_error($con);
        echo "<p style='color: red;'>✗ Error creating newsletter_subscribers table</p>";
    }
} else {
    echo "<p style='color: orange;'>✓ Newsletter subscribers table already exists</p>";
    $tables_exist++;
}

// Check and create contact_messages table
$check_contact = mysqli_query($con, "SHOW TABLES LIKE 'contact_messages'");
if(mysqli_num_rows($check_contact) == 0) {
    echo "<p>Creating <strong>contact_messages</strong> table...</p>";
    $create_contact = "CREATE TABLE `contact_messages` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(100) NOT NULL,
        `email` varchar(255) NOT NULL,
        `subject` varchar(255) DEFAULT NULL,
        `message` text NOT NULL,
        `status` enum('new','read','replied') NOT NULL DEFAULT 'new',
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    if(mysqli_query($con, $create_contact)) {
        echo "<p style='color: green;'>✓ Contact messages table created successfully!</p>";
        $tables_created++;
    } else {
        $errors[] = "Contact messages table: " . mysqli_error($con);
        echo "<p style='color: red;'>✗ Error creating contact_messages table</p>";
    }
} else {
    echo "<p style='color: orange;'>✓ Contact messages table already exists</p>";
    $tables_exist++;
}

// Check and create wishlist table
$check_wishlist = mysqli_query($con, "SHOW TABLES LIKE 'wishlist'");
if(mysqli_num_rows($check_wishlist) == 0) {
    echo "<p>Creating <strong>wishlist</strong> table...</p>";
    $create_wishlist = "CREATE TABLE `wishlist` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `product_id` int(11) NOT NULL,
        `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `user_product` (`user_id`, `product_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    if(mysqli_query($con, $create_wishlist)) {
        echo "<p style='color: green;'>✓ Wishlist table created successfully!</p>";
        $tables_created++;
    } else {
        $errors[] = "Wishlist table: " . mysqli_error($con);
        echo "<p style='color: red;'>✗ Error creating wishlist table</p>";
    }
} else {
    echo "<p style='color: orange;'>✓ Wishlist table already exists</p>";
    $tables_exist++;
}

echo "<hr>";
echo "<h3>Summary</h3>";
echo "<p><strong>Tables created:</strong> $tables_created</p>";
echo "<p><strong>Tables already exist:</strong> $tables_exist</p>";

if(count($errors) > 0) {
    echo "<h4 style='color: red;'>Errors:</h4>";
    echo "<ul>";
    foreach($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color: green; font-size: 18px;'><strong>✓ All tables are ready!</strong></p>";
}

echo "<hr>";
echo "<p><a href='orders.php' style='padding: 10px 20px; background: #2196F3; color: white; text-decoration: none; border-radius: 5px;'>Go to Admin Dashboard</a></p>";
echo "<p><small>You can delete this file after setup is complete.</small></p>";

mysqli_close($con);
?>
