/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `upaqv3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `upaqv3`;

CREATE TABLE IF NOT EXISTS `dow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_solicitante` varchar(255) DEFAULT '0',
  `solicitante` varchar(255) DEFAULT '0',
  `tipo` varchar(255) DEFAULT '0',
  `aprobador` varchar(255) DEFAULT '0',
  `prioridad` enum('baja','normal','alta') NOT NULL DEFAULT 'normal',
  `proveedor` varchar(255) DEFAULT '0',
  `origen` varchar(255) DEFAULT '0',
  `destino` varchar(255) DEFAULT '0',
  `lat_origen` varchar(250) DEFAULT '0',
  `long_origen` varchar(250) DEFAULT '0',
  `lat_destino` varchar(250) DEFAULT '0',
  `long_destino` varchar(250) DEFAULT '0',
  `contacto` varchar(255) DEFAULT '0',
  `detalle` varchar(255) DEFAULT '0',
  `cadete` varchar(50) DEFAULT '0',
  `status` enum('sin_iniciar','aceptado','buscando','entregando','completado') DEFAULT 'sin_iniciar',
  `fModificacionUsuario` varchar(50) DEFAULT NULL,
  `fModificacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) DEFAULT NULL,
  `fCreacionUsuario` varchar(21) DEFAULT NULL,
  `active` enum('y','n') DEFAULT 'y',
  `mode` enum('upaq','dow') DEFAULT 'dow',
  `validado` enum('y','n') DEFAULT 'n',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='tabla para uso de upaq con DOWN';

/*!40000 ALTER TABLE `dow` DISABLE KEYS */;
INSERT INTO `dow` (`id`, `n_solicitante`, `solicitante`, `tipo`, `aprobador`, `prioridad`, `proveedor`, `origen`, `destino`, `lat_origen`, `long_origen`, `lat_destino`, `long_destino`, `contacto`, `detalle`, `cadete`, `status`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `active`, `mode`, `validado`) VALUES
	(1, '0001', 'juan lopez', 'busqueda de materiales', 'lorena mirez', 'normal', 'mariano perez', 'alem 1234456', 'mitre 123', '-38.7046006', '-62.2685946', '-38.7061001', '-38.7061001', '2915151456', 'lalal alala mi vieja mula ya no es lo que era', '1', 'sin_iniciar', NULL, '2019-03-29 13:57:57', NULL, NULL, 'y', 'dow', 'n'),
	(12, '0001', 'juan lopez', 'busqueda de materiales', 'lorena mirez', 'normal', 'mariano perez', 'alem 1234', 'mitre 123', '0', '0', '0', '0', '2915151456', 'lalal alala mi vieja mula ya no es lo que era', '8', 'buscando', '1', '2019-04-01 16:14:14', NULL, NULL, 'n', 'dow', 'y'),
	(11, '0001', 'juan lopez', 'busqueda de materiales', 'lorena mirez', 'normal', 'mariano perez', 'alem 1234', 'mitre 123', '0', '0', '0', '0', '2915151456', 'lalal alala mi vieja mula ya no es lo que era', '1', 'sin_iniciar', '1', '2019-04-01 15:17:19', NULL, NULL, 'y', 'dow', 'y'),
	(10, '0001', 'juan lopez', 'busqueda de materiales', 'lorena mirez', 'normal', 'mariano perez', 'alem 1234', 'mitre 123', '0', '0', '0', '0', '2915151456', 'lalal alala mi vieja mula ya no es lo que era', '1', 'sin_iniciar', '1', '2019-04-01 15:21:34', NULL, NULL, 'y', 'dow', 'y'),
	(9, '0001', 'juan lopez', 'busqueda de materiales', 'lorena mirez', 'normal', 'mariano perez', 'alem 1234', 'mitre 123', '0', '0', '0', '0', '2915151456', 'lalal alala mi vieja mula ya no es lo que era', '1', 'sin_iniciar', NULL, '2019-03-29 13:55:13', NULL, NULL, 'y', 'dow', 'n'),
	(8, '0001', 'juan lopez', 'busqueda de materiales', 'lorena mirez', 'normal', 'mariano perez', 'alem 1234', 'mitre 123', '0', '0', '0', '0', '2915151456', 'lalal alala mi vieja mula ya no es lo que era', '1', 'sin_iniciar', NULL, '2019-03-29 13:55:13', NULL, NULL, 'y', 'dow', 'n'),
	(13, '0001', 'juan lopez', 'busqueda de materiales', 'lorena mirez', 'normal', 'mariano perez', 'alem 1234', 'mitre 123', '0', '0', '0', '0', '2915151456', 'lalal alala mi vieja mula ya no es lo que era', '1', 'sin_iniciar', '1', '2019-04-01 15:19:00', NULL, NULL, 'y', 'dow', 'y');
