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
  `hora_ini` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `dia` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_actividad`),
  KEY `monitor` (`monitor`),
  CONSTRAINT `monitor` FOREIGN KEY (`monitor`) REFERENCES `Monitor` (`id_entrenador`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Actividad`
--

LOCK TABLES `Actividad` WRITE;
/*!40000 ALTER TABLE `Actividad` DISABLE KEYS */;
INSERT INTO `Actividad` VALUES (1,'Spinning',40,'Pedalear a tope',6,'Sala de spinning',3,'18:00:00','19:00:00','Lunes'),(13,'Aerodance',30,'Bailar a tope',5,'Sala de actividades',4,'18:00:00','19:00:00','Jueves'),(14,'Circuit Fit',35,'A sudar todos',2,'Sala de actividades',5,'16:00:00','17:00:00','Miercoles'),(15,'Pilates',40,'Clase de pilates',4,'Sala de actividades',4,'18:00:00','19:00:00','Jueves'),(16,'Tai Chi',45,'Clase de tai chi tope zen tetes',6,'Sala de Actividades',3,'19:00:00','20:00:00','Viernes');
/*!40000 ALTER TABLE `Actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Deportista`
--

DROP TABLE IF EXISTS `Deportista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Deportista` (
  `id_deportista` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text COLLATE latin1_spanish_ci,
  `tipo_tarjeta` tinyint(1) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_deportista`),
  KEY `fk_usuario_idx` (`id_usuario`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Deportista`
--

LOCK TABLES `Deportista` WRITE;
/*!40000 ALTER TABLE `Deportista` DISABLE KEYS */;
INSERT INTO `Deportista` VALUES
(1,'Flojillo',1,1),
(2,'Fuerte',0,2),
(3,'Vago',0,6),
(4,'Grande',1,7),
(5,'Hiperactivo',0,13),
(6,NULL,1,14),
(7,NULL,1,15),
(8,NULL,0,16),
(9,NULL,1,17),
(10,NULL,1,18),
(11,NULL,0,19),
(12,NULL,0,20),
(13,NULL,1,21),
(14,NULL,0,22),
(15,NULL,1,23),
(16,NULL,0,24),
(25,"Trabajador",0,11);
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
  `maquina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ejercicio`),
  KEY `maquina_idx` (`maquina`),
  CONSTRAINT `maquina` FOREIGN KEY (`maquina`) REFERENCES `Maquina` (`idMaquina`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ejercicio`
--

LOCK TABLES `Ejercicio` WRITE;
/*!40000 ALTER TABLE `Ejercicio` DISABLE KEYS */;
INSERT INTO `Ejercicio` VALUES (2,'Press banca plano con barra','Press de pecho en banco plano con barra',2,'Pectoral y triceps',NULL,1),(3,'Press banca inclinado con barra','Press de pecho en banco inclinado con barra',2,'Pectoral y triceps',NULL,2),(4,'Press banca declinado con barra','Press de pecho en banco declinado con barra',2,'Pectoral y triceps',NULL,3),(5,'Press banca plano con mancuernas','Press de pecho en banco plano con mancuernas',2,'Pectoral y triceps',NULL,4),(6,'Press banca inclinado con mancuernas','Press de pecho inclinado con mancuernas',2,'Pectoral y triceps',NULL,5),(7,'Aperturas con mancuernas','Aperturas de pecho con mancuernas',1,'Pectoral',NULL,4),(8,'Remo con mancuernas','Remo de espalda con mancuerna a una mano',1,'Dorsal y bíceps',NULL,NULL),(9,'Jalón tras nuca','Jalón tras nuca con barra en polea',1,'Dorsal y bíceps',NULL,6),(10,'Gemelos en máquina hack','Elevacion de talones en maquina hack',1,'Pantorrillas',NULL,7),(11,'Bíceps en banco scott','Curl bíceps en banco scott',1,'Bíceps',NULL,8),(12,'Prensa','Prensa de pierna',1,'Cuádriceps y isquiotibiales',NULL,9),(13,'Sentadillas','Sentadillas con barra trasnuca en jaula',3,'Cuadriceps y isquiotibiales',NULL,10),(14,'Curl femoral','Curl femoral en máquina',1,'Isquiotibiales',NULL,11);
/*!40000 ALTER TABLE `Ejercicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Maquina`
--

DROP TABLE IF EXISTS `Maquina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Maquina` (
  `idMaquina` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE latin1_spanish_ci,
  PRIMARY KEY (`idMaquina`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Maquina`
--

LOCK TABLES `Maquina` WRITE;
/*!40000 ALTER TABLE `Maquina` DISABLE KEYS */;
INSERT INTO `Maquina` VALUES (1,'Banco press banca plano','Banco press banca plano'),(2,'Banco press banca inclinado','Banco press banca inclinado'),(3,'Banco de press de banca declinado','Banco de press de banca declinado'),(4,'Banco plano','Banco plano'),(5,'Banco inclinado','Banco inclinado'),(6,'Polea','Polea'),(7,'Maquina hack','Maquina hack'),(8,'Banco scott','Banco scott'),(9,'Prensa','Prensa'),(10,'Jaula','Jaula'),(11,'Maquina de curl femoral','Maquina de curl femoral');
/*!40000 ALTER TABLE `Maquina` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Monitor`
--

LOCK TABLES `Monitor` WRITE;
/*!40000 ALTER TABLE `Monitor` DISABLE KEYS */;
INSERT INTO `Monitor` VALUES (3,'tarde',3),(4,'mañana',5),(5,'todas',10);
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
  CONSTRAINT `id_actividad_reserva` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `Deportista` (`id_deportista`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reserva`
--

LOCK TABLES `Reserva` WRITE;
/*!40000 ALTER TABLE `Reserva` DISABLE KEYS */;
INSERT INTO `Reserva` VALUES (9,13,1),(10,15,2),(11,16,4),(12,14,3),(14,14,2),(16,15,4),(17,1,25);
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
  CONSTRAINT `id_actividad_sesion` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_tabla_sesion` FOREIGN KEY (`id_tabla`) REFERENCES `Tabla_Ejercicios` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_usuario_sesion` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sesion`
--

LOCK TABLES `Sesion` WRITE;
/*!40000 ALTER TABLE `Sesion` DISABLE KEYS */;
INSERT INTO `Sesion` (`id_sesion`, `fecha`, `id_usuario`, `comentario`, `id_tabla`, `id_actividad`) VALUES
(7, '2016-12-25 00:00:00', 7, 'Muy duro', 1, 13),
(8, '2016-12-31 00:00:00', 7, 'Muy suave', 2, 17),
(9, '2016-11-21 00:00:00', 13, 'Normalita', NULL, 1),
(10, '2016-11-25 16:11:00', 1, 'Aerodance', NULL, 13),
(11, '2016-11-25 16:11:00', 2, 'Circuit Fit', NULL, 14),
(13, '2016-11-27 15:11:00', 11, 'Completada', 1, NULL),
(14, '2016-11-27 16:11:00', 1, 'Demasiado exigente', 1, NULL),
(15, '2016-11-27 16:11:00', 7, 'Completada', 1, NULL),
(16, '2016-11-27 17:11:00', 1, 'Spinning', NULL, 1),
(17, '2016-11-27 17:11:00', 7, 'Spinning', NULL, 1),
(18, '2016-11-27 17:11:00', 14, 'Spinning', NULL, 1),
(19, '2016-11-27 17:11:00', 1, 'Aerodance', NULL, 13),
(20, '2016-11-27 17:11:00', 22, 'Aerodance', NULL, 13),
(21, '2016-11-27 17:11:00', 1, 'Circuit Fit', NULL, 14),
(22, '2016-11-27 17:11:00', 2, 'Circuit Fit', NULL, 14),
(23, '2016-11-27 17:11:00', 6, 'Circuit Fit', NULL, 14),
(24, '2016-11-27 17:11:00', 7, 'Circuit Fit', NULL, 14),
(25, '2016-11-27 17:11:00', 11, 'Circuit Fit', NULL, 14),
(26, '2016-11-27 17:11:00', 2, 'Pilates', NULL, 15),
(27, '2016-11-27 17:11:00', 6, 'Pilates', NULL, 15),
(28, '2016-11-27 17:11:00', 7, 'Pilates', NULL, 15),
(29, '2016-11-27 17:11:00', 13, 'Pilates', NULL, 15),
(30, '2016-11-27 17:11:00', 6, 'Tai Chi', NULL, 16),
(31, '2016-11-27 17:11:00', 7, 'Tai Chi', NULL, 16),
(33, '2016-11-27 17:11:00', 6, 'Hipopresivos', NULL, 19),
(34, '2016-11-27 17:11:00', 1, 'Power dumbell', NULL, 17),
(35, '2016-11-27 17:11:00', 7, 'Power dumbell', NULL, 17),
(36, '2016-12-14 16:12:00', 11, 'Spinning', NULL, 1),
(37, '2016-12-14 16:12:00', 11, 'Spinning', NULL, 1),
(38, '2016-12-14 16:12:00', 1, 'Spinning', NULL, 1),
(39, '2016-12-14 16:12:00', 15, 'Spinning', NULL, 1),
(40, '2016-12-14 16:12:00', 16, 'Spinning', NULL, 1),
(41, '2016-11-27 17:11:00', 16, 'Circuit Fit', NULL, 14),
(42, '2016-11-27 17:11:00', 17, 'Circuit Fit', NULL, 14),
(43, '2016-11-27 17:11:00', 18, 'Circuit Fit', NULL, 14),
(44, '2016-11-27 17:11:00', 14, 'Pilates', NULL, 15),
(45, '2016-11-27 17:11:00', 15, 'Pilates', NULL, 15),
(46, '2016-11-27 17:11:00', 16, 'Pilates', NULL, 15),
(47, '2016-11-27 17:11:00', 17, 'Pilates', NULL, 15),
(48, '2016-11-27 17:11:00', 18, 'Pilates', NULL, 15),
(49, '2016-11-27 17:11:00', 19, 'Pilates', NULL, 15),
(50, '2016-11-27 17:11:00', 23, 'Tai Chi', NULL, 16),
(51, '2016-11-27 17:11:00', 22, 'Tai Chi', NULL, 16),
(52, '2016-11-27 17:11:00', 21, 'Tai Chi', NULL, 16),
(53, '2016-11-27 17:11:00', 20, 'Tai Chi', NULL, 16),
(54, '2016-11-27 17:11:00', 6, 'Hipopresivos', NULL, 19),
(55, '2016-11-27 17:11:00', 23, 'Hipopresivos', NULL, 19),
(56, '2016-11-27 17:11:00', 22, 'Power dumbell', NULL, 17),
(57, '2016-11-27 17:11:00', 18, 'Power dumbell', NULL, 17),
(58, '2016-11-27 17:11:00', 19, 'Power dumbell', NULL, 17);
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
  `id_ejercicio` int(11) NOT NULL,
  `comentario` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla`,`id_deportista`,`id_ejercicio`),
  KEY `id_tabla_deportista_idx` (`id_deportista`),
  CONSTRAINT `id_tabla_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `Deportista` (`id_deportista`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_tabla_ejercicios` FOREIGN KEY (`id_tabla`) REFERENCES `Tabla_Ejercicios` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_ejercicios` FOREIGN KEY (`id_ejercicio`) REFERENCES `Ejercicio` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tabla_Ejercicios_Deportista`
--

LOCK TABLES `Tabla_Ejercicios_Deportista` WRITE;
/*!40000 ALTER TABLE `Tabla_Ejercicios_Deportista` DISABLE KEYS */;
INSERT INTO `Tabla_Ejercicios_Deportista` VALUES
(1, 1, 2,'Bajar repeticiones'),
(1, 1, 3, 'Subir repeticiones'),
(1, 1, 4, 'Bajar carga'),
(1, 1, 7, 'Subir carga'),
(3, 1, 3,'Bajar repeticiones'),
(3, 1, 7,'Subir carga'),
(3, 1, 11,'Subir carga'),
(3, 1, 14,'Subir carga'),
(2, 2, 3,'Bajar repeticiones'),
(2, 2, 5,'Subir carga'),
(2, 2, 7,'Subir repeticiones'),
(2, 2, 8,'Subir carga'),
(1, 3, 2,'Subir carga'),
(1, 3, 3,'Bajar repeticiones'),
(1, 3, 4,'Bajar carga'),
(1, 3, 7,'Subir carga'),
(3, 3, 3,'Bajar repeticiones'),
(3, 3, 7,'Subir carga'),
(3, 3, 11,'Subir repeticiones'),
(3, 3, 14,'Subir repeticiones'),
(1, 4, 2,'Bajar carga'),
(1, 4, 3,'Subir carga'),
(1, 4, 4,'Subir carga'),
(1, 4, 7,'Bajar repeticiones'),
(2, 4, 3,'Subir carga'),
(2, 4, 5,'Subir carga'),
(2, 4, 7,'Bajar repeticiones'),
(2, 4, 8,'Subir carga'),
(1, 25, 2,'Bajar repeticiones'),
(1, 25, 3,'Bajar carga'),
(1, 25, 4,'Subir carga'),
(1, 25, 7,'Subir carga'),
(2, 25, 3,'Bajar repeticiones'),
(2, 25, 5,'Subir repeticiones'),
(2, 25, 7,'Bajar carga'),
(2, 25, 8,'Subir carga');
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
  `carga` int(11) DEFAULT NULL,
  `repeticiones` int(11) DEFAULT NULL,
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
INSERT INTO `Tabla_Ejercicios_Detalles` VALUES
(1,2,20,15),
(1,3,15,15),
(2,3,30,10),
(1,4,15,15),
(2,5,30,10),
(1,7,20,15),
(2,7,20,10),
(2,8,20,10);
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
  UNIQUE KEY `mail_UNIQUE` (`mail`),
    `sexo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` (`id_usuario`, `login`, `dni`, `nombre`, `apellidos`, `mail`, `contraseña`, `permisos`, `telefono`, `fecha_nacimiento`, `sexo`) VALUES
(1, 'robertoGz', '25648375C', 'Roberto', 'Gonzalez', 'rober@gmail.com', 'dshfbfb', 0, '643875438', '1987-09-17', 'hombre'),
(2, 'lrcortizo', '44490236V', 'Luis', 'Raña', 'luisraco95@gmail.com', '1234', 0, '627642372', '1995-08-22', 'hombre'),
(3, 'manuelRa', '52689487R', 'Manuel', 'Ramos', 'manuelramos@gmail.com', 'pass', 1, '685365985', NULL, 'hombre'),
(4, 'gdavila', '53193712W', 'Guillermo', 'Davila Varela', 'guillermo.davilavarela@gmail.com', 'admin', 2, '638233356', '1995-10-26', 'hombre'),
(5, 'mariaG', '6985478T', 'Maria', 'Graña', 'maria@gmail.com', 'pass', 1, '698523654', NULL, 'mujer'),
(6, 'pepitoAl', '87538459X', 'Pepe', 'Alvarez', 'pepito@hotmail.com', 'bdsfbsi', 0, '642837238', '1990-04-26', 'hombre'),
(7, 'carlosMz', '98569383F', 'Carlos', 'Martinez', 'carlitos@gmail.com', 'ijnfibidv', 0, '623923733', '1992-10-10', 'hombre'),
(9, 'admin', '12345678A', 'Admin', 'Admin', 'admin@admin.admin', 'admin', 2, '', '2016-11-17', 'mujer'),
(10, 'monitor', '11111111A', 'Moni', 'Moni', 'moni@moni.moni', 'monitor', 1, NULL, NULL, 'hombre'),
(11, 'user', '22222222A', 'User', 'User', 'user@user.user', 'user', 0, NULL, NULL, 'hombre'),
(12, 'newuser', '52469845E', 'newuser', 'newuser', 'newuser@newuser.com', '(+34) ', 0, '+34685214523', '1995-05-10', 'hombre'),
(13, 'albaF', '69654768T', 'Alba', 'Fernández', 'alba@gmail.com', 'pass', 0, '698245574', '1996-11-14', 'mujer'),
(14, 'carlaH', '55896624M', 'Carla', 'Hernandez', 'carla@gmail.com', 'pass', 0, '632245589', '1994-03-01', 'mujer'),
(15, 'vanessaF', '44896324L', 'Vanessa', 'Fernández', 'vanessa@gmail.com', 'pass', 0, '666245574', '1991-02-11', 'mujer'),
(16, 'silviaP', '77896324Y', 'Silvia', 'Parada', 'silvia@gmail.com', 'pass', 0, '631487974', '1993-08-08', 'mujer'),
(17, 'aldaraV', '48796523G', 'Aldara', 'Vazquez', 'aldara@gmail.com', 'pass', 0, '632599874', '1994-05-21', 'mujer'),
(18, 'antoniaD', '87475893K', 'Antonia', 'Dominguez', 'antonia@gmail.com', 'pass', 0, '669855574', '1995-05-11', 'mujer'),
(19, 'paulaC', '44896324T', 'Paula', 'Carbonero', 'paula@gmail.com', 'pass', 0, '632245541', '1992-01-16', 'mujer'),
(20, 'fatimaP', '11896547P', 'Fatima', 'Pego', 'fatima@gmail.com', 'pass', 0, '632589625', '1991-09-11', 'mujer'),
(21, 'ariadnaM', '2259324S', 'Ariadna', 'Martinez', 'ariadna@gmail.com', 'pass', 0, '666953258', '1994-11-11', 'mujer'),
(22, 'estefaniaJ', '33569741O', 'Estefania', 'Jimenez', 'estefania@gmail.com', 'pass', 0, '666645574', '1995-12-21', 'mujer'),
(23, 'raquelB', '77859812C', 'Raquel', 'Barbeito', 'raquel@gmail.com', 'pass', 0, '6698741471', '1994-10-03', 'mujer'),
(24, 'lauraC', '77455596W', 'Laura', 'Castillo', 'laura@gmail.com', 'pass', 0, '674297365', '1998-09-09', 'mujer');
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

GRANT USAGE ON *.* TO 'infoFitness'@'localhost';
DROP USER 'infoFitness'@'localhost';

CREATE USER 'infoFitness'@'localhost' IDENTIFIED BY 'infoFitness';
GRANT ALL PRIVILEGES ON * . * TO 'infoFitness'@'localhost';


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-13 16:29:47
