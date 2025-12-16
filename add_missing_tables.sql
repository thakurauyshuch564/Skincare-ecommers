-- Add missing tables to glowskin database
-- Run this in phpMyAdmin

USE glowskin;

-- Create products table
CREATE TABLE IF NOT EXISTS `products` (
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

-- Create orders table
CREATE TABLE IF NOT EXISTS `orders` (
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

-- Create reviews table
CREATE TABLE IF NOT EXISTS `reviews` (
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

-- Create contact_messages table
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','read','replied') NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create newsletter_subscribers table
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','unsubscribed') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample products
INSERT INTO `products` (`id`, `name`, `brand`, `description`, `price`, `stock`, `category`, `skin_type`, `volume`, `image`) VALUES
(1, 'Cleanser Hidratant', 'La Roche-Posay', 'Cleanser hidratant pentru ten uscat', 59.00, 50, 'cleanser', 'dry', '400 ml', 'cleanser1.jpg'),
(2, 'Ser hidratant', 'RNW', 'Ser hidratant pentru ten uscat', 125.00, 30, 'serum', 'dry', '30 ml', 'ser1.jpg'),
(3, 'Cremă intens hidratantă', 'Rilastil', 'Cremă hidratantă pentru ten uscat', 52.00, 40, 'cream', 'dry', '40 ml', 'crema1.jpg'),
(4, 'SPF cu efect hidratant', 'ISNTREE', 'SPF hidratant pentru ten uscat', 97.00, 35, 'spf', 'dry', '50 ml', 'spf1.jpg'),
(5, 'Cleanser Purifiant', 'Acnemy', 'Cleanser purifiant pentru ten gras', 45.00, 45, 'cleanser', 'oily', '150 ml', 'cleanser2.jpg'),
(6, 'Ser exfoliant', 'Revox', 'Ser exfoliant pentru ten gras', 22.00, 60, 'serum', 'oily', '30 ml', 'ser2.jpg'),
(7, 'Cremă hidratantă', 'Purito', 'Cremă hidratantă pentru ten gras', 101.00, 25, 'cream', 'oily', '50 ml', 'crema2.jpg'),
(8, 'SPF cu efect matifiant', 'SVR', 'SPF matifiant pentru ten gras', 53.00, 40, 'spf', 'oily', '50 ml', 'spf2.jpg');
