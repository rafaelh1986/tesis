-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-02-2026 a las 01:56:21
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
-- Base de datos: `tesis_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'IT', 1, '2025-04-23 02:36:00', '2025-04-23 02:36:00'),
(2, 'Contabilidad', 1, '2025-05-24 06:30:07', '2025-05-24 06:30:07'),
(3, 'Finanzas', 1, '2025-05-24 06:30:16', '2025-05-24 06:30:16'),
(4, 'Gerencia', 1, '2025-05-24 06:30:23', '2025-05-24 06:30:23'),
(5, 'RRHH', 1, '2025-05-24 06:30:34', '2025-05-24 06:30:34'),
(6, 'Servicios', 1, '2025-05-24 06:30:58', '2025-05-24 06:31:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignacion`
--

INSERT INTO `asignacion` (`id`, `id_empleado`, `fecha_asignacion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-06-01', 1, '2025-06-19 13:56:00', '2025-09-15 01:40:48'),
(2, 2, '2025-06-19', 1, '2025-06-20 01:32:08', '2025-07-14 03:19:17'),
(3, 1, '2025-06-12', 1, '2025-06-21 00:06:04', '2025-06-21 04:13:17'),
(4, 3, '2025-06-20', 1, '2025-06-21 03:40:24', '2025-07-21 00:59:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `baja_inventario`
--

CREATE TABLE `baja_inventario` (
  `id` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `id_motivo_baja` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `gestion` int(4) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `baja_inventario`
--

INSERT INTO `baja_inventario` (`id`, `id_inventario`, `id_motivo_baja`, `fecha`, `gestion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2025-06-20', 2025, 1, '2025-06-21 21:36:07', '2025-12-24 01:21:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Coordinador', 1, '2025-05-26 06:28:37', '2025-05-26 06:28:37'),
(2, 'Jefe', 1, '2025-05-26 06:28:49', '2025-05-26 06:29:27'),
(3, 'Analista', 1, '2025-05-26 06:29:04', '2025-05-26 06:29:04'),
(4, 'Asistente', 1, '2025-05-26 06:29:41', '2025-05-26 06:29:41'),
(5, 'Soporte Técnico', 1, '2025-06-19 00:24:27', '2025-06-19 00:24:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Santa Cruz', 1, '2025-05-24 06:29:08', '2025-05-24 06:29:08'),
(2, 'La Paz', 1, '2025-05-24 06:29:23', '2025-05-24 06:29:23'),
(3, 'Cochabamba', 1, '2025-05-24 06:29:34', '2025-05-24 06:29:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_asignacion`
--

CREATE TABLE `detalle_asignacion` (
  `id` int(11) NOT NULL,
  `id_asignacion` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_asignacion`
--

INSERT INTO `detalle_asignacion` (`id`, `id_asignacion`, `id_inventario`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2025-06-20 00:18:39', '2025-06-20 02:00:02'),
(2, 2, 1, 0, '2025-06-20 01:32:44', '2025-06-20 02:00:12'),
(3, 2, 2, 0, '2025-06-20 01:43:05', '2025-06-20 02:02:42'),
(4, 2, 3, 0, '2025-06-20 01:46:04', '2025-06-21 03:13:55'),
(5, 2, 1, 0, '2025-06-20 01:52:20', '2025-06-20 02:00:21'),
(6, 2, 1, 0, '2025-06-20 01:53:02', '2025-06-21 03:14:04'),
(7, 2, 2, 0, '2025-06-20 02:03:02', '2025-06-21 03:14:11'),
(8, 2, 2, 0, '2025-06-20 02:06:53', '2025-06-21 03:30:12'),
(9, 2, 1, 0, '2025-06-20 02:11:42', '2025-06-21 03:11:16'),
(10, 1, 3, 0, '2025-06-20 02:12:51', '2025-06-20 02:42:56'),
(11, 1, 1, 0, '2025-06-21 00:02:48', '2025-06-21 00:07:27'),
(12, 3, 3, 0, '2025-06-21 00:06:12', '2025-06-21 03:10:42'),
(13, 3, 1, 0, '2025-06-21 03:22:03', '2025-06-21 03:31:06'),
(14, 1, 3, 0, '2025-06-21 03:27:22', '2025-06-21 03:28:40'),
(15, 3, 2, 0, '2025-06-21 03:30:32', '2025-06-21 03:33:25'),
(16, 3, 1, 0, '2025-06-21 03:31:26', '2025-06-21 03:34:36'),
(17, 3, 3, 0, '2025-06-21 03:33:04', '2025-06-21 03:34:36'),
(18, 3, 2, 0, '2025-06-21 03:33:54', '2025-06-21 03:34:36'),
(19, 2, 2, 0, '2025-06-21 03:35:20', '2025-06-21 03:38:25'),
(20, 3, 1, 0, '2025-06-21 03:35:47', '2025-06-21 03:36:21'),
(21, 3, 3, 0, '2025-06-21 03:35:50', '2025-06-21 03:35:56'),
(22, 1, 3, 0, '2025-06-21 03:36:04', '2025-06-21 03:38:23'),
(23, 4, 2, 0, '2025-06-21 03:40:32', '2025-06-21 03:51:07'),
(24, 3, 1, 0, '2025-06-21 03:40:59', '2025-06-21 03:42:02'),
(25, 4, 3, 0, '2025-06-21 03:41:30', '2025-06-21 03:51:07'),
(26, 4, 1, 0, '2025-06-21 03:51:31', '2025-06-21 03:55:32'),
(27, 4, 1, 0, '2025-06-21 04:09:57', '2025-06-21 04:12:57'),
(28, 4, 2, 0, '2025-06-21 04:10:01', '2025-06-21 04:12:57'),
(29, 3, 3, 0, '2025-06-21 04:10:15', '2025-06-21 04:11:37'),
(30, 4, 3, 0, '2025-06-21 04:12:15', '2025-06-21 04:12:57'),
(31, 1, 1, 0, '2025-06-21 04:13:06', '2025-06-21 04:13:54'),
(32, 3, 2, 1, '2025-06-21 04:13:15', '2025-06-21 04:13:15'),
(33, 4, 3, 0, '2025-06-21 04:13:35', '2025-06-21 15:05:05'),
(34, 2, 1, 0, '2025-06-21 04:14:24', '2025-06-21 15:13:33'),
(35, 2, 1, 1, '2025-07-14 03:19:11', '2025-07-14 03:19:11'),
(36, 4, 3, 1, '2025-07-21 00:59:49', '2025-07-21 00:59:49'),
(37, 1, 6, 0, '2025-07-21 02:43:35', '2025-09-14 21:03:55'),
(38, 1, 4, 0, '2025-09-14 21:00:37', '2025-09-14 21:00:57'),
(39, 1, 4, 0, '2025-09-14 21:01:50', '2025-09-14 21:02:15'),
(40, 1, 5, 0, '2025-09-14 21:02:26', '2025-09-14 21:03:55'),
(41, 1, 6, 0, '2025-09-15 01:03:21', '2025-09-15 01:07:05'),
(42, 1, 4, 0, '2025-09-15 01:03:21', '2025-09-15 01:07:05'),
(43, 1, 6, 0, '2025-09-15 01:16:26', '2025-09-15 01:16:59'),
(44, 1, 5, 0, '2025-09-15 01:16:43', '2025-09-15 01:16:59'),
(45, 1, 6, 0, '2025-09-15 01:17:23', '2025-09-15 01:21:15'),
(46, 1, 5, 0, '2025-09-15 01:17:23', '2025-09-15 01:21:15'),
(47, 1, 6, 0, '2025-09-15 01:24:12', '2025-09-15 01:32:57'),
(48, 1, 4, 0, '2025-09-15 01:24:12', '2025-09-15 01:32:57'),
(49, 1, 6, 0, '2025-09-15 01:33:46', '2025-09-15 01:40:32'),
(50, 1, 5, 0, '2025-09-15 01:33:46', '2025-09-15 01:40:32'),
(51, 1, 6, 0, '2025-09-15 01:40:43', '2025-09-21 02:31:00'),
(52, 1, 5, 1, '2025-09-15 01:40:43', '2025-09-15 01:40:43'),
(53, 1, 4, 1, '2025-09-21 02:18:50', '2025-09-21 02:18:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `id` int(11) NOT NULL,
  `id_detalle_asignacion` int(11) NOT NULL,
  `id_motivo_devolucion` int(11) NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `email` text NOT NULL,
  `telefono_interno` varchar(20) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `id_persona`, `id_area`, `id_ciudad`, `id_cargo`, `email`, `telefono_interno`, `fecha_ingreso`, `fecha_salida`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 5, 'rafaelherediap@mail.com', '79908680', '2018-01-02', NULL, 1, '2025-06-19 00:21:00', '2025-06-19 00:49:11'),
(2, 6, 1, 1, 1, 'alejandro.ayoroa@mail.com', '7523656', '2013-04-18', NULL, 1, '2025-06-19 00:23:24', '2025-06-19 00:23:24'),
(3, 5, 1, 1, 5, 'Fernanda.jimenez@mail.com', '7895645', '2025-02-03', NULL, 1, '2025-06-21 03:39:44', '2025-06-21 03:39:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `garantia` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_recepcion` date NOT NULL,
  `orden_compra` varchar(20) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `id_modelo`, `id_marca`, `id_proveedor`, `garantia`, `cantidad`, `fecha_recepcion`, `orden_compra`, `estado`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, '36 meses', 3, '2025-02-03', '3423422', 1, '2025-05-26 06:56:41', '2025-08-03 04:01:58'),
(2, 1, 1, 1, '36 meses', 1, '2016-07-27', '4500398620', 1, '2025-05-26 07:01:01', '2025-08-27 03:25:05'),
(3, 5, 1, 2, '36 meses', 5, '2024-11-04', '345649', 1, '2025-05-26 07:02:22', '2025-06-30 02:49:45'),
(4, 6, 1, 1, '36 meses', 15, '2025-06-02', '45006565', 1, '2025-06-30 02:48:23', '2025-06-30 02:48:23'),
(5, 7, 1, 1, '36 meses', 20, '2025-02-03', '45006525', 1, '2025-06-30 02:55:43', '2025-06-30 02:55:43'),
(6, 4, 1, 1, '36 meses', 2, '2025-02-20', '45006528', 1, '2025-08-03 04:03:12', '2025-08-03 04:03:12'),
(7, 2, 1, 2, '3 años', 1, '2017-05-02', '4500453551', 1, '2025-08-27 03:32:59', '2025-08-27 03:32:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `numero_serie` varchar(20) NOT NULL,
  `codigo_activo_fijo` varchar(20) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_equipo`, `numero_serie`, `codigo_activo_fijo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'VFDSCSSD', '20005482', 2, '2025-06-19 14:01:16', '2025-07-14 03:19:11'),
(2, 2, 'CJKDFNDK', '200065898', 2, '2025-06-20 01:42:14', '2025-06-22 04:21:42'),
(3, 1, 'SFADFWERE', '200068978', 0, '2025-06-20 01:42:49', '2025-12-24 01:21:11'),
(4, 1, 'VFDLKJSD', '20005258', 2, '2025-07-21 02:38:30', '2025-09-21 02:18:50'),
(5, 3, 'VFDSCDRE', '20005378', 2, '2025-07-21 02:39:55', '2025-09-15 01:40:43'),
(6, 2, 'SFADFOPRE', '20005478', 1, '2025-07-21 02:43:16', '2025-09-21 02:31:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Lenovo', 1, '2025-05-26 06:33:33', '2025-06-23 03:26:57'),
(2, 'HP', 1, '2025-05-26 06:33:42', '2025-05-26 06:33:42'),
(3, 'Samsung', 1, '2025-06-23 03:27:19', '2025-06-23 03:27:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_28_034032_create_permission_tables', 2),
(6, '2025_05_21_033553_create_permission_tables', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `id_tipo_equipo` int(11) NOT NULL,
  `nombre_comercial` varchar(30) NOT NULL,
  `nombre_tecnico` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id`, `id_tipo_equipo`, `nombre_comercial`, `nombre_tecnico`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 'ThinkCentre M800Z', '10EU-001QLS', 1, '2025-05-26 06:43:40', '2025-06-23 03:47:59'),
(2, 2, 'ThinkCentre M810z', '10Q1-SOFR08', 1, '2025-05-26 06:53:39', '2025-06-16 04:18:08'),
(3, 2, 'ThinkCentre M810z', '10NY-005LS', 1, '2025-05-26 06:54:13', '2025-06-16 04:18:14'),
(4, 1, 'ThinkPad T14 Gen 2', '20W1-S0EJ00', 1, '2025-05-26 06:55:02', '2025-06-16 04:18:19'),
(5, 1, 'ThinkPad T14 Gen 3', '21AJ-SERW00', 1, '2025-05-26 06:55:41', '2025-06-16 04:18:24'),
(6, 1, 'ThinkPad X390', '14REW-031QLSs', 1, '2025-06-30 02:45:54', '2025-06-30 02:45:54'),
(7, 1, 'ThinkPad X280', '14RPO-037QLSs', 1, '2025-06-30 02:53:49', '2025-06-30 03:08:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_baja`
--

CREATE TABLE `motivo_baja` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivo_baja`
--

INSERT INTO `motivo_baja` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Obsoleto', 1, '2025-06-19 14:11:25', '2025-06-19 14:11:25'),
(2, 'Falla', 1, '2025-12-19 03:17:40', '2025-12-19 03:18:04'),
(3, 'Dañado', 1, '2025-12-19 03:18:15', '2025-12-19 03:18:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_devolucion`
--

CREATE TABLE `motivo_devolucion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'permiso.index', 'web', 1, '2025-05-20 06:57:05', '2025-05-20 06:57:05'),
(2, 'permiso.create', 'web', 1, '2025-05-20 06:58:31', '2025-05-20 06:58:31'),
(3, 'permiso.store', 'web', 1, '2025-05-20 06:58:51', '2025-05-20 06:58:51'),
(4, 'permiso.edit', 'web', 1, '2025-05-20 06:59:03', '2025-05-20 06:59:03'),
(5, 'permiso.update', 'web', 1, '2025-05-20 06:59:22', '2025-05-20 06:59:22'),
(6, 'permiso.destroy', 'web', 1, '2025-05-20 06:59:41', '2025-05-20 06:59:41'),
(7, 'permiso.show', 'web', 1, '2025-05-20 06:59:55', '2025-05-20 06:59:55'),
(8, 'usuario.index', 'web', 1, '2025-05-20 07:00:49', '2025-05-20 07:00:49'),
(9, 'usuario.create', 'web', 1, '2025-05-20 07:01:16', '2025-05-20 07:01:16'),
(10, 'usuario.store', 'web', 1, '2025-05-20 07:01:35', '2025-05-20 07:01:35'),
(11, 'usuario.edit', 'web', 1, '2025-05-20 07:12:59', '2025-05-20 07:12:59'),
(12, 'usuario.update', 'web', 1, '2025-05-20 07:13:20', '2025-05-20 07:13:20'),
(13, 'usuario.destroy', 'web', 1, '2025-05-20 07:13:39', '2025-05-20 07:13:39'),
(14, 'usuario.show', 'web', 1, '2025-05-20 07:13:57', '2025-05-20 07:13:57'),
(15, 'roles.index', 'web', 1, '2025-05-20 07:14:31', '2025-05-20 07:14:31'),
(16, 'roles.create', 'web', 1, '2025-05-20 07:14:42', '2025-05-20 07:14:42'),
(17, 'roles.store', 'web', 1, '2025-05-20 07:14:57', '2025-05-20 07:14:57'),
(18, 'roles.edit', 'web', 1, '2025-05-20 07:15:07', '2025-05-20 07:15:07'),
(19, 'roles.update', 'web', 1, '2025-05-20 07:15:20', '2025-05-20 07:15:20'),
(20, 'roles.destroy', 'web', 1, '2025-05-20 07:15:35', '2025-05-20 07:15:35'),
(21, 'roles.show', 'web', 1, '2025-05-20 07:15:49', '2025-05-20 07:15:49'),
(22, 'asignacion.index', 'web', 1, '2025-05-20 03:23:21', '0000-00-00 00:00:00'),
(23, 'asignacion.create', 'web', 1, '2025-05-20 07:24:23', '2025-05-20 07:24:23'),
(24, 'asignacion.store', 'web', 1, '2025-05-20 07:24:39', '2025-05-20 07:24:39'),
(25, 'asignacion.edit', 'web', 1, '2025-05-20 07:25:09', '2025-05-20 07:25:09'),
(26, 'asignacion.update', 'web', 1, '2025-05-20 07:25:38', '2025-05-20 07:25:38'),
(27, 'asignacion.destroy', 'web', 1, '2025-05-20 07:26:13', '2025-05-20 07:26:13'),
(28, 'asignacion.show', 'web', 1, '2025-05-20 07:26:24', '2025-05-20 07:26:24'),
(29, 'persona.index', 'web', 1, '2025-05-20 07:27:14', '2025-05-20 07:27:14'),
(30, 'persona.create', 'web', 1, '2025-05-20 07:27:25', '2025-05-20 07:27:25'),
(31, 'persona.store', 'web', 1, '2025-05-20 07:27:37', '2025-05-20 07:27:37'),
(32, 'persona.edit', 'web', 1, '2025-05-20 07:27:48', '2025-05-20 07:27:48'),
(33, 'persona.update', 'web', 1, '2025-05-20 07:27:59', '2025-05-20 07:28:54'),
(35, 'persona.destroy', 'web', 1, '2025-05-20 07:29:22', '2025-05-20 07:29:22'),
(36, 'persona.show', 'web', 1, '2025-05-20 07:31:24', '2025-05-20 07:31:24'),
(37, 'empleado.index', 'web', 1, '2025-05-20 07:33:54', '2025-05-20 07:33:54'),
(38, 'empleado.create', 'web', 1, '2025-05-20 07:34:07', '2025-05-20 07:34:07'),
(39, 'empleado.store', 'web', 1, '2025-05-20 07:34:18', '2025-05-20 07:34:18'),
(41, 'empleado.edit', 'web', 1, '2025-05-20 07:34:43', '2025-05-20 07:34:43'),
(42, 'empleado.update', 'web', 1, '2025-05-20 07:34:55', '2025-05-20 07:34:55'),
(43, 'empleado.destroy', 'web', 1, '2025-05-20 07:35:05', '2025-05-20 07:35:05'),
(44, 'empleado.show', 'web', 1, '2025-05-20 07:35:16', '2025-05-20 07:35:16'),
(45, 'ciudad.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(47, 'ciudad.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(48, 'ciudad.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(49, 'ciudad.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(50, 'ciudad.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(51, 'ciudad.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(52, 'ciudad.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(53, 'area.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(54, 'area.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(55, 'area.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(56, 'area.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(57, 'area.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(58, 'area.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(59, 'area.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(60, 'cargo.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(61, 'cargo.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(62, 'cargo.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(63, 'cargo.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(64, 'cargo.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(65, 'cargo.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(66, 'cargo.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(67, 'marca.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(68, 'marca.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(69, 'marca.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(70, 'marca.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(71, 'marca.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(72, 'marca.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(73, 'marca.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(74, 'modelo.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(75, 'modelo.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(76, 'modelo.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(77, 'modelo.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(78, 'modelo.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(79, 'modelo.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(80, 'modelo.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(81, 'equipo.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(82, 'equipo.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(83, 'equipo.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(84, 'equipo.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(85, 'equipo.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(86, 'equipo.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(87, 'equipo.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(88, 'tipo_equipo.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(89, 'tipo_equipo.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(90, 'tipo_equipo.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(91, 'tipo_equipo.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(92, 'tipo_equipo.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(93, 'tipo_equipo.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(94, 'tipo_equipo.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(95, 'inventario.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(96, 'inventario.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(97, 'inventario.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(98, 'inventario.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(99, 'inventario.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(100, 'inventario.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(101, 'inventario.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(102, 'baja_inventario.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(103, 'baja_inventario.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(104, 'baja_inventario.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(105, 'baja_inventario.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(106, 'baja_inventario.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(107, 'baja_inventario.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(108, 'baja_inventario.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(109, 'motivo_baja.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(110, 'motivo_baja.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(111, 'motivo_baja.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(112, 'motivo_baja.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(113, 'motivo_baja.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(114, 'motivo_baja.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(115, 'motivo_baja.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(116, 'proveedor.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(117, 'proveedor.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(118, 'proveedor.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(119, 'proveedor.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(120, 'proveedor.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(121, 'proveedor.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(122, 'proveedor.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(123, 'salida_revision.index', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(124, 'salida_revision.create', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(125, 'salida_revision.store', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(126, 'salida_revision.edit', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(127, 'salida_revision.update', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(128, 'salida_revision.destroy', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03'),
(129, 'salida_revision.show', 'web', 1, '2025-05-20 03:38:03', '2025-05-20 03:38:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `ci` mediumtext NOT NULL,
  `nombres` mediumtext NOT NULL,
  `apellidos` mediumtext NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `ci`, `nombres`, `apellidos`, `estado`, `created_at`, `updated_at`) VALUES
(1, '6339071', 'Rafael', 'Heredia Padilla', 2, '2025-04-26 17:16:35', '2025-06-19 00:14:25'),
(2, '6352845', 'Fernanda', 'Sanchez Larreategui', 1, '2025-05-21 08:02:34', '2025-05-21 08:02:34'),
(3, '4562315', 'Roberto', 'Justiniano Vaca', 1, '2025-05-24 06:27:01', '2025-05-24 06:27:01'),
(4, '8794646', 'Juana', 'Añez Vaca', 1, '2025-05-24 06:28:08', '2025-05-24 06:28:08'),
(5, '6532512', 'Fernanda', 'Jimenez Gomez', 2, '2025-05-24 06:28:51', '2025-06-21 03:39:44'),
(6, '78945423', 'Alejandro', 'Ayoroa', 2, '2025-06-08 16:11:22', '2025-06-19 00:23:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `razon_social`, `nit`, `telefono`, `email`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'DATEC', '23563233', '32568', 'datec.tecnico@datec.com.bo', 1, '2025-05-26 06:49:11', '2025-05-26 06:49:11'),
(2, 'FUXION', '7897546', '5345345', 'fuxion@mail.com', 1, '2025-05-26 06:49:55', '2025-05-26 06:49:55'),
(3, 'DIMA', '238942389', '746545665', 'dima@dima.com.bo', 1, '2025-05-26 06:52:31', '2025-05-26 06:52:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'web', '2025-05-20 06:55:33', '2025-05-20 06:55:33'),
(2, 'Soporte', 'web', '2025-05-20 06:57:38', '2025-05-20 06:57:38'),
(3, 'Coordinador', 'web', '2025-06-08 16:11:50', '2025-06-08 16:11:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(22, 2),
(22, 3),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(95, 3),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(123, 3),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_revision`
--

CREATE TABLE `salida_revision` (
  `id` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_retorno` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salida_revision`
--

INSERT INTO `salida_revision` (`id`, `id_inventario`, `id_proveedor`, `fecha_salida`, `descripcion`, `fecha_retorno`, `observaciones`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-06-02', 'Revisión de pantalla', '2025-06-20', 'Se cambió la pantalla', 0, '2025-06-21 22:04:32', '2025-06-21 22:52:25'),
(2, 1, 1, '2025-06-03', 'Revisión de pantalla', '2025-06-21', 'Se cambió la pantalla', 0, '2025-06-21 23:03:33', '2025-06-21 23:06:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_equipo`
--

CREATE TABLE `tipo_equipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_equipo`
--

INSERT INTO `tipo_equipo` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 1, '2025-05-26 06:46:09', '2025-05-26 06:46:09'),
(2, 'All In One', 1, '2025-05-26 06:46:22', '2025-05-26 06:46:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_persona` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `id_persona`, `name`, `email`, `email_verified_at`, `password`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rafael', 'rafaelherediap@mail.com', NULL, '$2y$12$2YtgwIjcPiVvcOzpjyLMV.OR2yhrUjYtmPYI7E74UTjvyUjStC6FC', 1, NULL, '2025-04-25 06:24:54', '2025-04-25 06:24:54'),
(2, 2, NULL, 'fernanda.sanchez@mail.com', NULL, '$2y$12$iU26Ams0fEAgkmvcpkNIFebkAEd0tadOSrfmYAicR1Oeu/xOtU81q', 1, NULL, '2025-05-21 08:04:18', '2025-05-21 08:11:47'),
(3, 6, NULL, 'alejandro.ayoroa@mail.com', NULL, '$2y$12$rI6mr9WaVwoGcT4JI6LFTer1Iz1I9tSSs07Tg1FZ9tXFzHmHK47I2', 1, NULL, '2025-06-08 16:16:11', '2025-06-08 16:16:34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asignacion_empleado` (`id_empleado`);

--
-- Indices de la tabla `baja_inventario`
--
ALTER TABLE `baja_inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_baja_inventario_inventario` (`id_inventario`),
  ADD KEY `fk_baja_inventario_motivo_baja` (`id_motivo_baja`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_asignacion_asignacion` (`id_asignacion`),
  ADD KEY `fk_detalle_asignacion_inventario` (`id_inventario`);

--
-- Indices de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_devolucion_detalle_asignacion` (`id_detalle_asignacion`),
  ADD KEY `idx_devolucion_motivo_devolucion` (`id_motivo_devolucion`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empleado_area` (`id_area`),
  ADD KEY `fk_empleado_ciudad` (`id_ciudad`),
  ADD KEY `fk_empleado_cargo` (`id_cargo`),
  ADD KEY `fk_empleado_persona` (`id_persona`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipo_modelo` (`id_modelo`),
  ADD KEY `fk_equipo_marca` (`id_marca`),
  ADD KEY `fk_equipo_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventario_equipo` (`id_equipo`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_equipo` (`id_tipo_equipo`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `motivo_baja`
--
ALTER TABLE `motivo_baja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `motivo_devolucion`
--
ALTER TABLE `motivo_devolucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `salida_revision`
--
ALTER TABLE `salida_revision`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proveedor` (`id_proveedor`),
  ADD KEY `fk_inventario` (`id_inventario`);

--
-- Indices de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_persona` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `baja_inventario`
--
ALTER TABLE `baja_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `motivo_baja`
--
ALTER TABLE `motivo_baja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `motivo_devolucion`
--
ALTER TABLE `motivo_devolucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salida_revision`
--
ALTER TABLE `salida_revision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `fk_asignacion_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `baja_inventario`
--
ALTER TABLE `baja_inventario`
  ADD CONSTRAINT `fk_baja_inventario_inventario` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `fk_baja_inventario_motivo_baja` FOREIGN KEY (`id_motivo_baja`) REFERENCES `motivo_baja` (`id`);

--
-- Filtros para la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  ADD CONSTRAINT `fk_detalle_asignacion_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES `asignacion` (`id`),
  ADD CONSTRAINT `fk_detalle_asignacion_inventario` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`);

--
-- Filtros para la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD CONSTRAINT `fk_devolucion_detalle_asignacion` FOREIGN KEY (`id_detalle_asignacion`) REFERENCES `detalle_asignacion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_devolucion_motivo_devolucion` FOREIGN KEY (`id_motivo_devolucion`) REFERENCES `motivo_devolucion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_empleado_area` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`),
  ADD CONSTRAINT `fk_empleado_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`),
  ADD CONSTRAINT `fk_empleado_ciudad` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `fk_empleado_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `fk_equipo_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `fk_equipo_modelo` FOREIGN KEY (`id_modelo`) REFERENCES `modelo` (`id`),
  ADD CONSTRAINT `fk_equipo_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_equipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id`);

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`id_tipo_equipo`) REFERENCES `tipo_equipo` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `salida_revision`
--
ALTER TABLE `salida_revision`
  ADD CONSTRAINT `fk_inventario` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `fk_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
