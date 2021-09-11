-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2020 at 06:13 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertisements`
--

CREATE TABLE `tbl_advertisements` (
  `id` int(4) NOT NULL,
  `title` varchar(30) NOT NULL,
  `rank` int(10) NOT NULL,
  `image` varchar(500) NOT NULL,
  `expire_date` datetime(4) NOT NULL,
  `link` varchar(150) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(30) NOT NULL,
  `updated_by` int(30) DEFAULT NULL,
  `created_at` datetime(4) NOT NULL,
  `updated_at` datetime(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `rank` int(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(20) NOT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `created_at` datetime(4) NOT NULL,
  `updated_at` datetime(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `name`, `slug`, `rank`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'sports news5', 'sports-news5', 56, 0, 2, 2, '2020-09-04 04:16:49.0000', '2020-09-07 19:16:06.0000'),
(3, 'Wendy Vargas', 'Itaque debitis ullam', 25, 1, 2, 2, '2020-09-06 18:41:53.0000', '2020-09-07 19:16:18.0000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id` int(4) NOT NULL,
  `news_id` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `emails` varchar(30) NOT NULL,
  `comments` varchar(30) NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `feature_image` varchar(500) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `trending_key` tinyint(1) NOT NULL,
  `feature_key` tinyint(1) DEFAULT NULL,
  `breaking_key` tinyint(1) DEFAULT NULL,
  `slider_key` tinyint(1) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(30) NOT NULL,
  `updated_by` int(30) DEFAULT NULL,
  `created_at` datetime(4) NOT NULL,
  `updated_at` datetime(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `category_id`, `title`, `slug`, `feature_image`, `short_description`, `description`, `trending_key`, `feature_key`, `breaking_key`, `slider_key`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'health', 'Non exercitationem d', '5f5d8ea7b942c_Screenshot (9).png', '              Explicabo Pariatur            ', '<p>asdfghjklmnbvcx</p>', 1, 1, 1, 1, '1', 2, 2, '2020-09-09 05:00:28.0000', '2020-09-13 05:14:47.0000'),
(2, 3, 'education', 'Qui error et pariatu', '5f59909e3b396_Screenshot (37).png', 'news 123      ', '<p>fhfuifhwenxzmcnsjsd sjdnsjidnsjkdsn</p>', 1, 1, 1, 1, '0', 2, 2, '2020-09-10 04:34:06.0000', '2020-09-13 05:14:08.0000'),
(3, 3, 'technology', 'Anim error sapiente ', '5f5996938ef27_Screenshot (14).png', 'Ipsum sint saepe ul', '<p>werhjkk dfghghj</p>', 1, 0, 1, 0, '1', 2, NULL, '2020-09-10 04:59:31.0000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `id` int(4) NOT NULL,
  `title` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `images` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(30) NOT NULL,
  `updated_by` int(30) DEFAULT NULL,
  `created_at` datetime(4) NOT NULL,
  `updated_at` datetime(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `name`, `status`) VALUES
(1, 'Admin', 1),
(2, 'Editor', 1),
(3, 'Molly Freeman', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `last_login` date DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `username`, `password`, `last_login`, `image`, `status`, `role_id`) VALUES
(1, 'Rajesh jha', 'rajesh@gmail.com', 'rajesh', 'admin123', NULL, NULL, 1, 1),
(2, 'Ramesh Thapa', 'ramesh@gmail.com', 'Ramesh', 'ramesh123', NULL, NULL, 1, 2),
(11, 'rybujypub', 'gavici@mailinator.com', 'kafixiw', 'Ipsum nostrud nulla ', NULL, NULL, 0, 3),
(13, 'rahul', 'rahul123@gmail.com', 'rahul', 'rahul123', NULL, NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_advertisements`
--
ALTER TABLE `tbl_advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `tbl_news_ibfk_3` (`category_id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_advertisements`
--
ALTER TABLE `tbl_advertisements`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_advertisements`
--
ALTER TABLE `tbl_advertisements`
  ADD CONSTRAINT `tbl_advertisements_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_advertisements_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD CONSTRAINT `tbl_categories_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_categories_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD CONSTRAINT `tbl_comments_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `tbl_news` (`id`);

--
-- Constraints for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD CONSTRAINT `tbl_news_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_news_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_news_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`id`);

--
-- Constraints for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD CONSTRAINT `tbl_pages_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_pages_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
