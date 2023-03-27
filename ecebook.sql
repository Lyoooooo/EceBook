-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 27 mars 2023 à 13:39
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecebook`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ami`
--

INSERT INTO `ami` (`ida`, `idu1`, `idu2`, `valide`) VALUES
(1, 7, 8, 1),
(2, 7, 9, 1),
(3, 7, 5, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idm`, `idenvoyeur`, `idreceveur`, `dates`, `texte`) VALUES
(1, 8, 7, '2023-03-24 10:28:45', 'bonjour'),
(2, 9, 7, '2023-03-24 10:28:45', 'salut'),
(3, 5, 7, '2023-03-24 10:28:45', 'wawawwawawawa');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `idp` int(4) NOT NULL AUTO_INCREMENT,
  `idu` int(4) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `typep` varchar(20) NOT NULL,
  `likes` int(4) NOT NULL,
  `dislike` int(4) NOT NULL,
  `vu` int(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idp`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`idp`, `idu`, `titre`, `texte`, `photo`, `typep`, `likes`, `dislike`, `vu`, `date`) VALUES
(1, 5, 'Test général', 'ceci est un test', 'images/post/5-test.jpg', 'Général', 0, 0, 0, '2023-03-27 12:44:31'),
(3, 7, 'test actualité', 'actualité', 'images/post/7-Capture d\'écran_20230121_174356.png', 'Actualité', 0, 0, 0, '2023-03-27 13:37:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idu`, `nom`, `pnom`, `grade`, `mail`, `mdp`, `naissance`, `statut`, `promo`, `pp`, `ville`, `descrip`, `interet`) VALUES
(5, 'date', 'après', 0, 'test@edu.ece.fr', 'd1adb64a70b15919a98d54564e3d1da0', '4567-04-23', 'Elève', 'ING1', '', 'qszw', 'ghjklghjklsddddddddddddddddz', 'tyhjklxxxddddddddd'),
(7, 'super', 'toto', 0, 'toto@edu.ece.fr', '3a2202a372c7ccfbb9ffed294535a968', '2023-03-09', 'Elève', 'ING5', '', 'paris', 'description', 'waaaa'),
(8, 'super', 'tata', 0, 'tata@edu.ece.fr', '855c3b863224b09f443f3d244062069f', '2023-03-05', 'Elève', 'ING2', '', 'paris', 'wawaawawaw', 'wowowowowwowwo'),
(9, 'tro', 'tro', 0, 'trotro@edu.ece.fr', 'ef127c7e76331ef865222d60e9b66f5e', '2023-02-28', 'Elève', 'B3', '', 'paris', 'trotrotrotrotro', 'wawawawawawwawawwawawawawa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
