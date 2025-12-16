-- Fix for TipCuloare (Color Type) column error
-- This adds the missing column to the products table

USE glowskin;

-- Add TipCuloare column if it doesn't exist
ALTER TABLE products 
ADD COLUMN IF NOT EXISTS TipCuloare VARCHAR(50) DEFAULT NULL COMMENT 'Product color type';

-- You can also update existing products with default values if needed
-- UPDATE products SET TipCuloare = 'Standard' WHERE TipCuloare IS NULL;
