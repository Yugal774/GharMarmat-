-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2026 at 01:40 PM
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
-- Database: `gharmarmat`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profession_id` int(11) DEFAULT NULL,
  `professional_name` varchar(255) DEFAULT NULL,
  `work_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `time_slot_id` int(11) NOT NULL,
  `service_address` text NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `username`, `profession_id`, `professional_name`, `work_id`, `booking_date`, `time_slot_id`, `service_address`, `notes`, `status`) VALUES
(1, 'yugal@gmail.com', 3, 'Giru bashnet', 9, '2026-03-19', 1, 'Bishnudevi temple, chandragiri-10, kathmandu', 'Hi we will meet soon', 'confirmed'),
(2, 'yugal@gmail.com', 4, NULL, 15, '2026-03-21', 7, 'Satungal party palace, house no 10', 'Hello', 'pending'),
(3, 'anugya@gmail.com', 2, NULL, 6, '2026-03-28', 7, 'Gurjudhara, Kathmandu', 'Please visit as soon as possible', 'cancelled'),
(4, 'anugya@gmail.com', 1, 'Samir shrestha', 3, '2026-03-20', 2, 'Kalanki, Kathmandu', 'Please contact me', 'confirmed'),
(5, 'nawaj@gmail.com', 3, 'Gauri malla', 10, '2026-03-28', 9, 'Maharajgunj, Kathmandu', 'Hello please pick it up', 'confirmed'),
(6, 'nawaj@gmail.com', 4, NULL, 12, '2026-03-27', 4, 'Gudgau,Nepal house no-5', 'Hope you will be there.', 'cancelled'),
(7, 'yugal@gmail.com', 2, NULL, 6, '2026-03-13', 2, 'Balkhu, kathmandu', 'HI', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `profession`
--

CREATE TABLE `profession` (
  `profession_id` int(10) NOT NULL,
  `profession_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profession`
--

INSERT INTO `profession` (`profession_id`, `profession_name`) VALUES
(1, 'Plumber'),
(2, 'Electrician'),
(3, 'Cleaner'),
(4, 'Painter');

-- --------------------------------------------------------

--
-- Table structure for table `time_categories`
--

CREATE TABLE `time_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_categories`
--

INSERT INTO `time_categories` (`id`, `name`) VALUES
(2, 'Afternoon'),
(3, 'Evening'),
(1, 'Morning');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `time_category` enum('morning','afternoon','evening') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `time_category`, `start_time`, `end_time`) VALUES
(1, 'morning', '06:00:00', '07:00:00'),
(2, 'morning', '07:00:00', '08:00:00'),
(3, 'morning', '09:00:00', '10:00:00'),
(4, 'morning', '10:00:00', '11:00:00'),
(5, 'afternoon', '12:00:00', '13:00:00'),
(6, 'afternoon', '13:00:00', '14:00:00'),
(7, 'afternoon', '14:00:00', '15:00:00'),
(8, 'afternoon', '15:00:00', '16:00:00'),
(9, 'evening', '17:00:00', '18:00:00'),
(10, 'evening', '18:00:00', '19:00:00'),
(11, 'evening', '19:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Contact` bigint(20) DEFAULT NULL,
  `Gmail` varchar(40) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Profession` int(11) DEFAULT NULL,
  `Role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Contact`, `Gmail`, `Address`, `Password`, `Profession`, `Role`) VALUES
(1, '', NULL, 'admin@gmail.com', NULL, '$2y$10$2BzJxpvLUWATtIyi4AJ9yOTUpl.kb1I3tYbOhTUqNdH3fInrljNda', NULL, 'admin'),
(4, 'Yugal rai', NULL, 'yugal@gmail.com', NULL, '$2y$10$yewlSqiQf4NbAsYY00wTTug33oQOlNlE9CTGUMR3kPPlvzbLzm5LG', NULL, 'customer'),
(5, 'Samir shrestha', 9808150253, 'samir@gmail.com', 'Kalanki', '$2y$10$pLQwh.2pwXAoequN3ujhD.OnVhoXrTa8X5utHdUeC7.qVOj.lkJvG', 1, 'professional'),
(6, 'Hari Basnet', 9842144222, 'hari@gmail.com', 'Gurjudhara', '$2y$10$rmFetjQ77m5TGPPsAuK81OQYLtDSP8dEV/pn0k/EBKuzBDVETYNPW', NULL, 'customer'),
(7, 'Shyam Devkota', 9825362130, 'shyam@gmail.com', 'Satungal', '$2y$10$7i40/0aKKmjoDKIRE1Xj.OtOQjXN07TbseHSK6SWmZjmA0vGCNaMC', NULL, 'customer'),
(8, 'Asmita dhakal', 9712362598, 'asmita@gmail.com', 'Bhaktapur', '$2y$10$yHbfN2XxWAAW9foC7E7jJOxTmBX73nzE39OHvvVt7i/uFr2rauZSi', NULL, 'customer'),
(9, 'Keshari shah', 9856470369, 'keshari@gmail.com', 'Lalitpur', '$2y$10$SKppzqLToTq3NEvNBiHsJeyqQRA3WG5NPEO07hbQtsfwqgJPExCKW', NULL, 'customer'),
(10, 'Janak Tamrakar', 9874563218, 'janak@gmail.com', 'Khotang', '$2y$10$Rou5ylR09dBYSCHQBGoWB.zIXOiXx6cgM8yWDryes47XJkCaEZ2uq', NULL, 'customer'),
(11, 'Anugya rai', 9862123089, 'anugya@gmail.com', 'Satungal', '$2y$10$QCQeL3V.qnXAOg4FfwKloOviopfLHEmXytmUxEnJGjXP8vwqGRb4S', NULL, 'customer'),
(12, 'Jeevan Bashyal', 9811111111, 'jeevan@gmail.com', 'Satungal', '$2y$10$avFH9zqZLQFQ5XUIZIJxcOvkPuz2i1ieK7O4bdvgeMaI9.R5piMo.', NULL, 'customer'),
(13, 'Rajib Rai', 9820365698, 'rajib@gmail.com', 'Kathmandu', '$2y$10$ap4Y40Pzn6zgxQ8EZbl1UOWyiKc2CbXbnl7myc8Pak.16sQcy1QH6', 2, 'professional'),
(14, 'Giru bashnet', 9856238956, 'giru@gmail.com', 'Maitidevi', '$2y$10$9o1JpRg/aJQJ6f3Z8L6T7uuajwqX0QfDbG1aCI.TL5yc1bC5XwpS6', 3, 'professional'),
(15, 'Samira rai', 9756486230, 'samira@gmail.com', 'Salleri', '$2y$10$DFCtz279NXNUbBi9bHIR9urfKsdl4wa5p/ekDoparEgf.ScVBu0LW', 4, 'professional'),
(16, 'Sabita Magar', 9810398652, 'nandan11@gmail.com', 'Pokhara', '$2y$10$gvzlx3SvxqpuVLdx7B7NNuVxL5oSnEdOfBhgzNItT2fneEo0549Ha', 4, 'professional'),
(17, 'Gulshan Jha', 9856421563, 'gulshan@gmail.com', 'Sarlahi', '$2y$10$L9fBMS.6bItsqt4qPMAwfO1YlHt.8PqVkafJ20JkpPfx./Lp/1PXa', 1, 'professional'),
(18, 'Gauri malla', 9856231478, 'gauri@gmail.com', 'Manang', '$2y$10$NS7W2A5.vsLPvh4rcN6t5OW6xNyHXnEoJefkzwW2tmIlgFsYnfQVC', 3, 'professional'),
(19, 'Chadani Rai', 9856472310, 'chadani@gmail.com', 'Chaurikharka', '$2y$10$l73dVexNRREIyr07inxjze8PEpSe79O2HHMupwQLpXX9N5xXjLyb6', 2, 'professional'),
(20, 'Nawaj Thapa', 9862124589, 'nawaj@gmail.com', 'Morang', '$2y$10$TJG4Oj..TKYuCegLYbtDCeRc5X6jvXmNl4w6yVrU.HURcDhaVbmdG', NULL, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `work_id` int(11) NOT NULL,
  `profession_id` int(10) NOT NULL,
  `work_name` varchar(255) NOT NULL,
  `work_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `profession_id`, `work_name`, `work_price`) VALUES
(1, 1, 'General plumber', 700.00),
(2, 1, 'Installation plumber', 600.00),
(3, 1, 'Repair plumber', 500.00),
(4, 1, 'Geyser installation plumber', 800.00),
(5, 2, 'General electrician', 800.00),
(6, 2, 'Wiring and maintenance electrician', 650.00),
(7, 2, 'Electrical repair electrician', 600.00),
(8, 2, 'Electrical installation', 700.00),
(9, 3, 'General cleaner', 700.00),
(10, 3, 'Bathroom cleaner', 500.00),
(11, 3, 'Kitchen cleaner', 400.00),
(12, 4, 'Interior wall painting', 400.00),
(13, 4, 'Exterior wall painting', 500.00),
(14, 4, 'Furniture painting', 450.00),
(15, 4, 'Door and window painting', 550.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `time_slot_id` (`time_slot_id`);

--
-- Indexes for table `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`profession_id`);

--
-- Indexes for table `time_categories`
--
ALTER TABLE `time_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `time_category` (`time_category`,`start_time`,`end_time`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`work_id`),
  ADD KEY `profession_id` (`profession_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profession`
--
ALTER TABLE `profession`
  MODIFY `profession_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `time_categories`
--
ALTER TABLE `time_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slots` (`id`);

--
-- Constraints for table `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_ibfk_1` FOREIGN KEY (`profession_id`) REFERENCES `profession` (`profession_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
