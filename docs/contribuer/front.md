# Le front

Pour faire fonctionner le front, il faut tout d'abord installer [Node.js][node]
et [Yarn][yarn].

Pour la bonne version de Node.js, consultez le fichier [package.json][package-json].

Une fois installés :

```bash
$ cd radiophonix

## Installation des dépendances javascript
$ yarn

## Pendant le dev : (le browser va ouvrir http://localhost:8081)
## Cette commande rebuild tout (js, vue, sass) automatiquement
$ yarn run dev

## Pour faire un build de production
$ yarn run build
```

## Développer sans l'API

Il est possible de développer le frontend seul sans avoir à faire tourner
l'API sur votre PC.

Pour cela il faut créer/modifier un fichier `.env` à la racine du projet
et d'y modifier les options suivantes :

```
RADIOPHONIX_ENV=local
RADIOPHONIX_API_URL=https://dev.radiophonix.org/api/v1/
RADIOPHONIX_FEATURES_CONFIG=development
```

## Développer avec l'API

Si vous souhaitez également développer l'API il suffit de modifier certaines
options dans le le fichier `.env` comme ceci :

```
RADIOPHONIX_ENV=local
RADIOPHONIX_API_URL=http://radiophonix.test/api/v1/
RADIOPHONIX_FEATURES_CONFIG=development
```

[node]: https://nodejs.org
[yarn]: https://yarnpkg.com
[package-json]: https://gitlab.com/Radiophonix/Radiophonix/blob/dev/package.json
