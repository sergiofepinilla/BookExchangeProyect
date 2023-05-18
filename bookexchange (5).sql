-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2023 a las 17:05:42
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
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `claves`
--

INSERT INTO `claves` (`id_usuario`, `clave`) VALUES
(4, '$2y$10$it4XfOFKQTk6d6FgJ5cuWuEfAxsAMq5JEc2RDsKSPlrjvgDMv34iO'),
(5, '$2y$10$FpP5hoUfUja3HvnDbWjgkuN8olwl1jMSFcJsePVQVuR.1iAAYvhJe'),
(7, '$2y$10$XCyQE.ST7vd/PUKj0NBXS.Hblah4djQdEmqwC4nPP24L9TlTCM9pS'),
(8, '$2y$10$HRkGy1YMevYdS8OQr/RbKuGDYKwlqfYhDJXu6.6L8u3LMxlYAduOG'),
(9, '$2y$10$DhZsrIlW8KT.i16M8H6JderCBuTRIdKvXyzi0AmMtjc12qF9Oe00.'),
(10, '$2y$10$QAYDVpqzE17J4kDEQyevAu8wR.EqKdXmIIo7DdVXdAvdNCOE1V9Bu'),
(11, '$2y$10$MeyVudDs9zymCS2g3eJC8OFV1E8uHgnxxT.VIyeJjOKHJUL7u4iVO'),
(12, '$2y$10$6k7opWPxTnOBZPOz2iI3VusQC419TNfZQcbvEvvfiXiZog/m3vPai'),
(18, '$2y$10$VWkk6IdiO1FrmaODZWovlOyZ/qQIKtfo5ALBCxie7oitJr2DKb2by'),
(19, '$2y$10$sF3mRust3/TNd2MXsh2bf.o2ZMQBfdCnosWeF6xFEXIzU8PyhP4u6'),
(20, '$2y$10$YeWxHnXsfKVfLbChHHYgjOQVVJSxLNusuRneh5GQ0BFLRfyRgxZu.'),
(21, '$2y$10$62AezUNHqaN0XQnnJS475uKWZMPAiMwnSTXjd3ycQkH.zDtwk0KRa'),
(22, '$2y$10$MWyOvyyvsdfmVJkI/n0UD.uY20GodGSRlrrrYFpWVAyESxhzwgCga'),
(23, '$2y$10$x9D1ioqYPIfKMU5dJTEekeHwWzKn71/yXIZlTBscAiUqn0LcAMONy'),
(24, '$2y$10$VDRK2sl50f44oIy4POhqKO8FBi3Bv9wN77FW4cRK9SOrwSgZRnk3e'),
(25, '$2y$10$3GnbmpYA3VIanTg2b17Te.7TJhKA1JhdQvCpWzORLcq8ltFD9cGeS'),
(26, '$2y$10$JJ1JSuBvF7dJMdYhpAnheeivlyaESSJL/dMe66veMPWdVAw1ny1sK'),
(27, '$2y$10$vNvKGhlKmY3nP13.JT40zeho86fHt.Ly1usYyXkMTmHKF0M4.OTy6'),
(28, '$2y$10$hxcjcmYq6mygCPXvX3QoU.Wk8i5c/3w4.Fvuf61kYofLOxZHUBNXu');

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
(4, 'Jose Luis Zapatero', NULL),
(5, 'admin', NULL),
(7, 'Pepe', NULL),
(8, 'tyty', NULL),
(9, 'Manolito', NULL),
(10, 'usu2', NULL),
(11, 'usu3', NULL),
(12, 'Eduardo Gerardo', NULL),
(18, 'aAa', NULL),
(19, '123123', NULL),
(20, 'v', NULL),
(21, 'f', NULL),
(22, '', NULL),
(23, '', NULL),
(24, 'Neo', NULL),
(25, 'Leonardo', NULL),
(26, 'usuwu', NULL),
(27, 'chuerk', NULL),
(28, 'nuevo', NULL);

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
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) DEFAULT NULL,
  `ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Volcado de datos para la tabla `libros_vendidos`
--

INSERT INTO `libros_vendidos` (`id`, `id_usu_comprador`, `id_usu_vendedor`, `titulo`, `isbn`, `autor`, `genero`, `editorial`, `estado`, `precio`, `review`, `fecha_compra`, `id_libro_venta`) VALUES
(1, 22, 20, 'qwewq', 'Desconocido', 'qweqwqweqw', 3, 'qweqwewq', 'usado', 1231.00, 0, '2023-05-11 13:12:57', NULL),
(2, 22, 20, 'qwewq', 'Desconocido', 'qweqwqweqw', 3, 'qweqwewq', 'usado', 1231.00, 0, '2023-05-11 13:12:57', NULL),
(3, 22, 20, 'qwewq', 'Desconocido', 'qweqwqweqw', 3, 'qweqwewq', 'usado', 1231.00, 0, '2023-05-11 13:12:57', NULL),
(4, 22, 20, 'qwewq', 'Desconocido', 'qweqwqweqw', 3, 'qweqwewq', 'usado', 1231.00, 0, '2023-05-11 13:12:57', NULL),
(5, 22, 4, 'A Court of Mist and Fury', '9781619634466', 'Sarah J Maas', 1, 'A Court of Thorns and Roses', 'usado', 25.00, 0, '2023-05-11 13:12:57', NULL),
(6, 4, 22, 'qwewqe', 'Desconocido', 'qweqwe', 3, 'wqe', 'usado', 12312.00, 0, '2023-05-11 14:50:18', NULL),
(7, 4, 22, 'qwewqe', 'Desconocido', 'qweqwe', 3, 'wqe', 'usado', 12312.00, 0, '2023-05-11 14:55:19', NULL),
(8, 4, 23, 'Lorem Septum Umbralla', 'Desconocido', 'Desconocido', 3, 'Desconocido', 'usado', 25.00, 0, '2023-05-11 14:59:57', NULL),
(9, 4, 22, 'qwewqe', 'Desconocido', 'qweqwe', 3, 'wqe', 'usado', 12312.00, 0, '2023-05-11 15:12:35', NULL),
(10, 24, 22, 'qwewqe', 'Desconocido', 'qweqwe', 3, 'wqe', 'usado', 12312.00, 0, '2023-05-11 16:11:49', NULL),
(11, 4, 24, 'Título libro 1', '1234567890', 'Autor 1', 1, 'Editorial 1', 'usado', 15.99, 1, '2023-05-12 08:12:04', NULL),
(12, 4, 24, 'Título libro 2', '9876543210', 'Autor 2', 2, 'Editorial 2', 'malo', 50.50, 0, '2023-05-12 08:12:04', NULL),
(13, 4, 24, 'Título libro 3', '2468135790', 'Autor 3', 3, 'Editorial 3', 'nuevo', 99.99, 1, '2023-05-12 08:12:04', NULL),
(14, 4, 24, 'Título libro N', '0123456789012', 'Autor N', 15, 'Editorial N', 'usado', 25.75, 0, '2023-05-12 08:12:04', NULL),
(15, 4, 24, 'El Gran Gatsby', '9788491050731', 'F. Scott Fitzgerald', 7, 'DeBolsillo', 'usado', 15.99, 1, '2023-05-12 08:13:55', NULL),
(16, 4, 24, 'Cien años de soledad', '9788439720801', 'Gabriel García Márquez', 5, 'Literatura Random House', 'nuevo', 29.99, 1, '2023-05-12 08:13:55', NULL),
(17, 4, 24, '1984', '9780451524935', 'George Orwell', 3, 'Signet Classics', 'malo', 12.50, 0, '2023-05-12 08:13:55', NULL),
(18, 4, 24, 'Harry Potter and the Sorcerer\'s Stone', '9780590353427', 'J.K. Rowling', 8, 'Scholastic', 'usado', 20.50, 1, '2023-05-12 08:13:55', NULL),
(19, 4, 24, 'To Kill a Mockingbird', '9780060935467', 'Harper Lee', 9, 'Harper Perennial Modern Classics', 'nuevo', 15.99, 1, '2023-05-12 08:13:55', NULL),
(20, 4, 24, 'The Lord of the Rings', '9780618640157', 'J.R.R. Tolkien', 10, 'Houghton Mifflin Harcourt', 'usado', 30.75, 0, '2023-05-12 08:13:55', NULL),
(21, 4, 24, 'Pride and Prejudice', '9780141439518', 'Jane Austen', 11, 'Penguin Classics', 'malo', 10.99, 0, '2023-05-12 08:13:55', NULL),
(22, 4, 24, 'The Catcher in the Rye', '9780316769488', 'J.D. Salinger', 12, 'Little, Brown and Company', 'nuevo', 18.50, 1, '2023-05-12 08:13:55', NULL),
(23, 4, 23, '11111111111111111111111111111111111111111111111111', '1111111111111', '11111111111111111111111111111111111111111111111111', 3, '11111111111111111111111111111111111111111111111111', 'usado', 24.00, 0, '2023-05-12 09:04:52', NULL),
(24, 4, 23, '11111111111111111111111111111111111111111111111111', '1111111111111', '11111111111111111111111111111111111111111111111111', 3, '11111111111111111111111111111111111111111111111111', 'usado', 24.00, 0, '2023-05-12 09:10:43', 38),
(25, 22, 4, 'American Psyco', '1283190238109', 'Jhon debundom', 3, 'Editorial Bruno', 'usado', 25.00, 0, '2023-05-12 12:55:15', 39),
(26, 4, 23, '11111111111111111111111111111111111111111111111111', '1111111111111', '11111111111111111111111111111111111111111111111111', 3, '11111111111111111111111111111111111111111111111111', 'usado', 24.00, 0, '2023-05-12 12:57:33', 38),
(27, 4, 23, 'Lorem Septum Umbralla', 'Desconocido', 'Desconocido', 3, 'Desconocido', 'usado', 25.00, 0, '2023-05-12 12:57:39', 37),
(28, 4, 23, 'Lorem Septum Umbralla', 'Desconocido', 'Desconocido', 3, 'Desconocido', 'usado', 25.00, 1, '2023-05-12 12:57:45', 37),
(29, 4, 10, 'Speak', '9780736231916', 'Laurie Halse Anderson', 3, 'Una edicin de Speak 1999', 'usado', 9.00, 1, '2023-05-16 10:44:46', 29),
(30, 4, 10, 'Speak', '9780736231916', 'Laurie Halse Anderson', 0, 'Una edicin de Speak 1999', 'usado', 9.00, 0, '2023-05-16 10:47:30', 29),
(31, 4, 23, '11111111111111111111111111111111111111111111111111', '1111111111111', '11111111111111111111111111111111111111111111111111', 0, '11111111111111111111111111111111111111111111111111', 'usado', 24.00, 0, '2023-05-16 10:48:19', 38),
(32, 4, 23, 'Lorem Septum Umbralla', 'Desconocido', 'Desconocido', 3, 'Desconocido', 'usado', 25.00, 1, '2023-05-16 10:53:41', 37),
(33, 26, 4, 'qwewqe', 'Desconocido', 'wqewqewq', 3, '12312', 'usado', 21412.00, 1, '2023-05-16 12:11:07', 41),
(34, 27, 4, 'ction createCard', '123123123', 'ction createCard', 3, 'ction createCard', 'usado', 1123.00, 1, '2023-05-16 13:00:05', 34),
(35, 27, 4, 'ction createCard', '123123123', 'ction createCard', 3, 'ction createCard', 'usado', 1123.00, 1, '2023-05-16 13:02:17', 34),
(36, 27, 4, 'American Psyco', '1283190238109', 'Jhon debundom', 3, 'Editorial Bruno', 'usado', 25.00, 1, '2023-05-16 13:18:57', 39),
(37, 4, 28, 'Pepito Grillo', '123123', 'wakala', 3, 'Muoz', 'usado', 25.00, 1, '2023-05-16 16:21:54', 44),
(38, 4, 28, 'Pepito Grillo', '123123', 'wakala', 3, 'Muoz', 'usado', 25.00, 1, '2023-05-16 16:22:39', 44),
(39, 4, 10, 'Speak', '9780736231916', 'Laurie Halse Anderson', 3, 'Una edicin de Speak 1999', 'usado', 9.00, 1, '2023-05-17 10:08:19', 29),
(40, 4, 10, 'The Wise Man\\\'s Fear', '9854613860', 'Robert Louis Stevenson', 3, 'Ballantine Books', 'nuevo', 97.00, 1, '2023-05-17 13:27:02', 3911),
(41, 4, 9, 'Insurgent', '6478116732', 'Herman Melville', 1, 'Doubleday', 'nuevo', 17.00, 1, '2023-05-17 13:29:12', 3853),
(42, 4, 25, 'The Slow Regard of Silent Things', '3559324720', 'Javier Marías', 3, 'MIT Press', 'malo', 16.00, 1, '2023-05-17 16:44:59', 3912),
(43, 4, 25, 'Orgullo y prejuicio', '9471005920', 'Stephen King', 3, 'Harvard University Press', 'malo', 68.00, 1, '2023-05-18 16:18:09', 3941),
(44, 4, 10, 'The Witcher: Baptism of Fire', '6694227178', 'J.R.R. Tolkien', 3, 'Sceptre', 'malo', 79.00, 1, '2023-05-18 16:20:42', 4107),
(45, 4, 28, 'The Witcher: The Tower of Swallows', '5394745134', 'Robert Louis Stevenson', 3, 'Orion Publishing Group', 'malo', 85.00, 1, '2023-05-18 16:21:15', 4108);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 24, 22, 38, 5, 'Comentario insercion manual 1', '2023-05-16 10:41:25'),
(2, 24, 22, 38, 5, 'Comentario insercion manual 2', '2023-05-16 10:41:25'),
(4, 23, 4, 37, 4, 'Reiewideado', '2023-05-16 10:41:25'),
(5, 10, 4, 29, 4, 'qweqw', '2023-05-16 10:41:25'),
(6, 23, 4, 37, 5, 'Comentario Buno xd', '2023-05-16 10:41:25'),
(7, 4, 26, 41, 5, 'Comentario xd', '2023-05-16 10:41:25'),
(8, 4, 27, 34, 3, 'Malardo', '2023-05-16 11:00:59'),
(9, 4, 27, 34, 1, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2023-05-16 11:02:33'),
(10, 4, 27, 39, 5, 'Me ha gustado', '2023-05-16 11:19:13'),
(11, 28, 4, 44, 5, 'Buen Libro', '2023-05-16 14:23:19'),
(12, 28, 4, 44, 1, 'Malo', '2023-05-16 14:24:42'),
(13, 10, 4, 29, 5, 'Bueno', '2023-05-17 08:10:13'),
(14, 10, 4, 3911, 5, '', '2023-05-17 11:27:19'),
(15, 9, 4, 3853, 3, 'Estaba sucio', '2023-05-17 11:29:34'),
(16, 25, 4, 3912, 5, 'Me ha gustado tu libro', '2023-05-17 14:45:40'),
(17, 25, 4, 3941, 5, 'ok', '2023-05-18 14:19:19'),
(18, 10, 4, 4107, 4, 'bueno', '2023-05-18 14:20:51'),
(19, 28, 4, 4108, 4, 'bien', '2023-05-18 14:21:33');

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
(4, 'usu', 1, 'usu@usu.com'),
(5, 'admin', 2, 'admin@admin.com'),
(7, 'Pip', 1, 'pip@pip.com'),
(8, 'ttytytyty', 1, '123@123.com'),
(9, 'Manoloxd', 1, 'mano@lo.com'),
(10, 'usu2', 1, 'usu2@usu2.com'),
(11, 'usu3', 1, 'usu3@usu3.com'),
(12, 'eduwi', 1, 'esu@esu.com'),
(13, 'kikaso', 1, 'kike@kike.com'),
(14, 'a', 1, 'a@a.com'),
(15, 'a', 1, 'a@a.com'),
(16, 'a', 1, 'a@a.com'),
(17, 'a', 1, 'a@a.com'),
(18, 'A', 1, 'a@a.com'),
(19, '123123', 1, '123123@kek.com'),
(20, 'v', 1, 'v@v.com'),
(21, 'f', 1, 'f@f.com'),
(22, 'g', 1, 'g@g.com'),
(23, 'gerar_garci', 1, 'gerardo@erardo.com'),
(24, 'asd', 1, 'asd@asd.com'),
(25, 'leo', 1, 'leo@leo.com'),
(26, 'uwusu', 1, 'usuwu@usuwu.com'),
(27, 'Bolongerr', 1, 'ser@onoser.com'),
(28, 'nuevo', 1, 'nuevo@nuevo.com');

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
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Category` (`categoria`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `libros_venta`
--
ALTER TABLE `libros_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4116;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
-- Filtros para la tabla `libros_vendidos`
--
ALTER TABLE `libros_vendidos`
  ADD CONSTRAINT `libros_vendidos_ibfk_1` FOREIGN KEY (`id_usu_comprador`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `libros_vendidos_ibfk_2` FOREIGN KEY (`id_usu_vendedor`) REFERENCES `usuarios` (`id`);

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

--
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_usu_valorado`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_usu_valorador`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`id_libro`) REFERENCES `libros_vendidos` (`id_libro_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
