<?php

return [

    /*
    [--------------------------------------------------------------------------
    [ EXPÉDITEUR PAR DÉFAUT
    [--------------------------------------------------------------------------
    [
    [ Cette option définit le service d'expédition d'émail à utiliser
    [ par défaut pour tous les envois d’email par votre application.
    [ Bien attendu, vous avez la possibilité de remplacer cette
    [ valeur par une autre parmi nos différents services
    [ d’envoi disponibles:
    [
    [ Supportés : "smtp", "sendmail", "DKIM", "gmail",
    [            "gmail_xoauth", "qmail", "mail"
    [
    */

    'default' => 'smtp',

    /*
    [--------------------------------------------------------------------------
    [ Configurations des expéditeurs
    [--------------------------------------------------------------------------
    [
    [ ci-déssous, vous pouvez configurer tous les expéditeurs utilisés
    [ par votre application. là encore vous avez la possibilité
    [ d'ajouter ou de changer nos examples attribués.
    [
    */
    // $this->Username   = 'stephane@dievdesign.net';
    // $this->Password   = '@Admin2019';

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            /** Nom du serveur de messagerie. exemple: 'mail01.hebergeur.com' */
            'host' => '',
            /** Cette option doit être activée (TRUE). */
            'SMTPAuth' => true,
            /** Port utilisé pour transmettre le courrier sortant au serveur de messagerie. Utilisez le port 465 pour l'SSL et  587 pour le TLS */
            'port' => 587,
            /**  C'est généralement SSL, vous pouvez le changer en TLS si cela ne fonctionne pas. */
            'SMTPSecure' => 'tls',
            /** Encodage */
            'charset' => 'utf-8',
            /** Le nom d'utilisateur que vous utilisez pour accéder au compte de messagerie, c'est votre adresse mail. exemple: 'contact@mon-domaine.com' */
            'username' => '',
            /** Mot de passe que vous utilisez pour accéder au compte de messagerie */
            'password' => '',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => '/usr/sbin/sendmail -bs',
        ],

        'DKIM' => [
            'transport' => 'DKIM',
        ],

        'gmail' => [
            'transport' => 'gmail',
        ],

        'gmail_xoauth' => [
            'transport' => 'OAuth',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'SMTPSecure' => 'tls',
            'clientId' => 'RANDOMCHARS-----duv1n2.apps.googleusercontent.com',
            'password' => 'RANDOMCHARS-----lGyjPcRtvP',
            'refreshToken' => 'RANDOMCHARS-----DWxgOvPT003r-yFUV49TQYag7_Aod7y0',
        ],

        'mail' => [
            'transport' => 'mail',
        ],

    ],

    /*
    [--------------------------------------------------------------------------
    [ Adresse globale d'expéditions "De"
    [--------------------------------------------------------------------------
    [
    [ Vous pouvez souhaiter que tous les e-mails envoyés par votre
    [ application soient envoyés depuis la même adresse.
    [ ci-déssous, vous pouvez spécifier un nom et
    [ une adresse qui sont utilisé globalement
    [ pour tous les e-mails envoyés par votre application.
    [
    */
    'from' => [
        'address' => 'exemple@domaine.com',
        'name' => 'Nom de l\'entreprise',
    ],


];
