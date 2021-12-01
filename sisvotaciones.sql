-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2021 a las 00:30:18
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisvotaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidato`
--

CREATE TABLE `candidato` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Apellido` varchar(60) NOT NULL,
  `Partido` int(11) NOT NULL,
  `Puesto` int(60) NOT NULL,
  `Foto` varchar(100) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `candidato`
--

INSERT INTO `candidato` (`Id`, `Nombre`, `Apellido`, `Partido`, `Puesto`, `Foto`, `Estado`) VALUES
(10, 'Maria', 'Martínez', 2, 10, 'microservices.png', 1),
(11, 'Felipe', 'Cuevas', 2, 11, 'microkernel.png', 1),
(12, 'Marcelo', 'Tejeda', 3, 10, 'cliente-servidor.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudadanos`
--

CREATE TABLE `ciudadanos` (
  `cedula` varchar(70) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudadanos`
--

INSERT INTO `ciudadanos` (`cedula`, `nombre`, `apellido`, `email`, `estado`) VALUES
('001-0646787-2', 'Antinoti Marcill', 'Tejadas Molina', 'anti15@gmail.com', 0),
('004-5544554-5', 'Miguelina', 'Altagracia', 'miguela5@gmail.com', 1),
('402-2653917-4', 'Andri Manuel', 'Bonilla Guzmán', '20186551@itla.edu.do', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eleccion`
--

CREATE TABLE `eleccion` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `FechaRealizacion` date NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eleccion`
--

INSERT INTO `eleccion` (`Id`, `Nombre`, `FechaRealizacion`, `Estado`) VALUES
(1, 'Selección comité ITLA', '2021-05-05', 0),
(2, 'Junta de Vecinos', '2021-04-30', 0),
(3, 'Lider Proyecto WEb', '2021-04-26', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Logo` varchar(110) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`Id`, `Nombre`, `Descripcion`, `Logo`, `Estado`) VALUES
(1, 'PRM', 'Partido Revolucionario Moderno', 'microservices.png', 1),
(2, 'PRSC', 'Partido Revolucionario Social Cristiano', 'reindeer-5706627_640.png', 1),
(3, 'PLD', 'Partido de la Liberación Dominicana', 'cliente-servidor.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`Id`, `Nombre`, `Descripcion`, `Estado`) VALUES
(10, 'Alcalde', 'Maneja la Alcaldía', 1),
(11, 'Presidente', 'Maneja la presidencia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE `resultado` (
  `EleccionId` int(11) NOT NULL,
  `PuestoId` int(11) NOT NULL,
  `CandidatoId` int(11) NOT NULL,
  `Votos` int(11) NOT NULL,
  `Porcentaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `NombreUsuario` varchar(150) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Nombre`, `Apellido`, `Email`, `NombreUsuario`, `Contrasena`, `Estado`) VALUES
(1, 'Leonardo', 'Tavarez', 'leonardotb.93@gmail.com', 'leo93', '1234', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_partido` (`Partido`),
  ADD KEY `fk_puesto` (`Puesto`);

--
-- Indices de la tabla `ciudadanos`
--
ALTER TABLE `ciudadanos`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `eleccion`
--
ALTER TABLE `eleccion`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD KEY `Fk_candidato` (`CandidatoId`),
  ADD KEY `Fk_eleccion` (`EleccionId`),
  ADD KEY `fk_puestos` (`PuestoId`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `candidato`
--
ALTER TABLE `candidato`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `eleccion`
--
ALTER TABLE `eleccion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candidato`
--
ALTER TABLE `candidato`
  ADD CONSTRAINT `fk_puesto` FOREIGN KEY (`Puesto`) REFERENCES `puesto` (`Id`);

--
-- Filtros para la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `Fk_candidato` FOREIGN KEY (`CandidatoId`) REFERENCES `candidato` (`Id`),
  ADD CONSTRAINT `Fk_eleccion` FOREIGN KEY (`EleccionId`) REFERENCES `eleccion` (`Id`),
  ADD CONSTRAINT `fk_puestos` FOREIGN KEY (`PuestoId`) REFERENCES `puesto` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
