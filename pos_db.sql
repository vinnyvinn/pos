-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2018 at 03:25 WB
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.31-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_balance` int(11) NOT NULL DEFAULT '0',
  `credit_limit` int(11) NOT NULL DEFAULT '0',
  `is_credit` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `synched` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone_number`, `email`, `account_number`, `account_balance`, `credit_limit`, `is_credit`, `address`, `is_active`, `is_system`, `created_at`, `updated_at`, `deleted_at`, `synched`) VALUES
(1, 'Cash Customer', '+254711408108', 'info@wizag.biz', 'CST-00001', 0, 0, 0, 'Wise & Agile Solutions Limited', 1, 1, '2018-09-28 10:29:37', '2018-09-28 10:29:37', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_at` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `name`, `email`, `login_at`, `created_at`, `updated_at`) VALUES
(1, 'superuser', 'development@wizag.biz', '2018-10-02 12:26:57', NULL, NULL),
(2, 'superuser', 'development@wizag.biz', '2018-10-03 13:16:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_details`
--

CREATE TABLE `menu_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_details`
--

INSERT INTO `menu_details` (`id`, `item_id`, `quantity`, `created_at`, `updated_at`, `unit_price`, `sub_total`, `item_name`) VALUES
(1, 36, 2, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '20', '40', 'African Tea'),
(2, 40, 1, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '40', '40', 'Drinking Chocolate (White/milk)'),
(3, 41, 3, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '20', '60', 'Black Coffee'),
(4, 37, 1, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '20', '20', 'Strong Tea'),
(5, 38, 1, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '20', '20', 'Nylon Tea'),
(6, 42, 1, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '40', '40', 'White Coffee'),
(7, 55, 2, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '20', '40', 'Chapati'),
(8, 47, 3, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '5', '15', 'Cookies'),
(9, 56, 1, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '20', '20', 'Doughnuts'),
(10, 60, 1, '2018-10-03 11:43:25', '2018-10-03 11:43:25', '60', '60', 'Chapati/yai/mayai'),
(11, 52, 1, '2018-10-02 11:43:25', '2018-10-03 11:43:25', '20', '20', 'Chocolate Cake');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_04_110154_create_user_groups_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2017_02_14_114145_create_taxes_table', 1),
(10, '2017_03_13_143645_create_unit_of_measures_table', 1),
(11, '2017_03_14_080153_create_price_list_names_table', 1),
(12, '2017_03_14_105712_create_stock_items_table', 1),
(13, '2017_03_14_143704_create_unit_conversions_table', 1),
(14, '2017_03_15_103449_create_price_lists_table', 1),
(15, '2017_04_12_113709_create_settings_table', 1),
(16, '2017_04_12_120348_create_stalls_table', 1),
(17, '2017_04_26_153009_create_customers_table', 1),
(18, '2017_04_27_110737_create_stocks_table', 1),
(19, '2017_06_30_082427_create_suppliers_table', 1),
(20, '2017_06_30_104732_create_orders_table', 1),
(21, '2017_06_30_120932_create_order_lines_table', 1),
(22, '2017_07_04_144846_create_sales_table', 1),
(23, '2017_07_24_120525_create_payment_types_table', 1),
(24, '2017_10_02_172026_create_petty_cash_types_table', 1),
(25, '2017_11_02_170853_create_petty_cashes_table', 1),
(26, '2017_11_02_171410_create_transactions_table', 1),
(27, '2017_11_21_135002_create_transction_types_table', 1),
(28, '2017_11_25_095112_logs', 1),
(29, '2018_09_21_155104_create_product_subcategories_table', 1),
(30, '2018_09_21_155925_create_product_transactions_table', 1),
(31, '2018_09_28_140649_create_product_categories_table', 2),
(32, '2018_10_02_131842_create_menu_details_table', 3),
(33, '2018_10_03_135211_add_unit_price_column', 4),
(34, '2018_10_03_143033_add_sub_total_column', 5),
(35, '2018_10_03_143951_add_item_name_column', 6);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `stall_id` int(10) UNSIGNED DEFAULT NULL,
  `document_type` tinyint(4) NOT NULL,
  `document_status` tinyint(4) DEFAULT NULL,
  `document_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `total_discount` double NOT NULL DEFAULT '0',
  `total_exclusive` double NOT NULL,
  `total_inclusive` double NOT NULL,
  `total_tax` double NOT NULL,
  `cash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mpesa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `synched` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `account_id`, `user_id`, `customer_id`, `stall_id`, `document_type`, `document_status`, `document_number`, `order_number`, `external_order_number`, `description`, `order_date`, `due_date`, `total_discount`, `total_exclusive`, `total_inclusive`, `total_tax`, `cash`, `credit`, `mpesa`, `balance`, `notes`, `synched`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, 1, 1, NULL, 'INV00001', NULL, NULL, NULL, NULL, NULL, 0, 3696, 4394, 704, '5000', '0', '[{\"m_pesa_code\":null,\"m_pesa_amount\":0,\"default\":1}]', '612', NULL, 0, '2018-10-03 10:17:44', '2018-10-03 10:17:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_lines`
--

CREATE TABLE `order_lines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_item_id` int(10) UNSIGNED NOT NULL,
  `stall_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `uom` int(10) UNSIGNED NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `processed_quantity` int(11) NOT NULL DEFAULT '0',
  `tax_id` int(10) UNSIGNED NOT NULL,
  `tax_rate` double NOT NULL,
  `unit_tax` double NOT NULL,
  `unit_exclusive` double NOT NULL,
  `unit_inclusive` double NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `total_exclusive` double NOT NULL,
  `total_inclusive` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_credit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `slug`, `is_credit`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 'cash', '0', NULL, NULL, NULL),
(2, 'M-Pesa', 'm_pesa', '0', NULL, NULL, NULL),
(3, 'Credit', 'credit', '1', NULL, NULL, NULL),
(4, 'Credit Card', 'credit_card', '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `petty_cashes`
--

CREATE TABLE `petty_cashes` (
  `id` int(10) UNSIGNED NOT NULL,
  `petty_cash_type_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petty_cash_types`
--

CREATE TABLE `petty_cash_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_lists`
--

CREATE TABLE `price_lists` (
  `price_list_name_id` int(10) UNSIGNED NOT NULL,
  `stock_item_id` int(10) UNSIGNED NOT NULL,
  `unit_conversion_id` int(10) UNSIGNED DEFAULT NULL,
  `inclusive_price` double(8,2) NOT NULL,
  `exclusive_price` double(8,2) NOT NULL,
  `tax` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_lists`
--

INSERT INTO `price_lists` (`price_list_name_id`, `stock_item_id`, `unit_conversion_id`, `inclusive_price`, `exclusive_price`, `tax`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 400.00, 344.83, 55.17, '2018-10-02 09:27:58', '2018-10-02 09:27:58'),
(1, 2, 1, 550.00, 474.14, 75.86, '2018-10-02 09:28:44', '2018-10-02 09:28:44'),
(1, 3, 1, 600.00, 517.24, 82.76, '2018-10-02 09:29:13', '2018-10-02 09:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `price_list_names`
--

CREATE TABLE `price_list_names` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_list_names`
--

INSERT INTO `price_list_names` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Main Price List', 'Main Price List', 1, '2018-09-28 10:29:37', '2018-09-28 10:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'COLD & HOT DRINKS', NULL, NULL),
(2, 'SNACKS/CAKES', NULL, NULL),
(3, 'MAIN DISHES', NULL, NULL),
(4, 'CHEF SPECIALS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategories`
--

CREATE TABLE `product_subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_subcategories`
--

INSERT INTO `product_subcategories` (`id`, `name`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(36, 'African Tea', '20', 1, NULL, NULL),
(37, 'Strong Tea', '20', 1, NULL, NULL),
(38, 'Nylon Tea', '20', 1, NULL, NULL),
(39, 'Drinking Chocolate (Black)', '20', 1, NULL, NULL),
(40, 'Drinking Chocolate (White/milk)', '40', 1, NULL, NULL),
(41, 'Black Coffee', '20', 1, NULL, NULL),
(42, 'White Coffee', '40', 1, NULL, NULL),
(43, 'Soda', '35', 1, NULL, NULL),
(44, 'Mineral Water', '35', 1, NULL, NULL),
(45, 'Fresh fruit juice', '40', 1, NULL, NULL),
(46, 'Mala', '50', 1, NULL, NULL),
(47, 'Cookies', '5', 2, NULL, NULL),
(48, 'Tea Scones', '20', 2, NULL, NULL),
(49, 'Queen Cake(Small)', '10', 2, NULL, NULL),
(50, 'Queen Cake(Large)', '20', 2, NULL, NULL),
(51, 'Chocolate Cake', '20', 2, NULL, NULL),
(52, 'Chocolate Cake', '20', 2, NULL, NULL),
(53, 'Vanilla Cake', '20', 2, NULL, NULL),
(54, 'Fruit Cake', '30', 2, NULL, NULL),
(55, 'Chapati', '20', 2, NULL, NULL),
(56, 'Doughnuts', '20', 2, NULL, NULL),
(57, 'Andazi', '20', 2, NULL, NULL),
(58, 'Egg', '20', 2, NULL, NULL),
(59, 'Omlette', '60', 2, NULL, NULL),
(60, 'Chapati/yai/mayai', '60', 2, NULL, NULL),
(61, 'Rice + Njahi', '60', 3, NULL, NULL),
(62, 'Rice + Beans', '60', 3, NULL, NULL),
(63, 'Rice + Minji Stew', '100', 3, NULL, NULL),
(64, 'Rice + Matumbo', '80', 3, NULL, NULL),
(65, 'Rice + Beef', '100', 3, NULL, NULL),
(66, 'Rice + Mix(plain)', '60', 3, NULL, NULL),
(67, 'Rice + Mix with either Beef/Matumbo', '100', 3, NULL, NULL),
(68, 'Rice + Vegetables', '60', 3, NULL, NULL),
(69, 'Rice + Chicken', '130', 3, NULL, NULL),
(70, 'Rice + Fish', '200', 3, NULL, NULL),
(71, 'Rice + Omena', '70', 3, NULL, NULL),
(72, 'Ugali + Vegetables', '60', 3, NULL, NULL),
(73, 'Ugali + Njahi', '60', 3, NULL, NULL),
(74, 'Ugali + Beans', '60', 3, NULL, NULL),
(75, 'Ugali + Minji Stew', '100', 3, NULL, NULL),
(76, 'Ugali + Matumbo', '80', 3, NULL, NULL),
(77, 'Ugali + Beef', '100', 3, NULL, NULL),
(78, 'Ugali + Mix(plain)', '60', 3, NULL, NULL),
(79, 'Ugali + Mix with either Beef/Matumbo', '100', 3, NULL, NULL),
(80, 'Ugali + Chicken', '130', 3, NULL, NULL),
(81, 'Ugali + Fish', '200', 3, NULL, NULL),
(82, 'Ugali + Omena', '70', 3, NULL, NULL),
(83, 'Chapati +Vegetables', '60', 3, NULL, NULL),
(84, 'Chapati + Njahi', '60', 3, NULL, NULL),
(85, 'Chapati + Beans', '60', 3, NULL, NULL),
(86, 'Chapati + Minji stew', '100', 3, NULL, NULL),
(87, 'Chapati + Matumbo', '80', 3, NULL, NULL),
(88, 'Chapati + Beef', '100', 3, NULL, NULL),
(89, 'Chapati + Mix(plain)', '60', 3, NULL, NULL),
(90, 'Chapati + Mix with either Beef/Matumbo', '100', 3, NULL, NULL),
(91, 'Chapati + Chicken', '130', 3, NULL, NULL),
(92, 'Chapati + Fish', '200', 3, NULL, NULL),
(93, 'Chapati + Omena', '70', 3, NULL, NULL),
(94, 'Kienyeji + Vegetables/plain', '70', 3, NULL, NULL),
(95, 'Kienyeji + Njahi', '100', 3, NULL, NULL),
(96, 'Kienyeji + Beans', '100', 3, NULL, NULL),
(97, 'Kienyeji + Minji Stew', '120', 3, NULL, NULL),
(98, 'Kienyeji + Matumbo', '100', 3, NULL, NULL),
(99, 'Kienyeji + Beef', '120', 3, NULL, NULL),
(100, 'Kienyeji + Mix(plain)', '100', 3, NULL, NULL),
(101, 'Kienyeji + Mix with either Beef/ Matumbo', '140', 3, NULL, NULL),
(102, 'Kienyeji + Chicken', '150', 3, NULL, NULL),
(103, 'Kienyeji + Fish', '200', 3, NULL, NULL),
(104, 'Kienyeji + Omena', '80', 3, NULL, NULL),
(105, 'Pilau', '100', 4, NULL, NULL),
(106, 'Pilau + Any extra', '100', 4, NULL, NULL),
(107, 'Mala + Ugali', '80', 4, NULL, NULL),
(108, 'Ugali + Scrambled Eggs', '100', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_transactions`
--

CREATE TABLE `product_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_item_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_type_id` int(10) UNSIGNED DEFAULT NULL,
  `stall_id` int(10) UNSIGNED DEFAULT NULL,
  `sale_id` int(10) UNSIGNED DEFAULT NULL,
  `unit_conversion_id` int(10) UNSIGNED DEFAULT NULL,
  `stock_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double NOT NULL,
  `weight` double NOT NULL,
  `tax_rate` double NOT NULL,
  `unit_tax` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `unitExclPrice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitInclPrice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalInclPrice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalExclPrice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `synched` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `stock_item_id`, `transaction_type_id`, `stall_id`, `sale_id`, `unit_conversion_id`, `stock_name`, `code`, `description`, `quantity`, `weight`, `tax_rate`, `unit_tax`, `discount`, `unitExclPrice`, `unitInclPrice`, `totalInclPrice`, `totalExclPrice`, `total_tax`, `created_at`, `updated_at`, `synched`) VALUES
(1, 2, NULL, 1, 1, 1, 'p2', 'poo3', NULL, 1, 0, 16, 88, 0, '462', '550', '4400', '3696', '704', '2018-10-03 10:17:44', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventory_control_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'None',
  `costing_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Latest Cost',
  `enable_loyalty` tinyint(1) NOT NULL DEFAULT '0',
  `enable_gift_cards` tinyint(1) NOT NULL DEFAULT '0',
  `enable_bundles` tinyint(1) NOT NULL DEFAULT '0',
  `enable_happy_hour_sales` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `inventory_control_method`, `costing_method`, `enable_loyalty`, `enable_gift_cards`, `enable_bundles`, `enable_happy_hour_sales`, `created_at`, `updated_at`) VALUES
(1, 'None', 'Manual Cost Entry', 0, 0, 0, 0, '2018-09-28 10:29:37', '2018-09-28 10:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`id`, `name`, `location`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Head Office', '', '2018-09-28 10:29:37', '2018-09-28 10:29:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `quantity_on_hand` double NOT NULL DEFAULT '0',
  `quantity_reserved` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `synched` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `stall_id`, `item_id`, `quantity_on_hand`, `quantity_reserved`, `created_at`, `updated_at`, `synched`) VALUES
(1, 1, 1, 400, 0, '2018-10-02 09:27:58', '2018-10-02 09:29:26', 0),
(2, 1, 2, 292, 0, '2018-10-02 09:28:44', '2018-10-03 10:17:44', 0),
(3, 1, 3, 540, 0, '2018-10-02 09:29:13', '2018-10-02 09:29:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_items`
--

CREATE TABLE `stock_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `buying_tax` int(10) UNSIGNED DEFAULT NULL,
  `selling_tax` int(10) UNSIGNED DEFAULT NULL,
  `credit_note_tax` int(10) UNSIGNED DEFAULT NULL,
  `has_conversions` tinyint(1) NOT NULL DEFAULT '0',
  `stocking_uom` int(10) UNSIGNED DEFAULT NULL,
  `selling_uom` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `unit_cost` double(8,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_serial_item` tinyint(1) NOT NULL DEFAULT '0',
  `is_expiry_item` tinyint(1) NOT NULL DEFAULT '0',
  `has_inventory_control` tinyint(1) NOT NULL DEFAULT '0',
  `is_fifo` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_items`
--

INSERT INTO `stock_items` (`id`, `buying_tax`, `selling_tax`, `credit_note_tax`, `has_conversions`, `stocking_uom`, `selling_uom`, `code`, `barcode`, `name`, `description`, `unit_cost`, `is_active`, `is_serial_item`, `is_expiry_item`, `has_inventory_control`, `is_fifo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, 1, NULL, 'p00123', 'VLJSBE4J', 'p1', 'axas', 400.00, 1, 0, 0, 0, 0, NULL, '2018-10-02 09:27:58', '2018-10-02 09:27:58'),
(2, 1, 1, 1, 0, 1, NULL, 'poo3', 'WWRZFFIA', 'p2', 'asxcsc cew wefewv wefwe', 550.00, 1, 0, 0, 0, 0, NULL, '2018-10-02 09:28:44', '2018-10-02 09:28:44'),
(3, 1, 1, 1, 0, 1, NULL, 'sadfs324', '2JFE3Q96', 'p3', 'asc weaf efg', 600.00, 1, 0, 0, 0, 0, NULL, '2018-10-02 09:29:13', '2018-10-02 09:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_balance` int(11) NOT NULL DEFAULT '0',
  `credit_limit` int(11) NOT NULL DEFAULT '0',
  `is_credit` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `rate` double(8,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `code`, `description`, `rate`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Input Tax', 16.00, 1, '2018-09-28 10:29:37', '2018-09-28 10:29:37'),
(2, 'E', 'Exempt', 0.00, 1, '2018-09-28 10:29:37', '2018-09-28 10:29:37'),
(3, 'Z', 'Zero Rated', 0.00, 1, '2018-09-28 10:29:37', '2018-09-28 10:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `transactionable_id` int(11) NOT NULL,
  `transactionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transactionable_id`, `transactionable_type`, `type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 0, '', 'Cashbox', 90, '2018-10-02 09:27:02', '2018-10-02 09:27:02'),
(2, 0, '', 'Cashbox', 500, '2018-10-03 10:16:27', '2018-10-03 10:16:27'),
(3, 1, 'SmoDav\\Models\\Order', 'Cashbox', 4388, '2018-10-03 10:17:44', '2018-10-03 10:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `mop` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `mop`, `created_at`, `updated_at`) VALUES
(1, 'MPESA', '2018-09-28 10:29:38', '2018-09-28 10:29:38'),
(2, 'CREDIT CARD', '2018-09-28 10:29:38', '2018-09-28 10:29:38'),
(3, 'CASH', '2018-09-28 10:29:38', '2018-09-28 10:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `unit_conversions`
--

CREATE TABLE `unit_conversions` (
  `stock_item_id` int(10) UNSIGNED NOT NULL,
  `stocking_unit_id` int(10) UNSIGNED NOT NULL,
  `converted_unit_id` int(10) UNSIGNED NOT NULL,
  `stocking_ratio` double(8,2) NOT NULL,
  `converted_ratio` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_of_measures`
--

CREATE TABLE `unit_of_measures` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `system_install` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_of_measures`
--

INSERT INTO `unit_of_measures` (`id`, `name`, `description`, `is_active`, `system_install`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'unit', 'Default Unit of Measure', 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_group_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `username`, `full_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'superuser', 'Wizag', 'development@wizag.biz', '$2y$10$Em.ZYc9WPQ35ZYvcrvFniOb27sGG1tvWyGlb6ZlOLj3gHyueVGo8W', 'ydRZJRE5vJb2q0iCaYn7ky0rtaAz7ZqEm0rksgMDKS7uiUHYEQVjmuSHSTsl', '2018-09-28 10:29:38', '2018-09-28 10:29:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'default User', '[]', '2018-09-28 10:29:38', '2018-09-28 10:29:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_details`
--
ALTER TABLE `menu_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_account_id_index` (`account_id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_customer_id_index` (`customer_id`),
  ADD KEY `orders_stall_id_index` (`stall_id`);

--
-- Indexes for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_lines_order_id_index` (`order_id`),
  ADD KEY `order_lines_stock_item_id_index` (`stock_item_id`),
  ADD KEY `order_lines_stall_id_index` (`stall_id`),
  ADD KEY `order_lines_customer_id_index` (`customer_id`),
  ADD KEY `order_lines_uom_index` (`uom`),
  ADD KEY `order_lines_tax_id_index` (`tax_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petty_cashes`
--
ALTER TABLE `petty_cashes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petty_cashes_petty_cash_type_id_foreign` (`petty_cash_type_id`),
  ADD KEY `petty_cashes_user_id_foreign` (`user_id`);

--
-- Indexes for table `petty_cash_types`
--
ALTER TABLE `petty_cash_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_lists`
--
ALTER TABLE `price_lists`
  ADD KEY `price_lists_price_list_name_id_index` (`price_list_name_id`),
  ADD KEY `price_lists_stock_item_id_index` (`stock_item_id`),
  ADD KEY `price_lists_unit_conversion_id_index` (`unit_conversion_id`);

--
-- Indexes for table `price_list_names`
--
ALTER TABLE `price_list_names`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `price_list_names_name_unique` (`name`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_subcategories`
--
ALTER TABLE `product_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transactions`
--
ALTER TABLE `product_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_item_id_foreign` (`item_id`),
  ADD KEY `stocks_stall_id_index` (`stall_id`);

--
-- Indexes for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_items_code_unique` (`code`),
  ADD KEY `stock_items_buying_tax_index` (`buying_tax`),
  ADD KEY `stock_items_selling_tax_index` (`selling_tax`),
  ADD KEY `stock_items_credit_note_tax_index` (`credit_note_tax`),
  ADD KEY `stock_items_stocking_uom_index` (`stocking_uom`),
  ADD KEY `stock_items_selling_uom_index` (`selling_uom`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `taxes_code_unique` (`code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_conversions`
--
ALTER TABLE `unit_conversions`
  ADD KEY `unit_conversions_stock_item_id_index` (`stock_item_id`),
  ADD KEY `unit_conversions_stocking_unit_id_index` (`stocking_unit_id`),
  ADD KEY `unit_conversions_converted_unit_id_index` (`converted_unit_id`);

--
-- Indexes for table `unit_of_measures`
--
ALTER TABLE `unit_of_measures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_group_id_foreign` (`user_group_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_details`
--
ALTER TABLE `menu_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_lines`
--
ALTER TABLE `order_lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `petty_cashes`
--
ALTER TABLE `petty_cashes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `petty_cash_types`
--
ALTER TABLE `petty_cash_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price_list_names`
--
ALTER TABLE `price_list_names`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_subcategories`
--
ALTER TABLE `product_subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `product_transactions`
--
ALTER TABLE `product_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit_of_measures`
--
ALTER TABLE `unit_of_measures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_stall_id_foreign` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD CONSTRAINT `order_lines_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_lines_stall_id_foreign` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_lines_stock_item_id_foreign` FOREIGN KEY (`stock_item_id`) REFERENCES `stock_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_lines_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_lines_uom_foreign` FOREIGN KEY (`uom`) REFERENCES `unit_of_measures` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `petty_cashes`
--
ALTER TABLE `petty_cashes`
  ADD CONSTRAINT `petty_cashes_petty_cash_type_id_foreign` FOREIGN KEY (`petty_cash_type_id`) REFERENCES `petty_cash_types` (`id`),
  ADD CONSTRAINT `petty_cashes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `price_lists`
--
ALTER TABLE `price_lists`
  ADD CONSTRAINT `price_lists_price_list_name_id_foreign` FOREIGN KEY (`price_list_name_id`) REFERENCES `price_list_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `price_lists_stock_item_id_foreign` FOREIGN KEY (`stock_item_id`) REFERENCES `stock_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `price_lists_unit_conversion_id_foreign` FOREIGN KEY (`unit_conversion_id`) REFERENCES `unit_of_measures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `stock_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_stall_id_foreign` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD CONSTRAINT `stock_items_buying_tax_foreign` FOREIGN KEY (`buying_tax`) REFERENCES `taxes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_items_credit_note_tax_foreign` FOREIGN KEY (`credit_note_tax`) REFERENCES `taxes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_items_selling_tax_foreign` FOREIGN KEY (`selling_tax`) REFERENCES `taxes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_items_selling_uom_foreign` FOREIGN KEY (`selling_uom`) REFERENCES `unit_of_measures` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_items_stocking_uom_foreign` FOREIGN KEY (`stocking_uom`) REFERENCES `unit_of_measures` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `unit_conversions`
--
ALTER TABLE `unit_conversions`
  ADD CONSTRAINT `unit_conversions_converted_unit_id_foreign` FOREIGN KEY (`converted_unit_id`) REFERENCES `unit_of_measures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_conversions_stock_item_id_foreign` FOREIGN KEY (`stock_item_id`) REFERENCES `stock_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_conversions_stocking_unit_id_foreign` FOREIGN KEY (`stocking_unit_id`) REFERENCES `unit_of_measures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
