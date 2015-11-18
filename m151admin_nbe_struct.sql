-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 18 Novembre 2015 à 13:56
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `m151admin_nbe`
--
CREATE DATABASE IF NOT EXISTS `m151admin_nbe` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `m151admin_nbe`;

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

DROP TABLE IF EXISTS `choix`;
CREATE TABLE IF NOT EXISTS `choix` (
  `idSport` int(11) NOT NULL,
  `idEleve` int(11) NOT NULL,
  `ordreOref` int(11) NOT NULL,
  PRIMARY KEY (`idSport`,`idEleve`),
  KEY `idSport` (`idSport`,`idEleve`),
  KEY `idEleve` (`idEleve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `IdClasse` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`IdClasse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

DROP TABLE IF EXISTS `sports`;
CREATE TABLE IF NOT EXISTS `sports` (
  `idSport` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idSport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) COLLATE utf8_bin NOT NULL,
  `pseudo` varchar(20) COLLATE utf8_bin NOT NULL,
  `motDePasse` varchar(40) COLLATE utf8_bin NOT NULL,
  `description` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `dateNaissance` date NOT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  `IdClasse` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`),
  KEY `IdClasse` (`IdClasse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `choix`
--
ALTER TABLE `choix`
  ADD CONSTRAINT `choix_ibfk_2` FOREIGN KEY (`idSport`) REFERENCES `sports` (`idSport`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `choix_ibfk_1` FOREIGN KEY (`idEleve`) REFERENCES `utilisateurs` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`IdClasse`) REFERENCES `classes` (`IdClasse`) ON DELETE NO ACTION ON UPDATE CASCADE;

GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'm151admin'@'127.0.0.1' IDENTIFIED BY PASSWORD '*CABF25F928B266544D7C72904827B9379F897F6F';

GRANT SELECT, INSERT, UPDATE, DELETE ON `m151admin\_nbe`.* TO 'm151admin'@'127.0.0.1';
  
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
