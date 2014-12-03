-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for guessfood
CREATE DATABASE IF NOT EXISTS `guessfood` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `guessfood`;


-- Dumping structure for table guessfood.activity_type
CREATE TABLE IF NOT EXISTS `activity_type` (
  `activity_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `enable` enum('T','F') DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `image_link` varchar(200) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`activity_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.badge
CREATE TABLE IF NOT EXISTS `badge` (
  `badge_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `badge_type_id` int(11) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `image_link` varchar(200) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`badge_id`),
  KEY `FK_badge_badge_type` (`badge_type_id`),
  CONSTRAINT `FK_badge_badge_type` FOREIGN KEY (`badge_type_id`) REFERENCES `badge_type` (`badge_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.badge_type
CREATE TABLE IF NOT EXISTS `badge_type` (
  `badge_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `description` varchar(200) NOT NULL DEFAULT '0',
  `image_link` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`badge_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned DEFAULT NULL,
  `user_data` text,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.cuisine
CREATE TABLE IF NOT EXISTS `cuisine` (
  `cuisine_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `image_link` varchar(200) DEFAULT NULL,
  `point_awarded_multiplier` int(11) DEFAULT NULL,
  `point_deducted_multiplier` int(11) DEFAULT NULL,
  `flag` varchar(200) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cuisine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.dummy
CREATE TABLE IF NOT EXISTS `dummy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.ingredient
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ingredient_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `image_link` varchar(200) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.question
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_level_id` int(11) DEFAULT NULL,
  `recipie_id` int(11) DEFAULT NULL,
  `question_type_id` int(11) DEFAULT NULL,
  `question` varchar(300) DEFAULT NULL,
  `total_choices` int(11) DEFAULT NULL,
  `enabled` enum('T','F') DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_id`),
  KEY `fk_q_level_id_idx` (`question_level_id`),
  KEY `fk_q_recipie_id_idx` (`recipie_id`),
  KEY `fk_q_q_type_id_idx` (`question_type_id`),
  CONSTRAINT `fk_q_level_id` FOREIGN KEY (`question_level_id`) REFERENCES `question_level` (`question_level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_q_q_type_id` FOREIGN KEY (`question_type_id`) REFERENCES `question_type` (`question_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_q_recipie_id` FOREIGN KEY (`recipie_id`) REFERENCES `recipie` (`recipie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.question_level
CREATE TABLE IF NOT EXISTS `question_level` (
  `question_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `point_awarded` int(11) DEFAULT NULL,
  `point_deducted` int(11) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.question_multiple_choice
CREATE TABLE IF NOT EXISTS `question_multiple_choice` (
  `question_multiple_choice_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `choice` varchar(100) DEFAULT NULL,
  `correct` enum('T','F') DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_multiple_choice_id`),
  KEY `fk_qmc_question_id_idx` (`question_id`),
  CONSTRAINT `fk_qmc_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.question_type
CREATE TABLE IF NOT EXISTS `question_type` (
  `question_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `many_correct_choice` enum('T','F') DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.recipie
CREATE TABLE IF NOT EXISTS `recipie` (
  `recipie_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `cuisine_id` int(11) DEFAULT NULL,
  `image_link` varchar(200) DEFAULT NULL,
  `enabled` enum('T','F') DEFAULT NULL,
  `cooking_description` text,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`recipie_id`),
  KEY `fk_cuisine_id_idx` (`cuisine_id`),
  CONSTRAINT `fk_cuisine_id` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisine` (`cuisine_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.recipie_ingredient
CREATE TABLE IF NOT EXISTS `recipie_ingredient` (
  `recipie_ingredient_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `recipie_id` int(11) DEFAULT NULL,
  `ingredient_id` int(11) DEFAULT NULL,
  `main_ingredient` enum('T','F') DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`recipie_ingredient_id`),
  KEY `fk_recipie_id_idx` (`recipie_id`),
  KEY `fk_ingredient_id_idx` (`ingredient_id`),
  CONSTRAINT `fk_ingredient_id` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipie_id` FOREIGN KEY (`recipie_id`) REFERENCES `recipie` (`recipie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for view guessfood.tmp_user
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `tmp_user` (
	`user_id` INT(11) NOT NULL,
	`first_name` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`last_name` VARCHAR(50) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for table guessfood.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `verified` varchar(10) DEFAULT NULL,
  `about_me` text,
  `facebook_link` varchar(300) DEFAULT NULL,
  `website_link` varchar(300) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.user_activity
CREATE TABLE IF NOT EXISTS `user_activity` (
  `user_activity_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity_type_id` int(11) DEFAULT NULL,
  `description` text,
  `image_link` varchar(200) DEFAULT NULL,
  `json_properties` text,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_activity_id`),
  KEY `fk_uac_user_id_idx` (`user_id`),
  KEY `fk_uac_activity_type_id_idx` (`activity_type_id`),
  CONSTRAINT `fk_uac_activity_type_id` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_type` (`activity_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_uac_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.user_badge
CREATE TABLE IF NOT EXISTS `user_badge` (
  `user_badge_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `badge_id` int(11) NOT NULL DEFAULT '0',
  `created_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_badge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.user_bookmark_recipie
CREATE TABLE IF NOT EXISTS `user_bookmark_recipie` (
  `user_bookmark_recipie_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `recipie_id` int(11) DEFAULT NULL,
  `boomarked` enum('T','F') DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_bookmark_recipie_id`),
  KEY `fk_user_id_idx` (`user_id`),
  KEY `fk_recipie_id_idx` (`recipie_id`),
  CONSTRAINT `fk_bk_recipie_id` FOREIGN KEY (`recipie_id`) REFERENCES `recipie` (`recipie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.user_cuisine_point
CREATE TABLE IF NOT EXISTS `user_cuisine_point` (
  `user_cuisine_point_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cuisine_id` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_cuisine_point_id`),
  KEY `fk_ucp_user_id_idx` (`user_id`),
  KEY `fk_ucp_cuisine_id_idx` (`cuisine_id`),
  CONSTRAINT `fk_ucp_cuisine_id` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisine` (`cuisine_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ucp_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.user_question_answered
CREATE TABLE IF NOT EXISTS `user_question_answered` (
  `user_question_answered_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `choice_id` text,
  `result` enum('T','F') DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_question_answered_id`),
  KEY `fk_uq_user_id_idx` (`user_id`),
  KEY `fk_uq_question_id_idx` (`question_id`),
  CONSTRAINT `fk_uq_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_uq_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table guessfood.user_stats
CREATE TABLE IF NOT EXISTS `user_stats` (
  `user_stats_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT '0',
  `badges` int(11) DEFAULT '0',
  `friends` int(11) DEFAULT '0',
  `bookmarks` int(11) DEFAULT '0',
  `reviews` int(11) DEFAULT '0',
  `global_rank` int(11) DEFAULT '0',
  `question_right` int(11) DEFAULT '0',
  `question_wrong` int(11) DEFAULT '0',
  `question_percentage` int(11) DEFAULT '0',
  `created_ts` timestamp NULL DEFAULT NULL,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_stats_id`),
  KEY `fk_user_id_idx` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for view guessfood.tmp_user
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `tmp_user`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `tmp_user` AS select user_id,first_name,last_name from user ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
