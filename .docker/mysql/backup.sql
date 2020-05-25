-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: tbee
-- ------------------------------------------------------
-- Server version	5.7.29

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
-- Table structure for table `address_info`
--

DROP TABLE IF EXISTS `address_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `is_main_address` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `address_info_user_id_foreign` (`user_id`),
  CONSTRAINT `address_info_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_info`
--

LOCK TABLES `address_info` WRITE;
/*!40000 ALTER TABLE `address_info` DISABLE KEYS */;
INSERT INTO `address_info` VALUES (1,1,1,'Trần Anh Thư','288 Sóc Sơn, Hà Nội','0963318303',NULL,NULL),(2,1,NULL,'Trần Anh Tú','301 Đống Đa, Hà Nội','0888888888',NULL,NULL),(3,3,1,'Nguyễn Văn A','928 Bạch Đằng, New York','0151515158','2020-05-26 00:37:48','2020-05-26 00:37:48');
/*!40000 ALTER TABLE `address_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`product_id`),
  KEY `cart_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1,25,2,NULL,NULL),(1,27,1,NULL,NULL),(1,29,2,NULL,NULL),(3,30,3,NULL,NULL);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_level1`
--

DROP TABLE IF EXISTS `category_level1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_level1` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_level1`
--

LOCK TABLES `category_level1` WRITE;
/*!40000 ALTER TABLE `category_level1` DISABLE KEYS */;
INSERT INTO `category_level1` VALUES (1,'Thời trang nam','man-fashion.png','2020-03-29 03:56:32','2020-03-29 03:56:32'),(2,'Thời trang nữ','woman-fashion.png','2020-03-29 03:56:32','2020-03-29 03:56:32'),(3,'Laptop','laptop.png','2020-03-29 03:56:32','2020-03-29 03:56:32'),(4,'Tai nghe','headphone.png','2020-03-29 03:56:32','2020-03-29 03:56:32'),(5,'Điện thoại','smartphone.png','2020-03-29 03:56:32','2020-03-29 03:56:32'),(6,'Giày dép','giay-dep.png','2020-03-29 03:56:32','2020-03-29 03:56:32'),(7,'Túi ví','tui-vi.png','2020-03-29 03:56:32','2020-03-29 03:56:32'),(8,'Mỹ phẩm','mypham.png','2020-03-29 03:56:32','2020-03-29 03:56:32');
/*!40000 ALTER TABLE `category_level1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_level2`
--

DROP TABLE IF EXISTS `category_level2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_level2` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `category_level1_id` mediumint(8) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_level2_category_level1_id_foreign` (`category_level1_id`),
  CONSTRAINT `category_level2_category_level1_id_foreign` FOREIGN KEY (`category_level1_id`) REFERENCES `category_level1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_level2`
--

