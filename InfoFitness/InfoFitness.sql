-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-11-2016 a las 16:07:01
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `infofitness`
--
create database if not exists `infofitness` default character set utf8 collate utf8_spanish_ci;
use `infofitness`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE IF NOT EXISTS `Actividad` (
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
  KEY `monitor` (`monitor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`id_actividad`, `nombre`, `max_asistentes`, `descripcion`, `precio`, `lugar`, `monitor`, `hora_ini`, `hora_fin`, `dia`) VALUES
(1, 'Spinning', 40, 'Clase de spinning en bicicletas estáticas', 0, 'Sala de spinning', 3, '18:00:00', '19:00:00', 'Lunes'),
(13, 'Aerodance', 30, 'Danza aerobica', 0, 'Sala de actividades', 4, '18:00:00', '19:00:00', 'Lunes'),
(14, 'Circuit Fit', 35, 'Circuito con obstaculos', 0, 'Sala de actividades', 4, '16:00:00', '17:00:00', 'Miercoles'),
(15, 'Pilates', 40, 'Clase de pilates', 4, 'Sala de actividades', 4, '18:00:00', '19:00:00', 'Jueves'),
(16, 'Tai Chi', 45, 'Clase de tai chi', 6, 'Sala de Actividades', 3, '19:00:00', '20:00:00', 'Viernes'),
(17, 'Power dumbell', 25, 'Clase aerobica con pesas', 3, 'Sala de actividades', 3, '10:00:00', '11:00:00', 'Martes'),
(19, 'Hipopresivos', 30, 'Clase de hipopresivos', 8, 'Sala de actividades', 3, '12:00:00', '13:00:00', 'Viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_meta`
--

CREATE TABLE IF NOT EXISTS `actividad_meta` (
  `id_meta` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad_meta` int(11) DEFAULT NULL,
  `comienzo_actividad` timestamp NULL DEFAULT NULL,
  `intervalo_actividad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_meta`),
  UNIQUE KEY `id_meta_UNIQUE` (`id_meta`),
  KEY `id_actividad_idx` (`id_actividad_meta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `actividad_meta`
--

INSERT INTO `actividad_meta` (`id_meta`, `id_actividad_meta`, `comienzo_actividad`, `intervalo_actividad`) VALUES
(2, 13, '2016-11-10 10:49:13', 32000),
(3, 1, '2016-10-10 10:00:00', 65000),
(4, 14, '2016-11-07 07:50:13', 45000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asistencia`
--

CREATE TABLE IF NOT EXISTS `Asistencia` (
  `idAsistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAsistencia`),
  KEY `is_asistencia_actividad_idx` (`id_actividad`),
  KEY `id_asistencia_usuario_idx` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Deportista`
--

CREATE TABLE IF NOT EXISTS `Deportista` (
  `id_deportista` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text COLLATE latin1_spanish_ci,
  `tipo_tarjeta` tinyint(1) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_deportista`),
  KEY `fk_usuario_idx` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Deportista`
--

INSERT INTO `Deportista` (`id_deportista`, `comentario`, `tipo_tarjeta`, `id_usuario`) VALUES
(1, 'Perder peso', 1, 1),
(2, 'Ganar resistencia', 0, 2),
(3, 'Ganar fuerza', 0, 6),
(4, 'Ganar masa muscular', 1, 7),
(5, 'Tonificar musculos', 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ejercicio`
--

CREATE TABLE IF NOT EXISTS `Ejercicio` (
  `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1,
  `dificultad` tinyint(4) DEFAULT NULL,
  `grupo_muscular` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `multimedia` varbinary(100) DEFAULT NULL,
  `maquina` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_ejercicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `Ejercicio`
--

INSERT INTO `Ejercicio` (`id_ejercicio`, `nombre`, `descripcion`, `dificultad`, `grupo_muscular`, `multimedia`, `maquina`) VALUES
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
-- Estructura de tabla para la tabla `Monitor`
--

CREATE TABLE IF NOT EXISTS `Monitor` (
  `id_entrenador` int(11) NOT NULL AUTO_INCREMENT,
  `jornada` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_entrenador`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Monitor`
--

INSERT INTO `Monitor` (`id_entrenador`, `jornada`, `id_usuario`) VALUES
(3, 'tarde', 3),
(4, 'mañana', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva`
--

CREATE TABLE IF NOT EXISTS `Reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad` int(11) DEFAULT NULL,
  `id_deportista` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_deportista_idx` (`id_deportista`),
  KEY `id_actividad_reserva_idx` (`id_actividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `Reserva`
--

INSERT INTO `Reserva` (`id_reserva`, `id_actividad`, `id_deportista`) VALUES
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
-- Estructura de tabla para la tabla `Sesion`
--

CREATE TABLE IF NOT EXISTS `Sesion` (
  `id_sesion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `comentario` text COLLATE latin1_spanish_ci,
  `id_tabla` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sesion`),
  KEY `dni_usuario_idx` (`id_usuario`),
  KEY `id_actividad_sesion_idx` (`id_actividad`),
  KEY `id_tabla_sesion_idx` (`id_tabla`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `Sesion`
--

INSERT INTO `Sesion` (`id_sesion`, `fecha`, `id_usuario`, `comentario`, `id_tabla`, `id_actividad`) VALUES
(7, '2016-12-25 00:00:00', 1, 'Muy duro', 1, NULL),
(8, '2016-12-31 00:00:00', 6, 'Muy suave', 2, NULL),
(9, '2016-11-21 00:00:00', 2, 'Normalita', NULL, 1),
(10, '2016-11-25 16:11:00', 1, 'Aerodance', NULL, 13),
(11, '2016-11-25 16:11:00', 2, 'Circuit Fit', NULL, 14),
(13, '2016-11-27 15:11:00', 11, 'Completada', 1, NULL),
(14, '2016-11-27 16:11:00', 1, 'Demasiado exigente', 1, NULL),
(15, '2016-11-27 16:11:00', 7, 'Completada', 1, NULL),
(16, '2016-11-27 17:11:00', 1, 'Spinning', NULL, 1),
(17, '2016-11-27 17:11:00', 7, 'Spinning', NULL, 1),
(18, '2016-11-27 17:11:00', 11, 'Spinning', NULL, 1),
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
(29, '2016-11-27 17:11:00', 11, 'Pilates', NULL, 15),
(30, '2016-11-27 17:11:00', 6, 'Tai Chi', NULL, 16),
(31, '2016-11-27 17:11:00', 7, 'Tai Chi', NULL, 16),
(32, '2016-11-27 17:11:00', 11, 'Tai Chi', NULL, 16),
(33, '2016-11-27 17:11:00', 6, 'Hipopresivos', NULL, 19),
(34, '2016-11-27 17:11:00', 1, 'Power dumbell', NULL, 17),
(35, '2016-11-27 17:11:00', 6, 'Power dumbell', NULL, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tabla_Ejercicios`
--

CREATE TABLE IF NOT EXISTS `Tabla_Ejercicios` (
  `id_tabla` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE latin1_spanish_ci,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tabla`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Tabla_Ejercicios`
--

INSERT INTO `Tabla_Ejercicios` (`id_tabla`, `descripcion`, `nombre`) VALUES
(1, 'Tabla de hipertrofia', 'TablaHipertrofia1'),
(2, 'Tabla de fuerza  ', 'TablaFuerza1'),
(3, 'Tabla de definicion', 'TablaDefinicion'),
(4, 'Tabla de resistencia ', 'TablaResistencia1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tabla_Ejercicios_Deportista`
--

CREATE TABLE IF NOT EXISTS `Tabla_Ejercicios_Deportista` (
  `id_tabla` int(11) NOT NULL,
  `id_deportista` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla`,`id_deportista`),
  KEY `id_tabla_deportista_idx` (`id_deportista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Tabla_Ejercicios_Deportista`
--

INSERT INTO `Tabla_Ejercicios_Deportista` (`id_tabla`, `id_deportista`) VALUES
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
-- Estructura de tabla para la tabla `Tabla_Ejercicios_Detalles`
--

CREATE TABLE IF NOT EXISTS `Tabla_Ejercicios_Detalles` (
  `id_tabla` int(11) NOT NULL,
  `id_ejercicio` int(11) NOT NULL,
  PRIMARY KEY (`id_tabla`,`id_ejercicio`),
  KEY `id_ejercicio_idx` (`id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Tabla_Ejercicios_Detalles`
--

INSERT INTO `Tabla_Ejercicios_Detalles` (`id_tabla`, `id_ejercicio`) VALUES
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
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id_usuario`, `login`, `dni`, `nombre`, `apellidos`, `mail`, `contraseña`, `permisos`, `telefono`, `fecha_nacimiento`) VALUES
(1, 'robertoGz', '25648375C', 'Roberto', 'Gonzalez', 'rober@gmail.com', 'dshfbfb', 0, '643875438', '1987-09-17'),
(2, 'lrcortizo', '44490236V', 'Luis', 'Raña', 'luisraco95@gmail.com', '1234', 0, '627642372', '1995-08-22'),
(3, 'manuelRa', '52689487R', 'Manuel', 'Ramos', 'manuelramos@gmail.com', 'pass', 1, '685365985', NULL),
(4, 'gdavila', '53193712W', 'Guillermo', 'Davila Varela', 'guillermo.davilavarela@gmail.com', 'admin', 2, '638233356', '1995-10-26'),
(5, 'mariaG', '6985478T', 'Maria', 'Graña', 'maria@gmail.com', 'pass', 1, '698523654', NULL),
(6, 'pepitoAl', '87538459X', 'Pepe', 'Alvarez', 'pepito@hotmail.com', 'bdsfbsi', 0, '642837238', '1990-04-26'),
(7, 'carlosMz', '98569383F', 'Carlos', 'Martinez', 'carlitos@gmail.com', 'ijnfibidv', 0, '623923733', '1992-10-10'),
(9, 'admin', '12345678A', 'Admin', 'Admin', 'admin@admin.admin', 'admin', 2, '', '2016-11-17'),
(10, 'monitor', '11111111A', 'Moni', 'Moni', 'moni@moni.moni', 'monitor', 1, NULL, NULL),
(11, 'user', '22222222A', 'User', 'User', 'user@user.user', 'user', 0, NULL, NULL),
(12, 'newuser', '52469845E', 'newuser', 'newuser', 'newuser@newuser.com', '(+34) ', 0, '+34685214523', '1995-05-10');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Actividad`
--
ALTER TABLE `Actividad`
  ADD CONSTRAINT `monitor` FOREIGN KEY (`monitor`) REFERENCES `Monitor` (`id_entrenador`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `actividad_meta`
--
ALTER TABLE `actividad_meta`
  ADD CONSTRAINT `id_actividad_meta` FOREIGN KEY (`id_actividad_meta`) REFERENCES `Actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
  ADD CONSTRAINT `id_asistencia_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_asistencia_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Deportista`
--
ALTER TABLE `Deportista`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Monitor`
--
ALTER TABLE `Monitor`
  ADD CONSTRAINT `id_usuario_monitor` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Reserva`
--
ALTER TABLE `Reserva`
  ADD CONSTRAINT `id_actividad_reserva` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `Deportista` (`id_deportista`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Sesion`
--
ALTER TABLE `Sesion`
  ADD CONSTRAINT `id_actividad_sesion` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tabla_sesion` FOREIGN KEY (`id_tabla`) REFERENCES `Tabla_Ejercicios` (`id_tabla`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `id_usuario_sesion` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `Tabla_Ejercicios_Deportista`
--
ALTER TABLE `Tabla_Ejercicios_Deportista`
  ADD CONSTRAINT `id_tabla_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `Deportista` (`id_deportista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_tabla_ejercicios` FOREIGN KEY (`id_tabla`) REFERENCES `Tabla_Ejercicios` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Tabla_Ejercicios_Detalles`
--
ALTER TABLE `Tabla_Ejercicios_Detalles`
  ADD CONSTRAINT `id_ejercicio` FOREIGN KEY (`id_ejercicio`) REFERENCES `Ejercicio` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_tabla` FOREIGN KEY (`id_tabla`) REFERENCES `Tabla_Ejercicios` (`id_tabla`) ON DELETE CASCADE ON UPDATE CASCADE;

  CREATE USER 'infoFitness'@'localhost' IDENTIFIED BY 'infoFitness';
  GRANT ALL PRIVILEGES ON * . * TO 'infoFitness'@'localhost';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
