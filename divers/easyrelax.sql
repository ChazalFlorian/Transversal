-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 24 Mai 2015 à 21:18
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `easyrelax`
--
CREATE DATABASE IF NOT EXISTS `easyrelax` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `easyrelax`;

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Phone` varchar(45) NOT NULL,
  `Responsible` varchar(45) NOT NULL,
  `Adress` varchar(45) NOT NULL,
  `Mail` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `partners`
--

INSERT INTO `partners` (`ID`, `Name`, `Phone`, `Responsible`, `Adress`, `Mail`, `Password`, `Status`) VALUES
(1, 'lesPutesThai', '42', 'toto', '12 mange tes morts', 'pute@thai.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3 ', 'SAS'),
(2, 'lesPutesViet', '43', 'titi', '32 lopez de clermont', 'pute@viet.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3 ', 'SARL');

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE IF NOT EXISTS `rendezvous` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Service_ID` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`User_ID`,`Service_ID`,`Date`),
  KEY `fk_Rendez-Vous_Service1_idx` (`Service_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `rendezvous`
--

INSERT INTO `rendezvous` (`User_ID`, `Service_ID`, `Date`) VALUES
(2, 1, '2015-05-29 07:45:00'),
(1, 2, '2015-05-14 09:00:00'),
(1, 2, '2015-05-21 13:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Desc` varchar(45) NOT NULL,
  `Partner/Price` int(11) NOT NULL,
  `User/Price` int(11) NOT NULL,
  `Partner_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Partner_ID`),
  KEY `fk_Service_Partner1_idx` (`Partner_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `services`
--

INSERT INTO `services` (`ID`, `Name`, `Desc`, `Partner/Price`, `User/Price`, `Partner_ID`) VALUES
(1, 'massage Thai', 'proxenetisme', 20, 30, 1),
(2, 'massage viet', 'proxenetisme', 12, 16, 2);

-- --------------------------------------------------------

--
-- Structure de la table `service_is_related`
--

CREATE TABLE IF NOT EXISTS `service_is_related` (
  `Service_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Service_Partner_ID` int(11) NOT NULL,
  `Activity_ID` int(11) NOT NULL,
  PRIMARY KEY (`Service_ID`,`Service_Partner_ID`,`Activity_ID`),
  KEY `fk_Service_has_Activity_Activity1_idx` (`Activity_ID`),
  KEY `fk_Service_has_Activity_Service1_idx` (`Service_ID`,`Service_Partner_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `subcription`
--

CREATE TABLE IF NOT EXISTS `subcription` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `subcription`
--

INSERT INTO `subcription` (`ID`, `Name`, `Desc`) VALUES
(1, 'test1', 'testtesttesttest'),
(2, 'test2', NULL),
(3, 'test3', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `Mail` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Phone` varchar(45) NOT NULL,
  `Subcription_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Subcription_ID`),
  KEY `fk_User_Subcription_idx` (`Subcription_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`ID`, `Name`, `FirstName`, `Mail`, `Password`, `Phone`, `Subcription_ID`) VALUES
(1, 'test', 'test', 'toto@test.com', '76c5038c3bee6f6270a9e1815b87eb433fd89a75', '12', 2),
(2, 'test', 'test', 'test@toto.com', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', '1234567890', 1),
(3, 'test', 'test', 'test@toto.com', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', '1234567890', 1),
(4, 'test', 'test', 'test@toto.com', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', '1234567890', 1),
(5, 'test', 'test', 'test@toto.com', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', '1234567890', 1),
(6, 'test', 'test', 'test@toto.com', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', '1234567890', 1),
(7, 'test', 'test', 'test@toto.com', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', '1234567890', 1),
(8, 'tata', 'tesst', 'toto', 'f7e79ca8eb0b31ee4d5d6c181416667ffee528ed', '1333', 2),
(9, 'tata', 'tesst', 'toto', 'f7e79ca8eb0b31ee4d5d6c181416667ffee528ed', '1333', 2),
(10, 'Chazal', 'Florian', 'chazal.florian@gmail.com', 'a19806ed7d1bfed7d74bf24a0e2f9bfb48035a8c', '0645134497', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_has_interest`
--

CREATE TABLE IF NOT EXISTS `user_has_interest` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Subcription_ID` int(11) NOT NULL,
  `Activity_ID` int(11) NOT NULL,
  PRIMARY KEY (`User_ID`,`User_Subcription_ID`,`Activity_ID`),
  KEY `fk_User_has_Activity_Activity1_idx` (`Activity_ID`),
  KEY `fk_User_has_Activity_User1_idx` (`User_ID`,`User_Subcription_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `fk_Rendez-Vous_Service1` FOREIGN KEY (`Service_ID`) REFERENCES `services` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Rendez-Vous_User1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_Service_Partner1` FOREIGN KEY (`Partner_ID`) REFERENCES `partners` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `service_is_related`
--
ALTER TABLE `service_is_related`
  ADD CONSTRAINT `fk_Service_has_Activity_Activity1` FOREIGN KEY (`Activity_ID`) REFERENCES `activity` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Service_has_Activity_Service1` FOREIGN KEY (`Service_ID`, `Service_Partner_ID`) REFERENCES `services` (`ID`, `Partner_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_User_Subcription` FOREIGN KEY (`Subcription_ID`) REFERENCES `subcription` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_has_interest`
--
ALTER TABLE `user_has_interest`
  ADD CONSTRAINT `fk_User_has_Activity_Activity1` FOREIGN KEY (`Activity_ID`) REFERENCES `activity` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Activity_User1` FOREIGN KEY (`User_ID`, `User_Subcription_ID`) REFERENCES `users` (`ID`, `Subcription_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
