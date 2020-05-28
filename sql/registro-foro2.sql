-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-04-2015 a las 10:14:48
-- Versión del servidor: 5.5.35
-- Versión de PHP: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `registro-foro2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro2`
--

DROP TABLE IF EXISTS `registro2`;
CREATE TABLE IF NOT EXISTS `registro2` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` int(10) NOT NULL,
  `nombres` varchar(100) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_bin NOT NULL,
  `tipo_asistente` varchar(50) COLLATE utf8_bin NOT NULL,
  `asistencia` varchar(50) COLLATE utf8_bin NOT NULL,
  `com_institucion` varchar(100) COLLATE utf8_bin NOT NULL,
  `ponencia` varchar(300) COLLATE utf8_bin NOT NULL,
  `correo` varchar(100) COLLATE utf8_bin NOT NULL,
  `dias` varchar(3) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=362 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
