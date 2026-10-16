-- Script de création de la base "mvc"
-- À importer dans phpMyAdmin (onglet Importer) ou via la console MySQL

CREATE DATABASE IF NOT EXISTS mvc CHARACTER SET utf8 COLLATE utf8_general_ci;
USE mvc;

-- Table article (déjà existante dans le projet : créée seulement si absente)
CREATE TABLE IF NOT EXISTS article (
    art_id   INT AUTO_INCREMENT PRIMARY KEY,
    art_nom  VARCHAR(100) NOT NULL,
    art_prix DECIMAL(10,2) NOT NULL,
    art_poid DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

-- Table des comptes utilisateurs
-- ATTENTION : mots de passe en CLAIR (exercice pédagogique uniquement)
CREATE TABLE IF NOT EXISTS utilisateur (
    uti_id     INT AUTO_INCREMENT PRIMARY KEY,
    uti_login  VARCHAR(50)  NOT NULL UNIQUE,
    uti_mdp    VARCHAR(255) NOT NULL,
    uti_nom    VARCHAR(50)  NOT NULL,
    uti_prenom VARCHAR(50)  NOT NULL
) ENGINE=InnoDB;

-- Comptes de test (ajouter / supprimer des comptes directement ici ou dans phpMyAdmin)
INSERT IGNORE INTO utilisateur (uti_login, uti_mdp, uti_nom, uti_prenom) VALUES
    ('admin',    'admin',    'Admin',    'Super'),
    ('etudiant', 'sio2026',  'Dupont',   'Jean');