LOCK TABLES `category_level2` WRITE;
/*!40000 ALTER TABLE `category_level2` DISABLE KEYS */;
INSERT INTO `category_level2` VALUES (1,1,'Áo nam',NULL,NULL),(2,1,'Quần nam',NULL,NULL),(3,2,'Áo nữ',NULL,NULL),(4,2,'Quần nữ',NULL,NULL),(5,2,'Váy nữ',NULL,NULL),(6,8,'Chăm sóc da',NULL,NULL),(7,8,'Trang điểm',NULL,NULL),(8,3,'Laptop ',NULL,NULL),(9,4,'Tai nghe có dây',NULL,NULL),(10,4,'Tai nghe không dây',NULL,NULL),(11,5,'Điện thoại',NULL,NULL),(12,5,'Máy tính bảng',NULL,NULL),(13,6,'Giày cao gót',NULL,NULL),(14,6,'Giày thể thao',NULL,NULL),(15,7,'Túi xách',NULL,NULL),(16,7,'Balo',NULL,NULL),(17,7,'Ví',NULL,NULL),(18,3,'Màn hình',NULL,NULL);
/*!40000 ALTER TABLE `category_level2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_in_percent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_in_money` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `numbers` int(11) DEFAULT NULL,
  `used` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'tb30','30','100000','2020-05-09','2020-05-31',NULL,0,'2020-05-09 00:21:16','2020-05-09 00:21:16'),(2,'tb25','25','80000','2020-05-09','2020-05-10',5,0,'2020-05-09 00:21:51','2020-05-09 00:21:51'),(3,'tb301','30',NULL,'2020-05-01','2020-05-05',NULL,0,'2020-05-09 00:22:11','2020-05-09 00:22:11'),(4,'tb50','50','200000','2020-05-11','2020-05-15',10,0,'2020-05-09 00:23:03','2020-05-09 00:23:03');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_product`
--

DROP TABLE IF EXISTS `image_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_product_image_id_foreign` (`image_id`),
  KEY `image_product_product_id_foreign` (`product_id`),
  CONSTRAINT `image_product_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  CONSTRAINT `image_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_product`
--

LOCK TABLES `image_product` WRITE;
/*!40000 ALTER TABLE `image_product` DISABLE KEYS */;
INSERT INTO `image_product` VALUES (1,2,1,NULL,NULL),(2,3,1,NULL,NULL),(3,4,1,NULL,NULL),(4,5,1,NULL,NULL),(5,6,2,NULL,NULL),(6,7,2,NULL,NULL),(7,9,3,NULL,NULL),(8,10,4,NULL,NULL),(9,11,4,NULL,NULL),(10,19,5,NULL,NULL),(11,20,5,NULL,NULL),(12,21,5,NULL,NULL),(13,22,6,NULL,NULL),(14,23,6,NULL,NULL),(15,26,7,NULL,NULL),(16,27,7,NULL,NULL),(17,29,8,NULL,NULL),(18,30,8,NULL,NULL),(19,31,8,NULL,NULL),(20,32,8,NULL,NULL),(21,33,9,NULL,NULL),(22,34,9,NULL,NULL),(23,35,9,NULL,NULL),(24,36,9,NULL,NULL),(25,37,9,NULL,NULL),(26,38,10,NULL,NULL),(27,39,10,NULL,NULL),(28,40,10,NULL,NULL),(29,41,10,NULL,NULL),(30,42,11,NULL,NULL),(31,43,11,NULL,NULL),(32,44,12,NULL,NULL),(33,45,12,NULL,NULL),(34,46,12,NULL,NULL),(35,47,12,NULL,NULL),(36,48,13,NULL,NULL),(37,49,13,NULL,NULL),(38,50,14,NULL,NULL),(39,51,14,NULL,NULL),(40,52,15,NULL,NULL),(41,53,15,NULL,NULL),(42,54,15,NULL,NULL),(43,56,16,NULL,NULL),(44,57,16,NULL,NULL),(45,58,16,NULL,NULL),(46,59,17,NULL,NULL),(47,60,17,NULL,NULL),(48,61,17,NULL,NULL),(49,62,18,NULL,NULL),(50,63,18,NULL,NULL),(51,64,18,NULL,NULL),(52,65,19,NULL,NULL),(53,66,19,NULL,NULL),(54,67,19,NULL,NULL),(55,68,19,NULL,NULL),(56,69,20,NULL,NULL),(57,70,20,NULL,NULL),(58,71,20,NULL,NULL),(59,72,21,NULL,NULL),(60,73,21,NULL,NULL),(61,74,21,NULL,NULL),(62,75,22,NULL,NULL),(63,76,22,NULL,NULL),(64,77,22,NULL,NULL),(65,78,22,NULL,NULL),(66,79,23,NULL,NULL),(67,80,23,NULL,NULL),(68,81,23,NULL,NULL),(69,82,23,NULL,NULL),(70,84,24,NULL,NULL),(71,85,24,NULL,NULL),(72,86,24,NULL,NULL),(73,87,24,NULL,NULL),(74,91,25,NULL,NULL),(75,92,25,NULL,NULL),(76,93,25,NULL,NULL),(77,94,26,NULL,NULL),(78,95,26,NULL,NULL),(79,96,26,NULL,NULL),(80,97,27,NULL,NULL),(81,98,27,NULL,NULL),(82,99,27,NULL,NULL),(83,100,28,NULL,NULL),(84,101,28,NULL,NULL),(85,102,28,NULL,NULL),(86,107,29,NULL,NULL),(87,108,29,NULL,NULL),(88,109,29,NULL,NULL),(89,110,30,NULL,NULL),(90,111,30,NULL,NULL),(91,113,31,NULL,NULL),(92,114,31,NULL,NULL),(93,115,31,NULL,NULL),(94,116,31,NULL,NULL);
/*!40000 ALTER TABLE `image_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'/images/suppliers/20200411_225251_anhrua4.jpg','2020-04-11 22:52:51','2020-04-11 22:52:51'),(2,'/images/products/20200415_231658_phpNgiMhJ_1.jpeg','2020-04-15 23:16:59','2020-04-15 23:16:59'),(3,'/images/products/20200415_231659_phpkPFPFA_2.jpeg','2020-04-15 23:16:59','2020-04-15 23:16:59'),(4,'/images/products/20200415_231659_phpnmniKh_3.jpeg','2020-04-15 23:16:59','2020-04-15 23:16:59'),(5,'/images/products/20200415_231659_phpgDdpDd_4.jpeg','2020-04-15 23:16:59','2020-04-15 23:16:59'),(6,'/images/products/20200418_095104_phpoFNCfN_1.jpeg','2020-04-18 09:51:04','2020-04-18 09:51:04'),(7,'/images/products/20200418_095104_phpMOJoCg_2.jpeg','2020-04-18 09:51:04','2020-04-18 09:51:04'),(8,'/images/products/20200418_095604_phpdOcKDh_quan1.jpeg','2020-04-18 09:56:04','2020-04-18 09:56:04'),(9,'/images/products/20200418_095632_phpManmko_quan1.jpeg','2020-04-18 09:56:32','2020-04-18 09:56:32'),(10,'/images/products/20200418_100044_phpKFBHBE_ao1.jpeg','2020-04-18 10:00:44','2020-04-18 10:00:44'),(11,'/images/products/20200418_100044_phpAbfain_ao2.jpeg','2020-04-18 10:00:44','2020-04-18 10:00:44'),(12,'/images/suppliers/20200419_171205_banner-tbee2.jpg','2020-04-19 17:12:05','2020-04-19 17:12:05'),(13,'/images/products/20200419_172606_phpOfMkFD_sp1-2.jpg','2020-04-19 17:26:06','2020-04-19 17:26:06'),(14,'/images/products/20200419_172606_phpkBIdPM_sp1-1.jpg','2020-04-19 17:26:06','2020-04-19 17:26:06'),(15,'/images/products/20200419_172606_phpKGmPnF_sp1.jpg','2020-04-19 17:26:06','2020-04-19 17:26:06'),(16,'/images/products/20200419_172616_phpGienpo_sp1-2.jpg','2020-04-19 17:26:16','2020-04-19 17:26:16'),(17,'/images/products/20200419_172616_phpGLEAip_sp1-1.jpg','2020-04-19 17:26:16','2020-04-19 17:26:16'),(18,'/images/products/20200419_172616_phpGDkFId_sp1.jpg','2020-04-19 17:26:16','2020-04-19 17:26:16'),(19,'/images/products/20200419_172957_phpgKnBOk_sp1-2.jpg','2020-04-19 17:29:57','2020-04-19 17:29:57'),(20,'/images/products/20200419_172958_phpkEOekj_sp1-1.jpg','2020-04-19 17:29:58','2020-04-19 17:29:58'),(21,'/images/products/20200419_172958_phpkNBnIc_sp1.jpg','2020-04-19 17:29:58','2020-04-19 17:29:58'),(22,'/images/products/20200419_174012_phpKJfFKm_sp2-1.jpg','2020-04-19 17:40:12','2020-04-19 17:40:12'),(23,'/images/products/20200419_174012_phpkJphFI_sp2.jpg','2020-04-19 17:40:12','2020-04-19 17:40:12'),(24,'/images/products/20200419_174606_phpgPHhdj_SP3-1.jpg','2020-04-19 17:46:06','2020-04-19 17:46:06'),(25,'/images/products/20200419_174606_phpOfjKBe_SP3.jpg','2020-04-19 17:46:06','2020-04-19 17:46:06'),(26,'/images/products/20200419_174616_phpkCMOGn_SP3-1.jpg','2020-04-19 17:46:16','2020-04-19 17:46:16'),(27,'/images/products/20200419_174616_phpGFpdCh_SP3.jpg','2020-04-19 17:46:16','2020-04-19 17:46:16'),(28,'/images/suppliers/20200419_175210_banner-tbee1.jpeg','2020-04-19 17:52:10','2020-04-19 17:52:10'),(29,'/images/products/20200419_175708_phpGboioE_sp1-3.jpeg','2020-04-19 17:57:08','2020-04-19 17:57:08'),(30,'/images/products/20200419_175708_phpKmmIDH_sp1-2.jpeg','2020-04-19 17:57:08','2020-04-19 17:57:08'),(31,'/images/products/20200419_175708_phpOpFkng_sp1-1.jpeg','2020-04-19 17:57:08','2020-04-19 17:57:08'),(32,'/images/products/20200419_175708_phpgFbaap_sp1.jpeg','2020-04-19 17:57:08','2020-04-19 17:57:08'),(33,'/images/products/20200419_180044_phpklnbJi_sp2-4.jpeg','2020-04-19 18:00:44','2020-04-19 18:00:44'),(34,'/images/products/20200419_180044_phpOPmCBl_sp2-3.jpeg','2020-04-19 18:00:44','2020-04-19 18:00:44'),(35,'/images/products/20200419_180044_phpGEniek_sp2-2.jpeg','2020-04-19 18:00:44','2020-04-19 18:00:44'),(36,'/images/products/20200419_180044_phpoEBMgc_sp2-1.jpeg','2020-04-19 18:00:44','2020-04-19 18:00:44'),(37,'/images/products/20200419_180044_phpgnkDEo_sp2.jpeg','2020-04-19 18:00:44','2020-04-19 18:00:44'),(38,'/images/products/20200419_180320_phpGddMGc_sp3-3.jpeg','2020-04-19 18:03:20','2020-04-19 18:03:20'),(39,'/images/products/20200419_180320_phpglngbo_sp3-2.jpeg','2020-04-19 18:03:20','2020-04-19 18:03:20'),(40,'/images/products/20200419_180320_phpknfFMO_sp3.jpeg','2020-04-19 18:03:20','2020-04-19 18:03:20'),(41,'/images/products/20200419_180320_phpGAnAHp_sp3-1.jpeg','2020-04-19 18:03:20','2020-04-19 18:03:20'),(42,'/images/products/20200419_180728_phponJKMo_sp4-1.jpeg','2020-04-19 18:07:28','2020-04-19 18:07:28'),(43,'/images/products/20200419_180728_phpOoGhLE_sp4.jpeg','2020-04-19 18:07:28','2020-04-19 18:07:28'),(44,'/images/products/20200419_180947_phpKCLEml_sp5-3.jpeg','2020-04-19 18:09:47','2020-04-19 18:09:47'),(45,'/images/products/20200419_180947_phpCHNIkh_sp5-2.jpeg','2020-04-19 18:09:47','2020-04-19 18:09:47'),(46,'/images/products/20200419_180947_phpkjMDah_sp5.jpeg','2020-04-19 18:09:47','2020-04-19 18:09:47'),(47,'/images/products/20200419_180947_phpKNdIJK_sp5-1.jpeg','2020-04-19 18:09:47','2020-04-19 18:09:47'),(48,'/images/products/20200419_181256_phpklIpHb_sp6.jpeg','2020-04-19 18:12:56','2020-04-19 18:12:56'),(49,'/images/products/20200419_181256_phpojGOKf_sp6-1.jpeg','2020-04-19 18:12:56','2020-04-19 18:12:56'),(50,'/images/products/20200419_181512_phpKfJAnp_sp7-1.jpeg','2020-04-19 18:15:12','2020-04-19 18:15:12'),(51,'/images/products/20200419_181512_phpoOmeKj_sp7-2.jpeg','2020-04-19 18:15:12','2020-04-19 18:15:12'),(52,'/images/products/20200419_181727_phpooBFjP_sp8.jpeg','2020-04-19 18:17:27','2020-04-19 18:17:27'),(53,'/images/products/20200419_181727_phpcmpAnd_sp8-1.jpeg','2020-04-19 18:17:27','2020-04-19 18:17:27'),(54,'/images/products/20200419_181727_phpgkAhBa_sp8-2.jpeg','2020-04-19 18:17:27','2020-04-19 18:17:27'),(55,'/images/suppliers/20200419_182116_banner-tbee3.png','2020-04-19 18:21:16','2020-04-19 18:21:16'),(56,'/images/products/20200419_182402_phpCfmcam_sp1-2.jpeg','2020-04-19 18:24:02','2020-04-19 18:24:02'),(57,'/images/products/20200419_182402_phpohbcOc_sp1-1.jpeg','2020-04-19 18:24:02','2020-04-19 18:24:02'),(58,'/images/products/20200419_182402_phpOPBkpd_sp1.jpeg','2020-04-19 18:24:02','2020-04-19 18:24:02'),(59,'/images/products/20200419_182553_phpcfniKO_sp2-2.jpeg','2020-04-19 18:25:53','2020-04-19 18:25:53'),(60,'/images/products/20200419_182553_phpOEllEd_sp2-1.jpeg','2020-04-19 18:25:53','2020-04-19 18:25:53'),(61,'/images/products/20200419_182553_phpCGbJAH_sp2.jpeg','2020-04-19 18:25:53','2020-04-19 18:25:53'),(62,'/images/products/20200419_182750_phpcGdkKp_sp3-2.jpeg','2020-04-19 18:27:50','2020-04-19 18:27:50'),(63,'/images/products/20200419_182750_phpgOCNfB_sp3-1.jpeg','2020-04-19 18:27:50','2020-04-19 18:27:50'),(64,'/images/products/20200419_182750_phpkAdjbp_sp3.jpeg','2020-04-19 18:27:50','2020-04-19 18:27:50'),(65,'/images/products/20200419_182947_phpoHbJCk_sp4-3.jpeg','2020-04-19 18:29:47','2020-04-19 18:29:47'),(66,'/images/products/20200419_182947_phpGJlApG_sp4-2.jpeg','2020-04-19 18:29:47','2020-04-19 18:29:47'),(67,'/images/products/20200419_182947_phpoAjhIK_sp4-1.jpeg','2020-04-19 18:29:47','2020-04-19 18:29:47'),(68,'/images/products/20200419_182947_phpgcoMEp_sp4.jpeg','2020-04-19 18:29:47','2020-04-19 18:29:47'),(69,'/images/products/20200419_183122_phpkgCCMe_sp5.jpeg','2020-04-19 18:31:22','2020-04-19 18:31:22'),(70,'/images/products/20200419_183122_phpOgJeNG_sp5-1.jpeg','2020-04-19 18:31:22','2020-04-19 18:31:22'),(71,'/images/products/20200419_183123_phpCKDDFc_sp5-2.jpeg','2020-04-19 18:31:23','2020-04-19 18:31:23'),(72,'/images/products/20200419_183304_phpcIIFGB_sp6-2.jpeg','2020-04-19 18:33:04','2020-04-19 18:33:04'),(73,'/images/products/20200419_183304_phpOmlCol_sp6-1.jpeg','2020-04-19 18:33:04','2020-04-19 18:33:04'),(74,'/images/products/20200419_183304_phpCabchP_sp6.jpeg','2020-04-19 18:33:04','2020-04-19 18:33:04'),(75,'/images/products/20200419_183606_phpcLpOhI_sp7-3.jpeg','2020-04-19 18:36:06','2020-04-19 18:36:06'),(76,'/images/products/20200419_183606_phpKnLGdP_sp7-2.jpeg','2020-04-19 18:36:06','2020-04-19 18:36:06'),(77,'/images/products/20200419_183606_phpKbELLn_sp7-1.jpeg','2020-04-19 18:36:06','2020-04-19 18:36:06'),(78,'/images/products/20200419_183606_phpcKgmbk_sp7.jpeg','2020-04-19 18:36:06','2020-04-19 18:36:06'),(79,'/images/products/20200419_183825_phpkjgmhF_sp8-3.jpeg','2020-04-19 18:38:25','2020-04-19 18:38:25'),(80,'/images/products/20200419_183825_phpCFalmd_sp8-2.jpeg','2020-04-19 18:38:25','2020-04-19 18:38:25'),(81,'/images/products/20200419_183825_phpChCFlO_sp8-1.jpeg','2020-04-19 18:38:25','2020-04-19 18:38:25'),(82,'/images/products/20200419_183825_phpCiePbJ_sp8.jpeg','2020-04-19 18:38:25','2020-04-19 18:38:25'),(83,'/images/suppliers/20200419_214902_banner-tbee4.jpeg','2020-04-19 21:49:02','2020-04-19 21:49:02'),(84,'/images/products/20200419_215240_phpcpDBdj_sp1.jpeg','2020-04-19 21:52:40','2020-04-19 21:52:40'),(85,'/images/products/20200419_215240_phplfNGpF_sp1-1.jpeg','2020-04-19 21:52:40','2020-04-19 21:52:40'),(86,'/images/products/20200419_215240_phpefInpP_sp1-2.jpeg','2020-04-19 21:52:40','2020-04-19 21:52:40'),(87,'/images/products/20200419_215240_phpjdLDlJ_sp1-3.jpeg','2020-04-19 21:52:40','2020-04-19 21:52:40'),(88,'/images/products/20200419_215627_phpFDNhha_sp2.jpeg','2020-04-19 21:56:27','2020-04-19 21:56:27'),(89,'/images/products/20200419_215627_phpHFNDia_sp2-1.jpeg','2020-04-19 21:56:27','2020-04-19 21:56:27'),(90,'/images/products/20200419_215627_phpDkACGL_sp2-2.jpeg','2020-04-19 21:56:27','2020-04-19 21:56:27'),(91,'/images/products/20200419_215632_phpNMkdBh_sp2.jpeg','2020-04-19 21:56:32','2020-04-19 21:56:32'),(92,'/images/products/20200419_215632_phpghJAak_sp2-1.jpeg','2020-04-19 21:56:32','2020-04-19 21:56:32'),(93,'/images/products/20200419_215632_phpdPlfAf_sp2-2.jpeg','2020-04-19 21:56:32','2020-04-19 21:56:32'),(94,'/images/products/20200419_215729_phpfaIHdD_sp3.jpeg','2020-04-19 21:57:29','2020-04-19 21:57:29'),(95,'/images/products/20200419_215729_phpKCOFeg_sp3-1.jpeg','2020-04-19 21:57:29','2020-04-19 21:57:29'),(96,'/images/products/20200419_215729_phpPJMcoj_sp3-2.jpeg','2020-04-19 21:57:29','2020-04-19 21:57:29'),(97,'/images/products/20200419_215953_phpMgJCph_sp4.jpeg','2020-04-19 21:59:53','2020-04-19 21:59:53'),(98,'/images/products/20200419_215953_phpfKKAHM_sp4-1.jpeg','2020-04-19 21:59:53','2020-04-19 21:59:53'),(99,'/images/products/20200419_215954_phpkjfgBp_sp4-2.jpeg','2020-04-19 21:59:54','2020-04-19 21:59:54'),(100,'/images/products/20200419_220123_phppnaelC_sp6-2.jpeg','2020-04-19 22:01:23','2020-04-19 22:01:23'),(101,'/images/products/20200419_220123_phplbbLBB_sp6-1.jpeg','2020-04-19 22:01:23','2020-04-19 22:01:23'),(102,'/images/products/20200419_220124_phpAafboi_sp6.jpeg','2020-04-19 22:01:24','2020-04-19 22:01:24'),(103,'/images/suppliers/20200419_220333_banner-tbee5.jpeg','2020-04-19 22:03:34','2020-04-19 22:03:34'),(104,'/images/products/20200419_220506_phpKJgmpp_sp1.jpeg','2020-04-19 22:05:07','2020-04-19 22:05:07'),(105,'/images/products/20200419_220507_phppEBIjK_sp1-2.jpeg','2020-04-19 22:05:07','2020-04-19 22:05:07'),(106,'/images/products/20200419_220507_phphdEBan_sp1-1.jpeg','2020-04-19 22:05:07','2020-04-19 22:05:07'),(107,'/images/products/20200419_220512_phppbFFjg_sp1.jpeg','2020-04-19 22:05:12','2020-04-19 22:05:12'),(108,'/images/products/20200419_220512_phpDIMmIH_sp1-2.jpeg','2020-04-19 22:05:12','2020-04-19 22:05:12'),(109,'/images/products/20200419_220512_phpfJiAGP_sp1-1.jpeg','2020-04-19 22:05:12','2020-04-19 22:05:12'),(110,'/images/products/20200419_220645_phpIjhDKJ_sp2-1.jpeg','2020-04-19 22:06:45','2020-04-19 22:06:45'),(111,'/images/products/20200419_220645_phpfCmAAp_sp2.jpeg','2020-04-19 22:06:45','2020-04-19 22:06:45'),(112,'/images/suppliers/20200509_162214_banner-tbee2.jpg','2020-05-09 16:22:14','2020-05-09 16:22:14'),(113,'/images/products/20200509_163121_phpPjEfID_sp4.jpg','2020-05-09 16:31:21','2020-05-09 16:31:21'),(114,'/images/products/20200509_163121_phpHccEih_sp4-1.jpg','2020-05-09 16:31:21','2020-05-09 16:31:21'),(115,'/images/products/20200509_163121_phpLcgLhP_sp4-2.jpg','2020-05-09 16:31:21','2020-05-09 16:31:21'),(116,'/images/products/20200509_163121_phpLegclP_sp4-3.jpg','2020-05-09 16:31:21','2020-05-09 16:31:21'),(117,'/images/users/20200524_170206_logo.png','2020-05-24 17:02:06','2020-05-24 17:02:06');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sender` bigint(20) unsigned NOT NULL,
  `receiver` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (18,'2020_02_02_223707_create_images_table',1),(19,'2020_02_03_000000_create_users_table',1),(20,'2020_02_03_100000_create_password_resets_table',1),(21,'2020_02_03_144836_create_messages_table',1),(22,'2020_02_03_144903_create_notifications_table',1),(23,'2020_02_03_144921_create_roles_table',1),(24,'2020_02_03_155729_create_role_user_table',1),(25,'2020_02_03_215105_create_address_info_table',1),(26,'2020_02_03_215120_create_suppliers_table',1),(27,'2020_02_03_215220_create_category_level1_table',1),(28,'2020_02_03_215244_create_category_level2_table',1),(29,'2020_02_03_215352_create_products_table',1),(30,'2020_02_03_215725_create_coupons_table',1),(33,'2020_02_03_223543_create_cart_table',1),(34,'2020_04_07_100513_create_image_product_table',1),(35,'2020_02_03_215938_create_orders_table',2),(36,'2020_02_03_220020_create_order_detail_table',3),(37,'2020_05_21_083339_add_status_to_orders_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'Bạn có đơn hàng mới từ tbee',6,'/supplier/orders','2020-05-16 18:32:34','2020-05-16 18:32:34'),(2,'Bạn có đơn hàng mới từ tbee',6,'/supplier/orders','2020-05-21 21:19:09','2020-05-21 21:19:09'),(3,'Đơn hàng 2 của bạn đã được người bán asus_flagship_hch_store xác nhận',1,'/user/orders','2020-05-23 22:59:45','2020-05-23 22:59:45'),(4,'Bạn có đơn hàng mới từ tbee2',7,'/supplier/orders','2020-05-26 00:43:10','2020-05-26 00:43:10');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` mediumint(8) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_detail_order_id_foreign` (`order_id`),
  KEY `order_detail_product_id_foreign` (`product_id`),
  CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` VALUES (1,1,27,1,13000000,NULL,NULL),(2,1,28,2,1990000,NULL,NULL),(3,2,28,2,1990000,NULL,NULL),(4,3,30,3,109000,NULL,NULL);
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` bigint(20) unsigned NOT NULL,
  `coupon_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `orders_supplier_id_foreign` (`supplier_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_coupon_id_foreign` (`coupon_id`),
  CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  CONSTRAINT `orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,5,1,'Trần Anh Tú','0888888888','301 Đống Đa, Hà Nội',16880000,1,'2020-05-16 18:32:34','2020-05-16 18:32:34','pending'),(2,5,1,'Trần Anh Thư','0963318303','288 Sóc Sơn, Hà Nội',3980000,NULL,'2020-05-21 21:19:09','2020-05-23 22:59:45','done'),(3,6,3,'Nguyễn Văn A','0151515158','928 Bạch Đằng, New York',327000,NULL,'2020-05-26 00:43:10','2020-05-26 00:43:10','pending');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `category_level2_id` mediumint(8) unsigned NOT NULL,
  `image_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` bigint(20) unsigned NOT NULL,
  `sale_price` bigint(20) unsigned NOT NULL,
  `stock` mediumint(9) NOT NULL,
  `purchased_number` mediumint(9) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `products_image_id_foreign` (`image_id`),
  KEY `products_supplier_id_foreign` (`supplier_id`),
  KEY `products_category_level2_id_foreign` (`category_level2_id`),
  CONSTRAINT `products_category_level2_id_foreign` FOREIGN KEY (`category_level2_id`) REFERENCES `category_level2` (`id`),
  CONSTRAINT `products_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,4,'Áo Thun Cộc Tay Nam Ariza chất Cotton','- Chất liệu: Áo thun nam body Ariza cao cấp được làm từ Vải thun cotton 100% co giãn tốt, mềm mịn, thấm hút mồ hôi tốt, đường chỉ may chắc chắn, tỉ mỉ theo tiêu chuẩn hàng công ty.\r\n- Chất cotton làm tự sợi bông tự nhiên đặc điểm thấm hút tốt, thoáng mát vì vậy Áo thun nam cotton Ariza mỏng vừa phải, thoáng mát thấm hút mồ hôi tốt, tạo sự thoải mải, dễ chịu không giống như các loại áo PE không thấm mồ hôi, mặc khó chịu, bí đặc biệt vào mùa hè khi thời tiết nóng, nhiệt độ cao 39-40 độ, hoặc khi vận động nếu không thoáng mát thấm mồ hôi sẽ rất khó chịu, ảnh hưởng đến sức khỏe.\r\n- Quý khách có thể thử áo, khi đã giặt áo và phơi áo 1 lần với áo mới, thử nhỏ nước từng giọt vào áo nếu thấm hút thì có sợi cotton, thấm hút nhanh là áo càng nhiều cotton.\r\n- Kiểu dáng: Thời trang, trẻ trung, năng động thích hợp cho mọi lứa tuổi. Dáng áo thun nam cotton 100% Ariza  body trẻ trung, chất liệu co giãn tạo cảm giác thoải mái, áo mỏng vừa phải thoáng mát.\r\n- Xuất xứ: Việt Nam do xưởng Shop sản xuất',80000,80000,215,0,'2020-04-15 23:16:59','2020-04-15 23:16:59',NULL,0),(2,1,1,7,'Áo nam 2','Áo nam chất lượng tốt, có thể mặc đi làm, đi chơi',150000,120000,300,0,'2020-04-18 09:51:04','2020-04-18 09:51:04',NULL,0),(3,1,2,9,'Quần âu nam Kojiba dáng ôm co giãn nhẹ','BẠN NHỚ LIKE SẢN PHẨM VÀ THEO DÕI SHOP ĐỂ LUÔN CẬP NHẬT MÃ GIẢM GIÁ, CHƯƠNG TRÌNH DEAL SỐC , KHUYẾN MÃI KHỦNG TRONG THÔNG BÁO CỦA BẠN NHA, CÁM ƠN BẠN!!!\r\nThông tin nổi bật sản phẩm:\r\n- Xuất xứ: Việt Nam\r\n- Màu sắc: Đen, Xanh Đen, Ghi Sáng\r\n- Size: 28, 29, 30, 31, 32, 33, 34\r\n- Chất liệu: Cotton co giãn\r\nquần âu nam, quần tây nam đẹp cao cấp:',200000,199000,123,0,'2020-04-18 09:56:32','2020-04-18 09:56:32',NULL,0),(4,1,3,11,'ÁO HOODIE TRƠN BASIC','ÁO HOODIE TRƠN BASIC ĐỦ MÀU UNISEX , áo thun tay lỡ, áo hoddie, quần kaki\r\nHoodie Basic là chiếc áo không thể thiếu trong mọi tủ đồ mỗi dịp Đông về ☃️\r\n❄ Sắm đủ màu để mỗi ngày diện 1 bộ được không ạ ?\r\n?️ Chất liệu Nỉ bông mềm mịn, êm ái đem lại cảm giác thoải mái nhất khi mặc thường xuyên.\r\n?️ Size: M L XL ( Form Âu rộng rãi thoải mái ).',250000,225000,235,0,'2020-04-18 10:00:44','2020-04-18 10:00:44',NULL,0),(5,2,6,21,'CALM REDNESS RELIEF 1% BHA LOTION EXFOLIANT','LOẠI BỎ TẾ BÀO CHẾT SÂU BÊN TRONG LỖ CHÂN LÔNG\r\nHoàn toàn dịu nhẹ, không chứa tính bào mòn, loại bỏ tế bào chết sâu bên trong lỗ chân lông Nhờ thành phần Salicylic Acid, axit gốc dầu đi sâu dưới da, quét sạch dầu thừa da chết kết hợp dưỡng da, không khô hay kích ứng Giảm mụn viêm sưng, cải thiện bề mặt da do mụn và hạn chế phát sinh thêm vấn đề da khác\r\nTHÀNH PHẦN:\r\nWater, Butylene Glycol, Cetyl Alcohol, Cyclopentasiloxane, Dimethicone, Salicylic Acid, Avena Sativa Bran Extract, Allantoin, Camellia Sinensis  Leaf Extract, Glycyrrhiza Glabra Root Extract, Epilobium Angustifolium Flower/Leaf/Stem Extract, Lauric Acid, Glycerin, Polysorbate 20, Sorbitan Stearate, Magnesium Aluminum Silicate, Ammonium Acryloyldimethyltaurate/VP Copolymer, PEG-40 Stearate, Xanthan Gum, Hexylene Glycol, Sodium Hydroxide, Ethylhexylglycerin, Disodium EDTA, Phenoxyethanol, Caprylyl Glycol',910000,830000,30,0,'2020-04-19 17:29:58','2020-04-19 17:29:58',NULL,0),(6,2,6,23,'SKIN PERFECTING 2% BHA LIQUID EXFOLIANT','Sản phẩm tẩy tế bào chết hóa học, với công thức dịu nhẹ, không chứa chất làm bào mòn da, dễ dàng thẩm thấu mà không làm bít tắc lỗ chân lông. Loại bỏ sự xuất hiện của nếp nhăn sâu, cải thiện tông màu da ,giúp làn da sáng mịn, rạng rỡ và khỏe mạnh.\r\n\r\n– Làm giảm dấu hiệu lão hóa, mụn đầu đen, lỗ chân lông to.\r\n\r\n– Giảm sưng đỏ, cải thiện nếp nhăn sâu.\r\n\r\n– 2% BHA không làm bít tắc lỗ chân lông và hoàn toàn loại bỏ lỗ chân lông to.\r\n\r\n– Dùng cho mọi loại da.\r\n\r\nTHÀNH PHẦN:\r\nWater, Methylpropanediol, Butylene Glycol, Salicylic Acid, Polysorbate 20, Camellia Oleifera Leaf Extract, Sodium Hydroxide, Tetrasodium EDTA.',910000,630000,200,0,'2020-04-19 17:40:12','2020-04-19 17:40:12',NULL,0),(7,2,7,26,'LIPSCREEN BROAD SPECTRUM SPF 50','Chống nắng toàn diện\r\nChống nắng siêu linh hoạt vừa dưỡng ẩm, vừa chống nắng toàn diện cho môi.\r\n\r\nThành phần tự nhiên\r\nSở hữu bảng thành phần lành tính, phù hợp với làn da môi mỏng manh.\r\n\r\nNgăn ngừa lão hóa\r\nCác hoạt chất chống gốc tự do ngăn ngừa lão hóa, giúp đôi môi luôn hồng hào và mềm mượt.\r\n\r\nTHÀNH PHẦN: \r\nActive Ingredients:Avobenzone (3%), Homosalate (5%), Octisalate (5%), Octocrylene (2.5%)\r\nInactive Ingredients: Hydrogenated Soybean Oil (non-fragrant oil/antioxidant/emollient), Bis-Diglyceryl Polyacyladipate-2 (emollient), Hydrogenated Olive Oil (non-fragrant oil/antioxidant/emollient), Polyglyceryl-3 Diisostearate (emollient/texture-enhancing), Beeswax (texture-enhancing), Ozokerite (texture-enhancing), Hydrogenated Jojoba Oil (non-fragrant oil/emollient), Polyethylene (texture-enhancing), Hydrogenated Polycyclopentadiene (texture-enhancing), Microcrystalline Wax (texture-enhancing), Theobroma Cacao Seed Butter (cocoa butter/emollient/antioxidant), Silica (texture-enhancing), Tocopheryl Acetate (vitamin E/antioxidant), Butyrospermum Parkii Butter (shea butter/emollient/antioxidant), Olea Europaea Fruit Oil (olive oil/non-fragrant oil/antioxidant/emollient), Phytosterols (skin replenishing), Tocopherol (vitamin E/antioxidant), Hydrogenated Vegetable Oil (emollient), Copernicia Cerifera Wax (carnauba wax/texture-enhancing), Water (Aqua), Phenoxyethanol (preservative).',299000,200000,100,0,'2020-04-19 17:46:16','2020-04-19 17:46:16',NULL,0),(8,3,15,30,'Túi xách nữ đeo chéo trống tròn trơn chính hãng Tây Ban Nha Venuco Madrid S394 nhiều màu','Màu sắc: Đỏ, Ghi, Nâu Cam, Hồng, Xanh Than, Đen đậm, Vàng cúc\r\nThương hiệu: Venuco Madrid\r\nChất liệu : Da PU & Polyester\r\nStyle : Fashion\r\nGiới tính : Cho Phụ Nữ\r\nThiết kế tại Tây Ban Nha\r\nDesigners : Nadya and Eloisa\r\nKích thước: Cao 18cm, Dài 18,5cm, Rộng 6,5cm\r\nCách bảo quản : lau bằng khăn ẩm, không dùng hóa chất\r\nCông dụng : xách tay , đeo chéo, đeo vai, đi làm , đi chơi, đi biển\r\nĐể vừa IPhone plus, các chi tiết khóa mạ xi cao cấp,chống oxi hóa bền đẹp\r\nSản xuất tại Tây Ban Nha và nhập khẩu từ các nước thứ 3\r\nBảo hành : 1 đổi 1 trong 7 ngày nếu có lỗi do hãng sản xuất,bảo hành 1 tháng\r\nThương hiệu VENUCO được sáng lập bởi 2 nhà thiết kế người Tây Ban Nha là Nadya và Eloisa được thành lập tại Madrid năm 2010, với các yếu tố thiết kế hoạ tiết cơ bản kết hợp vào một loạt các sản phẩm thông qua một quy trình sản xuất đặc biệt, túi xách là sản phẩm chính ban đầu sau đó đến phụ kiện cho sản phẩm. Sau nhiều năm phát triển, dòng sản phẩm của VENUCO đã bao phủ tất cả các lĩnh vực túi xách, đồ gia dụng, thiết bị cho kỹ thuật số, vật tư, du lịch.',1828000,999000,50,0,'2020-04-19 17:57:08','2020-04-19 17:57:08',NULL,0),(9,3,15,36,'Túi xách nữ Chính Hãng Tây Ban Nha VENUCO MADRID B155 nhiều màu','Chất liệu : Da PU & Polyester\r\nStyle : Fashion\r\nGiới tính : Cho Phụ Nữ\r\nThiết kế tại Tây Ban Nha\r\nDesigners : Nadya and Eloisa\r\nKích thước: Cao 11 cm Ngang 17.5 cm Rộng 8 cm\r\nXuất xứ: Tây Ban Nha\r\nCách bảo quản : lau bằng khăn ẩm, không dùng hóa chất\r\nCông dụng : xách tay , đeo chéo, đeo vai, đi làm , đi chơi, đi biển\r\nĐể vừa IPhone plus, các chi tiết khóa mạ xi cao cấp,chống oxi hóa bền đẹp\r\nBảo hành : 1 đổi 1 trong 7 ngày nếu có lỗi do hãng sản xuất',1332000,666000,900,0,'2020-04-19 18:00:44','2020-04-19 18:00:44',NULL,0),(10,3,17,40,'Ví nữ để thẻ mini cầm tay Chính Hãng Tây Ban Nha VENUCO MADRID W68 nhiều màu','Chất liệu : Da PU & Polyester\r\nStyle : Fashion\r\nGiới tính : Cho Phụ Nữ\r\nThiết kế tại Tây Ban Nha\r\nDesigners : Nadya and Eloisa\r\nKích thước: Cao 9.3 cm Ngang 12 cm Rộng 1 cm\r\nCách bảo quản : lau bằng khăn ẩm, không dùng hóa chất\r\nCông dụng : để thẻ,để tiền,ví cầm tay bỏ túi\r\ncác chi tiết khóa mạ xi cao cấp,chống oxi hóa bền đẹp\r\nSản xuất tại Tây Ban Nha và nhập khẩu từ các nước thứ 3',786000,495000,30,0,'2020-04-19 18:03:20','2020-04-19 18:03:20',NULL,0),(11,3,16,43,'Balo nữ vừa đeo balo vừa đeo chéo chính hãng Tây Ban Nha VENUCO MADRID D03S345','Chất liệu : Da PU & Polyester\r\nStyle : Fashion\r\nGiới tính : Cho Phụ Nữ\r\nThiết kế tại Tây Ban Nha\r\nDesigners : Nadya and Eloisa\r\nKích thước: Cao 20 cm Ngang 17.5 cm Rộng 8.5 cm\r\nXuất xứ: Tây Ban Nha\r\nCách bảo quản : lau bằng khăn ẩm, không dùng hóa chất\r\nCông dụng : xách tay , đeo chéo, đi làm , đi chơi, đi biển\r\nĐể vừa IPhone plus, các chi tiết khóa mạ xi cao cấp,chống oxi hóa bền đẹp\r\nSản xuất tại Tây Ban Nha và nhập khẩu từ các nước thứ 3',1973000,1243000,99,0,'2020-04-19 18:07:28','2020-04-19 18:07:28',NULL,0),(12,3,16,46,'Balo nữ họa tiết chính hãng Tây Ban Nha Venuco Madrid S403 xanh vàng','Thương hiệu: Venuco Madrid\r\nChất liệu : Da PU & Polyester\r\nStyle : Fashion\r\nGiới tính : Cho Phụ Nữ\r\nThiết kế tại Tây Ban Nha\r\nDesigners : Nadya and Eloisa\r\nKích thước: Cao 23 cm Ngang 20 cm Rộng 12 cm\r\nCách bảo quản : lau bằng khăn ẩm, không dùng hóa chất\r\nCông dụng : đeo vai, đi làm , đi chơi, đi biển\r\nĐể vừa IPhone plus, các chi tiết khóa mạ xi cao cấp,chống oxi hóa bền đẹp\r\nSản xuất tại Tây Ban Nha và nhập khẩu từ các nước thứ 3',1998000,1998000,80,0,'2020-04-19 18:09:47','2020-04-19 18:09:47',NULL,0),(13,3,17,48,'Ví Chính Hãng Tây Ban Nha VENUCO MADRID','Gồm 4 màu : Xanh Navy, Xanh Lá, Nude, Đỏ\r\nChất liệu : Da PU & Polyester\r\nStyle : Fashion\r\nGiới tính : Cho Phụ Nữ\r\nThiết kế tại Tây Ban Nha\r\nDesigners : Nadya and Eloisa\r\nKích thước: Cao 10 cm Ngang 10 cm Rộng 10 cm\r\nXuất xứ: Tây Ban Nha\r\nCách bảo quản : lau bằng khăn ẩm, không dùng hóa chất\r\nCông dụng : xách tay , đeo chéo, đeo vai, đi làm , đi chơi, đi biển\r\nĐể vừa IPhone plus, các chi tiết khóa mạ xi cao cấp,chống oxi hóa bền đẹp\r\nSản xuất tại Tây Ban Nha và nhập khẩu từ các nước thứ 3',575000,362000,88,0,'2020-04-19 18:12:56','2020-04-19 18:12:56',NULL,0),(14,3,17,50,'Ví nữ mini gập khoá họa tiết chính hãng Tây Ban Nha VENUCO Q30','Chất liệu : Da PU & Polyester\r\nStyle : Fashion\r\nGiới tính : Cho Phụ Nữ\r\nThiết kế tại Tây Ban Nha\r\nDesigners : Nadya and Eloisa\r\nKích thước: Cao 9.5 cm Ngang 11 cm Rộng 1 cm\r\nCách bảo quản : lau bằng khăn ẩm, không dùng hóa chất\r\nCông dụng : để tiền,mini cầm tay,bỏ túi\r\n các chi tiết khóa mạ xi cao cấp,chống oxi hóa bền đẹp\r\nSản xuất tại Tây Ban Nha và nhập khẩu từ các nước thứ 3',839000,528000,70,0,'2020-04-19 18:15:12','2020-04-19 18:15:12',NULL,0),(15,3,15,53,'Túi xách nữ da thật Chính Hãng Tây Ban Nha VENUCO MADRID A47 đen','Màu: Trắng hoa\r\nChất liệu : Da thật\r\nStyle : Fashion\r\nGiới tính : Cho Phụ Nữ\r\nThiết kế tại Tây Ban Nha\r\nDesigners : Nadya and Eloisa\r\nKích thước: Cao 11.5 cm Ngang 18.5 cm Rộng 7 cm\r\nXuất xứ: Tây Ban Nha\r\nCách bảo quản : lau bằng khăn ẩm, không dùng hóa chất\r\nCông dụng : xách tay , đeo chéo, đeo vai, đi làm , đi chơi, đi biển\r\nĐể vừa IPhone plus, các chi tiết khóa mạ xi cao cấp,chống oxi hóa bền đẹp',2212000,1106000,7,0,'2020-04-19 18:17:27','2020-04-19 18:17:27',NULL,0),(16,4,14,58,'[WF58394] Giày Thể Thao Keds Nữ - Champion Metallic Hygge Peacoat','Thân giày:\r\n- Chất liệu: vải dệt hoạt tiết.\r\n- 4 lỗ xỏ dây.\r\n- Màu: xanh.\r\n- Dây giày: nâu\r\n- Chiều cao giày: 2 cm\r\n\r\nBên trong giày:\r\n- Lót giày trong: sử dụng đệm lót công nghệ Orthorlite, tạo cảm giác êm ái ngay cả khi mang giày cao và hạn chế vi khuẩn gây mùi chân trong quá trình di chuyển.\r\n\r\nXuất xứ giày: Nhập khẩu\r\n\r\nHướng dẫn vệ sinh giày: chỉ vệ sinh tại chỗ vết bẩn, giặt khô.',1380000,690000,20,0,'2020-04-19 18:24:02','2020-04-19 18:24:02',NULL,0),(17,4,14,61,'[WF59357] Giày Thể Thao Keds Nữ - Champion Starlight Canvas White','Thân giày:\r\n- Chất liệu: vải phủ lớp kim tuyến mỏng toàn thân giày.\r\n- 4 lỗ xỏ dây.\r\n- Màu: trắng.\r\n- Dây giày: màu trắng.\r\n- Chiều cao giày: 2 cm\r\n\r\nBên trong giày:\r\n- Lót giày trong: sử dụng đệm lót Dream Foam độc quyền của Keds, tạo cảm giác êm ái ngay cả khi mang giày cao và hạn chế vi khuẩn gây mùi chân trong quá trình di chuyển.\r\n\r\nXuất xứ giày: Nhập khẩu\r\n\r\nHướng dẫn vệ sinh giày: chỉ vệ sinh tại chỗ vết bẩn, giặt khô.',1250000,1250000,60,0,'2020-04-19 18:25:53','2020-04-19 18:25:53',NULL,0),(18,4,14,64,'[WF34000] Giày Thể Thao Keds Nữ - Champion Originals White','Thân giày:\r\n- Chất liệu: vải bố\r\n- 4 lỗ xỏ dây.\r\n- Màu: trắng.\r\n- Dây giày: màu trắng.\r\n- Chiều cao giày: 2cm\r\n\r\nBên trong giày:\r\n- Lót giày trong: sử dụng đệm lót công nghệ Dream Foam độc quyền, tạo cảm giác êm ái ngay cả khi mang giày cao và hạn chế vi khuẩn gây mùi chân trong quá trình di chuyển. \r\n\r\nXuất xứ giày: Nhập khẩu',990000,799000,2,0,'2020-04-19 18:27:50','2020-04-19 18:27:50',NULL,0),(19,4,14,68,'[WF58211] Giày Thể Thao Keds Nữ - Studio Leap Jersey Coral','Thân giày:\r\n- Chất liệu: vải thun jersey\r\n- Màu: hồng cam\r\n- Kiểu giày không dây.\r\n- Dây giày: màu hồng cam\r\n- Chiều cao giày: 2 cm\r\n\r\nBên trong giày:\r\n- Lót giày trong: sử dụng đệm lót công nghệ Orthorlite, tạo cảm giác êm ái ngay cả khi mang giày cao và hạn chế vi khuẩn gây mùi chân trong quá trình di chuyển. \r\n\r\nXuất xứ giày: Nhập khẩu',1760000,699000,5,0,'2020-04-19 18:29:47','2020-04-19 18:29:47',NULL,0),(20,4,14,71,'[WF59684] Giày Thể Thao Keds Nữ - Triple Decker Embroidered Herb Garden','Thân giày:\r\n- Chất liệu: vải bố (canvas).\r\n- Kiểu dáng: slip-on\r\n- Màu: đen.\r\n- Hoạ tiết hoa thêu nổi sang trọng.\r\n- Chiều cao giày: 2,5cm\r\n\r\nBên trong giày:\r\n- Lót giày trong: sử dụng đệm lót Orthorlite, tạo cảm giác êm ái ngay cả khi mang giày cao và hạn chế vi khuẩn gây mùi chân trong quá trình di chuyển.\r\n\r\nXuất xứ giày: Nhập khẩu',1800000,799000,20,0,'2020-04-19 18:31:23','2020-04-19 18:31:23',NULL,0),(21,4,14,72,'[WF60481] Giày Thể Thao Keds Nữ - Champion Lips White','Ngộ nghĩnh và tươi vui cùng mẫu giày Champion họa tiết đôi môi đến từ bst cao cấp Keds for katespadeny!!\r\n\r\nThân giày:\r\n- Chất liệu: vải họa tiết đôi môi.\r\n- 4 lỗ xỏ dây.\r\n- Màu: trắng (white).\r\n- Chiều cao giày: 2 cm\r\n\r\nBên trong giày:\r\n- Lót giày trong: sử dụng đệm lót thế hệ mới Dream Foam, tạo cảm giác êm ái ngay cả khi mang giày cao và hạn chế vi khuẩn gây mùi chân trong quá trình di chuyển.\r\n\r\nXuất xứ giày: Nhập khẩu\r\n\r\nHướng dẫn vệ sinh giày: chỉ vệ sinh tại chỗ vết bẩn, giặt khô.',1780000,1780000,3,0,'2020-04-19 18:33:04','2020-04-19 18:33:04',NULL,0),(22,4,14,78,'[WF59172] Giày Thể Thao Keds Nữ - Studio Flash Heathered Mesh Navy','Đậm chất thể thao nhưng vẫn đem đến vẻ ngoài sành điệu cho người mang, những đôi Studio Flash mới nhất trong bst Keds Studio được cải tiến về chất vải có thể co giãn 360° phù hợp với mọi khuôn chân, thoáng mát kết hợp cùng công nghệ làm mát tối ưu tại phần lót giày để kiểm soát độ ẩm của chân. Ngoài ra phần đế giày siêu nhẹ đi kèm cùng miếng đệm hỗ trợ gót giúp đem đến sự thoải mái cả ngày dành cho nàng. Với 4 gam màu trắng, hồng nhạt, xanh navy và đen, đâu sẽ là sự lựa chọn lý tưởng dành cho các cô nàng năng động của Keds đây nhỉ?\r\n\r\nThân giày:\r\n- Chất liệu: vải lưới.\r\n- Kiểu giày không dây tiện lợi.\r\n- Màu: xanh navy.\r\n- Chiều cao giày: 2 cm\r\n\r\nBên trong giày:\r\n- Lót giày trong: sử dụng đệm lót công nghệ riêng của Keds, tạo cảm giác êm ái ngay cả khi mang giày cao và hạn chế vi khuẩn gây mùi chân trong quá trình di chuyển.\r\n\r\nXuất xứ giày: Nhập khẩu',1960000,1372000,5,0,'2020-04-19 18:36:06','2020-04-19 18:36:06',NULL,0),(23,4,14,82,'[WF58055] Giày Thể Thao Keds Nữ - Triple Kick Striped Mesh Indigo','Thoáng mát với lớp vải lưới bố trí 2 bên thân giầy, cộng với miếng lót đệm Ortholite bên trong thì đây đích thị là đôi giày lý tưởng cho các cô nàng đúng không ?\r\n\r\nThân giày:\r\n- Chất liệu: vải lưới thoáng mát\r\n- 6 lỗ xỏ dây.\r\n- Màu: xanh dương đậm (indigo).\r\n- Chiều cao giày: 2.5 cm\r\n\r\nBên trong giày:\r\n- Lót giày trong: sử dụng đệm lót công nghệ Orthorlite, tạo cảm giác êm ái ngay cả khi mang giày cao và hạn chế vi khuẩn gây mùi chân trong quá trình di chuyển.\r\n\r\nXuất xứ giày: Nhập khẩu\r\n\r\nHướng dẫn vệ sinh giày: chỉ vệ sinh tại chỗ vết bẩn, giặt khô.',1450000,599000,53,0,'2020-04-19 18:38:25','2020-04-19 18:38:25',NULL,0),(24,5,18,84,'Màn hình ASUS TUF Gaming VG249Q 24\" FHD IPS 144Hz FreeSync 1ms','•	Màn hình Full HD (1920x1080) \r\n•	tốc độ làm mới cực nhanh 144Hz được thiết kế cho các game thủ chuyên nghiệp\r\n•	Công nghệ ASUS Extreme Low Motion Blur Sync (ELMB SYNC) cho phép thời gian phản hồi 1ms (MPRT)\r\n•	Công nghệ FreeSync để loại bỏ tốc độ rách màn hình và tốc độ khung hình\r\n•	Có chân đế được thiết kế công thái học để cung cấp các điều chỉnh xoay, nghiêng và chiều cao mở rộng\r\n•	Bảo hành: 36 tháng',6390000,6390000,7,0,'2020-04-19 21:52:40','2020-04-19 21:52:40',NULL,0),(25,5,18,91,'Màn Hình Cảm Ứng Di Động ASUS ZenScreen MB16AMT 15.6\" IP FHD, 7800mAh, USB Type-C','•	Màn hình IPS di động Full HD 15,6 inch với kích thước siêu mỏng 9mm và khối lượng chỉ 0,9 kg\r\n•	Đầu vào phản hồi và trực quan nhờ với chức năng cảm ứng 10 điểm hỗ trợ thực hiện đa tác vụ hiệu suất cao\r\n•	Pin tích hợp 7800 mAh mạnh mẽ hỗ trợ tới bốn giờ sử dụng\r\n•	Các cổng USB-C và micro-HDMI tín hiệu lai hỗ trợ kết nối đa năng với điện thoại thông minh, laptop, bộ điều khiển chơi game, camera, máy tính bảng và nhiều thứ khác nữa\r\n•	Vỏ gập bảo vệ thông minh có thể được chuyển thành chân đế để đỡ màn hình ở chế độ nằm dọc hoặc nằm ngang\r\n•	Bảo hành: 36 tháng chính hang ASUS',11400000,11400000,6,0,'2020-04-19 21:56:32','2020-04-19 21:56:32',NULL,0),(26,5,8,94,'Laptop ASUS UX434FLC-A6212T i5-10210U | 8GB | 512GB | GeForce MX250 |14 FHD IPS | WIN 10','•	CPU	Intel Core i5-10210U 1.6GHz up to 4.2GHz 6MB\r\n•	RAM	8GB LPDDR3 2133MHz (Onboard)\r\n•	Ổ cứng	512GB SSD M.2 PCIE G3X2\r\n•	Card đồ họa	NVIDIA GeForce MX250 2GB GDDR5 + Intel UHD Graphics 620\r\n•	Màn hình	14\" FHD (1920 x 1080) IPS, NanoEdge, 72% NTSC, 100% sRGB, 300nits\r\n•	Cổng giao tiếp	1x USB 3.1 Gen 2 Type-C™\r\n•	1x USB 3.1 Gen 2 Type-A\r\n•	1x USB 2.0\r\n•	1x Standard HDMI\r\n•	1x MicroSD card reader\r\n•	1x Audio combo jack\r\n•	1x DC-in\r\n•	Audio	Harman Kardon\r\n•	Đọc thẻ nhớ	MicroSD Card Reader\r\n•	ScreenPad	5.65” FHD+ (2160 x 1080) Super IPS Display, 178˚ Wide-view\r\n•	Chuẩn WIFI	Wi-Fi 6 (802.11ax(2x2))\r\n•	Bluetooth	v5.0\r\n•	Webcam	3D IR HD Camera\r\n•	Hệ điều hành	Windows 10 Home\r\n•	Pin	3 Cell 50WHr Lithium-Polymer\r\n•	Trọng lượng	1.26kg\r\n•	Màu sắc	Silver\r\n•	Kích thước	31.9 x 19.9 x 1.69 (cm)\r\n•	Bảo hành  24 tháng toàn cầu',26490000,23590000,20,2,'2020-04-19 21:57:29','2020-04-19 21:57:29',NULL,0),(27,5,8,97,'Laptop ASUS ZenBook Duo UX481FL-BM048T Core i5-10210U | 8GB | 512 GB| MX250| Win 10','•	CPU	Intel Core i5-10210U 1.6GHz up to 4.2GHz 6MB\r\n•	RAM	8GB LPDDR3 2133MHz\r\n•	Ổ cứng	512GB SSD M.2 PCIE G3X2\r\n•	Card đồ họa	NVIDIA GeForce MX250 2GB GDDR5 + Intel UHD Graphics\r\n•	Màn hình	14\" FHD (1920 x 1080) IPS, 72% NTSC, 100% sRGB\r\n•	ScreenPad™ Plus	\r\n•	12.6” FHD (1920 x 1080) Super IPS + Display 178˚ wide-view technology\r\n•	Cổng giao tiếp	 1x USB 3.1 Gen 2 Type-C™; 1x USB 3.1 Gen 2 Type-A; 1x USB 3.1 Gen 1 Type-A; 1x Standard HDMI; 1x Audio combo jack; 1x SD card reader; 1x DC-in; \r\n•	Audio	ASUS SonicMaster\r\n•	Đọc thẻ nhớ	MicroSD card reader',14000000,13000000,4,1,'2020-04-19 21:59:54','2020-05-16 18:32:34',NULL,0),(28,5,18,100,'Màn Hình ASUS VS207DF 20\" 5ms 75Hz -Chính hãng','Thông số sản phẩm\r\n•	Loại màn hình: LCD-LED\r\n•	Độ phân giải: 1366x786 pixels\r\n•	Thời gian đáp ứng: 5ms\r\n•	Độ sáng: 200cd/㎡\r\n•	Chức năng kiểm soát Aspect\r\n•	Công nghệ SplendidPlus\r\n•	Hỗ trợ treo tường\r\n•	Bảo hành: 36 tháng',2000000,1990000,0,2,'2020-04-19 22:01:24','2020-05-21 21:19:09',NULL,0),(29,6,10,107,'Tai Nghe Chụp Thời Trang Joyroom HP768','Thiết kế kiểu chụp tai hiện đại\r\nTai nghe chụp thời trang Joyroom HP768 được thiết kế đơn giãn nhưng mang trong mình một phong cách năng động, rất thích hợp cho các bạn làm DJ. Khung tai nghe được làm bằng chất liệu kim loại vô cùng chắc chắn, không sợ bị gãy khi sử dụng.  Với kiểu dáng chụp tai, tai nghe Joyroom HP768  đem đến chất lượng âm bass chắc, khỏe, khoảng âm lớn, khả năng lọc tiếng ồn tốt và âm lượng cao. \r\n\r\nVành chụp tai bằng giả da, êm ái\r\nĐể đem đến những âm thanh trải nghiệm sống động thì vành tai nghe Joyroom HP768 được làm bằng giả da để mang đến cảm giác êm ái, thoải mái, dễ chịu mà không bị đau tai khi sử dụng quá lâu. Do đó, rất thích hợp cho những bạn thường xuyên phải sử dụng tai nghe trong thời gian dài.',198000,99000,6,0,'2020-04-19 22:05:12','2020-04-19 22:05:12',NULL,0),(30,6,9,110,'tai nghe Baseus','Chất liệu silicone giúp bảo vệ tốt hơn nhiều cho Airpods của bạn.\r\n\r\nTạo sự hầm hố độc đáo cá tính, vừa mang tính bảo vệ cao.\r\n\r\nSạc trực tiếp mà không cần lấy Airpods ra khỏi Vỏ silicone.\r\n\r\nĐính kèm 1 dấy nối chống mất tai nghe Airpods\r\n\r\nDây nối được thiết kế bằng chất liệu cao su cao cấp\r\n\r\nDây co dãn tránh tình trạng bị đứt\r\n\r\nNối 2 tai nghe Earpods apple',150000,109000,31,3,'2020-04-19 22:06:45','2020-05-26 00:43:10',NULL,0),(31,7,6,113,'RESIST SUPER-LIGHT WRINKLE DEFENSE SPF 30','Một sản phẩm hoàn hảo dịu nhẹ cùng thành phần khoáng chất giúp chống lão hóa với chỉ số SPF bảo vệ da tối đa bằng cách thấm hút lượng dầu thừa. Đây là sản phẩm kem dưỡng ẩm ban ngày chống lão hóa dành cho những ai sở hữu làn da dầu hay hỗn hợp , chắc chắn sẽ yêu thích sản phẩm này và cảm thấy không thể thiếu nó được!',950000,900000,50,0,'2020-05-09 16:31:21','2020-05-09 16:31:21',NULL,0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,NULL,NULL),(2,1,3,NULL,NULL),(3,1,2,NULL,NULL),(4,2,3,NULL,NULL),(5,3,3,NULL,NULL),(6,4,3,NULL,NULL),(7,5,3,NULL,NULL),(8,3,2,NULL,NULL),(9,2,2,NULL,NULL),(10,4,2,NULL,NULL),(11,6,3,NULL,NULL),(12,6,2,NULL,NULL),(13,7,3,NULL,NULL),(14,7,2,NULL,NULL),(15,8,3,NULL,NULL),(16,8,2,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin',NULL,NULL),(2,'supplier',NULL,NULL),(3,'user',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `shop_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suppliers_user_id_foreign` (`user_id`),
  KEY `suppliers_banner_foreign` (`banner`),
  CONSTRAINT `suppliers_banner_foreign` FOREIGN KEY (`banner`) REFERENCES `images` (`id`),
  CONSTRAINT `suppliers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,1,'shop thu 3','22 phan phù tiên, phường cát linh, đống đa, newyork, Vietnam','Topshop - Responsive Magento Theme for Multipurpose\r\nTokyoLife là cửa hàng bán lẻ đồ gia dụng, hóa mỹ phẩm, phụ kiện chính hãng các thương hiệu Nhật Bản: KAI, Inomata, Ebisu, Lec, Seria, Merries, Glico, Aprica, Kose (Dòng Softymo) , Shiseido (Dòng Senka, Anessa), KAO, Rosette, Naive, Ebisu, Unicharm, Cocopalm, Himawari, Rocket, Gunze-Sabrina, Regart... Phụ kiện giày, túi, ví, balo và thời trang hiệu TokyoLife, TokyoBasic, In The Now và nhiều thương hiệu thời trang, phụ kiện khác sản xuất tại Việt Nam, Trung Quốc, Thái Lan…',1,'2020-04-11 22:52:51','2020-04-11 22:52:51'),(2,3,'Paula\'s choice store','Lotte Department Store, 54 Liễu Giai, HN','Paula’s Choice Skincare là thương hiệu Dược mỹ phẩm được xây dựng dựa trên những phản hồi tích cực của khách hàng và những kiến thức chăm sóc da khoa học, điều đó đã giúp duy trì những giá trị cốt lõi trong sản phẩm cũng như sự phát triển của chúng tôi. Chúng tôi hiểu rằng sự cần thiết của việc chăm sóc da và chúng tôi sẽ giữ được lời hứa của mình. Bạn sẽ hoàn toàn cảm thấy yên tâm khi sử dụng và mua chúng.\r\n\r\nPaula’s Choice được ra mắt vào năm 1995 do Paula Begoun là người sáng lập. Sau tất cả những lời khích lệ, động viên từ bạn bè, người thân và sau khi vượt qua sự thiếu tự tin của bản thân, Paula Begoun chợt nhận ra rằng: “Tôi thực sự có thể xóa bỏ những chữ NHƯNG trong thế giới mỹ phẩm và thế giới đó sẽ đầy ắp các thành phần được nghiên cứu có lợi cho làn da”. Ý tưởng về Paula’s Choice Skincare được sinh ra từ đó, những sản phẩm đầu tiên ra mắt gần hai năm sau.',12,'2020-04-19 17:12:05','2020-04-19 17:12:05'),(3,2,'VENUCO® 139Kim Mã','139 Kim Mã, Ba Đình, Hà Nội','Chuyên mẫu sản phẩm thiết kế độc đáo',28,'2020-04-19 17:52:10','2020-04-19 17:52:10'),(4,4,'Keds Vietnam','Hồ Chí Minh','giày dép các dòng Champions, Anchor, giày đi mưa, giày thể thao',55,'2020-04-19 18:21:16','2020-04-19 18:21:16'),(5,6,'asus_flagship_hch_store','Quận Phú Nhuận, TP. Hồ Chí Minh','Chuyên đồ Asus',83,'2020-04-19 21:49:02','2020-04-19 21:49:02'),(6,7,'GUTEK - SIÊU THỊ ĐIỆN TỬ','Quận Cầu Giấy, Hà Nội','Chuyên tai nghe Gutek',103,'2020-04-19 22:03:34','2020-04-19 22:03:34'),(7,8,'Paula\'s choice store official','Lotte Department Store, 54 Liễu Giai, HN','Triết lí chăm sóc da an toàn – thông minh của Paula’s Choice được cam kết và đồng hành cùng hành trình tìm kiếm làn da đẹp nhất của mọi khách hàng. Các sản phẩm được nghiên cứu, phát huy tác dụng với làn da bạn. Dựa trên mỗi nhu cầu chăm sóc da, từng công thức sản phẩm tạo ra được kỳ vọng mang lại hiệu quả từ nghiên cứu khoa học rõ ràng.',112,'2020-05-09 16:22:14','2020-05-09 16:22:14');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  KEY `users_avatar_foreign` (`avatar`),
  CONSTRAINT `users_avatar_foreign` FOREIGN KEY (`avatar`) REFERENCES `images` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'tbee','tbee@gmail.com','$2y$10$rz5ZUh2r.XFRiUX.MvAbxuz6uut6HoQWIEfJZpvOppn7iBnyd7Gqq','0912345678',0,117,NULL,'2020-03-28 22:54:22','2020-05-24 17:02:06'),(2,'tbee1','tbee1@abc.xyz','$2y$10$SuhLJuyhBun.4aaQaNdJc.g/aoBgUNsCzhG4Kq2tzjhIXL40I5oCC','0123456789',0,NULL,NULL,'2020-04-19 16:46:30','2020-04-19 16:46:30'),(3,'tbee2','tbee2@abc.xyz','$2y$10$V/5L59Iz/J3/VnOPnrMWP.gZJ.E3swS4dxjP5CCill.y/ZTgjTQYO','0123456788',0,NULL,NULL,'2020-04-19 16:47:54','2020-04-19 16:47:54'),(4,'tbee3','tbee3@abc.xyz','$2y$10$jWkVxAyiU9G/fX1YEC00ZuVCC.naFiXEGAeEGZlHMvGyUz093WTES','0123456787',0,NULL,NULL,'2020-04-19 16:48:43','2020-04-19 16:48:43'),(5,'anhthu98','anhthu.3198@gmail.com','$2y$10$EyZc323ktRyntT962f2Nz.KsJfiQNcLMA8ewViptXrZAMIjh4aKES','0963318303',0,NULL,NULL,'2020-04-19 16:50:05','2020-04-19 16:50:05'),(6,'tbee4','tbee4@abc.xyz','$2y$10$wWhzRbDKjNLJiLQCuQItteC69q8mHvvOFYz0qE5IZb9Y8pgBzNRSG','0123456791',0,NULL,NULL,'2020-04-19 21:42:46','2020-04-19 21:42:46'),(7,'tbee5','tbee5@abc.xyz','$2y$10$VcKpGwXMSTFt3n7/KJe2wea9W97QX9VEsMe3kHjOOyU2UBjFN64ZC','0123456792',0,NULL,NULL,'2020-04-19 22:02:22','2020-04-19 22:02:22'),(8,'tbee7','tbee7@abc.xyz','$2y$10$70wvbUguDJJ6emGZWZVsWOo9BjKSfnntTNQrfIzlbHFepkDmb.DBy','0987654332',0,NULL,NULL,'2020-05-09 15:55:58','2020-05-09 15:55:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-25 17:44:06
