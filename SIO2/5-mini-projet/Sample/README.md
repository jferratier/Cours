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

0. .NET 9 Installé
1. WampServer démarré (icône verte).
2. phpMyAdmin → onglet SQL → exécuter `base/01-creer-base.sql`.
3. Ouvrir `Sample.sln` dans Visual Studio 2022. **Outils → Gestionnaire de package NuGet → Console** :

```shell
Add-Migration Initial
Update-Database
```

4. **F5**. Puis lancez `base/02-requetes-exemples.sql` dans phpMyAdmin.

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

### L'algorithme d'Explorer (`Donjon.Explorer`)

```
nombre    <- nombre de lignes de la table Evenements
rang      <- un nombre au hasard entre 0 et nombre - 1
evenement <- la ligne à ce rang
écrire le nom et la description dans le journal
vie       <- vie - evenement.Degats          (Degats négatifs = soin)
si Monstre : tirer un monstre au hasard, de la même façon, et commencer le combat
si Sortie  : victoire
enregistrer la vie en base
```

Plus il y a de lignes d'un type dans la table, plus ce type sort souvent : ajoutez trois « Couloir vide » et le donjon devient plus calme.

### Le combat

| Action | Le héros frappe | Le monstre riposte |
|---|---|---|
| Attaquer | `Force + (0 à 2) - Défense du monstre` (au moins 1) | `Attaque + (0 à 2) - Défense du héros` |
| Défendre | 1 point | `Attaque + (0 à 2) - 2 x Défense du héros` |

La table `Monstres` n'est jamais modifiée : c'est un **modèle**. La vie du monstre en cours de combat est gardée en mémoire (`VieAdversaire`).

### Où sont Entity Framework et LINQ ?

| Dans le code | Ce qui se passe | Le SQL envoyé par EF (en gros) |
|---|---|---|
| `_db.EtatJoueur.First()` | lire le héros | `SELECT ... FROM EtatJoueur LIMIT 1` |
| `_db.Evenements.Count()` | compter les événements | `SELECT COUNT(*) FROM Evenements` |
| `.OrderBy(e => e.Id).Skip(n).First()` | prendre la ligne n | `SELECT ... ORDER BY Id LIMIT 1 OFFSET n` |
| `_db.Inventaire.Where(o => o.Quantite > 0).OrderBy(o => o.Nom)` | lire le sac | `SELECT ... WHERE Quantite > 0 ORDER BY Nom` |
| `Joueur.Vie = ...` puis `_db.SaveChanges()` | enregistrer le héros | `UPDATE EtatJoueur SET Vie = ... WHERE Id = 1` |
| `.Select(o => $"{o.Nom} x{o.Quantite}")` | texte du sac (dans `MainWindow`) | aucun : LINQ sur une liste en mémoire |

---

## Le travail demandé

### 1. Ajouter ou enlever des boutons d'action

- Un bouton = une ligne dans `MainWindow.xaml` + un gestionnaire `Click` dans `MainWindow.xaml.cs`.
- La **règle** s'écrit dans `Donjon.cs` (une méthode publique), jamais dans la fenêtre.
- À coder : **Manger** (utiliser une `Ration` de l'inventaire), **Dormir** (regagner de la vie, au risque d'être surpris par un monstre), **Ramasser** (ajouter l'objet vu à l'inventaire).

### 2. Au moins un trigger

Écrit en SQL dans phpMyAdmin, rangé dans `base/03-triggers.sql`. Idées :

- empêcher la vie de dépasser `VieMax` (`BEFORE UPDATE ON EtatJoueur`) ;
- compter les monstres vaincus, les objets ramassés... dans une table de statistiques (`AFTER INSERT`) ;
- refuser une quantité négative dans l'inventaire (`BEFORE UPDATE` + `SIGNAL`).

### 3. Au moins une table de plus, synchronisée avec Entity Framework

1. Créer la classe dans `Modeles/` (ex. `Combat`, `Statistique`, `Arme`...).
2. Ajouter son `DbSet` dans `SampleContext` (et des lignes de départ avec `HasData` si besoin).
3. Console NuGet : `Add-Migration AjoutXxx`, puis `Update-Database`.
4. Vérifier la nouvelle table dans phpMyAdmin, puis l'utiliser dans `Donjon.cs`.

### 4. Du LINQ

Au moins trois requêtes nouvelles, par exemple : l'objet le plus nombreux du sac, les monstres plus faibles que le héros, le nombre de combats gagnés.

### 5. Deux fiches à rendre

- **Le modèle UML de la base** : toutes les tables (les quatre de départ et les vôtres), leurs colonnes, leurs types, leurs clés et leurs relations.
- **Les requêtes les plus utilisées** dans votre code : pour chacune, la ligne LINQ, le SQL équivalent, et à quoi elle sert dans le jeu.
