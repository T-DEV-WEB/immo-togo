# Immo Togo

Site d'immobilier où l'on peut **publier des annonces** de maisons, appartements, magasins, etc., à louer ou à vendre. Les annonces peuvent être exportées en PDF.

## Fonctionnalités

- Publication d'annonces (maisons, appartements, magasins) à louer ou à vendre
- Consultation des annonces
- Export d'une annonce en PDF

<!-- À vérifier : ajoute ou retire des fonctionnalités selon ton application (inscription, recherche, filtres, photos...) -->

## Technologies

- [Laravel](https://laravel.com) (PHP)
- [Tailwind CSS](https://tailwindcss.com)
- [Vite](https://vitejs.dev)
- Base de données : [MySQL / SQLite, à préciser]

## Captures d'écran

<!-- Ajoute 2 ou 3 captures dans un dossier docs/ puis référence-les ici -->
![Page d'accueil](docs/accueil.png)
![Publication d'une annonce](docs/annonce.png)

## Installation

Prérequis : PHP 8.2 ou plus, Composer, Node.js et npm.

```bash
# 1. Cloner le projet
git clone https://github.com/T-DEV-WEB/immo-togo.git
cd immo-togo

# 2. Installer les dépendances
composer install
npm install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate
# Renseigne ensuite les informations de ta base de données dans le fichier .env

# 4. Créer les tables
php artisan migrate

# 5. Lancer l'application
npm run dev
php artisan serve
```

L'application est alors accessible sur http://127.0.0.1:8000.

## Auteur

**GAMEY Tony Akoété** : [github.com/T-DEV-WEB](https://github.com/T-DEV-WEB)
