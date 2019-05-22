CREATE DATABASE  IF NOT EXISTS `citypop_database` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `citypop_database`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: citypop_database
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `userrating_artist`
--

DROP TABLE IF EXISTS `userrating_artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrating_artist` (
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `rating` float(2,1) NOT NULL,
  PRIMARY KEY (`user_id`,`artist_id`),
  KEY `FK_userRating_artist_artist_idx` (`artist_id`),
  CONSTRAINT `FK_userRating_artist_artist` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_userRating_artist_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrating_artist`
--

LOCK TABLES `userrating_artist` WRITE;
/*!40000 ALTER TABLE `userrating_artist` DISABLE KEYS */;
INSERT INTO `userrating_artist` VALUES (1,1,5.0),(1,2,4.0),(1,10,5.0),(1,38,4.0),(2,1,5.0),(2,2,5.0),(2,4,4.0),(2,5,4.0),(2,7,4.0),(2,8,4.0),(2,10,4.0),(2,11,5.0),(2,24,4.0),(2,26,4.0),(2,38,3.0),(2,39,4.0),(5,1,4.0);
/*!40000 ALTER TABLE `userrating_artist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-21 14:58:38
