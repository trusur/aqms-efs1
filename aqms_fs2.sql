-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: aqms_f2_migration
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `a_groups`
--

DROP TABLE IF EXISTS `a_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `a_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `menu_ids` text NOT NULL,
  `privileges` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_groups`
--

LOCK TABLES `a_groups` WRITE;
/*!40000 ALTER TABLE `a_groups` DISABLE KEYS */;
INSERT INTO `a_groups` VALUES (1,'Administrator','1,2,3,4,5,','15,15,15,15,15,','2021-05-20 04:25:19'),(2,'Operator','1,4,5,','15,15,15,','2021-05-20 04:25:19');
/*!40000 ALTER TABLE `a_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_menu`
--

DROP TABLE IF EXISTS `a_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `a_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `seqno` int NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL DEFAULT '0',
  `name_id` varchar(100) NOT NULL DEFAULT '',
  `name_en` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(100) NOT NULL DEFAULT '',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_menu`
--

LOCK TABLES `a_menu` WRITE;
/*!40000 ALTER TABLE `a_menu` DISABLE KEYS */;
INSERT INTO `a_menu` VALUES (1,1,0,'Beranda','Home','/','','2021-05-20 04:25:19'),(2,2,0,'Konfigurasi','Configuration','configuration','','2021-05-20 04:25:19'),(3,3,0,'Parameter','Parameters','parameter','','2021-05-20 04:25:19'),(4,4,0,'Kalibrasi','Calibrations','calibration','','2021-05-20 04:25:19'),(5,5,0,'Ekspor','Export','export','','2021-05-20 04:25:19');
/*!40000 ALTER TABLE `a_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_users`
--

DROP TABLE IF EXISTS `a_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `a_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_users`
--

LOCK TABLES `a_users` WRITE;
/*!40000 ALTER TABLE `a_users` DISABLE KEYS */;
INSERT INTO `a_users` VALUES (1,0,'superuser@aqms','$argon2i$v=19$m=65536,t=4,p=1$dERlLmNabU91VU9VQWsvaA$YYS1ohqMxbQjkRtn96vS68B83M0HR6wu3p+HOE8vYtE','Superuser','2022-08-18 13:23:19'),(2,1,'admin@aqms','$argon2i$v=19$m=65536,t=4,p=1$R1FSbEMwYWZRWlJKMEwuTg$Wdl4gb5ugJWwGuFdqpjYdqLrSLRCfKAadUxA3LV1tTw','Adminstrator','2021-05-20 04:25:20'),(3,2,'operator@aqms','$argon2i$v=19$m=65536,t=4,p=1$R1FSbEMwYWZRWlJKMEwuTg$Wdl4gb5ugJWwGuFdqpjYdqLrSLRCfKAadUxA3LV1tTw','Operator','2021-05-20 04:25:20');
/*!40000 ALTER TABLE `a_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calibrations`
--

DROP TABLE IF EXISTS `calibrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calibrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `calibrator_name` varchar(255) NOT NULL,
  `started_at` varchar(20) NOT NULL,
  `finished_at` varchar(20) NOT NULL,
  `sensor_reader_id` int NOT NULL DEFAULT '0',
  `pin` int NOT NULL DEFAULT '0',
  `value` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `calibrator_name` (`calibrator_name`),
  KEY `started_at` (`started_at`),
  KEY `sensor_reader_id` (`sensor_reader_id`),
  KEY `pin` (`pin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calibrations`
--

LOCK TABLES `calibrations` WRITE;
/*!40000 ALTER TABLE `calibrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `calibrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configurations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurations`
--

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
INSERT INTO `configurations` VALUES (1,'aqms_code','AQMS_FS2'),(2,'id_stasiun','MASTER'),(3,'nama_stasiun','AQMS MASTER'),(4,'address','-'),(5,'city',''),(6,'province',''),(7,'latitude','0'),(8,'longitude','0'),(9,'pump_interval','360'),(10,'pump_state','1'),(11,'pump_last','2022-08-22 15:23:10'),(12,'pump_speed','200'),(13,'selenoid_state','q'),(14,'selenoid_names',''),(15,'selenoid_commands','q;w;e;r'),(16,'purge_state','o'),(17,'data_interval','1'),(18,'graph_interval','0'),(19,'is_sampling','0'),(20,'sampler_operator_name',''),(21,'id_sampling',''),(22,'start_sampling','0'),(23,'zerocal_schedule','00:00:00'),(24,'zerocal_duration','360'),(25,'is_zerocal','0'),(26,'calibrator_name',''),(27,'zerocal_started_at',''),(28,'zerocal_finished_at',''),(29,'is_cems','0'),(30,'is_valve_calibrator','1'),(31,'is_psu_restarting','1'),(32,'restart_schedule',''),(33,'last_restart_schedule',''),(34,'is_sentto_klhk','0'),(35,'klhk_api_server',''),(36,'klhk_api_username',''),(37,'klhk_api_password',''),(38,'klhk_api_key',''),(39,'is_sentto_trusur','1'),(40,'trusur_api_server','kafka-service.greenteams.co'),(41,'trusur_api_username',''),(42,'trusur_api_password',''),(43,'trusur_api_key','e3WxqSc0PVssXCIa6uJy985QpUl7BJXkx/XsGdgNtE4efz='),(44,'iot_path','/iot/iot/'),(45,'setSpan','');
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ispu`
--

DROP TABLE IF EXISTS `ispu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ispu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ispu_at` datetime NOT NULL,
  `parameter_id` int NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  `ispu` int NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ispu_at` (`ispu_at`),
  KEY `parameter_id` (`parameter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ispu`
--

LOCK TABLES `ispu` WRITE;
/*!40000 ALTER TABLE `ispu` DISABLE KEYS */;
/*!40000 ALTER TABLE `ispu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measurement_histories`
--

DROP TABLE IF EXISTS `measurement_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `measurement_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parameter_id` int NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  `sensor_value` double NOT NULL DEFAULT '0',
  `is_averaged` tinyint NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parameter_id` (`parameter_id`),
  KEY `is_averaged` (`is_averaged`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measurement_histories`
--

LOCK TABLES `measurement_histories` WRITE;
/*!40000 ALTER TABLE `measurement_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `measurement_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measurement_logs`
--

DROP TABLE IF EXISTS `measurement_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `measurement_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parameter_id` int NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  `sensor_value` double NOT NULL DEFAULT '0',
  `is_averaged` tinyint NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parameter_id` (`parameter_id`),
  KEY `is_averaged` (`is_averaged`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measurement_logs`
--

LOCK TABLES `measurement_logs` WRITE;
/*!40000 ALTER TABLE `measurement_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `measurement_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measurements`
--

DROP TABLE IF EXISTS `measurements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `measurements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `time_group` datetime NOT NULL,
  `parameter_id` int NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  `sensor_value` double NOT NULL DEFAULT '0',
  `is_sent_cloud` tinyint NOT NULL DEFAULT '0',
  `sent_cloud_at` datetime NOT NULL,
  `is_sent_klhk` tinyint NOT NULL DEFAULT '0',
  `sent_klhk_at` datetime NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `time_group_parameter_id` (`time_group`,`parameter_id`),
  KEY `is_sent_cloud` (`is_sent_cloud`),
  KEY `is_sent_klhk` (`is_sent_klhk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measurements`
--

LOCK TABLES `measurements` WRITE;
/*!40000 ALTER TABLE `measurements` DISABLE KEYS */;
/*!40000 ALTER TABLE `measurements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2021-05-02-100939','App\\Database\\Migrations\\Configurations','default','App',1621484654,1),(2,'2021-05-02-101023','App\\Database\\Migrations\\Measurements','default','App',1621484654,1),(3,'2021-05-02-101033','App\\Database\\Migrations\\MeasurementLogs','default','App',1621484655,1),(4,'2021-05-02-101052','App\\Database\\Migrations\\Ispu','default','App',1621484655,1),(5,'2021-05-02-101105','App\\Database\\Migrations\\Parameters','default','App',1621484655,1),(6,'2021-05-02-101127','App\\Database\\Migrations\\SerialPorts','default','App',1621484655,1),(7,'2021-05-02-101151','App\\Database\\Migrations\\AGroups','default','App',1621484655,1),(8,'2021-05-02-101157','App\\Database\\Migrations\\AMenu','default','App',1621484655,1),(9,'2021-05-02-101200','App\\Database\\Migrations\\AUsers','default','App',1621484655,1),(10,'2021-05-02-101313','App\\Database\\Migrations\\SensorReaders','default','App',1621484655,1),(11,'2021-05-02-101324','App\\Database\\Migrations\\SensorValues','default','App',1621484655,1),(12,'2021-05-02-101336','App\\Database\\Migrations\\SensorValueLogs','default','App',1621484655,1),(13,'2021-05-02-131550','App\\Database\\Migrations\\MeasurementHistories','default','App',1621484656,1),(14,'2021-05-05-101829','App\\Database\\Migrations\\AlterMeasurements','default','App',1621484656,1),(15,'2021-05-05-233406','App\\Database\\Migrations\\AlterMeasurements20210506','default','App',1621484656,1),(16,'2021-11-15-115849','App\\Database\\Migrations\\Calibrations','default','App',1656312976,2),(17,'2021-11-18-025803','App\\Database\\Migrations\\AlterCalibration20211118','default','App',1656312976,2),(18,'2022-04-06-071743','App\\Database\\Migrations\\AlterSerialPorts','default','App',1656312976,2),(19,'2022-04-13-010212','App\\Database\\Migrations\\InsertConfiguration20220413','default','App',1656312976,2),(20,'2022-04-13-014124','App\\Database\\Migrations\\InsertNewParameters20220413','default','App',1656312976,2),(21,'2022-05-23-010213','App\\Database\\Migrations\\IsValveCalibrator','default','App',1656312976,2),(22,'2022-05-23-091431','App\\Database\\Migrations\\IsPsuRestarting','default','App',1656312976,2),(23,'2022-05-24-101126','App\\Database\\Migrations\\RestartSchedule','default','App',1656312976,2),(24,'2022-05-30-011414','App\\Database\\Migrations\\ConfigurationsServers','default','App',1656312976,2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameters`
--

DROP TABLE IF EXISTS `parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parameters` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `caption_id` varchar(100) NOT NULL,
  `caption_en` varchar(100) NOT NULL,
  `default_unit` varchar(10) NOT NULL,
  `molecular_mass` double NOT NULL DEFAULT '0',
  `formula` varchar(255) NOT NULL,
  `is_view` tinyint NOT NULL DEFAULT '0',
  `p_type` varchar(30) NOT NULL DEFAULT 'gas',
  `is_graph` tinyint NOT NULL DEFAULT '0',
  `sensor_value_id` int NOT NULL DEFAULT '0',
  `voltage1` double NOT NULL DEFAULT '0',
  `voltage2` double NOT NULL DEFAULT '0',
  `concentration1` double NOT NULL DEFAULT '0',
  `concentration2` double NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameters`
--

LOCK TABLES `parameters` WRITE;
/*!40000 ALTER TABLE `parameters` DISABLE KEYS */;
INSERT INTO `parameters` VALUES (1,'no2','NO<sub>2</sub>','NO<sub>2</sub>','µg/m<sup>3',46.01,'round((explode(\";\",$sensor[1][0])[1]) * 46010 / 24.45)',0,'gas',1,1,0,0,0,0,'2022-08-18 14:40:16'),(2,'o3','O<sub>3</sub>','O<sub>3</sub>','µg/m<sup>3',48,'round((explode(\";\",$sensor[1][0])[4])* 48000 / 24.45,0)',0,'gas',1,0,0,0,0,0,'2024-01-15 07:26:50'),(3,'co','CO','CO','µg/m<sup>3',28.01,'round((explode(\";\",$sensor[2][0])[2])* 28010 / 24.45,0)',0,'gas',1,0,0,0,0,0,'2024-01-15 07:26:50'),(4,'so2','SO<sub>2</sub>','SO<sub>2</sub>','µg/m<sup>3',64.06,'round((explode(\";\",$sensor[1][0])[2])* 64060 / 24.45,0)',0,'gas',1,0,0,0,0,0,'2024-01-15 07:26:50'),(5,'hc','HC','HC','µg/m<sup>3',13.0186,'round((explode(\";\",$sensor[2][0])[4])* 13018.6/ 24.45,0)',0,'gas',1,0,0,0,0,0,'2024-01-15 07:26:50'),(6,'h2s','H<sub>2</sub>S','H<sub>2</sub>S','µg/m<sup>3',34.08,'',0,'gas',0,0,0,0,0,0,'2021-05-20 04:25:20'),(7,'cs2','CS<sub>2</sub>','CS<sub>2</sub>','µg/m<sup>3',76.1407,'',0,'gas',0,0,0,0,0,0,'2021-05-20 04:25:20'),(8,'nh3','NH<sub>3</sub>','NH<sub>3</sub>','µg/m<sup>3',76.1407,'',0,'gas',0,0,0,0,0,0,'2021-05-20 04:25:20'),(9,'ch4','CH<sub>4</sub>','CH<sub>4</sub>','µg/m<sup>3',16.04,'',0,'gas',0,0,0,0,0,0,'2021-05-20 04:25:20'),(10,'voc','VOC','VOC','µg/m<sup>3',78.9516,'',0,'gas',0,0,0,0,0,0,'2021-05-20 04:25:20'),(11,'nmhc','NMHC','NMHC','µg/m<sup>3',110,'',0,'gas',0,0,0,0,0,0,'2021-05-20 04:25:20'),(12,'pm25','PM2.5','PM2.5','µg/m<sup>3',0,'explode(";",$sensor[1][3])[1]',1,'particulate',1,1,0,0,0,0,'2022-08-18 13:56:43'),(13,'pm25_flow','PM2.5 Flow','PM2.5 Flow','l/mnt',0,'explode(";",$sensor[1][7])[1]/10',1,'particulate_flow',1,0,0,0,0,0,'2022-08-18 13:53:42'),(14,'pm10','PM10','PM10','µg/m<sup>3',0,'substr($sensor[3][0],2,7) * 1000',0,'particulate',1,5,0,0,0,0,'2022-08-18 13:57:24'),(15,'pm10_flow','PM10 Flow','PM10 Flow','l/mnt',0,'substr($sensor[3][0],10,3)',0,'particulate_flow',1,0,0,0,0,0,'2022-08-18 13:51:59'),(16,'tsp','TSP','TSP','µg/m<sup>3',0,'',0,'particulate',0,0,0,0,0,0,'2021-05-20 04:25:20'),(17,'tsp_flow','TSP Flow','TSP Flow','l/mnt',0,'',0,'particulate_flow',0,0,0,0,0,0,'2021-05-20 04:25:20'),(18,'pressure','Tekanan','Barometer','MBar',0,'round((explode(";",$sensor[2][5])[1]),2)',1,'weather',0,5,0,0,0,0,'2022-08-18 13:42:58'),(19,'wd','Arah angin','Wind Direction','°',0,'explode(";",$sensor[2][1])[1]',1,'weather',0,0,0,0,0,0,'2022-08-18 13:43:06'),(20,'ws','Kec. Angin','Wind Speed','Km/h',0,'round((explode(";",$sensor[2][2])[1]),2)',1,'weather',0,0,0,0,0,0,'2022-08-18 13:43:21'),(21,'temperature','Suhu','Temperature','°C',0,'round((explode(";",$sensor[2][3])[1]),2)',1,'weather',0,0,0,0,0,0,'2022-08-18 13:43:31'),(22,'humidity','Kelembaban','Humidity','%',0,'round((explode(";",$sensor[2][4])[1]),2)',1,'weather',0,0,0,0,0,0,'2022-08-18 13:43:52'),(23,'sr','Solar Radiasi','Solar Radiation','watt/m2',0,'round((explode(";",$sensor[2][20])[1]),2)',1,'weather',0,0,0,0,0,0,'2022-08-18 13:43:41'),(24,'rain_intensity','Curah Hujan','Rain Rate','mm/h',0,'round((explode(";",$sensor[2][8])[1]),2)',1,'weather',0,5,0,0,0,0,'2022-08-18 13:44:16'),(25,'pm10_bar','Tekanan','Barometer','MBar',0,'',0,'weather',0,0,0,0,0,0,'2021-05-20 04:25:20'),(26,'pm10_humid','Kelembaban','Humidity','%',0,'',0,'weather',0,0,0,0,0,0,'2021-05-20 04:25:20'),(27,'pm10_temp','Suhu','Temperature','°C',0,'',0,'weather',0,0,0,0,0,0,'2021-05-20 04:25:20'),(28,'pm25_bar','Tekanan','Barometer','MBar',0,'',0,'weather',0,0,0,0,0,0,'2021-05-20 04:25:20'),(29,'pm25_humid','Kelembaban','Humidity','%',0,'',0,'weather',0,0,0,0,0,0,'2021-05-20 04:25:20'),(30,'pm25_temp','Suhu','Temperature','°C',0,'',0,'weather',0,0,0,0,0,0,'2021-05-20 04:25:20'),(31,'co2','CO<sub>2</sub>','CO<sub>2</sub>','µg/m<sup>3',44.01,'round((explode(\";\",$sensor[9][0])[0]) * 44010 / 24.45,3)',0,'gas',0,0,0,0,0,0,'2022-08-18 13:39:52'),(32,'o2','O<sub>2</sub>','O<sub>2</sub>','µg/m<sup>3',15.99,'round((explode(\";\",$sensor[10][0])[0]) * 15990 / 24.45,3)',0,'gas',0,0,0,0,0,0,'2022-08-18 13:39:14'),(33,'no','NO','NO','µg/m<sup>3',30.0061,'round((explode(\";\",$sensor[10][0])[0]) * 30006.1 / 24.45,3)',0,'gas',0,0,0,0,0,0,'2022-08-18 13:40:07');
/*!40000 ALTER TABLE `parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensor_readers`
--

DROP TABLE IF EXISTS `sensor_readers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensor_readers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `driver` varchar(50) NOT NULL,
  `sensor_code` varchar(30) NOT NULL,
  `baud_rate` varchar(100) NOT NULL,
  `pins` varchar(200) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensor_readers`
--

LOCK TABLES `sensor_readers` WRITE;
/*!40000 ALTER TABLE `sensor_readers` DISABLE KEYS */;
INSERT INTO `sensor_readers` VALUES (1,'pm_alphasense_reader.py','/dev/ttyPM','9600','',''),(2,'rk900_reader.py','/dev/ttyWS','9600','','');
/*!40000 ALTER TABLE `sensor_readers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensor_value_logs`
--

DROP TABLE IF EXISTS `sensor_value_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensor_value_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sensor_value_id` int NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sensor_value_id` (`sensor_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensor_value_logs`
--

LOCK TABLES `sensor_value_logs` WRITE;
/*!40000 ALTER TABLE `sensor_value_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `sensor_value_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensor_values`
--

DROP TABLE IF EXISTS `sensor_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensor_values` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sensor_reader_id` int NOT NULL DEFAULT '0',
  `pin` int NOT NULL DEFAULT '0',
  `value` text NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sensor_reader_id` (`sensor_reader_id`),
  KEY `pin` (`pin`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensor_values`
--

LOCK TABLES `sensor_values` WRITE;
/*!40000 ALTER TABLE `sensor_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `sensor_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serial_ports`
--

DROP TABLE IF EXISTS `serial_ports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `serial_ports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `port` varchar(20) NOT NULL,
  `id_product` varchar(100) NOT NULL,
  `id_vendor` varchar(100) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `is_used` tinyint NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `port` (`port`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serial_ports`
--

LOCK TABLES `serial_ports` WRITE;
/*!40000 ALTER TABLE `serial_ports` DISABLE KEYS */;
/*!40000 ALTER TABLE `serial_ports` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-15 14:27:44
