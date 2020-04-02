# Docker et Docker compose

Gestion des environnements

## Index

1. Installation dev
2. Installation int

## 1. Installation DEV

### 1.1. Dépendances

* [Composer](https://getcomposer.org/)
* [Docker version 1.13 ou +](https://docs.docker.com/engine/installation/)
* [Docker compose](https://docs.docker.com/compose/install/)
* [SASS compilateur](http://sass-lang.com/install)
* [jwilder/nginx-proxy](https://hub.docker.com/r/jwilder/nginx-proxy/)

### 1.2 Installation du proxy : jwilder/nginx-proxy

Le proxy est un container Docker qui détecte tous les nouveaux containers exposants les port 80 et 443 et réalise un 
suivit des ports 80 et 443 avec les configuration nécessaires :

```
mkdir -p $HOME/srv/nginx/{logs,certs}
docker run -d --restart always --name nginx-proxy -p 80:80 -p443:443 -v $HOME/srv/nginx/logs:/var/logs/nginx -v $HOME/srv/nginx/certs:/etc/nginx/certs -v /var/run/docker.sock:/tmp/docker.sock:ro jwilder/nginx-proxy
```

### 1.3. Utilisation de docker

Lancement du [docker-compose.yml](https://docs.docker.com/compose/gettingstarted/#step-4-build-and-run-your-app-with-compose) :

```
docker-compose up -d
```

Ajout de certificat (auto-signés) dans le dossier : `~/srv/nginx/certs/` nommés :

* drupal8-formation.app.local.fr.crt
* drupal8-formation.app.local.fr.key 

Ajout du réseau (ce nom change en fonction du nom du dossier) au nginx-proxy

```
docker network connect drupal8-technomakers_default nginx-proxy
docker-compose restart
```

Vérifier l'existence du container :

```
docker-compose ps
docker ps
```

### 1.4 Modification du fichier `/etc/hosts`

(Optionnel selon environnement) Modification du hosts : selon l'environnement utilisé (OSX ou Windows) il faut ajouter
l'entrée pour pointer vers la machine Docker :

Ajouter une entrée dans le fichier `/etc/hosts` :

```
127.0.0.1    drupal8-formation.app.local.fr
```  

### 1.5. Installation de Drupal

Lors du premier lancement Docker compose, le conteneur `composer` se lance et installe les dépendance.

(sinon) Installation des dépendances via Composer :

```
docker-compose run --rm composer install
```

### 1.6. Import de la BDD
Demander et importer la BDD DEV.

### 1.6. Configuration de Drupal
Vérifier que le service mysql local est arrêté, puis importer la BDD par la commande:
mysql -udrupal8 -pMDP2drupal8 -h127.0.0.1 -P33078 drupal8_dev <  dmp/drupal8_dev.sql

### 1.7. Configuration de Drupal

Avant toute utilisation de Drupal importer les configurations et lancer les mises à jours :

```
docker-compose exec web drush csim config_ignore
docker-compose exec web drush csim cim
docker-compose exec web drush updb -y
```

Consulter le site via un navigateur (https://localhost:44316/ OU https://drupal8-formation.app.local.fr).

## 2. Installation int

todo
