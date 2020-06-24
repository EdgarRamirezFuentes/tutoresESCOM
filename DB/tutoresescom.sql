-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-06-2020 a las 02:36:20
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tutoresescom`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `agregarAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarAdmin` (IN `id` CHAR(18), `nombre` VARCHAR(100), `correo` VARCHAR(100), `pass` VARCHAR(100))  begin
insert into admin values (id,nombre,correo,pass);
end$$

DROP PROCEDURE IF EXISTS `agregarAlumno`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarAlumno` (IN `id` CHAR(18), `nombre` VARCHAR(100), `correo` VARCHAR(100), `pass` VARCHAR(100), `rol` VARCHAR(100), `descripcion` VARCHAR(100), `fecha` DATE, `foto` VARCHAR(100), `tarjeta` VARCHAR(100))  begin
insert into alumno values (id, nombre, correo, pass, rol, descripcion, fecha, foto, tarjeta);
end$$

DROP PROCEDURE IF EXISTS `agregarContenido`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarContenido` (IN `curso` INT, `nombre` VARCHAR(100))  begin
insert into contenido (idCurso, nombreContenido) values(curso, nombre);
end$$

DROP PROCEDURE IF EXISTS `agregarCurso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarCurso` (IN `tutor` CHAR(18), `nombre` VARCHAR(100), `descripcion` TEXT, `fecha` DATE, `precio` FLOAT, `idioma` INT, `categoria` INT, `institucion` INT)  begin
insert into curso (idTutor, nombreCurso, descripcionCurso, fechaModificacionCurso, precioCurso, idIdioma, idCategoria, idInstitucion) values (tutor, nombre, descripcion, fecha, precio, idioma, categoria, institucion);
end$$

DROP PROCEDURE IF EXISTS `agregarTarjeta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarTarjeta` (IN `numero` VARCHAR(100), `nombre` VARCHAR(100), `mes` CHAR(2), `anio` CHAR(2), `cvv` VARCHAR(100))  begin
insert into tarjeta values (numero, nombre, mes, anio, cvv);
end$$

DROP PROCEDURE IF EXISTS `agregarTutor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarTutor` (IN `id` VARCHAR(100), `nombre` VARCHAR(100), `correo` VARCHAR(100), `pass` VARCHAR(100), `rol` VARCHAR(100), `descripcion` VARCHAR(100), `fecha` DATE, `foto` VARCHAR(100), `tarjeta` VARCHAR(100))  begin
insert into tutor values(id, nombre, correo, pass, rol, descripcion, fecha, foto, tarjeta);
end$$

DROP PROCEDURE IF EXISTS `buscarAlumno`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarAlumno` (IN `parametro` VARCHAR(100))  begin
select * from alumnoRegistradosAdmin where idAlumno like concat("%",parametro,"%") or nombreAlumno like concat("%",parametro,"%") group by idAlumno order by nombreAlumno;
end$$

DROP PROCEDURE IF EXISTS `buscarTutor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarTutor` (IN `parametro` VARCHAR(100))  begin
select * from tutorRegistradosAdmin where idTutor like CONCAT("%",parametro,"%") or nombreTutor like CONCAT("%",parametro,"%") group by idTutor order by nombreTutor;
end$$

DROP PROCEDURE IF EXISTS `cursoInscritosAlumno`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cursoInscritosAlumno` (IN `alumno` CHAR(18))  begin
 select c.idCurso, t.nombreTutor, c.nombreCurso, c.descripcionCurso, c.precioCurso, i.descripcionIdioma, ca.descripcionCategoria, ins.descripcionInstitucion from curso c, categoria ca, idioma i,tutor t, institucion ins, alumno a, inscripcion insc where insc.idCurso = c.idCurso and insc.idAlumno = alumno and c.idTutor = t.idTutor and c.idIdioma = i.idIdioma and c.idCategoria = ca.idCategoria and c.idInstitucion = ins.idInstitucion group by insc.idCurso order by c.nombreCurso;
end$$

DROP PROCEDURE IF EXISTS `eliminarAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarAdmin` (IN `id` CHAR(18))  begin
delete from admin where idAdmin = id;
end$$

DROP PROCEDURE IF EXISTS `eliminarAlumno`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarAlumno` (IN `id` CHAR(18))  begin
delete from alumno where idAlumno = id;
end$$

