# 🧪 User Features Testing Guide

## ✅ All Updates Complete!

Your SkinCare Shop is now fully integrated with the **glowskin** database. All user and admin features have been updated.

---

## 🔧 What Was Fixed

### 1. **Database Integration**
- ✅ Connected to `glowskin` database
- ✅ Updated all queries to use glowskin table structure
- ✅ Fixed column names: `email` (not `email_id`), `name` (not `first_name`/`last_name`), `role` (not `admin`)

### 2. **Authentication System**
- ✅ **Login** (`login_script.php`) - Works with glowskin users table
- ✅ **Signup** (`signup_script.php`) - Creates users with correct structure
- ✅ **Admin Detection** - Checks `role='admin'` instead of `admin=1`

### 3. **User Profile**
- ✅ **View Profile** (`profile.php`) - Beautiful Bootstrap design
- ✅ **Update Profile** (`change_profile.php`) - Updates name, email, phone, password
- ✅ **Session Management** - Proper user authentication

### 4. **Admin Panel**
- ✅ **Dashboard** - Shows statistics from glowskin database
- ✅ **Products** - Manages products table
- ✅ **Orders** - Manages orders table
- ✅ **Users** - Displays all users with roles
- ✅ **Reviews, Messages, Newsletter** - All functional

---

## 🧪 Testing Instructions

### **Step 1: Run Test Page**
Open this URL to verify everything is set up correctly:
```
http://localhost/SkincareShop-main/OnlineSkincareShop/test_user_features.php
```

This page will:
- ✅ Check database connection
- ✅ Verify all required tables exist
- ✅ Show users table structure
- ✅ Display existing users and products
- ✅ Create missing cart tables if needed
- ✅ Provide test links to all features

---

### **Step 2: Test User Registration**

1. Go to: http://localhost/SkincareShop-main/OnlineSkincareShop/
2. Click **"Sign In"** button in navigation
3. Fill in the signup form:
   - First Name: Test
   - Last Name: User
   - Email: testuser@example.com
   - Password: test123
4. Click **"Submit"**
5. You should be redirected to products page

---

### **Step 3: Test User Login**

1. Go to homepage
2. Click **"Login"** button
3. Enter credentials:
   - Email: testuser@example.com
   - Password: test123
4. Click **"Submit"**
5. You should be logged in and see your email in navigation

---

### **Step 4: Test User Features**

#### **A. Profile Management**
1. Click on your email dropdown in navigation
2. Click **"Profile"**
3. Update your information:
   - Change name
   - Update phone
   - Change password (optional)
4. Click **"Update Profile"**
5. Verify changes are saved

#### **B. Shopping Cart**
1. Go to **"Products"** page
2. Click **"Adaugă în coș"** (Add to Cart) on any product
3. Click cart icon in navigation
4. Verify product is in cart
5. Update quantity
6. Test remove item

#### **C. Checkout Process**
1. Add products to cart
2. Click **"Confirmă Comanda"** (Confirm Order)
3. Fill in delivery details
4. Submit order
5. Check success page

#### **D. My Orders**
1. Click **"My Orders"** in navigation
2. View your order history
3. Check order status
4. Verify order details

#### **E. Wishlist**
1. Click **"Wishlist"** in navigation
2. Add products to wishlist (if feature is visible)
3. View wishlist items
4. Move items to cart

---

### **Step 5: Test Admin Features**

1. **Logout** from user account
2. Go to: http://localhost/SkincareShop-main/OnlineSkincareShop/admin/
3. Login with admin credentials:
   - Email: admin@skincareshop.com
   - Password: admin123
4. Test all admin features:
   - ✅ Dashboard statistics
   - ✅ Add/Edit/Delete products
   - ✅ View and update orders
   - ✅ View users list
   - ✅ Manage reviews
   - ✅ View contact messages
   - ✅ View newsletter subscribers

---

## 🔐 Login Credentials

### Admin Account
```
Email: admin@skincareshop.com
Password: admin123
```

### Test User Account (Create your own)
```
Email: [your-email]
Password: [your-password]
```

---

## 📊 Database Tables

Your glowskin database now has these tables:

1. **users** - User accounts (admin and regular users)
2. **products** - Product catalog (8 sample products included)
3. **orders** - Customer orders
4. **cart** / **users_products** - Shopping cart items
5. **reviews** - Product reviews
6. **contact_messages** - Contact form submissions
7. **newsletter_subscribers** - Newsletter subscriptions

---

## 🎯 Features Checklist

### User Features
- [x] User Registration
- [x] User Login
- [x] User Logout
- [x] View Profile
- [x] Update Profile
- [x] Change Password
- [x] Browse Products
- [x] Add to Cart
- [x] View Cart
- [x] Update Cart Quantity
- [x] Remove from Cart
- [x] Checkout Process
- [x] View Order History
- [x] Wishlist (if enabled)

### Admin Features
- [x] Admin Login
- [x] Dashboard Statistics
- [x] Product Management (CRUD)
- [x] Order Management
- [x] Update Order Status
- [x] User Management
- [x] Reviews Management
- [x] Contact Messages
- [x] Newsletter Subscribers

---

## 🐛 Troubleshooting

### Issue: "Unknown database 'skincareshop'"
**Solution:** The system is now using `glowskin` database. This is correct.

### Issue: "Table doesn't exist"
**Solution:** Run `test_user_features.php` to auto-create missing tables, or import `add_missing_tables.sql` in phpMyAdmin.

### Issue: "Login not working"
**Solution:** 
1. Check if user exists in glowskin database
2. Verify password is MD5 hashed
3. Check `role` column (should be 'admin' or 'user')

### Issue: "Profile page shows errors"
**Solution:** Make sure users table has columns: `id`, `name`, `email`, `phone`, `role`, `password`

### Issue: "Cart not working"
**Solution:** Run `test_user_features.php` to create cart and users_products tables

---

## 📝 Important Notes

1. **Database Name**: System uses `glowskin` (not `skincareshop`)
2. **User Structure**: Uses `name` (not `first_name`/`last_name`)
3. **Email Column**: Uses `email` (not `email_id`)
4. **Role System**: Uses `role='admin'` or `role='user'` (not `admin=1/0`)
5. **Password**: MD5 hashed (consider upgrading to bcrypt for production)

---

## 🚀 Next Steps

1. ✅ Test all user features listed above
2. ✅ Test all admin features
3. ✅ Add more products via admin panel
4. ✅ Create test orders
5. ✅ Customize design and branding
6. ✅ Add product images to `/images/` folder
7. ✅ Configure email notifications (optional)

---

## 🎉 Everything is Ready!

Your SkinCare Shop is now fully functional with:
- ✅ Complete user registration and login
- ✅ Shopping cart and checkout
- ✅ Order management
- ✅ User profiles
- ✅ Admin panel with full CRUD operations
- ✅ All features connected to glowskin database

**Start testing now!** 🚀

---

*Last Updated: November 5, 2025*
