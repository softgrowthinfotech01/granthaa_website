-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2026 at 07:58 AM
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
-- Database: `anushkaf_granthaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `email` varchar(11) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Adarsh More', 'moreyadarsh', '0902 234 7211'),
(3, '1', '1@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Adarsh Morey', 'moreyadarsh0@gmail.com', '0902 234 7211'),
(5, '1', '1@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_location` varchar(100) NOT NULL,
  `project_status` varchar(100) NOT NULL,
  `project_image1` varchar(100) NOT NULL,
  `project_image2` varchar(255) DEFAULT NULL,
  `project_image3` varchar(255) DEFAULT NULL,
  `project_details1` varchar(1000) NOT NULL,
  `project_details2` varchar(1000) NOT NULL,
  `project_details3` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `project_location`, `project_status`, `project_image1`, `project_image2`, `project_image3`, `project_details1`, `project_details2`, `project_details3`) VALUES
(17, 'INFINITY PARK', '', 'Current', '1770974098_1_infinity park.jpeg', '1770974098_2_infinity park layout.jpeg', '', 'Infinity Park – Grantha\r\nInfinity Park is a beautifully designed green space that enhances the overall lifestyle experience within the project.\r\n\r\nFeaturing landscaped gardens, walking paths, and open seating areas, the park encourages healthy outdoor activities and social interaction.\r\n\r\nSurrounded by landscaped greenery, walking trails, and leisure seating, the park promotes active lifestyles while creating a welcoming social environment.', 'Infinity Park – Your Gateway to Peaceful Living\r\nInfinity Park is a thoughtfully planned residential plotting project located in Chandrapur, offering a perfect blend of nature and modern infrastructure. Designed for comfortable living and smart investment, the project provides well-developed plots with essential amenities including internal roads, drainage, electricity, and water facilities.\r\n\r\nWith quality development, clear access routes, and future growth potential, Infinity Park is an ideal destination to build your dream home or grow your property investment.', ''),
(18, 'SHOBHAA RESIDENCY', '', 'Current', '1770975345_1_Shobha residency plan.jpeg', '', '', 'Elevated Living at Shobhaa Residency\r\nShobhaa Residency is a premium residential plot development created for those who value location, quality planning, and smart investment opportunities. Strategically located with excellent road access, the project offers NA-approved plots with bank finance availability and easy EMI options. Surrounded by open green spaces and supported by modern infrastructure, Shobhaa Residency promises peaceful living with strong appreciation potential—making it the perfect choice for building your dream home or securing a high-growth property investment.', '', ''),
(19, 'D.S.K', '', 'Current', '1770975493_1_facilities.png', '1770975493_2_specialities img.png', '1770975493_3_layout 1.jpeg', 'Well-Planned Facilities for Better Living\r\nD.S.K. RadhaKrishna Nagari offers thoughtfully planned amenities designed to give you comfort, convenience, and long-term value. The project features well-developed WPM internal roads, proper drainage systems, bright street lighting, and open green spaces that create a peaceful living environment.\r\n\r\nResidents enjoy landscaped open areas for relaxation, safe internal roads for smooth connectivity, and modern infrastructure that supports everyday needs. Every plot is carefully developed to ensure easy access, cleanliness, and future-ready living — making it an ideal choice for families and smart investors alike.', 'Premium Plots with Trusted Development\r\nD.S.K. RadhaKrishna Nagari brings you premium residential plots at an affordable price in a rapidly developing location. With NATP-sanctioned plots and clear legal documentation, this project offers complete peace of mind for buyers.\r\n\r\nEnjoy flexible payment options with up to 12 months easy installments, making ownership simpler than ever. Located near the city’s upcoming growth zone, the project provides excellent investment potential along with plots suitable for immediate home construction.', 'Well-Planned Facilities for Better Living\r\nD.S.K. RadhaKrishna Nagari offers thoughtfully planned amenities designed to give you comfort, convenience, and long-term value. The project features well-developed WPM internal roads, proper drainage systems, bright street lighting, and open green spaces that create a peaceful living environment.\r\n\r\nResidents enjoy landscaped open areas for relaxation, safe internal roads for smooth connectivity, and modern infrastructure that supports everyday needs. Every plot is carefully developed to ensure easy access, cleanliness, and future-ready living — making it an ideal choice for families and smart investors alike.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
