# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.10.10 (MySQL 5.7.17-0ubuntu0.16.04.1)
# Database: teknasyon
# Generation Time: 2018-12-19 17:47:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `language_code` varchar(2) DEFAULT NULL,
  `version` varchar(55) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` text,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;

INSERT INTO `languages` (`id`, `project_id`, `language_code`, `version`, `key`, `value`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,'TR','1.0','title','Merhaba',1,'2018-12-19 14:01:57','2018-12-19 14:01:57'),
	(2,3,'EN','1.0','title','Merhabas',1,'2018-12-19 14:21:09','2018-12-19 15:21:34'),
	(3,3,'EN','1.0','title','Hello',1,'2018-12-19 14:21:19','2018-12-19 14:21:19'),
	(4,1,'TR','1.1','title','test',1,'2018-12-19 14:32:04','2018-12-19 14:32:04'),
	(5,1,'TR','1.0','title','merhaha',1,'2018-12-19 14:32:14','2018-12-19 14:32:14'),
	(6,2,'TR','1.0','title','merhaba',1,'2018-12-19 15:25:10','2018-12-19 15:25:10'),
	(7,2,'EN','1.0','title','hello',1,'2018-12-19 15:25:28','2018-12-19 16:18:23');

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`id`, `project_name`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'MetTask',1,'2018-12-19 12:12:04','2018-12-19 12:43:22'),
	(2,'Toys',1,'2018-12-19 12:13:12','2018-12-19 12:13:12'),
	(3,'Keys',1,'2018-12-19 12:13:22','2018-12-19 12:13:22');

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Mehmet KILIÇ','mail@mehmetkilic.com.tr','$2y$10$kI/F30iQywJGAvPQyE2wsOAipLnO.HDSv7xzVrnxvw0uedP.C4X5O','z6ZbeIQIsiYlT9dHeSM1HVim9c9CFa4baVmaRQ3CJ3MWoDYke0r7x8pqhxj7',1,NULL,'2018-12-19 11:02:08'),
	(2,'Test User','test@teknasyon.com','$2y$10$t5mOtu.wJSFHUZcTQNg3CexotL7x7pYPSUw4PRSbUVtHplhAJ67U6','nTzyYOw6WUr2Gv0slMTk6lgAsS00068QmlJIoz7bz5Za1aS8E82gzTddXMpc',1,'2018-12-18 21:05:25','2018-12-18 21:05:25'),
	(4,'Müslüm Gürses','muslum@ibb.gov.tr','$2y$10$6xcuxlN3deJR9UT15xQmzOtw.nPkjbr4MPAWZDroYrT0UeZpCpjC6',NULL,1,'2018-12-19 11:07:28','2018-12-19 11:07:28');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
