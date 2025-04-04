-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: naacdb
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `annual_budget`
--

DROP TABLE IF EXISTS `annual_budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `annual_budget` (
  `id` int NOT NULL AUTO_INCREMENT,
  `year` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `total_annual_budget` decimal(15,2) NOT NULL,
  `building_maintenance` decimal(15,2) NOT NULL,
  `electrical_system` decimal(15,2) NOT NULL,
  `hvac_system` decimal(15,2) NOT NULL,
  `plumbing` decimal(15,2) NOT NULL,
  `landscaping` decimal(15,2) NOT NULL,
  `safety_equipment` decimal(15,2) NOT NULL,
  `water_supply_system` decimal(15,2) NOT NULL,
  `waste_management` decimal(15,2) NOT NULL,
  `ict_facilities` decimal(15,2) NOT NULL,
  `green_campus_initiatives` decimal(15,2) NOT NULL,
  `security_systems` decimal(15,2) NOT NULL,
  `pest_control` decimal(15,2) NOT NULL,
  `repair_works` decimal(15,2) NOT NULL,
  `transport_facilities` decimal(15,2) NOT NULL,
  `research_labs` decimal(15,2) NOT NULL,
  `hostel_facilities` decimal(15,2) NOT NULL,
  `sports_facilities` decimal(15,2) NOT NULL,
  `contingency_budget` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annual_budget`
--

