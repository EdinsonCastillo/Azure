-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2022 a las 04:35:04
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbmascota_feliz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliacion`
--

CREATE TABLE `afiliacion` (
  `id_afi` int(11) NOT NULL COMMENT 'Llave Principal..',
  `id_mascli` varchar(20) NOT NULL,
  `fecha_reg` date NOT NULL,
  `Obs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `afiliacion`
--

INSERT INTO `afiliacion` (`id_afi`, `id_mascli`, `fecha_reg`, `Obs`) VALUES
(2, 'ga01', '2022-08-30', 'Gato pícaro'),
(3, 'Con05', '2022-08-31', NULL),
(4, 'Per02', '2022-09-28', 'Afiliación por base de datos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_est` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_est`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Sano'),
(4, 'Enfermo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota_cliente`
--

CREATE TABLE `mascota_cliente` (
  `id_mascli` varchar(20) NOT NULL,
  `id_tipomas` varchar(20) NOT NULL,
  `id_usu` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `especie` varchar(45) NOT NULL,
  `raza` varchar(45) DEFAULT NULL,
  `id_vet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mascota_cliente`
--

INSERT INTO `mascota_cliente` (`id_mascli`, `id_tipomas`, `id_usu`, `nombre`, `color`, `especie`, `raza`, `id_vet`) VALUES
('78M', 'm1', 99999, 'Yogi', 'Negro', 'Canino', 'Free', 2121212),
('78MM', 'm2', 99999, 'Concha', 'Rojo', 'Angora', 'Angora', 2121212),
('Con05', 'm3', 88888, 'Flofy', 'Blanco', 'Conejo', 'Común', 79698),
('ga01', 'm2', 99999, 'Tomcat', 'Gris', 'Felino', 'Angora', 2121212),
('ga02', 'm2', 344566, 'Flofy', 'Café', 'Felino', 'Angora', 79698),
('ga05', 'm2', 344566, 'Bruno', 'Blanco', 'Felino', 'Persa', 2121212),
('ga06', 'm2', 344566, 'Lupe', 'Combinada', 'Felino', 'Común', 102324),
('per01', 'm1', 344566, 'Coqui', 'Amarillo', 'Canino', 'Pincher', NULL),
('Per02', 'm1', 79698, 'Toby', 'Negro', 'Canino', 'Pincher Enano Aleman', 102324);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id_med` int(11) NOT NULL,
  `nombre_med` varchar(45) NOT NULL,
  `Especificaciones` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id_med`, `nombre_med`, `Especificaciones`) VALUES
(1, 'Tyrocan X 30', 'Gotas'),
(2, 'Pretab 20 Mg', NULL),
(3, 'Bionupet', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos_medicina`
--

CREATE TABLE `recibos_medicina` (
  `id_recmec` int(11) NOT NULL,
  `id_med` int(11) NOT NULL,
  `id_vis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recibos_medicina`
--

INSERT INTO `recibos_medicina` (`id_recmec`, `id_med`, `id_vis`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 1, 9),
(6, 3, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mascota`
--

CREATE TABLE `tipo_mascota` (
  `id_tipomas` varchar(20) NOT NULL,
  `tipomas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_mascota`
--

INSERT INTO `tipo_mascota` (`id_tipomas`, `tipomas`) VALUES
('m1', 'Perro'),
('m2', 'Gato'),
('m3', 'Conejo'),
('m4', 'Hamster');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipousu` int(11) NOT NULL,
  `tipousu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipousu`, `tipousu`) VALUES
(1, 'Administrador'),
(2, 'Enfermera'),
(3, 'Veterinario'),
(4, 'Propietario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `Nombres` varchar(45) NOT NULL,
  `Apellidos` varchar(45) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `id_tipousu` int(11) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `tp` varchar(30) DEFAULT NULL COMMENT 'Solo se registra a los Médicos veterinarios',
  `clave` varchar(20) NOT NULL COMMENT 'Clave de acceso al sistema por tipo de usuario',
  `id_est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `Nombres`, `Apellidos`, `Direccion`, `email`, `id_tipousu`, `Telefono`, `tp`, `clave`, `id_est`) VALUES
(65786, 'Andrea', 'Bonilla', 'Diagonal 1', 'andrea@user.com', 3, '32099999', 'TP123434P', 'yali', 1),
(79698, 'Ricardo', 'Gutierrez', 'Carrera 1', 'ricardo@user.com', 3, '312000000', 'TP123456P', 'hrg', 1),
(88888, 'Sandra', 'Hernández', 'Avda 4 n 12', 'sandra@hot.com', 2, '31288888', '', '123456', 1),
(99999, 'Miguel', 'Suarez', 'Avda 4 n 12', 'suarez@hot.com', 1, '3222222222', '', '23456', 1),
(102324, 'Paula', 'Gutierrez Bonilla', 'Calle 3', 'paula@user.com', 3, '315789000', 'TP123478M', 'paulita', 1),
(344566, 'Yudi Lorena', 'Lara', 'Av falsa 123', 'yudy@user.com', 4, '31288448', '', 'clave123*', 1),
(2121212, 'Carlos', 'Tique', 'Avda 4 n 12', 'carlos@hot.com', 3, '312886678', 'TP34567', 'asdfg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_vis` int(11) NOT NULL,
  `id_vet` int(6) DEFAULT NULL,
  `id_mascli` varchar(20) NOT NULL,
  `id_est` int(11) NOT NULL,
  `temperatura` int(11) NOT NULL,
  `peso` decimal(10,0) NOT NULL,
  `fre_res` int(3) NOT NULL,
  `fre_car` int(3) NOT NULL,
  `recomendaciones` varchar(100) NOT NULL,
  `fecha_vis` date NOT NULL,
  `costo_visita` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_vis`, `id_vet`, `id_mascli`, `id_est`, `temperatura`, `peso`, `fre_res`, `fre_car`, `recomendaciones`, `fecha_vis`, `costo_visita`) VALUES
(1, NULL, 'ga01', 4, 36, '4', 70, 90, 'Dar Metronidazol 3 mlx4k c 12 h.\r\n', '2022-08-30', 0),
(2, 102324, 'Per02', 4, 30, '5', 78, 65, 'Alimentación con concentrado blando', '2022-09-28', 50000),
(3, 102324, 'Per02', 4, 30, '5', 78, 65, 'Alimentación con concentrado blando', '2022-09-28', 50000),
(4, 102324, 'Per02', 4, 30, '5', 78, 65, 'Alimentación con concentrado blando', '2022-09-28', 50000),
(5, 102324, 'Per02', 4, 30, '5', 78, 65, 'Alimentación con concentrado blando', '2022-09-28', 50000),
(6, 102324, 'Per02', 4, 30, '5', 78, 65, 'Alimentación con concentrado blando', '2022-09-28', 50000),
(7, 102324, 'Per02', 4, 32, '45', 45, 78, 'Cuello isabelino', '2022-09-28', 10000),
(8, 102324, 'Per02', 4, 40, '7', 45, 89, 'Bajo de peso', '2022-09-28', 0),
(9, 79698, 'Con05', 4, 45, '8', 98, 78, 'Aplicar pomada sobre la roncha', '2022-09-29', 0),
(10, 79698, 'ga02', 4, 87, '3', 102, 154, 'No asustar al gato', '2022-09-29', 100000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  ADD PRIMARY KEY (`id_afi`),
  ADD KEY `fk_Afiliacion_Mascota_cliente_idx` (`id_mascli`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `mascota_cliente`
--
ALTER TABLE `mascota_cliente`
  ADD PRIMARY KEY (`id_mascli`),
  ADD KEY `fk_Mascota_cliente_Usuario_idx` (`id_usu`),
  ADD KEY `fk_Mascota_cliente_Tipo_mascota_idx` (`id_tipomas`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id_med`);

--
-- Indices de la tabla `recibos_medicina`
--
ALTER TABLE `recibos_medicina`
  ADD PRIMARY KEY (`id_recmec`),
  ADD KEY `fk_Recibos_Medicina_Medicamentos_idx` (`id_med`),
  ADD KEY `fk_Recibos_Medicina_Visita_idx` (`id_vis`);

--
-- Indices de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  ADD PRIMARY KEY (`id_tipomas`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipousu`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`),
  ADD KEY `fk_Usuario_Tipo_usuario1_idx` (`id_tipousu`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_vis`),
  ADD KEY `fk_Visita_Mascota_cliente_idx` (`id_mascli`),
  ADD KEY `fk_Visita_Estado1_idx` (`id_est`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  MODIFY `id_afi` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Principal..', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recibos_medicina`
--
ALTER TABLE `recibos_medicina`
  MODIFY `id_recmec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_vis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  ADD CONSTRAINT `fk_Afiliacion_Mascota_cliente` FOREIGN KEY (`id_mascli`) REFERENCES `mascota_cliente` (`id_mascli`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mascota_cliente`
--
ALTER TABLE `mascota_cliente`
  ADD CONSTRAINT `fk_Mascota_cliente_Tipo_mascota` FOREIGN KEY (`id_tipomas`) REFERENCES `tipo_mascota` (`id_tipomas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Mascota_cliente_Usuario` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id_usu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recibos_medicina`
--
ALTER TABLE `recibos_medicina`
  ADD CONSTRAINT `fk_Recibos_Medicina_Medicamentos` FOREIGN KEY (`id_med`) REFERENCES `medicamentos` (`id_med`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `recibos_medicina_ibfk_1` FOREIGN KEY (`id_vis`) REFERENCES `visitas` (`id_vis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Tipo_usuario1` FOREIGN KEY (`id_tipousu`) REFERENCES `tipo_usuario` (`id_tipousu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`id_mascli`) REFERENCES `mascota_cliente` (`id_mascli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`id_est`) REFERENCES `estado` (`id_est`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