DROP PROCEDURE IF EXISTS `eliminarContenido`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarContenido` (IN `contenido` INT)  begin
delete from contenido where idContenido = contenido;
end$$

DROP PROCEDURE IF EXISTS `eliminarCurso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarCurso` (IN `id` INT)  begin
delete from curso where idCurso = id;
end$$

DROP PROCEDURE IF EXISTS `eliminarTarjeta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarTarjeta` (IN `numero` VARCHAR(100))  begin
delete from tarjeta where numeroTarjeta = numero;
end$$

DROP PROCEDURE IF EXISTS `eliminarTutor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarTutor` (IN `id` CHAR(18))  begin
delete from tutor where idTutor = id;
end$$

DROP PROCEDURE IF EXISTS `inscribirCurso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inscribirCurso` (IN `curso` INT, `alumno` CHAR(18), `fecha` DATE, `precio` FLOAT)  begin
insert into inscripcion values(curso,alumno,fecha,precio);
end$$

DROP PROCEDURE IF EXISTS `modificarAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarAdmin` (IN `id` CHAR(18), `nombre` VARCHAR(100), `correo` VARCHAR(100), `pass` VARCHAR(100))  begin
update admin set nombreAdmin = nombre, correoAdmin = correo, contraseniaAdmin = pass where idAdmin = id;
end$$

DROP PROCEDURE IF EXISTS `modificarAlumno`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarAlumno` (IN `id` VARCHAR(100), `nombre` VARCHAR(100), `correo` VARCHAR(100), `pass` VARCHAR(100), `rol` VARCHAR(100), `descripcion` VARCHAR(100))  begin
update alumno set nombreAlumno = nombre, correoAlumno = correo, contraseniaAlumno = pass, rolAlumno = rol, descripcionAlumno = descripcion where idAlumno = id; 
end$$

DROP PROCEDURE IF EXISTS `modificarCurso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarCurso` (IN `id` INT, `nombre` VARCHAR(100), `descripcion` VARCHAR(100), `fecha` DATE, `precio` FLOAT, `idioma` INT, `categoria` INT, `institucion` INT)  begin
update curso set nombreCurso = nombre, descripcionCurso = descripcion, fechaModificacionCurso = fecha, precioCurso = precio, idIdioma = idioma, idCategoria = categoria, idInstitucion = institucion where idCurso = id;
end$$

DROP PROCEDURE IF EXISTS `modificarTutor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarTutor` (IN `id` CHAR(18), `nombre` VARCHAR(100), `correo` VARCHAR(100), `pass` VARCHAR(100), `rol` VARCHAR(100), `descripcion` VARCHAR(100))  begin
update tutor set nombreTutor = nombre, correoTutor = correo, contraseniaTutor = pass, rolTutor = rol, descripcionTutor = descripcion where idTutor = id;
end$$

