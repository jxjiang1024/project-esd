CREATE DATABASE  IF NOT EXISTS `fms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fms`;
-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: esd.mysql.database.azure.com    Database: fms
-- ------------------------------------------------------
-- Server version	5.6.42.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aircraft`
--

DROP TABLE IF EXISTS `aircraft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aircraft` (
  `tail_no` varchar(45) NOT NULL,
  `model` varchar(45) NOT NULL,
  `manufacturer` varchar(45) NOT NULL,
  `econ` int(10) unsigned NOT NULL,
  `pre_econ` int(10) unsigned NOT NULL DEFAULT '0',
  `business` int(10) unsigned NOT NULL,
  `first` int(10) unsigned NOT NULL DEFAULT '0',
  `last_maintained` datetime NOT NULL,
  PRIMARY KEY (`tail_no`),
  KEY `model` (`model`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bid_packages`
--

DROP TABLE IF EXISTS `bid_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bid_packages` (
  `package_id` varchar(255) NOT NULL,
  `staff_id` int(10) unsigned NOT NULL,
  `result` binary(1) NOT NULL,
  PRIMARY KEY (`package_id`),
  KEY `fk_bid_packages_staff1_idx` (`staff_id`),
  CONSTRAINT `fk_bid_packages_staff1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `booking_id` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `payment_id` int(10) NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `suffix` varchar(45) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `email` text NOT NULL,
  `staff_id` int(10) unsigned DEFAULT NULL,
  `comments` text,
  `status` varchar(45) DEFAULT 'PENDING',
  PRIMARY KEY (`booking_id`,`payment_id`),
  KEY `fk_BOOKING_staff1_idx` (`staff_id`),
  CONSTRAINT `fk_BOOKING_staff1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `continent`
--

DROP TABLE IF EXISTS `continent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `continent` (
  `CONTIENT_CODE` varchar(2) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`CONTIENT_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `COUNTRY_CODE` varchar(2) NOT NULL,
  `CONTINENT_CODE` varchar(2) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`COUNTRY_CODE`),
  KEY `fk_COUNTRY_CONTINENT1_idx` (`CONTINENT_CODE`),
  CONSTRAINT `fk_COUNTRY_CONTINENT1` FOREIGN KEY (`CONTINENT_CODE`) REFERENCES `continent` (`CONTIENT_CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `flight_details`
--

DROP TABLE IF EXISTS `flight_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flight_details` (
  `flight_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `flight_no` varchar(45) NOT NULL,
  `flight_departure` date NOT NULL,
  `flight_arrival` date NOT NULL,
  `tail_no` varchar(45) NOT NULL,
  `econ_sv_price` decimal(10,2) unsigned NOT NULL,
  `econ_sv_seat` int(10) unsigned NOT NULL,
  `econ_stnd_price` decimal(10,2) unsigned NOT NULL,
  `econ_stnd_seat` int(10) unsigned NOT NULL,
  `econ_plus_price` decimal(10,2) unsigned NOT NULL,
  `econ_plus_seat` int(10) unsigned NOT NULL,
  `pr_econ_sv_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pr_econ_sv_seat` int(10) unsigned NOT NULL DEFAULT '0',
  `pr_econ_stnd_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pr_econ_stnd_seat` int(10) unsigned NOT NULL DEFAULT '0',
  `pr_econ_plus_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pr_econ_plus_seat` int(10) unsigned NOT NULL DEFAULT '0',
  `bus_sv_price` decimal(10,2) unsigned NOT NULL,
  `bus_sv_seat` int(10) unsigned NOT NULL,
  `bus_stnd_price` decimal(10,2) unsigned NOT NULL,
  `bus_stnd_seat` int(10) unsigned NOT NULL,
  `bus_plus_price` decimal(10,2) unsigned NOT NULL,
  `bus_plus_seat` int(10) unsigned NOT NULL,
  `first_stnd_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `first_stnd_seat` int(10) unsigned NOT NULL DEFAULT '0',
  `status_code` varchar(3) NOT NULL,
  PRIMARY KEY (`flight_details_id`),
  KEY `fk_flight_details_routes1_idx` (`flight_no`),
  KEY `fk_FLIGHT_DETAILS_aircraft1_idx` (`tail_no`),
  KEY `fk_FLIGHT_DETAILS_status1_idx` (`status_code`),
  CONSTRAINT `fk_FLIGHT_DETAILS_aircraft1` FOREIGN KEY (`tail_no`) REFERENCES `aircraft` (`tail_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_FLIGHT_DETAILS_status1` FOREIGN KEY (`status_code`) REFERENCES `status` (`status_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_flight_details_routes1` FOREIGN KEY (`flight_no`) REFERENCES `routes` (`flight_no`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pilot_license`
--

DROP TABLE IF EXISTS `pilot_license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pilot_license` (
  `staff_id` int(11) NOT NULL,
  `license_id` int(11) NOT NULL,
  `aircraft_model` varchar(45) NOT NULL,
  `expiration_date` date NOT NULL,
  PRIMARY KEY (`staff_id`,`license_id`),
  KEY `fk_pilot_license_aircraft1_idx` (`aircraft_model`),
  KEY `model` (`aircraft_model`),
  CONSTRAINT `fk_pilot_license_aircraft1` FOREIGN KEY (`aircraft_model`) REFERENCES `aircraft` (`model`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket` (
  `ticket_id` varchar(25) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `flight_details_id` int(11) NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `suffix` varchar(45) DEFAULT NULL,
  `ff_id` varchar(10) DEFAULT NULL,
  `issued_date` date NOT NULL,
  PRIMARY KEY (`ticket_id`,`booking_id`),
  KEY `fk_TICKET_BOOKING1_idx` (`booking_id`),
  KEY `fd_id_idx` (`flight_details_id`),
  CONSTRAINT `fd_id` FOREIGN KEY (`flight_details_id`) REFERENCES `flight_details` (`flight_details_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TICKET_BOOKING1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `union_compliance`
--

DROP TABLE IF EXISTS `union_compliance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `union_compliance` (
  `id` int(11) NOT NULL,
  `min_hours_per_trip` decimal(10,0) unsigned NOT NULL DEFAULT '4',
  `min_hours2` decimal(10,0) NOT NULL,
  `max_hours_per_annual` decimal(10,0) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-10 20:21:29
