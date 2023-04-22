-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2020 at 04:58 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meethabbo`
--

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`id`, `image`, `code`, `description`) VALUES
(1, 'BVN.gif', 'BVN', 'Pour les nouveaux utilisateurs'),
(2, 'MODO.png', 'MODO', 'Assure la sécurité du site'),
(3, 'ROOM1.gif', 'ROOM1', 'Spécialiste des Rooms'),
(4, 'CHAT1.gif', 'CHAT1', 'Un grand bavard'),
(5, 'BETA.gif', 'BETA', 'J\'ai testé la première version d\'HabboFriend'),
(6, 'FRIEND1.gif', 'FRIEND1', 'J\'adore les amis'),
(7, 'ROOM2.gif', 'ROOM2', 'Pour avoir créé ma première Room'),
(8, 'SECU.gif', 'SECU', 'Je suis à cheval sur la sécurité'),
(9, 'SECUR.png', 'SECUR', 'Pour les maîtres de la sécurité'),
(10, 'ADM.png', 'ADM', 'Administrateur du réseau social'),
(11, 'MOD.png', 'MOD', 'Modérateur du réseau social'),
(12, 'ANM.png', 'ANM', 'Animateur du réseau social'),
(13, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `badges_membership`
--

CREATE TABLE `badges_membership` (
  `id` int(11) NOT NULL,
  `user_token` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `badge_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badges_membership`
--

INSERT INTO `badges_membership` (`id`, `user_token`, `user_id`, `badge_code`) VALUES
(1, '240968378a5ccef445239c655c068060', 1, 'BVN'),
(2, 'ab5cfc9f893c62bb17d3e6510f6a0a62', 2, 'BVN'),
(3, '240968378a5ccef445239c655c068060', 1, 'MODO'),
(4, '240968378a5ccef445239c655c068060', 1, 'CHAT1'),
(5, '240968378a5ccef445239c655c068060', 1, 'BETA'),
(6, '240968378a5ccef445239c655c068060', 1, 'ADM'),
(7, '240968378a5ccef445239c655c068060', 1, 'MOD'),
(8, '240968378a5ccef445239c655c068060', 1, 'ANM'),
(9, '30dff571ce0d0a607b20d9da992e3cd3', 3, 'BVN'),
(10, '240968378a5ccef445239c655c068060', 1, 'ROOM1'),
(11, '240968378a5ccef445239c655c068060', 1, 'ROOM2'),
(13, '240968378a5ccef445239c655c068060', 1, 'FRIEND1'),
(14, 'e549ec6d693e56a42bd789156d89e152', 4, 'BVN'),
(15, '30dff571ce0d0a607b20d9da992e3cd3', 3, 'ADM');

-- --------------------------------------------------------

--
-- Table structure for table `badges_worn`
--

CREATE TABLE `badges_worn` (
  `id` int(11) NOT NULL,
  `user_token` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `badge_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badges_worn`
--

INSERT INTO `badges_worn` (`id`, `user_token`, `user_id`, `badge_code`) VALUES
(13, 'ab5cfc9f893c62bb17d3e6510f6a0a62', 2, 'BVN'),
(42, '240968378a5ccef445239c655c068060', 1, 'ADM'),
(50, '240968378a5ccef445239c655c068060', 1, 'MODO'),
(52, '240968378a5ccef445239c655c068060', 1, 'CHAT1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `order_id`) VALUES
(1, 'MeetHabbo Reception', '', 1),
(2, 'Discussion', '', 3),
(3, 'Graphisme', '', 4),
(4, 'Construction', '', 5),
(5, 'Wired', '', 6),
(6, 'Habbo', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum_animations`
--

CREATE TABLE `forum_animations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_token` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `price_type` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table meethabbo.forum_animations: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `meethabbo`.`forum_animations`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `forum_forums`
--

CREATE TABLE `forum_forums` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `locked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_forums`
--

