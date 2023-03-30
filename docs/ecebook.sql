-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Mars 2023 à 10:19
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ecebook`
--
CREATE DATABASE IF NOT EXISTS `ecebook` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecebook`;

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

DROP TABLE IF EXISTS `ami`;
CREATE TABLE IF NOT EXISTS `ami` (
  `ida` int(11) NOT NULL AUTO_INCREMENT,
  `idu1` int(11) NOT NULL,
  `idu2` int(11) NOT NULL,
  `valide` int(11) NOT NULL,
  PRIMARY KEY (`ida`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Contenu de la table `ami`
--

INSERT INTO `ami` (`ida`, `idu1`, `idu2`, `valide`) VALUES
(56, 4, 2, 1),
(57, 4, 3, 1),
(58, 4, 6, 1),
(59, 4, 7, 1),
(60, 4, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `jaime`
--

DROP TABLE IF EXISTS `jaime`;
CREATE TABLE IF NOT EXISTS `jaime` (
  `idj` int(11) NOT NULL AUTO_INCREMENT,
  `idp` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `ld` int(11) NOT NULL,
  PRIMARY KEY (`idj`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idm` int(11) NOT NULL AUTO_INCREMENT,
  `idenvoyeur` int(11) NOT NULL,
  `idreceveur` int(11) NOT NULL,
  `dates` datetime NOT NULL,
  `texte` varchar(500) NOT NULL,
  PRIMARY KEY (`idm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`idm`, `idenvoyeur`, `idreceveur`, `dates`, `texte`) VALUES
(3, 4, 2, '2023-03-30 09:59:49', 'Salut'),
(4, 2, 4, '2023-03-30 10:00:00', 'Salut'),
(5, 4, 2, '2023-03-30 10:00:18', 'Ca va ?'),
(6, 2, 4, '2023-03-30 10:02:27', 'Bien et toi je passe ma soutenance là'),
(8, 4, 9, '2023-03-30 10:01:33', 'Monsieur je serai pas là demain'),
(9, 9, 4, '2023-03-30 10:02:33', 'Je note merci bien');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `idp` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `typep` varchar(20) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `vu` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`idp`, `idu`, `titre`, `texte`, `photo`, `typep`, `likes`, `dislike`, `vu`, `date`) VALUES
(1, 8, 'Découverte des dernières avancées en mathématiques', 'Bonjour à tous ! Je suis Émilie Martin, professeure de mathématiques et programmation informatique à l''ECE Paris. Je suis ravie de retrouver mes élèves pour cette nouvelle année scolaire et de leur faire découvrir les dernières avancées dans ces domaines passionnants', NULL, 'Général', 19, 0, 95, '2023-03-15 08:13:18'),
(2, 9, 'Deux élèves de physique sélectionnés pour un concours international', 'Bonjour à tous ! Je suis Stéphane Moreau, professeur de physique à l''ECE Paris. Je suis très fier de mes deux élèves qui ont été sélectionnés pour participer à un concours international de sciences. Leur travail acharné et leur détermination ont porté leurs fruits. Bravo à eux !', 'images/post/9-physique.png', 'Actualité', 0, 0, 98, '2023-03-24 13:37:22'),
(3, 10, 'Voyage d''étude à la Silicon Valley', 'Bonjour à tous ! Je suis Antoine Lecomte, professeur d''informatique à l''ECE Paris. J''ai le plaisir d''accompagner mes élèves de deuxième année lors d''un voyage d''étude à la Silicon Valley en janvier prochain. Nous aurons l''opportunité de visiter les plus grandes entreprises de technologie et de découvrir les dernières innovations en matière de développement logiciel. Je suis impatient de partager cette expérience avec vous tous !', 'images/post/10-silicon.jpg', 'Général', 16, 0, 95, '2023-03-21 16:17:12'),
(4, 11, 'Conférence sur les dernières avancées en intelligence artificielle', 'Salut à tous ! Je suis Jules Girard, étudiant en informatique à l''ECE Paris. La semaine dernière, nous avons assisté à une conférence sur les dernières avancées en intelligence artificielle et j''ai été impressionné par la pertinence des sujets abordés. C''est génial d''étudier dans une école qui est à la pointe de la technologie !', NULL, 'Général', 0, 0, 98, '2023-03-14 11:19:09'),
(5, 12, 'Soirée théâtre à l''ECE Paris', 'Salut à tous ! Je suis Louise Lambert, étudiante en sciences humaines à l''ECE Paris. Je voulais partager avec vous une soirée théâtre qui sera organisée par l''école la semaine prochaine. Rejoignez nous à la cafétaria pour plus d''informations ! ', 'images/post/12-soiree.jpg', 'Evénement', 12, 1, 90, '2023-03-29 09:27:21'),
(7, 7, 'Création d''un site', 'Je suis en train de travailler sur ce site', NULL, 'Général', 0, 3, 107, '2023-03-29 02:31:08'),
(12, 9, 'L''ECE Paris annonce un partenariat avec l''entreprise XYZ', 'L''ECE Paris est fière d''annoncer un partenariat stratégique avec l''entreprise XYZ. Ce partenariat permettra à nos étudiants de travailler sur des projets de recherche innovants et de bénéficier d''une expérience pratique avec des professionnels de l''industrie.', 'images/post/9-1200px-.xyz_logo.svg.png', 'Actualité', 0, 0, 8, '2023-03-30 10:05:20'),
(13, 9, 'L''ECE Paris inaugure un nouveau laboratoire de recherche', 'L''ECE Paris a inauguré récemment un nouveau laboratoire de recherche, équipé des dernières technologies pour faciliter les travaux de recherche de nos professeurs et de nos étudiants. Nous sommes impatients de voir les découvertes qui en résulteront.\n\n\n\n', 'images/post/9-FabLab_ECE_Paris.jpg', 'Actualité', 0, 0, 6, '2023-03-15 10:06:19'),
(14, 9, 'Un élève de l''ECE Paris remporte un prix prestigieux pour son projet innovant', 'Félicitations à notre élève de l''ECE Paris, qui a remporté le premier prix lors d''un concours national pour son projet innovant. Son travail acharné et sa créativité sont un exemple de l''excellence que nous visons chez nos élèves.\n\n', NULL, 'Général', 0, 0, 6, '2023-03-30 10:07:07'),
(15, 6, 'Quelqu''un a-t-il pris le cours de M. Dupont l''année dernière ?\n', 'Salut tout le monde, je me demandais si quelqu''un avait déjà suivi le cours de M. Dupont l''année dernière et si vous avez des conseils pour réussir dans sa classe. Merci d''avance !', NULL, 'Général', 0, 0, 3, '2023-02-17 10:07:34'),
(16, 11, 'Quels sont les clubs et les associations les plus actifs à l''ECE ?\r\n', 'Je suis nouveau à l''ECE Paris et j''aimerais savoir quels sont les clubs et les associations les plus actifs sur le campus. J''aimerais m''impliquer dans la vie étudiante et rencontrer des gens qui partagent mes intérêts.\r\n\r\n', NULL, 'Général', 0, 0, 3, '2023-01-30 10:07:34'),
(17, 11, 'Qui est partant pour un tournoi de football ?\r\n', 'Salut tout le monde, je suis à la recherche de personnes intéressées pour former une équipe de football et participer à un tournoi sur le campus. Si vous êtes partants, laissez un commentaire ou envoyez-moi un message privé \n', NULL, 'Général', 0, 0, 3, '2023-03-28 17:07:34'),
(18, 10, 'Journée portes ouvertes à l''ECE Paris\r\n', 'L''ECE Paris organise une journée portes ouvertes le samedi 15 avril de 10h à 17h. Venez découvrir notre campus, rencontrer nos enseignants et étudiants, et en apprendre davantage sur nos programmes d''études en ingénierie. Inscrivez-vous dès maintenant sur notre site web !', 'images.post/ece-2022-classement-eduniversal-bachelor-devweb-750x750-1.png', 'Evénement', 0, 0, 2, '2023-03-08 17:07:34'),
(19, 10, 'Conférence sur l''innovation technologique', ' département d''ingénierie de l''ECE Paris organise une conférence sur l''innovation technologique le mercredi 22 mars à 18h dans l''amphithéâtre principal. Les intervenants invités discuteront des dernières tendances en matière d''innovation technologique, des défis à relever, et des opportunités pour les ingénieurs. Ne manquez pas cette occasion de vous informer et de rencontrer des professionnels du secteur !', NULL, 'Evénement', 0, 0, 2, '2023-03-10 12:07:34'),
(20, 8, 'Soirée de clôture de l''année universitaire', 'L''association étudiante de l''ECE Paris organise une soirée de clôture de l''année universitaire le vendredi 30 juin à partir de 20h dans la salle de réception de l''école. Venez célébrer la fin des examens et des projets avec vos camarades de classe et profitez d''une soirée animée avec musique, danse et bonne humeur. Les billets sont en vente à la cafétéria de l''école !\r\n\r\n', NULL, 'Evénement', 0, 0, 2, '2023-01-20 12:07:34'),
(21, 8, 'Visite d''une entreprise de haute technologie', 'Le département de génie électrique de l''ECE Paris organise une visite d''une entreprise de haute technologie le mercredi 17 mai de 9h à 12h. Les étudiants auront l''occasion de visiter les installations de l''entreprise, de rencontrer des ingénieurs et des responsables de projet, et d''en apprendre davantage sur les projets en cours. Les places sont limitées, alors inscrivez-vous rapidement auprès de votre professeur !\r\n', 'images/post/8-fb-visite-entreprise-2.1572682.jpg', 'Evénement', 0, 0, 2, '2023-02-12 12:07:34'),
(22, 7, 'Petit message d''amour', 'La soutenance va bien se passer !', 'images/post/EC1D8yaXUAAALVT.png', 'Général', 200, 0, 203, '2023-03-30 13:07:34');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idu` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `pnom` varchar(30) NOT NULL,
  `grade` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `naissance` date NOT NULL,
  `statut` varchar(15) NOT NULL,
  `promo` varchar(30) DEFAULT NULL,
  `pp` varchar(255) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `interet` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idu`, `nom`, `pnom`, `grade`, `mail`, `mdp`, `naissance`, `statut`, `promo`, `pp`, `ville`, `descrip`, `interet`) VALUES
(1, 'ADMIN', 'ENOW', 4, 'admin@edu.ece.fr', '9d8769d4dfa0cabc75d053523742e004', '1111-11-11', '1', NULL, 'images/pp/pp-admin.jpg', 'Melun', NULL, NULL),
(2, 'Pereira', 'Mattéo', 1, 'matteo.pereira@edu.ece.fr', '9ace87481ada3565e4e24c2b89b9092b', '1111-11-11', '1', 'B2', 'images/pp/pp-sus.png', NULL, NULL, NULL),
(3, 'Reminiac', 'Audran', 1, 'audran.reminiac@edu.ece.fr', '6bf31b7ac34e4631e4f9ee3b1e51358e', '1111-11-11', '1', 'B2', 'images/pp/pp-sus.png', NULL, NULL, NULL),
(4, 'Triffault', 'Léo', 1, 'leo.triffault@edu.ece.fr', '450c250c22a0948bec38242eb3634545', '1111-11-11', '1', 'B2', 'images/pp/pp-sus.png', 'Paris', 'J''aime coder toute la nuit', NULL),
(5, 'Kouassi', 'Julie', 1, 'julie.kouassi@edu.ece.fr', 'cccefb9821c5e5f4a4976bbba9ef033e', '1111-11-11', '1', 'B2', 'images/pp/pp-pink.jpg', NULL, NULL, NULL),
(6, 'Krekounian', 'Astrid', 1, 'astrid.krekounian@edu.ece.fr', '1e0fdd1d3e1603b07c1785919e07ab7b', '1111-11-11', '1', 'B2', 'images/pp/pp-pink.jpg', NULL, NULL, NULL),
(7, 'Novier', 'Nathan', 1, 'nathan.novier@edu.ece.fr', '787c2a6424b58efbb590d22107df542c', '1111-11-11', '1', 'B2', 'images/pp/pp-sus.png', 'Melun', 'Ratio léo omg ?', 'La data'),
(8, 'Laurent Martin', 'Émilie', 2, 'emilie.laurentmartin@omnesintervenant.com', 'a76cafb9bf6e8992148e096b60b1469d', '1975-02-10', '1', 'ING1', NULL, 'Versailles', 'Professeure de mathématiques passionnée par l''informatique et les nouvelles technologies.', 'Programmation, Voyages, Philosophie'),
(9, 'Moreau', 'Stéphane', 2, 'stephanie.moreau@omneseducation.com', 'f797d16e6da27fec6ce1e995b3a2f4c4', '1980-10-24', '1', 'ING4', NULL, 'Paris', 'Professeur de physique aimant partager sa passion pour les sciences avec ses élèves.', 'Cinéma, Musique, Voyages'),
(10, 'Lecomte', 'Antoine', 2, 'antoine.lecomte@omnesintervenant.com', 'e256b113f8cdb30fc24b59f48dddd28f', '1991-01-02', '1', 'B1', 'images/pp/pp-prof.jpg', 'Nanterre', 'Professeur d''informatique passionné par la création de jeux vidéo et la programmation.', 'Jeux vidéo, Programmation, Sports'),
(11, 'Girard', 'Jules', 1, 'jules.girard@edu.ece.fr', '9b4a80b0c2ba9dee00fed207a9e3dd97', '2002-04-23', '1', 'ING3', 'images/pp/pp-jules.jpg', 'Herblay', 'Étudiant en CPGE passionné par la musique et la lecture, souhaitant devenir ingénieur en informatique.\r\n', 'Musique, Lecture, Sports'),
(12, 'Lambert', 'Louise', 1, 'louise.lambert@edu.ece.fr', 'bd87fe843b36442059dabc7c790f4679', '2003-11-23', '1', 'ING2', NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
