-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 15, 2016 at 04:29 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `infofitness`
--
CREATE DATABASE IF NOT EXISTS `infofitness` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `infofitness`;

-- --------------------------------------------------------

--
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE IF NOT EXISTS `actividad` (
`id_actividad` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `max_asistentes` int(11) NOT NULL DEFAULT '0',
  `descripcion` text CHARACTER SET latin1,
  `precio` float DEFAULT NULL,
  `lugar` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `monitor` int(11) DEFAULT NULL,
  `hora_ini` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `dia` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `nombre`, `max_asistentes`, `descripcion`, `precio`, `lugar`, `monitor`, `hora_ini`, `hora_fin`, `dia`) VALUES
(1, 'Spinning', 40, 'Clase de spinning en bicicletas estáticas', 0, 'Sala de spinning', 3, '18:00:00', '19:00:00', 'Lunes'),
(13, 'Aerodance', 30, 'Danza aerobica', 0, 'Sala de actividades', 4, '18:00:00', '19:00:00', 'Lunes'),
(14, 'Circuit Fit', 35, 'Circuito con obstaculos', 0, 'Sala de actividades', 4, '16:00:00', '17:00:00', 'Miercoles'),
(15, 'Pilates', 40, 'Clase de pilates', 4, 'Sala de actividades', 4, '18:00:00', '19:00:00', 'Jueves'),
(16, 'Tai Chi', 45, 'Clase de tai chi', 6, 'Sala de Actividades', 3, '19:00:00', '20:00:00', 'Viernes'),
(17, 'Power dumbell', 25, 'Clase aerobica con pesas', 3, 'Sala de actividades', 3, '10:00:00', '11:00:00', 'Martes'),
(19, 'Hipopresivos', 30, 'Clase de hipopresivos', 8, 'Sala de actividades', 3, '12:00:00', '13:00:00', 'Viernes');

-- --------------------------------------------------------

--
-- Table structure for table `actividad_meta`
--

