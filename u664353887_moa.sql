-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-09-2018 a las 22:42:47
-- Versión del servidor: 10.2.17-MariaDB
-- Versión de PHP: 7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u664353887_moa`
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
(5, 'Camilo', 'Contreras S.', '9412468', 'carr 22, cale 16 # 22-85', '+584141266763', '', '', '', '');

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
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pedidos de cada mesa';

--
-- Volcado de datos para la tabla `tb_comandas`
--

INSERT INTO `tb_comandas` (`id`, `id_productos`, `ctd`, `id_usuario`, `id_mesa`, `id_cliente`, `status`) VALUES
(1, '22', '3', 2, 1, 19153540, 0),
(2, '17,26,27', '1,1,1', 2, 2, 6326095, 0),
(15, '18,22,31', '1,1,1', 2, 3, 9412468, 0);

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
  `id_iva` int(12) NOT NULL DEFAULT 1,
  `producto` varchar(50) NOT NULL,
  `base_imponible` decimal(12,2) NOT NULL,
  `iva` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_productos`
--

INSERT INTO `tb_productos` (`id`, `grupo`, `area`, `id_iva`, `producto`, `base_imponible`, `iva`, `total`) VALUES
(1, 'energizant', 'cocina', 1, 'DETOX CLASIC ', '0.00', '0.00', '0.00'),
(2, 'energizant', 'cocina', 1, 'DETOX MOA ', '0.00', '0.00', '0.00'),
(3, 'energizant', 'cocina', 1, 'ENERGY MOA ', '0.00', '0.00', '0.00'),
(4, 'energizant', 'cocina', 1, 'ENERGY ORANGE ', '0.00', '0.00', '0.00'),
(5, 'energizant', 'cocina', 1, 'MOATON', '0.00', '0.00', '0.00'),
(6, 'energizant', 'cocina', 1, 'JENGIBRE LIMON ', '0.00', '0.00', '0.00'),
(7, 'energizant', 'cocina', 1, 'GUANABI MOA ', '0.00', '0.00', '0.00'),
(8, 'b_frias', 'cocina', 1, 'FRAPPE', '0.00', '0.00', '0.00'),
(9, 'b_frias', 'cocina', 1, 'FRAPUCCINO ', '0.00', '0.00', '0.00'),
(10, 'b_frias', 'cocina', 1, 'FRAPPU ESPECIAL ', '0.00', '0.00', '0.00'),
(11, 'b_frias', 'cocina', 1, 'ICE COCONUT ', '0.00', '0.00', '0.00'),
(12, 'b_frias', 'cocina', 1, 'ICE COFFE ', '0.00', '0.00', '0.00'),
(13, 'b_frias', 'cocina', 1, 'ICE ORANGE ', '0.00', '0.00', '0.00'),
(14, 'b_frias', 'cocina', 1, 'KOLITA MOA ', '0.00', '0.00', '0.00'),
(15, 'b_frias', 'cocina', 1, 'TE VERDE ', '0.00', '0.00', '0.00'),
(16, 'b_frias', 'cocina', 1, 'TIZANA ', '0.00', '0.00', '0.00'),
(17, 'expresso', 'cafe', 1, 'ESPRESSO ', '0.00', '0.00', '0.00'),
(18, 'expresso', 'cafe', 1, 'RISTRETO ', '0.00', '0.00', '0.00'),
(19, 'expresso', 'cafe', 1, 'TRIPLE RISTRETO ', '0.00', '0.00', '0.00'),
(20, 'expresso', 'cafe', 1, 'LUNGO ', '0.00', '0.00', '0.00'),
(21, 'expresso', 'cafe', 1, 'DOPPIO RISTRETO ', '0.00', '0.00', '0.00'),
(22, 'expresso', 'cafe', 1, 'AMERICANO ', '0.00', '0.00', '0.00'),
(23, 'lattes', 'cafe', 1, 'LATTE ORANGE ', '0.00', '0.00', '0.00'),
(24, 'expresso', 'cafe', 1, 'ESPRESSO DE GUARANA ', '0.00', '0.00', '0.00'),
(25, 'lattes', 'cafe', 1, 'LATTE VAINILLA ', '0.00', '0.00', '0.00'),
(26, 'lattes', 'cafe', 1, 'LATTE CAPUCCINO ', '0.00', '0.00', '0.00'),
(27, 'lattes', 'cafe', 1, 'CAPUCCINO DOPPIO ', '0.00', '0.00', '0.00'),
(28, 'lattes', 'cafe', 1, 'MACHIATONE ', '0.00', '0.00', '0.00'),
(29, 'lattes', 'cafe', 1, 'MACHIATTO ', '0.00', '0.00', '0.00'),
(30, 'lattes', 'cafe', 1, 'MOCHA ', '0.00', '0.00', '0.00'),
(31, 'lattes', 'cafe', 1, 'BOMBOM', '0.00', '0.00', '0.00'),
(32, 'lattes', 'cafe', 1, 'CHOCOMILK ', '0.00', '0.00', '0.00'),
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
  `f_egreso` date NOT NULL,
  `authKey` varchar(50) NOT NULL,
  `accessToken` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Usuarios y empleados';

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `id_rol`, `username`, `password`, `nombres`, `apellidos`, `cedula`, `direccion`, `telf1`, `telf2`, `email`, `facebook`, `twitter`, `instagram`, `f_ingreso`, `f_egreso`, `authKey`, `accessToken`) VALUES
(1, 1, 'camilo', '123456', 'Camilo', 'Contreras S.', '9412468', 'carr 22, cale 16 # 22-85', '+58123123467', '+58123123467', 'contreras.camilo@gmail.com', 'fff', 'ttt', 'iii', '2018-09-05', '2018-09-05', '', ''),
(2, 3, 'camilo2', '123456', 'Camilo2', 'Contreras S2', '94124682', 'carr 22, cale 16 # 22-85, Barrio Obrero2', '+581231234672', '+581231234672', 'contreras.camilo@gmail.com2', 'fff2', 'ttt2', 'iii2', '2018-09-06', '2018-09-06', '', ''),
(3, 4, 'camilo3', '123456', 'Camilo', 'Contreras S.', '94124683', 'carr 22, cale 16 # 22-85', '+58123123467', '+581231234672', 'pielcuidada@gmail.com', 'fff', 'ttt', 'iii', '2018-09-15', '2018-09-15', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_cocina`
--
ALTER TABLE `tb_cocina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_comandas`
--
ALTER TABLE `tb_comandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
