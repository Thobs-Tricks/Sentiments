-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 03:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sentiments`
--

-- --------------------------------------------------------

--
-- Table structure for table `bridge`
--

CREATE TABLE `bridge` (
  `Inv_id` int(11) NOT NULL,
  `P_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `U_Price` double NOT NULL,
  `T_Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bridge`
--

INSERT INTO `bridge` (`Inv_id`, `P_Id`, `Quantity`, `U_Price`, `T_Price`) VALUES
(28, 1, 1, 200, 200),
(28, 3, 1, 8000, 8000),
(29, 1, 1, 200, 200),
(29, 3, 1, 8000, 8000),
(30, 1, 1, 200, 200),
(30, 3, 1, 8000, 8000),
(31, 1, 1, 200, 200),
(31, 3, 1, 8000, 8000),
(32, 1, 1, 200, 200),
(32, 3, 1, 8000, 8000),
(33, 1, 1, 200, 200),
(33, 3, 1, 8000, 8000),
(33, 12, 1, 7000, 7000),
(34, 1, 1, 200, 200),
(34, 3, 1, 8000, 8000),
(34, 12, 1, 7000, 7000),
(36, 15, 1, 10000, 10000),
(36, 16, 1, 9000, 9000),
(36, 17, 1, 8000, 8000),
(36, 18, 1, 700, 700),
(38, 1, 1, 200, 200),
(38, 3, 1, 8000, 8000),
(38, 14, 1, 8500, 8500),
(40, 1, 3, 200, 600),
(40, 3, 1, 8000, 8000),
(40, 4, 1, 400, 400),
(40, 5, 1, 450, 450),
(40, 6, 1, 450, 450),
(40, 7, 1, 500, 500),
(40, 8, 1, 300, 300),
(40, 9, 1, 400, 400),
(40, 10, 1, 500, 500),
(40, 11, 1, 500, 500),
(40, 12, 1, 7000, 7000),
(40, 13, 1, 8500, 8500),
(40, 14, 1, 8500, 8500),
(40, 15, 1, 10000, 10000),
(40, 16, 1, 9000, 9000),
(40, 17, 1, 8000, 8000),
(40, 18, 1, 700, 700),
(40, 19, 1, 400, 400),
(40, 20, 1, 400, 400),
(40, 21, 1, 300, 300),
(40, 22, 1, 300, 300),
(40, 23, 1, 400, 400),
(40, 24, 1, 350, 350),
(40, 25, 1, 800, 800),
(41, 1, 1, 200, 200),
(63, 1, 3, 200, 600),
(64, 19, 5, 400, 2000),
(68, 13, 1, 8500, 8500),
(68, 14, 3, 8500, 25500),
(68, 15, 3, 10000, 30000),
(69, 1, 1, 200, 200),
(69, 12, 1, 7000, 7000),
(69, 15, 1, 10000, 10000),
(69, 16, 1, 9000, 9000),
(70, 13, 1, 8500, 8500),
(70, 14, 1, 8500, 8500),
(70, 15, 1, 10000, 10000),
(71, 13, 1, 8500, 8500),
(71, 14, 1, 8500, 8500),
(71, 15, 1, 10000, 10000),
(72, 13, 1, 8500, 8500),
(72, 14, 1, 8500, 8500),
(72, 15, 1, 10000, 10000),
(73, 13, 1, 8500, 8500),
(73, 14, 1, 8500, 8500),
(73, 15, 1, 10000, 10000),
(74, 1, 1, 200, 200),
(74, 3, 1, 8000, 8000),
(75, 1, 3, 200, 600),
(75, 3, 3, 8000, 24000),
(75, 12, 2, 7000, 14000),
(76, 3, 2, 8000, 16000),
(77, 8, 2, 300, 600),
(78, 4, 1, 400, 400),
(78, 22, 2, 300, 600),
(78, 24, 1, 350, 350);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Inv_id` int(11) NOT NULL,
  `U_Id` int(11) NOT NULL,
  `Total_price` decimal(10,0) NOT NULL,
  `Price_Vat` decimal(10,0) NOT NULL,
  `Delivery_fee` decimal(10,0) NOT NULL,
  `Discount` decimal(10,0) NOT NULL,
  `Inv_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Inv_id`, `U_Id`, `Total_price`, `Price_Vat`, `Delivery_fee`, `Discount`, `Inv_date`) VALUES
(1, 26, 47400, 200, 0, 0, '2023-10-06'),
(2, 26, 47400, 200, 0, 0, '2023-10-06'),
(3, 26, 47400, 200, 0, 0, '2023-10-06'),
(4, 26, 47400, 200, 0, 0, '2023-10-06'),
(5, 26, 47400, 200, 0, 0, '2023-10-06'),
(6, 26, 47400, 200, 0, 0, '2023-10-06'),
(7, 26, 47400, 200, 0, 0, '2023-10-06'),
(8, 26, 47400, 200, 0, 0, '2023-10-06'),
(9, 26, 47400, 200, 0, 0, '2023-10-06'),
(10, 26, 47400, 200, 0, 0, '2023-10-06'),
(11, 26, 47400, 200, 0, 0, '2023-10-06'),
(12, 26, 47400, 200, 0, 0, '2023-10-06'),
(13, 26, 47400, 200, 0, 0, '2023-10-06'),
(14, 26, 47400, 200, 0, 0, '2023-10-06'),
(15, 26, 16400, 200, 0, 0, '2023-10-08'),
(16, 26, 16400, 200, 0, 0, '2023-10-08'),
(17, 26, 0, 0, 0, 0, '2023-10-08'),
(18, 26, 0, 0, 0, 0, '2023-10-08'),
(19, 26, 0, 0, 0, 0, '2023-10-08'),
(20, 26, 0, 0, 0, 0, '2023-10-08'),
(21, 26, 0, 0, 0, 0, '2023-10-08'),
(22, 26, 0, 0, 0, 0, '2023-10-08'),
(23, 26, 0, 0, 0, 0, '2023-10-08'),
(24, 26, 0, 0, 0, 0, '2023-10-08'),
(25, 26, 0, 0, 0, 0, '2023-10-08'),
(26, 26, 0, 0, 0, 0, '2023-10-08'),
(27, 26, 0, 0, 0, 0, '2023-10-08'),
(28, 26, 0, 0, 0, 0, '2023-10-08'),
(29, 26, 0, 0, 0, 0, '2023-10-08'),
(30, 26, 0, 0, 0, 0, '2023-10-08'),
(31, 26, 0, 0, 0, 0, '2023-10-08'),
(32, 26, 0, 0, 0, 0, '2023-10-08'),
(33, 38, 0, 0, 0, 0, '2023-10-09'),
(34, 38, 15200, 2280, 0, 0, '2023-10-09'),
(35, 38, 0, 0, 0, 0, '2023-10-09'),
(36, 38, 27700, 4155, 0, 0, '2023-10-09'),
(37, 38, 0, 0, 0, 0, '2023-10-09'),
(38, 38, 16700, 2505, 0, 0, '2023-10-09'),
(39, 38, 0, 0, 0, 0, '2023-10-09'),
(40, 38, 66750, 10013, 0, 0, '2023-10-09'),
(41, 38, 200, 30, 0, 0, '2023-10-09'),
(42, 38, 0, 0, 0, 0, '2023-10-11'),
(43, 38, 0, 0, 0, 0, '2023-10-11'),
(44, 38, 0, 0, 0, 0, '2023-10-11'),
(45, 38, 0, 0, 0, 0, '2023-10-11'),
(46, 38, 0, 0, 0, 0, '2023-10-11'),
(47, 38, 0, 0, 0, 0, '2023-10-11'),
(48, 38, 0, 0, 0, 0, '2023-10-11'),
(49, 38, 0, 0, 0, 0, '2023-10-11'),
(50, 38, 0, 0, 0, 0, '2023-10-11'),
(51, 38, 0, 0, 0, 0, '2023-10-11'),
(52, 38, 0, 0, 0, 0, '2023-10-11'),
(53, 38, 0, 0, 0, 0, '2023-10-11'),
(54, 38, 0, 0, 0, 0, '2023-10-11'),
(55, 38, 0, 0, 0, 0, '2023-10-11'),
(56, 38, 0, 0, 0, 0, '2023-10-11'),
(57, 38, 0, 0, 0, 0, '2023-10-11'),
(58, 38, 0, 0, 0, 0, '2023-10-11'),
(59, 38, 0, 0, 0, 0, '2023-10-11'),
(60, 38, 0, 0, 0, 0, '2023-10-11'),
(61, 38, 0, 0, 0, 0, '2023-10-11'),
(62, 38, 0, 0, 0, 0, '2023-10-11'),
(63, 38, 22140, 3209, 0, 0, '2023-10-11'),
(64, 38, 4900, 0, 0, 0, '2023-10-11'),
(65, 38, 0, 0, 0, 0, '2023-10-11'),
(66, 38, 0, 0, 0, 0, '2023-10-11'),
(67, 38, 0, 0, 0, 0, '2023-10-11'),
(68, 38, 64000, 8348, 0, 0, '2023-10-11'),
(69, 38, 26200, 3417, 0, 0, '2023-10-11'),
(70, 38, 0, 0, 0, 0, '2023-10-11'),
(71, 38, 0, 0, 0, 0, '2023-10-11'),
(72, 38, 0, 0, 0, 0, '2023-10-11'),
(73, 38, 27000, 3522, 0, 0, '2023-10-11'),
(74, 38, 7380, 1070, 0, 10, '2023-10-11'),
(75, 38, 34740, 5035, 0, 10, '2023-10-11'),
(76, 45, 16000, 2087, 0, 0, '2023-10-11'),
(77, 45, 600, 78, 0, 0, '2023-10-11'),
(78, 45, 1215, 176, 0, 10, '2023-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `produts`
--

CREATE TABLE `produts` (
  `P_ID` int(11) NOT NULL,
  `P_Image` varchar(255) NOT NULL,
  `P_Name` varchar(50) NOT NULL,
  `P_Description` varchar(255) NOT NULL,
  `P_Price` decimal(10,0) NOT NULL,
  `P_Category_Type` varchar(255) NOT NULL,
  `Prod_qty` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produts`
