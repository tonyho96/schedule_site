-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 06, 2018 lúc 05:23 AM
-- Phiên bản máy phục vụ: 5.7.19
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `schedule_site`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `groomer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schedules_pets_idx` (`pet_id`),
  KEY `fk_schedules_groomers_idx` (`groomer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `appointments_services`
--

DROP TABLE IF EXISTS `appointments_services`;
CREATE TABLE IF NOT EXISTS `appointments_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shedules_services_schedule_idx` (`appointment_id`),
  KEY `fk_shedules_services_services_idx` (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `breeds`
--

DROP TABLE IF EXISTS `breeds`;
CREATE TABLE IF NOT EXISTS `breeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customers_user` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `first_name`, `last_name`, `home_phone`, `mobile_phone`, `work_phone`, `email`, `address`, `address2`, `town`, `country_state`, `post_zip_code`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'aaa', 'aaa', NULL, '111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-27 06:40:28', '2018-03-27 06:40:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groomers`
--

DROP TABLE IF EXISTS `groomers`;
CREATE TABLE IF NOT EXISTS `groomers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_groomers_user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2017_12_28_101614_create_appointments_services_table', 1),
(19, '2017_12_28_101614_create_appointments_table', 1),
(20, '2017_12_28_101614_create_breeds_table', 1),
(21, '2017_12_28_101614_create_customers_table', 1),
(22, '2017_12_28_101614_create_groomers_table', 1),
(23, '2017_12_28_101614_create_password_resets_table', 1),
(24, '2017_12_28_101614_create_pets_table', 1),
(25, '2017_12_28_101614_create_services_table', 1),
(26, '2017_12_28_101614_create_settings_table', 1),
(27, '2017_12_28_101614_create_users_table', 1),
(28, '2017_12_28_101616_add_foreign_keys_to_appointments_services_table', 1),
(29, '2017_12_28_101616_add_foreign_keys_to_appointments_table', 1),
(30, '2017_12_28_101616_add_foreign_keys_to_pets_table', 1),
(31, '2017_12_28_101616_add_foreign_keys_to_settings_table', 1),
(32, '2018_01_03_101616_add_foreign_keys_to_customers_table', 1),
(33, '2018_01_05_135920_add_foreign_keys_to_groomers_table', 1),
(34, '2018_02_09_032408_add_owner_name_to_pets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pets`
--

DROP TABLE IF EXISTS `pets`;
CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `breed_id` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_neutered` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternative_contact_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternative_contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cut_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vet_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vet_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vet_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vet_medical_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_petse_customers_idx` (`customer_id`),
  KEY `fk_petse_breeds_idx` (`breed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_settings_users_idx` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'reminder_email_template', '<h1 style=\"font-weight: normal; line-height: 1.2; color: #333333; font-family: sans-serif, Arial, Verdana, \'Trebuchet MS\';\"><span style=\"color: #0099cc;\">Appointment Reminder</span></h1><p style=\"color: #333333; font-family: sans-serif, Arial, Verdana, \'Trebuchet MS\'; font-size: 13px;\">Dear [FirstName],</p><p style=\"color: #333333; font-family: sans-serif, Arial, Verdana, \'Trebuchet MS\'; font-size: 13px;\">This is just a quick reminder that [PetName] appointment is soon.</p><p style=\"color: #333333; font-family: sans-serif, Arial, Verdana, \'Trebuchet MS\'; font-size: 13px;\">Appointment Date:<strong>[When]</strong></p><p style=\"color: #333333; font-family: sans-serif, Arial, Verdana, \'Trebuchet MS\'; font-size: 13px;\">Should you need to rearrange or cancel your appointment please contact us as soon as possible.</p><p style=\"color: #333333; font-family: sans-serif, Arial, Verdana, \'Trebuchet MS\'; font-size: 13px;\">Regards<br />[BusinessName]<br />[BusinessContactDetails]</p>', 1, '2018-03-27 06:39:58', '2018-03-27 06:39:58'),
(2, 'days_before_appointment', '7', 1, '2018-03-27 06:39:58', '2018-03-27 06:39:58'),
(3, 'days_before_appointment_2nd', '1', 1, '2018-03-27 06:39:58', '2018-03-27 06:39:58'),
(4, 'calendar_view', 'month', 1, '2018-03-27 06:39:58', '2018-03-27 06:39:58'),
(5, 'start_time', '8:00 AM', 1, '2018-03-27 06:39:58', '2018-03-27 06:39:58'),
(6, 'end_time', '6:00 PM', 1, '2018-03-27 06:39:58', '2018-03-27 06:39:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `company_name`, `country_type`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abc', 'abc', 'abc', 'abc', 'aaa@gmail.com', '$2y$10$qN5t9BMmarj6KPIrrD5fxuuPB.GTt2KR5UWXInLVsVB4exiGJ0vKa', NULL, '2018-03-27 06:39:58', '2018-03-27 06:39:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