INSERT INTO `forum_forums` (`id`, `title`, `image`, `description`, `category_id`, `locked`) VALUES
(1, 'Communication MeetHabbo', 'meet_forum_communication.png', 'Ici seront affichés tous les communiqués faits par l\'équipe de MeetHabbo', 1, 1),
(2, 'Support/Bugs', 'meet_forum_support.png', 'Dans ce forum, vous pourrez prévenir tout problèmes ou bugs que vous rencontrez, notre équipe vous aideras à résoudre vos soucis', 1, 0),
(4, 'Discussion Habbo', 'meet_forum_retro.png', 'Venez discuter de tous ce qui concerne les rétroserveurs', 6, 0),
(5, 'Habbo Développement', 'meet_forum_development.png', 'Venez discuter de tout ce qui concerne le développement des rétroserveurs et autres projets (HTML/CSS/PHP/JS etc...)', 6, 0),
(6, 'Vos projets réalisés', 'meet_forum_release.png', 'Venez présenter vos projets terminés, pour attirer du monde', 6, 0),
(7, 'Habbo Tutoriels', 'meet_forum_tuto.png', 'Ici, vous trouverez des tutoriels en rapport avec le monde du développement des rétroserveurs', 6, 0),
(8, 'Présentation des membres', 'meet_forum_presentation.png', 'Ici, sont regroupées les présentations des nouveaux membres', 1, 0),
(9, 'Aides', 'meet_forum_aide.png', 'Un problème avec votre projet ? Venez le poser ici pour obtenir de l\'aide', 6, 0),
(10, 'Technologie / Jeux vidéos', 'meet_forum_techvideo.png', 'Venez discuter des nouvelles technologies et de vos jeux vidéos préférés', 2, 0),
(11, 'Ecole / Cours', 'meet_forum_school.png', 'Venez discuter des choses qui ont animées votre année scolaire', 2, 0),
(12, 'Musiques', 'meet_forum_music.gif', 'Venez discuter des musiques du moment et de vos musiques préférées', 2, 0),
(13, 'Films / Cinéma', 'meet_forum_film.png', 'Venez discuter des derniers films du moment et de vos films préférés', 2, 0),
(14, 'Sport', 'meet_forum_sport.png', 'Venez parler des sports et des compétitions du moment', 2, 0),
(15, 'Vidéos', 'meet_forum_videos.png', 'Venez parler des vidéos virales, qui font le buzz ou tout simplement de vos vidéos préférées', 2, 0),
(16, 'Vos créations', 'meet_forum_creation.gif', 'Venez publiez vos créations graphiques (pixel-art, dessin etc..) pour recueillir des avis et critiques', 3, 0),
(17, 'Tutotiels', 'meet_forum_crea_tuto.png', 'Vous pourrez y trouver des tutoriels graphiques', 3, 0),
(18, 'Vos créations', 'meet_forum_build.png', 'Découvrez ou postés vos créations architecturales', 4, 0),
(19, 'Tutoriels', 'meet_forum_build_tuto.gif', 'Venez découvrir des tutoriels sur l\'univers de l\'architecture Habbo', 4, 0),
(20, 'Vos créations', 'meet_forum_wired.png', 'Postez ou découvrez des créations faites avec des wireds Habbo', 5, 0),
(21, 'Tutoriels', 'meet_forum_wired_tuto.png', 'Apprenez à manier et dompter les wireds, pour vos créations ou jeux', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_replies`
--

CREATE TABLE `forum_replies` (
  `id` int(11) NOT NULL,
  `author_token` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `edit_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_replies`
--

INSERT INTO `forum_replies` (`id`, `author_token`, `content`, `topic_id`, `added_date`, `edit_date`) VALUES
(1, 'ab5cfc9f893c62bb17d3e6510f6a0a62', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor tempus consectetur.</p>', 1, '08/12/2016 11:47:48', NULL),
(15, '240968378a5ccef445239c655c068060', '<p>Encoraaaaaaaaaage</p>', 8, '08/16/2016 20:27:47', NULL),
(16, '240968378a5ccef445239c655c068060', '<p>Flooooooooooooooooooooood</p>', 8, '08/16/2016 20:27:53', NULL),
(17, '240968378a5ccef445239c655c068060', '<p>looooooooooooooooooooooool</p>', 8, '08/16/2016 20:27:58', NULL),
(18, '240968378a5ccef445239c655c068060', '<p>ptdrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr humm...</p>', 8, '08/16/2016 20:28:04', '08/17/2016 11:38:32'),
(19, '240968378a5ccef445239c655c068060', '<p>En force tmtc</p>', 8, '08/16/2016 20:28:10', NULL),
(20, '240968378a5ccef445239c655c068060', '<p>Encore une commenennnnnnn</p>', 8, '08/16/2016 20:28:23', NULL),
(21, '240968378a5ccef445239c655c068060', '<p>jsais meme pas ske jraconte</p>', 8, '08/16/2016 20:28:36', '08/23/2016 01:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_token` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `announce` int(11) NOT NULL,
  `sticked` int(11) NOT NULL,
  `warned` int(11) NOT NULL,
  `locked` int(11) NOT NULL,
  `edit_date` varchar(255) DEFAULT NULL,
  `forum_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `title`, `author_token`, `content`, `added_date`, `announce`, `sticked`, `warned`, `locked`, `edit_date`, `forum_id`) VALUES
(2, 'Je suis une annonce haha', '240968378a5ccef445239c655c068060', '<p>Haaaa</p>', '08/11/2016 00:57:19', 1, 0, 0, 0, '08/14/2016 17:07:23', 4),
(5, '&amp;eacute;', '240968378a5ccef445239c655c068060', '<p>go</p>', '08/13/2016 23:18:13', 0, 0, 0, 0, NULL, 4),
(6, 'MeetHabbo test 3', '240968378a5ccef445239c655c068060', '&amp;lt;div id=&quot;lipsum&quot;&amp;gt;\r\n&amp;lt;p&amp;gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor, erat a posuere gravida, quam ante vulputate nibh, vitae fringilla tellus massa lacinia lectus. Vivamus suscipit ullamcorper ante, sit amet vulputate urna rutrum nec. Ut dignissim mi ut ante rhoncus, nec auctor mi egestas. Maecenas interdum lorem eget lacus pellentesque laoreet. Sed facilisis consequat scelerisque. Etiam sit amet libero vehicula, iaculis purus sit amet, congue nisl. Mauris feugiat tempor sem vel condimentum. Proin placerat quam tellus, at porttitor sapien luctus eu. Suspendisse egestas dapibus ligula, nec fermentum nisl scelerisque at. Nunc ornare, sem in pellentesque egestas, nulla erat interdum ante, et venenatis sem erat ac ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut eleifend nec purus et dapibus. Aliquam erat volutpat. Vestibulum vulputate rutrum lacus.&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;Pellentesque bibendum eros in odio ultricies, nec ultrices urna congue. Sed porta tempor erat, vel pretium lorem pulvinar quis. Fusce nibh leo, gravida vel orci at, tristique consectetur justo. Nulla commodo justo lacus, a fringilla tortor gravida elementum. Etiam lacinia diam a rhoncus mollis. Donec in dictum tortor, a gravida sapien. Quisque malesuada, elit ut ornare laoreet, purus lacus convallis ipsum, sit amet vestibulum dui lacus vel ex. Curabitur sit amet elit vitae lectus varius rutrum eget eget nunc. Proin vitae erat convallis, aliquam libero quis, facilisis ante. Aliquam lorem libero, tempor a nisl sed, facilisis luctus turpis. Aenean euismod lacus vitae molestie placerat. Praesent in nibh id massa cursus tincidunt ac nec eros.&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam condimentum at orci eget blandit. Aenean imperdiet sem ipsum, sed blandit sem accumsan eget. Proin id lacus convallis, hendrerit erat id, pretium libero. Aenean pharetra nisl sit amet hendrerit egestas. Nunc accumsan sodales quam, non eleifend orci convallis sit amet. Integer ac justo at ipsum gravida aliquet sit amet eu eros. Curabitur at arcu nulla. Aliquam lobortis lorem ac urna venenatis, sit amet ornare ex aliquet. Etiam tristique, tellus ac porta rhoncus, elit leo volutpat sapien, id hendrerit purus nisl eu diam. Integer vitae tincidunt nisl.&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;Aenean luctus accumsan neque quis viverra. Phasellus blandit, massa dictum pharetra facilisis, nisi velit consectetur mauris, in bibendum nulla purus id elit. Cras quis tincidunt dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis interdum sed sapien in bibendum. Vivamus a feugiat arcu. Suspendisse fermentum luctus metus, in dignissim lectus rutrum at. Aliquam at lacus massa. Quisque dui arcu, malesuada ut orci id, dignissim ultricies libero. Suspendisse at risus magna. Sed porttitor eget turpis non tristique. Sed nec enim vulputate, iaculis dolor gravida, sagittis tortor.&amp;lt;/p&amp;gt;\r\n&amp;lt;/div&amp;gt;', '08/13/2016 23:21:13', 0, 0, 0, 1, NULL, 4),
(7, 'MeetHabbo test 4', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor, erat a posuere gravida, quam ante vulputate nibh, vitae fringilla tellus massa lacinia lectus. Vivamus suscipit ullamcorper ante, sit amet vulputate urna rutrum nec. Ut dignissim mi ut ante rhoncus, nec auctor mi egestas. Maecenas interdum lorem eget lacus pellentesque laoreet. Sed facilisis consequat scelerisque. Etiam sit amet libero vehicula, iaculis purus sit amet, congue nisl. Mauris feugiat tempor sem vel condimentum. Proin placerat quam tellus, at porttitor sapien luctus eu. Suspendisse egestas dapibus ligula, nec fermentum nisl scelerisque at. Nunc ornare, sem in pellentesque egestas, nulla erat interdum ante, et venenatis sem erat ac ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut eleifend nec purus et dapibus. Aliquam erat volutpat. Vestibulum vulputate rutrum lacus.</p>\r\n<p>Pellentesque bibendum eros in odio ultricies, nec ultrices urna congue. Sed porta tempor erat, vel pretium lorem pulvinar quis. Fusce nibh leo, gravida vel orci at, tristique consectetur justo. Nulla commodo justo lacus, a fringilla tortor gravida elementum. Etiam lacinia diam a rhoncus mollis. Donec in dictum tortor, a gravida sapien. Quisque malesuada, elit ut ornare laoreet, purus lacus convallis ipsum, sit amet vestibulum dui lacus vel ex. Curabitur sit amet elit vitae lectus varius rutrum eget eget nunc. Proin vitae erat convallis, aliquam libero quis, facilisis ante. Aliquam lorem libero, tempor a nisl sed, facilisis luctus turpis. Aenean euismod lacus vitae molestie placerat. Praesent in nibh id massa cursus tincidunt ac nec eros.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam condimentum at orci eget blandit. Aenean imperdiet sem ipsum, sed blandit sem accumsan eget. Proin id lacus convallis, hendrerit erat id, pretium libero. Aenean pharetra nisl sit amet hendrerit egestas. Nunc accumsan sodales quam, non eleifend orci convallis sit amet. Integer ac justo at ipsum gravida aliquet sit amet eu eros. Curabitur at arcu nulla. Aliquam lobortis lorem ac urna venenatis, sit amet ornare ex aliquet. Etiam tristique, tellus ac porta rhoncus, elit leo volutpat sapien, id hendrerit purus nisl eu diam. Integer vitae tincidunt nisl.</p>\r\n<p>Aenean luctus accumsan neque quis viverra. Phasellus blandit, massa dictum pharetra facilisis, nisi velit consectetur mauris, in bibendum nulla purus id elit. Cras quis tincidunt dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis interdum sed sapien in bibendum. Vivamus a feugiat arcu. Suspendisse fermentum luctus metus, in dignissim lectus rutrum at. Aliquam at lacus massa. Quisque dui arcu, malesuada ut orci id, dignissim ultricies libero. Suspendisse at risus magna. Sed porttitor eget turpis non tristique. Sed nec enim vulputate, iaculis dolor gravida, sagittis tortor.</p>\r\n</div>', '08/13/2016 23:22:23', 0, 0, 0, 0, NULL, 4),
(8, 'MeetHabbo test 5', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Proin auctor, erat a posuere gravida, quam ante vulputate nibh, vitae fringilla tellus massa lacinia lectus. Vivamus suscipit ullamcorper ante, sit amet vulputate urna rutrum nec. Ut dignissim mi ut ante rhoncus, nec auctor mi egestas. Maecenas interdum lorem eget lacus pellentesque laoreet. Sed facilisis consequat scelerisque. Etiam sit amet libero vehicula, iaculis purus sit amet, congue nisl. Mauris feugiat tempor sem vel condimentum. Proin placerat quam tellus, at porttitor <strong><span style=\"color: #ff6600;\">sapien luctus eu. Suspendisse egestas dapibus ligula, nec fermentum</span></strong> nisl scelerisque at. Nunc ornare, sem in pellentesque egestas, nulla erat interdum ante, et venenatis sem erat ac ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut eleifend nec purus et dapibus. Aliquam erat volutpat. Vestibulum vulputate rutrum lacus.</p>\r\n<p><img style=\"float: left;\" src=\"https://allolive.fr/wp-content/uploads/2014/01/credits_v3_teaser.png\" alt=\"\" width=\"370\" height=\"226\" /></p>\r\n<p style=\"text-align: center;\">Pellentesque bibendum eros in odio ultricies, nec ultrices urna congue. Sed porta tempor erat, vel pretium lorem pulvinar quis. Fusce nibh leo, gravida vel orci at, tristique consectetur justo. Nulla commodo justo lacus, a fringilla tortor gravida elementum. Etiam lacinia diam a rhoncus mollis. Donec in dictum tortor, a gravida sapien. Quisque malesuada, elit ut <strong><em>ornare laoreet, purus lacus convallis ipsum, sit amet vestibulum dui lacus vel ex</em></strong>. Curabitur sit amet elit vitae lectus varius rutrum eget eget nunc. Proin vitae erat convallis, aliquam libero quis, facilisis ante. Aliquam lorem libero, tempor a nisl sed, facilisis luctus turpis. Aenean euismod lacus vitae molestie placerat. Praesent in nibh id massa cursus tincidunt ac nec eros.</p>\r\n<ul>\r\n<li>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam condimentum at orci eget blandit. Aenean imperdiet sem ipsum, sed blandit sem accumsan eget. Proin id lacus convallis, hendrerit erat id, pretium libero. Aenean pharetra nisl sit amet hendrerit egestas. Nunc accumsan sodales quam, non eleifend orci convallis sit amet. Integer ac justo at ipsum gravida aliquet sit amet eu eros. Curabitur at arcu nulla. Aliquam lobortis lorem ac urna venenatis, sit amet ornare ex aliquet. Etiam tristique, tellus ac porta rhoncus, elit leo volutpat sapien, id hendrerit purus nisl eu diam. Integer vitae tincidunt nisl.</li>\r\n</ul>\r\n<p>Aenean luctus accumsan neque quis viverra. Phasellus blandit, massa dictum pharetra facilisis, nisi velit consectetur mauris, in bibendum nulla purus id elit. Cras quis tincidunt dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis interdum sed sapien in bibendum. Vivamus a feugiat arcu. Suspendisse fermentum luctus metus, in dignissim lectus rutrum at. Aliquam at lacus massa. Quisque dui arcu, malesuada ut orci id, dignissim ultricies libero. Suspendisse at risus magna. Sed porttitor eget turpis non tristique. Sed nec enim vulputate, iaculis dolor gravida, sagittis tortor.</p>\r\n</div>', '08/13/2016 23:26:30', 0, 0, 0, 0, '09/28/2019 03:12:31', 4),
(9, '&amp;eacute;&amp;eacute;&amp;eacute;&amp;eacute;&amp;eacute;&amp;eacute;&amp;eacute;&amp;eacute;&amp;eacute; accents', '240968378a5ccef445239c655c068060', '<p>&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute; accents tggggggggg XD mdrrr</p>', '08/14/2016 11:05:21', 0, 0, 0, 0, NULL, 4),
(10, 'Je suis MiceElf', '30dff571ce0d0a607b20d9da992e3cd3', '<p>Salut je suis Awesome-Dude</p>', '08/14/2016 13:00:55', 0, 1, 0, 0, NULL, 4),
(11, 'Lorem ipsum', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/14/2016 17:11:30', 0, 0, 0, 0, NULL, 4),
(12, 'Lorem ipsum', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>\r\n</div>\r\n</div>', '08/14/2016 17:11:39', 0, 0, 0, 0, NULL, 4),
(13, 'Lorem 3', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/14/2016 17:11:58', 0, 0, 0, 0, NULL, 4),
(14, 'Lorem 4', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/14/2016 17:12:05', 0, 0, 0, 0, NULL, 4),
(15, 'Lorem 5', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/14/2016 17:12:12', 0, 0, 0, 0, NULL, 4),
(16, 'Lorem 6', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/14/2016 17:12:19', 0, 0, 0, 0, NULL, 4),
(17, 'Lorem 7', '240968378a5ccef445239c655c068060', '<p></p>\r\n<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/14/2016 17:12:48', 0, 0, 0, 0, NULL, 4),
(18, 'Lorem 8', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/14/2016 17:12:55', 0, 0, 0, 0, NULL, 4),
(19, 'Habbo The Best Place Ever', 'ab5cfc9f893c62bb17d3e6510f6a0a62', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://upload.wikimedia.org/wikipedia/commons/1/1a/Habbo.gif\" alt=\"\" width=\"192\" height=\"68\" /></p>\r\n<p style=\"text-align: center;\">Habbo is the best place ever made. I love this game so !</p>', '08/14/2016 20:06:55', 0, 0, 0, 0, '08/14/2016 20:07:05', 4),
(20, 'Blabla 1', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/15/2016 14:06:49', 0, 0, 0, 0, NULL, 4);
INSERT INTO `forum_topics` (`id`, `title`, `author_token`, `content`, `added_date`, `announce`, `sticked`, `warned`, `locked`, `edit_date`, `forum_id`) VALUES
(21, 'Blabla 2', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/15/2016 14:06:58', 0, 0, 0, 0, NULL, 4),
(22, 'Blabla 4', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/15/2016 14:07:06', 0, 0, 0, 0, NULL, 4),
(23, 'Blabla 3', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus <span style=\"color: #808000;\">a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</span></p>\r\n<p><span style=\"color: #808000;\">Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</span></p>\r\n<p><span style=\"color: #808000;\">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere</span> cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/15/2016 14:07:19', 0, 0, 0, 0, NULL, 4),
(24, 'XDDDDDDDDDDDDDD', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/15/2016 14:14:20', 0, 0, 0, 0, NULL, 4),
(25, 'Ta gueule', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.</strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>\r\n</div>', '08/15/2016 14:14:27', 0, 0, 0, 0, '08/15/2016 16:13:42', 4),
(26, 'Pagination xD', '240968378a5ccef445239c655c068060', '<div id=\"lipsum\">\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non vehicula enim. Nunc ipsum dolor, lacinia eget ipsum a, faucibus tristique ligula. Nulla feugiat facilisis iaculis. Cras metus felis, hendrerit ut metus eu, molestie accumsan nisi. Nam ultrices urna sit amet placerat tempus. Vestibulum efficitur sit amet nulla vel dapibus. Ut porta quis metus eu porttitor. Proin interdum dolor lorem, sed ultrices ex commodo a. Proin egestas, risus eget interdum semper, erat libero malesuada leo, id bibendum dolor dui at nisi. Sed molestie tempor massa, at tempus ligula lacinia ut. Donec eget felis at odio auctor ornare. Aenean eget vehicula risus, id egestas ex. Donec suscipit erat feugiat tellus lobortis malesuada. Suspendisse id iaculis ligula, sed tincidunt tellus. Ut enim mi, porta quis felis non, volutpat aliquam elit. Aliquam luctus nibh ac luctus volutpat.<img style=\"float: left;\" src=\"http://habboo-a.akamaihd.net/c_images/article_images_hq/h15_ill2_logo.png\" alt=\"\" width=\"220\" height=\"184\" /></strong></p>\r\n<p><strong>Class aptent taciti sociosqu ad litora to</strong>rquent per conubia nostra, per inceptos himenaeos. In gravida diam a felis efficitur maximus. Pellentesque ac augue sit amet tellus elementum posuere in sed tellus. Aliquam blandit et velit ut euismod. Donec nec turpis in sapien egestas tempus non at felis. Integer justo sem, fermentum quis nisl et, interdum blandit diam. Etiam finibus posuere scelerisque. Donec dignissim blandit commodo. Proin mollis egestas libero, vel bibendum ante scelerisque ac. Nullam ut magna tristique, lobortis neque ac, rutrum nulla.</p>\r\n<p>Donec eleifend cursus augue, a maximus ante finibus a. Nam leo justo, ultricies ut dolor et, mollis eleifend enim. Vestibulum non metus odio. Cras sed bibendum odio. Ut enim elit, vulputate volutpat convallis volutpat, posuere condimentum dui. Curabitur scelerisque, diam vel auctor laoreet, sapien dolor suscipit sem, at egestas ipsum felis sit amet nibh. Vivamus cursus purus non ante placerat aliquam. Mauris ac justo at nisl rutrum tempor. Nam ex dolor, mattis et iaculis sit amet, commodo id mauris. Mauris nisl enim, faucibus vel arcu eleifend, molestie dignissim velit. Duis vel mollis lectus, at vestibulum diam. Donec sed lorem dui. Nam in convallis mi. Duis nec feugiat libero. Nullam eu hendrerit dolor.</p>\r\n<p>Vivamus vulputate augue sed turpis tempor, et blandit nisi lacinia. Aliquam ac viverra nisl. Sed id justo at quam sollicitudin ullamcorper sit amet in lacus. Ut sagittis tellus nec turpis mollis, id posuere lectus gravida. Etiam in mi sem. Nulla mollis efficitur sem, sed varius sapien lacinia at. Nulla leo erat, tristique vel aliquet quis, lacinia vitae mi. Nunc bibendum viverra ipsum at cursus.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Quisque ullamcorper arcu bibendum lorem posuere tempor. Ut ac gravida augue, posuere ultricies nunc. Nam dapibus ac dolor sed malesuada. Sed et porttitor massa. Vestibulum vehicula in ligula ut congue. Nulla lectus tortor, elementum vel odio id, hendrerit rutrum elit. Vestibulum at ornare ex. Fusce arcu mi, vestibulum eget convallis posuere, suscipit et purus. Nunc lorem urna, dictum at tincidunt id, ullamcorper vel felis. Quisque vel dictum purus. Quisque sit amet condimentum lectus, at placerat purus. Vestibulum sed lacinia lacus.</p>\r\n</div>', '08/15/2016 14:14:36', 0, 0, 0, 0, '08/17/2016 12:02:05', 4);

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `id` int(11) NOT NULL,
  `user_token` text NOT NULL,
  `friend_token` text NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `demand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`id`, `user_token`, `friend_token`, `added_date`, `demand_id`) VALUES
