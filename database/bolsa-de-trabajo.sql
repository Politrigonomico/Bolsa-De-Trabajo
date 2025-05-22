-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2025 a las 01:55:29
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
-- Base de datos: `bolsa-de-trabajo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carnets`
--

CREATE TABLE `carnets` (
  `id` int(11) NOT NULL,
  `carnetTipo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(250) NOT NULL,
  `razonSocial` varchar(250) NOT NULL,
  `cuit` varchar(13) NOT NULL,
  `rubro` varchar(250) NOT NULL,
  `contacto` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `celular` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `observacionEmp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulantes`
--

CREATE TABLE `postulantes` (
  `id` int(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `dni` int(8) NOT NULL,
  `cuil` varchar(13) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `domicilio` varchar(250) NOT NULL,
  `ciudad` varchar(250) NOT NULL,
  `nacimiento` date NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `cursos` varchar(250) NOT NULL,
  `observacionEdu` varchar(250) NOT NULL,
  `rubro` varchar(250) NOT NULL,
  `experiencia` varchar(250) NOT NULL,
  `empleado` tinyint(1) NOT NULL,
  `tipoEmpleo` varchar(250) NOT NULL,
  `empresa` varchar(250) NOT NULL,
  `carnet` varchar(250) NOT NULL,
  `observacionCarnet` varchar(250) NOT NULL,
  `idiomas` tinyint(1) NOT NULL,
  `observacionIdioma` varchar(250) NOT NULL,
  `practica` tinyint(1) NOT NULL,
  `pasante` tinyint(1) NOT NULL,
  `vigencia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(11) NOT NULL,
  `rubro` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos`
--

CREATE TABLE `titulos` (
  `id` int(250) NOT NULL,
  `titulo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carnets`
--
ALTER TABLE `carnets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carnetTipo` (`carnetTipo`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `razonSocial` (`razonSocial`);

--
-- Indices de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `rubro` (`rubro`),
  ADD KEY `titulo` (`titulo`),
  ADD KEY `carnet` (`carnet`),
  ADD KEY `empresa` (`empresa`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rubro` (`rubro`);

--
-- Indices de la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titulo` (`titulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carnets`
--
ALTER TABLE `carnets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `titulos`
--
ALTER TABLE `titulos`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD CONSTRAINT `postulantes_ibfk_1` FOREIGN KEY (`rubro`) REFERENCES `rubros` (`rubro`),
  ADD CONSTRAINT `postulantes_ibfk_2` FOREIGN KEY (`titulo`) REFERENCES `titulos` (`titulo`),
  ADD CONSTRAINT `postulantes_ibfk_3` FOREIGN KEY (`carnet`) REFERENCES `carnets` (`carnetTipo`),
  ADD CONSTRAINT `postulantes_ibfk_4` FOREIGN KEY (`empresa`) REFERENCES `empresas` (`razonSocial`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
