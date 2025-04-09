-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 07:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_iscon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT 'images/avatar/user-1.png',
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `profile_image`, `reset_token`, `token_expire`) VALUES
(3, 'admin', 'admin@gmail.com', '$2y$10$O8ZMRxaEfqRuEEzLZNA0yeMSP14sdD262U.ZVBe9rHhL5nYeK/GpO', 'images/avatar/user-1.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('published','draft') DEFAULT 'published'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `excerpt`, `author`, `created_at`, `updated_at`, `status`) VALUES
(4, 'ggghgf', 'hghhhh  bnxvnnn gnhjhjj    jhhgghhhhhhh  xnnnnnnnnnnnnnhhhhhhhhmm  hjhgggggggggggggggm hgjdgjjyujty hyttytuuuyum ghhfhhhghfh hghdjj  hghhhh  bnxvnnn gnhjhjj    jhhgghhhhhhh  xnnnnnnnnnnnnnhhhhhhhhmm hjhgggggggggggggggm hgjdgjjyujty hyttytuuuyum ghhfhhhghfh hghdjj hghhhh  bnxvnnn gnhjhjj    jhhgghhhhhhh  xnnnnnnnnnnnnnhhhhhhhhmm hjhgggggggggggggggm hgjdgjjyujty hyttytuuuyum ghhfhhhghfh hghdjj', 'hghhhh  bnxvnnn gnhjhjj    jhhgghhhhhhh  xnnnnnnnnnnnnnhhhhhhhhmm  hjhgggggggggggggggm hgjdgjjyujty hyttytuuuyum ghhfhhhghfh hghdjj  hghhhh  bnxvnnn gnhjhjj    jhhgghhhhhhh  xnnnnnnnnnnnnnhhhhhhhhmm hjhgggggggggggggggm hgjdgjjyujty hyttytuuuyum ghhfhhhghfh hghdjj hghhhh  bnxvnnn gnhjhjj    jhhgghhhhhhh  xnnnnnnnnnnnnnhhhhhhhhmm hjhgggggggggggggggm hgjdgjjyujty hyttytuuuyum ghhfhhhghfh hghdjj', 'mr .aaa vvbvb', '2025-04-03 09:25:50', '2025-04-03 09:25:50', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `blog_images`
--

CREATE TABLE `blog_images` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_images`
--

INSERT INTO `blog_images` (`id`, `blog_id`, `image_path`, `is_featured`, `created_at`) VALUES
(18, 4, 'uploads/blog/1743672350_6a5468ff4d3596acb8c9b03440e1b6b7.jpg', 0, '2025-04-03 09:25:50'),
(19, 4, 'uploads/blog/1743672350_b6a83a60a3d08b96533e8d83fc7ee8e6.jpg', 0, '2025-04-03 09:25:50'),
(20, 4, 'uploads/blog/1743672350_Thanos helmet_crown 3.146 (2)-Photoroom.png', 0, '2025-04-03 09:25:50'),
(21, 4, 'uploads/blog/1743672350_Thanos helmet_crown 3.146 (2).jpg', 1, '2025-04-03 09:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `main_category` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `main_category`, `subcategory`, `unit_id`, `quantity`, `created_at`, `updated_at`) VALUES
(31, 4, 5, 'Clothing', 'Dhoti', 23, 1, '2025-04-09 05:40:41', '2025-04-09 05:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `main_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `main_category`) VALUES
(6, 'Gifts'),
(7, 'Clothing'),
(8, 'Sale'),
(9, 'Donate'),
(10, 'Festivals');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `checkout_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `user_id`, `product_id`, `quantity`, `unit_price`, `total_price`, `checkout_date`, `status`) VALUES
(7, 4, 5, 4, 345.00, 1380.00, '2025-04-09 05:37:50', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `address1` text NOT NULL,
  `address2` text DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `order_notes` text DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `first_name`, `last_name`, `email`, `company`, `country`, `address1`, `address2`, `city`, `zip`, `phone`, `order_notes`, `subtotal`, `tax`, `shipping`, `total`, `payment_status`, `created_at`) VALUES
(1, 2, 5, 'jayshri', 'kale', 'jayshrikale459@gmail.com', 'vedh', 'india', 'katraj', 'pune', 'pune', '1234', '7654321234', 'hjghjhj gh jghjnmhggggggggggg ghghghgggggggb nmnmbnmcjkjj hjgjgh', 690.00, 0.00, 0.00, 690.00, 'Pending', '2025-04-08 11:36:05'),
(2, 2, 5, 'jayshri', 'kale', 'jayshrikale459@gmail.com', 'vedh', 'india', 'katraj', 'pune', 'pune', '1234', '7654321234', 'hghfghfghfg hghjjhjh', 1035.00, 0.00, 0.00, 1035.00, 'Pending', '2025-04-08 12:25:32'),
(3, 4, 5, 'jayshri', 'kale', 'jayshrikale459@gmail.com', 'vedh', 'India', 'hjdghjghjgh', 'hjghjdghhhhhhhhhhhh', 'hjghjdgh', '3455', '8765432143', 'hxhnjnjjjjjjjjjj hjjjjjjjjjjjjjjjjjjjjjjjjjjj hnxhgkjkxh mjxfghbdrg hfxgbhfg fgjh,jbnmjm hgjghjgh', 1380.00, 0.00, 0.00, 1380.00, 'Pending', '2025-04-09 05:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_status` enum('pending','complete') DEFAULT 'pending',
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `amount`, `payment_id`, `payment_status`, `added_on`) VALUES
(1, '2', 690.00, 'pay_QGY6gsln3pdmZS', 'complete', '2025-04-08 13:36:05'),
(2, '2', 1035.00, 'pay_QGYwfdo9Qr3mM0', 'complete', '2025-04-08 14:25:32'),
(3, '4', 1380.00, 'pay_QGqYQCE7To55Rp', 'complete', '2025-04-09 07:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `main_category` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `availability` varchar(50) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `dimensions` varchar(100) DEFAULT NULL,
  `country_origin` varchar(100) DEFAULT NULL,
  `source_type` varchar(100) DEFAULT NULL,
  `container_type` varchar(100) DEFAULT NULL,
  `has_multiple_units` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `main_category`, `subcategory`, `description`, `availability`, `weight`, `dimensions`, `country_origin`, `source_type`, `container_type`, `has_multiple_units`, `created_at`, `updated_at`) VALUES
