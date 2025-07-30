-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2025 at 04:03 PM
-- Server version: 10.6.22-MariaDB-cll-lve-log
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardvgut_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'fahmid', 'fahmid@gmail.com', '$2b$10$SULgHwMVkCFgGU5bO9dfkeedp6KvTHVo4t1sh./gjjRzjc5GixGVa');

-- --------------------------------------------------------

--
-- Table structure for table `audios`
--

CREATE TABLE `audios` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `audio_path` varchar(255) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `view_count` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `audios`
--

INSERT INTO `audios` (`id`, `category`, `name`, `audio_path`, `img_path`, `created_at`, `view_count`) VALUES
(6, 'sleeping_sounds', 'audiotesting', 'uploads/audios/1747526919441-111374433.m4a', 'uploads/images/1747526919432-553399421.png', '2025-05-18 00:08:39', 2),
(7, 'meditation', 'audiotesting', 'uploads/audios/1747526932483-610774472.m4a', 'uploads/images/1747526932480-120053239.png', '2025-05-18 00:08:52', 5),
(8, 'short_meditation', 'audiotesting', 'uploads/audios/1747526943683-564789451.m4a', 'uploads/images/1747526943657-264289469.png', '2025-05-18 00:09:03', 2),
(9, 'motivational_audio', 'audiotesting', 'uploads/audios/1747526952163-411103562.m4a', 'uploads/images/1747526952157-347245758.png', '2025-05-18 00:09:12', 4),
(11, 'motivational_audio', 'audiotesting', 'uploads/audios/1747526958600-855660596.m4a', 'uploads/images/1747526958593-607940113.png', '2025-05-18 00:09:18', 1),
(12, 'short_meditation', 'audiotesting', 'uploads/audios/1747526962012-644015392.m4a', 'uploads/images/1747526961990-829355428.png', '2025-05-18 00:09:22', 5),
(13, 'meditation', 'audiotesting', 'uploads/audios/1747526967369-158289782.m4a', 'uploads/images/1747526967364-386082181.png', '2025-05-18 00:09:27', 5),
(14, 'cardinal_sounds', 'test', 'uploads/audios/1747682246491-120909024.mp3', 'uploads/images/1747682246467-417645390.png', '2025-05-19 19:17:26', 10),
(15, 'cardinal_sounds', 'NUMB', 'uploads/audios/1747682264587-968525404.mp3', 'uploads/images/1747682264544-102922610.png', '2025-05-19 19:17:44', 23),
(16, 'cardinal_sounds', 'ki-anondo', 'uploads/audios/1749545394746-779411079.m4a', 'uploads/images/1749545394835-849991676.png', '2025-06-10 08:49:54', 2),
(17, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:19:53', 2),
(18, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:21:35', 2),
(19, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(20, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(22, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(24, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(25, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(26, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(27, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(28, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(29, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(30, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(31, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(32, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(33, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(34, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(35, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(36, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(37, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 3),
(38, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 3),
(39, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(40, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(41, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(42, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(43, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(44, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(45, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(46, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(47, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(48, 'nature_sounds', 'audiotesting', 'uploads/audios/1747526904683-201941207.m4a', 'uploads/images/1747526904657-248987314.png', '2025-06-20 18:23:33', 2),
(50, 'cardinal_sounds', 'Shukh Pakhi', 'uploads/audios/1750450369707-96982881.m4a', 'uploads/images/1750450369821-19087417.png', '2025-06-20 20:12:49', 10);

-- --------------------------------------------------------

--
-- Table structure for table `audio_keywords`
--

CREATE TABLE `audio_keywords` (
  `id` int(11) NOT NULL,
  `audio_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `audio_keywords`
--

INSERT INTO `audio_keywords` (`id`, `audio_id`, `keyword`) VALUES
(16, 15, 'popular'),
(2, 15, 'latest'),
(3, 15, 'grief_loss'),
(4, 2, 'grief_loss'),
(5, 5, 'grief_loss'),
(6, 14, 'grief_loss'),
(7, 15, 'grief_loss'),
(8, 16, 'grief_loss'),
(11, 15, 'mom_dad'),
(12, 14, 'popular'),
(13, 16, 'latest'),
(14, 7, 'popular'),
(17, 9, 'soul_neutral');

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `id` int(11) NOT NULL,
  `item_table` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`id`, `item_table`, `item_id`) VALUES
(4, 'visual', 7),
(5, 'visual', 6),
(6, 'visual', 4),
(7, 'visual', 9),
(9, 'visual', 11),
(10, 'visual', 12),
(11, 'visual', 13),
(12, 'visual', 14),
(13, 'quotes', 9),
(14, 'quotes', 10),
(15, 'quotes', 11),
(16, 'visual', 19),
(17, 'visual', 20),
(18, 'visual', 21),
(19, 'visual', 22),
(20, 'quotes', 31),
(21, 'quotes', 15),
(22, 'visual', 15);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `note` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `note`, `user_id`, `created_at`, `title`) VALUES
(1, 'sounds never die \n since the sky is shy \n enough to reflect \n enough to cry alone', 3, '2025-06-03 08:38:03', 'sound'),
(2, 'darkness in every puff', 3, '2025-06-03 08:40:13', NULL),
(3, 'darkness in every puff', 3, '2025-06-03 08:44:41', 'the Puff'),
(4, 'this is the test one note', 4, '2025-06-03 12:52:04', 'Test1'),
(5, 'this is the test one note', 4, '2025-06-03 12:52:04', 'Test1'),
(6, 'this is the test one note', 4, '2025-06-03 12:52:05', 'Test1'),
(7, 'this is the test one note, I will remain as it is. \n', 4, '2025-06-03 13:07:23', 'Test1'),
(8, 'this is the test one note, I will remain as it is. \n', 4, '2025-06-03 13:07:26', 'Test1'),
(9, 'this is the test one note', 4, '2025-06-03 13:12:10', 'Test1'),
(10, 'this is the test one note', 4, '2025-06-03 13:12:12', 'Test1'),
(11, 'this is the test one note', 4, '2025-06-03 13:13:18', 'Test2'),
(12, 'this is the test one note, I will remain as it is. \nki obostha', 4, '2025-06-03 13:15:41', 'Test1'),
(13, 'this is the test one note, I will remain as it is. \nki obostha', 4, '2025-06-03 13:15:41', 'Test1'),
(14, 'this is the test one note, I will remain as it is. \nki obostha', 4, '2025-06-03 13:15:43', 'Test1'),
(15, 'this is the test one note, I will remain as it is. \nki  obostha ', 4, '2025-06-03 13:16:11', 'Test1'),
(16, 'this is the test one note, I will remain as it is. \nki  obostha ', 4, '2025-06-03 13:16:11', 'Test1'),
(17, 'this is the test one note, I will remain as it is. \nki  obostha ', 4, '2025-06-03 13:16:11', 'Test1'),
(18, 'this is the test one note, I will remain as it is. \nnoit is not working', 4, '2025-06-03 13:18:23', 'Test1'),
(19, 'this is the test one note. Ki likhbo', 4, '2025-06-03 13:18:51', 'Test1'),
(20, 'this is the test one note. Ki likhbo', 4, '2025-06-03 13:18:51', 'Test1'),
(21, 'this is the test one note. Ki likhbo', 4, '2025-06-03 13:18:54', 'Test1'),
(22, 'this is the test one note. Ki likhbo. I am getting the point now.\n', 4, '2025-06-03 13:21:23', 'Test1'),
(23, 'this is the test one note. Ki likhbo. I am getting the point now.\n', 4, '2025-06-03 13:21:24', 'Test1'),
(24, 'this is the test one note. Ki likhbo. I am getting the point now.\n', 4, '2025-06-03 13:21:26', 'Test1'),
(25, 'this is the test one note. Ki likhbo. I am getting the point now.\n', 4, '2025-06-03 13:28:42', 'Test1'),
(26, 'this is the test one note. Ki likhbo. I am getting the point now. new1\n\n', 4, '2025-06-03 13:32:13', 'Test1'),
(27, 'this is the test one note. Ki likhbo. I am getting the point now. new1\n\n', 4, '2025-06-03 13:32:16', 'Test1'),
(28, 'this is the test one note. Ki likhbo. I am getting the point now.\n', 4, '2025-06-03 13:32:27', 'Test1'),
(29, 'this is the test one note. Ki likhbo. I am getting the point now.\n', 4, '2025-06-03 13:32:27', 'Test1'),
(30, 'this is the test one note. Ki likhbo. I am getting the point now.\n', 4, '2025-06-03 13:32:28', 'Test1'),
(31, 'this is the test one note. Ki likhbo. I am getting the point now.\n', 4, '2025-06-03 13:32:29', 'Test1'),
(32, 'this is the test one note. Ki likhbo. I am getting the point now I need to write something for this testing full lines maybe I should talk more okay that is good so there is no fear of having Mrs below anything else so basically I am doing \nadding something', 4, '2025-06-12 07:50:41', 'Test1'),
(33, 'It should work18\n', 4, '2025-06-03 14:53:16', 'Test2'),
(34, 'this test3 or 4\nsome thing\nanything \nmanything\nor nothing \nhow to do things', 4, '2025-06-03 14:54:50', 'Test3'),
(35, 'this is test 7', 4, '2025-06-03 15:23:47', 'Test4'),
(36, 'this is test 6', 4, '2025-06-03 15:28:42', 'Test6'),
(37, 'this is test 8', 4, '2025-06-03 15:33:50', 'test8'),
(38, 'this test 10 for note, updated', 4, '2025-06-12 07:51:27', 'test10'),
(39, 'this is test11, niw uodated', 4, '2025-06-12 07:53:08', 'test11'),
(40, 'This is an example feeling text', 4, '2025-06-12 09:40:32', 'This is'),
(41, 'test feeling too', 4, '2025-06-12 10:03:26', 'test feeling'),
(42, 'Test23 for final output of qoute', 4, '2025-06-12 10:29:48', 'Test23 for'),
(43, 'i am feeling awsome', 6, '2025-06-12 10:39:05', 'i am'),
(44, 'i am feeling awsome', 6, '2025-06-12 10:39:26', 'i am'),
(45, 'hello', 6, '2025-06-12 10:39:45', NULL),
(46, 'jak', 6, '2025-06-13 02:38:08', 'jak'),
(47, 'gdbbbb', 8, '2025-06-17 16:46:34', 'gd'),
(48, 'hgd', 8, '2025-06-17 16:38:58', 'hgd'),
(49, 'good', 8, '2025-06-17 18:27:05', 'good'),
(50, 'nothing i guess', 4, '2025-07-09 19:52:23', 'nothing i'),
(51, 'vulei geci ki cilo akhane', 4, '2025-07-10 06:29:49', 'vulei geci');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `is_text` tinyint(1) NOT NULL,
  `quote` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `category` varchar(50) DEFAULT NULL,
  `view_count` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `is_text`, `quote`, `created_at`, `category`, `view_count`) VALUES
(4, 0, 'uploads/quotes/1747527927898-501398558.png', '2025-05-17 20:25:27', 'top_quotes', 14),
(6, 0, 'uploads/quotes/1747528011099-890261643.png', '2025-05-17 20:26:51', 'cardinal_quotes', 9),
(7, 1, 'this is manual testing phase \n        --by Fahmid', '2025-05-17 20:27:34', 'cardinal_quotes', 1),
(8, 1, 'this is manual testing phase \n        --by Fahmid', '2025-05-17 20:27:39', 'top_quotes', 8),
(9, 0, 'uploads/quotes/1749546323380-561361725.jpg', '2025-06-10 05:05:23', 'top_quotes', 32),
(10, 0, 'uploads/quotes/1749546389065-895947418.png', '2025-06-10 05:06:29', 'top_quotes', 7),
(11, 0, 'uploads/quotes/1749546424832-782926516.png', '2025-06-10 05:07:04', 'top_quotes', 5),
(12, 0, 'uploads/quotes/1749803939097-508277284.jpg', '2025-06-13 04:38:59', 'top_quotes', 1),
(13, 0, 'uploads/quotes/1749803947565-664825150.jpg', '2025-06-13 04:39:07', 'top_quotes', 1),
(14, 0, 'uploads/quotes/1749803956092-278732709.jpg', '2025-06-13 04:39:16', 'top_quotes', 4),
(15, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 14),
(17, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(18, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(19, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(20, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(21, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 15),
(22, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 16),
(23, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(24, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(25, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(26, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(27, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(28, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(29, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(30, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(31, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(32, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 21),
(33, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(34, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(35, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(36, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(37, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(38, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(39, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(40, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(41, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(42, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(43, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(44, 1, 'few', '2025-06-20 17:10:14', 'top_quotes', 13),
(46, 1, 'Manual testing from admin panel \r\n   ----By Fahmid', '2025-06-20 17:31:10', 'cardinal_quotes', 2),
(47, 0, 'uploads/quotes/1750455114684-912720965.png', '2025-06-20 17:31:54', 'top_quotes', 1),
(48, 0, 'uploads/quotes/1750623306090-482434576.png', '2025-06-22 16:15:06', 'cardinal_quotes', 1),
(49, 0, 'uploads/quotes/1752912955117-394121541.jpg', '2025-07-19 04:15:55', 'cardinal_quotes', 1),
(50, 0, 'uploads/quotes/1752912958704-340808958.jpg', '2025-07-19 04:15:58', 'cardinal_quotes', 1),
(51, 0, 'uploads/quotes/1752912960614-917137843.jpg', '2025-07-19 04:16:00', 'cardinal_quotes', 1),
(52, 0, 'uploads/quotes/1752912960676-926951327.jpg', '2025-07-19 04:16:00', 'cardinal_quotes', 1),
(53, 0, 'uploads/quotes/1752912960987-103123083.jpg', '2025-07-19 04:16:01', 'cardinal_quotes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quote_keywords`
--

CREATE TABLE `quote_keywords` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quote_keywords`
--

INSERT INTO `quote_keywords` (`id`, `quote_id`, `keyword`) VALUES
(1, 5, 'grief_loss'),
(2, 6, 'grief_loss'),
(3, 8, 'grief_loss'),
(4, 3, 'soul_bad'),
(5, 4, 'soul_good'),
(6, 5, 'soul_awesome'),
(7, 5, 'soul_neutral'),
(8, 6, 'soul_terrible'),
(9, 9, 'grief_loss'),
(10, 10, 'grief_loss'),
(11, 11, 'grief_loss');

-- --------------------------------------------------------

--
-- Table structure for table `saved_audios`
--

CREATE TABLE `saved_audios` (
  `id` int(11) NOT NULL,
  `audio_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `saved_audios`
--

INSERT INTO `saved_audios` (`id`, `audio_id`, `user_id`) VALUES
(1, 15, 3),
(2, 15, 2),
(3, 14, 2),
(4, 15, 4),
(5, 15, 4),
(6, 15, 4),
(7, 15, 4),
(8, 15, 4),
(9, 2, 4),
(10, 2, 4),
(11, 6, 4),
(12, 3, 6),
(13, 50, 6),
(14, 14, 4),
(15, 14, 4),
(16, 14, 4),
(17, 14, 4),
(18, 14, 4),
(19, 50, 4),
(20, 38, 4),
(21, 38, 4),
(22, 7, 4),
(23, 8, 4),
(24, 8, 4),
(25, 8, 4),
(26, 9, 4),
(27, 9, 4),
(28, 11, 4),
(29, 7, 4),
(30, 14, 4),
(31, 7, 4),
(32, 50, 5);

-- --------------------------------------------------------

--
-- Table structure for table `saved_quotes`
--

CREATE TABLE `saved_quotes` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `saved_quotes`
--

INSERT INTO `saved_quotes` (`id`, `quote_id`, `user_id`) VALUES
(1, 3, 3),
(2, 4, 3),
(3, 5, 2),
(4, 7, 2),
(5, 3, 4),
(6, 4, 4),
(7, 4, 6),
(8, 3, 6),
(9, 4, 6),
(10, 8, 6),
(11, 12, 6),
(12, 32, 4),
(13, 4, 4),
(14, 7, 4),
(15, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `saved_visuals`
--

CREATE TABLE `saved_visuals` (
  `id` int(11) NOT NULL,
  `visual_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `saved_visuals`
--

INSERT INTO `saved_visuals` (`id`, `visual_id`, `user_id`) VALUES
(1, 3, 3),
(2, 5, 2),
(3, 3, 2),
(4, 4, 4),
(5, 3, 4),
(6, 3, 4),
(7, 4, 4),
(8, 12, 4),
(9, 12, 4),
(10, 12, 4),
(11, 30, 4),
(12, 12, 5),
(13, 12, 5),
(14, 12, 5),
(15, 12, 5),
(16, 12, 5),
(17, 12, 5),
(18, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `created_at`, `email`) VALUES
(1, 'bismillah', '$2b$10$UtWHrprGJgX69Ceiqj2XwuogmHXhfwUc8tUyjRUN7A5KKRFsJfi52', '2025-05-12 22:26:32', ''),
(2, 'fahmid', '$2b$10$S5pNiJKU9nc/c9LwuIcQU.JgkcBExflNy2ChQWe18DtWplUc65x6S', '2025-05-19 21:56:15', 'fahmid@gmail.com'),
(3, 'fahmid', '$2b$10$Ewp/YBNOt3pwx6QYdfFejubY1sCvY3unBrMCyecHIODx/tYzG4J4m', '2025-05-19 21:59:27', 'fahmd@gmail.com'),
(4, 'Sagor', '$2b$10$yrAOpYnGIpSpJ2dcAOVH3OlmT.9cilvzVHrFZAg..WUUz3GFeX0oK', '2025-05-24 10:09:45', 'aminulislamsagor3@gmail.com'),
(5, 'Sagor', '$2b$10$C8nphdDLNIplAGWwKB5AH.UR0JaOBTfTkL0lPJjl.TMJpp.15HUfS', '2025-05-24 10:21:10', 'aminulislamsagor23@gmail.com'),
(6, '', '$2b$10$o2MP3kuKz46OCMcT7QvEDuWDAeZPWsbK442jm/XgjvsWbFEVH3/92', '2025-06-10 18:24:48', 'fahmidsyed21@gmail.com'),
(7, 'Arifin', '$2b$10$Bxu7KwNqGYeQ1mFxXkpLruPVbCoUqNAi.WMJGm2UZM507JUE.D/Qy', '2025-06-12 10:46:06', 'arifinzaman1010@gmail.com'),
(8, 'habib', '$2b$10$YfyGgH4JE.a2GBDg6rvcWue0H5BmgE0g9/EM4Ib1P0KzbXsLTVYOK', '2025-06-13 08:52:37', 'at.habib2060@gmail.com'),
(9, 'tanvir', '$2b$10$9IBD/8sObO.yRaDJbWiCNOVaL1PQVq/tlN1aP5s0gpQiWEEeSofp.', '2025-06-13 16:58:30', 'hafizarmy1990@gmail.com'),
(10, 'niha', '$2b$10$RgWsXun4oxjVFLLNImnfvOkacPtXWDaWnmqCSHpAp4tKoNsAQyAvC', '2025-07-04 11:56:02', 'hfouzia27@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `visual_assets`
--

CREATE TABLE `visual_assets` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `view_count` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `visual_assets`
--

INSERT INTO `visual_assets` (`id`, `category`, `image_path`, `created_at`, `view_count`) VALUES
(9, 'memorial_card', 'uploads/visuals/1749546602474-681217612.png', '2025-06-10 09:10:02', 1),
(10, 'memorial_card', 'uploads/visuals/1749546621841-225860283.png', '2025-06-10 09:10:21', 1),
(11, 'memorial_card', 'uploads/visuals/1749546635347-544464244.png', '2025-06-10 09:10:35', 1),
(12, 'wallpaper', 'uploads/visuals/1749546661398-58444707.png', '2025-06-10 09:11:01', 9),
(13, 'wallpaper', 'uploads/visuals/1749546663863-539294250.png', '2025-06-10 09:11:03', 2),
(14, 'wallpaper', 'uploads/visuals/1749546677037-639132518.png', '2025-06-10 09:11:17', 1),
(15, 'wallpaper', 'uploads/visuals/1749546685993-216339841.png', '2025-06-10 09:11:26', 2),
(16, 'announcement', 'uploads/visuals/1749547181345-702092547.png', '2025-06-10 09:19:41', 2),
(18, 'wallpaper', 'uploads/visuals/1749803292788-47310599.png', '2025-06-13 08:28:12', 4),
(19, 'wallpaper', 'uploads/visuals/1749803304195-885773855.png', '2025-06-13 08:28:24', 1),
(20, 'wallpaper', 'uploads/visuals/1749803316048-75120567.png', '2025-06-13 08:28:36', 2),
(21, 'memorial_card', 'uploads/visuals/1749803382603-178708656.png', '2025-06-13 08:29:42', 1),
(22, 'memorial_card', 'uploads/visuals/1749803401639-449054515.png', '2025-06-13 08:30:01', 1),
(23, 'announcement', 'uploads/visuals/1749803588202-862842740.png', '2025-06-13 08:33:08', 2),
(25, 'wallpaper', 'uploads/visuals/1750509595143-1740760.png', '2025-06-21 12:39:55', 1),
(26, 'wallpaper', 'uploads/visuals/1750509664272-892429204.png', '2025-06-21 12:41:04', 1),
(27, 'wallpaper', 'uploads/visuals/1750509899498-437952707.png', '2025-06-21 12:44:59', 1),
(30, 'wallpaper', 'uploads/visuals/1750623676536-225588839.png', '2025-06-22 20:21:16', 1),
(31, 'announcement', 'uploads/visuals/1750690239501-105317031.png', '2025-06-23 14:50:39', 1),
(32, 'memorial_card', 'uploads/visuals/1750694505839-628466220.jpg', '2025-06-23 16:01:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visual_keywords`
--

CREATE TABLE `visual_keywords` (
  `id` int(11) NOT NULL,
  `visual_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `visual_keywords`
--

INSERT INTO `visual_keywords` (`id`, `visual_id`, `keyword`) VALUES
(3, 6, 'grief_loss'),
(4, 10, 'grief_loss'),
(5, 11, 'grief_loss'),
(6, 12, 'grief_loss'),
(7, 13, 'grief_loss'),
(8, 14, 'grief_loss'),
(9, 15, 'grief_loss'),
(12, 30, 'popular'),
(14, 9, 'grief_loss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audio_keywords`
--
ALTER TABLE `audio_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audio_id` (`audio_id`);

--
-- Indexes for table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_keywords`
--
ALTER TABLE `quote_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quote_id` (`quote_id`);

--
-- Indexes for table `saved_audios`
--
ALTER TABLE `saved_audios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_audio` (`audio_id`);

--
-- Indexes for table `saved_quotes`
--
ALTER TABLE `saved_quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_audio` (`quote_id`);

--
-- Indexes for table `saved_visuals`
--
ALTER TABLE `saved_visuals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visual_id` (`visual_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visual_assets`
--
ALTER TABLE `visual_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visual_keywords`
--
ALTER TABLE `visual_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visual_id` (`visual_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `audio_keywords`
--
ALTER TABLE `audio_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `quote_keywords`
--
ALTER TABLE `quote_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `saved_audios`
--
ALTER TABLE `saved_audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `saved_quotes`
--
ALTER TABLE `saved_quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `saved_visuals`
--
ALTER TABLE `saved_visuals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `visual_assets`
--
ALTER TABLE `visual_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `visual_keywords`
--
ALTER TABLE `visual_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
