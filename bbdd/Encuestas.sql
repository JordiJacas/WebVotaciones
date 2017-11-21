-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-11-2017 a las 17:40:11
-- Versión del servidor: 5.7.20-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Encuestas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Consultas`
--

CREATE TABLE `Consultas` (
  `id_consulta` int(5) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `id_admin` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Invitaciones`
--

CREATE TABLE `Invitaciones` (
  `id_admin` int(5) NOT NULL,
  `id_consulta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Opciones`
--

CREATE TABLE `Opciones` (
  `id_opcion` int(5) NOT NULL,
  `id_consulta` int(5) NOT NULL,
  `texto` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id_user` int(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id_user`, `nombre`, `apellido`, `email`, `password`, `isAdmin`) VALUES
(1, 'Admin', 'General', 'admin@general.com', 'admingeneral', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Votos`
--

CREATE TABLE `Votos` (
  `id_voto` int(5) NOT NULL,
  `id_opcion` int(5) NOT NULL,
  `contador` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Consultas`
--
ALTER TABLE `Consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD UNIQUE KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `Invitaciones`
--
ALTER TABLE `Invitaciones`
  ADD PRIMARY KEY (`id_admin`,`id_consulta`),
  ADD KEY `consultasInvitaciones` (`id_consulta`);

--
-- Indices de la tabla `Opciones`
--
ALTER TABLE `Opciones`
  ADD PRIMARY KEY (`id_opcion`),
  ADD UNIQUE KEY `id_consulta` (`id_consulta`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `Votos`
--
ALTER TABLE `Votos`
  ADD PRIMARY KEY (`id_voto`),
  ADD UNIQUE KEY `id_opcion` (`id_opcion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Consultas`
--
ALTER TABLE `Consultas`
  MODIFY `id_consulta` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Opciones`
--
ALTER TABLE `Opciones`
  MODIFY `id_opcion` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Votos`
--
ALTER TABLE `Votos`
  MODIFY `id_voto` int(5) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Consultas`
--
ALTER TABLE `Consultas`
  ADD CONSTRAINT `admins` FOREIGN KEY (`id_admin`) REFERENCES `Usuarios` (`id_user`);

--
-- Filtros para la tabla `Invitaciones`
--
ALTER TABLE `Invitaciones`
  ADD CONSTRAINT `consultasInvitaciones` FOREIGN KEY (`id_consulta`) REFERENCES `Consultas` (`id_consulta`),
  ADD CONSTRAINT `userInvitaciones` FOREIGN KEY (`id_admin`) REFERENCES `Usuarios` (`id_user`);

--
-- Filtros para la tabla `Opciones`
--
ALTER TABLE `Opciones`
  ADD CONSTRAINT `consultas` FOREIGN KEY (`id_consulta`) REFERENCES `Consultas` (`id_consulta`);

--
-- Filtros para la tabla `Votos`
--
ALTER TABLE `Votos`
  ADD CONSTRAINT `opciones` FOREIGN KEY (`id_opcion`) REFERENCES `Opciones` (`id_opcion`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