(5, 'dhotiiiii white', 'Clothing', 'Dhoti', 'Clothing, encompassing garments and attire, serves various purposes like protection, modesty, and adornment, and can be made from diverse materials like fabrics, animal skins, or natural products. ', 'In Stock', '1000', '100*100*100', 'India', 'Source Type', 'Container Type', 1, '2025-04-05 09:22:35', '2025-04-05 09:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`) VALUES
(25, 5, 'uploads/products/1743844955_0_shopping (3).webp', '2025-04-05 09:22:35'),
(26, 5, 'uploads/products/1743844955_1_shopping (2).webp', '2025-04-05 09:22:35'),
(27, 5, 'uploads/products/1743844955_2_shopping (1).webp', '2025-04-05 09:22:35'),
(28, 5, 'uploads/products/1743844955_3_shopping.webp', '2025-04-05 09:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_units`
--

CREATE TABLE `product_units` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_value` varchar(50) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_units`
--

INSERT INTO `product_units` (`id`, `product_id`, `unit_value`, `unit_type`, `price`, `created_at`) VALUES
(23, 5, '1', 'gram', 345.00, '2025-04-05 09:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `category_name`, `subcategory_name`) VALUES
(6, 6, 'Gifts', 'Frames'),
(7, 7, 'Clothing', 'Dhoti'),
(8, 8, 'Sale', 'Gift Combo'),
(9, 9, 'Donate', 'Dummy'),
(10, 10, 'Festivals', 'Guru pornima');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `city`, `state`, `pincode`, `newsletter`, `created_at`, `updated_at`) VALUES
(4, 'jayshri', 'kale', 'jayshrikale459@gmail.com', '$2y$10$73NP8O/5/ZtW.fznOqJpUeSr4//4xZLwOmXrbGUeDp5jZOekjczPq', NULL, NULL, NULL, NULL, NULL, 1, '2025-04-09 05:18:22', '2025-04-09 05:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `user_id`, `created_at`) VALUES
(62, 5, '2', '2025-04-07 11:18:14'),
(64, 5, '4', '2025-04-09 05:40:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_images`
--
ALTER TABLE `blog_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_units`
--
ALTER TABLE `product_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_subcategory` (`category_id`,`subcategory_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_product_session` (`product_id`,`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_images`
--
ALTER TABLE `blog_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_units`
--
ALTER TABLE `product_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_images`
--
ALTER TABLE `blog_images`
  ADD CONSTRAINT `blog_images_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `product_units` (`id`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `checkout_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_units`
--
ALTER TABLE `product_units`
  ADD CONSTRAINT `product_units_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
