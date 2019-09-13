-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2019 a las 18:49:10
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `puntou_corporativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movil_to_chofer`
--

CREATE TABLE IF NOT EXISTS `movil_to_chofer` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `numero_movil` int(20) NOT NULL,
  `nombre_chofer` varchar(255) CHARACTER SET utf16 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movil_to_chofer`
--

INSERT INTO `movil_to_chofer` (`id`, `numero_movil`, `nombre_chofer`) VALUES
(1, 400, 'Escudero Julio Cesar'),
(2, 500, 'Pasquini Rafael Antonio'),
(3, 501, 'Gauna Fernando Marcelo'),
(4, 502, 'Conte, Cesar Hugo'),
(5, 502, 'Alvarez Daniel Esteban'),
(6, 504, 'Artazcoz Fernando Atilio'),
(7, 505, 'Robert, Juan Francisco'),
(8, 506, 'Gil, Emiliano'),
(9, 506, 'Chaparro, Cristian Roberto'),
(10, 507, 'Vago Ricardo Ruben'),
(11, 509, 'Roassio, Alberto Adrian'),
(12, 510, 'Araneda, Omar Alberto'),
(13, 510, 'Lopez Gustavo Ra?l'),
(14, 511, 'Gristman, Hugo Nestor'),
(15, 512, 'Ibargoyen, Sergio Andres'),
(16, 512, 'Serri, Ruben'),
(17, 513, 'Go?i Javier Nicolas'),
(18, 513, 'Amaya Rodolfo Luis'),
(19, 514, 'Moreno Eric Hernan'),
(20, 515, 'Grunewald, Gustavo'),
(21, 516, 'Serra, Sergio Fabian'),
(22, 517, 'Baioni, Juan Jose'),
(23, 518, 'Gallitrico Mauricio'),
(24, 519, 'Polak, Santiago Nicolas'),
(25, 519, 'Aramburu Ernesto Enrique'),
(26, 521, 'Stern, Juan Jose'),
(27, 522, 'Gomez, Oscar Ubaldo'),
(28, 523, 'Gonzalez, Facundo Nicolas'),
(29, 525, 'Falcon Federico Daniel'),
(30, 526, 'Marillan, Anibal'),
(31, 527, 'Valdes Saez, Richard Antonio'),
(32, 528, 'Mazzaferro,Guido Jose'),
(33, 528, 'Suarez Federico Javier'),
(34, 529, 'Castro, Maglio Alberto'),
(35, 530, 'Benedet, Maria Josefina'),
(36, 531, 'Gomez, Jose Luis'),
(37, 531, 'Burte Oscar Alfredo'),
(38, 532, 'Sanchez Juan Marcelo Emanuel'),
(39, 600, 'Franco, Carlos Augusto'),
(40, 601, 'Goycoechea, Javier Francisco'),
(41, 604, 'Ruppel Nestor Alejandro'),
(42, 604, 'Gimenez Juan Manuel'),
(43, 605, 'Casamayou Gustavo Alberto');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
