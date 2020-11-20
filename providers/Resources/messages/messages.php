<?php
use \Controller\Handler\IphpExceptions;
function IphpThrowError(...$args)
{
  $handler = new \Controller\Handler\IphpExceptions();

  $showError = function()  {
    return $this->_errMsg;
  };

  //Initialisation
  $args[0] = $args[0] ?? null;
  $args[1] = $args[1] ?? null;
  $args[2] = $args[2] ?? null;
  $args[3] = $args[3] ?? null;
  $args[4] = $args[4] ?? null;

  $_errorsArray = [

        /*
        [--------------------------------------------------------------------------
        [ MESSAGES D'ERREURS IPHP
        [--------------------------------------------------------------------------
        [
        [ Cette liste determine les erreurs à afficher en cas d'Exception
        [
        // NOTE: N’y touchez que si vous saviez réellement ce que vous faites.
        */

        'errcd21210' => "Vueillez utiliser une version plus récente de PHP: à partir de la $args[1] par example...",
        'errcd21211' => "Erreur d'AutoLoading de classes externes: La classe " . $args[1] . " n'existe pas dans [ " . $args[2] . " ]",
        'errcd21212' => "Une erreur est survenue; Verifier votre Base De Données.",
        'errcd21213' => "Le champ que vous essayez de Scanner n'a pas été défini: (". $args[1].")",
        'errcd21214' => "Expéditeur invalide: (". $args[1].") dans [ /config/mail.php ]",
        'errcd21215' => "Aucun titre trouvé pour la vue « $args[1].html ». Vérifiez [". NAVIGATOR . IPHP_DS . "$args[1].iphp]",
        'errcd21216' => "La Route ($args[1].iphp) de cette vue contient des caractères non attendu [". NAVIGATOR . IPHP_DS . "$args[1].iphp]",
        'errcd21217' => "La Route « $args[1].iphp » n'est pas valide [". NAVIGATOR . IPHP_DS . "$args[1].iphp]",
        'errcd21218' => "Le fichier « $args[1] n'existe pas dans [ " . str_replace($args[1], '', $args[2]) . " ] ou a été supprimé.",
        'errcd21219' => "Le template « $args[1] n'existe pas dans [ " . str_replace($args[1], '', $args[2]) . " ] ou a été supprimé.",
        'errcd21220' => "Malheureusement je ne parviens pas à charger la page d’erreur personnalisée : veuillez vérifier NOTE_FOUND_PAGE dans [config/app.php]",
        'errcd21221' => "Erreur de traduction: Référence « $args[1] » invalide. Format « nom_fichier.indexTableau » attendu.",
        'errcd21222' => "Catégorie de traduction introuvable: « $args[1].php » n'existe pas dans [ /" . TRANSLATION_FILES . "/". $args[2] . "/ ].",
        'errcd21223' => "La clé « $args[1] » n'existe pas dans [ /$args[2] ]",
        'errcd21224' => "La classe « $args[1] » n'existe pas dans [ $args[2] ]",
        'errcd21225' => "Le Module « $args[1] » n'existe pas dans [ /application/application/Modules/ ]",
        'errcd21226' => "Le Module « $args[1] » ne contient pas de fichier 'main' dans[ /application/application/Modules/$args[1]/ ]",
        'errcd21227' => "Impossible d'importer « $args[1] ». Verifier si le paramètre passé à la fonction import() est valide...",
        'errcd21228' => "LOAD$args[2]FILES() Indique: « Impossible de charger les fichiers $args[2] ». Le répertoires indiqué n'a pas été trouvé. [ $args[1] ]",
        'errcd21229' => "LOAD$args[2]FILES() Indique: « Le fichiers $args[2].PHP est manquant dans [$args[1]] ». Ceci est la représentation d'une grave erreur.",
        'errcd21230' => "LOAD$args[3]FILES() Indique: « La référence '$args[1]' n'existe pas dans $args[2] ».",
        'errcd21231' => "LOAD$args[4]FILES() Indique: « Le groupe '$args[1]' n'existe pas pour la référence '$args[2]' dans $args[3] ».",
        'errcd21232' => "LOAD$args[2]FILES() Indique: « Le fichier '$args[2].PHP' n'est pas valide dans $args[1] ».",

    ];

    if (array_key_exists($args[0], $_errorsArray))
    {
      $handler->_errMsg = $_errorsArray[$args[0]];

      if (ERR_DISPLAY_MODE == "Exception") {
        $handler->IphpHandlerThrower();
      }

      $error = "<span style=\"color: #fe610b;font-size: 25px;\"><strong>IPHP_ERROR: </strong>";
      $error .= $showError->call($handler);
      $error .= "</span>";
      echo $error;
    }

    die("Impossible de detecter le code d'erreur <strong>" . $args[0] . "</strong>");
}
