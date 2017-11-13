-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: siskitnet
-- ------------------------------------------------------
-- Server version	5.7.13-log

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
-- Table structure for table `tb_acesso`
--

DROP TABLE IF EXISTS `tb_acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `user_agent` varchar(45) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_INT_USUARIO_idx` (`id_usuario`),
  CONSTRAINT `FK_INT_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_acesso`
--

LOCK TABLES `tb_acesso` WRITE;
/*!40000 ALTER TABLE `tb_acesso` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categoria`
--

DROP TABLE IF EXISTS `tb_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria`
--

LOCK TABLES `tb_categoria` WRITE;
/*!40000 ALTER TABLE `tb_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_contrato`
--

DROP TABLE IF EXISTS `tb_contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_contrato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_locatario` int(11) NOT NULL,
  `id_contrato` int(11) DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `id_locador` int(11) DEFAULT NULL,
  `valor` decimal(9,2) NOT NULL,
  `primeiro_vencimento` date NOT NULL,
  `dia_vencimento` int(11) DEFAULT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `prazo` int(11) NOT NULL,
  `chave` varchar(32) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_TB_ALUGUEL_TB_LOCATARIO1_idx` (`id_locatario`),
  KEY `fk_TB_ALUGUEL_TB_STATUS1_idx` (`id_status`),
  KEY `fk_quarto` (`id_imovel`),
  KEY `fk_contrato_idx` (`id_contrato`),
  KEY `fk_locador_idx` (`id_locador`),
  CONSTRAINT `fk_TB_ALUGUEL_TB_LOCATARIO1` FOREIGN KEY (`id_locatario`) REFERENCES `tb_locatario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_ALUGUEL_TB_STATUS1` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_locador` FOREIGN KEY (`id_locador`) REFERENCES `tb_locador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quarto` FOREIGN KEY (`id_imovel`) REFERENCES `tb_imovel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_contrato`
--

LOCK TABLES `tb_contrato` WRITE;
/*!40000 ALTER TABLE `tb_contrato` DISABLE KEYS */;
INSERT INTO `tb_contrato` VALUES (1,6,NULL,4,1,1,420.00,'2017-11-08',12,'2017-11-08','2018-04-08',6,NULL,NULL);
/*!40000 ALTER TABLE `tb_contrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_despesa`
--

DROP TABLE IF EXISTS `tb_despesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_despesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mes` int(11) NOT NULL,
  `id_tipo_despesa` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `descricao` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_despesa_tb_mes1_idx` (`id_mes`),
  KEY `fk_tb_despesa_tb_categoria1_idx` (`id_tipo_despesa`),
  CONSTRAINT `fk_tipo_despesa` FOREIGN KEY (`id_tipo_despesa`) REFERENCES `tb_tipo_despesa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_despesa`
--

LOCK TABLES `tb_despesa` WRITE;
/*!40000 ALTER TABLE `tb_despesa` DISABLE KEYS */;
INSERT INTO `tb_despesa` VALUES (12,11,2,'2017-11-02','teste',650.00,2017),(13,6,1,'2017-06-14','teste2',350.00,2017);
/*!40000 ALTER TABLE `tb_despesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estado_civil`
--

DROP TABLE IF EXISTS `tb_estado_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_estado_civil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estado_civil`
--

LOCK TABLES `tb_estado_civil` WRITE;
/*!40000 ALTER TABLE `tb_estado_civil` DISABLE KEYS */;
INSERT INTO `tb_estado_civil` VALUES (1,'Solteiro'),(2,'Casado'),(3,'Viúvo'),(4,'Separado');
/*!40000 ALTER TABLE `tb_estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_imovel`
--

DROP TABLE IF EXISTS `tb_imovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_imovel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'elemento identificador da tabela.',
  `id_tipo_imovel` int(11) NOT NULL,
  `uc` varchar(8) DEFAULT NULL COMMENT 'unidade de controle do imóvel é o registro na CEMAR para o pagamento de energia.',
  `nome` varchar(45) DEFAULT NULL COMMENT 'nome do imóvel',
  `disponivel` int(11) DEFAULT '0' COMMENT 'verifica se o imóvel está disponível "1" ou não "0".',
  `endereco` varchar(200) DEFAULT NULL COMMENT 'endereço de localização do imóvel',
  `numero` int(11) DEFAULT NULL COMMENT 'número do imóvel.',
  `chave` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tipo_imovel_idx` (`id_tipo_imovel`),
  CONSTRAINT `fk_tipo_imovel` FOREIGN KEY (`id_tipo_imovel`) REFERENCES `tb_tipo_imovel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_imovel`
--

LOCK TABLES `tb_imovel` WRITE;
/*!40000 ALTER TABLE `tb_imovel` DISABLE KEYS */;
INSERT INTO `tb_imovel` VALUES (1,3,'453671','Kitnet 1',0,'avenida',1,NULL),(2,3,'1122334','Kitnet 2',1,'avenida santos',2,NULL),(3,3,NULL,'Kitnet 3',1,'avenida',3,NULL),(4,3,NULL,'Kitnet 4',1,'avenida',4,NULL),(5,3,NULL,'Kitnet 5',1,'avenida',5,NULL),(6,3,NULL,'Kitnet 6',1,'avenida',6,NULL),(7,3,NULL,'Kitnet 7',1,'avenida',7,NULL),(8,3,'23456','Kitnet 8',1,'avenida santos dumont',8,NULL),(9,3,NULL,'Kitnet 9',1,'avenida',9,NULL),(10,3,NULL,'Kitnet 10',1,'avenida',10,NULL),(12,3,'1233123','Kitnet 11',1,'avenida santos dumont',11,NULL),(13,3,'1456271','Kitnet 12',1,'avenida',12,NULL);
/*!40000 ALTER TABLE `tb_imovel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_indenizacao`
--

DROP TABLE IF EXISTS `tb_indenizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_indenizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_locatario` int(11) DEFAULT NULL,
  `id_mes` int(11) DEFAULT NULL,
  `descricao` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `data` date DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `valor` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_int_locatario_idx` (`id_locatario`),
  KEY `fk_int_mes_idx` (`id_mes`),
  CONSTRAINT `fk_int_locatario` FOREIGN KEY (`id_locatario`) REFERENCES `tb_locatario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_int_mes` FOREIGN KEY (`id_mes`) REFERENCES `tb_mes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_indenizacao`
--

LOCK TABLES `tb_indenizacao` WRITE;
/*!40000 ALTER TABLE `tb_indenizacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_indenizacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lancamento`
--

DROP TABLE IF EXISTS `tb_lancamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_lancamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mes` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `valor` decimal(9,2) DEFAULT '0.00',
  `data_vencimento` date DEFAULT NULL,
  `valor_pago` decimal(9,2) DEFAULT '0.00',
  `ano` int(11) DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `chave` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lancamento_mes` (`id_mes`),
  KEY `fk_tb_lancamento_tb_status1_idx` (`id_status`),
  KEY `fk_contrato2_idx` (`id_contrato`),
  CONSTRAINT `fk_contrato2` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamento_mes` FOREIGN KEY (`id_mes`) REFERENCES `tb_mes` (`id`),
  CONSTRAINT `fk_tb_lancamento_tb_status1` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lancamento`
--

LOCK TABLES `tb_lancamento` WRITE;
/*!40000 ALTER TABLE `tb_lancamento` DISABLE KEYS */;
INSERT INTO `tb_lancamento` VALUES (1,11,2,1,420.00,'2017-11-12',420.00,2017,'2017-11-11',NULL),(2,12,1,1,420.00,'2017-12-12',0.00,2017,NULL,NULL),(3,1,1,1,420.00,'2018-01-12',0.00,2017,NULL,NULL),(4,2,1,1,420.00,'2018-02-12',0.00,2017,NULL,NULL),(5,3,1,1,420.00,'2018-03-12',0.00,2017,NULL,NULL),(6,4,1,1,420.00,'2018-04-12',0.00,2017,NULL,NULL);
/*!40000 ALTER TABLE `tb_lancamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_locador`
--

DROP TABLE IF EXISTS `tb_locador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_locador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(300) DEFAULT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `cep` varchar(11) DEFAULT NULL,
  `endereco` varchar(300) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_locador`
--

LOCK TABLES `tb_locador` WRITE;
/*!40000 ALTER TABLE `tb_locador` DISABLE KEYS */;
INSERT INTO `tb_locador` VALUES (1,'Luiz Claudio Santos','46752528349','65046660','Avenida Santos Dumont ','1','Anil','residencial canaã','São Luis');
/*!40000 ALTER TABLE `tb_locador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_locatario`
--

DROP TABLE IF EXISTS `tb_locatario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_locatario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado_civil` int(11) NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(30) DEFAULT NULL,
  `endereco` varchar(250) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `orgao_expedidor` varchar(10) DEFAULT NULL,
  `uf_expedidor` varchar(5) DEFAULT NULL,
  `profissao` varchar(45) DEFAULT NULL,
  `naturalidade` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `disponivel` int(11) DEFAULT '1',
  `chave` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_TB_LOCATARIO_TB_ESTADOCIVIL1_idx` (`id_estado_civil`),
  CONSTRAINT `fk_TB_LOCATARIO_TB_ESTADOCIVIL1` FOREIGN KEY (`id_estado_civil`) REFERENCES `tb_estado_civil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_locatario`
--

LOCK TABLES `tb_locatario` WRITE;
/*!40000 ALTER TABLE `tb_locatario` DISABLE KEYS */;
INSERT INTO `tb_locatario` VALUES (6,3,'Claudio Pablo Silva Santos','04172473385','123123','Avenida Santos Dumont, 01, residencial canaã','1990-07-12','1212','MA','Analista de Sistemas','São Luis','asdasd','65046660','98988197084','cc@gmail.com',1,NULL),(7,1,'Braulio Roberto Silva Santosssss','04172473385','9192030102','Avenida Santos Dumont, 01, residencial canaã','1993-11-09','ssp','ma','advogado','São Luis','anil','65046660','98988197084','pppp@gmail.com',1,NULL),(8,3,'PPP','123123123123','12312312312','Avenida Santos Dumont, 01, residencial canaã','1996-03-04','SSP','MA','asdasdasd','São Luis','asdsads','65046660','98988197084','cc5@gail.com',1,NULL),(9,1,'sssssssqqqqq','0417247385','193912391923','Avenida Santos Dumont, 01, residencial canaã','1994-02-14','MA','pa','sssssss','São Luis','sssss','65046660','98988197084','cs3@hotmail.com',1,NULL),(10,1,'ooaosodoodoasod','04172473385','9120300213','Avenida Santos Dumont, 01, residencial canaã','2008-12-12','MA','MA','aaaaa','São Luis','aasdad','65046660','98988197084','claudiopablosilva@hotmail.com',1,NULL),(11,1,'saxxxxxxxxxxxxxxxxxxxxx','04172473385','123123123','Avenida Santos Dumont, 01, residencial canaã','1990-01-12','SSP','MA','ssssssss','São Luis','sssss','65046660','98988197084','c2@gmail.com',1,NULL),(12,1,'xxxxxxxxxxxxxxxx','46752528349','08182839','Avenida Santos Dumont, 01, residencial canaã','1998-05-14','SSP','PI','osoaosdooasdo','São Luis','99llasdlasldasd','65046660','98988197084','mariass@gmail.com',1,NULL),(13,1,'jasjdiasdiaisdiasiiasdzzzz','04172473385','123123132','Avenida Santos Dumont, 01, residencial canaã','2000-02-12','SSP','PR','aveniasdass','São Luis','anil','65046660','679129391293','ccc@gmail.com',1,NULL);
/*!40000 ALTER TABLE `tb_locatario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_log`
--

DROP TABLE IF EXISTS `tb_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_log`
--

LOCK TABLES `tb_log` WRITE;
/*!40000 ALTER TABLE `tb_log` DISABLE KEYS */;
INSERT INTO `tb_log` VALUES (1,'asdasd','2017-09-09 12:39:35'),(2,'asdasd','2017-09-09 12:39:43'),(3,'Unknown column \'estadoCivil\' in \'field list\'','2017-09-09 13:34:04'),(4,'Unknown column \'estado_civil\' in \'field list\'','2017-09-09 13:39:53'),(5,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:49:37'),(6,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:50:30'),(7,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:52:12'),(8,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:57:44'),(9,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:31:44'),(10,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:32:22'),(11,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:33:52'),(12,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:42:00'),(13,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:43:13'),(14,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:43:28'),(15,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:46:43'),(16,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:47:04'),(17,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:07'),(18,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:30'),(19,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:53'),(20,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:05:38'),(21,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:06:15'),(22,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:07:09'),(23,'','2017-09-14 22:49:00'),(24,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:20:54'),(25,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:21:10'),(26,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:22:51'),(27,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:26:30'),(28,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:53:49'),(29,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:57:04'),(30,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:57:50'),(31,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:59:59'),(32,'Unknown column \'Array\' in \'field list\'','2017-09-20 21:00:41'),(33,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:18:58'),(34,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:22:23'),(35,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:22:52'),(36,'Unknown column \'Array\' in \'field list\'','2017-09-21 20:38:16'),(37,'Unknown column \'Array\' in \'field list\'','2017-09-21 20:39:53'),(38,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:19:11'),(39,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:21:59'),(40,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:28:23'),(41,'','2017-09-21 21:45:02'),(42,'','2017-09-21 21:55:00'),(43,'','2017-09-21 22:00:00'),(44,'','2017-09-21 22:00:11'),(45,'','2017-09-21 22:11:12'),(46,'','2017-09-26 21:18:05'),(47,'','2017-09-26 21:18:21'),(48,'','2017-09-26 21:18:29'),(49,'','2017-09-26 21:19:49'),(50,'','2017-09-26 21:20:23'),(51,'','2017-09-26 21:24:27'),(52,'','2017-09-26 22:01:28'),(53,'','2017-09-26 22:03:12'),(54,'','2017-09-26 22:06:33'),(55,'','2017-09-26 22:06:44'),(56,'','2017-09-26 22:07:21'),(57,'','2017-09-26 22:07:47'),(58,'','2017-09-26 22:13:45'),(59,'','2017-09-27 20:04:32'),(60,'','2017-09-27 20:33:05'),(61,'','2017-09-27 20:33:16'),(62,'','2017-09-27 20:34:05'),(63,'','2017-09-27 20:38:51'),(64,'','2017-09-27 20:39:21'),(65,'','2017-09-27 20:50:52'),(66,'Unknown column \'Array\' in \'field list\'','2017-09-28 20:48:49'),(67,'','2017-09-28 21:50:13'),(68,'','2017-09-30 18:09:21'),(69,'','2017-10-07 14:53:15'),(70,'','2017-10-07 14:53:45'),(71,'','2017-10-07 14:54:06'),(72,'','2017-10-07 14:54:07'),(73,'','2017-10-07 14:56:58'),(74,'','2017-10-07 14:58:40'),(75,'','2017-10-07 14:59:15'),(76,'','2017-10-07 15:00:29'),(77,'','2017-10-12 15:44:45'),(78,'','2017-10-12 15:47:18'),(79,'','2017-10-12 15:48:39'),(80,'','2017-10-12 15:48:42'),(81,'','2017-10-12 15:48:43'),(82,'','2017-10-12 15:49:03'),(83,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_lancamento`, CONSTRAINT `fk_contrato2` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-10-12 15:49:55'),(84,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_lancamento`, CONSTRAINT `fk_contrato2` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-10-12 15:49:58'),(85,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_lancamento`, CONSTRAINT `fk_contrato2` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-10-12 15:49:59'),(86,'','2017-10-12 15:53:19'),(87,'','2017-10-12 15:55:30'),(88,'','2017-10-12 15:57:23'),(89,'','2017-10-12 16:07:44'),(90,'','2017-10-12 16:12:48'),(91,'','2017-10-21 13:54:27'),(92,'','2017-10-21 14:01:39'),(93,'','2017-10-21 14:04:59'),(94,'','2017-10-26 20:03:46'),(95,'','2017-10-26 20:16:26'),(96,'','2017-10-26 20:17:09'),(97,'','2017-10-26 20:18:02'),(98,'','2017-10-26 20:23:17'),(99,'','2017-10-26 20:26:52'),(100,'','2017-10-26 20:31:12'),(101,'','2017-10-26 20:31:37'),(102,'','2017-10-26 20:33:36'),(103,'','2017-10-26 20:36:48'),(104,'','2017-10-26 20:38:06'),(105,'','2017-10-28 11:01:13'),(106,'','2017-10-28 11:18:16'),(107,'','2017-10-28 11:19:10'),(108,'','2017-10-28 11:19:43'),(109,'Unknown column \'locatario\' in \'field list\'','2017-10-28 11:21:07'),(110,'Unknown column \'locatario\' in \'field list\'','2017-10-28 12:04:05'),(111,'Unknown column \'locatario\' in \'field list\'','2017-10-28 12:18:38'),(112,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_contrato`, CONSTRAINT `fk_TB_ALUGUEL_TB_LOCATARIO1` FOREIGN KEY (`id_locatario`) REFERENCES `tb_locatario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-10-28 12:19:16'),(113,'','2017-10-28 12:42:29'),(114,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_imovel`, CONSTRAINT `fk_tipo_imovel` FOREIGN KEY (`id_tipo_imovel`) REFERENCES `tb_tipo_imovel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-11-02 10:49:03'),(115,'Unknown column \'tipo_imovel\' in \'field list\'','2017-11-02 11:12:36'),(116,'','2017-11-02 14:31:49'),(117,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_imovel`, CONSTRAINT `fk_tipo_imovel` FOREIGN KEY (`id_tipo_imovel`) REFERENCES `tb_tipo_imovel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-11-02 14:31:55'),(118,'','2017-11-11 14:50:30'),(119,'','2017-11-11 14:58:02'),(120,'','2017-11-11 14:59:39'),(121,'','2017-11-11 15:07:45');
/*!40000 ALTER TABLE `tb_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_mes`
--

DROP TABLE IF EXISTS `tb_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mes`
--

LOCK TABLES `tb_mes` WRITE;
/*!40000 ALTER TABLE `tb_mes` DISABLE KEYS */;
INSERT INTO `tb_mes` VALUES (1,'Janeiro'),(2,'Fevereiro'),(3,'Março'),(4,'Abril'),(5,'Maio'),(6,'Junho'),(7,'Julho'),(8,'Agosto'),(9,'Setembro'),(10,'Outubro'),(11,'Novembro'),(12,'Dezembro');
/*!40000 ALTER TABLE `tb_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pagamento`
--

DROP TABLE IF EXISTS `tb_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contrato` int(11) NOT NULL,
  `id_mes` int(11) DEFAULT NULL,
  `recibo` varchar(30) NOT NULL,
  `data_pagamento` date DEFAULT NULL,
  `valor_total` decimal(9,2) DEFAULT NULL,
  `desconto` decimal(9,2) DEFAULT '0.00',
  `valor_base` decimal(9,2) DEFAULT NULL,
  `periodo_inicial` date DEFAULT NULL,
  `periodo_final` date DEFAULT NULL,
  `chave` varchar(32) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mes` (`id_mes`),
  KEY `fk_contrato1_idx` (`id_contrato`),
  CONSTRAINT `fk_contrato1` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mes` FOREIGN KEY (`id_mes`) REFERENCES `tb_mes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pagamento`
--

LOCK TABLES `tb_pagamento` WRITE;
/*!40000 ALTER TABLE `tb_pagamento` DISABLE KEYS */;
INSERT INTO `tb_pagamento` VALUES (1,1,11,'1102008','2017-11-11',420.00,0.00,420.00,'2017-11-12','2017-12-12',NULL,2017);
/*!40000 ALTER TABLE `tb_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_perfil`
--

DROP TABLE IF EXISTS `tb_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_perfil`
--

LOCK TABLES `tb_perfil` WRITE;
/*!40000 ALTER TABLE `tb_perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_renovacao_contrato`
--

DROP TABLE IF EXISTS `tb_renovacao_contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_renovacao_contrato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contrato` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `prazo` int(11) NOT NULL,
  `primeiro_vencimento` date NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `chave` varchar(32) NOT NULL,
  `numero` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_INT_ALUGUEL_idx` (`id_contrato`),
  KEY `FK_INT_STATUS_idx` (`id_status`),
  KEY `FK_INT_QUARTO_idx` (`id_imovel`),
  CONSTRAINT `FK_INT_ALUGUEL` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_INT_QUARTO` FOREIGN KEY (`id_imovel`) REFERENCES `tb_imovel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_INT_STATUS` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_renovacao_contrato`
--

LOCK TABLES `tb_renovacao_contrato` WRITE;
/*!40000 ALTER TABLE `tb_renovacao_contrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_renovacao_contrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_status`
--

DROP TABLE IF EXISTS `tb_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_status` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tipo_status_idx` (`id_tipo_status`),
  CONSTRAINT `fk_tipo_status` FOREIGN KEY (`id_tipo_status`) REFERENCES `tb_tipo_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_status`
--

LOCK TABLES `tb_status` WRITE;
/*!40000 ALTER TABLE `tb_status` DISABLE KEYS */;
INSERT INTO `tb_status` VALUES (1,2,'Em Aberto'),(2,2,'Atrasado'),(3,2,'Pago'),(4,1,'Vigente'),(5,1,'Cancelado'),(6,1,'Cumprido'),(7,1,'Vencido');
/*!40000 ALTER TABLE `tb_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipo_despesa`
--

DROP TABLE IF EXISTS `tb_tipo_despesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tipo_despesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_despesa`
--

LOCK TABLES `tb_tipo_despesa` WRITE;
/*!40000 ALTER TABLE `tb_tipo_despesa` DISABLE KEYS */;
INSERT INTO `tb_tipo_despesa` VALUES (1,'Materiais'),(2,'Serviços');
/*!40000 ALTER TABLE `tb_tipo_despesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipo_imovel`
--

DROP TABLE IF EXISTS `tb_tipo_imovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tipo_imovel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_imovel`
--

LOCK TABLES `tb_tipo_imovel` WRITE;
/*!40000 ALTER TABLE `tb_tipo_imovel` DISABLE KEYS */;
INSERT INTO `tb_tipo_imovel` VALUES (1,'Casa'),(2,'Apartamento'),(3,'Kitnet');
/*!40000 ALTER TABLE `tb_tipo_imovel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipo_status`
--

DROP TABLE IF EXISTS `tb_tipo_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tipo_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_status`
--

LOCK TABLES `tb_tipo_status` WRITE;
/*!40000 ALTER TABLE `tb_tipo_status` DISABLE KEYS */;
INSERT INTO `tb_tipo_status` VALUES (1,'Contrato'),(2,'Lançamento');
/*!40000 ALTER TABLE `tb_tipo_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `login` varchar(15) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `ativo` int(11) DEFAULT '1',
  `chave` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfil` (`id_perfil`),
  CONSTRAINT `fk_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `tb_perfil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuario`
--

LOCK TABLES `tb_usuario` WRITE;
/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'siskitnet'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-12 22:34:01