DROP TABLE IF EXISTS `actividad_meta`;
CREATE TABLE IF NOT EXISTS `actividad_meta` (
`id_meta` int(11) NOT NULL,
  `id_actividad_meta` int(11) DEFAULT NULL,
  `comienzo_actividad` timestamp NULL DEFAULT NULL,
  `intervalo_actividad` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `actividad_meta`
--

INSERT INTO `actividad_meta` (`id_meta`, `id_actividad_meta`, `comienzo_actividad`, `intervalo_actividad`) VALUES
(2, 13, '2016-11-10 10:49:13', 32000),
(3, 1, '2016-10-10 10:00:00', 65000),
(4, 14, '2016-11-07 07:50:13', 45000);

-- --------------------------------------------------------

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
`idAsistencia` int(11) NOT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deportista`
--

DROP TABLE IF EXISTS `deportista`;
CREATE TABLE IF NOT EXISTS `deportista` (
`id_deportista` int(11) NOT NULL,
  `comentario` text COLLATE latin1_spanish_ci,
  `tipo_tarjeta` tinyint(1) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `deportista`
--

INSERT INTO `deportista` (`id_deportista`, `comentario`, `tipo_tarjeta`, `id_usuario`) VALUES
(1, 'Perder peso', 1, 1),
(2, 'Ganar resistencia', 0, 2),
(3, 'Ganar fuerza', 0, 6),
(4, 'Ganar masa muscular', 1, 7),
(5, 'Tonificar musculos', 1, 11),
(6, 'Tonificar musculos', 1, 13),
(7, 'Tonificar musculos', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `ejercicio`
--

DROP TABLE IF EXISTS `ejercicio`;
CREATE TABLE IF NOT EXISTS `ejercicio` (
`id_ejercicio` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1,
  `dificultad` tinyint(4) DEFAULT NULL,
  `grupo_muscular` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `multimedia` varbinary(100) DEFAULT NULL,
  `maquina` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ejercicio`
--

INSERT INTO `ejercicio` (`id_ejercicio`, `nombre`, `descripcion`, `dificultad`, `grupo_muscular`, `multimedia`, `maquina`) VALUES
(2, 'Press banca plano con barra', 'Press de pecho en banco plano con barra', 2, 'Pectoral', NULL, 'Banco press banca plano'),
(3, 'Press banca inclinado con barra', 'Press de pecho en banco inclinado con barra', 2, 'Pectoral', NULL, 'Banco inclinado'),
(4, 'Press banca declinado con barra', 'Press de pecho en banco declinado con barra', 2, 'Pectoral', NULL, 'Banco declinado'),
(5, 'Press banca plano con mancuernas', 'Press de pecho en banco plano con mancuernas', 2, 'Pectoral', NULL, 'Banco plano'),
(6, 'Press banca inclinado con mancuernas', 'Press de pecho inclinado con mancuernas', 2, 'Pectoral', NULL, 'Banco inclinado'),
(7, 'Aperturas con mancuernas', 'Aperturas de pecho con mancuernas', 1, 'Pectoral', NULL, 'Banco plano'),
(8, 'Remo con mancuernas', 'Remo de espalda con mancuerna a una mano', 1, 'Dorsal', NULL, ''),
(9, 'Jalón tras nuca', 'Jalón tras nuca con barra en polea', 1, 'Dorsal', NULL, 'Dorsalera'),
(10, 'Gemelos en máquina hack', 'Elevacion de talones en maquina hack', 1, 'Pantorrillas', NULL, 'Maquina hack'),
(11, 'Bíceps en banco scott', 'Curl bíceps en banco scott', 1, 'Bíceps', NULL, 'Banco scott'),
(12, 'Prensa', 'Prensa de pierna', 1, 'Cuádriceps y isquiotibiales', NULL, 'Prensa'),
(13, 'Sentadillas', 'Sentadillas con barra trasnuca en jaula', 3, 'Cuadriceps y isquiotibiales', NULL, 'Jaula'),
(14, 'Curl femoral', 'Curl femoral en máquina', 1, 'Isquiotibiales', NULL, 'Maquina de curl femoral'),
(16, 'Hiperextensiones de espalda', 'Extensiones de lumbar', 2, 'Lumbar', NULL, 'Silla romana'),
(17, 'Jalon frontal', 'Jalón frontal de espalda en polea', 1, 'Dorsal', NULL, 'Dorsalera'),
(18, 'Dominadas', 'Dominadas en bara con agarre pronación', 3, 'Dorsal', NULL, 'Barra de dominadas'),
(19, 'Curl bíceps con barra', 'Curl con barra recta de pie', 1, 'Bíceps', NULL, ''),
(20, 'Curl alterno mancuernas', 'Curl bíceps alterno con mancuernas de pie', 1, 'Bíceps', NULL, ''),
(21, 'Press francés', 'Press francés en banco plano', 2, 'Tríceps', NULL, 'Banco plano'),
(22, 'Jalón tríceps', 'Jalón tríceps en polea alta', 1, 'Tríceps', NULL, 'Polea'),
(23, 'Aperturas en máquina', 'Aperturas de pecho en máquina', 1, 'Pectoral', NULL, 'Peck Deck'),
(24, 'Fondos en paralelas', 'Fondos de tríceps en barras paralelas', 3, 'Tríceps', NULL, 'Paralelas'),
(25, 'Press militar', 'Press militar con barra de pie', 3, 'Deltoides', NULL, ''),
(26, 'Press arnold', 'Press de hombro en banco 90º', 2, 'Deltoides', NULL, 'Banco 90º'),
(27, 'Elevaciones laterales', 'Elevaciones laterales con mancuernas', 1, 'Deltoides', NULL, ''),
(28, 'Remo al mentón', 'Remo al mentón con barra', 2, 'Trapecio', NULL, ''),
(29, 'Peso muerto', 'Peso muerto con barra', 3, 'Isquiotibiales', NULL, ''),
(30, 'Extensiones de cuádricpes', 'Extensiones de cuadriceps en maquina', 1, 'Cuadriceps', NULL, 'Maquina de cuadriceps'),
(31, 'Crunch en maquina', 'Crunch abdominal en máquina', 1, 'Abdominales', NULL, 'Maquina de abdominales');

-- --------------------------------------------------------

--
-- Table structure for table `monitor`
--

DROP TABLE IF EXISTS `monitor`;
CREATE TABLE IF NOT EXISTS `monitor` (
`id_entrenador` int(11) NOT NULL,
  `jornada` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `monitor`
--

INSERT INTO `monitor` (`id_entrenador`, `jornada`, `id_usuario`) VALUES
(3, 'tarde', 3),
(4, 'mañana', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
`id_reserva` int(11) NOT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `id_deportista` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `id_actividad`, `id_deportista`) VALUES
(9, 13, 1),
(10, 15, 2),
(11, 16, 4),
(12, 14, 3),
(14, 14, 2),
(16, 15, 4),
(32, 15, 5),
(34, 16, 5),
(37, 14, 5),
(38, 1, 5),
(39, 17, 1),
(40, 1, 1),
(41, 14, 1),
(42, 19, 3),
(43, 17, 3),
(44, 16, 3),
(45, 15, 3),
(46, 1, 4),
(47, 13, 4),
(48, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sesion`
--

DROP TABLE IF EXISTS `sesion`;
CREATE TABLE IF NOT EXISTS `sesion` (
`id_sesion` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `comentario` text COLLATE latin1_spanish_ci,
  `id_tabla` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `sesion`
--

INSERT INTO `sesion` (`id_sesion`, `fecha`, `id_usuario`, `comentario`, `id_tabla`, `id_actividad`) VALUES
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
(20, '2016-11-27 17:11:00', 7, 'Aerodance', NULL, 13),
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

-- --------------------------------------------------------

--
-- Table structure for table `tabla_ejercicios`
--

DROP TABLE IF EXISTS `tabla_ejercicios`;
CREATE TABLE IF NOT EXISTS `tabla_ejercicios` (
`id_tabla` int(11) NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tabla_ejercicios`
--

INSERT INTO `tabla_ejercicios` (`id_tabla`, `descripcion`, `nombre`) VALUES
(1, 'Tabla de hipertrofia', 'TablaHipertrofia1'),
(2, 'Tabla de fuerza  ', 'TablaFuerza1'),
(3, 'Tabla de definicion', 'TablaDefinicion'),
(4, 'Tabla de resistencia ', 'TablaResistencia1');

-- --------------------------------------------------------

--
-- Table structure for table `tabla_ejercicios_deportista`
--

DROP TABLE IF EXISTS `tabla_ejercicios_deportista`;
CREATE TABLE IF NOT EXISTS `tabla_ejercicios_deportista` (
  `id_tabla` int(11) NOT NULL,
  `id_deportista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tabla_ejercicios_deportista`
--

INSERT INTO `tabla_ejercicios_deportista` (`id_tabla`, `id_deportista`) VALUES
(1, 1),
(3, 1),
(2, 2),
(1, 3),
(3, 3),
(4, 3),
(1, 4),
(2, 4),
(4, 4),
(1, 5),
(2, 5),
(3, 5),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tabla_ejercicios_detalles`
--

DROP TABLE IF EXISTS `tabla_ejercicios_detalles`;
CREATE TABLE IF NOT EXISTS `tabla_ejercicios_detalles` (
  `id_tabla` int(11) NOT NULL,
  `id_ejercicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tabla_ejercicios_detalles`
--

INSERT INTO `tabla_ejercicios_detalles` (`id_tabla`, `id_ejercicio`) VALUES
(1, 2),
(1, 3),
(2, 3),
(3, 4),
(3, 6),
(1, 7),
(3, 7),
(4, 7),
(1, 8),
(2, 8),
(4, 8),
(4, 10),
(4, 11),
(2, 13),
(1, 14),
(4, 14),
(3, 16),
(3, 17),
(3, 18),
(4, 19),
(3, 20),
(4, 20),
(3, 21),
(4, 23),
(2, 25),
(1, 26),
(4, 26),
(1, 27),
(3, 28),
(4, 28),
(2, 29),
(3, 29),
(1, 30),
(3, 30),
(1, 31),
(4, 31);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `login` varchar(100) CHARACTER SET latin1 NOT NULL,
  `dni` varchar(9) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `apellidos` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `mail` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `contraseña` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `permisos` tinyint(2) NOT NULL DEFAULT '0',
  `telefono` varchar(12) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `login`, `dni`, `nombre`, `apellidos`, `mail`, `contraseña`, `permisos`, `telefono`, `fecha_nacimiento`, `sexo`) VALUES
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividad`
--
ALTER TABLE `actividad`
 ADD PRIMARY KEY (`id_actividad`), ADD KEY `monitor` (`monitor`);

--
-- Indexes for table `actividad_meta`
--
ALTER TABLE `actividad_meta`
 ADD PRIMARY KEY (`id_meta`), ADD UNIQUE KEY `id_meta_UNIQUE` (`id_meta`), ADD KEY `id_actividad_idx` (`id_actividad_meta`);

--
-- Indexes for table `asistencia`
--
ALTER TABLE `asistencia`
 ADD PRIMARY KEY (`idAsistencia`), ADD KEY `is_asistencia_actividad_idx` (`id_actividad`), ADD KEY `id_asistencia_usuario_idx` (`id_usuario`);

--
-- Indexes for table `deportista`
--
ALTER TABLE `deportista`
 ADD PRIMARY KEY (`id_deportista`), ADD KEY `fk_usuario_idx` (`id_usuario`);

--
-- Indexes for table `ejercicio`
--
ALTER TABLE `ejercicio`
 ADD PRIMARY KEY (`id_ejercicio`);

--
-- Indexes for table `monitor`
--
ALTER TABLE `monitor`
 ADD PRIMARY KEY (`id_entrenador`), ADD UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
 ADD PRIMARY KEY (`id_reserva`), ADD KEY `id_deportista_idx` (`id_deportista`), ADD KEY `id_actividad_reserva_idx` (`id_actividad`);

--
-- Indexes for table `sesion`
--
ALTER TABLE `sesion`
 ADD PRIMARY KEY (`id_sesion`), ADD KEY `dni_usuario_idx` (`id_usuario`), ADD KEY `id_actividad_sesion_idx` (`id_actividad`), ADD KEY `id_tabla_sesion_idx` (`id_tabla`);

--
-- Indexes for table `tabla_ejercicios`
--
ALTER TABLE `tabla_ejercicios`
 ADD PRIMARY KEY (`id_tabla`);

--
-- Indexes for table `tabla_ejercicios_deportista`
--
ALTER TABLE `tabla_ejercicios_deportista`
 ADD PRIMARY KEY (`id_tabla`,`id_deportista`), ADD KEY `id_tabla_deportista_idx` (`id_deportista`);

--
-- Indexes for table `tabla_ejercicios_detalles`
--
ALTER TABLE `tabla_ejercicios_detalles`
 ADD PRIMARY KEY (`id_tabla`,`id_ejercicio`), ADD KEY `id_ejercicio_idx` (`id_ejercicio`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `dni_UNIQUE` (`dni`), ADD UNIQUE KEY `id_usuario_UNIQUE` (`login`), ADD UNIQUE KEY `mail_UNIQUE` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividad`
--
ALTER TABLE `actividad`
MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `actividad_meta`
--
ALTER TABLE `actividad_meta`
MODIFY `id_meta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `asistencia`
--
ALTER TABLE `asistencia`
MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deportista`
--
ALTER TABLE `deportista`
MODIFY `id_deportista` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ejercicio`
--
ALTER TABLE `ejercicio`
MODIFY `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `monitor`
--
ALTER TABLE `monitor`
MODIFY `id_entrenador` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `sesion`
--
ALTER TABLE `sesion`
MODIFY `id_sesion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tabla_ejercicios`
--
ALTER TABLE `tabla_ejercicios`
MODIFY `id_tabla` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividad`
--
ALTER TABLE `actividad`
ADD CONSTRAINT `monitor` FOREIGN KEY (`monitor`) REFERENCES `monitor` (`id_entrenador`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `actividad_meta`
--
ALTER TABLE `actividad_meta`
ADD CONSTRAINT `id_actividad_meta` FOREIGN KEY (`id_actividad_meta`) REFERENCES `actividad` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asistencia`
--
ALTER TABLE `asistencia`
ADD CONSTRAINT `id_asistencia_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `id_asistencia_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `deportista`
--
ALTER TABLE `deportista`
ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `monitor`
--
ALTER TABLE `monitor`
ADD CONSTRAINT `id_usuario_monitor` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reserva`
--
ALTER TABLE `reserva`
ADD CONSTRAINT `id_actividad_reserva` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `id_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `deportista` (`id_deportista`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sesion`
--
ALTER TABLE `sesion`
ADD CONSTRAINT `id_actividad_sesion` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `id_tabla_sesion` FOREIGN KEY (`id_tabla`) REFERENCES `tabla_ejercicios` (`id_tabla`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `id_usuario_sesion` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tabla_ejercicios_deportista`
--
ALTER TABLE `tabla_ejercicios_deportista`
ADD CONSTRAINT `id_tabla_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `deportista` (`id_deportista`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `id_tabla_ejercicios` FOREIGN KEY (`id_tabla`) REFERENCES `tabla_ejercicios` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tabla_ejercicios_detalles`
--
ALTER TABLE `tabla_ejercicios_detalles`
ADD CONSTRAINT `id_ejercicio` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `id_tabla` FOREIGN KEY (`id_tabla`) REFERENCES `tabla_ejercicios` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
