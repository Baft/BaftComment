
-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (x86_64)
--
-- Host: localhost   
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.14.04.1

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
-- Table structure for table `baftcomment__message_revision`
--

DROP TABLE IF EXISTS `baftcomment__message_revision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baftcomment__message_revision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref__message__id` int(11) NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  `message_subject` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `revision_time` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ref__message__id` (`ref__message__id`),
  CONSTRAINT `baftcomment__message_revision_ibfk_1` FOREIGN KEY (`ref__message__id`) REFERENCES `baftcomment__message` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baftcomment__message_revision`
--

LOCK TABLES `baftcomment__message_revision` WRITE;
/*!40000 ALTER TABLE `baftcomment__message_revision` DISABLE KEYS */;
/*!40000 ALTER TABLE `baftcomment__message_revision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `baftcomment__message`
--

DROP TABLE IF EXISTS `baftcomment__message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baftcomment__message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_time` bigint(20) NOT NULL,
  `author` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `author_email` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `author_name` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `ref__comment__id` int(11) NOT NULL,
  `parent_message_id` int(11) DEFAULT NULL,
  `message_subject` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  `deleted` int(1) DEFAULT '0',
  `spam` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ref__comment__id` (`ref__comment__id`),
  CONSTRAINT `baftcomment__message_ibfk_1` FOREIGN KEY (`ref__comment__id`) REFERENCES `baftcomment__comment` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baftcomment__message`
--

LOCK TABLES `baftcomment__message` WRITE;
/*!40000 ALTER TABLE `baftcomment__message` DISABLE KEYS */;
/*!40000 ALTER TABLE `baftcomment__message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `baftcomment__comment`
--

DROP TABLE IF EXISTS `baftcomment__comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baftcomment__comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `discuss_subject` varchar(1000) COLLATE utf8_persian_ci NOT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`,`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baftcomment__comment`
--

LOCK TABLES `baftcomment__comment` WRITE;
/*!40000 ALTER TABLE `baftcomment__comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `baftcomment__comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'insp_v2'
--

--
-- Dumping routines for database 'insp_v2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-14 18:44:29
