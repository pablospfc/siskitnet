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
  `renovou` int(11) DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_contrato`
--

LOCK TABLES `tb_contrato` WRITE;
/*!40000 ALTER TABLE `tb_contrato` DISABLE KEYS */;
INSERT INTO `tb_contrato` VALUES (1,6,NULL,4,1,1,420.00,'2017-11-08',13,'2017-11-08','2018-04-08',6,'08d52742b4ab8ec170e3465972cd952f',NULL,0),(2,7,NULL,7,2,1,500.00,'2017-03-17',17,'2017-03-17','2017-08-17',6,'08d52742b4ab8ec170e3465972cd952f',NULL,1),(27,7,2,7,2,NULL,600.00,'2017-11-28',28,'2017-11-28','2018-04-28',6,'08d52742b4ab8ec170e3465972cd952f',NULL,1),(28,7,27,4,2,NULL,400.00,'2018-10-01',1,'2018-10-01','2019-03-01',6,'08d52742b4ab8ec170e3465972cd952f',NULL,0),(29,13,NULL,7,13,NULL,450.00,'2017-01-26',26,'2017-01-26','2017-06-26',6,'08d52742b4ab8ec170e3465972cd952f',NULL,0),(30,13,NULL,4,9,NULL,500.00,'2017-12-23',23,'2017-12-23','2018-05-23',6,'08d52742b4ab8ec170e3465972cd952f',NULL,0),(31,8,NULL,4,13,NULL,450.00,'2017-12-24',24,'2017-12-24','2018-05-24',6,'08d52742b4ab8ec170e3465972cd952f',NULL,0);
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
  `chave` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
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
INSERT INTO `tb_despesa` VALUES (12,11,2,'2017-11-02','teste',650.00,2017,'08d52742b4ab8ec170e3465972cd952f'),(13,6,1,'2017-06-14','teste2',350.00,2017,'08d52742b4ab8ec170e3465972cd952f');
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
  `cep` varchar(45) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
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
INSERT INTO `tb_imovel` VALUES (1,3,'453671','Kitnet 1',0,'avenida',1,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(2,3,'1122334','Kitnet 2',0,'avenida santos',2,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(3,3,'32342343','Kitnet 3',1,'avenida',3,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(4,3,'11232232','Kitnet 4',1,'avenida',4,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(5,3,'2343344','Kitnet 5',1,'avenida',5,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(6,3,'6756766','Kitnet 6',1,'avenida',6,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(7,3,'1112231','Kitnet 7',1,'avenida',7,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(8,3,'23456','Kitnet 8',1,'avenida santos dumont',8,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(9,3,'6678899','Kitnet 9',0,'avenida',9,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(10,3,'835516','Kitnet 10',1,'avenida',10,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(12,3,'1233123','Kitnet 11',1,'avenida santos dumont',11,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f'),(13,3,'1456271','Kitnet 12',0,'avenida',12,'65046660','residencial canaã','08d52742b4ab8ec170e3465972cd952f');
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
  `chave` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_int_locatario_idx` (`id_locatario`),
  KEY `fk_int_mes_idx` (`id_mes`),
  CONSTRAINT `fk_int_locatario` FOREIGN KEY (`id_locatario`) REFERENCES `tb_locatario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_int_mes` FOREIGN KEY (`id_mes`) REFERENCES `tb_mes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_indenizacao`
--