DROP PROCEDURE IF EXISTS `mostrarCompras`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarCompras` (`tutor` CHAR(18))  begin
select c.nombreCurso, a.nombreAlumno, i.fechaInscripcion,  i.precioInscripcion from curso c, alumno a, inscripcion i where c.idCurso = i.idCurso and a.idAlumno = i.idAlumno AND c.idTutor = tutor;
end$$

DROP PROCEDURE IF EXISTS `mostrarHistorialAlumno`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarHistorialAlumno` (IN `alumno` CHAR(18))  begin
select c.nombreCurso, i.precioInscripcion, i.fechaInscripcion from inscripcion i, curso c where i.idAlumno = alumno and c.idCurso = i.idCurso order by fechaInscripcion;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` char(18) NOT NULL,
  `nombreAdmin` varchar(100) NOT NULL,
  `correoAdmin` varchar(100) NOT NULL,
  `contraseniaAdmin` varchar(100) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`idAdmin`, `nombreAdmin`, `correoAdmin`, `contraseniaAdmin`) VALUES
('ADMIN', 'ADMIN', 'ADMIN@ADMIN.COM', '835d6dc88b708bc646d6db82c853ef4182fabbd4a8de59c213f2b5ab3ae7d9be'),
('RAFE980812HDFMND02', 'EDGAR ALEJANDRO RAMÍREZ FUENTES', 'EDGAR-ALEJANDRO-FUENTES@HOTMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `adminregistrados`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `adminregistrados`;
CREATE TABLE IF NOT EXISTS `adminregistrados` (
`idAdmin` char(18)
,`nombreAdmin` varchar(100)
,`correoAdmin` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `idAlumno` char(18) NOT NULL,
  `nombreAlumno` varchar(100) NOT NULL,
  `correoAlumno` varchar(100) NOT NULL,
  `contraseniaAlumno` varchar(100) NOT NULL,
  `rolAlumno` varchar(100) NOT NULL,
  `descripcionAlumno` varchar(100) NOT NULL,
  `fechaRegistroAlumno` date NOT NULL,
  `fotografiaAlumno` varchar(100) NOT NULL,
  `numeroTarjeta` varchar(100) NOT NULL,
  PRIMARY KEY (`idAlumno`),
  KEY `numeroTarjeta` (`numeroTarjeta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idAlumno`, `nombreAlumno`, `correoAlumno`, `contraseniaAlumno`, `rolAlumno`, `descripcionAlumno`, `fechaRegistroAlumno`, `fotografiaAlumno`, `numeroTarjeta`) VALUES
('RAFE980812HDFMND00', 'EDGAR ALEJANDRO RAMíREZ FUENTES', 'EDGAR@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER Y ESTUDIANTE DE INGENIERíA EN SISTEMAS', 'ESTUDIANTE DE ESCOM E INTEGRANTE DEL CLUB DE ALGORITMIA', '2020-06-09', 'RAFE980812HDFMND00.jpg', '0'),
('RAFE980812HDFMND30', 'ALFREDO', 'ALFREDO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND30.jpg', '30'),
('RAFE980812HDFMND02', 'RODOLFO', 'RODOLFO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND02.jpg', '2'),
('RAFE980812HDFMND03', 'YAEL', 'YAEL@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND03.jpg', '3'),
('RAFE980812HDFMND04', 'TONY', 'TONY@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND04.jpg', '4'),
('RAFE980812HDFMND05', 'IVAN', 'IVAN@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND05.jpg', '5'),
('RAFE980812HDFMND06', 'JAIR', 'JAIR@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND06.jpg', '06'),
('RAFE980812HDFMND07', 'ALAN', 'ALAN@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND07.jpg', '07'),
('RAFE980812HDFMND08', 'JOSIAS', 'JOSIAS@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND08.jpg', '8'),
('RAFE980812HDFMND09', 'FERNANDA', 'FERNANDA@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND09.jpg', '9'),
('RAFE980812HDFMND10', 'JUAN', 'JUAN@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND10.jpg', '10'),
('RAFE980812HDFMND11', 'BERNARDO', 'BERNARDO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND11.jpg', '11'),
('RAFE980812HDFMND12', 'ERIK', 'ERIK@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND12.jpg', '12'),
('RAFE980812HDFMND13', 'HECTOR', 'HECTOR@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND13.jpg', 'hector'),
('RAFE980812HDFMND14', 'DANIEL', 'DANIEL@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND14.jpg', '14'),
('RAFE980812HDFMND15', 'DAVID', 'DAVID@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND15.jpg', '15'),
('RAFE980812HDFMND16', 'LOURDES', 'LOURDES@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND16.jpg', '16'),
('RAFE980812HDFMND17', 'MALU', 'MALU@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND17.jpg', '17'),
('RAFE980812HDFMND18', 'KIEV', 'KIEV@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND18.jpg', '18'),
('RAFE980812HDFMND19', 'GISELLE', 'GISELLE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND19.jpg', '19'),
('RAFE980812HDFMND20', 'EVA', 'EVA@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND20.jpg', '20'),
('RAFE980812HDFMND21', 'RODRIGO', 'RODRIGO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND21.jpg', '21'),
('RAFE980812HDFMND22', 'FARID', 'FARID@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND22.jpg', '22'),
('RAFE980812HDFMND23', 'EDUARDO', 'EDUARDO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND23.jpg', 'eduardo'),
('RAFE980812HDFMND24', 'MONTSE', 'MONTSE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND24.jpg', '24'),
('RAFE980812HDFMND25', 'CESAR', 'CESAR@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND25.jpg', '25'),
('RAFE980812HDFMND26', 'DAFNE', 'DAFNE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND26.jpg', '26'),
('RAFE980812HDFMND27', 'HUGO', 'HUGO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND27.jpg', '27'),
('RAFE980812HDFMND28', 'ARTURO', 'ARTURO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND28.jpg', '28'),
('RAFE980812HDFMND29', 'PATRICIA', 'PATRICIA@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'ESTUDIANTE', '2020-06-09', 'RAFE980812HDFMND29.jpg', '29');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `alumnoregistradosadmin`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `alumnoregistradosadmin`;
CREATE TABLE IF NOT EXISTS `alumnoregistradosadmin` (
`idAlumno` char(18)
,`nombreAlumno` varchar(100)
,`correoAlumno` varchar(100)
,`fechaRegistroAlumno` date
,`fotografiaAlumno` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionCategoria` varchar(100) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `descripcionCategoria`) VALUES
(10, 'DESARROLLO WEB'),
(11, 'CIENCIAS DE LA INFORMACIÓN'),
(12, 'BASES DE DATOS'),
(13, 'INGENIERÍA DE SOFTWARE'),
(14, 'DESARROLLO DE VIDEOJUEGOS'),
(15, 'TESTING DE SOFTWARE'),
(16, 'APLICACIONES MÓVILES'),
(17, 'REDES Y SEGURIDAD'),
(18, 'SISTEMAS OPERATIVOS'),
(19, 'DISEÑO GRÁFICO'),
(20, 'MARKETING'),
(21, 'ECONOMÍA'),
(22, 'ADMINISTRACIÓN'),
(23, 'OTROS'),
(24, 'LENGUAJES DE PROGRAMACIÓN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

DROP TABLE IF EXISTS `contenido`;
CREATE TABLE IF NOT EXISTS `contenido` (
  `idContenido` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(11) NOT NULL,
  `nombreContenido` varchar(100) NOT NULL,
  PRIMARY KEY (`idContenido`),
  KEY `idCurso` (`idCurso`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`idContenido`, `idCurso`, `nombreContenido`) VALUES
(2, 15, '01 - introducción'),
(4, 23, '01 - introducción'),
(5, 38, '01 - introducción'),
(6, 31, '01 - introducción'),
(7, 26, '01 - introducción'),
(8, 35, '01 - introducción'),
(9, 25, '01 - introducción'),
(10, 39, '01 - introducción'),
(11, 30, '01 - introducción'),
(12, 27, '01 - introducción'),
(13, 16, '01 - introducción'),
(14, 28, '01 - introducción'),
(15, 34, '01 - introducción'),
(16, 42, '01 - introducción'),
(17, 37, '01 - introducción'),
(18, 32, '01 - introducción'),
(19, 24, '01 - introducción'),
(20, 41, '01 - introducción'),
(21, 14, '01 - introducción'),
(22, 33, '01 - introducción'),
(23, 44, '01 - introducción'),
(24, 36, '01 - introducción'),
(25, 45, '01 - introducción'),
(26, 40, '01 - introducción'),
(27, 22, '01 - introducción'),
(28, 43, '02 - Primer video'),
(29, 23, '02 - Primer video'),
(30, 38, '02 - Primer video'),
(31, 31, '02 - Primer video');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `idTutor` char(18) NOT NULL,
  `nombreCurso` varchar(100) NOT NULL,
  `descripcionCurso` text NOT NULL,
  `fechaModificacionCurso` date NOT NULL,
  `precioCurso` float NOT NULL,
  `idIdioma` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idInstitucion` int(11) NOT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `idIdioma` (`idIdioma`),
  KEY `idCategoria` (`idCategoria`),
  KEY `idInstitucion` (`idInstitucion`),
  KEY `idTutor` (`idTutor`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `idTutor`, `nombreCurso`, `descripcionCurso`, `fechaModificacionCurso`, `precioCurso`, `idIdioma`, `idCategoria`, `idInstitucion`) VALUES
(14, 'RAFE980812HDFMND00', 'JAVASCRIPT DE CERO A EXPERTO MASTER', 'CURSO DE JAVASCRIPT', '2020-06-20', 260, 1, 10, 2),
(15, 'RAFE980812HDFMND00', 'PHP DE CERO A EXPERTO', 'CURSO DE PHP', '2020-06-20', 300.5, 1, 10, 1),
(16, 'RAFE980812HDFMND00', 'FUNDAMENTOS DE ECONOMíA', 'CURSO DE FUNDAMENTOS DE ECONOMíA', '2020-06-20', 350.5, 1, 21, 3),
(31, 'RAFE980812HDFMND00', 'ANáLISIS FUNDAMENTAL DE CIRCUITOS', 'CURSO DE ANáLISIS FUNDAMENTAL DE CIRCUITOS', '2020-06-22', 350.41, 1, 23, 14),
(18, 'RAFE980812HDFMND04', 'FUNDAMENTOS DE GEOFíSICA', 'CURSO DE FUNDAMENTOS DE GEOFíSICA', '2020-06-20', 650.23, 1, 23, 1),
(19, 'RAFE980812HDFMND04', 'PYTHON DE CERO A EXPERTO', 'CURSO PYTHON DE CERO A EXPERTO', '2020-06-20', 750.5, 1, 24, 7),
(20, 'RAFE980812HDFMND03', 'FUNDAMENTOS DE CRIMINALíSTICA', 'CURSO DE FUNDAMENTOS DE CRIMINALíSTICA', '2020-06-20', 230.5, 1, 23, 11),
(21, 'RAFE980812HDFMND03', 'FUNDAMENTOS DE CRIMINOLOGíA', 'CURSO DE FUNDAMENTOS DE CRIMINOLOGíA', '2020-06-20', 450.5, 2, 23, 9),
(22, 'RAFE980812HDFMND00', 'WEB DEVELOPMENT', 'WEB DEVELOPMENT COURSE', '2020-06-20', 560.6, 2, 10, 1),
(23, 'RAFE980812HDFMND00', 'ALGORITHMS AND DATA STRUCTURES', 'ALGORITHMS AND DATA STRUCTURES COURSE', '2020-06-20', 450.9, 2, 13, 10),
(24, 'RAFE980812HDFMND00', 'INTELIGENCIA ARTIFICIAL DE CERO A EXPERTO', 'CURSO DE INTELIGENCIA ARTIFICIAL DE CERO A EXPERTO', '2020-06-20', 450.6, 1, 11, 1),
(25, 'RAFE980812HDFMND00', 'DESARROLLO DE VIDEOJUEGOS CON UNITY 2019', 'CURSO DE DESARROLLO DE VIDEOJUEGOS', '2020-06-20', 1250.5, 1, 14, 9),
(26, 'RAFE980812HDFMND00', 'CáLCULO DIFERENCIAL', 'CURSO DE CáLCULO DIFERENCIAL', '2020-06-20', 650.7, 1, 23, 2),
(27, 'RAFE980812HDFMND00', 'FUNDAMENTOS DE DART', 'CUSO DE FUNDAMENTOS DE DART', '2020-06-20', 450.9, 1, 16, 4),
(28, 'RAFE980812HDFMND00', 'FUNDAMENTOS DE FLUTTER', 'CURSO DE FUNDAMENTOS DE FLUTTER', '2020-06-20', 150.6, 1, 16, 11),
(30, 'RAFE980812HDFMND00', 'FLUTTER AVANZADO', 'CURSO DE FLUTTER AVANZADO', '2020-06-20', 350.5, 1, 16, 2),
(32, 'RAFE980812HDFMND00', 'INGENIERíA éTICA Y SOCIEDAD', 'CURSO DE IES', '2020-06-22', 420.31, 12, 23, 4),
(33, 'RAFE980812HDFMND00', 'MATEMáTICAS DISCRETAS', 'CURSO DE MATEMáTICAS DISCRETAS', '2020-06-22', 450.3, 14, 23, 8),
(34, 'RAFE980812HDFMND00', 'FUNDAMENTOS ECONóMICOS', 'CURSO DE FUNDAMENTOS ECONóMICOS', '2020-06-22', 490.22, 16, 21, 2),
(35, 'RAFE980812HDFMND00', 'COMUNICACIóN ORAL Y ESCRITA', 'CURSO DE COMUNICACIóN ORAL Y ESCRITA', '2020-06-22', 120.3, 1, 23, 10),
(36, 'RAFE980812HDFMND00', 'PROBABILIDAD Y ESTADíSTICA', 'CURSO DE PROBABILIDAD Y ESTADíSTICA', '2020-06-22', 483.1, 19, 23, 4),
(37, 'RAFE980812HDFMND00', 'INGENIERíA DE SOFTWARE', 'CURSO DE INGENIERíA DE SOFTWARE', '2020-06-22', 650.99, 2, 13, 2),
(38, 'RAFE980812HDFMND00', 'ANáLISIS DE ALGORITMOS', 'CURSO DE ANáLISIS DE ALGORITMOS', '2020-06-22', 950.33, 12, 13, 1),
(39, 'RAFE980812HDFMND00', 'DISEñO DE SISTEMAS DIGITALES', 'CURSO DE DSD', '2020-06-22', 456.9, 6, 23, 1),
(40, 'RAFE980812HDFMND00', 'TECNOLOGíAS PARA LA WEB', 'CURSO DE TECNOLOGíAS PARA LA WEB', '2020-06-22', 780.36, 2, 10, 13),
(41, 'RAFE980812HDFMND00', 'INTRODUCCIóN A LOS MICROCONTROLADORES', 'CURSO DE MICROCONTROLADORES', '2020-06-22', 950.23, 19, 23, 14),
(42, 'RAFE980812HDFMND00', 'GESTIóN EMPRESARIAL', 'CURSO DE GESTIóN EMPRESARIAL', '2020-06-22', 780.32, 2, 22, 2),
(43, 'RAFE980812HDFMND00', 'ADMINISTRACIóN DE SERVICIOS DE RED', 'CURSO DE SERVICIOS DE ADMINISTRACIóN DE RED', '2020-06-22', 782.65, 1, 17, 9),
(44, 'RAFE980812HDFMND00', 'MéTODOS CUANTITATIVOS PARA LA TOMA DE DECISIONES ', 'CURSO DE MéTODO CUANTITATIVOS PARA LA TOMA DE DECISIONES ', '2020-06-22', 560.21, 1, 23, 2),
(45, 'RAFE980812HDFMND00', 'PROGRAMACIóN ORIENTADA A OBJETOS', 'CURSO DE PROGRAMACIóN ORIENTADA A OBJETOS', '2020-06-22', 785.3, 2, 13, 4);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cursoregistradosadmin`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `cursoregistradosadmin`;
CREATE TABLE IF NOT EXISTS `cursoregistradosadmin` (
`idCurso` int(11)
,`nombreTutor` varchar(100)
,`nombreCurso` varchar(100)
,`descripcionCurso` text
,`precioCurso` float
,`descripcionIdioma` varchar(100)
,`descripcionCategoria` varchar(100)
,`descripcionInstitucion` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

DROP TABLE IF EXISTS `idioma`;
CREATE TABLE IF NOT EXISTS `idioma` (
  `idIdioma` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionIdioma` varchar(100) NOT NULL,
  PRIMARY KEY (`idIdioma`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`idIdioma`, `descripcionIdioma`) VALUES
(1, 'ESPAÑOL'),
(2, 'INGLÉS'),
(3, 'FRANCÉS'),
(4, 'ALEMÁN'),
(5, 'RUSO'),
(6, 'NÁHUATL'),
(7, 'MIXTECO'),
(8, 'CHINO'),
(9, 'HINDI'),
(10, 'ÁRABE'),
(11, 'BENGALÍ'),
(12, 'JAPONÉS'),
(13, 'ITALIANO'),
(14, 'PORTUGUÉS'),
(15, 'GRIEGO'),
(16, 'COREANO'),
(17, 'MONGOL'),
(18, 'ZAPOTECO'),
(19, 'OTOMÍ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE IF NOT EXISTS `inscripcion` (
  `idCurso` int(11) NOT NULL,
  `idAlumno` char(18) NOT NULL,
  `fechaInscripcion` date NOT NULL,
  `precioInscripcion` float NOT NULL,
  PRIMARY KEY (`idCurso`,`idAlumno`),
  KEY `idAlumno` (`idAlumno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`idCurso`, `idAlumno`, `fechaInscripcion`, `precioInscripcion`) VALUES
(23, 'RAFE980812HDFMND00', '2020-06-20', 450.9),
(26, 'RAFE980812HDFMND00', '2020-06-20', 650.7),
(27, 'RAFE980812HDFMND00', '2020-06-20', 450.9),
(17, 'RAFE980812HDFMND00', '2020-06-21', 500.6),
(22, 'RAFE980812HDFMND00', '2020-06-21', 560.6),
(19, 'RAFE980812HDFMND03', '2020-06-21', 750.5),
(22, 'RAFE980812HDFMND03', '2020-06-21', 560.6),
(4, 'RAFE980812HDFMND00', '2020-06-23', 450.9),
(43, 'RAFE980812HDFMND03', '2020-06-23', 782.65),
(23, 'RAFE980812HDFMND03', '2020-06-23', 450.9),
(38, 'RAFE980812HDFMND03', '2020-06-23', 950.33),
(31, 'RAFE980812HDFMND03', '2020-06-23', 350.41),
(26, 'RAFE980812HDFMND03', '2020-06-23', 650.7),
(35, 'RAFE980812HDFMND03', '2020-06-23', 120.3),
(39, 'RAFE980812HDFMND03', '2020-06-23', 456.9),
(30, 'RAFE980812HDFMND03', '2020-06-23', 350.5),
(34, 'RAFE980812HDFMND03', '2020-06-23', 490.22),
(24, 'RAFE980812HDFMND03', '2020-06-23', 450.6),
(45, 'RAFE980812HDFMND03', '2020-06-23', 785.3),
(15, 'RAFE980812HDFMND03', '2020-06-23', 300.5),
(40, 'RAFE980812HDFMND03', '2020-06-23', 780.36),
(43, 'RAFE980812HDFMND04', '2020-06-23', 782.65),
(23, 'RAFE980812HDFMND04', '2020-06-23', 450.9),
(38, 'RAFE980812HDFMND04', '2020-06-23', 950.33),
(31, 'RAFE980812HDFMND04', '2020-06-23', 350.41),
(25, 'RAFE980812HDFMND04', '2020-06-23', 1250.5),
(35, 'RAFE980812HDFMND04', '2020-06-23', 120.3),
(28, 'RAFE980812HDFMND04', '2020-06-23', 150.6),
(18, 'RAFE980812HDFMND04', '2020-06-23', 650.23),
(19, 'RAFE980812HDFMND04', '2020-06-23', 750.5),
(43, 'RAFE980812HDFMND00', '2020-06-23', 782.65);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

DROP TABLE IF EXISTS `institucion`;
CREATE TABLE IF NOT EXISTS `institucion` (
  `idInstitucion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionInstitucion` varchar(100) NOT NULL,
  PRIMARY KEY (`idInstitucion`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`idInstitucion`, `descripcionInstitucion`) VALUES
(1, 'INDEPENDIENTE'),
(2, 'INSTITUTO POLITÉCNICO NACIONAL'),
(3, 'UNIVERSIDAD NACIONAL AUTÓNOMA DE MÉXICO'),
(4, 'UNIVERSIDAD AUTÓNOMA METROPOLITANA'),
(5, 'UNIVERSIDAD IBEROAMERICANA'),
(6, 'UNITEC'),
(7, 'UNIVERSIDAD ANÁHUAC'),
(8, 'UNIVERSIDAD INSURGENTES'),
(9, 'UNIVERSIDAD ICEL'),
(10, 'UNIVERSIDAD DE LONDRES'),
(11, 'UNIVERSIDAD LA SALLE'),
(12, 'INSTITUTO TECNOLÓGICO Y DE ESTUDIOS SUPERIORES DE MONTERREY'),
(13, 'UNIVERSIDAD DE GUADALAJARA'),
(14, 'UNIVERSIDAD AUTÓNOMA DEL ESTADO DE MÉXICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

DROP TABLE IF EXISTS `tarjeta`;
CREATE TABLE IF NOT EXISTS `tarjeta` (
  `numeroTarjeta` varchar(100) NOT NULL,
  `nombrePropietario` varchar(100) NOT NULL,
  `mesVencimiento` char(2) NOT NULL,
  `anioVencimiento` char(4) NOT NULL,
  `CVV` varchar(100) NOT NULL,
  PRIMARY KEY (`numeroTarjeta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tarjeta`
--

INSERT INTO `tarjeta` (`numeroTarjeta`, `nombrePropietario`, `mesVencimiento`, `anioVencimiento`, `CVV`) VALUES
('0', 'EDGAR', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('30', 'ALFREDO', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('2', 'RODOLFO', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('3', 'YAEL', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('4', 'TONY', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('5', 'IVAN', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('6', 'JAIR', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('7', 'ALAN', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('8', 'JOSIAS', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('9', 'FERNANDA', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('10', 'JUAN', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('11', 'BERNARDO', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('12', 'ERIK', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('13', 'HECTOR', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('14', 'DANIEL', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('15', 'DAVID', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('16', 'LOURDES', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('17', 'MALU', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('18', 'KIEV', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('19', 'GISELLE', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('20', 'EVA', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('21', 'RODRIGO', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('22', 'FARID', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('23', 'EDUARDO', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('24', 'MONTSE', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('25', 'CESAR', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('26', 'DAFNE', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('27', 'HUGO', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('28', 'ARTURO', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('29', 'PATRICIA', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('1', 'ALEJANDRO', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
('49', 'BRUCE', '1', '20', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

DROP TABLE IF EXISTS `tutor`;
CREATE TABLE IF NOT EXISTS `tutor` (
  `idTutor` char(18) NOT NULL,
  `nombreTutor` varchar(100) NOT NULL,
  `correoTutor` varchar(100) NOT NULL,
  `contraseniaTutor` varchar(100) NOT NULL,
  `rolTutor` varchar(100) NOT NULL,
  `descripcionTutor` varchar(100) NOT NULL,
  `fechaRegistroTutor` date NOT NULL,
  `fotografiaTutor` varchar(100) NOT NULL,
  `numeroTarjeta` varchar(100) NOT NULL,
  PRIMARY KEY (`idTutor`),
  KEY `numeroTarjeta` (`numeroTarjeta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`idTutor`, `nombreTutor`, `correoTutor`, `contraseniaTutor`, `rolTutor`, `descripcionTutor`, `fechaRegistroTutor`, `fotografiaTutor`, `numeroTarjeta`) VALUES
('RAFE980812HDFMND00', 'EDGAR ALEJANDRO RAMíREZ FUENTES', 'EDGAR@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND00.jpg', '25'),
('RAFE980812HDFMND01', 'ALEJANDRO', 'ALEJANDRO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND01.jpg', '1'),
('RAFE980812HDFMND02', 'LUIS', 'LUIS@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND02.jpg', '2'),
('RAFE980812HDFMND03', 'RODOLFO', 'RODOLFO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND03.jpg', '3'),
('RAFE980812HDFMND04', 'YAEL', 'YAEL@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND04.jpg', '4'),
('RAFE980812HDFMND05', 'TONY', 'TONY@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND05.jpg', '5'),
('RAFE980812HDFMND06', 'ENRIQUE', 'ENRIQUE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND06.jpg', '6'),
('RAFE980812HDFMND07', 'GIUSEPPE', 'GIUSEPPE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND07.jpg', '7'),
('RAFE980812HDFMND08', 'HECTOR', 'HECTOR@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND08.jpg', '8'),
('RAFE980812HDFMND09', 'DANIEL', 'DANIEL@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND09.jpg', '9'),
('RAFE980812HDFMND10', 'DAVID', 'DAVID@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND10.jpg', '10'),
('RAFE980812HDFMND11', 'DANIELA', 'DANIELA@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND11.jpg', '11'),
('RAFE980812HDFMND12', 'BRANDON', 'BRANDON@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND12.jpg', '1'),
('RAFE980812HDFMND13', 'ERIKA', 'ERIKA@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND13.jpg', '1'),
('RAFE980812HDFMND14', 'KIEV', 'KIEV@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND14.jpg', '1'),
('RAFE980812HDFMND15', 'GISELLE', 'GISELLE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND15.jpg', '1'),
('RAFE980812HDFMND16', 'DIANA', 'DIANA@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND16.jpg', '1'),
('RAFE980812HDFMND17', 'JOSé', 'JOSE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND17.jpg', '1'),
('RAFE980812HDFMND18', 'LOURDES', 'LOURDES@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND18.jpg', '1'),
('RAFE980812HDFMND19', 'MALU', 'MALU@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND19.jpg', '1'),
('RAFE980812HDFMND20', 'VICENTE', 'VICENTE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND20.jpg', '1'),
('RAFE980812HDFMND21', 'GABRIEL', 'GABRIEL@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND21.jpg', '1'),
('RAFE980812HDFMND22', 'GABRIELA', 'GABRIELA@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND22.jpg', '1'),
('RAFE980812HDFMND23', 'EDGARDO', 'EDGARDO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND23.jpg', '1'),
('RAFE980812HDFMND24', 'GRECIA', 'GRECIA@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND24.jpg', '1'),
('RAFE980812HDFMND25', 'ROBERTO', 'ROBERTO@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND25.jpg', '1'),
('RAFE980812HDFMND26', 'JOAQUIN', 'JOAQUIN@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND26.jpg', '1'),
('RAFE980812HDFMND27', 'BARRY', 'BARRY@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-09', 'RAFE980812HDFMND27.jpg', '1'),
('RAFE980812HDFMND29', 'BRUCE', 'BRUCE@GMAIL.COM', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'WEB DEVELOPER', 'PROFESOR', '2020-06-15', 'RAFE980812HDFMND29.jpg', '49');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `tutorregistradosadmin`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `tutorregistradosadmin`;
CREATE TABLE IF NOT EXISTS `tutorregistradosadmin` (
`idTutor` char(18)
,`nombreTutor` varchar(100)
,`correoTutor` varchar(100)
,`fechaRegistroTutor` date
,`fotografiaTutor` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `adminregistrados`
--
DROP TABLE IF EXISTS `adminregistrados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `adminregistrados`  AS  select `admin`.`idAdmin` AS `idAdmin`,`admin`.`nombreAdmin` AS `nombreAdmin`,`admin`.`correoAdmin` AS `correoAdmin` from `admin` order by `admin`.`nombreAdmin` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `alumnoregistradosadmin`
--
DROP TABLE IF EXISTS `alumnoregistradosadmin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alumnoregistradosadmin`  AS  select `alumno`.`idAlumno` AS `idAlumno`,`alumno`.`nombreAlumno` AS `nombreAlumno`,`alumno`.`correoAlumno` AS `correoAlumno`,`alumno`.`fechaRegistroAlumno` AS `fechaRegistroAlumno`,`alumno`.`fotografiaAlumno` AS `fotografiaAlumno` from `alumno` order by `alumno`.`nombreAlumno` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `cursoregistradosadmin`
--
DROP TABLE IF EXISTS `cursoregistradosadmin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cursoregistradosadmin`  AS  select `c`.`idCurso` AS `idCurso`,`t`.`nombreTutor` AS `nombreTutor`,`c`.`nombreCurso` AS `nombreCurso`,`c`.`descripcionCurso` AS `descripcionCurso`,`c`.`precioCurso` AS `precioCurso`,`i`.`descripcionIdioma` AS `descripcionIdioma`,`ca`.`descripcionCategoria` AS `descripcionCategoria`,`ins`.`descripcionInstitucion` AS `descripcionInstitucion` from ((((`curso` `c` join `categoria` `ca`) join `idioma` `i`) join `tutor` `t`) join `institucion` `ins`) where ((`c`.`idTutor` = `t`.`idTutor`) and (`c`.`idIdioma` = `i`.`idIdioma`) and (`c`.`idCategoria` = `ca`.`idCategoria`) and (`c`.`idInstitucion` = `ins`.`idInstitucion`)) order by `c`.`nombreCurso` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `tutorregistradosadmin`
--
DROP TABLE IF EXISTS `tutorregistradosadmin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tutorregistradosadmin`  AS  select `tutor`.`idTutor` AS `idTutor`,`tutor`.`nombreTutor` AS `nombreTutor`,`tutor`.`correoTutor` AS `correoTutor`,`tutor`.`fechaRegistroTutor` AS `fechaRegistroTutor`,`tutor`.`fotografiaTutor` AS `fotografiaTutor` from `tutor` order by `tutor`.`nombreTutor` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
