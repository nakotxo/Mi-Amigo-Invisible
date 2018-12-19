-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2018 a las 15:08:13
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Base de datos: `amigoinvisible`
--
/*CREATE DATABASE IF NOT EXISTS `amigoinvisible` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `amigoinvisible`;*/

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deseos`
--

CREATE TABLE `deseos` (
  `DesId` int(11) NOT NULL COMMENT 'Identificador Deseo',
  `DesNom` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre Deseo',
  `DesCar` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Características Deseo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `deseos`
--

INSERT INTO `deseos` (`DesId`, `DesNom`, `DesCar`) VALUES
(0, 'Nodefinido', 'No Definido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padreususor`
--

CREATE TABLE `padreususor` (
  `ID` int(11) NOT NULL,
  `IdSor` int(11) NOT NULL,
  `IdUsu` int(11) NOT NULL,
  `IdAmi` int(11) NOT NULL,
  `IdDes1` int(11) NOT NULL,
  `IdDes2` int(11) NOT NULL,
  `IdDes3` int(11) NOT NULL,
  `IdDes4` int(11) NOT NULL,
  `IdDes5` int(11) NOT NULL,
  `IdAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `padreususor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sorteos`
--

CREATE TABLE `sorteos` (
  `SorId` int(11) NOT NULL COMMENT 'Identificador',
  `SorNom` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre',
  `SorFec` date NOT NULL COMMENT 'Fecha Sorteo',
  `SorPre` int(11) NOT NULL COMMENT 'Presupuesto para los Deseos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sorteos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuId` int(11) NOT NULL COMMENT 'Identificador',
  `UsuRol` enum('Admin','Usu','Root') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Rol Administrador/Usuario/Root',
  `UsuNom` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre',
  `UsuPwd` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Password',
  `UsuEma` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'E-mail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`UsuId`, `UsuRol`, `UsuNom`, `UsuPwd`, `UsuEma`) VALUES
(0, 'Root', 'Root', 'Root', 'nakocho@hotmail.com'),
(1, 'Admin', 'Admin', 'Admin', 'Admin@admin.com'),
(2, 'Usu', 'Usu2', 'Usu2', 'Usu2@Usu2.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `deseos`
--
ALTER TABLE `deseos`
  ADD PRIMARY KEY (`DesId`);

--
-- Indices de la tabla `padreususor`
--
ALTER TABLE `padreususor`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IdUsu` (`IdUsu`,`IdSor`,`IdDes1`,`IdDes2`,`IdDes3`,`IdDes4`,`IdDes5`) USING BTREE,
  ADD KEY `IdDes1` (`IdDes1`),
  ADD KEY `IdSor` (`IdSor`),
  ADD KEY `IdDes2` (`IdDes2`),
  ADD KEY `IdDes3` (`IdDes3`),
  ADD KEY `IdDes4` (`IdDes4`),
  ADD KEY `IdDes5` (`IdDes5`),
  ADD KEY `IdAmi` (`IdAmi`),
  ADD KEY `IdAdmin` (`IdAdmin`);

--
-- Indices de la tabla `sorteos`
--
ALTER TABLE `sorteos`
  ADD PRIMARY KEY (`SorId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `padreususor`
--
ALTER TABLE `padreususor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `padreususor`
--
ALTER TABLE `padreususor`
  ADD CONSTRAINT `padreususor_ibfk_1` FOREIGN KEY (`IdDes1`) REFERENCES `deseos` (`DesId`),
  ADD CONSTRAINT `padreususor_ibfk_2` FOREIGN KEY (`IdSor`) REFERENCES `sorteos` (`SorId`),
  ADD CONSTRAINT `padreususor_ibfk_3` FOREIGN KEY (`IdUsu`) REFERENCES `usuarios` (`UsuId`),
  ADD CONSTRAINT `padreususor_ibfk_4` FOREIGN KEY (`IdDes2`) REFERENCES `deseos` (`DesId`),
  ADD CONSTRAINT `padreususor_ibfk_5` FOREIGN KEY (`IdDes3`) REFERENCES `deseos` (`DesId`),
  ADD CONSTRAINT `padreususor_ibfk_6` FOREIGN KEY (`IdDes4`) REFERENCES `deseos` (`DesId`),
  ADD CONSTRAINT `padreususor_ibfk_7` FOREIGN KEY (`IdDes5`) REFERENCES `deseos` (`DesId`),
  ADD CONSTRAINT `padreususor_ibfk_8` FOREIGN KEY (`IdAmi`) REFERENCES `usuarios` (`UsuId`),
  ADD CONSTRAINT `padreususor_ibfk_9` FOREIGN KEY (`IdAdmin`) REFERENCES `usuarios` (`UsuId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
