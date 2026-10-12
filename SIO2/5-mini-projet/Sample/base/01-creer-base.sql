-- =====================================================================
-- Sample : création de la BASE (phpMyAdmin, onglet SQL)
-- Les tables et leurs premières lignes sont créées par Entity Framework :
--   Add-Migration Initial, puis Update-Database
-- =====================================================================

CREATE DATABASE IF NOT EXISTS sample
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

-- Contrôle après Update-Database : cinq tables attendues
--   Evenements, Monstres, EtatJoueur, Inventaire, __EFMigrationsHistory
-- USE sample;
-- SHOW TABLES;
