-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 06:02 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `created_at`) VALUES
(1, 'Mobile Application', 'Example (MySQLi Object-oriented) <? $servername = \"localhost\"; $username = \"username\"; $password = \"password\"; Example (MySQLi Procedural) <? $servername = \"localhost\"; $username = \"username\"; $password = \"password\"; Example (PDO) <? $servername \r\nExample (MySQLi Object-oriented) <? $servername = \"localhost\"; $username = \"username\"; $password = \"password\"; Example (MySQLi Procedural) <? $servername = \"localhost\"; $username = \"username\"; $password = \"password\"; Example (PDO) <? $servername ', '2021/03/30'),
(2, 'Calculator 2', 'asdasadasdasdasd', '2021/03/30'),
(3, 'Desktop Application', 'Desktop Application', '2021/03/31'),
(4, 'Desktop Application 4', 'Desktop Application Desktop Application', '2021/04/06');

-- --------------------------------------------------------

--
-- Table structure for table `projects_members`
--

CREATE TABLE `projects_members` (
  `id` int(11) NOT NULL,
  `project_id` bigint(255) NOT NULL,
  `member_id` bigint(255) NOT NULL,
  `member_type` tinyint(2) NOT NULL DEFAULT 2 COMMENT '1.Creator 2.collaborator',
  `member_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0.pending, 1.confirm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects_members`
--

INSERT INTO `projects_members` (`id`, `project_id`, `member_id`, `member_type`, `member_status`) VALUES
(2, 2, 3, 1, 1),
(4, 1, 3, 1, 0),
(10, 1, 4, 2, 0),
(15, 2, 5, 2, 0),
(16, 2, 4, 2, 0),
(17, 3, 4, 1, 1),
(18, 3, 3, 2, 0),
(19, 4, 3, 1, 1),
(21, 4, 6, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects_tasks`
--

CREATE TABLE `projects_tasks` (
  `id` int(11) NOT NULL,
  `project_id` bigint(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `due_date` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1.todo2on-progress3.done',
  `assigned_member` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects_tasks`
--

INSERT INTO `projects_tasks` (`id`, `project_id`, `title`, `description`, `due_date`, `status`, `assigned_member`) VALUES
(1, 3, 'Create Database for the system', 'Create Database for the system', '2021-03-31 00:00:00', 3, 3),
(2, 3, 'Admin Panel UI layout', 'Admin Panel UI layout', '2021-03-31 00:00:00', 2, 3),
(3, 3, 'Admin panel login system', 'Admin panel login system', '2021-03-31 00:00:00', 3, 3),
(4, 3, 'Customer panel UI', 'Customer panel UI', '2021-04-01 00:00:00', 1, 4),
(7, 4, 'adbashdbjashbd', 'djfksjdfbjksdbfsd ', '2021-04-22 09:55:00', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `phone`, `password`) VALUES
(1, 'test user', 'user98@mailinator.com', NULL, '213', '4297f44b13955235245b2497399d7a93'),
(3, 'Sumaiya Mehjabin', 'snigdha@gmail.com', NULL, '01762011847', '25d55ad283aa400af464c76d713c07ad'),
(4, 'Fahim Ahmed', 'fahimzz1@mailinator.com', NULL, '01325856545', '5f1839842f2fb6979bf53490d99fa58e'),
(5, 'foysal', 'foysaldd@mailinator.com', NULL, '017425262', '5f1839842f2fb6979bf53490d99fa58e'),
(6, 'Sadia Mehjabin', 'sadia@gmail.com', NULL, '0197865454', '25d55ad283aa400af464c76d713c07ad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects_members`
--
ALTER TABLE `projects_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects_tasks`
--
ALTER TABLE `projects_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects_members`
--
ALTER TABLE `projects_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `projects_tasks`
--
ALTER TABLE `projects_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
