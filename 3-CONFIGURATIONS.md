# Configurations

Gestion des configurations détaillées sous Drupal 8

## Index

1. Introduction
2. Fonctionnement à suivre
3. Commandes
4. Tableau des configurations

## 1. Introduction

Les configurations sont gérés via l'API configuration du coeur de Drupal associé avec un module permettant de séparer
les configurations par thème OU environnement. Sur le projet présenté, les choix sont les suivants :

- 1 split spécifique `config_ignore` : sera exécuté en premier pour des raison d'ignore à l'import des autres splits
- 1 split local `blacklist` : initialisé par le développeur, permet d'ignorer à l'export des splits
- 1 split par environnement applicatif : ici 3 environnements applicatifs `dev`, `staging`, `live` (à ne pas confondre 
avec environnement technique : INT, QUALIF sont tous deux sur un environnement applicatif `staging`)

## 2. Fonctionnement à suivre

Par défaut, Drupal 8 inclut un dossier de synchronisation : ici `../config/sync` (ou `/config/sync` en prenant la racine
du projet).

Les splits fonctionnent par principe de blacklist, ou plutôt d'export exclusif dans un dossier. De fait, toute configuration
commune se situe dans le dossier `sync` tandis que les spécificités se situent dans les splits. Il est aussi à noter que
si une configuration est exportée dans un split, elle ne sera pas exportée dans les autres splits ou le dossier de synchronisation.

**Exemple 1** : les modules `devel`, `field_ui`, `menu_ui`, `views_ui` sont nécessaire uniquement sur l'environnement de
développement => il seront donc exportés dans le split `dev`

**Exemple 2** : le module `robotstxt` est essentiellement utile pour la production, il peut donc être exporté dans
le split `live`. Il est également possible de l'exporter dans le dossier `sync` avec une surcharge uniquement pour 
`dev` si toutefois il est nécessaire de valider son fonctionnement avant le passage en production.

**IMPORTANT** : avant tout démarrage d'une nouvelle fonctionnalité, il est nécessaire d'importer les configurations =>
voir chapitre suivant

## 3. Commandes

Import des configurations (splits actifs compris) :

```
# Import du split spécifique avant toute chose
docker-compose exec web drush config-split:import config_ignore
# PUIS Import générique
docker-compose exec web drush config:import
docker-compose exec web drush cim # Raccourcis de la commande précédente
```

Export des splits actifs et sync :

```
docker-compose exec web drush config:export
docker-compose exec web drush cex # Raccourcis de la commande précédente
```

Export d'une configuration Split spécifique (nécessaire dans certains cas) :

```
docker-compose exec web drush config-split:export {nom-du-split}
docker-compose exec web drush csex {nom-du-split} # Raccourcis de la commande précédente
```

**Exemple export split spécifique** : configuration SMTP commune à tous les environnements sauf pour la production. Démarche
à suivre :

1. Configurer les paramètres SMTP communs dans le BO
2. Export des configurations : `drush cex`
3. Vérifier la modification ou ajout dans le dossier `sync`
4. Configurer les paramètres SMTP spécifiques pour `live` depuis le BO
5. Export du split `live` : `drush csex live`
6. Vérifier la modification ou ajout dans le dossier `live`
7. Commiter les changements
8. Import des configurations pour le développement : `drush cex` => cette étape permet de récupération la configuration
commune à tous les environnements exporté en étape 2

## 4. Tableau de management

| Split         | dev | staging | live |
|---------------|-----|---------|------|
| blacklist     | x   | --      | --   |
| config_ignore | x   | x       | x    |
| dev           | x   | x       | --   |
| staging       | --  | x       | --   |
| live          | --  | --      | x    |

