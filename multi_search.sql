-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `skills` (`id`, `skill_name`) VALUES
(1,	'html'),
(2,	'css'),
(3,	'javascript');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `name`) VALUES
(1,	'jagroopsingh123',	'Jagroop Singh'),
(2,	'sachinkumar123',	'Sachin Kumar '),
(3,	'dileepkumar123',	'Dileep Kumar'),
(4,	'johndoe123',	'JOhn Doe');

DROP TABLE IF EXISTS `user_skills`;
CREATE TABLE `user_skills` (
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `skill_id` (`skill_id`),
  CONSTRAINT `user_skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_skills` (`user_id`, `skill_id`) VALUES
(1,	1),
(1,	2),
(2,	2),
(3,	1),
(3,	2),
(3,	3),
(4,	3);

-- 2018-03-14 11:19:27
