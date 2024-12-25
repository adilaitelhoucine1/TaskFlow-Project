# ✅ TaskFlow - Gestionnaire de Tâches Simple

TaskFlow est une application web intuitive de gestion de tâches conçue pour vous initier aux concepts de Programmation Orientée Objet (POO). Ce projet met l'accent sur les bases de l'encapsulation, de l'héritage et de la validation des données tout en offrant une interface utilisateur claire et simple.

## 🌟 Fonctionnalités principales

### 📝 Gestion des Tâches
- ✅ Création de tâches basiques
- 🐛 Création de tâches spécifiques : **Bug** et **Feature**
- 🔄 Changement de statut des tâches (à faire, en cours, terminé)
- 👥 Attribution des tâches à des utilisateurs

### 🖥️ Interface Utilisateur Simple
- 📋 Liste des tâches avec tri par utilisateur ou statut
- ➕ Formulaire de création de tâche
- 🔍 Page de détail d'une tâche
- 👤 Vue dédiée aux tâches assignées à chaque utilisateur

---

## 👥 User Stories

### En tant qu'utilisateur :
1. Je veux pouvoir **créer une tâche simple** avec un titre et une description.
2. Je veux pouvoir **créer une tâche spécifique** (Bug ou Feature) avec des propriétés supplémentaires.
3. Je veux pouvoir **changer le statut d'une tâche** pour refléter son avancement.
4. Je veux pouvoir **voir mes tâches assignées** dans une vue personnalisée.

### En tant que développeur :
1. Je dois **utiliser l'encapsulation** avec des propriétés `private` et des méthodes `getters/setters`.
2. Je dois **implémenter l'héritage** pour différencier les types de tâches (Bug, Feature).
3. Je dois créer un **diagramme de classes basique** pour structurer le projet.
4. Je dois **valider les données** avant de créer ou de modifier des tâches.

---

## 🛠️ Technologies utilisées
- **Langage** : PHP
- **Frontend** : HTML, CSS (optionnellement Tailwind CSS pour la mise en page)
- **Base de données** : MySQL (si persistance nécessaire, sinon fichiers JSON ou tableaux en mémoire)
- **Architecture** : Programmation Orientée Objet (POO)

---

## 🗂️ Organisation du projet

### 📌 Diagramme de Classes (exemple simplifié)
```text
Task (classe parent)
│
├── Bug (hérite de Task)
│      - priority
│      - reproductionSteps
│
└── Feature (hérite de Task)
       - estimatedTime
       - isApproved
