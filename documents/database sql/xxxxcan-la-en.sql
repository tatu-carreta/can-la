-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-03-2014 a las 13:15:42
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `can-la-en`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alianza`
--

CREATE TABLE IF NOT EXISTS `alianza` (
  `idAlianza` int(11) NOT NULL AUTO_INCREMENT,
  `logoAlianza` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreAlianza` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlAlianza` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoriaAlianza` int(11) DEFAULT NULL,
  `fechaCargaAlianza` datetime DEFAULT NULL,
  `fechaModificacionAlianza` datetime DEFAULT NULL,
  `fechaBajaAlianza` datetime DEFAULT NULL,
  `estadoAlianza` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idAlianza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_evento`
--

CREATE TABLE IF NOT EXISTS `archivo_evento` (
  `idArchivoEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `nombreArchivoEvento` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tituloArchivoEvento` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaArchivoEvento` datetime DEFAULT NULL,
  `fechaBajaArchivoEvento` datetime DEFAULT NULL,
  `destacadoArchivoEvento` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoArchivoEvento` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idArchivoEvento`),
  KEY `idEvento` (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `idArea` int(11) NOT NULL AUTO_INCREMENT,
  `nombreArea` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagenArea` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcionArea` mediumtext COLLATE utf8_unicode_ci,
  `fechaCargaArea` datetime DEFAULT NULL,
  `fechaModificacionArea` datetime DEFAULT NULL,
  `fechaBajaArea` datetime DEFAULT NULL,
  `ordenArea` int(11) DEFAULT NULL,
  `estadoArea` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `estadoAreaNotaPrensa` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `estadoAreaNoticia` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `estadoAreaPosicion` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `estadoAreaPublicacionCanla` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `tituloBoletin` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivoBoletin` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaBoletin` datetime DEFAULT NULL,
  `fechaModificacionBoletin` datetime DEFAULT NULL,
  `fechaBajaBoletin` datetime DEFAULT NULL,
  `estadoBoletin` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idBoletin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eco`
--

CREATE TABLE IF NOT EXISTS `eco` (
  `idEco` tinyint(4) NOT NULL AUTO_INCREMENT,
  `tituloEco` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivoEco` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaEco` datetime DEFAULT NULL,
  `fechaModificacionEco` datetime DEFAULT NULL,
  `fechaBajaEco` datetime DEFAULT NULL,
  `estadoEco` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `idEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEtiqueta` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaEtiqueta` datetime DEFAULT NULL,
  PRIMARY KEY (`idEtiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `tituloEvento` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lugarEvento` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaInicioEvento` datetime DEFAULT NULL,
  `fechaFinEvento` datetime DEFAULT NULL,
  `imagenEvento` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagenSlideEvento` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcionEvento` mediumtext COLLATE utf8_unicode_ci,
  `cuerpoEvento` mediumtext COLLATE utf8_unicode_ci,
  `fechaCargaEvento` datetime DEFAULT NULL,
  `fechaModificacionEvento` datetime DEFAULT NULL,
  `fechaBajaEvento` datetime DEFAULT NULL,
  `destacadoEvento` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoEvento` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_evento`
--

CREATE TABLE IF NOT EXISTS `imagen_evento` (
  `idImagenEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `nombreImagenEvento` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaImagenEvento` datetime DEFAULT NULL,
  `fechaBajaImagenEvento` datetime DEFAULT NULL,
  `estadoImagenEvento` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `nombreImagenNotaPrensa` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaImagenNotaPrensa` datetime DEFAULT NULL,
  `fechaBajaNotaPrensa` datetime DEFAULT NULL,
  `estadoImagenNotaPrensa` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `nombreImagenNoticia` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaImagenNoticia` datetime DEFAULT NULL,
  `fechaBajaImagenNoticia` datetime DEFAULT NULL,
  `estadoImagenNoticia` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro`
--

CREATE TABLE IF NOT EXISTS `miembro` (
  `idMiembro` int(11) NOT NULL AUTO_INCREMENT,
  `logoMiembro` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreMiembro` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlMiembro` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `representanteMiembro` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionMiembro` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcionMiembro` mediumtext COLLATE utf8_unicode_ci,
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
  `tituloNotaPrensa` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagenNotaPrensa` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagenSlideNotaPrensa` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaNotaPrensa` datetime DEFAULT NULL,
  `descripcionNotaPrensa` mediumtext COLLATE utf8_unicode_ci,
  `cuerpoNotaPrensa` mediumtext COLLATE utf8_unicode_ci,
  `fechaCargaNotaPrensa` datetime DEFAULT NULL,
  `fechaModificacionNotaPrensa` datetime DEFAULT NULL,
  `fechaBajaNotaPrensa` datetime DEFAULT NULL,
  `destacadoNotaPrensa` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoNotaPrensa` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `estadoNotaPrensaEtiqueta` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `tituloNoticia` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fuenteNoticia` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagenNoticia` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagenSlideNoticia` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaNoticia` datetime DEFAULT NULL,
  `descripcionNoticia` mediumtext COLLATE utf8_unicode_ci,
  `cuerpoNoticia` mediumtext COLLATE utf8_unicode_ci,
  `fechaCargaNoticia` datetime DEFAULT NULL,
  `fechaModificacionNoticia` datetime DEFAULT NULL,
  `fechaBajaNoticia` datetime DEFAULT NULL,
  `destacadoNoticia` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoNoticia` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `estadoNoticiaEtiqueta` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `tituloOtraPublicacion` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcionOtraPublicacion` mediumtext COLLATE utf8_unicode_ci,
  `urlOtraPublicacion` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaOtraPublicacion` datetime DEFAULT NULL,
  `fechaModificacionOtraPublicacion` datetime DEFAULT NULL,
  `fechaBajaOtraPublicacion` datetime DEFAULT NULL,
  `estadoOtraPublicacion` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idOtraPublicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `idPais` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePais` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=241 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idPais`, `nombrePais`) VALUES
(1, 'Afghanistan'),
(2, 'Islas Gland'),
(3, 'Albania'),
(4, 'Germany'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and Barbuda'),
(10, 'Netherlands Antilles'),
(11, 'Saudi Arabia'),
(12, 'Algeria'),
(13, 'Argentina'),
(14, 'Armenia'),
(15, 'Aruba'),
(16, 'Australia'),
(17, 'Austria'),
(18, 'Azerbaijan'),
(19, 'The Bahamas'),
(20, 'Bahrain'),
(21, 'Bangladesh'),
(22, 'Barbados'),
(23, 'Belarus'),
(24, 'Belgium'),
(25, 'Belize'),
(26, 'Benin'),
(27, 'Bermuda'),
(28, 'Bhután'),
(29, 'Bolivia'),
(30, 'Bosnia and Herzegovina'),
(31, 'Botswana'),
(32, 'Bouvet Island'),
(33, 'Brazil'),
(34, 'Brunei'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cape Verde'),
(39, 'Cayman Islands'),
(40, 'Cambodia'),
(41, 'Cameroon'),
(42, 'Canada'),
(43, 'Central African Republic'),
(44, 'Chad'),
(45, 'Czech Republic'),
(46, 'Chile'),
(47, 'China'),
(48, 'Cyprus'),
(49, 'Christmas Island'),
(50, 'Vatican City'),
(51, 'Cocos (Keeling) Islands'),
(52, 'Colombia'),
(53, 'Comoros'),
(54, 'Democratic Republic of the Congo'),
(55, 'Congo'),
(56, 'Cook Islands'),
(57, 'North Korea'),
(58, 'South Korea'),
(59, 'Côte dIvoire'),
(60, 'Costa Rica'),
(61, 'Croatia'),
(62, 'Cuba'),
(63, 'Denmark'),
(64, 'Dominica'),
(65, 'Dominican Republic'),
(66, 'Ecuador'),
(67, 'Egypt'),
(68, 'El Salvador'),
(69, 'United Arab Emirates'),
(70, 'Eritrea'),
(71, 'Slovakia'),
(72, 'Slovenia'),
(73, 'Spain'),
(74, 'United States Minor Outlying Islands'),
(75, 'United States'),
(76, 'Estonia'),
(77, 'Ethiopia'),
(78, 'Faeroe Islands'),
(79, 'Philippines'),
(80, 'Finland'),
(81, 'Fiji'),
(82, 'France'),
(83, 'Gabon'),
(84, 'The Gambia'),
(85, 'Georgia'),
(86, 'South Georgia and the South Sandwich Islands'),
(87, 'Ghana'),
(88, 'Gibraltar'),
(89, 'Grenada'),
(90, 'Greece'),
(91, 'Greenland'),
(92, 'Guadeloupe'),
(93, 'Guam'),
(94, 'Guatemala'),
(95, 'French Guiana'),
(96, 'Guinea'),
(97, 'Equatorial Guinea'),
(98, 'Guinea-Bissau'),
(99, 'Guyana'),
(100, 'Haiti'),
(101, 'Heard Island and McDonald Islands'),
(102, 'Honduras'),
(103, 'Hong Kong'),
(104, 'Hungary'),
(105, 'India'),
(106, 'Indonesia'),
(107, 'Iran'),
(108, 'Iraq'),
(109, 'Ireland'),
(110, 'Iceland'),
(111, 'Israel'),
(112, 'Italy'),
(113, 'Jamaica'),
(114, 'Japan'),
(115, 'Jordan'),
(116, 'Kazakhstan'),
(117, 'Kenya'),
(118, 'Kyrgyzstan'),
(119, 'Kiribati'),
(120, 'Kuwait'),
(121, 'Laos'),
(122, 'Lesotho'),
(123, 'Latvia'),
(124, 'Lebanon'),
(125, 'Liberia'),
(126, 'Libya'),
(127, 'Liechtenstein'),
(128, 'Lithuania'),
(129, 'Luxembourg'),
(130, 'Macao'),
(131, 'Former Yugoslav Republic of Macedonia'),
(132, 'Madagascar'),
(133, 'Malaysia'),
(134, 'Malawi'),
(135, 'Maldives'),
(136, 'Mali'),
(137, 'Malta'),
(138, 'Falkland Islands'),
(139, 'Northern Marianas'),
(140, 'Morocco'),
(141, 'Marshall Islands'),
(142, 'Martinique'),
(143, 'Mauritius'),
(144, 'Mauritania'),
(145, 'Mayotte'),
(146, 'Mexico'),
(147, 'Micronesia'),
(148, 'Moldova'),
(149, 'Monaco'),
(150, 'Mongolia'),
(151, 'Montserrat'),
(152, 'Mozambique'),
(153, 'Myanmar'),
(154, 'Namibia'),
(155, 'Nauru'),
(156, 'Nepal'),
(157, 'Nicaragua'),
(158, 'Niger'),
(159, 'Nigeria'),
(160, 'Niue'),
(161, 'Norfolk Island'),
(162, 'Norway'),
(163, 'New Caledonia'),
(164, 'New Zealand'),
(165, 'Oman'),
(166, 'Netherlands'),
(167, 'Pakistan'),
(168, 'Palau'),
(169, 'Palestina'),
(170, 'Panama'),
(171, 'Papua New Guinea'),
(172, 'Paraguay'),
(173, 'Peru'),
(174, 'Pitcairn Islands'),
(175, 'French Polynesia'),
(176, 'Poland'),
(177, 'Portugal'),
(178, 'Puerto Rico'),
(179, 'Qatar'),
(180, 'United Kingdom'),
(181, 'Réunion'),
(182, 'Rwanda'),
(183, 'Romania'),
(184, 'Russia'),
(185, 'Western Sahara'),
(186, 'Solomon Islands'),
(187, 'Samoa'),
(188, 'American Samoa'),
(189, 'Saint Kitts and Nevis'),
(190, 'San Marino'),
(191, 'Saint Pierre and Miquelon'),
(192, 'Saint Vincent and the Grenadines'),
(193, 'Saint Helena'),
(194, 'Santa Lucía'),
(195, 'São Tomé and Príncipe'),
(196, 'Senegal'),
(197, 'Serbia y Montenegro'),
(198, 'Seychelles'),
(199, 'Sierra Leone'),
(200, 'Singapore'),
(201, 'Syria'),
(202, 'Somalia'),
(203, 'Sri Lanka'),
(204, 'Swaziland'),
(205, 'South Africa'),
(206, 'Sudan'),
(207, 'Sweden'),
(208, 'Switzerland'),
(209, 'Suriname'),
(210, 'Svalbard and Jan Mayen'),
(211, 'Thailand'),
(212, 'Taiwan'),
(213, 'Tanzania'),
(214, 'Tajikistan'),
(215, 'British Indian Ocean Territory'),
(216, 'French Southern Territories'),
(217, 'East Timor'),
(218, 'Togo'),
(219, 'Tokelau'),
(220, 'Tonga'),
(221, 'Trinidad and Tobago'),
(222, 'Tunisia'),
(223, 'Turks and Caicos Islands'),
(224, 'Turkmenistan'),
(225, 'Turkey'),
(226, 'Tuvalu'),
(227, 'Ukraine'),
(228, 'Uganda'),
(229, 'Uruguay'),
(230, 'Uzbekistan'),
(231, 'Vanuatu'),
(232, 'Venezuela'),
(233, 'Vietnam'),
(234, 'British Virgin Islands'),
(235, 'US Virgin Islands'),
(236, 'Wallis and Futuna'),
(237, 'Yemen'),
(238, 'Djibouti'),
(239, 'Zambia'),
(240, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePerfil` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idPerfil`, `nombrePerfil`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE IF NOT EXISTS `posicion` (
  `idPosicion` int(11) NOT NULL AUTO_INCREMENT,
  `tituloPosicion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivoPosicion` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaPosicion` datetime DEFAULT NULL,
  `fechaModificacionPosicion` datetime DEFAULT NULL,
  `fechaBajaPosicion` datetime DEFAULT NULL,
  `estadoPosicion` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `estadoPosicionEtiqueta` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `tituloPublicacionCanla` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivoPublicacionCanla` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaPublicacionCanla` datetime DEFAULT NULL,
  `fechaModificacionPublicacionCanla` datetime DEFAULT NULL,
  `fechaBajaPublicacionCanla` datetime DEFAULT NULL,
  `estadoPublicacionCanla` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `estadoPublicacionCanlaEtiqueta` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `imagenReporteAnual` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tituloReporteAnual` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivoReporteAnual` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaReporteAnual` datetime DEFAULT NULL,
  `fechaModificacionReporteAnual` datetime DEFAULT NULL,
  `fechaBajaReporteAnual` datetime DEFAULT NULL,
  `estadoReporteAnual` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idReporteAnual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretariado`
--

CREATE TABLE IF NOT EXISTS `secretariado` (
  `idSecretariado` int(11) NOT NULL AUTO_INCREMENT,
  `imagenSecretariado` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `textoSecretariado` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreSecretariado` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargoSecretariado` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaSecretariado` datetime DEFAULT NULL,
  `fechaModificacionSecretariado` datetime DEFAULT NULL,
  `fechaBajaSecretariado` datetime DEFAULT NULL,
  `estadoSecretariado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordenSecretariado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idSecretariado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sobrecanla`
--

CREATE TABLE IF NOT EXISTS `sobrecanla` (
  `idSobreCanla` int(11) NOT NULL AUTO_INCREMENT,
  `cuerpoSobreCanla` mediumtext COLLATE utf8_unicode_ci,
  `tipoSobreCanla` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaSobreCanla` datetime DEFAULT NULL,
  `fechaModificacionSobreCanla` datetime DEFAULT NULL,
  `fechaBajaSobreCanla` datetime DEFAULT NULL,
  `estadoSobreCanla` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idSobreCanla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idPerfil` int(11) NOT NULL,
  `nombreUsuario` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `claveUsuario` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iderUser` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoUsuario` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `nombreVideoEvento` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaVideoEvento` datetime DEFAULT NULL,
  `fechaBajaVideoEvento` datetime DEFAULT NULL,
  `estadoVideoEvento` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `nombreVideoNotaPrensa` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaVideoNotaPrensa` datetime DEFAULT NULL,
  `fechaBajaVideoNotaPrensa` datetime DEFAULT NULL,
  `estadoVideoNotaPrensa` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `nombreVideoNoticia` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCargaVideoNoticia` datetime DEFAULT NULL,
  `fechaBajaVideoNoticia` datetime DEFAULT NULL,
  `estadoVideoNoticia` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
