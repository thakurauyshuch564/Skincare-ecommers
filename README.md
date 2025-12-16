# SkinCare Shop - Complete E-commerce System

## 🎯 Project Overview
A complete e-commerce platform for skincare products with comprehensive admin and user panels built with PHP, MySQL, Bootstrap, and jQuery.

## ✨ Features

### 🛍️ User Features
- **Product Browsing**: Browse products by skin type (Dry, Oily, Combination, Dehydrated)
- **Shopping Cart**: Add/remove products, update quantities
- **Wishlist**: Save favorite products for later
- **User Authentication**: Secure login/registration system
- **Order Management**: Place orders, track order history
- **Profile Management**: Update personal information and address
- **Skincare Advice**: Educational content about skincare routines

### 👨‍💼 Admin Features
- **Dashboard**: Overview with statistics (orders, users, revenue, products)
- **Product Management**: Full CRUD operations for products
- **Order Management**: View, update, and track all orders
- **User Management**: View all registered users
- **Reviews Management**: Monitor and moderate product reviews
- **Contact Messages**: View and manage customer inquiries
- **Newsletter Subscribers**: Track newsletter subscriptions

## 📁 Project Structure

```
OnlineSkincareShop/
├── admin/                      # Admin Panel
│   ├── css/
│   │   └── admin.css          # Admin panel styles
│   ├── includes/
│   │   ├── header.php         # Admin header with sidebar
│   │   └── footer.php         # Admin footer
│   ├── dashboard.php          # Admin dashboard
│   ├── login.php              # Admin login page
│   ├── logout.php             # Admin logout
│   ├── products.php           # Product management
│   ├── add_product.php        # Add new product
│   ├── edit_product.php       # Edit product
│   ├── orders.php             # Order management
│   ├── view_order.php         # View order details
│   ├── update_status.php      # Update order status
│   ├── users.php              # User management
│   ├── reviews.php            # Reviews management
│   ├── messages.php           # Contact messages
│   └── newsletter.php         # Newsletter subscribers
├── user/                       # User Panel
│   ├── my_orders.php          # User order history
│   └── wishlist.php           # User wishlist
├── includes/                   # Shared Components
│   ├── common.php             # Database connection
│   ├── header_menu.php        # Main navigation
│   ├── footer.php             # Footer
│   └── check-if-added.php     # Cart validation
├── images/                     # Product images
├── index.php                   # Homepage
├── products.php                # Products page
├── cart.php                    # Shopping cart
├── checkout_form.php           # Checkout page
├── about.php                   # About page
├── advices.php                 # Skincare advice
├── profile.php                 # User profile
├── login_script.php            # Login handler
├── signup_script.php           # Registration handler
├── logout_script.php           # Logout handler
├── cart-add.php                # Add to cart
├── cart-remove.php             # Remove from cart
├── wishlist-add.php            # Add to wishlist
├── process.php                 # Order processing
├── success.php                 # Order success page
├── style.css                   # Main stylesheet
├── main.js                     # JavaScript functions
└── skincareshop_complete.sql   # Complete database schema
```

## 🗄️ Database Schema

### Tables
1. **users** - User accounts (customers and admins)
2. **products** - Product catalog with details
3. **orders** - Customer orders
4. **users_products** - Shopping cart items
5. **wishlist** - User wishlists
6. **reviews** - Product reviews
7. **contact_messages** - Contact form submissions
8. **newsletter_subscribers** - Newsletter subscriptions

## 🚀 Installation Guide

