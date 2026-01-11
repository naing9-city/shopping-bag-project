-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 06:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2024-04-02 16:21:18', '03-05-2024 08:27:55 PM');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(8, 'Bag', '', '2024-06-25 13:59:03', NULL),
(9, 'Backpack', '', '2024-06-25 13:59:18', NULL),
(11, 'Wallet for Men', '', '2024-06-25 14:00:20', NULL),
(12, 'Wallet for Women', '', '2024-06-25 14:00:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(5, 7, '22', 1, '2024-06-26 13:41:45', 'COD', 'Delivered'),
(6, 8, '23', 1, '2024-07-31 14:02:07', 'COD', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(8, 5, 'Delivered', 'Delivered', '2024-07-18 14:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `productreviews`
--

INSERT INTO `productreviews` (`id`, `productId`, `quality`, `price`, `value`, `name`, `summary`, `review`, `reviewDate`) VALUES
(1, 34, 5, 5, 5, 'mimi', 'Quality Good', 'Quality Good', '2024-08-09 02:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productPriceBeforeDiscount` int(11) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `productCompany`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`) VALUES
(22, 8, 15, 'Women Bag Calvin klein Re-Lock Hobo', 'CK', 50000, 0, 'Women Bag Calvin klein Re-Lock Hobo<br>', 'ckbg.jpg', 'ckbg1.jpg', '', 4000, 'In Stock', '2024-06-25 14:25:53', NULL),
(23, 9, 18, 'Addidas Back pack', 'ADDIDAS', 60000, 0, 'Addidas Back pack<br>', 'backpack1.jpg', 'bpack2.jpg', 'bpack3.jpg', 3500, 'In Stock', '2024-06-26 12:53:42', NULL),
(24, 9, 23, 'THE NORTH FACE Womens Jester Luxe Everyday Laptop Backpack', 'Jester Luxe', 240000, 0, 'THE NORTH FACE Womens Jester Luxe Everyday Laptop Backpack<br>', 'photo_2024-07-18_19-54-52.jpg', 'THE NORTH FACE Womens Jester Luxe Everyday Laptop Backpack1.jpg', 'women backpack.jpg', 4000, 'In Stock', '2024-07-18 13:36:36', NULL),
(25, 9, 24, 'JanSport Cross Town Backpack', 'JanSport', 75000, 0, 'The Cross Town is functional simplicity at it is best.  Featuring one \r\nlarge main compartment, front utility pocket with organizer, haul loop, \r\nside water bottle pocket, padded back panel, and iconic straight-cut, \r\npadded shoulder straps. The Cross Town will get you across town in \r\nstyle.', 'photo_2024-07-18_20-10-03.jpg', 'bp1.jpg', 'bp2.jpg', 4000, 'In Stock', '2024-07-18 13:49:05', NULL),
(26, 9, 25, 'MATEIN Travel Laptop Backpack', 'MATEIN', 100000, 0, '<span>The <em>Matein Travel</em> is an amazing steal. It has ample storage capacity for multiple <em>laptops</em> and enough padding to protect them in transit.</span>', 'photo_2024-07-18_20-23-18.jpg', 'bp5.jpg', 'bp4.jpg', 4000, 'In Stock', '2024-07-18 13:55:03', NULL),
(27, 8, 26, 'Prada shoulder ', 'Prada', 35000, 0, '<div>color-6 colors</div><div>size-28cm<br></div>', 'photo_2024-07-20_11-16-18.jpg', 'photo_2024-07-20_11-16-35.jpg', 'photo_2024-07-20_11-16-39.jpg', 4000, 'In Stock', '2024-07-20 04:48:03', NULL),
(28, 12, 21, 'GUCCI Zip Around wallet with box', 'GUCCI', 21000, 0, '<div>size-19cm</div><div>Designs-8 designs</div><div><br></div>', 'photo_2024-07-20_11-30-51.jpg', 'photo_2024-07-20_11-30-58.jpg', 'photo_2024-07-20_11-31-01.jpg', 4000, 'In Stock', '2024-07-20 05:02:01', NULL),
(29, 11, 28, 'Columbia Mens Everyday Bifold Wallet-Multiple Card Slots', 'Columbia', 89000, 0, '<b>Columbia Mens Everyday Bifold Wallet-Multiple Card Slots</b><br>', 'photo_2024-07-21_21-50-40.jpg', 'photo_2024-07-21_21-50-40.jpg', 'photo_2024-07-21_21-50-40.jpg', 4000, 'In Stock', '2024-07-21 15:21:44', NULL),
(30, 11, 29, 'Carhartt Mens Rodeo Wallet', 'Carhartt ', 156000, 0, 'Carhartt Mens Rodeo Wallet<br>', 'photo_2024-07-21_21-53-13.jpg', 'photo_2024-07-21_21-53-13.jpg', 'photo_2024-07-21_21-53-13.jpg', 4000, 'In Stock', '2024-07-21 15:23:58', NULL),
(31, 11, 30, 'WOLVERINE Mens RFID Blocking Rugged Trifold Wallet', 'WOLVERINE', 96000, 0, 'WOLVERINE Mens RFID Blocking Rugged Trifold Wallet<br>', 'photo_2024-07-21_21-55-40.jpg', 'photo_2024-07-21_21-55-40.jpg', 'photo_2024-07-21_21-55-40.jpg', 4000, 'In Stock', '2024-07-21 15:26:09', NULL),
(32, 11, 31, 'GOIACII Genuine Leather Wallet for Men RFID Blocking Men Wallet with Zipper Coin Pocket', 'GOIACII', 62000, 0, 'GOIACII Genuine Leather Wallet for Men RFID Blocking Men Wallet with Zipper Coin Pocket<br>', 'photo_2024-07-21_21-57-56.jpg', 'photo_2024-07-21_21-57-56.jpg', 'photo_2024-07-21_21-57-56.jpg', 4000, 'In Stock', '2024-07-21 15:28:20', NULL),
(33, 11, 32, 'SENDEFN Mens Wallet Genuine Leather Wallets for Men RFID Blocking Card Holder with Zipper Coin Purse', 'SENDEFN', 58000, 0, 'SENDEFN Mens Wallet Genuine Leather Wallets for Men RFID Blocking Card Holder with Zipper Coin Purse<br>', 'photo_2024-07-21_22-00-01.jpg', 'photo_2024-07-21_22-00-01.jpg', 'photo_2024-07-21_22-00-01.jpg', 4000, 'In Stock', '2024-07-21 15:30:34', NULL),
(34, 8, 33, 'VERSACE Jeans Couture bag', 'VERSACE', 50500, 0, 'VERSACE Jeans Couture bag<br>', 'versace1.jpg', 'versace2.jpg', 'versace.jpg', 4000, 'In Stock', '2024-07-21 15:38:08', NULL),
(35, 8, 34, 'DIOR BAG', 'DIOR', 45500, 0, 'Dior Bag<br>', 'dior.jpg', 'dior1.jpg', 'dior2.jpg', 4000, 'In Stock', '2024-07-21 15:40:54', NULL),
(36, 8, 35, 'House of Little Bunny Jeans Series', 'House of Little Bunny', 61000, 0, 'House of Little Bunny Jeans Series<br>', 'HoLB.jpg', 'holb1.jpg', 'holb2.jpg', 4000, 'In Stock', '2024-07-21 15:44:09', NULL),
(37, 12, 22, 'CK womens Annelise Belted Wallet', 'CK', 37500, 0, 'CK womens Annelise Belted Wallet<br>', 'photo_2024-07-22_11-21-18.jpg', 'photo_2024-07-22_11-21-18 (2).jpg', 'photo_2024-07-22_11-21-20.jpg', 4000, 'In Stock', '2024-07-22 05:49:26', NULL),
(38, 12, 22, 'CK ziparound wallet', 'CK', 45000, 0, '<div>size 19cm</div><div>color 4 colors<br></div>', 'photo_2024-07-22_11-21-31.jpg', 'photo_2024-07-22_11-21-34.jpg', 'photo_2024-07-22_11-21-31.jpg', 4000, 'In Stock', '2024-07-22 05:53:28', NULL),
(39, 12, 36, 'David Jones wallet for women', 'David Jones', 35000, 0, 'David Jones wallet for women<br>', 'photo_2024-07-22_11-21-22.jpg', 'photo_2024-07-22_11-21-25.jpg', 'photo_2024-07-22_11-21-28.jpg', 4000, 'In Stock', '2024-07-22 05:56:35', NULL),
(40, 12, 36, 'David Jones wallet for women with Belted', 'David Jones', 30000, 0, 'David Jones wallet for women with Belted<br>', 'photo_2024-07-22_11-21-27.jpg', 'photo_2024-07-22_11-21-26.jpg', 'photo_2024-07-22_11-21-27.jpg', 4000, 'In Stock', '2024-07-22 05:58:32', NULL),
(41, 9, 37, 'School Backpack for Teens Large Corduroy Bookbag', 'Corduroy ', 60000, 75000, 'School Backpack for Teens Large Corduroy Bookbag<br>', 'photo_2024-07-31_21-06-26.jpg', 'pbk1.jfif', 'pbk2.jfif', 4000, 'In Stock', '2024-07-31 14:45:24', NULL),
(42, 9, 38, 'PINCNEL Women Backpack', 'PINCNEL', 78000, 85000, 'PINCNEL Women Backpack<br>', 'bpk.jpg', 'bpk1.jpg', 'bpk2.jpg', 4000, 'In Stock', '2024-07-31 14:51:08', NULL),
(43, 9, 39, 'CHERUTY Women Backpack', 'CHERUTY ', 65000, 75000, 'CHERUTY Women Backpack<br>', 'back.jpg', 'back2.jfif', 'back3.jfif', 4000, 'In Stock', '2024-07-31 14:55:09', NULL),
(44, 12, 40, 'SENDEFN Wallets for Women Genuine Leather Credit Card Holder with RFID Blocking Large Capacity Wristlet', 'SENDEFN', 59000, 65000, 'SENDEFN Wallets for Women Genuine Leather Credit Card Holder with<br>', 'ww.jpg', 'ww1.jpg', 'ww.jpg', 4000, 'In Stock', '2024-07-31 15:03:01', NULL),
(45, 12, 41, 'Bow Wallet for Women Small Coin Purse with Card Holder Ladies wallets PU Leather Zipper', 'Girly and cute', 29000, 35000, 'Bow Wallet for Women Small Coin Purse with Card Holder Ladies wallets PU Leather Zipper<br>', 'boww.jpg', 'boww1.jfif', 'boww2.jfif', 4000, 'In Stock', '2024-07-31 15:07:07', NULL),
(46, 12, 41, 'Cute Wallet for Women Small Coin Purse with Card Holder Ladies wallets PU Leather Zipper', 'other', 18000, 25000, 'Cute Wallet for Women Small Coin Purse with Card Holder Ladies wallets PU Leather Zipper<br>', 'cutew.jpg', 'cutew3.jfif', 'cutew1.jfif', 4000, 'In Stock', '2024-07-31 15:11:26', NULL),
(47, 8, 42, 'Small Purse for Women, Adjustable Shoulder Bags Crocodile Pattern Clutch Purse with Zipper Closure Retro', 'other', 38000, 0, 'Small Purse for Women, Adjustable Shoulder Bags Crocodile Pattern Clutch Purse with Zipper Closure Retro<br>', 'bag.jpg', 'bag2.jfif', 'bag3.jfif', 4000, 'In Stock', '2024-07-31 15:19:03', NULL),
(48, 8, 42, 'Laptop Tote Bag for Women 15.6 Inch Waterproof Leather Computer Bags Women Business Office Work Bag Briefcase Light Purple', 'other', 80000, 0, 'Laptop Tote Bag for Women 15.6 Inch Waterproof Leather Computer Bags Women Business Office Work Bag Briefcase Light Purple<br>', 'bagg2.jfif', 'bagg.jfif', 'bagg3.jfif', 4000, 'In Stock', '2024-07-31 15:23:21', NULL),
(49, 8, 42, 'Evening Bag Women Y2k Silver Purse Hobo Bag Tote Handbag Satchel Bag Cute Party Bag Clutch Purses Crossbody Bags 2024', 'other', 45000, 0, 'Evening Bag Women Y2k Silver Purse Hobo Bag Tote Handbag Satchel Bag Cute Party Bag Clutch Purses Crossbody Bags 2024<br>', 'ev.jpg', 'ev1.jfif', 'ev2.jpg', 4000, 'In Stock', '2024-07-31 15:27:12', NULL),
(50, 8, 17, 'USA Coach Shoulder bag', 'Coach', 450000, 500000, 'USA Coach Shoulder bag<br>', 'c1.jpg', 'c2.jpg', 'c3.jpg', 4000, 'In Stock', '2024-07-31 15:31:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(15, 8, 'CK', '2024-06-25 14:01:57', NULL),
(16, 8, 'MK', '2024-06-25 14:02:09', NULL),
(17, 8, 'Coach', '2024-06-25 14:02:28', NULL),
(18, 9, 'Addidas', '2024-06-25 14:02:44', NULL),
(19, 11, 'LV', '2024-06-25 14:08:23', NULL),
(20, 11, 'Prada', '2024-06-25 14:08:51', NULL),
(21, 12, 'GUCCI', '2024-06-25 14:09:08', NULL),
(22, 12, 'CK', '2024-06-25 14:09:17', NULL),
(23, 9, 'Jester Luxe', '2024-07-18 13:23:00', NULL),
(24, 9, 'JanSport', '2024-07-18 13:40:41', NULL),
(25, 9, 'MATEIN', '2024-07-18 13:49:39', NULL),
(26, 8, 'Prada', '2024-07-20 04:43:14', NULL),
(28, 11, 'Columbia', '2024-07-21 15:19:04', NULL),
(29, 11, 'Carhartt', '2024-07-21 15:22:20', NULL),
(30, 11, 'WOLVERINE', '2024-07-21 15:24:47', NULL),
(31, 11, 'GOIACII', '2024-07-21 15:26:59', NULL),
(32, 11, 'SENDEFN', '2024-07-21 15:28:57', NULL),
(33, 8, 'VERSACE', '2024-07-21 15:36:12', NULL),
(34, 8, 'DIOR', '2024-07-21 15:39:27', NULL),
(35, 8, 'House of Little Bunny', '2024-07-21 15:42:05', NULL),
(36, 12, 'David Jones', '2024-07-22 05:54:30', NULL),
(37, 9, 'Corduroy ', '2024-07-31 14:37:59', NULL),
(38, 9, 'PINCNEL', '2024-07-31 14:46:29', NULL),
(39, 9, 'CHERUTY', '2024-07-31 14:51:52', NULL),
(40, 12, 'SENDEFN ', '2024-07-31 14:59:46', NULL),
(41, 12, 'other', '2024-07-31 15:04:02', NULL),
(42, 8, 'other', '2024-07-31 15:15:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(4, 'phoo@gmail.com', 0x3132372e302e302e3100000000000000, '2024-06-26 12:02:09', '26-06-2024 05:32:43 PM', 1),
(5, 'phoo@gmail.com', 0x3132372e302e302e3100000000000000, '2024-06-26 13:09:00', '26-06-2024 06:52:30 PM', 1),
(6, 'honey@gmail.com', 0x3132372e302e302e3100000000000000, '2024-06-26 13:40:14', '26-06-2024 07:18:01 PM', 1),
(7, 'honey@gmail.com', 0x3132372e302e302e3100000000000000, '2024-07-31 13:52:39', NULL, 0),
(8, 'cherryko@gmail.com', 0x3132372e302e302e3100000000000000, '2024-07-31 13:55:37', '31-07-2024 07:34:10 PM', 1),
(9, 'mimi123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-08-09 02:55:45', '09-08-2024 08:27:42 AM', 1),
(10, 'mimi123@gmail.com', 0x3132372e302e302e3100000000000000, '2024-08-09 03:01:39', NULL, 1),
(11, 'cherryko@gmail.com', 0x3132372e302e302e3100000000000000, '2024-08-28 15:42:01', '28-08-2024 09:15:08 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext DEFAULT NULL,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`) VALUES
(12, 'honey', 'honey123@gmail.com', 9668177999, '00bdd51659640fc00b6c1e63c198f91c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-28 15:57:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `postingDate`) VALUES
(3, 9, 23, '2024-08-09 03:02:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
