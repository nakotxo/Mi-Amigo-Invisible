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
CREATE DATABASE IF NOT EXISTS `amigoinvisible` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `amigoinvisible`;
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
(0, 'Deseo 0', 'Características Deseo 0'),
(1, 'Deseo 1', 'Características Deseo 1'),
(2, 'Deseo 2', 'Características Deseo 2'),
(3, 'Deseo 3', 'Características Deseo 3'),
(4, 'Deseo 4', 'Características Deseo 4'),
(6, 'Deseo 6', 'Características Deseo 6'),
(12, 'Deseo 12', 'Características Deseo 12'),
(56, 'Deseo 56', 'Características Deseos 56'),
(105, 'Deseo 105', 'Características Deseo 105');

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

INSERT INTO `padreususor` (`ID`, `IdSor`, `IdUsu`, `IdAmi`, `IdDes1`, `IdDes2`, `IdDes3`, `IdDes4`, `IdDes5`, `IdAdmin`) VALUES
(20, 5, 0, 2, 0, 0, 0, 0, 0, 0),
(21, 5, 1, 0, 1, 1, 1, 1, 1, 0),
(22, 5, 2, 1, 2, 2, 2, 2, 2, 0),
(23, 6, 0, 1, 0, 0, 0, 0, 0, 0),
(24, 6, 1, 2, 1, 1, 1, 1, 1, 0),
(25, 6, 2, 0, 2, 2, 2, 2, 3, 0),
(44, 7, 4, 11, 0, 0, 0, 0, 0, 4),
(45, 7, 3, 4, 0, 0, 0, 0, 0, 3),
(46, 7, 11, 3, 0, 0, 0, 0, 0, 11),
(47, 8, 11, 6, 0, 0, 0, 0, 0, 11),
(48, 8, 10, 8, 0, 0, 0, 0, 0, 10),
(49, 8, 8, 10, 0, 0, 0, 0, 0, 8),
(50, 8, 7, 11, 0, 0, 0, 0, 0, 7),
(51, 8, 6, 7, 0, 0, 0, 0, 0, 6);

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

INSERT INTO `sorteos` (`SorId`, `SorNom`, `SorFec`, `SorPre`) VALUES
(0, 'Sorteo Nº- 0', '2018-12-31', 100),
(1, 'Sorteo Nº- 1', '2018-12-31', 30),
(2, 'Sorteo Nº- 2', '2018-12-31', 50),
(3, 'Sorteo Nº- 3', '2018-12-31', 0),
(4, 'Sorteo Nº- 4', '2018-07-31', 0),
(5, 'Halloween', '2018-10-31', 0),
(6, 'Halloween', '2018-10-31', 0),
(7, 'dsfad', '2018-10-31', 45),
(8, 'dsfad', '2018-10-31', 45);

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
(0, 'Root', 'Jose Ignacio', 'SuperAdmin', 'nakocho@hotmail.com'),
(1, 'Admin', 'Admin', 'Admin', 'Admin@admin.com'),
(2, 'Usu', 'Usu2', 'Usu2', 'Usu2@Usu2.com'),
(3, 'Usu', 'Usu3', 'Usu3', 'Usu3@Usu3.com'),
(4, 'Usu', 'Usu4', 'Usu4', 'Usu4@Usu4.com'),
(5, 'Usu', 'Usu5', '0cc175b9c0f1b6a831c399e269772661', 'a'),
(6, 'Usu', 'Usu6', '92eb5ffee6ae2fec3ad71c777531578f', 'b'),
(7, 'Usu', 'Usu7', '4a8a08f09d37b73795649038408b5f33', 'c'),
(8, 'Usu', 'Usu8', 'd41d8cd98f00b204e9800998ecf8427e', 'Usu8@Usu8.com'),
(9, 'Usu', 's', '03c7c0ace395d80182db07ae2c30f034', 's'),
(10, 'Usu', 'rt', '822050d9ae3c47f54bee71b85fce1487', 'rt'),
(11, 'Usu', 'a', '0cc175b9c0f1b6a831c399e269772661', 'a'),
(12, 'Usu', 'Usu12', 'Usu12', 'Usu12@usu12.com'),
(13, 'Usu', 'Usu13', 'Usu13', 'Usu13@usu13.com'),
(14, 'Usu', 'df', 'eff7d5dba32b4da32d9a67a519434d3f', 'df'),
(15, 'Usu', 'p', '83878c91171338902e0fe0fb97a8c47a', 'p'),
(16, 'Usu', 'we', 'ff1ccf57e98c817df1efcd9fe44a8aeb', 'we');

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