LOCK TABLES `tb_indenizacao` WRITE;
/*!40000 ALTER TABLE `tb_indenizacao` DISABLE KEYS */;
INSERT INTO `tb_indenizacao` VALUES (1,6,2,'aluguel atrasado','2007-02-02',2007,50.00,'08d52742b4ab8ec170e3465972cd952f'),(2,13,3,'bichaasdasd','2017-03-03',2017,456.00,'08d52742b4ab8ec170e3465972cd952f');
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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lancamento`
--

LOCK TABLES `tb_lancamento` WRITE;
/*!40000 ALTER TABLE `tb_lancamento` DISABLE KEYS */;
INSERT INTO `tb_lancamento` VALUES (1,11,3,1,420.00,'2017-11-12',405.00,2017,'2017-11-11','08d52742b4ab8ec170e3465972cd952f'),(2,12,1,1,420.00,'2017-12-13',NULL,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(3,1,1,1,420.00,'2018-01-13',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(4,2,1,1,420.00,'2018-02-13',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(5,3,1,1,420.00,'2018-03-13',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(6,4,1,1,420.00,'2018-04-13',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(7,3,2,2,500.00,'2017-03-17',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(8,4,2,2,500.00,'2017-04-17',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(9,5,2,2,500.00,'2017-05-17',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(10,6,2,2,500.00,'2017-06-17',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(11,7,2,2,500.00,'2017-07-17',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(12,8,2,2,500.00,'2017-08-17',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(91,11,2,27,600.00,'2017-11-28',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(92,12,1,27,600.00,'2017-12-28',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(93,1,1,27,600.00,'2018-01-28',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(94,2,1,27,600.00,'2018-02-28',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(95,3,1,27,600.00,'2018-03-28',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(96,4,1,27,600.00,'2018-04-28',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(97,10,1,28,400.00,'2018-10-01',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(98,11,1,28,400.00,'2018-11-01',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(99,12,1,28,400.00,'2018-12-01',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(100,1,1,28,400.00,'2019-01-01',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(101,2,1,28,400.00,'2019-02-01',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(102,3,1,28,400.00,'2019-03-01',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(103,1,2,29,450.00,'2017-01-26',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(104,2,2,29,450.00,'2017-02-26',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(105,3,2,29,450.00,'2017-03-26',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(106,4,2,29,450.00,'2017-04-26',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(107,5,2,29,450.00,'2017-05-26',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(108,6,2,29,450.00,'2017-06-26',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(109,12,1,30,500.00,'2017-12-23',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(110,1,1,30,500.00,'2018-01-23',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(111,2,1,30,500.00,'2018-02-23',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(112,3,1,30,500.00,'2018-03-23',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(113,4,1,30,500.00,'2018-04-23',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(114,5,1,30,500.00,'2018-05-23',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(115,12,1,31,450.00,'2017-12-24',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(116,1,1,31,450.00,'2018-01-24',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(117,2,1,31,450.00,'2018-02-24',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(118,3,1,31,450.00,'2018-03-24',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(119,4,1,31,450.00,'2018-04-24',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f'),(120,5,1,31,450.00,'2018-05-24',0.00,2017,NULL,'08d52742b4ab8ec170e3465972cd952f');
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
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_locador`
--

