-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2019 a las 07:06:29
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mibasededatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audiosaudify`
--

CREATE TABLE `audiosaudify` (
  `id` int(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `size` varchar(20) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `fechaSubida` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `audiosaudify`
--

INSERT INTO `audiosaudify` (`id`, `usuario`, `nombre`, `size`, `tipo`, `ruta`, `fechaSubida`) VALUES
(141, 'tomi.3', 'Dua Lipa - Blow Your Mind (Mwah) (Official Video).mp3', '4256425', 'audio/mp3', '../Audios/Dua Lipa - Blow Your Mind (Mwah) (Official Video).mp3', '31-05-2019 00:19:33'),
(142, 'tomi.3', 'DICC X Duki - Ferrari.mp3', '3948544', 'audio/mp3', '../Audios/DICC X Duki - Ferrari.mp3', '31-05-2019 00:19:38'),
(143, 'tomi.3', 'DirtyK Ft. Coscu - Nada de nada RMX (1).mp3', '4202508', 'audio/mp3', '../Audios/DirtyK Ft. Coscu - Nada de nada RMX (1).mp3', '31-05-2019 00:19:41'),
(144, 'tomi.3', 'Dua Lipa - Blow Your Mind (Mwah) (Official Video).mp3', '4256425', 'audio/mp3', '../Audios/Dua Lipa - Blow Your Mind (Mwah) (Official Video).mp3', '31-05-2019 00:19:44'),
(193, 'admin', 'Duki - LeBron (Prod. Rojas  DJ Wreckless)  Ballin ft Rojas.mp3', '8488262', 'audio/mp3', '../Audios/Duki - LeBron (Prod. Rojas  DJ Wreckless)  Ballin ft Rojas.mp3', '28-06-2019 22:08:28'),
(195, 'admin', 'Dua Lipa - Blow Your Mind (Mwah) (Official Video).mp3', '4256425', 'audio/mp3', '../Audios/Dua Lipa - Blow Your Mind (Mwah) (Official Video).mp3', '28-06-2019 23:33:51'),
(197, 'tomi.3', 'Duki - LeBron (Prod. Rojas  DJ Wreckless)  Ballin ft Rojas.mp3', '8488262', 'audio/mp3', '../Audios/Duki - LeBron (Prod. Rojas  DJ Wreckless)  Ballin ft Rojas.mp3', '29-06-2019 00:13:46'),
(198, 'admin', 'Drake - Legend (Wynn Remix) Prod. by Sean Ross [OFFICIAL VIDEO].mp3', '3897189', 'audio/mp3', '../Audios/Drake - Legend (Wynn Remix) Prod. by Sean Ross [OFFICIAL VIDEO].mp3', '29-06-2019 00:16:18'),
(199, 'admin', 'PAULO -LUNA LLENA-  [OFFICIAL VIDEO].mp3', '4457672', 'audio/mp3', '../Audios/PAULO -LUNA LLENA-  [OFFICIAL VIDEO].mp3', '29-06-2019 00:16:50'),
(209, 'admin', 'ECKO - ICE (Official Video).mp3', '2575602', 'audio/mp3', '../Audios/ECKO - ICE (Official Video).mp3', '03-07-2019 15:29:08'),
(210, 'admin', 'Deorro x Chris Brown - Five More Hours (Official Video).mp3', '6884552', 'audio/mp3', '../Audios/Deorro x Chris Brown - Five More Hours (Official Video).mp3', '03-07-2019 15:29:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentariosaudify`
--

