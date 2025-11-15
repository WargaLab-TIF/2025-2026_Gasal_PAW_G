CREATE DATABASE  IF NOT EXISTS `store` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `store`;
-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: store
-- ------------------------------------------------------
-- Server version	8.0.43

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
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `supplier_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id_idx` (`supplier_id`),
  CONSTRAINT `supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES (1,'1','Meja',25000,10,1),(2,'2','Kursi',15000,20,2),(3,'3','Lemari',50000,5,3),(4,'4','Rak Buku',30000,8,4),(5,'5','Papan Tulis',20000,12,5),(6,'6','Kipas Angin',45000,6,6),(7,'7','Lampu',10000,25,7),(8,'8','Karpet',35000,7,8),(9,'9','Jam Dinding',18000,9,9),(10,'10','Gorden',22000,11,10);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelanggan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggan`
--

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` VALUES (1,'budi','L','123456789123','JL. lorem ipsum'),(2,'Rino','L','123456789123','Jl. Lorem Ipsum No. 1'),(3,'Siti','P','987654321987','Jl. Mawar Indah No. 2'),(4,'Andi','L','081234567890','Jl. Melati Putih No. 3'),(5,'Rina','P','082345678901','Jl. Anggrek Ungu No. 4'),(6,'Tono','L','083456789012','Jl. Cempaka Kuning No. 5'),(7,'Dewi','P','084567890123','Jl. Dahlia Merah No. 6'),(8,'Rudi','L','085678901234','Jl. Kenanga Biru No. 7'),(9,'Fitri','P','086789012345','Jl. Flamboyan Hijau No. 8'),(10,'Hadi','L','087890123456','Jl. Teratai Putih No. 9');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembayaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_id_idx` (`transaksi_id`),
  CONSTRAINT `transaksi_ids` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES (1,'2025-10-05 11:11:10',10,'TUNAI',1),(2,'2025-10-05 12:05:20',25,'EDC',2),(3,'2025-10-06 09:45:00',50,'TRANSFER',3),(4,'2025-10-06 14:30:40',15,'TUNAI',4),(5,'2025-10-07 08:15:25',30,'EDC',5),(6,'2025-10-07 16:10:00',40,'TRANSFER',6),(7,'2025-10-08 10:00:30',20,'TUNAI',7),(8,'2025-10-08 18:45:15',35,'EDC',8),(9,'2025-10-09 13:25:50',60,'TRANSFER',9),(10,'2025-10-09 19:05:00',45,'TUNAI',10);
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'Rini','123456789012','JL. Melati 1 No. 3'),(2,'Bambang','081234567890','Jl. Mawar No. 21'),(3,'Siti','082134567891','Jl. Kenanga No. 5'),(4,'Dewi','083134567892','Jl. Anggrek No. 8'),(5,'Tono','084134567893','Jl. Dahlia No. 15'),(6,'Rika','085134567894','Jl. Kamboja No. 11'),(7,'Agus','086134567895','Jl. Flamboyan No. 9'),(8,'Wati','087134567896','Jl. Cempaka No. 4'),(9,'Rudi','088134567897','Jl. Teratai No. 12'),(10,'Box Box Box','089134567898','Jl. Bougenville No. 89 1 23423');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text,
  `total` int DEFAULT NULL,
  `pelanggan_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pelanggan_id_idx` (`pelanggan_id`),
  CONSTRAINT `pelanggan_id` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (1,'2025-10-10','Bangku',50,1),(2,'2025-10-11','Meja',120,2),(3,'2025-10-12','Lemari',300,3),(4,'2025-10-13','Kursi',75,4),(5,'2025-10-14','Kasur',500,5),(6,'2025-10-15','Sofa',450,6),(7,'2025-10-16','Rak Buku',200,7),(8,'2025-10-17','Karpet',150,8),(9,'2025-10-18','Lampu',80,9),(10,'2025-10-19','Cermin',100,10);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi_detail`
--

DROP TABLE IF EXISTS `transaksi_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`,`barang_id`),
  KEY `barang_id_idx` (`barang_id`),
  CONSTRAINT `barang_id` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  CONSTRAINT `transaksi_id` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_detail`
--

LOCK TABLES `transaksi_detail` WRITE;
/*!40000 ALTER TABLE `transaksi_detail` DISABLE KEYS */;
INSERT INTO `transaksi_detail` VALUES (1,1,25000,2),(2,2,15000,4),(3,3,50000,1),(4,4,30000,3),(5,5,20000,2),(6,6,45000,1),(7,7,10000,5),(8,8,35000,2),(9,9,18000,4),(10,10,22000,3);
/*!40000 ALTER TABLE `transaksi_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id_user` tinyint NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'adrian','ardsfs','Adriano','Jl. Box Box Box','123456789012',1),(2,'budi','bud123','Budi Santoso','Jl. Melati No.10','081234567890',2),(3,'citra','cit456','Citra Dewi','Jl. Mawar Indah No.5','082345678901',2),(4,'dian','dia789','Dian Saputra','Jl. Kenanga Barat No.3','083456789012',1),(5,'eko','eko321','Eko Prasetyo','Jl. Merpati Timur No.7','084567890123',2),(6,'farah','far654','Farah Anisa','Jl. Anggrek No.9','085678901234',1),(7,'gina','gin987','Gina Lestari','Jl. Teratai Selatan No.4','086789012345',2),(8,'hari','har147','Hari Nugroho','Jl. Cemara Utara No.12','087890123456',1),(9,'intan','int258','Intan Permata','Jl. Sakura Raya No.8','088901234567',2),(10,'joko','jok369','Joko Susilo','Jl. Dahlia Tengah No.11','089012345678',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-31 13:12:04
