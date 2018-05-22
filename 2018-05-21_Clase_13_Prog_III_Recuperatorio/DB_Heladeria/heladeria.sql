-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2018 a las 02:54:53
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `heladeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `nacionalidad` varchar(256) NOT NULL,
  `sexo` varchar(8) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `nacionalidad`, `sexo`, `edad`) VALUES
(1, 'Augusto Rosendo', 'argentina', 'm', 32),
(2, 'Lorena Paredes', 'paraguaya', 'f', 25),
(3, 'Maria Gomez', 'argentina', 'f', 45),
(4, 'Mauro Aguilar', 'colombiana', 'm', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `turno` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`nombre`, `turno`, `tipo`, `id`) VALUES
('Paul Landers', 'dia', 'novato', 4),
('Edith Piaf', 'noche', 'jefe', 5),
('Till Lindeman', 'dia', 'novato', 6),
('Oliver Riedel', 'noche', 'jefe', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `helados`
--

CREATE TABLE `helados` (
  `id_helado` int(11) NOT NULL,
  `sabor` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float NOT NULL,
  `tipo` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `helados`
--

INSERT INTO `helados` (`id_helado`, `sabor`, `precio`, `tipo`, `cantidad`) VALUES
(1, 'frutilla', 95, 'crema', 5),
(2, 'frutilla', 75, 'agua', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

CREATE TABLE `local` (
  `idLocal` int(11) NOT NULL,
  `dirección` varchar(50) NOT NULL,
  `idLocalidad` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `local`
--

INSERT INTO `local` (`idLocal`, `dirección`, `idLocalidad`, `estado`) VALUES
(1, 'av nazca 103', 2, 'abierto'),
(2, 'piedras 147', 1, 'cerrado'),
(3, 'mitre 614', 3, 'abierto'),
(4, 'belgrano 1564', 1, 'abierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `idLocalidad` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`idLocalidad`, `nombre`, `provincia`, `estado`) VALUES
(1, 'avellaneda', 'buenos aires', 'abierto'),
(2, 'lanus', 'buenos aires', 'abierto'),
(3, 'avellaneda', 'santa fe', 'cerrado'),
(4, 'moron', 'buenos aires', 'cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `idLocal` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idHelado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `sabor` varchar(128) NOT NULL,
  `tipo` varchar(128) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `helados`
--
ALTER TABLE `helados`
  ADD PRIMARY KEY (`id_helado`);

--
-- Indices de la tabla `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`idLocal`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`idLocalidad`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `helados`
--
ALTER TABLE `helados`
  MODIFY `id_helado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `local`
--
ALTER TABLE `local`
  MODIFY `idLocal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `idLocalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
