-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2025 a las 23:35:46
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
-- Base de datos: `clinica_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialistas`
--

CREATE TABLE `especialistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `horario` varchar(100) NOT NULL,
  `contacto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialistas`
--

INSERT INTO `especialistas` (`id`, `nombre`, `especialidad`, `horario`, `contacto`) VALUES
(1, 'Dr. Juan Pére', 'Cardiología', 'Lunes a Viernes 08:00–12:00', '72451234'),
(2, 'Dra. María López', 'Pediatría', 'Lunes a Viernes 14:00-18:00', '65478901'),
(3, 'Dr. Luis Gutiérrez', 'Dermatología', 'Martes y Jueves 09:00-13:00', '76123456'),
(4, 'Dra. Ana Castro', 'Ginecología', 'Lunes, Miércoles y Viernes 09:00-12:00', '76581234'),
(5, 'Dr. Ricardo Flores', 'Traumatología', 'Martes a Sábado 10:00-15:00', '71234567'),
(6, 'Dra. Claudia Ramos', 'Oftalmología', 'Lunes a Viernes 08:00-11:00', '78965412'),
(7, 'Dr. Miguel Hinojosa', 'Odontología', 'Lunes a Sábado 08:00-12:00', '75896421'),
(8, 'Dra. Karina Velasco', 'Neurología', 'Martes y Jueves 14:00-18:00', '76451239'),
(9, 'Dr. Pablo Montes', 'Psiquiatría', 'Lunes a Viernes 15:00-19:00', '75698412'),
(10, 'Lic. Lorena Aguilar', 'Nutrición', 'Lunes a Viernes 08:00-13:00', '78945126'),
(11, 'Dr. Óscar Maldonado', 'Urología', 'Martes y Viernes 09:00-12:00', '71234985'),
(12, 'Dr. Ernesto Suárez', 'Gastroenterología', 'Miércoles y Viernes 08:00-12:00', '76549123'),
(13, 'Dra. Gabriela Ríos', 'Endocrinología', 'Lunes y Jueves 09:00-13:00', '78912345'),
(14, 'Dr. Ramiro Quispe', 'Reumatología', 'Martes a Sábado 13:00-17:00', '74568912'),
(15, 'Dr. Edwin Flores', 'Medicina Interna', 'Lunes a Viernes 08:00-12:00', '76459821');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
