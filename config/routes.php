<?php

/*
[--------------------------------------------------------------------------
[ PAGE D'ACCUEIL
[--------------------------------------------------------------------------
[
[ Cette valeur étant le nom d’une route, représente  la vue par défaut que
[ vous voudriez appeler quand un utilisateur arrive sur votre site (monsite
[ .com). Vous pouvez changer cette valeur à tout moment, cela dépend entiè-
[ rement de vous !
[
*/

define('DEFAULT_PAGE', '');


/*
[--------------------------------------------------------------------------
[ URL DE NAVIGATION PAR DEFAUT
[--------------------------------------------------------------------------
[
[ L’url de navigation détermine la route que vous souhaitez appliquer par -
[ défaut l’osque vous appelez la fonction ou la méthode Iphp_navigation() -
[ dans vos attribues HTML « href ». Vous êtes libre de changer cette valeur
[ à tout moment et comme bon vous semble !
[
*/

define('DEFAULT_NAV', '');

/*
[--------------------------------------------------------------------------
[ TITRE PAR DEFAUT DE PAGE
[--------------------------------------------------------------------------
[
[ À l'appel du module ou de la methode dynamicPageTitle() entre les balises
[ <title></title> de votre page, cette valeur est appliquée l'orsque la clé
[ page_title est présente dans votre route IPHP.
[
*/

define('DEFAULT_PG_TITLE', DEFAULT_PAGE . ' - Bienvenue!');
