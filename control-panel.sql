-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Nov 2015 um 16:35
-- Server Version: 5.6.14
-- PHP-Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `vio_extended`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `changelog`
--
DROP TABLE IF EXISTS `cp_changelog`;
CREATE TABLE `cp_changelog` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Date` varchar(255) NOT NULL,
  `msg` longtext NOT NULL,
  `user` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tabellenstruktur für Tabelle `cp_bank`
--
DROP TABLE IF EXISTS `cp_bank`;
CREATE TABLE IF NOT EXISTS `cp_bank` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `absender` varchar(255) NOT NULL,
  `empfanger` varchar(255) NOT NULL,
  `betrag` double NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


--
-- Tabellenstruktur für Tabelle `cp_ticket`
--
DROP TABLE IF EXISTS `cp_ticket`;
CREATE TABLE IF NOT EXISTS `cp_ticket` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `isclosed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Tabellenstruktur für Tabelle `cp_ticket_ans`
--
DROP TABLE IF EXISTS `cp_ticket_ans`;
CREATE TABLE IF NOT EXISTS `cp_ticket_ans` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
