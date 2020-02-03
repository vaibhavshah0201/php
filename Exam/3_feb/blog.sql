-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2020 at 05:41 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `blogId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `blogTitle` varchar(255) NOT NULL,
  `blogUrl` varchar(255) NOT NULL,
  `blogContent` text NOT NULL,
  `blogImage` varchar(255) NOT NULL,
  `blogPublishAt` date NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `catParentId` int(11) NOT NULL,
  `catTitle` varchar(255) NOT NULL,
  `catMetaTitle` varchar(255) NOT NULL,
  `catUrl` varchar(255) NOT NULL,
  `catContent` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `catParentId`, `catTitle`, `catMetaTitle`, `catUrl`, `catContent`, `createdAt`, `updatedAt`) VALUES
(3, 2, 'text', 'asdfasdf', 'www.abc.com', 'asdfasdf', '2020-02-03 11:22:28', '2020-02-03 11:22:28'),
(5, 1, 'asdf', 'asdfasdf', 'www.abc.dom', 'asdf', '2020-02-03 11:22:53', '2020-02-03 11:22:53'),
(6, 2, 'textasdf', 'asdfasdf', 'asdfadsf', 'asdfasdf', '2020-02-03 11:23:11', '2020-02-03 11:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `parentCategory`
--

CREATE TABLE `parentCategory` (
  `catParentId` int(11) NOT NULL,
  `catParentName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parentCategory`
--

INSERT INTO `parentCategory` (`catParentId`, `catParentName`) VALUES
(1, 'Lifestyle'),
(2, 'Travel');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `blogId` int(11) NOT NULL,
  `catId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userPrefix` varchar(5) NOT NULL,
  `userFirstName` varchar(30) NOT NULL,
  `userLastName` varchar(30) NOT NULL,
  `userMobile` bigint(11) NOT NULL,
  `userEmail` varchar(30) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userLastLogin` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userInfo` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userPrefix`, `userFirstName`, `userLastName`, `userMobile`, `userEmail`, `userPassword`, `userLastLogin`, `userInfo`, `createdAt`, `updatedAt`) VALUES
(4, 'Mr', 'Vaibhav', 'Shah', 9537385306, 'vaibhav.sanskar@gmail.com', '912ec803b2ce49e4a541068d495ab570', '2020-02-03 08:59:12', 'asdf', '2020-02-03 08:59:12', '2020-02-03 08:59:12'),
(5, 'Mr', 'Devyani', 'Hirani', 942938172, 'Devyani.hirani2899@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-03 09:17:25', 'asdf', '2020-02-03 09:17:25', '2020-02-03 09:17:25'),
(7, 'Mr', 'Vaibhav', 'Shah', 953738536, 'kevinshah@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-03 09:20:58', '123', '2020-02-03 09:20:58', '2020-02-03 09:20:58'),
(8, 'Mr', 'Vaibhav', 'Shah', 8537385306, 'vaibhav@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-03 09:38:52', '123123', '2020-02-03 09:38:52', '2020-02-03 09:38:52'),
(9, 'Mr', 'Vaibhav', 'Shah', 7894561230, 'kevin@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-03 09:43:12', '123132', '2020-02-03 09:43:12', '2020-02-03 09:43:12'),
(10, 'Mr', 'Demo', 'Demo', 9537385300, 'demo@demo.com', 'fe01ce2a7fbac8fafaed7c982a04e229', '2020-02-03 11:25:01', 'this is demo', '2020-02-03 11:25:01', '2020-02-03 11:25:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`blogId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`),
  ADD KEY `catParentId` (`catParentId`);

--
-- Indexes for table `parentCategory`
--
ALTER TABLE `parentCategory`
  ADD PRIMARY KEY (`catParentId`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD KEY `blogId` (`blogId`),
  ADD KEY `catId` (`catId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `userMobile` (`userMobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parentCategory`
--
ALTER TABLE `parentCategory`
  MODIFY `catParentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`catParentId`) REFERENCES `parentCategory` (`catParentId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `category` (`catId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`blogId`) REFERENCES `blog_post` (`blogId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
