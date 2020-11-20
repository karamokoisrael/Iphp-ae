<?php

return [
    /*
    [--------------------------------------------------------------------------
    [ CONFIGURATION DE LANGUE LOCAL
    [--------------------------------------------------------------------------
    [
    [ CONFIGURATION DE LANGUE LOCAL permet d’indiquer la langue par
    [ défaut qui devra être utiliser par le service
    [ de traduction pour votre application.
    [
    */
    'default' => 'fr',

    /*
    [--------------------------------------------------------------------------
    [ CONFIGURATION DE LANGUE DE SECOURS
    [--------------------------------------------------------------------------
    [
    [ CONFIGURATION DE LANGUE DE SECOURS détermine la langue utiliser
    [ par le service de traduction, lorsque celle active
    [ n'est pas disponible.
    [
    */
    'fallback_locale' => 'en',

    /*
    [--------------------------------------------------------------------------
    [ CLÉ DE SESSION DE CHANGEMENT
    [--------------------------------------------------------------------------
    [
    [ CLÉ DE SESSION DE CHANGEMENT détermine le nom d’index à utiliser
    [ pour la variable globale $_SESSION qui servira à changer
    [ de langue pour votre application.
    [
    */
    'change_key' => 'newlang',

    /*
    [--------------------------------------------------------------------------
    [ MESSAGES D'ERREURS DE TYPE EXCEPTIONS
    [--------------------------------------------------------------------------
    [
    [ MESSAGES D'ERREURS D'EXCEPTIONS détermine la langue dans laquel
    [ vous souhaiter voir afficher les messages d’erreurs
    [ d'Exceptions (Générés par le Framework IPHP).
    [
    // NOTE: Cette fonctionnalité n’est actuellement disponible que
             dans l’Édition Entreprise du produit.
    */
    'IPHPExceptionsErrMsg' => 'fr',

];
