<?php


/*
[--------------------------------------------------------------------------
[ MODE D’AFFICHAGE
[--------------------------------------------------------------------------
[
[ Cette option détermine comment l’on souhaite voir affichés les
[ messages d’erreurs retournées par le Framework IPHP
[
*/

@define("ERR_DISPLAY_MODE", "Exception");


/**
* WARNING: Cette fonctionnalité ne doit resté activée qu'au cours de la PHASE DÉVELOPPEMENT
*					 de votre application. en PHASE DE PRODUCTION, il fortement recommandée de les désactivés en
*					 remplaçant les valeurs true et yes par false, no
*
* @return void
* @throws \Exception
*/

@define('IPHP_DISPLAY_ERRORS', true); // PHP peut afficher des erreurs


/*
[--------------------------------------------------------------------------
[ PAGE D'ERREURS
[--------------------------------------------------------------------------
[
[ Whoops nous fournir une belle page pour l'affichage des erreurs que nous
[ rencontrons pendant le développement de notre application. Cela va  nous
[ permettre de déboguer notre script de façon plus top!
[	Il suffit de de passer la valeur ci-déssous à 'yes' si elle ne l'est
[	pas déjà; pour activer cette page.
[
[	NOTE: Whoops est en Mode DEV. il est donc recommandée de rempacer la val-
 				eur ci-déssous par 'no' l'orsque vous êtes en MODE PRODUCTION...
*/

Controller\Roots\MainRoot::showExceptions(

	['allow_error_page' => 'yes'] // yes OR no

);
