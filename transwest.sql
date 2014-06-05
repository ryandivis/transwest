-- MySQL dump 10.13  Distrib 5.6.17, for osx10.9 (x86_64)
--
-- Host: localhost    Database: ryandiv1_transwest
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `access_codes`
--

DROP TABLE IF EXISTS `access_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `code` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_codes`
--

LOCK TABLES `access_codes` WRITE;
/*!40000 ALTER TABLE `access_codes` DISABLE KEYS */;
INSERT INTO `access_codes` VALUES (1,0,0,1,'TW9651212TW','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `access_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `businesses`
--

DROP TABLE IF EXISTS `businesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `businesses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `businesses`
--

LOCK TABLES `businesses` WRITE;
/*!40000 ALTER TABLE `businesses` DISABLE KEYS */;
INSERT INTO `businesses` VALUES (1,'Divis INC','555-555-1212','2014-06-04 01:18:44','2014-06-04 01:18:44'),(2,'Comcast','555-555-1212','2014-06-04 01:18:44','2014-06-04 01:18:44'),(3,'Dave\'s Trucking','555-555-1212','2014-06-04 01:18:44','2014-06-04 01:18:44');
/*!40000 ALTER TABLE `businesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,5,2,'Needs new windshield wipers as well','2014-06-04 01:18:44','2014-06-04 01:18:44'),(2,5,1,'We just recently did work on this vehicle\'s brakes. We will look into the problem, but I don\'t think the break pads will need to be changed.','2014-06-04 01:18:44','2014-06-04 01:18:44');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_04_22_171408_create_users_table',1),('2014_04_23_154654_create_token_table',1),('2014_04_23_164657_add_remember_token',1),('2014_04_23_170245_tickets_table',1),('2014_05_12_183905_create_vehicle_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mileage`
--

DROP TABLE IF EXISTS `mileage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mileage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mileage`
--

LOCK TABLES `mileage` WRITE;
/*!40000 ALTER TABLE `mileage` DISABLE KEYS */;
INSERT INTO `mileage` VALUES (1,1,130000,1,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(2,2,27000,1,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(3,2,30000,1,'2014-06-04 01:18:44','2014-06-04 01:18:44');
/*!40000 ALTER TABLE `mileage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `issue` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `approved_by` int(11) DEFAULT NULL,
  `approved_timestamp` datetime DEFAULT NULL,
  `scheduled` tinyint(1) DEFAULT '0',
  `scheduled_by` int(11) DEFAULT NULL,
  `scheduled_timestamp` datetime DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT '0',
  `resolved_by` int(11) DEFAULT NULL,
  `resolved_timestamp` datetime DEFAULT NULL,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `closed_by` int(11) DEFAULT NULL,
  `closed_timestamp` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,3,1,'Truck is not turning over every time.',0,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,0,NULL,NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(2,2,1,'Truck is running really rough.',0,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,0,NULL,NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(3,4,2,'Truck is running really rough.',0,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,0,NULL,NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(4,2,1,'Brakes need some work.',1,2,'2014-06-03 19:18:44',1,2,'2014-06-03 19:18:44',NULL,0,NULL,NULL,0,NULL,NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(5,4,2,'Brakes need some work.',1,4,'2014-06-03 19:18:44',1,1,'2014-06-03 19:18:44',NULL,0,NULL,NULL,0,NULL,NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(6,3,1,'Truck is really difficult to steer. Power steering seems like it went out.',1,2,'2014-06-03 19:18:44',0,NULL,NULL,NULL,0,NULL,NULL,0,NULL,NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(7,3,1,'Radiator leaking all over the place.',1,2,'2014-06-03 19:18:44',0,NULL,NULL,NULL,1,1,'2014-06-03 19:18:44',0,NULL,NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(8,3,1,'Needs an oil change.',0,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,1,2,'2014-06-03 19:18:44','2014-06-04 01:18:44','2014-06-04 01:18:44');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `business_required` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'Super Admin',100,0,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(2,'Vehicle Manager',50,1,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(3,'Mechanic',75,0,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(4,'Supervisor',20,1,'2014-06-04 01:18:44','2014-06-04 01:18:44'),(5,'Driver',10,1,'2014-06-04 01:18:44','2014-06-04 01:18:44');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `work_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,NULL,NULL,NULL,'Niel','Townsend','niel@test.com','$2y$10$lsGRCHwisJVJt6nTr10d/OeoG9VDflTiZLdSVA2WfZinrgnMGX1Ei',NULL,NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44',NULL),(2,4,1,NULL,1,'Danielle','Divis','danielle@test.com','$2y$10$6TBXRiaFLh0iH35udXKxR.zHVNuQaeXhlotGihm0DwRIF6fMId.uG','5555551212',NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44',NULL),(3,5,1,2,2,'Ryan','Divis','ryan@test.com','$2y$10$R7N7/uZfjCd5HriWOsgT0O5UsQp.QhK.inlq2XsgFIrty6OkJ7Pxu','5555551213',NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44',NULL),(4,4,2,NULL,3,'Bob','Krandall','bob@test.com','$2y$10$H0UYeOA4GjpJ/brAdp6zH.yYsWQcPxB7.szd84qYlYiyvLW9qHtoe','5555551213',NULL,'2014-06-04 01:18:44','2014-06-04 01:18:44',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `fleet_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `make` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,1,'1','4F2YU08102KM17887',2002,'Mazda','Tribute','3L V6','2014-06-04 01:18:44','2014-06-04 01:18:44'),(2,1,'2','1N4AL3AP9DN441925',2013,'Nissan','Altima','2.5L Inline 4','2014-06-04 01:18:44','2014-06-04 01:18:44'),(3,2,'19','1N4AL3AP9DN441925',2013,'Nissan','Altima','2.5L Inline 4','2014-06-04 01:18:44','2014-06-04 01:18:44');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-03 13:22:08
