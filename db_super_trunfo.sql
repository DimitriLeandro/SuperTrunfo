-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: db_super_trunfo
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `tb_carta`
--

DROP TABLE IF EXISTS `tb_carta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_carta` (
  `cd_carta` int(11) NOT NULL AUTO_INCREMENT,
  `ic_tipo` varchar(20) DEFAULT NULL,
  `nm_carta` varchar(30) DEFAULT NULL,
  `vl_att_a` decimal(10,0) DEFAULT NULL,
  `vl_att_b` decimal(10,0) DEFAULT NULL,
  `vl_att_c` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`cd_carta`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_carta`
--

LOCK TABLES `tb_carta` WRITE;
/*!40000 ALTER TABLE `tb_carta` DISABLE KEYS */;
INSERT INTO `tb_carta` VALUES (1,'tubarao','Tubarão Branco',7,2500,40),(2,'tubarao','Tubarão Martelo',5,410,25),(3,'tubarao','Tubarão Limão',7,980,30),(4,'tubarao','Tubarão Baleia',12,4800,12),(5,'tubarao','Tubarão-Cabeça-Chata',3,700,45),(6,'tubarao','Tubarão Tigre',4,360,36),(7,'tubarao','Tubarão Fantasma',3,275,18),(8,'tubarao','Tubarão Duende',4,250,15),(9,'tubarao','Tubarão Lixa',3,180,20),(10,'tubarao','Tubarão Azul',7,1300,27),(11,'carro','BMW i8',250,255,490300),(12,'carro','Audi A6',210,183,120550),(13,'carro','Citroen C4',190,202,60400),(14,'carro','Hyundai Veloster',450,103,210600),(15,'carro','Chevrolet Camaro',275,171,650500),(16,'carro','Ferrari Red',310,287,950500),(17,'carro','Porsche Carrera',300,143,995000),(18,'carro','Alfa Romeo 500',210,109,125000),(19,'carro','Chevrolet Onix',230,214,80300),(20,'carro','Gol 1000',170,296,7500);
/*!40000 ALTER TABLE `tb_carta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jogador`
--

DROP TABLE IF EXISTS `tb_jogador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_jogador` (
  `cd_jogador` int(11) NOT NULL AUTO_INCREMENT,
  `cd_jogo` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_jogador`),
  KEY `fk_jogador_jogo` (`cd_jogo`),
  CONSTRAINT `fk_jogador_jogo` FOREIGN KEY (`cd_jogo`) REFERENCES `tb_jogo` (`cd_jogo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jogador`
--

LOCK TABLES `tb_jogador` WRITE;
/*!40000 ALTER TABLE `tb_jogador` DISABLE KEYS */;
INSERT INTO `tb_jogador` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `tb_jogador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jogador_carta`
--

DROP TABLE IF EXISTS `tb_jogador_carta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_jogador_carta` (
  `cd_jogador` int(11) DEFAULT NULL,
  `cd_carta` int(11) DEFAULT NULL,
  KEY `fk_jogador_carta_jogador` (`cd_jogador`),
  KEY `fk_jogador_carta_carta` (`cd_carta`),
  CONSTRAINT `fk_jogador_carta_carta` FOREIGN KEY (`cd_carta`) REFERENCES `tb_carta` (`cd_carta`),
  CONSTRAINT `fk_jogador_carta_jogador` FOREIGN KEY (`cd_jogador`) REFERENCES `tb_jogador` (`cd_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jogador_carta`
--

LOCK TABLES `tb_jogador_carta` WRITE;
/*!40000 ALTER TABLE `tb_jogador_carta` DISABLE KEYS */;
INSERT INTO `tb_jogador_carta` VALUES (1,9),(1,8),(1,10),(1,7),(1,2),(2,5),(2,4),(2,6),(2,1),(2,3);
/*!40000 ALTER TABLE `tb_jogador_carta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jogo`
--

DROP TABLE IF EXISTS `tb_jogo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_jogo` (
  `cd_jogo` int(11) NOT NULL AUTO_INCREMENT,
  `ic_vez` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_jogo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jogo`
--

LOCK TABLES `tb_jogo` WRITE;
/*!40000 ALTER TABLE `tb_jogo` DISABLE KEYS */;
INSERT INTO `tb_jogo` VALUES (1,1);
/*!40000 ALTER TABLE `tb_jogo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'db_super_trunfo'
--

--
-- Dumping routines for database 'db_super_trunfo'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-04 23:21:25
