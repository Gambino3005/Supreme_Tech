-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2025 a las 18:06:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Computadoras', 'Laptops y computadoras de escritorio'),
(2, 'Celulares', 'Teléfonos móviles y accesorios'),
(3, 'Electrónica', 'Dispositivos electrónicos como audífonos y parlantes'),
(4, 'Accesorios', 'Cables, cargadores y otros accesorios tecnológicos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(1, 2, 1, 1, 899.99),
(2, 2, 2, 1, 1199.99),
(3, 2, 3, 1, 999.99),
(4, 3, 1, 1, 899.99),
(5, 4, 1, 5, 899.99),
(6, 4, 2, 3, 1199.99),
(7, 4, 6, 1, 19.99),
(8, 5, 1, 1, 899.99),
(9, 6, 1, 1, 899.99),
(10, 7, 2, 2, 1199.99),
(11, 8, 1, 2, 899.99),
(12, 10, 1, 1, 899.99),
(13, 11, 2, 1, 1199.99),
(14, 12, 2, 1, 1199.99),
(15, 13, 1, 1, 899.99),
(16, 14, 1, 1, 899.99),
(17, 15, 2, 1, 1199.99),
(18, 16, 1, 1, 899.99),
(19, 17, 1, 1, 899.99),
(20, 19, 2, 2, 1199.99),
(21, 20, 2, 3, 1199.99),
(22, 21, 2, 10, 1199.99),
(23, 22, 1, 3, 899.99),
(24, 23, 1, 1, 899.99),
(25, 23, 2, 1, 1199.99),
(26, 23, 3, 1, 999.99),
(27, 23, 4, 1, 849.99),
(28, 23, 5, 1, 149.99),
(29, 23, 6, 1, 19.99),
(30, 25, 1, 3, 899.99),
(31, 26, 3, 1, 999.99),
(32, 26, 2, 1, 1199.99),
(33, 26, 6, 1, 19.99),
(34, 27, 1, 1, 899.99),
(35, 27, 2, 1, 1199.99),
(36, 27, 3, 1, 999.99),
(37, 28, 2, 1, 1199.99),
(38, 28, 3, 1, 999.99),
(39, 29, 1, 1, 899.99),
(40, 30, 2, 1, 1199.99),
(41, 31, 1, 3, 899.99),
(42, 31, 2, 1, 1199.99),
(43, 31, 3, 1, 999.99),
(44, 31, 4, 1, 849.99),
(45, 31, 5, 1, 149.99),
(46, 31, 6, 1, 19.99),
(47, 32, 1, 3, 899.99),
(48, 32, 2, 1, 1199.99),
(49, 32, 3, 1, 999.99),
(50, 32, 4, 1, 849.99),
(51, 32, 5, 1, 149.99),
(52, 32, 6, 1, 19.99),
(53, 33, 1, 1, 899.99),
(54, 33, 2, 1, 1199.99),
(55, 33, 3, 1, 999.99),
(56, 34, 2, 1, 1199.99),
(57, 35, 1, 2, 899.99),
(58, 36, 1, 1, 899.99),
(59, 37, 1, 2, 899.99),
(60, 38, 2, 1, 1199.99),
(61, 38, 1, 1, 899.99),
(62, 39, 1, 1, 899.99),
(63, 40, 1, 1, 899.99),
(64, 41, 1, 2, 899.99),
(65, 41, 2, 2, 1199.99),
(66, 41, 3, 1, 999.99),
(67, 42, 1, 1, 899.99),
(68, 43, 2, 1, 1199.99),
(69, 43, 3, 1, 999.99),
(70, 44, 1, 1, 899.99),
(71, 45, 1, 1, 899.99),
(72, 46, 1, 1, 899.99),
(73, 47, 1, 1, 899.99),
(74, 48, 2, 1, 1199.99),
(75, 49, 1, 1, 899.99),
(76, 50, 1, 1, 899.99),
(77, 51, 1, 1, 899.99),
(78, 52, 1, 1, 899.99),
(79, 52, 2, 1, 1199.99),
(80, 52, 4, 1, 849.99),
(81, 52, 6, 1, 19.99),
(82, 53, 1, 1, 849.99),
(83, 53, 2, 1, 929.99),
(84, 54, 1, 1, 849.99),
(85, 54, 2, 1, 929.99),
(86, 54, 3, 1, 1299.99),
(87, 54, 4, 1, 699.99),
(88, 54, 5, 1, 137.99),
(89, 54, 6, 1, 229.90),
(90, 54, 7, 1, 399.99),
(91, 54, 8, 1, 249.00),
(92, 54, 9, 1, 599.99),
(93, 55, 1, 1, 849.99),
(94, 55, 2, 1, 929.99),
(95, 55, 3, 1, 1299.99),
(96, 56, 1, 1, 849.99),
(97, 57, 1, 1, 849.99),
(98, 57, 3, 1, 1299.99),
(99, 58, 1, 1, 849.99),
(100, 58, 2, 1, 929.99),
(101, 58, 3, 1, 1299.99),
(102, 59, 4, 1, 699.99),
(103, 59, 5, 1, 137.99),
(104, 60, 3, 1, 1299.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id`, `nombre`) VALUES
(1, 'Tarjeta de crédito/debito '),
(2, 'PayPal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  `estado` enum('pendiente','enviado','entregado') DEFAULT 'pendiente',
  `metodo_pago_id` int(11) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `fecha`, `total`, `estado`, `metodo_pago_id`, `correo`, `direccion`) VALUES
(2, 1, '2025-03-23 14:06:05', 3099.97, 'pendiente', 1, '', ''),
(3, 1, '2025-03-23 23:04:49', 899.99, 'pendiente', 1, '', ''),
(4, 1, '2025-03-23 23:18:27', 8119.91, 'pendiente', 1, '', ''),
(5, 1, '2025-03-23 23:22:54', 899.99, 'pendiente', 1, '', ''),
(6, 1, '2025-03-23 23:26:49', 899.99, 'pendiente', 1, '', ''),
(7, 1, '2025-03-23 23:37:37', 2399.98, 'pendiente', 1, '', ''),
(8, 1, '2025-03-23 23:45:13', 1799.98, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(10, 1, '2025-03-23 23:48:15', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(11, 1, '2025-03-23 23:49:20', 1199.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(12, 1, '2025-03-23 23:51:08', 1199.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(13, 1, '2025-03-23 23:56:13', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(14, 1, '2025-03-23 23:57:44', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(15, 1, '2025-03-24 00:13:38', 1199.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(16, 1, '2025-03-24 00:23:06', 899.99, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(17, 1, '2025-03-24 00:24:01', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(19, 1, '2025-03-24 00:27:57', 2399.98, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(20, 1, '2025-03-24 00:28:28', 3599.97, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(21, 1, '2025-03-24 00:34:56', 11999.90, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(22, 2, '2025-03-24 00:49:42', 2699.97, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(23, 2, '2025-03-24 05:51:42', 4119.94, 'pendiente', 1, 'adielbg1417@gmail.com', 'Teo Cruz'),
(25, 1, '2025-03-24 11:39:03', 2699.97, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(26, 1, '2025-03-24 12:21:31', 2219.97, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(27, 1, '2025-03-24 12:27:17', 3099.97, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(28, 1, '2025-03-24 12:39:00', 2199.98, 'pendiente', 1, 'adielbg17@gmail.com', 'calle3'),
(29, 1, '2025-03-24 12:42:53', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'calle3'),
(30, 1, '2025-03-24 12:46:49', 1199.99, 'pendiente', 1, 'adielbg17@gmail.com', 'calle3'),
(31, 1, '2025-03-24 12:47:41', 5919.92, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(32, 7, '2025-03-24 23:20:36', 5919.92, 'pendiente', 1, 'alan@gmail.com', 'Teo Cruz'),
(33, 7, '2025-03-24 23:54:48', 3099.97, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(34, 7, '2025-03-24 23:55:18', 1199.99, 'pendiente', 1, 'alan@gmail.com', 'Avenida dorada'),
(35, 1, '2025-03-24 23:57:21', 1799.98, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(36, 1, '2025-03-25 19:32:53', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(37, 1, '2025-03-25 19:53:28', 1799.98, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(38, 1, '2025-03-25 20:21:07', 2099.98, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(39, 1, '2025-03-25 20:23:52', 899.99, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(40, 1, '2025-03-25 20:26:46', 899.99, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(41, 7, '2025-03-26 06:22:36', 5199.95, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(42, 8, '2025-03-26 06:44:04', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(43, 8, '2025-03-26 06:49:09', 2199.98, 'pendiente', 1, 'adielbg10@gmail.com', 'Teo Cru'),
(44, 8, '2025-03-26 06:55:00', 899.99, 'pendiente', 1, 'adielbg10@gmail.com', 'Teo Cru'),
(45, 8, '2025-03-26 06:58:52', 899.99, 'pendiente', 1, 'adielbg10@gmail.com', 'Teo Cru'),
(46, 8, '2025-03-26 07:10:18', 899.99, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(47, 8, '2025-03-26 07:10:48', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(48, 8, '2025-03-26 07:25:19', 1199.99, 'pendiente', 2, 'adielbg17@gmail.com', 'calle3'),
(49, 1, '2025-03-26 16:24:15', 899.99, NULL, 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(50, 1, '2025-03-26 16:30:48', 899.99, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(51, 1, '2025-03-26 16:35:16', 899.99, 'pendiente', 1, 'adielbg17@gmail.com', 'Avenida dorada'),
(52, 1, '2025-03-27 23:26:35', 2969.96, 'pendiente', 2, 'adielbg17@gmail.com', 'Avenida dorada'),
(53, 1, '2025-03-28 23:27:38', 1779.98, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(54, 1, '2025-03-29 18:01:01', 5396.83, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(55, 1, '2025-03-31 11:57:30', 3079.97, 'pendiente', 2, 'adielbg17@gmail.com', 'Avenida dorada'),
(56, 9, '2025-04-01 11:48:40', 849.99, 'pendiente', 2, 'adielbg17@gmail.com', 'Avenida dorada'),
(57, 1, '2025-04-01 11:53:37', 2149.98, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(58, 1, '2025-04-01 12:10:19', 3079.97, 'pendiente', 2, 'adielbg17@gmail.com', 'Teo Cruz'),
(59, 1, '2025-04-01 12:16:27', 837.98, 'pendiente', 1, 'adielbg17@gmail.com', 'Teo Cruz'),
(60, 11, '2025-04-02 08:55:56', 1299.99, 'pendiente', 2, 'miguelA27@gmail.com', 'calle la esperanza #14, San Felipe, Villa Mella');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `categoria_id`, `precio`, `stock`, `imagen`) VALUES
(1, 'Laptop Gaming Acer Nitro', 'Acer Nitro V - 15.6\" GeForce RTX 4050 Laptop GPU - Intel Core i7-13620H - 16GB Memory - 1 TB PCIe SSD - Windows 11 Home 64-bit - Gaming Laptop - 144 Hz IPS (ANV15-51-75HE )', 1, 849.99, 10, '../assets/img/computadora.jpg'),
(2, 'Gaming Laptop MSI', 'MSI - 15.6\" GeForce RTX 4060 Laptop GPU - AMD Ryzen 9 8945HS - 16GB Memory - 1 TB PCIe SSD - Windows 11 Home 64-bit - Gaming Laptop - 144 Hz IPS (Thin A15 B8VF-270US )', 1, 929.99, 8, '../assets/img/computadora2.jpg'),
(3, 'Gaming Laptop ASUS', 'ASUS ROG Strix - 16\" GeForce RTX 4050 Laptop GPU - Intel Core i7-13650HX - 16GB Memory - 512 GB SSD - Windows 11 Home 64-bit - 165 Hz (G614JU-NS73 )', 1, 1299.99, 15, '../assets/img/computadora3.jpg'),
(4, 'Apple iPhone 14 PRO', 'Apple iPhone 14 PRO 256GB, Refurbished Unlocked Cell Phone, Space Black - Very Good Condition (Grade B)Samsung Galaxy A05 A055M 128GB Fully Unlocked, Latin America Version, Black', 2, 699.99, 12, '../assets/img/celular2.jpg'),
(5, 'Samsung Galaxy A05', 'Samsung Galaxy A05 A055M 128GB Fully Unlocked, Latin America Version, Black', 2, 137.99, 20, '../assets/img/celular1.jpg'),
(6, 'Apple iPhone 12 Mini', 'Apple iPhone 12 Mini 64GB, Refurbished Unlocked Cell Phone, Black - Very Good Condition (Grade B)', 2, 229.90, 30, '../assets/img/celular3.jpg'),
(7, 'Headphones', 'beyerdynamic AVENTHO 300 Wireless Over-Ear Headphones with ANC, Dolby Atmos and Head Tracking (Nordic Grey)', 4, 399.99, 10, '../assets/img/electronica1.jpg'),
(8, 'Headphones', 'Bose QuietComfort Wireless Noise Cancelling Over-the-ear Headphones - Black', 4, 249.00, 10, '../assets/img/electronica2.jpg'),
(9, 'Samsung Galaxy Tablet', 'Samsung Galaxy Tab S9 FE+ 12.4\" Octa-core 8GB RAM 128GB Storage WiFi - Gray', 4, 599.99, 10, '../assets/img/electronica3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `ciudad` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `telefono`, `direccion`, `ciudad`, `estado`, `pais`, `contrasena`) VALUES
(1, 'Adiel', 'adielbg17@gmail.com', '8094236925', 'Teo Cruz', '', '', '', '$2y$10$TSTngQ7B4R9kA3QwZRkiZOdQN/FeMGtn5xYGtVrvlcwP7yCJObLRy'),
(2, 'Adiel', 'adielbg1417@gmail.com', '8094236925', 'Teo Cruz', '', '', '', '$2y$10$MkfNXY/z4N3iwJJaQlCiCOeaSShAAHMZwZzDSkegPcpx5ioj6rh9G'),
(3, 'Pedro Gomez', 'pedro2000@gmail.com', '8298837890', 'Avenida dorada', '', '', '', '$2y$10$LlyDXWN7vN1t.jAA2U.CZOM53jzKmDoa0LRXhRD4ZyZIGQmBunMVi'),
(4, 'Maria Martínez', 'maria2000@gmail.com', '8292093746', 'calle3', '', '', '', '$2y$10$vYE8jGwn5y8gXDTxgCMPd.n3aVHcoEqxKBEqSdoX40F.Lls3gWfHC'),
(5, 'Maria Gomez', 'mariagomez2000@gmail.com', '8094236925', 'Teo Cruz', '', '', '', '$2y$10$5hreHNgwJekDDmW48xpQp.n905PeMp8KhURLN5PMFwDIl9vdP1f92'),
(6, 'Adiel', 'adielbg14@gmail.com', '8094236925', 'Teo Cruz', '', '', '', '$2y$10$uQs8lGorIEzvmkgRJHgEZOii24x8x6XxYxdQIFUT8vZ8/HyfdsX.S'),
(7, 'Alan', 'alan@gmail.com', '8094236925', 'Teo Cruz', '', '', '', '$2y$10$Oe72y0fYc0FooOokpmGBP.IyM71dUUKV7QDV7JVemQGVF0eHE1XbK'),
(8, 'Adiel Batista Guzmán', 'adielbg10@gmail.com', '8094236925', 'Teo Cruz', '', '', '', '$2y$10$oA9rxblRco92g1UY//W8OuYi0JfdqUrdWLuFd5aBuH4u3T2K5zUeK'),
(9, 'Adiel Batista Guzmán', 'adielbg17.2@gmail.com', '8094236925', 'Teo Cruz', 'Santo Domingo Norte', 'Villa Mella, Santo Domingo', 'República Dominicana', '$2y$10$q57QNb9W4O6m22OctW8U1.n3keVdme3sqYxJxdzvAfuqERcYC4VHm'),
(10, 'Pedro Gomez', 'pedro2@gmail.com', '8094236925', 'Teo Cruz', 'Santo Domingo Norte', 'Villa Mella, Santo Domingo', 'República Dominicana', '$2y$10$osnSOYeBWE2XCnuL3b87g.JN8GiBo4SP7vCMQV4eMA/n62FIgROA6'),
(11, 'Miguel Ángel Nival Paredez', 'miguelA27@gmail.com', '8492252004', 'calle la esperanza #14, San Felipe, Villa Mella', 'Santo Domingo Norte', 'Villa Mella, Santo Domingo', 'República Dominicana', '$2y$10$tG6TkhetNqbMgD21fWpb7.jKntbVUozN4Uxh3Gwp7iMvsgEhKak3y'),
(12, 'Alan', 'alan17@gmail.com', '8094236925', 'Teo Cruz', 'Santo Domingo Norte', 'Villa Mella, Santo Domingo', 'República Dominicana', '$2y$10$deyc6EyqjWGYZpPn0zb1d.p0AXUSfbmTMi3nTNrtBjnI9ZycGwnQi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `metodo_pago_id` (`metodo_pago_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodos_pago` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