LOCK TABLES `tb_locador` WRITE;
/*!40000 ALTER TABLE `tb_locador` DISABLE KEYS */;
INSERT INTO `tb_locador` VALUES (1,'Luiz Claudio Santos','46752528349','65046660','Avenida Santos Dumont ','1','Anil','residencial canaã','São Luis',NULL);
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
INSERT INTO `tb_locatario` VALUES (6,3,'Claudio Pablo Silva Santos','04172473385','123123','Avenida Santos Dumont, 01, residencial canaã','1990-07-12','1212','MA','Analista de Sistemas','São Luis','asdasd','65046660','98988197084','cc@gmail.com',1,'08d52742b4ab8ec170e3465972cd952f'),(7,1,'Braulio Roberto Silva Santosssss','04172473385','9192030102','Avenida Santos Dumont, 01, residencial canaã','1993-11-09','ssp','ma','advogado','São Luis','anil','65046660','98988197084','pppp@gmail.com',1,'08d52742b4ab8ec170e3465972cd952f'),(8,3,'Antonio José Silva','123123123123','12312312312','Avenida Santos Dumont, 01, residencial canaã','1996-03-04','SSP','MA','asdasdasd','São Luis','asdsads','65046660','98988197084','cc5@gail.com',1,'08d52742b4ab8ec170e3465972cd952f'),(9,1,'sssssssqqqqq','0417247385','193912391923','Avenida Santos Dumont, 01, residencial canaã','1994-02-14','MA','pa','sssssss','São Luis','sssss','65046660','98988197084','cs3@hotmail.com',1,'08d52742b4ab8ec170e3465972cd952f'),(11,1,'Delimar Corrêa','04172473385','123123123','Avenida Santos Dumont, 01, residencial canaã','1990-01-12','SSP','MA','ssssssss','São Luis','sssss','65046660','98988197084','c2@gmail.com',1,'08d52742b4ab8ec170e3465972cd952f'),(12,1,'xxxxxxxxxxxxxxxx','46752528349','08182839','Avenida Santos Dumont, 01, residencial canaã','1998-05-14','SSP','PI','osoaosdooasdo','São Luis','99llasdlasldasd','65046660','98988197084','mariass@gmail.com',1,'08d52742b4ab8ec170e3465972cd952f'),(13,1,'Bruno Eduardo Silva Ferreira','04172473385','123123132','Avenida Santos Dumont, 01, residencial canaã','2000-02-12','SSP','PR','aveniasdass','São Luis','anil','65046660','679129391293','ccc@gmail.com',1,'08d52742b4ab8ec170e3465972cd952f');
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
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_log`
--

LOCK TABLES `tb_log` WRITE;
/*!40000 ALTER TABLE `tb_log` DISABLE KEYS */;
INSERT INTO `tb_log` VALUES (1,'asdasd','2017-09-09 12:39:35'),(2,'asdasd','2017-09-09 12:39:43'),(3,'Unknown column \'estadoCivil\' in \'field list\'','2017-09-09 13:34:04'),(4,'Unknown column \'estado_civil\' in \'field list\'','2017-09-09 13:39:53'),(5,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:49:37'),(6,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:50:30'),(7,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:52:12'),(8,'Unknown column \'Array\' in \'where clause\'','2017-09-10 11:57:44'),(9,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:31:44'),(10,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:32:22'),(11,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:33:52'),(12,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:42:00'),(13,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:43:13'),(14,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:43:28'),(15,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:46:43'),(16,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:47:04'),(17,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:07'),(18,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:30'),(19,'Unknown column \'Array\' in \'where clause\'','2017-09-10 12:53:53'),(20,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:05:38'),(21,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:06:15'),(22,'Unknown column \'Array\' in \'where clause\'','2017-09-10 13:07:09'),(23,'','2017-09-14 22:49:00'),(24,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:20:54'),(25,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:21:10'),(26,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:22:51'),(27,'Unknown column \'Array\' in \'field list\'','2017-09-19 22:26:30'),(28,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:53:49'),(29,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:57:04'),(30,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:57:50'),(31,'Unknown column \'Array\' in \'field list\'','2017-09-20 20:59:59'),(32,'Unknown column \'Array\' in \'field list\'','2017-09-20 21:00:41'),(33,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:18:58'),(34,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:22:23'),(35,'Unknown column \'Array\' in \'field list\'','2017-09-21 19:22:52'),(36,'Unknown column \'Array\' in \'field list\'','2017-09-21 20:38:16'),(37,'Unknown column \'Array\' in \'field list\'','2017-09-21 20:39:53'),(38,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:19:11'),(39,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:21:59'),(40,'Unknown column \'Array\' in \'field list\'','2017-09-21 21:28:23'),(41,'','2017-09-21 21:45:02'),(42,'','2017-09-21 21:55:00'),(43,'','2017-09-21 22:00:00'),(44,'','2017-09-21 22:00:11'),(45,'','2017-09-21 22:11:12'),(46,'','2017-09-26 21:18:05'),(47,'','2017-09-26 21:18:21'),(48,'','2017-09-26 21:18:29'),(49,'','2017-09-26 21:19:49'),(50,'','2017-09-26 21:20:23'),(51,'','2017-09-26 21:24:27'),(52,'','2017-09-26 22:01:28'),(53,'','2017-09-26 22:03:12'),(54,'','2017-09-26 22:06:33'),(55,'','2017-09-26 22:06:44'),(56,'','2017-09-26 22:07:21'),(57,'','2017-09-26 22:07:47'),(58,'','2017-09-26 22:13:45'),(59,'','2017-09-27 20:04:32'),(60,'','2017-09-27 20:33:05'),(61,'','2017-09-27 20:33:16'),(62,'','2017-09-27 20:34:05'),(63,'','2017-09-27 20:38:51'),(64,'','2017-09-27 20:39:21'),(65,'','2017-09-27 20:50:52'),(66,'Unknown column \'Array\' in \'field list\'','2017-09-28 20:48:49'),(67,'','2017-09-28 21:50:13'),(68,'','2017-09-30 18:09:21'),(69,'','2017-10-07 14:53:15'),(70,'','2017-10-07 14:53:45'),(71,'','2017-10-07 14:54:06'),(72,'','2017-10-07 14:54:07'),(73,'','2017-10-07 14:56:58'),(74,'','2017-10-07 14:58:40'),(75,'','2017-10-07 14:59:15'),(76,'','2017-10-07 15:00:29'),(77,'','2017-10-12 15:44:45'),(78,'','2017-10-12 15:47:18'),(79,'','2017-10-12 15:48:39'),(80,'','2017-10-12 15:48:42'),(81,'','2017-10-12 15:48:43'),(82,'','2017-10-12 15:49:03'),(83,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_lancamento`, CONSTRAINT `fk_contrato2` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-10-12 15:49:55'),(84,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_lancamento`, CONSTRAINT `fk_contrato2` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-10-12 15:49:58'),(85,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_lancamento`, CONSTRAINT `fk_contrato2` FOREIGN KEY (`id_contrato`) REFERENCES `tb_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-10-12 15:49:59'),(86,'','2017-10-12 15:53:19'),(87,'','2017-10-12 15:55:30'),(88,'','2017-10-12 15:57:23'),(89,'','2017-10-12 16:07:44'),(90,'','2017-10-12 16:12:48'),(91,'','2017-10-21 13:54:27'),(92,'','2017-10-21 14:01:39'),(93,'','2017-10-21 14:04:59'),(94,'','2017-10-26 20:03:46'),(95,'','2017-10-26 20:16:26'),(96,'','2017-10-26 20:17:09'),(97,'','2017-10-26 20:18:02'),(98,'','2017-10-26 20:23:17'),(99,'','2017-10-26 20:26:52'),(100,'','2017-10-26 20:31:12'),(101,'','2017-10-26 20:31:37'),(102,'','2017-10-26 20:33:36'),(103,'','2017-10-26 20:36:48'),(104,'','2017-10-26 20:38:06'),(105,'','2017-10-28 11:01:13'),(106,'','2017-10-28 11:18:16'),(107,'','2017-10-28 11:19:10'),(108,'','2017-10-28 11:19:43'),(109,'Unknown column \'locatario\' in \'field list\'','2017-10-28 11:21:07'),(110,'Unknown column \'locatario\' in \'field list\'','2017-10-28 12:04:05'),(111,'Unknown column \'locatario\' in \'field list\'','2017-10-28 12:18:38'),(112,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_contrato`, CONSTRAINT `fk_TB_ALUGUEL_TB_LOCATARIO1` FOREIGN KEY (`id_locatario`) REFERENCES `tb_locatario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-10-28 12:19:16'),(113,'','2017-10-28 12:42:29'),(114,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_imovel`, CONSTRAINT `fk_tipo_imovel` FOREIGN KEY (`id_tipo_imovel`) REFERENCES `tb_tipo_imovel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-11-02 10:49:03'),(115,'Unknown column \'tipo_imovel\' in \'field list\'','2017-11-02 11:12:36'),(116,'','2017-11-02 14:31:49'),(117,'Cannot add or update a child row: a foreign key constraint fails (`siskitnet`.`tb_imovel`, CONSTRAINT `fk_tipo_imovel` FOREIGN KEY (`id_tipo_imovel`) REFERENCES `tb_tipo_imovel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)','2017-11-02 14:31:55'),(118,'','2017-11-11 14:50:30'),(119,'','2017-11-11 14:58:02'),(120,'','2017-11-11 14:59:39'),(121,'','2017-11-11 15:07:45'),(122,'','2017-11-13 22:13:26'),(123,'','2017-11-23 19:45:44'),(124,'','2017-11-23 19:46:20'),(125,'','2017-11-23 19:50:21'),(126,'','2017-11-23 20:04:30'),(127,'','2017-11-23 20:05:15'),(128,'','2017-11-23 20:05:39'),(129,'','2017-11-23 20:09:46'),(130,'','2017-11-23 20:19:34'),(131,'','2017-11-23 20:20:00'),(132,'','2017-11-23 20:21:00'),(133,'','2017-11-25 21:28:45'),(134,'','2017-11-25 21:29:39'),(135,'','2017-11-27 20:58:25'),(136,'','2017-11-27 20:59:15'),(137,'','2017-11-27 21:09:31'),(138,'','2017-11-27 21:18:39'),(139,'','2017-11-27 21:21:08'),(140,'','2017-11-27 21:22:20'),(141,'','2017-11-27 21:38:46'),(142,'Unknown column \'confirma_senha\' in \'field list\'','2018-02-19 15:37:49'),(143,'Unknown column \'confirma_senha\' in \'field list\'','2018-02-19 15:38:21'),(144,'Unknown column \'confirma_senha\' in \'field list\'','2018-02-19 15:47:18'),(145,'Unknown column \'confirma_senha\' in \'field list\'','2018-02-19 15:47:19'),(146,'Unknown column \'confirma_senha\' in \'field list\'','2018-02-19 15:47:47'),(147,'Unknown column \'confirma_senha\' in \'field list\'','2018-02-19 15:49:31'),(148,'Unknown column \'confirma_senha\' in \'field list\'','2018-02-19 15:52:04'),(149,'The following SMTP error was encountered: 0 <br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 16:45:50 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nTo: claudiopablosilva@hotmail.com\r\nSubject: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8d942e76656@gmail.com&gt;\r\nMime-Version: 1.0\r\n\n\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\nTestando o envio de email\r\n</pre>','2018-02-21 12:45:51'),(150,'The following SMTP error was encountered: 0 <br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 18:05:32 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nTo: claudiopablosilva@hotmail.com\r\nSubject: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8da6dcbe424@gmail.com&gt;\r\nMime-Version: 1.0\r\n\n\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\nTestando o envio de email\r\n</pre>','2018-02-21 14:05:33'),(151,'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 18:08:34 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8da7922911c@gmail.com&gt;\r\nMime-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\n=?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\nTestando o envio de email\r\n</pre>','2018-02-21 14:08:34'),(152,'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 18:08:36 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8da794d6b41@gmail.com&gt;\r\nMime-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\n=?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\nTestando o envio de email\r\n</pre>','2018-02-21 14:08:36'),(153,'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 18:09:18 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8da7bec0328@gmail.com&gt;\r\nMime-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\n=?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\nTestando o envio de email\r\n</pre>','2018-02-21 14:09:18'),(154,'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 18:09:33 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8da7cda0a41@gmail.com&gt;\r\nMime-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\n=?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\nTestando o envio de email\r\n</pre>','2018-02-21 14:09:33'),(155,'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 18:09:35 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8da7cf7f2d9@gmail.com&gt;\r\nMime-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\n=?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\nTestando o envio de email\r\n</pre>','2018-02-21 14:09:35'),(156,'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 18:11:09 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8da82dec4ae@gmail.com&gt;\r\nMime-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\n=?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\nTestando o envio de email\r\n</pre>','2018-02-21 14:11:09'),(157,'Unable to send email using PHP mail(). Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 21 Feb 2018 18:11:11 +0100\r\nFrom: =?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?= &lt;pablitochivas@gmail.com&gt;\r\nReturn-Path: &lt;pablitochivas@gmail.com&gt;\r\nReply-To: &lt;pablitochivas@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: pablitochivas@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5a8da82f31b8a@gmail.com&gt;\r\nMime-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\n=?UTF-8?Q?Siskitnet=20-=20Redefini?==?UTF-8?Q?=C3=A7=C3=A3o=20de?= =?UTF-8?Q?=20Senha?=\nTestando o envio de email\r\n</pre>','2018-02-21 14:11:11'),(158,'Unknown column \'Array\' in \'where clause\'','2018-02-23 13:22:52'),(159,'Unknown column \'Array\' in \'where clause\'','2018-02-23 13:23:02'),(160,'Unknown column \'Array\' in \'where clause\'','2018-02-23 13:23:27'),(161,'Unknown column \'Array\' in \'where clause\'','2018-02-23 13:25:42'),(162,'Unknown column \'Array\' in \'where clause\'','2018-02-23 13:26:05'),(163,'','2018-02-23 13:39:15'),(164,'','2018-02-23 13:41:00'),(165,'','2018-02-23 13:42:54'),(166,'','2018-02-23 13:43:38'),(167,'','2018-02-23 13:47:50'),(168,'','2018-02-23 13:48:55'),(169,'','2018-02-23 13:50:30'),(170,'Unknown column \'Array\' in \'where clause\'','2018-02-23 15:30:28'),(171,'Unknown column \'Array\' in \'where clause\'','2018-02-23 15:30:39'),(172,'Unknown column \'Array\' in \'where clause\'','2018-02-23 15:31:19'),(173,'','2018-02-23 15:38:48'),(174,'Unknown column \'__ci_last_regenerate\' in \'field list\'','2018-02-25 10:49:39'),(175,'Unknown column \'__ci_last_regenerate\' in \'field list\'','2018-02-25 10:50:37'),(176,'Unknown column \'__ci_last_regenerate\' in \'field list\'','2018-02-25 10:51:35'),(177,'Unknown column \'__ci_last_regenerate\' in \'field list\'','2018-02-25 10:54:45'),(178,'Unknown column \'__ci_last_regenerate\' in \'field list\'','2018-02-25 10:56:16'),(179,'Unknown column \'__ci_last_regenerate\' in \'field list\'','2018-02-25 11:06:11');
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
INSERT INTO `tb_pagamento` VALUES (1,1,11,'1102008','2017-11-11',405.00,15.00,420.00,'2017-11-12','2017-12-12','08d52742b4ab8ec170e3465972cd952f',2017);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_perfil`
--

LOCK TABLES `tb_perfil` WRITE;
/*!40000 ALTER TABLE `tb_perfil` DISABLE KEYS */;
INSERT INTO `tb_perfil` VALUES (1,'Administrador'),(2,'Operador');
/*!40000 ALTER TABLE `tb_perfil` ENABLE KEYS */;
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
-- Table structure for table `tb_token`
--

DROP TABLE IF EXISTS `tb_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_expiracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_idx` (`id_usuario`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_token`
--

