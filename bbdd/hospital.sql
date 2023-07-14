-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2023 a las 08:31:39
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--
CREATE DATABASE IF NOT EXISTS `hospital` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hospital`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL,
  `nif` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `apellidos` varchar(100) CHARACTER SET latin1 NOT NULL,
  `fechaingreso` date NOT NULL,
  `fechaalta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpaciente`, `nif`, `nombre`, `apellidos`, `fechaingreso`, `fechaalta`) VALUES
(19, '40000000A', 'Jose Luis', 'Torrente', '2012-12-15', NULL),
(38, '41000000B', 'Mariana', 'Cuchufletas', '0000-00-00', NULL),
(56, '47000000H', 'Marianico', 'El Corto', '2000-01-06', '2020-09-07'),
(60, '10000206H', 'Louis', 'Griffin', '2020-08-05', '2021-10-08'),
(61, '43330014L', 'John', 'Rambo', '2020-09-01', '0000-00-00'),
(179, '12345678K', 'Peter', 'Clemenza', '2022-06-10', NULL),
(241, '10000002C', 'Beatrix', 'Kiddo', '2023-05-04', NULL),
(249, '10000001B', 'Arch', 'Stanton', '2023-05-02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nif` char(9) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nif`, `nombre`, `apellidos`, `password`) VALUES
(1, '40000001A', 'David', 'Alcolea', 'admin'),
(2, '42000002T', 'Gogo', 'Yubari', 'gogo'),
(3, '42006602T', 'Tucco', 'Beneditto', 'tucco');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`),
  ADD UNIQUE KEY `nif_UNIQUE` (`nif`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
