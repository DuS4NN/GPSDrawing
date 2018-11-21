-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: St 21.Nov 2018, 16:11
-- Verzia serveru: 10.1.19-MariaDB
-- Verzia PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `gps_drawing`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `badges`
--

CREATE TABLE `badges` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rarity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `badges`
--

INSERT INTO `badges` (`id`, `name`, `url`, `rarity`) VALUES
(1, 'badge1', '/img/badge/18.png', 15),
(2, 'badge2', '/img/badge/4.png', 14),
(3, 'badge3', '/img/badge/7.png', 14),
(4, 'badge4', '/img/badge/10.png', 14),
(5, 'badge5', '/img/badge/13.png', 14),
(6, 'badge6', '/img/badge/5.png', 13),
(7, 'badge7', '/img/badge/8.png', 13),
(8, 'badge8', '/img/badge/11.png', 13),
(9, 'badge9', '/img/badge/14.png', 13),
(10, 'badge10', '/img/badge/6.png', 12),
(11, 'badge11', '/img/badge/9.png', 12),
(12, 'badge12', '/img/badge/12.png', 12),
(13, 'badge13', '/img/badge/15.png', 12),
(14, 'badge14', '/img/badge/2.png', 11),
(15, 'badge15', '/img/badge/3.png', 11),
(16, 'badge16', '/img/badge/16.png', 11),
(17, 'badge17', '/img/badge/17.png', 11),
(18, 'badge18', '/img/badge/19.png', 10),
(19, 'badge19', '/img/badge/20.png', 10),
(20, 'badge20', '/img/badge/21.png', 10),
(21, 'badge21', '/img/badge/22.png', 10),
(22, 'badge22', '/img/badge/23.png', 14),
(23, 'badge23', '/img/badge/24.png', 13),
(24, 'badge24', '/img/badge/25.png', 12);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `blocked_comments`
--

CREATE TABLE `blocked_comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `blocked_posts`
--

CREATE TABLE `blocked_posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `blocked_users`
--

CREATE TABLE `blocked_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blocked` int(11) DEFAULT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `id_user`, `id_post`) VALUES
(132, 1, 3),
(201, 1, 17),
(213, 1, 30),
(215, 1, 20),
(216, 1, 85),
(217, 1, 67);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `collaboration`
--

CREATE TABLE `collaboration` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `collaboration`
--

INSERT INTO `collaboration` (`id`, `id_post`) VALUES
(1, 4),
(31, 59);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `comment` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `id_post`, `comment`, `time`) VALUES
(2, 1, 2, 'lul', '2018-07-13 19:52'),
(3, 1, 2, 'ds', '2018-07-13 19:52'),
(4, 1, 2, 'Ahoj', '2018-07-13 19:54'),
(5, 1, 2, 'Cus', '2018-07-13 19:55'),
(6, 1, 1, 'Ahoj', '2018-07-13 20:12'),
(7, 1, 2, 'Ccc', '2018-07-13 20:18'),
(8, 1, 2, 'Ahoj', '2018-07-13 20:18'),
(9, 1, 2, 'Uuu', '2018-07-13 20:18'),
(10, 1, 1, 'as', '2018-07-13 20:25'),
(12, 1, 1, 'f', '2018-07-13 20:25'),
(14, 1, 1, 'ad', '2018-07-13 20:25'),
(18, 1, 1, 'sdf', '2018-07-13 20:25'),
(19, 1, 1, 'ag', '2018-07-13 20:25'),
(20, 1, 2, 'Cus', '2018-07-13 20:38'),
(32, 1, 2, 'jm', '2018-07-13 20:42'),
(33, 1, 2, 'kfh', '2018-07-13 20:42'),
(34, 1, 2, 'To nejako nefunguje', '2018-07-13 20:42'),
(35, 1, 2, 'df', '2018-07-13 20:44'),
(36, 1, 2, 's', '2018-07-14 07:54'),
(37, 1, 2, 'sss', '2018-07-14 07:56'),
(38, 1, 2, 'asd', '2018-07-14 07:56'),
(42, 1, 2, 'afd', '2018-07-14 07:59'),
(47, 1, 3, 'Pekná spolupráca', '2018-07-16 08:39'),
(49, 1, 3, ' Ahoj', '2018-07-16 11:17'),
(50, 2, 3, 'Aj ja si myslim, ze je to velmi pekne', '2018-07-16 11:25'),
(65, 1, 2, 'Ahoj', '2018-07-17 12:57'),
(67, 2, 4, 'Pekne sme to urobili.', '2018-07-28 07:54'),
(68, 1, 4, 'Veľmi sa mi to páči.', '2018-07-28 08:27'),
(70, 1, 5, 'Pekné', '2018-07-28 12:59'),
(71, 1, 6, 'sda', '2018-08-15 14:02'),
(72, 1, 6, '&#x1f60d', '2018-08-15 14:02'),
(73, 1, 9, 'Paci sa mi to', '2018-08-16 14:26'),
(75, 1, 9, ' Hm dost dobre.', '2018-08-16 14:26'),
(76, 1, 9, 'Je to skareed', '2018-08-16 14:26'),
(77, 1, 9, 'Nepaci sa mi to', '2018-08-16 14:26'),
(120, 2, 4, 'nice', '2018-08-16 16:02'),
(121, 2, 4, 'velmi pekne', '2018-08-16 16:02'),
(122, 2, 4, 'super', '2018-08-16 16:02'),
(123, 2, 4, 'paci sa mi to', '2018-08-16 16:02'),
(126, 1, 12, 'fff', '2018-08-18 09:14'),
(127, 1, 10, 'Nice', '2018-08-18 09:15'),
(154, 1, 11, 'dsa', '2018-08-18 12:29'),
(155, 1, 11, 'f', '2018-08-18 12:29'),
(156, 1, 11, 'a', '2018-08-18 12:29'),
(157, 1, 11, 'df', '2018-08-18 12:29'),
(159, 1, 11, ' dd', '2018-08-18 12:29'),
(160, 1, 17, 'Pekne', '2018-08-18 20:12'),
(161, 1, 9, 'ss', '2018-08-25 12:09'),
(162, 1, 9, 'dsa', '2018-08-25 12:09'),
(163, 1, 9, 'd', '2018-08-25 12:11'),
(164, 1, 16, 's', '2018-08-25 12:11'),
(165, 1, 17, 'jo', '2018-08-25 12:11'),
(166, 1, 18, 'g', '2018-08-25 12:12'),
(170, 1, 10, 's', '2018-08-25 12:15'),
(171, 2, 18, 'Ahoj ako sa mas ja sa mam velmi dobre, toto je fakt pekný obrázok. Test dlhého komentáru. kolko mozem pisat a tak dalej. Toto je dost dlhy komentar. Ahoj ako sa mas ja sa mam velmi dobre, toto je fakt pekný obrázok. Test dlhého komentáru. kolko mozem pisat a tak dalej. Toto je dost dlhy komentar. ', '2018-08-25 12:53'),
(172, 3, 18, 'Dost pekné si myslim', '2018-08-25 13:00'),
(173, 3, 18, 'Hej je to nice', '2018-08-25 13:01'),
(174, 3, 18, 'very nice', '2018-08-25 13:01'),
(175, 3, 16, 'asdf', '2018-08-25 13:01'),
(176, 3, 15, 'Pekne', '2018-08-25 13:01'),
(177, 3, 9, 'Hmm', '2018-08-25 13:01'),
(178, 3, 10, 'haha', '2018-08-25 13:01'),
(179, 3, 4, ':)', '2018-08-25 13:01'),
(180, 3, 4, 'asd', '2018-08-25 13:01'),
(181, 3, 4, 'fasd', '2018-08-25 13:01'),
(183, 1, 18, 'Všetko ide', '2018-08-28 15:08'),
(184, 1, 20, 'pekne', '2018-09-01 10:49'),
(192, 2, 22, 'Pekné', '2018-09-01 11:29'),
(193, 2, 15, 'Nice', '2018-09-01 11:30'),
(194, 1, 20, 'Jo', '2018-09-01 12:54'),
(195, 1, 20, 'Aa', '2018-09-01 12:54'),
(196, 2, 4, 'Tak toto je mega', '2018-09-01 12:59'),
(197, 2, 22, 'Pekne pekne', '2018-09-01 12:59'),
(198, 3, 22, 'Very nice', '2018-09-03 10:03'),
(199, 3, 15, 'Pekne ze', '2018-09-03 10:03'),
(200, 3, 4, 'Jo', '2018-09-03 10:03'),
(201, 3, 4, 'Comment 1', '2018-09-03 10:03'),
(202, 3, 4, 'Comment 2', '2018-09-03 10:03'),
(203, 2, 22, 'lol', '2018-09-03 10:21'),
(204, 2, 22, 'lol', '2018-09-03 10:21'),
(205, 2, 4, 'nice', '2018-09-08 10:43'),
(206, 1, 18, 'Ahoj', '2018-09-26 10:06'),
(207, 1, 18, 'Ano', '2018-09-26 10:14'),
(208, 1, 18, 'ANO', '2018-09-26 10:14'),
(209, 1, 18, 'Nie', '2018-09-26 10:14'),
(210, 1, 18, 'NIE', '2018-09-26 10:14'),
(211, 1, 18, 'LOL', '2018-09-26 10:14'),
(212, 1, 18, 'LUL', '2018-09-26 10:14'),
(213, 1, 18, 'OMEGALUL', '2018-09-26 10:14'),
(221, 1, 30, 'dsň', '2018-09-28 08:11'),
(222, 1, 30, ' sdsa', '2018-09-28 08:12'),
(225, 1, 30, 'fg', '2018-09-28 08:14'),
(226, 1, 30, 'd', '2018-09-28 08:14'),
(227, 1, 30, 'f', '2018-09-28 08:14'),
(229, 1, 30, 'g', '2018-09-28 08:16'),
(230, 1, 30, 'd', '2018-09-28 08:16'),
(235, 1, 30, 'Ahoj', '2018-09-28 08:21'),
(236, 1, 30, 'Ako', '2018-09-28 08:21'),
(237, 1, 30, 'Sa ', '2018-09-28 08:21'),
(238, 1, 30, 'Mas', '2018-09-28 08:21'),
(239, 1, 30, 'Lul', '2018-09-28 08:21'),
(240, 1, 30, 'AAA', '2018-09-28 08:22'),
(241, 1, 30, 'bBBB', '2018-09-28 08:22'),
(242, 1, 30, 'ccc', '2018-09-28 08:22'),
(243, 1, 30, 'dddd', '2018-09-28 08:22'),
(244, 1, 30, 'asd', '2018-09-28 08:22'),
(245, 1, 30, 'asd', '2018-09-28 08:22'),
(246, 1, 30, 'asda', '2018-09-28 08:22'),
(247, 1, 59, 'Pekný robot', '2018-09-28 11:57'),
(248, 1, 59, 'Ten sa nám teda podaril', '2018-09-28 11:57'),
(250, 1, 30, ' DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD', '2018-09-30 07:46'),
(251, 1, 59, 'A', '2018-10-03 13:01'),
(252, 1, 59, 'B', '2018-10-03 13:01'),
(253, 1, 59, 'C', '2018-10-03 13:01'),
(254, 1, 59, 'D', '2018-10-03 13:01'),
(255, 1, 59, 'E', '2018-10-03 13:01'),
(256, 1, 59, 'F', '2018-10-03 13:01'),
(257, 1, 59, 'G', '2018-10-03 13:01'),
(258, 1, 59, 'H', '2018-10-03 13:01'),
(259, 1, 59, 'I', '2018-10-03 13:01'),
(260, 1, 59, 'J', '2018-10-03 13:01'),
(261, 1, 59, 'K', '2018-10-03 13:01'),
(262, 1, 59, 'L', '2018-10-03 13:01'),
(263, 1, 59, 'M', '2018-10-03 13:01'),
(264, 1, 59, 'N', '2018-10-03 13:01'),
(265, 1, 59, 'O', '2018-10-03 13:01'),
(266, 1, 59, 'P', '2018-10-03 13:01'),
(271, 1, 64, ' mjxccc', '2018-10-13 10:39'),
(272, 1, 29, 'jn', '2018-10-13 10:49'),
(275, 1, 22, ' dsa  😀', '2018-11-10 14:42'),
(277, 1, 22, ' 😄 😄', '2018-11-10 14:43'),
(279, 1, 20, ' 😈', '2018-11-10 14:50'),
(281, 1, 30, ' 😇 🤗', '2018-11-10 16:21'),
(284, 1, 88, 'asd', '2018-11-11 10:31');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `followers`
--

INSERT INTO `followers` (`id`, `follower`, `id_user`, `date`) VALUES
(62, 3, 2, '2018-08-25 13:00'),
(67, 1, 5, '2018-08-30 16:06'),
(69, 2, 1, '2018-09-01 12:59'),
(70, 3, 1, '2018-09-03 10:03'),
(79, 2, 4, '2018-10-19 12:02'),
(80, 3, 6, '2018-10-19 12:04'),
(81, 3, 4, '2018-10-18 12:54'),
(113, 1, 3, '2018-10-20 11:50'),
(128, 1, 2, '2018-11-01 08:38');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `likes`
--

INSERT INTO `likes` (`id`, `id_post`, `id_user`, `date`) VALUES
(1, 2, 5, '2018-10-19 12:02'),
(2, 1, 5, '2018-10-19 12:02'),
(69, 1, 2, '2018-10-19 12:02'),
(70, 3, 2, '2018-10-19 12:02'),
(71, 2, 2, '2018-10-19 12:02'),
(79, 4, 1, '2018-10-19 12:02'),
(82, 6, 1, '2018-10-19 12:02'),
(83, 5, 1, '2018-10-03 12:02'),
(84, 9, 1, '2018-10-05 12:02'),
(85, 14, 1, '2018-10-10 12:02'),
(86, 9, 2, '2018-10-10 12:02'),
(87, 11, 1, '2018-10-10 12:02'),
(88, 10, 1, '2018-10-12 12:02'),
(89, 17, 1, '2018-10-12 12:02'),
(90, 16, 1, '2018-10-12 12:02'),
(91, 18, 1, '2018-10-13 12:02'),
(92, 1, 1, '2018-10-14 12:02'),
(96, 15, 1, '2018-10-15 12:02'),
(100, 21, 1, '2018-10-15 12:02'),
(101, 19, 1, '2018-10-16 12:02'),
(108, 15, 2, '2018-10-16 12:02'),
(109, 22, 2, '2018-10-17 12:02'),
(110, 18, 2, '2018-10-17 12:02'),
(111, 22, 3, '2018-10-18 12:02'),
(112, 18, 3, '2018-10-18 12:02'),
(113, 15, 3, '2018-10-18 12:02'),
(114, 4, 3, '2018-10-19 12:02'),
(117, 23, 1, '2018-10-19 12:02'),
(118, 4, 2, '2018-10-19 12:02'),
(125, 28, 1, '2018-10-19 12:02'),
(126, 59, 1, '2018-10-19 12:02'),
(127, 63, 1, '2018-10-19 12:02'),
(150, 64, 1, '2018-10-19 12:02'),
(161, 20, 1, '2018-10-19 12:02'),
(166, 29, 1, '2018-10-20 10:04'),
(169, 67, 1, '2018-10-20 11:52'),
(173, 30, 1, '2018-11-01 09:01'),
(174, 22, 1, '2018-11-01 09:05'),
(178, 75, 1, '2018-11-01 09:08'),
(179, 22, 7, '2018-11-08 14:40'),
(180, 77, 7, '2018-11-08 15:35');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `map_theme`
--

CREATE TABLE `map_theme` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `map_theme`
--

