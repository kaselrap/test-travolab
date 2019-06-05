-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2019 at 12:58 AM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `constants` int(10) UNSIGNED DEFAULT NULL,
  `types` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `constants`, `types`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 0, 0, NULL, NULL, NULL),
(3, 0, 0, NULL, NULL, NULL),
(4, 0, 0, NULL, NULL, '2019-05-14 18:38:33'),
(5, 0, 0, NULL, NULL, NULL),
(6, 1, 0, NULL, NULL, NULL),
(7, 0, 0, NULL, NULL, NULL),
(8, 1, 1, NULL, NULL, NULL),
(9, 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '122 2 3', '2019-05-15 18:30:27', '2019-05-17 21:32:28', NULL),
(2, 'Павлов Михаил Степанович', '2019-05-15 18:30:27', '2019-05-15 18:30:27', NULL),
(3, 'Поповz Александ Иоревичm', '2019-05-15 18:30:27', '2019-05-15 18:30:27', NULL),
(4, 'Борисёнок Михаил Аванасьевич', '2019-05-15 18:30:27', '2019-05-15 18:30:27', NULL),
(5, 'При Асс Фыыы', '2019-05-15 18:30:27', '2019-05-15 18:30:27', NULL),
(6, 'Попов Александр Игоревич', '2019-05-15 18:30:27', '2019-05-15 18:30:27', NULL),
(7, 'new fas kas', '2019-05-17 21:38:42', '2019-05-17 21:38:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(10) UNSIGNED NOT NULL,
  `subtype_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `duration`, `subtype_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Экскурсия в кадетский корпус', 60, 1, '2019-05-15 18:38:37', '2019-05-15 18:38:37', NULL),
(2, 'Обзорная экскурсия', 45, 1, '2019-05-15 18:38:37', '2019-05-15 18:38:37', NULL),
(3, 'Экскурсия в кадетский корпус', 60, 1, '2019-05-15 18:38:37', '2019-05-15 18:38:37', '2019-05-15 18:38:37'),
(4, 'Бла-бла', 60, 1, '2019-05-15 18:38:37', '2019-05-15 18:38:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events_coast`
--

CREATE TABLE `events_coast` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `coast_less_five_spec` double(8,2) DEFAULT NULL,
  `coast_less_five_other` double(8,2) DEFAULT NULL,
  `coast_more_five_spec` double(8,2) DEFAULT NULL,
  `coast_more_five_other` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events_coast`
--

INSERT INTO `events_coast` (`id`, `event_id`, `coast_less_five_spec`, `coast_less_five_other`, `coast_more_five_spec`, `coast_more_five_other`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1.00, 1.00, 1.20, 1.00, '2019-05-15 18:44:00', '2019-05-15 18:44:00', '2019-05-15 18:44:00'),
(2, 3, 1.00, 1.40, 1.20, 1.00, '2019-05-15 18:44:00', '2019-05-15 18:44:00', NULL),
(3, 2, 1.00, 1.90, 1.20, 1.00, '2019-05-15 18:44:00', '2019-05-15 18:44:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_on_places`
--

CREATE TABLE `event_on_places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_on_places`
--

INSERT INTO `event_on_places` (`id`, `place_id`, `event_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2019-05-15 18:47:25', '2019-05-15 18:47:25', NULL),
(2, 2, 2, '2019-05-15 18:47:25', '2019-05-15 18:47:25', NULL),
(3, 2, 3, '2019-05-15 18:47:25', '2019-05-15 18:47:25', '2019-05-15 18:47:25'),
(4, 2, 4, '2019-05-15 18:47:25', '2019-05-15 18:47:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fiz_clients`
--

CREATE TABLE `fiz_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fiz_clients`
--

INSERT INTO `fiz_clients` (`id`, `client_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Волков Михаил', '2019-05-15 18:49:41', '2019-05-15 18:49:41', NULL),
(2, 3, 'Петров Павел', '2019-05-15 18:49:41', '2019-05-15 18:49:41', NULL),
(3, 4, 'Попов Александр Игоревич', '2019-05-15 18:49:41', '2019-05-15 18:49:41', '2019-05-15 18:49:41'),
(4, 5, 'Тран Игорь Сергеевич', '2019-05-15 18:49:41', '2019-05-15 18:49:41', '2019-05-15 18:49:41'),
(5, 6, 'И И И', '2019-05-15 18:49:41', '2019-05-15 18:49:41', NULL),
(6, 7, 'П П П', '2019-05-15 18:49:41', '2019-05-15 18:49:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holiday_status`
--

CREATE TABLE `holiday_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dateStart` date NOT NULL,
  `dateEnd` date NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_status_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holiday_status`
--

INSERT INTO `holiday_status` (`id`, `dateStart`, `dateEnd`, `reason`, `work_status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2017-12-28', '2017-12-28', 'ОТпуск', 1, '2019-05-15 18:52:14', '2019-05-15 18:52:14', NULL),
(2, '2018-05-23', '2018-05-26', 'Болезнь', 3, '2019-05-15 18:52:14', '2019-05-15 18:52:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_05_14_202123_create_employee_table', 1),
(2, '2019_05_14_202341_create_events_table', 1),
(3, '2019_05_14_202647_create_events_coast_table', 1),
(4, '2019_05_14_203006_create_event_on_places_table', 1),
(5, '2019_05_14_203154_create_clients_table', 1),
(6, '2019_05_14_203653_create_fiz_clients_table', 1),
(7, '2019_05_14_203811_create_holiday_status_table', 1),
(8, '2019_05_14_204045_create_organizations_table', 1),
(9, '2019_05_14_204222_create_organization_types_table', 1),
(10, '2019_05_14_204355_create_places_table', 1),
(11, '2019_05_14_204441_create_reservations_table', 1),
(12, '2019_05_14_205024_create_status_in_times_table', 1),
(13, '2019_05_14_205122_create_subtypes_table', 1),
(14, '2019_05_14_205314_create_times_table', 1),
(15, '2019_05_14_205506_create_treaties_table', 1),
(16, '2019_05_14_210011_create_types_table', 1),
(17, '2019_05_14_210118_create_work_statuses_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `client_id`, `type_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Шестая школа', '2019-05-15 18:55:41', '2019-05-15 18:55:41', NULL),
(2, 8, 1, 'П', '2019-05-15 18:55:41', '2019-05-15 18:55:41', NULL),
(3, 9, 1, 'А', '2019-05-15 18:55:41', '2019-05-15 18:55:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization_types`
--

CREATE TABLE `organization_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_types`
--

INSERT INTO `organization_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Школы', '2019-05-15 18:57:34', '2019-05-15 18:57:34', NULL),
(3, 'Заводы', '2019-05-15 18:57:34', '2019-05-15 18:57:34', NULL),
(4, 'Турфирмы', '2019-05-15 18:57:34', '2019-05-15 18:57:34', NULL),
(5, 'Детский сад', '2019-05-15 18:57:34', '2019-05-15 18:57:34', NULL),
(6, 'Организация', '2019-05-16 20:00:55', '2019-05-16 20:00:55', NULL),
(7, 'assaas', '2019-05-17 17:43:38', '2019-05-17 17:51:46', '2019-05-17 17:51:46'),
(8, 'sasa', '2019-05-17 17:53:54', '2019-05-17 17:54:00', '2019-05-17 17:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Кадетский корпус УО \"ПГУ\"', '2019-05-15 19:09:42', '2019-05-15 19:09:42', NULL),
(2, 'Художественная галерея', '2019-05-15 19:09:42', '2019-05-15 19:09:42', NULL),
(3, 'Софийский собор', '2019-05-15 19:09:42', '2019-05-15 19:09:42', NULL),
(4, 'название', '2019-05-16 18:53:12', '2019-05-16 19:02:41', '2019-05-16 19:02:41'),
(5, 'wqqw', '2019-05-16 19:02:56', '2019-05-16 19:04:15', '2019-05-16 19:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `fiz_client_id` int(10) UNSIGNED NOT NULL,
  `call_day` date NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `children_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiving` int(11) DEFAULT NULL,
  `document` int(11) DEFAULT NULL,
  `summ` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_in_times`
--

CREATE TABLE `status_in_times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `time_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_in_times`
--

INSERT INTO `status_in_times` (`id`, `status_id`, `time_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subtypes`
--

CREATE TABLE `subtypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subtypes`
--

INSERT INTO `subtypes` (`id`, `name`, `type_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Обзорные экскурсии', 1, '2019-05-15 19:10:21', '2019-05-15 19:10:21', NULL),
(3, 'Детские праздники', 1, '2019-05-15 19:10:21', '2019-05-15 19:10:21', NULL),
(4, 'Фотосессия', 2, '2019-05-15 19:10:21', '2019-05-15 19:10:21', '2019-05-15 19:10:21'),
(5, 'фывфыв', 1, '2019-05-15 19:10:21', '2019-05-15 19:10:21', '2019-05-15 19:10:21'),
(6, 'xzcxczxc', 1, '2019-05-15 19:10:21', '2019-05-15 19:10:21', '2019-05-15 19:10:21'),
(7, 'новое мероприятие', 3, '2019-05-16 19:48:06', '2019-05-16 19:48:53', '2019-05-16 19:48:53'),
(8, 'Курсы php', 6, '2019-05-16 19:48:40', '2019-05-16 19:48:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `type_time` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`id`, `time_start`, `time_end`, `type_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '09:00:00', '10:00:00', 0, '2019-05-15 19:12:47', '2019-05-15 19:12:47', NULL),
(2, '13:00:00', '17:00:00', 0, '2019-05-15 19:12:47', '2019-05-15 19:12:47', NULL),
(3, '13:00:00', '17:00:00', 0, '2019-05-15 19:12:47', '2019-05-15 19:12:47', NULL),
(4, '13:00:00', '17:00:00', 0, '2019-05-15 19:12:47', '2019-05-15 19:12:47', NULL),
(5, '13:00:00', '14:00:00', 0, '2019-05-15 19:12:47', '2019-05-15 19:12:47', NULL),
(6, '09:00:00', '20:00:00', 0, '2019-05-15 19:12:47', '2019-05-15 19:12:47', NULL),
(7, '09:00:00', '10:00:00', 0, '2019-05-15 19:12:47', '2019-05-15 19:12:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `treaties`
--

CREATE TABLE `treaties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` int(10) UNSIGNED NOT NULL,
  `event_on_place_id` int(10) UNSIGNED NOT NULL,
  `exit_date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `subtype_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Экскурсии', '2019-05-15 19:13:35', '2019-05-15 19:13:35', NULL),
(2, 'Мероприятио', '2019-05-15 19:13:35', '2019-05-15 19:13:35', '2019-05-15 19:13:35'),
(3, 'Прогулки', '2019-05-15 19:13:35', '2019-05-15 19:13:35', NULL),
(4, 'Аывфывфыв', '2019-05-15 19:13:35', '2019-05-15 19:13:35', '2019-05-15 19:13:35'),
(5, 'новый вид', '2019-05-16 19:17:33', '2019-05-16 19:17:36', '2019-05-16 19:17:36'),
(6, 'Программирование', '2019-05-16 19:48:26', '2019-05-16 19:48:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_statuses`
--

CREATE TABLE `work_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_statuses`
--

INSERT INTO `work_statuses` (`id`, `employee_id`, `date_start`, `date_end`, `data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2018-10-03', '2018-11-15', '{\"monday\":\"1\",\"thursday\":\"1\",\"friday\":\"1\"}', '2019-05-15 19:16:12', '2019-05-17 21:32:28', NULL),
(2, 2, '2018-01-24', '2018-04-25', '{\"monday\":1,\"tuesday\":0,\"wednesday\":1,\"thursday\":0,\"friday\":1,\"saturday\":0,\"sunday\":0}', '2019-05-15 19:16:12', '2019-05-15 19:16:12', NULL),
(3, 3, '2018-10-01', '2018-10-31', '{\"monday\":1,\"tuesday\":0,\"wednesday\":0,\"thursday\":0,\"friday\":0,\"saturday\":0,\"sunday\":0}', '2019-05-15 19:16:12', '2019-05-15 19:16:12', NULL),
(4, 4, '2018-05-01', '2018-05-08', '{\"monday\":1,\"tuesday\":0,\"wednesday\":0,\"thursday\":1,\"friday\":0,\"saturday\":0,\"sunday\":0}', '2019-05-15 19:16:12', '2019-05-15 19:16:12', NULL),
(5, 5, '2018-09-05', '2018-09-27', '{\"monday\":0,\"tuesday\":1,\"wednesday\":1,\"thursday\":1,\"friday\":0,\"saturday\":0,\"sunday\":0}', '2019-05-15 19:16:12', '2019-05-15 19:16:12', NULL),
(6, 6, '2018-05-01', '2018-12-31', '{\"monday\":1,\"tuesday\":1,\"wednesday\":1,\"thursday\":1,\"friday\":1,\"saturday\":1,\"sunday\":1}', '2019-05-15 19:16:12', '2019-05-15 19:16:12', NULL),
(7, 3, '2018-10-01', '2018-10-31', '{\"monday\":1,\"tuesday\":0,\"wednesday\":0,\"thursday\":0,\"friday\":0,\"saturday\":0,\"sunday\":0}', '2019-05-15 19:16:12', '2019-05-15 19:16:12', NULL),
(20, 7, '2019-05-15', '2020-05-08', '{\"monday\":\"1\",\"wednesday\":\"1\",\"friday\":\"1\",\"type_time\":\"1\",\"time_start\":\"04:44\",\"time_end\":\"13:55\"}', '2019-05-17 21:38:42', '2019-05-17 21:47:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_subtype_id_index` (`subtype_id`);

--
-- Indexes for table `events_coast`
--
ALTER TABLE `events_coast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_coast_event_id_index` (`event_id`);

--
-- Indexes for table `event_on_places`
--
ALTER TABLE `event_on_places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_on_places_place_id_index` (`place_id`),
  ADD KEY `event_on_places_event_id_index` (`event_id`);

--
-- Indexes for table `fiz_clients`
--
ALTER TABLE `fiz_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fiz_clients_client_id_index` (`client_id`);

--
-- Indexes for table `holiday_status`
--
ALTER TABLE `holiday_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `holiday_status_work_status_id_index` (`work_status_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizations_client_id_index` (`client_id`),
  ADD KEY `organizations_type_id_index` (`type_id`);

--
-- Indexes for table `organization_types`
--
ALTER TABLE `organization_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_client_id_index` (`client_id`),
  ADD KEY `reservations_fiz_client_id_index` (`fiz_client_id`);

--
-- Indexes for table `status_in_times`
--
ALTER TABLE `status_in_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_in_times_status_id_index` (`status_id`),
  ADD KEY `status_in_times_time_id_index` (`time_id`);

--
-- Indexes for table `subtypes`
--
ALTER TABLE `subtypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtypes_type_id_index` (`type_id`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treaties`
--
ALTER TABLE `treaties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treaties_reservation_id_index` (`reservation_id`),
  ADD KEY `treaties_event_on_place_id_index` (`event_on_place_id`),
  ADD KEY `treaties_subtype_id_index` (`subtype_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_statuses`
--
ALTER TABLE `work_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_statuses_employee_id_index` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events_coast`
--
ALTER TABLE `events_coast`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_on_places`
--
ALTER TABLE `event_on_places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fiz_clients`
--
ALTER TABLE `fiz_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `holiday_status`
--
ALTER TABLE `holiday_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organization_types`
--
ALTER TABLE `organization_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_in_times`
--
ALTER TABLE `status_in_times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subtypes`
--
ALTER TABLE `subtypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `treaties`
--
ALTER TABLE `treaties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_statuses`
--
ALTER TABLE `work_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
