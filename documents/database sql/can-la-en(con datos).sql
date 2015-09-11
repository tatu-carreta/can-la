-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-05-2014 a las 19:28:08
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

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
  `logoAlianza` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreAlianza` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `urlAlianza` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoriaAlianza` int(11) DEFAULT NULL,
  `fechaCargaAlianza` datetime DEFAULT NULL,
  `fechaModificacionAlianza` datetime DEFAULT NULL,
  `fechaBajaAlianza` datetime DEFAULT NULL,
  `estadoAlianza` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idAlianza`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `alianza`
--

INSERT INTO `alianza` (`idAlianza`, `logoAlianza`, `nombreAlianza`, `urlAlianza`, `categoriaAlianza`, `fechaCargaAlianza`, `fechaModificacionAlianza`, `fechaBajaAlianza`, `estadoAlianza`) VALUES
(1, 'intercambio41163.png', 'Intercambio Clim&aacute;tico', 'http://intercambioclimatico.com/', 1, '2014-05-07 16:49:49', '2014-05-07 16:49:49', NULL, 'A'),
(2, 'southern64932.png', 'Sourthen Voices', 'http://www.southernvoices.net/es/', 1, '2014-05-07 16:58:50', '2014-05-07 16:58:50', NULL, 'A'),
(3, 'LogoPCL94965.jpeg', 'Plataforma Clim&aacute;tica', 'http://intercambioclimatico.com/', 1, '2014-05-07 17:21:20', '2014-05-07 17:21:20', NULL, 'A');

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
  PRIMARY KEY (`idArea`),
  KEY `nombreAreaUrl` (`nombreAreaUrl`(255))
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
  `nombreEtiquetaUrl` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCargaEtiqueta` datetime DEFAULT NULL,
  PRIMARY KEY (`idEtiqueta`),
  KEY `nombreEtiqueta` (`nombreEtiqueta`(255)),
  KEY `nombreEtiquetaUrl` (`nombreEtiquetaUrl`(255))
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
  `fechaInicioEvento` date DEFAULT NULL,
  `fechaFinEvento` date DEFAULT NULL,
  `imagenEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagenSlideEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcionEvento` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `cuerpoEvento` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fechaCargaEvento` datetime DEFAULT NULL,
  `fechaModificacionEvento` datetime DEFAULT NULL,
  `fechaBajaEvento` datetime DEFAULT NULL,
  `destacadoEvento` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoEvento` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idEvento`),
  KEY `nombreEventoUrl` (`nombreEventoUrl`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_evento`
--

