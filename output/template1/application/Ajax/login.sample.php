<?php
//Importer les classes IPHP dans l'espace de nom globale
use Controller\Controller\AppController;
use Model\Modelstatement\ModelClass;
use Model\Modelstatement\IPHPCRUD;
/**
 ** #TITRE: RÉCEPTION & TRAITEMENTS DE DONNÉES EN PROVENANCE D'AJAX **
 *
 ** #DESCRIPTION:
 * Ici, nous traitons sur des données reçus via AJAX (Une technologie
 * de JS pour la communication Client-Serveur) tout en mettant
 * l’accent sur la sécurité: Souvenez vous de la règle :
 * « NE JAMAIS FAIRE CONFIANCE AUX DONNÉES DES UTILISATEURS. »
 *
 **
 *
 * @package IPHP
 * @author Stéphane N'cho <contact@geniecodeurspro.group>
 * {@link https://www.skytech.org}
 * @var objet $Scanner  Contrôleur et validateur de données.
 * @var objet $db_conn  connexion à la base de données.
 * @var array $errors[]  Stocke les messages d’érreurs
*/

// NOTE: Cet exemple traite sur l'authentification d'utilisateur
//       en suposant qu'une insciption de celui-ci a déjà ete
//       effectuée avec l'example dans register.sample.php.


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
require_once __DIR__ . '/../../providers/Resources/autoload.php';
IPHPGetLoadElements();

/**
 * La ligne ci-dessous permet l’auto-chargement de nos classes externes:
 * @see /application/Class/*.class.php
 */
AppController::getAutoloadClassFromApplicationDir();


/**
 ** Vu qu’il est aussi bien intéressant d’envoyer des constantes à une classe, **
 *  nous allons ranger nos données dans ceux-ci sans toute fois se soucier
 *  pour les injections SQL! « Le Scanner s’en ai déjà occupé pour nous. »
 */
define('USERNAME', $_POST['username']);
define('PASSWORD', $_POST['password']);
// //...

/** Connexion à la base de données */
$db_conn = ModelClass::DB_connection();

/** Instantiation de la classe Model*/
$fetch = new IPHPCRUD();

//Select from
$fetch->tableName("table_user_private_data")
           ->colList("*")
           ->where("(username = :username OR email = :username OR phone = :username)")
           ->values(['username' => USERNAME])
           ->read();

/** Si les choses se sont bien passés, nous pouvons connecter
 *  l'utilisateur qui vient tout fraichement de s'inscire.*/
if ($fetch->results())  {

  if (password_verify(PASSWORD, $fetch->results()[0]->password))
  {
    if (session_status() == PHP_SESSION_NONE)
       session_start();

       $fetch->tableName("table_user_personnal_data")
             ->colList("*")
             ->where("id = ?")
             ->values([$fetch->results()[0]->user_id])
             ->read();

        // Les données de l'utilisateur sont stockés en variable de session
       $_SESSION['aldf_auth2020'] = $fetch->results();
       echo "success";
       exit;
  }else {
    echo "Identifiant ou mot de passe incorrect";
  }


}else {
  echo "Ce compte n'existe. Le créer ?";
}
