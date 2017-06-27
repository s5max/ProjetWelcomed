-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 27 Juin 2017 à 19:00
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
-- Structure de la table `ad_dialog`
--

CREATE TABLE `ad_dialog` (
  `ad_dialog_id` int(11) NOT NULL,
  `answer_sender` int(11) NOT NULL,
  `answer_receiver` int(11) NOT NULL,
  `answer_message` text NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `cv` varchar(255) NOT NULL,
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
-- Structure de la table `home_text`
--

CREATE TABLE `home_text` (
  `text_id` int(11) NOT NULL,
  `text_title` varchar(255) NOT NULL,
  `text_description` varchar(255) NOT NULL,
  `text_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `home_text`
--

INSERT INTO `home_text` (`text_id`, `text_title`, `text_description`, `text_content`) VALUES
(1, 'Titre', 'Titre du site', 'Welcomed'),
(2, 'Slogan', 'Slogan du site', 'Une expérience libérale sous le Soleil de Martinique'),
(3, 'Titre de la 2eme section', 'Welcomed Community', 'Welcomed Community'),
(4, 'Titre de description de la 2eme section', 'Welcomed Community ?', 'Qu\'est-ce que la Welcomed Community ?'),
(5, 'Paragraphe de la 2eme section', 'Description de la Welcomed Community\r\n', 'Bonjour bienvenue'),
(6, '2eme Paragraphe de la 2eme section (Si nécessaire)', 'Description de la Welcomed Community\r\n', 'Nemo animi soluta ratione quisquam, dicta ab cupiditate iure eaque? Repellendus voluptatum, magni impedit eaque delectus, beatae maxime temporibus maiores quibusdam quasi rem magnam ad perferendis iusto sint tempora.'),
(7, '3eme Paragraphe de la 2eme section (Si nécessaire)', 'Description de la Welcomed Community', 'Bénéficiez de réductions sur l\'hébergement, la restauration et bien d\'autres choses...'),
(8, 'Nom 1er témoignant', 'Nom du 1er témoignant', 'Antoine'),
(9, '1er témoignage', '1er témoignage', 'Pourquoi passer par différentes plateformes pour chercher ou diffuser ces informations si tout est disponible ici'),
(10, 'Nom 2eme témoignant', 'Nom du 2eme témoignant', 'Louise'),
(11, '2eme témoignage', '2eme témoignage', 'Louer un appart\' et une voiture, un mois en Martinique, ça peut revenir assez cher! Bénéficier des réductions de la Welcomed Community c\'est top !'),
(12, 'Nom 3eme témoignant', 'Nom du 3eme témoignant', 'Charlotte'),
(13, '3eme témoignage', '3eme témoignage', 'J\'ai posté une offre de remplacement sur les réseaux sociaux mais je devais régulièrement \"liker\" le post pour qu\'il soit bien vu... Avec Welcomed c\'est plus simple.');

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
-- Structure de la table `partnership`
--

CREATE TABLE `partnership` (
  `partner_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `partner` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `partner_link` varchar(255) NOT NULL,
  `partner_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Contenu de la table `partnership`
--

INSERT INTO `partnership` (`partner_id`, `name`, `partner`, `description`, `partner_link`, `partner_picture`) VALUES
(1, 'Publicité 1', 'Gites de France', 'Bénéficiez de réduction en rejoignant la Welcomed Community', 'https://www.gites-de-france.com/', 'img_595269f1237b6.png'),
(2, 'Publicité 2', 'Mr Bricolage', '', '', 'img_59526a1159bcc.jpg'),
(3, 'Publicité 3', 'Gites de France', '', 'https://www.gites-de-france.com/', 'img_594c5069727f6.png'),
(4, 'Publicité 4', '', '', '', '');

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
(1, 'Background 1', 'Image d\'arrière-plan du haut de la page d\'accueil', 'img_594b338b47477.jpg', '> 1600 pixels de largeur'),
(2, 'Background 2', 'Image d\'arrière-plan du milieu de la page d\'accueil', 'img_594b33933a10f.jpeg', '> 1600 pixels de largeur'),
(3, 'Miniature Médecin', 'Miniature du métier Médecin', 'pic-doc.jpg', '708 x 472 pixels'),
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
-- Index pour la table `home_text`
--
ALTER TABLE `home_text`
  ADD PRIMARY KEY (`text_id`);

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
-- Index pour la table `partnership`
--
ALTER TABLE `partnership`
  ADD PRIMARY KEY (`partner_id`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`img_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT pour la table `home_text`
--
ALTER TABLE `home_text`
  MODIFY `text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `partnership`
--
ALTER TABLE `partnership`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `profession`
--
ALTER TABLE `profession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
