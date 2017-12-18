-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 18-12-2017 a les 19:44:39
-- Versió del servidor: 5.7.20-0ubuntu0.16.04.1
-- Versió de PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `Encuestas`
--
CREATE DATABASE IF NOT EXISTS `Encuestas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Encuestas`;

-- --------------------------------------------------------

--
-- Estructura de la taula `Consultas`
--

DROP TABLE IF EXISTS `Consultas`;
CREATE TABLE `Consultas` (
  `id_consulta` int(5) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `id_admin` int(5) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `Consultas`
--

INSERT INTO `Consultas` (`id_consulta`, `descripcion`, `id_admin`, `fechaInicial`, `fechaFinal`) VALUES
(31, 'Consulta 1', 1, '2017-12-05', '2017-12-29'),
(33, 'Blanco o negro?', 1, '2017-12-11', '2018-01-31');

-- --------------------------------------------------------

--
-- Estructura de la taula `Invitaciones`
--

DROP TABLE IF EXISTS `Invitaciones`;
CREATE TABLE `Invitaciones` (
  `id_admin` int(5) NOT NULL,
  `id_consulta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `Invitaciones`
--

INSERT INTO `Invitaciones` (`id_admin`, `id_consulta`) VALUES
(1, 31),
(1, 33);

-- --------------------------------------------------------

--
-- Estructura de la taula `Opciones`
--

DROP TABLE IF EXISTS `Opciones`;
CREATE TABLE `Opciones` (
  `id_opcion` int(5) NOT NULL,
  `id_consulta` int(5) NOT NULL,
  `texto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `Opciones`
--

INSERT INTO `Opciones` (`id_opcion`, `id_consulta`, `texto`) VALUES
(29, 31, 'Opcion 1'),
(30, 31, 'Opcion 2'),
(34, 33, 'Blanco'),
(35, 33, 'Negro');

-- --------------------------------------------------------

--
-- Estructura de la taula `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
CREATE TABLE `Usuarios` (
  `id_user` int(5) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `Usuarios`
--

INSERT INTO `Usuarios` (`id_user`, `nombre`, `apellido`, `email`, `password`, `isAdmin`, `token`) VALUES
(1, 'admin', 'General', 'admin@general.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, ''),
(2, 'public', 'general', 'public@gmail.com', '61c9b2b17db77a27841bbeeabff923448b0f6388', 0, '');

-- --------------------------------------------------------

--
-- Estructura de la taula `VotosOpcion`
--

DROP TABLE IF EXISTS `VotosOpcion`;
CREATE TABLE `VotosOpcion` (
  `id_voto` int(11) NOT NULL,
  `id_opcion` int(5) NOT NULL,
  `hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `VotosUsuario`
--

DROP TABLE IF EXISTS `VotosUsuario`;
CREATE TABLE `VotosUsuario` (
  `id_voto` int(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hash_enc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `Consultas`
--
ALTER TABLE `Consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_admin` (`id_admin`) USING BTREE,
  ADD KEY `fechaInicial` (`fechaInicial`),
  ADD KEY `fechaFinal` (`fechaFinal`);

--
-- Index de la taula `Invitaciones`
--
ALTER TABLE `Invitaciones`
  ADD PRIMARY KEY (`id_admin`,`id_consulta`),
  ADD KEY `consultasInvitaciones` (`id_consulta`);

--
-- Index de la taula `Opciones`
--
ALTER TABLE `Opciones`
  ADD PRIMARY KEY (`id_opcion`),
  ADD KEY `id_consulta` (`id_consulta`) USING BTREE;

--
-- Index de la taula `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- Index de la taula `VotosOpcion`
--
ALTER TABLE `VotosOpcion`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `id_opcion` (`id_opcion`);

--
-- Index de la taula `VotosUsuario`
--
ALTER TABLE `VotosUsuario`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `Consultas`
--
ALTER TABLE `Consultas`
  MODIFY `id_consulta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT per la taula `Opciones`
--
ALTER TABLE `Opciones`
  MODIFY `id_opcion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT per la taula `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la taula `VotosOpcion`
--
ALTER TABLE `VotosOpcion`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la taula `VotosUsuario`
--
ALTER TABLE `VotosUsuario`
  MODIFY `id_voto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `Consultas`
--
ALTER TABLE `Consultas`
  ADD CONSTRAINT `admins` FOREIGN KEY (`id_admin`) REFERENCES `Usuarios` (`id_user`);

--
-- Restriccions per la taula `Invitaciones`
--
ALTER TABLE `Invitaciones`
  ADD CONSTRAINT `consultasInvitaciones` FOREIGN KEY (`id_consulta`) REFERENCES `Consultas` (`id_consulta`),
  ADD CONSTRAINT `userInvitaciones` FOREIGN KEY (`id_admin`) REFERENCES `Usuarios` (`id_user`);

--
-- Restriccions per la taula `Opciones`
--
ALTER TABLE `Opciones`
  ADD CONSTRAINT `consultas` FOREIGN KEY (`id_consulta`) REFERENCES `Consultas` (`id_consulta`);

--
-- Restriccions per la taula `VotosOpcion`
--
ALTER TABLE `VotosOpcion`
  ADD CONSTRAINT `opcion` FOREIGN KEY (`id_opcion`) REFERENCES `Opciones` (`id_opcion`);

--
-- Restriccions per la taula `VotosUsuario`
--
ALTER TABLE `VotosUsuario`
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_user`) REFERENCES `Usuarios` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
