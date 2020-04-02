<?php

// @codingStandardsIgnoreFile

/**
 * Base Drupal 8
 */

# Salt for one-time login links, cancel links, form tokens, etc.
$settings['hash_salt'] = 'J1PkbQKzDwHPkZtR5kbz2ToCUAtHNFialcLXnKIqv-vQTvKZr99UA6FueQWyeHV5MDSkeUtKuw';

# Access control for update.php script.
$settings['update_free_access'] = FALSE;

# Load services definition file.
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

# The default list of directories that will be ignored by Drupal's file API.
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

# The default number of entities to update in a batch process.
$settings['entity_update_batch_size'] = 50;

# Entity update backup.
$settings['entity_update_backup'] = TRUE;


/**
 * Configurations particulières
 */

# Apache errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

# Récupération de l'environnement courant définit dans les variables d'environnement
$drupal_env = getenv('DRUPAL_ENV');

# Trusted host configuration.
$settings['trusted_host_patterns'] = [
  '^drupal8-formation\.app\.local\.fr$',
];

# Dossiers de synchronisation
$config_directories = [];
$config_directories['sync'] = '../config/sync';

# BDD
$databases = [];
$databases['default']['default'] = [
  'database' => $_ENV['SITE_DB_NAME'],
  'username' => $_ENV['SITE_DB_USER'],
  'password' => $_ENV['SITE_DB_PASSWORD'],
  'prefix' => '',
  'host' => $_ENV['SITE_DB_HOST'],
  'port' => $_ENV['SITE_DB_PORT'],
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
];

# Fichiers
$settings['file_public_path'] = 'sites/default/files';
$settings['file_private_path'] = 'sites/default/private';
$config['system.file']['path']['temporary'] = '/tmp';

# Caches
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';
$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
$settings['cache']['bins']['page'] = 'cache.backend.null';
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

# SMTP
$config['smtp.settings']['smtp_on'] = 1;
$config['smtp.settings']['smtp_host'] = 'smtp.office365.com';
$config['smtp.settings']['smtp_port'] = '587';
$config['smtp.settings']['smtp_protocol'] = 'tls';
$config['smtp.settings']['smtp_username'] = "tmessagerie@norsys.fr";
$config['smtp.settings']['smtp_password'] = 'MDP2tmsg!';
$config['smtp.settings']['smtp_from'] = 'tmessagerie@norsys.fr';
$config['smtp.settings']['smtp_fromname'] = 'Norsys drupal8-formation DEV';
$config['smtp.settings']['smtp_allowhtml'] = 1;
$config['smtp.settings']['smtp_debugging'] = 2;

# Site
//$config['system.site']['name'] = 'Drupal 8';
//$config['system.site']['slogan'] = '';
//$config['system.site']['frontpage'] = 'accueil';
//$config['system.site']['403'] = 'acces-refuse';
//$config['system.site']['404'] = 'page-introuvable';
$config['system.site']['mail'] = 'tmessagerie@norsys.fr';

# Config split :
# - blacklist : (bdd) exporte dans la BDD, ne sera pas pris en compte par les autres split ou sync
# - config_ignore : exécuté en priorité configuration du module config_ignore
# - dev
# - staging : recette
# - live : prod
$config["config_split.config_split.blacklist"]['status'] = TRUE;
$config["config_split.config_split.config_ignore"]['status'] = TRUE;
$config["config_split.config_split.dev"]['status'] = TRUE;
$config["config_split.config_split.staging"]['status'] = TRUE;
$config["config_split.config_split.live"]['status'] = FALSE;