--

INSERT INTO `produts` (`P_ID`, `P_Image`, `P_Name`, `P_Description`, `P_Price`, `P_Category_Type`, `Prod_qty`) VALUES
(1, 'download2.png', 'Teddy', 'This is a wedding ', 200, 'Wedding', 8),
(3, 'Ring1.png', 'Diamond Ring', 'Diamond Ring', 8000, 'Wedding', 3),
(4, 'T1.png', 'Teddy', 'Brown Teddy', 400, 'Valentines', 0),
(5, 'T2.png', 'Teddy', 'White Teddy', 450, 'Valentines', 0),
(6, 'T4.png', 'Teddy', 'White Teddy', 450, 'Valentines', 0),
(7, 'T5.png', 'Teddy', 'Purple Teddy', 500, 'Birthday', 0),
(8, 'T6.png', 'Teddy', 'Brown Teddy', 300, 'Birthday', 0),
(9, 'T7.png', 'Teddy', 'Brown Teddy', 400, 'Birthday', 0),
(10, 'T8.png', 'Teddy', 'Pink Teddy', 500, 'Birthday', 0),
(11, 'T9.png', 'Teddy', 'Pink Teddy', 500, 'Birthday', 0),
(12, 'R1.png', 'Ring', 'Diamond Gold Silver', 7000, 'Wedding', 3),
(13, 'R2.png', 'Ring', 'Male Gold Ring', 8500, 'Wedding', 0),
(14, 'R3.png', 'Ring', 'Diamond Gold Ring', 8500, 'Wedding', 0),
(15, 'R4.png', 'Ring', 'Diamond Love Ring', 10000, 'Wedding', 0),
(16, 'R5.png', 'Ring', 'Silver Diamond Ring', 9000, 'Wedding', 0),
(17, 'R6.png', 'Ring', 'Gold Ring', 8000, 'Wedding', 0),
(18, 'P1.png', 'Plate', 'Plate Set', 700, 'Wedding', 0),
(19, 'P2.png', 'Bowl', 'White Bowl Set', 400, 'Wedding', 0),
(20, 'P3.png', 'Grind Mixer', 'Grinder Mixer', 400, 'Wedding', 0),
(21, 'P4.png', 'Kettle', 'Kettle', 300, 'Wedding', 0),
(22, 'P5.png', 'Toaster', 'Bread Toaster', 300, 'Wedding', 0),
(23, 'P6.png', 'Mixer Grinder', 'Mixer Grinder', 400, 'Wedding', 0),
(24, 'P7.png', 'Spoon', 'Spoon Set', 350, 'Wedding', 0),
(25, 'W1.png', 'Watch', 'Casio Watch', 800, 'Birthday', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 3, 'GGS', '2023-10-11 10:20:28'),
(2, 3, 3, 'I love This product', '2023-10-11 10:22:35'),
(3, 5, 3, 'I love This product', '2023-10-11 10:23:44'),
(4, 1, 5, 'I love This Product', '2023-10-11 11:54:27'),
(5, 1, 2, 'This is bad', '2023-10-11 11:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `user_id`, `user_content`) VALUES
(7, 26, 'Content for User Name 01'),
(8, 27, 'Content for User Name 03'),
(9, 28, 'Content for User Name 02'),
(10, 37, 'I love This Website'),
(15, 0, 'This is the best service ever'),
(16, 0, 'dghd'),
(17, 26, 'df'),
(18, 26, 'df'),
(19, 38, 'I love This Website Too Much');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `F_Name` varchar(255) NOT NULL,
  `L_Name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(10) NOT NULL,
  `Gender` varchar(25) NOT NULL,
  `DOB` date DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Email`, `F_Name`, `L_Name`, `Password`, `role`, `Address`, `Phone`, `Gender`, `DOB`, `registration_date`, `last_login`) VALUES
