-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 10.200.10.225
-- Tiempo de generación: 27-05-2022 a las 23:05:22
-- Versión del servidor: 10.5.16-MariaDB-1:10.5.16+maria~stretch-log
-- Versión de PHP: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `sgec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `primerApellido` varchar(50) NOT NULL,
  `segundoApellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `departamento` varchar(250) NOT NULL,
  `contra` varchar(150) NOT NULL,
  `confirmacion` tinyint(1) NOT NULL,
  `rol` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `primerApellido`, `segundoApellido`, `usuario`, `departamento`, `contra`, `confirmacion`, `rol`) VALUES
(1, 'Maria', 'mariagarcia.daw@ciudadescolarfp.es', 'García', 'Valero', 'Maria', 'Dpto. Informatica', '1234', 1, 1),
(501, 'Ana', NULL, 'Amate', 'Aguado', 'aamaagu372', 'Dpto. Fol', 'aamaagu372', 0, 2),
(502, 'Isabel', NULL, 'Arévalo', 'Moyano', 'iarvmoy077', 'Dpto. Actividades Extraescolares', 'iarvmoy077', 0, 2),
(503, 'Patricia', NULL, 'Arroyo', 'Cortázar', 'parrcor997', 'Dpto. Agrario', 'parrcor997', 0, 2),
(504, 'Nuria', NULL, 'Ballesteros', 'Rincón', 'nbalrin331', 'Sin departamento asignado', 'nbalrin331', 0, 2),
(505, 'Milena', NULL, 'Barrera', 'Ramírez', 'mbarram438', 'Dpto. Administración y Gestión', 'mbarram438', 0, 2),
(506, 'M.Esther de la', NULL, 'Beldad', 'Diez', 'mbeldez760', 'Dpto. Fol', 'mbeldez760', 0, 2),
(507, 'Almudena', NULL, 'Caballero', 'Delgado', 'acabdel884', 'Dpto. Inglés', 'acabdel884', 0, 2),
(508, 'Susana', NULL, 'Cabellos', 'Caldera', 'scabcal501', 'Dpto. Fol', 'scabcal501', 0, 2),
(509, 'Nuria de la', NULL, 'Cámara', 'Andrés', 'ncmaand151', 'Dpto. Fol', 'ncmaand151', 0, 2),
(510, 'Luis Miguel', NULL, 'Canorea', 'López', 'lcanlpe856', 'Sin departamento asignado', 'lcanlpe856', 0, 2),
(511, 'Pedro', NULL, 'Carcajona', 'Piris', 'pcarpir328', 'Dpto. Fol', 'pcarpir328', 0, 2),
(512, 'Francisco Javi', NULL, 'Casco', 'Romero', 'fcasrom118', 'Dpto. Comercio y Marketing', 'fcasrom118', 0, 2),
(513, 'Cristina', NULL, 'Chamizo', 'Cáceres', 'cchacac104', 'Dpto. Informatica', 'cchacac104', 0, 2),
(514, 'Mikel', NULL, 'Conde', 'Reyes', 'mconrey936', 'Dpto. Servicios Culturales y a la Comunidad', 'mconrey936', 0, 2),
(515, 'Alicia', NULL, 'Cotarelo', 'Seijas', 'acotsei466', 'Dpto. Inglés', 'acotsei466', 0, 2),
(516, 'M.Mar', NULL, 'Crespo', 'Jiménez', 'mcrejim994', 'Dpto. Servicios Culturales y a la Comunidad', 'mcrejim994', 0, 2),
(517, 'Francisco', NULL, 'Crespo', 'Molero', 'fcremol415', 'Dpto. Servicios Culturales y a la Comunidad', 'fcremol415', 0, 2),
(518, 'Concepción', NULL, 'Delgado', 'Martín', 'cdelmar231', 'Dpto. Servicios Culturales y a la Comunidad', 'cdelmar231', 0, 2),
(519, 'Héctor C.', NULL, 'Fernández', 'Bardal', 'hferbar894', 'Dpto. Informatica', 'hferbar894', 0, 2),
(520, 'Ana Irene', NULL, 'Fuentes del', 'Castillo', 'afuecas252', 'Dpto. Actividades Físicas', 'afuecas252', 0, 2),
(521, 'Fatima', NULL, 'Gamero', 'Tapias', 'fgamtap556', 'Dpto. Fol', 'fgamtap556', 0, 2),
(522, 'Soraya', NULL, 'García', 'Nogales', 'sgarnog360', 'Dpto. Actividades Físicas', 'sgarnog360', 0, 2),
(523, 'Alfonso Jose', NULL, 'García', 'Rodríguez', 'agarrod353', 'Dpto. Actividades Físicas', 'agarrod353', 0, 2),
(524, 'Santiago', NULL, 'García', 'Tejero', 'sgartej868', 'Dpto. Actividades Físicas', 'sgartej868', 0, 2),
(525, 'Alejandro', NULL, 'Gimenez', 'Elorriaga', 'agimelo202', 'Sin departamento asignado', 'agimelo202', 0, 2),
(526, 'Raquel', NULL, 'Gómez', 'López', 'rgmelpe128', 'Dpto. Servicios Culturales y a la Comunidad', 'rgmelpe128', 0, 2),
(527, 'M.Luisa', NULL, 'González', 'Herranz', 'mgonher314', 'Dpto. Administración y Gestión', 'mgonher314', 0, 2),
(528, 'Maria Victoria', NULL, 'González', 'López', 'mgonlop497f', 'Dpto. Informatica', 'mgonlop497f', 0, 2),
(529, 'Ignacio', NULL, 'González', 'Sánchez', 'igonsnc799', 'Dpto. Actividades Físicas', 'igonsnc799', 0, 2),
(530, 'Oscar Javier', NULL, 'Guerrero', 'Roldán', 'oguerol016', 'Dpto. Informatica', 'oguerol016', 0, 2),
(531, 'Maria Cristina', NULL, 'Hernández', 'Martínez', 'mhermar808', 'Dpto. Comercio y Marketing', 'mhermar808', 0, 2),
(532, 'Víctor', NULL, 'Hernando', 'Jerez', 'vherjer601', 'Dpto. Actividades Físicas', 'vherjer601', 0, 2),
(533, 'Javier', NULL, 'Herrero', 'Ruiz', 'jherrui543', 'Dpto. Inglés', 'jherrui543', 0, 2),
(534, 'M. Belén', NULL, 'Ibáñez', 'Marcos', 'mibemar978', 'Sin departamento asignado', 'mibemar978', 0, 2),
(535, 'Elena', NULL, 'Jara', 'Cañas', 'ejarcaa077', 'Sin departamento asignado', 'ejarcaa077', 0, 2),
(536, 'María Carmen', NULL, 'Jiménez', 'Blázquez', 'mjimblz561', 'Dpto. Informatica', 'mjimblz561', 0, 2),
(537, 'Iván', NULL, 'Jiménez', 'Fombona', 'ijimfom417', 'Dpto. Informatica', 'ijimfom417', 0, 2),
(538, 'Prado', NULL, 'Lens', 'Carretero', 'plencar881', 'Dpto. Fol', 'plencar881', 0, 2),
(539, 'Cecilia', NULL, 'López', 'García', 'clopgar691', 'Dpto. Administración y Gestión', 'clopgar691', 0, 2),
(540, 'Julio Javier', NULL, 'López', 'Gimenez', 'jlopgim830', 'Dpto. Informatica', 'jlopgim830', 0, 2),
(541, 'Miguel A.', NULL, 'Lorenzo', 'Tomillo', 'mlortom761', 'Dpto. Actividades Físicas', 'mlortom761', 0, 2),
(542, 'Vanesa', NULL, 'Luna', 'Serrano', 'vlunser952', 'Dpto. Fol', 'vlunser952', 0, 2),
(543, 'Susana', NULL, 'Madrigal', 'Barchino', 'smadbar721', 'Dpto. Administración y Gestión', 'smadbar721', 0, 2),
(544, 'Carmen', NULL, 'Mañas', 'Ariza', 'cmaaari645', 'Dpto. Comercio y Marketing', 'cmaaari645', 0, 2),
(545, 'Cristina', NULL, 'Mariscal del', 'Saz-Orozc', 'cmarsaz757', 'Dpto. Servicios Culturales y a la Comunidad', 'cmarsaz757', 0, 2),
(546, 'Sonsoles', NULL, 'Martín', 'Encinar', 'smarenc699', 'Dpto. Actividades Físicas', 'smarenc699', 0, 2),
(547, 'Soledad', NULL, 'Martín', 'Velasco', 'smarvel054', 'Dpto. Fol', 'smarvel054', 0, 2),
(548, 'Elvira', NULL, 'Méndez', 'Santamarina', 'emndsan108', 'Dpto. Administración y Gestión', 'emndsan108', 0, 2),
(549, 'Natalia', NULL, 'Merino', 'Jiménez', 'nmerjim484', 'Dpto. Administración y Gestión', 'nmerjim484', 0, 2),
(550, 'Eva', NULL, 'Montero', 'Cañibano', 'emoncan411', 'Dpto. Actividades Físicas', 'emoncan411', 0, 2),
(551, 'M.Esperanza', NULL, 'Mora', 'Ruiz', 'mmorrui852', 'Dpto. Administración y Gestión', 'mmorrui852', 0, 2),
(552, 'María Carmen', NULL, 'Nieto', 'Bonal', 'mniebon124', 'Dpto. Fol', 'mniebon124', 0, 2),
(553, 'Susana', NULL, 'Ortiz', 'García', 'sortgar378', 'Dpto. Servicios Culturales y a la Comunidad', 'sortgar378', 0, 2),
(554, 'Jose Antonio', NULL, 'Pérez', 'Fuentes', 'jperfue784', 'Dpto. Informatica', 'jperfue784', 0, 2),
(555, 'Raul', NULL, 'Pulido', 'Piñero', 'rpulpin135', 'Dpto. Fol', 'rpulpin135', 0, 2),
(556, 'Marta', NULL, 'Remiro', 'Va', 'mremva127', 'Dpto. Servicios Culturales y a la Comunidad', 'mremva127', 0, 2),
(557, 'M.Teresa', NULL, 'Revilla', 'Rivas', 'mrevriv003', 'Dpto. Comercio y Marketing', 'mrevriv003', 0, 2),
(558, 'Mercedes', NULL, 'Rodríguez', 'Araque', 'mrodara771', 'Dpto. Actividades Físicas', 'mrodara771', 0, 2),
(559, 'M.Mar', NULL, 'Rodríguez', 'Sánchez', 'mrodsnc495', 'Dpto. Fol', 'mrodsnc495', 0, 2),
(560, 'Elvira', NULL, 'Rodríguez', 'Villar', 'erodvil911', 'Dpto. Actividades Físicas', 'erodvil911', 0, 2),
(561, 'Laura', NULL, 'Sanabria', 'Serrano', 'lsanser155', 'Dpto. Inglés', 'lsanser155', 0, 2),
(562, 'Salvador', NULL, 'Sanchez', 'Fernández', 'ssanfer194', 'Dpto. Informatica', 'ssanfer194', 0, 2),
(563, 'Miguel Ángel', NULL, 'Sánchez', 'López', 'msnclpe421', 'Dpto. Fol', 'msnclpe421', 0, 2),
(564, 'Maria del Mar', NULL, 'Santos', 'Yugueros', 'msanyug896', 'Dpto. Administración y Gestión', 'msanyug896', 0, 2),
(565, 'Marta', NULL, 'Sanz', 'Polo', 'msanpol764', 'Dpto. Administración y Gestión', 'msanpol764', 0, 2),
(566, 'Ana', NULL, 'Sayalero', 'Morón', 'asaymor156', 'Dpto. Comercio y Marketing', 'asaymor156', 0, 2),
(567, 'Maria', NULL, 'Terrón', 'Torrado', 'mtertor596', 'Dpto. Administración y Gestión', 'mtertor596', 0, 2),
(568, 'Rebeca del', NULL, 'Val', 'Sánchez', 'rvalsnc351', 'Dpto. Fol', 'rvalsnc351', 0, 2),
(569, 'Ana Belén', NULL, 'Vázquez', 'Hernando', 'avazher138', 'Dpto. Servicios Culturales y a la Comunidad', 'avazher138', 0, 2),
(570, 'Maria Nieves', NULL, 'Zamora', 'Gómez', 'nzamgom087', 'Dpto. Comercio y Marketing', 'nzamgom087', 0, 2);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=571;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
