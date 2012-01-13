-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-01-2012 a las 23:11:24
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `canea`
--
create database canea;
use canea;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `representante_id` int(10) unsigned NOT NULL DEFAULT '1',
  `nacionalidad` varchar(2) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fecha_n` date NOT NULL,
  `lugar_n` varchar(45) DEFAULT NULL,
  `observaciones` varchar(60) DEFAULT NULL,
  `retirado` varchar(2) NOT NULL DEFAULT 'No',
  `entidad_federal` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alumnos_FKIndex1` (`representante_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE IF NOT EXISTS `asignatura` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `abreviatura` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `descripcion`, `abreviatura`) VALUES
(1, 'Castellano', 'CA'),
(2, 'Ingles', 'IN'),
(3, 'Matematica', 'MA'),
(4, 'Estudios de la Naturaleza', 'EDN'),
(5, 'Historia de Venezuela', 'HV'),
(6, 'Educacion Familiar y Ciudadana', 'EFC'),
(7, 'Geografia General', 'GG'),
(8, 'Educacion Artistica', 'EA'),
(9, 'Educacion Fisica y Deportes', 'EFD'),
(10, 'Educacion para el Trabajo', 'EPT'),
(11, 'Educacion para la Salud', 'EPS'),
(12, 'Ciencias Biologicas', 'CB'),
(13, 'Historia Universal', 'HU'),
(14, 'Fisica', 'FI'),
(15, 'Quimica', 'QUI'),
(16, 'Catedra Bolivariana', 'CAB'),
(17, 'Geografia de Venezuela', 'GV'),
(18, 'Castellano y Literatura', 'CL'),
(19, 'Dibujo Tecnico', 'DT'),
(20, 'Psicologia', 'PSI'),
(21, 'Instruccion Premilitar', 'IP'),
(22, 'Ciencias de la Tierra', 'CDT'),
(23, 'Geografia economica de Venezuela', 'GEV'),
(24, 'Primer Grado', '1G'),
(25, 'Segundo Grado', '2G'),
(26, 'Tercer Grado', '3G'),
(27, 'Cuarto Grado', '4G'),
(28, 'Quinto Grado', '5G'),
(29, 'Sexto Grado', '6G'),
(30, 'Preescolar', 'PR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ca_entidades`
--

CREATE TABLE IF NOT EXISTS `ca_entidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `abreviatura` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `ca_entidades`
--

INSERT INTO `ca_entidades` (`id`, `nombre`, `abreviatura`) VALUES
(1, 'Zulia', 'ZU'),
(2, 'Miranda', 'MI'),
(3, 'Carabobo', 'CA'),
(4, 'Distrito Capital', 'DC'),
(5, 'Lara', 'LA'),
(6, 'Aragua', 'AR'),
(7, 'Bolivar', 'BO'),
(8, 'Anzoategui', 'AN'),
(9, 'Tachira', 'TA'),
(10, 'Sucre', 'SU'),
(11, 'Falcon', 'FA'),
(12, 'Portuguesa', 'PO'),
(13, 'Monagas', 'MO'),
(14, 'Merida', 'ME'),
(15, 'Barinas', 'BA'),
(16, 'Guarico', 'GU'),
(17, 'Trujillo', 'TR'),
(18, 'Yaracuy', 'YA'),
(19, 'Apure', 'AP'),
(20, 'Nueva Esparta', 'NE'),
(21, 'Vargas', 'VA'),
(22, 'Cojedes', 'CO'),
(23, 'Delta Amacuro', 'DA'),
(24, 'Amazonas', 'AM'),
(25, 'EXTRANJERO', 'EX');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ca_usuario`
--

CREATE TABLE IF NOT EXISTS `ca_usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ca_usuario`
--

INSERT INTO `ca_usuario` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `materia_id` int(10) unsigned NOT NULL,
  `semestre_id` int(10) unsigned NOT NULL,
  `maestro_id` int(10) unsigned NOT NULL,
  `seccion` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `curso_FKIndex1` (`maestro_id`),
  KEY `curso_FKIndex2` (`semestre_id`),
  KEY `curso_FKIndex3` (`materia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE IF NOT EXISTS `grado` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id`, `nombre`) VALUES
(1, '1° Grado'),
(2, '2° Grado'),
(3, '3° Grado'),
(4, '4° Grado'),
(5, '5° Grado'),
(6, '6° Grado'),
(7, '7° Grado'),
(8, '8° Grado'),
(9, '9° Grado'),
(10, '4° Año'),
(11, '5° Año'),
(12, 'Preescolar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE IF NOT EXISTS `maestro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nacionalidad` varchar(2) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`id`, `nacionalidad`, `cedula`, `nombre`, `apellidos`, `telefono`, `estado`) VALUES
(1, 'X-', 'X', 'MAESTRO', 'SIN', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asignatura_id` int(10) unsigned NOT NULL,
  `grado_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `materia_FKIndex1` (`grado_id`),
  KEY `materia_FKIndex2` (`asignatura_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id`, `asignatura_id`, `grado_id`) VALUES
(1, 1, 7),
(2, 2, 7),
(3, 3, 7),
(4, 4, 7),
(5, 5, 7),
(6, 6, 7),
(7, 7, 7),
(8, 8, 7),
(9, 9, 7),
(10, 10, 7),
(11, 1, 8),
(12, 2, 8),
(13, 3, 8),
(14, 11, 8),
(15, 12, 8),
(16, 5, 8),
(17, 13, 8),
(18, 8, 8),
(19, 9, 8),
(20, 10, 8),
(21, 1, 9),
(22, 2, 9),
(23, 3, 9),
(24, 12, 9),
(25, 14, 9),
(26, 15, 9),
(27, 16, 9),
(28, 17, 9),
(29, 9, 9),
(30, 10, 9),
(31, 18, 10),
(32, 3, 10),
(33, 5, 10),
(34, 2, 10),
(35, 9, 10),
(36, 14, 10),
(37, 15, 10),
(38, 12, 10),
(39, 20, 10),
(40, 21, 10),
(41, 2, 11),
(42, 9, 11),
(43, 23, 11),
(44, 18, 11),
(45, 3, 11),
(46, 14, 11),
(47, 15, 11),
(48, 12, 11),
(49, 22, 11),
(50, 21, 11),
(51, 19, 10),
(52, 24, 1),
(53, 25, 2),
(54, 26, 3),
(55, 27, 4),
(56, 28, 5),
(57, 29, 6),
(58, 30, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grado_id` int(10) unsigned NOT NULL,
  `alumno_id` int(10) unsigned NOT NULL,
  `semestre_id` int(10) unsigned NOT NULL,
  `seccion` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `semestre_alumno_FKIndex1` (`semestre_id`),
  KEY `semestre_alumno_FKIndex2` (`alumno_id`),
  KEY `semestre_alumno_FKIndex3` (`grado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matricula_id` int(10) unsigned NOT NULL,
  `materia_id` int(10) unsigned NOT NULL,
  `calificacion` varchar(4) DEFAULT NULL,
  `fecha_mes` varchar(20) DEFAULT NULL,
  `fecha_año` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nota_FKIndex1` (`materia_id`),
  KEY `nota_FKIndex3` (`matricula_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante`
--

CREATE TABLE IF NOT EXISTS `representante` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nacionalidad` varchar(2) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `representante`
--

INSERT INTO `representante` (`id`, `nacionalidad`, `cedula`, `nombre`, `apellidos`, `telefono`) VALUES
(1, 'X-', 'X', 'REPRESENTANTE', 'SIN', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE IF NOT EXISTS `semestre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `año_inicio` int(10) DEFAULT NULL,
  `mes_inicio` varchar(20) DEFAULT 'Septiembre',
  `año_fin` int(10) DEFAULT NULL,
  `mes_fin` varchar(20) DEFAULT 'Julio',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`representante_id`) REFERENCES `representante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`maestro_id`) REFERENCES `maestro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `curso_ibfk_3` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`grado_id`) REFERENCES `grado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `materia_ibfk_2` FOREIGN KEY (`asignatura_id`) REFERENCES `asignatura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `matricula_ibfk_3` FOREIGN KEY (`grado_id`) REFERENCES `grado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
