-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2025 at 11:56 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `preloved`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Apparel', '2025-06-03 15:08:58', '2025-06-03 15:08:58'),
(2, 'Bags', '2025-06-03 15:09:58', '2025-06-03 15:09:58'),
(3, 'Shoes', '2025-06-03 15:10:09', '2025-06-03 15:10:09'),
(4, 'Holiday', '2025-06-03 15:10:19', '2025-06-03 15:10:19'),
(5, 'Others', '2025-06-03 15:10:28', '2025-06-03 15:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `buyer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `status` enum('pending','dikirim','selesai','dibatalkan') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_headers`
--

CREATE TABLE `order_headers` (
  `id` int NOT NULL,
  `buyer_id` int NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `status` enum('pending','dibayar','dikirim','selesai','dibatalkan') DEFAULT 'pending',
  `nama_penerima` varchar(100) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_headers`
--

INSERT INTO `order_headers` (`id`, `buyer_id`, `total_amount`, `status`, `nama_penerima`, `alamat`, `telepon`, `created_at`) VALUES
(1, 5, 1000000.00, 'pending', NULL, NULL, NULL, '2025-06-04 19:33:03'),
(2, 5, 700000.00, 'pending', 'asep saepufin', 'kp mars', '089412813', '2025-06-04 19:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `qty` int DEFAULT '1',
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `size`, `qty`, `price`, `subtotal`) VALUES
(1, 1, 5, 'One Size', 1, 1000000.00, 1000000.00),
(2, 2, 6, 'One Size', 1, 700000.00, 700000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `description` text,
  `photo` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_condition` enum('baru','bekas') NOT NULL,
  `status` enum('tersedia','habis','pending') DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `available_sizes` varchar(255) DEFAULT 'One Size'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `title`, `description`, `photo`, `price`, `product_condition`, `status`, `created_at`, `updated_at`, `deleted_at`, `available_sizes`) VALUES
(2, 1, 5, 'Aroma mile', 'aroma enak le', '1748963484_bc87f608e7acf5c8f182.jpg', 18000.00, 'baru', 'tersedia', '2025-06-03 08:11:24', '2025-06-03 08:11:24', NULL, 'One Size'),
(3, 1, 1, ' Stone Island Nylon Metal Flock Hooded Jacket Black', 'jacket', '1749060994_11b93c9788e226645fda.jpg', 9999999.99, 'baru', 'tersedia', '2025-06-04 11:16:34', '2025-06-04 16:08:45', NULL, 'One Size'),
(4, 1, 3, ' Black Stone Island Shoes for Men ', 'sepatu', '1749061190_fae27299df89c8f9cb6c.webp', 1000000.00, 'baru', 'tersedia', '2025-06-04 11:19:50', '2025-06-04 11:19:50', NULL, 'One Size'),
(5, 1, 2, ' Stone Island Patch Waist Bag Black', 'bags', '1749061311_a0454ffadba42734af87.webp', 1000000.00, 'baru', 'tersedia', '2025-06-04 11:21:51', '2025-06-04 11:21:51', NULL, 'One Size'),
(6, 1, 4, ' Stone Island: 40 Years Without Compromise', 'holiday', '1749061461_593c64bdd9dd3527e800.jpg', 7000000.00, 'baru', 'tersedia', '2025-06-04 11:24:21', '2025-06-04 16:08:57', NULL, 'One Size');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`, `photo`) VALUES
(1, 'SinX', '$2y$10$j0Tr3eGeVvqpFtJPKGflxOr7xunUeANb.FkCEprScHXpqdKf2sYB6', 'user', '2025-06-03 05:11:48', '2025-06-05 06:42:47', NULL, '1749130967_efdb1abf66ccab373c39.jpeg'),
(4, 'admin2', '$2y$10$nGgDb/hCX5NJOIBq5W9rw.1i.UFPpHSjbfrVka/wha/aDO/0Z2yBS', 'admin', '2025-06-03 05:28:25', '2025-06-03 12:29:43', NULL, NULL),
(5, 'asep', '$2y$10$lrNwQ/oAB1keCTF61CiJSumdH16NsXyPJAA2Drj3wlwZsyMEsW0x.', 'user', '2025-06-04 11:51:34', '2025-06-04 11:51:34', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_headers`
--
ALTER TABLE `order_headers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_user` (`buyer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_order` (`order_id`),
  ADD KEY `fk_item_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_headers`
--
ALTER TABLE `order_headers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_headers`
--
ALTER TABLE `order_headers`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_item_order` FOREIGN KEY (`order_id`) REFERENCES `order_headers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_item_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
