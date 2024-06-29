-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2023 a las 00:38:33
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `titulacion`
--
CREATE DATABASE IF NOT EXISTS `titulacion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `titulacion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_acciones`
--

DROP TABLE IF EXISTS `tit_acciones`;
CREATE TABLE `tit_acciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL,
  `funcion` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_acciones`
--

INSERT INTO `tit_acciones` (`id`, `nombre`, `rol`, `funcion`, `codigo`) VALUES
(1, 'Gestionar universidades', 1, 1, 'formularios/add_universidades.html'),
(2, 'Gestionar rectores', 1, 1, 'formularios/add_usuarios.html'),
(3, 'Visualizar aA', 1, 2, 'formularios/show_actividades.html'),
(4, 'Gestionar decanos', 2, 1, 'formularios/add_usuarios.html'),
(5, 'Gestinar facultades', 2, 1, 'formularios/add_facultades.html'),
(6, 'Gestionar coordinadores', 3, 1, 'formularios/add_usuarios.html'),
(7, 'Gestionar carreras', 3, 1, 'formularios/add_carreras.html'),
(8, 'Gestionar responsables de vinculacion', 4, 1, 'formularios/add_usuarios.html'),
(9, 'Gestionar otra cosa', 4, 1, 'formularios/add-otra.html');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_asignaciones`
--

DROP TABLE IF EXISTS `tit_asignaciones`;
CREATE TABLE `tit_asignaciones` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL DEFAULT 0,
  `parametro` varchar(20) NOT NULL,
  `valor` int(11) NOT NULL,
  `rol` int(11) NOT NULL DEFAULT 6
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_asignaciones`
--

INSERT INTO `tit_asignaciones` (`id`, `usuario`, `parametro`, `valor`, `rol`) VALUES
(11, 1, 'global', 0, 1),
(15, 32, 'rector', 0, 2),
(16, 7, 'rector', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_carreras`
--

DROP TABLE IF EXISTS `tit_carreras`;
CREATE TABLE `tit_carreras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL DEFAULT '',
  `facultad` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `coordinador` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `logotipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_carreras`
--

INSERT INTO `tit_carreras` (`id`, `nombre`, `facultad`, `coordinador`, `logotipo`) VALUES
(1, 'AGROPECUARIA', 6, 8, 'svuzitjgeknphwoardclfbyxqm_1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_coordinadores`
--

DROP TABLE IF EXISTS `tit_coordinadores`;
CREATE TABLE `tit_coordinadores` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `facultad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_facultades`
--

DROP TABLE IF EXISTS `tit_facultades`;
CREATE TABLE `tit_facultades` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `decano` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `logotipo` varchar(70) NOT NULL,
  `universidad` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_facultades`
--

INSERT INTO `tit_facultades` (`id`, `nombre`, `decano`, `logotipo`, `universidad`) VALUES
(6, 'FACULTAD DE CIENCIAS NATURALES Y DE LA AGRICULTURA', 7, 'gxkmzcdaqptovlibrfnwsjueyh_6.png', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_funciones`
--

DROP TABLE IF EXISTS `tit_funciones`;
CREATE TABLE `tit_funciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_funciones`
--

