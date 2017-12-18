-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 13-12-2017 a les 20:00:57
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
(31, 'Consulta 1', 1, '2017-12-05', '2017-12-21'),
(32, 'Prueba apertura', 1, '2017-12-03', '2017-12-21');

-- --------------------------------------------------------

--
-- Estructura de la taula `Invitaciones`
--

CREATE TABLE `Invitaciones` (
  `id_admin` int(5) NOT NULL,
  `id_consulta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `Opciones`
--

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
(31, 32, 'Opcion 1'),
(32, 32, 'Opcion 2'),
(33, 32, 'Opcion 3');

-- --------------------------------------------------------

--
-- Estructura de la taula `Usuarios`
--

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
(1, 'Admin', 'General', 'admin@general.com', '55133c9aa03017a76fd569121c2aea86e981d43a', 1, ''),
(2, 'public', 'general', 'public@gmail.com', '61c9b2b17db77a27841bbeeabff923448b0f6388', 0, ''),
(3, 'Moises', 'Ortega', 'mortegarodriguez@iesesteveterradas.cat', '033614ceb3ae465f9ec6dccd19d3a918dd7ffd2b', 1, ''),
(5, NULL, NULL, 'jjacasventura@iesesteveterradas.cat', NULL, 1, 'abcd1234');

-- --------------------------------------------------------

--
-- Estructura de la taula `Votos`
--

CREATE TABLE `Votos` (
  `id_voto` int(5) NOT NULL,
  `id_opcion` int(5) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `Votos`
--

INSERT INTO `Votos` (`id_voto`, `id_opcion`, `id_user`) VALUES
(1, 31, 2),
(2, 32, 1),
(3, 32, 3);

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
-- Index de la taula `Votos`
--
ALTER TABLE `Votos`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `id_opcion` (`id_opcion`) USING BTREE,
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `Consultas`
--
ALTER TABLE `Consultas`
  MODIFY `id_consulta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT per la taula `Opciones`
--
ALTER TABLE `Opciones`
  MODIFY `id_opcion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT per la taula `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la taula `Votos`
--
ALTER TABLE `Votos`
  MODIFY `id_voto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
-- Restriccions per la taula `Votos`
--
ALTER TABLE `Votos`
  ADD CONSTRAINT `opciones` FOREIGN KEY (`id_opcion`) REFERENCES `Opciones` (`id_opcion`),
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_user`) REFERENCES `Usuarios` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;