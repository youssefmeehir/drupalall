# Socle Drupal 8

Socle intégrant tous les composants nécessaire à la maitrise d'un projet sous Drupal 8 :

- **Composer** : projet entièrement géré sous Composer pour les dépendances et librairies
- **Docker et Docker compose**
- **Config architecture** : architecture de configurations orienté Devops
- **Bootstrap SASS** : thème frontoffice responsive
- **CI** : intégration continue via Gitlab CI

## Index

1. Pré-requis
2. Lignes directrices
3. Installation
4. Gitlab et Gitlab CI
5. Bootstrap et SASS

## 1. Pré-requis

- [Drupal 8](https://www.drupal.org/docs/8)
- [Composer](https://getcomposer.org/) : gestion des dépendances
- [Docker version 1.13 ou +](https://docs.docker.com/)
- [Docker compose](https://docs.docker.com/compose/)
- [Gitlab flow](https://docs.gitlab.com/ce/workflow/gitlab_flow.html) : flux de travail Git
- [SASS](https://sass-lang.com/)

## 2. Lignes directrices

### 2.1. Gestion des dépendances : Coeur, Modules, Librairies, Patches

Ce projet est entièrement géré par un schéma Composer spécifique à Drupal.

Les ajouts, modifications ou suppressions de modules et de livrairies doivent obligatoirement passer par les commandes 
Composer sans quoi elles ne seront pas prises en compte sur les autre environnements.

Suivre les indications : [1-COMPOSER.md](1-COMPOSER.md)

Exemple d'ajout d'un module Drupal via Docker Compose fournit :

```
docker-compose run --rm composer require drupal/chosen
```

### 2.2. Environnements

Par défaut, ce projet propose un exemple de gestion de 3 environnements :

- **dev** : environnement de développement local géré via Docker et Docker compose
- **int** : environnement d'intégration (hébergé chez Norsys dans OPS) pour la recette interne
- **prod**

Suivre les indications :  : [2-DOCKER.md](2-DOCKER.md)

### 2.3. Drush : commandes console

Les commandes consoles via Drush sont utilisées dans le processus de déploiement de d'intégration continue à travers 
tous les environnements. Elles seronts nécessaires lors de la gestion des configurations.

Exemple via Docker compose :

```
docker-compose exec web drush
```

### 2.4. Configurations

**Merci de lire attentivement ce chapitre qui permettra l'utilisation multi-environnements professionnelle de Drupal 8.**

Pour permettre la gestion des configurations par code de chaque environnement, ce projet utilise un ensemble de modules :

- (coeur) [Configuration API](https://www.drupal.org/docs/8/api/configuration-api/configuration-api-overview) : base
- [Config ignore](https://www.drupal.org/project/config_ignore) : exclusion des configurations bloquantes
- [Config split](https://www.drupal.org/project/config_split) : gestion multi-environnements

Le modèle choisit est expliqué en détail : [3-CONFIGURATIONS.md](3-CONFIGURATIONS.md)

## 3. Installation

Suivre les indications Docker : [2-DOCKER.md](2-DOCKER.md)

## 4. Gitlab et Gitlab CI

Le support des fichiers Markdown pour le Gitlab flow est intégré au projet dans le sous dossier `.gitlab`.

Un exemple complet d'intégration à Gitlab CI dans l'environnement technique de Norsys est proposé dans le fichier
`.gitlab-ci.yml`. Il faudra ajuster les variables après la copie du projet.

## 5. Bootstrap et SASS

Le thème proposé dans ce projet est un sous-thème de Bootstrap utilisant Bootstrap dans sa version SASS.

Tester que le compilateur SASS est bien installé :

    $ sass -v

S'il n'est pas installé, suivre l'installation : http://sass-lang.com/install

Exemple d'utilisation depuis la racine du site en mode "écoute" (prend le controle du terminal) :

    $ sass --watch web/themes/custom/norsys/scss/style.scss:web/themes/custom/norsys/css/style.css

A titre informatif, il est possible d'utiliser un "Watcher" comme Phpstorm ou d'autres IDE le proposent afin
d'automatiser ce fonctionnement.