INSERT INTO `tit_funciones` (`id`, `nombre`) VALUES
(1, 'Gestionar'),
(2, 'Visualizar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_tipo_usuarios`
--

DROP TABLE IF EXISTS `tit_tipo_usuarios`;
CREATE TABLE `tit_tipo_usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_tipo_usuarios`
--

INSERT INTO `tit_tipo_usuarios` (`id`, `nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'RECTOR'),
(3, 'DECANO'),
(4, 'COORDINADOR'),
(5, 'PROFESOR RESPONSABLE'),
(6, 'ESTUDIANTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_universidades`
--

DROP TABLE IF EXISTS `tit_universidades`;
CREATE TABLE `tit_universidades` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(45) NOT NULL DEFAULT '',
  `urll` varchar(45) NOT NULL DEFAULT '',
  `logotipo` text NOT NULL,
  `rector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_universidades`
--

INSERT INTO `tit_universidades` (`id`, `nombre`, `email`, `urll`, `logotipo`, `rector`) VALUES
(1, 'UNIVERSIDAD ESTATL DEL SUR DE MANABÍ', 'pvaldestamayo@gmail.com', 'http://unesum.edu.ec', 'vuxaipwotcshfeqydbrlkzmjng_1.jpg', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_usuarios`
--

DROP TABLE IF EXISTS `tit_usuarios`;
CREATE TABLE `tit_usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `cedula` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nombres` varchar(45) NOT NULL DEFAULT '',
  `apellidos` varchar(45) NOT NULL DEFAULT '',
  `usuario` varchar(25) NOT NULL DEFAULT '',
  `clave` varchar(100) NOT NULL DEFAULT '',
  `foto` varchar(70) NOT NULL,
  `sexo` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 hembras',
  `carrera` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_usuarios`
--

INSERT INTO `tit_usuarios` (`id`, `cedula`, `email`, `nombres`, `apellidos`, `usuario`, `clave`, `foto`, `sexo`, `carrera`) VALUES
(1, '', '', 'Administrador', 'admin', 'admin', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'female.png', 1, 0),
(5, '1758614505', 'pvaldestamayo@gmail.com', 'VALDES TAMAYO', 'PEDRO ROBERTO', 'pvaldes', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'bdvtpgsjrqeznhyuwomxacilkf_5.jpg', 2, 1),
(7, '12345678', 'jose.alcivar@unesum.edu.ec', 'ALCIVAR COBEÑA', 'JOSE LUIS', 'alcivar', '', 'ltaksdoyphgniexfvcwzjqrmub_7.jpg', 1, 0),
(8, '567657', 'carlos.castro@unesum.edu.ec', 'CASTRO PIGUAVE', 'CARLOS ALBERTO', 'carlitos', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'lxidsbkwmenhpfozjcgavrqytu_8.jpg', 1, 0),
(9, '123', 'pvaldestamayo@gmail.com', 'YANDRY ALBERTO', 'PALMA SORNOSA', 'yandry', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'zvemjihrwlapqusobxdcyktfng_9.jpg', 1, 0),
(22, '567657', 'washinton.narvaez@unesum.edu.ec', 'NARVAEZ CAMPANA', 'WASHINTON VICENTE', 'washito', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '', 2, 0),
(29, '23456', 'blanca.indacochea@unesum.edu.ec', 'INDACOCHEA GANCHOSO', 'BLANCA SOLEDAD', 'blanca', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'gynlqesrvatizmfbxowkcuphjd.png', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tit_acciones`
--
ALTER TABLE `tit_acciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_asignaciones`
--
ALTER TABLE `tit_asignaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_carreras`
--
ALTER TABLE `tit_carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_coordinadores`
--
ALTER TABLE `tit_coordinadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_facultades`
--
ALTER TABLE `tit_facultades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_funciones`
--
ALTER TABLE `tit_funciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_tipo_usuarios`
--
ALTER TABLE `tit_tipo_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_universidades`
--
ALTER TABLE `tit_universidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_usuarios`
--
ALTER TABLE `tit_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tit_acciones`
--
ALTER TABLE `tit_acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tit_asignaciones`
--
ALTER TABLE `tit_asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tit_carreras`
--
ALTER TABLE `tit_carreras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tit_coordinadores`
--
ALTER TABLE `tit_coordinadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tit_facultades`
--
ALTER TABLE `tit_facultades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tit_funciones`
--
ALTER TABLE `tit_funciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tit_tipo_usuarios`
--
ALTER TABLE `tit_tipo_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tit_universidades`
--
ALTER TABLE `tit_universidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tit_usuarios`
--
ALTER TABLE `tit_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
