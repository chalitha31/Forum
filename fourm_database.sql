-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.26 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for elakiri
CREATE DATABASE IF NOT EXISTS `elakiri` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `elakiri`;

-- Dumping structure for table elakiri.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `otp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `admin_type_id` int DEFAULT NULL,
  `blocked` int DEFAULT '0',
  PRIMARY KEY (`email`),
  KEY `FK_admin_admin_type` (`admin_type_id`),
  CONSTRAINT `FK_admin_admin_type` FOREIGN KEY (`admin_type_id`) REFERENCES `admin_type` (`id`),
  CONSTRAINT `FK_admin_users` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.admin: ~3 rows (approximately)
INSERT INTO `admin` (`email`, `otp`, `admin_type_id`, `blocked`) VALUES
	('kawshalya20001025@gmail.com', '64c3f770775c7', 2, 0),
	('prasannasampath064@gmail.com', '64ec4c6036886', 1, 0),
	('samanali@gmail.com', '64c897a883644', 2, 0);

-- Dumping structure for table elakiri.admin_type
CREATE TABLE IF NOT EXISTS `admin_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.admin_type: ~2 rows (approximately)
INSERT INTO `admin_type` (`id`, `name`) VALUES
	(1, 'super Admin'),
	(2, 'Moderator');

-- Dumping structure for table elakiri.bookmark
CREATE TABLE IF NOT EXISTS `bookmark` (
  `id` int NOT NULL AUTO_INCREMENT,
  `postid` int NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bookmark_post` (`postid`),
  KEY `FK_bookmark_users` (`user_email`),
  CONSTRAINT `FK_bookmark_post` FOREIGN KEY (`postid`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_bookmark_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.bookmark: ~6 rows (approximately)
INSERT INTO `bookmark` (`id`, `postid`, `user_email`, `date`) VALUES
	(73, 5, 'samanali@gmail.com', '2023-06-27 16:31:56'),
	(77, 11, 'samanali@gmail.com', '2023-06-27 23:07:03'),
	(78, 3, 'kawshalya20001025@gmail.com', '2023-06-28 02:12:15'),
	(223, 3, 'chalithachamod3031@gmail.com', '2023-07-17 13:02:37'),
	(227, 2, 'mahi@gmail.com', '2023-08-16 21:56:49'),
	(228, 26, 'prasannasampath064@gmail.com', '2023-08-28 12:56:31');

-- Dumping structure for table elakiri.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.category: ~11 rows (approximately)
INSERT INTO `category` (`id`, `name`, `icon`) VALUES
	(1, 'General', 'fa-solid fa-border-all'),
	(2, 'Tech', 'fa-solid fa-microchip'),
	(3, 'Health', 'fa-solid fa-heart-pulse'),
	(4, 'Agree', 'fa-solid fa-tractor'),
	(5, 'Auto', 'fa-solid fa-car'),
	(6, 'Science', 'fa-solid fa-flask'),
	(7, 'Games', 'fa-solid fa-chess-knight'),
	(8, 'Travel', 'fa-solid fa-compass'),
	(9, 'business & Marketing', 'fa-solid fa-briefcase'),
	(10, 'Entertainment', 'fa-solid fa-photo-film'),
	(11, 'Food & Cooking', 'fa-solid fa-burger');

-- Dumping structure for table elakiri.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `comment` text,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comments_users` (`user_email`),
  KEY `FK_comments_post` (`post_id`),
  CONSTRAINT `FK_comments_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_comments_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.comments: ~46 rows (approximately)
INSERT INTO `comments` (`id`, `user_email`, `post_id`, `comment`, `date_time`) VALUES
	(1, 'mahi@gmail.com', 2, 'lassnai', '2022-06-08 21:47:34'),
	(2, 'mahi@gmail.com', 2, 'පට්ට සින්දුව සුපිරි!', '2023-04-08 22:03:06'),
	(3, 'mahi@gmail.com', 2, 'gemmakâ❤️❤️❤', '2023-06-03 23:03:45'),
	(4, 'samanali@gmail.com', 2, 'නයියියිස්ස්ස්ස් අයියා..........😍😍😍😍', '2023-06-09 00:07:46'),
	(5, 'samanali@gmail.com', 2, '💕💕😍', '2023-06-08 12:55:22'),
	(6, 'samanali@gmail.com', 2, 'el', '2023-06-09 00:59:06'),
	(7, 'samanali@gmail.com', 2, '45', '2023-06-09 01:01:47'),
	(8, 'samanali@gmail.com', 4, 'wedak ne', '2023-06-09 01:35:15'),
	(9, 'samanali@gmail.com', 4, '😍', '2023-06-09 01:36:12'),
	(10, 'chalithachamod3031@gmail.com', 1, 'Not important', '2023-06-09 01:42:11'),
	(11, 'chalithachamod3031@gmail.com', 1, 'm...', '2023-06-09 01:44:12'),
	(16, 'chalithachamod3031@gmail.com', 1, 'price', '2023-06-09 01:54:38'),
	(17, 'chalithachamod3031@gmail.com', 1, 'price ?', '2023-06-09 01:54:58'),
	(18, 'chalithachamod3031@gmail.com', 6, 'wow', '2023-06-09 01:59:31'),
	(19, 'chalithachamod3031@gmail.com', 6, 'mm', '2023-06-09 12:45:44'),
	(20, 'salika@gmail.com', 2, 'wow', '2023-06-09 19:18:33'),
	(21, 'salika@gmail.com', 11, '😍😍😍😍😍😍', '2023-06-09 20:35:06'),
	(22, 'samanali@gmail.com', 11, 'ado', '2023-06-27 22:54:51'),
	(23, 'samanali@gmail.com', 11, '👍', '2023-06-27 22:55:03'),
	(24, 'chalithachamod3031@gmail.com', 3, 'nic', '2023-07-01 13:43:33'),
	(25, 'samanali@gmail.com', 2, 'adee patta', '2023-07-01 15:18:50'),
	(26, 'samanali@gmail.com', 2, '😍😍😍😍😍', '2023-07-01 15:20:21'),
	(27, 'samanali@gmail.com', 2, '', '2023-07-01 15:22:03'),
	(28, 'chalithachamod3031@gmail.com', 2, '', '2023-07-01 15:22:20'),
	(29, 'chalithachamod3031@gmail.com', 2, 'dsddsdsdsd', '2023-07-01 15:29:58'),
	(30, 'samanali@gmail.com', 2, 'fattt', '2023-07-01 15:30:25'),
	(31, 'chalithachamod3031@gmail.com', 2, 'wwwwooow', '2023-07-01 15:30:57'),
	(32, 'chalithachamod3031@gmail.com', 2, 'adad', '2023-07-01 15:31:48'),
	(33, 'chalithachamod3031@gmail.com', 2, 'sd', '2023-07-01 15:33:00'),
	(34, 'samanali@gmail.com', 2, 'ggds', '2023-07-01 15:33:04'),
	(35, 'samanali@gmail.com', 2, 'sds', '2023-07-01 15:33:12'),
	(36, 'samanali@gmail.com', 2, '45', '2023-07-01 15:34:27'),
	(37, 'chalithachamod3031@gmail.com', 2, 'gg', '2023-07-01 15:34:53'),
	(38, 'chalithachamod3031@gmail.com', 6, '45', '2023-07-05 13:17:14'),
	(39, 'chalithachamod3031@gmail.com', 3, '45', '2023-07-05 15:40:46'),
	(40, 'chalithachamod3031@gmail.com', 3, 'el', '2023-07-05 16:00:12'),
	(41, 'chalithachamod3031@gmail.com', 3, 'wow', '2023-07-10 11:56:44'),
	(42, 'chalithachamod3031@gmail.com', 1, 'a', '2023-07-10 11:58:07'),
	(43, 'chalithachamod3031@gmail.com', 1, 'gdfggdsgsdg', '2023-07-10 11:59:19'),
	(44, 'kawshalya20001025@gmail.com', 1, '56546456', '2023-07-10 11:59:31'),
	(45, 'chalithachamod3031@gmail.com', 1, 'gftgfgfgf', '2023-07-10 11:59:39'),
	(46, 'chalithachamod3031@gmail.com', 3, 'fghfghfg', '2023-07-18 19:50:08'),
	(47, 'chalithachamod3031@gmail.com', 2, 'dsfgdsgs', '2023-08-01 10:19:27'),
	(48, 'sahannim7@gmail.com', 24, 'el nino situation', '2023-08-28 14:43:26'),
	(49, 'ks9446.hashini@gmail.com', 26, 'oops ... log of my gmails will deleting ', '2023-08-28 14:48:04'),
	(50, 'ks9446.hashini@gmail.com', 24, 'we have to manage water and secure trees ', '2023-08-28 14:50:33');

-- Dumping structure for table elakiri.follow
CREATE TABLE IF NOT EXISTS `follow` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `followed_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `unfollow` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_follow_users` (`email`),
  KEY `FK_follow_users_2` (`followed_email`) USING BTREE,
  CONSTRAINT `FK_follow_users` FOREIGN KEY (`email`) REFERENCES `users` (`email`),
  CONSTRAINT `FK_follow_users_2` FOREIGN KEY (`followed_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.follow: ~11 rows (approximately)
INSERT INTO `follow` (`id`, `email`, `followed_email`, `unfollow`) VALUES
	(4, 'chalithachamod3031@gmail.com', 'samanali@gmail.com', 0),
	(18, 'chalithachamod3031@gmail.com', 'kawshalya20001025@gmail.com', 0),
	(27, 'mahi@gmail.com', 'samanali@gmail.com', 0),
	(34, 'samanali@gmail.com', 'chalithachamod3031@gmail.com', 0),
	(35, 'mahi@gmail.com', 'chalithachamod3031@gmail.com', 0),
	(36, 'kawshalya20001025@gmail.com', 'mahi@gmail.com', 1),
	(37, 'chalithachamod3031@gmail.com', 'mahi@gmail.com', 0),
	(38, 'chalithachamod3031@gmail.com', 'chalithachamod3031@gmail.com', 1),
	(39, 'kawshalya20001025@gmail.com', 'sahannim7@gmail.com', 0),
	(40, 'prasannasampath064@gmail.com', 'sahannim7@gmail.com', 0),
	(41, 'prasannasampath064@gmail.com', 'ks9446.hashini@gmail.com', 0),
	(42, 'prasannasampath064@gmail.com', 'chalithachamod3031@gmail.com', 1);

-- Dumping structure for table elakiri.follow_notification
CREATE TABLE IF NOT EXISTS `follow_notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `follow_id` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `read` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_follow_notification_follow` (`follow_id`),
  CONSTRAINT `FK_follow_notification_follow` FOREIGN KEY (`follow_id`) REFERENCES `follow` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.follow_notification: ~30 rows (approximately)
INSERT INTO `follow_notification` (`id`, `follow_id`, `datetime`, `read`) VALUES
	(9, 27, '2023-08-16 12:46:52', 1),
	(11, 35, '2023-08-16 12:56:36', 1),
	(17, 36, '2023-08-17 20:50:04', 1),
	(18, 37, '2023-08-18 09:13:57', 1),
	(19, 37, '2023-08-18 09:15:14', 1),
	(20, 37, '2023-08-18 09:15:23', 1),
	(21, 38, '2023-08-18 09:15:34', 1),
	(22, 38, '2023-08-18 09:18:02', 1),
	(23, 38, '2023-08-18 09:19:00', 1),
	(24, 38, '2023-08-18 09:19:20', 1),
	(25, 38, '2023-08-18 09:22:31', 1),
	(26, 37, '2023-08-18 10:26:31', 1),
	(27, 37, '2023-08-18 10:27:06', 1),
	(28, 35, '2023-08-18 10:27:40', 1),
	(29, 35, '2023-08-18 10:27:54', 1),
	(30, 38, '2023-08-18 10:28:43', 1),
	(31, 35, '2023-08-18 10:31:03', 1),
	(32, 35, '2023-08-18 10:52:20', 1),
	(33, 39, '2023-08-27 07:59:31', 1),
	(34, 40, '2023-08-28 14:43:06', 0),
	(35, 41, '2023-08-28 14:46:30', 0),
	(36, 38, '2023-08-28 18:43:18', 1),
	(37, 38, '2023-08-28 18:45:38', 1),
	(38, 38, '2023-08-28 18:47:14', 1),
	(39, 38, '2023-08-28 18:52:28', 1),
	(40, 42, '2023-08-28 19:03:37', 0),
	(41, 38, '2023-08-30 15:34:42', 1),
	(42, 34, '2023-08-30 20:09:22', 0),
	(43, 37, '2023-08-30 20:10:55', 1),
	(44, 37, '2023-08-30 20:11:19', 1);

-- Dumping structure for table elakiri.notification
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `notification_type_id` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_notification_users` (`email`),
  KEY `FK_notification_notification_type` (`notification_type_id`),
  CONSTRAINT `FK_notification_notification_type` FOREIGN KEY (`notification_type_id`) REFERENCES `notification_type` (`id`),
  CONSTRAINT `FK_notification_users` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.notification: ~2 rows (approximately)
INSERT INTO `notification` (`id`, `email`, `notification_type_id`, `datetime`) VALUES
	(1, 'chalithachamod3031@gmail.com', 1, '2022-06-08 21:47:34'),
	(2, 'samanali@gmail.com', 1, '2023-08-08 21:10:25');

-- Dumping structure for table elakiri.notification_type
CREATE TABLE IF NOT EXISTS `notification_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.notification_type: ~5 rows (approximately)
INSERT INTO `notification_type` (`id`, `name`) VALUES
	(1, 'friend'),
	(2, 'relist'),
	(3, 'report'),
	(4, 'block'),
	(5, 'removed');

-- Dumping structure for table elakiri.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `media` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `post_content` text,
  `date` datetime DEFAULT NULL,
  `hidden` int DEFAULT '0',
  `view_id` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_post_users` (`user_email`),
  KEY `FK_post_category` (`category_id`),
  KEY `FK_post_post_view` (`view_id`),
  CONSTRAINT `FK_post_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_post_post_view` FOREIGN KEY (`view_id`) REFERENCES `post_view` (`id`),
  CONSTRAINT `FK_post_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.post: ~36 rows (approximately)
INSERT INTO `post` (`id`, `post_title`, `user_email`, `category_id`, `media`, `post_content`, `date`, `hidden`, `view_id`) VALUES
	(1, 'tree', 'chalithachamod3031@gmail.com', 4, '647f94d36e705.jpeg', 'පට්ට ලස්සන ගහක් ඒක මර', '2023-06-03 00:00:00', 0, 1),
	(2, 'abcdef', 'samanali@gmail.com', 1, '647f9606f3bc7.mp4', 'katharaka thani vii  ඔබ යන  අයුරු පෙනි පෙනී...\\r\\n', '2023-06-07 00:00:00', 0, 2),
	(3, 'සොන්ග්', 'chalithachamod3031@gmail.com', 1, '647f967e2c08c.mp3', 'හා ආ ආ ආ.<br/>  හා ආ ආ ආ..<br/>  අදුරු කුටිය තුල.......<br/> දොරගුළු ලාගෙන....<br/> ගයන ගීතිකා....<br/> යදින යාතිකා....<br/> දෙවියන් හට නෑසේ..<br/>.. දෙවියන් හට නෑසේ....<br/>  පොළොව කොටන තැන....<br/> පාර තනන තැන.....<br/> ගිණියම් අව්වේ......<br/> මහ වරුසාවේ......<br/> දෙවියෝ වැඩ ඉන්නේ..<br/>.. දෙවියෝ වැඩ ඉන්නේ....<br/> බලන් කඩ තුරා..හැර දෑසේ.<br/>.. බලන් කඩ තුරා හැර දෑසේ...<br/> හා... ආ.. ආ.. ආ<br/>   🙏🙏🙏🙏 <br/> සිනිදු සුවැති සළු සිරසින් හැරදා.. <br/> දූවිලි මඩ වැකි පිළි ගත පලදා...<br/> දෙවියන් රුව දක්නට හැක්කේ<br/> හා..ආ..ආ...ආ...<br/> <br/>  අදුරු කුටිය තුල....... <br/> දොරගුළු ලාගෙන....<br/> ගයන ගීතිකා....<br/> යදින යාතිකා....<br/> දෙවියන් හට නෑසේ..<br/>.. දෙවියන් හට නෑසේ....<br/> <br/> පොළොව කොටන තැන....<br/> පාර තනන තැන.....<br/> ගිණියම් අව්වේ......<br/> මහ වරුසාවේ......<br/> දෙවියෝ වැඩ ඉන්නේ..<br/>.. දෙවියෝ වැඩ ඉන්නේ....<br/> බලන් කඩ තුරා හැර දෑසේ..<br/>. බලන් කඩ තුරා හැර දෑසේ...<br/> හා... ආ..හා ආ.. ආ<br/> <br/> හා... ආ..හා ආ.. ආ<br/>  🙏🙏🙏🙏 <br/>  කුසුම් සදුන් දුම් සුවදින් වැලකී<br/> ගත නැගි දාඩිය සුවදින් සැරසී...<br/> දෙවියන් හා එක්විය හැක්කේ<br/> හා...ආ...හාආ..හා.ආ<br/> <br/> අදුරු කුටිය තුල.......<br/>  දොරගුළු ලාගෙන....<br/> ගයන ගීතිකා....<br/> යදින යාතිකා....<br/> දෙවියන් හට නෑසේ..<br/>.. දෙවියන් හට නෑසේ....<br/> <br/> පොළොව කොටන තැන....<br/> පාර තනන තැන.....<br/> ගිණියම් අව්වේ......<br/> මහ වරුසාවේ......<br/> දෙවියෝ වැඩ ඉන්නේ..<br/>.. දෙවියෝ වැඩ ඉන්නේ....<br/> බලන් කඩ තුරා හැර දෑසේ..<br/>. බලන් කඩ තුරා හැර දෑසේ...<br/', '2023-06-06 00:00:00', 0, 1),
	(4, 'කොහු', 'salika@gmail.com', 4, '648021d17a20f.jpeg', '\'මල් පැල සදහා 1kg Rs : 650 \\r\\ncontact : 0716542586', '2023-06-07 00:00:00', 0, 3),
	(5, 'Acostich', 'chalithachamod3031@gmail.com', 2, '648039d329b19.mp4', '[Intro] <br/>\r\n---------------------------------------------<br/>\r\n| Em | - | Am | - |<br/>\r\n| F#7| - | B7 | - | <br/>\r\n| Em | - | Am | - |<br/>\r\n| F# | - |  B |<br/>\r\n\r\n[Chorus]<br/>\r\n---------------------------------------------<br/>\r\n           Em           Am<br/>\r\nChan chala wee hengum rayak gaane<br/>\r\n     D7             G<br/>\r\nkandulel wenawa mai handa paane<br/>\r\n   Em             Am<br/>\r\nPaaya hinehi yana dedunne\r\n   <br/>D7             G\r\nPiyawi yanawa oya aadare<br/>\r\n    C          Am<br/>\r\nOba a lesatama aaye<br/>\r\nD7           G<br/>\r\nWen wena eka wenawamai<br/>\r\nC      D7      Em<br/>\r\nMayawakmai aadare<br/>\r\nC      B7      Em<br/>\r\nMayawakmai aadare<br/>\r\n\r\n[Inter 1]<br/>\r\n-------------------------------------------<br/>\r\n| Em  C | <br/>\r\n\r\n| Em | Am | G | D7 |<br/>\r\n| Em | Am | G-D-Em |<br/>\r\n| Em | Am | G | D7 |<br/>\r\n| Em | Am | G-D-Em |<br/>\r\n\r\n| Em | - | Am | - |<br/>\r\n| D  | - | G  | - |<br/>\r\n| Em | - | Am | - |<br/>\r\n| D  | - | G  | - |<br/>\r\n| Em | Am| D  | G | <br/>\r\n| C  | D | Em | - |<br/>\r\n| C  | B7| Em | - |<br/>\r\n\r\n[Verse 1]<br/>\r\n---------------------------------------------<br/>\r\n    Em                         Am<br/>\r\nchanchala hegumaka nidi warala thunyame<br/>\r\nD                        G<br/>\r\nkandulata ai andagasanne handa paane<br/>\r\n     Em                       Am<br/>\r\nyasa eli mahane rasa thiyeddi aadare<br/>\r\nD                       G<br/>\r\nDedunna kiyana mayawada luhu bende<br/>\r\n    Em          Am<br/>\r\nOba ki lesatama aaye<br/>\r\nD            G<br/>\r\nhamuwena eka wenawamai<br/>\r\nC      D7      Em<br/>\r\nMayawakmai aadare<br/>\r\nC      B7      Em<br/>\r\nMayawakmai aadare<br/>\r\n\r\n[Verse 2]<br/>\r\n---------------------------------------------<br/>\r\nEm                   Am       D<br/>\r\nMiringuwada hemadama asbandum keruwe<br/>\r\nC             Am       D        Em<br/>\r\nDena denamada hemadema dothinma piduwe<br/>\r\n\r\n| Em | Am | G | D7 | Em |<br/>\r\n\r\nEm                   Am       D<br/>\r\nMiringuwada hemadama asbandum keruwe<br/>\r\nC             Am       B7       Em<br/>\r\nDena denamada hemadema dothinma piduwe<br/>\r\n\r\nEm                        Am<br/>\r\npena seemawan rasabaladdi aadare<br/>\r\n    D                     G<br/>\r\npanayanawamai miriguwa obatath rahase<br/>\r\nEm                        Am<br/>\r\npena seemawan rasabaladdi aadare<br/>\r\n    D                     G<br/>\r\npanayanawamai miriguwa obatath rahase<br/>\r\n    Em         Am<br/>\r\noba kilesatama aaye<br/>\r\nD           G<br/>\r\nduka nam lanwenawamai<br/>\r\nC      D7      Em<br/>\r\nMayawakmai aadare<br/>\r\nC      B7      Em<br/>\r\nMayawakmai aadare<br/>\r\n\r\n[Inter2]<br/>\r\n---------------------------------------------<br/>\r\n| Em | Am | G | D | <br/>\r\n| Em | Am | G | D7|<br/>\r\n| Em |<br/>\r\n\r\n[Verse 3]<br/>\r\n---------------------------------------------<br/>\r\nEm                       Am          D<br/>\r\nSithijaya matha hemadama dehithak ek keruwe<br/>\r\nC            Am          D        Em<br/>\r\nehi paratharayama neda e hith wen keruwe<br/>\r\n\r\n| Em | Am | G | D7 | Em |<br/>\r\n\r\nEm                       Am          D<br/>\r\nSithijaya matha hemadama dehithak ek keruwe<br/>\r\nC            Am          B7       Em<br/>\r\nehi paratharayama neda e hith wen keruwe<br/>\r\nEm                            Am<br/>\r\nDura langa waage suwa labaddi aadare<br/>\r\n    D                    G<br/>\r\nlanwen namai sithijaya eknowana se<br/>\r\nEm                            Am<br/>\r\nDura langa waage suwa labaddi aadare<br/>\r\n    D                    G<br/>\r\nlanwen namai sithijaya eknowana se<br/>\r\n    Em          Am   D          G<br/>\r\noba ki lesatama aaye paluwa lan wenawamai<br/>\r\nC      D7      Em<br/>\r\nMayawakmai aadare<br/>\r\nC      B7      Em<br/>\r\nMayawakmai aadare<br/>', '2023-06-07 00:00:00', 1, 1),
	(6, 'Covid map: Coronavirus cases, deaths, vaccinations by country', 'mahi@gmail.com', 3, '648040dcad584.png', 'The true extent of the first outbreak in 2020 is unclear because testing was not then widely available.\r\n\r\nDeaths are falling in many areas, however official figures may not fully reflect the true number in many countries.\r\n\r\nData on excess deaths, a measure of how many more people are dying than would be expected based on the previous few years, may give a better indication of the actual numbers in many cases.\r\n\r\nUsing this metric, researchers from the Lancet medical journal suggest that more than 18 million people may have died because of Covid up to the end of 2021. That figure is three times higher than officially recorded deaths from the disease.\r\n\r\nSeparate analysis by the World Health Organization (WHO) estimates about 15 million excess deaths due to coronavirus over a similar period.', '2023-06-07 00:00:00', 1, 1),
	(11, '5 takeaways from Appleâ€™s biggest product event in years', 'kawshalya20001025@gmail.com', 2, '64833f42d8c2c.jpeg', 'According to Apple, once a user puts on the device, theyâ€™re able to see apps directly projected in front of them. At the event, Apple showed off a range of unique experiences with the product, including apps for medicine, productivity and entertainment. Disney CEO Bob Iger also joined the Apple event to discuss how Disney will create content for the new Vision Pro headset.\r\n\r\nUnlike other headsets, the new mixed reality headset will display the eyes of its users on the outside, so â€œyouâ€™re never isolated from the people around you, you can see them and they can see you,â€ said Alan Dye, vice president of human interface.\r\n\r\nBut the product faces a number of challenges: Apple is diving into an unproven market littered with other tech companies who have tried and largely failed to find mainstream traction for their devices. Apple is also charging $3,499 for the device â€“ more than had been rumored, and a hefty amount at a time of lingering economic uncertainty.', '2023-06-09 00:00:00', 0, 1),
	(12, 'Italian Combo and Broccoli Rabe Pressed Hero', 'salika@gmail.com', 11, '64836d288964c.jpeg', 'Put the 1/4 cup olive oil and the garlic slices in a large skillet and place over medium heat. When the garlic starts to turn a light golden brown, add the broccoli rabe, 3/4 teaspoon salt and a few grinds of pepper. Stir to coat evenly in the oil. Cover the skillet with a lid and turn the heat down to low. Cook until the broccoli rabe stems are just tender, 6 to 8 minutes. Uncover and turn the heat up to medium-high. Stir in the cherry pepper pickling liquid and cook until the pan is dry, an additional 3 to 4 minutes. Transfer to a bowl and let cool completely.', '2023-06-10 20:00:00', 0, 1),
	(13, 'cod mobile (AZ  BOT)', 'mahi@gmail.com', 7, '649b1befc1bb7.png', 'Worlds Collide in Call of Duty®: Mobile Season 4 — Veiled Uprising\r\nIntroducing Call of Duty®: Mobile Season 3 — RUSH\r\nIntroducing Call of Duty®: Mobile Season 2 — Heavy Metal\r\nIntroducing Call of Duty®: Mobile Season 1 – Reawakening', '2023-06-27 22:57:11', 0, 1),
	(15, 'Black Barbie dolls to get your children after watching Barbie 2023', 'chalithachamod3031@gmail.com', 10, '64dc7ce11d11b.jpg', 'Black Barbie — Greta Gerwig and Margot Robbie have accomplished the impossible by bringing the world’s most beloved doll, Barbie, to life in the film. The teasers and trailers', '2023-08-16 13:08:09', 0, 2),
	(16, 'ftft', 'prasannasampath064@gmail.com', 1, '64ead15018a13.jpeg', 'djusdftujdgyfjuydtujdgtjud', '2023-08-27 10:00:08', 0, 3),
	(17, 'fdhgs', 'prasannasampath064@gmail.com', 2, '64ead459ae30f.jpeg', 'hgffhfg', '2023-08-27 10:13:05', 0, 3),
	(18, 'what is a ponzi scheme', 'prasannasampath064@gmail.com', 2, '64ead55a6da98.jpeg', 'a ponzi scheme is a ', '2023-08-27 10:17:22', 0, 3),
	(19, 'jh sduhgasgh da abjhjhjhjhjhjhjhjhjhjhjhjhbdkja sdguaj ksjk adika,lj', 'prasannasampath064@gmail.com', 3, '64ead684408aa.jpeg', 'adsayutgtd ta ahuda kjashdaiuhda jhadga sjkdattiushd alijuda dfoakaj sduiajdgajkksjdgaud a ajsudga  ausdjha jaksb da kjas da  lakijsd a                                   aoisd aaaaaaaaaaadoi  p;p;p;p;p;p;p;p;p;p;p;p;p;p;p;p;p;p; aiiuiuiuiuiuiuiuiuiuiuiuiuiua dhhhhhhhhhaoissssssssssss     iodhhhhhhhhhhhhhhhhhhha               osiaaaaaaaaaaaaaaaaadh aaaaaaaaaaaaaaaaaaaodhakjsmdhieuw                      aoooooooojkmhduia                   hdjas,mdhiue            djkaaaad aiuhd ewewewewewewewewewewewd adahuahhhhhhhhhhhhhhhoi dap9ud akjdhaoiewdh        aiodh aoidhaaaaaaaaaaaaad audaedfafsafsaf', '2023-08-27 10:22:20', 0, 3),
	(20, 'සඳ මත ජනාවාස පිහිටුවන”Artemis” මෙහෙයුම', 'prasannasampath064@gmail.com', 6, '64ead7c357f40.jpeg', 'නාසා ආයතනය මෙහෙයවන “Artemis (ආටෙමිස්)” වැඩසටහන, අභ්‍යවකාශ ගවේෂණයේ නව පරිච්ඡේදයක් ඇරඹීමට බලාපොරොත්තුවෙන් පසුවන ව්‍යාපෘතියක්. චන්ද්‍රයා ඉලක්ක කර ගනිමින් මීට වසර 50 කට පමණ පෙර ඇරඹූ “ඇපලෝ” වැඩසටහනටත් වඩා දැවැන්ත සහ සංකීර්ණ ක්‍රියාදාමයක් ලෙස “ආටෙමිස්” ව්‍යාපෘතිය ක්‍රියාත්මක වේවි', '2023-08-27 10:27:39', 0, 3),
	(21, 'සඳ මත ජනාවාස පිහිටුවන”Artemis” මෙහෙයුම', 'prasannasampath064@gmail.com', 6, '64eadc3927ca9.jpeg', 'නාසා ආයතනය මෙහෙයවන “Artemis (ආටෙමිස්)” වැඩසටහන, අභ්‍යවකාශ ගවේෂණයේ නව පරිච්ඡේදයක් ඇරඹීමට බලාපොරොත්තුවෙන් පසුවන ව්‍යාපෘතියක්. චන්ද්‍රයා ඉලක්ක කර ගනිමින් මීට වසර 50 කට පමණ පෙර ඇරඹූ “ඇපලෝ” වැඩසටහනටත් වඩා දැවැන්ත සහ සංකීර්ණ ක්‍රියාදාමයක් ලෙස “ආටෙමිස්” ව්‍යාපෘතිය ක්‍රියාත්මක වේවි..\r\nඑබැවින්, නාසා ආයතනයට අමතර ව යුරෝපා අභ්‍යවකාශ ඒජන්සිය. කැනේඩියානු අභ්‍යවකාශ ඒජන්සිය, ජපාන අභ්‍යවකාශ ගවේෂණ ඒජන්සිය සහ තවත් සමාගම් කිහිපයක් “ආටෙමිස්” වැඩසටහන සමඟ සහයෝගී ව කටයුතු කරමින් සිටිනවා.\r\n\r\nඇපලෝ චන්ද්‍ර මෙහෙයුම් සමඟ සැසඳීමේ දී “Artemis” වැඩසටහන විශේෂ වන කරුණු බොහෝමයක් තිබෙනවා', '2023-08-27 10:46:41', 0, 1),
	(22, 'වර්ජින් ගැලැක්ටික් හි පළමු අභ්‍යවකාශ සංචාරක ගුවන් ගමන සාර්ථකයි.', 'prasannasampath064@gmail.com', 6, '64eade8923179.jpeg', 'Virgin Galactic යනු Richard Branson සහ Virgin Group සමූහය විසින් ආරම්භ කරන ලද ඇමරිකානු අභ්‍යවකාශ පියාසර සමාගමකි. එය අභ්‍යවකාශ සංචාරකයින්ට උප කක්ෂීය අභ්‍යවකාශ පියාසැරියක සංචාරය සඳහා වාණිජ අභ්‍යවකාශ යානා සංවර්ධනය කිරීම අරමුණු කරගත් වානිජ ව්‍යාපාරයකි.\r\n\r\nමෙසේ සිවිල් පාරිභෝගිකයන් අභ්‍යවකාශයට රැගෙන යාමේ වර්ජින් ගැලැක්ටික් හි පළමු මෙහෙයුම වන Galactic-02 ඊයේ දින එනම්, 2023 අගෝස්තු 10 වන දින නිව් මෙක්සිකෝවෙන් දියත් කර ඇත.\r\n\r\nVirgin Galactic සිය පළමු අභ්‍යවකාශ සංචාරක සැරිය සඳහා සංචාරකයින් වූයේ අසූ හැවිරිදි හිටපු ඔලිම්පික් ක්‍රීඩකයෙකු වන Jon Goodwin, 46 හැවිරිදි ශරීර සුවතා පුහුණුව උපදේශකවරියක වන Keisha Schahaff සහ ඇගේ දියණිය,18 හැවිරිදි විශ්ව විද්‍යාල සිසුවියක වනAnastia Mayers යන තිදෙනායි.  ඔවුන් සමඟ ගගනගාමී උපදේශක බෙත් මෝසස් සමඟ ගුවන් නියමුවන් වන සීජේ ස්ටර්කෝ සහ කෙලී ලැටිමර් ද එක්ව ඇත. ඔවුන් ගමන් ගත්තේ Virgin  Galactic හි VSS Unity අභ්‍යවකාශ යානයේයි.\r\n\r\nVirgin Galactic හි දියත් කිරීමේ පද්ධතිය කොටස් දෙකකින් සමන්විත වේ. VMS Eve නම් විශාල ගුවන් යානයක් සහ VSS Unity  කුඩා අභ්‍යවකාශ යානයක් ඊට අයත් ය. දියත් කිරීම නිව් මෙක්සිකෝවේ Spaceport America හිදී සිදුවූ අතර, එක්සත් රාජධානියේ වේලාවෙන් ඊයේ සවස 4ට ගුවන්ගත වීමේ කවුළුව විවෘත වී ඇත.\r\n\r\nඅභ්‍යවකාශ ගමනේ දී ගුවන් යානය ධාවන පථයෙන් ඉවතට ගොස් මුදා හැරීමේ උන්නතාංශයට පැමිණි පසු, අභ්‍යවකාශ යානය මුදා හරිනු ලබන අතර, එහි ප්‍රබල රොකට් එන්ජිම භාවිතා කර පෘථිවියට සැතපුම් 50 ක් පමණ ඉහළට ගමන් කිරීමට නියමිතය. සම්පූර්ණ පියාසැරිය විනාඩි 90 ක් පමණ ගතවනු ඇත.\r\n\r\nමීට පෙර Virgin Galactic ගගනගාමීන් හය දෙනෙකුගෙන් යුත් කාර්ය මණ්ඩලයක් සමඟ පසුගිය  ජුනි 29 වන දින අභ්‍යවකාශයට ගමන් කරමින් සිය පුහුණු ගුවන් ගමන දියත් කළේය. Galactic 01 නම් වූ මෙම මෙහෙයුම අභ්‍යවකාශ සංචාරකයින් රැගෙන නොගිය අතර ඒ සඳහා ඉතාලි ගුවන් හමුදාවේ සාමාජිකයින් දෙදෙනෙකු සහ පර්යේෂණ ඉංජිනේරුවෙකු විය.ඔවුන් තිදෙනා ජීවමිතික දත්ත, සංජානන දත්ත සහ ජෛව වෛද්‍ය විද්‍යාත්මකව අදාළ ඇතැම් ද්‍රව සහ ඝන ද්‍රව්‍ය මිශ්‍ර වන ආකාරය ඇතුළු ක්ෂුද්‍ර ගුරුත්වාකර්ෂණය පිළිබඳ විද්‍යාත්මක තොරතුරු රැස් කිරීමට මේ ගුවන් ගමන භාවිතා කළ බවයි පැවසෙන්නේ.  ඔවුන් සමඟ Virgin Galactic හි ගුවන් නියමුවන් දෙදෙනෙකු සහ ගුවන් ඉංජිනේරුවෙකු එක්ව සිටියහ.\r\n\r\nRichard Branson ගේ අභ්‍යවකාශ සමාගම  Elon Musk ගේ SpaceX සහ Jeff Bezos ගේ Blue Origin සමඟ කුඩා සමාගම් සමූහයකට සම්බන්ධ වී ඇති අතර එමඟින් ගනුදෙනුකරුවන් මුදල් ගෙවා අභ්‍යවකාශයට රැගෙන යා හැකිය.\r\n\r\nමෙතැන් පටන් ඉදිරියට අභ්‍යාවකාශ සංචාරකයන් සඳහා  $250,000 (£191,000) සහ $450,000 (£344,000) අතර මිල ගණන් දරණ ආසන සහිත මාසික පුද්ගලික ගුවන් ගමන් සිදු කිරීමට Virgin Galactic අපේක්ෂා කරයි.\r\n\r\nමීළඟ ගුවන් යානයේ සිටින අය කවුරුන්ද යන්න සමාගම තවමත් හෙළි කර නැතත්, උනන්දුවක් දක්වන පාර්ශ්වයන්ට "Virgin Galactic අත්දැකීම" සහ අනාගත චාරිකා සඳහා ප්‍රවේශපත්‍ර තිබේ නම් වැඩිදුර දැන ගැනීමට විද්‍යුත් තැපැල් දැනුම්දීම් සඳහා ඔවුන්ගේ වෙබ් අඩවිය හරහා ලියාපදිංචි විය හැක.', '2023-08-27 10:56:33', 0, 1),
	(23, 'gg', 'prasannasampath064@gmail.com', 6, '64eadedb6607a.jpeg', 'Virgin Galactic යනු Richard Branson සහ Virgin Group සමූහය විසින් ආරම්භ කරන ලද ඇමරිකානු අභ්‍යවකාශ පියාසර සමාගමකි. එය අභ්‍යවකාශ සංචාරකයින්ට උප කක්ෂීය අභ්‍යවකාශ පියාසැරියක සංචාරය සඳහා වාණිජ අභ්‍යවකාශ යානා සංවර්ධනය කිරීම අරමුණු කරගත් වානිජ ව්‍යාපාරයකි.\r\n\r\nමෙසේ සිවිල් පාරිභෝගිකයන් අභ්‍යවකාශයට රැගෙන යාමේ වර්ජින් ගැලැක්ටික් හි පළමු මෙහෙයුම වන Galactic-02 ඊයේ දින එනම්, 2023 අගෝස්තු 10 වන දින නිව් මෙක්සිකෝවෙන් දියත් කර ඇත.\r\n\r\n\r\n\r\nVirgin Galactic සිය පළමු අභ්‍යවකාශ සංචාරක සැරිය සඳහා සංචාරකයින් වූයේ අසූ හැවිරිදි හිටපු ඔලිම්පික් ක්‍රීඩකයෙකු වන Jon Goodwin, 46 හැවිරිදි ශරීර සුවතා පුහුණුව උපදේශකවරියක වන Keisha Schahaff සහ ඇගේ දියණිය,18 හැවිරිදි විශ්ව විද්‍යාල සිසුවියක වනAnastia Mayers යන තිදෙනායි.  ඔවුන් සමඟ ගගනගාමී උපදේශක බෙත් මෝසස් සමඟ ගුවන් නියමුවන් වන සීජේ ස්ටර්කෝ සහ කෙලී ලැටිමර් ද එක්ව ඇත. ඔවුන් ගමන් ගත්තේ Virgin  Galactic හි VSS Unity අභ්‍යවකාශ යානයේයි.\r\n\r\n\r\nVirgin Galactic හි දියත් කිරීමේ පද්ධතිය කොටස් දෙකකින් සමන්විත වේ. VMS Eve නම් විශාල ගුවන් යානයක් සහ VSS Unity  කුඩා අභ්‍යවකාශ යානයක් ඊට අයත් ය. දියත් කිරීම නිව් මෙක්සිකෝවේ Spaceport America හිදී සිදුවූ අතර, එක්සත් රාජධානියේ වේලාවෙන් ඊයේ සවස 4ට ගුවන්ගත වීමේ කවුළුව විවෘත වී ඇත.\r\n\r\n\r\nඅභ්‍යවකාශ ගමනේ දී ගුවන් යානය ධාවන පථයෙන් ඉවතට ගොස් මුදා හැරීමේ උන්නතාංශයට පැමිණි පසු, අභ්‍යවකාශ යානය මුදා හරිනු ලබන අතර, එහි ප්‍රබල රොකට් එන්ජිම භාවිතා කර පෘථිවියට සැතපුම් 50 ක් පමණ ඉහළට ගමන් කිරීමට නියමිතය. සම්පූර්ණ පියාසැරිය විනාඩි 90 ක් පමණ ගතවනු ඇත.\r\n\r\n\r\nමීට පෙර Virgin Galactic ගගනගාමීන් හය දෙනෙකුගෙන් යුත් කාර්ය මණ්ඩලයක් සමඟ පසුගිය  ජුනි 29 වන දින අභ්‍යවකාශයට ගමන් කරමින් සිය පුහුණු ගුවන් ගමන දියත් කළේය. Galactic 01 නම් වූ මෙම මෙහෙයුම අභ්‍යවකාශ සංචාරකයින් රැගෙන නොගිය අතර ඒ සඳහා ඉතාලි ගුවන් හමුදාවේ සාමාජිකයින් දෙදෙනෙකු සහ පර්යේෂණ ඉංජිනේරුවෙකු විය.ඔවුන් තිදෙනා ජීවමිතික දත්ත, සංජානන දත්ත සහ ජෛව වෛද්‍ය විද්‍යාත්මකව අදාළ ඇතැම් ද්‍රව සහ ඝන ද්‍රව්‍ය මිශ්‍ර වන ආකාරය ඇතුළු ක්ෂුද්‍ර ගුරුත්වාකර්ෂණය පිළිබඳ විද්‍යාත්මක තොරතුරු රැස් කිරීමට මේ ගුවන් ගමන භාවිතා කළ බවයි පැවසෙන්නේ.  ඔවුන් සමඟ Virgin Galactic හි ගුවන් නියමුවන් දෙදෙනෙකු සහ ගුවන් ඉංජිනේරුවෙකු එක්ව සිටියහ.\r\n\r\n\r\n\r\nRichard Branson ගේ අභ්‍යවකාශ සමාගම  Elon Musk ගේ SpaceX සහ Jeff Bezos ගේ Blue Origin සමඟ කුඩා සමාගම් සමූහයකට සම්බන්ධ වී ඇති අතර එමඟින් ගනුදෙනුකරුවන් මුදල් ගෙවා අභ්‍යවකාශයට රැගෙන යා හැකිය.\r\n\r\n\r\nමෙතැන් පටන් ඉදිරියට අභ්‍යාවකාශ සංචාරකයන් සඳහා  $250,000 (£191,000) සහ $450,000 (£344,000) අතර මිල ගණන් දරණ ආසන සහිත මාසික පුද්ගලික ගුවන් ගමන් සිදු කිරීමට Virgin Galactic අපේක්ෂා කරයි.\r\n\r\n\r\nමීළඟ ගුවන් යානයේ සිටින අය කවුරුන්ද යන්න සමාගම තවමත් හෙළි කර නැතත්, උනන්දුවක් දක්වන පාර්ශ්වයන්ට "Virgin Galactic අත්දැකීම" සහ අනාගත චාරිකා සඳහා ප්‍රවේශපත්‍ර තිබේ නම් වැඩිදුර දැන ගැනීමට විද්‍යුත් තැපැල් දැනුම්දීම් සඳහා ඔවුන්ගේ වෙබ් අඩවිය හරහා ලියාපදිංචි විය හැක.', '2023-08-27 10:57:55', 0, 1),
	(24, 'වියලි කාලගුණය රෝග රැසකට හේතුයි.පරිස්සම් වෙන්න', 'prasannasampath064@gmail.com', 1, '64ec167075cfa.jpeg', 'පවතින වියලි කාලගුණික තත්ත්වය හමුවේ විවිධ රෝගා බාධ පැතිර යා හැකි බව ශ්‍රි ලංකා මහජන සෞඛ්‍ය පරීක්ෂක සංගමයේ සභාපති උපුල් රෝහණ මහතා සදහන් කරයි.                                                                                                                                                                                 \r\n                                                               අපිරිසිදු ජලය පානය කිරීමෙන් පාචනය රෝගය වැළදිය හැකි බවත්,අනවශ්‍ය ආකාරයට හිරු එළියට නිරාවරණය වීම හේතුවෙන් සමේ රෝග ඇති වීමට ඉඩ ඇති බවද ඒ මහතා පැවසීය.එමෙන්ම සිදී යමින් ඇති වැව් වල මසුන් මැරීමට යාමෙන් මී උණ වැනි රෝග  වැළදීමට ඉඩ ඇති බවද උපුල් රෝහණ මහතා පැවසීය.', '2023-08-28 09:07:20', 0, 1),
	(25, 'දුරස්ථ පාලක කාර් රථ සහ ප්‍රවාහනයේ අනාගතය​', 'prasannasampath064@gmail.com', 2, '64ec1852643fa.jpeg', 'GTA වැනි පරිගණක ක්‍රීඩා වල නිරත වන විට ඔබට කවදා හෝ පරිගණකයක් ඉදිරිපිට සිට සැබෑම වාහනයක් ධාවනය කිරීමේ සිතුවිල්ල ඇතිවී තිබුණා ද​? පුද්ගලිකව මා එලෙස බොහෝ වර සිතා ඇති අතර ජර්මානු ආයතනයක් විසින් මේ වන විට එකී සිතුවිල්ල​ යථාර්තයක් කර ඇත​.​                              ඔබට බැලූ බැල්මට පෙනෙන්නට තිබෙන්නේ මෙම මෝටර් රථය Auto Pilot Mode නැතිනම් තනිවම ගමන් කරන බවයි. නමුත් මේ පිටුපස ඇති තාක්‍ෂණය නම් බර්ලින්හි කාර්‍යාලයක සිට මෙම රිය දුරස්ථව (Remotely) හසුරුවන එක්තරා රියදුරන් කණ්ඩායමක් සිටීමයි. නගරය තුළ රිය ධාවනයට හෝ පාසලෙන් ඔබගේ දරුවා රැගෙන ඒමට නැතිනම් බිරිඳ හෝ ස්වාමි පුරුෂයා සේවා ස්ථානය වෙත හැරලවීමට ඔබටම​ යොමු වීමේ අවශ්‍යතාවයක් ඉදිරි වැඩිදියුණු කිරීම් වලදී ඇති නොවනු ඇත​. ඔබට අවශ්‍ය විටෙක ඇණවුම් කිරීමටත්, මාර්ගගතව රිය හැසිරවීමටත් අවස්ථාව මෙම ක්‍රමවේදය හරහා ලබාගත හැකි බව​ බව VAY ආයතනයේ අදහසයි', '2023-08-28 09:15:22', 0, 1),
	(26, 'භාවිතා නොකරන ගිණුම් ගැන බලන්නේ වසර දෙකයි', 'prasannasampath064@gmail.com', 2, '64ec18f1de938.jpeg', 'වසර දෙකක කාලයක් තුළ පුරනය වී හෝ භාවිතා කර නොමැති ඕනෑම Google ගිණුමක් අක්‍රිය වූවා සේ සළකා එම ගිණුම් හා එහි ඇති ඕනෑම අන්තර්ගතයක් 2023 දෙසැම්බර් 1 සිට සිය ජාලයෙන් ඉවත් කිරීමට Google සමාගම විසින් තීරණය කොට තිබේ', '2023-08-28 09:18:01', 0, 1),
	(27, 'Twitter වෙත කුරුල්ලා ලාංඡනය වෙනුව‍ෙ X ලාංඡනය කරලියට', 'prasannasampath064@gmail.com', 3, '64ec201c55b94.jpeg', 'ලෝකප්‍රසිද්ධ ට්විටර් ලාංඡනය වෙනස් කිරීමේ සූදානමක්පවතින බවට ට්විටර් සමාගමේ වත්මන් හිමිකරු ඊලොන් මස්ක් නිවේදනය කොට ඇතැයි විදෙස්මාධ්‍ය වාර්ථා කර සිටියි..\r\n\r\nමෙතෙක් ට්වීටර් ලාංඡනය වශයෙන් පැවති කුරුල්ලා වෙනුවට  X අකුර සහිත ලාංඡනයක් ඇතුළත් කෙටි වීඩියෝවක් මස්ක් සිය ට්විටර් අවකාශයේ පළකර තිබීම හේතුවෙන් මීලඟ ට්වීටර් ලාංචනය X වනු ඇති බවටද කියවෙයි.', '2023-08-28 09:48:36', 0, 3),
	(28, 'Twitter වෙත කුරුල්ලා ලාංඡනය වෙනුව‍ෙ X ලාංඡනය කරලියට', 'prasannasampath064@gmail.com', 2, '64ec204bb2494.jpeg', 'ලෝකප්‍රසිද්ධ ට්විටර් ලාංඡනය වෙනස් කිරීමේ සූදානමක්පවතින බවට ට්විටර් සමාගමේ වත්මන් හිමිකරු ඊලොන් මස්ක් නිවේදනය කොට ඇතැයි විදෙස්මාධ්‍ය වාර්ථා කර සිටියි..\r\n\r\nමෙතෙක් ට්වීටර් ලාංඡනය වශයෙන් පැවති කුරුල්ලා වෙනුවට  X අකුර සහිත ලාංඡනයක් ඇතුළත් කෙටි වීඩියෝවක් මස්ක් සිය ට්විටර් අවකාශයේ පළකර තිබීම හේතුවෙන් මීලඟ ට්වීටර් ලාංචනය X වනු ඇති බවටද කියවෙයි.', '2023-08-28 09:49:23', 0, 1),
	(29, 'AI නිසා නළු නිළියන් වර්ජනයේ', 'prasannasampath064@gmail.com', 2, '64ec20f4abaf7.png', 'ඇමරිකා එක්සත් ජනපදයේ ක්‍රියාත්මක වන විනෝදාස්වාද කර්මාන්තයට (entertainment industry) සම්බන්ද ශ්‍රමිකයන් 160,000 පමණ නියෝජනය කරන වෘත්තීය සංගමයක් වන Screen Actors Guild - American Federation of Television and Radio Artists (SAG-AFTRA) 2023 ජුලි 14 වන දින වැඩ වර්ජනයකට අවතීර්ණ වීමට තීරණය කර තිබෙනවා. මෙවැනි වර්ජනයක් සිදුවන්නේ වසර 60කට පමණ පසුව ප්‍රථම වරට බවයි විදෙස් මාධ්‍ය වාර්තා කරන්නේ. ආදායම් අඩුවීම්, උද්ධමනය වැනි ගැටළු නිසා මෙම වෘත්තිකයින් අර්බුද රැසකට මුහුණදී ඇති බවත්, එවන් පසුබිමක කෘතීම බුද්ධි (AI) තාක්ෂණයේ දියුණුවත් සමග ඔවුන්ගේ ජීවිකාවන් බරපතල ලෙස තර්ජනයට ලක්ව ඇති බවත් මෙම සංගමය පවසනවා. මෙම ගැටළු වලට විසදුම් ලෙස යෝජනා කිහිපයක් ඉදිරිපත් කර ඇති අතර මේ සම්බන්දව විසදුමක් ලබාගැනීමේ අරමුණින් Alliance of Motion Picture and Television Producers (AMPTP) සමග සාකච්චා වට කිහිපයක් පැවැත්වුවද ඒ හරහා සුබවාදී ප්‍රතිපලයක් නොලැබුන නිසා මෙවැනි වර්ජනයකට යොමු වූ බව SAG-AFTRA පවසනවා.', '2023-08-28 09:52:12', 0, 1),
	(30, '"අමු"වට වඩා "වියළි" එවා හොඳ ඇයි..??', 'prasannasampath064@gmail.com', 3, '64ec3beec40f9.jpeg', 'පළතුරු ගැන අමුතු කතාවක්\r\nඔබ එදිනෙදා ජීවිතයේදී පළතුරු අනුභවයට දක්වන රුචිකත්වය විවිධ විය හැක. ඒවා අමුවෙන්, ගෙඩි පිටින් හෝ කැබළි වශයෙන් කොතෙක් ඔබ අනුභව කර තිබුනත් කිසිදු විටෙක "වියලි පලතුරු" අනුභවය ගැන ඔබ කල්පනා කර තිබේද?  සමාන්‍යයෙන්  වියළි පලතුරු යනු විටමින් සහ පෝෂ්‍ය පදාර්ථ වලින් පිරුණු රසවත් කට ගැස්මක් පමණක්ම නොවේ. ඒවා ඇත්ත වශයෙන්ම ඔබට ඔබේ ඇතැම් සුළු සුළු සෞඛ්‍ය ගැටළු සඳහා උපකාර විය හැකි ඖෂධයක් සේම හොඳ විකල්පයක්ද විය හැකි බව ඔබ දැන සිටියාද?. මේ ලිපිය අවසන් වනතෙක් කියවන්න. ඔබට ඇති සෞඛ්‍ය ප්‍රශ්න සඳහා වඩාත් ප්‍රයෝජනවත් වන්නේ කුමන වියළි පලතුරුදැයි සොයා ගැනීමට එය ඔබට උපකාරී වේවි. මේ ලිපිය මගින් එවනි වියළි පළතුරු 10ක් ගැන ඔබට හඳුන්වා දෙන්නට සූදානම්.', '2023-08-28 09:58:16', 0, 1),
	(31, 'කෘෂි කර්මාන්තයේ විප්ලවීය වෙනසක් අවශ්‍යයි!', 'prasannasampath064@gmail.com', 4, '64ec3beec40f9.jpeg', 'මෙරට කෘෂි කර්මාන්තයේ විප්ලවීය වෙනාක් ඇති කිරීමේ සැලසුම් කඩිනමින් ක්‍රියාත්මක කළ යුතුවන බව ජනාධිපති රනිල් වික්‍රමසිංහ මහතා අවධාරණය කරයි.\r\n\r\nජනාධිපතිවරයා මේ බව සඳහන් කළේ “කෘෂිකාර්මික අංශය නවීකරණය කිරීම” පිළිබඳ ජනාධිපති කාර්යාලයේ පැවති සාකච්ඡාවේදීය.\r\n\r\nජනාධිපතිවරයා කෘෂිකර්මයට සම්බන්ධ ගැටලු කාර්යක්ෂමව විසඳා ගැනීම වෙනුවෙන් කාර්ය සාධක බලකායක් ස්ථාපිත කරන බව එහිදී සඳහන් කරන අතර කෘෂිකර්ම, වැවිලි, වාරිමාර්ග සහ මහවැලි සංවර්ධන යන අමාත්‍යාංශ ඒකාබද්ධ කර පෞද්ගලික අංශය ද නියෝජනය වන පරිදි මෙම කාර්ය සාධක බලකාය ස්ථාපිත කිරීමටයි යෝජනා වී ඇත්තේ.', '2023-08-28 11:47:18', 0, 1),
	(32, '2022 ලොව හොඳම කෑම', 'prasannasampath064@gmail.com', 4, '64ec3c92afcd9.jpeg', 'Tasteatlas web අඩවියේ සමීක්ෂණයකට අනුව ලෝකයේ රසම කෑ ම තියෙන්නේ යාලුවනේ ඉතාලියේ -https://www.tasteatlas.com/best/cuisines', '2023-08-28 11:50:02', 0, 3),
	(33, '2022 ලොව හොඳම කෑම', 'prasannasampath064@gmail.com', 11, '64ec3ff535a30.jpeg', 'Tasteatlas web අඩවියේ සමීක්ෂණයකට අනුව ලෝකයේ රසම කෑ ම තියෙන්නේ යාලුවනේ ඉතාලියේ 😋😋😋😋😋😋\r\nhttps://www.tasteatlas.com/best/cuisines', '2023-08-28 12:04:29', 0, 1),
	(34, 'Fiber optic cable (noun, “FY-ber OPP-tik CAY-bel”)', 'chalithachamod3031@gmail.com', 6, '64ecbe0373ad0.jpeg', '<font color="#c52020">Fiber optic cables carry data as pulses of light</font><span style="color: rgb(49, 49, 59);">. Those pulses can travel thousands of kilometers (miles) extremely quickly. As a result, fiber optic cables are often used for high-speed communications. That includes phone calls, TV and internet access.</span></p><p style="margin-top: var(--block-vertical-rhythm); border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: NotoSans, helvetica, arial, sans-serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; margin-inline-end: var(--block-margin-inline-end, var(--block-margin-inline, auto)); margin-inline-start: var(--block-margin-inline-start, var(--block-margin-inline, auto)); margin-block-end: var(--block-vertical-rhythm-bottom, var(--block-vertical-rhythm)); margin-block-start: var(--block-vertical-rhythm-top, var(--block-vertical-rhythm)); max-width: var(--block-max-width); color: rgb(49, 49, 59); background-color: rgb(255, 255, 255);">Each fiber optic cable contains many hair-thin strands, or fibers, of a transparent material. That material is usually glass. But sometimes it’s plastic. A single cable may contain only a few fibers. Or it may contain hundreds.</p><p style="margin-top: var(--block-vertical-rhythm); border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: NotoSans, helvetica, arial, sans-serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; margin-inline-end: var(--block-margin-inline-end, var(--block-margin-inline, auto)); margin-inline-start: var(--block-margin-inline-start, var(--block-margin-inline, auto)); margin-block-end: var(--block-vertical-rhythm-bottom, var(--block-vertical-rhythm)); margin-block-start: var(--block-vertical-rhythm-top, var(--block-vertical-rhythm)); max-width: var(--block-max-width); color: rgb(49, 49, 59); background-color: rgb(255, 255, 255);">A laser can send pulses of light into the glass or plastic fiber at one end of a cable. The pattern of those light pulses encodes data. Say, the sound of someone’s voice on a phone call or the visuals of a TV show. Those light pulses zip along the fiber optic cable to their destination. There, a receiver decodes the pattern of light into digital data. A device, such as a phone or computer, can then process that information so that we can see or hear it.&nbsp;&nbsp;</p><p style="margin-top: var(--block-vertical-rhythm); border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: NotoSans, helvetica, arial, sans-serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; margin-inline-end: var(--block-margin-inline-end, var(--block-margin-inline, auto)); margin-inline-start: var(--block-margin-inline-start, var(--block-margin-inline, auto)); margin-block-end: var(--block-vertical-rhythm-bottom, var(--block-vertical-rhythm)); margin-block-start: var(--block-vertical-rhythm-top, var(--block-vertical-rhythm)); max-width: var(--block-max-width); color: rgb(49, 49, 59); background-color: rgb(255, 255, 255);"><br></p><p style="border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: NotoSans, helvetica, arial, sans-serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; margin-inline-end: var(--block-margin-inline-end, var(--block-margin-inline, auto)); margin-inline-start: var(--block-margin-inline-start, var(--block-margin-inline, auto)); margin-block-end: var(--block-vertical-rhythm-bottom, var(--block-vertical-rhythm)); margin-block-start: var(--block-vertical-rhythm-top, var(--block-vertical-rhythm)); max-width: var(--block-max-width); color: rgb(49, 49, 59); background-color: rgb(255, 255, 255);"><b>Fiber optic cables </b>were first used to carry phone calls in the <b>1970s</b>. Now, these cables bring high-speed internet to much of the world. Around the globe, cables are buried underground, hang from poles and snake across the seafloor. Together, they span some 4 billion kilometers (2.5 billion miles) of cable. That’s father than the distance from Earth to Uranus.</p><p style="border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: NotoSans, helvetica, arial, sans-serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; margin-inline-end: var(--block-margin-inline-end, var(--block-margin-inline, auto)); margin-inline-start: var(--block-margin-inline-start, var(--block-margin-inline, auto)); margin-block-end: var(--block-vertical-rhythm-bottom, var(--block-vertical-rhythm)); margin-block-start: var(--block-vertical-rhythm-top, var(--block-vertical-rhythm)); max-width: var(--block-max-width); color: rgb(49, 49, 59); background-color: rgb(255, 255, 255);"><br></p><p style="margin-top: var(--block-vertical-rhythm); border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: NotoSans, helvetica, arial, sans-serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; margin-inline-end: var(--block-margin-inline-end, var(--block-margin-inline, auto)); margin-inline-start: var(--block-margin-inline-start, var(--block-margin-inline, auto)); margin-block-end: var(--block-vertical-rhythm-bottom, var(--block-vertical-rhythm)); margin-block-start: var(--block-vertical-rhythm-top, var(--block-vertical-rhythm)); max-width: var(--block-max-width); color: rgb(49, 49, 59); background-color: rgb(255, 255, 255);"><ol><li>But fiber optic cables aren’t only used for communications. Some seismologists use them to listen for earthquakes on the seafloor. (Earth’s rumblings can mess with the light signals sent through a fiber, allowing researchers to detect seismic activity.) Likewise, fiber optic cables can be used as sensors to monitor structures such as bridges or railways. These fibers are even used to provide precise lighting for medical instruments such as endoscopes.</li></ol>', '2023-08-28 21:02:19', 1, 3),
	(35, 'How artificial intelligence could help us talk to animals', 'chalithachamod3031@gmail.com', 8, '64ecbfc6bfffc.jpeg', '<span style="font-family: NotoSans, helvetica, arial, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);"><font color="#e51f1f"><b>A sperm whale surfaces</b></font></span><span style="color: rgb(49, 49, 59); font-family: NotoSans, helvetica, arial, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);">, exhaling a cloud of misty air. Its calf comes in close to drink milk. When the baby has had its fill, mom flicks her tail. Then, together the pair dive down deep. Gašper Beguš watches from a boat nearby. “You get this sense of how vast and different their world is when they dive,” he says. “But in some ways, they are so similar to us.”</span>', '2023-08-28 21:09:50', 0, 1),
	(36, 'Gmail offline lets you read, reply, delete, and search your Gmail messages when you’re not connected to the internet.', 'chalithachamod3031@gmail.com', 10, '64ef142c45c78.jpeg', '<span style="color: rgb(95, 99, 104); font-family: &quot;Google Sans&quot;, Roboto, Arial, sans-serif; font-size: 18px; background-color: rgb(248, 249, 250);"><b>Gmail offline lets you read</b>, reply, delete, and search your Gmail messages when you’re not connected to the </span><span style="font-family: &quot;Google Sans&quot;, Roboto, Arial, sans-serif; font-size: 18px; background-color: rgb(248, 249, 250);"><font color="#f01414">internet</font></span><span style="color: rgb(95, 99, 104); font-family: &quot;Google Sans&quot;, Roboto, Arial, sans-serif; font-size: 18px; background-color: rgb(248, 249, 250);">.</span>', '2023-08-30 15:34:28', 0, 1),
	(37, 'asdfdf', 'chalithachamod3031@gmail.com', 8, '64ef5ad695c81.jpeg', '<span style="font-size: 16px; text-align: justify; background-color: rgb(255, 255, 255);"><b>ලෝකප්‍රසිද්ධ </b>ට්විටර් ලාංඡනය වෙනස් කිරීමේ සූදානමක්පවතින බවට ට්විටර් සමාගමේ වත්මන් හිමිකරු ඊලොන් මස්ක් නිවේදනය කොට ඇතැයි විදෙස්මාධ්‍ය වාර්ථා කර සිටියි.. මෙතෙක් ට්වීටර් ලාංඡනය වශයෙන් පැවති කුරුල්ලා වෙනුවට X අකුර සහිත ලාංඡනයක් ඇතුළත් කෙටි වීඩියෝවක් මස්ක් සිය ට්විටර් අවකාශයේ පළකර තිබීම හේතුවෙන් මීලඟ ට්වීටර් ලාංචනය X වනු ඇති බවටද කියවෙයි.</span>', '2023-08-30 20:35:58', 0, 1),
	(38, 'aluth', 'mahi@gmail.com', 10, '64ef5e115d9d0.jpg', '<div>“මූන් ස්නයිපර්” නම් රොබෝ යානාව ලෑස්තියි..</div><div><br></div><div>මූන් ස්නයිපර්” නම් රොබෝ යානාවක් සඳට යැවීමට ජපන් අභ්‍යවකාශ පර්යේෂණ ආයතනයේ විද්‍යාඥයන් සූදානම් වෙමින් සිටින බව ජපන් මාධ්‍ය විසින් වාර්තා කර තිබේ.</div><div><br></div><div>සඳට යානයක් යැවීමට ජපාන විද්‍යාඥයන් උත්සහ ගන්නේ වසර ගණනක සිට වන අතර පසුගිය 2022 වසරේදී විද්‍යාඥයන් සඳට යානාවක් යැවීමට උත්සාහ කළ නමුත් එය අසාර්ථක විය.</div><div><br></div><div>මීටර් 2.4 ක් උස, මීටර් 2.7 ක් පළල, මීටර් 1.7 ක් දිග කිලෝ ග්‍රෑම් 700 ක් බර රොබෝ යානයක් එලෙස සඳට යැවීමට සූදානම් බව ජපන් අභ්‍යවකාශ පර්යේෂණ ආයතනය සදහන් කරයි.</div><div><br></div><div>මෙම මෙහෙයුමේ අරමුණ වන්නේ සඳේ පස පරීක්ෂා කිරීම වන අතර ජපන් විද්‍යාඥයන් නිර්මාණය කළ කුඩා රෝවර් යානයක් ද “මූන් ස්නයිපර්” රොබෝ යානය තුළ ඇත.</div><div><br></div><div>“මූන් ස්නයිපර්” රොබෝ යානය පෘථිවි ගුරුත්ව බලය යොදා ගනිමින් සඳ බලා යනු ඇති ඒ සඳහා මාස කීපයක් ගත වනු ඇති බවද ජපාන විද්‍යාඥයෝ සදහන් කරයි</div>', '2023-08-30 20:49:45', 1, 1),
	(39, 'sss', 'chalithachamod3031@gmail.com', 10, '64ef975d74a9b.jpeg', 'Gather signals to trace your threat. VirusTotal tools extract suspicious signals such as OLE VBA code streams in Office document macros, invalid cross reference tables in PDFs, packer details in Windows Executables, intrusion detection system alerts triggered in PCAPs, Exif metadata, authenticode signatures and a myriad of other properties. Use these properties as IoCs to hunt down badness in your network.\r\n\r\nMulti-property searches can be performed via advanced modifiers and threat actor campaigns can be fully mapped through pivoting and similarity searching. Lightning-fast binary n-gram searches complement file similarity searches to find other unknown variants of an attack and different malware pertaining to a same threat actor.', '2023-08-31 00:54:13', 0, 1),
	(40, 'd', 'chalithachamod3031@gmail.com', 10, '64ef9788af213.jpeg', '“<b><font color="#cb0606">මූන් ස්නයිපර්</font></b>” නම් රොබෝ යානාව ලෑස්තියි..\r\n\r\nමූන් ස්නයිපර්” නම් රොබෝ යානාවක් සඳට යැවීමට ජපන් අභ්‍යවකාශ පර්යේෂණ ආයතනයේ විද්‍යාඥයන් සූදානම් වෙමින් සිටින බව ජපන් මාධ්‍ය විසින් වාර්තා කර තිබේ.\r\n\r\nසඳට යානයක් යැවීමට ජපාන විද්‍යාඥයන් උත්සහ ගන්නේ වසර ගණනක සිට වන අතර පසුගිය 2022 වසරේදී විද්‍යාඥයන් සඳට යානාවක් යැවීමට උත්සාහ කළ නමුත් එය අසාර්ථක විය.\r\n\r\nමීටර් 2.4 ක් උස, මීටර් 2.7 ක් පළල, මීටර් 1.7 ක් දිග කිලෝ ග්‍රෑම් 700 ක් බර රොබෝ යානයක් එලෙස සඳට යැවීමට සූදානම් බව ජපන් අභ්‍යවකාශ පර්යේෂණ ආයතනය සදහන් කරයි.\r\n\r\nමෙම මෙහෙයුමේ අරමුණ වන්නේ සඳේ පස පරීක්ෂා කිරීම වන අතර ජපන් විද්‍යාඥයන් නිර්මාණය කළ කුඩා රෝවර් යානයක් ද “මූන් ස්නයිපර්” රොබෝ යානය තුළ ඇත.\r\n\r\n“මූන් ස්නයිපර්” රොබෝ යානය පෘථිවි ගුරුත්ව බලය යොදා ගනිමින් සඳ බලා යනු ඇති ඒ සඳහා මාස කීපයක් ගත වනු ඇති බවද ජපාන විද්‍යාඥයෝ&nbsp;සදහන්&nbsp;කරයි.\r\n', '2023-08-31 00:54:56', 0, 1),
	(42, 'ddd', 'kawshalya20001025@gmail.com', 7, '64ef9edfbc17b.mp4', '“Where I’m standing right now could potentially be under 6 feet of water by the time we get the high tide” late Wednesday afternoon, he said.\r\n\r\nSeveral major bridges connecting Florida islands to the mainland are inaccessible, and Idalia’s destructive rampage now threatens coastal Georgia and South Carolina with intense flooding, powerful winds and tornadoes.\r\n\r\nAs of 2 p.m. ET, Idalia was whipping maximum sustained winds of 75 mph – with even more ferocious gusts. It was centered about 10 miles north-northwest of Waycross, Georgia, a city in the southeastern part of the state. Flash flooding and river flooding is likely across Georgia and the Carolinas through Thursday, the National Hurricane Center warned.\r\n\r\nBut officials in western Florida are warning residents to not get a false sense of security as the hurricane slowly pulls away from them. That’s because a massive “king tide” could make the already dangerous flooding even deadlier.', '2023-08-31 01:26:15', 0, 1);

-- Dumping structure for table elakiri.post_notification
CREATE TABLE IF NOT EXISTS `post_notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `relist` int DEFAULT '0',
  `remove` int DEFAULT '0',
  `read` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_post_notification_post` (`post_id`),
  CONSTRAINT `FK_post_notification_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.post_notification: ~7 rows (approximately)
INSERT INTO `post_notification` (`id`, `post_id`, `datetime`, `relist`, `remove`, `read`) VALUES
	(1, 6, '2023-08-16 00:16:58', 1, 0, 1),
	(2, 1, '2023-08-16 00:17:23', 1, 0, 1),
	(3, 13, '2023-08-16 00:21:01', 0, 1, 1),
	(4, 6, '2023-08-16 00:23:57', 1, 0, 1),
	(5, 6, '2023-08-16 00:24:43', 0, 1, 1),
	(6, 2, '2023-08-16 13:00:07', 0, 1, 0),
	(7, 13, '2023-08-17 20:44:51', 1, 0, 1);

-- Dumping structure for table elakiri.post_view
CREATE TABLE IF NOT EXISTS `post_view` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.post_view: ~3 rows (approximately)
INSERT INTO `post_view` (`id`, `name`) VALUES
	(1, 'public'),
	(2, 'followers'),
	(3, 'private');

-- Dumping structure for table elakiri.profile_pic
CREATE TABLE IF NOT EXISTS `profile_pic` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_profile_pic_users` (`email`),
  CONSTRAINT `FK_profile_pic_users` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.profile_pic: ~3 rows (approximately)
INSERT INTO `profile_pic` (`id`, `image`, `email`) VALUES
	(1, '64efa33eeb8aa.jpeg', 'chalithachamod3031@gmail.com'),
	(2, '64efa040c8c34.jpeg', 'kawshalya20001025@gmail.com'),
	(4, '64ec64ce02090.jpeg', 'sahannim7@gmail.com');

-- Dumping structure for table elakiri.react
CREATE TABLE IF NOT EXISTS `react` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.react: ~3 rows (approximately)
INSERT INTO `react` (`id`, `name`) VALUES
	(1, 'like'),
	(2, 'dislike'),
	(3, 'no');

-- Dumping structure for table elakiri.reaction
CREATE TABLE IF NOT EXISTS `reaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `react_id` int DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reaction_post` (`post_id`),
  KEY `FK_reaction_users` (`user_email`),
  KEY `FK_reaction_react` (`react_id`),
  CONSTRAINT `FK_reaction_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_reaction_react` FOREIGN KEY (`react_id`) REFERENCES `react` (`id`),
  CONSTRAINT `FK_reaction_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.reaction: ~93 rows (approximately)
INSERT INTO `reaction` (`id`, `post_id`, `react_id`, `user_email`) VALUES
	(76, 15, 1, 'chalithachamod3031@gmail.com'),
	(77, 5, 2, 'chalithachamod3031@gmail.com'),
	(78, 3, 2, 'chalithachamod3031@gmail.com'),
	(79, 2, 1, 'chalithachamod3031@gmail.com'),
	(80, 5, 3, 'samanali@gmail.com'),
	(81, 15, 1, 'samanali@gmail.com'),
	(82, 13, 1, 'samanali@gmail.com'),
	(83, 3, 1, 'samanali@gmail.com'),
	(84, 15, 1, 'kawshalya20001025@gmail.com'),
	(85, 2, 3, 'samanali@gmail.com'),
	(86, 6, 3, 'chalithachamod3031@gmail.com'),
	(87, 15, 2, 'chalithachamod3031@gmail.com'),
	(88, 15, 2, 'kawshalya20001025@gmail.com'),
	(89, 4, 3, 'chalithachamod3031@gmail.com'),
	(90, 11, 2, 'chalithachamod3031@gmail.com'),
	(91, 13, 3, 'kawshalya20001025@gmail.com'),
	(92, 2, 3, 'kawshalya20001025@gmail.com'),
	(93, 4, 3, 'kawshalya20001025@gmail.com'),
	(94, 12, 3, 'kawshalya20001025@gmail.com'),
	(95, 3, 3, 'mahi@gmail.com'),
	(96, 15, 3, 'chalithachamod3031@gmail.com'),
	(97, 13, 3, 'chalithachamod3031@gmail.com'),
	(98, 1, 3, 'chalithachamod3031@gmail.com'),
	(99, 6, 3, 'mahi@gmail.com'),
	(100, 15, 3, 'chalithachamod3031@gmail.com'),
	(101, 15, 3, 'chalithachamod3031@gmail.com'),
	(102, 15, 3, 'mahi@gmail.com'),
	(103, 15, 3, 'chalithachamod3031@gmail.com'),
	(104, 15, 3, 'chalithachamod3031@gmail.com'),
	(105, 15, 3, 'chalithachamod3031@gmail.com'),
	(106, 15, 3, 'chalithachamod3031@gmail.com'),
	(107, 15, 3, 'chalithachamod3031@gmail.com'),
	(108, 15, 3, 'chalithachamod3031@gmail.com'),
	(109, 15, 3, 'chalithachamod3031@gmail.com'),
	(110, 15, 3, 'chalithachamod3031@gmail.com'),
	(111, 15, 3, 'chalithachamod3031@gmail.com'),
	(112, 15, 3, 'chalithachamod3031@gmail.com'),
	(113, 15, 3, 'chalithachamod3031@gmail.com'),
	(114, 15, 3, 'chalithachamod3031@gmail.com'),
	(115, 15, 3, 'chalithachamod3031@gmail.com'),
	(116, 15, 3, 'chalithachamod3031@gmail.com'),
	(117, 15, 3, 'chalithachamod3031@gmail.com'),
	(118, 15, 3, 'chalithachamod3031@gmail.com'),
	(119, 15, 3, 'chalithachamod3031@gmail.com'),
	(120, 15, 3, 'chalithachamod3031@gmail.com'),
	(121, 15, 3, 'chalithachamod3031@gmail.com'),
	(122, 15, 3, 'chalithachamod3031@gmail.com'),
	(123, 15, 3, 'chalithachamod3031@gmail.com'),
	(124, 15, 3, 'chalithachamod3031@gmail.com'),
	(125, 15, 3, 'chalithachamod3031@gmail.com'),
	(126, 15, 3, 'chalithachamod3031@gmail.com'),
	(127, 2, 3, 'mahi@gmail.com'),
	(128, 15, 3, 'chalithachamod3031@gmail.com'),
	(129, 15, 3, 'chalithachamod3031@gmail.com'),
	(130, 15, 3, 'chalithachamod3031@gmail.com'),
	(131, 15, 3, 'chalithachamod3031@gmail.com'),
	(132, 15, 3, 'chalithachamod3031@gmail.com'),
	(133, 11, 3, 'sahannim7@gmail.com'),
	(134, 1, 3, 'prasannasampath064@gmail.com'),
	(135, 16, 3, 'prasannasampath064@gmail.com'),
	(136, 17, 3, 'prasannasampath064@gmail.com'),
	(137, 18, 3, 'prasannasampath064@gmail.com'),
	(138, 11, 3, 'prasannasampath064@gmail.com'),
	(139, 20, 3, 'prasannasampath064@gmail.com'),
	(140, 37, 3, 'prasannasampath064@gmail.com'),
	(141, 21, 3, 'prasannasampath064@gmail.com'),
	(142, 22, 3, 'prasannasampath064@gmail.com'),
	(143, 37, 3, 'prasannasampath064@gmail.com'),
	(144, 24, 3, 'prasannasampath064@gmail.com'),
	(145, 25, 3, 'prasannasampath064@gmail.com'),
	(146, 26, 1, 'prasannasampath064@gmail.com'),
	(147, 27, 3, 'prasannasampath064@gmail.com'),
	(148, 30, 3, 'prasannasampath064@gmail.com'),
	(149, 32, 3, 'prasannasampath064@gmail.com'),
	(150, 33, 3, 'prasannasampath064@gmail.com'),
	(151, 37, 3, 'sahannim7@gmail.com'),
	(152, 24, 1, 'ks9446.hashini@gmail.com'),
	(153, 26, 1, 'ks9446.hashini@gmail.com'),
	(154, 25, 3, 'ks9446.hashini@gmail.com'),
	(155, 24, 3, 'chalithachamod3031@gmail.com'),
	(156, 25, 3, 'chalithachamod3031@gmail.com'),
	(157, 34, 3, 'chalithachamod3031@gmail.com'),
	(158, 35, 3, 'chalithachamod3031@gmail.com'),
	(159, 33, 3, 'chalithachamod3031@gmail.com'),
	(160, 23, 3, 'chalithachamod3031@gmail.com'),
	(161, 31, 3, 'chalithachamod3031@gmail.com'),
	(162, 36, 3, 'chalithachamod3031@gmail.com'),
	(163, 28, 3, 'chalithachamod3031@gmail.com'),
	(164, 37, 3, 'chalithachamod3031@gmail.com'),
	(165, 38, 3, 'chalithachamod3031@gmail.com'),
	(166, 40, 3, 'chalithachamod3031@gmail.com'),
	(168, 42, 3, 'kawshalya20001025@gmail.com'),
	(169, 30, 3, 'chalithachamod3031@gmail.com');

-- Dumping structure for table elakiri.remove_post
CREATE TABLE IF NOT EXISTS `remove_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `reason` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_remove_post_post` (`post_id`),
  CONSTRAINT `FK_remove_post_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.remove_post: ~4 rows (approximately)
INSERT INTO `remove_post` (`id`, `post_id`, `reason`) VALUES
	(5, 4, 'Harassment or bullying'),
	(6, 13, 'Child abuse'),
	(7, 6, 'Hateful or abusive content'),
	(8, 2, 'Harmful or dangerous acts');

-- Dumping structure for table elakiri.report
CREATE TABLE IF NOT EXISTS `report` (
  `id` int NOT NULL AUTO_INCREMENT,
  `report_email` varchar(50) DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `tittle` varchar(200) DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_report_users` (`report_email`),
  KEY `FK_report_post` (`post_id`),
  CONSTRAINT `FK_report_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_report_users` FOREIGN KEY (`report_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.report: ~12 rows (approximately)
INSERT INTO `report` (`id`, `report_email`, `post_id`, `tittle`, `status`) VALUES
	(147, 'chalithachamod3031@gmail.com', 11, 'Child abuse', 0),
	(153, 'chalithachamod3031@gmail.com', 5, 'Harmful or dangerous acts', 1),
	(154, 'chalithachamod3031@gmail.com', 5, 'Harmful or dangerous acts', 1),
	(155, 'chalithachamod3031@gmail.com', 5, 'Harmful or dangerous acts', 1),
	(156, 'chalithachamod3031@gmail.com', 5, 'Harmful or dangerous acts', 1),
	(157, 'chalithachamod3031@gmail.com', 5, 'Harmful or dangerous acts', 1),
	(158, 'mahi@gmail.com', 3, 'Child abuse', 0),
	(159, 'prasannasampath064@gmail.com', 1, 'Spam or misleading', 0),
	(160, 'mahi@gmail.com', 3, 'Spam or misleading', 0),
	(161, 'kawshalya20001025@gmail.com', 42, 'Harmful or dangerous acts', 1),
	(162, 'kawshalya20001025@gmail.com', 42, 'Harmful or dangerous acts', 1),
	(163, 'kawshalya20001025@gmail.com', 42, 'Harmful or dangerous acts', 1);

-- Dumping structure for table elakiri.report_notificaion
CREATE TABLE IF NOT EXISTS `report_notificaion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `read` int DEFAULT '0',
  `block` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_report_notificaion_report` (`post_id`) USING BTREE,
  CONSTRAINT `FK_report_notificaion_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.report_notificaion: ~8 rows (approximately)
INSERT INTO `report_notificaion` (`id`, `post_id`, `datetime`, `read`, `block`) VALUES
	(35, 3, '2023-08-17 20:51:25', 1, 0),
	(36, 1, '2023-08-28 10:51:14', 1, 0),
	(37, 3, '2023-08-30 20:25:33', 1, 0),
	(38, 42, '2023-08-31 01:26:47', 1, 0),
	(39, 42, '2023-08-31 01:26:53', 1, 0),
	(40, 42, '2023-08-31 01:26:57', 1, 0),
	(41, 42, '2023-08-31 01:27:02', 1, 0),
	(42, 42, '2023-08-31 01:27:08', 1, 1);

-- Dumping structure for table elakiri.users
CREATE TABLE IF NOT EXISTS `users` (
  `fname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  `blocked` int DEFAULT '0',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table elakiri.users: ~8 rows (approximately)
INSERT INTO `users` (`fname`, `lname`, `email`, `username`, `password`, `register_date`, `verification_code`, `blocked`) VALUES
	('cha', 'ge', 'chalithachamod3031@gmail.com', 'gf', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', '2023-05-17 21:09:10', '6464f9152e521', 0),
	('Kawshalya ', 'Dissanayaka', 'kawshalya20001025@gmail.com', 'kavi', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2023-03-26 15:15:29', NULL, 0),
	('hashini', 'jayangi', 'ks9446.hashini@gmail.com', 'hashi', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', '2023-08-28 14:45:50', NULL, 0),
	('mahinda', 'samarsignha', 'mahi@gmail.com', 'mahinda', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2023-06-07 13:27:49', NULL, 0),
	('Prasanna sampath', 'samarakoon', 'prasannasampath064@gmail.com', 'prasa', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', '2023-08-25 21:07:00', '64e8cbc79d980', 0),
	('sahan', 'nimesh', 'sahannim7@gmail.com', 'sahannim', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', '2023-08-27 07:42:11', '64eab37c3c9d0', 0),
	('salika', 'eranga', 'salika@gmail.com', 'saali', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2023-06-09 19:18:06', NULL, 0),
	('smanli', 'kumari', 'samanali@gmail.com', 'samanli', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '2023-06-07 02:22:59', NULL, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
