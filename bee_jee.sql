-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2016 at 10:21 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bee_jee`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '/src/uploads/user-default.jpg',
  `status` varchar(255) DEFAULT 'reviewing',
  `modified` tinyint(1) DEFAULT '0',
  `updated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `comment`, `image`, `status`, `modified`, `updated`) VALUES
(1, 'LeXXuSSS', 'ffd@gm.re', 'Test', '/src/uploads/5ceb146cd99f.png', 'reviewing', 1, '2016-08-15 18:48:48'),
(2, 'Alex', 'alexxx.tsyk@gmail.com', 'Ala bala. This is second feed back. Ala bala. This is second feed back. Ala bala. This is second feed back. Ala bala. This is second feed back.', '/src/uploads/9f77ab850cf9.png', 'reviewing', 1, '2016-08-15 18:48:48'),
(3, 'Alex', 'alexxx.tsyk@gmail.com', 'ЖГШГШГШШШШ', '/src/uploads/user-default.jpg', 'reviewing', 0, '2016-08-16 09:26:18'),
(4, 'feewdf', 'alexxx.tsyk@gmail.com', 'KHGFKGHVEdhjveblcjkhGlchjge', '/src/uploads/dc4da4cb3802.png', 'accepted', 1, '2016-08-16 09:26:43'),
(5, 'Arina', 'sadasdf@uhj.com', 'ТОРЩОЦВщшожщушвожщуцвц', '/src/uploads/user-default.jpg', 'accepted', 1, '2016-08-16 21:06:33'),
(6, 'Alex!!!', 'alexxx.tsyk@gmail.com', 'уцвауцватзщукцльтадуцжьэжуцдбавуцвауцаука', '/src/uploads/95b12429169f.png', 'reviewing', 0, '2016-08-16 21:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `pass`, `role`) VALUES
(1, 'Alex', '123455', 'user'),
(2, 'admin', '123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
