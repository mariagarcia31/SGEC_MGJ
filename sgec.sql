-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2022 a las 23:43:39
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.4

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
(1, 'Maria', 'mariagarcia.daw@ciudadescolarfp.es', 'García', 'Valero', 'Maria', 'Informática', '$2y$10$eF7yZrthW5tC4DmtdRw.0ePcWKAJiDiaC64.2QNXfjOrQatuU.lZ6', 1, 1),
(2, 'Jossue', 'anthonyjossuebuenano.daw@ciudadescolarfp.es', 'buenaño', 'peña', 'josu', 'Informático', '$2y$10$SpZrXU.wXTNfQaGypHPCU.rEkDN5bYDEMisAAyJUQ2cG4DBUlFXtG', 1, 1),
(3, 'Gerardo', 'gerardopimentel.daw@ciudadescolarfp.es', 'Pimentel', 'Serrano', 'gerardo', 'Informático', '$2y$10$JJ/4SHZgPgbiDiNZamaVmOMYcC5QojBN4Uh7xJutmBrYJDgMZOD0S', 1, 1),
(4, 'Vicky', 'victoria.gonzalez@ciudadescolarfp.es', 'gonzález', 'gonzález', 'vicky', 'Profesora', '1234', 0, 1);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
