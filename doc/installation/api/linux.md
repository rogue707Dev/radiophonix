# Développer l'API sur Linux

Pour développer l'API de Radiophonix sur Linux il suffit d'utiliser une
machine virtuelle (VM) via [Vagrant][vagrant].

!!! note
    Il est probablement possible de se passer de Vagrant sur Linux, mais je ne
    développe pas dessus.
    
    Les contributions sont les bienvenues pour compléter ce guide avec d'autres
    façon de développer.

## Cloner le repository

Il faut avant tout cloner le repository git de Radiophonix.

```bash
# Vous pouvez cloner le repo là où vous voulez
$ cd ~/Code

$ git clone git@gitlab.com:Radiophonix/Radiophonix.git
```

## Installer Vagrant

Il faut tout d'abord installer [Vagrant][vagrant] et un gestionnaire de machines
virtuelles comme [VirtualBox][virtualbox].

## Installer Homestead

[Homestead][homestead] est une machine virtuelle conçue spécialement pour
le développement PHP.

Pour l'installation suivez les instructions officielles : [Installation de Homestead][homestead-install]

Il faut ensuite configurer un mapping vers le code de Radiophonix dans le
fichier `Homestead.yml`.

### Le dossier

```yaml
folders:
    -
        map: ~/Code/Radiophonix
        to: /home/vagrant/code/radiophonix
```

### Configuration du domaine

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

Chemin du fichier : `/etc/hosts`

### Base de données

```yaml
databases:
    - homestead
```

### Exemple complet

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
        map: ~/Code/Radiophonix
        to: /home/vagrant/radiophonix/code

sites:
    -
        map: radiophonix.test
        to: /home/vagrant/code/radiophonix/public
        php: "7.2"

databases:
    - homestead
```

## Imagick

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

## Installation de l'API

Une fois la plateforme prête, il faut installer l'API.

### Sur votre machine

```bash
# Se rendre dans le dossier contenant Homestead
$ cd homestead

# Se connecter à la VM
$ vagrant ssh
```

### Sur la VM

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

L'API devient accessible via [http://radiophonix.test/api/v1/sagas](http://radiophonix.test/api/v1/sagas)

!!! tip "Le front"
    Le front est écrit en JavaScript et doit être [configuré séparément](../front.md).

[vagrant]: https://www.vagrantup.com
[virtualbox]: https://www.virtualbox.org
[homestead]: https://laravel.com/docs/5.7/homestead
[homestead-install]: https://laravel.com/docs/5.7/homestead#installation-and-setup
[vagrantfile]: https://gitlab.com/Radiophonix/Radiophonix/blob/dev/Vagrantfile
