-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2023 a las 12:47:56
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
(2, 'Gestionar rectores', 1, 1, 'formularios/add_rectores.html'),
(3, 'Visualizar aA', 1, 2, 'formularios/show_actividades.html');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_carreras`
--

DROP TABLE IF EXISTS `tit_carreras`;
CREATE TABLE `tit_carreras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL DEFAULT '',
  `facultad` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `coordonador` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_facultades`
--

DROP TABLE IF EXISTS `tit_facultades`;
CREATE TABLE `tit_facultades` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL DEFAULT '',
  `decano` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `url` varchar(45) NOT NULL DEFAULT '',
  `logotipo` text NOT NULL,
  `rector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_universidades`
--

INSERT INTO `tit_universidades` (`id`, `nombre`, `email`, `url`, `logotipo`, `rector`) VALUES
(19, 'Pedro Valdes', 'pvaldestamayo@gmail.com', 'https://www.intermatico.com/ebanking/usuario/', '82539640_2572464936411477_853257049339854848_n.jpg', 2),
(20, 'Pedro Valdes', 'pvaldestamayo@gmail.com', 'https://www.intermatico.com/ebanking/usuario/', 'Agro18_01.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_usuarios`
--

DROP TABLE IF EXISTS `tit_usuarios`;
CREATE TABLE `tit_usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(45) NOT NULL DEFAULT '',
  `apellidos` varchar(45) NOT NULL DEFAULT '',
  `usuario` varchar(25) NOT NULL DEFAULT '',
  `clave` varchar(100) NOT NULL DEFAULT '',
  `rol` int(11) NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_usuarios`
--

INSERT INTO `tit_usuarios` (`id`, `nombres`, `apellidos`, `usuario`, `clave`, `rol`, `foto`) VALUES
(1, 'Administrador', 'admin', 'admin', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 1, 'female.png'),
(5, 'PEDRO ROBERTO', 'VALDES TAMAYO', 'pvaldes', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 5, 'pvaldes.png'),
(6, 'BLANCA SOLEDAD', 'INDACOCHEA GANCHOSO', 'blanca', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 2, 'blanca.png'),
(7, 'JOSE LUIS', 'ALCIVAR COBEÃ‘A', 'alcivar', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 3, 'alcivar.png'),
(8, 'CARLOS ALBERTO', 'CASTRO PIGUAVE', 'carlitos', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 4, 'carlitos.png'),
(9, 'YANDRY ALBERTO', 'PALMA SORNOSA', 'yandry', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 6, 'yandry.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tit_acciones`
--
ALTER TABLE `tit_acciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_carreras`
--
ALTER TABLE `tit_carreras`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tit_carreras`
--
ALTER TABLE `tit_carreras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tit_facultades`
--
ALTER TABLE `tit_facultades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tit_usuarios`
--
ALTER TABLE `tit_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
