# Sample : le donjon (C# / WPF / Entity Framework / MySQL)

> **Projet de départ** volontairement tout simple, à reprendre en **C#**, **SQL**, **LINQ** et **Entity Framework**.

---

## Le jeu

Un héros explore un donjon. Chaque clic sur **Explorer** tire un **événement au hasard** dans la table `Evenements` : rien, un piège, une fontaine de santé, un objet, un monstre... ou la sortie.

- Un **monstre** lance un **combat** : on **attaque** ou on se **défend** jusqu'à ce que le monstre meure (ou le héros).
- **Victoire** : trouver la sortie. **Défaite** : la vie tombe à 0. **Recommencer** remet la vie au maximum.
- Les boutons **Manger**, **Dormir** et **Ramasser** sont présents mais **pas codés** : c'est à vous.

```
┌───────────────────────────────────────────┬─────────────────────────┐
│ [Explorer] [Attaquer] [Défendre] [Manger] │  (dessin)  Héros        │  20 %
│ [Dormir] [Ramasser] [Recommencer]         │  Vie ████░░ Att. Déf.   │
├───────────────────────────────────────────┴─────────────────────────┤
│  Journal des événements (le plus récent en haut)                    │
│  > Piège à pointes : le sol se dérobe...                            │  80 %
│  > Vie -4.                                                          │
└─────────────────────────────────────────────────────────────────────┘
```

---

## Lancer le projet

1. WampServer démarré (icône verte).
2. phpMyAdmin → onglet SQL → exécuter `base/01-creer-base.sql`.
3. Ouvrir `Sample.sln` dans Visual Studio 2022. **Outils → Gestionnaire de package NuGet → Console** :

```shell
Add-Migration Initial
Update-Database
```

4. **F5**. Puis essayez `base/02-requetes-exemples.sql` dans phpMyAdmin.

---

## L'organisation du code

Un seul projet, cinq dossiers :

```
Sample/
├── Sample.sln
├── base/                     scripts SQL
└── Sample/
    ├── Modeles/              UNE CLASSE = UNE TABLE
    │   ├── Evenement.cs      (+ l'enum TypeEvenement)
    │   ├── Monstre.cs
    │   ├── EtatJoueur.cs
    │   └── ObjetInventaire.cs
    ├── Donnees/
    │   └── SampleContext.cs  le lien C# <-> MySQL, et les lignes de départ (HasData)
    ├── Jeu/
    │   └── Donjon.cs         LES RÈGLES : explorer, combattre
    ├── Images/heros.png      le petit dessin de la fiche
    └── MainWindow.xaml(.cs)  l'écran : il appelle Donjon, puis affiche
```

---

## Le travail demandé

### 0. Créez un jeu selon vos envies : reprenez tout, le monde, la mécanique, les images.

### 1. Ajouter ou enlever des boutons d'action

### 2. Au moins un trigger

- Exemple 1: empêcher la vie de dépasser `VieMax` (`BEFORE UPDATE ON EtatJoueur`) ;
- Exemple 2: compter les monstres vaincus, les objets ramassés... dans une table de statistiques (`AFTER INSERT`) ;

### 3. Au moins une table de plus, synchronisée avec Entity Framework

1. Créer la classe dans `Modeles/` (ex. `Combat`, `Statistique`, `Arme`...).
2. Ajouter son `DbSet` dans `SampleContext` (et des lignes de départ avec `HasData` si besoin).
3. Console NuGet : `Add-Migration AjoutXxx`, puis `Update-Database`.
4. Vérifier la nouvelle table dans phpMyAdmin, puis l'utiliser dans `Donjon.cs`.

### 4. Du LINQ

Au moins trois requêtes nouvelles, par exemple : l'objet le plus nombreux du sac, les monstres plus faibles que le héros, le nombre de combats gagnés.

## 5. A rendre

### 5.1 Deux fiches (Word)
- **Le modèle UML de la base** : toutes les tables (les quatre de départ et les vôtres), leurs colonnes, leurs types, leurs clés et leurs relations.
- **Les requêtes les plus utilisées** dans votre code : pour chacune, la ligne LINQ, le SQL équivalent, et à quoi elle sert dans le jeu. Il faut au moins une requete avec jointure. Au moins une requete un "GROUP BY et HAVING".

### 5.2 Votre projet 