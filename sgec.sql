-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2022 a las 01:40:23
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `sgec`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiarContra` (IN `_correo` VARCHAR(150), IN `_contra` VARCHAR(250))   BEGIN
	declare _id int;
	select id into _id from usuarios where correo = _correo;
    
	update usuarios
		set contra=_contra, confirmacion=1
		where id=_id;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `ValidarUsuario` (`_correo` VARCHAR(150), `_contra` VARCHAR(150)) RETURNS INT(11)  BEGIN
	DECLARE aux int default null;

	SELECT count(*) INTO aux FROM usuarios WHERE correo = _correo and contra=_contra;
    
IF aux = 0 THEN
        return 0; -- NO EXISTE ESE USUARIO
END IF;
return 1; -- SÍ EXISTE ESE USUARIO

 END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `verificarContra` (`_correo` VARCHAR(50)) RETURNS INT(11)  BEGIN
	DECLARE aux int default null;
		select confirmacion into aux from usuarios where correo = _correo;
        
IF aux = 0 THEN
         return 0; -- No confirmado
END IF;
return 1; -- Si confirmado

 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id` varchar(220) NOT NULL,
  `ubicacion` varchar(220) NOT NULL,
  `informacion` varchar(220) NOT NULL,
  `aforo` int(100) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `imagen` varchar(80) NOT NULL DEFAULT '''libs/img/upload/aulaDefecto.jpeg'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id`, `ubicacion`, `informacion`, `aforo`, `habilitado`, `imagen`) VALUES
('Aula 100', 'Pabellon 3, Planta baja, Puerta 4ª', 'tv, ordenadores', 30, 1, 'libs/img/upload/2F22C3B6-24F0-4518-9A67-784374EB740B.jpeg'),
('Aula 515', 'Pabellón 5, Planta 1ª, Puerta 1ª', 'Mesas, Sillas', 30, 0, 'libs/img/upload/aula1.jpg'),
('aula 7', 'l', 'l', 9, 0, 'libs/img/upload/aulaDefecto.jpeg'),
('Aula 700', 'Pabellon 3', 'Tv', 70, 1, 'libs/img/upload/aula1.jpg'),
('aula 8', 'l', 'l', 7, 1, 'libs/img/upload/aula1.jpg'),
('Aula 815', 'Pabellón 10, Planta 2ª, Puerta 1ª', 'Tv, Ordenadores, Sillas, Mesas', 30, 1, 'libs/img/upload/aulaDefecto.jpeg'),
('Aula Auxiliar', 'Pabellón 5', 'tv', 29, 0, 'libs/img/upload/aulaDefecto.jpeg'),
('Aula Extra', 'Pabellón 3', 'Tv', 50, 0, 'libs/img/upload/aulaDefecto.jpeg'),
('Aula Polivalente', 'Pabellón 10, Planta 1ª, Puerta 1ª', 'Mesas, Sillas, Pizarras', 70, 1, 'libs/img/upload/aula1.jpg'),
('Aula prueba 2', 'Pabellon 3', 'tv', 33, 1, 'libs/img/upload/aula1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `festivos`
--

CREATE TABLE `festivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `festivos`
--

INSERT INTO `festivos` (`id`, `Nombre`, `fechaInicio`, `fechaFinal`) VALUES
(1, 'Semana Santa', '2022-04-04', '2022-04-18'),
(2, 'Día del Trabajador', '2022-04-12', '2022-04-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `departamento` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `departamento`) VALUES
(1, 'DAW 2', 'Informática'),
(2, 'DAM 2', 'Informática'),
(3, 'DAW 1', 'Informática'),
(4, 'DAM 1', 'Informática');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `idAula` varchar(220) NOT NULL,
  `idUsuario` int(11) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `grupo` varchar(255) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `hora` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `idAula`, `idUsuario`, `fecha`, `grupo`, `motivo`, `hora`, `fecha_creacion`) VALUES
(149, 'Aula Polivalente', 1, '2022-05-03', 'DAM 1', 'Charla', '10:30AM - 11:30AM', '2022-04-29 21:26:44'),
(150, 'Aula Polivalente', 1, '2022-05-03', 'DAM 1', 'Charla', '09:30AM - 10:30AM', '2022-04-29 21:27:25'),
(151, 'Aula Polivalente', 1, '2022-05-03', 'DAM 2', 'Charla', '10:30AM - 11:30AM', '2022-04-29 21:29:57'),
(152, 'Aula Polivalente', 1, '2022-05-09', 'DAM 1', 'Charla', '08:30AM - 09:30AM', '2022-04-29 21:30:38'),
(153, 'Aula Polivalente', 1, '2022-05-13', 'DAW 2', 'Charla', '13:30PM - 14:30PM', '2022-04-29 21:36:20'),
(154, 'Aula 100', 1, '2022-05-13', 'DAM 1', 'Charla', '09:30AM - 10:30AM', '2022-04-29 21:51:16'),
(155, 'Aula 100', 1, '2022-05-13', 'DAW 1', 'Charla', '10:30AM - 11:30AM', '2022-04-29 22:08:06'),
(156, 'Aula 100', 1, '2022-05-13', 'DAW 1', 'Charla', '11:30AM - 12:30AM', '2022-04-29 22:10:51'),
(157, 'Aula 100', 1, '2022-05-13', 'DAM 2', 'Charla', '08:30AM - 09:30AM', '2022-04-29 22:11:07'),
(158, 'Aula 100', 1, '2022-05-13', 'DAM 1', 'Charla', '12:30AM - 13:30PM', '2022-04-29 22:14:38'),
(159, 'Aula 100', 1, '2022-05-13', 'DAM 1', 'Charla', '13:30PM - 14:30PM', '2022-04-29 22:14:44'),
(160, 'Aula Polivalente', 1, '2022-05-06', 'DAM 1', 'Charla', '09:30AM - 10:30AM', '2022-04-29 22:16:07'),
(161, 'Aula Polivalente', 1, '2022-05-04', 'DAM 1', 'Charla', '08:30AM - 09:30AM', '2022-04-29 22:17:01'),
(162, 'Aula Polivalente', 1, '2022-05-04', 'DAM 1', 'Charla', '09:30AM - 10:30AM', '2022-04-29 22:18:22'),
(163, 'Aula Polivalente', 1, '2022-05-06', 'DAM 1', 'Charla', '13:30PM - 14:30PM', '2022-04-29 22:18:29'),
(164, 'Aula 700', 1, '2022-05-11', 'DAM 1', 'Charla', '09:30AM - 10:30AM', '2022-04-29 22:18:41'),
(165, 'Aula 100', 1, '2022-05-03', 'DAM 1', 'examem', '09:30AM - 10:30AM', '2022-04-29 22:27:49'),
(166, 'Aula Polivalente', 1, '2022-05-05', 'DAM 1', 'Charla', '09:30AM - 10:30AM', '2022-04-30 21:07:07'),
(167, 'Aula 100', 1, '2022-05-05', 'DAM 1', 'Examen', '08:30AM - 09:30AM', '2022-05-01 11:58:30'),
(168, 'Aula prueba 2', 1, '2022-05-10', 'DAM 1', 'Charla', '08:30AM - 09:30AM', '2022-05-01 12:32:47'),
(169, 'Aula 100', 1, '2022-05-02', 'DAM 1', 'Examen', '08:30AM - 09:30AM', '2022-05-01 12:36:02'),
(170, 'Aula 100', 1, '2022-05-02', 'DAM 1', 'examen', '09:30AM - 10:30AM', '2022-05-01 15:44:56'),
(171, 'Aula 100', 1, '2022-05-05', 'DAM 1', 'Examen', '10:30AM - 11:30AM', '2022-05-01 16:44:22'),
(172, 'Aula 100', 1, '2022-05-03', 'DAM 1', 'Examen', '10:30AM - 11:30AM', '2022-05-01 17:12:22'),
(173, 'Aula 100', 1, '2022-05-04', 'DAM 1', 'Charla', '08:30AM - 09:30AM', '2022-05-01 22:04:12'),
(174, 'Aula 700', 1, '2022-05-06', 'DAM 1', 'Charla', '13:30PM - 14:30PM', '2022-05-01 22:09:50'),
(175, 'Aula 100', 1, '2022-05-06', 'DAM 1', 'Charla', '08:30AM - 09:30AM', '2022-05-01 22:47:02'),
(176, 'Aula 100', 1, '2022-05-03', 'DAM 1', 'Charla', '08:30AM - 09:30AM', '2022-05-01 22:47:07'),
(177, 'Aula 100', 5, '2022-05-02', 'DAM 1', 'Charla', '10:30AM - 11:30AM', '2022-05-01 23:37:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `crud_roles` tinyint(1) NOT NULL,
  `crud_usuarios` tinyint(1) NOT NULL,
  `crud_aulas` tinyint(1) NOT NULL,
  `crud_reservas` tinyint(1) NOT NULL,
  `crud_grupos` tinyint(1) NOT NULL,
  `actualizar_bbdd` tinyint(1) NOT NULL,
  `crud_festivos` tinyint(1) NOT NULL,
  `estadisticas` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `crud_roles`, `crud_usuarios`, `crud_aulas`, `crud_reservas`, `crud_grupos`, `actualizar_bbdd`, `crud_festivos`, `estadisticas`) VALUES
(1, 'adminstrador', 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'profesor', 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `primerApellido` varchar(50) NOT NULL,
  `segundoApellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `puesto` varchar(250) NOT NULL,
  `contra` varchar(150) NOT NULL,
  `confirmacion` tinyint(1) NOT NULL,
  `rol` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `primerApellido`, `segundoApellido`, `usuario`, `puesto`, `contra`, `confirmacion`, `rol`) VALUES
(1, 'Maria', 'maria@gmail.com', 'García', 'Perez', 'maria123', 'Administradora', '$2y$10$c2SFZOk086XjKe.XkDKPOOwXfnaFpqNaQ9Et6iAVmJHP2PNLDrWMK', 1, 1),
(5, 'Ana', 'aamaagu372@ciudadescolarfp.es', 'Amate', 'Aguado', 'aamaagu372', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', '$2y$10$whfec1hkABlYjI8LjU87keRta8vs3e1n5rvb.ZuRsftLVoW5zSmaC', 1, 2),
(6, 'Isabel', 'iarvmoy077@ciudadescolarfp.es', 'Arévalo', 'Moyano', 'iarvmoy077', 'Música-Profesores de Enseñanza Secundaria\r\n', 'iarvmoy077', 0, 2),
(7, 'Patricia', 'parrcor997@ciudadescolarfp.es', 'Arroyo', 'Cortázar', 'parrcor997', 'Procesos de Producción Agraria-Profesores de Enseñanza Secundaria\r\n', 'parrcor997', 0, 2),
(8, 'Nuria', 'nbalrin331@ciudadescolarfp.es', 'Ballesteros', 'Rincón', 'nbalrin331', 'Orientación Educativa-Profesores de Enseñanza Secundaria\r\n', 'nbalrin331', 0, 2),
(9, 'Milena', 'mbarram438@ciudadescolarfp.es', 'Barrera', 'Ramírez', 'mbarram438', 'Organización y Gestión Comercial-Profesores de Enseñanza Secundaria\r\n', 'mbarram438', 0, 2),
(10, 'M.Esther de la', 'mbeldez760@ciudadescolarfp.es', 'Beldad', 'Diez', 'mbeldez760', 'Formación y Orientación Laboral-Profesores de Enseñanza Secundaria\r\n', 'mbeldez760', 0, 2),
(11, 'Almudena', 'acabdel884@ciudadescolarfp.es', 'Caballero', 'Delgado', 'acabdel884', 'Inglés-Profesores de Enseñanza Secundaria\r\n', 'acabdel884', 0, 2),
(12, 'Susana', 'scabcal501@ciudadescolarfp.es', 'Cabellos', 'Caldera', 'scabcal501', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', 'scabcal501', 0, 2),
(13, 'Nuria de la', 'ncmaand151@ciudadescolarfp.es', 'Cámara', 'Andrés', 'ncmaand151', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', 'ncmaand151', 0, 2),
(14, 'Luis Miguel', 'lcanlpe856@ciudadescolarfp.es', 'Canorea', 'López', 'lcanlpe856', 'Administración de Empresas-Profesores de Enseñanza Secundaria\r\n', 'lcanlpe856', 0, 2),
(15, 'Pedro', 'pcarpir328@ciudadescolarfp.es', 'Carcajona', 'Piris', 'pcarpir328', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', 'pcarpir328', 0, 2),
(16, 'Francisco Javi', 'fcasrom118@ciudadescolarfp.es', 'Casco', 'Romero', 'fcasrom118', 'Procesos Comerciales-Profesores Técnicos de Formación Profesional\r\n', 'fcasrom118', 0, 2),
(17, 'Cristina', 'cchacac104@ciudadescolarfp.es', 'Chamizo', 'Cáceres', 'cchacac104', 'Sistemas y Aplicaciones Informáticas-Profesores Técnicos de Formación Profesio\r\n', 'cchacac104', 0, 2),
(18, 'Mikel', 'mconrey936@ciudadescolarfp.es', 'Conde', 'Reyes', 'mconrey936', 'Procedimientos Sanitarios y Asistenciales-Profesores Técnicos de Formación Pro\r\n', 'mconrey936', 0, 2),
(19, 'Alicia', 'acotsei466@ciudadescolarfp.es', 'Cotarelo', 'Seijas', 'acotsei466', 'Inglés-Profesores de Enseñanza Secundaria\r\n', 'acotsei466', 0, 2),
(20, 'M.Mar', 'mcrejim994@ciudadescolarfp.es', 'Crespo', 'Jiménez', 'mcrejim994', 'Servicios a la Comunidad-Profesores Técnicos de Formación Profesional\r\n', 'mcrejim994', 0, 2),
(21, 'Francisco', 'fcremol415@ciudadescolarfp.es', 'Crespo', 'Molero', 'fcremol415', 'Servicios a la Comunidad-Profesores Técnicos de Formación Profesional\r\n', 'fcremol415', 0, 2),
(22, 'Concepción', 'cdelmar231@ciudadescolarfp.es', 'Delgado', 'Martín', 'cdelmar231', 'Servicios a la Comunidad-Profesores Técnicos de Formación Profesional\r\n', 'cdelmar231', 0, 2),
(23, 'Héctor C.', 'hferbar894@ciudadescolarfp.es', 'Fernández', 'Bardal', 'hferbar894', 'Informática-Profesores de Enseñanza Secundaria\r\n', 'hferbar894', 0, 2),
(24, 'Ana Irene', 'afuecas252@ciudadescolarfp.es', 'Fuentes del', 'Castillo', 'afuecas252', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'afuecas252', 0, 2),
(25, 'Fatima', 'fgamtap556@ciudadescolarfp.es', 'Gamero', 'Tapias', 'fgamtap556', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', 'fgamtap556', 0, 2),
(26, 'Soraya', 'sgarnog360@ciudadescolarfp.es', 'García', 'Nogales', 'sgarnog360', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'sgarnog360', 0, 2),
(27, 'Alfonso Jose', 'agarrod353@ciudadescolarfp.es', 'García', 'Rodríguez', 'agarrod353', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'agarrod353', 0, 2),
(28, 'Santiago', 'sgartej868@ciudadescolarfp.es', 'García', 'Tejero', 'sgartej868', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'sgartej868', 0, 2),
(29, 'Alejandro', 'agimelo202@ciudadescolarfp.es', 'Gimenez', 'Elorriaga', 'agimelo202', 'Administración de Empresas-Profesores de Enseñanza Secundaria\r\n', 'agimelo202', 0, 2),
(30, 'Raquel', 'rgmelpe128@ciudadescolarfp.es', 'Gómez', 'López', 'rgmelpe128', 'Servicios a la Comunidad-Profesores Técnicos de Formación Profesional\r\n', 'rgmelpe128', 0, 2),
(31, 'M.Luisa', 'mgonher314@ciudadescolarfp.es', 'González', 'Herranz', 'mgonher314', 'Organización y Gestión Comercial-Profesores de Enseñanza Secundaria\r\n', 'mgonher314', 0, 2),
(32, 'Maria Victoria', 'mgonlop497f@ciudadescolarfp.es', 'González', 'López', 'mgonlop497f', 'Informática-Profesores de Enseñanza Secundaria\r\n', 'mgonlop497f', 0, 2),
(33, 'Ignacio', 'igonsnc799@ciudadescolarfp.es', 'González', 'Sánchez', 'igonsnc799', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'igonsnc799', 0, 2),
(34, 'Oscar Javier', 'oguerol016@ciudadescolarfp.es', 'Guerrero', 'Roldán', 'oguerol016', 'Sistemas y Aplicaciones Informáticas-Profesores Técnicos de Formación Profesio\r\n', 'oguerol016', 0, 2),
(35, 'Maria Cristina', 'mhermar808@ciudadescolarfp.es', 'Hernández', 'Martínez', 'mhermar808', 'Procesos Comerciales-Profesores Técnicos de Formación Profesional\r\n', 'mhermar808', 0, 2),
(36, 'Víctor', 'vherjer601@ciudadescolarfp.es', 'Hernando', 'Jerez', 'vherjer601', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'vherjer601', 0, 2),
(37, 'Javier', 'jherrui543@ciudadescolarfp.es', 'Herrero', 'Ruiz', 'jherrui543', 'Inglés-Profesores de Enseñanza Secundaria\r\n', 'jherrui543', 0, 2),
(38, 'M. Belén', 'mibemar978@ciudadescolarfp.es', 'Ibáñez', 'Marcos', 'mibemar978', 'Administración de Empresas-Profesores de Enseñanza Secundaria\r\n', 'mibemar978', 0, 2),
(39, 'Elena', 'ejarcaa077@ciudadescolarfp.es', 'Jara', 'Cañas', 'ejarcaa077', 'Operaciones y Equipos de Producción Agraria-Profesores Técnicos de Formación P\r\n', 'ejarcaa077', 0, 2),
(40, 'María Carmen', 'mjimblz561@ciudadescolarfp.es', 'Jiménez', 'Blázquez', 'mjimblz561', 'Sistemas y Aplicaciones Informáticas-Profesores Técnicos de Formación Profesio\r\n', 'mjimblz561', 0, 2),
(41, 'Iván', 'ijimfom417@ciudadescolarfp.es', 'Jiménez', 'Fombona', 'ijimfom417', 'Informática-Profesores de Enseñanza Secundaria\r\n', 'ijimfom417', 0, 2),
(42, 'Prado', 'plencar881@ciudadescolarfp.es', 'Lens', 'Carretero', 'plencar881', 'Formación y Orientación Laboral-Profesores de Enseñanza Secundaria\r\n', 'plencar881', 0, 2),
(43, 'Cecilia', 'clopgar691@ciudadescolarfp.es', 'López', 'García', 'clopgar691', 'Organización y Gestión Comercial-Profesores de Enseñanza Secundaria\r\n', 'clopgar691', 0, 2),
(44, 'Julio Javier', 'jlopgim830@ciudadescolarfp.es', 'López', 'Gimenez', 'jlopgim830', 'Informática-Profesores de Enseñanza Secundaria\r\n', 'jlopgim830', 0, 2),
(45, 'Miguel A.', 'mlortom761@ciudadescolarfp.es', 'Lorenzo', 'Tomillo', 'mlortom761', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'mlortom761', 0, 2),
(46, 'Vanesa', 'vlunser952@ciudadescolarfp.es', 'Luna', 'Serrano', 'vlunser952', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', 'vlunser952', 0, 2),
(47, 'Susana', 'smadbar721@ciudadescolarfp.es', 'Madrigal', 'Barchino', 'smadbar721', 'Organización y Gestión Comercial-Profesores de Enseñanza Secundaria\r\n', 'smadbar721', 0, 2),
(48, 'Carmen', 'cmaaari645@ciudadescolarfp.es', 'Mañas', 'Ariza', 'cmaaari645', 'Procesos Comerciales-Profesores Técnicos de Formación Profesional\r\n', 'cmaaari645', 0, 2),
(49, 'Cristina', 'cmarsaz757@ciudadescolarfp.es', 'Mariscal del', 'Saz-Orozc', 'cmarsaz757', 'Procedimientos Sanitarios y Asistenciales-Profesores Técnicos de Formación Pro\r\n', 'cmarsaz757', 0, 2),
(50, 'Sonsoles', 'smarenc699@ciudadescolarfp.es', 'Martín', 'Encinar', 'smarenc699', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'smarenc699', 0, 2),
(51, 'Soledad', 'smarvel054@ciudadescolarfp.es', 'Martín', 'Velasco', 'smarvel054', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', 'smarvel054', 0, 2),
(52, 'Elvira', 'emndsan108@ciudadescolarfp.es', 'Méndez', 'Santamarina', 'emndsan108', 'Procesos de Gestión Administrativa-Profesores Técnicos de Formación Profesiona\r\n', 'emndsan108', 0, 2),
(53, 'Natalia', 'nmerjim484@ciudadescolarfp.es', 'Merino', 'Jiménez', 'nmerjim484', 'Organización y Gestión Comercial-Profesores de Enseñanza Secundaria\r\n', 'nmerjim484', 0, 2),
(54, 'Eva', 'emoncan411@ciudadescolarfp.es', 'Montero', 'Cañibano', 'emoncan411', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'emoncan411', 0, 2),
(55, 'M.Esperanza', 'mmorrui852@ciudadescolarfp.es', 'Mora', 'Ruiz', 'mmorrui852', 'Organización y Gestión Comercial-Profesores de Enseñanza Secundaria\r\n', 'mmorrui852', 0, 2),
(56, 'María Carmen', 'mniebon124@ciudadescolarfp.es', 'Nieto', 'Bonal', 'mniebon124', 'Formación y Orientación Laboral-Profesores de Enseñanza Secundaria\r\n', 'mniebon124', 0, 2),
(57, 'Susana', 'sortgar378@ciudadescolarfp.es', 'Ortiz', 'García', 'sortgar378', 'Procedimientos Sanitarios y Asistenciales-Profesores Técnicos de Formación Pro\r\n', 'sortgar378', 0, 2),
(58, 'Jose Antonio', 'jperfue784@ciudadescolarfp.es', 'Pérez', 'Fuentes', 'jperfue784', 'Informática-Profesores de Enseñanza Secundaria\r\n', 'jperfue784', 0, 2),
(59, 'Raul', 'rpulpin135@ciudadescolarfp.es', 'Pulido', 'Piñero', 'rpulpin135', 'Formación y Orientación Laboral-Profesores de Enseñanza Secundaria\r\n', 'rpulpin135', 0, 2),
(60, 'Marta', 'mremva127@ciudadescolarfp.es', 'Remiro', 'Va', 'mremva127', 'Servicios a la Comunidad-Profesores Técnicos de Formación Profesional\r\n', 'mremva127', 0, 2),
(61, 'M.Teresa', 'mrevriv003@ciudadescolarfp.es', 'Revilla', 'Rivas', 'mrevriv003', 'Procesos Comerciales-Profesores Técnicos de Formación Profesional\r\n', 'mrevriv003', 0, 2),
(62, 'Mercedes', 'mrodara771@ciudadescolarfp.es', 'Rodríguez', 'Araque', 'mrodara771', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'mrodara771', 0, 2),
(63, 'M.Mar', 'mrodsnc495@ciudadescolarfp.es', 'Rodríguez', 'Sánchez', 'mrodsnc495', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', 'mrodsnc495', 0, 2),
(64, 'Elvira', 'erodvil911@ciudadescolarfp.es', 'Rodríguez', 'Villar', 'erodvil911', 'Educación Física-Profesores de Enseñanza Secundaria\r\n', 'erodvil911', 0, 2),
(65, 'Laura', 'lsanser155@ciudadescolarfp.es', 'Sanabria', 'Serrano', 'lsanser155', 'Inglés-Profesores de Enseñanza Secundaria\r\n', 'lsanser155', 0, 2),
(66, 'Salvador', 'ssanfer194@ciudadescolarfp.es', 'Sanchez', 'Fernández', 'ssanfer194', 'Informática-Profesores de Enseñanza Secundaria\r\n', 'ssanfer194', 0, 2),
(67, 'Miguel Ángel', 'msnclpe421@ciudadescolarfp.es', 'Sánchez', 'López', 'msnclpe421', 'Formación y Orientación Laboral-Profesores de Enseñanza Secundaria\r\n', 'msnclpe421', 0, 2),
(68, 'Maria del Mar', 'msanyug896@ciudadescolarfp.es', 'Santos', 'Yugueros', 'msanyug896', 'Procesos de Gestión Administrativa-Profesores Técnicos de Formación Profesiona\r\n', 'msanyug896', 0, 2),
(69, 'Marta', 'msanpol764@ciudadescolarfp.es', 'Sanz', 'Polo', 'msanpol764', 'Organización y Gestión Comercial-Profesores de Enseñanza Secundaria\r\n', 'msanpol764', 0, 2),
(70, 'Ana', 'asaymor156@ciudadescolarfp.es', 'Sayalero', 'Morón', 'asaymor156', 'Procesos Comerciales-Profesores Técnicos de Formación Profesional\r\n', 'asaymor156', 0, 2),
(71, 'Maria', 'mtertor596@ciudadescolarfp.es', 'Terrón', 'Torrado', 'mtertor596', 'Procesos de Gestión Administrativa-Profesores Técnicos de Formación Profesiona\r\n', 'mtertor596', 0, 2),
(72, 'Rebeca del', 'rvalsnc351@ciudadescolarfp.es', 'Val', 'Sánchez', 'rvalsnc351', 'Intervención Sociocomunitaria-Profesores de Enseñanza Secundaria\r\n', 'rvalsnc351', 0, 2),
(73, 'Ana Belén', 'avazher138@ciudadescolarfp.es', 'Vázquez', 'Hernando', 'avazher138', 'Servicios a la Comunidad-Profesores Técnicos de Formación Profesional\r\n', 'avazher138', 0, 2),
(74, 'Maria Nieves', 'nzamgom087@ciudadescolarfp.es', 'Zamora', 'Gómez', 'nzamgom087', 'Procesos Comerciales-Profesores Técnicos de Formación Profesional', 'nzamgom087', 0, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `festivos`
--
ALTER TABLE `festivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reserva_aula` (`idAula`),
  ADD KEY `id_reserva_usuario` (`idUsuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_id_rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `festivos`
--
ALTER TABLE `festivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `id_reserva_aula` FOREIGN KEY (`idAula`) REFERENCES `aulas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_reserva_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;