/*!40000 ALTER TABLE `dow` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origen` varchar(250) DEFAULT NULL,
  `depto_origen` varchar(250) DEFAULT NULL,
  `lat_origen` varchar(250) DEFAULT '0',
  `long_origen` varchar(250) DEFAULT '0',
  `destino` varchar(250) DEFAULT NULL,
  `lat_destino` varchar(250) DEFAULT '0',
  `long_destino` varchar(250) DEFAULT '0',
  `depto_destino` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `destinatario` varchar(250) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `cadete` varchar(250) DEFAULT '0',
  `status` enum('sin_iniciar','aceptado','buscando','entregando','completado') DEFAULT 'sin_iniciar',
  `fModificacionUsuario` varchar(50) DEFAULT NULL,
  `fModificacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) DEFAULT NULL,
  `fCreacionUsuario` varchar(21) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'y',
  `mode` enum('upaq','dow') DEFAULT 'upaq',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `origen`, `depto_origen`, `lat_origen`, `long_origen`, `destino`, `lat_destino`, `long_destino`, `depto_destino`, `tipo`, `destinatario`, `descripcion`, `user`, `cadete`, `status`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `active`, `mode`) VALUES
	(35, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '8', 'aceptado', '8', '2019-03-29 14:41:28', '2019-02-08 14:22:09', '1', 'y', 'upaq'),
	(34, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '8', 'aceptado', '8', '2019-03-29 14:41:52', '2019-02-08 14:22:09', '1', 'y', 'upaq'),
	(31, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '0', 'sin_iniciar', '1', '2019-02-09 11:35:09', '2019-02-08 14:22:09', '1', 'y', 'upaq'),
	(33, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '8', 'completado', '8', '2019-03-29 15:02:50', '2019-02-08 14:22:09', '1', 'y', 'upaq'),
	(28, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '0', 'sin_iniciar', '1', '2019-02-09 11:35:14', '2019-02-08 14:22:09', '1', 'y', 'upaq'),
	(27, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '0', 'sin_iniciar', '1', '2019-02-09 11:35:16', '2019-02-08 14:22:09', '1', 'y', 'upaq'),
	(25, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '0', 'sin_iniciar', '1', '2019-02-09 11:35:17', '2019-02-08 14:22:15', '1', 'y', 'upaq'),
	(26, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '0', 'sin_iniciar', '1', '2019-02-09 11:35:19', '2019-02-08 14:22:09', '1', 'y', 'upaq'),
	(24, 'alem 1020', 'asd 1', '-38.7046006', '-62.2685946', 'alem 865', '-38.7061001', '-62.2666123', 'asd 5', 'Tramite', 'nexosmart', 'asd asd asd asd asd asd 123', '1', '0', 'sin_iniciar', '1', '2019-02-09 11:35:21', '2019-02-08 14:22:09', '1', 'y', 'upaq');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tarifas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(250) DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `monto2` int(11) DEFAULT NULL,
  `fModificacionUsuario` varchar(50) DEFAULT NULL,
  `fModificacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) DEFAULT NULL,
  `fCreacionUsuario` varchar(21) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `tarifas` DISABLE KEYS */;