INSERT INTO `map_theme` (`id`, `name`, `code`) VALUES
(1, 'Default', '[]'),
(2, 'Ultra Light', '[\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#e9e9e9"\r\n            },\r\n            {\r\n                "lightness": 17\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#f5f5f5"\r\n            },\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            },\r\n            {\r\n                "lightness": 17\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            },\r\n            {\r\n                "lightness": 29\r\n            },\r\n            {\r\n                "weight": 0.2\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            },\r\n            {\r\n                "lightness": 18\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.local",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            },\r\n            {\r\n                "lightness": 16\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#f5f5f5"\r\n            },\r\n            {\r\n                "lightness": 21\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#dedede"\r\n            },\r\n            {\r\n                "lightness": 21\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#ffffff"\r\n            },\r\n            {\r\n                "lightness": 16\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "saturation": 36\r\n            },\r\n            {\r\n                "color": "#333333"\r\n            },\r\n            {\r\n                "lightness": 40\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#f2f2f2"\r\n            },\r\n            {\r\n                "lightness": 19\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#fefefe"\r\n            },\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#fefefe"\r\n            },\r\n            {\r\n                "lightness": 17\r\n            },\r\n            {\r\n                "weight": 1.2\r\n            }\r\n        ]\r\n    }\r\n]'),
(3, 'Dark Yellow', '[\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "saturation": 36\r\n            },\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 40\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 16\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 17\r\n            },\r\n            {\r\n                "weight": 1.2\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative.province",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#e3b141"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative.locality",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#e0a64b"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative.locality",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#0e0d0a"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative.neighborhood",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#d1b995"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 21\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#12120f"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "lightness": "-77"\r\n            },\r\n            {\r\n                "gamma": "4.48"\r\n            },\r\n            {\r\n                "saturation": "24"\r\n            },\r\n            {\r\n                "weight": "0.65"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "lightness": 29\r\n            },\r\n            {\r\n                "weight": 0.2\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway.controlled_access",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#f6b044"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#4f4e49"\r\n            },\r\n            {\r\n                "weight": "0.36"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#c4ac87"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#262307"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.local",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#a4875a"\r\n            },\r\n            {\r\n                "lightness": 16\r\n            },\r\n            {\r\n                "weight": "0.16"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.local",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#deb483"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 19\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#0f252e"\r\n            },\r\n            {\r\n                "lightness": 17\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#080808"\r\n            },\r\n            {\r\n                "gamma": "3.14"\r\n            },\r\n            {\r\n                "weight": "1.07"\r\n            }\r\n        ]\r\n    }\r\n]'),
(4, 'Black Grey', '[\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "saturation": 36\r\n            },\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 40\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 16\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 17\r\n            },\r\n            {\r\n                "weight": 1.2\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 21\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 17\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 29\r\n            },\r\n            {\r\n                "weight": 0.2\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 18\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.local",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 16\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 19\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#000000"\r\n            },\r\n            {\r\n                "lightness": 17\r\n            }\r\n        ]\r\n    }\r\n]'),
(5, 'White Blue', '[\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#444444"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#f2f2f2"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "saturation": -100\r\n            },\r\n            {\r\n                "lightness": 45\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#46bcec"\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    }\r\n]'),
(6, 'Vintage', '\r\n\r\n[\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#ff7000"\r\n            },\r\n            {\r\n                "lightness": "69"\r\n            },\r\n            {\r\n                "saturation": "100"\r\n            },\r\n            {\r\n                "weight": "1.17"\r\n            },\r\n            {\r\n                "gamma": "2.04"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#cb8536"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffb471"\r\n            },\r\n            {\r\n                "lightness": "66"\r\n            },\r\n            {\r\n                "saturation": "100"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "gamma": 0.01\r\n            },\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "saturation": -31\r\n            },\r\n            {\r\n                "lightness": -33\r\n            },\r\n            {\r\n                "weight": 2\r\n            },\r\n            {\r\n                "gamma": 0.8\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "lightness": "-8"\r\n            },\r\n            {\r\n                "gamma": "0.98"\r\n            },\r\n            {\r\n                "weight": "2.45"\r\n            },\r\n            {\r\n                "saturation": "26"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "lightness": 30\r\n            },\r\n            {\r\n                "saturation": 30\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "saturation": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "lightness": 20\r\n            },\r\n            {\r\n                "saturation": -20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "lightness": 10\r\n            },\r\n            {\r\n                "saturation": -30\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "saturation": 25\r\n            },\r\n            {\r\n                "lightness": 25\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "lightness": -20\r\n            },\r\n            {\r\n                "color": "#ecc080"\r\n            }\r\n        ]\r\n    }\r\n]\r\n\r\n'),
(7, 'Bright Bubbly', '[\r\n    {\r\n        "featureType": "water",\r\n        "stylers": [\r\n            {\r\n                "color": "#19a0d8"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            },\r\n            {\r\n                "weight": 6\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#e85113"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#efe9e4"\r\n            },\r\n            {\r\n                "lightness": -40\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#efe9e4"\r\n            },\r\n            {\r\n                "lightness": -20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "lightness": 100\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "lightness": -100\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "labels.icon"\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "stylers": [\r\n            {\r\n                "lightness": 20\r\n            },\r\n            {\r\n                "color": "#efe9e4"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape.man_made",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "lightness": 100\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "lightness": -100\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "hue": "#11ff00"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "lightness": 100\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "hue": "#4cff00"\r\n            },\r\n            {\r\n                "saturation": 58\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#f0e4d3"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#efe9e4"\r\n            },\r\n            {\r\n                "lightness": -25\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#efe9e4"\r\n            },\r\n            {\r\n                "lightness": -10\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    }\r\n]'),
(8, 'Even Lighter', '[\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#6195a0"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#f2f2f2"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#e6f3d6"\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "saturation": -100\r\n            },\r\n            {\r\n                "lightness": 45\r\n            },\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#f4d2c5"\r\n            },\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "labels.text",\r\n        "stylers": [\r\n            {\r\n                "color": "#4e4e4e"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#f4f4f4"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#787878"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#eaf6f8"\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#eaf6f8"\r\n            }\r\n        ]\r\n    }\r\n]'),
(9, 'Red Hues', 'styles: [\r\n                    {\r\n                        "stylers": [\r\n                            {\r\n                                "hue": "#dd0d0d"\r\n                            }\r\n                        ]\r\n                    },\r\n                    {\r\n                        "featureType": "road",\r\n                        "elementType": "labels",\r\n                        "stylers": [\r\n                            {\r\n                                "visibility": "off"\r\n                            }\r\n                        ]\r\n                    },\r\n                    {\r\n                        "featureType": "road",\r\n                        "elementType": "geometry",\r\n                        "stylers": [\r\n                            {\r\n                                "lightness": 100\r\n                            },\r\n                            {\r\n                                "visibility": "simplified"\r\n                            }\r\n                        ]\r\n                    }\r\n                ]'),
(10, 'Dark Red', '"[\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"all\\",\\n" +\r\n        "        \\"elementType\\": \\"labels.text.fill\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#ffffff\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"all\\",\\n" +\r\n        "        \\"elementType\\": \\"labels.text.stroke\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"visibility\\": \\"off\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"all\\",\\n" +\r\n        "        \\"elementType\\": \\"labels.icon\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"visibility\\": \\"off\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"administrative\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry.fill\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#c9323b\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"administrative\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry.stroke\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#c9323b\\"\\n" +\r\n        "            },\\n" +\r\n        "            {\\n" +\r\n        "                \\"weight\\": 1.2\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"administrative.locality\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry.fill\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"lightness\\": \\"-1\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"administrative.neighborhood\\",\\n" +\r\n        "        \\"elementType\\": \\"labels.text.fill\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"lightness\\": \\"0\\"\\n" +\r\n        "            },\\n" +\r\n        "            {\\n" +\r\n        "                \\"saturation\\": \\"0\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"administrative.neighborhood\\",\\n" +\r\n        "        \\"elementType\\": \\"labels.text.stroke\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"weight\\": \\"0.01\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"administrative.land_parcel\\",\\n" +\r\n        "        \\"elementType\\": \\"labels.text.stroke\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"weight\\": \\"0.01\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"landscape\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#c9323b\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"poi\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#99282f\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"road\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry.stroke\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"visibility\\": \\"off\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"road.highway\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry.fill\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#99282f\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"road.highway.controlled_access\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry.stroke\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#99282f\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"road.arterial\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#99282f\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"road.local\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#99282f\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"transit\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#99282f\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    },\\n" +\r\n        "    {\\n" +\r\n        "        \\"featureType\\": \\"water\\",\\n" +\r\n        "        \\"elementType\\": \\"geometry\\",\\n" +\r\n        "        \\"stylers\\": [\\n" +\r\n        "            {\\n" +\r\n        "                \\"color\\": \\"#090228\\"\\n" +\r\n        "            }\\n" +\r\n        "        ]\\n" +\r\n        "    }\\n" +\r\n        "]"'),
(11, 'Turquoise Water', '[\r\n    {\r\n        "stylers": [\r\n            {\r\n                "hue": "#16a085"\r\n            },\r\n            {\r\n                "saturation": 0\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "lightness": 100\r\n            },\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    }\r\n]'),
(12, 'Brown Grey', '[\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "hue": "#ffaa00"\r\n            },\r\n            {\r\n                "saturation": "-33"\r\n            },\r\n            {\r\n                "lightness": "10"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative.locality",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#9c5e18"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape.natural.terrain",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "labels.text",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit.line",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "saturation": "-23"\r\n            },\r\n            {\r\n                "gamma": "2.01"\r\n            },\r\n            {\r\n                "color": "#f2f6f6"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "saturation": "-14"\r\n            }\r\n        ]\r\n    }\r\n]'),
(13, 'Pale Dawn', '[\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "lightness": 33\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#f2e5d4"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#c5dac6"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#c5c6c6"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#e4d7c6"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.local",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#fbfaf7"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#acbcc9"\r\n            }\r\n        ]\r\n    }\r\n]'),
(14, 'Neutral Blue', '\r\n\r\n[\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#193341"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#2c5a71"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#29768a"\r\n            },\r\n            {\r\n                "lightness": -37\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#406d80"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#406d80"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#3e606f"\r\n            },\r\n            {\r\n                "weight": 2\r\n            },\r\n            {\r\n                "gamma": 0.84\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "weight": 0.6\r\n            },\r\n            {\r\n                "color": "#1a3541"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#2c5a71"\r\n            }\r\n        ]\r\n    }\r\n]\r\n\r\n'),
(15, 'Gray', '[\r\n    {\r\n        "featureType": "water",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#b5cbe4"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "stylers": [\r\n            {\r\n                "color": "#efefef"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#83a5b0"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#bdcdd3"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.local",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "color": "#e3eed3"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "lightness": 33\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road"\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    },\r\n    {},\r\n    {\r\n        "featureType": "road",\r\n        "stylers": [\r\n            {\r\n                "lightness": 20\r\n            }\r\n        ]\r\n    }\r\n]');
INSERT INTO `map_theme` (`id`, `name`, `code`) VALUES
(16, 'Light Pink', '\r\n\r\n[\r\n    {\r\n        "featureType": "all",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            },\r\n            {\r\n                "color": "#a31645"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "weight": "3.79"\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#ffecf0"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            },\r\n            {\r\n                "color": "#a31645"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "saturation": "0"\r\n            },\r\n            {\r\n                "lightness": "0"\r\n            },\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.business",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            },\r\n            {\r\n                "color": "#d89ca8"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.business",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.business",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "saturation": "0"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.business",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "color": "#a31645"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.business",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            },\r\n            {\r\n                "lightness": "84"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "saturation": -100\r\n            },\r\n            {\r\n                "lightness": 45\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#d89ca8"\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#fedce3"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    }\r\n]\r\n\r\n'),
(17, 'Basic', '[\r\n    {\r\n        "featureType": "water",\r\n        "stylers": [\r\n            {\r\n                "saturation": 43\r\n            },\r\n            {\r\n                "lightness": -11\r\n            },\r\n            {\r\n                "hue": "#0088ff"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "hue": "#ff0000"\r\n            },\r\n            {\r\n                "saturation": -100\r\n            },\r\n            {\r\n                "lightness": 99\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "geometry.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#808080"\r\n            },\r\n            {\r\n                "lightness": 54\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape.man_made",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#ece2d9"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#ccdca1"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#767676"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "labels.text.stroke",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape.natural",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            },\r\n            {\r\n                "color": "#b8cb93"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.sports_complex",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.medical",\r\n        "stylers": [\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.business",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    }\r\n]'),
(18, 'Classic', '[\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "hue": "#7fc8ed"\r\n            },\r\n            {\r\n                "saturation": 55\r\n            },\r\n            {\r\n                "lightness": -6\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "hue": "#7fc8ed"\r\n            },\r\n            {\r\n                "saturation": 55\r\n            },\r\n            {\r\n                "lightness": -6\r\n            },\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "hue": "#83cead"\r\n            },\r\n            {\r\n                "saturation": 1\r\n            },\r\n            {\r\n                "lightness": -15\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "hue": "#f3f4f4"\r\n            },\r\n            {\r\n                "saturation": -84\r\n            },\r\n            {\r\n                "lightness": 59\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "hue": "#ffffff"\r\n            },\r\n            {\r\n                "saturation": -100\r\n            },\r\n            {\r\n                "lightness": 100\r\n            },\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "hue": "#ffffff"\r\n            },\r\n            {\r\n                "saturation": -100\r\n            },\r\n            {\r\n                "lightness": 100\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "labels",\r\n        "stylers": [\r\n            {\r\n                "hue": "#bbbbbb"\r\n            },\r\n            {\r\n                "saturation": -100\r\n            },\r\n            {\r\n                "lightness": 26\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "hue": "#ffcc00"\r\n            },\r\n            {\r\n                "saturation": 100\r\n            },\r\n            {\r\n                "lightness": -35\r\n            },\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry",\r\n        "stylers": [\r\n            {\r\n                "hue": "#ffcc00"\r\n            },\r\n            {\r\n                "saturation": 100\r\n            },\r\n            {\r\n                "lightness": -22\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.school",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "hue": "#d7e4e4"\r\n            },\r\n            {\r\n                "saturation": -60\r\n            },\r\n            {\r\n                "lightness": 23\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    }\r\n]'),
(19, 'Light colors', '[\r\n    {\r\n        "featureType": "administrative",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#5d7e9e"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#f2f2f2"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "landscape",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#ffffff"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "poi.park",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#e6f3d6"\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "saturation": -100\r\n            },\r\n            {\r\n                "lightness": 45\r\n            },\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "visibility": "simplified"\r\n            },\r\n            {\r\n                "color": "#f4a8a8"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.highway",\r\n        "elementType": "labels.text",\r\n        "stylers": [\r\n            {\r\n                "color": "#4e4e4e"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#f4f4f4"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "labels.text.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#787878"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "road.arterial",\r\n        "elementType": "labels.icon",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "transit",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "visibility": "off"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "all",\r\n        "stylers": [\r\n            {\r\n                "color": "#eaf6f8"\r\n            },\r\n            {\r\n                "visibility": "on"\r\n            }\r\n        ]\r\n    },\r\n    {\r\n        "featureType": "water",\r\n        "elementType": "geometry.fill",\r\n        "stylers": [\r\n            {\r\n                "color": "#eaf6f8"\r\n            }\r\n        ]\r\n    }\r\n]'),
(20, 'Dark', '[\r\n            {elementType: ''geometry'', stylers: [{color: ''#242f3e''}]},\r\n            {elementType: ''labels.text.stroke'', stylers: [{color: ''#242f3e''}]},\r\n            {elementType: ''labels.text.fill'', stylers: [{color: ''#746855''}]},\r\n            {\r\n              featureType: ''administrative.locality'',\r\n              elementType: ''labels.text.fill'',\r\n              stylers: [{color: ''#d59563''}]\r\n            },\r\n            {\r\n              featureType: ''poi'',\r\n              elementType: ''labels.text.fill'',\r\n              stylers: [{color: ''#d59563''}]\r\n            },\r\n            {\r\n              featureType: ''poi.park'',\r\n              elementType: ''geometry'',\r\n              stylers: [{color: ''#263c3f''}]\r\n            },\r\n            {\r\n              featureType: ''poi.park'',\r\n              elementType: ''labels.text.fill'',\r\n              stylers: [{color: ''#6b9a76''}]\r\n            },\r\n            {\r\n              featureType: ''road'',\r\n              elementType: ''geometry'',\r\n              stylers: [{color: ''#38414e''}]\r\n            },\r\n            {\r\n              featureType: ''road'',\r\n              elementType: ''geometry.stroke'',\r\n              stylers: [{color: ''#212a37''}]\r\n            },\r\n            {\r\n              featureType: ''road'',\r\n              elementType: ''labels.text.fill'',\r\n              stylers: [{color: ''#9ca5b3''}]\r\n            },\r\n            {\r\n              featureType: ''road.highway'',\r\n              elementType: ''geometry'',\r\n              stylers: [{color: ''#746855''}]\r\n            },\r\n            {\r\n              featureType: ''road.highway'',\r\n              elementType: ''geometry.stroke'',\r\n              stylers: [{color: ''#1f2835''}]\r\n            },\r\n            {\r\n              featureType: ''road.highway'',\r\n              elementType: ''labels.text.fill'',\r\n              stylers: [{color: ''#f3d19c''}]\r\n            },\r\n            {\r\n              featureType: ''transit'',\r\n              elementType: ''geometry'',\r\n              stylers: [{color: ''#2f3948''}]\r\n            },\r\n            {\r\n              featureType: ''transit.station'',\r\n              elementType: ''labels.text.fill'',\r\n              stylers: [{color: ''#d59563''}]\r\n            },\r\n            {\r\n              featureType: ''water'',\r\n              elementType: ''geometry'',\r\n              stylers: [{color: ''#17263c''}]\r\n            },\r\n            {\r\n              featureType: ''water'',\r\n              elementType: ''labels.text.fill'',\r\n              stylers: [{color: ''#515c6d''}]\r\n            },\r\n            {\r\n              featureType: ''water'',\r\n              elementType: ''labels.text.stroke'',\r\n              stylers: [{color: ''#17263c''}]\r\n            }\r\n          ]\r\n');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `post_user_id` int(11) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `action`, `post_user_id`, `view`, `date`) VALUES
(1, 1, 3, 20, 0, '2018-09-01 12:54'),
(3, 2, 3, 4, 1, '2018-09-01 12:59'),
(4, 2, 2, 1, 1, '2018-09-01 12:59'),
(5, 2, 3, 22, 1, '2018-09-01 12:59'),
(6, 2, 1, 22, 1, '2018-09-01 13:00'),
(7, 2, 1, 18, 1, '2018-09-01 13:00'),
(8, 3, 1, 22, 1, '2018-09-03 10:03'),
(9, 3, 3, 22, 1, '2018-09-03 10:03'),
(10, 3, 1, 18, 1, '2018-09-03 10:03'),
(11, 3, 2, 1, 1, '2018-09-03 10:03'),
(12, 3, 1, 15, 1, '2018-09-03 10:03'),
(13, 3, 3, 15, 1, '2018-09-03 10:03'),
(14, 3, 1, 4, 1, '2018-09-03 10:03'),
(15, 3, 3, 4, 1, '2018-09-03 10:03'),
(16, 3, 3, 4, 1, '2018-09-03 10:03'),
(17, 3, 3, 4, 1, '2018-09-03 10:03'),
(18, 2, 3, 22, 1, '2018-09-03 10:21'),
(19, 2, 3, 22, 1, '2018-09-03 10:21'),
(20, 1, 1, 22, 1, '2018-09-07 06:49'),
(21, 1, 4, 1, 1, '2018-09-07 06:49'),
(22, 1, 1, 22, 1, '2018-09-07 07:16'),
(23, 1, 1, 23, 1, '2018-09-08 08:02'),
(24, 1, 5, 1, 1, '2018-09-08 10:37'),
(25, 2, 1, 4, 1, '2018-09-08 10:43'),
(26, 2, 3, 4, 1, '2018-09-08 10:43'),
(27, 2, 5, 22, 1, '2018-09-08 10:49'),
(28, 2, 5, 22, 1, '2018-09-08 10:50'),
(29, 2, 5, 22, 1, '2018-09-08 10:50'),
(30, 2, 5, 22, 1, '2018-09-08 10:51'),
(31, 2, 5, 22, 1, '2018-09-08 10:52'),
(32, 2, 5, 22, 1, '2018-09-08 10:52'),
(33, 2, 5, 22, 1, '2018-09-08 10:53'),
(34, 1, 5, 28, 1, '2018-09-08 13:22'),
(35, 1, 5, 29, 0, '2018-09-08 13:23'),
(36, 1, 5, 30, 1, '2018-09-08 13:23'),
(37, 1, 1, 30, 1, '2018-09-09 08:05'),
(38, 1, 5, 17, 0, '2018-09-12 08:43'),
(39, 1, 5, 29, 0, '2018-09-12 09:20'),
(40, 1, 5, 22, 1, '2018-09-12 09:43'),
(41, 1, 5, 9, 1, '2018-09-12 09:45'),
(42, 1, 5, 10, 1, '2018-09-12 09:48'),
(43, 1, 5, 23, 0, '2018-09-12 10:56'),
(44, 1, 5, 30, 1, '2018-09-12 11:04'),
(45, 1, 5, 16, 1, '2018-09-12 11:31'),
(46, 1, 5, 9, 1, '2018-09-12 11:31'),
(47, 1, 5, 16, 1, '2018-09-12 11:40'),
(48, 1, 5, 16, 1, '2018-09-14 10:00'),
(52, 1, 6, 30, 1, '2018-09-14 10:46'),
(53, 1, 6, 29, 0, '2018-09-14 10:46'),
(54, 1, 1, 30, 0, '2018-09-14 10:55'),
(55, 1, 5, 30, 0, '2018-09-14 13:00'),
(56, 1, 1, 28, 1, '2018-09-25 13:36'),
(57, 1, 1, 28, 1, '2018-09-25 13:39'),
(58, 1, 1, 28, 1, '2018-09-25 13:39'),
(59, 1, 1, 28, 1, '2018-09-25 13:43'),
(60, 1, 1, 28, 1, '2018-09-25 13:43'),
(61, 1, 1, 28, 1, '2018-09-25 13:52'),
(62, 1, 3, 18, 1, '2018-09-26 10:06'),
(63, 1, 3, 18, 1, '2018-09-26 10:14'),
(64, 1, 3, 18, 1, '2018-09-26 10:14'),
(65, 1, 3, 18, 1, '2018-09-26 10:14'),
(66, 1, 3, 18, 1, '2018-09-26 10:14'),
(67, 1, 3, 18, 1, '2018-09-26 10:14'),
(68, 1, 3, 18, 1, '2018-09-26 10:14'),
(69, 1, 3, 18, 1, '2018-09-26 10:14'),
(70, 1, 1, 59, 1, '2018-09-26 10:32'),
(71, 1, 3, 20, 0, '2018-09-28 08:05'),
(72, 1, 3, 20, 0, '2018-09-28 08:07'),
(73, 1, 3, 20, 0, '2018-09-28 08:07'),
(74, 1, 3, 20, 0, '2018-09-28 08:07'),
(75, 1, 3, 20, 0, '2018-09-28 08:07'),
(76, 1, 3, 20, 0, '2018-09-28 08:10'),
(77, 1, 3, 20, 0, '2018-09-28 08:10'),
(78, 1, 3, 30, 0, '2018-09-28 08:11'),
(79, 1, 3, 30, 0, '2018-09-28 08:12'),
(80, 1, 3, 30, 0, '2018-09-28 08:13'),
(81, 1, 3, 30, 0, '2018-09-28 08:13'),
(82, 1, 3, 30, 0, '2018-09-28 08:14'),
(83, 1, 3, 30, 0, '2018-09-28 08:14'),
(84, 1, 3, 30, 0, '2018-09-28 08:14'),
(85, 1, 3, 30, 0, '2018-09-28 08:14'),
(86, 1, 3, 30, 0, '2018-09-28 08:16'),
(87, 1, 3, 30, 0, '2018-09-28 08:16'),
(88, 1, 3, 20, 0, '2018-09-28 08:20'),
(89, 1, 3, 20, 0, '2018-09-28 08:20'),
(90, 1, 3, 20, 0, '2018-09-28 08:20'),
(91, 1, 3, 20, 0, '2018-09-28 08:20'),
(92, 1, 3, 30, 0, '2018-09-28 08:21'),
(93, 1, 3, 30, 0, '2018-09-28 08:21'),
(94, 1, 3, 30, 0, '2018-09-28 08:21'),
(95, 1, 3, 30, 0, '2018-09-28 08:21'),
(96, 1, 3, 30, 0, '2018-09-28 08:21'),
(97, 1, 3, 30, 0, '2018-09-28 08:22'),
(98, 1, 3, 30, 0, '2018-09-28 08:22'),
(99, 1, 3, 30, 0, '2018-09-28 08:22'),
(100, 1, 3, 30, 0, '2018-09-28 08:22'),
(101, 1, 3, 30, 0, '2018-09-28 08:22'),
(102, 1, 3, 30, 0, '2018-09-28 08:22'),
(103, 1, 3, 30, 0, '2018-09-28 08:22'),
(104, 1, 3, 59, 1, '2018-09-28 11:57'),
(105, 1, 3, 59, 1, '2018-09-28 11:57'),
(106, 1, 5, 29, 0, '2018-09-28 11:59'),
(107, 1, 3, 30, 0, '2018-09-30 07:45'),
(108, 1, 3, 30, 0, '2018-09-30 07:46'),
(109, 1, 3, 30, 0, '2018-09-30 09:32'),
(110, 1, 3, 30, 0, '2018-09-30 09:32'),
(111, 1, 3, 30, 0, '2018-09-30 09:32'),
(112, 1, 3, 59, 1, '2018-10-03 13:01'),
(113, 1, 3, 59, 1, '2018-10-03 13:01'),
(114, 1, 3, 59, 1, '2018-10-03 13:01'),
(115, 1, 3, 59, 1, '2018-10-03 13:01'),
(116, 1, 3, 59, 1, '2018-10-03 13:01'),
(117, 1, 3, 59, 1, '2018-10-03 13:01'),
(118, 1, 3, 59, 1, '2018-10-03 13:01'),
(119, 1, 3, 59, 1, '2018-10-03 13:01'),
(120, 1, 3, 59, 1, '2018-10-03 13:01'),
(121, 1, 3, 59, 1, '2018-10-03 13:01'),
(122, 1, 3, 59, 1, '2018-10-03 13:01'),
(123, 1, 3, 59, 1, '2018-10-03 13:01'),
(124, 1, 3, 59, 1, '2018-10-03 13:01'),
(125, 1, 3, 59, 1, '2018-10-03 13:01'),
(126, 1, 3, 59, 1, '2018-10-03 13:01'),
(127, 1, 3, 59, 1, '2018-10-03 13:01'),
(128, 1, 5, 22, 1, '2018-10-03 15:17'),
(129, 1, 6, 30, 0, '2018-10-03 15:17'),
(130, 1, 6, 29, 0, '2018-10-03 15:17'),
(131, 1, 6, 29, 0, '2018-10-09 14:01'),
(132, 1, 6, 30, 0, '2018-10-09 14:01'),
(133, 1, 6, 29, 0, '2018-10-09 14:03'),
(134, 1, 6, 30, 0, '2018-10-09 14:03'),
(135, 1, 1, 63, 1, '2018-10-09 14:03'),
(136, 1, 1, 30, 0, '2018-10-13 07:50'),
(137, 1, 1, 30, 0, '2018-10-13 08:05'),
(138, 1, 1, 30, 0, '2018-10-13 08:08'),
(139, 1, 1, 29, 0, '2018-10-13 08:09'),
(140, 1, 1, 29, 0, '2018-10-13 08:13'),
(141, 1, 1, 29, 0, '2018-10-13 08:13'),
(142, 1, 1, 30, 0, '2018-10-13 08:14'),
(143, 1, 1, 29, 0, '2018-10-13 08:14'),
(144, 1, 1, 29, 0, '2018-10-13 08:14'),
(145, 1, 1, 30, 0, '2018-10-13 08:15'),
(146, 1, 1, 30, 0, '2018-10-13 08:15'),
(147, 1, 1, 30, 0, '2018-10-13 08:15'),
(148, 1, 1, 30, 0, '2018-10-13 08:15'),
(149, 1, 1, 30, 0, '2018-10-13 08:15'),
(150, 1, 1, 30, 0, '2018-10-13 08:15'),
(151, 1, 1, 30, 0, '2018-10-13 08:15'),
(152, 1, 1, 30, 0, '2018-10-13 08:15'),
(153, 1, 1, 30, 0, '2018-10-13 08:15'),
(154, 1, 1, 30, 0, '2018-10-13 08:15'),
(155, 1, 1, 30, 0, '2018-10-13 08:15'),
(156, 1, 2, 3, 0, '2018-10-13 09:16'),
(157, 1, 2, 3, 0, '2018-10-13 09:16'),
(158, 1, 2, 3, 0, '2018-10-13 09:17'),
(159, 1, 2, 3, 0, '2018-10-13 09:20'),
(160, 1, 2, 3, 0, '2018-10-13 09:22'),
(161, 1, 2, 3, 0, '2018-10-13 09:22'),
(162, 1, 2, 3, 0, '2018-10-13 09:22'),
(163, 1, 1, 30, 0, '2018-10-13 09:22'),
(164, 1, 1, 64, 1, '2018-10-13 09:22'),
(165, 1, 3, 30, 0, '2018-10-13 09:38'),
(166, 1, 3, 30, 0, '2018-10-13 09:38'),
(167, 1, 3, 30, 0, '2018-10-13 09:39'),
(168, 1, 3, 30, 0, '2018-10-13 09:40'),
(169, 1, 1, 64, 1, '2018-10-13 10:39'),
(170, 1, 3, 64, 1, '2018-10-13 10:39'),
(171, 1, 5, 30, 0, '2018-10-13 10:40'),
(172, 1, 5, 29, 0, '2018-10-13 10:40'),
(173, 1, 3, 29, 0, '2018-10-13 10:49'),
(174, 1, 1, 29, 0, '2018-10-13 10:49'),
(175, 1, 1, 29, 0, '2018-10-13 10:49'),
(176, 1, 1, 29, 0, '2018-10-13 10:49'),
(177, 1, 1, 20, 0, '2018-10-13 11:05'),
(178, 1, 1, 20, 0, '2018-10-13 11:07'),
(179, 1, 1, 20, 0, '2018-10-13 11:07'),
(180, 1, 1, 20, 0, '2018-10-13 11:08'),
(181, 1, 1, 20, 0, '2018-10-13 11:08'),
(182, 1, 1, 20, 0, '2018-10-13 11:08'),
(183, 1, 1, 20, 0, '2018-10-13 11:08'),
(184, 1, 1, 20, 0, '2018-10-13 11:09'),
(185, 1, 1, 30, 0, '2018-10-13 11:09'),
(186, 1, 1, 29, 0, '2018-10-13 11:10'),
(187, 1, 6, 30, 0, '2018-10-13 12:08'),
(188, 1, 6, 29, 0, '2018-10-13 12:08'),
(189, 1, 1, 29, 0, '2018-10-16 15:49'),
(190, 1, 2, 2, 0, '2018-10-19 11:42'),
(191, 1, 2, 2, 0, '2018-10-19 15:52'),
(192, 1, 2, 6, 0, '2018-10-19 15:56'),
(193, 1, 2, 4, 0, '2018-10-19 15:56'),
(194, 1, 2, 6, 0, '2018-10-19 15:56'),
(195, 1, 1, 30, 0, '2018-10-20 10:02'),
(196, 1, 1, 29, 0, '2018-10-20 10:04'),
(197, 1, 1, 22, 1, '2018-10-20 10:57'),
(198, 1, 1, 22, 1, '2018-10-20 11:16'),
(199, 1, 2, 2, 0, '2018-10-20 11:20'),
(200, 1, 2, 2, 0, '2018-10-20 11:35'),
(201, 1, 2, 2, 0, '2018-10-20 11:36'),
(202, 1, 2, 2, 0, '2018-10-20 11:36'),
(203, 1, 2, 2, 0, '2018-10-20 11:36'),
(204, 1, 2, 2, 0, '2018-10-20 11:36'),
(205, 1, 2, 2, 0, '2018-10-20 11:36'),
(206, 1, 2, 2, 0, '2018-10-20 11:36'),
(207, 1, 2, 2, 0, '2018-10-20 11:37'),
(208, 1, 2, 2, 0, '2018-10-20 11:37'),
(209, 1, 2, 2, 0, '2018-10-20 11:37'),
(210, 1, 2, 2, 0, '2018-10-20 11:37'),
(211, 1, 2, 2, 0, '2018-10-20 11:38'),
(212, 1, 2, 2, 0, '2018-10-20 11:38'),
(213, 1, 2, 2, 0, '2018-10-20 11:38'),
(214, 1, 2, 2, 0, '2018-10-20 11:38'),
(215, 1, 2, 2, 0, '2018-10-20 11:40'),
(216, 1, 2, 2, 0, '2018-10-20 11:40'),
(217, 1, 2, 2, 0, '2018-10-20 11:40'),
(218, 1, 2, 2, 0, '2018-10-20 11:40'),
(219, 1, 2, 3, 0, '2018-10-20 11:41'),
(220, 1, 2, 2, 0, '2018-10-20 11:41'),
(221, 1, 2, 2, 0, '2018-10-20 11:44'),
(222, 1, 2, 2, 0, '2018-10-20 11:45'),
(223, 1, 2, 2, 0, '2018-10-20 11:46'),
(224, 1, 2, 3, 0, '2018-10-20 11:47'),
(225, 1, 2, 2, 0, '2018-10-20 11:47'),
(226, 1, 2, 2, 0, '2018-10-20 11:48'),
(227, 1, 2, 3, 0, '2018-10-20 11:48'),
(228, 1, 2, 3, 0, '2018-10-20 11:48'),
(229, 1, 2, 3, 0, '2018-10-20 11:50'),
(230, 1, 2, 2, 0, '2018-10-20 11:50'),
(231, 1, 2, 2, 0, '2018-10-20 11:50'),
(232, 1, 1, 67, 0, '2018-10-20 11:52'),
(233, 1, 2, 2, 0, '2018-10-30 14:31'),
(234, 1, 2, 2, 0, '2018-10-30 14:32'),
(235, 1, 2, 2, 0, '2018-10-30 14:33'),
(236, 1, 2, 2, 0, '2018-10-30 14:33'),
(237, 1, 2, 2, 0, '2018-10-30 14:34'),
(238, 1, 2, 2, 0, '2018-10-30 14:34'),
(239, 1, 2, 2, 0, '2018-10-30 14:35'),
(240, 1, 2, 2, 0, '2018-10-30 14:35'),
(241, 1, 2, 2, 0, '2018-10-30 14:36'),
(242, 1, 2, 2, 0, '2018-10-30 14:36'),
(243, 1, 2, 2, 0, '2018-10-30 14:36'),
(244, 1, 2, 2, 0, '2018-11-01 08:38'),
(245, 1, 2, 2, 0, '2018-11-01 08:38'),
(246, 1, 6, 30, 0, '2018-11-01 08:47'),
(247, 1, 6, 29, 0, '2018-11-01 08:47'),
(248, 1, 6, 30, 0, '2018-11-01 08:47'),
(249, 1, 6, 29, 0, '2018-11-01 08:47'),
(250, 1, 1, 75, 0, '2018-11-01 09:00'),
(251, 1, 1, 75, 0, '2018-11-01 09:01'),
(252, 1, 1, 75, 0, '2018-11-01 09:01'),
(253, 1, 1, 30, 0, '2018-11-01 09:01'),
(254, 1, 1, 22, 1, '2018-11-01 09:05'),
(255, 1, 1, 75, 0, '2018-11-01 09:05'),
(256, 1, 1, 75, 0, '2018-11-01 09:08'),
(257, 1, 1, 75, 0, '2018-11-01 09:08'),
(258, 1, 1, 75, 0, '2018-11-01 09:08'),
(259, 7, 4, 7, 1, '2018-11-08 14:39'),
(260, 7, 1, 22, 1, '2018-11-08 14:40'),
(261, 7, 1, 77, 1, '2018-11-08 15:35'),
(262, 8, 4, 8, 0, '2018-11-09 09:08'),
(263, 1, 3, 30, 0, '2018-11-10 11:35'),
(264, 1, 3, 30, 0, '2018-11-10 11:35'),
(265, 1, 6, 29, 0, '2018-11-10 11:45'),
(266, 1, 6, 30, 0, '2018-11-10 11:45'),
(267, 1, 3, 22, 1, '2018-11-10 14:42'),
(268, 1, 3, 22, 1, '2018-11-10 14:42'),
(269, 1, 3, 22, 1, '2018-11-10 14:43'),
(270, 1, 3, 22, 1, '2018-11-10 14:47'),
(271, 1, 3, 20, 0, '2018-11-10 14:50'),
(272, 1, 3, 20, 0, '2018-11-10 14:52'),
(273, 1, 3, 30, 0, '2018-11-10 16:21'),
(274, 1, 3, 30, 0, '2018-11-11 09:56'),
(275, 1, 3, 30, 0, '2018-11-11 10:06'),
(276, 1, 5, 30, 0, '2018-11-11 10:22'),
(277, 1, 3, 88, 1, '2018-11-11 10:31'),
(278, 1, 3, 59, 0, '2018-11-21 09:39');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_bin NOT NULL,
  `activity` tinyint(4) NOT NULL,
  `points` longtext COLLATE utf8mb4_bin NOT NULL,
  `collaboration` int(11) NOT NULL,
  `duration` int(11) DEFAULT '0',
  `length` int(11) DEFAULT '0',
  `place` varchar(500) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Sťahujem dáta pre tabuľku `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `date`, `description`, `activity`, `points`, `collaboration`, `duration`, `length`, `place`) VALUES
(1, 2, '2018-07-22 17:04', 'Môj prvý obrázok nakreslený na mape. ĽŤ', 1, '48.9812840;21.2171920;48.9832841;21.2176398;48.9856443;21.2209088;48.9861461;21.2261563;48.9874682;21.2294855;48.9909244;21.2295512;48.9928871;21.2292352', 0, 915, 48614, 'Nitra District, Slovakia'),
(4, 1, '2018-07-22 17:04', 'Naša prvá spolupráca.', 1, '___DuS4NN*48.9812840;21.2171920;48.9832841;21.2176398;48.9856443;21.2209088*GPSBoy*48.9861461;21.2261563;48.9874682;21.2294855*Marek123*48.9909244;21.2295512;48.9928871;21.2292352', 1, 915, 48614, 'Nitra District, Slovakia'),
(9, 2, '2018-08-15 16:05', 'Moj treti post', 1, '48.9812840;21.2171920;48.9832841;21.2176398;48.9856443;21.2209088', 0, 915, 48614, 'Nitra District, Slovakia'),
(10, 2, '2018-08-15 16:05', 'Moj stvrty post sadsa', 2, '48.9812840;21.2171920;48.9832841;21.2176398;48.9856443;21.2209088;48.9861461;21.2261563;48.9874682;21.2294855;48.9909244;21.2295512;48.9928871;21.2292352', 0, 915, 48614, 'Nitra District, Slovakia'),
(15, 1, '2018-08-18 13:02', 'd', 0, '48.24334;18.01708;48.24291;18.017390000000002;48.242810000000006;18.017480000000003;48.24224000147895;18.01806000644218;48.241670000000006;18.01864;48.24179500194395;18.01930999835076;48.24192000000001;18.01998;48.242470003668416;18.020899990106116;48.24302;18.02182;48.24387666745476;18.021520010046327;48.24473333412918;18.02122001004383;48.24559000000001;18.02092;48.24542;18.02036;48.245110000000004;18.01985;48.24462333937976;18.019016650851494;48.24413667273803;18.018183317561128;48.24365;18.01735;48.24344000000001;18.01717', 0, 915, 48614, 'Nitra District, Slovakia'),
(16, 2, '2018-08-18 19:24', 'Nieco nove :)', 2, '48.24334;18.01708;48.24291;18.017390000000002;48.242810000000006;18.017480000000003;48.24224000147895;18.01806000644218;48.241670000000006;18.01864;48.24179500194395;18.01930999835076;48.24192000000001;18.01998;48.242470003668416;18.020899990106116;48.24302;18.02182;48.24387666745476;18.021520010046327;48.24473333412918;18.02122001004383;48.24559000000001;18.02092;48.24542;18.02036;48.245110000000004;18.01985;48.24462333937976;18.019016650851494;48.24413667273803;18.018183317561128;48.24365;18.01735;48.24344000000001;18.01717', 0, 915, 48614, 'Nitra District, Slovakia'),
(17, 3, '2018-08-18 19:27', 'Prvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmmPrvy post hmmm\r\n', 3, '48.9812840;21.2171920;48.9832841;21.2176398;48.9856443;21.2209088;48.9861461;21.2261563;48.9874682;21.2294855;48.9909244;21.2295512;48.9928871;21.2292352', 0, 915, 48614, 'Presov District, Slovakia'),
(18, 1, '2018-08-18 20:49', 'hmm', 0, '48.30818000000001;18.084690000000002;48.308310000000006;18.08386;48.30848;18.083920000000003;48.308530000000005;18.083660000000002;48.308725018811934;18.08245751372335;48.30892002508934;18.081255018256545;48.30911501883203;18.080052513600037;48.30931;18.078850000000003;48.309380000000004;18.07832;48.30953334240985;18.077296672824247;48.30968667574203;18.076273339498766;48.30984;18.07525;48.30993;18.075010000000002;48.31006000000001;18.07488;48.31017000000001;18.074820000000003;48.31038;18.074530000000003;48.31044000000001;18.0744;48.310680000000005;18.07381;48.31074;18.073600000000003;48.31076;18.073330000000002;48.31074;18.07317;48.310680000000005;18.072930000000003;48.31063;18.0728;48.310570000000006;18.07271;48.3104;18.072570000000002;48.31027;18.072290000000002;48.31024000000001;18.07213;48.310210000000005;18.07189;48.310140000000004;18.07075;48.31011;18.06999;48.31006000000001;18.06922;48.31007;18.068440000000002;48.31013;18.067600000000002;48.310140000000004;18.067140000000002;48.31017000000001;18.066280000000003;48.31022000250715;18.06552000068835;48.31027;18.06476;48.31046500339548;18.063880003186465;48.310660000000006;18.063000000000002;48.31;18.06248;48.309850000000004;18.062350000000002;48.30991;18.062170000000002;48.309430000000006;18.06164;48.30941000000001;18.06162;48.308743337943554;18.060889980917295;48.30807667126751;18.0601599809074;48.307410000000004;18.059430000000003;48.307390000000005;18.059420000000003;48.3070150007764;18.05899999692721;48.30664;18.058580000000003;48.306630000000006;18.058570000000003;48.306015001996876;18.057889991798007;48.305400000000006;18.05721;48.305400000000006;18.0572;48.305200000000006;18.056980000000003;48.30485;18.0574;48.304500000000004;18.057830000000003;48.30444000000001;18.05788;48.30407;18.05833;48.303900000000006;18.05854;48.304;18.05908;48.30397000000001;18.05928;48.303450000000005;18.060170000000003;48.30322;18.060540000000003;48.30315;18.060740000000003;48.30315;18.060950000000002;48.302960000000006;18.061500000000002;48.30275;18.06175;48.30216;18.0625;48.302110000000006;18.06241;48.30216;18.0625;48.302640000000004;18.063380000000002;48.30313;18.064200000000003;48.30358000301265;18.06503499262105;48.304030000000004;18.06587;48.30447;18.066930000000003;48.3047250019817;18.067599996747283;48.30498;18.068270000000002;48.305040000000005;18.06893;48.30507;18.06906;48.30516;18.069300000000002;48.305570008510905;18.070109980439398;48.3059800113345;18.070919973892416;48.306390008470636;18.071729980359283;48.3068;18.07254;48.30688000000001;18.073230000000002;48.30688000000001;18.07356;48.30684;18.073970000000003;48.30661000322094;18.074840004146463;48.306380000000004;18.07571;48.30624;18.07611;48.306230000000006;18.0761;48.306160000000006;18.07611;48.306110000000004;18.076210000000003;48.30601;18.0762;48.305780000000006;18.076220000000003;48.30533500022945;18.076104999041817;48.30489000000001;18.07599;48.304460000000006;18.076;48.303984999981004;18.076055000515556;48.30351;18.07611;48.303010000182184;18.076215001000318;48.302510000000005;18.076320000000003;48.302035000410946;18.07646000120669;48.30156;18.076600000000003;48.30078;18.07694;48.30031;18.077180000000002;48.2997300008807;18.077496673856103;48.29915000089207;18.077813340516453;48.298570000000005;18.07813;48.29792000043297;18.078470004364508;48.297270000000005;18.07881;48.29703000000001;18.07892;48.296200000000006;18.07926;48.296060000000004;18.079320000000003;48.29599;18.07938;48.29596;18.07944;48.295930000000006;18.07967;48.29603;18.08041;48.296060000000004;18.080820000000003;48.296800000000005;18.080750000000002;48.297630000000005;18.080540000000003;48.298210000000005;18.0804;48.298640000000006;18.080370000000002;48.29889000000001;18.08039;48.299420000000005;18.080560000000002;48.30002;18.080920000000003;48.29997;18.08107;48.29950000541213;18.081860014543444;48.29903000541393;18.082650014540192;48.29856;18.083440000000003;48.298100000000005;18.08423;48.29870333946826;18.08507331335729;48.29930667277127;18.08591664664788;48.299910000000004;18.08676;48.2999;18.086750000000002;48.30047000265831;18.087539991114024;48.30104;18.088330000000003;48.30104;18.088320000000003;48.301390000000005;18.088800000000003;48.30154;18.08874;48.301805001388175;18.08817500292352;48.30207;18.08761;48.30239;18.08688;48.302690000000005;18.08624;48.303090000000005;18.08537;48.303580000000004;18.084290000000003;48.303670000000004;18.08404;48.30451000070179;18.084454993148064;48.305350000000004;18.084870000000002;48.30591500040763;18.085134997114835;48.30648;18.0854;48.30646;18.085520000000002;48.307280000000006;18.08578;48.30727;18.08578;48.30791000000001;18.085980000000003;48.307970000000005;18.085600000000003;48.30805;18.08557;48.30807;18.08548;48.30818000000001;18.084690000000002', 0, 915, 48614, 'Nitra District, Slovakia'),
(19, 5, '2018-08-30 15:41', '', 0, '48.24334;18.01708;48.24291;18.017390000000002;48.242810000000006;18.017480000000003;48.24224000147895;18.01806000644218;48.241670000000006;18.01864;48.24179500194395;18.01930999835076;48.24192000000001;18.01998;48.242470003668416;18.020899990106116;48.24302;18.02182;48.24387666745476;18.021520010046327;48.24473333412918;18.02122001004383;48.24559000000001;18.02092;48.24542;18.02036;48.245110000000004;18.01985;48.24462333937976;18.019016650851494;48.24413667273803;18.018183317561128;48.24365;18.01735;48.24344000000001;18.01717', 0, 915, 48614, 'Nitra District, Slovakia'),
(20, 5, '2018-08-30 15:42', '', 0, '48.30818000000001;18.084690000000002;48.308310000000006;18.08386;48.30848;18.083920000000003;48.308530000000005;18.083660000000002;48.308725018811934;18.08245751372335;48.30892002508934;18.081255018256545;48.30911501883203;18.080052513600037;48.30931;18.078850000000003;48.309380000000004;18.07832;48.30953334240985;18.077296672824247;48.30968667574203;18.076273339498766;48.30984;18.07525;48.30993;18.075010000000002;48.31006000000001;18.07488;48.31017000000001;18.074820000000003;48.31038;18.074530000000003;48.31044000000001;18.0744;48.310680000000005;18.07381;48.31074;18.073600000000003;48.31076;18.073330000000002;48.31074;18.07317;48.310680000000005;18.072930000000003;48.31063;18.0728;48.310570000000006;18.07271;48.3104;18.072570000000002;48.31027;18.072290000000002;48.31024000000001;18.07213;48.310210000000005;18.07189;48.310140000000004;18.07075;48.31011;18.06999;48.31006000000001;18.06922;48.31007;18.068440000000002;48.31013;18.067600000000002;48.310140000000004;18.067140000000002;48.31017000000001;18.066280000000003;48.31022000250715;18.06552000068835;48.31027;18.06476;48.31046500339548;18.063880003186465;48.310660000000006;18.063000000000002;48.31;18.06248;48.309850000000004;18.062350000000002;48.30991;18.062170000000002;48.309430000000006;18.06164;48.30941000000001;18.06162;48.308743337943554;18.060889980917295;48.30807667126751;18.0601599809074;48.307410000000004;18.059430000000003;48.307390000000005;18.059420000000003;48.3070150007764;18.05899999692721;48.30664;18.058580000000003;48.306630000000006;18.058570000000003;48.306015001996876;18.057889991798007;48.305400000000006;18.05721;48.305400000000006;18.0572;48.305200000000006;18.056980000000003;48.30485;18.0574;48.304500000000004;18.057830000000003;48.30444000000001;18.05788;48.30407;18.05833;48.303900000000006;18.05854;48.304;18.05908;48.30397000000001;18.05928;48.303450000000005;18.060170000000003;48.30322;18.060540000000003;48.30315;18.060740000000003;48.30315;18.060950000000002;48.302960000000006;18.061500000000002;48.30275;18.06175;48.30216;18.0625;48.302110000000006;18.06241;48.30216;18.0625;48.302640000000004;18.063380000000002;48.30313;18.064200000000003;48.30358000301265;18.06503499262105;48.304030000000004;18.06587;48.30447;18.066930000000003;48.3047250019817;18.067599996747283;48.30498;18.068270000000002;48.305040000000005;18.06893;48.30507;18.06906;48.30516;18.069300000000002;48.305570008510905;18.070109980439398;48.3059800113345;18.070919973892416;48.306390008470636;18.071729980359283;48.3068;18.07254;48.30688000000001;18.073230000000002;48.30688000000001;18.07356;48.30684;18.073970000000003;48.30661000322094;18.074840004146463;48.306380000000004;18.07571;48.30624;18.07611;48.306230000000006;18.0761;48.306160000000006;18.07611;48.306110000000004;18.076210000000003;48.30601;18.0762;48.305780000000006;18.076220000000003;48.30533500022945;18.076104999041817;48.30489000000001;18.07599;48.304460000000006;18.076;48.303984999981004;18.076055000515556;48.30351;18.07611;48.303010000182184;18.076215001000318;48.302510000000005;18.076320000000003;48.302035000410946;18.07646000120669;48.30156;18.076600000000003;48.30078;18.07694;48.30031;18.077180000000002;48.2997300008807;18.077496673856103;48.29915000089207;18.077813340516453;48.298570000000005;18.07813;48.29792000043297;18.078470004364508;48.297270000000005;18.07881;48.29703000000001;18.07892;48.296200000000006;18.07926;48.296060000000004;18.079320000000003;48.29599;18.07938;48.29596;18.07944;48.295930000000006;18.07967;48.29603;18.08041;48.296060000000004;18.080820000000003;48.296800000000005;18.080750000000002;48.297630000000005;18.080540000000003;48.298210000000005;18.0804;48.298640000000006;18.080370000000002;48.29889000000001;18.08039;48.299420000000005;18.080560000000002;48.30002;18.080920000000003;48.29997;18.08107;48.29950000541213;18.081860014543444;48.29903000541393;18.082650014540192;48.29856;18.083440000000003;48.298100000000005;18.08423;48.29870333946826;18.08507331335729;48.29930667277127;18.08591664664788;48.299910000000004;18.08676;48.2999;18.086750000000002;48.30047000265831;18.087539991114024;48.30104;18.088330000000003;48.30104;18.088320000000003;48.301390000000005;18.088800000000003;48.30154;18.08874;48.301805001388175;18.08817500292352;48.30207;18.08761;48.30239;18.08688;48.302690000000005;18.08624;48.303090000000005;18.08537;48.303580000000004;18.084290000000003;48.303670000000004;18.08404;48.30451000070179;18.084454993148064;48.305350000000004;18.084870000000002;48.30591500040763;18.085134997114835;48.30648;18.0854;48.30646;18.085520000000002;48.307280000000006;18.08578;48.30727;18.08578;48.30791000000001;18.085980000000003;48.307970000000005;18.085600000000003;48.30805;18.08557;48.30807;18.08548;48.30818000000001;18.084690000000002', 0, 915, 48614, 'Nitra District, Slovakia'),
(21, 5, '2018-08-30 15:42', '', 0, '48.23975200;18.01809310;48.23929510;18.01945560;48.23992390;18.02057140;48.24153880;18.01874750;48.24053840;18.01589360;48.24035270;18.01610820;48.23998110;18.01769610;48.23982000;18.01822990;48.23966280;18.01847660', 0, 915, 48614, 'Nitra District, Slovakia'),
(22, 1, '2018-08-30 18:08', 'Ahojte, urobil som pre Vás další post. Tento krát som zašiel do Cabaja, malá dedina pri Nitre, kde som vytvoril túto veľmi peknú kresbu. Netrvala moc dlho, trasa bol dlhá 1,2 kilometra a celé mi to trvaloa do 3 minút, kedže som bol na bicykli. 😏 😨', 2, '48.24334;18.01708;48.24291;18.017390000000002;48.242810000000006;18.017480000000003;48.24224000147895;18.01806000644218;48.241670000000006;18.01864;48.24179500194395;18.01930999835076;48.24192000000001;18.01998;48.242470003668416;18.020899990106116;48.24302;18.02182;48.24387666745476;18.021520010046327;48.24473333412918;18.02122001004383;48.24559000000001;18.02092;48.24542;18.02036;48.245110000000004;18.01985;48.24462333937976;18.019016650851494;48.24413667273803;18.018183317561128;48.24365;18.01735;48.24344000000001;18.01717', 0, 915, 48614, 'Nitra District, Slovakia'),
(23, 3, '2018-08-18 19:27', 'Prvy post hmmm', 3, '48.9812840;21.2171920;48.9832841;21.2176398;48.9856443;21.2209088;48.9861461;21.2261563;48.9874682;21.2294855;48.9909244;21.2295512;48.9928871;21.2292352', 0, 915, 48614, 'Presov District, Slovakia'),
(24, 3, '2018-08-18 19:27', 'Prvy post hmmm', 3, '48.9812840;21.2171920;48.9832841;21.2176398;48.9856443;21.2209088;48.9861461;21.2261563;48.9874682;21.2294855;48.9909244;21.2295512;48.9928871;21.2292352', 0, 915, 48614, 'Presov District, Slovakia'),
(28, 1, '2018-09-08 13:12', 'Ahojte, toto je prvý časť nášho spoločného príspevku. Bude to náš druhý spoločný príspevok spolu s Marekom a GPSBoyom. Je to hlava robota :) ', 0, '40.76718;-73.98996000000001;40.76678334104621;-73.98901665548111;40.7663866744113;-73.98807332222347;40.76599;-73.98713000000001;40.766570001555216;-73.98670334079273;40.76715000153912;-73.98627667413801;40.76773;-73.98585;40.76773;-73.98586;40.76791;-73.98572;40.76750251213054;-73.984752482228;40.76709501618125;-73.98378497632147;40.76668751215232;-73.98281748228032;40.76628;-73.98185000000001;40.76625000000001;-73.98179;40.76592500253425;-73.98100999596603;40.765600000000006;-73.98023;40.76552;-73.98004;40.764876668552375;-73.98050667569696;40.76423333522495;-73.98097334235919;40.76359;-73.98144;40.76336000127845;-73.98088999803205;40.763130000000004;-73.98034000000001;40.762890000000006;-73.97980000000001;40.762482528277566;-73.97883245847706;40.76207504847512;-73.97786492881728;40.761667560592855;-73.97689741102062;40.76126006463099;-73.97592990508694;40.760852560589754;-73.97496241101621;40.76044504846935;-73.97399492880832;40.76003752826999;-73.97302745846319;40.75963;-73.97206;40.76027666863589;-73.9715866758505;40.76092333533803;-73.97111334249134;40.761570000000006;-73.97064;40.761520000000004;-73.97053000000001;40.761151683057925;-73.96965830917257;40.76078335955746;-73.96878662800559;40.76041502949877;-73.967914956499;40.76004669288204;-73.96704329465273;40.75967834970741;-73.96617164246673;40.759310000000006;-73.9653;40.75858001462974;-73.96583160850498;40.75785002682031;-73.9663632053345;40.75712003657182;-73.96689479048908;40.756390043884345;-73.96742636396922;40.755660048758074;-73.96795792577544;40.754930051193064;-73.96848947590827;40.75420005118946;-73.96902101436821;40.75347004874738;-73.96955254115579;40.75274004386692;-73.97008405627153;40.7520100365482;-73.97061555971594;40.75128002679136;-73.97114705148954;40.750550014596506;-73.97167853159286;40.74982000000001;-73.97221;40.75022751179353;-73.97316498241014;40.75063501571574;-73.97411997652544;40.75104251176643;-73.97507498234603;40.751450000000006;-73.97603000000001;40.75176000493325;-73.97678665959076;40.752070004924974;-73.97754332623715;40.75238;-73.9783;40.752410000000005;-73.97836000000001;40.7528;-73.97929;40.75269;-73.97938;40.752680000000005;-73.97938;40.753320001906665;-73.97891000904832;40.75396000190677;-73.97844000904837;40.7546;-73.97797;40.7546;-73.97798;40.754720000000006;-73.97788;40.75511752676265;-73.97882121060428;40.75551504587918;-73.97976243246423;40.75591255734939;-73.98070366557991;40.756310061173096;-73.98164490995138;40.75670755735007;-73.98258616557875;40.75710504588013;-73.9835274324621;40.7575025267631;-73.98446871060148;40.75790000000001;-73.98541;40.757960000000004;-73.98554;40.75733;-73.98602000000001;40.75668000099263;-73.98648500450396;40.75603;-73.98695000000001;40.75562627770136;-73.98599245930922;40.755222547489154;-73.9850349302481;40.75481880936358;-73.98407741281665;40.75441506332485;-73.98311990701471;40.75401130937317;-73.98216241284224;40.75360754750874;-73.98120493029917;40.753203777731805;-73.98024745938541;40.7528;-73.97929;40.752680000000005;-73.97939000000001;40.752660000000006;-73.97939000000001;40.7528;-73.97929;40.753229284561435;-73.9803091517988;40.753658560158044;-73.98132831675812;40.75408782678959;-73.98234749487804;40.75451708445581;-73.98336668615866;40.75494633315649;-73.98438589060007;40.75537557289131;-73.98540510820237;40.75580480366009;-73.98642433896565;40.75623402546253;-73.98744358289002;40.756663238298394;-73.98846283997555;40.75709244216743;-73.98948211022235;40.757521637069395;-73.99050139363052;40.75795082300402;-73.99152069020013;40.75838;-73.99254;40.758755003298226;-73.99341999493298;40.759130000000006;-73.99430000000001;40.75937500158796;-73.9948899980318;40.759620000000005;-73.99548;40.76037601182954;-73.99492805650928;40.76113202102958;-73.99437610046327;40.76188802759999;-73.99382413186136;40.76264403154064;-73.99327215070299;40.76340003285139;-73.9927201569876;40.764156031532146;-73.99216815071458;40.76491202758274;-73.99161613188338;40.76566802100305;-73.9910641004934;40.76642401179295;-73.99051205654409;40.76718;-73.98996000000001', 0, 915, 48614, 'Nitra District, Slovakia'),
(29, 3, '2018-09-08 13:18', 'druhy druhy', 0, '40.75325;-73.98037000000001;40.75283000434664;-73.97936499362264;40.752410000000005;-73.97836000000001;40.75238;-73.9783;40.75207000494989;-73.97754332629796;40.75176000495816;-73.97678665965158;40.751450000000006;-73.97603000000001;40.75111000273317;-73.97523999605319;40.75077;-73.97445;40.750640000000004;-73.97454;40.75063;-73.97455000000001;40.75077;-73.97445;40.75111000265334;-73.97523999586771;40.751450000000006;-73.97603000000001;40.75069301188016;-73.97658305665684;40.74993602112043;-73.97713610072131;40.74917902772099;-73.97768913219406;40.74842203168193;-73.97824215107563;40.74766503300342;-73.97879515736662;40.74690803168556;-73.9793481510676;40.746151027728466;-73.97990113217914;40.74539402113232;-73.98045410070183;40.74463701189721;-73.98100705663626;40.743880000000004;-73.98156;40.743930000000006;-73.98168000000001;40.743880000000004;-73.98156;40.74326000000001;-73.98201;40.74360000849385;-73.98281998757814;40.743940011325336;-73.98362998343778;40.74428000849434;-73.98443998757897;40.744620000000005;-73.98525000000001;40.74524;-73.9848;40.74589500089228;-73.98433500460872;40.746550000000006;-73.98387000000001;40.74715500088868;-73.98341500414291;40.74776000000001;-73.98296;40.748461435301415;-73.98245003228098;40.74916286835819;-73.98194005380344;40.74986429917026;-73.98143006456696;40.7505657277375;-73.98092006457107;40.75126715405984;-73.9804100538153;40.75196857813714;-73.97990003229921;40.75267;-73.97939000000001;40.752660000000006;-73.97940000000001;40.7528;-73.97929;40.75322131472935;-73.98028990495614;40.753642620829304;-73.98128982258453;40.7540639182996;-73.98228975288526;40.754485207140036;-73.98328969585843;40.75490648735034;-73.98428965150411;40.755327758930285;-73.98528961982241;40.75574902187964;-73.98628960081341;40.75617027619816;-73.9872895944772;40.75659152188561;-73.98828960081387;40.757012758941755;-73.98928961982352;40.75743398736637;-73.99028965150623;40.757855207159174;-73.99128969586206;40.75827641831998;-73.99228975289115;40.75869762084852;-73.99328982259357;40.75911881474457;-73.9942899049694;40.75954;-73.99529000000001;40.759620000000005;-73.99548;40.758970000000005;-73.99595000000001;40.75835000174424;-73.99640334181119;40.75773000171465;-73.99685667516604;40.757110000000004;-73.99731000000001;40.75649000176412;-73.99776000838166;40.7558700017804;-73.99821000836971;40.755250000000004;-73.99866;40.754646668380964;-73.9991033413665;40.75404333506551;-73.9995466746866;40.753440000000005;-73.99999000000001;40.75343;-74.0;40.75275000102326;-74.00049500508737;40.75207;-74.00099;40.75144;-74.00143;40.75207;-74.00099;40.75173500274454;-74.0001949960351;40.751400000000004;-73.99940000000001;40.75133;-73.99914000000001;40.750980000000006;-73.99837000000001;40.7509;-73.99816000000001;40.75025;-73.99863;40.75087000089389;-73.9981750042422;40.751490000000004;-73.99772;40.75142;-73.99755;40.75155;-73.99754;40.75207;-73.99714;40.75209;-73.99721000000001;40.752120000000005;-73.99727;40.75264000000001;-73.99688;40.752720000000004;-73.99680000000001;40.753080000000004;-73.99656;40.75307;-73.99656;40.75360666792312;-73.99617333960002;40.75414333455585;-73.99578667295789;40.75468;-73.9954;40.755030000000005;-73.99511000000001;40.755480000000006;-73.99479000000001;40.75547;-73.99480000000001;40.75623;-73.99427;40.756220000000006;-73.99427;40.75654;-73.99405;40.75709500084124;-73.99363000344589;40.757650000000005;-73.99321;40.75764;-73.99321;40.758340000000004;-73.9927', 0, 915, 48614, 'New York, NY, USA'),
(30, 2, '2018-09-08 13:22', 'Posledna cast nasej spoluprace', 0, '40.74437;-73.98332;40.74477500034387;-73.98302500181948;40.745180000000005;-73.98273;40.745598059608064;-73.98372324591864;40.746016110701625;-73.9847165043245;40.74643415328043;-73.98570977521771;40.74685218734427;-73.98670305859832;40.74727021289291;-73.98769635446646;40.74768822992608;-73.9886896628222;40.74810623844359;-73.9896829836656;40.748524238445185;-73.99067631699677;40.748942229930655;-73.99166966281578;40.74936021289975;-73.99266302112275;40.74977818735223;-73.99365639191775;40.75019615328789;-73.99464977520086;40.75061411070647;-73.99564317097217;40.751032059607745;-73.99663657923178;40.751450000000006;-73.99763;40.751380000000005;-73.99766000000001;40.75067000000001;-73.99817;40.75066;-73.99817;40.74993728472576;-73.99869733003281;40.74921456705154;-73.99922464860296;40.74849184697748;-73.99975195571093;40.74776912450366;-74.00027925135726;40.74704639963021;-74.00080653554242;40.74632367235725;-74.00133380826693;40.74560094268489;-74.00186106953132;40.74487821061323;-74.00238831933603;40.744155476142396;-74.00291555768162;40.74343273927248;-74.00344278456856;40.74271;-74.00397000000001;40.74255;-74.00408;40.74251;-74.00417;40.742250000000006;-74.00435;40.74217;-74.00439;40.741670000000006;-74.00475;40.74165;-74.00489;40.74157;-74.00500000000001;40.741080000000004;-74.00538;40.74094;-74.00537;40.7405416860031;-74.00442330498956;40.74014336427149;-74.00347662131703;40.73974503480536;-74.00252994898234;40.73934669760493;-74.00158328798543;40.73894835267038;-74.0006366383262;40.738550000000004;-73.99969;40.73846;-73.99975;40.73845;-73.99976000000001;40.73917666909291;-73.999230011578;40.73990333576163;-73.99870001157672;40.74063;-73.99817;40.74062;-73.99818;40.741283335348015;-73.99769667630798;40.74194666867994;-73.99721334297584;40.742610000000006;-73.99673;40.7426;-73.99673;40.743356669210556;-73.99618001256293;40.74411333581044;-73.9956300126117;40.744870000000006;-73.99508;40.744870000000006;-73.99509;40.74543500080173;-73.99468000342777;40.746;-73.99427;40.74595;-73.99415;40.745566673831775;-73.99323998955265;40.74518334051647;-73.9923299895956;40.744800000000005;-73.99142;40.74416666853324;-73.99188334214746;40.74353333521366;-73.99234667547061;40.742900000000006;-73.99281;40.742153335950604;-73.99335334548144;40.74140666935336;-73.99389667876405;40.740660000000005;-73.99444000000001;40.740640000000006;-73.99444000000001;40.74004000166464;-73.99488000794219;40.7394400016584;-73.99532000794663;40.73884;-73.99576;40.73884;-73.99577000000001;40.73810000124649;-73.99631000601556;40.73736;-73.99685000000001;40.737020008380455;-73.99604498763739;40.73668001116819;-73.99523998350315;40.73634000836334;-73.99443498759724;40.736000000000004;-73.99363000000001;40.73560334122823;-73.99267332191697;40.73520667455796;-73.9917166552418;40.73481;-73.99076000000001;40.734860000000005;-73.99064;40.7351;-73.99022000000001;40.73534;-73.98992000000001;40.735925000899236;-73.9894950036501;40.73651;-73.98907000000001;40.73711500078898;-73.9886150042164;40.73772;-73.98816000000001;40.73845778776604;-73.98762226993513;40.73919557303656;-73.98708452794237;40.739933355811424;-73.98654677402116;40.740671136090526;-73.98600900817101;40.74140891387372;-73.98547123039135;40.74214668916091;-73.98493344068166;40.742884461951974;-73.9843956390414;40.74362223224678;-73.98385782547004;40.74436;-73.98332', 0, 915, 48614, 'New York, NY, USA'),
(59, 1, '2018-09-14 10:46', 'Robot', 0, '___DuS4NN*40.76718;-73.98996000000001;40.76678334104621;-73.98901665548111;40.7663866744113;-73.98807332222347;40.76599;-73.98713000000001;40.766570001555216;-73.98670334079273;40.76715000153912;-73.98627667413801;40.76773;-73.98585;40.76773;-73.98586;40.76791;-73.98572;40.76750251213054;-73.984752482228;40.76709501618125;-73.98378497632147;40.76668751215232;-73.98281748228032;40.76628;-73.98185000000001;40.76625000000001;-73.98179;40.76592500253425;-73.98100999596603;40.765600000000006;-73.98023;40.76552;-73.98004;40.764876668552375;-73.98050667569696;40.76423333522495;-73.98097334235919;40.76359;-73.98144;40.76336000127845;-73.98088999803205;40.763130000000004;-73.98034000000001;40.762890000000006;-73.97980000000001;40.762482528277566;-73.97883245847706;40.76207504847512;-73.97786492881728;40.761667560592855;-73.97689741102062;40.76126006463099;-73.97592990508694;40.760852560589754;-73.97496241101621;40.76044504846935;-73.97399492880832;40.76003752826999;-73.97302745846319;40.75963;-73.97206;40.76027666863589;-73.9715866758505;40.76092333533803;-73.97111334249134;40.761570000000006;-73.97064;40.761520000000004;-73.97053000000001;40.761151683057925;-73.96965830917257;40.76078335955746;-73.96878662800559;40.76041502949877;-73.967914956499;40.76004669288204;-73.96704329465273;40.75967834970741;-73.96617164246673;40.759310000000006;-73.9653;40.75858001462974;-73.96583160850498;40.75785002682031;-73.9663632053345;40.75712003657182;-73.96689479048908;40.756390043884345;-73.96742636396922;40.755660048758074;-73.96795792577544;40.754930051193064;-73.96848947590827;40.75420005118946;-73.96902101436821;40.75347004874738;-73.96955254115579;40.75274004386692;-73.97008405627153;40.7520100365482;-73.97061555971594;40.75128002679136;-73.97114705148954;40.750550014596506;-73.97167853159286;40.74982000000001;-73.97221;40.75022751179353;-73.97316498241014;40.75063501571574;-73.97411997652544;40.75104251176643;-73.97507498234603;40.751450000000006;-73.97603000000001;40.75176000493325;-73.97678665959076;40.752070004924974;-73.97754332623715;40.75238;-73.9783;40.752410000000005;-73.97836000000001;40.7528;-73.97929;40.75269;-73.97938;40.752680000000005;-73.97938;40.753320001906665;-73.97891000904832;40.75396000190677;-73.97844000904837;40.7546;-73.97797;40.7546;-73.97798;40.754720000000006;-73.97788;40.75511752676265;-73.97882121060428;40.75551504587918;-73.97976243246423;40.75591255734939;-73.98070366557991;40.756310061173096;-73.98164490995138;40.75670755735007;-73.98258616557875;40.75710504588013;-73.9835274324621;40.7575025267631;-73.98446871060148;40.75790000000001;-73.98541;40.757960000000004;-73.98554;40.75733;-73.98602000000001;40.75668000099263;-73.98648500450396;40.75603;-73.98695000000001;40.75562627770136;-73.98599245930922;40.755222547489154;-73.9850349302481;40.75481880936358;-73.98407741281665;40.75441506332485;-73.98311990701471;40.75401130937317;-73.98216241284224;40.75360754750874;-73.98120493029917;40.753203777731805;-73.98024745938541;40.7528;-73.97929;40.752680000000005;-73.97939000000001;40.752660000000006;-73.97939000000001;40.7528;-73.97929;40.753229284561435;-73.9803091517988;40.753658560158044;-73.98132831675812;40.75408782678959;-73.98234749487804;40.75451708445581;-73.98336668615866;40.75494633315649;-73.98438589060007;40.75537557289131;-73.98540510820237;40.75580480366009;-73.98642433896565;40.75623402546253;-73.98744358289002;40.756663238298394;-73.98846283997555;40.75709244216743;-73.98948211022235;40.757521637069395;-73.99050139363052;40.75795082300402;-73.99152069020013;40.75838;-73.99254;40.758755003298226;-73.99341999493298;40.759130000000006;-73.99430000000001;40.75937500158796;-73.9948899980318;40.759620000000005;-73.99548;40.76037601182954;-73.99492805650928;40.76113202102958;-73.99437610046327;40.76188802759999;-73.99382413186136;40.76264403154064;-73.99327215070299;40.76340003285139;-73.9927201569876;40.764156031532146;-73.99216815071458;40.76491202758274;-73.99161613188338;40.76566802100305;-73.9910641004934;40.76642401179295;-73.99051205654409;40.76718;-73.98996000000001*GPSBoy*40.74437;-73.98332;40.74477500034387;-73.98302500181948;40.745180000000005;-73.98273;40.745598059608064;-73.98372324591864;40.746016110701625;-73.9847165043245;40.74643415328043;-73.98570977521771;40.74685218734427;-73.98670305859832;40.74727021289291;-73.98769635446646;40.74768822992608;-73.9886896628222;40.74810623844359;-73.9896829836656;40.748524238445185;-73.99067631699677;40.748942229930655;-73.99166966281578;40.74936021289975;-73.99266302112275;40.74977818735223;-73.99365639191775;40.75019615328789;-73.99464977520086;40.75061411070647;-73.99564317097217;40.751032059607745;-73.99663657923178;40.751450000000006;-73.99763;40.751380000000005;-73.99766000000001;40.75067000000001;-73.99817;40.75066;-73.99817;40.74993728472576;-73.99869733003281;40.74921456705154;-73.99922464860296;40.74849184697748;-73.99975195571093;40.74776912450366;-74.00027925135726;40.74704639963021;-74.00080653554242;40.74632367235725;-74.00133380826693;40.74560094268489;-74.00186106953132;40.74487821061323;-74.00238831933603;40.744155476142396;-74.00291555768162;40.74343273927248;-74.00344278456856;40.74271;-74.00397000000001;40.74255;-74.00408;40.74251;-74.00417;40.742250000000006;-74.00435;40.74217;-74.00439;40.741670000000006;-74.00475;40.74165;-74.00489;40.74157;-74.00500000000001;40.741080000000004;-74.00538;40.74094;-74.00537;40.7405416860031;-74.00442330498956;40.74014336427149;-74.00347662131703;40.73974503480536;-74.00252994898234;40.73934669760493;-74.00158328798543;40.73894835267038;-74.0006366383262;40.738550000000004;-73.99969;40.73846;-73.99975;40.73845;-73.99976000000001;40.73917666909291;-73.999230011578;40.73990333576163;-73.99870001157672;40.74063;-73.99817;40.74062;-73.99818;40.741283335348015;-73.99769667630798;40.74194666867994;-73.99721334297584;40.742610000000006;-73.99673;40.7426;-73.99673;40.743356669210556;-73.99618001256293;40.74411333581044;-73.9956300126117;40.744870000000006;-73.99508;40.744870000000006;-73.99509;40.74543500080173;-73.99468000342777;40.746;-73.99427;40.74595;-73.99415;40.745566673831775;-73.99323998955265;40.74518334051647;-73.9923299895956;40.744800000000005;-73.99142;40.74416666853324;-73.99188334214746;40.74353333521366;-73.99234667547061;40.742900000000006;-73.99281;40.742153335950604;-73.99335334548144;40.74140666935336;-73.99389667876405;40.740660000000005;-73.99444000000001;40.740640000000006;-73.99444000000001;40.74004000166464;-73.99488000794219;40.7394400016584;-73.99532000794663;40.73884;-73.99576;40.73884;-73.99577000000001;40.73810000124649;-73.99631000601556;40.73736;-73.99685000000001;40.737020008380455;-73.99604498763739;40.73668001116819;-73.99523998350315;40.73634000836334;-73.99443498759724;40.736000000000004;-73.99363000000001;40.73560334122823;-73.99267332191697;40.73520667455796;-73.9917166552418;40.73481;-73.99076000000001;40.734860000000005;-73.99064;40.7351;-73.99022000000001;40.73534;-73.98992000000001;40.735925000899236;-73.9894950036501;40.73651;-73.98907000000001;40.73711500078898;-73.9886150042164;40.73772;-73.98816000000001;40.73845778776604;-73.98762226993513;40.73919557303656;-73.98708452794237;40.739933355811424;-73.98654677402116;40.740671136090526;-73.98600900817101;40.74140891387372;-73.98547123039135;40.74214668916091;-73.98493344068166;40.742884461951974;-73.9843956390414;40.74362223224678;-73.98385782547004;40.74436;-73.98332*Marek123*40.75325;-73.98037000000001;40.75283000434664;-73.97936499362264;40.752410000000005;-73.97836000000001;40.75238;-73.9783;40.75207000494989;-73.97754332629796;40.75176000495816;-73.97678665965158;40.751450000000006;-73.97603000000001;40.75111000273317;-73.97523999605319;40.75077;-73.97445;40.750640000000004;-73.97454;40.75063;-73.97455000000001;40.75077;-73.97445;40.75111000265334;-73.97523999586771;40.751450000000006;-73.97603000000001;40.75069301188016;-73.97658305665684;40.74993602112043;-73.97713610072131;40.74917902772099;-73.97768913219406;40.74842203168193;-73.97824215107563;40.74766503300342;-73.97879515736662;40.74690803168556;-73.9793481510676;40.746151027728466;-73.97990113217914;40.74539402113232;-73.98045410070183;40.74463701189721;-73.98100705663626;40.743880000000004;-73.98156;40.743930000000006;-73.98168000000001;40.743880000000004;-73.98156;40.74326000000001;-73.98201;40.74360000849385;-73.98281998757814;40.743940011325336;-73.98362998343778;40.74428000849434;-73.98443998757897;40.744620000000005;-73.98525000000001;40.74524;-73.9848;40.74589500089228;-73.98433500460872;40.746550000000006;-73.98387000000001;40.74715500088868;-73.98341500414291;40.74776000000001;-73.98296;40.748461435301415;-73.98245003228098;40.74916286835819;-73.98194005380344;40.74986429917026;-73.98143006456696;40.7505657277375;-73.98092006457107;40.75126715405984;-73.9804100538153;40.75196857813714;-73.97990003229921;40.75267;-73.97939000000001;40.752660000000006;-73.97940000000001;40.7528;-73.97929;40.75322131472935;-73.98028990495614;40.753642620829304;-73.98128982258453;40.7540639182996;-73.98228975288526;40.754485207140036;-73.98328969585843;40.75490648735034;-73.98428965150411;40.755327758930285;-73.98528961982241;40.75574902187964;-73.98628960081341;40.75617027619816;-73.9872895944772;40.75659152188561;-73.98828960081387;40.757012758941755;-73.98928961982352;40.75743398736637;-73.99028965150623;40.757855207159174;-73.99128969586206;40.75827641831998;-73.99228975289115;40.75869762084852;-73.99328982259357;40.75911881474457;-73.9942899049694;40.75954;-73.99529000000001;40.759620000000005;-73.99548;40.758970000000005;-73.99595000000001;40.75835000174424;-73.99640334181119;40.75773000171465;-73.99685667516604;40.757110000000004;-73.99731000000001;40.75649000176412;-73.99776000838166;40.7558700017804;-73.99821000836971;40.755250000000004;-73.99866;40.754646668380964;-73.9991033413665;40.75404333506551;-73.9995466746866;40.753440000000005;-73.99999000000001;40.75343;-74.0;40.75275000102326;-74.00049500508737;40.75207;-74.00099;40.75144;-74.00143;40.75207;-74.00099;40.75173500274454;-74.0001949960351;40.751400000000004;-73.99940000000001;40.75133;-73.99914000000001;40.750980000000006;-73.99837000000001;40.7509;-73.99816000000001;40.75025;-73.99863;40.75087000089389;-73.9981750042422;40.751490000000004;-73.99772;40.75142;-73.99755;40.75155;-73.99754;40.75207;-73.99714;40.75209;-73.99721000000001;40.752120000000005;-73.99727;40.75264000000001;-73.99688;40.752720000000004;-73.99680000000001;40.753080000000004;-73.99656;40.75307;-73.99656;40.75360666792312;-73.99617333960002;40.75414333455585;-73.99578667295789;40.75468;-73.9954;40.755030000000005;-73.99511000000001;40.755480000000006;-73.99479000000001;40.75547;-73.99480000000001;40.75623;-73.99427;40.756220000000006;-73.99427;40.75654;-73.99405;40.75709500084124;-73.99363000344589;40.757650000000005;-73.99321;40.75764;-73.99321;40.758340000000004;-73.9927', 31, 915, 48614, 'Nitra District, Slovakia'),
(60, 1, '2018-10-07 13:37', 'Pes', 1, '48.171870000000006;17.16353;48.172360000000005;17.16296;48.172380000000004;17.163;48.1724;17.16297;48.17280000247191;17.16372999400894;48.1732;17.16449;48.173170000000006;17.164520000000003;48.173190000000005;17.164550000000002;48.17266;17.16517;48.17268000000001;17.16515;48.17307;17.1659;48.17307;17.16589;48.17356;17.16682;48.173965002507906;17.167574994103607;48.17437;17.16833;48.174795002953324;17.16915999305363;48.17522;17.169990000000002;48.174960000000006;17.17032;48.174420000000005;17.170920000000002;48.17401000105308;17.171405003839045;48.1736;17.17189;48.17329;17.172250000000002;48.17327;17.1722;48.17293;17.17155;48.17284;17.17134;48.173140000000004;17.17099;48.17268000334298;17.170109992076465;48.17222;17.169230000000002;48.17192000000001;17.168680000000002;48.17143;17.16776;48.170950000000005;17.168290000000002;48.17083;17.16807;48.17081;17.168100000000003;48.170910000000006;17.168280000000003;48.170910000000006;17.16827;48.17081;17.168100000000003;48.17083;17.16807;48.170570000000005;17.16758;48.170550000000006;17.16761;48.17100000000001;17.167060000000003;48.171020000000006;17.16705;48.17083;17.166680000000003;48.170820000000006;17.166680000000003;48.171020000000006;17.16705;48.171580000000006;17.166400000000003;48.17186;17.166050000000002;48.17166;17.165680000000002;48.17147000000001;17.165300000000002;48.171440000000004;17.16532;48.17105;17.16459;48.17108;17.16456;48.171060000000004;17.164540000000002;48.17134;17.16421;48.17132;17.16418;48.171290000000006;17.16421;48.170750000000005;17.16317;48.17074;17.16317;48.170440000000006;17.162580000000002;48.17098000000001;17.16195;48.17100000000001;17.162000000000003;48.171020000000006;17.16197;48.17146;17.16281;48.17146;17.1628;48.171850000000006;17.16356;48.171870000000006;17.16353', 0, 915, 48614, 'Nitra District, Slovakia'),
(61, 1, '2018-10-07 14:21', 'zahrada lol\n', 0, '48.24361;18.01762;48.243534;18.017714;48.243416;18.017864;48.243286;18.017996;48.243183;18.018026;48.243172;18.018167;48.243187;18.018303;48.243099;18.018234;48.243038;18.018127', 0, 848484181, 484, 'Nitra District, Slovakia');
INSERT INTO `posts` (`id`, `id_user`, `date`, `description`, `activity`, `points`, `collaboration`, `duration`, `length`, `place`) VALUES
(63, 1, '2018-10-09 13:52', 'Cesta zo školy', 0, '48.307743;18.089052;48.307789;18.088913;48.307812;18.08876;48.307827;18.088602;48.307835;18.088427;48.307739;18.088438;48.307667;18.088352;48.307644;18.088213;48.307598;18.088089;48.307499;18.08802;48.307423;18.087938;48.307343;18.087831;48.307262;18.087744;48.307178;18.087698;48.307091;18.087652;48.307003;18.08761;48.306931;18.087517;48.306843;18.08744;48.306786;18.087317;48.306705;18.087255;48.306614;18.087202;48.306526;18.087133;48.306458;18.087038;48.30637;18.086958;48.306293;18.086878;48.30621;18.086811;48.306122;18.086769;48.30603;18.086731;48.30595;18.086637;48.305878;18.086552;48.305805;18.086473;48.305714;18.086409;48.305634;18.086338;48.305546;18.086252;48.305466;18.086189;48.305386;18.086111;48.305298;18.086031;48.305206;18.085964;48.305119;18.085892;48.305035;18.08585;48.304951;18.085796;48.304966;18.085659;48.304985;18.085518;48.304897;18.085474;48.304806;18.085423;48.30471;18.085375;48.30463;18.085289;48.304619;18.085152;48.3046;18.085012;48.304573;18.084867;48.304539;18.084732;48.304482;18.084602;48.304398;18.084536;48.304298;18.084494;48.304207;18.084475;48.304123;18.084408;48.304024;18.084368;48.303928;18.084337;48.303837;18.084301;48.303757;18.084238;48.303669;18.084187;48.303589;18.084103;48.303513;18.084026;48.303516;18.083891;48.303547;18.083763;48.30349;18.083643;48.303452;18.083511;48.303452;18.083368;48.30341;18.083246;48.303341;18.083158;48.303246;18.083076;48.303173;18.082993;48.303219;18.082861;48.303268;18.082727;48.303322;18.082594;48.303349;18.082457;48.303391;18.082319;48.303429;18.08218;48.303486;18.082056;48.303535;18.081944;48.303581;18.081814;48.303623;18.081675;48.303646;18.081541;48.303707;18.081442;48.303802;18.081373;48.303894;18.081324;48.30394;18.081202;48.303978;18.081057;48.30402;18.0809;48.304043;18.080729;48.304131;18.080767;48.304211;18.08069;48.304218;18.080835;48.304142;18.080929;48.304058;18.081068;48.304024;18.081215;48.303932;18.081306;48.303829;18.081251;48.303753;18.081177;48.303665;18.081099;48.303581;18.08102;48.303505;18.0809;48.30352;18.080729;48.303589;18.08057;48.30365;18.08042;48.303715;18.080267;48.303757;18.080126;48.303787;18.079958;48.303795;18.079815;48.30368;18.079758;48.303562;18.079763;48.303459;18.079781;48.303349;18.0798;48.303215;18.079823;48.303082;18.079836;48.30294;18.079859;48.302795;18.079882;48.30265;18.079901;48.302502;18.079926;48.302349;18.079962;48.302197;18.079985;48.302052;18.080002;48.301914;18.080017;48.301792;18.080029;48.301632;18.080038;48.301529;18.080048;48.30143;18.080061;48.301342;18.080114;48.301285;18.080223;48.301228;18.080387;48.30117;18.080551;48.301079;18.080793;48.301025;18.080942;48.300972;18.081089;48.300896;18.081264;48.3008;18.081348;48.300694;18.081337;48.300621;18.081251;48.300514;18.081135;48.300423;18.081066;48.300304;18.080969;48.300167;18.08086;48.300026;18.080759;48.299885;18.080666;48.299728;18.080587;48.299564;18.080496;48.299389;18.080391;48.299297;18.080351;48.299206;18.08032;48.29911;18.080292;48.299015;18.080275;48.29892;18.080254;48.298824;18.080236;48.298729;18.080225;48.29863;18.080219;48.298534;18.080221;48.298439;18.080223;48.298344;18.080231;48.298252;18.080246;48.298157;18.080265;48.298061;18.08028;48.297966;18.080296;48.297871;18.080311;48.297775;18.08033;48.297684;18.080351;48.297588;18.080372;48.297501;18.080397;48.297325;18.080446;48.297165;18.08049;48.29702;18.080523;48.29689;18.080551;48.296776;18.080574;48.296665;18.080584;48.296566;18.080587;48.296455;18.080595;48.296337;18.080599;48.296246;18.080606;48.296154;18.080585;48.296078;18.080494;48.296043;18.080322;48.296024;18.080126;48.295998;18.079918;48.295967;18.079704;48.295937;18.079468;48.295876;18.079231;48.295795;18.078993;48.295696;18.078762;48.295635;18.078655;48.295563;18.078554;48.295479;18.078465;48.295391;18.078382;48.295288;18.078321;48.295185;18.078268;48.295078;18.078213;48.294968;18.078171;48.294857;18.078129;48.294746;18.078079;48.29464;18.078041;48.294529;18.077995;48.294426;18.077957;48.294323;18.077923;48.29422;18.077887;48.294125;18.077841;48.294025;18.077797;48.29393;18.077753;48.293842;18.077705;48.293697;18.077608;48.293587;18.077534;48.293495;18.07748;48.293388;18.077452;48.293285;18.077419;48.293156;18.077362;48.293056;18.077309;48.292931;18.077248;48.292778;18.077166;48.292622;18.077087;48.292454;18.077002;48.292366;18.076958;48.292271;18.076908;48.292175;18.076859;48.29208;18.076811;48.291981;18.076765;48.291882;18.076719;48.291782;18.07667;48.291683;18.07662;48.291584;18.076571;48.291489;18.076525;48.291393;18.076481;48.291298;18.076435;48.291203;18.076389;48.291107;18.076344;48.291016;18.076298;48.290924;18.076256;48.290833;18.076212;48.290741;18.076168;48.290649;18.076126;48.290562;18.076084;48.290474;18.076042;48.290386;18.076002;48.290298;18.075958;48.290211;18.07592;48.290123;18.075884;48.290035;18.07585;48.289948;18.075813;48.289864;18.075768;48.289696;18.075678;48.289528;18.075584;48.289364;18.075481;48.289207;18.075354;48.289062;18.075211;48.288921;18.075054;48.288784;18.074881;48.288654;18.074701;48.288517;18.074535;48.288387;18.074368;48.288265;18.074183;48.288143;18.073999;48.288025;18.073809;48.287903;18.073624;48.287781;18.073437;48.287663;18.073252;48.28754;18.073067;48.287422;18.072887;48.287304;18.072708;48.287189;18.072544;48.287086;18.072397;48.287006;18.072264;48.286938;18.072145;48.286861;18.072016;48.286777;18.071903;48.28669;18.071785;48.286617;18.071663;48.286541;18.071548;48.286449;18.071404;48.286339;18.071236;48.286224;18.071056;48.28611;18.070879;48.285976;18.070698;48.285904;18.070602;48.285831;18.070501;48.285759;18.070398;48.285686;18.070293;48.28561;18.07019;48.28553;18.070084;48.285454;18.069977;48.285374;18.069868;48.285294;18.069756;48.285213;18.069635;48.285137;18.069513;48.285065;18.069387;48.284985;18.069267;48.284908;18.069145;48.284836;18.069023;48.284763;18.068897;48.284691;18.068771;48.284611;18.068657;48.284534;18.068535;48.284462;18.068409;48.284393;18.068275;48.284328;18.06814;48.284264;18.068003;48.284203;18.067865;48.284138;18.067732;48.284081;18.067595;48.284019;18.067459;48.283962;18.067329;48.283901;18.067209;48.283848;18.067091;48.283798;18.066969;48.283749;18.066853;48.283695;18.066744;48.283642;18.066633;48.283592;18.066519;48.283535;18.066408;48.283482;18.066298;48.283379;18.066086;48.283268;18.065882;48.28315;18.065676;48.283089;18.065571;48.283024;18.065466;48.282963;18.065359;48.282902;18.065254;48.282841;18.065145;48.28278;18.065039;48.282715;18.064932;48.282654;18.064825;48.282589;18.06472;48.282528;18.06461;48.282467;18.064501;48.28241;18.06439;48.282345;18.064281;48.28228;18.064171;48.282219;18.064058;48.282158;18.06394;48.282101;18.063824;48.282043;18.063705;48.281986;18.063587;48.281929;18.063471;48.281868;18.063356;48.281815;18.063236;48.281761;18.06312;48.281708;18.063;48.281658;18.062876;48.281605;18.062756;48.281548;18.062632;48.281494;18.062506;48.281445;18.062376;48.281391;18.06225;48.281338;18.062122;48.281288;18.061995;48.281246;18.061863;48.281197;18.061741;48.281143;18.061617;48.281094;18.061497;48.28104;18.061378;48.280991;18.061258;48.280941;18.06114;48.280891;18.061022;48.280838;18.060905;48.2808;18.06077;48.280746;18.060654;48.280682;18.060547;48.280605;18.060455;48.280525;18.060373;48.280437;18.060307;48.280342;18.060253;48.280247;18.060211;48.280151;18.060171;48.280056;18.060133;48.279961;18.060095;48.279869;18.060055;48.279778;18.060009;48.279686;18.059965;48.279598;18.059908;48.279518;18.059839;48.279438;18.059765;48.279358;18.059694;48.279282;18.059616;48.279205;18.059536;48.279133;18.05945;48.27906;18.059359;48.278992;18.059263;48.278927;18.059164;48.278862;18.059069;48.278797;18.058969;48.278736;18.058865;48.278683;18.058748;48.278629;18.058632;48.27858;18.058516;48.278534;18.058392;48.278484;18.058271;48.278435;18.058149;48.278393;18.058025;48.278355;18.057898;48.27832;18.057772;48.27829;18.057642;48.278259;18.05751;48.278233;18.057381;48.278202;18.057247;48.278168;18.057112;48.278126;18.056973;48.278084;18.056833;48.278046;18.056686;48.278027;18.05652;48.277988;18.056368;48.27795;18.056219;48.277893;18.056082;48.277828;18.055943;48.27776;18.055807;48.277679;18.055681;48.277596;18.055561;48.277504;18.055447;48.277416;18.055325;48.277313;18.055229;48.27721;18.05514;48.2771;18.055052;48.276993;18.05496;48.27689;18.054865;48.276783;18.05477;48.27668;18.054668;48.276577;18.054564;48.27647;18.054462;48.276367;18.054358;48.276268;18.054243;48.276165;18.054132;48.276058;18.05402;48.275955;18.053909;48.275852;18.053795;48.275745;18.053682;48.275635;18.053568;48.275517;18.053457;48.275402;18.053343;48.275284;18.053226;48.275166;18.05311;48.275051;18.052996;48.274929;18.052881;48.274818;18.052759;48.274708;18.052628;48.274609;18.05246;48.274509;18.052288;48.274414;18.05212;48.274315;18.051949;48.27422;18.051781;48.27412;18.051617;48.274029;18.051453;48.273933;18.051294;48.273838;18.051147;48.273743;18.051003;48.273651;18.050859;48.273567;18.050718;48.273483;18.050573;48.273407;18.05043;48.273327;18.050293;48.273254;18.050158;48.273186;18.050028;48.273125;18.04991;48.273029;18.049707;48.272961;18.049564;48.272892;18.049433;48.272797;18.049299;48.27272;18.049175;48.272636;18.049023;48.27253;18.048826;48.272461;18.048717;48.2724;18.048611;48.272331;18.048504;48.272263;18.048389;48.27219;18.048273;48.272114;18.048143;48.272034;18.048004;48.271957;18.047861;48.271877;18.04772;48.271801;18.047577;48.271713;18.047434;48.271629;18.047283;48.271542;18.047129;48.271454;18.04697;48.271366;18.046808;48.271275;18.046644;48.271175;18.046476;48.27108;18.046305;48.270985;18.046127;48.270885;18.04595;48.270782;18.045771;48.270679;18.045595;48.27058;18.045414;48.270481;18.045237;48.270382;18.045061;48.270283;18.044888;48.270187;18.044714;48.270088;18.044544;48.269997;18.044374;48.269901;18.044207;48.269806;18.044043;48.269714;18.043879;48.269623;18.043715;48.269527;18.043552;48.269436;18.043392;48.269344;18.043232;48.269253;18.043072;48.269165;18.042913;48.269073;18.042755;48.268982;18.042595;48.26889;18.042437;48.268791;18.042282;48.268692;18.042122;48.268585;18.041965;48.268478;18.041807;48.268372;18.041649;48.268265;18.041485;48.268158;18.041321;48.268047;18.041151;48.267937;18.040977;48.267822;18.040804;48.267708;18.040627;48.26759;18.040445;48.267467;18.040264;48.267345;18.040081;48.26722;18.039904;48.267094;18.039722;48.266972;18.039537;48.266842;18.039356;48.266712;18.039183;48.266575;18.039019;48.266438;18.038855;48.2663;18.038691;48.266163;18.038523;48.266029;18.038353;48.2659;18.038183;48.265766;18.038017;48.265633;18.037853;48.265499;18.037693;48.265366;18.037542;48.265228;18.037407;48.265083;18.037283;48.264938;18.037163;48.26479;18.037054;48.264645;18.036949;48.2645;18.03685;48.264351;18.036764;48.264202;18.036684;48.264057;18.036598;48.263912;18.036501;48.263771;18.036409;48.263626;18.03632;48.263477;18.036234;48.263329;18.036156;48.263176;18.036085;48.263027;18.036013;48.262875;18.035944;48.262722;18.035875;48.262573;18.035801;48.262424;18.035734;48.262276;18.035673;48.262127;18.035612;48.261978;18.035549;48.261829;18.035479;48.261677;18.035418;48.261524;18.035358;48.261375;18.035294;48.261223;18.035225;48.26107;18.035162;48.260918;18.035093;48.260769;18.035017;48.260624;18.034933;48.260483;18.034845;48.260338;18.034756;48.260197;18.034666;48.260052;18.034571;48.259911;18.034477;48.259766;18.034384;48.259621;18.034288;48.259476;18.034195;48.259327;18.034101;48.259182;18.034012;48.259037;18.03392;48.258888;18.033834;48.258743;18.033751;48.258591;18.033678;48.258442;18.033611;48.258293;18.033548;48.258148;18.033491;48.258003;18.033436;48.257858;18.033388;48.257713;18.033335;48.257568;18.033287;48.257427;18.033237;48.257286;18.033188;48.257145;18.033146;48.257008;18.033102;48.256874;18.033049;48.256741;18.032993;48.256607;18.032936;48.256481;18.032871;48.256351;18.032808;48.256229;18.032743;48.256107;18.032673;48.255985;18.032593;48.255867;18.032511;48.255753;18.032429;48.255638;18.032345;48.255524;18.032265;48.255409;18.032183;48.255295;18.032106;48.255184;18.03203;48.255077;18.031952;48.254974;18.031872;48.254871;18.031801;48.254768;18.031733;48.254662;18.031666;48.254555;18.031593;48.254452;18.031519;48.254353;18.031441;48.25425;18.031363;48.254147;18.031286;48.254044;18.031212;48.253941;18.031137;48.253838;18.031063;48.253735;18.030987;48.253632;18.030912;48.253529;18.030836;48.253426;18.030764;48.253323;18.030691;48.253216;18.030615;48.253113;18.030539;48.25301;18.03046;48.252907;18.030373;48.252804;18.030287;48.252705;18.030197;48.252609;18.0301;48.25251;18.030003;48.252415;18.029903;48.252312;18.029806;48.252213;18.029709;48.252117;18.029606;48.252022;18.029499;48.25193;18.029387;48.251835;18.029274;48.251743;18.029165;48.251648;18.029058;48.251549;18.028957;48.25145;18.028858;48.251354;18.028755;48.251259;18.02865;48.251163;18.028543;48.251072;18.028437;48.25098;18.02833;48.250885;18.028225;48.250793;18.028122;48.250698;18.028017;48.250607;18.027914;48.250515;18.027809;48.250423;18.027704;48.25034;18.027594;48.250256;18.027483;48.250172;18.027378;48.250084;18.027283;48.25;18.027176;48.249931;18.027086;48.249809;18.026924;48.249718;18.026871;48.249638;18.026802;48.249546;18.026627;48.249447;18.026468;48.249332;18.026299;48.249264;18.026197;48.249191;18.026093;48.249115;18.025991;48.249043;18.025894;48.248966;18.025787;48.248886;18.025679;48.248814;18.025576;48.248734;18.025463;48.24865;18.025349;48.248566;18.025227;48.248486;18.025103;48.248405;18.024977;48.248325;18.024851;48.248249;18.024725;48.248169;18.024603;48.248085;18.024481;48.248005;18.024359;48.247925;18.024235;48.247845;18.02412;48.247765;18.024008;48.247684;18.023899;48.247608;18.023787;48.247532;18.023676;48.247459;18.023561;48.247387;18.023451;48.247314;18.023336;48.247246;18.023224;48.247177;18.023111;48.247108;18.022997;48.247036;18.02289;48.246967;18.022783;48.246902;18.022676;48.246838;18.022572;48.24678;18.022469;48.246681;18.022268;48.246593;18.0221;48.246529;18.021992;48.246445;18.021898;48.246368;18.021811;48.246281;18.021704;48.246208;18.021599;48.246132;18.021433;48.246021;18.021242;48.24596;18.021141;48.245895;18.021027;48.245831;18.020912;48.245754;18.020794;48.245678;18.02067;48.245598;18.020544;48.245522;18.020418;48.245438;18.020283;48.245358;18.020145;48.245274;18.020006;48.245193;18.019867;48.245113;18.019726;48.245026;18.019587;48.244942;18.019447;48.244858;18.019302;48.244774;18.019163;48.24469;18.019026;48.244606;18.01889;48.244526;18.018759;48.244442;18.018631;48.244362;18.018503;48.244282;18.018379;48.244205;18.018255;48.244129;18.018135;48.244053;18.018015;48.243984;18.017885;48.243919;18.017759;48.243851;18.017635;48.243786;18.017513;48.243713;18.017401;48.243645;18.01729;48.243576;18.017179;48.243507;18.017071;48.243431;18.016972;48.243359;18.016874;48.243282;18.016781;48.243202;18.016691;48.243122;18.016605;48.243042;18.016521;48.242962;18.016443;48.242882;18.016367;48.242802;18.016287;48.242718;18.016214;48.242634;18.016144;48.24255;18.016075;48.242466;18.016008;48.242382;18.01594;48.242294;18.015873;48.24221;18.015804;48.242126;18.015738;48.241989;18.015608;48.241909;18.015514;48.242001;18.015657;48.242085;18.015745;48.242153;18.015833;48.242237;18.015882;48.242275;18.01602;48.242355;18.016106;48.242443;18.016167;48.242535;18.016226;48.242622;18.016293;48.242699;18.016371;48.242783;18.016459;48.242863;18.016541;48.242943;18.016626;48.243023;18.016689;48.243095;18.016779;48.243179;18.016867;48.243244;18.016962;48.243263;18.017099;48.243176;18.017145;48.243088;18.017208;48.243004;18.017265;48.24292;18.017326;48.242832;18.017391;48.242756;18.017464;48.242752;18.017605;48.24279;18.017733;48.242825;18.017862;48.242859;18.01799;48.242901;18.018131;48.24295;18.018259', 0, 2868088, 10416, 'Nitra District, Slovakia'),
(64, 1, '2018-10-12 09:44', 'eedfff', 0, '48.307743;18.089052;48.307789;18.088913;48.307812;18.08876;48.307827;18.088602;48.307835;18.088427;48.307739;18.088438;48.307667;18.088352;48.307644;18.088213;48.307598;18.088089;48.307499;18.08802;48.307423;18.087938;48.307343;18.087831;48.307262;18.087744;48.307178;18.087698;48.307091;18.087652;48.307003;18.08761;48.306931;18.087517;48.306843;18.08744;48.306786;18.087317;48.306705;18.087255;48.306614;18.087202;48.306526;18.087133;48.306458;18.087038;48.30637;18.086958;48.306293;18.086878;48.30621;18.086811;48.306122;18.086769;48.30603;18.086731;48.30595;18.086637;48.305878;18.086552;48.305805;18.086473;48.305714;18.086409;48.305634;18.086338;48.305546;18.086252;48.305466;18.086189;48.305386;18.086111;48.305298;18.086031;48.305206;18.085964;48.305119;18.085892;48.305035;18.08585;48.304951;18.085796;48.304966;18.085659;48.304985;18.085518;48.304897;18.085474;48.304806;18.085423;48.30471;18.085375;48.30463;18.085289;48.304619;18.085152;48.3046;18.085012;48.304573;18.084867;48.304539;18.084732;48.304482;18.084602;48.304398;18.084536;48.304298;18.084494;48.304207;18.084475;48.304123;18.084408;48.304024;18.084368;48.303928;18.084337;48.303837;18.084301;48.303757;18.084238;48.303669;18.084187;48.303589;18.084103;48.303513;18.084026;48.303516;18.083891;48.303547;18.083763;48.30349;18.083643;48.303452;18.083511;48.303452;18.083368;48.30341;18.083246;48.303341;18.083158;48.303246;18.083076;48.303173;18.082993;48.303219;18.082861;48.303268;18.082727;48.303322;18.082594;48.303349;18.082457;48.303391;18.082319;48.303429;18.08218;48.303486;18.082056;48.303535;18.081944;48.303581;18.081814;48.303623;18.081675;48.303646;18.081541;48.303707;18.081442;48.303802;18.081373;48.303894;18.081324;48.30394;18.081202;48.303978;18.081057;48.30402;18.0809;48.304043;18.080729;48.304131;18.080767;48.304211;18.08069;48.304218;18.080835;48.304142;18.080929;48.304058;18.081068;48.304024;18.081215;48.303932;18.081306;48.303829;18.081251;48.303753;18.081177;48.303665;18.081099;48.303581;18.08102;48.303505;18.0809;48.30352;18.080729;48.303589;18.08057;48.30365;18.08042;48.303715;18.080267;48.303757;18.080126;48.303787;18.079958;48.303795;18.079815;48.30368;18.079758;48.303562;18.079763;48.303459;18.079781;48.303349;18.0798;48.303215;18.079823;48.303082;18.079836;48.30294;18.079859;48.302795;18.079882;48.30265;18.079901;48.302502;18.079926;48.302349;18.079962;48.302197;18.079985;48.302052;18.080002;48.301914;18.080017;48.301792;18.080029;48.301632;18.080038;48.301529;18.080048;48.30143;18.080061;48.301342;18.080114;48.301285;18.080223;48.301228;18.080387;48.30117;18.080551;48.301079;18.080793;48.301025;18.080942;48.300972;18.081089;48.300896;18.081264;48.3008;18.081348;48.300694;18.081337;48.300621;18.081251;48.300514;18.081135;48.300423;18.081066;48.300304;18.080969;48.300167;18.08086;48.300026;18.080759;48.299885;18.080666;48.299728;18.080587;48.299564;18.080496;48.299389;18.080391;48.299297;18.080351;48.299206;18.08032;48.29911;18.080292;48.299015;18.080275;48.29892;18.080254;48.298824;18.080236;48.298729;18.080225;48.29863;18.080219;48.298534;18.080221;48.298439;18.080223;48.298344;18.080231;48.298252;18.080246;48.298157;18.080265;48.298061;18.08028;48.297966;18.080296;48.297871;18.080311;48.297775;18.08033;48.297684;18.080351;48.297588;18.080372;48.297501;18.080397;48.297325;18.080446;48.297165;18.08049;48.29702;18.080523;48.29689;18.080551;48.296776;18.080574;48.296665;18.080584;48.296566;18.080587;48.296455;18.080595;48.296337;18.080599;48.296246;18.080606;48.296154;18.080585;48.296078;18.080494;48.296043;18.080322;48.296024;18.080126;48.295998;18.079918;48.295967;18.079704;48.295937;18.079468;48.295876;18.079231;48.295795;18.078993;48.295696;18.078762;48.295635;18.078655;48.295563;18.078554;48.295479;18.078465;48.295391;18.078382;48.295288;18.078321;48.295185;18.078268;48.295078;18.078213;48.294968;18.078171;48.294857;18.078129;48.294746;18.078079;48.29464;18.078041;48.294529;18.077995;48.294426;18.077957;48.294323;18.077923;48.29422;18.077887;48.294125;18.077841;48.294025;18.077797;48.29393;18.077753;48.293842;18.077705;48.293697;18.077608;48.293587;18.077534;48.293495;18.07748;48.293388;18.077452;48.293285;18.077419;48.293156;18.077362;48.293056;18.077309;48.292931;18.077248;48.292778;18.077166;48.292622;18.077087;48.292454;18.077002;48.292366;18.076958;48.292271;18.076908;48.292175;18.076859;48.29208;18.076811;48.291981;18.076765;48.291882;18.076719;48.291782;18.07667;48.291683;18.07662;48.291584;18.076571;48.291489;18.076525;48.291393;18.076481;48.291298;18.076435;48.291203;18.076389;48.291107;18.076344;48.291016;18.076298;48.290924;18.076256;48.290833;18.076212;48.290741;18.076168;48.290649;18.076126;48.290562;18.076084;48.290474;18.076042;48.290386;18.076002;48.290298;18.075958;48.290211;18.07592;48.290123;18.075884;48.290035;18.07585;48.289948;18.075813;48.289864;18.075768;48.289696;18.075678;48.289528;18.075584;48.289364;18.075481;48.289207;18.075354;48.289062;18.075211;48.288921;18.075054;48.288784;18.074881;48.288654;18.074701;48.288517;18.074535;48.288387;18.074368;48.288265;18.074183;48.288143;18.073999;48.288025;18.073809;48.287903;18.073624;48.287781;18.073437;48.287663;18.073252;48.28754;18.073067;48.287422;18.072887;48.287304;18.072708;48.287189;18.072544;48.287086;18.072397;48.287006;18.072264;48.286938;18.072145;48.286861;18.072016;48.286777;18.071903;48.28669;18.071785;48.286617;18.071663;48.286541;18.071548;48.286449;18.071404;48.286339;18.071236;48.286224;18.071056;48.28611;18.070879;48.285976;18.070698;48.285904;18.070602;48.285831;18.070501;48.285759;18.070398;48.285686;18.070293;48.28561;18.07019;48.28553;18.070084;48.285454;18.069977;48.285374;18.069868;48.285294;18.069756;48.285213;18.069635;48.285137;18.069513;48.285065;18.069387;48.284985;18.069267;48.284908;18.069145;48.284836;18.069023;48.284763;18.068897;48.284691;18.068771;48.284611;18.068657;48.284534;18.068535;48.284462;18.068409;48.284393;18.068275;48.284328;18.06814;48.284264;18.068003;48.284203;18.067865;48.284138;18.067732;48.284081;18.067595;48.284019;18.067459;48.283962;18.067329;48.283901;18.067209;48.283848;18.067091;48.283798;18.066969;48.283749;18.066853;48.283695;18.066744;48.283642;18.066633;48.283592;18.066519;48.283535;18.066408;48.283482;18.066298;48.283379;18.066086;48.283268;18.065882;48.28315;18.065676;48.283089;18.065571;48.283024;18.065466;48.282963;18.065359;48.282902;18.065254;48.282841;18.065145;48.28278;18.065039;48.282715;18.064932;48.282654;18.064825;48.282589;18.06472;48.282528;18.06461;48.282467;18.064501;48.28241;18.06439;48.282345;18.064281;48.28228;18.064171;48.282219;18.064058;48.282158;18.06394;48.282101;18.063824;48.282043;18.063705;48.281986;18.063587;48.281929;18.063471;48.281868;18.063356;48.281815;18.063236;48.281761;18.06312;48.281708;18.063;48.281658;18.062876;48.281605;18.062756;48.281548;18.062632;48.281494;18.062506;48.281445;18.062376;48.281391;18.06225;48.281338;18.062122;48.281288;18.061995;48.281246;18.061863;48.281197;18.061741;48.281143;18.061617;48.281094;18.061497;48.28104;18.061378;48.280991;18.061258;48.280941;18.06114;48.280891;18.061022;48.280838;18.060905;48.2808;18.06077;48.280746;18.060654;48.280682;18.060547;48.280605;18.060455;48.280525;18.060373;48.280437;18.060307;48.280342;18.060253;48.280247;18.060211;48.280151;18.060171;48.280056;18.060133;48.279961;18.060095;48.279869;18.060055;48.279778;18.060009;48.279686;18.059965;48.279598;18.059908;48.279518;18.059839;48.279438;18.059765;48.279358;18.059694;48.279282;18.059616;48.279205;18.059536;48.279133;18.05945;48.27906;18.059359;48.278992;18.059263;48.278927;18.059164;48.278862;18.059069;48.278797;18.058969;48.278736;18.058865;48.278683;18.058748;48.278629;18.058632;48.27858;18.058516;48.278534;18.058392;48.278484;18.058271;48.278435;18.058149;48.278393;18.058025;48.278355;18.057898;48.27832;18.057772;48.27829;18.057642;48.278259;18.05751;48.278233;18.057381;48.278202;18.057247;48.278168;18.057112;48.278126;18.056973;48.278084;18.056833;48.278046;18.056686;48.278027;18.05652;48.277988;18.056368;48.27795;18.056219;48.277893;18.056082;48.277828;18.055943;48.27776;18.055807;48.277679;18.055681;48.277596;18.055561;48.277504;18.055447;48.277416;18.055325;48.277313;18.055229;48.27721;18.05514;48.2771;18.055052;48.276993;18.05496;48.27689;18.054865;48.276783;18.05477;48.27668;18.054668;48.276577;18.054564;48.27647;18.054462;48.276367;18.054358;48.276268;18.054243;48.276165;18.054132;48.276058;18.05402;48.275955;18.053909;48.275852;18.053795;48.275745;18.053682;48.275635;18.053568;48.275517;18.053457;48.275402;18.053343;48.275284;18.053226;48.275166;18.05311;48.275051;18.052996;48.274929;18.052881;48.274818;18.052759;48.274708;18.052628;48.274609;18.05246;48.274509;18.052288;48.274414;18.05212;48.274315;18.051949;48.27422;18.051781;48.27412;18.051617;48.274029;18.051453;48.273933;18.051294;48.273838;18.051147;48.273743;18.051003;48.273651;18.050859;48.273567;18.050718;48.273483;18.050573;48.273407;18.05043;48.273327;18.050293;48.273254;18.050158;48.273186;18.050028;48.273125;18.04991;48.273029;18.049707;48.272961;18.049564;48.272892;18.049433;48.272797;18.049299;48.27272;18.049175;48.272636;18.049023;48.27253;18.048826;48.272461;18.048717;48.2724;18.048611;48.272331;18.048504;48.272263;18.048389;48.27219;18.048273;48.272114;18.048143;48.272034;18.048004;48.271957;18.047861;48.271877;18.04772;48.271801;18.047577;48.271713;18.047434;48.271629;18.047283;48.271542;18.047129;48.271454;18.04697;48.271366;18.046808;48.271275;18.046644;48.271175;18.046476;48.27108;18.046305;48.270985;18.046127;48.270885;18.04595;48.270782;18.045771;48.270679;18.045595;48.27058;18.045414;48.270481;18.045237;48.270382;18.045061;48.270283;18.044888;48.270187;18.044714;48.270088;18.044544;48.269997;18.044374;48.269901;18.044207;48.269806;18.044043;48.269714;18.043879;48.269623;18.043715;48.269527;18.043552;48.269436;18.043392;48.269344;18.043232;48.269253;18.043072;48.269165;18.042913;48.269073;18.042755;48.268982;18.042595;48.26889;18.042437;48.268791;18.042282;48.268692;18.042122;48.268585;18.041965;48.268478;18.041807;48.268372;18.041649;48.268265;18.041485;48.268158;18.041321;48.268047;18.041151;48.267937;18.040977;48.267822;18.040804;48.267708;18.040627;48.26759;18.040445;48.267467;18.040264;48.267345;18.040081;48.26722;18.039904;48.267094;18.039722;48.266972;18.039537;48.266842;18.039356;48.266712;18.039183;48.266575;18.039019;48.266438;18.038855;48.2663;18.038691;48.266163;18.038523;48.266029;18.038353;48.2659;18.038183;48.265766;18.038017;48.265633;18.037853;48.265499;18.037693;48.265366;18.037542;48.265228;18.037407;48.265083;18.037283;48.264938;18.037163;48.26479;18.037054;48.264645;18.036949;48.2645;18.03685;48.264351;18.036764;48.264202;18.036684;48.264057;18.036598;48.263912;18.036501;48.263771;18.036409;48.263626;18.03632;48.263477;18.036234;48.263329;18.036156;48.263176;18.036085;48.263027;18.036013;48.262875;18.035944;48.262722;18.035875;48.262573;18.035801;48.262424;18.035734;48.262276;18.035673;48.262127;18.035612;48.261978;18.035549;48.261829;18.035479;48.261677;18.035418;48.261524;18.035358;48.261375;18.035294;48.261223;18.035225;48.26107;18.035162;48.260918;18.035093;48.260769;18.035017;48.260624;18.034933;48.260483;18.034845;48.260338;18.034756;48.260197;18.034666;48.260052;18.034571;48.259911;18.034477;48.259766;18.034384;48.259621;18.034288;48.259476;18.034195;48.259327;18.034101;48.259182;18.034012;48.259037;18.03392;48.258888;18.033834;48.258743;18.033751;48.258591;18.033678;48.258442;18.033611;48.258293;18.033548;48.258148;18.033491;48.258003;18.033436;48.257858;18.033388;48.257713;18.033335;48.257568;18.033287;48.257427;18.033237;48.257286;18.033188;48.257145;18.033146;48.257008;18.033102;48.256874;18.033049;48.256741;18.032993;48.256607;18.032936;48.256481;18.032871;48.256351;18.032808;48.256229;18.032743;48.256107;18.032673;48.255985;18.032593;48.255867;18.032511;48.255753;18.032429;48.255638;18.032345;48.255524;18.032265;48.255409;18.032183;48.255295;18.032106;48.255184;18.03203;48.255077;18.031952;48.254974;18.031872;48.254871;18.031801;48.254768;18.031733;48.254662;18.031666;48.254555;18.031593;48.254452;18.031519;48.254353;18.031441;48.25425;18.031363;48.254147;18.031286;48.254044;18.031212;48.253941;18.031137;48.253838;18.031063;48.253735;18.030987;48.253632;18.030912;48.253529;18.030836;48.253426;18.030764;48.253323;18.030691;48.253216;18.030615;48.253113;18.030539;48.25301;18.03046;48.252907;18.030373;48.252804;18.030287;48.252705;18.030197;48.252609;18.0301;48.25251;18.030003;48.252415;18.029903;48.252312;18.029806;48.252213;18.029709;48.252117;18.029606;48.252022;18.029499;48.25193;18.029387;48.251835;18.029274;48.251743;18.029165;48.251648;18.029058;48.251549;18.028957;48.25145;18.028858;48.251354;18.028755;48.251259;18.02865;48.251163;18.028543;48.251072;18.028437;48.25098;18.02833;48.250885;18.028225;48.250793;18.028122;48.250698;18.028017;48.250607;18.027914;48.250515;18.027809;48.250423;18.027704;48.25034;18.027594;48.250256;18.027483;48.250172;18.027378;48.250084;18.027283;48.25;18.027176;48.249931;18.027086;48.249809;18.026924;48.249718;18.026871;48.249638;18.026802;48.249546;18.026627;48.249447;18.026468;48.249332;18.026299;48.249264;18.026197;48.249191;18.026093;48.249115;18.025991;48.249043;18.025894;48.248966;18.025787;48.248886;18.025679;48.248814;18.025576;48.248734;18.025463;48.24865;18.025349;48.248566;18.025227;48.248486;18.025103;48.248405;18.024977;48.248325;18.024851;48.248249;18.024725;48.248169;18.024603;48.248085;18.024481;48.248005;18.024359;48.247925;18.024235;48.247845;18.02412;48.247765;18.024008;48.247684;18.023899;48.247608;18.023787;48.247532;18.023676;48.247459;18.023561;48.247387;18.023451;48.247314;18.023336;48.247246;18.023224;48.247177;18.023111;48.247108;18.022997;48.247036;18.02289;48.246967;18.022783;48.246902;18.022676;48.246838;18.022572;48.24678;18.022469;48.246681;18.022268;48.246593;18.0221;48.246529;18.021992;48.246445;18.021898;48.246368;18.021811;48.246281;18.021704;48.246208;18.021599;48.246132;18.021433;48.246021;18.021242;48.24596;18.021141;48.245895;18.021027;48.245831;18.020912;48.245754;18.020794;48.245678;18.02067;48.245598;18.020544;48.245522;18.020418;48.245438;18.020283;48.245358;18.020145;48.245274;18.020006;48.245193;18.019867;48.245113;18.019726;48.245026;18.019587;48.244942;18.019447;48.244858;18.019302;48.244774;18.019163;48.24469;18.019026;48.244606;18.01889;48.244526;18.018759;48.244442;18.018631;48.244362;18.018503;48.244282;18.018379;48.244205;18.018255;48.244129;18.018135;48.244053;18.018015;48.243984;18.017885;48.243919;18.017759;48.243851;18.017635;48.243786;18.017513;48.243713;18.017401;48.243645;18.01729;48.243576;18.017179;48.243507;18.017071;48.243431;18.016972;48.243359;18.016874;48.243282;18.016781;48.243202;18.016691;48.243122;18.016605;48.243042;18.016521;48.242962;18.016443;48.242882;18.016367;48.242802;18.016287;48.242718;18.016214;48.242634;18.016144;48.24255;18.016075;48.242466;18.016008;48.242382;18.01594;48.242294;18.015873;48.24221;18.015804;48.242126;18.015738;48.241989;18.015608;48.241909;18.015514;48.242001;18.015657;48.242085;18.015745;48.242153;18.015833;48.242237;18.015882;48.242275;18.01602;48.242355;18.016106;48.242443;18.016167;48.242535;18.016226;48.242622;18.016293;48.242699;18.016371;48.242783;18.016459;48.242863;18.016541;48.242943;18.016626;48.243023;18.016689;48.243095;18.016779;48.243179;18.016867;48.243244;18.016962;48.243263;18.017099;48.243176;18.017145;48.243088;18.017208;48.243004;18.017265;48.24292;18.017326;48.242832;18.017391;48.242756;18.017464;48.242752;18.017605;48.24279;18.017733;48.242825;18.017862;48.242859;18.01799;48.242901;18.018131;48.24295;18.018259', 0, 2856000, 10404, 'Nitra District, Slovakia'),
(65, 6, '2018-10-19 14:20', 'Dasd\r\n\r\n', 0, '48.24361;18.01762;48.243534;18.017714;48.243416;18.017864;48.243286;18.017996;48.243183;18.018026;48.243172;18.018167;48.243187;18.018303;48.243099;18.018234;48.243038;18.018127', 0, 295600, 10404, 'Nitra District, Slovakia'),
(66, 4, '2018-10-19 14:20', 'ghfgfsgsfDasd\r\n\r\n', 0, '48.24361;18.01762;48.243534;18.017714;48.243416;18.017864;48.243286;18.017996;48.243183;18.018026;48.243172;18.018167;48.243187;18.018303;48.243099;18.018234;48.243038;18.018127', 0, 295600, 10404, 'Nitra District, Slovakia'),
(67, 6, '2018-10-19 12:20', 'Dasd\r\n\r\n😃', 0, '48.24361;18.01762;48.243534;18.017714;48.243416;18.017864;48.243286;18.017996;48.243183;18.018026;48.243172;18.018167;48.243187;18.018303;48.243099;18.018234;48.243038;18.018127', 0, 295600, 10404, 'Nitra District, Slovakia'),
(68, 4, '2018-10-19 10:20', 'asdadasdasdasdas\r\n\r\n', 0, '48.24361;18.01762;48.243534;18.017714;48.243416;18.017864;48.243286;18.017996;48.243183;18.018026;48.243172;18.018167;48.243187;18.018303;48.243099;18.018234;48.243038;18.018127', 0, 295600, 10404, 'Nitra District, Slovakia'),
(70, 1, '2018-11-01 08:42', '', 0, '48.171870000000006;17.16353;48.172360000000005;17.16296;48.172380000000004;17.163;48.1724;17.16297;48.17280000247191;17.16372999400894;48.1732;17.16449;48.173170000000006;17.164520000000003;48.173190000000005;17.164550000000002;48.17266;17.16517;48.17268000000001;17.16515;48.17307;17.1659;48.17307;17.16589;48.17356;17.16682;48.173965002507906;17.167574994103607;48.17437;17.16833;48.174795002953324;17.16915999305363;48.17522;17.169990000000002;48.174960000000006;17.17032;48.174420000000005;17.170920000000002;48.17401000105308;17.171405003839045;48.1736;17.17189;48.17329;17.172250000000002;48.17327;17.1722;48.17293;17.17155;48.17284;17.17134;48.173140000000004;17.17099;48.17268000334298;17.170109992076465;48.17222;17.169230000000002;48.17192000000001;17.168680000000002;48.17143;17.16776;48.170950000000005;17.168290000000002;48.17083;17.16807;48.17081;17.168100000000003;48.170910000000006;17.168280000000003;48.170910000000006;17.16827;48.17081;17.168100000000003;48.17083;17.16807;48.170570000000005;17.16758;48.170550000000006;17.16761;48.17100000000001;17.167060000000003;48.171020000000006;17.16705;48.17083;17.166680000000003;48.170820000000006;17.166680000000003;48.171020000000006;17.16705;48.171580000000006;17.166400000000003;48.17186;17.166050000000002;48.17166;17.165680000000002;48.17147000000001;17.165300000000002;48.171440000000004;17.16532;48.17105;17.16459;48.17108;17.16456;48.171060000000004;17.164540000000002;48.17134;17.16421;48.17132;17.16418;48.171290000000006;17.16421;48.170750000000005;17.16317;48.17074;17.16317;48.170440000000006;17.162580000000002;48.17098000000001;17.16195;48.17100000000001;17.162000000000003;48.171020000000006;17.16197;48.17146;17.16281;48.17146;17.1628;48.171850000000006;17.16356;48.171870000000006;17.16353', 0, 0, 2491, 'Nitra District, Slovakia'),
(77, 1, '2018-11-01 09:43', 'dsd\r\n\r\n', 0, '48.24334;18.01708;48.24291;18.017390000000002;48.242810000000006;18.017480000000003;48.24224000147895;18.01806000644218;48.241670000000006;18.01864;48.24179500194395;18.01930999835076;48.24192000000001;18.01998;48.242470003668416;18.020899990106116;48.24302;18.02182;48.24387666745476;18.021520010046327;48.24473333412918;18.02122001004383;48.24559000000001;18.02092;48.24542;18.02036;48.245110000000004;18.01985;48.24462333937976;18.019016650851494;48.24413667273803;18.018183317561128;48.24365;18.01735;48.24344000000001;18.01717', 0, 0, 1169, 'Nitra District, Slovakia'),
(83, 1, '2018-11-08 13:59', '😇 😇 😑', 0, '40.74437;-73.98332;40.74477500034387;-73.98302500181948;40.745180000000005;-73.98273;40.745598059608064;-73.98372324591864;40.746016110701625;-73.9847165043245;40.74643415328043;-73.98570977521771;40.74685218734427;-73.98670305859832;40.74727021289291;-73.98769635446646;40.74768822992608;-73.9886896628222;40.74810623844359;-73.9896829836656;40.748524238445185;-73.99067631699677;40.748942229930655;-73.99166966281578;40.74936021289975;-73.99266302112275;40.74977818735223;-73.99365639191775;40.75019615328789;-73.99464977520086;40.75061411070647;-73.99564317097217;40.751032059607745;-73.99663657923178;40.751450000000006;-73.99763;40.751380000000005;-73.99766000000001;40.75067000000001;-73.99817;40.75066;-73.99817;40.74993728472576;-73.99869733003281;40.74921456705154;-73.99922464860296;40.74849184697748;-73.99975195571093;40.74776912450366;-74.00027925135726;40.74704639963021;-74.00080653554242;40.74632367235725;-74.00133380826693;40.74560094268489;-74.00186106953132;40.74487821061323;-74.00238831933603;40.744155476142396;-74.00291555768162;40.74343273927248;-74.00344278456856;40.74271;-74.00397000000001;40.74255;-74.00408;40.74251;-74.00417;40.742250000000006;-74.00435;40.74217;-74.00439;40.741670000000006;-74.00475;40.74165;-74.00489;40.74157;-74.00500000000001;40.741080000000004;-74.00538;40.74094;-74.00537;40.7405416860031;-74.00442330498956;40.74014336427149;-74.00347662131703;40.73974503480536;-74.00252994898234;40.73934669760493;-74.00158328798543;40.73894835267038;-74.0006366383262;40.738550000000004;-73.99969;40.73846;-73.99975;40.73845;-73.99976000000001;40.73917666909291;-73.999230011578;40.73990333576163;-73.99870001157672;40.74063;-73.99817;40.74062;-73.99818;40.741283335348015;-73.99769667630798;40.74194666867994;-73.99721334297584;40.742610000000006;-73.99673;40.7426;-73.99673;40.743356669210556;-73.99618001256293;40.74411333581044;-73.9956300126117;40.744870000000006;-73.99508;40.744870000000006;-73.99509;40.74543500080173;-73.99468000342777;40.746;-73.99427;40.74595;-73.99415;40.745566673831775;-73.99323998955265;40.74518334051647;-73.9923299895956;40.744800000000005;-73.99142;40.74416666853324;-73.99188334214746;40.74353333521366;-73.99234667547061;40.742900000000006;-73.99281;40.742153335950604;-73.99335334548144;40.74140666935336;-73.99389667876405;40.740660000000005;-73.99444000000001;40.740640000000006;-73.99444000000001;40.74004000166464;-73.99488000794219;40.7394400016584;-73.99532000794663;40.73884;-73.99576;40.73884;-73.99577000000001;40.73810000124649;-73.99631000601556;40.73736;-73.99685000000001;40.737020008380455;-73.99604498763739;40.73668001116819;-73.99523998350315;40.73634000836334;-73.99443498759724;40.736000000000004;-73.99363000000001;40.73560334122823;-73.99267332191697;40.73520667455796;-73.9917166552418;40.73481;-73.99076000000001;40.734860000000005;-73.99064;40.7351;-73.99022000000001;40.73534;-73.98992000000001;40.735925000899236;-73.9894950036501;40.73651;-73.98907000000001;40.73711500078898;-73.9886150042164;40.73772;-73.98816000000001;40.73845778776604;-73.98762226993513;40.73919557303656;-73.98708452794237;40.739933355811424;-73.98654677402116;40.740671136090526;-73.98600900817101;40.74140891387372;-73.98547123039135;40.74214668916091;-73.98493344068166;40.742884461951974;-73.9843956390414;40.74362223224678;-73.98385782547004;40.74436;-73.98332', 0, 0, 7457, 'New York, NY, USA'),
(85, 7, '2018-11-08 14:40', 'hi', 0, '48.24334;18.01708;48.24291;18.017390000000002;48.242810000000006;18.017480000000003;48.24224000147895;18.01806000644218;48.241670000000006;18.01864;48.24179500194395;18.01930999835076;48.24192000000001;18.01998;48.242470003668416;18.020899990106116;48.24302;18.02182;48.24387666745476;18.021520010046327;48.24473333412918;18.02122001004383;48.24559000000001;18.02092;48.24542;18.02036;48.245110000000004;18.01985;48.24462333937976;18.019016650851494;48.24413667273803;18.018183317561128;48.24365;18.01735;48.24344000000001;18.01717', 0, 0, 1169, 'Nitra District, Slovakia'),
(88, 1, '2018-11-10 14:23', ' 😪 😪 😪', 0, '48.23975200;18.01809310;48.23929510;18.01945560;48.23992390;18.02057140;48.24153880;18.01874750;48.24053840;18.01589360;48.24035270;18.01610820;48.23998110;18.01769610;48.23982000;18.01822990;48.23966280;18.01847660', 0, 0, 904, 'Nitra District, Slovakia');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `projects`
--

INSERT INTO `projects` (`id`, `id_user`, `name`) VALUES
(1, 1, 'Projekt 1'),
(9, 1, 'dsaa'),
(11, 1, 'as'),
(12, 1, 'fff'),
(13, 1, 'qq'),
(14, 1, 'ww'),
(15, 1, 'ee'),
(16, 1, 'rr'),
(23, 1, 'asd'),
(24, 1, 'dsa'),
(25, 1, 'dsa'),
(34, 2, 'Test'),
(37, 1, 'sd'),
(38, 1, 'ds'),
(39, 1, 'ds'),
(40, 1, 'ds'),
(41, 1, 'ds');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `projects_posts`
--

CREATE TABLE `projects_posts` (
  `id` int(11) NOT NULL,
  `id_project` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `projects_posts`
--

INSERT INTO `projects_posts` (`id`, `id_project`, `id_post`, `id_user`, `date`) VALUES
(158, 1, 28, 1, '2017-07-12 19:04'),
(159, 1, 29, 1, '2018-07-12 20:15'),
(167, 1, 30, 1, '2017-09-12 11:04'),
(169, 9, 30, 1, '2018-09-14 13:00'),
(171, 42, 30, 1, '2018-10-13 10:40'),
(172, 42, 29, 1, '2018-10-13 10:40'),
(173, 11, 30, 1, '2018-11-11 10:22');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `reported_posts`
--

CREATE TABLE `reported_posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `reason` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `reported_posts`
--

