-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 12:51 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nakit2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `product_id`, `name`, `action`, `date`) VALUES
(1, 1, NULL, 'Aleksandra', 'Login', '2021-03-09'),
(2, 1, NULL, 'Aleksandra', 'Logout', '2021-03-10'),
(4, 1, NULL, 'Aleksandra', 'Login', '2021-03-10'),
(5, 1, 1, 'Aleksandra', 'Added to cart', '2021-03-10'),
(8, 1, NULL, 'Aleksandra', 'Login', '2021-03-11'),
(10, 1, NULL, 'Aleksandra', 'Logout', '2021-03-11'),
(11, 2, NULL, 'Jelena', 'Login', '2021-03-11'),
(12, 2, 2, 'Jelena', 'Added to cart', '2021-03-11'),
(13, 2, NULL, 'Jelena', 'Logout', '2021-03-11'),
(14, 1, NULL, 'Aleksandra', 'Login', '2021-03-11'),
(16, 1, NULL, 'Aleksandra', 'Logout', '2021-03-11'),
(17, 5, NULL, 'Ivana', 'Registration', '2021-03-11'),
(29, 1, 22, 'Aleksandra', 'Added to cart', '2021-03-12'),
(30, 1, NULL, 'Aleksandra', 'Login', '2021-03-12'),
(31, 1, 15, 'Aleksandra', 'Added to cart', '2021-03-12'),
(32, 1, 6, 'Aleksandra', 'Added to cart', '2021-03-12'),
(33, 1, NULL, 'Aleksandra', 'Logout', '2021-03-12'),
(34, 1, NULL, 'Aleksandra', 'Login', '2021-03-14'),
(35, 1, 6, 'Aleksandra', 'Added to cart', '2021-03-14'),
(36, 1, 18, 'Aleksandra', 'Added to cart', '2021-03-14'),
(37, 1, 25, 'Aleksandra', 'Added to cart', '2021-03-14'),
(38, 1, 5, 'Aleksandra', 'Added to cart', '2021-03-14'),
(39, 1, 1, 'Aleksandra', 'Added to cart', '2021-03-14'),
(40, 1, 2, 'Aleksandra', 'Added to cart', '2021-03-14'),
(41, 1, 11, 'Aleksandra', 'Added to cart', '2021-03-14'),
(42, 1, 13, 'Aleksandra', 'Added to cart', '2021-03-14'),
(43, 1, 3, 'Aleksandra', 'Added to cart', '2021-03-14'),
(44, 1, 4, 'Aleksandra', 'Added to cart', '2021-03-14'),
(45, 1, 1, 'Aleksandra', 'Added to cart', '2021-03-14'),
(46, 1, NULL, 'Aleksandra', 'Logout', '2021-03-14'),
(47, 1, NULL, 'Aleksandra', 'Login', '2021-03-14'),
(48, 1, NULL, 'Aleksandra', 'Logout', '2021-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Calvin Klein'),
(2, 'Guess'),
(3, 'Fossil'),
(4, 'Sector'),
(5, 'Brosway'),
(6, 'Skagen'),
(7, 'Daniel Klein'),
(8, 'Morellato'),
(9, 'Bering'),
(10, 'Melano');

-- --------------------------------------------------------

--
-- Table structure for table `buys`
--

