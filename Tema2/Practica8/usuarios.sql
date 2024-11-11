-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-11-2024 a las 09:34:21
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
-- Base de datos: `bd_cv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `sexo` enum('hombre','mujer') NOT NULL,
  `foto` varchar(30) NOT NULL DEFAULT 'no_imagen.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `nombre`, `dni`, `sexo`, `foto`) VALUES
(1, 'calvarez', 'e10adc3949ba59abbe56e057f20f883e', 'Clara Álvarez', '78980976B', 'mujer', 'no_imagen.jpg'),
(2, 'nperez', 'e10adc3949ba59abbe56e057f20f883e', 'Noelia Perez', '123456789N', 'mujer', 'no_imagen.jpg'),
(3, 'vmena', 'e10adc3949ba59abbe56e057f20f883e', 'Víctor Mena', '789456123V', 'hombre', 'no_imagen.jpg'),
(4, 'salejandro', 'e10adc3949ba59abbe56e057f20f883e', 'Samuel Alejandro', '741258963S', 'hombre', 'no_imagen.jpg'),
(5, 'dio', 'e10adc3949ba59abbe56e057f20f883e', 'Diómedes', '96328741D', 'hombre', 'no_imagen.jpg'),
(6, 'koko', '25f9e794323b453885f5181f1b624d0b', 'Kokoro', '852159753K', 'mujer', 'no_imagen.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