INSERT INTO `tarifas` (`id`, `tipo`, `monto`, `monto2`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `active`) VALUES
	(1, 'Sobre', 50, NULL, NULL, '2019-02-09 12:08:35', NULL, NULL, 1),
	(2, 'Tramite', 100, NULL, NULL, '2019-02-09 12:07:17', NULL, NULL, 1),
	(3, 'Pequeño/mediano paquete', 150, NULL, NULL, '2019-02-09 12:08:28', NULL, NULL, 1),
	(4, 'Paquete grande', 200, NULL, NULL, '2019-02-09 12:08:25', NULL, NULL, 1),
	(5, 'Pequeño/mediano bulto', 300, NULL, NULL, '2019-02-09 12:08:20', NULL, NULL, 1),
	(6, 'Bulto grande', 500, NULL, NULL, '2019-02-09 12:08:15', NULL, NULL, 1),
	(7, 'Mudanza', 1500, NULL, NULL, '2019-02-09 12:08:13', NULL, NULL, 1),
	(8, 'Delivery', 50, NULL, NULL, '2019-02-09 12:08:06', NULL, NULL, 1),
	(10, 'test', 260, 620, '1', '2019-03-01 12:31:50', '2019-03-01 12:31:50', '1', 1),
	(11, 'test1', 6201, 2601, '1', '2019-03-01 16:04:31', '2019-03-01 12:33:09', '1', 0);
/*!40000 ALTER TABLE `tarifas` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '0',
  `lastname` varchar(250) NOT NULL DEFAULT '0',
  `email` varchar(250) NOT NULL DEFAULT '0',
  `password` varchar(250) NOT NULL DEFAULT '0',
  `phone` varchar(250) NOT NULL DEFAULT '0',
  `type` enum('user','cadete','admin') NOT NULL DEFAULT 'user',
  `fModificacionUsuario` varchar(50) DEFAULT NULL,
  `fModificacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fCreacion` varchar(19) DEFAULT NULL,
  `fCreacionUsuario` varchar(21) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `phone`, `type`, `fModificacionUsuario`, `fModificacion`, `fCreacion`, `fCreacionUsuario`, `active`) VALUES
	(1, 'admin', 'upaq', 'admin@upaq.com', 'd4e1df81be77aea2d4755ffc30585d8f7f3037b9', '2910454545', 'admin', '1', '2019-03-29 11:21:15', NULL, NULL, 'y'),
	(2, 'asd', 'qwe', 'asd@asd', '736c71b3dc8927078a660b6813499d87baeb7f15', '12313213', 'user', '', '2019-03-29 11:21:17', '2019-02-06 12:16:50', '', 'y'),
	(3, 'add', 'asd', 'asd@456', '3ee721d1d3d21f97f099a913f3391b51c4d24e52', '123', 'user', '', '2019-03-29 11:21:18', '2019-02-06 12:36:08', '', 'y'),
	(4, 'braian', 'cliente', 'braian@cliente.com', 'a3c1b169da70f446671170d0289606f683105567', '123654789', 'user', '', '2019-03-29 11:21:19', '2019-02-06 14:28:01', '', 'y'),
	(5, 'qweqwe', '|qweqweqwe', 'asd@456465', '8f95757c844e70f994f013fa86ffaeb1238aacf3', '456465', 'user', '', '2019-03-29 11:21:22', '2019-02-07 09:28:00', '', 'y'),
	(6, 'cadete', 'upaq', 'asd@456465', '8f95757c844e70f994f013fa86ffaeb1238aacf3', '456465', 'cadete', '', '2019-03-29 11:21:23', '2019-02-07 09:28:05', '', 'y'),
	(7, 'braian1', 'vaylet1', 'braianvaylet@gmail.com1', '92bb5cc83905426e656415eeb9e0e0396fa7fe2e', '29150161421', 'user', '7', '2019-03-29 11:21:24', '2019-02-07 09:28:34', '', 'y'),
	(8, 'test', 'test', 'test@gmail.com', 'd4e1df81be77aea2d4755ffc30585d8f7f3037b9', '123456789987', 'cadete', '', '2019-03-29 11:21:26', '2019-02-28 13:10:06', '', 'y');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
