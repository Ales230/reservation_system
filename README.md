# Système de Réservations en Ligne

Ce projet est une application backend Symfony 6 pour gérer les réservations d'une salle d'événements. Il permet aux administrateurs et aux utilisateurs de gérer les réservations de manière sécurisée.

## Prérequis

- PHP 8.0 ou supérieur
- Composer
- MySQL

## Installation

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/reservation-system.git
   cd reservation-system

Installez les dépendances :
composer install

Configurez les variables d'environnement dans le fichier .env : 
DATABASE_URL="mysql://username:password@127.0.0.1:3306/reservation_system"

Créez la base de données et exécutez les migrations :
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

Chargez les fixtures (données de test) : php bin/console doctrine:fixtures:load

Démarrez le serveur de développement :
symfony server:start

Accédez à l'application via http://127.0.0.1:8000

Fonctionnalités
Gestion des utilisateurs avec rôles (ROLE_ADMIN et ROLE_USER).

CRUD complet pour les utilisateurs et les réservations.

Authentification sécurisée et restriction d'accès.

Validation des règles métier spécifiques.

Liste des Routes Disponibles : 
Méthode HTTP	Chemin	Nom de la Route	Description
GET	/	app_home	Page d'accueil
GET	/login	app_login	Page de connexion
POST	/logout	app_logout	Déconnexion
GET	/admin/user	user_index	Liste des utilisateurs (admin)
GET	/admin/user/new	user_new	Créer un nouvel utilisateur (admin)
GET	/admin/reservation	reservation_index	Liste des réservations (admin)
GET	/admin/reservation/new	reservation_new	Créer une nouvelle réservation (admin)

Exemples de Requêtes
Création d'un Utilisateur : 
POST /api/users
{
    "email": "user@example.com",
    "password": "password",
    "roles": ["ROLE_USER"],
    "name": "John Doe",
    "phoneNumber": "+1234567890"
}

Création d'une Réservation :
POST /api/reservations
{
    "date": "2024-12-15T18:00:00Z",
    "timeSlot": "18:00-20:00",
    "eventName": "Concert",
    "user": "/api/users/1"
}

Exécution des Tests
Pour exécuter les tests, utilisez la commande suivante :
php bin/console test


