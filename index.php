<?php
/*
===========================================================================================
=======================.----.==.--------.===-----===-----==.--------.=====================
                       °----°  |  ___    °  |   |   |   |  |  ___    °
                       |°°°°|  | /__/    °  |   |   |   |  | /__/    °
                       |    |  |    .___/   |   |°°°|   |  |    .___/
                       |    |  |    |       |   |°°°|   |  |    |
                       |    |  |    |       |   |   |   |  |    |
                       [____]  [____]       [___]   [___]  [____] 1.0.0 - [fr_FR]



 [--------------------------------------------------------------------------
 [ DEMARER L’AUTOLOADER
 [--------------------------------------------------------------------------
 [
 [ Composer fournit un loader de classe pratique et généré automatiquement
 [ pour notre application. Nous avons juste besoin de l'utiliser! Nous allons
 [ simplement le require dans le script
 [ ici afin que nous n'ayons pas à nous soucier
 [ du chargement manuel de nos classes plus tard. Cela fait du bien de se détendre.
 [
    ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/*/
require __DIR__. '/providers/Resources/autoload.php';


/**
 * @param  string $page_name (Ex: 'home') 	Veuillez renseigner cette valeur dans
 * {@link config/routes.php}. vous êtes libre d’indiquer cette valeur directement
 * en paramètre dans Controller\Roots\Router() ci-dessous. La valeur par défaut -
 * fournie avec la constante DEFAULT_PAGE dans le fichier de configuration
 * sera prise en compte si vous laissez vide.
 *
 * @see config/routes
 */
$router = new Controller\Roots\Router();

/*
[--------------------------------------------------------------------------
[ DÉMARRAGE DE LA ROUTE
[--------------------------------------------------------------------------
[
[ Maintenant que notre application est prête à l’emploi, nous allons pouvoir
[ gérer la demande entrante via le noyau et renvoyer la réponse	associée au
[ navigateur du client afin de leur permettre de profiter de la créative et
[ merveilleuse application que nous avons préparée pour eux.
[
*/
Controller\Roots\Router::getStartRooting();
