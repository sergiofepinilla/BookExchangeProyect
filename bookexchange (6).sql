-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2023 a las 17:09:14
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
(5, '$2y$10$FpP5hoUfUja3HvnDbWjgkuN8olwl1jMSFcJsePVQVuR.1iAAYvhJe'),
(30, '$2y$10$GYNb56vNgf4HGvPUIhk81eEBgNoAQN9QIXkke34ea9f2NFn4IBB16'),
(31, '$2y$10$wvSJwQG1DU0f9R1rZmD5qevbe1Mjn2X518MtqgJR2LBOmC9hXYn7O'),
(32, '$2y$10$.XETba1vQfO2p0Wjni6D/u/SuPg5kF6LV10r5cwsFy1/2py49t92C'),
(34, '$2y$10$E12QX42rRfQZQANojVeFyu0zeAnupxEZ9iQU8OC5xG6eRZvFYWXSW'),
(35, '$2y$10$ljpBrJFjEL.qwiWs.OQgX.dqi3yxIf1XVu2heX3ndh.oK75eS3HvC');

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
  `estado` enum('Nuevo','Usado','Malo') DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `review` tinyint(1) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT current_timestamp(),
  `id_libro_venta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros_vendidos`
--

INSERT INTO `libros_vendidos` (`id`, `id_usu_comprador`, `id_usu_vendedor`, `titulo`, `isbn`, `autor`, `genero`, `editorial`, `estado`, `precio`, `review`, `fecha_compra`, `id_libro_venta`) VALUES
(52, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-23 13:17:58', 4714),
(53, 5, 32, 'The Name of the Wind', '9615666401', 'Walter Scott', 19, 'Harper Perennial', 'Usado', 24.00, 0, '2023-05-23 13:18:13', 4715),
(54, 35, 30, 'Harry Potter', '2222222222222', '22222222222222222222222222222222222222222222222222', 14, '22222222222222222222222222222222222222222222222222', 'Usado', 25.90, 0, '2023-05-24 12:39:17', 4724),
(55, 35, 30, 'Harry Potter', 'Desconocido', 'Desconocido', 17, 'Desconocido', 'Nuevo', 2525.00, 1, '2023-05-24 13:34:17', 4720),
(56, 35, 34, '123123', '2131231231231', 'Desconocido', 16, 'Desconocido', 'Nuevo', 213.00, 0, '2023-05-24 13:48:24', 4727),
(57, 35, 30, 'Harry Potter', '2222222222222', '22222222222222222222222222222222222222222222222222', 14, '22222222222222222222222222222222222222222222222222', 'Usado', 25.90, 1, '2023-05-24 13:49:14', 4724),
(58, 35, 30, 'Brave New World', '2952000844', 'Albert Camus', 14, 'Orbit Books', 'Nuevo', 11.00, 1, '2023-05-24 13:54:35', 4596),
(59, 35, 30, 'Harry Potter', '2222222222222', '22222222222222222222222222222222222222222222222222', 14, '22222222222222222222222222222222222222222222222222', 'Usado', 25.90, 1, '2023-05-24 13:56:53', 4724),
(60, 5, 30, 'The Witcher: The Tower of Swallows', '8099331696', 'Lewis Carroll', 15, 'Mills & Boon', 'Nuevo', 81.00, 0, '2023-05-24 14:40:19', 4712),
(61, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-24 14:40:25', 4714),
(62, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-24 14:40:33', 4714),
(63, 5, 30, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'Desconocido', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 16, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'Usado', 25.99, 0, '2023-05-24 14:40:42', 4725),
(64, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-24 14:41:15', 4714),
(65, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-24 14:44:41', 4714),
(66, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-24 14:45:45', 4714),
(67, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-24 14:46:01', 4714),
(68, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-24 14:49:10', 4714),
(69, 5, 30, 'The Witcher: Season of Storms', '8403281833', 'Walter Scott', 11, 'National Geographic', 'Malo', 41.00, 0, '2023-05-24 14:50:54', 4714),
(70, 5, 30, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'Desconocido', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 16, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'Usado', 25.99, 0, '2023-05-24 14:51:23', 4725);

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
  `estado` enum('Nuevo','Usado','Malo') NOT NULL,
  `precio` decimal(10,2) NOT NULL,
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

--
-- Volcado de datos para la tabla `review`
--

INSERT INTO `review` (`id`, `id_usu_valorado`, `id_usu_valorador`, `id_libro`, `puntuacion`, `comentario`, `fecha_review`) VALUES
(29, 30, 35, 4720, 5, '12211', '2023-05-24 11:34:38'),
(30, 30, 35, 4720, 0, '', '2023-05-24 11:34:38'),
(31, 30, 35, 4724, 5, '', '2023-05-24 11:49:48'),
(32, 30, 35, 4596, 1, 'Bastante malo', '2023-05-24 11:55:31'),
(33, 30, 35, 4724, 0, '', '2023-05-24 11:57:12');

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
(5, 'admin', 2, 'admin@admin.com'),
(30, 'usu', 1, 'usu@usu.com'),
(31, '3', 1, '3@3.com'),
(32, '4', 1, '4@4.com'),
(34, '1', 1, '1@1.com'),
(35, 'qweqweqwe', 1, 'qwewq@1321.com');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `libros_venta`
--
ALTER TABLE `libros_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4729;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
