-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-04-2014 a las 14:41:20
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `can-la-es`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alianza`
--

CREATE TABLE IF NOT EXISTS `alianza` (
  `idAlianza` int(11) NOT NULL AUTO_INCREMENT,
  `logoAlianza` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreAlianza` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `urlAlianza` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoriaAlianza` int(11) DEFAULT NULL,
  `fechaCargaAlianza` datetime DEFAULT NULL,
  `fechaModificacionAlianza` datetime DEFAULT NULL,
  `fechaBajaAlianza` datetime DEFAULT NULL,
  `estadoAlianza` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idAlianza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_evento`
--

CREATE TABLE IF NOT EXISTS `archivo_evento` (
  `idArchivoEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `nombreArchivoEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tituloArchivoEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaArchivoEvento` datetime DEFAULT NULL,
  `fechaBajaArchivoEvento` datetime DEFAULT NULL,
  `destacadoArchivoEvento` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoArchivoEvento` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idArchivoEvento`),
  KEY `idEvento` (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `idArea` int(11) NOT NULL AUTO_INCREMENT,
  `nombreArea` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreAreaUrl` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagenArea` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcionArea` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fechaCargaArea` datetime DEFAULT NULL,
  `fechaModificacionArea` datetime DEFAULT NULL,
  `fechaBajaArea` datetime DEFAULT NULL,
  `ordenArea` int(11) DEFAULT NULL,
  `estadoArea` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idArea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_notaprensa`
--

CREATE TABLE IF NOT EXISTS `area_notaprensa` (
  `idAreaNotaPrensa` int(11) NOT NULL AUTO_INCREMENT,
  `idArea` int(11) NOT NULL,
  `idNotaPrensa` int(11) NOT NULL,
  `estadoAreaNotaPrensa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idAreaNotaPrensa`),
  KEY `idArea` (`idArea`),
  KEY `idNotaPrensa` (`idNotaPrensa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_noticia`
--

CREATE TABLE IF NOT EXISTS `area_noticia` (
  `idAreaNoticia` int(11) NOT NULL AUTO_INCREMENT,
  `idArea` int(11) NOT NULL,
  `idNoticia` int(11) NOT NULL,
  `estadoAreaNoticia` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idAreaNoticia`),
  KEY `idArea` (`idArea`),
  KEY `idNoticia` (`idNoticia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_posicion`
--

CREATE TABLE IF NOT EXISTS `area_posicion` (
  `idAreaPosicion` int(11) NOT NULL AUTO_INCREMENT,
  `idArea` int(11) NOT NULL,
  `idPosicion` int(11) NOT NULL,
  `estadoAreaPosicion` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idAreaPosicion`),
  KEY `idArea` (`idArea`),
  KEY `idPosicion` (`idPosicion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_publicacioncanla`
--

CREATE TABLE IF NOT EXISTS `area_publicacioncanla` (
  `idAreaPublicacionCanla` int(11) NOT NULL AUTO_INCREMENT,
  `idArea` int(11) NOT NULL,
  `idPublicacionCanla` int(11) NOT NULL,
  `estadoAreaPublicacionCanla` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idAreaPublicacionCanla`),
  KEY `idArea` (`idArea`),
  KEY `idPublicacionCanla` (`idPublicacionCanla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletin`
--

CREATE TABLE IF NOT EXISTS `boletin` (
  `idBoletin` int(11) NOT NULL AUTO_INCREMENT,
  `tituloBoletin` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `archivoBoletin` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaBoletin` datetime DEFAULT NULL,
  `fechaModificacionBoletin` datetime DEFAULT NULL,
  `fechaBajaBoletin` datetime DEFAULT NULL,
  `estadoBoletin` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idBoletin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eco`
--

CREATE TABLE IF NOT EXISTS `eco` (
  `idEco` tinyint(4) NOT NULL AUTO_INCREMENT,
  `tituloEco` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `archivoEco` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaEco` datetime DEFAULT NULL,
  `fechaModificacionEco` datetime DEFAULT NULL,
  `fechaBajaEco` datetime DEFAULT NULL,
  `estadoEco` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idEco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `idEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEtiqueta` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaEtiqueta` datetime DEFAULT NULL,
  PRIMARY KEY (`idEtiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `tituloEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreEventoUrl` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugarEvento` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaInicioEvento` datetime DEFAULT NULL,
  `fechaFinEvento` datetime DEFAULT NULL,
  `imagenEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagenSlideEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcionEvento` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `cuerpoEvento` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fechaCargaEvento` datetime DEFAULT NULL,
  `fechaModificacionEvento` datetime DEFAULT NULL,
  `fechaBajaEvento` datetime DEFAULT NULL,
  `destacadoEvento` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoEvento` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_evento`
--

CREATE TABLE IF NOT EXISTS `imagen_evento` (
  `idImagenEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `nombreImagenEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaImagenEvento` datetime DEFAULT NULL,
  `fechaBajaImagenEvento` datetime DEFAULT NULL,
  `estadoImagenEvento` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idImagenEvento`),
  KEY `idEvento` (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_notaprensa`
--

CREATE TABLE IF NOT EXISTS `imagen_notaprensa` (
  `idImagenNotaPrensa` int(11) NOT NULL AUTO_INCREMENT,
  `idNotaPrensa` int(11) NOT NULL,
  `nombreImagenNotaPrensa` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaImagenNotaPrensa` datetime DEFAULT NULL,
  `fechaBajaNotaPrensa` datetime DEFAULT NULL,
  `estadoImagenNotaPrensa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idImagenNotaPrensa`),
  KEY `idNotaPrensa` (`idNotaPrensa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_noticia`
--

CREATE TABLE IF NOT EXISTS `imagen_noticia` (
  `idImagenNoticia` int(11) NOT NULL AUTO_INCREMENT,
  `idNoticia` int(11) NOT NULL,
  `nombreImagenNoticia` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaImagenNoticia` datetime DEFAULT NULL,
  `fechaBajaImagenNoticia` datetime DEFAULT NULL,
  `estadoImagenNoticia` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idImagenNoticia`),
  KEY `idNoticia` (`idNoticia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maliciosa_ip`
--

CREATE TABLE IF NOT EXISTS `maliciosa_ip` (
  `idIpMaliciosa` int(10) NOT NULL AUTO_INCREMENT,
  `maliciosa_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `archivo` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `iderUser` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaIntento` datetime DEFAULT NULL,
  PRIMARY KEY (`idIpMaliciosa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=99 ;

--
-- Volcado de datos para la tabla `maliciosa_ip`
--

INSERT INTO `maliciosa_ip` (`idIpMaliciosa`, `maliciosa_address`, `archivo`, `iderUser`, `fechaIntento`) VALUES
(11, '127.0.0.1', '/can-la/admin/usuarios/iniciarSesion.php', NULL, '2014-03-12 10:19:24'),
(12, '127.0.0.1', '/can-la/admin/usuarios/iniciarSesion.php', NULL, '2014-03-12 10:25:18'),
(13, '127.0.0.1', '/can-la/admin/usuarios/cerrarSesion.php', NULL, '2014-03-12 10:37:38'),
(14, '127.0.0.1', '/can-la/admin/usuarios/cerrarSesion.php', NULL, '2014-03-12 10:39:01'),
(15, '127.0.0.1', '/can-la/admin/usuarios/iniciarSesion.php', NULL, '2014-03-12 10:39:17'),
(16, '127.0.0.1', '/can-la/admin/usuarios/iniciarSesion.php', NULL, '2014-03-12 10:40:55'),
(17, '127.0.0.1', '/can-la/admin/usuarios/cerrarSesion.php', NULL, '2014-03-12 10:41:00'),
(18, '127.0.0.1', '/can-la/admin/usuarios/cerrarSesion.php', NULL, '2014-03-12 10:42:18'),
(19, '127.0.0.1', '/can-la/admin/usuarios/cerrarSesion.php', NULL, '2014-03-12 10:43:35'),
(20, '127.0.0.1', '/can-la/admin/usuarios/cerrarSesion.php', NULL, '2014-03-12 10:43:38'),
(21, '127.0.0.1', '/can-la/admin/usuarios/cerrarSesion.php', NULL, '2014-03-12 10:44:41'),
(22, '127.0.0.1', '/can-la/admin/usuarios/cerrarSesion.php', NULL, '2014-03-12 10:45:39'),
(23, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=agregarSobreCanla', NULL, '2014-03-12 11:09:28'),
(24, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=agregarSobreCanla', NULL, '2014-03-12 11:14:17'),
(25, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=agregarObjetivo', NULL, '2014-03-12 11:14:24'),
(26, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=agregarObjetivo', NULL, '2014-03-12 11:14:53'),
(27, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=agregarObjetivo', NULL, '2014-03-12 11:14:53'),
(28, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=agregarObjetivo', NULL, '2014-03-12 11:15:38'),
(29, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php', NULL, '2014-03-14 12:00:13'),
(30, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php', NULL, '2014-03-14 12:01:23'),
(31, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=historia', NULL, '2014-03-14 12:13:29'),
(32, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=historia', NULL, '2014-03-14 12:14:30'),
(33, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=historia', NULL, '2014-03-14 12:14:32'),
(34, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=historia', NULL, '2014-03-14 12:14:32'),
(35, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=historia', NULL, '2014-03-14 12:15:01'),
(36, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=historia', NULL, '2014-03-14 12:15:01'),
(37, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=hi', NULL, '2014-03-14 12:16:26'),
(38, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=hi', NULL, '2014-03-14 12:17:39'),
(39, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=vistaCanInternacional', NULL, '2014-03-14 13:42:51'),
(40, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=vistaCanInternacional', NULL, '2014-03-14 13:46:25'),
(41, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=vistaCanInternacional', NULL, '2014-03-14 13:46:28'),
(42, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=vistaCanInternacional', NULL, '2014-03-14 13:47:27'),
(43, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?titulo=&fechaManual=2014-03-13&archivo=00945120knit2.jpg', NULL, '2014-03-17 15:02:15'),
(44, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?titulo=&fechaManual=2014-03-13&archivo=00945120knit2.jpg', NULL, '2014-03-17 15:02:19'),
(45, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=agregarArea', NULL, '2014-03-28 10:21:29'),
(46, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-28 10:51:40'),
(47, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=reglamento', NULL, '2014-03-28 11:02:28'),
(48, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 11:06:17'),
(49, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 11:06:28'),
(50, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=reglamento', NULL, '2014-03-28 11:06:45'),
(51, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=reglamento', NULL, '2014-03-28 11:57:22'),
(52, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 11:57:25'),
(53, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 14:46:41'),
(54, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 14:46:59'),
(55, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=reglamento', NULL, '2014-03-28 16:24:53'),
(56, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 16:25:13'),
(57, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 16:27:45'),
(58, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 16:39:40'),
(59, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-28 16:40:19'),
(60, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 11:15:27'),
(61, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-03-31 11:38:26'),
(62, '127.0.0.1', '/can-la/controller/extends.php?seccion=extends', NULL, '2014-03-31 12:06:05'),
(63, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:10:43'),
(64, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:11:06'),
(65, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:11:15'),
(66, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:11:30'),
(67, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:11:47'),
(68, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:12:40'),
(69, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:13:03'),
(70, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:13:09'),
(71, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:13:20'),
(72, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:14:45'),
(73, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:17:16'),
(74, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:17:28'),
(75, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:17:33'),
(76, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:25:54'),
(77, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:25:58'),
(78, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:27:48'),
(79, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:30:59'),
(80, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-03-31 12:31:02'),
(81, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=AmbientaciÃ³n', NULL, '2014-03-31 13:48:11'),
(82, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=AmbientaciÃ³n', NULL, '2014-03-31 13:49:09'),
(83, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=AmbientaciÃ³n', NULL, '2014-03-31 13:51:10'),
(84, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=Área dós', NULL, '2014-03-31 13:54:25'),
(85, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=', NULL, '2014-03-31 14:01:02'),
(86, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=', NULL, '2014-03-31 14:02:26'),
(87, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=', NULL, '2014-03-31 14:02:31'),
(88, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=', NULL, '2014-03-31 14:02:49'),
(89, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=Emoticon-Loco', NULL, '2014-03-31 14:02:52'),
(90, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=che-loco', NULL, '2014-03-31 14:05:15'),
(91, '127.0.0.1', '/can-la/controller/areas/controladorAdmin.php?seccion=area&area=che-loco', NULL, '2014-03-31 14:13:24'),
(92, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=objetivo', NULL, '2014-04-04 12:26:01'),
(93, '127.0.0.1', '/can-la/controller/comunicaciones/controladorAdmin.php?seccion=notaPrensa&notaPrensaUrl=&language=ES', NULL, '2014-04-04 14:52:31'),
(94, '127.0.0.1', '/can-la/controller/comunicaciones/controladorAdmin.php?seccion=modificarNotaPrensa&idNotaPrensa=&language=ES', NULL, '2014-04-04 15:12:57'),
(95, '127.0.0.1', '/can-la/controller/comunicaciones/controladorAdmin.php?seccion=modificarNotaPrensa&idNotaPrensa=&language=ES', NULL, '2014-04-04 15:14:24'),
(96, '127.0.0.1', '/can-la/controller/comunicaciones/controladorAdmin.php?seccion=modificarNotaPrensa&idNotaPrensa=23&language=ES', NULL, '2014-04-04 15:14:30'),
(97, '127.0.0.1', '/can-la/controller/comunicaciones/controladorAdmin.php?seccion=modificarNotaPrensa&idNotaPrensa=23&language=ES', NULL, '2014-04-04 15:59:12'),
(98, '127.0.0.1', '/can-la/controller/sobrecanla/controladorAdmin.php?seccion=miembros', NULL, '2014-04-04 16:37:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro`
--

CREATE TABLE IF NOT EXISTS `miembro` (
  `idMiembro` int(11) NOT NULL AUTO_INCREMENT,
  `logoMiembro` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreMiembro` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `urlMiembro` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `representanteMiembro` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccionMiembro` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcionMiembro` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `idPais` int(11) NOT NULL,
  PRIMARY KEY (`idMiembro`),
  KEY `idPais` (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaprensa`
--

CREATE TABLE IF NOT EXISTS `notaprensa` (
  `idNotaPrensa` int(11) NOT NULL AUTO_INCREMENT,
  `tituloNotaPrensa` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `notaPrensaUrl` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagenNotaPrensa` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagenSlideNotaPrensa` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaNotaPrensa` datetime DEFAULT NULL,
  `descripcionNotaPrensa` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `cuerpoNotaPrensa` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fechaCargaNotaPrensa` datetime DEFAULT NULL,
  `fechaModificacionNotaPrensa` datetime DEFAULT NULL,
  `fechaBajaNotaPrensa` datetime DEFAULT NULL,
  `destacadoNotaPrensa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoNotaPrensa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idNotaPrensa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaprensa_etiqueta`
--

CREATE TABLE IF NOT EXISTS `notaprensa_etiqueta` (
  `idNotaPrensaEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idNotaPrensa` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  `estadoNotaPrensaEtiqueta` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idNotaPrensaEtiqueta`),
  KEY `idNotaPrensa` (`idNotaPrensa`),
  KEY `idEtiqueta` (`idEtiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `idNoticia` int(11) NOT NULL AUTO_INCREMENT,
  `tituloNoticia` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreNoticiaUrl` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fuenteNoticia` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagenNoticia` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagenSlideNoticia` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaNoticia` datetime DEFAULT NULL,
  `descripcionNoticia` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `cuerpoNoticia` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fechaCargaNoticia` datetime DEFAULT NULL,
  `fechaModificacionNoticia` datetime DEFAULT NULL,
  `fechaBajaNoticia` datetime DEFAULT NULL,
  `destacadoNoticia` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoNoticia` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idNoticia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_etiqueta`
--

CREATE TABLE IF NOT EXISTS `noticia_etiqueta` (
  `idNoticiaEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idNoticia` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  `estadoNoticiaEtiqueta` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idNoticiaEtiqueta`),
  KEY `idNoticia` (`idNoticia`),
  KEY `idEtiqueta` (`idEtiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otrapublicacion`
--

CREATE TABLE IF NOT EXISTS `otrapublicacion` (
  `idOtraPublicacion` int(11) NOT NULL AUTO_INCREMENT,
  `tituloOtraPublicacion` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcionOtraPublicacion` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `urlOtraPublicacion` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaOtraPublicacion` datetime DEFAULT NULL,
  `fechaModificacionOtraPublicacion` datetime DEFAULT NULL,
  `fechaBajaOtraPublicacion` datetime DEFAULT NULL,
  `estadoOtraPublicacion` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idOtraPublicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `idPais` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePais` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=241 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idPais`, `nombrePais`) VALUES
(1, 'Afganistán'),
(2, 'Islas Gland'),
(3, 'Albania'),
(4, 'Alemania'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antártida'),
(9, 'Antigua y Barbuda'),
(10, 'Antillas Holandesas'),
(11, 'Arabia Saudí'),
(12, 'Argelia'),
(13, 'Argentina'),
(14, 'Armenia'),
(15, 'Aruba'),
(16, 'Australia'),
(17, 'Austria'),
(18, 'Azerbaiyán'),
(19, 'Bahamas'),
(20, 'Bahréin'),
(21, 'Bangladesh'),
(22, 'Barbados'),
(23, 'Bielorrusia'),
(24, 'Bélgica'),
(25, 'Belice'),
(26, 'Benin'),
(27, 'Bermudas'),
(28, 'Bhután'),
(29, 'Bolivia'),
(30, 'Bosnia y Herzegovina'),
(31, 'Botsuana'),
(32, 'Isla Bouvet'),
(33, 'Brasil'),
(34, 'Brunéi'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cabo Verde'),
(39, 'Islas Caimán'),
(40, 'Camboya'),
(41, 'Camerún'),
(42, 'Canadá'),
(43, 'República Centroafricana'),
(44, 'Chad'),
(45, 'República Checa'),
(46, 'Chile'),
(47, 'China'),
(48, 'Chipre'),
(49, 'Isla de Navidad'),
(50, 'Ciudad del Vaticano'),
(51, 'Islas Cocos'),
(52, 'Colombia'),
(53, 'Comoras'),
(54, 'República Democrática del Congo'),
(55, 'Congo'),
(56, 'Islas Cook'),
(57, 'Corea del Norte'),
(58, 'Corea del Sur'),
(59, 'Costa de Marfil'),
(60, 'Costa Rica'),
(61, 'Croacia'),
(62, 'Cuba'),
(63, 'Dinamarca'),
(64, 'Dominica'),
(65, 'República Dominicana'),
(66, 'Ecuador'),
(67, 'Egipto'),
(68, 'El Salvador'),
(69, 'Emiratos Árabes Unidos'),
(70, 'Eritrea'),
(71, 'Eslovaquia'),
(72, 'Eslovenia'),
(73, 'España'),
(74, 'Islas ultramarinas de Estados Unidos'),
(75, 'Estados Unidos'),
(76, 'Estonia'),
(77, 'Etiopía'),
(78, 'Islas Feroe'),
(79, 'Filipinas'),
(80, 'Finlandia'),
(81, 'Fiyi'),
(82, 'Francia'),
(83, 'Gabón'),
(84, 'Gambia'),
(85, 'Georgia'),
(86, 'Islas Georgias del Sur y Sandwich del Sur'),
(87, 'Ghana'),
(88, 'Gibraltar'),
(89, 'Granada'),
(90, 'Grecia'),
(91, 'Groenlandia'),
(92, 'Guadalupe'),
(93, 'Guam'),
(94, 'Guatemala'),
(95, 'Guayana Francesa'),
(96, 'Guinea'),
(97, 'Guinea Ecuatorial'),
(98, 'Guinea-Bissau'),
(99, 'Guyana'),
(100, 'Haití'),
(101, 'Islas Heard y McDonald'),
(102, 'Honduras'),
(103, 'Hong Kong'),
(104, 'Hungría'),
(105, 'India'),
(106, 'Indonesia'),
(107, 'Irán'),
(108, 'Iraq'),
(109, 'Irlanda'),
(110, 'Islandia'),
(111, 'Israel'),
(112, 'Italia'),
(113, 'Jamaica'),
(114, 'Japón'),
(115, 'Jordania'),
(116, 'Kazajstán'),
(117, 'Kenia'),
(118, 'Kirguistán'),
(119, 'Kiribati'),
(120, 'Kuwait'),
(121, 'Laos'),
(122, 'Lesotho'),
(123, 'Letonia'),
(124, 'Líbano'),
(125, 'Liberia'),
(126, 'Libia'),
(127, 'Liechtenstein'),
(128, 'Lituania'),
(129, 'Luxemburgo'),
(130, 'Macao'),
(131, 'ARY Macedonia'),
(132, 'Madagascar'),
(133, 'Malasia'),
(134, 'Malawi'),
(135, 'Maldivas'),
(136, 'Malí'),
(137, 'Malta'),
(138, 'Islas Malvinas'),
(139, 'Islas Marianas del Norte'),
(140, 'Marruecos'),
(141, 'Islas Marshall'),
(142, 'Martinica'),
(143, 'Mauricio'),
(144, 'Mauritania'),
(145, 'Mayotte'),
(146, 'México'),
(147, 'Micronesia'),
(148, 'Moldavia'),
(149, 'Mónaco'),
(150, 'Mongolia'),
(151, 'Montserrat'),
(152, 'Mozambique'),
(153, 'Myanmar'),
(154, 'Namibia'),
(155, 'Nauru'),
(156, 'Nepal'),
(157, 'Nicaragua'),
(158, 'Níger'),
(159, 'Nigeria'),
(160, 'Niue'),
(161, 'Isla Norfolk'),
(162, 'Noruega'),
(163, 'Nueva Caledonia'),
(164, 'Nueva Zelanda'),
(165, 'Omán'),
(166, 'Países Bajos'),
(167, 'Pakistán'),
(168, 'Palau'),
(169, 'Palestina'),
(170, 'Panamá'),
(171, 'Papúa Nueva Guinea'),
(172, 'Paraguay'),
(173, 'Perú'),
(174, 'Islas Pitcairn'),
(175, 'Polinesia Francesa'),
(176, 'Polonia'),
(177, 'Portugal'),
(178, 'Puerto Rico'),
(179, 'Qatar'),
(180, 'Reino Unido'),
(181, 'Reunión'),
(182, 'Ruanda'),
(183, 'Rumania'),
(184, 'Rusia'),
(185, 'Sahara Occidental'),
(186, 'Islas Salomón'),
(187, 'Samoa'),
(188, 'Samoa Americana'),
(189, 'San Cristóbal y Nevis'),
(190, 'San Marino'),
(191, 'San Pedro y Miquelón'),
(192, 'San Vicente y las Granadinas'),
(193, 'Santa Helena'),
(194, 'Santa Lucía'),
(195, 'Santo Tomé y Príncipe'),
(196, 'Senegal'),
(197, 'Serbia y Montenegro'),
(198, 'Seychelles'),
(199, 'Sierra Leona'),
(200, 'Singapur'),
(201, 'Siria'),
(202, 'Somalia'),
(203, 'Sri Lanka'),
(204, 'Suazilandia'),
(205, 'Sudáfrica'),
(206, 'Sudán'),
(207, 'Suecia'),
(208, 'Suiza'),
(209, 'Surinam'),
(210, 'Svalbard y Jan Mayen'),
(211, 'Tailandia'),
(212, 'Taiwán'),
(213, 'Tanzania'),
(214, 'Tayikistán'),
(215, 'Territorio Británico del Océano Índico'),
(216, 'Territorios Australes Franceses'),
(217, 'Timor Oriental'),
(218, 'Togo'),
(219, 'Tokelau'),
(220, 'Tonga'),
(221, 'Trinidad y Tobago'),
(222, 'Túnez'),
(223, 'Islas Turcas y Caicos'),
(224, 'Turkmenistán'),
(225, 'Turquía'),
(226, 'Tuvalu'),
(227, 'Ucrania'),
(228, 'Uganda'),
(229, 'Uruguay'),
(230, 'Uzbekistán'),
(231, 'Vanuatu'),
(232, 'Venezuela'),
(233, 'Vietnam'),
(234, 'Islas Vírgenes Británicas'),
(235, 'Islas Vírgenes de los Estados Unidos'),
(236, 'Wallis y Futuna'),
(237, 'Yemen'),
(238, 'Yibuti'),
(239, 'Zambia'),
(240, 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePerfil` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idPerfil`, `nombrePerfil`) VALUES
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE IF NOT EXISTS `posicion` (
  `idPosicion` int(11) NOT NULL AUTO_INCREMENT,
  `tituloPosicion` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombrePosicionUrl` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `archivoPosicion` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaPosicion` datetime DEFAULT NULL,
  `fechaModificacionPosicion` datetime DEFAULT NULL,
  `fechaBajaPosicion` datetime DEFAULT NULL,
  `estadoPosicion` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPosicion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion_etiqueta`
--

CREATE TABLE IF NOT EXISTS `posicion_etiqueta` (
  `idPosicionEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idPosicion` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  `estadoPosicionEtiqueta` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPosicionEtiqueta`),
  KEY `idPosicion` (`idPosicion`),
  KEY `idEtiqueta` (`idEtiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacioncanla`
--

CREATE TABLE IF NOT EXISTS `publicacioncanla` (
  `idPublicacionCanla` int(11) NOT NULL AUTO_INCREMENT,
  `tituloPublicacionCanla` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombrePublicacionCanlaUrl` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `archivoPublicacionCanla` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaPublicacionCanla` datetime DEFAULT NULL,
  `fechaModificacionPublicacionCanla` datetime DEFAULT NULL,
  `fechaBajaPublicacionCanla` datetime DEFAULT NULL,
  `estadoPublicacionCanla` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPublicacionCanla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacioncanla_etiqueta`
--

CREATE TABLE IF NOT EXISTS `publicacioncanla_etiqueta` (
  `idPublicacionCanlaEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idPublicacionCanla` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  `estadoPublicacionCanlaEtiqueta` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPublicacionCanlaEtiqueta`),
  KEY `idPublicacionCanla` (`idPublicacionCanla`),
  KEY `idEtiqueta` (`idEtiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteanual`
--

CREATE TABLE IF NOT EXISTS `reporteanual` (
  `idReporteAnual` int(11) NOT NULL AUTO_INCREMENT,
  `imagenReporteAnual` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tituloReporteAnual` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `archivoReporteAnual` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaManualReporteAnual` date DEFAULT NULL,
  `fechaCargaReporteAnual` datetime DEFAULT NULL,
  `fechaModificacionReporteAnual` datetime DEFAULT NULL,
  `fechaBajaReporteAnual` datetime DEFAULT NULL,
  `estadoReporteAnual` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idReporteAnual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretariado`
--

CREATE TABLE IF NOT EXISTS `secretariado` (
  `idSecretariado` int(11) NOT NULL AUTO_INCREMENT,
  `imagenSecretariado` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `textoSecretariado` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreSecretariado` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargoSecretariado` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaSecretariado` datetime DEFAULT NULL,
  `fechaModificacionSecretariado` datetime DEFAULT NULL,
  `fechaBajaSecretariado` datetime DEFAULT NULL,
  `estadoSecretariado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ordenSecretariado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idSecretariado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sobrecanla`
--

CREATE TABLE IF NOT EXISTS `sobrecanla` (
  `idSobreCanla` int(11) NOT NULL AUTO_INCREMENT,
  `cuerpoSobreCanla` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `tipoSobreCanla` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaSobreCanla` datetime DEFAULT NULL,
  `fechaModificacionSobreCanla` datetime DEFAULT NULL,
  `fechaBajaSobreCanla` datetime DEFAULT NULL,
  `estadoSobreCanla` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idSobreCanla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idPerfil` int(11) NOT NULL,
  `nombreUsuario` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `claveUsuario` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `iderUser` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoUsuario` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidadIngresos` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `idPerfil` (`idPerfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idPerfil`, `nombreUsuario`, `claveUsuario`, `iderUser`, `estadoUsuario`, `cantidadIngresos`) VALUES
(1, 1, 'f911b57401739896a62e4e9c1a33633309097a32b2a94c82db6509f8', 'f911b57401739896a62e4e9c1a33633309097a32b2a94c82db6509f8', '53095d5fde24e35fdbd74fe2af6645c93bf909b9859dd24e93a5e9df', 'A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video_evento`
--

CREATE TABLE IF NOT EXISTS `video_evento` (
  `idVideoEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `nombreVideoEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaVideoEvento` datetime DEFAULT NULL,
  `fechaBajaVideoEvento` datetime DEFAULT NULL,
  `estadoVideoEvento` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idVideoEvento`),
  KEY `idEvento` (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video_notaprensa`
--

CREATE TABLE IF NOT EXISTS `video_notaprensa` (
  `idVideoNotaPrensa` int(11) NOT NULL AUTO_INCREMENT,
  `idNotaPrensa` int(11) NOT NULL,
  `nombreVideoNotaPrensa` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaVideoNotaPrensa` datetime DEFAULT NULL,
  `fechaBajaVideoNotaPrensa` datetime DEFAULT NULL,
  `estadoVideoNotaPrensa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idVideoNotaPrensa`),
  KEY `idNotaPrensa` (`idNotaPrensa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video_noticia`
--

CREATE TABLE IF NOT EXISTS `video_noticia` (
  `idVideoNoticia` int(11) NOT NULL AUTO_INCREMENT,
  `idNoticia` int(11) NOT NULL,
  `nombreVideoNoticia` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaVideoNoticia` datetime DEFAULT NULL,
  `fechaBajaVideoNoticia` datetime DEFAULT NULL,
  `estadoVideoNoticia` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idVideoNoticia`),
  KEY `idNoticia` (`idNoticia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo_evento`
--
ALTER TABLE `archivo_evento`
  ADD CONSTRAINT `archivo_evento_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`);

--
-- Filtros para la tabla `area_notaprensa`
--
ALTER TABLE `area_notaprensa`
  ADD CONSTRAINT `area_notaprensa_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`),
  ADD CONSTRAINT `area_notaprensa_ibfk_2` FOREIGN KEY (`idNotaPrensa`) REFERENCES `notaprensa` (`idNotaPrensa`);

--
-- Filtros para la tabla `area_noticia`
--
ALTER TABLE `area_noticia`
  ADD CONSTRAINT `area_noticia_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`),
  ADD CONSTRAINT `area_noticia_ibfk_2` FOREIGN KEY (`idNoticia`) REFERENCES `noticia` (`idNoticia`);

--
-- Filtros para la tabla `area_posicion`
--
ALTER TABLE `area_posicion`
  ADD CONSTRAINT `area_posicion_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`),
  ADD CONSTRAINT `area_posicion_ibfk_2` FOREIGN KEY (`idPosicion`) REFERENCES `posicion` (`idPosicion`);

--
-- Filtros para la tabla `area_publicacioncanla`
--
ALTER TABLE `area_publicacioncanla`
  ADD CONSTRAINT `area_publicacioncanla_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`),
  ADD CONSTRAINT `area_publicacioncanla_ibfk_2` FOREIGN KEY (`idPublicacionCanla`) REFERENCES `publicacioncanla` (`idPublicacionCanla`);

--
-- Filtros para la tabla `imagen_evento`
--
ALTER TABLE `imagen_evento`
  ADD CONSTRAINT `imagen_evento_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`);

--
-- Filtros para la tabla `imagen_notaprensa`
--
ALTER TABLE `imagen_notaprensa`
  ADD CONSTRAINT `imagen_notaprensa_ibfk_1` FOREIGN KEY (`idNotaPrensa`) REFERENCES `notaprensa` (`idNotaPrensa`);

--
-- Filtros para la tabla `imagen_noticia`
--
ALTER TABLE `imagen_noticia`
  ADD CONSTRAINT `imagen_noticia_ibfk_1` FOREIGN KEY (`idNoticia`) REFERENCES `noticia` (`idNoticia`);

--
-- Filtros para la tabla `miembro`
--
ALTER TABLE `miembro`
  ADD CONSTRAINT `miembro_ibfk_1` FOREIGN KEY (`idPais`) REFERENCES `pais` (`idPais`);

--
-- Filtros para la tabla `notaprensa_etiqueta`
--
ALTER TABLE `notaprensa_etiqueta`
  ADD CONSTRAINT `notaprensa_etiqueta_ibfk_1` FOREIGN KEY (`idNotaPrensa`) REFERENCES `notaprensa` (`idNotaPrensa`),
  ADD CONSTRAINT `notaprensa_etiqueta_ibfk_2` FOREIGN KEY (`idEtiqueta`) REFERENCES `etiqueta` (`idEtiqueta`);

--
-- Filtros para la tabla `noticia_etiqueta`
--
ALTER TABLE `noticia_etiqueta`
  ADD CONSTRAINT `noticia_etiqueta_ibfk_1` FOREIGN KEY (`idNoticia`) REFERENCES `noticia` (`idNoticia`),
  ADD CONSTRAINT `noticia_etiqueta_ibfk_2` FOREIGN KEY (`idEtiqueta`) REFERENCES `etiqueta` (`idEtiqueta`);

--
-- Filtros para la tabla `posicion_etiqueta`
--
ALTER TABLE `posicion_etiqueta`
  ADD CONSTRAINT `posicion_etiqueta_ibfk_1` FOREIGN KEY (`idPosicion`) REFERENCES `posicion` (`idPosicion`),
  ADD CONSTRAINT `posicion_etiqueta_ibfk_2` FOREIGN KEY (`idEtiqueta`) REFERENCES `etiqueta` (`idEtiqueta`);

--
-- Filtros para la tabla `publicacioncanla_etiqueta`
--
ALTER TABLE `publicacioncanla_etiqueta`
  ADD CONSTRAINT `publicacioncanla_etiqueta_ibfk_1` FOREIGN KEY (`idPublicacionCanla`) REFERENCES `publicacioncanla` (`idPublicacionCanla`),
  ADD CONSTRAINT `publicacioncanla_etiqueta_ibfk_2` FOREIGN KEY (`idEtiqueta`) REFERENCES `etiqueta` (`idEtiqueta`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idPerfil`) REFERENCES `perfil` (`idPerfil`);

--
-- Filtros para la tabla `video_evento`
--
ALTER TABLE `video_evento`
  ADD CONSTRAINT `video_evento_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`);

--
-- Filtros para la tabla `video_notaprensa`
--
ALTER TABLE `video_notaprensa`
  ADD CONSTRAINT `video_notaprensa_ibfk_1` FOREIGN KEY (`idNotaPrensa`) REFERENCES `notaprensa` (`idNotaPrensa`);

--
-- Filtros para la tabla `video_noticia`
--
ALTER TABLE `video_noticia`
  ADD CONSTRAINT `video_noticia_ibfk_1` FOREIGN KEY (`idNoticia`) REFERENCES `noticia` (`idNoticia`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
