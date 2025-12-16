<?php
require "includes/common.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Features Test</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .test-section { background: white; padding: 20px; margin: 20px 0; border-radius: 10px; }
        .success { color: green; }
        .error { color: red; }
        .warning { color: orange; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #667eea; color: white; }
        .btn { display: inline-block; padding: 10px 20px; margin: 5px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>🧪 User Features Test - Glowskin Database</h1>
    
    <!-- Database Connection -->
    <div class="test-section">
        <h2>✅ Database Connection</h2>
        <p class="success">Connected to: <strong>glowskin</strong></p>
    </div>
    
    <!-- Check Tables -->
    <div class="test-section">
        <h2>📊 Required Tables Status</h2>
        <?php
        $required_tables = ['users', 'products', 'orders', 'cart'];
        echo "<table>";
        echo "<tr><th>Table Name</th><th>Status</th><th>Row Count</th></tr>";
        foreach($required_tables as $table){
            $check = mysqli_query($con, "SHOW TABLES LIKE '$table'");
            if(mysqli_num_rows($check) > 0){
                $count_result = mysqli_query($con, "SELECT COUNT(*) as cnt FROM $table");
                $count = mysqli_fetch_assoc($count_result)['cnt'];
                echo "<tr><td>$table</td><td class='success'>✓ EXISTS</td><td>$count rows</td></tr>";
            } else {
                echo "<tr><td>$table</td><td class='error'>✗ MISSING</td><td>-</td></tr>";
            }
        }
        echo "</table>";
        ?>
    </div>
    
    <!-- Users Table Structure -->
    <div class="test-section">
        <h2>👤 Users Table Structure</h2>
        <?php
        $columns = mysqli_query($con, "DESCRIBE users");
        echo "<table>";
        echo "<tr><th>Column</th><th>Type</th><th>Null</th><th>Key</th></tr>";
        while($col = mysqli_fetch_assoc($columns)){
            echo "<tr>";
            echo "<td><strong>" . $col['Field'] . "</strong></td>";
            echo "<td>" . $col['Type'] . "</td>";
            echo "<td>" . $col['Null'] . "</td>";
            echo "<td>" . $col['Key'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
    
    <!-- Test Users -->
    <div class="test-section">
        <h2>👥 Existing Users</h2>
        <?php
        $users = mysqli_query($con, "SELECT id, name, email, role FROM users LIMIT 10");
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";
        while($user = mysqli_fetch_assoc($users)){
            $role_color = ($user['role'] == 'admin') ? 'red' : 'blue';
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['name'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td style='color:$role_color;'><strong>" . strtoupper($user['role']) . "</strong></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
    
    <!-- Test Products -->
    <div class="test-section">
        <h2>📦 Products Available</h2>
        <?php
        $products = mysqli_query($con, "SELECT id, name, brand, price, stock FROM products LIMIT 5");
        if(mysqli_num_rows($products) > 0){
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Brand</th><th>Price</th><th>Stock</th></tr>";
            while($product = mysqli_fetch_assoc($products)){
                echo "<tr>";
                echo "<td>" . $product['id'] . "</td>";
                echo "<td>" . $product['name'] . "</td>";
                echo "<td>" . $product['brand'] . "</td>";
                echo "<td>" . number_format($product['price'], 2) . " Lei</td>";
                echo "<td>" . $product['stock'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='warning'>⚠️ No products found. Import the SQL file to add sample products.</p>";
        }
        ?>
    </div>
    
    <!-- Feature Links -->
    <div class="test-section">
        <h2>🔗 Test User Features</h2>
        <p><strong>Before testing, make sure you're logged in!</strong></p>
        <a href="index.php" class="btn">🏠 Home Page</a>
        <a href="products.php" class="btn">🛍️ Products Page</a>
        <a href="cart.php" class="btn">🛒 Shopping Cart</a>
        <a href="profile.php" class="btn">👤 My Profile</a>
        <a href="user/my_orders.php" class="btn">📦 My Orders</a>
        <a href="user/wishlist.php" class="btn">❤️ Wishlist</a>
    </div>
    
    <!-- Login Credentials -->
    <div class="test-section">
        <h2>🔐 Test Login Credentials</h2>
        <h3>Admin Account:</h3>
        <p><strong>Email:</strong> admin@skincareshop.com<br>
        <strong>Password:</strong> admin123</p>
        
        <h3>Create New User:</h3>
        <p>Go to homepage and click "Sign In" to register a new user account.</p>
    </div>
    
    <!-- Missing Cart Table Warning -->
    <?php
    $cart_check = mysqli_query($con, "SHOW TABLES LIKE 'cart'");
    if(mysqli_num_rows($cart_check) == 0):
    ?>
    <div class="test-section" style="border: 2px solid red;">
        <h2 class="error">⚠️ IMPORTANT: Cart Table Missing!</h2>
        <p>The <strong>cart</strong> table doesn't exist. The system uses <strong>users_products</strong> table for cart.</p>
        <p>Creating cart table now...</p>
        <?php
        $create_cart = "CREATE TABLE IF NOT EXISTS `cart` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL,
          `item_id` int(11) NOT NULL,
          `quantity` int(11) NOT NULL DEFAULT 1,
          `status` enum('Added To Cart','Confirmed') NOT NULL DEFAULT 'Added To Cart',
          `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
          PRIMARY KEY (`id`),
          KEY `user_id` (`user_id`),
          KEY `item_id` (`item_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        if(mysqli_query($con, $create_cart)){
            echo "<p class='success'>✓ Cart table created successfully!</p>";
        } else {
            echo "<p class='error'>✗ Error creating cart table: " . mysqli_error($con) . "</p>";
        }
        
        // Also create users_products as alias
        $create_users_products = "CREATE TABLE IF NOT EXISTS `users_products` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL,
          `item_id` int(11) NOT NULL,
          `quantity` int(11) NOT NULL DEFAULT 1,
          `status` enum('Added To Cart','Confirmed') NOT NULL DEFAULT 'Added To Cart',
          `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
          PRIMARY KEY (`id`),
          KEY `user_id` (`user_id`),
          KEY `item_id` (`item_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        if(mysqli_query($con, $create_users_products)){
            echo "<p class='success'>✓ users_products table created successfully!</p>";
        }
        ?>
    </div>
    <?php endif; ?>
    
    <div class="test-section">
        <h2>✅ Next Steps</h2>
        <ol>
            <li>Go to <a href="index.php">Homepage</a></li>
            <li>Click "Sign In" to register a new user</li>
            <li>Or click "Login" to login with existing account</li>
            <li>Browse products and add to cart</li>
            <li>Test checkout process</li>
            <li>Check profile, orders, and wishlist</li>
        </ol>
    </div>
    
</body>
</html>
