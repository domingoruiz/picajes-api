-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-03-2022 a las 12:14:38
-- Versión del servidor: 10.3.28-MariaDB
-- Versión de PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `picajes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_empresas`
--

CREATE TABLE `pic_empresas` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `nif` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_equipos`
--

CREATE TABLE `pic_equipos` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_log`
--

CREATE TABLE `pic_log` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  `puestofichaje` int(11) NOT NULL,
  `tipo_movimiento` int(11) NOT NULL COMMENT '1: Entrada; 2: Salida'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_puestofichaje`
--

CREATE TABLE `pic_puestofichaje` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `zona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_sesiones`
--

CREATE TABLE `pic_sesiones` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `expiracion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `token_sesion` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_usuarios`
--

CREATE TABLE `pic_usuarios` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `contrasenia` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `equipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_zonas`
--

CREATE TABLE `pic_zonas` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `empresa` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pic_empresas`
--
ALTER TABLE `pic_empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- Indices de la tabla `pic_equipos`
--
ALTER TABLE `pic_equipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`,`empresa`),
  ADD KEY `fk_empresas` (`empresa`);

--
-- Indices de la tabla `pic_log`
--
ALTER TABLE `pic_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`usuario`),
  ADD KEY `fk_puestofichaje` (`puestofichaje`);

--
-- Indices de la tabla `pic_puestofichaje`
--
ALTER TABLE `pic_puestofichaje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`,`zona`),
  ADD KEY `fk_zona` (`zona`);

--
-- Indices de la tabla `pic_sesiones`
--
ALTER TABLE `pic_sesiones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_token_sesion` (`token_sesion`),
  ADD KEY `fk_usuario3` (`usuario`);

--
-- Indices de la tabla `pic_usuarios`
--
ALTER TABLE `pic_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `fk_empresas2` (`empresa`),
  ADD KEY `fk_equipos` (`equipo`);

--
-- Indices de la tabla `pic_zonas`
--
ALTER TABLE `pic_zonas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empresa` (`empresa`,`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pic_empresas`
--
ALTER TABLE `pic_empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pic_equipos`
--
ALTER TABLE `pic_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pic_log`
--
ALTER TABLE `pic_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pic_puestofichaje`
--
ALTER TABLE `pic_puestofichaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pic_sesiones`
--
ALTER TABLE `pic_sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pic_usuarios`
--
ALTER TABLE `pic_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pic_zonas`
--
ALTER TABLE `pic_zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pic_equipos`
--
ALTER TABLE `pic_equipos`
  ADD CONSTRAINT `fk_empresas` FOREIGN KEY (`empresa`) REFERENCES `pic_empresas` (`id`);

--
-- Filtros para la tabla `pic_log`
--
ALTER TABLE `pic_log`
  ADD CONSTRAINT `fk_puestofichaje` FOREIGN KEY (`puestofichaje`) REFERENCES `pic_puestofichaje` (`id`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `pic_usuarios` (`id`);

--
-- Filtros para la tabla `pic_puestofichaje`
--
ALTER TABLE `pic_puestofichaje`
  ADD CONSTRAINT `fk_zona` FOREIGN KEY (`zona`) REFERENCES `pic_zonas` (`id`);

--
-- Filtros para la tabla `pic_sesiones`
--
ALTER TABLE `pic_sesiones`
  ADD CONSTRAINT `fk_usuario3` FOREIGN KEY (`usuario`) REFERENCES `pic_usuarios` (`id`);

--
-- Filtros para la tabla `pic_usuarios`
--
ALTER TABLE `pic_usuarios`
  ADD CONSTRAINT `fk_empresas2` FOREIGN KEY (`empresa`) REFERENCES `pic_empresas` (`id`),
  ADD CONSTRAINT `fk_equipos` FOREIGN KEY (`equipo`) REFERENCES `pic_equipos` (`id`);

--
-- Filtros para la tabla `pic_zonas`
--
ALTER TABLE `pic_zonas`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`empresa`) REFERENCES `pic_empresas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
