# Installation

La première chose à faire est de cloner le repository :

```bash
$ git clone git@gitlab.com:Radiophonix/Radiophonix.git
```

## L'API

L'API est écrite en PHP et il existe plusieurs façon de la faire tourner sur
votre PC.

### Plateforme de dev

La première chose à faire est d'installer une plateforme de développement pour
l'API.

#### Via Vagrant

Il faut tout d'abord installer [Vagrant][vagrant] et un gestionnaire de machines
virtuelles comme [VirtualBox][virtualbox].

##### Avec PHP

Si PHP (en version 7.2) est installé sur votre PC, vous pouvez utiliser l'image
Vagrant fournie directement dans le repository de [Radiophonix][vagrantfile].

Cette image est basée sur [Homestead][homestead] et contient tout ce qu'il faut
pour faire tourner le site sur votre PC.

Une fois les pré-requis installés, il faut se rendre dans le répertoire du
projet et lancer :

```bash
$ cd radiophonix
$ composer install
$ vagrant up
```

Le site est ensuite accessible via [http://radiophonix.test](http://radiophonix.test)

##### Sans PHP

Si PHP n'est pas installé sur votre machine, alors il suffit d'utiliser la
version globale de [Homestead][homestead].

La première chose à faire est d'installer Homestead: [Installation][homestead-install]

Il faut ensuite configurer un mapping vers le code de Radiophonix dans le
fichier `Homestead.yml`.

###### Le dossier

```yaml
folders:
    -
        map: /chemin/vers/dossier/contenant/radiophonix/sur/pc
        to: /home/vagrant/code/radiophonix
```

###### Configuration du domaine

```yaml
sites:
    -
        map: radiophonix.test
        to: /home/vagrant/code/radiophonix/public
        php: "7.2"
```

Il faut aussi configurer ce domaine dans les hosts du PC :

```
192.168.10.10   radiophonix.test
```

Sur Linux/MacOs : `/etc/hosts`

Sur Windows : `C:\Windows\System32\drivers\etc\hosts`

###### Base de données

```yaml
databases:
    - homestead
```

###### Exemple complet

```yaml
ip: 192.168.10.10
memory: 2048
cpus: 1
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    -
        map: /chemin/vers/dossier/contenant/radiophonix/sur/pc
        to: /home/vagrant/radiophonix/code

sites:
    -
        map: radiophonix.test
        to: /home/vagrant/code/radiophonix/public
        php: "7.2"

databases:
    - homestead
```

##### Imagick

Il faut ensuite installer Imagick sur la VM :

```bash
# Se rendre dans le dossier contenant Homestead
$ cd homestead

# Se connecter à la VM
$ vagrant ssh
```

Une fois dans la VM :

```bash
# Installation de imagick
vagrant@homestead:~$ sudo apt-get update && sudo apt-get install -y imagemagick php-imagick

# Reboot de PHP et Nginx
vagrant@homestead:~$ sudo service php7.2-fpm restart && sudo service nginx restart
```

#### Via Valet

Sur un Mac il est possible d'utiliser [Valet][valet] pour faire tourner l'API.

L'avantage est que l'API sera plus rapide qu'avec Vagrant car le code est
exécuté directement sur le Mac.

Il suffit de se rendre dans le dossier et de configurer Valet une seule fois :

```bash
$ cd radiophonix
$ valet link
```

L'API devient accessible via [http://radiophonix.test](http://radiophonix.test).

### Installation de l'API

Une fois la plateforme prête, il faut installer l'API.

#### Avec Vagrant

##### Sur votre machine

```bash
# Se rendre dans le dossier contenant Homestead
$ cd homestead

# Se connecter à la VM
$ vagrant ssh
```

##### Sur la VM

```bash
# Se rendre dans le dossier
vagrant@homestead:~$ cd code/radiophonix

# Installer les dépendances PHP
vagrant@homestead:~/code/radiophonix$ composer install

# Créé un lien symbolique pour les uploads
vagrant@homestead:~/code/radiophonix$ php artisan storage:link

# Rempli la base de données de sagas
vagrant@homestead:~/code/radiophonix$ php artisan alpha:refresh
```

#### Avec Valet

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

### Le front

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

!!! info
    Il faut installer Node.js et yarn sur votre PC pour que `yarn run dev`
    fonctionne.

[vagrant]: https://www.vagrantup.com
[virtualbox]: https://www.virtualbox.org
[node]: https://nodejs.org
[yarn]: https://yarnpkg.com
[homestead]: https://laravel.com/docs/5.7/homestead
[valet]: https://laravel.com/docs/5.7/valet
[homestead-install]: https://laravel.com/docs/5.7/homestead#installation-and-setup
[vagrantfile]: https://gitlab.com/Radiophonix/Radiophonix/blob/dev/Vagrantfile
[package-json]: https://gitlab.com/Radiophonix/Radiophonix/blob/dev/package.json