CREATE TABLE IF NOT EXISTS `imagen_evento` (
  `idImagenEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `nombreImagenEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `epigrafeImagenEvento` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `maliciosa_ip`
--

INSERT INTO `maliciosa_ip` (`idIpMaliciosa`, `maliciosa_address`, `archivo`, `iderUser`, `fechaIntento`) VALUES
(1, '127.0.0.1', '/can-la/controller/comunicaciones/controladorAdminModel.php?language=en', NULL, '2014-05-01 11:08:55'),
(2, '127.0.0.1', '/can-la/controller/publicaciones/controladorAdmin.php?seccion=publicaciones&language=en', NULL, '2014-05-01 11:10:17');

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
  `latitud` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `longitud` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `idPais` int(11) NOT NULL,
  `fechaCargaMiembro` datetime DEFAULT NULL,
  `fechaModificacionMiembro` datetime DEFAULT NULL,
  `fechaBajaMiembro` datetime DEFAULT NULL,
  `estadoMiembro` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idMiembro`),
  KEY `idPais` (`idPais`),
  KEY `nombreMiembro` (`nombreMiembro`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `miembro`
--

INSERT INTO `miembro` (`idMiembro`, `logoMiembro`, `nombreMiembro`, `urlMiembro`, `representanteMiembro`, `direccionMiembro`, `descripcionMiembro`, `latitud`, `longitud`, `idPais`, `fechaCargaMiembro`, `fechaModificacionMiembro`, `fechaBajaMiembro`, `estadoMiembro`) VALUES
(1, NULL, 'Klimaforum Latinoamérica Network', 'http://klnred.ning.com/', 'Manuel Guzmán Hennessey', '', 'Klimaforum Latinoamérica Network (KLN) es una organización tipo red, orientada a facilitar la comprensión del cambio climático global (CC), mediante actividades educativas y de comunicación. Su énfasis es el análisis de la índole antropogénica del problema, de las necesidades de la adaptación, y del cambio gradual de los modelos de producción y consumo de la sociedad. La red KLN nace en el año 2007 como expresión del interés de un grupo de investigadores latinoamericanos, interesados en promover y facilitar espacios de análisis en la academia, la sociedad, los gobiernos y el empresariado, sobre la necesidad de un cambio gradual en la cultura, y muy especialmente en los modelos de desarrollo relacionados con el factor antropogénico del CC.', '0', '0', 52, '2014-05-05 15:26:38', '2014-05-05 15:26:38', NULL, 'A'),
(2, NULL, 'Federación de Organizaciones y Juntas Ambientalistas de Venezuela: “FORJA”', '', 'Jose Moya H', '', 'Casa Doña Carmen Hernández, e/ El Barrero y La Ceiba, Las 4 Esquinas de Paraguachí, Antolín del Campo, Isla de Margarita. VENEZUELA \n\nTels de contacto: (58) 295 2348291  (58) 416 7020749\n\nMails: forja@reacciun.ve  /  forjadevenezuela@cantv.net', '0', '0', 232, '2014-05-05 15:37:27', '2014-05-05 15:37:27', NULL, 'A'),
(3, 'logo_biosfera10040.jpeg', 'Fundación Biosfera', 'http://www.biosfera.org/', 'Horacio de Belaustegui', '', 'Dirección: 16 nº 1611 (CP) 1900, La Plata, Argentina. Tels: (54) 221 4570481  (54) 221 4570481. Contacto: Enrique Maurtua Konstantinidis, mail: enriquemk@yahoo.com. Representante: Horacio de Belaustegui , mail: belaustegui@biosfera.org', '0', '0', 13, '2014-05-05 16:33:44', '2014-05-05 16:33:44', NULL, 'A'),
(4, NULL, 'Foro del Buen Ayre', 'http://www.foroba.org.ar', '', '', 'Calle 14 N° 106, Mercedes, Buenos Aires, ARGENTINA. Tels: (54) 2324 15500020   (54) 2324 421042', '0', '0', 13, '2014-05-09 13:16:28', '2014-05-09 13:16:28', NULL, 'A'),
(5, 'mdl-honduras62439.jpeg', 'Fundación de Iniciativas de Cambio Climático de Honduras', 'http://fundacioncambioclimatico.hn/', 'GUADALUPE MONTES MIRALDA', '', 'Teléfonos: (504) 2257-3358, y Móviles: (504) 9973-2919 y 9952-1217. Email: fundclimahonduras@yahoo.com. Directora Ejecutiva: SUYAPA ZELAYA  -   suyapazelaya59@yahoo.com . Representante: GUADALUPE MONTES MIRALDA  gmontes_4144@yahoo.com.', '0', '0', 102, '2014-05-09 13:25:51', '2014-05-09 13:25:51', NULL, 'A'),
(7, NULL, 'Fundación Moisés Bertoni', 'www.mbertoni.org.py', 'Yan Artemio Speranza González', NULL, 'Procer Carlos Arguello 208, Asunción, Paraguay. Teléfonos: (595) 21-608740/2 595-21-600855 (595) 21-608740. Representante: Yan Artemio Speranza González, email: ysperanza@mbertoni.org.py', '0', '0', 172, '2014-05-09 15:09:13', '2014-05-09 15:09:13', NULL, 'A'),
(8, NULL, 'Vitae Civilis - Cidadania e Sustentabilidade', 'www.vitaecivilis.org.br', 'Morrow Gaines Campbell III', NULL, 'Rua Itápolis, 1468 - Pacaembú - CEP 01245-000 - Sao Paulo (SP) - Brasil\nTel/Fax.: 55 (11) 3662-0158. Contato: administracao@vitaecivilis.org.br \nRepresentante: Morrow Gaines Campbell III ( gaines@vitaecivilis.org.br )', '0', '0', 33, '2014-05-09 15:20:25', '2014-05-09 15:20:25', NULL, 'A'),
(9, 'logo_esquel53939.png', 'Fundação Grupo Esquel Brasil', 'www.esquel.org.br', 'Silvio R. Sant’Ana', NULL, 'SCS Quadra 1  Bloco I  Edifício Central, Sala 1301-1307  Brasília, Brasil. Teléfonos: (55) 61 3322 2062, (55) 613322 11 85 (55) 61 3322 2062, emails:   silvio@esquel.org.br   silvio@esquel.org.br', '0', '0', 33, '2014-05-09 15:39:43', '2014-05-09 15:39:43', NULL, 'A'),
(10, 'haiti-survie40247.png', 'Haiti Survie', 'www.haitisurvie.org', 'Aldrin Calixte', NULL, 'Reulle Alerte 69 Port au Prince, Haití. Teléfonos (509) 29402441 (509) 34019684. Emails: info@haitisurvie.org, aldrin.calixte@gmail.com.', '0', '0', 100, '2014-05-09 15:43:55', '2014-05-09 15:43:55', NULL, 'A'),
(11, 'accion-ecologica43511.png', 'Acción Ecológica', 'www.accionecologica.cl', 'Luis Mariano Rendón Escobar', NULL, 'Colo Colo 1019-A, Ñuñoa, Santiago, Chile. Teléfonos: (56) 2-3567659 (56) 6393871. Email: luismarianorendon@gmail.com', '0', '0', 46, '2014-05-09 15:47:47', '2014-05-09 15:47:47', NULL, 'A'),
(12, 'amigos-del-viento88113.jpeg', 'Sociedad Amigos del Viento meteorología ambiente desarrollo', 'www.freewebs.com/amigosdelviento', 'Graciela Salaberri', NULL, 'Luis Piera 1931 apto 001, CP 11200 Montevideo, Uruguay. Teléfonos: (598) 9911 2893 (598) 2411 2824. Emails: amigosdelviento@adinet.com.uy , gracielasalaberri@yahoo.com.ar', '0', '0', 229, '2014-05-09 15:53:07', '2014-05-09 15:53:07', NULL, 'A');

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
  `fechaNotaPrensa` date DEFAULT NULL,
  `descripcionNotaPrensa` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `cuerpoNotaPrensa` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fechaCargaNotaPrensa` datetime DEFAULT NULL,
  `fechaModificacionNotaPrensa` datetime DEFAULT NULL,
  `fechaBajaNotaPrensa` datetime DEFAULT NULL,
  `destacadoNotaPrensa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoNotaPrensa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idNotaPrensa`),
  KEY `notaPrensaUrl` (`notaPrensaUrl`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaprensa_archivo`
--

CREATE TABLE IF NOT EXISTS `notaprensa_archivo` (
  `idNotaPrensaArchivo` int(11) NOT NULL AUTO_INCREMENT,
  `idNotaPrensa` int(11) NOT NULL,
  `archivoNotaPrensa` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estadoArchivoNotaPrensa` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaCargaArchivoNotaPrensa` datetime NOT NULL,
  `fechaBajaArchivoNotaPrensa` datetime DEFAULT NULL,
  PRIMARY KEY (`idNotaPrensaArchivo`),
  KEY `FK_notaprensa_archivo_notaprensa` (`idNotaPrensa`)
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
  `fechaNoticia` date DEFAULT NULL,
  `descripcionNoticia` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `cuerpoNoticia` mediumtext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fechaCargaNoticia` datetime DEFAULT NULL,
  `fechaModificacionNoticia` datetime DEFAULT NULL,
  `fechaBajaNoticia` datetime DEFAULT NULL,
  `destacadoNoticia` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadoNoticia` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idNoticia`),
  KEY `nombreNoticiaUrl` (`nombreNoticiaUrl`(255))
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
  `nombrePais` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=241 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idPais`, `nombrePais`) VALUES
(13, 'Argentina'),
(29, 'Bolivia'),
(33, 'Brazil'),
(42, 'Canada'),
(46, 'Chile'),
(52, 'Colombia'),
(60, 'Costa Rica'),
(62, 'Cuba'),
(64, 'Dominica'),
(65, 'Dominican Republic'),
(66, 'Ecuador'),
(68, 'El Salvador'),
(75, 'United States'),
(94, 'Guatemala'),
(95, 'French Guiana'),
(96, 'Guinea'),
(97, 'Equatorial Guinea'),
(98, 'Guinea-Bissau'),
(99, 'Guyana'),
(100, 'Haiti'),
(102, 'Honduras'),
(113, 'Jamaica'),
(146, 'Mexico'),
(157, 'Nicaragua'),
(170, 'Panama'),
(172, 'Paraguay'),
(173, 'Peru'),
(178, 'Puerto Rico'),
(190, 'San Marino'),
(194, 'Santa Lucía'),
(209, 'Suriname'),
(229, 'Uruguay'),
(232, 'Venezuela');

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
  PRIMARY KEY (`idPosicion`),
  KEY `nombrePosicionUrl` (`nombrePosicionUrl`(255))
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
  PRIMARY KEY (`idPublicacionCanla`),
  KEY `nombrePublicacionCanlaUrl` (`nombrePublicacionCanlaUrl`(255))
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `reporteanual`
--

INSERT INTO `reporteanual` (`idReporteAnual`, `imagenReporteAnual`, `tituloReporteAnual`, `archivoReporteAnual`, `fechaManualReporteAnual`, `fechaCargaReporteAnual`, `fechaModificacionReporteAnual`, `fechaBajaReporteAnual`, `estadoReporteAnual`) VALUES
(1, '', 'Reporte Anual 2013', 'eco-201475236.pdf', '2013-12-01', '2014-05-05 14:27:17', '2014-05-05 14:27:17', '2014-05-09 12:53:40', 'B'),
(2, '', 'ASASD', 'eco-201465234.pdf', '1234-12-12', '2014-05-05 14:48:39', '2014-05-05 14:48:39', '2014-05-05 14:52:51', 'B'),
(3, '', 'QWEQWEQW', 'eco-201469812.pdf', '1235-12-12', '2014-05-05 14:49:04', '2014-05-05 14:49:04', '2014-05-05 14:52:39', 'B'),
(4, '', 'Reporte Anual 2013', 'eco-201422969.pdf', '2013-12-01', '2014-05-09 12:55:55', '2014-05-09 12:55:55', NULL, 'A');

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
  `tipoSecretariado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idSecretariado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `secretariado`
--