LOCK TABLES `tb_token` WRITE;
/*!40000 ALTER TABLE `tb_token` DISABLE KEYS */;
INSERT INTO `tb_token` VALUES (1,1,'$2a$08$Cf1f11ePArKlBJomM0F6a.4Bl4Jp1ly4O2ADCOy2pP1/CS3laKnP.','2018-02-23 17:30:43','2018-02-23 18:00:43'),(2,1,'$2a$08$Cf1f11ePArKlBJomM0F6a.8TKd30RuFfV.DbkW3jfjwNir3T5mCCy','2018-02-23 17:33:20','2018-02-23 18:03:20'),(3,1,'$2a$08$Cf1f11ePArKlBJomM0F6a.PWIAbvWzRok8q6lvv6B.o8IDagBky2i','2018-02-23 17:34:57','2018-02-23 18:04:57'),(4,1,'$2a$08$Cf1f11ePArKlBJomM0F6a.QnRE2UOq6ArzM2BjHN4S6kQo.Qnq9LG','2018-02-23 17:36:38','2018-02-23 18:06:38'),(5,1,'$2a$08$Cf1f11ePArKlBJomM0F6a.RuPPQtfv7pkoEzfwTlXVZjjmUaDGjS6','2018-02-23 17:43:56','2018-02-23 18:13:56'),(6,1,'$2a$08$Cf1f11ePArKlBJomM0F6a.VW0/ZT4opfMXZF9yD2sJF93vUk6aKXC','2018-02-23 17:44:28','2018-02-23 18:14:28'),(7,1,'$2a$08$Cf1f11ePArKlBJomM0F6a.Ol8BVPewDiv3Q2jkPF9zrdgJEVtxzky','2018-02-23 17:45:29','2018-02-23 18:15:29'),(8,1,'$2a$08$Cf1f11ePArKlBJomM0F6a.GfIBBEjMmyZ4ikMe.UuWHilZ7MMkXmu','2018-02-23 17:47:05','2018-02-23 18:17:05');
/*!40000 ALTER TABLE `tb_token` ENABLE KEYS */;
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
  `cpf` varchar(15) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `ativo` int(11) DEFAULT '1',
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `chave` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfil` (`id_perfil`),
  CONSTRAINT `fk_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `tb_perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuario`
--

LOCK TABLES `tb_usuario` WRITE;
/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
INSERT INTO `tb_usuario` VALUES (1,2,'Claudio Pablo Silva Santos','04172473385','98983195289','claudiopablosilva@hotmail.com','18e2edf61276cb53f35c69732158e57d',1,'2017-09-03 22:30:37','08d52742b4ab8ec170e3465972cd952f'),(3,2,'Claudio Pablo','04172473385','98988197084','paoloscorcia@gmail.com','18e2edf61276cb53f35c69732158e57d',1,'2018-02-19 16:21:42','72f78f8386164e26bbc179c1d95b19c7'),(4,2,'Paolo Scorcia','46752528349','98912939123','carlos_marcio800@hotmail.com','7ba66204a4813700ed4c4685005fa9c7',1,'2018-02-19 16:39:15','b2e6afa07cb04734d2f9b062f2713ec2');
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

-- Dump completed on 2018-03-14 23:43:40