INSERT INTO `reported_posts` (`id`, `id_user`, `id_post`, `time`, `reason`) VALUES
(1, 1, 1, '2018-07-23 09:31', 4),
(3, 1, 1, '2018-07-27 07:23', 4),
(4, 1, 1, '2018-07-27 07:24', 4),
(5, 1, 1, '2018-07-27 07:26', 1),
(6, 1, 1, '2018-07-27 11:58', 1),
(7, 1, 2, '2018-08-08 11:30', 1),
(8, 1, 9, '2018-08-18 09:13', 3),
(9, 1, 10, '2018-08-19 10:59', 5),
(10, 1, 20, '2018-09-07 13:26', 1),
(11, 1, 30, '2018-11-11 10:22', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `reported_users`
--

CREATE TABLE `reported_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reported` int(11) DEFAULT NULL,
  `reason` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `reported_users`
--

INSERT INTO `reported_users` (`id`, `user_id`, `reported`, `reason`) VALUES
(2, 1, 2, 3),
(3, 1, 3, 5),
(4, 1, 3, 3),
(5, 1, 2, 2),
(6, 1, 2, 3),
(7, 1, 2, 2),
(8, 1, 2, 5),
(9, 1, 2, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/profilepicture.png',
  `hash` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(230) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify` tinyint(4) NOT NULL,
  `date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `email`, `nick_name`, `first_name`, `last_name`, `profile_picture`, `hash`, `password`, `about`, `verify`, `date`) VALUES
(1, 'dusan7991@gmail.com', '___DuS4NN', 'Dušan', 'Orlíček', '/img/uploads/1/h.jpg', '47804e683ec84bebe63a829442ec52414f7c7f68', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Ahojte, volám sa Dušan, Pochádzam z Cabaja  😏 😏 🤭', 1, '2018-06-04 14:58'),
(2, 'gpsboy@gmail.com', 'GPSBoy', 'Juraj', 'Pekný', '/img/uploads/2/giphy.gif', 'c9f3e1a03b73378c806a4883e52771c8da74cd8e', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 1, '2018-07-03 22:34'),
(3, 'marek@gmail.com', 'Marek123', 'Marek', 'Veľký', 'img/profilepicture.png', '8aab1abb3c592ecc9ba612ddeaace3758d6af1ca', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Ahojte, moje meno je Dušan. GPS Drawing som začal robiť pred 4 rokmi a veľmi ma to baví. Je to super. :) Ahojte, moje meno je Dušan. GPS Drawing som začal robiť pred 4 rokmi a veľmi ma to baví. GPS Drawing som robím už asi 4 rok ', 1, '2018-07-12 09:12'),
(4, 'user123@gmail.com', 'User123', 'Filip', 'Veľký', 'img/profilepicture.png', 'f14d3510d30d38aeac7552655405b3ec9630685c', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, '2018-08-09 14:08'),
(5, 'user321@gmail.com', 'User321', 'Jožko', 'Mrkvička', 'img/profilepicture.png', '7556205eac37ace3876ef10e4e7da52ef9fe701b', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 1, '2018-08-30 13:10'),
(6, 'adsad@gmail.com', 'dasd', 'aa', 'bb', 'img/profilepicture.png', 'd83821008b23845991f3e7c0fc14468f1ed96b37', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 0, '2018-09-01 10:53'),
(7, 'niekto@gmail.com', 'Niekto', 'neveim', '123', 'img/profilepicture.png', '6ebe269b5ec048f1b044ec4446795ab37b11a3c4', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 1, '2018-11-08 14:39');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users_badges`
--

CREATE TABLE `users_badges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `badge_id` int(11) DEFAULT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `users_badges`
--

INSERT INTO `users_badges` (`id`, `user_id`, `badge_id`, `date`) VALUES
(1, 1, 1, '2018-08-09 12:54'),
(2, 1, 10, '2018-08-05 14:25'),
(3, 2, 1, '2018-08-04 15:45'),
(4, 3, 1, '2018-07-24 10:46'),
(5, 4, 1, '2018-08-09 14:08'),
(7, 5, 1, '2018-08-30 13:10'),
(8, 6, 1, '2018-09-01 10:53'),
(11, 1, 6, '2018-08-09 15:30\r\n'),
(12, 1, 7, '2018-08-09 15:30\r\n'),
(13, 1, 8, '2018-09-10 16:20'),
(14, 1, 9, '2018-09-10 16:20'),
(15, 1, 11, '2018-09-10 16:20'),
(16, 1, 12, '2018-09-10 16:20'),
(17, 1, 23, '2018-09-10 15:50'),
(18, 2, 5, '2018-11-01 08:38'),
(19, 1, 3, '2018-11-01 08:42'),
(20, 1, 4, '2018-11-01 08:47'),
(21, 1, 2, '2018-11-01 09:01'),
(22, 1, 22, '2018-11-01 09:08'),
(23, 7, 1, '2018-11-08 14:39'),
(24, 8, 1, '2018-11-09 09:08');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users_in_collab`
--

CREATE TABLE `users_in_collab` (
  `id` int(11) NOT NULL,
  `id_collaboration` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `users_in_collab`
--

INSERT INTO `users_in_collab` (`id`, `id_collaboration`, `id_user`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(26, 31, 1),
(27, 31, 2),
(28, 31, 3);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users_options`
--

CREATE TABLE `users_options` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `color` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#1ab188',
  `color_of_collab` tinyint(11) NOT NULL DEFAULT '0',
  `night_mode` tinyint(11) NOT NULL DEFAULT '0',
  `show_icons` tinyint(4) NOT NULL DEFAULT '1',
  `map_theme` int(11) NOT NULL DEFAULT '5',
  `color_icon` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#000000',
  `lang` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collab` tinyint(4) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `users_options`
--

INSERT INTO `users_options` (`id`, `id_user`, `color`, `color_of_collab`, `night_mode`, `show_icons`, `map_theme`, `color_icon`, `lang`, `collab`) VALUES
(2, 1, '#45FFAC', 1, 1, 1, 2, '#FFFFFF', 'sk', 2),
(3, 2, '#1AB188', 1, 0, 1, 5, '#000000', 'en', 2),
(4, 3, '#1ab188', 0, 0, 1, 1, '#16a085', 'en', 2),
(5, 4, '#1ab188', 0, 0, 1, 5, '#000000', 'en', 2),
(6, 5, '#1ab188', 0, 0, 1, 5, '#000000', 'sk', 2),
(7, 6, '#1ab188', 0, 0, 1, 5, '#000000', 'en', 2),
(8, 7, '#1ab188', 0, 0, 1, 5, '#000000', 'en', 2),
(9, 8, '#1ab188', 0, 0, 1, 5, '#000000', 'en', 2);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `badges_id_uindex` (`id`);

--
-- Indexy pre tabuľku `blocked_comments`
--
ALTER TABLE `blocked_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `blocked_posts`
--
ALTER TABLE `blocked_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blocked_users_id_uindex` (`id`);

--
-- Indexy pre tabuľku `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `collaboration`
--
ALTER TABLE `collaboration`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `map_theme`
--
ALTER TABLE `map_theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notification_id_uindex` (`id`);

--
-- Indexy pre tabuľku `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_id_uindex` (`id`);

--
-- Indexy pre tabuľku `projects_posts`
--
ALTER TABLE `projects_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_posts_id_uindex` (`id`);

--
-- Indexy pre tabuľku `reported_posts`
--
ALTER TABLE `reported_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `reported_users`
--
ALTER TABLE `reported_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blocked_users_id_uindex` (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users_badges`
--
ALTER TABLE `users_badges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `badges_id_uindex` (`id`);

--
-- Indexy pre tabuľku `users_in_collab`
--
ALTER TABLE `users_in_collab`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users_options`
--
ALTER TABLE `users_options`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pre tabuľku `blocked_comments`
--
ALTER TABLE `blocked_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `blocked_posts`
--
ALTER TABLE `blocked_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `blocked_users`
--
ALTER TABLE `blocked_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;
--
-- AUTO_INCREMENT pre tabuľku `collaboration`
--
ALTER TABLE `collaboration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pre tabuľku `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;
--
-- AUTO_INCREMENT pre tabuľku `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT pre tabuľku `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT pre tabuľku `map_theme`
--
ALTER TABLE `map_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pre tabuľku `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;
--
-- AUTO_INCREMENT pre tabuľku `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT pre tabuľku `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pre tabuľku `projects_posts`
--
ALTER TABLE `projects_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;
--
-- AUTO_INCREMENT pre tabuľku `reported_posts`
--
ALTER TABLE `reported_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pre tabuľku `reported_users`
--
ALTER TABLE `reported_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pre tabuľku `users_badges`
--
ALTER TABLE `users_badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pre tabuľku `users_in_collab`
--
ALTER TABLE `users_in_collab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pre tabuľku `users_options`
--
ALTER TABLE `users_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
