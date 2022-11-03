-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2022 a las 02:17:13
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospecto_documento`
--

CREATE TABLE `prospecto_documento` (
  `documento_id` int(11) NOT NULL,
  `prospecto_id` int(11) NOT NULL,
  `nombre_documento` varchar(50) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `borrado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prospecto_documento`
--

INSERT INTO `prospecto_documento` (`documento_id`, `prospecto_id`, `nombre_documento`, `ruta`, `borrado`) VALUES
(10, 33, '1500057220165.jpg', 'Documentos/prospecto33/1500057220165.jpg', b'0'),
(11, 33, '2016-ford-focus-rs-101-1557785824.jpg', 'Documentos/prospecto33/2016-ford-focus-rs-101-1557785824.jpg', b'0'),
(12, 34, '1500057220165.jpg', 'Documentos/prospecto34/1500057220165.jpg', b'0'),
(13, 34, '2016-ford-focus-rs-101-1557785824.jpg', 'Documentos/prospecto34/2016-ford-focus-rs-101-1557785824.jpg', b'0'),
(14, 36, '1500057220165.jpg', 'Documentos/prospecto36/1500057220165.jpg', b'0'),
(15, 36, '2016-ford-focus-rs-101-1557785824.jpg', 'Documentos/prospecto36/2016-ford-focus-rs-101-1557785824.jpg', b'0'),
(16, 36, 'Covid-19 Declaration form for candidates (2).pdf', 'Documentos/prospecto36/Covid-19 Declaration form for candidates (2).pdf', b'0'),
(19, 48, 'Covid-19 Declaration form for candidates (2).pdf', 'Documentos/prospecto48/Covid-19 Declaration form for candidates (2).pdf', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospecto_domicilio`
--

CREATE TABLE `prospecto_domicilio` (
  `domicilio_id` int(11) NOT NULL,
  `prospecto_id` int(11) NOT NULL,
  `calle` varchar(20) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `colonia` varchar(20) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `borrado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prospecto_domicilio`
--

INSERT INTO `prospecto_domicilio` (`domicilio_id`, `prospecto_id`, `calle`, `numero`, `colonia`, `codigo_postal`, `borrado`) VALUES
(31, 33, 'Santuario', '102', 'Tepeyac', '78384', b'0'),
(32, 34, 'Calle', '29', 'Colonia', '89764', b'0'),
(34, 36, 'Calle 1', '123', 'Colonia 2', '87463', b'0'),
(36, 48, 'Calle', '122', 'Colonia', '98734', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospecto_estatus`
--

CREATE TABLE `prospecto_estatus` (
  `solicitud_id` int(11) NOT NULL,
  `prospecto_id` int(11) NOT NULL,
  `estatus` varchar(10) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `borrado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prospecto_estatus`
--

INSERT INTO `prospecto_estatus` (`solicitud_id`, `prospecto_id`, `estatus`, `observaciones`, `borrado`) VALUES
(31, 33, 'Autorizado', NULL, b'0'),
(32, 34, 'Rechazado', 'No estan bien los documentos', b'0'),
(34, 36, 'Enviado', NULL, b'0'),
(36, 48, 'Rechazado', 'Informacion incorrecta', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospecto_informacion`
--

CREATE TABLE `prospecto_informacion` (
  `prospecto_id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido_paterno` varchar(20) NOT NULL,
  `apellido_materno` varchar(20) DEFAULT NULL,
  `telefono` varchar(14) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `borrado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prospecto_informacion`
--

INSERT INTO `prospecto_informacion` (`prospecto_id`, `nombre`, `apellido_paterno`, `apellido_materno`, `telefono`, `rfc`, `borrado`) VALUES
(33, 'Francisco', 'Rendon', NULL, '4442907626', 'REMF960110UR8', b'0'),
(34, 'Joaquin', 'El Albañil', NULL, '438482123238', 'AJRN987643RI0', b'0'),
(36, 'Juana', 'La', 'Iguana', '4448372834', 'JUAN282828UE9', b'0'),
(48, 'Pepe', 'El toro', NULL, '4443218277', 'PEPE344321URE', b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `prospecto_documento`
--
ALTER TABLE `prospecto_documento`
  ADD PRIMARY KEY (`documento_id`),
  ADD KEY `prospecto_id` (`prospecto_id`);

--
-- Indices de la tabla `prospecto_domicilio`
--
ALTER TABLE `prospecto_domicilio`
  ADD PRIMARY KEY (`domicilio_id`),
  ADD KEY `prospecto_id` (`prospecto_id`);

--
-- Indices de la tabla `prospecto_estatus`
--
ALTER TABLE `prospecto_estatus`
  ADD PRIMARY KEY (`solicitud_id`),
  ADD KEY `prospecto_id` (`prospecto_id`);

--
-- Indices de la tabla `prospecto_informacion`
--
ALTER TABLE `prospecto_informacion`
  ADD PRIMARY KEY (`prospecto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `prospecto_documento`
--
ALTER TABLE `prospecto_documento`
  MODIFY `documento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `prospecto_domicilio`
--
ALTER TABLE `prospecto_domicilio`
  MODIFY `domicilio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `prospecto_estatus`
--
ALTER TABLE `prospecto_estatus`
  MODIFY `solicitud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `prospecto_informacion`
--
ALTER TABLE `prospecto_informacion`
  MODIFY `prospecto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prospecto_documento`
--
ALTER TABLE `prospecto_documento`
  ADD CONSTRAINT `prospecto_documento_ibfk_1` FOREIGN KEY (`prospecto_id`) REFERENCES `prospecto_informacion` (`prospecto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prospecto_domicilio`
--
ALTER TABLE `prospecto_domicilio`
  ADD CONSTRAINT `prospecto_domicilio_ibfk_1` FOREIGN KEY (`prospecto_id`) REFERENCES `prospecto_informacion` (`prospecto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prospecto_estatus`
--
ALTER TABLE `prospecto_estatus`
  ADD CONSTRAINT `prospecto_estatus_ibfk_1` FOREIGN KEY (`prospecto_id`) REFERENCES `prospecto_informacion` (`prospecto_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
