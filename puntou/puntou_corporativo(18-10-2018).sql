-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-10-2018 a las 10:47:03
-- Versión del servidor: 10.1.35-MariaDB-1~xenial
-- Versión de PHP: 7.0.32-0ubuntu0.16.04.1

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
-- Estructura de tabla para la tabla `addresses_saved`
--

CREATE TABLE `addresses_saved` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `type` int(11) UNSIGNED NOT NULL,
  `fModificacionUsuario` varchar(50) NOT NULL,
  `fModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) NOT NULL,
  `fCreacionUsuario` varchar(21) NOT NULL,
  `categories` enum('activo','borrado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `addresses_saved`
--

INSERT INTO `addresses_saved` (`id`, `id_users`, `address`, `type`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES
(1, 14, 'alem 869', 1, '', '2018-09-04 13:54:36', '2018-09-04 10:54:36', '14', 'activo'),
(2, 14, 'marcos mora 1362', 1, '', '2018-09-04 13:54:51', '2018-09-04 10:54:51', '14', 'activo'),
(3, 14, 'marcos mora 1362', 1, '', '2018-09-04 13:55:19', '2018-09-04 10:55:19', '14', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `address_type`
--

CREATE TABLE `address_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `fModificacionUsuario` varchar(50) NOT NULL,
  `fModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) NOT NULL,
  `fCreacionUsuario` varchar(21) NOT NULL,
  `categories` enum('activo','borrado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `address_type`
--

INSERT INTO `address_type` (`id`, `description`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES
(1, 'Casa', '', '2018-03-02 21:55:28', '', '', 'activo'),
(2, 'Trabajo', '', '2018-03-02 21:55:49', '', '', 'activo'),
(3, 'Otro', '', '2018-03-02 21:55:49', '', '', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_signatures`
--

CREATE TABLE `logs_signatures` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `id_travel_logs` int(11) UNSIGNED NOT NULL,
  `url_signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logs_signatures`
--

