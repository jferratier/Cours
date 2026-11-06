# Cahier des charges — Règles du projet

## 1. Architecture et conception

Le projet doit respecter les principes suivants :

- **POO (Programmation Orientée Objet)** : structurer le code à l'aide de classes et d'objets.
- **MVC (Modèle-Vue-Contrôleur)** : séparer la logique métier, l'interface utilisateur et le contrôle des actions et des mécanismes.
- **CRUD (Create, Read, Update, Delete)** : implémenter les opérations fondamentales de gestion des données :
  - **Create** : créer des données.
  - **Read** : lire et consulter des données.
  - **Update** : modifier des données.
  - **Delete** : supprimer des données.

---

## 2. Bonnes pratiques de développement

Le code source doit être propre, lisible et facile à maintenir.

Les bonnes pratiques suivantes doivent être respectées :

- **Encapsulation** : protéger les données et contrôler leur accès.
- **Commentaires** : documenter le code lorsque cela est nécessaire pour faciliter sa compréhension.
- **CamelCase** : respecter les conventions de nommage adaptées au langage utilisé.
- **Indentation** : conserver une indentation cohérente dans l'ensemble du projet.

---

## 3. Utilisation de composants et de bibliothèques

Tous les composants, frameworks et bibliothèques utilisés dans le projet doivent être **libres ou gratuits**, conformément aux conditions de licence applicables.

### 3.1. Bibliothèques graphiques et frameworks CSS

Les frameworks CSS suivants peuvent être utilisés pour concevoir l'interface utilisateur :

- [Bootstrap](https://getbootstrap.com/)
- [Materialize](https://materializecss.com/)
- [Bulma](https://bulma.io/)

### 3.2. Icônes et logos

- [Font Awesome](https://fontawesome.com/) : bibliothèque d'icônes utilisable dans le respect des conditions de licence de la version choisie.

### 3.3. fonctionnalités attendues

- Trois CRUD : gestion des champs, des cultures (KC) et des réserves d'eau.
- Respecter le schéma UML joint aux règles de conception.
- Authentification et gestion des utilisateurs : une page d'authentification ainsi qu'un CRUD de gestion des utilisateurs, accessible uniquement à l'administrateur.
- Page d'accueil : un tableau de bord (Dashboard) présentant les principales informations et indicateurs de l'application.
- Journalisation des actions : mise en place d'un trigger alimentant automatiquement une table logs dans la base de données. Cette table devra enregistrer les actions effectuées sur les tables champs, cultures et reserve_eau, en précisant notamment l'utilisateur à l'origine de l'action, le type d'opération réalisée (création, modification ou suppression) ainsi que la date et l'heure de l'opération.

---

## 4. Vérification avant livraison

Avant la livraison du projet, vérifier les points suivants :

- [ ] L'architecture POO et MVC est respectée.
- [ ] Les fonctionnalités CRUD sont implémentées.
- [ ] Les bonnes pratiques de développement sont appliquées.
- [ ] Les bibliothèques et composants respectent les conditions de licence.
- [ ] Les ressources graphiques utilisées sont autorisées.