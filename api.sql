DROP DATABASE IF EXISTS `api`;
CREATE DATABASE `api`;

CREATE TABLE `api`.`lesson` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `api`.`grade` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lesson_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `api`.`question` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `order` int(11) NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1',
  `ans1` varchar(255) DEFAULT NULL,
  `ans2` varchar(255) DEFAULT NULL,
  `ans3` varchar(255) DEFAULT NULL,
  `ans4` varchar(255) DEFAULT NULL,
  `ans5` varchar(255) DEFAULT NULL,
  `subject_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `api`.`subject` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `lesson_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lesson`(`id`, `name`) VALUES 
(1, "Math"), (2, "Kyrgyz"), (3, "Russian");

INSERT INTO `grade`(`id`, `name`, `lesson_id`) VALUES 
(1, "5 класс", 1), (2, "6 класс", 1), (3, "6 класс", 1);

INSERT INTO `subject`(`id`, `name`, `order`, `lesson_id`) VALUES
(1, "Addition and subtraction of natural numbers", 1, 1),
(2, "Multiplication and division of natural numbers", 2, 1);

INSERT INTO `question`(`id`, `text`, `order`, `is_active`, 
  `ans1`, `ans2`, `ans3`, `ans4`, `ans5`, `subject_id`) VALUES 
(1, "What is 1+1: Ң ң?", 1, 1, "2", "3", "4", "5", "6", 1),
(2, "What is 1+2: Ү ү?", 2, 1, "3", "4", "5", "6", "7", 1),
(3, "What is 3+2: Ө ө?", 3, 1, "5", "6", "7", "3", "4", 1),
(4, "What is 3*2?", 4, 1, "6", "7", "3", "4", "5", 2),
(5, "What is 3/2?", 5, 1, "1.5", "6", "7", "3", "4", 2);
