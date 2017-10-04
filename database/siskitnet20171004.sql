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
  `valor` decimal(9,2) NOT NULL,
  `primeiro_vencimento` date NOT NULL,
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
  CONSTRAINT `fk_TB_ALUGUEL_TB_LOCATARIO1` FOREIGN KEY (`id_locatario`) REFERENCES `tb_locatario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_ALUGUEL_TB_STATUS1` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quarto` FOREIGN KEY (`id_imovel`) REFERENCES `tb_imovel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_contrato`
--

LOCK TABLES `tb_contrato` WRITE;
/*!40000 ALTER TABLE `tb_contrato` DISABLE KEYS */;
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
  `id_categoria` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `descricao` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_despesa_tb_mes1_idx` (`id_mes`),
  KEY `fk_tb_despesa_tb_categoria1_idx` (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_despesa`
--

LOCK TABLES `tb_despesa` WRITE;
/*!40000 ALTER TABLE `tb_despesa` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_imovel`
--

LOCK TABLES `tb_imovel` WRITE;
/*!40000 ALTER TABLE `tb_imovel` DISABLE KEYS */;
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
  `id_contrato` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lancamento`
--

LOCK TABLES `tb_lancamento` WRITE;
/*!40000 ALTER TABLE `tb_lancamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_lancamento` ENABLE KEYS */;
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
  `cpf` varchar(15) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_locatario`
--

LOCK TABLES `tb_locatario` WRITE;
/*!40000 ALTER TABLE `tb_locatario` DISABLE KEYS */;
INSERT INTO `tb_locatario` VALUES (6,3,'Claudio Pablo Silva Santos','04172473385','123123','Avenida Santos Dumont, 01, residencial canaã','1990-07-12','1212','MA','Analista de Sistemas','São Luis','asdasd','65046660','98988197084','cc@gmail.com',1,NULL),(7,1,'Braulio Roberto Silva Santosssss','04172473385','9192030102','Avenida Santos Dumont, 01, residencial canaã','1993-11-09','ssp','ma','advogado','São Luis','anil','65046660','98988197084','pppp@gmail.com',1,NULL),(8,3,'PPP','123123123123','12312312312','Avenida Santos Dumont, 01, residencial canaã','1996-03-04','SSP','MA','asdasdasd','São Luis','asdsads','65046660','98988197084','cc5@gail.com',1,NULL),(9,1,'sssssssqqqqq','0417247385','193912391923','Avenida Santos Dumont, 01, residencial canaã','1994-02-14','MA','pa','sssssss','São Luis','sssss','65046660','98988197084','cs3@hotmail.com',1,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_log`
--

LOCK TABLES `tb_log` WRITE;
/*!40000 ALTER TABLE `tb_log` DISABLE KEYS */;
INSERT INTO `tb_log` VALUES (1,'asdasd','2017-09-09 12:39:35'),(2,'asdasd','2017-09-09 12:39:43'),(3,'Unknown column \'estadoCivil\' in \'field list\'','2017-09-09 13:34:04'),(4,'Unknown column \'estado_civil\' in \'field list\'','2017-09-09 13:39:53'),(5,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:49:37'),(6,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:50:30'),(7,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:52:12'),(8,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:57:44'),(9,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:31:44'),(10,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:32:22'),(11,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:33:52'),(12,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:42:00'),(13,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:43:13'),(14,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:43:28'),(15,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:46:43'),(16,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:47:04'),(17,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:07'),(18,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:30'),(19,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:53'),(20,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:05:38'),(21,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:06:15'),(22,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:07:09'),(23,'','2017-09-14 22:49:00'),(24,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:20:54'),(25,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:21:10'),(26,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:22:51'),(27,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:26:30'),(28,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:53:49'),(29,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:57:04'),(30,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:57:50'),(31,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:59:59'),(32,'Unknown column \'Array\' in \'field list\'','2017-09-20 21:00:41'),(33,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:18:58'),(34,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:22:23'),(35,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:22:52'),(36,'Unknown column \'Array\' in \'field list\'','2017-09-21 20:38:16'),(37,'Unknown column \'Array\' in \'field list\'','2017-09-21 20:39:53'),(38,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:19:11'),(39,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:21:59'),(40,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:28:23'),(41,'','2017-09-21 21:45:02'),(42,'','2017-09-21 21:55:00'),(43,'','2017-09-21 22:00:00'),(44,'','2017-09-21 22:00:11'),(45,'','2017-09-21 22:11:12'),(46,'','2017-09-26 21:18:05'),(47,'','2017-09-26 21:18:21'),(48,'','2017-09-26 21:18:29'),(49,'','2017-09-26 21:19:49'),(50,'','2017-09-26 21:20:23'),(51,'','2017-09-26 21:24:27'),(52,'','2017-09-26 22:01:28'),(53,'','2017-09-26 22:03:12'),(54,'','2017-09-26 22:06:33'),(55,'','2017-09-26 22:06:44'),(56,'','2017-09-26 22:07:21'),(57,'','2017-09-26 22:07:47'),(58,'','2017-09-26 22:13:45'),(59,'','2017-09-27 20:04:32'),(60,'','2017-09-27 20:33:05'),(61,'','2017-09-27 20:33:16'),(62,'','2017-09-27 20:34:05'),(63,'','2017-09-27 20:38:51'),(64,'','2017-09-27 20:39:21'),(65,'','2017-09-27 20:50:52'),(66,'Unknown column \'Array\' in \'field list\'','2017-09-28 20:48:49'),(67,'','2017-09-28 21:50:13'),(68,'','2017-09-30 18:09:21');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mes`
--

LOCK TABLES `tb_mes` WRITE;
/*!40000 ALTER TABLE `tb_mes` DISABLE KEYS */;
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
  `valor_pago` decimal(9,2) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `chave` varchar(32) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mes` (`id_mes`),
  KEY `fk_contrato1_idx` (`id_contrato`),
  CONSTRAINT `fk_contrato1` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mes` FOREIGN KEY (`id_mes`) REFERENCES `tb_mes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pagamento`
--

LOCK TABLES `tb_pagamento` WRITE;
/*!40000 ALTER TABLE `tb_pagamento` DISABLE KEYS */;
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
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_status`
--

LOCK TABLES `tb_status` WRITE;
/*!40000 ALTER TABLE `tb_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_status` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_imovel`
--

LOCK TABLES `tb_tipo_imovel` WRITE;
/*!40000 ALTER TABLE `tb_tipo_imovel` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_tipo_imovel` ENABLE KEYS */;
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

-- Dump completed on 2017-10-04  8:33:20
