-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2018 a las 03:13:44
-- Versión del servidor: 5.7.18-log
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `indicadores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `act_id` int(11) NOT NULL,
  `act_nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`act_id`, `act_nom`) VALUES
(1, 'Futbol'),
(2, 'Tennis'),
(3, 'Basquetball'),
(4, 'Volleyball');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `per_id` int(11) NOT NULL,
  `per_nom_com` varchar(50) NOT NULL,
  `per_ide` int(11) NOT NULL,
  `per_sed_car` varchar(50) NOT NULL,
  `per_cod` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`per_id`, `per_nom_com`, `per_ide`, `per_sed_car`, `per_cod`) VALUES
(1, 'esteban salcedo alvarez', 1075302583, 'neiva - ingenieria de software', '20142128765'),
(2, 'Wolfgang herminso rios avila', 1075301458, 'neiva - ingenieria de software', '20132115420'),
(3, 'Cristian Armando Torres Cuellar', 1083881856, 'neiva - ingeniería de software', '20132125689'),
(4, 'Luisa María Vargas', 1075356587, 'neiva - ingeniería de software', '20142124587'),
(5, 'esteban fernando salazar', 1075213586, 'neiva - psicología', '20102115489'),
(6, 'Cristian fernando velez', 1077851236, 'neiva - ingeniería de software', '20141127413'),
(7, 'Brayan Alexnader Ruiza Palencia', 1077741236, 'neiva - Igneniería industrial', '20142115471'),
(8, 'Diego fransico fonseca', 1077357159, 'neiva - Educacio Física', '20142121232');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_actividad`
--

CREATE TABLE `persona_actividad` (
  `per_act_id` int(11) NOT NULL,
  `per_id_fk` int(11) DEFAULT NULL,
  `act_id_fk` int(11) DEFAULT NULL,
  `per_act_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona_actividad`
--

INSERT INTO `persona_actividad` (`per_act_id`, `per_id_fk`, `act_id_fk`, `per_act_nom`) VALUES
(2, 6, 4, 'Volleyball'),
(3, 1, 1, 'Futbol'),
(4, 1, 1, 'Futbol'),
(5, 1, 2, 'Tennis'),
(6, 5, 2, 'Tennis'),
(7, 1, 4, 'Volleyball'),
(8, 4, 3, 'Basquetball'),
(9, 4, 1, 'Futbol'),
(10, 4, 1, 'Futbol'),
(11, 4, 1, 'Futbol'),
(12, 4, 1, 'Futbol'),
(13, 8, 2, 'Tennis'),
(14, 6, 3, 'Basquetball'),
(15, 1, 2, 'Tennis'),
(16, 6, 3, 'Basquetball'),
(17, 5, 3, 'Basquetball'),
(18, 3, 3, 'Basquetball'),
(19, 2, 4, 'Volleyball'),
(20, 1, 3, 'Basquetball'),
(21, 1, 3, 'Basquetball'),
(22, 3, 3, 'Basquetball'),
(23, 5, 3, 'Basquetball'),
(24, 7, 3, 'Basquetball'),
(25, 7, 3, 'Basquetball'),
(26, 7, 3, 'Basquetball'),
(27, 7, 3, 'Basquetball'),
(28, 6, 3, 'Basquetball'),
(29, 3, 2, 'Tennis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `tip_usu_id` int(11) NOT NULL,
  `tip_usu_nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`tip_usu_id`, `tip_usu_nom`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_usu` varchar(40) NOT NULL,
  `usu_pas` varchar(130) NOT NULL,
  `usu_nom` varchar(100) NOT NULL,
  `usu_cor` varchar(80) NOT NULL,
  `usu_las_ses` datetime DEFAULT NULL,
  `usu_act` int(11) NOT NULL DEFAULT '0',
  `usu_tok` varchar(40) NOT NULL,
  `usu_tok_pas` varchar(100) DEFAULT NULL,
  `usu_pas_req` int(11) DEFAULT '0',
  `tip_usu_id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_usu`, `usu_pas`, `usu_nom`, `usu_cor`, `usu_las_ses`, `usu_act`, `usu_tok`, `usu_tok_pas`, `usu_pas_req`, `tip_usu_id2`) VALUES
(14, 'usuario', '$2y$10$ceWsovkuqezk9ytcVnBzWOZLF4NJhgTzs0YXCL2.z/x49EMkqjLK2', 'nombre', 'u20142128765@usco.edu.co', '2018-06-04 19:17:59', 1, '2c0176e7aecf81acdbbf461257837db5', '', 1, 1),
(15, 'esteban48', '$2y$10$vChA.se5UMnm6fbAPxl5ZeQQ2v.JJQtfX/WNutlRS7lvh9jY4tYG6', 'esteban', 'esti_4884@hotmail.com', '2018-06-04 19:54:55', 1, '12c472fc1631d51630d3d549894dbe23', '', 1, 2),
(16, 'cristian', '$2y$10$bOYXdes9qcPBElvkFxvC3OmvZAcFnAU775DLOI.F73XhsKB5HRsPq', 'cristian armando', 'cact070890@gmail.com', '2018-06-04 20:07:47', 1, '9b72e7d6dd5ba0025ceda3ac55935055', '', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`act_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`per_id`);

--
-- Indices de la tabla `persona_actividad`
--
ALTER TABLE `persona_actividad`
  ADD PRIMARY KEY (`per_act_id`),
  ADD KEY `fk1_persona_actividad` (`per_id_fk`),
  ADD KEY `fk2_persona_actividad` (`act_id_fk`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`tip_usu_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `persona_actividad`
--
ALTER TABLE `persona_actividad`
  MODIFY `per_act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `persona_actividad`
--
ALTER TABLE `persona_actividad`
  ADD CONSTRAINT `fk1_persona_actividad` FOREIGN KEY (`per_id_fk`) REFERENCES `persona` (`per_id`),
  ADD CONSTRAINT `fk2_persona_actividad` FOREIGN KEY (`act_id_fk`) REFERENCES `actividad` (`act_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
