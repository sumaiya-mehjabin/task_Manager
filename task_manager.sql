-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 08:10 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

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
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `start_date`, `end_date`, `created_at`) VALUES
(6, 'Mobile Application', 'Mobile Application', '2021-04-11 00:00:00', '2021-04-16 00:00:00', '2021/04/11'),
(7, 'Desktop Application', 'Desktop Application', '2021-04-11 00:00:00', '2021-04-17 00:00:00', '2021/04/11'),
(8, 'Flask Calculator', 'A calculator using flask', '2021-04-11 00:00:00', '2021-04-08 00:00:00', '2021/04/11');

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
(1, 6, 4, 1, 1),
(2, 6, 5, 2, 1),
(3, 7, 4, 1, 1),
(4, 7, 1, 2, 1),
(5, 8, 4, 1, 1),
(6, 8, 1, 2, 1),
(7, 8, 3, 2, 1),
(8, 8, 5, 2, 1);

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
(2, 8, 'Task 1', 'Task 1', '2021-04-12 11:42:00', 1, 3),
(3, 8, 'Task 2', 'Task 2', '2021-04-13 11:42:00', 1, 5),
(4, 8, 'Task 3', 'Task 3', '2021-04-15 11:44:00', 1, 1),
(5, 8, 'Task 4', 'Task 4', '2021-04-14 11:45:00', 2, 4),
(6, 8, 'Task 5', 'Task 5', '2021-04-11 11:46:36', 1, 3),
(7, 8, 'task 6', 'task 6', '2021-04-11 11:47:45', 3, 4);

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
(1, 'aa', 'user98@mailinator.com', NULL, '213', '5f1839842f2fb6979bf53490d99fa58e'),
(3, 'Ahmed Zobayer', 'zobayer.me@gmail.com', NULL, '01762011847', '5f1839842f2fb6979bf53490d99fa58e'),
(4, 'Fahim Ahmed', 'fahimzz1@mailinator.com', NULL, '01325856545', '5f1839842f2fb6979bf53490d99fa58e'),
(5, 'foysal', 'foysaldd@mailinator.com', NULL, '017425262', '5f1839842f2fb6979bf53490d99fa58e');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects_members`
--
ALTER TABLE `projects_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects_tasks`
--
ALTER TABLE `projects_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