(26, '240968378a5ccef445239c655c068060', 'ab5cfc9f893c62bb17d3e6510f6a0a62', '08/11/2016 22:34:25', 19),
(27, 'ab5cfc9f893c62bb17d3e6510f6a0a62', '240968378a5ccef445239c655c068060', '08/11/2016 22:34:25', 19),
(28, '30dff571ce0d0a607b20d9da992e3cd3', '240968378a5ccef445239c655c068060', '08/16/2016 17:01:53', 20),
(29, '240968378a5ccef445239c655c068060', '30dff571ce0d0a607b20d9da992e3cd3', '08/16/2016 17:01:53', 20);

-- --------------------------------------------------------

--
-- Table structure for table `friendship_demands`
--

CREATE TABLE `friendship_demands` (
  `id` int(11) NOT NULL,
  `user_token` text NOT NULL,
  `target_token` text NOT NULL,
  `accepted` int(11) NOT NULL,
  `refused` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendship_demands`
--

INSERT INTO `friendship_demands` (`id`, `user_token`, `target_token`, `accepted`, `refused`) VALUES
(18, '30dff571ce0d0a607b20d9da992e3cd3', '240968378a5ccef445239c655c068060', 1, 0),
(19, 'ab5cfc9f893c62bb17d3e6510f6a0a62', '240968378a5ccef445239c655c068060', 1, 0),
(20, '240968378a5ccef445239c655c068060', '30dff571ce0d0a607b20d9da992e3cd3', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `author_token` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `target_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `author_token`, `author_id`, `target_token`) VALUES
(34, '30dff571ce0d0a607b20d9da992e3cd3', 3, '240968378a5ccef445239c655c068060'),
(36, 'ab5cfc9f893c62bb17d3e6510f6a0a62', 2, 'ab5cfc9f893c62bb17d3e6510f6a0a62'),
(40, '240968378a5ccef445239c655c068060', 1, '30dff571ce0d0a607b20d9da992e3cd3'),
(41, '240968378a5ccef445239c655c068060', 1, 'ab5cfc9f893c62bb17d3e6510f6a0a62'),
(44, '240968378a5ccef445239c655c068060', 1, '240968378a5ccef445239c655c068060');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `author_token` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `author_token` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `target_token` text NOT NULL,
  `content` text NOT NULL,
  `_topic_id` int(11) DEFAULT NULL,
  `_room_id` int(11) DEFAULT NULL,
  `_profile_token` text,
  `added_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `author_token`, `author_id`, `target_token`, `content`, `_topic_id`, `_room_id`, `_profile_token`, `added_date`) VALUES
(2, '240968378a5ccef445239c655c068060', 1, '30dff571ce0d0a607b20d9da992e3cd3', 'a accepté votre demande d\'ami', NULL, NULL, '240968378a5ccef445239c655c068060', '08/10/2016 17:00:26'),
(3, '240968378a5ccef445239c655c068060', 1, '30dff571ce0d0a607b20d9da992e3cd3', 'a apprécier votre profil', NULL, NULL, '240968378a5ccef445239c655c068060', '08/16/2016 17:00:56'),
(8, '30dff571ce0d0a607b20d9da992e3cd3', 3, '240968378a5ccef445239c655c068060', 'a posté un réponse sur votre topic', 8, NULL, NULL, '08/16/2016 20:22:57'),
(9, '240968378a5ccef445239c655c068060', 1, 'ab5cfc9f893c62bb17d3e6510f6a0a62', 'a apprécier votre profil', NULL, NULL, '240968378a5ccef445239c655c068060', '08/18/2016 16:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `retros`
--

CREATE TABLE `retros` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retros`
--

