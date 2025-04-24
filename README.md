# Gestion des Projets, Clients, Sessions, Formations et Appels de Fonds

## Description

Ce projet est une application web construite avec **Symfony** pour la gestion des projets, clients, sessions de formation et appels de fonds. Elle permet aux utilisateurs de créer, modifier, consulter et supprimer ces entités avec une interface intuitive et efficace.

## Fonctionnalités

- **Gestion des Projets** :
  - Création, modification et suppression de projets.
  - Association d'un projet à un client.
  - Affichage d'une liste des projets existants.
  
- **Gestion des Clients** :
  - Création, modification et suppression de clients.
  - Visualisation de la liste des clients avec leurs détails.

- **Gestion des Appels de Fonds** :
  - Création, modification et suppression des appels de fonds.
  - Association des appels de fonds à des projets.

- **Gestion des Sessions de Formation** :
  - Création, modification et suppression des sessions.
  - Association des sessions à des projets.

- **Gestion des Formations** :
  - Création, modification et suppression des formations.

- **Interface Admin** :
  - Gestion des utilisateurs avec des rôles et droits spécifiques.

## Installation

### Prérequis
- PHP >= 8.1
- Composer
- Symfony CLI
- Un serveur MySQL
- Node.js et npm (pour gérer les assets)

### Étapes d'installation

1. **Cloner le projet** :
   git clone https://github.com/Mounirou19/ServiceFormation
   cd ServiceFormation

### 2. Installer les dépendances

composer install

### 3. Lancer docker

docker compose up --build

### 4. Configurer la base de données

php bin/console doctrine:database:create

php bin/console doctrine:migrations:migrate

### 5. Aller sur l'application

http://localhost:8000/login