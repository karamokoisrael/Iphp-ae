<?php

// WARNING: Fichier interne

define('IPHP_START', microtime(true));

/*
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
*/

require_once __DIR__ . '/../../vendor/autoload.php';


/**
 *[--------------------------------------------------------------------------
 *[ ACTIVER LE DEBUGER
 *[--------------------------------------------------------------------------
 *[
 *[ @see /config/errors.php
 *[ @see /providers/Resources/messages/messages.php
 *[
*/



require_once __DIR__ . '/../../config/errors.php';

require_once __DIR__ . '/../../config/app.php';

require_once __DIR__ . '/../../providers/Resources/auto-providers/consts.php';

require_once __DIR__ . '/../../providers/Resources/messages/messages.php';
