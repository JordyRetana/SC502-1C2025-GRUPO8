-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3315
-- Tiempo de generación: 20-04-2025 a las 22:51:13
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
-- Base de datos: `proyecto`
--
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `tipo` enum('success','warning','info') DEFAULT 'info',
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_contacto`
--

CREATE TABLE `mensajes_contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `leido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes_contacto`
--

INSERT INTO `mensajes_contacto` (`id`, `nombre`, `correo`, `mensaje`, `fecha`, `leido`) VALUES
(1, 'Jordy Retana', 'retanajordy@gmail.com', 'sss', '2025-04-11 03:15:11', 0),
(2, 'Jordy Retana', 'retanajordy@gmail.com', 'ssssss', '2025-04-11 03:16:35', 1),
(6, 'Jordy Retana', 'pocep97716@dpcos.com', 'aaaaaa', '2025-04-16 04:14:39', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen_url`, `categoria`, `stock`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Asus X1404', 'Laptop de temporada ideal para tareas básicas y estudiantes, con diseño ligero y eficiente.', 499.99, 'https://extremetechcr.com/tienda/40331-large_default/asus-notebook-x1404-i3-1215u-8-gb-ssd.jpg', 'Laptops', 39, '2025-04-14 06:09:46', '2025-04-16 04:29:13'),
(2, 'Lenovo IdeaPad Slim 3', 'Laptop inteligente con procesador i5 de última generación y almacenamiento SSD, ideal para trabajo y estudio.', 699.99, 'https://extremetechcr.com/tienda/41995-large_default/lenovo-ideapad-slim-3-i5-12450h-8-gb-ssd.jpg', 'Laptops', 21, '2025-04-14 06:09:46', '2025-04-16 23:29:52'),
(3, 'Dell Inspiron 3520', 'Laptop moderna con diseño elegante, alto rendimiento y gran capacidad de memoria para usuarios exigentes.', 899.99, 'https://extremetechcr.com/tienda/38592-large_default/dell-inspiron-3520-i7-1255u-16-gb-ssd-carbon-black.jpg', 'Laptops', 12, '2025-04-14 06:09:46', '2025-04-16 04:23:08'),
(4, 'HP 255 G10 Ryzen 7', 'Laptop potente ideal para trabajo y estudio', 699.99, 'https://extremetechcr.com/tienda/40323-large_default/hp-255-g10-ryzen-7-7730u-16gb-ssd.jpg', 'laptops', 25, '2025-04-14 06:22:21', '2025-04-14 06:22:21'),
(6, 'PC Hogar AMD', 'Computadora básica para tareas del hogar y oficina', 399.00, 'https://extremetechcr.com/tienda/42959-large_default/pc-hogar-y-oficina-amd.jpg', 'pc', 14, '2025-04-14 06:22:21', '2025-04-16 04:24:25'),
(7, 'Extreme PC Nivel 3 AMD', 'PC gamer nivel medio con componentes de alto rendimiento', 849.99, 'https://extremetechcr.com/tienda/42946-large_default/extreme-pc-level-3-amd.jpg', 'gaming', 10, '2025-04-14 06:22:21', '2025-04-14 06:22:21'),
(8, 'Disipador Intel LGA 1700', 'Disipador de stock para procesadores Intel socket 1700', 19.99, 'https://extremetechcr.com/tienda/28522-large_default/disipador-stock-intel-para-socket-1700.jpg', 'cooling', 55, '2025-04-14 06:22:21', '2025-04-16 07:28:46'),
(9, 'AMD Ryzen 9 7900X', 'Procesador de alto rendimiento para gamers y creadores', 499.00, 'https://extremetechcr.com/tienda/21810-large_default/amd-ryzen-9-7900x.jpg', 'processors', 12, '2025-04-14 06:22:21', '2025-04-14 06:22:21'),
(10, 'Cooler AMD Wraith Stealth', 'Sistema de enfriamiento oficial AMD para socket AM4', 24.90, 'https://extremetechcr.com/tienda/21145-large_default/cooler-amd-wraith-stealth-socket-am4.jpg', 'cooling', 30, '2025-04-14 06:22:21', '2025-04-14 06:22:21'),
(11, 'Antec A30 Neo ARGB', 'Disipador con iluminación ARGB para PC', 34.99, 'https://extremetechcr.com/tienda/30481-large_default/antec-a30-neo-argb.jpg', 'cooling', 20, '2025-04-14 06:22:21', '2025-04-14 06:22:21'),
(12, 'Redragon Effect CC2000', 'Refrigeración líquida RGB para alto desempeño', 89.99, 'https://extremetechcr.com/tienda/13154-large_default/redragon-effect-cc2000-rgb.jpg', 'cooling', 15, '2025-04-14 06:22:21', '2025-04-14 06:22:21'),
(13, 'T-Dagger Mustang T-TC700', 'Silla gamer ergonómica de color rojo', 149.99, 'https://extremetechcr.com/tienda/26554-large_default/t-dagger-mustang-t-tc700-br-rojo.jpg', 'furniture', 18, '2025-04-14 06:22:21', '2025-04-14 06:22:21'),
(14, 'Fuente Redragon RGPS 600W', 'Fuente de poder 80 Plus Bronze', 49.99, 'https://extremetechcr.com/tienda/39573-large_default/redragon-rgps-600w-80-plus-bronze-gc-ps024.jpg', 'Fuentes', 15, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(15, 'Thermaltake Toughpower PF3 850W', 'Fuente 80 Plus Platinum', 129.99, 'https://extremetechcr.com/tienda/29541-large_default/thermaltake-toughpower-pf3-850w-80-plus-platinum.jpg', 'Fuentes', 10, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(16, 'G.Skill Aegis 8GB DDR4 3200', 'Memoria RAM DDR4', 29.99, 'https://extremetechcr.com/tienda/13086-large_default/gskill-aegis-8-gb-ddr4-3200.jpg', 'Memoria RAM', 25, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(17, 'TeamGroup T-Force Delta RGB 16GB DDR5 6000', 'Memoria RAM RGB blanca', 69.99, 'https://extremetechcr.com/tienda/32528-large_default/teamgroup-t-force-delta-rgb-16gb-ddr5-6000-blanco.jpg', 'Memoria RAM', 18, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(18, 'G.Skill Trident Z5 RGB 24GB DDR5 6000', 'Memoria RAM DDR5 RGB', 109.99, 'https://extremetechcr.com/tienda/32551-large_default/gskill-trident-z5-rgb-24gb-ddr5-6000-cl40-negro.jpg', 'Memoria RAM', 12, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(19, 'Sapphire Pulse Radeon RX 6500XT 8GB', 'Tarjeta gráfica económica', 189.99, 'https://extremetechcr.com/tienda/37068-large_default/sapphire-pulse-radeon-rx-6500xt-pure-oc-8-gb.jpg', 'Tarjetas Gráficas', 9, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(20, 'XFX Radeon RX 7600 XT 16GB', 'Tarjeta gráfica de alto rendimiento', 399.99, 'https://extremetechcr.com/tienda/36130-large_default/xfx-amd-radeon-rx-7600-xt-swift-210-16gb.jpg', 'Tarjetas Gráficas', 7, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(21, 'Teclado T-Dagger Mustang T-TC700', 'Teclado mecánico verde', 34.99, 'https://extremetechcr.com/tienda/26556-large_default/t-dagger-mustang-t-tc700-br-verde.jpg', 'Teclados', 20, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(22, 'Silla Vertagear PL6800', 'Silla gamer Black/White', 249.99, 'https://extremetechcr.com/tienda/21693-large_default/vertagear-pl6800-blackwhite.jpg', 'Sillas', 5, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(23, 'Monitor Xiaomi A24i IPS 100Hz', 'Monitor IPS económico', 109.99, 'https://extremetechcr.com/tienda/36820-large_default/xiaomi-a24i-ips-100hz.jpg', 'Monitores', 14, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(24, 'Redragon OPAL V2 GM27X5QIPS 27\"', 'Monitor 2K 180Hz', 229.99, 'https://extremetechcr.com/tienda/37228-large_default/redragon-opal-v2-gm27x5qips-27-2k-180hz-ips.jpg', 'Monitores', 11, '2025-04-14 20:00:54', '2025-04-14 20:00:54'),
(25, 'Samsung Odyssey G4 27\"', 'Monitor 240Hz', 299.99, 'https://extremetechcr.com/tienda/37608-large_default/samsung-odyssey-g4-27-240hz.jpg', 'Monitores', 8, '2025-04-14 20:00:54', '2025-04-14 20:00:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `plan` varchar(20) NOT NULL,
  `fecha_suscripcion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `suscripciones`
--

INSERT INTO `suscripciones` (`id`, `nombre`, `correo`, `telefono`, `plan`, `fecha_suscripcion`) VALUES
(41, 'RR', 'retanajordy@gmail.com', '87138971', 'Demo', '2025-04-11 16:02:28'),
(42, 'RR', 'retanajordy@gmail.com', '87138971', 'Pro', '2025-04-11 16:04:57'),
(43, 'Linsday111', 'lindsaymendez75@gmail.com', '89091505', 'Pro', '2025-04-11 17:29:45'),
(44, 'JORDY', 'pocep97716@dpcos.com', '22', 'Pro', '2025-04-16 02:27:17'),
(45, 'Juan Jose Oviedo Chinchilla', 'oviedochjj@gmail.com', '63521854', 'Basic', '2025-04-16 17:28:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(2, 'Jordy', 'mobece1087@operades.com', '$2y$10$KDY1yayaO1rDKelH3BbtQO7QjGRSMsIBvPTy4nDqIwPjiiFoK3vqK', '2025-04-15 18:41:46'),
(3, 'Jordy', 'retanajordy@gmail.com', '$2y$10$ae0Y8wZTmuyfDfSlZ30iu.2vUg2oMH/fqlKCOLGl6GPWrprRIOKUu', '2025-04-15 18:42:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_dashboard`
--

CREATE TABLE `usuarios_dashboard` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_dashboard`
--

INSERT INTO `usuarios_dashboard` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(9, 'Admin', 'Admin', 'admin@proyecto.com', '$2y$10$p7LN4rp2LXA69geW4tq.5.LPn6EB1zn2kmgbFA7lTfIGPsu1cl1ji', '2025-04-11 23:31:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_pendientes`
--

CREATE TABLE `usuarios_pendientes` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','activado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_pendientes`
--

INSERT INTO `usuarios_pendientes` (`id`, `first_name`, `last_name`, `email`, `fecha_registro`, `estado`) VALUES
(1, 'Jordy', 'Retana', 'retanajordy@gmail.com', '2025-04-12 04:27:26', ''),
(2, 'Jordy', 'Retana', 'pocep97716@dpcos.com', '2025-04-16 08:27:55', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `producto_id`, `cantidad`, `precio_unitario`, `fecha`) VALUES
(6, 8, 1, 19.99, '2025-04-15 14:37:47'),
(7, 1, 1, 499.99, '2025-04-15 15:03:17'),
(8, 1, 1, 499.99, '2025-04-15 15:03:17'),
(9, 3, 1, 899.99, '2025-04-15 15:06:18'),
(10, 2, 2, 699.99, '2025-04-15 15:06:18'),
(11, 3, 1, 899.99, '2025-04-15 15:06:18'),
(12, 2, 2, 699.99, '2025-04-15 15:06:18'),
(13, 3, 1, 899.99, '2025-04-15 15:59:21'),
(14, 1, 1, 499.99, '2025-04-15 16:07:25'),
(15, 1, 1, 499.99, '2025-04-15 16:18:33'),
(16, 1, 1, 499.99, '2025-04-15 16:18:33'),
(17, 2, 1, 699.99, '2025-04-15 16:18:33'),
(18, 3, 1, 899.99, '2025-04-15 22:23:08'),
(19, 6, 1, 399.00, '2025-04-15 22:24:25'),
(20, 1, 1, 499.99, '2025-04-15 22:26:51'),
(21, 1, 1, 499.99, '2025-04-15 22:26:51'),
(22, 1, 1, 499.99, '2025-04-15 22:28:21'),
(23, 1, 1, 499.99, '2025-04-15 22:28:21'),
(24, 1, 1, 499.99, '2025-04-15 22:29:13'),
(25, 1, 1, 499.99, '2025-04-15 22:29:13'),
(28, 2, 1, 699.99, '2025-04-16 12:05:45'),
(29, 2, 1, 699.99, '2025-04-16 12:05:45'),
(30, 2, 1, 699.99, '2025-04-16 17:29:52'),
(31, 2, 1, 699.99, '2025-04-16 17:29:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes_contacto`
--
ALTER TABLE `mensajes_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios_dashboard`
--
ALTER TABLE `usuarios_dashboard`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios_pendientes`
--
ALTER TABLE `usuarios_pendientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes_contacto`
--
ALTER TABLE `mensajes_contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios_dashboard`
--
ALTER TABLE `usuarios_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios_pendientes`
--
ALTER TABLE `usuarios_pendientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
