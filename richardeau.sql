-- Adminer 4.8.1 MySQL 5.5.5-10.5.21-MariaDB-0+deb11u1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `jouer`;
CREATE TABLE `jouer` (
  `IDROOM` int(11) NOT NULL,
  `IDMAP` int(11) NOT NULL,
  KEY `IDROOM` (`IDROOM`),
  KEY `IDMAP` (`IDMAP`),
  CONSTRAINT `jouer_ibfk_1` FOREIGN KEY (`IDROOM`) REFERENCES `room` (`ID`),
  CONSTRAINT `jouer_ibfk_2` FOREIGN KEY (`IDMAP`) REFERENCES `map` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `map`;
CREATE TABLE `map` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIB` text NOT NULL,
  `URL` text NOT NULL,
  `TIMER` mediumint(9) NOT NULL,
  `ORDRE` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIB` text NOT NULL,
  `SCORE` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `rejoindre`;
CREATE TABLE `rejoindre` (
  `IDPLAYER` int(11) NOT NULL,
  `IDROOM` int(11) NOT NULL,
  KEY `IDPLAYER` (`IDPLAYER`),
  KEY `IDROOM` (`IDROOM`),
  CONSTRAINT `rejoindre_ibfk_1` FOREIGN KEY (`IDPLAYER`) REFERENCES `player` (`ID`),
  CONSTRAINT `rejoindre_ibfk_2` FOREIGN KEY (`IDROOM`) REFERENCES `room` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `richardeau`;
CREATE TABLE `richardeau` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POSITION` text NOT NULL,
  `IDMAP` int(11) NOT NULL,
  `IDSOUND` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDMAP` (`IDMAP`),
  KEY `IDSOUND` (`IDSOUND`),
  CONSTRAINT `richardeau_ibfk_1` FOREIGN KEY (`IDMAP`) REFERENCES `map` (`ID`),
  CONSTRAINT `richardeau_ibfk_2` FOREIGN KEY (`IDMAP`) REFERENCES `map` (`ID`),
  CONSTRAINT `richardeau_ibfk_3` FOREIGN KEY (`IDSOUND`) REFERENCES `sound` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `lib` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `sound`;
CREATE TABLE `sound` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIB` text NOT NULL,
  `URL` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- 2023-12-07 17:32:00
