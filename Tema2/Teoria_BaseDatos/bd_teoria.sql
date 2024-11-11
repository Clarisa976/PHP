-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-10-2024 a las 13:44:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_teoria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_alumnos`
--

CREATE TABLE `t_alumnos` (
  `cod_alu` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `telefono` int(9) NOT NULL,
  `cp` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_alumnos`
--

INSERT INTO `t_alumnos` (`cod_alu`, `nombre`, `telefono`, `cp`) VALUES
(100, 'Juan Perez', 123456789, 29680),
(101, 'Juana Alvaro', 456789123, 29680),
(102, 'Alba Fierro', 789123456, 29680);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignaturas`
--

CREATE TABLE `t_asignaturas` (
  `cod_asig` int(11) NOT NULL,
  `denominacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_asignaturas`
--

INSERT INTO `t_asignaturas` (`cod_asig`, `denominacion`) VALUES
(100, 'Programación'),
(101, 'Diseño'),
(102, 'Despliegue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_notas`
--

CREATE TABLE `t_notas` (
  `cod_alu` int(11) NOT NULL,
  `cod_asig` int(11) NOT NULL,
  `nota` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_notas`
--

INSERT INTO `t_notas` (`cod_alu`, `cod_asig`, `nota`) VALUES
(100, 100, 7),
(100, 101, 6),
(100, 102, 3),
(101, 100, 7),
(101, 101, 7),
(101, 102, 7),
(102, 100, 5),
(102, 101, 9),
(102, 102, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_alumnos`
--
ALTER TABLE `t_alumnos`
  ADD PRIMARY KEY (`cod_alu`);

--
-- Indices de la tabla `t_asignaturas`
--
ALTER TABLE `t_asignaturas`
  ADD PRIMARY KEY (`cod_asig`);

--
-- Indices de la tabla `t_notas`
--
ALTER TABLE `t_notas`
  ADD PRIMARY KEY (`cod_alu`,`cod_asig`),
  ADD KEY `cod_asig` (`cod_asig`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_notas`
--
ALTER TABLE `t_notas`
  ADD CONSTRAINT `t_notas_ibfk_1` FOREIGN KEY (`cod_alu`) REFERENCES `t_alumnos` (`cod_alu`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `t_notas_ibfk_2` FOREIGN KEY (`cod_asig`) REFERENCES `t_asignaturas` (`cod_asig`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
