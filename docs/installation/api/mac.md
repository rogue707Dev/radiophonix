# Développer l'API sur Mac

Sur un Mac le plus simple est d'utiliser [Valet][valet] pour faire tourner l'API.

L'avantage est que l'API sera plus rapide qu'avec [Vagrant][vagrant] car le code est
exécuté directement sur le Mac.

Il est également possible d'utiliser [Vagrant][vagrant] en suivant les mêmes instructions
que pour [l'installation sur Linux](./linux.md).

## Cloner le repository

Il faut avant tout cloner le repository git de Radiophonix.

```bash
# Vous pouvez cloner le repo là où vous voulez
$ cd ~/Code

$ git clone git@gitlab.com:Radiophonix/Radiophonix.git
```

## Installer Valet

Pour installer Valet, suivez les instructions officielles : [Documentation de Valet][valet-doc]

!!! warning "Important"
    Il faut également installer `MySQL` (par exemple comme expliqué sur la
    documentation de Valet).

## Configurer Valet

Il suffit de se rendre dans le dossier et de configurer Valet une seule fois :

```bash
$ cd radiophonix
$ valet link
```

## Base de données

Il faut également créer une base de données MySQL. Le plus simple est
d'utiliser [Sequel Pro][sequel-pro] qui est gratuit et très pratique.

Une fois la base créée, il faut la configurer dans le fichier `.env` via ces
options :

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=radiophonix
DB_USERNAME=radiophonix
DB_PASSWORD=radiophonix
```

## Installation de l'API

```bash
# Se rendre dans le dossier
$ cd radiophonix

# Installer les dépendances PHP
$ composer install

# Créé un lien symbolique pour les uploads
$ php artisan storage:link

# Rempli la base de données de sagas
$ php artisan alpha:refresh
```

L'API devient accessible via [http://radiophonix.test/api/v1/sagas](http://radiophonix.test/api/v1/sagas)

!!! tip "Le front"
    Le front est écrit en JavaScript et doit être [configuré séparément](../front.md).

[valet]: https://laravel.com/docs/5.7/valet
[valet-doc]: https://laravel.com/docs/5.7/valet#installation
[vagrant]: https://www.vagrantup.com
[sequel-pro]: https://www.sequelpro.com/
