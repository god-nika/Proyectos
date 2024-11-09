-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2024 a las 23:03:25
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
-- Base de datos: `ejemplo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_Categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_Categoria`, `nombre`) VALUES
(5, 'Comestible'),
(6, 'Bebida No Alcohólica'),
(7, 'Bebida Alcohólica'),
(8, 'Equipo de Juego');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicios`
--

CREATE TABLE `detalle_servicios` (
  `id_Detalle_Servicios` int(11) NOT NULL,
  `Valor_Productos` int(11) NOT NULL,
  `Valor_Servicios` int(11) NOT NULL,
  `Valor_Total` int(11) NOT NULL,
  `id_producto_categoria` int(11) NOT NULL,
  `id_User_Rol` int(11) NOT NULL,
  `id_Servicios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_Equipo` int(11) NOT NULL,
  `Nombre` varchar(250) DEFAULT NULL,
  `Cantidad` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_tipoju`
--

CREATE TABLE `equipo_tipoju` (
  `id_Equipo_TipoJu` int(11) NOT NULL,
  `id_Tipo_Juego` int(11) NOT NULL,
  `id_Equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `Nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'De baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `id_Facturacion` int(11) NOT NULL,
  `id_Detalle_Servicios` int(11) NOT NULL,
  `id_Metodo_Pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id_Juegos` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL,
  `Fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `Time_Jugado` time NOT NULL,
  `valor` int(11) NOT NULL,
  `id_Equipo_TipoJu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id_Mesas` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Estado` varchar(250) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_Metodo_Pago` int(11) NOT NULL,
  `Nombre` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_stock`
--

CREATE TABLE `movimientos_stock` (
  `id_movimiento` int(11) NOT NULL,
  `cantidad_Ingresada` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_Producto` int(11) DEFAULT NULL,
  `cantidad_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos_stock`
--

INSERT INTO `movimientos_stock` (`id_movimiento`, `cantidad_Ingresada`, `fecha`, `id_Producto`, `cantidad_total`) VALUES
(2, 43, '2024-10-26 19:46:24', 5, 48),
(3, 14, '2024-10-26 19:48:19', 19, 16),
(4, 3, '2024-10-26 19:49:10', 5, 51),
(5, 4, '2024-10-26 19:50:02', 21, 10),
(6, 5, '2024-10-26 19:50:45', 22, 13),
(7, 14, '2024-10-26 19:51:34', 23, 18),
(8, 4, '2024-10-27 02:00:53', 19, 20),
(9, 8, '2024-10-27 02:03:31', 21, 18),
(10, 7, '2024-10-27 02:03:48', 22, 20),
(11, 2, '2024-10-27 02:04:00', 23, 20),
(12, 7, '2024-10-27 02:05:16', 5, 58),
(13, 7, '2024-10-27 02:22:41', 19, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_Persona` int(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `apellidos` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `Cedula` bigint(20) NOT NULL,
  `Telefono` bigint(20) NOT NULL,
  `Direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_Persona`, `nombres`, `apellidos`, `correo`, `Cedula`, `Telefono`, `Direccion`) VALUES
(1, 'Meily', 'Aguilar', 'johan@gmail.com', 33237627672, 32346273, 'Cra 12 # 11-54'),
(2, 'Emi', 'Perez', 'emi@cliente.com', 1236437643, 342536452, 'Cra 65 # 6-23'),
(3, 'Oscar', 'Suarez', 'Oscar@admin.com', 1237127362, 213647273, 'Cra 8 # 12-87'),
(19, 'Johan', 'Gil', 'gilghost@gmail.com', 1058198012, 3134709801, 'Cra 8 # 12-34'),
(22, 'Jerlan', 'Gil', 'JohanGilo144@gmail.com', 1058198012, 3134709801, 'Cra 54 # 23-54'),
(23, 'Johan', 'Espitia', 'Espi@gmail.com', 88240974, 314875745, 'Cra 76 # 09-12'),
(24, 'Valentina', 'Osorio', 'Valen@gmail.com', 25478454521, 3254789546, 'Cra 54 # 65-12'),
(25, 'Pedraza', 'Nidea', 'Pepa@gmail.com', 212154545454, 32154845, 'Cra 4 # 32-65'),
(26, 'Nose', 'Nose', 'Nose@gmail.com', 32416362365, 123456789, 'Cra 5 # 12-76'),
(27, 'sise', 'sise', 'sise@gmail.com', 124532536524, 3235434421, 'Cra 8 # 32-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_Productos` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `detalles` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_Productos`, `nombre`, `precio`, `cantidad`, `detalles`) VALUES
(5, 'Cerveza', 3000, 58, 'Aguila'),
(19, 'Snack', 2500, 27, 'Nose'),
(21, 'Jugo', 2000, 18, 'Hit'),
(22, 'Gaseosa', 6000, 20, 'Pepsi'),
(23, 'Salchichon', 3000, 20, 'Zenu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_categoria`
--

CREATE TABLE `producto_categoria` (
  `id_producto_categoria` int(11) NOT NULL,
  `id_Categoria` int(11) NOT NULL,
  `id_Productos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_categoria`
--

INSERT INTO `producto_categoria` (`id_producto_categoria`, `id_Categoria`, `id_Productos`) VALUES
(5, 7, 5),
(19, 5, 19),
(21, 6, 21),
(22, 5, 22),
(23, 5, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_Rol` int(11) NOT NULL,
  `rol` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_Rol`, `rol`) VALUES
(1, 'Cliente'),
(2, 'Vendedor'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_Servicios` int(11) NOT NULL,
  `id_Juegos` int(11) NOT NULL,
  `id_Mesas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_juego`
--

CREATE TABLE `tipo_juego` (
  `id_Tipo_Juego` int(11) NOT NULL,
  `Categoria` varchar(250) NOT NULL,
  `Tarifa_Hora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_juego`
--

INSERT INTO `tipo_juego` (`id_Tipo_Juego`, `Categoria`, `Tarifa_Hora`) VALUES
(1, 'Nose', 2000),
(2, 'Mause', 12000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_rol`
--

CREATE TABLE `user_rol` (
  `id_User_Rol` int(11) NOT NULL,
  `Contraseña` varchar(250) NOT NULL,
  `id_Persona` int(11) NOT NULL,
  `id_Rol` int(11) NOT NULL,
  `id_estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_rol`
--

INSERT INTO `user_rol` (`id_User_Rol`, `Contraseña`, `id_Persona`, `id_Rol`, `id_estado`) VALUES
(2, 'Johan12345', 1, 1, 1),
(3, 'Emi1203', 2, 2, 1),
(4, 'Oscar0708', 3, 3, 1),
(20, '88240974', 19, 3, 1),
(23, 'Johan1703', 22, 3, 1),
(24, 'Espi09', 23, 2, 1),
(25, 'Valen12', 24, 1, 1),
(26, 'Pepe', 25, 2, 1),
(27, 'Nosse', 26, 2, 1),
(28, 'Sise', 27, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_Categoria`);

--
-- Indices de la tabla `detalle_servicios`
--
ALTER TABLE `detalle_servicios`
  ADD PRIMARY KEY (`id_Detalle_Servicios`),
  ADD KEY `id_producto_categoria` (`id_producto_categoria`),
  ADD KEY `id_User_Rol` (`id_User_Rol`),
  ADD KEY `id_Servicios` (`id_Servicios`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_Equipo`);

--
-- Indices de la tabla `equipo_tipoju`
--
ALTER TABLE `equipo_tipoju`
  ADD PRIMARY KEY (`id_Equipo_TipoJu`),
  ADD KEY `id_Tipo_Juego` (`id_Tipo_Juego`),
  ADD KEY `id_Equipo` (`id_Equipo`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`id_Facturacion`),
  ADD KEY `id_Detalle_Servicios` (`id_Detalle_Servicios`),
  ADD KEY `id_Metodo_Pago` (`id_Metodo_Pago`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_Juegos`),
  ADD KEY `id_Equipo_TipoJu` (`id_Equipo_TipoJu`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id_Mesas`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id_Metodo_Pago`);

--
-- Indices de la tabla `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `id_Producto` (`id_Producto`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_Persona`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_Productos`);

--
-- Indices de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  ADD PRIMARY KEY (`id_producto_categoria`),
  ADD KEY `id_Categoria` (`id_Categoria`),
  ADD KEY `id_Productos` (`id_Productos`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_Rol`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_Servicios`),
  ADD KEY `id_Juegos` (`id_Juegos`),
  ADD KEY `id_Mesas` (`id_Mesas`);

--
-- Indices de la tabla `tipo_juego`
--
ALTER TABLE `tipo_juego`
  ADD PRIMARY KEY (`id_Tipo_Juego`);

--
-- Indices de la tabla `user_rol`
--
ALTER TABLE `user_rol`
  ADD PRIMARY KEY (`id_User_Rol`),
  ADD KEY `id_Persona` (`id_Persona`),
  ADD KEY `id_Rol` (`id_Rol`),
  ADD KEY `fk_estado` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_servicios`
--
ALTER TABLE `detalle_servicios`
  MODIFY `id_Detalle_Servicios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id_Equipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo_tipoju`
--
ALTER TABLE `equipo_tipoju`
  MODIFY `id_Equipo_TipoJu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `id_Facturacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_Juegos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_Mesas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_Metodo_Pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_Persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_Productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  MODIFY `id_producto_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_Servicios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_juego`
--
ALTER TABLE `tipo_juego`
  MODIFY `id_Tipo_Juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_rol`
--
ALTER TABLE `user_rol`
  MODIFY `id_User_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_servicios`
--
ALTER TABLE `detalle_servicios`
  ADD CONSTRAINT `detalle_servicios_ibfk_1` FOREIGN KEY (`id_producto_categoria`) REFERENCES `producto_categoria` (`id_producto_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_servicios_ibfk_2` FOREIGN KEY (`id_User_Rol`) REFERENCES `user_rol` (`id_User_Rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_servicios_ibfk_3` FOREIGN KEY (`id_Servicios`) REFERENCES `servicios` (`id_Servicios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipo_tipoju`
--
ALTER TABLE `equipo_tipoju`
  ADD CONSTRAINT `equipo_tipoju_ibfk_1` FOREIGN KEY (`id_Tipo_Juego`) REFERENCES `tipo_juego` (`id_Tipo_Juego`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipo_tipoju_ibfk_2` FOREIGN KEY (`id_Equipo`) REFERENCES `equipo` (`id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`id_Detalle_Servicios`) REFERENCES `detalle_servicios` (`id_Detalle_Servicios`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacion_ibfk_2` FOREIGN KEY (`id_Metodo_Pago`) REFERENCES `metodo_pago` (`id_Metodo_Pago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`id_Equipo_TipoJu`) REFERENCES `equipo_tipoju` (`id_Equipo_TipoJu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  ADD CONSTRAINT `movimientos_stock_ibfk_1` FOREIGN KEY (`id_Producto`) REFERENCES `productos` (`id_Productos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  ADD CONSTRAINT `producto_categoria_ibfk_1` FOREIGN KEY (`id_Categoria`) REFERENCES `categorias` (`id_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_categoria_ibfk_2` FOREIGN KEY (`id_Productos`) REFERENCES `productos` (`id_Productos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_Juegos`) REFERENCES `juegos` (`id_Juegos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`id_Mesas`) REFERENCES `mesas` (`id_Mesas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_rol`
--
ALTER TABLE `user_rol`
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `user_rol_ibfk_1` FOREIGN KEY (`id_Persona`) REFERENCES `persona` (`id_Persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rol_ibfk_2` FOREIGN KEY (`id_Rol`) REFERENCES `rol` (`id_Rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
