-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 28, 2019 at 03:22 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Rollex', 'Rollex Watches', '1566879278.png', '2019-08-26 22:14:38', '2019-08-26 22:14:38'),
(2, 'Apex', 'All apex shoes', NULL, '2019-08-27 20:43:18', '2019-08-27 20:43:18'),
(3, 'Bata', NULL, NULL, '2019-08-27 20:43:26', '2019-08-27 20:43:26'),
(4, 'Lotto', NULL, NULL, '2019-08-27 20:43:35', '2019-08-27 20:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'Electronics Electronics Electronics', '1566879301.png', NULL, '2019-08-26 22:15:01', '2019-08-26 22:15:01'),
(2, 'Watch', 'ElectronicsElectronicsElectronicsElectronicsElectronics', '1566879315.jpg', 1, '2019-08-26 22:15:16', '2019-08-26 22:15:16'),
(3, 'Fashion', NULL, '1566960007.jpg', NULL, '2019-08-27 20:39:32', '2019-08-27 20:40:08'),
(4, 'Shoes', NULL, '1566960031.jpg', 3, '2019-08-27 20:40:31', '2019-08-27 20:40:31'),
(5, 'Shirts', NULL, '1566960048.jpg', 3, '2019-08-27 20:40:48', '2019-08-27 20:40:48'),
(6, 'Mobiles', NULL, '1566960084.png', 1, '2019-08-27 20:41:24', '2019-08-27 20:41:24'),
(7, 'Education', NULL, '1566960114.png', NULL, '2019-08-27 20:41:54', '2019-08-27 20:41:54'),
(8, 'Calculators', NULL, '1566960139.png', 7, '2019-08-27 20:42:19', '2019-08-27 20:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_division_id_foreign` (`division_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 1, '2019-08-26 22:14:01', '2019-08-26 22:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 1, '2019-08-26 22:13:45', '2019-08-26 22:13:45'),
(2, 'Rajshahi', 2, '2019-08-26 22:13:53', '2019-08-26 22:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_05_045544_create_categories_table', 1),
(4, '2019_08_05_045818_create_brands_table', 1),
(5, '2019_08_05_045957_create_products_table', 1),
(6, '2019_08_05_050214_create_admins_table', 1),
(7, '2019_08_05_051554_create_product_images_table', 1),
(8, '2019_08_16_040233_create_divisions_table', 1),
(9, '2019_08_16_040348_create_districts_table', 1),
(34, '2019_08_27_062436_create_ordered_products_table', 3),
(12, '2019_08_19_042941_create_settings_table', 1),
(13, '2019_08_19_050152_create_payments_table', 1),
(31, '2019_08_18_112511_create_carts_table', 2),
(30, '2019_08_18_111440_create_orders_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

DROP TABLE IF EXISTS `ordered_products`;
CREATE TABLE IF NOT EXISTS `ordered_products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ordered_products_order_id_foreign` (`order_id`),
  KEY `ordered_products_product_id_foreign` (`product_id`),
  KEY `ordered_products_product_quantity_foreign` (`product_quantity`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `order_id`, `product_id`, `product_quantity`, `created_at`, `updated_at`) VALUES
(18, 17, 4, 1, '2019-08-27 20:55:06', '2019-08-27 20:55:06'),
(17, 17, 8, 1, '2019-08-27 20:55:06', '2019-08-27 20:55:06'),
(16, 17, 6, 1, '2019-08-27 20:55:06', '2019-08-27 20:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `is_seen_by_admin` tinyint(1) NOT NULL DEFAULT '0',
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charge` int(11) NOT NULL DEFAULT '60',
  `custom_discount` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_payment_id_foreign` (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_id`, `ip_address`, `email`, `name`, `phone_no`, `shipping_address`, `message`, `is_paid`, `is_completed`, `is_seen_by_admin`, `transaction_id`, `shipping_charge`, `custom_discount`, `created_at`, `updated_at`) VALUES
(17, 1, 1, '127.0.0.1', 'akash.cse.diu@gmail.com', 'Shohanur Rahman Akash', '01912885974', 'Sector 5, Uttara, Dhaka', NULL, 1, 1, 1, NULL, 60, 0, '2019-08-27 20:55:06', '2019-08-27 20:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT '1',
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Payment Number',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Agent|Personal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_short_name_unique` (`short_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `image`, `priority`, `short_name`, `no`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Cash In Delivery', 'cash_in.jpg', 1, 'cash_in', NULL, NULL, NULL, NULL),
(2, 'Bkash', 'bkash.jpg', 1, 'bkash', NULL, NULL, NULL, NULL),
(3, 'Rocket', 'rocket.jpg', 1, 'rocket', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `offer_price` int(11) DEFAULT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `title`, `description`, `slug`, `quantity`, `price`, `status`, `offer_price`, `admin_id`, `created_at`, `updated_at`) VALUES
(3, 4, 3, 'Ladies Shoe', 'Brand new bata lady shoe', 'ladies-shoe', 10, 120, 0, NULL, 1, '2019-08-27 20:44:14', '2019-08-27 20:44:14'),
(4, 4, 4, 'Sports Shoe', 'Brand new shoe', 'sports-shoe', 10, 150, 0, NULL, 1, '2019-08-27 20:44:48', '2019-08-27 20:44:48'),
(5, 8, 1, 'Calculator', 'Helpful for study', 'casio-calculator', 15, 80, 0, NULL, 1, '2019-08-27 20:46:24', '2019-08-27 20:46:48'),
(6, 2, 1, 'Handwatch', 'Brand new watch', 'handwatch', 10, 150, 0, NULL, 1, '2019-08-27 20:47:33', '2019-08-27 20:47:33'),
(7, 2, 1, 'Rollex', 'Rollex watch', 'rollex', 5, 120, 0, NULL, 1, '2019-08-27 20:48:54', '2019-08-27 20:48:54'),
(8, 5, 4, 'Cotton Shirt', 'Brand new shirt', 'cotton-shirt', 5, 50, 0, NULL, 1, '2019-08-27 20:50:36', '2019-08-27 20:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, '1566879448.jpg', '2019-08-26 22:17:28', '2019-08-26 22:17:28'),
(2, 1, '1566879448.jpg', '2019-08-26 22:17:28', '2019-08-26 22:17:28'),
(3, 2, '1566888011.jpg', '2019-08-27 00:40:11', '2019-08-27 00:40:11'),
(4, 2, '1566888011.jpg', '2019-08-27 00:40:11', '2019-08-27 00:40:11'),
(5, 3, '1566960254.jpg', '2019-08-27 20:44:15', '2019-08-27 20:44:15'),
(6, 3, '1566960255.jpg', '2019-08-27 20:44:15', '2019-08-27 20:44:15'),
(7, 4, '1566960288.jpg', '2019-08-27 20:44:48', '2019-08-27 20:44:48'),
(8, 5, '1566960384.png', '2019-08-27 20:46:24', '2019-08-27 20:46:24'),
(9, 5, '1566960385.png', '2019-08-27 20:46:25', '2019-08-27 20:46:25'),
(10, 6, '1566960453.jpg', '2019-08-27 20:47:33', '2019-08-27 20:47:33'),
(11, 6, '1566960453.jpg', '2019-08-27 20:47:33', '2019-08-27 20:47:33'),
(12, 7, '1566960534.jpg', '2019-08-27 20:48:54', '2019-08-27 20:48:54'),
(13, 7, '1566960534.jpg', '2019-08-27 20:48:54', '2019-08-27 20:48:54'),
(14, 8, '1566960636.jpg', '2019-08-27 20:50:36', '2019-08-27 20:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` int(10) UNSIGNED NOT NULL DEFAULT '100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `phone_no`, `address`, `shipping_cost`, `created_at`, `updated_at`) VALUES
(1, 'akash.cse.diu@gmail.com', '01912885974', 'sector 5, uttara', 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL COMMENT 'Division Table Id',
  `district_id` int(10) UNSIGNED NOT NULL COMMENT 'District Table Id',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=inactive|1=active|2=Banned',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_phone_no_unique` (`phone_no`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `phone_no`, `email`, `password`, `street_address`, `division_id`, `district_id`, `status`, `ip_address`, `shipping_address`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shohanur Rahman', 'Akash', 'shohanur-rahmanakash', '01912885974', 'akash.cse.diu@gmail.com', '$2y$10$qtzxXJh.RomlVA1QD9gX9.qk.PXzsQQ1ijOk14jz6Q6rFunsHdxiC', 'Sector 5, Uttara dhaka', 1, 1, 1, '127.0.0.1', 'Sector 5, Uttara dhaka', NULL, NULL, '2019-08-26 22:15:38', '2019-08-27 21:21:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
