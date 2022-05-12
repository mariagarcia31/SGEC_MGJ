-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2022 a las 10:30:23
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
('Aula polivalente', 'Al lado de cafetería', 'Pizarra pequeña, ordenador, proyector, altavoces y sillas', 100, 1, 'libs/img/upload/IMG-6104.jpg'),
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
(1, 'DAW 2', 'Informática'),
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
  `estadisticas` tinyint(1) NOT NULL,
  `crud_configuracion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `crud_roles`, `crud_usuarios`, `crud_aulas`, `crud_reservas`, `crud_grupos`, `actualizar_bbdd`, `crud_festivos`, `estadisticas`, `crud_configuracion`) VALUES
(1, 'adminstrador', 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Profesor', 0, 0, 0, 0, 0, 0, 0, 1, 0);

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
(1, 'Maria', 'mariagarcia.daw@ciudadescolarfp.es', 'García', 'Valero', 'Maria', 'Informática', '$2y$10$qVF4hrjF2zReZTZkLySa0OhgWVrCg/Wpqj01W6PBrUXGhB5WMk8GO', 1, 1),
(2, 'Jossue', 'anthonyjossuebuenano.daw@ciudadescolarfp.es', 'buenaño', 'peña', 'josu', 'Informático', '$2y$10$SpZrXU.wXTNfQaGypHPCU.rEkDN5bYDEMisAAyJUQ2cG4DBUlFXtG', 1, 1),
(3, 'Gerardo', 'gerardopimentel.daw@ciudadescolarfp.es', 'Pimentel', 'Serrano', 'gerardo', 'Informático', '$2y$10$dbURiABwmulO1adHZnaF2uXlN45wtg1KqMGfnRQ0HFAZ3qW4HsWJK', 1, 1),
(4, 'Vicky', 'victoria.gonzalez@ciudadescolarfp.es', 'gonzález', 'gonzález', 'vicky', 'Profesora', '1234', 0, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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
