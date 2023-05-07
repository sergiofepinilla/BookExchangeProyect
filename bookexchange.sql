-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2023 a las 21:35:16
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Genero Prueba 1'),
(2, 'Genero Prueba 2'),
(3, 'Genero Prueba 3'),
(4, 'Genero Prueba 4'),
(5, 'Genero Prueba 5'),
(6, 'Genero Prueba 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claves`
--

CREATE TABLE `claves` (
  `id_usuario` int(11) NOT NULL,
  `clave` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `claves`
--

INSERT INTO `claves` (`id_usuario`, `clave`) VALUES
(4, '$2y$10$it4XfOFKQTk6d6FgJ5cuWuEfAxsAMq5JEc2RDsKSPlrjvgDMv34iO'),
(5, '$2y$10$FpP5hoUfUja3HvnDbWjgkuN8olwl1jMSFcJsePVQVuR.1iAAYvhJe'),
(7, '$2y$10$XCyQE.ST7vd/PUKj0NBXS.Hblah4djQdEmqwC4nPP24L9TlTCM9pS'),
(8, '$2y$10$HRkGy1YMevYdS8OQr/RbKuGDYKwlqfYhDJXu6.6L8u3LMxlYAduOG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre_completo`, `correo`, `descripcion`) VALUES
(1, '1', '1@1.com', '123123'),
(2, '1', '1@1.com', '123123'),
(3, '1', '1@1.com', '123123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuario`
--

CREATE TABLE `datos_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `genero` enum('hombre','mujer','otro') NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `foto_perfil` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_usuario`
--

INSERT INTO `datos_usuario` (`id_usuario`, `nombre`, `genero`, `fecha_nacimiento`, `direccion`, `pais`, `foto_perfil`) VALUES
(4, 'usu', 'hombre', NULL, NULL, NULL, NULL),
(5, 'admin', 'hombre', NULL, NULL, NULL, NULL),
(7, 'Pepe', 'hombre', NULL, NULL, NULL, NULL),
(8, 'tyty', 'hombre', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `genero` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `genero`) VALUES
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
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) DEFAULT NULL,
  `ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `ruta`) VALUES
(3, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(3, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(3, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(3, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(4, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(4, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(4, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(4, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(5, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(5, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(5, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(5, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(6, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(6, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(6, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(6, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(107, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(107, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(107, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(107, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(108, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(108, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(108, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(108, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(109, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(109, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(109, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(109, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(110, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(110, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(110, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(110, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(111, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(111, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(111, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(113, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(113, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(113, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000'),
(113, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_venta`
--

CREATE TABLE `libros_venta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `cantidad`, `precio`, `imagen`, `categoria`) VALUES
(3, 'Prueba 1', 'Esto es una descripción del libro que se está vendiendo.', 5, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 2),
(4, 'Prueba 2', 'Esto es una descripción del libro que se está vendiendo.', 0, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 2),
(6, 'Prueba 3', 'Esto es una descripción del libro que se está vendiendo.', 0, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 2),
(107, 'Prueba 4', 'Esto es una descripción del libro que se está vendiendo.', 0, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 1),
(108, 'Prueba 5', 'Esto es una descripción del libro que se está vendiendo.', 0, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 1),
(109, 'Prueba 6', 'Esto es una descripción del libro que se está vendiendo.', 0, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 3),
(110, 'Prueba 7', 'Esto es una descripción del libro que se está vendiendo.', 0, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 3),
(111, 'Prueba 8', 'Esto es una descripción del libro que se está vendiendo.', 0, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 5),
(113, 'Prueba 9', 'Esto es una descripción del libro que se está vendiendo.', 1, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 4),
(200, 'Prueba 10', 'Esto es una descripción del libro que se está vendiendo.', 1, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 2),
(201, 'Prueba 11', 'Esto es una descripción del libro que se está vendiendo.', 5, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 2),
(202, 'Prueba 12', 'Esto es una descripción del libro que se está vendiendo.', 5, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 2),
(203, 'Prueba 13', 'Esto es una descripción del libro que se está vendiendo.', 5, 9.99, 'https://img.freepik.com/vector-premium/libro-abierto-leer-vector-simbolo_599395-337.jpg?w=2000', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `apodo`, `tipo`, `correo`) VALUES
(4, 'usu', 1, 'usu@usu.com'),
(5, 'admin', 2, 'admin@admin.com'),
(7, 'Pip', 1, 'pip@pip.com'),
(8, 'ttytytyty', 1, '123@123.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloqueados`
--
ALTER TABLE `bloqueados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genero` (`genero`);

--
-- Indices de la tabla `libros_venta`
--
ALTER TABLE `libros_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Category` (`categoria`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `libros_venta`
--
ALTER TABLE `libros_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Filtros para la tabla `libros_venta`
--
ALTER TABLE `libros_venta`
  ADD CONSTRAINT `libros_venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_Category` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
