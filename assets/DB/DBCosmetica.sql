-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2024 a las 19:29:04
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
-- Base de datos: `cosmetica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `ID` smallint(6) NOT NULL,
  `Titulo` varchar(32) NOT NULL,
  `Entrada` varchar(1504) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`ID`, `Titulo`, `Entrada`, `Fecha`) VALUES
(1, 'Primera Entrada', 'Hola, esta es una entrada de ejemplo', '2024-02-27 10:36:22'),
(2, 'Segunda Entrada', 'Hola, esta es la segunda entrada', '2024-02-27 10:58:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `IDUsuario` int(11) NOT NULL,
  `IDProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ies`
--

CREATE TABLE `ies` (
  `telf` varchar(9) NOT NULL,
  `web` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ies`
--

INSERT INTO `ies` (`telf`, `web`, `nombre`, `email`, `ID`) VALUES
('886120464', 'www.edu.xunta.gal/centros/iesteis', 'IES de Teis', 'ies.teis@edu.xunta.es', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `ID` smallint(6) NOT NULL,
  `ID_Musica` smallint(6) NOT NULL,
  `Nombre` varchar(16) NOT NULL,
  `Color` varchar(6) NOT NULL,
  `Descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`ID`, `ID_Musica`, `Nombre`, `Color`, `Descripcion`) VALUES
(1, 1, 'Revitalizante', 'FFC0CB', 'Elaborada con precisión e infundida con los ingredientes revitalizantes más potentes de la naturaleza, esta gama de cuidado de la piel está diseñada para dar nueva vida a tu piel, revelando un cutis radiante y rejuvenecido.'),
(2, 2, 'Relajante', 'AF49FC', 'Con precisión y los ingredientes más potentes, esta gama de cuidado de la piel da vida a tu cutis, revelando una piel radiante y rejuvenecida. Déjate envolver por la frescura y el rejuvenecimiento que esta línea ofrece, y experimenta la sensación de una piel revitalizada y llena de vitalidad.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `Precio` double NOT NULL,
  `Stock` int(100) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `ID_Linea` smallint(6) NOT NULL,
  `Nombre` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `Precio`, `Stock`, `Descripcion`, `ID_Linea`, `Nombre`) VALUES
(1, 20, 10, 'demo', 1, 'Aceite'),
(2, 5, 25, 'demo2', 1, 'Ambientador'),
(3, 15, 40, 'demo3', 1, 'Colonia'),
(4, 10, 10, 'demo4', 1, 'Exfoliante'),
(5, 18, 20, 'demo5', 1, 'Sales'),
(6, 6, 50, 'demo6', 1, 'Vela'),
(7, 20, 10, 'demo', 2, 'Aceite'),
(8, 5, 25, 'demo2', 2, 'Ambientador'),
(9, 15, 40, 'demo3', 2, 'Colonia'),
(10, 10, 10, 'demo4', 2, 'Exfoliante'),
(11, 18, 20, 'demo5', 2, 'Sales'),
(12, 6, 50, 'demo6', 2, 'Vela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'alumno'),
(3, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD KEY `fk_idusuario` (`IDUsuario`),
  ADD KEY `fk_idproducto` (`IDProducto`);

--
-- Indices de la tabla `ies`
--
ALTER TABLE `ies`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProductLine` (`ID_Linea`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `fk_rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ies`
--
ALTER TABLE `ies`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_idproducto` FOREIGN KEY (`IDProducto`) REFERENCES `productos` (`ID`),
  ADD CONSTRAINT `fk_idusuario` FOREIGN KEY (`IDUsuario`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `ProductLine` FOREIGN KEY (`ID_Linea`) REFERENCES `lineas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
