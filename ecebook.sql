-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 20 Mars 2023 à 22:52
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `idm` int(10) NOT NULL AUTO_INCREMENT,
  `idenvoyeur` int(4) NOT NULL,
  `idreceveur` int(4) NOT NULL,
  `date` datetime NOT NULL,
  `texte` varchar(500) NOT NULL,
  PRIMARY KEY (`idm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `type` varchar(20) NOT NULL,
  `like` int(4) NOT NULL,
  `dislike` int(4) NOT NULL,
  `vu` int(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `mdp` varchar(30) NOT NULL,
  `naissance` date NOT NULL,
  `promo` varchar(30) DEFAULT NULL,
  `pp` varchar(255) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `interet` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idu`, `nom`, `pnom`, `grade`, `mail`, `mdp`, `naissance`, `promo`, `pp`, `ville`, `descrip`, `interet`) VALUES
(13, 'Novier', 'Nathan', 1, 'nathannovier@gmail.com', 'mdp', '2002-01-13', 'BS2', NULL, 'Melun', 'J''aime coder en légende et beaucoup de choses comme par exemple j''aime le fait de ratio léo c''est vraiment mon plaisir ultime', 'Ratio léo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
