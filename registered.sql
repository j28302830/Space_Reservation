-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2024 at 01:29 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registered`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockdate`
--

CREATE TABLE `blockdate` (
  `bid` int NOT NULL,
  `date` date NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `rid` int NOT NULL,
  `id` int NOT NULL,
  `sid` int NOT NULL,
  `period` char(1) NOT NULL,
  `rdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `sid` int NOT NULL,
  `location` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `num` int UNSIGNED NOT NULL,
  `socket` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`sid`, `location`, `num`, `socket`) VALUES
(1, 'A', 1, 0),
(2, 'A', 2, 1),
(3, 'A', 3, 1),
(4, 'A', 4, 1),
(5, 'A', 5, 0),
(6, 'A', 6, 0),
(7, 'A', 7, 1),
(8, 'A', 8, 1),
(9, 'A', 9, 0),
(10, 'A', 10, 1),
(11, 'A', 11, 0),
(12, 'A', 12, 1),
(13, 'A', 13, 0),
(14, 'A', 14, 0),
(15, 'A', 15, 0),
(16, 'A', 16, 1),
(17, 'A', 17, 0),
(18, 'A', 18, 0),
(19, 'A', 19, 1),
(20, 'A', 20, 0),
(21, 'B', 1, 1),
(22, 'B', 2, 1),
(23, 'B', 3, 1),
(24, 'B', 4, 1),
(25, 'B', 5, 0),
(26, 'B', 6, 1),
(27, 'B', 7, 1),
(28, 'B', 8, 1),
(29, 'B', 9, 0),
(30, 'B', 10, 0),
(31, 'B', 11, 0),
(32, 'B', 12, 0),
(33, 'B', 13, 1),
(34, 'B', 14, 0),
(35, 'B', 15, 1),
(36, 'B', 16, 1),
(37, 'B', 17, 0),
(38, 'B', 18, 1),
(39, 'B', 19, 0),
(40, 'B', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `reg_date`) VALUES
(10, 'M123140002', 'aa28302830@gmail.com', '$2y$10$/8b55CHCPSJsQlQ08xkjSu/yhfzA4rqP7qL3JQMLkO4YnvpbHym6i', 0, '2024-05-06 19:36:50'),
(12, 'root', 'root@gmail.com', '$2y$10$NUmmtvhkKZC4Qa9iKOGWZOdEpF7fsTOY6zoU0WeBYNffyoP5o1Xxq', 0, '2024-05-07 16:00:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockdate`
--
ALTER TABLE `blockdate`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `id` (`id`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `rid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sid` FOREIGN KEY (`sid`) REFERENCES `seats` (`sid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