### Prerequisites
- XAMPP (or any PHP/MySQL server)
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Step 1: Setup Files
1. Copy the `OnlineSkincareShop` folder to `C:\xampp\htdocs\SkincareShop-main\`
2. Ensure all files are in place

### Step 2: Database Setup
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create a new database named `skincareshop`
3. Import the SQL file:
   - Click on the `skincareshop` database
   - Go to "Import" tab
   - Choose file: `skincareshop_complete.sql`
   - Click "Go" to import

### Step 3: Configuration
The database connection is already configured in `includes/common.php`:
```php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "skincareshop";
```

### Step 4: Access the Application

**User Website:**
- URL: http://localhost/SkincareShop-main/OnlineSkincareShop/
- Register a new account or use existing credentials

**Admin Panel:**
- URL: http://localhost/SkincareShop-main/OnlineSkincareShop/admin/
- Default Admin Credentials:
  - Email: `admin@skincareshop.com`
  - Password: `admin123`

## 🔐 Default Accounts

### Admin Account
- **Email**: admin@skincareshop.com
- **Password**: admin123
- **Role**: Administrator

### Creating New Admin
To create a new admin user:
1. Register a normal user account
2. Go to phpMyAdmin
3. Find the user in the `users` table
4. Change the `admin` column value from `0` to `1`

## 📋 User Guide

### For Customers

#### Registration & Login
1. Click "Sign In" in the navigation
2. Fill in your details (email, password, name)
3. Click "Submit" to create account
4. Login with your credentials

#### Shopping
1. Browse products by skin type
2. Click "Adaugă în coș" (Add to Cart)
3. View cart by clicking cart icon
4. Update quantities or remove items
5. Click "Confirmă Comanda" (Confirm Order)
6. Fill in delivery details
7. Submit order

#### Wishlist
1. Browse products
2. Click heart icon to add to wishlist
3. Access wishlist from "Wishlist" menu
4. Move items to cart or remove them

#### Order Tracking
1. Click "My Orders" in navigation
2. View all your orders with status
3. Track order progress (Processing/Done)

### For Administrators

#### Dashboard
- View key statistics
- Monitor recent orders
- Quick access to all sections

#### Product Management
1. Go to "Products" section
2. Click "Add New Product" to create
3. Fill in product details (name, brand, price, stock, etc.)
4. Click "Edit" icon to modify existing products
5. Click "Delete" icon to remove products

#### Order Management
1. Go to "Orders" section
2. Filter by status (All/Processing/Done)
3. Click "View" to see order details
4. Click "Update Status" to change order status
5. Update customer about order progress

#### User Management
1. Go to "Users" section
2. View all registered users
3. Check registration dates and login activity

## 🎨 Customization

### Changing Colors
Edit `style.css` and `admin/css/admin.css`:
```css
:root {
    --primary-color: #667eea;  /* Change this */
    --secondary-color: #764ba2; /* Change this */
}
```

### Adding Products
1. Upload product image to `/images/` folder
2. Login to admin panel
3. Go to Products > Add New Product
4. Fill in details and image filename
5. Save product

### Modifying Email Templates
Edit the respective PHP files:
- Order confirmation: `success.php`
- Newsletter: `includes/footer.php`

## 🔧 Troubleshooting

### Database Connection Error
- Check if MySQL is running in XAMPP
- Verify database name is `skincareshop`
- Check credentials in `includes/common.php`

### Admin Panel Not Loading
- Clear browser cache
- Check if admin session is set
- Verify admin login credentials

### Products Not Showing
- Check if products exist in database
- Verify image files are in `/images/` folder
- Check product stock is not 0

### Cart Not Working
- Ensure user is logged in
- Check session is active
- Verify `users_products` table exists

## 🛡️ Security Notes

### Current Implementation
- MD5 password hashing (basic)
- SQL injection protection with `mysqli_real_escape_string()`
- Session-based authentication

### Recommended Improvements
1. **Password Hashing**: Upgrade from MD5 to `password_hash()` and `password_verify()`
2. **Prepared Statements**: Use prepared statements for all database queries
3. **HTTPS**: Enable SSL certificate for production
4. **CSRF Protection**: Add CSRF tokens to forms
5. **Input Validation**: Add comprehensive server-side validation

## 📱 Browser Compatibility
- Chrome (Latest)
- Firefox (Latest)
- Safari (Latest)
- Edge (Latest)
- Mobile browsers (Responsive design)

## 🌐 Technologies Used
- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 4.1.3
- **Icons**: Font Awesome 5.15.4
- **jQuery**: 3.3.1

## 📞 Support & Contact
For issues or questions about this project, please check:
1. Database connection settings
2. File permissions
3. PHP error logs in XAMPP

## 📝 License
This project is for educational purposes.

## 🎉 Credits
- **Developer**: Patricia Ruhstrat
- **Project**: SkinCare Shop E-commerce Platform
- **Year**: 2021-2025

---

**Happy Shopping! 🛍️**
  



  admin@skincareshop.com
  admin123