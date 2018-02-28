<div align="center">
    <img src="resources/assets/images/radiophonix-logo.png" alt="Radiophonix logo" width="560"/>
    <br/>
    <br/>
    Toutes vos sagas au même endroit
</div>

# A propos

Radiophonix est une plateforme libre et gratuite de publication et d'écoute de
Sagas MP3.

Le site est écrit en JavaScript à l'aide de Vue.js et l'API en PHP à l'aide de
Laravel.

## Setup

```bash
# Cloner le repository
git clone git@gitlab.com:Radiophonix/Radiophonix.git

# On se place dans le répertoire
cd Radiophonix/

# Installation des dépendances PHP
composer install

# Installation des dépendances JavaScript
yarn # ou `npm install`

# Configuration locale
cp .env.example .env

# Pendant le dev : (le navigateur s'ouvre automatiquement sur http://localhost:8080)
# Cette commande rebuild tout (js, vue, sass) automatiquement.
npm run dev
```

Pour activer les mocks de l'apiil faut dans le fichier `.env` :
```
RADIOPHONIX_API_MOCK=1
```

## Licence

Voir le fichier [LICENSE](LICENSE)