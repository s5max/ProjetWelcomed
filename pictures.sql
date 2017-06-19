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
