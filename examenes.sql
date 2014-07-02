-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2014 a las 06:54:15
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `examenes`
--
CREATE DATABASE examenes; 
USE examenes;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `idanswer` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '1',
  `question_idquestion` int(11) NOT NULL,
  PRIMARY KEY (`idanswer`),
  KEY `fk_answer_question_idx` (`question_idquestion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `idexam` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `showpreg` int(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idexam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_has_question`
--

CREATE TABLE IF NOT EXISTS `exam_has_question` (
  `exam_idexam` int(11) NOT NULL,
  `question_idquestion` int(11) NOT NULL,
  PRIMARY KEY (`exam_idexam`,`question_idquestion`),
  KEY `fk_exam_has_question_question1_idx` (`question_idquestion`),
  KEY `fk_exam_has_question_exam1_idx` (`exam_idexam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `idquestion` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `typequestion` int(1) DEFAULT NULL,
  PRIMARY KEY (`idquestion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `fk_answer_question` FOREIGN KEY (`question_idquestion`) REFERENCES `question` (`idquestion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `exam_has_question`
--
ALTER TABLE `exam_has_question`
  ADD CONSTRAINT `fk_exam_has_question_question1` FOREIGN KEY (`question_idquestion`) REFERENCES `question` (`idquestion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exam_has_question_exam1` FOREIGN KEY (`exam_idexam`) REFERENCES `exam` (`idexam`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
