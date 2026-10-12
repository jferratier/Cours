-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 01 oct. 2026 à 09:11
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sample`
--

-- --------------------------------------------------------

--
-- Structure de la table `epreuves`
--

DROP TABLE IF EXISTS `epreuves`;
CREATE TABLE IF NOT EXISTS `epreuves` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `niveauEndurance` int NOT NULL,
  `niveauIntelligence` int NOT NULL,
  `niveauForce` int NOT NULL,
  `niveauForme` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `epreuves`
--

INSERT INTO `epreuves` (`Id`, `Nom`, `niveauEndurance`, `niveauIntelligence`, `niveauForce`, `niveauForme`) VALUES
(1, 'Lancer de poid', 3, 3, 8, 3);

-- --------------------------------------------------------

--
-- Structure de la table `etatjoueur`
--

DROP TABLE IF EXISTS `etatjoueur`;
CREATE TABLE IF NOT EXISTS `etatjoueur` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Vie` int NOT NULL,
  `VieMax` int NOT NULL,
  `Force` int NOT NULL,
  `Defense` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etatjoueur`
--

INSERT INTO `etatjoueur` (`Id`, `Nom`, `Vie`, `VieMax`, `Force`, `Defense`) VALUES
(1, 'Héros', 20, 20, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Degats` int NOT NULL,
  `Objet` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`Id`, `Nom`, `Type`, `Description`, `Degats`, `Objet`) VALUES
(1, 'Couloir vide', 'Rien', 'Un couloir humide et silencieux. Rien à signaler.', 0, NULL),
(2, 'Salle abandonnée', 'Rien', 'Des toiles d\'araignée et un vieux tabouret. Rien d\'utile.', 0, NULL),
(3, 'Rencontre', 'Monstre', 'Un grognement résonne : un monstre surgit de l\'ombre !', 0, NULL),
(4, 'Embuscade', 'Monstre', 'Quelque chose vous attaque par derrière !', 0, NULL),
(5, 'Piège à pointes', 'Piege', 'Le sol se dérobe sur des pointes rouillées.', 4, NULL),
(6, 'Fléchette', 'Piege', 'Une fléchette jaillit du mur.', 2, NULL),
(7, 'Fontaine de santé', 'Fontaine', 'Une eau claire et scintillante. Vous vous sentez mieux.', -6, NULL),
(8, 'Coffre', 'Objet', 'Un petit coffre entrouvert.', 0, 'Ration'),
(9, 'Râtelier', 'Objet', 'Une arme pend au mur.', 0, 'Épée'),
(10, 'Sortie', 'Sortie', 'Un courant d\'air frais... La sortie du donjon !', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `inventaire`
--

DROP TABLE IF EXISTS `inventaire`;
CREATE TABLE IF NOT EXISTS `inventaire` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Quantite` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inventaire`
--

INSERT INTO `inventaire` (`Id`, `Nom`, `Quantite`) VALUES
(1, 'Ration', 2),
(2, 'Torche', 1);

-- --------------------------------------------------------

--
-- Structure de la table `monstres`
--

DROP TABLE IF EXISTS `monstres`;
CREATE TABLE IF NOT EXISTS `monstres` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Attaque` int NOT NULL,
  `Vie` int NOT NULL,
  `Defense` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `monstres`
--

INSERT INTO `monstres` (`Id`, `Nom`, `Attaque`, `Vie`, `Defense`) VALUES
(1, 'Rat géant', 3, 4, 0),
(2, 'Gobelin', 4, 7, 1),
(3, 'Squelette', 5, 9, 1),
(4, 'Orc', 6, 12, 2);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `niveauEndurance` int NOT NULL,
  `niveauIntelligence` int NOT NULL,
  `niveauForce` int NOT NULL,
  `niveauForme` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `participant`
--

INSERT INTO `participant` (`Id`, `Nom`, `niveauEndurance`, `niveauIntelligence`, `niveauForce`, `niveauForme`) VALUES
(1, 'Brice roi de la glisse', 1, 1, 1, 10),
(2, 'Hector...', 1, 1, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `__efmigrationshistory`
--

DROP TABLE IF EXISTS `__efmigrationshistory`;
CREATE TABLE IF NOT EXISTS `__efmigrationshistory` (
  `MigrationId` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ProductVersion` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`MigrationId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `__efmigrationshistory`
--

INSERT INTO `__efmigrationshistory` (`MigrationId`, `ProductVersion`) VALUES
('20260922155121_init', '9.0.20'),
('20260925141605_epreuve', '9.0.20'),
('20260928074446_ajoutParticipant', '9.0.20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
