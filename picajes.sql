-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-06-2022 a las 18:35:16
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
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
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
-- Estructura de tabla para la tabla `pic_fichajes`
--

CREATE TABLE `pic_fichajes` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario` int(11) NOT NULL,
  `equipo` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `hor_ini` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `hor_fin` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `tim_trb` time DEFAULT NULL,
  `tim_dsc` time DEFAULT NULL,
  `tim_tot` time DEFAULT NULL,
  `min_trb` int(11) DEFAULT NULL,
  `min_dsc` int(11) DEFAULT NULL,
  `min_tot` int(11) DEFAULT NULL,
  `fch` date NOT NULL DEFAULT current_timestamp(),
  `estado` int(1) NOT NULL COMMENT '1: dentro 2: fuera'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_log`
--

CREATE TABLE `pic_log` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `puestofichaje` int(11) NOT NULL,
  `tipo_movimiento` int(11) NOT NULL COMMENT '1: Entrada; 2: Salida',
  `empresa` int(11) NOT NULL,
  `fichajes` int(11) NOT NULL,
  `fch` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pic_puestofichaje`
--

CREATE TABLE `pic_puestofichaje` (
  `id` int(11) NOT NULL,
  `alt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `zona` int(11) NOT NULL,
  `empresa` int(11) NOT NULL
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
  `nombre` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contrasenia` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(35) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `equipo` int(11) DEFAULT NULL,
  `barcode` bigint(16) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pic_fichajes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_pic_fichajes` (
`id` int(11)
,`fch` date
,`semana` int(2)
,`año` int(4)
,`equipo_usuario` varchar(11)
,`usuario` varchar(40)
,`hor_ini` varchar(8)
,`hor_fin` varchar(8)
,`tim_trb` time
,`tim_dsc` time
,`tim_tot` time
,`min_trb` int(11)
,`min_dsc` int(11)
,`min_tot` int(11)
,`estado` varchar(6)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pic_fichajes_datetime`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_pic_fichajes_datetime` (
`id` int(11)
,`fch` datetime
,`semana` int(2)
,`año` int(4)
,`equipo_usuario` varchar(11)
,`usuario` varchar(40)
,`hor_ini` varchar(8)
,`hor_fin` varchar(8)
,`tim_trb` time
,`tim_dsc` time
,`tim_tot` time
,`min_trb` decimal(14,4)
,`min_dsc` decimal(14,4)
,`min_tot` decimal(14,4)
,`estado` varchar(6)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pic_log`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_pic_log` (
`id` int(11)
,`fch` date
,`semana` int(2)
,`año` int(4)
,`fecha_hora` timestamp
,`equipo_usuario` varchar(11)
,`usuario` varchar(40)
,`puesto_fichaje_zona` varchar(20)
,`puesto_fichaje` varchar(25)
,`tipo_movimiento` varchar(7)
,`su_fichaje` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pic_log_datetime`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_pic_log_datetime` (
`id` int(11)
,`fch` datetime
,`semana` int(2)
,`año` int(4)
,`fecha_hora` timestamp
,`equipo_usuario` varchar(11)
,`usuario` varchar(40)
,`puesto_fichaje_zona` varchar(20)
,`puesto_fichaje` varchar(25)
,`tipo_movimiento` varchar(7)
,`su_fichaje` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pic_fichajes`
--
DROP TABLE IF EXISTS `v_pic_fichajes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_pic_fichajes`  AS SELECT `pic_fichajes`.`id` AS `id`, `pic_fichajes`.`fch` AS `fch`, week(`pic_fichajes`.`fch`) AS `semana`, year(`pic_fichajes`.`fch`) AS `año`, `pic_equipos`.`nombre` AS `equipo_usuario`, `pic_usuarios`.`nombre` AS `usuario`, time_format(`pic_fichajes`.`hor_ini`,'%T') AS `hor_ini`, time_format(`pic_fichajes`.`hor_fin`,'%T') AS `hor_fin`, `pic_fichajes`.`tim_trb` AS `tim_trb`, `pic_fichajes`.`tim_dsc` AS `tim_dsc`, `pic_fichajes`.`tim_tot` AS `tim_tot`, `pic_fichajes`.`min_trb` AS `min_trb`, `pic_fichajes`.`min_dsc` AS `min_dsc`, `pic_fichajes`.`min_tot` AS `min_tot`, CASE `pic_fichajes`.`estado` WHEN 1 THEN 'DENTRO' WHEN 2 THEN 'FUERA' ELSE '' END AS `estado` FROM ((`pic_fichajes` left join `pic_usuarios` on(`pic_usuarios`.`id` = `pic_fichajes`.`usuario`)) left join `pic_equipos` on(`pic_equipos`.`id` = `pic_usuarios`.`equipo`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pic_fichajes_datetime`
--
DROP TABLE IF EXISTS `v_pic_fichajes_datetime`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_pic_fichajes_datetime`  AS SELECT `pic_fichajes`.`id` AS `id`, str_to_date(concat(`pic_fichajes`.`fch`,' 00:00:00'),'%Y-%m-%d %H:%i:%s') AS `fch`, week(`pic_fichajes`.`fch`) AS `semana`, year(`pic_fichajes`.`fch`) AS `año`, `pic_equipos`.`nombre` AS `equipo_usuario`, `pic_usuarios`.`nombre` AS `usuario`, time_format(`pic_fichajes`.`hor_ini`,'%T') AS `hor_ini`, time_format(`pic_fichajes`.`hor_fin`,'%T') AS `hor_fin`, `pic_fichajes`.`tim_trb` AS `tim_trb`, `pic_fichajes`.`tim_dsc` AS `tim_dsc`, `pic_fichajes`.`tim_tot` AS `tim_tot`, `pic_fichajes`.`min_trb`/ 60 AS `min_trb`, `pic_fichajes`.`min_dsc`/ 60 AS `min_dsc`, `pic_fichajes`.`min_tot`/ 60 AS `min_tot`, CASE `pic_fichajes`.`estado` WHEN 1 THEN 'DENTRO' WHEN 2 THEN 'FUERA' ELSE '' END AS `estado` FROM ((`pic_fichajes` left join `pic_usuarios` on(`pic_usuarios`.`id` = `pic_fichajes`.`usuario`)) left join `pic_equipos` on(`pic_equipos`.`id` = `pic_usuarios`.`equipo`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pic_log`
--
DROP TABLE IF EXISTS `v_pic_log`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_pic_log`  AS SELECT `pic_log`.`id` AS `id`, `pic_log`.`fch` AS `fch`, week(`pic_log`.`fch`) AS `semana`, year(`pic_log`.`fch`) AS `año`, `pic_log`.`alt_date` AS `fecha_hora`, `pic_equipos`.`nombre` AS `equipo_usuario`, `pic_usuarios`.`nombre` AS `usuario`, `pic_zonas`.`nombre` AS `puesto_fichaje_zona`, `pic_puestofichaje`.`nombre` AS `puesto_fichaje`, CASE `pic_log`.`tipo_movimiento` WHEN 1 THEN 'ENTRADA' WHEN 2 THEN 'SALIDA' ELSE '' END AS `tipo_movimiento`, `pic_log`.`fichajes` AS `su_fichaje` FROM ((((`pic_log` left join `pic_usuarios` on(`pic_usuarios`.`id` = `pic_log`.`usuario`)) left join `pic_equipos` on(`pic_equipos`.`id` = `pic_usuarios`.`equipo`)) left join `pic_puestofichaje` on(`pic_puestofichaje`.`id` = `pic_log`.`puestofichaje`)) left join `pic_zonas` on(`pic_zonas`.`id` = `pic_puestofichaje`.`zona`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pic_log_datetime`
--
DROP TABLE IF EXISTS `v_pic_log_datetime`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_pic_log_datetime`  AS SELECT `pic_log`.`id` AS `id`, str_to_date(concat(`pic_log`.`fch`,' 00:00:00'),'%Y-%m-%d %H:%i:%s') AS `fch`, week(`pic_log`.`fch`) AS `semana`, year(`pic_log`.`fch`) AS `año`, `pic_log`.`alt_date` AS `fecha_hora`, `pic_equipos`.`nombre` AS `equipo_usuario`, `pic_usuarios`.`nombre` AS `usuario`, `pic_zonas`.`nombre` AS `puesto_fichaje_zona`, `pic_puestofichaje`.`nombre` AS `puesto_fichaje`, CASE `pic_log`.`tipo_movimiento` WHEN 1 THEN 'ENTRADA' WHEN 2 THEN 'SALIDA' ELSE '' END AS `tipo_movimiento`, `pic_log`.`fichajes` AS `su_fichaje` FROM ((((`pic_log` left join `pic_usuarios` on(`pic_usuarios`.`id` = `pic_log`.`usuario`)) left join `pic_equipos` on(`pic_equipos`.`id` = `pic_usuarios`.`equipo`)) left join `pic_puestofichaje` on(`pic_puestofichaje`.`id` = `pic_log`.`puestofichaje`)) left join `pic_zonas` on(`pic_zonas`.`id` = `pic_puestofichaje`.`zona`))  ;

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
-- Indices de la tabla `pic_fichajes`
--
ALTER TABLE `pic_fichajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empresa4` (`empresa`),
  ADD KEY `fk_equipo4` (`equipo`),
  ADD KEY `fk_usuario4` (`usuario`);

--
-- Indices de la tabla `pic_log`
--
ALTER TABLE `pic_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`usuario`),
  ADD KEY `fk_puestofichaje` (`puestofichaje`),
  ADD KEY `fk_empresa3` (`empresa`);

--
-- Indices de la tabla `pic_puestofichaje`
--
ALTER TABLE `pic_puestofichaje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`,`zona`),
  ADD KEY `fk_empresa2` (`empresa`),
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
-- AUTO_INCREMENT de la tabla `pic_fichajes`
--
ALTER TABLE `pic_fichajes`
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
  ADD CONSTRAINT `fk_empresas` FOREIGN KEY (`empresa`) REFERENCES `pic_empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pic_log`
--
ALTER TABLE `pic_log`
  ADD CONSTRAINT `fk_fichajes` FOREIGN KEY (`fichajes`) REFERENCES `pic_fichajes` (`id`),
  ADD CONSTRAINT `fk_puestofichaje` FOREIGN KEY (`puestofichaje`) REFERENCES `pic_puestofichaje` (`id`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `pic_usuarios` (`id`);

--
-- Filtros para la tabla `pic_puestofichaje`
--
ALTER TABLE `pic_puestofichaje`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`empresa`) REFERENCES `pic_empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_zona` FOREIGN KEY (`zona`) REFERENCES `pic_zonas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pic_sesiones`
--
ALTER TABLE `pic_sesiones`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `pic_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pic_usuarios`
--
ALTER TABLE `pic_usuarios`
  ADD CONSTRAINT `fk_empresas` FOREIGN KEY (`empresa`) REFERENCES `pic_empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equipos` FOREIGN KEY (`equipo`) REFERENCES `pic_equipos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pic_zonas`
--
ALTER TABLE `pic_zonas`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`empresa`) REFERENCES `pic_empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
