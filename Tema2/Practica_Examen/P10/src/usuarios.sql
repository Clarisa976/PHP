-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-11-2024 a las 14:20:31
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
-- Base de datos: `bd_horarios_exam2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tipo` enum('admin','usuario') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `clave`, `email`, `tipo`) VALUES
(1, 'Apellido1 Apellido2, NOMBRE1', 'profesor1', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(2, 'Apellido1 Apellido2, NOMBRE2', 'profesor2', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(3, 'Apellido1 Apellido2, NOMBRE3', 'profesor3', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(4, 'Apellido1 Apellido2, NOMBRE4', 'profesor4', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(5, 'Apellido1 Apellido2, NOMBRE5', 'profesor5', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(6, 'Apellido1 Apellido2, NOMBRE6', 'profesor6', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(7, 'Apellido1 Apellido2, NOMBRE7', 'profesor7', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(8, 'Apellido1 Apellido2, NOMBRE8', 'profesor8', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(9, 'Apellido1 Apellido2, NOMBRE9', 'profesor9', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(10, 'Apellido1 Apellido2, NOMBRE10', 'profesor10', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(11, 'Apellido1 Apellido2, NOMBRE11', 'profesor11', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(12, 'Apellido1 Apellido2, NOMBRE12', 'profesor12', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(13, 'Apellido1 Apellido2, NOMBRE13', 'profesor13', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(14, 'Apellido1 Apellido2, NOMBRE14', 'profesor14', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(15, 'Apellido1 Apellido2, NOMBRE15', 'profesor15', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(16, 'Apellido1 Apellido2, NOMBRE16', 'profesor16', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(17, 'Apellido1 Apellido2, NOMBRE17', 'profesor17', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(18, 'Apellido1 Apellido2, NOMBRE18', 'profesor18', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(19, 'Apellido1 Apellido2, NOMBRE19', 'profesor19', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(20, 'Apellido1 Apellido2, NOMBRE20', 'profesor20', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(21, 'Apellido1 Apellido2, NOMBRE21', 'profesor21', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(22, 'Apellido1 Apellido2, NOMBRE22', 'profesor22', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(23, 'Apellido1 Apellido2, NOMBRE23', 'profesor23', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(24, 'Apellido1 Apellido2, NOMBRE24', 'profesor24', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(25, 'Apellido1 Apellido2, NOMBRE25', 'profesor25', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(26, 'Apellido1 Apellido2, NOMBRE26', 'profesor26', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(27, 'Apellido1 Apellido2, NOMBRE27', 'profesor27', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(28, 'Apellido1 Apellido2, NOMBRE28', 'profesor28', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(29, 'Apellido1 Apellido2, NOMBRE29', 'profesor29', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(30, 'Apellido1 Apellido2, NOMBRE30', 'profesor30', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(31, 'Apellido1 Apellido2, NOMBRE31', 'profesor31', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(32, 'Apellido1 Apellido2, NOMBRE32', 'profesor32', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(33, 'Apellido1 Apellido2, NOMBRE33', 'profesor33', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(34, 'Apellido1 Apellido2, NOMBRE34', 'profesor34', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(35, 'Apellido1 Apellido2, NOMBRE35', 'profesor35', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(36, 'Apellido1 Apellido2, NOMBRE36', 'profesor36', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(37, 'Apellido1 Apellido2, NOMBRE37', 'profesor37', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(38, 'Apellido1 Apellido2, NOMBRE38', 'profesor38', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(39, 'Apellido1 Apellido2, NOMBRE39', 'profesor39', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(40, 'Apellido1 Apellido2, NOMBRE40', 'profesor40', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(41, 'Apellido1 Apellido2, NOMBRE41', 'profesor41', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(42, 'Apellido1 Apellido2, NOMBRE42', 'profesor42', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(43, 'Apellido1 Apellido2, NOMBRE43', 'profesor43', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(44, 'Apellido1 Apellido2, NOMBRE44', 'profesor44', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(45, 'Apellido1 Apellido2, NOMBRE45', 'profesor45', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(46, 'Apellido1 Apellido2, NOMBRE46', 'profesor46', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(47, 'Apellido1 Apellido2, NOMBRE47', 'profesor47', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(48, 'Apellido1 Apellido2, NOMBRE48', 'profesor48', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(49, 'Apellido1 Apellido2, NOMBRE49', 'profesor49', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(50, 'Apellido1 Apellido2, NOMBRE50', 'profesor50', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(51, 'Apellido1 Apellido2, NOMBRE51', 'profesor51', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(52, 'Apellido1 Apellido2, NOMBRE52', 'profesor52', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(53, 'Apellido1 Apellido2, NOMBRE53', 'profesor53', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(54, 'Apellido1 Apellido2, NOMBRE54', 'profesor54', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(55, 'Apellido1 Apellido2, NOMBRE55', 'profesor55', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(56, 'Apellido1 Apellido2, NOMBRE56', 'profesor56', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(57, 'Apellido1 Apellido2, NOMBRE57', 'profesor57', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(58, 'Apellido1 Apellido2, NOMBRE58', 'profesor58', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(59, 'Apellido1 Apellido2, NOMBRE59', 'profesor59', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(60, 'Apellido1 Apellido2, NOMBRE60', 'profesor60', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(61, 'Apellido1 Apellido2, NOMBRE61', 'profesor61', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(62, 'Apellido1 Apellido2, NOMBRE62', 'profesor62', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(63, 'Apellido1 Apellido2, NOMBRE63', 'profesor63', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(64, 'Apellido1 Apellido2, NOMBRE64', 'profesor64', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(65, 'Apellido1 Apellido2, NOMBRE65', 'profesor65', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(66, 'Apellido1 Apellido2, NOMBRE66', 'profesor66', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(67, 'Apellido1 Apellido2, NOMBRE67', 'profesor67', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(68, 'Apellido1 Apellido2, NOMBRE68', 'profesor68', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(69, 'Apellido1 Apellido2, NOMBRE69', 'profesor69', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(70, 'Apellido1 Apellido2, NOMBRE70', 'profesor70', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(71, 'Apellido1 Apellido2, NOMBRE71', 'profesor71', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(72, 'Apellido1 Apellido2, NOMBRE72', 'profesor72', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(73, 'Apellido1 Apellido2, NOMBRE73', 'profesor73', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(74, 'Apellido1 Apellido2, NOMBRE74', 'profesor74', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(75, 'Apellido1 Apellido2, NOMBRE75', 'profesor75', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(76, 'Apellido1 Apellido2, NOMBRE76', 'profesor76', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(77, 'Apellido1 Apellido2, NOMBRE77', 'profesor77', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(78, 'Apellido1 Apellido2, NOMBRE78', 'profesor78', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(79, 'Apellido1 Apellido2, NOMBRE79', 'profesor79', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(80, 'Apellido1 Apellido2, NOMBRE80', 'profesor80', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(81, 'Apellido1 Apellido2, NOMBRE81', 'profesor81', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(82, 'Apellido1 Apellido2, NOMBRE82', 'profesor82', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(83, 'Apellido1 Apellido2, NOMBRE83', 'profesor83', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(84, 'Apellido1 Apellido2, NOMBRE84', 'profesor84', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(85, 'Apellido1 Apellido2, NOMBRE85', 'profesor85', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(86, 'Apellido1 Apellido2, NOMBRE86', 'profesor86', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(87, 'Apellido1 Apellido2, NOMBRE87', 'profesor87', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(88, 'Apellido1 Apellido2, NOMBRE88', 'profesor88', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(89, 'Apellido1 Apellido2, NOMBRE89', 'profesor89', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(90, 'Apellido1 Apellido2, NOMBRE90', 'profesor90', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(91, 'Apellido1 Apellido2, NOMBRE91', 'profesor91', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(92, 'Apellido1 Apellido2, NOMBRE92', 'profesor92', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(93, 'Apellido1 Apellido2, NOMBRE93', 'profesor93', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(94, 'Apellido1 Apellido2, NOMBRE94', 'profesor94', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(95, 'Apellido1 Apellido2, NOMBRE95', 'profesor95', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(96, 'Apellido1 Apellido2, NOMBRE96', 'profesor96', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(97, 'Apellido1 Apellido2, NOMBRE97', 'profesor97', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(98, 'Apellido1 Apellido2, NOMBRE98', 'profesor98', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(99, 'Apellido1 Apellido2, NOMBRE99', 'profesor99', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(100, 'Apellido1 Apellido2, NOMBRE100', 'profesor100', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(101, 'Apellido1 Apellido2, NOMBRE101', 'profesor101', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(102, 'Apellido1 Apellido2, NOMBRE102', 'profesor102', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(103, 'Apellido1 Apellido2, NOMBRE103', 'profesor103', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(104, 'Apellido1 Apellido2, NOMBRE104', 'profesor104', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(105, 'Apellido1 Apellido2, NOMBRE105', 'profesor105', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(106, 'Apellido1 Apellido2, NOMBRE106', 'profesor106', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(107, 'Apellido1 Apellido2, NOMBRE107', 'profesor107', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(108, 'Apellido1 Apellido2, NOMBRE108', 'profesor108', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(109, 'Apellido1 Apellido2, NOMBRE109', 'profesor109', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(110, 'Apellido1 Apellido2, NOMBRE110', 'profesor110', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(111, 'Apellido1 Apellido2, NOMBRE111', 'profesor111', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(112, 'Apellido1 Apellido2, NOMBRE112', 'profesor112', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(113, 'Apellido1 Apellido2, NOMBRE113', 'profesor113', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(114, 'Apellido1 Apellido2, NOMBRE114', 'profesor114', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(115, 'Apellido1 Apellido2, NOMBRE115', 'profesor115', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(116, 'Apellido1 Apellido2, NOMBRE116', 'profesor116', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(117, 'Apellido1 Apellido2, NOMBRE117', 'profesor117', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(118, 'Apellido1 Apellido2, NOMBRE118', 'profesor118', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(119, 'Apellido1 Apellido2, NOMBRE119', 'profesor119', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(120, 'Apellido1 Apellido2, NOMBRE120', 'profesor120', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(121, 'Apellido1 Apellido2, NOMBRE121', 'profesor121', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(122, 'Apellido1 Apellido2, NOMBRE122', 'profesor122', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(123, 'Apellido1 Apellido2, NOMBRE123', 'profesor123', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(124, 'Apellido1 Apellido2, NOMBRE124', 'profesor124', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'usuario'),
(125, 'LA JUNTA', 'director', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'admin');

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
