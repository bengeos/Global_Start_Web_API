-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2016 at 01:26 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `global_start`
--

-- --------------------------------------------------------

--
-- Table structure for table `NewsFeeds`
--

CREATE TABLE `NewsFeeds` (
  `id` int(11) NOT NULL,
  `Title` varchar(500) NOT NULL,
  `Content` varchar(1000) NOT NULL,
  `Image_URL` varchar(5000) DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `NewsFeeds`
--

INSERT INTO `NewsFeeds` (`id`, `Title`, `Content`, `Image_URL`, `Created`) VALUES
(1, 'This is the Title', 'This is the content of the news', 'http://192.168.43.156/GlobalStart/Public/Images/ben.jpeg\r\n', '2016-06-30 17:08:21'),
(2, 'asdasd', 'dasdasd', 'http://192.168.43.156/GlobalStart/Public/Images/ben.jpeg\r\n', '2016-06-30 17:36:12'),
(3, 'asdasd', 'dasdasd', 'http://192.168.43.156/GlobalStart/Public/Images/ben.jpeg\r\n', '2016-06-30 17:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `NewsFeeds_Log`
--

CREATE TABLE `NewsFeeds_Log` (
  `id` int(11) NOT NULL,
  `User_ID` varchar(50) NOT NULL,
  `NewsFeed_ID` int(11) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `NewsFeeds_Log`
--

INSERT INTO `NewsFeeds_Log` (`id`, `User_ID`, `NewsFeed_ID`, `Created`) VALUES
(18, '31423424', 1, '2016-07-01 04:50:34'),
(19, '31423424', 2, '2016-07-01 04:50:34'),
(20, '31423424', 3, '2016-07-01 04:50:34'),
(39, '352584066232031', 1, '2016-07-01 06:50:20'),
(40, '352584066232031', 2, '2016-07-01 06:50:20'),
(41, '352584066232031', 3, '2016-07-01 06:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `Testimony`
--

CREATE TABLE `Testimony` (
  `id` int(11) NOT NULL,
  `User_ID` varchar(1000) NOT NULL,
  `Title` varchar(1000) NOT NULL,
  `Content` varchar(1000) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Testimony`
--

INSERT INTO `Testimony` (`id`, `User_ID`, `Title`, `Content`, `Created`) VALUES
(1, '352584066232031', 'ghhtf hhbh', 'hhdhdh yjgy yjvfv', '2016-07-01 08:04:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `NewsFeeds`
--
ALTER TABLE `NewsFeeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `NewsFeeds_Log`
--
ALTER TABLE `NewsFeeds_Log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `User_ID` (`User_ID`,`NewsFeed_ID`),
  ADD KEY `NewsFeed_ID` (`NewsFeed_ID`);

--
-- Indexes for table `Testimony`
--
ALTER TABLE `Testimony`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `NewsFeeds`
--
ALTER TABLE `NewsFeeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `NewsFeeds_Log`
--
ALTER TABLE `NewsFeeds_Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `Testimony`
--
ALTER TABLE `Testimony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `NewsFeeds_Log`
--
ALTER TABLE `NewsFeeds_Log`
  ADD CONSTRAINT `newsfeeds_log_ibfk_1` FOREIGN KEY (`NewsFeed_ID`) REFERENCES `NewsFeeds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
