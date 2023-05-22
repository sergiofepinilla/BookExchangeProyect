-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2023 a las 17:00:30
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bookexchange`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueados`
--

CREATE TABLE `bloqueados` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claves`
--

CREATE TABLE `claves` (
  `id_usuario` int(11) NOT NULL,
  `clave` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `claves`
--

INSERT INTO `claves` (`id_usuario`, `clave`) VALUES
(5, '$2y$10$FpP5hoUfUja3HvnDbWjgkuN8olwl1jMSFcJsePVQVuR.1iAAYvhJe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre_completo`, `correo`, `descripcion`) VALUES
(1, '1', '1@1.com', '123123'),
(2, '1', '1@1.com', '123123'),
(3, '1', '1@1.com', '123123'),
(4, 'Pepe', 'pepe@pepe.com', 'Quiero lo que sea'),
(5, 'Fernanddo', 'fernan@do.com', 'Quiero que me llameis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuario`
--

CREATE TABLE `datos_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `foto_perfil` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_usuario`
--

INSERT INTO `datos_usuario` (`id_usuario`, `nombre`, `foto_perfil`) VALUES
(5, 'admin', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `nombre_genero` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre_genero`) VALUES
(1, 'Acción y aventura'),
(2, 'Biografía'),
(3, 'Ciencia ficción'),
(4, 'Crimen y misterio'),
(5, 'Cuento de hadas'),
(6, 'Ensayo'),
(7, 'Fantasía'),
(8, 'Ficción histórica'),
(9, 'Ficción literaria'),
(10, 'Horror y terror'),
(11, 'Humor'),
(12, 'Infantil y juvenil'),
(13, 'Memorias'),
(14, 'Narrativa'),
(15, 'Novela gráfica'),
(16, 'Novela negra'),
(17, 'Novela romántica'),
(26, 'Otros'),
(18, 'Poesía'),
(19, 'Política'),
(20, 'Realismo mágico'),
(21, 'Religión y espiritualidad'),
(22, 'Sátira'),
(23, 'Teatro'),
(24, 'Thriller y suspense'),
(25, 'Viajes y aventuras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_vendidos`
--

CREATE TABLE `libros_vendidos` (
  `id` int(11) NOT NULL,
  `id_usu_comprador` int(11) DEFAULT NULL,
  `id_usu_vendedor` int(11) DEFAULT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `editorial` varchar(255) DEFAULT NULL,
  `estado` enum('nuevo','usado','malo') DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `review` tinyint(1) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT current_timestamp(),
  `id_libro_venta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_venta`
--

CREATE TABLE `libros_venta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `isbn` varchar(13) NOT NULL,
  `editorial` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `estado` enum('nuevo','usado','malo') NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cambio` tinyint(1) NOT NULL,
  `envio` tinyint(1) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` longblob NOT NULL,
  `autor` varchar(255) NOT NULL DEFAULT 'Desconocido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `id_usu_valorado` int(11) DEFAULT NULL,
  `id_usu_valorador` int(11) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `comentario` varchar(250) DEFAULT NULL,
  `fecha_review` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `descripcion`) VALUES
(1, 'usuario'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `apodo` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL CHECK (`tipo` in (1,2)),
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `apodo`, `tipo`, `correo`) VALUES
(5, 'admin', 2, 'admin@admin.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloqueados`
--
ALTER TABLE `bloqueados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `claves`
--
ALTER TABLE `claves`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_usuario`
--
ALTER TABLE `datos_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`),
  ADD UNIQUE KEY `genero` (`nombre_genero`);

--
-- Indices de la tabla `libros_vendidos`
--
ALTER TABLE `libros_vendidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usu_comprador` (`id_usu_comprador`),
  ADD KEY `id_usu_vendedor` (`id_usu_vendedor`),
  ADD KEY `genero` (`genero`),
  ADD KEY `id_libro_venta` (`id_libro_venta`);

--
-- Indices de la tabla `libros_venta`
--
ALTER TABLE `libros_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usu_valorado` (`id_usu_valorado`),
  ADD KEY `id_usu_valorador` (`id_usu_valorador`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bloqueados`
--
ALTER TABLE `bloqueados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `libros_vendidos`
--
ALTER TABLE `libros_vendidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `libros_venta`
--
ALTER TABLE `libros_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4518;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `claves`
--
ALTER TABLE `claves`
  ADD CONSTRAINT `claves_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datos_usuario`
--
ALTER TABLE `datos_usuario`
  ADD CONSTRAINT `datos_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`id_libro`) REFERENCES `libros_vendidos` (`id_libro_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
