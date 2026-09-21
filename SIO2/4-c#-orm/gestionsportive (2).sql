-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 sep. 2026 à 07:20
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
-- Base de données : `gestionsportive`
--

-- --------------------------------------------------------

--
-- Structure de la table `tp_course`
--

DROP TABLE IF EXISTS `tp_course`;
CREATE TABLE IF NOT EXISTS `tp_course` (
  `cou_id` int NOT NULL AUTO_INCREMENT,
  `spo_id` int NOT NULL,
  `cou_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cou_duree` int NOT NULL,
  `cou_lieu` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cou_distance` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`cou_id`),
  KEY `idx_tp_course_spo_id` (`spo_id`)
) ;

--
-- Déchargement des données de la table `tp_course`
--

INSERT INTO `tp_course` (`cou_id`, `spo_id`, `cou_type`, `cou_duree`, `cou_lieu`, `cou_distance`) VALUES
(1, 1, 'Trail', 95, 'Fontainebleau', 14.20),
(2, 1, 'Route', 42, 'Paris', 8.00),
(3, 1, 'Fractionné', 35, NULL, 6.50),
(4, 2, 'Route', 120, 'Lyon', 21.10),
(5, 2, 'Trail', 80, 'Chartreuse', 12.00),
(6, 3, 'Route', 28, 'Paris', 5.00),
(7, 3, 'Trail', 150, 'Vercors', 28.00),
(8, 4, 'Route', 55, 'Nîmes', 10.00),
(9, 4, 'Fractionné', 48, 'Nîmes', 8.50);

-- --------------------------------------------------------

--
-- Structure de la table `tp_entrainement`
--

DROP TABLE IF EXISTS `tp_entrainement`;
CREATE TABLE IF NOT EXISTS `tp_entrainement` (
  `ent_id` int NOT NULL AUTO_INCREMENT,
  `ent_nom` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_niveau` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ent_id`),
  UNIQUE KEY `uq_tp_entrainement_nom` (`ent_nom`)
) ;

--
-- Déchargement des données de la table `tp_entrainement`
--

INSERT INTO `tp_entrainement` (`ent_id`, `ent_nom`, `ent_niveau`) VALUES
(1, 'Endurance fondamentale', 'Debutant'),
(2, 'Seuil', 'Intermediaire'),
(3, 'VMA courte', 'Avance'),
(4, 'Côtes', 'Intermediaire'),
(5, 'Récupération', 'Debutant');

-- --------------------------------------------------------

--
-- Structure de la table `tp_serie`
--

DROP TABLE IF EXISTS `tp_serie`;
CREATE TABLE IF NOT EXISTS `tp_serie` (
  `cou_id` int NOT NULL,
  `ent_id` int NOT NULL,
  `ser_date` date NOT NULL,
  `ser_ressenti` int DEFAULT NULL,
  `ser_commentaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cou_id`,`ent_id`),
  KEY `idx_tp_serie_ent_id` (`ent_id`)
) ;

--
-- Déchargement des données de la table `tp_serie`
--

INSERT INTO `tp_serie` (`cou_id`, `ent_id`, `ser_date`, `ser_ressenti`, `ser_commentaire`) VALUES
(1, 1, '2026-03-02', 4, 'Bonnes sensations'),
(1, 4, '2026-03-02', 3, NULL),
(2, 2, '2026-03-05', 5, 'Rapide'),
(3, 3, '2026-03-07', 2, 'Jambes lourdes'),
(4, 1, '2026-03-09', 4, NULL),
(5, 4, '2026-03-12', 3, 'Dénivelé important'),
(6, 2, '2026-03-14', 4, NULL),
(8, 3, '2026-03-18', 5, 'Excellent'),
(9, 2, '2026-03-20', 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tp_sportif`
--

DROP TABLE IF EXISTS `tp_sportif`;
CREATE TABLE IF NOT EXISTS `tp_sportif` (
  `spo_id` int NOT NULL AUTO_INCREMENT,
  `spo_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spo_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spo_email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`spo_id`),
  UNIQUE KEY `uq_tp_sportif_email` (`spo_email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tp_sportif`
--

INSERT INTO `tp_sportif` (`spo_id`, `spo_nom`, `spo_prenom`, `spo_email`) VALUES
(1, 'Martin', 'Julie', 'julie.martin@exemple.fr'),
(2, 'Bernard', 'Marc', 'marc.bernard@exemple.fr'),
(3, 'Dubois', 'Sophie', 'sophie.dubois@exemple.fr'),
(4, 'Petit', 'Karim', 'karim.petit@exemple.fr'),
(5, 'Durand', 'Léa', 'lea.durand@exemple.fr');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tp_course`
--
ALTER TABLE `tp_course`
  ADD CONSTRAINT `fk_tp_course_sportif` FOREIGN KEY (`spo_id`) REFERENCES `tp_sportif` (`spo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tp_serie`
--
ALTER TABLE `tp_serie`
  ADD CONSTRAINT `fk_tp_serie_course` FOREIGN KEY (`cou_id`) REFERENCES `tp_course` (`cou_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tp_serie_entrainement` FOREIGN KEY (`ent_id`) REFERENCES `tp_entrainement` (`ent_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
