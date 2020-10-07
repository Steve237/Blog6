-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 07 oct. 2020 à 19:33
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blogsnow`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `figure_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C5C011B5` (`figure_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `figures`
--

DROP TABLE IF EXISTS `figures`;
CREATE TABLE IF NOT EXISTS `figures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_figure` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `image_top` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ABF1009A7A45358C` (`groupe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `figures`
--

INSERT INTO `figures` (`id`, `nom_figure`, `description`, `groupe_id`, `image_top`, `updated_at`) VALUES
(151, 'Grabs', 'Les Grabs ce sont la base des figures du freestyle en Snowboard. C’est le mouvement d’aller attraper son snowboard avec une main ou deux. Ce sont des figures que l’on peut exécuter seules ou en combinaison avec des rotations.', 65, 'c0b199d73b-120515-lexique-snowboard-5f68e81c4fc0b409425152.jpg', '2020-09-21 17:51:24'),
(164, 'Cork', 'Un Cork, appellation tirée du mot anglais corkscrew signifiant « tire-bouchon », est une rotation horizontale dont l\'axe peut varier. Les meilleurs snowboardeurs réussissent des « Triple Cork ».', 68, 'how-to-cork-540-snowboard-800-5f7e040e8ae46486132127.jpg', '2020-10-07 18:08:13'),
(165, 'Mc Twist', 'Un McTwist est une figure en demi-lune dans lequel le pilote effectue une rotation et demie - se déplaçant vers l\'avant pour le décollage et l\'atterrissage.', 66, 'https-fansided-com-wp-content-uploads-getty-images-2018-02-916416334-snowboard-winter-olympics-day-1.jpg-5f7e060176798305811041.jpg', '2020-10-07 18:16:33'),
(166, 'One Foot', 'Effectuer une figure one foot consiste à retirer un des pieds de la fixation. Il faut ensuite tendre la jambe au maximum pour bien montrer la manœuvre aux juges.', 67, '3279ddf3b14a5e4f3dde2fb9a2821208-5f7e076597a9a237502867-5f7e07ad85af7368582811.jpg', '2020-10-07 18:23:41'),
(167, 'Backlip', 'Le backflip figure parmi les sauts les plus spectaculaires de cette discipline. Il nécessite la maîtrise des fondamentaux et d’une bonne perception du corps.', 66, 'frontflipknuckle-620x413-5f7e0c4b72033296976845.jpg', '2020-10-07 18:43:23'),
(168, 'Method Air', 'Un trick où le snowboarder saisit le bord du talon de la planche avec sa main arrière, entre ses pieds, puis tire la planche vers son dos, tout en cambrant le dos et en pliant les genoux.', 65, '95hh5e0c0tf11-5f7e11a5023ad858386787.jpg', '2020-10-07 19:06:12');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `libelle`) VALUES
(65, 'Air'),
(66, 'Flip'),
(67, 'One Foot'),
(68, 'Cork');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `image_figure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `figure_id` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045F5C011B5` (`figure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`image_figure`, `figure_id`, `updated_at`, `id`) VALUES
('d3b321ee66fbb32c72d1bd0e5c0d4513-5f7e040e856fe984395545.jpg', 164, '2020-10-07 18:08:13', 49),
('seb-toots-x-games-slopestyle-620x413-5f7e040e89ad5912140849.jpg', 164, '2020-10-07 18:08:13', 50),
('7096901-5f7e040e8a41b163976057.jpg', 164, '2020-10-07 18:08:13', 51),
('20100128-20100129-a12-sp29oexxmain.ap1_-5f7e060175d79722367159.jpg', 165, '2020-10-07 18:16:33', 52),
('3279ddf3b14a5e4f3dde2fb9a2821208-5f7e076597a9a237502867.jpg', 166, '2020-10-07 18:22:29', 53),
('748e20c877c4ab37f9b2a685fc5affb9-5f7e076598529770880166.jpg', 166, '2020-10-07 18:22:29', 54),
('how-to-backflip-snowboard-800-5f7e0c4b6f440258827281.jpg', 167, '2020-10-07 18:43:23', 55),
('fot-0010862976-1-5f7e0c4b7035e582828831.jpg', 167, '2020-10-07 18:43:23', 56),
('36117c47a3c950a5b7c1d1c7d7f3c31a-5f7e11a5011dd345649271.jpg', 168, '2020-10-07 19:06:12', 57),
('hqdefault-5f7e11a501b1a597578201.jpg', 168, '2020-10-07 19:06:12', 58);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200818165233', '2020-08-18 16:52:46'),
('20200818175231', '2020-08-18 17:52:45');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifpass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_token` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `verifpass`, `activation_token`, `reset_token`, `avatar`, `updated_at`, `roles`) VALUES
(15, 'salut', 'adouessono@yahoo.fr', '$argon2id$v=19$m=65536,t=4,p=1$YmdlWDFMbnB2dkFBNmZoNw$X3OFclAZitmL27JdGn3xny/iCkgcSLgojxccp+zRP8w', 'Espirito237!', NULL, NULL, 'snow.jpg', '0000-00-00 00:00:00', 'ROLE_USER'),
(22, 'salutmec', 'essonoadou@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$RE5xblk2a2FWUnFzWUIuZA$EPsG0vS2XP+Mgba3GWnodvAeHkvrg9ZKyW5t0PrTKEo', '$argon2id$v=19$m=65536,t=4,p=1$VkJVSEhSanhQWVJFWFphLg$yt+bh0fcar4YYQKYgAhK+uNi3R7fdek1zw5aYMFLHNE', NULL, NULL, 'C:\\wamp64\\tmp\\php31CF.tmp', '2020-09-21 19:33:16', 'ROLE_USER'),
(43, 'Espirito237', 'franckngba@yahoo.com', '$argon2id$v=19$m=65536,t=4,p=1$bE5KS0g2blNZeVNzRThMMg$QeR2THGhUydbnHWMZbiKxYKVB+Udyh8hwnqLCNQZ54k', '$argon2id$v=19$m=65536,t=4,p=1$bE5KS0g2blNZeVNzRThMMg$QeR2THGhUydbnHWMZbiKxYKVB+Udyh8hwnqLCNQZ54k', NULL, NULL, 'bloodshotslider-5f715c3c75124679719638.jpg', '2020-09-28 03:44:59', 'ROLE_USER');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `figure_id` int(11) DEFAULT NULL,
  `video_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2C5C011B5` (`figure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `figure_id`, `video_name`) VALUES
(21, 76, 'Method.mp4'),
(32, 129, 'https://www.youtube.com/watch?v=Y3WibRW2Nmw');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figures` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `figures`
--
ALTER TABLE `figures`
  ADD CONSTRAINT `FK_ABF1009A7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figures` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2C5C011B5` FOREIGN KEY (`figure_id`) REFERENCES `figures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
