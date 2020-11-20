<?php
//Importer les classes IPHP dans l'espace de nom globale
use Controller\Controller\AppController;
use Model\Modelstatement\ModelClass;
use Model\Modelstatement\IPHPCRUD;
use Controller\Featured\Mailer;
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

// NOTE: Cet exemple traite sur un aspect professionnel, de
//       l’analyse et validation de données (grâce à la
//       classe Scanner), jusqu’à l’envoie au serveur
//       tout en mettant l'accent sur la sécurité.


/*
[--------------------------------------------------------------------------
[ DEMARER L’AUTOLOADER
[--------------------------------------------------------------------------
[
[ Composer fournit un loader de classe pratique et généré automatiquement
[ pour notre application. Nous avons juste besoin de l'utiliser! Nous
[ allons simplement le require dans le script ici afin que nous
[ n'ayons pas à nous soucier du chargement manuel de nos
[ classes plus tard. Cela fait du bien de se détendre.
[
*/
require_once __DIR__ . '/../../providers/Resources/autoload.php';
IPHPGetLoadElements();


/**
 * La ligne ci-dessous permet l’auto-chargement de nos propres classes :
 * @see /application/Class/*.class.php
 */
AppController::getAutoloadClassFromApplicationDir();

/**
 * La classe Scanner nous permet de contrôler et valider les données
 * reçus du client via AJAX. Nous pouvons nous en servir dans un
 * premier temps avant tout autres traitements supplémentaires
 *
*/

/**
 * @param $_POST  à remplacer par $_GET si vous recevez via la methode 'GET'
 */
$Scanner = new Scanner(
  $_POST
);

$errors = []; // $errors peut stocker la liste des méssages du traitement.

  /**
   * à présent proccedons à l'analyse des données grâce aux méthodes de
   * traitements que nous offre, la classe Scanner.
   *
   * @see https://skytech.org/iphp/security/
  */
$Scanner
    // Analyse du champ  [name="email" type="email"]
      ->isNotValidEmail('email', "Addresse E-mail invalide.")
      // Analyse du champ [name="firstname" type="email" && // type="text"]
      ->isNotFirstName('firstname', "Le champ prénom est invalide")
      // Analyse du champ [name="lastname" type="text"]
      ->isNotLastName('lastname', "Le champ nom est invalide")
      // Analyse du champ [name="password" type="password"] && || [type="text"]
      ->isNotPossiblePW('password', "Le champ mot de passe est invalide (8 caractères minimum)")
      // Analyse d'existence (d'email par example) en table (...)
      ->verify('user_id')->in('tableName')->where('email = ?')->values($_POST["email"])->errMessage('l\'dresse E-mail n\'est pas disponible.')->isInTable();
  					//...

if ( !$Scanner->isValidated() )
  /*
   * Si le Scanner n'a pas validé les données, vous pouvez afficher les
   * messages à l’utilisateur avce l’instruction suivante:
  */
$Scanner->displayWithListItem();

/*
 * Si par contre vous souhaitez stocker les messages pour les
 * afficher vous même plustard manuellement, vous pouvez
 * plutôt faire comme ceci:
*/
$errors[] = $Scanner->getErrors();



/** A PARTIR D’ICI NOS DONNÉES ONT BIEN ÉTÉ VALIDÉS PAR LE SCANNER; */

/** NOTE: VOUS POUVEZ EFFECTUER D’AUTRES TRAITEMENTS SUPPLÉMENTAIRES
 *        SUR CES DONNÉES AVEC VOS PROPRES CLASSES OU FONCTIONS, PUIS
 *        LES EXÉCUTERS VERS LE SERVEUR.
 *
 * REGARDER L'EXAMPLE CI-DESSOUS:
 */


/**
 ** Vu qu’il est aussi bien intéressant d’envoyer des constantes à une classe, **
 *  nous allons stocker nos données dans ceux-ci sans toute fois se soucier
 *  pour les injections SQL. En effet, nous venons de les traiter un
 *  peu plus haut a l'aide  notre Scanner.
 */
define("COLLIST", "name = ?, firstname = ?");
define("PERSONNAL_DATA", [$_POST['firstname'], $_POST['lastname']]);
define('EMAIL', $_POST['email']);
define('PASSWORD', $_POST['password']);
// //...

/** Connexion à la base de données */
$db_conn = ModelClass::DB_connection();

  /** Instantiation de la classe IPHPCRUD*/
$createUser = new IPHPCRUD();
  // Instantiation de la classe Mailer
$mail = new Mailer();


$password = password_hash($_POST["rgstpw"], PASSWORD_BCRYPT);
$tokenLink = Str::random(30);
$tokenCode = random_int(10000, 90000);
$uniqid = Str::randomInt(9);

  //insert to table 1
$createUser->tableName("table_user_personnal_data")
           ->colList(COLLIST)
           ->values([PERSONNAL_DATA])
           ->create();

  // recupération de l'id de la dernnière insertion en table
$lastId = $createUser->lastIdInsertedVal();

 //insert to table 1
$createUser->tableName("table_user_private_data")
           ->colList("user_id = ?, user_uniqid = ?, email = ?, password = ?, confirm_code = ?, confirm_token = ?")
           ->values([$lastId, $uniqid, $_POST['email'], $password, $tokenCode, $tokenLink])
           ->create();

/** Si l'enregistrement des informations de l'utilisateur s'est bien passé,'
 *  Envoi d'email de confirmation et un retour de succès à AJAX.*/
if ($createUser->created())  {

// envoi d'email de confirmation
$mail->to($_POST["rgsteml"], $_POST["rgstfrtnm"])
     ->subject("Confirmation de votre compte")
     ->mailContent( confirmMailBody("{$_POST["rgstfrtnm"]} {$_POST["rgstltnm"]}", $tokenCode, $tokenLink) )
     ->send();

   echo "success";
   exit;
}
