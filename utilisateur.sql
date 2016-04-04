-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Mars 2016 à 17:42
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `vin`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `id_droit` int(2) NOT NULL,
  `nom_user` varchar(100) NOT NULL,
  `prenom_user` varchar(100) NOT NULL,
  `mail_user` varchar(100) NOT NULL,
  `mdp_user` varchar(100) NOT NULL,
  `photo_user` varchar(100) NOT NULL,
  `code_recup_user` varchar(6) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_droit` (`id_droit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `id_droit`, `nom_user`, `prenom_user`, `mail_user`, `mdp_user`, `photo_user`, `code_recup_user`) VALUES
(1, 1, 'Sozza', 'Marc', 'marc.sozza@gmail.com', 'qjsfddklhqsh', '/photo/profil.png', ''),
(2, 1, 'Kun', 'Yannick', 'YannickLaMalice@gmail.com', 'qjsfddklhqsh', '/photo/profil.png', ''),
(3, 1, 'Lajoux', 'Clément', 'ClémentLajoux@gmail.com', 'slqdkjffsdjlk', '/photo/photo.png', ''),
(4, 1, 'Raimondi', 'Jordan', 'raimondi.jordan.57@gmail.com', '1234', '/photo/photo.png', '756813');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_droit`) REFERENCES `type_droit` (`id_droit`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