INSERT INTO `retros` (`id`, `title`, `code`) VALUES
(1, 'Adow', 'ADW'),
(2, 'AdoHotel', 'ADH'),
(3, 'Habbo-Alpha', 'HAL'),
(4, 'HabboBeta', 'HBE'),
(5, 'HabboCity', 'HCI'),
(6, 'HabboLove', 'HLO'),
(7, 'Habbi', 'HBI'),
(8, 'Habbix', 'HBX'),
(9, 'PlusHabbo', 'PHA'),
(10, 'Jabbo', 'JBO'),
(11, 'MeetHabbo', 'MHB');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `maintenance` int(11) NOT NULL,
  `register_close` int(11) NOT NULL,
  `version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `maintenance`, `register_close`, `version`) VALUES
(1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topic_views`
--

CREATE TABLE `topic_views` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic_views`
--

INSERT INTO `topic_views` (`id`, `topic_id`, `hits`) VALUES
(1, 1, 250),
(2, 2, 58),
(3, 3, 2),
(4, 4, 2),
(5, 5, 3),
(6, 6, 5),
(7, 7, 1),
(8, 8, 18),
(9, 9, 3),
(10, 10, 10),
(11, 19, 2),
(12, 18, 1),
(13, 17, 1),
(14, 26, 4),
(15, 25, 1),
(16, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `retro` varchar(255) NOT NULL,
  `mood` int(11) NOT NULL,
  `humor` text NOT NULL,
  `avatar` text NOT NULL,
  `background` text NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  `evolution` int(11) NOT NULL,
  `ban` int(11) NOT NULL,
  `validate` int(11) NOT NULL,
  `token` text NOT NULL,
  `connection` int(11) NOT NULL,
  `textamigo` int(11) NOT NULL,
  `coins` int(11) NOT NULL,
  `ducks` int(11) NOT NULL,
  `ban_time` varchar(255) DEFAULT NULL,
  `ban_raison` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `email`, `retro`, `mood`, `humor`, `avatar`, `background`, `added_date`, `rank`, `evolution`, `ban`, `validate`, `token`, `connection`, `textamigo`, `coins`, `ducks`, `ban_time`, `ban_raison`) VALUES
(1, 'Wanka', '335b392d5d0d07da14b04342605d55e8', 'retrocode@gmail.com', 'MHB', 1, 'Nouveau sur MeetHabbo!', '9f8f0c1919853ec1d9ce20b9640c29b6.png', '43b388ad2e54366a8dbd36b139d46d19.png', '07/27/2016 16:55:52', 10, 5, 0, 1, '240968378a5ccef445239c655c068060', 1, 1, 500000, 500, NULL, NULL),
(2, 'Delph', '335b392d5d0d07da14b04342605d55e8', 'delph@gmail.com', 'PHA', 1, 'Nouveau sur MeetHabbo!', '65151942a1a7401a9d7e3f1e62261f1f.png', 'default_user_background.png', '07/29/2016 00:08:27', 1, 5, 0, 1, 'ab5cfc9f893c62bb17d3e6510f6a0a62', 1, 1, 500, 0, NULL, NULL),
(3, 'MiceElf', '335b392d5d0d07da14b04342605d55e8', 'flought@gmail.com', 'HBE', 1, 'Nouveau sur MeetHabbo!', 'default_user_avatar.png', 'default_user_background.png', '08/07/2016 02:34:21', 1, 5, 1, 1, '30dff571ce0d0a607b20d9da992e3cd3', 1, 1, 500, 0, '08/18/2016 01:51:39', 'Veuillez respecter les r&amp;egrave;gles du forum et ne pas insulter de membres'),
(4, 'Bot', '335b392d5d0d07da14b04342605d55e8', 'bot@gmail.com', 'MHB', 1, 'Nouveau sur MeetHabbo!', 'default_user_avatar.png', 'default_user_background.png', '08/14/2016 10:51:43', 1, 5, 0, 1, 'e549ec6d693e56a42bd789156d89e152', 1, 1, 500, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badges_membership`
--
ALTER TABLE `badges_membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badges_worn`
--
ALTER TABLE `badges_worn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_animations`
--
ALTER TABLE `forum_animations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_forums`
--
ALTER TABLE `forum_forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_replies`
--
ALTER TABLE `forum_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendship_demands`
--
ALTER TABLE `friendship_demands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retros`
--
ALTER TABLE `retros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic_views`
--
ALTER TABLE `topic_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `badges_membership`
--
ALTER TABLE `badges_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `badges_worn`
--
ALTER TABLE `badges_worn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forum_animations`
--
ALTER TABLE `forum_animations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_forums`
--
ALTER TABLE `forum_forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `forum_replies`
--
ALTER TABLE `forum_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `friendship_demands`
--
ALTER TABLE `friendship_demands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `retros`
--
ALTER TABLE `retros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `topic_views`
--
ALTER TABLE `topic_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
