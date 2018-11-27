-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2018 a las 18:55:56
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `somosmoa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva`
--

CREATE TABLE `iva` (
  `id` int(10) NOT NULL,
  `iva` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `iva`
--

INSERT INTO `iva` (`id`, `iva`) VALUES
(0, '16.50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cafe`
--

CREATE TABLE `tb_cafe` (
  `id` int(11) NOT NULL,
  `id_comanda` int(12) NOT NULL,
  `h_entrada` time NOT NULL,
  `h_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telf1` varchar(20) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Clientes';

--
-- Volcado de datos para la tabla `tb_clientes`
--

INSERT INTO `tb_clientes` (`id`, `nombres`, `apellidos`, `cedula`, `direccion`, `telf1`, `facebook`, `twitter`, `instagram`, `email`) VALUES
(1, 'Mireya ', 'Arellano de Contreras', '6326095', 'carr 22, cale 16 # 22-85', '+584241051197', '', '', '', 'pielcuidada@gmail.com'),
(2, 'Aarón', 'Contreras Arellano', '19153540', 'carrera 22 bo', '+58412468357', '', '', '', ''),
(5, 'Camilo', 'Contreras S.', '9412468', 'carr 22, cale 16 # 22-85', '+584141266763', '', '', '', ''),
(6, 'Angel', 'Contreras', '11204022', 'Barrio Obrero', '+584141266763', '', '', '', 'contreras.camilo@gmail.com'),
(10, 'Nuevo', 'Cliente', '1754354', '', '', '', '', '', ''),
(11, 'Nuevo', 'Cliente', '85467528', '', '', '', '', '', ''),
(12, 'Nuevo', 'Cliente', '995544', '', '', '', '', '', ''),
(13, 'Nuevo', 'Cliente', '998877', '', '', '', '', '', ''),
(14, '', '', '21218934', '', '', '', '', '', ''),
(15, '', '', '12345677', '', '', '', '', '', ''),
(16, '', '', '11223322', '', '', '', '', '', ''),
(17, '', '', '21002087', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cocina`
--

CREATE TABLE `tb_cocina` (
  `id` int(11) NOT NULL,
  `id_comanda` int(12) NOT NULL,
  `h_entrada` time NOT NULL,
  `h_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='recepcion y despacho de comandas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_comandas`
--

CREATE TABLE `tb_comandas` (
  `id` int(11) NOT NULL,
  `id_productos` varchar(50) NOT NULL,
  `ctd` varchar(50) NOT NULL,
  `id_usuario` int(4) NOT NULL,
  `id_mesa` int(4) NOT NULL,
  `id_cliente` int(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_cafe` int(1) NOT NULL,
  `status_cocina` int(1) NOT NULL,
  `obs_expressos` varchar(125) DEFAULT NULL,
  `obs_lattes` varchar(125) DEFAULT NULL,
  `obs_bfrias` varchar(125) DEFAULT NULL,
  `obs_energy` varchar(125) DEFAULT NULL,
  `obs_shake` varchar(125) DEFAULT NULL,
  `obs_fruits` varchar(125) DEFAULT NULL,
  `obs_paninis` varchar(125) DEFAULT NULL,
  `obs_salads` varchar(125) DEFAULT NULL,
  `obs_hotcakes` varchar(125) DEFAULT NULL,
  `obs_cakes` varchar(125) DEFAULT NULL,
  `obs_deserts` varchar(125) DEFAULT NULL,
  `h_pedido` time NOT NULL,
  `h_entrega` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pedidos de cada mesa';

--
-- Volcado de datos para la tabla `tb_comandas`
--

INSERT INTO `tb_comandas` (`id`, `id_productos`, `ctd`, `id_usuario`, `id_mesa`, `id_cliente`, `status`, `status_cafe`, `status_cocina`, `obs_expressos`, `obs_lattes`, `obs_bfrias`, `obs_energy`, `obs_shake`, `obs_fruits`, `obs_paninis`, `obs_salads`, `obs_hotcakes`, `obs_cakes`, `obs_deserts`, `h_pedido`, `h_entrega`) VALUES
(26, '1', '1', 2, 2, 85467528, 1, 2, 0, '', '', '', '', '', '', '', '', '', '', '', '12:52:20', '00:00:00'),
(27, '1,2,7', '4,3,1', 2, 4, 6326095, 1, 2, 0, '', '', '', '', '', '', '', '', '', '', '', '21:13:21', '00:00:00'),
(28, '1', '2', 2, 6, 12345677, 1, 2, 0, '', '', '', '', '', '', '', '', '', '', '', '21:16:37', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_facturacion`
--

CREATE TABLE `tb_facturacion` (
  `id` int(11) NOT NULL,
  `id_comanda` int(12) NOT NULL,
  `fecha` date NOT NULL,
  `sub_total` int(12) NOT NULL,
  `iva` int(2) NOT NULL,
  `total` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Facturación';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--

CREATE TABLE `tb_productos` (
  `id` int(11) NOT NULL,
  `grupo` varchar(10) NOT NULL,
  `area` varchar(10) NOT NULL,
  `id_iva` int(12) NOT NULL DEFAULT '1',
  `producto` varchar(50) NOT NULL,
  `base_imponible` decimal(12,2) NOT NULL,
  `iva` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_productos`
--

INSERT INTO `tb_productos` (`id`, `grupo`, `area`, `id_iva`, `producto`, `base_imponible`, `iva`, `total`) VALUES
(1, 'expresso', 'cafe', 1, 'ESPRESSO ', '0.00', '0.00', '0.00'),
(2, 'expresso', 'cafe', 1, 'RISTRETO ', '0.00', '0.00', '0.00'),
(3, 'expresso', 'cafe', 1, 'TRIPLE RISTRETO ', '0.00', '0.00', '0.00'),
(4, 'expresso', 'cafe', 1, 'LUNGO ', '0.00', '0.00', '0.00'),
(5, 'expresso', 'cafe', 1, 'DOPPIO RISTRETO ', '0.00', '0.00', '0.00'),
(6, 'expresso', 'cafe', 1, 'AMERICANO ', '0.00', '0.00', '0.00'),
(7, 'lattes', 'cafe', 1, 'LATTE ORANGE ', '0.00', '0.00', '0.00'),
(8, 'expresso', 'cafe', 1, 'ESPRESSO DE GUARANA ', '0.00', '0.00', '0.00'),
(9, 'lattes', 'cafe', 1, 'LATTE VAINILLA ', '0.00', '0.00', '0.00'),
(10, 'lattes', 'cafe', 1, 'LATTE CAPUCCINO ', '0.00', '0.00', '0.00'),
(11, 'lattes', 'cafe', 1, 'CAPUCCINO DOPPIO ', '0.00', '0.00', '0.00'),
(12, 'lattes', 'cafe', 1, 'MACHIATONE ', '0.00', '0.00', '0.00'),
(13, 'lattes', 'cafe', 1, 'MACHIATTO ', '0.00', '0.00', '0.00'),
(14, 'lattes', 'cafe', 1, 'MOCHA ', '0.00', '0.00', '0.00'),
(15, 'lattes', 'cafe', 1, 'BOMBOM', '0.00', '0.00', '0.00'),
(16, 'lattes', 'cafe', 1, 'CHOCOMILK ', '0.00', '0.00', '0.00'),
(17, 'energizant', 'cocina', 1, 'DETOX CLASIC ', '0.00', '0.00', '0.00'),
(18, 'energizant', 'cocina', 1, 'DETOX MOA ', '0.00', '0.00', '0.00'),
(19, 'energizant', 'cocina', 1, 'ENERGY MOA ', '0.00', '0.00', '0.00'),
(20, 'energizant', 'cocina', 1, 'ENERGY ORANGE ', '0.00', '0.00', '0.00'),
(21, 'energizant', 'cocina', 1, 'MOATON', '0.00', '0.00', '0.00'),
(22, 'energizant', 'cocina', 1, 'JENGIBRE LIMON ', '0.00', '0.00', '0.00'),
(23, 'energizant', 'cocina', 1, 'GUANABI MOA ', '0.00', '0.00', '0.00'),
(24, 'b_frias', 'cocina', 1, 'FRAPPE', '0.00', '0.00', '0.00'),
(25, 'b_frias', 'cocina', 1, 'FRAPUCCINO ', '0.00', '0.00', '0.00'),
(26, 'b_frias', 'cocina', 1, 'FRAPPU ESPECIAL ', '0.00', '0.00', '0.00'),
(27, 'b_frias', 'cocina', 1, 'ICE COCONUT ', '0.00', '0.00', '0.00'),
(28, 'b_frias', 'cocina', 1, 'ICE COFFE ', '0.00', '0.00', '0.00'),
(29, 'b_frias', 'cocina', 1, 'ICE ORANGE ', '0.00', '0.00', '0.00'),
(30, 'b_frias', 'cocina', 1, 'KOLITA MOA ', '0.00', '0.00', '0.00'),
(31, 'b_frias', 'cocina', 1, 'TE VERDE ', '0.00', '0.00', '0.00'),
(32, 'b_frias', 'cocina', 1, 'TIZANA ', '0.00', '0.00', '0.00'),
(33, 'tortas', 'cocina', 1, 'BROWNIE ', '0.00', '0.00', '0.00'),
(34, 'tortas', 'cocina', 1, 'BROWNIE MOA ', '0.00', '0.00', '0.00'),
(35, 'tortas', 'cocina', 1, 'TORTA DE CHOCOLATE ', '0.00', '0.00', '0.00'),
(36, 'tortas', 'cocina', 1, 'TORTA MICHI', '0.00', '0.00', '0.00'),
(37, 'tortas', 'cocina', 1, 'TORTA RED VELVET ', '0.00', '0.00', '0.00'),
(38, 'tortas', 'cocina', 1, 'TORTA VAINILLA ', '0.00', '0.00', '0.00'),
(39, 'tortas', 'cocina', 1, 'CHEES CAKE ', '0.00', '0.00', '0.00'),
(40, 'postres', 'cocina', 1, 'ICE BROWNIE ', '0.00', '0.00', '0.00'),
(41, 'postres', 'cocina', 1, 'ICE BROWNIE MOA ', '0.00', '0.00', '0.00'),
(42, 'postres', 'cocina', 1, 'ISLA DE CHOCOLATE ', '0.00', '0.00', '0.00'),
(43, 'postres', 'cocina', 1, 'ISLA TRES LECHES', '0.00', '0.00', '0.00'),
(44, 'postres', 'cocina', 1, 'PIE ', '0.00', '0.00', '0.00'),
(45, 'postres', 'cocina', 1, 'CHIPS MOA', '0.00', '0.00', '0.00'),
(46, 'postres', 'cocina', 1, 'PARFAIT ', '0.00', '0.00', '0.00'),
(47, 'postres', 'cocina', 1, 'PARFAIT TOGO', '0.00', '0.00', '0.00'),
(48, 'p_caliente', 'cocina', 1, 'PANQUECAS ', '0.00', '0.00', '0.00'),
(49, 'p_caliente', 'cocina', 1, 'WAFLE ', '0.00', '0.00', '0.00'),
(50, 'p_caliente', 'cocina', 1, 'CREPE ', '0.00', '0.00', '0.00'),
(51, 'panini', 'cocina', 1, 'AMERICANO ', '0.00', '0.00', '0.00'),
(52, 'panini', 'cocina', 1, 'CIABATTA MOA ', '0.00', '0.00', '0.00'),
(53, 'panini', 'cocina', 1, 'DESAYUNO AMERICANO ', '0.00', '0.00', '0.00'),
(54, 'panini', 'cocina', 1, 'MONTADITO DE ATUN', '0.00', '0.00', '0.00'),
(55, 'panini', 'cocina', 1, 'PANINI LOMO PORK ', '0.00', '0.00', '0.00'),
(56, 'panini', 'cocina', 1, 'ROAST BEEFS ', '0.00', '0.00', '0.00'),
(57, 'panini', 'cocina', 1, 'VEGANO ', '0.00', '0.00', '0.00'),
(58, 'ensaladas', 'cocina', 1, 'ENSALADA CESAR ', '0.00', '0.00', '0.00'),
(59, 'ensaladas', 'cocina', 1, 'ENSALADA DEL MAR', '0.00', '0.00', '0.00'),
(60, 'ensaladas', 'cocina', 1, 'ENSALADA MOA ', '0.00', '0.00', '0.00'),
(61, 'ensaladas', 'cocina', 1, 'GREEN SALAD ', '0.00', '0.00', '0.00'),
(62, 'm_frutas', 'cocina', 1, 'COCADA ', '0.00', '0.00', '0.00'),
(63, 'm_frutas', 'cocina', 1, 'COCADA ESPECIAL ', '0.00', '0.00', '0.00'),
(64, 'm_frutas', 'cocina', 1, 'MERENGADA FRUTA ', '0.00', '0.00', '0.00'),
(65, 'm_frutas', 'cocina', 1, 'MERENGADA FRUTA ESPECIAL ', '0.00', '0.00', '0.00'),
(66, 'merengadas', 'cocina', 1, 'HELADO ', '0.00', '0.00', '0.00'),
(67, 'merengadas', 'cocina', 1, 'CHOCO ESPECIAL ', '0.00', '0.00', '0.00'),
(68, 'merengadas', 'cocina', 1, 'CHOCO/OREO ', '0.00', '0.00', '0.00'),
(69, 'merengadas', 'cocina', 1, 'MILK SHAKE ', '0.00', '0.00', '0.00'),
(70, 'merengadas', 'cocina', 1, ' PIE ', '0.00', '0.00', '0.00'),
(71, 'merengadas', 'cocina', 1, 'PIE ESPECIAL ', '0.00', '0.00', '0.00'),
(72, 'merengadas', 'cocina', 1, 'SAMBA ', '0.00', '0.00', '0.00'),
(73, 'merengadas', 'cocina', 1, 'M.S. ESPECIAL', '0.00', '0.00', '0.00'),
(74, 'merengadas', 'cocina', 1, 'SAMBA ESPECIAL ', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_rol`
--

CREATE TABLE `tb_rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_rol`
--

INSERT INTO `tb_rol` (`id`, `descripcion`) VALUES
(1, 'Admin'),
(2, 'Caja'),
(3, 'Mesa'),
(4, 'Cafe'),
(5, 'Cocina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `id_rol` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(12) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `direccion` varchar(125) NOT NULL,
  `telf1` varchar(20) NOT NULL,
  `telf2` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `f_ingreso` date NOT NULL,
  `f_egreso` date DEFAULT NULL,
  `authKey` varchar(50) NOT NULL,
  `accessToken` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Usuarios y empleados';

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `id_rol`, `username`, `password`, `nombres`, `apellidos`, `cedula`, `direccion`, `telf1`, `telf2`, `email`, `facebook`, `twitter`, `instagram`, `f_ingreso`, `f_egreso`, `authKey`, `accessToken`) VALUES
(1, 1, 'Admin', '123456', 'Admin', 'Administrador@', '9412468', 'carr 22, cale 16 # 22-85', '+58123123467', '+58123123467', 'contreras.camilo@gmail.com', 'fff', 'ttt', 'iii', '2018-09-05', '2018-09-05', '', ''),
(2, 3, 'Mesas', '123456', 'Mesa', 'Meserer@', '94124682', 'carr 22, cale 16 # 22-85, Barrio Obrero2', '+581231234672', '+581231234672', 'contreras.camilo@gmail.com2', 'fff2', 'ttt2', 'iii2', '2018-09-06', '2018-09-06', '', ''),
(3, 4, 'Cafe', '123456', 'Cafe', 'Lattes@', '94124683', 'carr 22, cale 16 # 22-85', '+58123123467', '+581231234672', 'pielcuidada@gmail.com', 'fff', 'ttt', 'iii', '2018-09-15', '2018-09-15', '', ''),
(4, 5, 'Cocina', '123456', 'Cocina', 'Paninis@', '123456789', 'MCO:85316 2250NW 114th Ave', '+58123123467', '', '', '', '', '', '2018-09-18', NULL, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `iva`
--
ALTER TABLE `iva`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_cafe`
--
ALTER TABLE `tb_cafe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_comanda` (`id_comanda`);

--
-- Indices de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_cocina`
--
ALTER TABLE `tb_cocina`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_comanda` (`id_comanda`);

--
-- Indices de la tabla `tb_comandas`
--
ALTER TABLE `tb_comandas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_facturacion`
--
ALTER TABLE `tb_facturacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_comanda` (`id_comanda`);

--
-- Indices de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_iva` (`id_iva`),
  ADD KEY `id` (`id`),
  ADD KEY `id_iva_2` (`id_iva`);

--
-- Indices de la tabla `tb_rol`
--
ALTER TABLE `tb_rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tb_cafe`
--
ALTER TABLE `tb_cafe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tb_cocina`
--
ALTER TABLE `tb_cocina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_comandas`
--
ALTER TABLE `tb_comandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tb_facturacion`
--
ALTER TABLE `tb_facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `tb_rol`
--
ALTER TABLE `tb_rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_cafe`
--
ALTER TABLE `tb_cafe`
  ADD CONSTRAINT `tb_cafe_ibfk_1` FOREIGN KEY (`id_comanda`) REFERENCES `tb_comandas` (`id`);

--
-- Filtros para la tabla `tb_cocina`
--
ALTER TABLE `tb_cocina`
  ADD CONSTRAINT `tb_cocina_ibfk_1` FOREIGN KEY (`id_comanda`) REFERENCES `tb_comandas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
