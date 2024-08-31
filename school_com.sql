-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 05:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_class_teachers`
--

CREATE TABLE `assign_class_teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_class_teachers`
--

INSERT INTO `assign_class_teachers` (`id`, `class_id`, `teacher_id`, `created_by`, `subject_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 1, 17, 37, 10, 0, '2024-08-15 01:36:21', '2024-08-15 01:36:21'),
(9, 2, 20, 37, 10, 0, '2024-08-15 10:46:19', '2024-08-15 10:46:19'),
(10, 2, 20, 37, 12, 0, '2024-08-15 10:46:19', '2024-08-15 10:46:19'),
(11, 2, 20, 37, 11, 0, '2024-08-15 10:52:35', '2024-08-15 10:52:35'),
(12, 1, 17, 37, 11, 0, '2024-08-15 10:54:01', '2024-08-15 10:54:01'),
(13, 1, 17, 37, 12, 0, '2024-08-15 10:54:01', '2024-08-15 10:54:01'),
(14, 1, 20, 37, 10, 0, '2024-08-28 21:03:13', '2024-08-28 21:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `student_id`, `book_id`, `booking_date`, `return_date`, `created_at`, `updated_at`) VALUES
(4, 8, 2, '2024-08-31', '2024-09-24', '2024-08-31 06:08:56', '2024-08-31 06:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `bus_schedules`
--

CREATE TABLE `bus_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `bus_number` varchar(255) NOT NULL,
  `route_name` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_location` varchar(255) NOT NULL,
  `end_location` varchar(255) NOT NULL,
  `days_of_operation` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_schedules`
--

INSERT INTO `bus_schedules` (`id`, `class_id`, `bus_number`, `route_name`, `driver_name`, `start_time`, `end_time`, `start_location`, `end_location`, `days_of_operation`, `capacity`, `contact_number`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(5, 1, '215', 'Travis Powell', 'Oren Mcguire', '20:59:00', '21:59:00', 'Pariatur Porro alia', 'Consequuntur aliqua', '20', 10, '01934567890', 1, 'N/A', '2024-08-25 08:59:35', '2024-08-25 08:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `class_names`
--

CREATE TABLE `class_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_names`
--

INSERT INTO `class_names` (`id`, `class_name`, `amount`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'One', 4000, 37, 0, '2024-08-04 07:40:19', '2024-08-04 07:40:19'),
(2, 'Two', 5000, 37, 0, '2024-08-04 07:40:31', '2024-08-15 02:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject_models`
--

CREATE TABLE `class_subject_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_subject_models`
--

INSERT INTO `class_subject_models` (`id`, `class_id`, `subject_id`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(37, 2, 10, 37, 0, '2024-08-15 02:33:35', '2024-08-15 02:33:35'),
(38, 2, 12, 37, 0, '2024-08-15 10:44:14', '2024-08-15 10:44:14'),
(39, 2, 11, 37, 0, '2024-08-15 10:44:14', '2024-08-15 10:44:14'),
(40, 1, 12, 37, 0, '2024-08-15 10:44:25', '2024-08-15 10:44:25'),
(41, 1, 10, 37, 0, '2024-08-15 10:44:25', '2024-08-15 10:44:25'),
(42, 1, 11, 37, 0, '2024-08-15 10:44:25', '2024-08-15 10:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_name` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `note`, `created_by`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Mid Term-24', 'N/A', 37, 0, 0, '2024-08-01 03:49:03', '2024-08-01 03:49:03'),
(10, 'First Term-24', 'N/A', 37, 0, 0, '2024-08-02 04:16:36', '2024-08-02 04:16:36'),
(11, 'Final Term -24', 'N/A', 37, 0, 0, '2024-08-02 04:16:57', '2024-08-15 10:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `full_mark` int(11) NOT NULL,
  `passing_mark` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_schedules`
--

INSERT INTO `exam_schedules` (`id`, `exam_id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `full_mark`, `passing_mark`, `created_at`, `updated_at`) VALUES
(38, 10, 1, 10, '2024-08-17', '10:00:00', '11:00:00', '202', 100, 60, '2024-08-15 11:00:06', '2024-08-15 11:00:06'),
(39, 10, 2, 11, '2024-08-17', '10:00:00', '11:00:00', '200', 100, 60, '2024-08-15 11:01:03', '2024-08-15 11:01:03'),
(40, 9, 1, 10, '2024-08-30', '02:01:00', '03:01:00', '202', 100, 60, '2024-08-29 14:01:41', '2024-08-29 14:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `home_works`
--

CREATE TABLE `home_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `homework_date` date NOT NULL,
  `submission_date` date NOT NULL,
  `document` text NOT NULL,
  `description` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_works`
--

INSERT INTO `home_works` (`id`, `class_id`, `subject_id`, `teacher_id`, `homework_date`, `submission_date`, `document`, `description`, `is_deleted`, `created_at`, `updated_at`) VALUES
(7, 1, 10, 17, '2024-08-15', '2024-08-29', 'documents/N9xEB8nTBmyWlLw1DrIQcFl3U9LFrpofdtbamNNQ.pdf', 'Description', 0, '2024-08-15 11:10:03', '2024-08-15 11:10:03'),
(8, 2, 11, 20, '2024-08-15', '2024-08-27', 'documents/a531etxeILI7acJY3T5cVdeT6qBbb1jv6NgfG1QN.pdf', 'description', 0, '2024-08-15 11:22:35', '2024-08-15 11:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_title` text NOT NULL,
  `author` text NOT NULL,
  `publisher` text NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `published_year` year(4) NOT NULL,
  `category` text NOT NULL,
  `language` varchar(50) NOT NULL,
  `copies_available` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `libraries`
--

INSERT INTO `libraries` (`id`, `book_title`, `author`, `publisher`, `isbn`, `published_year`, `category`, `language`, `copies_available`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Relativity', 'Albert Einstein', 'N/A', 'N/A', 1915, 'N/A', 'English', 8, 37, 'available', '2024-08-31 06:01:31', '2024-08-31 06:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_work` int(11) DEFAULT NULL,
  `home_work` int(11) DEFAULT NULL,
  `test_work` int(11) DEFAULT NULL,
  `exam_work` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `student_id`, `subject_id`, `exam_id`, `class_id`, `class_work`, `home_work`, `test_work`, `exam_work`, `created_at`, `updated_at`) VALUES
(96, 7, 10, 10, 1, 10, 10, 30, 10, '2024-08-15 11:03:17', '2024-08-15 11:03:40'),
(97, 8, 11, 10, 2, 10, 20, 40, 20, '2024-08-15 11:05:20', '2024-08-15 11:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `mark_grades`
--

CREATE TABLE `mark_grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade_name` varchar(255) NOT NULL,
  `percent_from` int(11) NOT NULL,
  `percent_to` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mark_grades`
--

INSERT INTO `mark_grades` (`id`, `grade_name`, `percent_from`, `percent_to`, `created_by`, `created_at`, `updated_at`) VALUES
(12, 'F', 0, 49, 37, '2024-08-01 03:50:48', '2024-08-01 03:50:58'),
(13, 'A+', 90, 100, 37, '2024-08-01 04:00:53', '2024-08-01 04:00:53'),
(14, 'A', 80, 89, 37, '2024-08-01 04:01:11', '2024-08-01 04:01:11'),
(15, 'A-', 70, 79, 37, '2024-08-01 04:01:33', '2024-08-01 04:01:57'),
(16, 'B', 60, 69, 37, '2024-08-01 04:02:18', '2024-08-01 04:02:18'),
(17, 'C', 50, 59, 37, '2024-08-01 04:02:32', '2024-08-01 04:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(31, '2014_10_12_000000_create_users_table', 10),
(37, '2024_06_06_202237_create_assign_subject_modals_table', 14),
(50, '2024_06_13_143930_create_exams_table', 18),
(52, '2024_06_12_162830_create_week_modals_table', 20),
(57, '2024_06_23_075012_create_exam_schedules_table', 22),
(63, '2024_06_24_103536_create_marks_table', 25),
(65, '2024_06_26_144649_create_student_attendances_table', 26),
(66, '2024_06_27_105456_create_notice_boards_table', 27),
(67, '2024_06_27_121247_create_notice_board_messages_table', 28),
(76, '2024_06_30_150524_create_student_fees_table', 31),
(80, '2024_06_12_163209_create_time_tables_table', 35),
(84, '2024_06_29_124202_create_home_works_table', 38),
(85, '2024_07_07_191341_create_student_homework_submissions_table', 39),
(86, '2024_05_27_092824_create_class_subject_models_table', 40),
(87, '2024_05_26_181335_create_subject_models_table', 41),
(88, '2024_06_24_180558_create_mark_grades_table', 42),
(91, '2014_10_12_100000_create_password_resets_table', 43),
(92, '2014_10_12_200000_add_two_factor_columns_to_users_table', 43),
(94, '2024_07_31_175625_create_sessions_table', 43),
(95, '2024_06_10_110708_create_assign_class_teachers_table', 44),
(96, '2024_06_02_152659_create_parent_modals_table', 45),
(97, '2024_05_29_111709_create_student_modals_table', 46),
(98, '2024_06_04_214754_create_teacher_modals_table', 47),
(99, '2024_05_27_081126_create_class_names_table', 48),
(101, '2024_08_11_134555_create_settings_table', 49),
(103, '2024_08_25_065148_create_bus_schedules_table', 50),
(104, '2024_08_25_152154_create_libraries_table', 51),
(106, '2024_08_25_180553_create_bookings_table', 52);

-- --------------------------------------------------------

--
-- Table structure for table `notice_boards`
--

CREATE TABLE `notice_boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `notice_date` date NOT NULL,
  `publish_date` date NOT NULL,
  `message` text NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notice_boards`
--

INSERT INTO `notice_boards` (`id`, `title`, `notice_date`, `publish_date`, `message`, `created_by`, `created_at`, `updated_at`) VALUES
(17, 'HoliDay', '2024-08-03', '2024-08-02', 'N/A', 37, '2024-08-02 04:24:26', '2024-08-02 04:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `notice_board_messages`
--

CREATE TABLE `notice_board_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notice_board_id` bigint(20) UNSIGNED NOT NULL,
  `message_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notice_board_messages`
--

INSERT INTO `notice_board_messages` (`id`, `notice_board_id`, `message_to`, `created_at`, `updated_at`) VALUES
(34, 17, '3', '2024-08-15 11:09:09', '2024-08-15 11:09:09'),
(35, 17, '4', '2024-08-15 11:09:09', '2024-08-15 11:09:09'),
(36, 17, '2', '2024-08-15 11:09:09', '2024-08-15 11:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `parent_modals`
--

CREATE TABLE `parent_modals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `profile_pic` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_modals`
--

INSERT INTO `parent_modals` (`id`, `user_id`, `student_id`, `name`, `address`, `status`, `profile_pic`, `gender`, `mobile_number`, `occupation`, `created_at`, `updated_at`) VALUES
(13, 102, 7, 'Nazmul Rahman', '123 Main Street, Dhaka', 0, '2024081516164143IIF2IOI8ETL9nBfHxj.jpeg', 'male', '016-12345678', 'Teacher', '2024-08-15 08:45:55', '2024-08-15 10:16:41'),
(16, 110, 8, 'Abdul Wahid', 'sylhet', 0, '20240821084108fnEq96cZWZv61owNFpi4.jpg', 'male', '01134567890', 'teacher', '2024-08-15 10:43:33', '2024-08-21 02:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', 'CCjkc0nfjasGHPOyCH49S0LsWroWPW0aOUTXy52olvcXGTKv47CDTntdD7Xr', '2024-08-12 04:29:41'),
('admin@gmail.com', 'vTvIEMyEnVthMImsw3wOZEXG1TAqYuiAYSFpT5aZlVurqcRPSAmluYge6GMJ', '2024-08-12 03:02:18'),
('admin@gmail.com', 'j1ro34gBkiOGRidSgxaStBs3oqd0UTTm8VHpUS6ErASMp4W25fC1GxeBqnpp', '2024-08-12 03:13:03'),
('parent@gmail.com', 'EU9KaUGayRn7NnyCfVpQij5CQ0xI5mOn2uLTNbkF2Px7nQJYR7HUH2bVOwQY', '2024-08-12 04:24:31'),
('parent@gmail.com', 'XQ8oK3BCNbmFrUCbu9uz2liWTwkh3IzVVSw35HFt29qNRhILOtYYVfV2Wddl', '2024-08-12 03:16:47'),
('parent@gmail.com', 'obNTpYJP0ixx7RbnJ5n5KPfvNWwizG8pKIP5CWFhMa64o64kYyFZWvtQlTWi', '2024-08-12 03:17:23'),
('parent@gmail.com', '5s1In0QBuE9rimXNYjkq1a9yh5EUQ1ZedBk1A0KNHHaXvQ1UkfX5244iYNTv', '2024-08-12 03:17:49'),
('parent@gmail.com', 'CnhUUbPVl7kxuWV7qsue5T7GoRCUa1TbYhHRBac3a678OUj75yaZY38e6vA6', '2024-08-12 03:21:51'),
('admin@gmail.com', 'xJwFEQdZhCxyq7fzonRLvj82En8kkVYYbBQrC5lLZaIMwHz9RNk5VnSMzSC5', '2024-08-12 03:22:16'),
('admin@gmail.com', 'xu0d11VDuPWyVWh06bk06YPrOIoNp7RNuppiv8a8uUGVkRQYx70N0qMkrqjK', '2024-08-12 03:43:24'),
('parent@gmail.com', 'XTXoNE7l8Qy6n7ZBvhuuYlsWP2AvxpWLKncz2ZYN108HbvOUMZiSWCxwrhks', '2024-08-12 03:43:44'),
('parent@gmail.com', 'i9z5KCmjmmUd3UYYF0GRnYi7yghtnxRzQAqK9cgf7MvRhcbJK1esqtLA1XN5', '2024-08-12 03:45:18'),
('parent@gmail.com', 'upQh8NfGge7nA7KQhiE6SuTBeS5Ww0ZjK2A8WOHjGqBWrIIY7IAbH3e1axLc', '2024-08-12 03:46:04'),
('parent@gmail.com', 'aQNLwJAnhRQ3VHGjH6wyVw0XL02AZmh9bOUWNN9sOr7BM4r3QlolHbTygNQF', '2024-08-12 03:46:21'),
('parent@gmail.com', 'vBuwEc3tjrxXGSqPioWOL9FsQeDnZJHPabiVdGWe9n6FfEoDcUTgtOlLXowP', '2024-08-12 03:48:26'),
('parent@gmail.com', 'p1ejiMficlkH734JtQPrC2qugduiT5Uf2lZPDWKzdjl5c8E9zVOFVtVS2JJX', '2024-08-12 03:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$E/N9Uw/S6S8OQBAJn4dBkO.NNhM66e5DP827L8eD5b5T8SB0vYtxq', '2024-08-12 02:34:41'),
('student@gmail.com', '$2y$10$0EFJHTbvuKKUJZojspAqfeB9jlY0RFirFJrsBo0IpLCXc98w1twjG', '2024-08-01 03:16:01'),
('student1001@gmail.com', '$2y$10$YGYqdzi7IhB8pR9p/FenxOiU4TUp7Cb90DyKfoUJdXkWE8O7OJUhi', '2024-08-01 03:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7N8qkUzyigqxWAAMxuLHi4hW8H6qNtbSHigZOi3E', 100, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWUlQNDhVVVJoQ01jeTVZSGZMNDd6YWhENWtvZlk2dExQdUdoYUU5YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvU2Nob29sLkNvbS9zdHVkZW50L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwMDt9', 1725111400),
('C7ssyVZs7h5KRRDEfokuVRRq4exxlduNAPUJ8mMI', 37, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiajdncThLd0xKY0wwQjBndjhjNE1sUlFEY3VoZDd0c0d3ZGxZQUhJWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvU2Nob29sLkNvbS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozNzt9', 1725111324);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `school_name`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 'Blue Bird', 'Opstel IT', '2024-08-13 08:45:13', '2024-08-13 09:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendances`
--

CREATE TABLE `student_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendances`
--

INSERT INTO `student_attendances` (`id`, `student_id`, `class_id`, `attendance_date`, `attendance_type`, `created_at`, `updated_at`) VALUES
(15, 7, 1, '2024-08-15', 1, '2024-08-15 11:06:32', '2024-08-15 11:06:32'),
(16, 7, 1, '2024-08-16', 1, '2024-08-15 11:07:00', '2024-08-15 11:07:00'),
(17, 8, 2, '2024-08-15', 2, '2024-08-15 11:07:25', '2024-08-15 11:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `remaining_amount` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_fees`
--

INSERT INTO `student_fees` (`id`, `class_id`, `student_id`, `total_amount`, `paid_amount`, `remaining_amount`, `payment_type`, `created_by`, `created_at`, `updated_at`) VALUES
(76, 21, 11, 5000, 5000, 0, 'cash', 37, '2024-08-04 03:35:53', '2024-08-04 03:35:53'),
(78, 1, 7, 4000, 2000, 2000, 'Cash', 37, '2024-08-15 11:24:52', '2024-08-15 11:24:52'),
(79, 2, 8, 5000, 4000, 1000, 'Cash', 37, '2024-08-15 11:25:09', '2024-08-15 11:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `student_homework_submissions`
--

CREATE TABLE `student_homework_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `homework_id` bigint(20) UNSIGNED NOT NULL,
  `document` text NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_homework_submissions`
--

INSERT INTO `student_homework_submissions` (`id`, `student_id`, `homework_id`, `document`, `description`, `created_at`, `updated_at`) VALUES
(22, 8, 8, 'student_homework/ZOqVgF0v9dJ4RYEL2inYfB4kjMxcxK6DWEHCz37A.pdf', 'This Is my Submited Homework', '2024-08-15 11:23:51', '2024-08-15 11:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `student_modals`
--

CREATE TABLE `student_modals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admission_number` varchar(255) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `d_o_b` date NOT NULL,
  `caste` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `admission_date` date NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_modals`
--

INSERT INTO `student_modals` (`id`, `user_id`, `admission_number`, `roll_number`, `class_id`, `first_name`, `last_name`, `gender`, `d_o_b`, `caste`, `religion`, `mobile_number`, `admission_date`, `profile_pic`, `blood_group`, `height`, `weight`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(7, 100, '100', '1', 1, 'Arif', 'Rashid', 'male', '2017-01-15', 'N/A', 'Muslim', '019-34567890', '2024-08-15', '20240815150226GKdsxNxWq0qOjgZe32AA.jpeg', 'A+', '5.60', '70.00', NULL, NULL, 0, '2024-08-15 08:38:26', '2024-08-15 09:02:26'),
(8, 101, '102', '2', 2, 'sajed', 'miah', 'male', '2018-01-15', 'N/A', 'Muslim', '017-34567890', '2024-08-15', '20240815150212pXjuMvK4Q9Pr386obMcM.png', 'B+', '5.60', '70.00', NULL, NULL, 0, '2024-08-15 08:41:39', '2024-08-15 09:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `subject_models`
--

CREATE TABLE `subject_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` text NOT NULL,
  `type` text NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_models`
--

INSERT INTO `subject_models` (`id`, `subject_name`, `type`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(10, 'English', 'Theory', 37, '0', '2024-08-01 03:45:55', '2024-08-01 03:45:55'),
(11, 'Math', 'Practical', 37, '0', '2024-08-01 10:02:31', '2024-08-15 10:44:00'),
(12, 'Bangla', 'Theory', 37, '0', '2024-08-15 05:00:34', '2024-08-15 05:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_modals`
--

CREATE TABLE `teacher_modals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `d_o_b` date NOT NULL,
  `c_address` text DEFAULT NULL,
  `p_address` text DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `d_o_j` date NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_modals`
--

INSERT INTO `teacher_modals` (`id`, `user_id`, `name`, `marital_status`, `qualification`, `gender`, `d_o_b`, `c_address`, `p_address`, `religion`, `mobile_number`, `d_o_j`, `profile_pic`, `experience`, `note`, `blood_group`, `status`, `created_at`, `updated_at`) VALUES
(17, 92, 'John Doe', 'Married', 'Master\'s Degree in Education', 'male', '2024-08-01', '123 Elm Street, Springfield', '45 Maple Avenue, Hometown', 'Christianity', '+1 555-123-4567', '2024-08-14', '20240815140459.jpeg', '10 years of teaching', 'Excellent in student engagement', 'O+', 0, '2024-08-14 08:29:44', '2024-08-15 08:05:00'),
(20, 99, 'alex smith', 'Single', 'Master\'s Degree', 'female', '1988-01-15', '789 Sample Ave, Town', '101 Second St, Town', 'Muslim', '987-654-3210', '2024-08-15', '20240815150105.jpeg', '8 Years', 'Experienced teacher with a passion for education.', 'B+', 0, '2024-08-15 08:30:36', '2024-08-15 09:01:05'),
(24, 113, 'Adara Gay', 'Single', 'Autem quia vero offi', 'female', '2007-08-10', 'Consequat Occaecat', 'Eiusmod amet delect', 'Reprehenderit laudan', '885', '1989-09-05', NULL, 'Voluptate blanditiis', 'Voluptatem id volupt', 'A-', 1, '2024-08-28 20:37:55', '2024-08-28 20:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `time_tables`
--

CREATE TABLE `time_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `week_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_tables`
--

INSERT INTO `time_tables` (`id`, `class_id`, `week_id`, `subject_id`, `teacher_id`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`) VALUES
(17, 2, 1, 10, 20, '10:00:00', '11:00:00', '202', '2024-08-15 10:56:13', '2024-08-15 10:56:13'),
(19, 1, 1, 12, 17, '10:00:00', '11:00:00', '100', '2024-08-15 10:58:47', '2024-08-15 10:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(37, 'admin', 'admin@gmail.com', NULL, '$2y$10$LATeIhrhhSnp8c50pCyb7.tfe6x3CcO3bmO9x4ZY.2ONjQ/ya/m86', NULL, NULL, NULL, 1, 'jM5vAkF1eX4cqf86E0c64fLjEirxBXUS5fUhLVXVYJ3hdZmMJB3XqI0r2o4Y', NULL, '2024-08-15 07:52:24'),
(92, 'John Doe', 'john.doe@gmail.com', NULL, '$2y$10$RASOi2EoxFgfmsoAFZEe7OB/2HlnnbayJvz83MVBe.lKxWrK4uP3K', NULL, NULL, NULL, 2, NULL, '2024-08-14 08:29:44', '2024-08-15 11:12:11'),
(99, 'alex smith', 'alexsmith@gmail.com', NULL, '$2y$10$4J1v31DXnY6tBGXnWqRuJeId..Sbf8LyZCdj/F8yqWVE32xDRajcK', NULL, NULL, NULL, 2, NULL, '2024-08-15 08:30:36', '2024-08-15 08:30:36'),
(100, 'Arif Rashid', 'arifrashid@gmail.com', NULL, '$2y$10$by82qU5kFDstdu3KHHfK8.VXg9feO9IA7dCxEbkSuLMjz7Chofdha', NULL, NULL, NULL, 3, NULL, '2024-08-15 08:38:26', '2024-08-15 08:38:26'),
(101, 'sajed miah', 'sajedmiah@gmail.com', NULL, '$2y$10$QB7wprbWJT/qRaAiYsH74eRs83w81HvwWePmm.jZcBMCd9nN9msO2', NULL, NULL, NULL, 3, NULL, '2024-08-15 08:41:39', '2024-08-15 08:41:39'),
(102, 'Nazmul Rahman', 'nazmulrahman@gmail.com', NULL, '$2y$10$0A4gud6aDQs1X3bs4eiKJe5upKsgc7UwrAa.TtGYwSLGfIFoFt/82', NULL, NULL, NULL, 4, NULL, '2024-08-15 08:45:55', '2024-08-15 08:45:55'),
(110, 'Abdul Wahid', 'wahid@gmail.com', NULL, '$2y$10$GSO6HbyWrLENQMNL3rRi3eS0F4yOhyG85SjmZ.MNeQglRP5v7N8Tq', NULL, NULL, NULL, 4, NULL, '2024-08-15 10:43:33', '2024-08-15 10:43:33'),
(111, 'Kylee Tyson', 'fywy@mailinator.com', NULL, '$2y$10$zbq.ZmulXEfZzzw8RxJ6mO2aFsSJ.JZR8LQmXC2PmERSqYg2n/..a', NULL, NULL, NULL, 2, NULL, '2024-08-18 11:34:47', '2024-08-18 11:34:47'),
(112, 'Graiden Rush', 'kedemic@mailinator.com', NULL, '$2y$10$Ydx0CiwCcXRKGCMX7aohqu7xxxVbswH5LRuxx5KZx26clBPe5hSGK', NULL, NULL, NULL, 2, NULL, '2024-08-21 02:42:54', '2024-08-21 02:42:54'),
(113, 'Adara Gay', 'cebacoziko@mailinator.com', NULL, '$2y$10$UMNbfMp3TjeHgrJMB1eWgOA128jDMGGt/h/eAFAjBx3.vgnJF1IVu', NULL, NULL, NULL, 2, NULL, '2024-08-28 20:37:55', '2024-08-28 20:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `week_modals`
--

CREATE TABLE `week_modals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `week_modals`
--

INSERT INTO `week_modals` (`id`, `week_name`, `created_at`, `updated_at`) VALUES
(1, 'Saturday', NULL, NULL),
(2, 'Sunday', NULL, NULL),
(3, 'Monday', NULL, NULL),
(4, 'Tuesday', NULL, NULL),
(5, 'Wednesday', NULL, NULL),
(6, 'Thursday', NULL, NULL),
(7, 'Friday', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_class_teachers`
--
ALTER TABLE `assign_class_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_class_teachers_teacher_id_foreign` (`teacher_id`),
  ADD KEY `assign_class_teachers_created_by_foreign` (`created_by`),
  ADD KEY `assign_class_teachers_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_student_id_foreign` (`student_id`),
  ADD KEY `bookings_book_id_foreign` (`book_id`);

--
-- Indexes for table `bus_schedules`
--
ALTER TABLE `bus_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_schedules_class_id_foreign` (`class_id`);

--
-- Indexes for table `class_names`
--
ALTER TABLE `class_names`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_names_created_by_foreign` (`created_by`);

--
-- Indexes for table `class_subject_models`
--
ALTER TABLE `class_subject_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_subject_models_class_id_foreign` (`class_id`),
  ADD KEY `class_subject_models_subject_id_foreign` (`subject_id`),
  ADD KEY `class_subject_models_created_by_foreign` (`created_by`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_created_by_foreign` (`created_by`);

--
-- Indexes for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_schedules_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_schedules_class_id_foreign` (`class_id`),
  ADD KEY `exam_schedules_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_works`
--
ALTER TABLE `home_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_works_teacher_id_foreign` (`teacher_id`),
  ADD KEY `home_works_class_id_foreign` (`class_id`),
  ADD KEY `home_works_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `libraries`
--
ALTER TABLE `libraries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libraries_created_by_foreign` (`created_by`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marks_student_id_foreign` (`student_id`),
  ADD KEY `marks_subject_id_foreign` (`subject_id`),
  ADD KEY `marks_exam_id_foreign` (`exam_id`),
  ADD KEY `marks_class_id_foreign` (`class_id`);

--
-- Indexes for table `mark_grades`
--
ALTER TABLE `mark_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mark_grades_created_by_foreign` (`created_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_boards`
--
ALTER TABLE `notice_boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_boards_created_by_foreign` (`created_by`);

--
-- Indexes for table `notice_board_messages`
--
ALTER TABLE `notice_board_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_board_messages_notice_board_id_foreign` (`notice_board_id`);

--
-- Indexes for table `parent_modals`
--
ALTER TABLE `parent_modals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parent_modals_mobile_number_unique` (`mobile_number`),
  ADD KEY `parent_modals_user_id_foreign` (`user_id`),
  ADD KEY `parent_modals_student_id_foreign` (`student_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_attendances_student_id_foreign` (`student_id`),
  ADD KEY `student_attendances_class_id_foreign` (`class_id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_fees_created_by_foreign` (`created_by`),
  ADD KEY `student_fees_class_id_foreign` (`class_id`),
  ADD KEY `student_fees_student_id_foreign` (`student_id`);

--
-- Indexes for table `student_homework_submissions`
--
ALTER TABLE `student_homework_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_homework_submissions_student_id_foreign` (`student_id`),
  ADD KEY `student_homework_submissions_homework_id_foreign` (`homework_id`);

--
-- Indexes for table `student_modals`
--
ALTER TABLE `student_modals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_modals_admission_number_unique` (`admission_number`),
  ADD UNIQUE KEY `student_modals_roll_number_unique` (`roll_number`),
  ADD UNIQUE KEY `student_modals_mobile_number_unique` (`mobile_number`),
  ADD UNIQUE KEY `student_modals_email_unique` (`email`),
  ADD KEY `student_modals_user_id_foreign` (`user_id`),
  ADD KEY `student_modals_class_id_foreign` (`class_id`);

--
-- Indexes for table `subject_models`
--
ALTER TABLE `subject_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_models_created_by_foreign` (`created_by`);

--
-- Indexes for table `teacher_modals`
--
ALTER TABLE `teacher_modals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_modals_mobile_number_unique` (`mobile_number`);

--
-- Indexes for table `time_tables`
--
ALTER TABLE `time_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_tables_class_id_foreign` (`class_id`),
  ADD KEY `time_tables_week_id_foreign` (`week_id`),
  ADD KEY `time_tables_subject_id_foreign` (`subject_id`),
  ADD KEY `time_tables_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `week_modals`
--
ALTER TABLE `week_modals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_class_teachers`
--
ALTER TABLE `assign_class_teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bus_schedules`
--
ALTER TABLE `bus_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_names`
--
ALTER TABLE `class_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_subject_models`
--
ALTER TABLE `class_subject_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_works`
--
ALTER TABLE `home_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE `libraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `mark_grades`
--
ALTER TABLE `mark_grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `notice_boards`
--
ALTER TABLE `notice_boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notice_board_messages`
--
ALTER TABLE `notice_board_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `parent_modals`
--
ALTER TABLE `parent_modals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_attendances`
--
ALTER TABLE `student_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `student_homework_submissions`
--
ALTER TABLE `student_homework_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_modals`
--
ALTER TABLE `student_modals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subject_models`
--
ALTER TABLE `subject_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teacher_modals`
--
ALTER TABLE `teacher_modals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `time_tables`
--
ALTER TABLE `time_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `week_modals`
--
ALTER TABLE `week_modals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_class_teachers`
--
ALTER TABLE `assign_class_teachers`
  ADD CONSTRAINT `assign_class_teachers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assign_class_teachers_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject_models` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assign_class_teachers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_modals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `libraries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student_modals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bus_schedules`
--
ALTER TABLE `bus_schedules`
  ADD CONSTRAINT `bus_schedules_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class_names` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_names`
--
ALTER TABLE `class_names`
  ADD CONSTRAINT `class_names_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_subject_models`
--
ALTER TABLE `class_subject_models`
  ADD CONSTRAINT `class_subject_models_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class_names` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_subject_models_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_subject_models_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject_models` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD CONSTRAINT `exam_schedules_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class_names` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_schedules_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_schedules_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject_models` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `home_works`
--
ALTER TABLE `home_works`
  ADD CONSTRAINT `home_works_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class_names` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `home_works_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject_models` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `home_works_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_modals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `libraries`
--
ALTER TABLE `libraries`
  ADD CONSTRAINT `libraries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class_names` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marks_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student_modals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marks_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject_models` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mark_grades`
--
ALTER TABLE `mark_grades`
  ADD CONSTRAINT `mark_grades_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notice_boards`
--
ALTER TABLE `notice_boards`
  ADD CONSTRAINT `notice_boards_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notice_board_messages`
--
ALTER TABLE `notice_board_messages`
  ADD CONSTRAINT `notice_board_messages_notice_board_id_foreign` FOREIGN KEY (`notice_board_id`) REFERENCES `notice_boards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parent_modals`
--
ALTER TABLE `parent_modals`
  ADD CONSTRAINT `parent_modals_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student_modals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parent_modals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD CONSTRAINT `student_attendances_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class_names` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student_modals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_homework_submissions`
--
ALTER TABLE `student_homework_submissions`
  ADD CONSTRAINT `student_homework_submissions_homework_id_foreign` FOREIGN KEY (`homework_id`) REFERENCES `home_works` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_homework_submissions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student_modals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
