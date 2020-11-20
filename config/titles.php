<?php

return [

    /*
    [----------------------------------------------------------------------------------------
    [ TITRAGE DE PAGE
    [----------------------------------------------------------------------------------------
    [
    [ Lorsque nous utilisons un entête unique pour nos vues, nous sommes confrontés au
    [ problème du texte de titre dans les balises <title></title> de HTML qui ne
    [ change pas pour chacune de nos pages. Cette section nous permet de pallier
    [ à ce problème à partir d'un tableau nous permettant de lister nos titres.
    [
    */

    'Routes' => [
        'home' => 'Bienvenue à l\'accueil',
        'our-services' => 'nos services',
        'my-dashboard' => 'Mon Tableau De Board',
        'feed' => 'Notre fil d\'actualité',
    ],

    /*
    [----------------------------------------------------------------------------------------
    [ TITLE FOR ERROR 404 & IPHP DEFAULT HOME PAGE
    [----------------------------------------------------------------------------------------
    [
    [ Personnalisez les Titres des pages 404 et home-iphp...
    [
    */

    'page' => [
        '404' => [
            'title' => 'Erreur 404',
        ],

        'welcome' => [
            'title' => 'token',
        ],
    ]

];
