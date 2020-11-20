<?php

// WARNING: Fichier interne

/*
[----------------------------------------------------------------------------------
[ CONFIGURATION AVANCÉE DE IPHP - N'y touchez que si vous savez ce que vous faites.
[----------------------------------------------------------------------------------
[ /**ATTENTION: l'accès à ce fichier est restreint. Lisez la documentation pour sa-
[               voir ce que vous pouvez modifier à ce fichier
[
[ /** DÉTAILS TECHNIQUE:
[ Cet fichier fait partir du Framework IPHP et Consiste à un paramétrage avancée
[ de ce celui-ci. son accès est cependant restreint.
[  N'y touchez donc que si vous savez réellement ce que vous faites
[ au risque de perturber le bon fonctionnement de votre application
[ ou du logiciel lui même. Lisez la documentation à ce sujet pour savoir
[ ce que vous pouviez modifier ou ne pas modifier à ce fichier
[
*/

/**
 * TODO: planning des activités.
 *
 * {@link  / IPHP_DS}  séparateur de chemin (dynamique)
 * {@link  / FIX_DS}  séparateur de chemin (statique)
 * @const  PG_TITLE_KEY  clé de titrage de page (par défaut)
 * {@link  output/contents/content-pages}  RESOURCES_DIR chémin vers  content-pages
 * {@link  output/contents/includes}  INCLUDES_DIR chémin vers  includes
 * {@link  output/contents/switchers}  NAVIGATOR chémin vers  switchers
 * {@link  output/contents/header-php}  HEADER_PHP chémin vers  header-php
 *iphp.conf.php
 */

 const ZERO = 0,	 ONE = 1,	 TWO = 2,	 THREE = 3,	 FOUR = 4, FIVE = 5, SIX = 6, SEVEN = 7, EIGHT = 8, NINE = 9;

 include_once __DIR__ . '/../' . '/AppManager/_freeUserData.fw.php';

   /*
   [------------------------------------------------------------------------------------
   [ SEPARATEUR DE DOSSIER
   [------------------------------------------------------------------------------------
   [
   [ Un séparateur de dossier nous est fourni par la Constante DIRECTORY_SEPARATOR
   [ de PHP. Le Framework IPHP se base entièrement sur celui-ci
   [ afin d’assurer une sécurité informatique.
   [
   */
 define(
   'IPHP_DS', DIRECTORY_SEPARATOR
 );

   /*
   [------------------------------------------------------------------------------------
   [ UN SEPARATEUR DE DOSSIER PAR DEFAUT
   [------------------------------------------------------------------------------------
   [
   [ Nous définissons ci-dessous, un séparateur de dossier par défaut
   [ adapté pour tous type de système d’exploitation.
   [
   */
 define(
   'FIXED_DS', '/'
 );

 // Constantes pré-définies ¶
 define(
   'BY_DOT', '.'
 );

 // Constantes pré-définies ¶
 define(
   'CURRENTTEMPLATE', currTemplate()
 );

 // Constantes pré-définies ¶
 define(
   'BY_COLON', ':'
 );

 // Constantes pré-définies ¶
 define(
   'BY_UNIX_DS', '/'
 );

 /*
 [------------------------------------------------------------------------------------
 [ EXTENSION PHP
 [------------------------------------------------------------------------------------
 [
 [ Nous définissons ci-dessous, une constante pour utiliser l'extension de PHP
 [
 */
 define(
   'PHP_EXT', '.php'
 );


  /*
  [------------------------------------------------------------------------------------
  [ EXTENSION CSS
  [------------------------------------------------------------------------------------
  [
  [ Nous définissons ci-dessous, une constante pour utiliser l'extension de CSS
  [
  */
 define(
   'CSS_EXT', '.css'
 );


   /*
   [------------------------------------------------------------------------------------
   [ EXTENSION JS
   [------------------------------------------------------------------------------------
   [
   [ Nous définissons ci-dessous, une constante pour utiliser l'extension de JAVASCRIPT
   [
   */
 define(
   'JS_EXT', '.js'
 );


    /*
    [------------------------------------------------------------------------------------
    [ CLE DE TITRAGE DE PAGE VIA ROUTES
    [------------------------------------------------------------------------------------
    [
    [ Utiliser PG_TITLE_KEY à la 6ème ligne de vos fichiers de Route
    [ pour définir un titre pour vos pages.
    [
    */
 define(
   'PG_TITLE_KEY', 'page_title'
 );

   /*
   [------------------------------------------------------------------------------------
   [ DEFINITION DE CHEMINS
   [------------------------------------------------------------------------------------
   [
   [ Nous définissons ci-dessous, une constante pour utiliser l'extension de JAVASCRIPT
   [
   */

   /** {@link output/contents/content-pages} */
 define(
   'RESOURCES_DIR', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'contents' . IPHP_DS . 'content-pages'
 );


    /*
    [------------------------------------------------------------------------------------
    [ DEFINITION DE CHEMIN
    [------------------------------------------------------------------------------------
    [
    [ Les lignes ci-dessous définis des chemins vers des répertoires
    [ différents présents sur le Framework.
    [ // NOTE: L’architecture utilise ces constantes comme références.
               Vous n’êtes pas invitez à modifier ces chemins et ne
               le faites surtout pas si vous n’êtes pas sûre de
               savoir ce que vous faites.
    */

  /** {@link output/contents/includes/} */
 define(
   'INCLUDES_DIR', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'contents' . IPHP_DS . 'includes'
 );

  /** {@link output/[current]/application/application/Consts/} */
 define(
   'CONSTS_DIR', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'application' . IPHP_DS . 'application' . IPHP_DS . 'Consts'
 );

  /** {@link output/[current]/application/application/Routes/} */
 define(
   'NAVIGATOR', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'application' . IPHP_DS . 'application' . IPHP_DS . 'Routes'
 );

  /** {@link output/[current]/application/application/PhpPart/} */
 define(
   'HEADER_PHP', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'application' . IPHP_DS . 'application' . IPHP_DS . 'PhpPart'
 );

  /** {@link output/[current]/application/application/Class/} */
 define(
   'PHP_CLASS', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'application' . IPHP_DS . 'application' . IPHP_DS . 'Class'
 );

  /** {@link output/[current]/application/application/Modules/} */
 define(
   'MODULE', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'application' . IPHP_DS . 'application' . IPHP_DS . 'Modules'
 );

  /** {@link output/[current]/application/application/EmailingTemplates/} */
 define(
   'EmailingTemplates', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'application' . IPHP_DS . 'application' . IPHP_DS . 'EmailingTemplates'
 );

  /** {@link output/[current]/contents/languages/} */
 define(
   'TRANSLATION_FILES', 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'contents' . IPHP_DS . 'languages'
 );
