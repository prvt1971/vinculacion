-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2023 a las 22:20:51
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
(9, 'Gestionar otra cosa', 4, 1, 'formularios/add-otra.html'),
(10, 'Gestionar proyectos de vinculación', 5, 1, 'formularios/add_proyectos.html'),
(11, 'Gestionar estudiantes', 5, 1, 'formularios/add_usuarios.html'),
(12, 'Gestionar períodos', 2, 1, 'formularios/add_periodos.html'),
(13, 'Gestionar provincias', 1, 1, 'formularios/add_provincias.html'),
(15, 'Gestionar cantones', 1, 1, 'formularios/add_cantones.html'),
(17, 'Gestionar parroquias', 1, 1, 'formularios/add_parroquias.html'),
(19, 'Gestionar comunidades', 1, 1, 'formularios/add_comunidades.html');

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
(35, 34, '', 0, 2),
(45, 35, '', 1, 3),
(46, 40, '', 1, 3),
(52, 37, '', 1, 4),
(53, 38, '', 1, 4),
(54, 39, '', 1, 4),
(55, 41, 'global', 4, 4),
(56, 36, '', 1, 2),
(59, 44, 'global', 1, 5),
(60, 45, '', 0, 4),
(61, 46, '', 4, 5),
(62, 47, '', 1, 5),
(64, 49, '', 4, 6),
(65, 50, '', 1, 6),
(66, 52, '', 0, 6),
(67, 53, '', 0, 6),
(68, 54, '', 0, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_cantones`
--

DROP TABLE IF EXISTS `tit_cantones`;
CREATE TABLE `tit_cantones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_cantones`
--

INSERT INTO `tit_cantones` (`id`, `nombre`, `provincia`) VALUES
(4, 'JIPIJAPA', 4),
(5, 'LOMAS DE SARGENTILLO', 5),
(6, 'MONTECRISTI', 4);

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
(1, 'AGROPECUARIA', 1, 38, 'rlpkebxoiqycgwusnjatmdvzfh_1.jpg'),
(2, 'INGENIERIA AMBIENTAL', 1, 37, 'fcmdhtnjizlybruaqseopgkvwx_2.png'),
(3, 'INGENIERIA FORESTAL', 1, 39, ''),
(4, 'ADMINISTRACION DE EMPRESAS', 4, 41, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_comunidades`
--

DROP TABLE IF EXISTS `tit_comunidades`;
CREATE TABLE `tit_comunidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `parroquia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'FACULTAD DE CIENCIAS NATURALES Y DE LA AGRICULTURA', 35, '', 1),
(4, 'CIENCIAS ECONOMICAS', 40, '', 1);

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
-- Estructura de tabla para la tabla `tit_paises`
--

DROP TABLE IF EXISTS `tit_paises`;
CREATE TABLE `tit_paises` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_paises`
--

INSERT INTO `tit_paises` (`id`, `nombre`) VALUES
(1, 'ECUADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_parroquias`
--

DROP TABLE IF EXISTS `tit_parroquias`;
CREATE TABLE `tit_parroquias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `canton` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_parroquias`
--