INSERT INTO `secretariado` (`idSecretariado`, `imagenSecretariado`, `textoSecretariado`, `nombreSecretariado`, `cargoSecretariado`, `fechaCargaSecretariado`, `fechaModificacionSecretariado`, `fechaBajaSecretariado`, `estadoSecretariado`, `ordenSecretariado`, `tipoSecretariado`) VALUES
(1, 'enrique31219.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. P', 'Enrique Maurtua Konstantinidis', 'Coordinador', '2014-05-05 13:15:31', '2014-05-05 13:15:31', NULL, 'A', '1', 'S'),
(2, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. P', 'Mario Caffera', 'cargo', '2014-05-05 13:52:11', '2014-05-05 13:52:11', '2014-05-05 13:53:17', 'B', '2', 'S'),
(3, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. P', 'Nobre y Apellido', 'Cargo', '2014-05-05 13:53:58', '2014-05-05 13:53:58', NULL, 'A', '2', 'S'),
(4, 'enrique78647.jpeg', 'werewr qñwoiru weioru woiur owuer wieoru  owpiur owie', 'rwerwer', 'werwer', '2014-05-09 10:55:15', '2014-05-09 10:55:15', '2014-05-09 10:55:43', 'B', '3', 'S');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `sobrecanla`
--

INSERT INTO `sobrecanla` (`idSobreCanla`, `cuerpoSobreCanla`, `tipoSobreCanla`, `fechaCargaSobreCanla`, `fechaModificacionSobreCanla`, `fechaBajaSobreCanla`, `estadoSobreCanla`) VALUES
(1, '<h1>Objetivos</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. Pellentesque malesuada ultrices sapien vel elementum. Nunc ligula nisi, mollis blandit scelerisque id, auctor in ipsum. Nullam non velit vitae lectus feugiat volutpat. Mauris nibh libero, pharetra dignissim volutpat in, viverra a mauris. In convallis gravida magna vitae placerat.</p>\r\n\r\n<h1>Misi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n\r\n<h1>Visi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n', 'O', '2014-05-05 12:36:00', '2014-05-05 12:36:00', NULL, 'A'),
(2, '<h1>Objetivos</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. Pellentesque malesuada ultrices sapien vel elementum. Nunc ligula nisi, mollis blandit scelerisque id, auctor in ipsum. Nullam non velit vitae lectus feugiat volutpat. Mauris nibh libero, pharetra dignissim volutpat in, viverra a mauris. In convallis gravida magna vitae placerat.</p>\r\n\r\n<h1>Misi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n\r\n<h1>Visi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n', 'O', '2014-05-05 12:36:19', '2014-05-05 12:36:19', NULL, 'A'),
(3, '<h1>Objetivos</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. Pellentesque malesuada ultrices sapien vel elementum. Nunc ligula nisi, mollis blandit scelerisque id, auctor in ipsum. Nullam non velit vitae lectus feugiat volutpat. Mauris nibh libero, pharetra dignissim volutpat in, viverra a mauris. In convallis gravida magna vitae placerat.</p>\r\n\r\n<h1>Misi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n\r\n<h1>Visi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n', 'O', '2014-05-05 12:36:57', '2014-05-05 12:36:57', NULL, 'A'),
(4, '<h1>Objetivos</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. Pellentesque malesuada ultrices sapien vel elementum. Nunc ligula nisi, mollis blandit scelerisque id, auctor in ipsum. Nullam non velit vitae lectus feugiat volutpat. Mauris nibh libero, pharetra dignissim volutpat in, viverra a mauris. In convallis gravida magna vitae placerat.</p>\r\n\r\n<h1>Misi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n\r\n<h1>Visi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n', 'O', '2014-05-05 12:41:00', '2014-05-05 12:41:00', NULL, 'A'),
(5, '<h1>Objetivos</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. Pellentesque malesuada ultrices sapien vel elementum. Nunc ligula nisi, mollis blandit scelerisque id, auctor in ipsum. Nullam non velit vitae lectus feugiat volutpat. Mauris nibh libero, pharetra dignissim volutpat in, viverra a mauris. In convallis gravida magna vitae placerat.</p>\r\n\r\n<h1>Misi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n\r\n<h1>Visi&oacute;n</h1>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n', 'O', '2014-05-05 12:41:18', '2014-05-05 12:41:18', NULL, 'A'),
(6, '<h1><strong><u>Reglamento de la Red de Acci&oacute;n Clim&aacute;tica de Am&eacute;rica Latina</u></strong></h1>\r\n\r\n<h1>A.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE CAN-LA</h1>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>1.&nbsp;</strong>Climate Action Network Latin America (CAN-LA) es el Nodo Regional de Climate Action Network International (CAN-I)&nbsp; en la regi&oacute;n geogr&aacute;fica de Am&eacute;rica Latina y el Caribe.</p>\r\n\r\n<p><strong>2.&nbsp;</strong>CAN-LA es una red de organizaciones no gubernamentales independientes de Am&eacute;rica Latina comprometidas en la lucha contra los efectos nocivos del cambio clim&aacute;tico. La red se basa en la confianza, apertura democr&aacute;tica y equidad. Esta red de miembros independientes actuar&aacute; en concordancia con sus propios mandatos, metas y objetivos institucionales, aceptando el estatuto de CAN Internacional en lo que le sea aplicable, y rigi&eacute;ndose por el presente reglamento.</p>\r\n\r\n<p><strong>3.&nbsp;</strong>Los idiomas que manejar&aacute; CAN-LA en sus documentos ser&aacute;n: espa&ntilde;ol, portugu&eacute;s e ingl&eacute;s.</p>\r\n\r\n<p><strong>4.&nbsp;</strong>CAN-LA se forma para presentar una sola voz de la regi&oacute;n en las Asambleas Generales de CAN-I y en sesiones de negociaci&oacute;n en torno a la problem&aacute;tica del clima.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>B.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE LA MEMBRES&Iacute;A</h1>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>5.&nbsp;</strong>Podr&aacute;n ser miembros de CAN-LA las organizaciones sin fines de lucro, organizaciones e instituciones no gubernamentales (ONG), y fundaciones, que est&eacute;n interesadas y activas en temas de cambio clim&aacute;tico y sostenibilidad, y que no est&eacute;n relacionadas con gobiernos o empresas.</p>\r\n\r\n<p><strong>6.&nbsp;</strong>Para afiliarse a CAN-LA, las organizaciones solicitar&aacute;n su membrec&iacute;a presentando sus credenciales de incorporaci&oacute;n debidamente legalizadas y firmadas por su representante legal, al nodo nacional o en su defecto al Consejo Administrativo de&nbsp; CAN-LA, llenando una ficha de inscripci&oacute;n. Adem&aacute;s deber&aacute;n adjuntar cartas de recomendaci&oacute;n de al menos dos (2) organizaciones miembros de CAN-LA o de las autoridades de su nodo nacional.</p>\r\n\r\n<p><strong>7.&nbsp;</strong>Seg&uacute;n corresponda, el nodo nacional o el Consejo Administrativo, comunicar&aacute;n a los miembros de CAN-LA las nuevas solicitudes de afiliaci&oacute;n para su aprobaci&oacute;n en el&nbsp; lapso de un (1) mes, hecho que se comunicar&aacute; a la Secretar&iacute;a de CAN-I y luego al nodo nacional que los registrar&aacute;.</p>\r\n\r\n<p><strong>8.&nbsp;</strong>Los miembros de CAN-I que desarrollan sus actividades en la regi&oacute;n latinoamericana ser&aacute;n miembros del nodo nacional o de CAN-LA de forma autom&aacute;tica presentando su ficha de inscripci&oacute;n.</p>\r\n\r\n<p><strong>9.&nbsp;</strong>Las organizaciones internacionales afiliadas a CAN-I presentes en los pa&iacute;ses miembros de CAN-LA tendr&aacute;n el estatus de observadoras en las reuniones regionales.</p>\r\n\r\n<p><strong>10.&nbsp;</strong>Las organizaciones no gubernamentales y sin fines de lucro podr&aacute;n solicitar tener el estatus de miembros observadores presentando su solicitud y manifestando expresamente la elecci&oacute;n de dicho estatus. Si el miembro es aceptado, se inscribir&aacute; en el registro de Miembros Observadores.</p>\r\n\r\n<p><strong>11.&nbsp;</strong>Toda la informaci&oacute;n de los miembros de CAN-LA ser&aacute; registrada en el directorio y el sitio web de CAN-LA.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>C.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; OBLIGACIONES DE LOS MIEMBROS</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>12.&nbsp;</strong>Los miembros de CAN-LA deben estar comprometidos con la visi&oacute;n, misi&oacute;n y objetivos de CAN-I y de CAN-LA.</p>\r\n\r\n<p><strong>13.&nbsp;</strong>Todos los miembros de CAN-LA deben estar comprometidos con el C&oacute;digo de Conducta de este Reglamento.</p>\r\n\r\n<p><strong>14.&nbsp;</strong>Los miembros observadores tendr&aacute;n derecho a asistir a las reuniones de CAN-LA y a tener acceso a los materiales, y tendr&aacute;n derecho a voz pero no tendr&aacute;n derecho a voto, y no influir&aacute;n en el consenso de la toma de decisiones. Estos miembros deber&aacute;n respetar la naturaleza interna y confidencial de las reuniones de CAN-LA. El facilitador o el presidente de la reuni&oacute;n podr&aacute; excluir a estos miembros a pedido de los miembros plenos de CAN-LA despu&eacute;s de una votaci&oacute;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>D.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE LA RENUNCIA</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>15.&nbsp;</strong>Para renunciar, la organizaci&oacute;n miembro deber&aacute; enviar una comunicaci&oacute;n escrita a CAN-LA, que ser&aacute; aceptada una vez revisado el cumplimiento de sus obligaciones.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>E.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; EXPULSI&Oacute;N DE MIEMBROS DE CAN-LA</h2>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>16.&nbsp;</strong>Una organizaci&oacute;n miembro puede ser expulsada de CAN-LA si se comprueba que ha violado el C&oacute;digo de Conducta o el presente Reglamento.</p>\r\n\r\n<p><strong>17.&nbsp;</strong>La solicitud de expulsi&oacute;n, expresando la motivaci&oacute;n, debe ser firmada por lo menos por tres miembros diferentes de CAN-LA, o por el Nodo Nacional o el Regional y enviada al Consejo Administrativo de CAN-LA,&nbsp; para su evaluaci&oacute;n.</p>\r\n\r\n<p><strong>18.&nbsp;</strong>El Consejo Administrativo debe proporcionar al miembro cuestionado la oportunidad de ser o&iacute;do o de remediar las acciones denunciadas en la solicitud de expulsi&oacute;n, y determinar&aacute; el procedimiento conforme a las normas de este Reglamento. El Consejo deber&aacute; tener en cuenta los comentarios y recomendaciones del coordinador pertinente (Nodo Nacional o Regional) y los comentarios de los que presentan la queja.</p>\r\n\r\n<p><strong>19.&nbsp;</strong>CAN-LA expulsar&aacute; al miembro s&oacute;lo despu&eacute;s que el Consejo Administrativo haya comprobado la violaci&oacute;n a que se refiere el Art.16 y tomado la decisi&oacute;n fundada de expulsi&oacute;n.</p>\r\n\r\n<p><strong>20.&nbsp;</strong>El Consejo Administrativo de CAN-LA deber&aacute; enviar la decisi&oacute;n de expulsi&oacute;n expresando el motivo al Secretariado de CAN-I.</p>\r\n\r\n<p><strong>21.&nbsp;</strong>El miembro expulsado puede apelar a la Junta Directiva de CAN-I, la que escuchar&aacute; a todas las partes y decidir&aacute; bajo los principios de justicia y equidad. La decisi&oacute;n de la Junta Directiva de CAN-I ser&aacute; referida a su Asamblea General para la decisi&oacute;n final.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>F. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE LA GOBERNANZA Y LA TOMA DE DECISIONES Y DECLARACIONES</h1>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>22.&nbsp;</strong>La Asamblea General Regional&nbsp; es el &oacute;rgano supremo de decisi&oacute;n de CAN-LA y ejerce dicha autoridad a trav&eacute;s de las decisiones que se acuerden en ella.</p>\r\n\r\n<p><strong>23.&nbsp;</strong>La Asamblea General se reunir&aacute; por lo menos una (1) vez cada dos a&ntilde;os. Pueden realizarse asambleas extraordinarias en las &eacute;pocas de eventos importantes en las que est&eacute;n presentes miembros de los pa&iacute;ses integrantes de CAN-LA como en los talleres de construcci&oacute;n de capacidades o en eventos.</p>\r\n\r\n<p><strong>24.&nbsp;</strong>Las decisiones que se tomen en estas asambleas extraordinarias deber&aacute;n ser comunicadas a la red para conocimiento.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>G.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE LA ASAMBLEA GENERAL REGIONAL</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>25.&nbsp;</strong>La Asamblea General Regional es la m&aacute;s alta autoridad de la red, establece la visi&oacute;n y estrategia de CAN-LA, y decide tanto acerca de la discusi&oacute;n de soluciones importantes en el tema de cambio clim&aacute;tico, como la gobernanza, administraci&oacute;n y recaudaci&oacute;n de fondos de la red regional. La Asamblea anualmente elegir&aacute; al Coordinador Regional y al Consejo Administrativo de CAN-LA.</p>\r\n\r\n<p><strong>26.&nbsp;</strong>La Asamblea General Regional queda constituida si el 90% de los pa&iacute;ses miembros de CAN-LA est&aacute;n presentes (sea presencial, por poder o virtualmente si se acord&oacute; realizarla de esa forma).</p>\r\n\r\n<p><strong>27.&nbsp;</strong>Si un representante no puede estar f&iacute;sicamente presente, podr&aacute; dar poder a un miembro presente mediante documento escrito entregado al Consejo Directivo con una anticipaci&oacute;n de quince (15) d&iacute;as calendarios a la fecha de la asamblea. Un miembro podr&aacute; representar solamente a un miembro ausente, es decir, podr&aacute; &uacute;nicamente representar dos votos.</p>\r\n\r\n<p><strong>28.&nbsp;</strong>La Asamblea deber&aacute; ser convocada por el Coordinador Regional y ser&aacute; comunicada a los miembros v&iacute;a la red de correos electr&oacute;nicos de CAN-LA y en su p&aacute;gina web, consignando lugar, fecha y agenda propuesta, y convocar a los miembros a proponer m&aacute;s temas para la agenda.</p>\r\n\r\n<p><strong>29.&nbsp;</strong>Los miembros que no puedan asistir a la Asamblea General de CAN-LA podr&aacute;n solicitar al Consejo Administrativo que tome nota de sus propuestas u observaciones sobre los &iacute;tems de la agenda para la toma de decisiones, y el Consejo Administrativo transmitir&aacute; dichos puntos de vista a la Asamblea.</p>\r\n\r\n<p><strong>30.&nbsp;</strong>Cuando las posibilidades de financiaci&oacute;n sean limitadas, CAN-LA, asignar&aacute; un n&uacute;mero de representantes por pa&iacute;s proporcional al n&uacute;mero de afiliados. Siempre se intentar&aacute; asegurar que haya al menos un (1) representante de cada Nodo Nacional, y si no lo hay, al menos un representante de ese pa&iacute;s que tenga como m&iacute;nimo una ONG miembro. Ser&aacute; responsabilidad de los miembros de los Nodos Nacionales o de cada pa&iacute;s elegir a su(s) representante(s), a fin de lograr la equitativa y amplia participaci&oacute;n de las ONG miembros de la regi&oacute;n. La selecci&oacute;n de participantes se sustenta en los principios de rotaci&oacute;n, inclusi&oacute;n y balance.</p>\r\n\r\n<p><strong>31.&nbsp;</strong>Todos los miembros de CAN-LA tienen derecho a voz y a voto.</p>\r\n\r\n<p><strong>32.&nbsp;</strong>La Asamblea General Regional elegir&aacute; al Coordinador Regional y a un Consejo Administrativo que apoye el trabajo del Coordinador. Ambos realizar&aacute;n las funciones que la Asamblea acuerde. En el caso de la elecci&oacute;n del Coordinador se har&aacute; con la votaci&oacute;n de los presentes, m&aacute;s los votos que por poder escrito fehaciente se entreguen al Coordinador que dirige la Asamblea con la anticipaci&oacute;n debida, m&aacute;s la votaci&oacute;n virtual que llegue al momento de la Asamblea.&nbsp; Las Asambleas podr&aacute;n ser transmitidas a los miembros de CAN-LA v&iacute;a Internet o teleconferencia, en vivo.</p>\r\n\r\n<p><strong>33.&nbsp;</strong>Las decisiones que tome la Asamblea deber&aacute;n ser tomadas procurando alcanzar el consenso.</p>\r\n\r\n<p><strong>34.&nbsp;</strong>Cuando no se alcance el consenso se podr&aacute;n aprobar las decisiones siempre que las organizaciones en desacuerdo no superen el 10% del total de miembros.</p>\r\n\r\n<p><strong>35.&nbsp;</strong>En los casos de declaraciones p&uacute;blicas o posicionamientos, las organizaciones disidentes podr&aacute;n dejar expreso su descuerdo en el acta de la asamblea.</p>\r\n\r\n<p><strong>36.&nbsp;</strong>Se podr&aacute;n realizar asambleas virtuales cuando se requiera tomar decisiones de emergencia como el nombramiento de un Coordinador Regional Interino o alg&uacute;n miembro del Consejo Administrativo por renuncia, o cuando el 50% de los miembros lo solicite.</p>\r\n\r\n<p><strong>37.&nbsp;</strong>En el caso de asambleas virtuales, la Asamblea quedar&aacute; debidamente constituida cuando al menos el 70% de los representantes de los miembros est&eacute;n virtualmente conectados por v&iacute;a remota o internet, o si el 50% de los miembros de CAN-LA est&aacute; presente (sin embargo, esto no debe comprometer la interpretaci&oacute;n de un consenso suficiente de todos los representantes de CAN-LA que falten y deben tenerse en cuenta).</p>\r\n\r\n<p><strong>38.&nbsp;</strong>La modificaci&oacute;n de cualquier art&iacute;culo del presente Reglamento s&oacute;lo podr&aacute; ser llevado a cabo en la Asamblea Regional bianual por mayor&iacute;a calificada. Se estimar&aacute; dicho qu&oacute;rum de acuerdo al Art. 26. La mayor&iacute;a calificada estar&aacute; dada por las tres cuartas partes de los miembros presentes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>H.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE LA ELECCI&Oacute;N DEL COORDINADOR Y EL CONSEJO ADMINISTRATIVO Y SUS FUNCIONES</h1>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>39.&nbsp;</strong>El Coordinador ser&aacute; elegido anualmente en la Asamblea General por consenso y si no se logra &eacute;ste, por mayor&iacute;a simple (opci&oacute;n con m&aacute;s votos), con posibilidad de un a&ntilde;o m&aacute;s de renovaci&oacute;n, si as&iacute; lo decide la Asamblea General.</p>\r\n\r\n<p><strong>40.&nbsp;</strong>El Consejo Administrativo estar&aacute; formado por tres (3) miembros y dos (2) suplentes que ser&aacute;n elegidos anualmente por la Asamblea General, respetando la equidad de g&eacute;nero y la distribuci&oacute;n geogr&aacute;fica, de acuerdo al Estatuto de CAN.</p>\r\n\r\n<p><strong>41.&nbsp;</strong>Se crea el Consejo Administrativo para fines de orientaci&oacute;n en la toma de decisiones en cuanto al &aacute;rea administrativa del Coordinador y para que desarrolle el Plan de Acci&oacute;n de CAN-LA.</p>\r\n\r\n<p><strong>42.&nbsp;</strong>Los cargos de Coordinador y Consejo Administrativo son de car&aacute;cter institucional. No obstante lo anterior, las organizaciones elegidas se comprometen a mantener en esa posici&oacute;n a la persona representante de la entidad en el momento de la elecci&oacute;n para ocupar el cargo. En caso que la persona en cuesti&oacute;n, se vea impedida de continuar ejerciendo el cargo, la instituci&oacute;n perder&aacute; autom&aacute;ticamente dicho estatus.</p>\r\n\r\n<p><strong>43.&nbsp;</strong>Son funciones del Coordinador:</p>\r\n\r\n<p><strong>a.&nbsp;</strong>Representar y ser vocero de CAN-LA ante CAN-I y otras organizaciones.</p>\r\n\r\n<p><strong>b.&nbsp;</strong>Mantener actualizada la base de datos de los miembros de CAN-LA.</p>\r\n\r\n<p><strong>c.&nbsp;</strong>Mantener registros de CAN-LA: registro de miembros, nodos, miembros expulsados, fondos y otros necesarios para el buen gobierno de CAN-LA.</p>\r\n\r\n<p><strong>d.&nbsp;</strong>Presentar a la red en un plazo prudencial, el Plan de Acci&oacute;n Bi-Anual de CAN-LA que debe ser aprobado por los miembros de CAN-LA. El Plan se desarrollar&aacute; con los aportes de los miembros de CAN-LA.</p>\r\n\r\n<p><strong>e.&nbsp;</strong>Delegar en los miembros del Consejo Administrativo las tareas para el desarrollo del Plan de Acci&oacute;n.</p>\r\n\r\n<p><strong>f.&nbsp;</strong>Informar del cumplimiento del Plan de Acci&oacute;n anual de CAN-LA en la Asamblea General.</p>\r\n\r\n<p><strong>g.&nbsp;</strong>Convocar y organizar las Asambleas de CAN-LA.</p>\r\n\r\n<p><strong>h.&nbsp;</strong>Conjuntamente con el Consejo Administrativo, preparar la agenda b&aacute;sica de la asamblea y proponerla a la red, pidiendo a los miembros que propongan temas para la agenda relacionados con el tema principal de la convocatoria, as&iacute; como temas que tengan que ver con el gobierno de CAN-LA y que debe ser decididos por la asamblea.</p>\r\n\r\n<p><strong>i.&nbsp;</strong>Dirigir las Asambleas de CAN-LA.</p>\r\n\r\n<p><strong>j.&nbsp;</strong>Coordinar, actualizar y administrar el sitio web de CAN-LA:&nbsp;<a href="http://www.can-la.org/" style="color: rgb(123, 165, 102);">www.can-la.org</a>.</p>\r\n\r\n<p><strong>k.&nbsp;</strong>Mantener un registro de todas las declaraciones de posici&oacute;n de CAN-LA y de CAN-I, y comunicarlas en tiempo y forma a los miembros de CAN-LA.</p>\r\n\r\n<p><strong>l.&nbsp;</strong>Coordinar la recaudaci&oacute;n de fondos para la regi&oacute;n, para cubrir las actividades de capacitaci&oacute;n tanto a nivel regional como nacional, y coordinar y asistir a los miembros de CAN-LA en la recaudaci&oacute;n de fondos para las actividades a nivel regional y para el desarrollo de proyectos a nivel nacional.</p>\r\n\r\n<p><strong>m.&nbsp;</strong>Mantener actualizada la lista virtual de los miembros de CAN-LA, con dos direcciones electr&oacute;nicas de cada una de ellas. Esta ser&aacute; la v&iacute;a oficial de comunicaci&oacute;n en la red. Es responsabilidad de los miembros informar al Coordinador Regional sobre cambios en la direcci&oacute;n electr&oacute;nica o persona responsable registrada. Podr&aacute;n crearse otras formas de comunicaci&oacute;n anexadas a la oficial.</p>\r\n\r\n<p><strong>n.&nbsp;</strong>Actualizar el directorio de organismos relacionados con CAN-I, Gobiernos, Empresas, Secretariado de la CMNUCC, etc.</p>\r\n\r\n<p><strong>o.&nbsp;</strong>Elaborar un informe financiero cada seis (6) meses sobre los fondos&nbsp; recaudados para las actividades de CAN-LA.</p>\r\n\r\n<p><strong>p.&nbsp;</strong>Realizar una auditor&iacute;a de los fondos restantes de CAN-LA al cierre de cada ejercicio fiscal.</p>\r\n\r\n<p><strong>q.&nbsp;</strong>Favorecer los esfuerzos de investigaci&oacute;n dentro de la regi&oacute;n, sobre los temas con los que CAN-LA est&aacute; comprometida (cambio clim&aacute;tico, equidad, etc.)</p>\r\n\r\n<p><strong>r.&nbsp;</strong>Mantener registros de estos esfuerzos y ayudar a la creaci&oacute;n de capacidades dentro de CAN-LA.</p>\r\n\r\n<p><strong>s.&nbsp;</strong>Ejercer la coordinaci&oacute;n y la financiaci&oacute;n de las actividades de CAN-LA en la participaci&oacute;n en talleres regionales y en las COP / MOP.</p>\r\n\r\n<p><strong>t.&nbsp;</strong>Comunicar a la red las decisiones del Consejo Administrativo para opini&oacute;n de los miembros.</p>\r\n\r\n<p><strong>u.&nbsp;</strong>Procurar en lo posible (sujeto a la disposici&oacute;n de fondos) la realizaci&oacute;n y coordinaci&oacute;n de al menos un (1) taller de capacitaci&oacute;n anual de los miembros de CAN-LA de forma presencial. Se facilitar&aacute; as&iacute;, la realizaci&oacute;n de una Asamblea General Anual.</p>\r\n\r\n<p><strong>v.&nbsp;</strong>Tener el rol de mediador y/o solucionador de conflictos, adem&aacute;s de tratar de unificar a la regi&oacute;n orient&aacute;ndola hacia una posici&oacute;n com&uacute;n.</p>\r\n\r\n<p><strong>44.&nbsp;</strong>Son funciones del Consejo Administrativo:</p>\r\n\r\n<p><strong>a)&nbsp;</strong>Realizar las tareas asignadas para el desarrollo y cumplimiento del Plan de Acci&oacute;n Anual de CAN-LA.</p>\r\n\r\n<p><strong>b)&nbsp;</strong>Proveer al Coordinador apoyo y asesor&iacute;a para el buen gobierno de CAN-LA, y supervisar el cumplimiento de las funciones del Coordinador de acuerdo a estos recursos.</p>\r\n\r\n<p><strong>c)&nbsp;</strong>Tramitar las solicitudes de nuevos miembros o nodos de CAN-LA e informarlas a la red siguiendo el procedimiento.</p>\r\n\r\n<p><strong>d)&nbsp;</strong>Recibir y tramitar las solicitudes de expulsi&oacute;n de miembros de CAN-LA por causa justificada, organizar la forma de escuchar a las partes y las opiniones que sean necesarias para resolver la cuesti&oacute;n de manera justa y con equidad.</p>\r\n\r\n<p><strong>e)&nbsp;</strong>Recibir la solicitud de los miembros (por lo menos tres) pidiendo la renuncia del Coordinador con causa justificada y probada para darle tr&aacute;mite y proceder conforme al Ac&aacute;pite E del presente Reglamento.</p>\r\n\r\n<p><strong>f)&nbsp;</strong>Autorizar a los miembros a recaudar fondos utilizando el nombre de CAN-LA para realizar las actividades de acuerdo a los lineamientos de CAN-LA, como son construcci&oacute;n de capacidades, investigaci&oacute;n en temas de cambio clim&aacute;tico, proyectos y programas y otros compatibles. Se informar&aacute; al Consejo de estas actividades y deber&aacute; rend&iacute;rsele cuentas.</p>\r\n\r\n<p><strong>g)&nbsp;</strong>Decidir sobre la administraci&oacute;n del abastecimiento y la distribuci&oacute;n de los fondos,&nbsp; sujeto a una transparencia total y a las opiniones de los miembros de CAN-LA y de CAN-I, si los fondos provienen de ellos. En la asignaci&oacute;n de fondos, se prestar&aacute; especial atenci&oacute;n a los pa&iacute;ses y los miembros que carecen de financiaci&oacute;n que les permita participar en las Asambleas y en las COP/MOP.</p>\r\n\r\n<p><strong>h)&nbsp;</strong>Publicar cada a&ntilde;o el destino de todos los fondos de CAN-LA y de aquellos fondos de CAN-LA otorgados a sus miembros. Cualquier miembro es libre de comentar y asesorar con respecto a la asignaci&oacute;n de fondos planteados.</p>\r\n\r\n<p><strong>i)&nbsp;</strong>Pedir la renuncia del Coordinador por causa justificada y probada y proceder conforme al Ac&aacute;pite E del presente Reglamento.</p>\r\n\r\n<p><strong>j)&nbsp;</strong>Poner a consideraci&oacute;n de la red de CAN-LA toda decisi&oacute;n pol&iacute;tica, de posici&oacute;n o administrativa que se juzgue importante para los fines de CAN-LA.</p>\r\n\r\n<p><strong>k)&nbsp;</strong>Recibir las cartas poder de los miembros que no puedan asistir a las asambleas, aceptarlas y presentarlas en la Asamblea.</p>\r\n\r\n<p><strong>l)&nbsp;</strong>Actualizar en la p&aacute;gina web los Nodos existentes para evitar la repetici&oacute;n de los mismos.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>I.- DE LOS FONDOS RECAUDADOS POR CANLA</strong></p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>45.&nbsp;</strong>Solamente el Consejo Administrativo de CAN-LA puede autorizar a que una ONG miembro de CAN-LA capte recursos en nombre de CAN-LA<strong>.</strong></p>\r\n\r\n<p><strong>46.&nbsp;</strong>Los fondos recaudados por CAN-LA deben ser utilizados para financiar sus actividades, como publicaciones, medios de comunicaci&oacute;n, talleres, presencia de sus representantes ante eventos internacionales u otros similares conducentes a la realizaci&oacute;n de los objetivos de CAN-LA.</p>\r\n\r\n<p><strong>47.&nbsp;</strong>Los fondos adicionales pueden ser utilizados para proyectos y programas, o actividades regionales realizadas por los miembros o Nodos. La organizaci&oacute;n miembro beneficiada proporcionar&aacute; la prueba contable adecuada del gasto de los fondos a satisfacci&oacute;n de los auditores.</p>\r\n\r\n<p><strong>48.&nbsp;</strong>En la asignaci&oacute;n de fondos, se prestar&aacute; especial atenci&oacute;n a regiones o pa&iacute;ses y los miembros que carecen de financiaci&oacute;n que les permita participar en las Asambleas o en las COP/MOP.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>J.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE LOS GRUPOS DE TRABAJO TEM&Aacute;TICOS</h1>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>49.&nbsp;</strong>Los Grupos de Trabajo Tem&aacute;ticos (GTT) ser&aacute;n formados en la Asamblea General sobre temas de inter&eacute;s de CAN-LA, o a pedido de los miembros o de los nodos de CAN-LA al Consejo Administrativo, referidos a nuevos temas que puedan o no ser diferentes de los grupos de trabajo tem&aacute;ticos de CAN-I.&nbsp;<strong>&nbsp;</strong></p>\r\n\r\n<p><strong>50.&nbsp;</strong>Los Grupos de Trabajo Tem&aacute;ticos se formar&aacute;n para hacer frente a cuestiones particulares, y generar experiencia dentro de CAN-LA.</p>\r\n\r\n<p><strong>51.&nbsp;</strong>Los resultados en borrador de los Grupos de Trabajo Tem&aacute;ticos ser&aacute;n publicados dentro de CAN-LA para ser comentados por los miembros, y los miembros del GTT tomar&aacute;n en cuenta los comentarios recibidos para presentar el resultado final a la red.</p>\r\n\r\n<p><strong>52.&nbsp;</strong>Los resultados de los GTT pueden llegar a ser posiciones o declaraciones de CAN-LA cuando habiendo sido publicados en la lista de correo de can-la no tuvieran objeciones luego de un periodo de 15 d&iacute;as.</p>\r\n\r\n<p><strong>53.&nbsp;</strong>Los trabajos de estos Grupos pueden ser financiados por CAN-LA o CAN-I.<strong>&nbsp;</strong></p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<h1>K.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE LOS NODOS DE LA ORGANIZACI&Oacute;N CAN-LA Y SU GOBERNANZA</h1>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>54.&nbsp;</strong>Un Nodo Nacional es una asociaci&oacute;n de miembros aut&oacute;nomos de CAN-LA de un determinado pa&iacute;s, formado para presentar una sola voz nacional ante la Asamblea Regional.</p>\r\n\r\n<p><strong>55.&nbsp;</strong>Pueden formarse tambi&eacute;n Nodos Sub-regionales entre nodos nacionales de pa&iacute;ses miembros de CAN-LA o de miembros de CAN-LA en base a su cercan&iacute;a geogr&aacute;fica o a otros intereses.</p>\r\n\r\n<p><strong>56.&nbsp;</strong>Todos los Nodos Nacionales y los Sub-regionales existentes y los nuevos que se formen, solicitar&aacute;n su registro en CAN-LA ante el Consejo Administrativo, dentro de los 30 d&iacute;as de haber acordado crear o relanzar el Nodo, adjuntando una lista de sus miembros, el nombre del Nodo y todos sus documentos de gobernanza.</p>\r\n\r\n<p><strong>57.&nbsp;</strong>El Consejo Administrativo publicar&aacute; los Nodos y las listas de sus miembros en su p&aacute;gina Web para el per&iacute;odo de observaci&oacute;n.</p>\r\n\r\n<p><strong>58.&nbsp;</strong>Cualquier miembro o Nodo (en caso de Nodos sub-regionales) del &aacute;mbito de operaci&oacute;n del Nodo que solicita su registro, que no haya sido incluido,&nbsp; puede pronunciarse a favor o en contra de su inclusi&oacute;n en el Nodo durante el per&iacute;odo de observaci&oacute;n determinado por el&nbsp; Consejo Administrativo.</p>\r\n\r\n<p><strong>59.&nbsp;</strong>Una vez concluido el per&iacute;odo de observaci&oacute;n, el Consejo Administrativo de CAN-LA, registrar&aacute; el Nodo y comunicar&aacute; a la Junta Directiva de CAN-I para su registro.</p>\r\n\r\n<p><strong>60.&nbsp;</strong>En el caso de una objeci&oacute;n a la inclusi&oacute;n de un Nodo, el Consejo Administrativo intentar&aacute; primero resolver la controversia y luego decidir. El Consejo Administrativo deber&aacute; emitir una decisi&oacute;n fundada, incluyendo la cancelaci&oacute;n, el cambio de nombre y/o re-demarcaci&oacute;n del Nodo (en caso de un Nodo Sub regional). Al hacerlo, el Consejo Administrativo de CAN-LA tratar&aacute; de evaluar los requisitos de la libertad de asociaci&oacute;n y la buena organizaci&oacute;n. Si el Coordinador Regional y el Consejo Administrativo est&aacute;n en duda, podr&aacute;n remitir el asunto a la Asamblea Regional para su decisi&oacute;n.</p>\r\n\r\n<p><strong>61.&nbsp;</strong>Un Nodo Nacional de CAN LA, por decisi&oacute;n de sus miembros, puede llevar a cabo, sin restricciones y de forma aut&oacute;noma, actividades nacionales se&ntilde;alando incluso la pertenencia de sus miembros a CAN-LA y a CAN -I.</p>\r\n\r\n<p><strong>62.&nbsp;</strong>El&nbsp; Nodo Nacional: 1) Debe participar y cooperar con las acciones del Nodo Sub-regional, de CAN-LA y de CAN, que sean decididas en sus &oacute;rganos democr&aacute;ticos de decisi&oacute;n. 2) Podr&aacute;, con autorizaci&oacute;n del Consejo Administrativo de CAN-LA, llevar a cabo actividades bajo el nombre de CAN-LA.</p>\r\n\r\n<p><strong>63.&nbsp;</strong>Un Nodo Nacional o Sub-regional puede crear una entidad jur&iacute;dica, recaudar fondos, y llevar a cabo actividades aut&oacute;nomas para promover la visi&oacute;n, misi&oacute;n y actividades del Nodo, de CAN-LA y CAN-I. Un Nodo Nacional o Sub-regional tendr&aacute; un &oacute;rgano de gobierno apropiado basado en los principios de responsabilidad y de transparencia.</p>\r\n\r\n<p><strong>64.&nbsp;</strong>Los Nodos son libres de establecer las normas y c&oacute;digos de conducta que consideren necesarias. Estas normas no deben estar en conflicto con las disposiciones de este Reglamento y del Estatuto de CAN-I.</p>\r\n\r\n<p><strong>65.&nbsp;</strong>Cada &oacute;rgano de gobierno del Nodo es responsable ante sus miembros. En el caso de fallar en sus responsabilidades, los miembros pueden informar seg&uacute;n sea el caso, al Coordinador o&nbsp; al Consejo Administrativo de CAN-LA, que deber&aacute;n intervenir y resolver la materia, siguiendo el procedimiento establecido.</p>\r\n\r\n<p><strong>66.&nbsp;</strong>Cada Nodo debe nombrar a un Coordinador y a un Alterno.</p>\r\n\r\n<p><strong>67.&nbsp;</strong>Los Nodos pueden establecer las reglas para el nombramiento, la rotaci&oacute;n, los t&eacute;rminos de referencia, y las actividades del Coordinador y el Alterno.</p>\r\n\r\n<p><strong>68.&nbsp;</strong>En la medida de lo posible, los Nodos son responsables de la financiaci&oacute;n necesaria para los costos del Nodo, incluidos los costos del Coordinador y el Alterno. Los Nodos pueden solicitar financiamiento a CAN-LA o CAN-I</p>\r\n\r\n<p><strong>69.&nbsp;</strong>En el caso de cualquier financiaci&oacute;n recibida de CAN-LA o de CAN-I, los Nodos ser&aacute;n responsables ante CAN-LA o CAN-I&nbsp; de la divulgaci&oacute;n completa y de la rendici&oacute;n de cuentas apropiada, relacionadas con la financiaci&oacute;n solicitada y recibida.</p>\r\n\r\n<p><strong>70.&nbsp;</strong>En el caso de fondos recaudados por el Nodo en nombre de CAN-LA o CAN-I, el Nodo garantizar&aacute; una buena coordinaci&oacute;n de la financiaci&oacute;n compartiendo informaci&oacute;n sobre tal financiaci&oacute;n con CAN-LA y la Secretar&iacute;a de CAN al final del ejercicio anual.</p>\r\n\r\n<p><strong>71.&nbsp;</strong>Los Nodos registrados estar&aacute;n sujetos al C&oacute;digo de Conducta y las disposiciones de este Reglamento y del Estatuto de CAN-I.</p>\r\n\r\n<h1>L.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE LAS DECLARACIONES DE CAN-LA Y SUS MIEMBROS O NODOS</h1>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>72.&nbsp;</strong>Una declaraci&oacute;n es una toma de posici&oacute;n p&uacute;blica adoptada por el Nodo en el plano internacional a trav&eacute;s del proceso de la toma de decisiones establecido en el art&iacute;culo 52 del presente reglamento,, e incluye las posiciones existentes de CAN-I.</p>\r\n\r\n<p><strong>73.&nbsp;</strong>Si un miembro o Nodo desea que emitir una declaraci&oacute;n bajo el nombre de CAN-LA, la declaraci&oacute;n o fragmento debe estar de acuerdo con la posici&oacute;n de CAN-LA y de CAN-I. Cualquier miembro o Nodo es libre de emitir dicho extracto en cualquier momento. En el caso que un miembro o Nodo desee poner su propia interpretaci&oacute;n en el extracto, se aplica lo dispuesto en el art&iacute;culo siguiente.</p>\r\n\r\n<p><strong>74.&nbsp;</strong>Los Nodos no pueden emitir declaraciones en nombre de CAN-LA o CAN-I que sean contradictorias con el fondo o en su interpretaci&oacute;n, con las declaraciones de CAN-LA o CAN-I. En caso de duda al respecto, el miembro o el Nodo deber&aacute; presentar primero la declaraci&oacute;n al Consejo Administrativo o a la Junta Directiva de CAN-I con una petici&oacute;n para emitir dicha Declaraci&oacute;n a nombre de CAN. En este caso CAN-LA o CAN-I deben determinar si la declaraci&oacute;n est&aacute; en consonancia con la posici&oacute;n de CAN-LA o CAN-I.</p>\r\n\r\n<p><strong>75.&nbsp;</strong>Cualquier miembro o Nodo de CAN-LA puede emitir un comunicado por propio derecho. Si esta afirmaci&oacute;n est&aacute; en contradicci&oacute;n con una declaraci&oacute;n de CAN-I, este hecho debe ser reconocido y se&ntilde;alado por el miembro en la declaraci&oacute;n. Todos los miembros o Nodos son libres de tener opiniones contrarias a las declaraciones de CAN-I sobre esta base.</p>\r\n\r\n<p><strong>76.&nbsp;</strong>En caso que un miembro o Nodo emitiera una declaraci&oacute;n en nombre de CAN-LA o CAN-I, que est&eacute; en conflicto con una posici&oacute;n de CAN-LA o CAN-I, sin que haya sido previamente consultada, cualquier otro miembro o Nodo podr&aacute; elevar una queja formal a CAN-LA y/o CAN-I. Cualquiera de &eacute;stas podr&aacute;, entonces, tomar los pasos descritos en el caso de una violaci&oacute;n al C&oacute;digo de Conducta y del presente Reglamento.</p>\r\n\r\n<h1>M.-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DEL CODIGO DE CONDUCTA DE LOS MIEMBROS DE CAN-LA</h1>\r\n\r\n<p>Con base en el deseo de progresar y mejorar la vida de las personas a trav&eacute;s de la lucha contra los efectos nocivos del cambio clim&aacute;tico, estamos comprometidos con los siguientes valores fundamentales que sustentan la misi&oacute;n, la visi&oacute;n y los objetivos de CAN-LA y de sus miembros. Por lo tanto, nos comprometemos a regirnos por:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>La participaci&oacute;n, seriedad, compromiso, responsabilidad y transparencia en nuestro trabajo y en la toma de decisiones.</li>\r\n	<li>La garant&iacute;a de que CAN-LA siga siendo fiel a su visi&oacute;n, misi&oacute;n y objetivos compartidos con CAN-I.</li>\r\n	<li>La cooperaci&oacute;n mutua, colaboraci&oacute;n y trabajo en red en el &aacute;mbito&nbsp; latinoamericano y con otras organizaciones en torno a cuestiones de inter&eacute;s mutuo relacionados con el cambio clim&aacute;tico.</li>\r\n</ul>\r\n', 'R', '2014-05-05 12:43:14', '2014-05-05 12:43:14', NULL, 'A'),
(7, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. Pellentesque malesuada ultrices sapien vel elementum. Nunc ligula nisi, mollis blandit scelerisque id, auctor in ipsum. Nullam non velit vitae lectus feugiat volutpat. Mauris nibh libero, pharetra dignissim volutpat in, viverra a mauris. In convallis gravida magna vitae placerat.</p>\r\n\r\n<p>Vestibulum hendrerit in augue nec ultrices. Aliquam nec tincidunt erat, non pretium quam. Maecenas sed est nec nibh fermentum suscipit in eget nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi porttitor, sapien quis tristique varius, nulla est consequat risus, id tristique lorem elit sed lacus. Nulla facilisi. Nunc eu facilisis metus, et accumsan risus. Vestibulum sit amet suscipit nunc. Praesent nec velit tellus. Nunc nec quam sed nisl ultrices porttitor vitae eget velit. Aliquam a pellentesque diam. Morbi tincidunt, urna nec ultricies condimentum, nisl orci ullamcorper tellus, in auctor diam magna non nibh. Sed accumsan arcu et metus luctus bibendum.</p>\r\n', 'H', '2014-05-05 13:02:26', '2014-05-05 13:02:26', NULL, 'A'),
(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie pretium ante, ac lobortis velit auctor sit amet. Proin orci ligula, porta at nunc at, vulputate dictum justo. Cras non neque non lorem sagittis tincidunt. Nullam faucibus tortor euismod, condimentum elit eu, fermentum velit. Pellentesque malesuada ultrices sapien vel elementum. Nunc ligula nisi, mollis blandit scelerisque id, auctor in ipsum. Nullam non velit vitae lectus feugiat volutpat. Mauris nibh libero, pharetra dignissim volutpat in, viverra a mauris. In convallis gravida magna vitae placerat.', 'C', '2014-05-05 16:50:22', '2014-05-05 16:50:22', NULL, 'A');

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
-- Filtros para la tabla `notaprensa_archivo`
--
ALTER TABLE `notaprensa_archivo`
  ADD CONSTRAINT `FK_notaprensa_archivo_notaprensa` FOREIGN KEY (`idNotaPrensa`) REFERENCES `notaprensa` (`idNotaPrensa`);

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
