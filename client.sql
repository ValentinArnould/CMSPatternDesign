-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `CP` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `client` (`id`, `Nom`, `Prenom`, `Age`, `Telephone`, `Adresse`, `CP`) VALUES
(1,	'Dupont',	'Jacky',	89,	'612345678',	'432 Rue du DoomHammer',	69000),
(2,	'Ramirez',	'Michel',	54,	'645789652',	'23 avenue du portuaire',	56120);

-- 2018-10-25 07:22:27