INSERT INTO `logs_signatures` (`id`, `id_users`, `id_travel_logs`, `url_signature`) VALUES
(0, 14, 1, '../signatures/14-0-signature.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

CREATE TABLE `notification` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `id_user` bigint(11) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` varchar(140) NOT NULL,
  `message_alt` varchar(140) DEFAULT NULL,
  `new` int(1) NOT NULL,
  `fModificacionUsuario` varchar(50) NOT NULL,
  `fModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) NOT NULL,
  `fCreacionUsuario` varchar(21) NOT NULL,
  `categories` enum('activo','borrado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recover`
--

CREATE TABLE `recover` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `id_user` bigint(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hash` varchar(64) NOT NULL,
  `claimed` int(1) NOT NULL DEFAULT '0',
  `claimed_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fModificacionUsuario` varchar(50) NOT NULL,
  `fModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) NOT NULL,
  `fCreacionUsuario` varchar(21) NOT NULL,
  `categories` enum('activo','borrado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recover`
--

INSERT INTO `recover` (`id`, `id_user`, `date`, `hash`, `claimed`, `claimed_date`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES
(1, 1, '2017-07-28 18:34:24', 'cc4cd4dcc9ca8be3f421e54d4f6dd524de95fe70e001889c62b8cbe11536a5e4', 0, '0000-00-00 00:00:00', '', '2017-07-28 23:34:24', '2017-07-28 20:34:24', '', 'activo'),
(2, 1, '2017-07-28 18:38:53', '046cecab3ce7af1baf6e996f3c70e81f6bd244662e7a2bc1e9c2266460655e9a', 0, '0000-00-00 00:00:00', '', '2017-07-28 23:38:53', '2017-07-28 20:38:53', '', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `review` int(11) UNSIGNED NOT NULL,
  `fModificacionUsuario` varchar(50) NOT NULL,
  `fModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) NOT NULL,
  `fCreacionUsuario` varchar(21) NOT NULL,
  `categories` enum('activo','borrado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `signatures`
--

CREATE TABLE `signatures` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_travel` int(11) DEFAULT NULL,
  `signature_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `travel_logs`
--

CREATE TABLE `travel_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `applicant` varchar(255) NOT NULL,
  `applicant_company` varchar(255) NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `alias_id` int(20) NOT NULL,
  `id_dac` int(11) UNSIGNED NOT NULL,
  `travel_date` date NOT NULL,
  `travel_time` time NOT NULL,
  `minutos_anticipacion` int(20) NOT NULL,
  `travel_type` tinyint(1) NOT NULL,
  `from_address` varchar(255) NOT NULL,
  `from_address_2` varchar(255) NOT NULL,
  `from_address_3` varchar(255) NOT NULL,
  `to_address` varchar(255) NOT NULL,
  `to_address_2` varchar(255) NOT NULL,
  `to_address_3` varchar(255) NOT NULL,
  `id_users_driver` varchar(20) NOT NULL,
  `amount` float UNSIGNED NOT NULL,
  `duration` float UNSIGNED NOT NULL,
  `observations` varchar(255) NOT NULL,
  `observations_2` varchar(255) NOT NULL,
  `observations_3` varchar(255) NOT NULL,
  `observations_general` text NOT NULL,
  `message` text NOT NULL,
  `status_dac` int(2) NOT NULL,
  `status` enum('reservado','agendado','en_progreso','completado','cancelado','inmediato') NOT NULL,
  `by_app` int(1) NOT NULL,
  `fModificacionUsuario` varchar(50) NOT NULL,
  `fModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) NOT NULL,
  `fCreacionUsuario` varchar(21) NOT NULL,
  `categories` enum('activo','borrado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `travel_logs`
--

INSERT INTO `travel_logs` (`id`, `applicant`, `applicant_company`, `id_users`, `alias_id`, `id_dac`, `travel_date`, `travel_time`, `minutos_anticipacion`, `travel_type`, `from_address`, `from_address_2`, `from_address_3`, `to_address`, `to_address_2`, `to_address_3`, `id_users_driver`, `amount`, `duration`, `observations`, `observations_2`, `observations_3`, `observations_general`, `message`, `status_dac`, `status`, `by_app`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `categories`) VALUES
(2, '-', 'None', 13, 0, 0, '2018-08-21', '15:32:00', 30, 0, 'X GRAL DANIEL CERRI ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE UNI SR RUBEN CALLE GURRUCHAGA 796', '-', 97, 'cancelado', 0, '6', '2018-08-21 18:33:01', '2018-08-21 15:32:47', '6', 'activo'),
(3, '-', 'None', 13, 1003016, 0, '2018-08-21', '15:32:00', 30, 0, 'X GRAL DANIEL CERRI ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE UNI SR RUBEN CALLE GURRUCHAGA 796', '-', 97, 'cancelado', 0, '6', '2018-08-21 18:34:01', '2018-08-21 15:33:37', '6', 'activo'),
(5, '-', 'None', 13, 1003016, 0, '2018-08-21', '20:00:00', 30, 0, 'X GRAL DANIEL CERRI ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE UNI SR RUBEN CALLE GURRUCHAGA 796', '-', 97, 'cancelado', 0, '6', '2018-08-23 14:39:33', '2018-08-21 19:22:25', '6', 'activo'),
(6, '-', 'None', 13, 502118, 0, '2018-08-22', '15:00:00', 30, 0, 'MARCOS MORA N*1362 ', '', '', '-', '', '', '0', 0, 0, '', '', '', 'CTA CTE?  - C/C UNI  MARTIN MIRO', '15HS', 97, 'cancelado', 0, '6', '2018-08-23 14:39:33', '2018-08-22 13:28:00', '6', 'activo'),
(7, '-', 'None', 13, 1003016, 0, '2018-08-22', '21:30:00', 30, 0, 'X GRAL DANIEL CERRI ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE UNI SR RUBEN CALLE GURRUCHAGA 796', 'PRUEBA', 97, 'cancelado', 0, '6', '2018-08-23 14:39:33', '2018-08-22 20:02:54', '6', 'activo'),
(8, '-', 'None', 13, 813131, 121, '2018-08-23', '16:00:00', 30, 0, 'HUMBOLDT N*375 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE UNI MARCELA', 'prueba ', 99, 'cancelado', 0, '6', '2018-09-04 19:21:58', '2018-08-23 11:31:33', '6', 'activo'),
(9, '-', 'None', 13, 879513, 0, '2018-08-23', '11:39:00', 0, 0, 'RINCON N*613 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C FUNBAPA SR FERNANDEZ', '-', 97, 'cancelado', 0, '6', '2018-08-23 14:41:32', '2018-08-23 11:41:06', '6', 'activo'),
(10, '-', 'None', 13, 879513, 0, '2018-08-23', '11:43:00', 0, 0, 'RINCON N*613 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C FUNBAPA SR FERNANDEZ', 'prueba', 97, 'cancelado', 0, '6', '2018-08-23 14:43:14', '2018-08-23 11:43:05', '6', 'activo'),
(11, '-', 'None', 13, 987029, 122, '2018-08-23', '11:45:00', 0, 0, 'MORENO N*45 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C CTE FUNBAPA SR FERNANDEZ', 'asd', 99, 'cancelado', 0, '6', '2018-09-04 19:21:55', '2018-08-23 11:43:49', '6', 'activo'),
(12, '-', 'None', 13, 564424, 0, '2018-08-23', '11:46:00', 30, 0, 'CASANOVA N*568 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C CTE SR PAVON MAXIMILIANO', 'para las 15.30hs y sale juan ', 97, 'cancelado', 0, '6', '2018-08-23 14:52:01', '2018-08-23 11:51:02', '6', 'activo'),
(13, '-', 'None', 13, 1084679, 123, '2018-08-24', '11:53:00', 30, 0, 'WAIKA N*585 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE UNIVERSITARIO  MARCELA', '-', 99, 'cancelado', 0, '6', '2018-09-04 19:21:52', '2018-08-23 12:01:42', '6', 'activo'),
(14, '-', 'None', 13, 0, 0, '2018-08-23', '19:18:00', 30, 0, 'GRAL PAZ N*95 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C DOW GONZALEZ MARTIN', 'prueba borrar', 97, 'cancelado', 0, '1', '2018-08-23 22:28:01', '2018-08-23 19:27:10', '1', 'activo'),
(15, '-', 'None', 13, 1101118, 0, '1969-12-31', '00:00:00', 0, 0, 'ROCA N*1747 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C DOW SR GUSTAVO GONZALES', 'adsfasfa', 97, 'cancelado', 0, '1', '2018-08-23 22:29:01', '2018-08-23 19:28:16', '1', 'activo'),
(16, '', '', 0, 0, 0, '0000-00-00', '00:00:00', 0, 0, '', '', '', '', '', '', '0', 0, 0, '', '', '', '', '', 97, 'cancelado', 0, '', '2018-08-27 18:11:01', '', '', 'activo'),
(17, '', '', 0, 0, 0, '0000-00-00', '00:00:00', 0, 0, '', '', '', '', '', '', '0', 0, 0, '', '', '', '', '', 97, 'cancelado', 0, '', '2018-08-27 19:11:01', '', '', 'activo'),
(18, '', '', 14, 0, 0, '2018-08-27', '16:53:00', 0, 0, 'Alem 869', '', '', 'Alem 869', '', '', '0', 0, 0, '', '', '', '', 'Prueba', 96, 'agendado', 0, '14', '2018-08-27 19:53:44', '2018-08-27 16:53:44', '14', 'activo'),
(19, '', '', 14, 0, 0, '2018-08-28', '11:40:00', 0, 0, 'Salta 523', '', '', 'Alem 869', '', '', '0', 0, 0, '', '', '', '', 'Prueba', 96, 'agendado', 0, '14', '2018-08-28 14:40:03', '2018-08-28 11:40:03', '14', 'activo'),
(20, '', '', 14, 0, 0, '2018-08-28', '17:08:00', 0, 0, 'Salta 523', '', '', 'Alem 865', '', '', '0', 0, 0, '', '', '', '', 'Prueba', 96, 'agendado', 0, '14', '2018-08-28 20:08:07', '2018-08-28 17:08:07', '14', 'activo'),
(21, '-', 'None', 14, 614057, 127, '2018-08-29', '17:00:00', 30, 0, 'PILCANIYEN N*1373 ', '', '', '-', '', '', '0', 0, 0, '', '', '', 'CTA CTE?  - C/C UNI MARTIN CASA 72 BO LOS TAXISTAS', 'prueba', 99, 'cancelado', 0, '6', '2018-09-04 19:21:49', '2018-08-29 10:27:59', '6', 'activo'),
(22, '-', 'None', 14, 9413, 126, '2018-08-30', '05:45:00', 15, 0, 'ALVAREZ JONTE N*1764 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE UNI MAURO', 'prueba', 99, 'cancelado', 0, '6', '2018-09-04 19:21:46', '2018-08-29 10:28:53', '6', 'activo'),
(23, '-', 'None', 14, 1136991, 0, '2018-08-29', '10:41:00', 0, 0, 'X IREL ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C LA SEGUNDA ART BARRIENTOS', '-', 97, 'cancelado', 0, '6', '2018-08-29 13:43:01', '2018-08-29 10:41:54', '6', 'activo'),
(24, '-', 'None', 14, 1136991, 0, '2018-08-29', '10:43:00', 0, 0, 'X IREL ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C LA SEGUNDA ART BARRIENTOS', '-', 97, 'cancelado', 0, '6', '2018-08-29 13:46:01', '2018-08-29 10:43:38', '6', 'activo'),
(25, '-', 'None', 14, 1136991, 0, '2018-08-29', '10:46:00', 0, 0, 'X IREL ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C LA SEGUNDA ART BARRIENTOS', '-', 97, 'cancelado', 0, '6', '2018-08-29 13:47:01', '2018-08-29 10:46:12', '6', 'activo'),
(26, '-', 'None', 14, 1003620, 0, '2018-08-29', '11:17:00', 0, 0, 'GARIBALDI N*277 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C CTE TGS SR FUENTES', '-', 97, 'cancelado', 0, '6', '2018-08-29 14:19:01', '2018-08-29 11:17:35', '6', 'activo'),
(27, '-', 'None', 14, 1169944, 0, '2018-08-29', '11:26:00', 0, 0, 'FUERTE ARGENTINO N*7 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE LA 2DA ART SANHUEZA', '-', 97, 'cancelado', 0, '6', '2018-08-29 14:29:01', '2018-08-29 11:26:40', '6', 'activo'),
(28, '-', 'None', 14, 49193, 0, '2018-08-29', '11:27:00', 0, 0, '19 DE MAYO N*370 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C TGS SR ABERASTURI SOLICITA MANEJAR DESPACIO', '-', 97, 'cancelado', 0, '6', '2018-08-29 14:28:01', '2018-08-29 11:27:14', '6', 'activo'),
(29, '-', 'None', 14, 1054534, 0, '2018-08-29', '00:14:15', 30, 0, 'X DOW ETILENO I (SAN MARTIN 1881) ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C DOW', '14:15HS TAMBORINDEGUY', 97, 'cancelado', 0, '6', '2018-08-29 18:28:16', '2018-08-29 11:38:58', '6', 'activo'),
(30, '-', 'None', 14, 1054534, 128, '2018-08-29', '14:15:00', 30, 0, 'X DOW ETILENO I (SAN MARTIN 1881) ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C DOW', '14:15HS TAMBORINDEGUY', 99, 'cancelado', 0, '6', '2018-09-04 19:21:43', '2018-08-29 11:39:49', '6', 'activo'),
(31, '-', 'None', 14, 1138937, 0, '2018-09-04', '11:15:00', 5, 0, 'X DOW CTRO CAPACITACION (SAN MARTIN 1800) ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - PARTICULAR', 'viaje de prueba', 99, 'cancelado', 0, '6', '2018-09-03 14:02:01', '2018-09-03 11:01:14', '6', 'activo'),
(32, '-', 'None', 14, 285732, 0, '2018-09-03', '11:57:00', 0, 0, 'ALEM N*869 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - CTA CTE UNI MARCELA', 'VIAJE DE PRUEBA ', 96, 'agendado', 0, '6', '2018-09-03 14:57:56', '2018-09-03 11:57:56', '6', 'activo'),
(33, '-', 'None', 14, 1045888, 0, '2018-09-03', '12:11:00', 0, 0, 'ROSALES N*950 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C DOW GONZALEZ G. PRUEBA', 'PRUEBA', 96, 'agendado', 0, '1', '2018-09-03 15:11:09', '2018-09-03 12:11:09', '1', 'activo'),
(34, '-', 'None', 14, 1159474, 0, '2018-09-03', '12:12:00', 0, 0, 'PIEDRA BUENA N*1235 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C DOW GONZALEZ LUIS EDUARDO PRUEBA', 'PRUEBA', 96, 'agendado', 0, '1', '2018-09-03 15:12:18', '2018-09-03 12:12:18', '1', 'activo'),
(35, '-', 'None', 14, 1045888, 0, '2018-09-03', '12:16:00', 0, 0, 'ROSALES N*950 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C DOW GONZALEZ G. PRUEBA', 'PRUEBA', 96, 'agendado', 0, '1', '2018-09-03 15:16:13', '2018-09-03 12:16:13', '1', 'activo'),
(36, '-', 'None', 14, 1159474, 0, '2018-09-03', '12:22:00', 0, 0, 'PIEDRA BUENA N*1235 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C DOW GONZALEZ LUIS EDUARDO PRUEBA', 'PRUEBA', 96, 'agendado', 0, '1', '2018-09-03 15:22:24', '2018-09-03 12:22:24', '1', 'activo'),
(37, '-', 'None', 14, 1045888, 0, '2018-09-03', '12:27:00', 0, 0, 'ROSALES N*950 ', '', '', '-', '', '', '0', 0, 0, '', '', '', 'PRUEBA', 'PRUEBA', 96, 'en_progreso', 0, '1', '2018-09-03 15:27:25', '2018-09-03 12:27:19', '1', 'activo'),
(38, '-', 'None', 14, 0, 0, '2018-09-03', '12:36:00', 0, 0, '-', '', '', '-', '', '', '0', 0, 0, '', '', '', 'KINDERKNECHT MAS 2', '-', 99, 'cancelado', 0, '6', '2018-09-03 15:38:26', '2018-09-03 12:36:36', '6', 'activo'),
(39, '-', 'None', 14, 0, 0, '2018-09-03', '14:30:00', 30, 0, '-', '', '', '-', '', '', '0', 0, 0, '', '', '', 'PRUEBA ', '-', 99, 'cancelado', 0, '6', '2018-09-03 16:18:01', '2018-09-03 13:17:38', '6', 'activo'),
(40, '-', 'None', 14, 1138937, 0, '2018-09-03', '13:18:00', 30, 0, 'X DOW CTRO CAPACITACION (SAN MARTIN 1800) ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - PARTICULAR', 'viaje prueba', 99, 'cancelado', 0, '6', '2018-09-03 16:19:01', '2018-09-03 13:18:41', '6', 'activo'),
(41, '', '', 14, 0, 0, '2018-09-03', '14:24:00', 0, 0, 'Salta 523', '', '', 'Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA', 96, 'en_progreso', 0, '14', '2018-09-03 17:24:48', '2018-09-03 14:24:43', '14', 'activo'),
(42, '-', 'None', 14, 1163785, 0, '2018-09-04', '10:47:00', 0, 0, 'FUERTE ARGENTINO N*7 ', '', '', '-', '', '', '0', 0, 0, '', '', '', ' - C/C LA 2DA ART SOTO', '-', 96, 'en_progreso', 0, '6', '2018-09-04 13:47:09', '2018-09-04 10:47:03', '6', 'activo'),
(43, '-', 'None', 14, 308905, 0, '2018-09-04', '10:47:00', 0, 0, 'X TERMINAL B.BCA (T.B.B) ', '', '', '-', '', '', '0', 0, 0, '', '', '', 'SOBRE EL PUENTE LA NIÑA - XTUESER VAGONES C/C CAMARA DE CEREALES SR JOSE', '-', 96, 'en_progreso', 0, '6', '2018-09-04 13:48:01', '2018-09-04 10:47:55', '6', 'activo'),
(44, '-', 'None', 14, 1132949, 0, '2018-09-04', '11:17:00', 0, 0, 'X GUARDIA PRIVADO SUR (SOLER 265) ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C LA SEGUNDA ART CRISOSTOMO', '-', 99, 'cancelado', 0, '6', '2018-09-04 19:21:40', '2018-09-04 11:17:07', '6', 'activo'),
(45, '-', 'None', 14, 1054534, 134, '2018-09-04', '14:30:00', 30, 0, 'X DOW ETILENO I (SAN MARTIN 1881) ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW', 'MENGONI', 99, 'cancelado', 0, '6', '2018-09-04 19:21:37', '2018-09-04 11:29:54', '6', 'activo'),
(46, '-', 'None', 14, 1136991, 0, '2018-09-04', '11:31:00', 30, 0, 'X IREL ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C LA SEGUNDA ART BARRIENTOS', '-', 99, 'cancelado', 0, '6', '2018-09-04 14:43:04', '2018-09-04 11:42:21', '6', 'activo'),
(47, '-', 'None', 14, 1136991, 0, '2018-09-04', '11:42:00', 0, 0, 'X IREL ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C LA SEGUNDA ART BARRIENTOS', '-', 99, 'cancelado', 0, '6', '2018-09-04 19:21:34', '2018-09-04 11:42:48', '6', 'activo'),
(48, '-', 'None', 14, 1054534, 136, '2018-09-04', '15:50:00', 30, 0, 'X DOW ETILENO I (SAN MARTIN 1881) ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW', '15:50HS ROSALES ', 99, 'cancelado', 0, '6', '2018-09-04 19:21:31', '2018-09-04 11:46:12', '6', 'activo'),
(49, '-', 'None', 14, 0, 0, '2018-09-04', '11:57:00', 0, 0, '3', '', '', '-', '', '', '-1', 0, 0, '', '', '', '-', '-', 99, 'cancelado', 0, '6', '2018-09-04 15:00:01', '2018-09-04 11:57:59', '6', 'activo'),
(50, '-', 'None', 14, 532790, 0, '2018-09-04', '12:04:00', 0, 0, 'ALEM N*869 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C CONICET SR FABIAN', '-', 99, 'cancelado', 0, '6', '2018-09-04 19:21:28', '2018-09-04 12:04:09', '6', 'activo'),
(51, '-', 'None', 14, 155483, 0, '2018-09-04', '12:04:00', 30, 0, 'SAAVEDRA N*636 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C CAMARA CEREALES JOSE_ SCHLAP', '-', 99, 'cancelado', 0, '6', '2018-09-04 15:07:05', '2018-09-04 12:06:03', '6', 'activo'),
(52, '-', 'None', 14, 155483, 0, '2018-09-04', '12:06:00', 0, 0, 'SAAVEDRA N*636 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C CAMARA CEREALES JOSE_ SCHLAP', '-', 99, 'cancelado', 0, '6', '2018-09-04 19:21:25', '2018-09-04 12:06:31', '6', 'activo'),
(53, '-', 'None', 14, 502118, 139, '2018-09-04', '14:30:00', 30, 0, 'MARCOS MORA N*1362 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', 'CTA CTE?  - C/C UNI  MARTIN MIRO', '14.30HS VIAJE DE PRUEBA ', 99, 'cancelado', 0, '6', '2018-09-04 19:21:22', '2018-09-04 12:37:34', '6', 'activo'),
(54, '-', 'None', 14, 758777, 0, '2018-09-04', '12:42:00', 0, 0, 'FUERTE ARGENTINO N*7 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C LA 2DA ART SR SANHUEZA ', '-', 99, 'cancelado', 0, '6', '2018-09-04 19:21:19', '2018-09-04 12:42:45', '6', 'activo'),
(55, '-', 'None', 14, 1054534, 142, '2018-09-04', '14:10:00', 30, 0, 'X DOW ETILENO I (SAN MARTIN 1881) ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW', '14:10HS PIÑEIRO', 99, 'cancelado', 0, '6', '2018-09-04 19:21:16', '2018-09-04 12:44:35', '6', 'activo'),
(56, '-', 'None', 14, 1065196, 141, '2018-09-04', '16:30:00', 30, 0, 'BERUTI N*293 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW PIÑEIRO ROCIO', '16:30HS ', 99, 'cancelado', 0, '6', '2018-09-04 19:21:13', '2018-09-04 12:45:35', '6', 'activo'),
(57, '-', 'None', 14, 1172487, 143, '2018-09-04', '17:45:00', 30, 0, 'CONSENTINO MARIA LUISA N*2105 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - CTA CTE RBB VAZQUEZ', '17:45HS COD 149', 99, 'cancelado', 1, '6', '2018-09-04 19:21:10', '2018-09-04 12:54:14', '6', 'activo'),
(58, '', '', 14, 0, 0, '2018-09-04', '13:18:00', 0, 0, ' alem 869', '', '', 'aeropuerto', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA', 99, 'cancelado', 1, '14', '2018-09-04 19:21:07', '2018-09-04 13:18:13', '14', 'activo'),
(59, '-', 'None', 14, 1045690, 145, '2018-09-04', '17:00:00', 30, 0, 'X DOW HDPE Ó PEADE (SAN MARTIN 1881) ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW', '17HS IACARUSO', 99, 'cancelado', 1, '6', '2018-09-04 19:21:04', '2018-09-04 13:22:53', '6', 'activo'),
(60, '-', 'None', 6, 41108, 0, '2018-09-05', '10:58:00', 0, 0, 'X IREL ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - X ALEM CCTE 2DA SR SOTO', '-', 99, 'cancelado', 0, '6', '2018-09-05 13:59:04', '2018-09-05 10:58:14', '6', 'activo'),
(61, '-', 'None', 6, 2737, 0, '2018-09-06', '08:43:00', 0, 0, 'X T.G.S. CERRI ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C T.G.S', 'FUENTE ', 96, 'agendado', 0, '6', '2018-09-06 11:43:55', '2018-09-06 08:43:55', '6', 'activo'),
(62, '', '', 15, 0, 0, '2018-09-06', '08:45:00', 0, 0, 'Av. Alem 869', '', '', '', '', '', '0', 0, 0, '', '', '', '', 'c/cte universitario Martin Miro', 96, 'agendado', 1, '15', '2018-09-06 11:45:31', '2018-09-06 08:45:31', '15', 'activo'),
(63, '-', 'None', 6, 1047634, 149, '2018-09-06', '14:30:00', 30, 0, 'CHICLANA N*453 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW LUPPO PAMELA', '14:30HS ', 97, 'reservado', 0, '6', '2018-10-03 13:32:45', '2018-09-06 09:27:45', '6', 'activo'),
(64, '-', 'None', 6, 48974, 150, '2018-09-06', '13:05:00', 30, 0, 'X AEROPUERTO ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C CTE  C/CARTEL A SU NOMBRE', '13:05HS ALEJANDRA BRASESCO AR 2644', 97, 'reservado', 0, '6', '2018-10-03 13:32:41', '2018-09-06 09:29:54', '6', 'activo'),
(65, '-', 'None', 6, 2737, 0, '2018-09-06', '09:35:00', 0, 0, 'X T.G.S. CERRI ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C T.G.S', 'LUQUE', 96, 'agendado', 0, '6', '2018-09-06 12:35:09', '2018-09-06 09:35:09', '6', 'activo'),
(66, '-', 'None', 6, 2737, 0, '2018-09-06', '09:46:00', 0, 0, 'X T.G.S. CERRI ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C T.G.S', '10HS FERREIRA HACE RECORRIDO ', 96, 'agendado', 0, '6', '2018-09-06 12:46:10', '2018-09-06 09:46:10', '6', 'activo'),
(67, '-', 'None', 6, 2737, 0, '2018-09-06', '10:43:00', 0, 0, 'X T.G.S. CERRI ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C T.G.S', '11HS PABLO GOMEZ', 96, 'agendado', 0, '6', '2018-09-06 13:43:54', '2018-09-06 10:43:54', '6', 'activo'),
(68, '-', 'None', 6, 502118, 154, '2018-09-06', '15:00:00', 30, 0, 'MARCOS MORA N*1362 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', 'CTA CTE?  - C/C UNI  MARTIN MIRO', '-', 97, 'reservado', 0, '6', '2018-10-03 13:32:36', '2018-09-06 11:18:59', '6', 'activo'),
(69, '', '', 15, 0, 0, '2018-09-06', '11:20:00', 0, 0, 'Av. Alem 869', '', '', '', '', '', '0', 0, 0, '', '', '', '', 'c/cte universitario Martin Miro', 96, 'agendado', 1, '15', '2018-09-06 14:20:19', '2018-09-06 11:20:19', '15', 'activo'),
(70, '', '', 15, 0, 0, '2018-09-06', '11:22:00', 0, 0, 'Av. Alem 869', '', '', 'al centro ', '', '', '0', 0, 0, '', '', '', '', 'c/cte universitario Martin Miro', 96, 'agendado', 1, '15', '2018-09-06 14:22:48', '2018-09-06 11:22:48', '15', 'activo'),
(71, '-', 'None', 6, 1045740, 157, '2018-09-07', '09:30:00', 30, 0, 'KARAKACHOFF SERGIO N*912 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW SR GOYANARTE IÑAKI', '9:30HS SALE TORTI', 97, 'reservado', 0, '6', '2018-10-03 13:32:29', '2018-09-07 08:03:23', '6', 'activo'),
(72, '-', 'None', 6, 1045688, 160, '2018-09-07', '13:00:00', 30, 0, 'X DOW LDPE (18 DE JULIO 1881) ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW', '13HS LOPEZ', 97, 'reservado', 0, '6', '2018-10-03 13:32:25', '2018-09-07 08:04:26', '6', 'activo'),
(73, '-', 'None', 6, 1045892, 159, '2018-09-07', '13:05:00', 30, 0, 'X AEROPUERTO ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW C/ CARTEL', '13:05HS RODRIGUEZ VIDAL', 97, 'reservado', 0, '6', '2018-10-03 13:32:21', '2018-09-07 08:05:17', '6', 'activo'),
(74, '-', 'None', 6, 1067961, 158, '2018-09-07', '13:30:00', 30, 0, 'VIEYTES N*1219 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW GIROTTI CESAR OMAR', '13:30HS SALE DIESER ', 97, 'reservado', 0, '6', '2018-10-03 13:32:14', '2018-09-07 08:06:05', '6', 'activo'),
(75, '', '', 15, 0, 0, '2018-09-07', '11:26:00', 0, 0, 'Av. Alem 869', '', '', '', '', '', '0', 0, 0, '', '', '', '', 'c/cte universitario Martin Miro', 97, 'cancelado', 1, '15', '2018-09-07 14:30:01', '2018-09-07 11:26:28', '15', 'activo'),
(76, '', '', 14, 0, 0, '2018-09-07', '11:35:00', 0, 0, ' alem 869', '', '', 'Alem 869', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA', 96, 'agendado', 1, '14', '2018-09-07 14:35:40', '2018-09-07 11:35:40', '14', 'activo'),
(77, '', '', 1, 0, 0, '2018-09-11', '10:50:00', 0, 0, 'Salta 545', '', '', 'Alem 865', '', '', '0', 0, 0, '', '', '', '', '', 96, 'agendado', 1, '1', '2018-09-11 13:50:49', '2018-09-11 10:50:49', '1', 'activo'),
(78, '-', 'None', 1, 1144549, 0, '2018-09-19', '14:19:00', 30, 0, 'CATAMARCA N*1191 ', '', '', '-', '', '', '-1', 0, 0, '', '', '', ' - C/C DOW GONZALEZ ELIAS prueba', 'prueba', 97, 'cancelado', 0, '1', '2018-09-19 17:22:01', '2018-09-19 14:21:30', '1', 'activo'),
(80, '', '', 14, 0, 0, '2018-10-03', '13:01:00', 0, 0, 'Salta 523', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-03 16:01:37', '2018-10-03 13:01:37', '14', 'activo'),
(81, '', '', 14, 0, 0, '2018-10-03', '13:23:00', 0, 0, 'Salta 523', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-03 16:23:26', '2018-10-03 13:23:26', '14', 'activo'),
(82, '', '', 14, 0, 0, '2018-10-03', '13:23:00', 0, 0, 'Salta 545', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-03 16:23:58', '2018-10-03 13:23:58', '14', 'activo'),
(83, '', '', 14, 0, 0, '2018-10-03', '14:01:00', 0, 0, 'Salta 523', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-03 17:01:59', '2018-10-03 14:01:59', '14', 'activo'),
(84, '', '', 14, 0, 0, '2018-10-03', '14:03:00', 0, 0, 'Salta 523', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-03 17:03:19', '2018-10-03 14:03:19', '14', 'activo'),
(85, '', '', 14, 0, 0, '2018-10-03', '14:12:00', 0, 0, 'Salta 523', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-03 17:12:29', '2018-10-03 14:12:29', '14', 'activo'),
(86, '', '', 14, 0, 0, '2018-10-03', '14:14:00', 0, 0, 'Av. Alem 1089', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-03 17:14:11', '2018-10-03 14:14:11', '14', 'activo'),
(87, '', '', 14, 0, 0, '2018-10-05', '12:07:00', 0, 0, 'Salta 545', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-05 15:07:02', '2018-10-05 12:07:02', '14', 'activo'),
(88, '', '', 14, 0, 0, '2018-10-05', '12:12:00', 0, 0, 'Güemes 600', '', '', 'Av. Alem 865', '', '', '0', 0, 0, '', '', '', '', 'PRUEBA ..viaje de prueba..', 96, 'agendado', 1, '14', '2018-10-05 15:12:11', '2018-10-05 12:12:11', '14', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(70) NOT NULL,
  `id_users_master` int(10) DEFAULT NULL,
  `is_driver` int(1) NOT NULL DEFAULT '0',
  `mensaje_pred` varchar(55) NOT NULL,
  `fModificacionUsuario` varchar(50) NOT NULL,
  `fModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) NOT NULL,
  `fCreacionUsuario` varchar(21) NOT NULL,
  `tipo` enum('user','admin','banned') NOT NULL DEFAULT 'user',
  `categories` enum('activo','borrado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `email`, `id_users_master`, `is_driver`, `mensaje_pred`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `tipo`, `categories`) VALUES
(1, 'Matias Lopez', 'bassdx', 'd4e1df81be77aea2d4755ffc30585d8f7f3037b9', 'bassdx@gmail.com', NULL, 0, '', '', '2018-07-31 18:07:56', '2017-07-27 19:20:45', '', 'admin', 'activo'),
(6, 'Nexo Smart', 'nexosmart', 'd4e1df81be77aea2d4755ffc30585d8f7f3037b9', 'nexosmart@gmail.com', NULL, 0, '', '', '2018-07-31 18:47:53', '2017-07-27 19:20:45', '', 'admin', 'activo'),
(7, 'Administrador', 'administrador', '863e4c910f9475843bcddb4bfc66fadf512a951b', 'administrador1@gmail.com', NULL, 0, '', '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'admin', 'activo'),
(8, 'Operador 1', 'operador1', '873ee77dbbc99fb8a99adeb6acd1bad5bfdd7dc7', 'operador1@gmail.com', NULL, 0, '', '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'user', 'activo'),
(9, 'Operador 2', 'operador2', 'd44f94515b3eb7a3d438ad56c2cc31267e3c7658', 'operador2@gmail.com', NULL, 0, '', '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'user', 'activo'),
(10, 'Operador 3', 'operador3', 'c410ba66984c3150052c65739aef6ae4bbc3ff0b', 'operador3@gmail.com', NULL, 0, '', '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'user', 'activo'),
(11, 'Operador 4', 'operador4', '6cae66da30a03f46c8b7ed4cda0d09e1677e1e2a', 'operador4@gmail.com', NULL, 0, '', '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'user', 'activo'),
(12, 'Operador 5', 'operador5', 'dd63e900f60a53c0c816477ecaad80ee702e5255', 'operador5@gmail.com', NULL, 0, '', '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'user', 'activo'),
(13, 'Operador 6', 'operador6', '85a35051ab39fea5ea40439ab239038c16b3c49b', 'operador6@gmail.com', NULL, 0, '', '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'user', 'activo'),
(14, 'Martin Miro', 'remis', 'b1a7a132738d61aed591be384ce55dcf2f9df316', 'remis@universitario.com', NULL, 0, 'PRUEBA ..viaje de prueba..', '', '2018-10-03 15:28:01', '', '', 'user', 'activo'),
(15, 'Martin Miro', 'martinmiro', 'df788bb89341fb36b13cf55a5c6509b222386100', 'remis@universitario.com', NULL, 0, 'c/cte universitario Martin Miro', '', '2018-09-03 17:23:18', '', '', 'user', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `addresses_saved`
--
ALTER TABLE `addresses_saved`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `address_type`
--
ALTER TABLE `address_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs_signatures`
--
ALTER TABLE `logs_signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `recover`
--
ALTER TABLE `recover`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `travel_logs`
--
ALTER TABLE `travel_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `addresses_saved`
--
ALTER TABLE `addresses_saved`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `address_type`
--
ALTER TABLE `address_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recover`
--
ALTER TABLE `recover`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `travel_logs`
--
ALTER TABLE `travel_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
