-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2016 at 03:00 am
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Schlocktober`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `movie_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `movie_id`) VALUES
(1, 'testing', 6, 2),
(2, 'good movie', 6, 2),
(3, 'good movie', 6, 2),
(4, 'worst movie ever', 6, 4),
(5, 'qqyweiyqiwyeiqyweiwei', 6, 4),
(6, 'hkdhfkshdfkhsdf', 6, 4),
(7, 'ertjerptejrtjerot', 6, 3),
(8, 'another worst movie.', 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

CREATE TABLE `merchandise` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`id`, `name`, `price`, `description`) VALUES
(1, 'Collectable DVD', '30.00', 'A collectable DVD. Zone 4'),
(2, 'Dinner for five', '159.00', 'Rob Zombie, Bruce Campbell, Roger Corman, Faizon Love');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `description` text NOT NULL,
  `poster` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `description`, `poster`) VALUES
(2, 'Independence Day: Resurgence', 2016, 'As the Fourth of July nears, satellite engineer David Levinson (Jeff Goldblum) investigates a 3,000-mile-wide mother ship that''s approaching Earth. Fortunately, 20 years earlier, nations across the world started to use recovered extraterrestrial technology to develop an immense defense program. When the alien invaders attack with unprecedented force, the U.S. president, teams of scientists and brave fighter pilots spring into action to save the planet from a seemingly invincible enemy.', '584f51b1bcd41.jpg'),
(3, 'You Don''t Mess with the Zohan', 2008, 'Tired of all the fighting in his country, legendary Israeli commando Zohan -Adam Sandler fakes his own death and goes to New York, where he can fulfill his fondest dream: to become a hairstylist. Zohan''s sexy way with a cut and curl makes him a hit with Manhattan''s women, but when enemy Arabs spot him, Zohan has to call on his military skills if he is ever to wield scissors again.', '584f427f5f321.jpg'),
(4, 'Troll 2', 1989, 'When young Joshua (Michael Stephenson) learns that he will be going on vacation with his family to a small town called Nilbog, he protests adamantly. He is warned by the spirit of his deceased grandfather that goblins populate the town.', '584f4d9e9fbab.jpg'),
(5, 'test', 1989, 'sdsdf', NULL),
(6, 'testing', 1999, 'gsjdgjsgdfjg', NULL),
(7, 'new', 0000, 'dfgyidfygidf', NULL),
(8, 'tesing new', 2000, 'udtfufg', NULL),
(9, 'testing', 1990, 'fghfgh', '584f417b8b2fe.jpg'),
(10, 'newly created', 1989, 'dfgdfg', '584f3defc7b6b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `profile_image` varchar(15) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `privilege` enum('user','admin','banned') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `profile_image`, `date_created`, `privilege`) VALUES
(1, 'ben@website.com', '', '', '', '', '2016-11-29 01:02:50', 'user'),
(2, 'admin@admin.com', '$2y$10$.CjQ6RhVgLOOFWtpwT8TtOdX5jx7VY5iu52oUlWjzpkdo5peYzf7i', '', '', '', '2016-12-01 01:10:53', 'admin'),
(3, 'admin@admin1.com', '$2y$10$FKc1zvRteuecoNOM99WRqepjRU2tvM2y/B6DxmvXyFEkoMwuHIP5m', '', '', '', '2016-12-01 01:12:26', 'user'),
(4, 'new@account.com', '$2y$10$0xwLnu7ldDN5cbnzwZiPp.VV56Cr4qyHcVo3sGJo8USOtXxUzf9GC', '', '', '', '2016-12-01 02:10:37', 'user'),
(5, 'test@website.com', '$2y$10$rqaxd1Hd7yi8YpJBMSG7vejX6dYZtZ/OiyWj1NQ6KuhqTz9IJ1s/2', '', '', '', '2016-12-01 23:32:47', 'user'),
(6, 'ss@m.com', '$2y$10$X.QpBsmNoyhweuTwCKsrZ.5T78WVvGU4PwahDXQ2w3X9Fjr4y0uri', '', '', '', '2016-12-04 23:08:49', 'user'),
(7, 'sindhu@mail.com', '$2y$10$MpmQQ.O7PhE4mSkEaJOdWuZLZpRySF.SJgT0091A9HsIqlgaEoFCm', '', '', '', '2016-12-05 23:17:10', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
