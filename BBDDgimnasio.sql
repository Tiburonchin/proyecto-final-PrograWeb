-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2021 a las 17:29:15
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gimnasio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaclases`
--

CREATE TABLE `asistenciaclases` (
  `id` int(11) NOT NULL,
  `idClase` int(11) NOT NULL,
  `idAlumno` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistenciaclases`
--

INSERT INTO `asistenciaclases` (`id`, `idClase`, `idAlumno`) VALUES
(0, 1, 2),
(0, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `Imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `nombre`, `descripcion`,`Imagen`) VALUES
(1, 'Yoga','El yoga es una tradicional disciplina física y mental que se originó en la India. El yoga enfatiza la meditación y la liberación y su texto principal es el Yoga sutra (400 d.C.) La palabra se asocia con prácticas de meditación en el hinduismo, el budismo y el jainismo.','yoga.jpg'),
(2, 'Spinning','El spinning es un tipo de ejercicio aeróbico que se realiza con una bicicleta estática.','spinning.jpg'),
(3, 'Aikido', 'La característica fundamental del aikido como arte marcial consiste en la neutralización de uno o más adversarios, armados o no, en el menor tiempo y espacio posible e independientemente de la masa, género, edad o fuerza física del practicante.','aikido.jpg'),
(4, 'Aerobic', 'Aeróbic o aerobic es un tipo de gimnasia que se realiza al son de la música, en un gimnasio, un salón o al aire libre. El aeróbic reúne todos los beneficios del ejercicio aeróbico, además de ejercitar capacidades físicas como la flexibilidad, coordinación, orientación, ritmo, etc.','aerobic.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasesexistentes`
--

CREATE TABLE `clasesexistentes` (
  `id` int(11) NOT NULL,
  `idClase` int(11) NOT NULL,
  `Dia` varchar(10) NOT NULL,
  `duracion` int(2) DEFAULT NULL,
  `horaInicio` varchar(5) NOT NULL,
  `horaFin` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clasesexistentes`
--

INSERT INTO `clasesexistentes` (`id`, `idClase`, `Dia`, `duracion`, `horaInicio`, `horaFin`) VALUES
(1, 1, 'Lunes', NULL, '07:00', '08:00'),
(2, 2, 'Martes', NULL, '09:00', '10:00'),
(3, 3, 'Miercoles', NULL, '07:00', '08:00'),
(4, 1, 'Jueves', NULL, '09:00', '10:00'),
(5, 2, 'Viernes', NULL, '07:00', '08:00'),
(6, 3, 'Sabado', NULL, '09:00', '10:00'),
(7, 1, 'Lunes', NULL, '16:00', '17:00'),
(8, 2, 'Martes', NULL, '19:00', '20:00'),
(9, 3, 'Miercoles', NULL, '16:00', '17:00'),
(10, 1, 'Jueves', NULL, '19:00', '20:00'),
(11, 2, 'Viernes', NULL, '16:00', '17:00'),
(12, 3, 'Sabado', NULL, '19:00', '20:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nif` varchar(9) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido1` varchar(50) DEFAULT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `telefono` int(12) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `rol_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nif`, `nombre`, `apellido1`, `apellido2`, `usuario`, `password`, `email`, `imagen`, `telefono`, `direccion`, `rol_id`) VALUES
(1, '49118359L', 'Manuel', 'Urbano', '', 'manu', '123', 'saddasd2@gmail.es', NULL, 666666666, 'Calle 123,3', 0),
(2, '49118359L', 'Ana', 'Maria', 'Perez', 'ana', '123', 'saddasd2@gmail.es', NULL, 666666666, 'Av.Andalucia,4', 1),
(3, '49118359L', 'Pedro', 'Marquez', 'Garcia', 'Pedrito', '123', '123@gmail.com', NULL, 666666666, 'Calle Paz123,5A', 2),
(4, '49118359L', 'Carlos', 'Crivi', 'Perez', 'Carlitos', '123', 'carlos123@gmail.com', NULL, 666666666, 'Calle Loco,123', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clasesexistentes`
--
ALTER TABLE `clasesexistentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clasesexistentes`
--
ALTER TABLE `clasesexistentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