(26, 'retshidi10@gmail.com', 'Retshidisitswe', 'Radebe', '$2y$10$3Vzqr3ONuiyeDiS/zEmdJeIW23gXNTOcP1eHvRj8DFIVZWdGZqn/K', 'admin', NULL, '', '', NULL, '2023-09-06 12:27:50', '2023-08-10 18:24:03'),
(27, 'rt@ef', 'eew', 'gfg', '$2y$10$1R.ms5MX1e0JXyiAMgUbhOVUpjYOOtuC3luKXhjcCt.iQjklGsS3S', 'admin', NULL, '', '', NULL, '2023-09-06 12:27:50', '2023-08-12 20:27:11'),
(28, 'sd', 'gfg', 'sd', '$2y$10$0AnBUgdjxRPTPwm0OAznF.c6aoMjEcrxaFY6iamI.13MBX472eUfu', 'admin', NULL, '', '', NULL, '2023-09-06 12:27:50', '2023-08-14 20:34:13'),
(29, 'sddsd@gmail.mail', 'TT', 'Stones', '$2y$10$4NEtD5AlEpfXZzmTUKZspOU2cV3r2uQonEXqsu/9c7Gca1wa5D1W.', 'admin', '4707 Dodoma cresent', '076465556', 'male', '2023-09-06', '2023-09-06 12:27:50', '2023-09-21 12:39:28'),
(30, 'sddsd@', 'dds', 'dsfd', '$2y$10$nsrt1nXC80JpMsxRjZMF/ev2tNcCG0xWoQj7LReGNNMx/tatmFePO', 'admin', NULL, '', '', NULL, '2023-09-06 12:27:50', '2023-08-28 12:10:19'),
(31, 'sds', 'dsd', 'sd', '$2y$10$GM5uxS41Bvqlcu1.Z9Esmur3.ss86oiYFDB3wLAOA/GIkugtc7Ol6', 'admin', NULL, '', '', NULL, '2023-09-06 12:27:50', '2023-08-14 20:36:08'),
(32, 'sdsdsd', 'dssd', 'sdsd', '$2y$10$BzNzb48fQiZWTy5nlIq9c.4A5YX7tuUhbEbw9cmwJMGnMYAsUuOiq', 'admin', NULL, '', '', NULL, '2023-09-06 12:27:50', '2023-08-14 21:16:10'),
(33, 'ttyw', 'ss', '232', '$2y$10$flouP5FPMxci7IeyXhpQhOi.i.Dvquw8eNzzTV2lQYur38EaEFHZS', 'admin', NULL, '', '', NULL, '2023-09-06 12:27:50', '2023-08-28 11:38:09'),
(34, 'sds@gg', 'ds', 'sds', '$2y$10$61JhOjdk2jTBnFlbR4PIo.kxbqoh/1i2AiwS9eogeoxi6yMBG0R2W', 'customer', '', '222', 'male', '0000-00-00', '2023-09-06 16:04:28', '2023-09-06 16:04:28'),
(35, '33345@sd', 'dsd', 'sds', '$2y$10$hYQiu52bTvml/3fKC3i76.jFbZu4acy2Vz/000MXItYzEPKSzV1vy', 'customer', '4788 fofo fo', '1255', 'female', '2023-09-06', '2023-09-06 16:06:00', '2023-09-21 00:02:16'),
(36, 'Pou@p', '1', '1', '$2y$10$tw7taeeCYOzplHjVgLPtzuWG3830gSAvG5jHpNcs/YZDjIlpM8IuC', 'customer', '', '12', 'male', '0000-00-00', '2023-09-06 16:33:15', '2023-09-06 16:33:15'),
(37, 'petrosmaps@gmail.com', 'Petros', 'Maphalle', '$2y$10$rAoR6uEACmCSAJYIAWLque3id.wNQ3Of7Ky1PoM4wfudLNrqOEUru', 'admin', '221 Summer 2023', '0726667291', 'male', '0000-00-00', '2023-09-11 08:48:30', '2023-09-11 08:48:30'),
(38, '111@333', 'Petros', 'Maphalle', '$2y$10$vZrZ/V5T4.sBdnnp6Y.E8.BELKc3fbCOMLvaVD7liWXmivOfamD3a', 'customer', '4707 Boliv', '333444434', 'male', '2023-09-27', '2023-09-21 00:04:46', '2023-09-21 13:52:02'),
(39, 'halle@gmail.com', 'Petros', 'Maphalle', '$2y$10$7qzQa/0Tr8lZdKRhToc9ku9NuuFBybVNjpPmmlOzBZ9eciQmKahTi', 'customer', '4707', '764633031', 'male', '2023-11-02', '2023-10-04 18:39:39', '2023-10-04 18:39:39'),
(40, 'kkk@ggs', 'yukj', 'sddsd', '$2y$10$toAiK2gxRRRv8b07sOe4DOI08tZfHsN4hTVIB2tjMi1F8mOtotNYm', 'customer', '', '443', 'male', '2023-11-01', '2023-10-05 12:28:44', '2023-10-05 12:28:44'),
(41, 'rrr@gg', 'dsds', '3434', '$2y$10$r.SeZW7ePzldHcKOmEQh3.PGek11/dpdo15eUhIO.97WIJXaE9nq6', 'customer', '', '12', 'male', '0000-00-00', '2023-10-05 12:30:19', '2023-10-05 12:30:19'),
(42, 'FF@gmail.com', 'Petros', 'Maphalle', '$2y$10$4Bgym/TncOHnHoB6iYEfA.ZSaRIRX0sxAIeWqhwt6/LKqlsJR/O8y', 'customer', '4707', '764633031', 'male', '2023-10-24', '2023-10-05 14:47:28', '2023-10-05 14:47:28'),
(43, 'petroshalle@gmail.com', 'Petros', 'Maphalle', '$2y$10$OIluQ379R57GvwKBkDzQbuF/.FnR6OLesc75HiRB72rMIhFTsE3ma', 'customer', '4707', '764633031', 'male', '0000-00-00', '2023-10-06 15:42:09', '2023-10-06 15:42:09'),
(44, 'eee@r', 'rrrrt', 'mapheet', '$2y$10$iiq3MrlS5vJ3OtSvllfiuuZS6MQu9QmEVughLd/1FQi/xmjD8y5tK', 'customer', '', '5667', 'male', '2023-10-20', '2023-10-10 17:54:33', '2023-10-10 17:54:33'),
(45, '111@33', 'dff', 'dfdf', '$2y$10$c6WO2FQY8PUU8yNdRqT3Y.FEZ5Z/qXWK4t2lWYCkk28GFVPTsdZ8C', 'customer', '', '1122', 'male', '0000-00-00', '2023-10-11 11:56:29', '2023-10-11 11:56:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bridge`
--
ALTER TABLE `bridge`
  ADD PRIMARY KEY (`Inv_id`,`P_Id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Inv_id`),
  ADD KEY `U_Id` (`U_Id`);

--
-- Indexes for table `produts`
--
ALTER TABLE `produts`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `produts`
--
ALTER TABLE `produts`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`U_Id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
