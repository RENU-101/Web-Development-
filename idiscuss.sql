-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 05:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idiscuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `Date`) VALUES
(1, 'Python', 'Python is an interpreted, high-level, general-purpose programming language. Created by Guido van Rossum and first released in 1991, Python\'s design philosophy emphasizes code readability with its notable use of significant whitespace.', '2020-08-06 10:17:55'),
(2, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-or', '2020-08-06 10:18:56'),
(3, 'Java', 'Java is a general-purpose programming language that is class-based, object-oriented, and designed to have as few implementation dependencies as possible.', '0000-00-00 00:00:00'),
(4, 'Django', 'Django is a Python-based free and open-source web framework that follows the model-template-view architectural pattern. It is maintained by the Django Software Foundation, an American independent organization established as a 501 non-profit.', '2020-08-06 14:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(20) NOT NULL,
  `comment_by` varchar(30) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `thread_id` int(30) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int(7) NOT NULL,
  `thread_user_id` int(7) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Sno.` int(11) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Sno.`, `user_email`, `user_pass`, `Date`) VALUES
(1, 'renu@gmail.com', '123', '2020-08-08 08:51:10'),
(2, 'st@gmail.com', 'dqs', '2020-08-08 09:05:02'),
(3, 'ad@gmail.com', '$2y$10$k2eRJ5QBbqcRsfqavvHaRO78HCROb/J7SwFr/eK/cLLTcPwr2eTH6', '2020-08-08 10:35:03'),
(4, 'renubedia101@gmail.com', '$2y$10$ZikfTQhLqwv96y.7yG5OIeyZ6N6U/RWg3kAnBBcAY67mt3ZhnfYvq', '2020-08-08 10:36:59'),
(5, 'renubedia11@gmail.com', '$2y$10$dpCfwWEVnGADBJ67lZ4rfOoMWASn56ImJNqtgIvszQ363/o6JmLlq', '2020-08-08 10:38:32'),
(6, 'roj@gmail.com', '$2y$10$2KEDoARNU88fckOh1ZzRT.MaR5vzkLWxBq20tDNdpaHDTbwUsXtgO', '2020-08-08 10:46:06'),
(7, 'roni@gmail.com', '$2y$10$pEy25OK5nEe/9JUotxWgke.cRK4UEWJSDi/Pben1vzh0QL8Zk8Ygq', '2020-08-08 10:47:59'),
(8, 'roma@gmail.com', '$2y$10$R6efwckIXucQsorNtDkyYuaDw610lVoDGZd5aoGEKYISlFnIqwFtW', '2020-08-08 10:48:19'),
(9, 'ranu@gmail.com', '$2y$10$zXWUmeDtpCva8ZcNnyZcy.Vy2oXQN6B8PHnL2YZzP.5vdK9Xwx/b.', '2020-08-08 10:53:07'),
(10, 'ruhi@gmail.com', '$2y$10$0ysNPnB5O8ApJj8qfL3kAeKMDe1NWdcLrZNXxnOPDJ6KIjIh5K77S', '2020-08-08 11:20:09'),
(11, 'sohan@gmail.com', '$2y$10$jxW5ECk.6n4SwlhuLDlfS.J7AJSD6YU8daG0KzKgr7CgLPdI/a3A2', '2020-08-08 11:27:45'),
(12, 'dm@gmail.com', '$2y$10$/T/5deCqA2XC/cSSp8o1OeTD/OeVk98F0yEHaedjtV7CbclgQGZ2e', '2020-08-08 17:58:52'),
(13, 're@gmail.com', '$2y$10$thCbg3UkmTZfuYB7dYp51.mL14YNjnNNZvu0EJOLROFfq.zCUfRDC', '2020-08-08 20:16:03'),
(14, 'sikha@g.com', '$2y$10$JiE0sdQkf90ojgCSxOmIOeNUYAnvkYu/UXmNh/B5AIq5ZQjHert8q', '2020-08-09 08:07:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Sno.`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `thread_id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Sno.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
