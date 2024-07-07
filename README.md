# design-pattern

GAP/PaymentLibrary est une librairie PHP pour interagir avec différentes interfaces de paiement en ligne.

## Installation

Avoir minimum PHP 8.2

```bash
composer install
```

Renseignez les fichier .env

API_KEY= // Votre clé d'API Stripe
PAYPAL_CLIENT_ID= // Votre identifiant client Paypal
PAYPAL_CLIENT_SECRET= // Votre clé secrète Paypal

## Utilisation

Dans le dossier test, vous trouverez des exemples d'utilisation de la librairie.
Exemple de test

```bash
php example.php
```

On peut faire docker-compose up pour lancer le serveur web et accéder à l'interface web pour tester les fichiers de test.

## Voci un exemple de repot qui a fait une implementation de la librairie 

https://github.com/Pyracantharia/test-design-pattern

## Ressources

On utilise Stripe et Paypal.

## Contributeurs

PERROUAS Thibault

ADAM Garchi

ASSI MARC

ESGI 3 IW2