CREATE TABLE `comentariosaudify` (
  `comentario_id` int(11) NOT NULL,
  `parent_comentario_id` int(11) DEFAULT NULL,
  `comment` varchar(200) CHARACTER SET latin1 NOT NULL,
  `comment_sender_name` varchar(40) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publicacion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla Comentarios';

--
-- Volcado de datos para la tabla `comentariosaudify`
--

INSERT INTO `comentariosaudify` (`comentario_id`, `parent_comentario_id`, `comment`, `comment_sender_name`, `date`, `publicacion_id`) VALUES
(253, 0, 'dasda', 'tomi.3', '2019-06-29 03:13:12', 20),
(254, 253, '123', 'tomi.3', '2019-06-29 03:13:17', 20),
(255, 0, 'asaaa', 'tomi.3', '2019-06-29 03:13:21', 20),
(256, 0, 'Good song!', 'tomi.3', '2019-06-29 03:14:44', 21),
(257, 0, '123', 'tomi.3', '2019-06-29 03:14:52', 21),
(258, 257, 'qq', 'admin', '2019-06-29 21:24:13', 21),
(259, 0, 'dasda', 'admin', '2019-07-03 17:53:51', 21),
(260, 0, 'qq', 'admin', '2019-07-03 17:54:05', 21),
(261, 0, '11', 'admin', '2019-10-13 04:42:00', 21),
(262, 256, 'qqa', 'admin', '2019-10-13 04:42:09', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `megusta_nomegusta`
--

CREATE TABLE `megusta_nomegusta` (
  `id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL,
  `like_unlike` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `megusta_nomegusta`
--

INSERT INTO `megusta_nomegusta` (`id`, `comentario_id`, `like_unlike`, `date`, `user`) VALUES
(234, 253, 1, '2019-06-29 03:13:15', 'tomi.3'),
(235, 256, 1, '2019-06-29 03:14:49', 'tomi.3'),
(236, 253, 1, '2019-07-03 18:33:47', 'admin'),
(237, 254, 0, '2019-06-29 21:26:11', 'admin'),
(238, 256, 1, '2019-07-03 17:53:49', 'admin'),
(239, 257, 1, '2019-07-03 17:53:50', 'admin'),
(240, 259, 1, '2019-07-03 17:54:04', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacionesaudify`
--

CREATE TABLE `publicacionesaudify` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `comentario` varchar(175) CHARACTER SET utf8mb4 NOT NULL,
  `nombreAudio` varchar(75) CHARACTER SET utf8mb4 NOT NULL,
  `ruta` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `horaFecha` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicacionesaudify`
--

INSERT INTO `publicacionesaudify` (`id`, `usuario`, `comentario`, `nombreAudio`, `ruta`, `horaFecha`, `size`, `tipo`) VALUES
(20, 'tomi.3', '', 'Damas Gratis - No te Creas Tan Importante (Feat Viru Kumbieron) VIDEO OFICI', '../Audios/Damas Gratis - No te Creas Tan Importante (Feat Viru Kumbieron) VIDEO OFICIAL EN VIVO.mp3', '29-06-2019 00:12:35', 5806844, 'audio/mp3'),
(21, 'tomi.3', 'Buena cancion', 'Duki - LeBron (Prod. Rojas  DJ Wreckless)  Ballin ft Rojas.mp3', '../Audios/Duki - LeBron (Prod. Rojas  DJ Wreckless)  Ballin ft Rojas.mp3', '29-06-2019 00:13:41', 8488262, 'audio/mp3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosaudify`
--

CREATE TABLE `usuariosaudify` (
  `id` int(255) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `nombreUsuario` varchar(20) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `correo` varchar(35) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `token` varchar(100) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuariosaudify`
--

INSERT INTO `usuariosaudify` (`id`, `nombre`, `apellido`, `nombreUsuario`, `clave`, `correo`, `fechaNacimiento`, `sexo`, `token`, `rol`) VALUES
(95, 'Juan', 'Perez', 'admin', '202cb962ac59075b964b07152d234b70', 'Juansito99@hotmail.com', '1999-08-04', 'M', '812b4ba287f5ee0bc9d43bbf5bbe87fb', 'admin'),
(110, 'dasda', 'dasdas', 'asdas', '89defae676abd3e3a42b41df17c40096', 'tomaselfacha@hotmail.com', '2018-12-09', 'M', '', 'user'),
(111, 'agustin', 'perez', 'user1', '827ccb0eea8a706c4c34a16891f84e7b', 'user1@hotmail.com', '2018-12-19', 'F', '', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audiosaudify`
--
ALTER TABLE `audiosaudify`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentariosaudify`
--
ALTER TABLE `comentariosaudify`
  ADD PRIMARY KEY (`comentario_id`);

--
-- Indices de la tabla `megusta_nomegusta`
--
ALTER TABLE `megusta_nomegusta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicacionesaudify`
--
ALTER TABLE `publicacionesaudify`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuariosaudify`
--
ALTER TABLE `usuariosaudify`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audiosaudify`
--
ALTER TABLE `audiosaudify`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT de la tabla `comentariosaudify`
--
ALTER TABLE `comentariosaudify`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `megusta_nomegusta`
--
ALTER TABLE `megusta_nomegusta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT de la tabla `publicacionesaudify`
--
ALTER TABLE `publicacionesaudify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuariosaudify`
--
ALTER TABLE `usuariosaudify`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
