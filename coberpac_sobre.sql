-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2020 a las 16:59:29
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coberpac_sobre`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `colonia` varchar(20) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `direccion`, `colonia`, `ciudad`, `estado`, `cp`, `telefono`, `user_name`) VALUES
(1, 'Brayan Cruz Lucatero', 'Ramon Lopes Velarde norte 360-b, santa cecilia, sa', 'santa cecilia', 'Morelia', 'Michoacan de Ocampo', '58090', '4431298580', 'admin'),
(12, 'oscar contreras', 'palomas 149 Interior: 12', 'la hacienda', 'Morelia', 'Michoacán', '58330', '4435398291', ''),
(13, 'prueba', 'asd 223 Interior: as11', '2312', 'asd', 'asd', '3124', '3318251146', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinatario`
--

CREATE TABLE `destinatario` (
  `id_destinatario` int(11) NOT NULL,
  `id_envio_des` int(11) NOT NULL,
  `nombre_des` varchar(100) NOT NULL,
  `direccion_des` varchar(50) NOT NULL,
  `colonia_des` varchar(20) NOT NULL,
  `ciudad_des` varchar(20) NOT NULL,
  `estado_des` varchar(20) NOT NULL,
  `cp_des` int(11) NOT NULL,
  `tel_des` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `destinatario`
--

INSERT INTO `destinatario` (`id_destinatario`, `id_envio_des`, `nombre_des`, `direccion_des`, `colonia_des`, `ciudad_des`, `estado_des`, `cp_des`, `tel_des`) VALUES
(1, 1, 'Brayan Cruz Lucatero', 'Ramon Lopes Velarde norte 360-b, santa cecilia, sa', 'santa cecilia', 'Morelia', 'Michoacan de Ocampo', 58090, '+5244312985'),
(5, 8, 'kuris', '443234 a34 Interior: 3434', 'sgfffgf', 'VillaMadero', 'Michoacán', 23423, '4432730858'),
(6, 9, 'asdasd', 'asdasd asdasd Interior: asdasd', 'asdasd', 'asdasd', 'asdasd', 12312312, '4432730858');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_envio`
--

CREATE TABLE `detalle_envio` (
  `id_detalle` int(11) NOT NULL,
  `id_envio_detalle` int(11) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `peso_fisico` varchar(10) NOT NULL,
  `largo` varchar(10) NOT NULL,
  `ancho` varchar(10) NOT NULL,
  `alto` varchar(10) NOT NULL,
  `peso_volumen` varchar(10) NOT NULL,
  `costo` decimal(10,0) NOT NULL,
  `agencia` varchar(20) NOT NULL,
  `fecha_agencia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_envio`
--

INSERT INTO `detalle_envio` (`id_detalle`, `id_envio_detalle`, `observaciones`, `peso_fisico`, `largo`, `ancho`, `alto`, `peso_volumen`, `costo`, `agencia`, `fecha_agencia`) VALUES
(1, 1, 'asdadasdad', '0', '0', '0', '0', '0', '280', 'Farmacia Principal', '2019-02-23'),
(6, 8, 'xfghgfjghj', '33.6', '33', '13', '13', '33.8', '12', 'asdasd', '2020-09-10'),
(7, 9, 'asdasdasdasdasd', '123123', '233', '332', '223', '1232', '3333333', '123231', '2020-09-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id_envio` int(10) NOT NULL,
  `id_cliente_envio` int(10) NOT NULL,
  `n_guia` int(10) NOT NULL,
  `tipo_servicio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`id_envio`, `id_cliente_envio`, `n_guia`, `tipo_servicio`) VALUES
(1, 1, 4339, 'buzon'),
(8, 12, 12345, 'buzon'),
(9, 13, 0, 'asad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `id_prov` int(10) NOT NULL,
  `id_envio_p` int(10) NOT NULL,
  `provedor` varchar(20) NOT NULL,
  `track` varchar(30) NOT NULL,
  `fecha_guia_p` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provedor`
--

INSERT INTO `provedor` (`id_prov`, `id_envio_p`, `provedor`, `track`, `fecha_guia_p`) VALUES
(1, 1, 'fedex', '777849923362', '2020-09-09'),
(4, 8, '2234', '123494', '0000-00-00'),
(7, 9, '', '', '2020-09-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(3) NOT NULL,
  `token` text NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `telefono` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `level` int(1) NOT NULL COMMENT 'Tipo de empleado\r\n1: Administrador\r\n2: Empleado\r\n3: Distribuidor',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1: Activo\r\n2: Bloqueado',
  `intentos_fallidos` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `token`, `nombre`, `password`, `email`, `telefono`, `foto`, `level`, `status`, `intentos_fallidos`, `created_at`, `updated_at`) VALUES
(10, 'be53ef26158d21f773dcad2bf006971a', 'Oscar Rafae Contreras Flota', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 'oscarcontrerasf91@gmail.com', '4435398290', NULL, 1, 1, 0, '2020-09-03 00:37:41', '2020-09-15 14:23:25'),
(12, '7b2a9a30bc8a7d3f20d30e9edf9111cd', 'Oscar Contreras', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 'eeeprincesseee@gmail.com', '3318251146', NULL, 3, 1, 0, '2020-09-03 15:50:05', '2020-09-15 14:54:37'),
(13, '80e046335e2ee2c97a0fc0a88ba37b24', 'Reverian', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 'baom77@hotmail.com', '', NULL, 2, 1, 0, '2020-09-03 19:29:30', '2020-09-09 18:02:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `destinatario`
--
ALTER TABLE `destinatario`
  ADD PRIMARY KEY (`id_destinatario`),
  ADD KEY `fk_envio_des` (`id_envio_des`);

--
-- Indices de la tabla `detalle_envio`
--
ALTER TABLE `detalle_envio`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_envio_d` (`id_envio_detalle`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id_envio`),
  ADD KEY `fk_envio` (`id_cliente_envio`);

--
-- Indices de la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD PRIMARY KEY (`id_prov`),
  ADD KEY `fk_envio_p` (`id_envio_p`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `destinatario`
--
ALTER TABLE `destinatario`
  MODIFY `id_destinatario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_envio`
--
ALTER TABLE `detalle_envio`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id_envio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `provedor`
--
ALTER TABLE `provedor`
  MODIFY `id_prov` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `destinatario`
--
ALTER TABLE `destinatario`
  ADD CONSTRAINT `fk_envio_des` FOREIGN KEY (`id_envio_des`) REFERENCES `envio` (`id_envio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_envio`
--
ALTER TABLE `detalle_envio`
  ADD CONSTRAINT `fk_envio_d` FOREIGN KEY (`id_envio_detalle`) REFERENCES `envio` (`id_envio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `fk_envio` FOREIGN KEY (`id_cliente_envio`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD CONSTRAINT `fk_envio_p` FOREIGN KEY (`id_envio_p`) REFERENCES `envio` (`id_envio`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
