-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-04-2018 a las 10:52:50
-- Versión del servidor: 10.1.32-MariaDB-1~xenial
-- Versión de PHP: 7.0.28-0ubuntu0.16.04.1

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
CREATE DATABASE IF NOT EXISTS `puntou_corporativo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `puntou_corporativo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `addresses_saved`
--

DROP TABLE IF EXISTS `addresses_saved`;
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `address_type`
--

DROP TABLE IF EXISTS `address_type`;
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

DROP TABLE IF EXISTS `logs_signatures`;
CREATE TABLE `logs_signatures` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `id_travel_logs` int(11) UNSIGNED NOT NULL,
  `url_signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

DROP TABLE IF EXISTS `notification`;
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

DROP TABLE IF EXISTS `recover`;
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

DROP TABLE IF EXISTS `reviews`;
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
-- Estructura de tabla para la tabla `travel_logs`
--

DROP TABLE IF EXISTS `travel_logs`;
CREATE TABLE `travel_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `applicant` varchar(255) NOT NULL,
  `applicant_company` varchar(255) NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `id_dac` int(11) UNSIGNED NOT NULL,
  `travel_date` date NOT NULL,
  `travel_time` time NOT NULL,
  `travel_type` tinyint(1) NOT NULL,
  `from_address` varchar(255) NOT NULL,
  `from_address_2` varchar(255) NOT NULL,
  `from_address_3` varchar(255) NOT NULL,
  `to_address` varchar(255) NOT NULL,
  `to_address_2` varchar(255) NOT NULL,
  `to_address_3` varchar(255) NOT NULL,
  `id_users_driver` int(11) UNSIGNED NOT NULL,
  `amount` float UNSIGNED NOT NULL,
  `duration` float UNSIGNED NOT NULL,
  `observations` varchar(255) NOT NULL,
  `observations_2` varchar(255) NOT NULL,
  `observations_3` varchar(255) NOT NULL,
  `status_dac` int(2) NOT NULL,
  `status` enum('reservado','agendado','en_progreso','completado','cancelado') NOT NULL,
  `fModificacionUsuario` varchar(50) NOT NULL,
  `fModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) NOT NULL,
  `fCreacionUsuario` varchar(21) NOT NULL,
  `categories` enum('activo','borrado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(70) NOT NULL,
  `id_users_master` int(10) DEFAULT NULL,
  `is_driver` int(1) NOT NULL DEFAULT '0',
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

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `email`, `id_users_master`, `is_driver`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `tipo`, `categories`) VALUES
(1, 'Matias Lopez', 'bassdx', 'd4e1df81be77aea2d4755ffc30585d8f7f3037b9', 'bassdx@gmail.com', NULL, 0, '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'user', 'activo'),
(6, 'Nexo Smart', 'nexosmart', 'd4e1df81be77aea2d4755ffc30585d8f7f3037b9', 'nexosmart@gmail.com', NULL, 0, '', '2018-02-28 19:35:54', '2017-07-27 19:20:45', '', 'user', 'activo');

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
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `travel_logs`
--
ALTER TABLE `travel_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
