-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2026 a las 22:57:34
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
-- Base de datos: `biocenter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `password`, `email`, `token`, `token_expira`) VALUES
(1, 'admin', '$2y$10$NZ6RF5hV/8JWt4Y4nfL8.uIsDUs6ajIw80OYTICRJlTKTE1TEB6Ny', 'perdomomiguel2004@gmail.com', 'a0db2a848fac6939ee62636a188541f58f31bf34c6d3897de8031c1316ac3b41bdef89d1cc1445dabea79be622cbdce3dc1a', '2026-02-17 20:20:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `email` varchar(120) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `tipo_servicio` enum('Medico Ocupacional','Optometria','Audiometria','Laboratorios') NOT NULL,
  `tipo_usuario` enum('Persona Natural','Empresa') NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` enum('Pendiente','Confirmada','Cancelada') DEFAULT 'Pendiente',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `nombre_completo`, `email`, `telefono`, `tipo_servicio`, `tipo_usuario`, `fecha`, `hora`, `estado`, `fecha_registro`, `observaciones`) VALUES
(1, 'Miguel', 'sistemas@gamil.com', '3160539301', 'Optometria', 'Persona Natural', '2026-02-18', '08:00:00', 'Pendiente', '2026-02-17 17:58:15', 'Pruebaaa'),
(2, 'PRUEBA', 'thebugscompile@gmail.com', '3133854821', 'Medico Ocupacional', 'Empresa', '2026-02-18', '09:00:00', 'Pendiente', '2026-02-17 18:01:56', 'Purba'),
(3, 'miguel', 'biocentersaludocupacional@gmail.com', '3123591195', 'Laboratorios', 'Empresa', '2026-02-19', '12:00:00', 'Pendiente', '2026-02-17 18:03:08', 'sdfafaswdfasdf'),
(4, 'Miguel', 'thebugscompile@gmail.com', '3160539301', 'Optometria', 'Empresa', '2026-02-17', '12:00:00', 'Pendiente', '2026-02-17 18:10:38', 'sdds'),
(5, 'miguel', 'biocentersaludocupacional@gmail.com', '3133854821', 'Audiometria', 'Empresa', '2026-02-17', '08:00:00', 'Pendiente', '2026-02-17 18:13:50', 'VJF'),
(6, 'Miguel', 'thebugscompile@gmail.com', '3133854821', 'Audiometria', 'Empresa', '2026-02-24', '12:00:00', 'Pendiente', '2026-02-17 18:19:38', 'prueba');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
