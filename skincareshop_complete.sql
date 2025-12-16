-- phpMyAdmin SQL Dump
-- Complete Database Schema for SkinCare Shop
-- Database: `skincareshop`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS `skincareshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `skincareshop`;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT '0',
  `address` varchar(256) DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `county` varchar(100) DEFAULT '',
  `postal_code` varchar(20) DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `registration_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123)
INSERT INTO `users` (`id`, `email_id`, `first_name`, `last_name`, `phone`, `address`, `city`, `county`, `postal_code`, `password`, `admin`) VALUES
(1, 'admin@skincareshop.com', 'Admin', 'User', '0742000000', 'Admin Address', 'Timisoara', 'Romania', '300000', '0192023a7bbd73250516f069df18b500', 1);

-- --------------------------------------------------------
-- Table structure for table `products`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 100,
  `category` varchar(50) DEFAULT NULL,
  `skin_type` varchar(50) DEFAULT NULL,
  `volume` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert products
INSERT INTO `products` (`id`, `name`, `brand`, `description`, `price`, `stock`, `category`, `skin_type`, `volume`, `image`) VALUES
(1, 'Cleanser Hidratant', 'La Roche-Posay', 'Cleanser hidratant pentru ten uscat', 59.00, 50, 'cleanser', 'dry', '400 ml', 'cleanser1.jpg'),
(2, 'Ser hidratant', 'RNW', 'Ser hidratant pentru ten uscat', 125.00, 30, 'serum', 'dry', '30 ml', 'ser1.jpg'),
(3, 'Cremă intens hidratantă', 'Rilastil', 'Cremă hidratantă pentru ten uscat', 52.00, 40, 'cream', 'dry', '40 ml', 'crema1.jpg'),
(4, 'SPF cu efect hidratant', 'ISNTREE', 'SPF hidratant pentru ten uscat', 97.00, 35, 'spf', 'dry', '50 ml', 'spf1.jpg'),
(5, 'Cleanser Purifiant', 'Acnemy', 'Cleanser purifiant pentru ten gras', 45.00, 45, 'cleanser', 'oily', '150 ml', 'cleanser2.jpg'),
(6, 'Ser exfoliant', 'Revox', 'Ser exfoliant pentru ten gras', 22.00, 60, 'serum', 'oily', '30 ml', 'ser2.jpg'),
(7, 'Cremă hidratantă', 'Purito', 'Cremă hidratantă pentru ten gras', 101.00, 25, 'cream', 'oily', '50 ml', 'crema2.jpg'),
(8, 'SPF cu efect matifiant', 'SVR', 'SPF matifiant pentru ten gras', 53.00, 40, 'spf', 'oily', '50 ml', 'spf2.jpg'),
(9, 'Cleanser antioxidant', 'Youth To The People', 'Cleanser antioxidant pentru ten mixt', 135.00, 20, 'cleanser', 'combination', '237 ml', 'cleanser3.jpg'),
(10, 'Ser reparator', 'The Ordinary', 'Ser reparator pentru ten mixt', 31.00, 55, 'serum', 'combination', '30 ml', 'ser3.jpg'),
(11, 'Cremă hidratantă', 'Benton', 'Cremă hidratantă pentru ten mixt', 100.00, 30, 'cream', 'combination', '50 ml', 'crema3.jpg'),
(12, 'Spf cu efect hidratant', 'Purito', 'SPF hidratant pentru ten mixt', 100.00, 35, 'spf', 'combination', '60 ml', 'spf3.jpg'),
(13, 'Cleanser reparator', 'CosrX', 'Cleanser reparator pentru ten deshidratat', 45.00, 40, 'cleanser', 'dehydrated', '150 ml', 'cleanser4.jpg'),
(14, 'Ser reparator și hidratant', 'Krave Beauty', 'Ser reparator pentru ten deshidratat', 215.00, 15, 'serum', 'dehydrated', '40 ml', 'ser4.jpg'),
(15, 'Cremă hidratantă și reparatoare', 'La Roche Posay', 'Cremă reparatoare pentru ten deshidratat', 45.00, 50, 'cream', 'dehydrated', '100 ml', 'crema4.jpg'),
(16, 'Spf cu efect hidratant', 'Avene', 'SPF hidratant pentru ten deshidratat', 64.00, 45, 'spf', 'dehydrated', '150 ml', 'spf4.jpg');

-- --------------------------------------------------------
-- Table structure for table `orders`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `products_order` text NOT NULL,
  `order_price` decimal(10,2) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Processing',
  `payment_method` varchar(50) DEFAULT 'Cash on Delivery',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `users_products` (Shopping Cart)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users_products`;
CREATE TABLE `users_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` enum('Added To Cart','Confirmed') NOT NULL DEFAULT 'Added To Cart',
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `users_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_products_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `wishlist`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_product` (`user_id`, `product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `reviews`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `contact_messages`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','read','replied') NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `newsletter_subscribers`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','unsubscribed') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