CREATE TABLE `buys` (
  `id` int(10) NOT NULL,
  `cart_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) NOT NULL,
  `product_size_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(10) NOT NULL,
  `bought` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(1, 'Gold'),
(2, 'Silver'),
(3, 'White Gold');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `grade` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `product_id`, `user_id`, `grade`) VALUES
(1, 1, 1, 5),
(2, 1, 1, 4),
(3, 1, 2, 4),
(4, 3, 1, 4),
(5, 2, 2, 3),
(7, 8, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `route`, `order`) VALUES
(1, 'Home', 'home', 1),
(2, 'Products', 'products', 2),
(3, 'Contact', 'contact', 3);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(10) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `image`, `alt`, `product_id`) VALUES
(214, 'braided-ring1.jpg', 'Braided Ring ', 1),
(215, 'braided-ring2.jpg', 'Braided Ring ', 1),
(216, 'braided-ring3.png', 'Braided Ring ', 1),
(219, 'bold_herringbone1.jpg', 'Bold Herringbone', 2),
(220, 'bold_herringbone2.jpg', 'Bold Herringbone ', 2),
(221, 'bold_herringbone3.jpg', 'Bold Herringbone ', 2),
(222, 'triple-cable1.jpg', 'Triple Cable Bracelet', 17),
(223, 'triple-cable2.jpg', 'Triple Cable Bracelet', 17),
(224, 'triple-cable3.jpg', 'Triple Cable Bracelet', 17),
(225, 'metallic-sphere1.jpg', 'Metallic Sphere Bracelet', 20),
(226, 'metallic-sphere2.jpg', 'Metallic Sphere Bracelet', 20),
(227, 'metallic-sphere3.jpg', 'Metallic Sphere Bracelet', 20),
(228, 'engravable-bar1.jpg', 'Engravable Bar Bracelet', 5),
(229, 'engravable-bar2.jpg', 'Engravable Bar Bracelet', 5),
(230, 'engravable-bar.jpg', 'Engravable Bar Bracelet', 5),
(231, 'curb-bracelet1.jpg', 'Curb Bracelet', 11),
(232, 'curb-bracelet2.jpg', 'Curb Bracelet', 11),
(233, 'curb-bracelet3.jpg', 'Curb Bracelet', 11),
(234, 'white-sapphire1.jpg', 'White Sapphire', 25),
(235, 'white-sapphire2.jpg', 'White Sapphire', 25),
(236, 'white-sapphire3.jpg', 'White Sapphire', 25),
(237, 'bold-bangle1.jpg', 'Bold Bangle', 21),
(238, 'bold-bangle2.jpg', 'Bold Bangle', 21),
(239, 'bold-bangle3.jpg', 'Bold Bangle', 21),
(240, 'diamond-tennis1.jpg', 'Diamond Tennis', 3),
(241, 'diamond-tennis2.jpg', 'Diamond Tennis', 3),
(242, 'diamond-tennis3.jpg', 'Diamond Tennis', 3),
(243, 'solo-diamond1.jpg', 'Solo Diamond', 14),
(244, 'solo-diamond2.jpg', 'Solo Diamond', 14),
(245, 'solo-diamond3.jpg', 'Solo Diamond', 14),
(246, 'croissant-dome1.jpg', 'Croissant Dome', 15),
(247, 'croissant-dome2.jpg', 'Croissant Dome', 15),
(248, 'croissant-dome3.jpg', 'Croissant Dome', 15),
(249, 'charlotte-ring1.jpg', 'Charlotte Ring', 4),
(250, 'charlotte-ring2.jpg', 'Charlotte Ring', 4),
(251, 'charlotte-ring3.jpg', 'Charlotte Ring', 4),
(252, 'sculpture-band1.jpg', 'Sculpture Band', 23),
(253, 'sculpture-band2.jpg', 'Sculpture Band', 23),
(254, 'sculpture-band3.jpg', 'Sculpture Band', 23),
(255, 'dome-ring1.jpg', 'Dome Ring', 13),
(256, 'dome-ring2.jpg', 'Dome Ring', 13),
(257, 'dome-ring3.jpg', 'Dome Ring', 13),
(258, 'diamond-beaded1.jpg', 'Diamond Beaded', 8),
(259, 'diamond-beaded2.jpg', 'Diamond Beaded', 8),
(260, 'diamond-beaded3.jpg', 'Diamond Beaded', 8),
(261, 'boyfriend-stacker1.jpg', 'Boyfriend Stacker', 19),
(262, 'boyfriend-stacker2.jpg', 'Boyfriend Stacker', 19),
(263, 'boyfriend-stacker3.jpg', 'Boyfriend Stacker', 19),
(264, 'floating-metal1.jpg', 'Floating Metal', 10),
(265, 'floating-metal2.jpg', 'Floating Metal', 10),
(266, 'floating-metal3.jpg', 'Floating Metal', 10),
(267, 'nova-necklace1.jpg', 'Nova Necklace', 22),
(268, 'nova-necklace2.jpg', 'Nova Necklace', 22),
(269, 'nova-necklace3.jpg', 'Nova Necklace', 22),
(270, 'bold-link1.jpg', 'Bold Link', 18),
(271, 'bold-link2.jpg', 'Bold Link', 18),
(272, 'bold-link3.jpg', 'Bold Link', 18),
(273, 'triple-cable-necklace1.jpg', 'Triple Cable Necklace', 9),
(274, 'triple-cable-necklace2.jpg', 'Triple Cable Necklace', 9),
(275, 'triple-cable-necklace3.jpg', 'Triple Cable Necklace', 9),
(276, 'rope-chain1.jpg', 'Rope Chain', 24),
(277, 'rope-chain2.jpg', 'Rope Chain', 24),
(278, 'rope-chain3.jpg', 'Rope Chain', 24),
(279, 'diamonds-line1.jpg', 'Diamonds Line', 6),
(280, 'diamonds-line2.jpg', 'Diamonds Line', 6),
(281, 'diamonds-line3.jpg', 'Diamonds Line', 6),
(282, 'diamond-necklace1.jpg', 'Diamond Necklace', 12),
(283, 'diamond-necklace2.jpg', 'Diamond Necklace', 12),
(284, 'diamond-necklace3.jpg', 'Diamond Necklace', 12),
(285, 'large-diamond1.jpg', 'Large Diamond', 16),
(286, 'large-diamond2.jpg', 'Large Diamond', 16),
(287, 'large-diamond3.jpg', 'Large Diamond', 16);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `price`, `date`, `product_id`) VALUES
(1, '120.00', '2021-03-09 22:35:34', 1),
(2, '165.00', '2021-03-09 22:35:34', 2),
(3, '2300.00', '2021-03-09 22:35:34', 3),
(4, '595.00', '2021-03-09 22:35:34', 4),
(5, '60.00', '2021-03-09 22:35:34', 5),
(6, '310.00', '2021-03-09 22:35:34', 6),
(7, '205.00', '2021-03-09 22:35:34', 8),
(8, '350.00', '2021-03-09 22:35:34', 9),
(9, '60.00', '2021-03-09 22:35:34', 10),
(10, '235.00', '2021-03-09 22:35:34', 11),
(11, '300.00', '2021-03-09 22:35:34', 12),
(12, '60.00', '2021-03-09 22:35:34', 13),
(13, '200.00', '2021-03-09 22:35:34', 14),
(14, '75.00', '2021-03-09 22:35:34', 15),
(15, '995.00', '2021-03-09 22:35:34', 16),
(16, '175.00', '2021-03-09 22:35:34', 17),
(17, '90.00', '2021-03-09 22:35:34', 18),
(18, '65.00', '2021-03-09 22:35:34', 19),
(19, '110.00', '2021-03-09 22:35:34', 20),
(20, '495.00', '2021-03-09 22:35:34', 21),
(21, '175.00', '2021-03-09 22:35:34', 22),
(22, '120.00', '2021-03-09 22:35:34', 23),
(23, '185.00', '2021-03-09 22:35:34', 24),
(24, '200.00', '2021-03-09 22:35:34', 25);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand_id` int(10) NOT NULL,
  `color_id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `main_image`, `brand_id`, `color_id`, `type_id`, `created_at`) VALUES
