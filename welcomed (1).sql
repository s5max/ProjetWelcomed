-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 19 Juin 2017 à 18:30
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `welcomed`
--
CREATE DATABASE IF NOT EXISTS `welcomed` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `welcomed`;

-- --------------------------------------------------------

--
-- Structure de la table `ad`
--

CREATE TABLE `ad` (
  `id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ad_message`
--

CREATE TABLE `ad_message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `object` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `seen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `city`
--

INSERT INTO `city` (`id`, `zipcode`, `name`) VALUES
(1, '', 'Ajoupa Bouillon'),
(2, '', 'Anse d\'Arlets'),
(3, '', 'Basse Pointe'),
(4, '', 'Carbet'),
(5, '', 'Case Pilote'),
(6, '', 'Diamant'),
(7, '', 'Ducos'),
(8, '', 'Fond Saint Denis'),
(9, '', 'Fort de France'),
(10, '', 'François'),
(11, '', 'Gros Morne'),
(12, '', 'Lamentin'),
(13, '', 'Lorrain'),
(14, '', 'Macouba'),
(15, '', 'Marigot'),
(16, '', 'Marin'),
(17, '', 'Morne Rouge'),
(18, '', 'Morne Vert'),
(19, '', 'Précheur'),
(20, '', 'Rivière Pilote'),
(21, '', 'Rivière Salée'),
(22, '', 'Robert'),
(23, '', 'Saint Anne'),
(24, '', 'Saint ESprit'),
(25, '', 'Saint Joseph'),
(26, '', 'Saint Luce'),
(27, '', 'Sainte Marie'),
(28, '', 'Saint Pierre'),
(29, '', 'Schoelcher'),
(30, '', 'Trinité'),
(31, '', 'Trois Ilets'),
(32, '', 'Vauclin'),
(33, '', 'Vert-Pré');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `object` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `msgread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `kind` varchar(7) NOT NULL,
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `offer`
--

INSERT INTO `offer` (`id`, `kind`, `type`) VALUES
(1, 'offre', 'assistanat'),
(2, 'offre', 'cession'),
(3, 'offre', 'remplacement'),
(4, 'offre', 'salariat'),
(5, 'demande', 'assistanat'),
(6, 'demande', 'cession'),
(7, 'demande', 'remplacement'),
(8, 'demande', 'salariat');

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `img_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf32 NOT NULL,
  `description` text CHARACTER SET utf32 NOT NULL,
  `img_url` varchar(255) CHARACTER SET utf32 NOT NULL,
  `img_size` varchar(255) CHARACTER SET utf32 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`img_id`, `title`, `description`, `img_url`, `img_size`) VALUES
(1, 'Background 1', 'Image d\'arrière-plan du haut de la page d\'accueil', 'img_5943f80b2e34b.jpg', '> 1600 pixels de largeur'),
(2, 'Background 2', 'Image d\'arrière-plan du milieu de la page d\'accueil', '78e7e3_4fb0cc53ed464a4eb830af125643983c-mv2.jpeg', '> 1600 pixels de largeur'),
(3, 'Miniature Médecin', 'Miniature du métier Médecin', 'img_5943f135eb993.jpg', '708 x 472 pixels'),
(4, 'Miniature Kiné', 'Miniature du métier Kinésithérapeute', 'pic-kiné.jpg', '708 x 472 pixels'),
(5, 'Miniature Infirmier', 'Miniature du métier Infirmier(e)', 'pic-nurse.jpg', '708 x 472 pixels'),
(6, 'Miniature Orthophoniste', 'Miniature du métier Orthophoniste', 'pic-ortho.jpg', '708 x 472 pixels'),
(7, 'Miniature Podologue', 'Miniature du métier Podologue', 'pic-podo.jpg', '708 x 472 pixels'),
(8, 'Miniature Dentiste', 'Miniature du métier Chirurgien-dentiste', 'pic-dentist.png', '708 x 472 pixels'),
(9, 'Image Welcomed Community', 'Miniature de la Welcommed Community', 'wmcommunity.jpg', '708 x 472 pixels');

-- --------------------------------------------------------

--
-- Structure de la table `profession`
--

CREATE TABLE `profession` (
  `id` int(11) NOT NULL,
  `speciality` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `profession`
--

INSERT INTO `profession` (`id`, `speciality`) VALUES
(1, 'Chirurgien-Dentiste'),
(2, 'Infirmier/Infirmière'),
(3, 'Kinésithérapeute'),
(4, 'Médecin'),
(5, 'Orthophoniste'),
(6, 'Osthéopate'),
(7, 'Podologue');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `profession_id` int(11) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `wm_role` varchar(5) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ad_message`
--
ALTER TABLE `ad_message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ad`
--
ALTER TABLE `ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ad_message`
--
ALTER TABLE `ad_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `profession`
--
ALTER TABLE `profession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;