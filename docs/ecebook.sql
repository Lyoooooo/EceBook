-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 29 Mars 2023 à 02:32
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
CREATE DATABASE IF NOT EXISTS `ecebook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ecebook`;

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

DROP TABLE IF EXISTS `ami`;
CREATE TABLE IF NOT EXISTS `ami` (
  `ida` int(5) NOT NULL AUTO_INCREMENT,
  `idu1` int(4) NOT NULL,
  `idu2` int(4) NOT NULL,
  `valide` int(1) NOT NULL,
  PRIMARY KEY (`ida`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Structure de la table `jaime`
--

DROP TABLE IF EXISTS `jaime`;
CREATE TABLE IF NOT EXISTS `jaime` (
  `idj` int(10) NOT NULL AUTO_INCREMENT,
  `idp` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `ld` int(11) NOT NULL
  PRIMARY KEY (`idj`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idm` int(10) NOT NULL AUTO_INCREMENT,
  `idenvoyeur` int(4) NOT NULL,
  `idreceveur` int(4) NOT NULL,
  `dates` datetime NOT NULL,
  `texte` varchar(500) NOT NULL,
  PRIMARY KEY (`idm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `idp` int(4) NOT NULL AUTO_INCREMENT,
  `idu` int(4) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `typep` varchar(20) NOT NULL,
  `likes` int(4) NOT NULL,
  `dislike` int(4) NOT NULL,
  `vu` int(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`idp`, `idu`, `titre`, `texte`, `photo`, `typep`, `likes`, `dislike`, `vu`, `date`) VALUES
(1, 8, 'Découverte des dernières avancées en mathématiques', 'Bonjour à tous ! Je suis Émilie Martin, professeure de mathématiques et programmation informatique à l''ECE Paris. Je suis ravie de retrouver mes élèves pour cette nouvelle année scolaire et de leur faire découvrir les dernières avancées dans ces domaines passionnants', NULL, 'Général', 0, 0, 0, '2023-03-15 08:13:18'),
(2, 9, 'Deux élèves de physique sélectionnés pour un concours international', 'Bonjour à tous ! Je suis Stéphane Moreau, professeur de physique à l''ECE Paris. Je suis très fier de mes deux élèves qui ont été sélectionnés pour participer à un concours international de sciences. Leur travail acharné et leur détermination ont porté leurs fruits. Bravo à eux !', 'images/post/9-physique.png', 'Actualité', 0, 0, 0, '2023-03-24 13:37:22'),
(3, 10, 'Voyage d''étude à la Silicon Valley', 'Bonjour à tous ! Je suis Antoine Lecomte, professeur d''informatique à l''ECE Paris. J''ai le plaisir d''accompagner mes élèves de deuxième année lors d''un voyage d''étude à la Silicon Valley en janvier prochain. Nous aurons l''opportunité de visiter les plus grandes entreprises de technologie et de découvrir les dernières innovations en matière de développement logiciel. Je suis impatient de partager cette expérience avec vous tous !', 'images/post/10-silicon.jpg', 'Général', 0, 0, 0, '2023-03-21 16:17:12'),
(4, 11, 'Conférence sur les dernières avancées en intelligence artificielle', 'Salut à tous ! Je suis Jules Girard, étudiant en informatique à l''ECE Paris. La semaine dernière, nous avons assisté à une conférence sur les dernières avancées en intelligence artificielle et j''ai été impressionné par la pertinence des sujets abordés. C''est génial d''étudier dans une école qui est à la pointe de la technologie !', NULL, 'Général', 0, 0, 0, '2023-03-14 11:19:09'),
(5, 12, 'Soirée théâtre à l''ECE Paris', 'Salut à tous ! Je suis Louise Lambert, étudiante en sciences humaines à l''ECE Paris. Je voulais partager avec vous une soirée théâtre qui sera organisée par l''école la semaine prochaine. Rejoignez nous à la cafétaria pour plus d''informations ! ', 'images/post/12-soiree.jpg', 'Evénement', 0, 0, 0, '2023-03-29 09:27:21'),
(7, 7, 'Création d''un site', 'Je suis en train de travailler sur ce site', NULL, 'Général', 0, 0, 0, '2023-03-29 02:31:08');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idu` int(4) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `pnom` varchar(30) NOT NULL,
  `grade` int(1) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idu`, `nom`, `pnom`, `grade`, `mail`, `mdp`, `naissance`, `statut`, `promo`, `pp`, `ville`, `descrip`, `interet`) VALUES
(1, 'ADMIN', 'ENOW', 4, 'admin@edu.ece.fr', '9d8769d4dfa0cabc75d053523742e004', '1111-11-11', '1', NULL, 'images/pp/pp-admin.jpg', 'Melun', NULL, NULL),
(2, 'Pereira', 'Mattéo', 1, 'matteo.pereira@edu.ece.fr', '9ace87481ada3565e4e24c2b89b9092b', '1111-11-11', '1', 'B2', 'images/pp/pp-sus.png', NULL, NULL, NULL),
(3, 'Reminiac', 'Audran', 1, 'audran.reminiac@edu.ece.fr', '6bf31b7ac34e4631e4f9ee3b1e51358e', '1111-11-11', '1', 'B2', 'images/pp/pp-sus.png', NULL, NULL, NULL),
(4, 'Triffault', 'Léo', 1, 'leo.triffault@edu.ece.fr', '450c250c22a0948bec38242eb3634545', '1111-11-11', '1', 'B2', 'images/pp/pp-sus.png', 'Paris', 'J''aime coder toute la nuit', NULL),
(5, 'Kouassi', 'Julie', 1, 'julie.kouassi@edu.ece.fr', 'cccefb9821c5e5f4a4976bbba9ef033e', '1111-11-11', '1', 'B2', 'images/pp/pp-pink.png', NULL, NULL, NULL),
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
