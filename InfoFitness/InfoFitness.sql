CREATE DATABASE  IF NOT EXISTS `infofitness` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `infofitness`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: infofitness
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Table structure for table `Actividad`
--

DROP TABLE IF EXISTS `Actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Actividad` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `max_asistentes` int(11) NOT NULL DEFAULT '0',
  `descripcion` text CHARACTER SET latin1,
  `precio` float DEFAULT NULL,
  `lugar` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `monitor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_actividad`),
  KEY `monitor` (`monitor`),
  CONSTRAINT `monitor` FOREIGN KEY (`monitor`) REFERENCES `Monitor` (`id_entrenador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Actividad`
--

LOCK TABLES `Actividad` WRITE;
/*!40000 ALTER TABLE `Actividad` DISABLE KEYS */;
INSERT INTO `Actividad` VALUES (1,'Spinning',50,'Pedalear a tope',0,'Sala de spinning',3),(13,'Aerodance',30,'Bailar a tope',0,'Sala de actividades',4),(14,'Circuit Fit',35,'A sudar todos',0,'Sala de actividades',4),(15,'Pilates',40,'Clase de pilates',4,'Sala de actividades',4),(16,'Tai Chi',45,'Clase de tai chi tope zen tetes',6,'Sala de Actividades',3);
/*!40000 ALTER TABLE `Actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Actividad_meta`
--

DROP TABLE IF EXISTS `Actividad_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Actividad_meta` (
  `id_meta` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad_meta` int(11) DEFAULT NULL,
  `comienzo_actividad` timestamp NULL DEFAULT NULL,
  `intervalo_actividad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_meta`),
  UNIQUE KEY `id_meta_UNIQUE` (`id_meta`),
  KEY `id_actividad_idx` (`id_actividad_meta`),
  CONSTRAINT `id_actividad_meta` FOREIGN KEY (`id_actividad_meta`) REFERENCES `Actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Actividad_meta`
--

LOCK TABLES `Actividad_meta` WRITE;
/*!40000 ALTER TABLE `Actividad_meta` DISABLE KEYS */;
INSERT INTO `Actividad_meta` VALUES (2,13,'2016-11-10 10:49:13',32000),(3,1,'2016-10-10 10:00:00',65000),(4,14,'2016-11-07 07:50:13',45000);
/*!40000 ALTER TABLE `Actividad_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Deportista`
--

DROP TABLE IF EXISTS `Deportista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Deportista` (
  `id_deportista` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `comentario` text COLLATE latin1_spanish_ci,
  `tipo_tarjeta` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_deportista`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`),
  CONSTRAINT `id_usuario_deportista` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Deportista`
--

LOCK TABLES `Deportista` WRITE;
/*!40000 ALTER TABLE `Deportista` DISABLE KEYS */;
INSERT INTO `Deportista` VALUES (1,1,'flojillo',''),(2,2,'to tocho','\0'),(3,6,'vago','\0'),(4,7,'','');
/*!40000 ALTER TABLE `Deportista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ejercicio`
--

DROP TABLE IF EXISTS `Ejercicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ejercicio` (
  `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1,
  `dificultad` tinyint(4) DEFAULT NULL,
  `grupo_muscular` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `multimedia` varbinary(100) DEFAULT NULL,
  `maquina` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_ejercicio`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ejercicio`
--

LOCK TABLES `Ejercicio` WRITE;
/*!40000 ALTER TABLE `Ejercicio` DISABLE KEYS */;
INSERT INTO `Ejercicio` VALUES (2,'Press banca plano con barra','Press de pecho en banco plano con barra',2,'Pectoral y triceps',NULL,'Banco press banca plano'),(3,'Press banca inclinado con barra','Press de pecho en banco inclinado con barra',2,'Pectoral y triceps',NULL,'Banco press banca inclinado'),(4,'Press banca declinado con barra','Press de pecho en banco declinado con barra',2,'Pectoral y triceps',NULL,'Banco de press de banca declinado'),(5,'Press banca plano con mancuernas','Press de pecho en banco plano con mancuernas',2,'Pectoral y triceps',NULL,'Banco plano'),(6,'Press banca inclinado con mancuernas','Press de pecho inclinado con mancuernas',2,'Pectoral y triceps',NULL,'Banco inclinado'),(7,'Aperturas con mancuernas','Aperturas de pecho con mancuernas',1,'Pectoral',NULL,'Banco plano'),(8,'Remo con mancuernas','Remo de espalda con mancuerna a una mano',1,'Dorsal y bíceps',NULL,NULL),(9,'Jalón tras nuca','Jalón tras nuca con barra en polea',1,'Dorsal y bíceps',NULL,'Polea'),(10,'Gemelos en máquina hack','Elevacion de talones en maquina hack',1,'Pantorrillas',NULL,'Maquina hack'),(11,'Bíceps en banco scott','Curl bíceps en banco scott',1,'Bíceps',NULL,'Banco scott'),(12,'Prensa','Prensa de pierna',1,'Cuádriceps y isquiotibiales',NULL,'Prensa'),(13,'Sentadillas','Sentadillas con barra trasnuca en jaula',3,'Cuadriceps y isquiotibiales',NULL,'Jaula'),(14,'Curl femoral','Curl femoral en máquina',1,'Isquiotibiales',NULL,'Maquina de curl femoral');
/*!40000 ALTER TABLE `Ejercicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Monitor`
--

DROP TABLE IF EXISTS `Monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Monitor` (
  `id_entrenador` int(11) NOT NULL AUTO_INCREMENT,
  `jornada` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_entrenador`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`),
  CONSTRAINT `id_usuario_monitor` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Monitor`
--

LOCK TABLES `Monitor` WRITE;
/*!40000 ALTER TABLE `Monitor` DISABLE KEYS */;
INSERT INTO `Monitor` VALUES (3,'tarde',3),(4,'mañana',5);
/*!40000 ALTER TABLE `Monitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reserva`
--

DROP TABLE IF EXISTS `Reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad` int(11) DEFAULT NULL,
  `id_deportista` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_deportista_idx` (`id_deportista`),
  KEY `id_actividad_reserva_idx` (`id_actividad`),
  CONSTRAINT `id_actividad_reserva` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `Deportista` (`id_deportista`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reserva`
--

LOCK TABLES `Reserva` WRITE;
/*!40000 ALTER TABLE `Reserva` DISABLE KEYS */;
INSERT INTO `Reserva` VALUES (9,13,1),(10,15,2),(11,16,4),(12,14,3),(13,14,4),(14,14,2),(15,13,3),(16,15,4);
/*!40000 ALTER TABLE `Reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sesion`
--

DROP TABLE IF EXISTS `Sesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sesion` (
  `id_sesion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `comentario` text COLLATE latin1_spanish_ci,
  `id_tabla` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sesion`),
  KEY `dni_usuario_idx` (`id_usuario`),
  KEY `id_actividad_sesion_idx` (`id_actividad`),
  KEY `id_tabla_sesion_idx` (`id_tabla`),
  CONSTRAINT `id_actividad_sesion` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_tabla_sesion` FOREIGN KEY (`id_tabla`) REFERENCES `Tabla_Ejercicios` (`id_tabla`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_usuario_sesion` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sesion`
--

LOCK TABLES `Sesion` WRITE;
/*!40000 ALTER TABLE `Sesion` DISABLE KEYS */;
INSERT INTO `Sesion` VALUES (7,'2016-12-25 00:00:00',1,'Muy duro',1,NULL),(8,'2016-12-31 00:00:00',6,'Muy suave',2,NULL),(9,'2016-11-21 00:00:00',2,'Normalita',NULL,1);
/*!40000 ALTER TABLE `Sesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tabla_Ejercicios`
--

DROP TABLE IF EXISTS `Tabla_Ejercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tabla_Ejercicios` (
  `id_tabla` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE latin1_spanish_ci,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tabla_Ejercicios`
--

LOCK TABLES `Tabla_Ejercicios` WRITE;
/*!40000 ALTER TABLE `Tabla_Ejercicios` DISABLE KEYS */;
INSERT INTO `Tabla_Ejercicios` VALUES (1,'Tabla de hipertrofia','TablaHipertrofia1'),(2,'Tabla de fuerza','TablaFuerza1'),(3,'Tabla de definicion','TablaDefinicion'),(4,'Tabla de resistencia','TablaResistencia1');
/*!40000 ALTER TABLE `Tabla_Ejercicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tabla_Ejercicios_Deportista`
--

DROP TABLE IF EXISTS `Tabla_Ejercicios_Deportista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tabla_Ejercicios_Deportista` (
  `id_tabla` int(11) NOT NULL,
  `id_deportista` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla`,`id_deportista`),
  KEY `id_tabla_deportista_idx` (`id_deportista`),
  CONSTRAINT `id_tabla_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `Deportista` (`id_deportista`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_tabla_ejercicios` FOREIGN KEY (`id_tabla`) REFERENCES `Tabla_Ejercicios` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tabla_Ejercicios_Deportista`
--

LOCK TABLES `Tabla_Ejercicios_Deportista` WRITE;
/*!40000 ALTER TABLE `Tabla_Ejercicios_Deportista` DISABLE KEYS */;
INSERT INTO `Tabla_Ejercicios_Deportista` VALUES (1,1),(2,2),(1,3),(2,4);
/*!40000 ALTER TABLE `Tabla_Ejercicios_Deportista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tabla_Ejercicios_Detalles`
--

DROP TABLE IF EXISTS `Tabla_Ejercicios_Detalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tabla_Ejercicios_Detalles` (
  `id_tabla` int(11) NOT NULL,
  `id_ejercicio` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla`,`id_ejercicio`),
  KEY `id_ejercicio_idx` (`id_ejercicio`),
  CONSTRAINT `id_ejercicio` FOREIGN KEY (`id_ejercicio`) REFERENCES `Ejercicio` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_tabla` FOREIGN KEY (`id_tabla`) REFERENCES `Tabla_Ejercicios` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tabla_Ejercicios_Detalles`
--

LOCK TABLES `Tabla_Ejercicios_Detalles` WRITE;
/*!40000 ALTER TABLE `Tabla_Ejercicios_Detalles` DISABLE KEYS */;
INSERT INTO `Tabla_Ejercicios_Detalles` VALUES (1,2),(1,3),(2,3),(1,4),(1,5),(2,5),(2,7),(2,8);
/*!40000 ALTER TABLE `Tabla_Ejercicios_Detalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) CHARACTER SET latin1 NOT NULL,
  `dni` varchar(9) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `apellidos` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `mail` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `contraseña` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `permisos` tinyint(2) NOT NULL DEFAULT '0',
  `telefono` varchar(12) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `id_usuario_UNIQUE` (`login`),
  UNIQUE KEY `mail_UNIQUE` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'robertoGz','25648375C','Roberto','Gonzalez','rober@gmail.com','dshfbfb',0,'643875438','1987-09-17'),(2,'lrcortizo','44490236V','Luis','Raña','luisraco95@gmail.com','pass1234',0,'627642372','1995-08-22'),(3,'manuelRa','52689487R','Manuel','Ramos','manuelramos@gmail.com','alskdhkajsh',1,'685365985',NULL),(4,'gdavila','53193712W','Guillermo','Davila Varela','guillermo.davilavarela@gmail.com','oqwurouey',2,'638233356',NULL),(5,'mariaG','6985478T','Maria','Graña','maria@gmail.com','askdhqufad',1,'698523654',NULL),(6,'pepitoAl','87538459X','Pepe','Alvarez','pepito@hotmail.com','bdsfbsi',0,'642837238','1990-04-26'),(7,'carlosMz','98569383F','Carlos','Martinez','carlitos@gmail.com','ijnfibidv',0,'623923733','1973-02-11');
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-10 16:17:09
