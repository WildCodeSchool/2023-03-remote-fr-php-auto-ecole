-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simple-mvc`
--

-- --------------------------------------------------------

CREATE TABLE `training` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255),
  content TEXT
);

CREATE TABLE `message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NULL,
  `content` TEXT NULL,
  `sended_at` DATETIME NULL,
  `training_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_message_training1`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE `licence` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NULL,
  `training_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_licence_training1`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE `message_licence` (
  `message_id` INT NOT NULL,
  `licence_id` INT NOT NULL,
  CONSTRAINT `fk_message_licence_message1`
    FOREIGN KEY (`message_id`)
    REFERENCES `message` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_licence_licence1`
    FOREIGN KEY (`licence_id`)
    REFERENCES `licence` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pseudo` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `user` VALUES (1,'admin@test.com','$2y$10$4Fr/E4Lcj8HRTQ5UtXBE4./ut/diPoZQLzICLRQqqFU5NamJpsKOK','Marty','Marty','McFly');


INSERT INTO `training` VALUES
(1, 'Les enjeux de la formation au permis', 'Le permis de conduire est devenu un impératif sociétal important pour les jeunes qui ont à se déplacer pour leurs études, leur travail ou même leur vie sociale.
Dés le début  de la formation, l\'élève va devoir acquérir des compétences pour ne pas mettre en danger sa sécurité et celle des autres.<br>
La formation théorique validée par l\'examen du code de la route permet de transmettre les clés de compréhension de la sécurité routière.<br>
La formation à la conduite a pour but principal d\'amener le conducteur débutant à la maîtrise de compétences en termes de savoir-être, savoirs, savoir-faire et savoir-devenir.<br>
Les formateurs de l\'auto-école JB vous guideront et vous conseilleront tout au long des cours théoriques et pratiques'),
(2, 'Les conduites accompagnées', 'Lorem'),
(3, 'Déroulement du permis B', 'Lorem'),
(4, 'Examen code de la route', 'Lorem'),
(5, 'Examen conduite permis B', 'Lorem'),
(6, 'Permis AM (ex BSR)', 'Lorem'),
(7, 'Formation moto 125 avec permis B', 'Lorem'),
(8, 'Permis moto A1', 'Lorem'),
(9, 'Permis moto A2', 'Lorem'),
(10, 'Passerelle moto A', 'Lorem'),
(11, 'Permis remorque B96', 'Lorem'),
(12, 'Permis remorque BE', 'Lorem'),
(13, 'Permis B boîte automatique', 'Lorem'),
(14, 'Formation post-permis', 'Lorem');

INSERT INTO `licence` (`title`, `training_id`) VALUES
('AM (cyclomoteurs)', 6),
('Permis 125', 7),
('Permis moto A1', 8),
('Permis moto A2', 9),
('Permis B', 3)
;
