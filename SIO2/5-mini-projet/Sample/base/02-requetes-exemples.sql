-- =====================================================================
-- Sample : requêtes d'exemple (phpMyAdmin, onglet SQL)
-- =====================================================================

USE sample;

-- Tous les événements, par type
SELECT Type, Nom, Degats, Objet
FROM   Evenements
ORDER BY Type, Nom;

-- Combien d'événements de chaque type ? (plus il y en a, plus ce type sort souvent)
SELECT Type, COUNT(*) AS nombre
FROM   Evenements
GROUP BY Type;

-- Le monstre le plus dangereux
SELECT Nom, Attaque, Vie, Defense
FROM   Monstres
ORDER BY Attaque DESC
LIMIT 1;

-- L'état du héros : il change à chaque action du jeu (EF fait les UPDATE)
SELECT * FROM EtatJoueur;

-- Le contenu du sac
SELECT Nom, Quantite FROM Inventaire WHERE Quantite > 0 ORDER BY Nom;

-- Ajouter un événement : il peut sortir dès le prochain clic sur Explorer, sans recompiler
INSERT INTO Evenements (Nom, Type, Description, Degats, Objet)
VALUES ('Trésor', 'Objet', 'Des pièces brillent au fond d''un coffre.', 0, 'Pièce d''or');

-- Ajouter un monstre
INSERT INTO Monstres (Nom, Attaque, Vie, Defense) VALUES ('Araignée', 4, 5, 0);

-- Remettre le héros en forme
UPDATE EtatJoueur SET Vie = VieMax WHERE Id = 1;