LOCK TABLES `annual_budget` WRITE;
/*!40000 ALTER TABLE `annual_budget` DISABLE KEYS */;
/*!40000 ALTER TABLE `annual_budget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `award_name` varchar(255) NOT NULL,
  `issuing_organization` varchar(255) NOT NULL,
  `date_received` date NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `proof_file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awards`
--

LOCK TABLES `awards` WRITE;
/*!40000 ALTER TABLE `awards` DISABLE KEYS */;
/*!40000 ALTER TABLE `awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_chapter_publications`
--

DROP TABLE IF EXISTS `book_chapter_publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_chapter_publications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(9) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `department` enum('cse','it','extc','mech','civil') NOT NULL,
  `publication_type` enum('Book','Chapter') NOT NULL,
  `title` varchar(255) NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `ISBN_number` varchar(20) NOT NULL,
  `proof_document` varchar(255) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_chapter_publications`
--

LOCK TABLES `book_chapter_publications` WRITE;
/*!40000 ALTER TABLE `book_chapter_publications` DISABLE KEYS */;
INSERT INTO `book_chapter_publications` VALUES (1,'2023-24','Dr. Nikhil Karale','it','Book','Advanced AI Techniques','Tech Publications','978-3-16-148410-0','proof_ai_book.pdf','1','2025-03-17 10:54:50'),(2,'2022-23','Prof. Harshal Dattire','it','Chapter','Cybersecurity Trends','Springer','978-1-23-456789-0','proof_cyber_chapter.pdf','2','2025-03-17 10:54:50'),(3,'2021-22','Dr. Vijay Guthane','it','Book','Data Science Fundamentals','Pearson','978-0-12-345678-9','proof_data_science.pdf','1','2025-03-17 10:54:50'),(4,'2020-21','Prof. Ravindra Pardhi','it','Chapter','Cloud Computing Innovations','Wiley','978-9-87-654321-0','proof_cloud_chapter.pdf','0','2025-03-17 10:54:50');
/*!40000 ALTER TABLE `book_chapter_publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus_area`
--

DROP TABLE IF EXISTS `campus_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campus_area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `total_area` decimal(10,2) DEFAULT NULL,
  `built_up_area` decimal(10,2) DEFAULT NULL,
  `green_area` decimal(10,2) DEFAULT NULL,
  `playground_area` decimal(10,2) DEFAULT NULL,
  `open_space` decimal(10,2) DEFAULT NULL,
  `parking_area` decimal(10,2) DEFAULT NULL,
  `administrator_block_area` decimal(10,2) DEFAULT NULL,
  `academic_block_area` decimal(10,2) DEFAULT NULL,
  `auditorium_area` decimal(10,2) DEFAULT NULL,
  `residential_area` decimal(10,2) DEFAULT NULL,
  `sustainability_area` decimal(10,2) DEFAULT NULL,
  `hostel_area` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus_area`
--

LOCK TABLES `campus_area` WRITE;
/*!40000 ALTER TABLE `campus_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `campus_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom_facilities`
--

DROP TABLE IF EXISTS `classroom_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classroom_facilities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_of_classrooms` int DEFAULT NULL,
  `seating_capacity` int DEFAULT NULL,
  `avg_size_classroom` float DEFAULT NULL,
  `no_of_projectors` int DEFAULT NULL,
  `no_of_smart_boards` int DEFAULT NULL,
  `no_of_audio_systems` int DEFAULT NULL,
  `no_of_au_facilities` int DEFAULT NULL,
  `no_of_air_conditioners` int DEFAULT NULL,
  `no_of_boards` int DEFAULT NULL,
  `internet_connectivity` varchar(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lighting` varchar(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom_facilities`
--

LOCK TABLES `classroom_facilities` WRITE;
/*!40000 ALTER TABLE `classroom_facilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `classroom_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conference_papers`
--

DROP TABLE IF EXISTS `conference_papers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conference_papers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paper_title` varchar(255) NOT NULL,
  `proceedings_title` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `conference_name` varchar(255) NOT NULL,
  `conference_type` enum('National','International') NOT NULL,
  `isbn_issn` varchar(50) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `affiliating_institute` varchar(255) DEFAULT NULL,
  `proof_file` varchar(255) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `submission_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conference_papers`
--

LOCK TABLES `conference_papers` WRITE;
/*!40000 ALTER TABLE `conference_papers` DISABLE KEYS */;
INSERT INTO `conference_papers` VALUES (1,'AI Security','IT Research','it','Cyber Conf','National','978-3-16-148410-0','IEEE','IITB','ai_sec.pdf','1','2025-03-17 11:00:44'),(2,'Blockchain Tech','Blockchain Conf','it','Block Summit','International','978-0-12-345678-9','Springer','MIT','block.pdf','2','2025-03-17 11:00:44'),(3,'ML Health','AI Med','it','AI Health Symp','International','978-1-23-456789-0','Elsevier','Harvard','ml_health.pdf','1','2025-03-17 11:00:44'),(4,'Cloud Edu','Cloud Conf','it','Cloud Comp Conf','National','978-0-19-876543-2','T&F','IITD','cloud_edu.pdf','0','2025-03-17 11:00:44');
/*!40000 ALTER TABLE `conference_papers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrepreneurship_programs`
--

DROP TABLE IF EXISTS `entrepreneurship_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entrepreneurship_programs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program_name` varchar(255) NOT NULL,
  `date_conducted` date NOT NULL,
  `participants` int NOT NULL,
  `key_outcomes` text NOT NULL,
  `department` varchar(255) NOT NULL,
  `proof_file` varchar(255) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrepreneurship_programs`
--

LOCK TABLES `entrepreneurship_programs` WRITE;
/*!40000 ALTER TABLE `entrepreneurship_programs` DISABLE KEYS */;
/*!40000 ALTER TABLE `entrepreneurship_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extension_outreach`
--

DROP TABLE IF EXISTS `extension_outreach`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extension_outreach` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program_name` varchar(255) NOT NULL,
  `date_conducted` date NOT NULL,
  `participants` int NOT NULL,
  `department` varchar(100) NOT NULL,
  `key_outcomes` text NOT NULL,
  `proof_file` varchar(255) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extension_outreach`
--

LOCK TABLES `extension_outreach` WRITE;
/*!40000 ALTER TABLE `extension_outreach` DISABLE KEYS */;
/*!40000 ALTER TABLE `extension_outreach` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faculty` (
  `faculty_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `initials` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `blood_group` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `qualification` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `specialization` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `experience` int DEFAULT NULL,
  `official_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `personal_email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `postal_address` text COLLATE utf8mb4_general_ci,
  `permanent_address` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`faculty_id`),
  UNIQUE KEY `official_email` (`official_email`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES ('1',NULL,'Nikhil','E','Karale','Male','2025-02-28','O+','it','Sipna','2017-02-15','Ph.D. (Pursuing), M.E. (CSE)','CSE',6,'NEK@gmail.com','NEK@gmail.com','95617916154','12345','sipna','sipna'),('2',NULL,'Harshal','N','Dattire','Male','2025-02-27','A+','it','Sipna','2009-06-09','Ph.D., M.E. (IT)','II',15,'MND@gmail.com','MND@gmail.com','956179611549','12345','sipna','sipna'),('3',NULL,'Vijay','S','Guthane','Male','2025-02-28','A+','it','Sipna','2008-02-18','Ph.D. (CSE), M.E. (CSE)','CSE',25,'VSG@gmail.com','VSG@gmail.com','1234876981','12345','sipna','sipna'),('4',NULL,'Ravindra','Laxman','Pardhi','Male','2025-02-28','B+','it','Sipna','2011-02-01','Ph.D. (Pursuing), M.E. (IT)','IT',14,'RLP@gmail.com','RLP@gmail.com','12345678939','12345','sipna','sipna');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty_projects`
--

DROP TABLE IF EXISTS `faculty_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faculty_projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_title` varchar(255) NOT NULL,
  `pi_name` varchar(255) NOT NULL,
  `co_investigators` text,
  `department` varchar(255) NOT NULL,
  `funding_agency` varchar(255) DEFAULT NULL,
  `grant_amount` decimal(10,2) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `research_objectives` text,
  `research_outcomes` text,
  `proof_file` varchar(255) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty_projects`
--

LOCK TABLES `faculty_projects` WRITE;
/*!40000 ALTER TABLE `faculty_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `faculty_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grant_receive`
--

DROP TABLE IF EXISTS `grant_receive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grant_receive` (
  `grant_id` int NOT NULL AUTO_INCREMENT,
  `faculty_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `department` int NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nature_of_project` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `duration` int NOT NULL,
  `funding_agency` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `amount_received` decimal(10,2) NOT NULL,
  `proof` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`grant_id`),
  KEY `faculty_id` (`faculty_id`),
  KEY `department` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grant_receive`
--

LOCK TABLES `grant_receive` WRITE;
/*!40000 ALTER TABLE `grant_receive` DISABLE KEYS */;
/*!40000 ALTER TABLE `grant_receive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ict_facilities`
--

DROP TABLE IF EXISTS `ict_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ict_facilities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `total_computers` int NOT NULL,
  `internet_bandwidth` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `wifi_availability` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `no_of_smart_boards` int NOT NULL,
  `audio_visual_facilities` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_of_servers` int NOT NULL,
  `it_support_staff` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `backup_system` text COLLATE utf8mb4_general_ci NOT NULL,
  `electronic_resources` text COLLATE utf8mb4_general_ci NOT NULL,
  `video_conferencing` text COLLATE utf8mb4_general_ci NOT NULL,
  `digital_learning_platform` text COLLATE utf8mb4_general_ci NOT NULL,
  `lab_ict_enable` text COLLATE utf8mb4_general_ci NOT NULL,
  `energy_efficient` text COLLATE utf8mb4_general_ci NOT NULL,
  `it_tech_support_availability` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ict_facilities`
--

LOCK TABLES `ict_facilities` WRITE;
/*!40000 ALTER TABLE `ict_facilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `ict_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incubation_centers`
--

DROP TABLE IF EXISTS `incubation_centers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incubation_centers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `center_name` varchar(255) NOT NULL,
  `year_established` int NOT NULL,
  `affiliated_institution` varchar(255) NOT NULL,
  `funding_received` decimal(10,2) NOT NULL,
  `startups_supported` int NOT NULL,
  `department` varchar(255) NOT NULL,
  `proof_file` varchar(255) NOT NULL,
  `facilities_provided` text NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incubation_centers`
--

LOCK TABLES `incubation_centers` WRITE;
/*!40000 ALTER TABLE `incubation_centers` DISABLE KEYS */;
/*!40000 ALTER TABLE `incubation_centers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `industry_academia`
--

DROP TABLE IF EXISTS `industry_academia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `industry_academia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `industry_name` varchar(255) NOT NULL,
  `collaboration_type` varchar(255) NOT NULL,
  `beneficiaries` int NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `proof_file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `industry_academia`
--

LOCK TABLES `industry_academia` WRITE;
/*!40000 ALTER TABLE `industry_academia` DISABLE KEYS */;
/*!40000 ALTER TABLE `industry_academia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `industry_projects`
--

DROP TABLE IF EXISTS `industry_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `industry_projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_title` varchar(255) NOT NULL,
  `industry_partner` varchar(255) NOT NULL,
  `industry_type` varchar(255) NOT NULL,
  `funding_amount` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `department` varchar(255) NOT NULL,
  `proof_file` varchar(255) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `industry_projects`
--

LOCK TABLES `industry_projects` WRITE;
/*!40000 ALTER TABLE `industry_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `industry_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `innovation_ecosystem`
--

DROP TABLE IF EXISTS `innovation_ecosystem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `innovation_ecosystem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faculty_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `title_of_innovation` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name_of_award` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_award` date NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `proof_file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_id` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `innovation_ecosystem`
--

LOCK TABLES `innovation_ecosystem` WRITE;
/*!40000 ALTER TABLE `innovation_ecosystem` DISABLE KEYS */;
/*!40000 ALTER TABLE `innovation_ecosystem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `innovation_startups`
--

DROP TABLE IF EXISTS `innovation_startups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `innovation_startups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `startup_name` varchar(255) NOT NULL,
  `founders` varchar(255) NOT NULL,
  `year_established` int NOT NULL,
  `funding_received` decimal(10,2) NOT NULL,
  `industry_collaborations` text,
  `department` varchar(255) NOT NULL,
  `proof_file` varchar(255) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `innovation_startups`
--

LOCK TABLES `innovation_startups` WRITE;
/*!40000 ALTER TABLE `innovation_startups` DISABLE KEYS */;
/*!40000 ALTER TABLE `innovation_startups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratory_facilities`
--

DROP TABLE IF EXISTS `laboratory_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laboratory_facilities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_of_labs` int NOT NULL,
  `type_of_labs` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `seating_capacity` int NOT NULL,
  `ict_enabled` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `modern_equipment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `safety_equipment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size_of_labs` decimal(10,2) NOT NULL,
  `ventilation` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `research_facilities` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fumehood_availability` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sustainability_feature` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_count` int NOT NULL,
  `maintenance_support` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `chemical_storage_facilities` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratory_facilities`
--

LOCK TABLES `laboratory_facilities` WRITE;
/*!40000 ALTER TABLE `laboratory_facilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `laboratory_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratory_resources`
--

DROP TABLE IF EXISTS `laboratory_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laboratory_resources` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_of_books` int NOT NULL,
  `no_of_journals` int NOT NULL,
  `ebooks_available` int NOT NULL,
  `digital_resources` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sitting_capacity` int NOT NULL,
  `total_library_area` decimal(10,2) NOT NULL,
  `library_timing` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reference_section` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `internet_access` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `library_staff_count` int NOT NULL,
  `journal_subscribe` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `library_software` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `online_database` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `accessible_to_disabled` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratory_resources`
--

LOCK TABLES `laboratory_resources` WRITE;
/*!40000 ALTER TABLE `laboratory_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `laboratory_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mou_institutions`
--

DROP TABLE IF EXISTS `mou_institutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mou_institutions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `institution_name` varchar(255) NOT NULL,
  `mou_signed_date` date NOT NULL,
  `mou_purpose` text NOT NULL,
  `department` varchar(100) NOT NULL,
  `proof_file` varchar(255) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mou_institutions`
--

LOCK TABLES `mou_institutions` WRITE;
/*!40000 ALTER TABLE `mou_institutions` DISABLE KEYS */;
/*!40000 ALTER TABLE `mou_institutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mous_data`
--

DROP TABLE IF EXISTS `mous_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mous_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `organization` varchar(255) NOT NULL,
  `date_of_mou_signed` date NOT NULL,
  `purpose_activities` text NOT NULL,
  `teachers_participated` int DEFAULT '0',
  `department` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `criteria_id` int DEFAULT NULL,
  `proof_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mous_data`
--

LOCK TABLES `mous_data` WRITE;
/*!40000 ALTER TABLE `mous_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `mous_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mous_trash`
--

DROP TABLE IF EXISTS `mous_trash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mous_trash` (
  `id` int NOT NULL AUTO_INCREMENT,
  `organization` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_mou_signed` date NOT NULL,
  `purpose_activities` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `teachers_participated` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mous_trash`
--

LOCK TABLES `mous_trash` WRITE;
/*!40000 ALTER TABLE `mous_trash` DISABLE KEYS */;
/*!40000 ALTER TABLE `mous_trash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ngos_collaborations`
--

DROP TABLE IF EXISTS `ngos_collaborations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ngos_collaborations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ngo_name` varchar(255) NOT NULL,
  `collaboration_type` varchar(255) NOT NULL,
  `beneficiaries` int NOT NULL,
  `department` varchar(100) NOT NULL,
  `proof_file` varchar(255) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ngos_collaborations`
--

LOCK TABLES `ngos_collaborations` WRITE;
/*!40000 ALTER TABLE `ngos_collaborations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ngos_collaborations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_conducted`
--

DROP TABLE IF EXISTS `program_conducted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_conducted` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faculty_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `department_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_activity` date NOT NULL,
  `no_of_participants` int NOT NULL,
  `outcome` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_of_teachers` int NOT NULL,
  `collaborate_agencies` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `award_received` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `award_bodies` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `proof` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_id` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_conducted`
--

LOCK TABLES `program_conducted` WRITE;
/*!40000 ALTER TABLE `program_conducted` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_conducted` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_funding`
--

DROP TABLE IF EXISTS `project_funding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_funding` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_nature` varchar(255) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `funding_agency` varchar(255) NOT NULL,
  `total_grant` decimal(10,2) NOT NULL,
  `amount_received` decimal(10,2) NOT NULL,
  `department` varchar(50) NOT NULL,
  `proof_file` varchar(255) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `submission_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_funding`
--

LOCK TABLES `project_funding` WRITE;
/*!40000 ALTER TABLE `project_funding` DISABLE KEYS */;
INSERT INTO `project_funding` VALUES (1,'naac','4','sipna',456000.00,23000.00,'it','Project_Funding/Project_Funding_files/research_awards.pdf','1','2025-03-17 03:51:42');
/*!40000 ALTER TABLE `project_funding` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_records`
--

DROP TABLE IF EXISTS `repair_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `year` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `report_date` date NOT NULL,
  `completion_date` date NOT NULL,
  `facility_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `issue_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `repair_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `priority_level` enum('Low','Medium','High','Critical') COLLATE utf8mb4_general_ci NOT NULL,
  `action_taken` text COLLATE utf8mb4_general_ci NOT NULL,
  `inspection_remarks` text COLLATE utf8mb4_general_ci NOT NULL,
  `assigned_to` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `approved_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `approval_date` date NOT NULL,
  `budget_allocated` decimal(10,2) NOT NULL,
  `vendor_details` text COLLATE utf8mb4_general_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_records`
--

LOCK TABLES `repair_records` WRITE;
/*!40000 ALTER TABLE `repair_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `research_awards`
--

DROP TABLE IF EXISTS `research_awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `research_awards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(10) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `award_name` varchar(255) NOT NULL,
  `award_organization` varchar(255) NOT NULL,
  `award_date` date NOT NULL,
  `proof_document` varchar(255) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `research_awards`
--

LOCK TABLES `research_awards` WRITE;
/*!40000 ALTER TABLE `research_awards` DISABLE KEYS */;
INSERT INTO `research_awards` VALUES (1,'2023-24','Dr. Nikhil Karale','it','Best Researcher Award','AICTE','2024-01-15','proof_best_researcher.pdf','1','2025-03-17 10:57:42'),(2,'2022-23','Prof. harshal Dattire','it','Innovative Teaching Award','IEEE','2023-05-20','proof_teaching_award.pdf','2','2025-03-17 10:57:42'),(3,'2021-22','Dr. Vijay Guthane','it','Excellence in Computer Science','Springer','2022-07-10','proof_excellence_cs.pdf','1','2025-03-17 10:57:42'),(4,'2020-21','Prof. Ravindra Pardhi','it','Outstanding Faculty Award','UGC','2021-11-30','proof_outstanding_faculty.pdf','0','2025-03-17 10:57:42');
/*!40000 ALTER TABLE `research_awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `research_papers`
--

DROP TABLE IF EXISTS `research_papers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `research_papers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(9) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `paper_title` varchar(255) NOT NULL,
  `journal_name` varchar(255) NOT NULL,
  `journal_type` enum('book chap','journal','conference') NOT NULL,
  `publication_date` date NOT NULL,
  `ISSN_number` varchar(20) NOT NULL,
  `proof_document` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `research_papers`
--

LOCK TABLES `research_papers` WRITE;
/*!40000 ALTER TABLE `research_papers` DISABLE KEYS */;
INSERT INTO `research_papers` VALUES (1,'2021','Nikhil E Karale','it','Handwritten digits identification ','IOP conference series','journal','2021-02-17','1022 0121','Gope_2021_IOP_Conf._Ser.__Mater._Sci._Eng._1022_012108.pdf','2025-03-17 10:21:09','0'),(2,'2021','Harshal N Dattire','it','A virtualized security framework ','International Journal ','journal','2013-01-29','12344567','document.pdf','2025-03-17 10:38:36','0'),(3,'2021','Vijay S Gulhane','it','Application of genetic algorithm ','(IJARCET)','journal','2013-04-17','12344567','document.pdf','2025-03-17 10:41:11','0'),(4,'2021','Ravindra Laxman Pardhi','it','Mobile malware detection techniques',' (IJCSET)','journal','2013-04-17','12344567','IJCSET13-04-04-094.pdf','2025-03-17 10:42:59','0');
/*!40000 ALTER TABLE `research_papers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-17 16:43:01