(1, 'Braided Ring', 'Made in 14k solid gold, the alloy gives our pieces its beautiful, subtle hue, band width: 4.45 mm, band thickness: 0.85 mm', 'braided-ring.jpg', 1, 1, 1, '2021-03-02 18:05:25'),
(2, 'Bold Herringbone', 'Made in gold vermeil: a thick 18k gold layer on sterling silver, width: 5 mm.', 'bold_herringbone.jpg', 2, 1, 2, '2021-03-02 18:12:17'),
(3, 'Diamond Tennis', 'Made in 14k solid gold set with high-quality ethically sourced diamonds (GH color, SI clarity), diamond size: 1.3 mm, 6 inches: 0.968 ct, 88 diamonds, 6.5 inches: 1.045 ct, 96 diamonds.', 'diamond-tennis.jpg', 9, 3, 3, '2021-03-06 21:54:03'),
(4, 'Charlotte Ring', 'Made in 14k solid gold, the alloy that gives our pieces its beautiful, subtle hue, width: 6.35 mm.', 'charlotte-ring.jpg', 5, 1, 1, '2021-03-06 21:54:03'),
(5, 'Engravable Bar', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, adjustable chain 6 to 7 inches.', 'engravable-bar.jpg', 6, 2, 3, '2021-03-06 21:54:03'),
(6, 'Diamonds Line', 'Made in 14k white gold finished in rhodium plating set with a high-quality diamonds (SI 1- 2 clarity), overall length: 16 inches, length of bar: 13 mm', 'diamonds-line.jpg', 2, 3, 2, '2021-03-06 21:54:03'),
(8, 'Diamond Beaded', 'Made in 14k solid gold set with a high-quality diamond (SI 1- 2 clarity). Conflict-free and socially responsible diamonds only, carat weight 0.06, diamond diameter: 2.5 mm, band thickness: 1.5 mm.', 'diamond-beaded.jpg', 6, 1, 1, '2021-03-06 21:54:08'),
(9, 'Triple Cable Necklace', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, chain width: 13 mm, adjustable chain length from 16 to 18 inches.', 'triple-cable-necklace.jpg', 9, 2, 2, '2021-03-06 21:54:03'),
(10, 'Floating Metal', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, width: 16.45 mm, length: 22.10 mm, band Width: 2.48 mm.', 'floating-metal.jpg', 4, 2, 1, '2021-03-06 21:54:03'),
(11, 'Curb Bracelet', 'Made in 14k solid gold, the alloy that gives our pieces its beautiful, subtle hue, adjustable length 6 to 7 inches.', 'curb-bracelet.jpg', 2, 1, 3, '2021-03-06 21:54:03'),
(12, 'Diamond Necklace', 'Made in 14k white gold finished in rhodium plating set with a high-quality diamond (SI 1- 2 clarity), carat weight 0.06, overall diameter 3 mm.', 'diamond-necklace.jpg', 4, 3, 2, '2021-03-06 21:54:07'),
(13, 'Dôme Ring ', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, band thickness: 4.3 - 11.5 mm', 'dome-ring.jpg', 3, 2, 1, '2021-03-06 21:54:03'),
(14, 'Solo Diamond', 'Made in 14k white gold finished in rhodium plating with a high-quality ethically sourced diamond, carat weight 0.065, overall diameter 3.7 mm, adjustable chain length 6 to 7 inches.', 'solo-diamond.jpg', 10, 3, 3, '2021-03-06 21:54:03'),
(15, 'Croissant Dôme', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, band width:3.0 - 9.15mm.', 'croissant-dome.jpg', 2, 2, 1, '2021-03-06 21:54:05'),
(16, 'Large Diamond', 'Made in 14k white gold finished in rhodium plating set with a high-quality diamond (SI 1- 2 clarity), average carat weight: 0.26, diameter: 5.7 mm.', 'large-diamond.jpg', 7, 3, 2, '2021-03-06 21:54:03'),
(17, 'Triple Cable Bracelet', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, chain width: 13 mm.', 'triple-cable.jpg', 1, 2, 3, '2021-03-06 21:54:03'),
(18, 'Bold Chain Necklace', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, chain length: 22 inches, width: 4.70 mm.', 'bold-link.jpg', 3, 2, 2, '2021-03-06 21:54:03'),
(19, 'Boyfriend Stacker', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, band width: 6.5 mm', 'boyfriend-stacker.jpg', 7, 2, 1, '2021-03-06 21:54:03'),
(20, 'Metallic Sphere', 'Made in 925 sterling silver dipped in rhodium for extra shine and strength, sphere size: 5 mm.', 'metallic-sphere.jpg', 8, 2, 3, '2021-03-06 21:54:03'),
(21, 'Bold Bangle', 'Made in hollowed 14k solid gold, the alloy gives our pieces its beautiful, subtle hue, size: 50x60mm, thickness: 3mm.', 'bold-bangle.jpg', 3, 1, 3, '2021-03-06 21:54:03'),
(22, 'Nova Necklace', 'Made in 14k solid gold, the alloy gives our pieces its beautiful, subtle hue, star size: 4 mm, adjustable chain length: 16 to 18 inches.', 'nova-necklace.jpg', 1, 1, 2, '2021-03-06 21:54:03'),
(23, 'Sculpture Band', 'Made in 14k solid gold, the alloy gives our pieces its beautiful, subtle hue, band Width: 1.0 - 2.5 mm.', 'sculpture-band.jpg', 8, 1, 1, '2021-03-06 21:54:03'),
(24, 'Rope Chain Necklace', 'Thickness: 4 mm.', 'rope-chain.jpg', 4, 2, 2, '2021-03-06 21:54:03'),
(25, 'White Sapphire', 'Made in 14k solid gold, set with AAA quality white sapphire, pendant size: 4.50 mm x 9.20 mm.', 'white-sapphire.jpg', 5, 1, 3, '2021-03-06 21:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `size_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`, `quantity`) VALUES
(35, 1, 1, 9),
(36, 1, 2, 14),
(37, 2, 4, 11),
(38, 3, 4, 14),
(39, 5, 4, 16),
(40, 11, 4, 17),
(41, 14, 4, 25),
(42, 17, 4, 24),
(43, 20, 4, 23),
(44, 21, 4, 22),
(45, 23, 4, 21),
(46, 25, 4, 19),
(47, 4, 3, 18),
(48, 4, 2, 18),
(49, 6, 3, 15),
(50, 9, 11, 16),
(51, 9, 7, 15),
(52, 10, 12, 14),
(53, 10, 3, 13),
(54, 10, 5, 12),
(55, 12, 6, 11),
(56, 13, 4, 10),
(57, 13, 1, 10),
(58, 15, 2, 12),
(59, 15, 1, 13),
(60, 15, 3, 12),
(61, 15, 8, 15),
(62, 18, 12, 15),
(63, 19, 5, 17),
(64, 19, 3, 181),
(65, 19, 7, 19),
(66, 22, 9, 20),
(67, 22, 10, 18),
(68, 24, 4, 22),
(69, 16, 1, 23);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`) VALUES
(1, '4'),
(2, '5'),
(3, '6'),
(4, 'Universal'),
(5, '7'),
(6, '8'),
(7, '9'),
(8, '10'),
(9, '18 inches'),
(10, '20 inches'),
(11, '22 inches'),
(12, '24 inches'),
(46, ' 2'),
(47, '1 '),
(48, '  2'),
(49, '4'),
(50, ' 5'),
(51, '1'),
(52, ' 2'),
(53, '14'),
(54, ' 15'),
(55, '14'),
(56, ' 15'),
(57, '14'),
(58, ' 15'),
(59, '1'),
(60, ' 2'),
(61, '1'),
(62, ' 2'),
(63, '14'),
(64, ' 15'),
(65, '14'),
(66, ' 15'),
(67, '1'),
(68, ' 2');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type`) VALUES
(1, 'Ring'),
(2, 'Necklace'),
(3, 'Bracelet');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `address`, `password`, `active`, `role_id`) VALUES
(1, 'Aleksandra', 'Markovic', 'markovic749@gmail.com', 'Kosovska 2', '25d55ad283aa400af464c76d713c07ad', 1, 1),
(2, 'Jelena', 'Markovic', 'jelena@gmail.com', 'Kosovska 2', '25d55ad283aa400af464c76d713c07ad', 1, 2),
(5, 'Ivana', 'Nedeljkovic', 'ivana@gmail.com', 'Brace Avramovic 10', '25d55ad283aa400af464c76d713c07ad', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_id` (`product_size_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `typr_id` (`type_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `buys`
--
ALTER TABLE `buys`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `buys`
--
ALTER TABLE `buys`
  ADD CONSTRAINT `buys_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_size_id`) REFERENCES `product_size` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