INSERT INTO `tit_parroquias` (`id`, `nombre`, `canton`) VALUES
(2, 'JULCUI', 4),
(3, 'MEMBRILLAL', 4),
(4, 'LA UNIÓN', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_periodos`
--

DROP TABLE IF EXISTS `tit_periodos`;
CREATE TABLE `tit_periodos` (
  `id` int(11) NOT NULL,
  `universidad` int(11) NOT NULL,
  `titulo_largo` varchar(70) NOT NULL,
  `titulo_corto` varchar(10) NOT NULL,
  `inicia` date NOT NULL,
  `termina` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_periodos`
--

INSERT INTO `tit_periodos` (`id`, `universidad`, `titulo_largo`, `titulo_corto`, `inicia`, `termina`) VALUES
(5, 1, 'Segundo período académico ordinario PII del 2023', 'PII2023', '2023-11-17', '2024-03-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_provincias`
--

DROP TABLE IF EXISTS `tit_provincias`;
CREATE TABLE `tit_provincias` (
  `id` int(11) NOT NULL,
  `pais` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_provincias`
--

INSERT INTO `tit_provincias` (`id`, `pais`, `nombre`) VALUES
(3, 1, 'ESMERALDAS'),
(4, 1, 'MANABÍ'),
(5, 1, 'GUAYAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tit_proyectos`
--

DROP TABLE IF EXISTS `tit_proyectos`;
CREATE TABLE `tit_proyectos` (
  `id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `carrera` int(11) NOT NULL,
  `director` int(11) NOT NULL,
  `provincia` int(11) NOT NULL,
  `canton` int(11) NOT NULL,
  `parroquia` int(11) NOT NULL,
  `camunidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 'ESTUDIANTE'),
(7, 'PROFESOR');

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
(1, 'UNIVERSIDAD ESTATL DEL SUR DE MANABÍ', 'pvaldestamayo@gmail.com', 'http://unesum.edu.ec', 'eqhnkijyxsmcvuowbgzpfltdra_1.png', 36);

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
  `carrera` int(11) NOT NULL DEFAULT 0,
  `confirmado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tit_usuarios`
--

INSERT INTO `tit_usuarios` (`id`, `cedula`, `email`, `nombres`, `apellidos`, `usuario`, `clave`, `foto`, `sexo`, `carrera`, `confirmado`) VALUES
(1, '71061823246', '', 'Administrador', 'admin', 'admin', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'female.png', 1, 0, 1),
(34, '2', 'blanca.indacochea@unesum.edu.ec', 'INDACOCHEA GANCHOSO', 'BLANCA SOLEDAD', 'blanca', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'ihdnpgomwqtyzlufvksrxbjaec.jpg', 1, 0, 1),
(35, '3', 'jose.alcivar@unesum.edu.ec', 'ALCIVAR COBEÑA', 'JOSÉ LUIS', 'alcivar', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'abiqfogewpusxnhtlrkdyvmcjz.jpg', 2, 0, 1),
(36, '4', 'christian.canarte@unesum.edu.ec', 'CAÑARTE VELEZ ', 'CHRISTIAN ANDRES', 'christian', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'tgocdjslimkbwxephzqvunfyra.jpg', 1, 0, 1),
(37, '5', 'julio.jaramillos@unesum.edu.ec', 'JARAMILLO VELEZ', 'JULIO', 'julio', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'licejavnksbomdfygzuwhxrqpt.jpg', 2, 0, 1),
(38, '6', 'carlos.castro@unesum.edu.ec', 'CASTRO PIGUAVE', 'CARLOS ALBERTO', 'carlos', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'iudacfzmtjrhoepnygbqvwskxl.jpg', 2, 0, 1),
(39, '7', 'cesar.verdesoto@unesum.edu.ec', 'VERDESOTO', 'CESAR', 'cesar', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'caxnsdpjkfyoeizqtvwglbuhmr.jpg', 2, 0, 1),
(40, '8', 'carlos.zea@unesum.edu.ec', 'ZEA BARAHONA', 'CARLOS', 'carloszea', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'ofalvebsukhcjxmzrqypwdigtn.jpg', 1, 0, 1),
(41, '9', 'dewis.alvarez@unesum.edu.ec', 'ÁLVAREZ PINCAY', 'DEWIS EDWIN ', 'dewis', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'palebvgrdxqcnjkfuzythiwmos.jpg', 2, 0, 1),
(44, '10', 'washintong.narvaes@unesum.edu.ec', 'NARVAEZ CAMPANA', 'WASHINTONG VICENTE', 'washito', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '', 2, 0, 1),
(45, '11', 'manuel.manobanda@unesum.edu.ec', 'MANOBANDA GUAMAN', 'MANUEL', 'manobanda', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '', 2, 0, 1),
(46, '12', 'pvaldestamayo@gmail.com', 'Apellidos', 'Nombres', 'profesor1', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '', 2, 0, 1),
(47, '13', 'tomas.fuentes@unesum.edu.ec', 'FUENTES FIGUEROA', 'TOMAS ROBERT', 'tomas', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '', 2, 0, 1),
(49, '14', 'yandri.palma@ult.edu.ec', 'PALMA SORNOSA', 'YANDRY ALBERTO', 'yandri', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '', 2, 0, 1),
(50, '15', 'karla.moran@unesum.edu.ec', 'MORAN NIETO', 'KARLA NANESSA', 'karla', '', 'oqunmtrzhbxvkdgafpsjieycwl.jpg', 1, 0, 1),
(53, '72052014978', 'misle.72.04@gmail.com', 'HERNANDEZ AYRA', 'MISLEIDYS', 'misle', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'ghnfrebkyljamvzcopdxistuwq.jpg', 1, 0, 0),
(54, '2004', 'pedrivaldes@gmail.com', 'VALDES HERNANDEZ', 'PEDRO', 'pedri', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '', 2, 0, 0);

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
-- Indices de la tabla `tit_cantones`
--
ALTER TABLE `tit_cantones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_carreras`
--
ALTER TABLE `tit_carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_comunidades`
--
ALTER TABLE `tit_comunidades`
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
-- Indices de la tabla `tit_paises`
--
ALTER TABLE `tit_paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_parroquias`
--
ALTER TABLE `tit_parroquias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_periodos`
--
ALTER TABLE `tit_periodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_provincias`
--
ALTER TABLE `tit_provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tit_proyectos`
--
ALTER TABLE `tit_proyectos`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tit_asignaciones`
--
ALTER TABLE `tit_asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `tit_cantones`
--
ALTER TABLE `tit_cantones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tit_carreras`
--
ALTER TABLE `tit_carreras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tit_comunidades`
--
ALTER TABLE `tit_comunidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tit_coordinadores`
--
ALTER TABLE `tit_coordinadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tit_facultades`
--
ALTER TABLE `tit_facultades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tit_funciones`
--
ALTER TABLE `tit_funciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tit_paises`
--
ALTER TABLE `tit_paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tit_parroquias`
--
ALTER TABLE `tit_parroquias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tit_periodos`
--
ALTER TABLE `tit_periodos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tit_provincias`
--
ALTER TABLE `tit_provincias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tit_proyectos`
--
ALTER TABLE `tit_proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tit_tipo_usuarios`
--
ALTER TABLE `tit_tipo_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tit_universidades`
--
ALTER TABLE `tit_universidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tit_usuarios`
--
ALTER TABLE `tit_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
