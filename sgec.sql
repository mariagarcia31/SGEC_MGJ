-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2022 a las 13:15:00
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
	select id into _id from usuarios where (correo = _correo or usuario = _correo);
    
	update usuarios
		set contra=_contra, correo=_correo ,confirmacion=1
		where id=_id;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `ValidarUsuario` (`_correo` VARCHAR(150), `_contra` VARCHAR(150)) RETURNS INT(11)  BEGIN
	DECLARE aux int default null;

	SELECT count(*) INTO aux FROM usuarios WHERE (correo = _correo or usuario = _correo) and contra=_contra;
    
IF aux = 0 THEN
        return 0; -- NO EXISTE ESE USUARIO
END IF;
return 1; -- SÍ EXISTE ESE USUARIO

 END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `verificarContra` (`_correo` VARCHAR(50)) RETURNS INT(11)  BEGIN
	DECLARE aux int default null;
		select confirmacion into aux from usuarios where (correo = _correo or usuario = _correo);
        
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
('Aula polivalente', 'Al lado de cafetería', 'Pizarra pequeña, ordenador, proyector, altavoces y sillas', 99, 1, 'libs/img/upload/IMG-6104.jpg'),
('El bosque', 'Pabellón 1, planta 2ª', 'Mesa, sillas y sofá', 15, 0, 'libs/img/upload/IMG-6108.jpg'),
('Espacio Erasmus', 'Pabellón 1, planta 2ª', 'Mesas y sillas', 10, 1, 'libs/img/upload/IMG-6093.jpg'),
('Sala de reuniones (112)', 'Pabellón 1, planta 1ª', 'Pizarra digital , mesas y sillas', 16, 1, 'libs/img/upload/IMG-6095.jpg'),
('Sala de reuniones (301)', 'Pabellón 3, planta 2ª', 'Mesas y sillas', 5, 1, 'libs/img/upload/IMG-6102.jpg'),
('Sala de reuniones (311)', 'Pabellón 3, planta 1ª', 'Mesas y sillas', 5, 1, 'libs/img/upload/IMG-6100.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `valor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `valor`) VALUES
(1, 'Máximo de días siguientes para reservar', '14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `puesto` varchar(250) NOT NULL,
  `departamento` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`puesto`, `departamento`) VALUES
('Informático', 'Dpto. Informatica'),
('Intervención Sociocomunitaria', 'Dpto. Administración y finanzas'),
('Procesos de Producción Agraria', 'Dpto. Agrario');

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
(1, 'Semana Santa', '2022-04-04', '2022-04-18');

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
(1, 'DAW 3', 'Dpto. Agrario'),
(2, 'DAM 2', 'Informática'),
(3, 'DAW 1', 'Informática'),
(4, 'DAM 1', 'Informática'),
(5, 'DAW 5', 'Infornática'),
(6, 'DAW 6', 'Informática'),
(7, 'DAM 7', 'Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
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
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `idAula`, `idUsuario`, `fecha`, `grupo`, `motivo`, `hora`, `fecha_creacion`) VALUES
(149, 'Aula Polivalente', 1, '2022-05-03', 'DAM 1', 'Charla', '10:30AM - 11:30AM', '2022-04-29 21:26:44'),
(300, 'aula 7', 75, '2022-05-02', 'DAW', 'charla', '11:30 - 12:30 am', '2022-05-05 14:20:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ip`
--

CREATE TABLE `ip` (
  `address` char(16) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(316, 'Aula polivalente', 1, '2022-05-24', 'DAM 1', 'examem', '10:30AM - 11:30AM', '2022-05-18 11:33:55'),
(317, 'Espacio Erasmus', 1, '2022-05-24', 'DAM 1', 'charla', '10:30AM - 11:30AM', '2022-05-24 14:37:41'),
(318, 'Aula polivalente', 1, '2022-06-01', 'DAM 1', 'examem', '09:30AM - 10:30AM', '2022-05-25 13:03:48');

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
  `crud_festivos` tinyint(1) NOT NULL,
  `estadisticas` tinyint(1) NOT NULL,
  `crud_configuracion` tinyint(1) NOT NULL,
  `crud_departamentos` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `crud_roles`, `crud_usuarios`, `crud_aulas`, `crud_reservas`, `crud_grupos`, `crud_festivos`, `estadisticas`, `crud_configuracion`, `crud_departamentos`) VALUES
(1, 'super-admin', 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Profesor', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 'Gestor', 0, 1, 1, 1, 1, 1, 1, 1, 0);

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
(1, 'Maria', 'mariagarcia.daw@ciudadescolarfp.es', 'García', 'Valero', 'Maria', 'Procesos de Producción Agrariaaa', '$2y$10$8RheuFJBBw8cVZuN6p.CK.wOXXa1ME.StjIa3TND/nLZlRykM/WR2', 1, 1),
(2, 'Jossue', 'anthonyjossuebuenano.daw@ciudadescolarfp.es', 'buenaño', 'peña', 'josu', 'Informático', '$2y$10$SpZrXU.wXTNfQaGypHPCU.rEkDN5bYDEMisAAyJUQ2cG4DBUlFXtG', 1, 1),
(3, 'Gerardo', 'gerardopimentel.daw@ciudadescolarfp.es', 'Pimentel', 'Serrano', 'gerardo', 'Informático', '$2y$10$dbURiABwmulO1adHZnaF2uXlN45wtg1KqMGfnRQ0HFAZ3qW4HsWJK', 1, 1),
(81, 'Ana', 'aamaagu372@ciudadescolarfp.es', 'Amate', 'Aguado', 'aamaagu372', 'Intervención Sociocomunitaria', 'aamaagu372', 0, 2),
(82, 'Isabel', 'iarvmoy077@ciudadescolarfp.es', 'Arévalo', 'Moyano', 'iarvmoy077', 'Música', 'iarvmoy077', 0, 2),
(83, 'Patricia', 'parrcor997@ciudadescolarfp.es', 'Arroyo', 'Cortázar', 'parrcor997', 'Procesos de Producción Agraria', 'parrcor997', 0, 2),
(84, 'Nuria', 'nbalrin331@ciudadescolarfp.es', 'Ballesteros', 'Rincón', 'nbalrin331', 'Orientación Educativa', 'nbalrin331', 0, 2),
(85, 'Milena', 'mbarram438@ciudadescolarfp.es', 'Barrera', 'Ramírez', 'mbarram438', 'Organización y Gestión Comercial', 'mbarram438', 0, 2),
(86, 'M.Esther de la', 'mbeldez760@ciudadescolarfp.es', 'Beldad', 'Diez', 'mbeldez760', 'Formación y Orientación Laboral', 'mbeldez760', 0, 2),
(87, 'Almudena', 'acabdel884@ciudadescolarfp.es', 'Caballero', 'Delgado', 'acabdel884', 'Inglés', 'acabdel884', 0, 2),
(88, 'Susana', 'scabcal501@ciudadescolarfp.es', 'Cabellos', 'Caldera', 'scabcal501', 'Intervención Sociocomunitaria', 'scabcal501', 0, 2),
(89, 'Nuria de la', 'ncmaand151@ciudadescolarfp.es', 'Cámara', 'Andrés', 'ncmaand151', 'Intervención Sociocomunitaria', 'ncmaand151', 0, 2),
(90, 'Luis Miguel', 'lcanlpe856@ciudadescolarfp.es', 'Canorea', 'López', 'lcanlpe856', 'Administración de Empresas', 'lcanlpe856', 0, 2),
(91, 'Pedro', 'pcarpir328@ciudadescolarfp.es', 'Carcajona', 'Piris', 'pcarpir328', 'Intervención Sociocomunitaria', 'pcarpir328', 0, 2),
(92, 'Francisco Javi', 'fcasrom118@ciudadescolarfp.es', 'Casco', 'Romero', 'fcasrom118', 'Procesos Comerciales', 'fcasrom118', 0, 2),
(93, 'Cristina', 'cchacac104@ciudadescolarfp.es', 'Chamizo', 'Cáceres', 'cchacac104', 'Sistemas y Aplicaciones Informáticas', 'cchacac104', 0, 2),
(94, 'Mikel', 'mconrey936@ciudadescolarfp.es', 'Conde', 'Reyes', 'mconrey936', 'Procedimientos Sanitarios y Asistenciales', 'mconrey936', 0, 2),
(95, 'Alicia', 'acotsei466@ciudadescolarfp.es', 'Cotarelo', 'Seijas', 'acotsei466', 'Inglés', 'acotsei466', 0, 2),
(96, 'M.Mar', 'mcrejim994@ciudadescolarfp.es', 'Crespo', 'Jiménez', 'mcrejim994', 'Servicios a la Comunidad', 'mcrejim994', 0, 2),
(97, 'Francisco', 'fcremol415@ciudadescolarfp.es', 'Crespo', 'Molero', 'fcremol415', 'Servicios a la Comunidad', 'fcremol415', 0, 2),
(98, 'Concepción', 'cdelmar231@ciudadescolarfp.es', 'Delgado', 'Martín', 'cdelmar231', 'Servicios a la Comunidad', 'cdelmar231', 0, 2),
(99, 'Héctor C.', 'hferbar894@ciudadescolarfp.es', 'Fernández', 'Bardal', 'hferbar894', 'Informática', 'hferbar894', 0, 2),
(100, 'Ana Irene', 'afuecas252@ciudadescolarfp.es', 'Fuentes del', 'Castillo', 'afuecas252', 'Educación Física', 'afuecas252', 0, 2),
(101, 'Fatima', 'fgamtap556@ciudadescolarfp.es', 'Gamero', 'Tapias', 'fgamtap556', 'Intervención Sociocomunitaria', 'fgamtap556', 0, 2),
(102, 'Soraya', 'sgarnog360@ciudadescolarfp.es', 'García', 'Nogales', 'sgarnog360', 'Educación Física', 'sgarnog360', 0, 2),
(103, 'Alfonso Jose', 'agarrod353@ciudadescolarfp.es', 'García', 'Rodríguez', 'agarrod353', 'Educación Física', 'agarrod353', 0, 2),
(104, 'Santiago', 'sgartej868@ciudadescolarfp.es', 'García', 'Tejero', 'sgartej868', 'Educación Física', 'sgartej868', 0, 2),
(105, 'Alejandro', 'agimelo202@ciudadescolarfp.es', 'Gimenez', 'Elorriaga', 'agimelo202', 'Administración de Empresas', 'agimelo202', 0, 2),
(106, 'Raquel', 'rgmelpe128@ciudadescolarfp.es', 'Gómez', 'López', 'rgmelpe128', 'Servicios a la Comunidad', 'rgmelpe128', 0, 2),
(107, 'M.Luisa', 'mgonher314@ciudadescolarfp.es', 'González', 'Herranz', 'mgonher314', 'Organización y Gestión Comercial', 'mgonher314', 0, 2),
(108, 'Maria Victoria', 'mgonlop497f@ciudadescolarfp.es', 'González', 'López', 'mgonlop497f', 'Informática', 'mgonlop497f', 0, 2),
(109, 'Ignacio', 'igonsnc799@ciudadescolarfp.es', 'González', 'Sánchez', 'igonsnc799', 'Educación Física', 'igonsnc799', 0, 2),
(110, 'Oscar Javier', 'oguerol016@ciudadescolarfp.es', 'Guerrero', 'Roldán', 'oguerol016', 'Sistemas y Aplicaciones Informáticas', 'oguerol016', 0, 2),
(111, 'Maria Cristina', 'mhermar808@ciudadescolarfp.es', 'Hernández', 'Martínez', 'mhermar808', 'Procesos Comerciales', 'mhermar808', 0, 2),
(112, 'Víctor', 'vherjer601@ciudadescolarfp.es', 'Hernando', 'Jerez', 'vherjer601', 'Educación Física', 'vherjer601', 0, 2),
(113, 'Javier', 'jherrui543@ciudadescolarfp.es', 'Herrero', 'Ruiz', 'jherrui543', 'Inglés', 'jherrui543', 0, 2),
(114, 'M. Belén', 'mibemar978@ciudadescolarfp.es', 'Ibáñez', 'Marcos', 'mibemar978', 'Administración de Empresas', 'mibemar978', 0, 2),
(115, 'Elena', 'ejarcaa077@ciudadescolarfp.es', 'Jara', 'Cañas', 'ejarcaa077', 'Operaciones y Equipos de Producción Agraria', 'ejarcaa077', 0, 2),
(116, 'María Carmen', 'mjimblz561@ciudadescolarfp.es', 'Jiménez', 'Blázquez', 'mjimblz561', 'Sistemas y Aplicaciones Informáticas', 'mjimblz561', 0, 2),
(117, 'Iván', 'ijimfom417@ciudadescolarfp.es', 'Jiménez', 'Fombona', 'ijimfom417', 'Informática', 'ijimfom417', 0, 2),
(118, 'Prado', 'plencar881@ciudadescolarfp.es', 'Lens', 'Carretero', 'plencar881', 'Formación y Orientación Laboral', 'plencar881', 0, 2),
(119, 'Cecilia', 'clopgar691@ciudadescolarfp.es', 'López', 'García', 'clopgar691', 'Organización y Gestión Comercial', 'clopgar691', 0, 2),
(120, 'Julio Javier', 'jlopgim830@ciudadescolarfp.es', 'López', 'Gimenez', 'jlopgim830', 'Informática', 'jlopgim830', 0, 2),
(121, 'Miguel A.', 'mlortom761@ciudadescolarfp.es', 'Lorenzo', 'Tomillo', 'mlortom761', 'Educación Física', 'mlortom761', 0, 2),
(122, 'Vanesa', 'vlunser952@ciudadescolarfp.es', 'Luna', 'Serrano', 'vlunser952', 'Intervención Sociocomunitaria', 'vlunser952', 0, 2),
(123, 'Susana', 'smadbar721@ciudadescolarfp.es', 'Madrigal', 'Barchino', 'smadbar721', 'Organización y Gestión Comercial', 'smadbar721', 0, 2),
(124, 'Carmen', 'cmaaari645@ciudadescolarfp.es', 'Mañas', 'Ariza', 'cmaaari645', 'Procesos Comerciales', 'cmaaari645', 0, 2),
(125, 'Cristina', 'cmarsaz757@ciudadescolarfp.es', 'Mariscal del', 'Saz-Orozc', 'cmarsaz757', 'Procedimientos Sanitarios y Asistenciales', 'cmarsaz757', 0, 2),
(126, 'Sonsoles', 'smarenc699@ciudadescolarfp.es', 'Martín', 'Encinar', 'smarenc699', 'Educación Física', 'smarenc699', 0, 2),
(127, 'Soledad', 'smarvel054@ciudadescolarfp.es', 'Martín', 'Velasco', 'smarvel054', 'Intervención Sociocomunitaria', 'smarvel054', 0, 2),
(128, 'Elvira', 'emndsan108@ciudadescolarfp.es', 'Méndez', 'Santamarina', 'emndsan108', 'Procesos de Gestión Administrativa', 'emndsan108', 0, 2),
(129, 'Natalia', 'nmerjim484@ciudadescolarfp.es', 'Merino', 'Jiménez', 'nmerjim484', 'Organización y Gestión Comercial', 'nmerjim484', 0, 2),
(130, 'Eva', 'emoncan411@ciudadescolarfp.es', 'Montero', 'Cañibano', 'emoncan411', 'Educación Física', 'emoncan411', 0, 2),
(131, 'M.Esperanza', 'mmorrui852@ciudadescolarfp.es', 'Mora', 'Ruiz', 'mmorrui852', 'Organización y Gestión Comercial', 'mmorrui852', 0, 2),
(132, 'María Carmen', 'mniebon124@ciudadescolarfp.es', 'Nieto', 'Bonal', 'mniebon124', 'Formación y Orientación Laboral', 'mniebon124', 0, 2),
(133, 'Susana', 'sortgar378@ciudadescolarfp.es', 'Ortiz', 'García', 'sortgar378', 'Procedimientos Sanitarios y Asistenciales', 'sortgar378', 0, 2),
(134, 'Jose Antonio', 'jperfue784@ciudadescolarfp.es', 'Pérez', 'Fuentes', 'jperfue784', 'Informática', 'jperfue784', 0, 2),
(135, 'Raul', 'rpulpin135@ciudadescolarfp.es', 'Pulido', 'Piñero', 'rpulpin135', 'Formación y Orientación Laboral', 'rpulpin135', 0, 2),
(136, 'Marta', 'mremva127@ciudadescolarfp.es', 'Remiro', 'Va', 'mremva127', 'Servicios a la Comunidad', 'mremva127', 0, 2),
(137, 'M.Teresa', 'mrevriv003@ciudadescolarfp.es', 'Revilla', 'Rivas', 'mrevriv003', 'Procesos Comerciales', 'mrevriv003', 0, 2),
(138, 'Mercedes', 'mrodara771@ciudadescolarfp.es', 'Rodríguez', 'Araque', 'mrodara771', 'Educación Física', 'mrodara771', 0, 2),
(139, 'M.Mar', 'mrodsnc495@ciudadescolarfp.es', 'Rodríguez', 'Sánchez', 'mrodsnc495', 'Intervención Sociocomunitaria', 'mrodsnc495', 0, 2),
(140, 'Elvira', 'erodvil911@ciudadescolarfp.es', 'Rodríguez', 'Villar', 'erodvil911', 'Educación Física', 'erodvil911', 0, 2),
(141, 'Laura', 'lsanser155@ciudadescolarfp.es', 'Sanabria', 'Serrano', 'lsanser155', 'Inglés', 'lsanser155', 0, 2),
(142, 'Salvador', 'ssanfer194@ciudadescolarfp.es', 'Sanchez', 'Fernández', 'ssanfer194', 'Informática', 'ssanfer194', 0, 2),
(143, 'Miguel Ángel', 'msnclpe421@ciudadescolarfp.es', 'Sánchez', 'López', 'msnclpe421', 'Formación y Orientación Laboral', 'msnclpe421', 0, 2),
(144, 'Maria del Mar', 'msanyug896@ciudadescolarfp.es', 'Santos', 'Yugueros', 'msanyug896', 'Procesos de Gestión Administrativa', 'msanyug896', 0, 2),
(145, 'Marta', 'msanpol764@ciudadescolarfp.es', 'Sanz', 'Polo', 'msanpol764', 'Organización y Gestión Comercial', 'msanpol764', 0, 2),
(146, 'Ana', 'asaymor156@ciudadescolarfp.es', 'Sayalero', 'Morón', 'asaymor156', 'Procesos Comerciales', 'asaymor156', 0, 2),
(147, 'Maria', 'mtertor596@ciudadescolarfp.es', 'Terrón', 'Torrado', 'mtertor596', 'Procesos de Gestión Administrativa', 'mtertor596', 0, 2),
(148, 'Rebeca del', 'rvalsnc351@ciudadescolarfp.es', 'Val', 'Sánchez', 'rvalsnc351', 'Intervención Sociocomunitaria', 'rvalsnc351', 0, 2),
(149, 'Ana Belén', 'avazher138@ciudadescolarfp.es', 'Vázquez', 'Hernando', 'avazher138', 'Servicios a la Comunidad', 'avazher138', 0, 2),
(150, 'Maria Nieves', 'nzamgom087@ciudadescolarfp.es', 'Zamora', 'Gómez', 'nzamgom087', 'Procesos Comerciales', 'nzamgom087', 0, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`departamento`),
  ADD KEY `puesto` (`puesto`);

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
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `festivos`
--
ALTER TABLE `festivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `id_reserva_aula` FOREIGN KEY (`idAula`) REFERENCES `aulas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_reserva_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `almacenamiento` ON SCHEDULE EVERY 1 DAY STARTS '2022-05-05 16:24:53' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
INSERT INTO `historial` (`id`, `idAula`, `idUsuario`, `fecha`, `grupo`,`motivo`, `hora`, `fecha_creacion`)
  SELECT `id`, `idAula`, `idUsuario`, `fecha`, `grupo`,`motivo`, `hora`, `fecha_creacion`
  FROM `reservas` 
  WHERE `fecha` <  CURDATE();
  
  DELETE FROM `reservas` WHERE `fecha` < CURDATE();
  
  END$$

DELIMITER ;
COMMIT;
