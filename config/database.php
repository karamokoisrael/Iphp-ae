<?php
/**
 * Ce fichier contient la configuration de la Base de Données de votre Projet.
 *
 *
 * @package Iphp
 */

/** [ Réglages MySQL - c'est votre hébergeur qui vous fournir ces informations. */

/** Type de Base De Données*/
define('DSN', 'mysql');

/** Nom de la base de données. */
define('DB_NAME', 'alodifa');

/** Utilisateur pour la connexion la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de connexion à la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'UTF8');

define('HOSTING', DSN . ':host=' . DB_HOST . ';dbname=' . DB_NAME);


// DBCONN_ERR_MSG message à afficher en cas d'erreur
define('DBCONN_ERR_MSG', 'Erreur de connexion à la base de donnée');
