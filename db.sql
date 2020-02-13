
-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 10.2.1.123
-- Tiempo de generación: 25-04-2018 a las 23:27:30
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u630310491_a`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `nombreAdmin` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` varchar(1) NOT NULL,
  `fechaCreado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`idAdmin`, `nombreAdmin`, `password`, `rol`, `fechaCreado`) VALUES
(1, 'admin', '123456', 'A', '2018-03-06 16:13:21'),
(12, 'fdgf', 'xxxxxxxxxxxxxx', 'U', '2018-04-18 23:16:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(110) NOT NULL,
  `nombreCliente` varchar(100) NOT NULL,
  `telefonoCliente` varchar(100) NOT NULL,
  `direccionCliente` varchar(100) NOT NULL,
  `estadoCliente` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombreCliente`, `telefonoCliente`, `direccionCliente`, `estadoCliente`) VALUES
(3, 'diego pennisi', '3412596553', 'provincias unidas 921bis', 1),
(4, 'bianca aniduzzi', '3413693019', 'salta 1234', 1),
(5, 'tomas pennisi', '4569879', 'corrientes 835', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuarteo`
--

CREATE TABLE `cuarteo` (
  `idCuarteo` int(255) NOT NULL,
  `kiloMedia` float NOT NULL,
  `nroTropa` text NOT NULL,
  `idInventario` int(255) NOT NULL,
  `estadoCuarteo` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuarteo`
--

INSERT INTO `cuarteo` (`idCuarteo`, `kiloMedia`, `nroTropa`, `idInventario`, `estadoCuarteo`) VALUES
(1, 97, '45605', 3, 0),
(5, 91, '45698', 16, 0),
(6, 100, '45697', 15, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuarteoinventario`
--

CREATE TABLE `cuarteoinventario` (
  `idCuarteoInventario` int(255) NOT NULL,
  `pecho` varchar(50) DEFAULT NULL,
  `mocho` text,
  `parrillero` text,
  `completos` text,
  `largos` text,
  `bifes` text,
  `asado` text,
  `totalPeso` float NOT NULL,
  `cantidad` int(1) NOT NULL,
  `idCuarteo` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuarteoinventario`
--

INSERT INTO `cuarteoinventario` (`idCuarteoInventario`, `pecho`, `mocho`, `parrillero`, `completos`, `largos`, `bifes`, `asado`, `totalPeso`, `cantidad`, `idCuarteo`) VALUES
(1, '27', '0', '32', '0', '0', '0', '0', 94, 2, 1),
(2, '28', '33', '0', '0', '28', '0', '0', 89, 3, 5),
(5, '30', '30', '35', '0', '0', '0', '0', 95, 3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentacorriente`
--

CREATE TABLE `cuentacorriente` (
  `idCuentaCorriente` int(11) NOT NULL,
  `comprobante` text NOT NULL,
  `entrada` float DEFAULT NULL,
  `pagos` float DEFAULT NULL,
  `saldo` float NOT NULL DEFAULT '0',
  `idCliente` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `idVendedor` int(255) DEFAULT NULL,
  `nroFactura` int(255) DEFAULT NULL,
  `nroNotaCredito` int(255) DEFAULT NULL,
  `nroNotaDebito` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuentacorriente`
--

INSERT INTO `cuentacorriente` (`idCuentaCorriente`, `comprobante`, `entrada`, `pagos`, `saldo`, `idCliente`, `fecha`, `idVendedor`, `nroFactura`, `nroNotaCredito`, `nroNotaDebito`) VALUES
(3, 'Factura 3', 8000, NULL, 13000, 3, '2018-04-19', NULL, 3, NULL, NULL),
(4, 'Factura 4', 2870, NULL, 4870, 4, '2018-04-19', NULL, 4, NULL, NULL),
(5, 'Nota de Crédito 1', NULL, 567, 4303, 4, '2018-04-19', NULL, NULL, 1, NULL),
(6, 'Nota de Débito 1', 100, NULL, 4403, 4, '2018-04-19', NULL, NULL, NULL, 1),
(7, 'recibo 1', NULL, 1500, 11500, 3, '2018-04-19', 1, NULL, NULL, NULL),
(8, 'recibo 13', NULL, 1000, 9000, 5, '2018-04-19', 2, NULL, NULL, NULL),
(9, 'Factura 5', 8000, NULL, 17000, 5, '2018-04-19', NULL, 5, NULL, NULL),
(10, 'Nota de Crédito 2', NULL, 200, 16800, 5, '2018-04-23', NULL, NULL, 2, NULL),
(11, 'recibo 32', NULL, 1500, 15300, 5, '2018-04-23', 1, NULL, NULL, NULL),
(12, 'Nota de Débito 2', 1500, NULL, 16800, 5, '2018-04-23', NULL, NULL, NULL, 2),
(13, 'Nota de Débito 3', 1000, NULL, 12500, 3, '2018-04-23', NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `idDetalle` int(255) NOT NULL,
  `kilo` int(255) NOT NULL,
  `nroTropa` text,
  `descripcion` varchar(50) NOT NULL,
  `cantidad` int(1) NOT NULL,
  `precio` float NOT NULL,
  `fecha` date DEFAULT NULL,
  `nroFactura` text NOT NULL,
  `idInventario` int(255) DEFAULT NULL,
  `idCuarteo` int(255) DEFAULT NULL,
  `idCliente` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`idDetalle`, `kilo`, `nroTropa`, `descripcion`, `cantidad`, `precio`, `fecha`, `nroFactura`, `idInventario`, `idCuarteo`, `idCliente`) VALUES
(4, 100, '45698', 'Media Res', 1, 80, '2018-04-19', '3', 2, NULL, 3),
(5, 35, NULL, 'mocho', 1, 82, '2018-04-19', '4', NULL, 1, 4),
(6, 100, '45698', 'Media Res', 1, 80, '2018-04-20', '5', 1, NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturado`
--

CREATE TABLE `facturado` (
  `idFacturado` int(255) NOT NULL,
  `nroFactura` text NOT NULL,
  `fecha` date DEFAULT NULL,
  `idCliente` int(255) NOT NULL,
  `totalVenta` float NOT NULL,
  `idAdmin` int(255) DEFAULT NULL,
  `estado` int(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facturado`
--

INSERT INTO `facturado` (`idFacturado`, `nroFactura`, `fecha`, `idCliente`, `totalVenta`, `idAdmin`, `estado`) VALUES
(3, '3', '2018-04-19', 3, 8000, 1, 1),
(4, '4', '2018-04-19', 4, 2870, 1, 1),
(5, '5', '2018-04-19', 5, 8000, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idFactura` int(255) NOT NULL,
  `estado` int(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idFactura`, `estado`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(255) NOT NULL,
  `kiloMedia` float NOT NULL,
  `nroTropa` text NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `estado` varchar(50) DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idInventario`, `kiloMedia`, `nroTropa`, `cantidad`, `estado`) VALUES
(1, 100, '45698', 0, 'Vendida'),
(2, 100, '45698', 0, 'Vendida'),
(3, 97, '45605', 0, 'Cuarteo'),
(4, 100, '45605', 1, 'Disponible'),
(5, 87, '45605', 1, 'Disponible'),
(6, 98, '45697', 1, 'Disponible'),
(7, 88, '45697', 1, 'Disponible'),
(8, 78, '45697', 1, 'Disponible'),
(9, 77, '45697', 1, 'Disponible'),
(10, 75, '45697', 1, 'Disponible'),
(11, 72, '45697', 1, 'Disponible'),
(12, 90, '45697', 1, 'Disponible'),
(13, 77, '45697', 1, 'Disponible'),
(14, 98, '45697', 1, 'Disponible'),
(15, 100, '45697 ', 0, 'Cuarteo'),
(16, 91, '45698', 0, 'Cuarteo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notacredito`
--

CREATE TABLE `notacredito` (
  `idNotaCredito` int(255) NOT NULL,
  `descripcionCredito` text NOT NULL,
  `cantidadCredito` text NOT NULL,
  `importeCredito` text NOT NULL,
  `totalCredito` text NOT NULL,
  `idCliente` int(255) NOT NULL,
  `fechaCredito` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notacredito`
--

INSERT INTO `notacredito` (`idNotaCredito`, `descripcionCredito`, `cantidadCredito`, `importeCredito`, `totalCredito`, `idCliente`, `fechaCredito`) VALUES
(1, 'descuento por grasa', '7', '81', '567', 4, '2018-04-19 18:54:48'),
(2, 'descuento por grasa', '10', '20', '200', 5, '2018-04-23 21:25:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notadebito`
--

CREATE TABLE `notadebito` (
  `idNotaDebito` int(255) NOT NULL,
  `descripcionDebito` text NOT NULL,
  `cantidadDebito` text NOT NULL,
  `importeDebito` text NOT NULL,
  `totalDebito` text NOT NULL,
  `nroCheque` text,
  `idCliente` int(255) NOT NULL,
  `fechaDebito` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notadebito`
--

INSERT INTO `notadebito` (`idNotaDebito`, `descripcionDebito`, `cantidadDebito`, `importeDebito`, `totalDebito`, `nroCheque`, `idCliente`, `fechaDebito`) VALUES
(1, 'mal facturado', '1', '100', '100', NULL, 4, '2018-04-19 18:57:14'),
(2, 'cheque rechazadi por falta de fondos', '1', '1500', '1500', '78956', 5, '2018-04-23 21:33:02'),
(3, 'mal facturado', '1', '1000', '1000', NULL, 3, '2018-04-23 21:33:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPagos` int(255) NOT NULL,
  `idCliente` int(255) NOT NULL,
  `comprobante` text NOT NULL,
  `monto` float NOT NULL,
  `efectivo` varchar(50) DEFAULT NULL,
  `cheque` varchar(50) DEFAULT NULL,
  `nroCheque` varchar(50) DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `propietario` varchar(50) DEFAULT NULL,
  `fechaPago` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idVendedor` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idPagos`, `idCliente`, `comprobante`, `monto`, `efectivo`, `cheque`, `nroCheque`, `banco`, `propietario`, `fechaPago`, `idVendedor`) VALUES
(1, 3, 'recibo 1', 1500, '1500', '', '', '', '', '2018-04-20 00:09:35', 1),
(2, 5, 'recibo 13', 1000, '1000', '', '', '', '', '2018-04-20 00:14:34', 2),
(3, 5, 'recibo 32', 1500, '', '1500', '78956', 'santander rio', 'jose luis rodriguez', '2018-04-23 21:29:35', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProductos` int(255) NOT NULL,
  `dueHacienda` varchar(100) NOT NULL,
  `cantCabeza` int(110) NOT NULL,
  `cantMedia` int(110) NOT NULL,
  `fechaFaena` date NOT NULL,
  `cantKilos` float NOT NULL,
  `nroTropa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `dueHacienda`, `cantCabeza`, `cantMedia`, `fechaFaena`, `cantKilos`, `nroTropa`) VALUES
(2, 'jajaj', 10, 20, '2018-04-18', 1800, '45605'),
(3, 'jacinto herrera', 5, 10, '2018-04-19', 1850, '45698'),
(4, 'pedro alfonso', 5, 10, '2018-04-23', 20000, '45697');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldos`
--

CREATE TABLE `saldos` (
  `idSaldos` int(255) NOT NULL,
  `idCliente` int(255) NOT NULL,
  `saldoInicial` float NOT NULL,
  `saldoActual` float NOT NULL DEFAULT '0',
  `saldoFinal` float NOT NULL DEFAULT '0',
  `idVendedor` int(255) NOT NULL DEFAULT '0',
  `fechaSaldo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `saldos`
--

INSERT INTO `saldos` (`idSaldos`, `idCliente`, `saldoInicial`, `saldoActual`, `saldoFinal`, `idVendedor`, `fechaSaldo`) VALUES
(2, 3, 5000, 12500, 12500, 1, '2018-04-19 18:34:45'),
(3, 4, 2000, 4403, 4403, 1, '2018-04-19 18:51:54'),
(4, 5, 10000, 16800, 16800, 1, '2018-04-20 00:12:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp`
--

CREATE TABLE `temp` (
  `idTemp` int(255) NOT NULL,
  `kiloMedia` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precioMedia` float NOT NULL,
  `fechaVenta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nroFactura` text NOT NULL,
  `id` int(255) NOT NULL,
  `idCliente` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tempmedia`
--

CREATE TABLE `tempmedia` (
  `idTempMedia` int(255) NOT NULL,
  `kilo` int(255) NOT NULL,
  `nroTropa` text NOT NULL,
  `descripcionMedia` varchar(50) NOT NULL DEFAULT 'Media Res',
  `cantidad` int(1) NOT NULL DEFAULT '1',
  `precio` float NOT NULL DEFAULT '1',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nroFactura` text NOT NULL,
  `idInventario` int(255) NOT NULL,
  `idCliente` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `idVendedor` int(255) NOT NULL,
  `nombreVendedor` varchar(150) NOT NULL,
  `telefonoVendedor` text NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`idVendedor`, `nombreVendedor`, `telefonoVendedor`, `estado`) VALUES
(1, 'juan pablo', '45698733', 1),
(2, 'carlos jimenez', '4584463', 1),
(3, 'lorena pennisi', '45877669', 1),
(4, 'dfbg', '234234', 1),
(5, 'dfsdfsd', '353535375', 1),
(6, 'bbbbbbbbbb', '111111111111', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `cuarteo`
--
ALTER TABLE `cuarteo`
  ADD PRIMARY KEY (`idCuarteo`);

--
-- Indices de la tabla `cuarteoinventario`
--
ALTER TABLE `cuarteoinventario`
  ADD PRIMARY KEY (`idCuarteoInventario`);

--
-- Indices de la tabla `cuentacorriente`
--
ALTER TABLE `cuentacorriente`
  ADD PRIMARY KEY (`idCuentaCorriente`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`idDetalle`);

--
-- Indices de la tabla `facturado`
--
ALTER TABLE `facturado`
  ADD PRIMARY KEY (`idFacturado`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idFactura`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`);

--
-- Indices de la tabla `notacredito`
--
ALTER TABLE `notacredito`
  ADD PRIMARY KEY (`idNotaCredito`);

--
-- Indices de la tabla `notadebito`
--
ALTER TABLE `notadebito`
  ADD PRIMARY KEY (`idNotaDebito`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPagos`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProductos`);

--
-- Indices de la tabla `saldos`
--
ALTER TABLE `saldos`
  ADD PRIMARY KEY (`idSaldos`);

--
-- Indices de la tabla `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`idTemp`);

--
-- Indices de la tabla `tempmedia`
--
ALTER TABLE `tempmedia`
  ADD PRIMARY KEY (`idTempMedia`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`idVendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuarteo`
--
ALTER TABLE `cuarteo`
  MODIFY `idCuarteo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuarteoinventario`
--
ALTER TABLE `cuarteoinventario`
  MODIFY `idCuarteoInventario` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuentacorriente`
--
ALTER TABLE `cuentacorriente`
  MODIFY `idCuentaCorriente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `idDetalle` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facturado`
--
ALTER TABLE `facturado`
  MODIFY `idFacturado` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFactura` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `notacredito`
--
ALTER TABLE `notacredito`
  MODIFY `idNotaCredito` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notadebito`
--
ALTER TABLE `notadebito`
  MODIFY `idNotaDebito` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPagos` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProductos` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `saldos`
--
ALTER TABLE `saldos`
  MODIFY `idSaldos` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temp`
--
ALTER TABLE `temp`
  MODIFY `idTemp` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tempmedia`
--
ALTER TABLE `tempmedia`
  MODIFY `idTempMedia` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `idVendedor` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
