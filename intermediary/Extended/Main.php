<?php
namespace Controller\Extended;
/**
 *
 */
use \Whoops\{Run as HandlerThrower};
use Controller\Controller\{AppController as Cntrl};

trait Main
{

  /*
  [--------------------------------------------------------------------------
  [ GÉNÉRATEUR DE FICHIERS
  [--------------------------------------------------------------------------
  [
  [ Méthode utilisée par IPHPGetLoadElements() pour permettre la
  [ génératon d'une liste de fichiers séparée par virgules.
  [
  */
  public static function generator($param)
  {
    $output = null;
    foreach ($param as $key => $value)
            $output .= $value.',';

    return $output;
  }

  /*
  [--------------------------------------------------------------------------
  [ CHARGEMENT DES FICHIERS
  [--------------------------------------------------------------------------
  [
  [ Méthode utilisée par  IPHPGetLoadElements() pour charger une
  [ liste de fichiers contenu dans un dossier
  [ spécifique, séparée par virgules.
  [
  */
  public static function load($param)
  {
    $baseDir = dirname(
      dirname(__DIR__)
      ) . IPHP_DS;

    foreach ($param as $k => $v)
    {
      if (is_readable($v)) {
        require_once "$v";
      }
    }
  }


  public static function iphp_welcome()
  {
    $testPHP = function (){
      return phpversion() < "7.4.0" ? IphpThrowError(
        "errcd21210", "7.4.0"
        ):"IPHP <span style=\"font-size: 25px;position: relative;bottom: 0;right: 60px;\"> AE-v1.0.0</span>";
    };

    $user_work_start = empty(
      self::appRoutes() ? false:true
    );
    if (!$user_work_start) {
        file_exists(
          'welcome.html'
          ) ? require_once 'welcome.html' : die(
            '<div style="height: 40vh;text-align: center;font-size: 35px;color: gray;"><h1>IPHP</h1><p>Ce projet n’a pas encore enregistrée de Route…</p></div>'
          );
        exit;
    }
  }

  /**
   * Teste l'existence d’un fichier que tente charger votre Route
   *
   * @param array $data - Référence à la route courante
   * @return bool $retval
   */
  public static function isPageExisted(array $data): bool
  {

    $retval = true;
    foreach ($data as $key => $values)
		{

      if (!file_exists($values))      {

        $retval = explode(
          IPHP_DS, $values
        );
        $retval = array_pop(
          $retval
        );
        IphpThrowError(
          "errcd21218", $retval, $values
        );
        $retval = false;
      }

    }

    return $retval;
  }


  static function showExceptions()
  {
    [$toggoler] = func_get_args() ;
    $errors = new HandlerThrower;

    if (IPHP_DISPLAY_ERRORS)
    {

      $toggoler = (
        $toggoler[
          'allow_error_page'
          ] == 'yes' ?true:false
      );

      if ($toggoler)
          $errors->pushHandler(new \Whoops\Handler\PrettyPageHandler)->register();

    }

    else
        error_reporting(0);

  }


  static function appRoutes(): array
  {
    return glob(
      NAVIGATOR . IPHP_DS . '*.{iphp}', GLOB_BRACE
    );
  }


  /*
  [--------------------------------------------------------------------------
  [ APPLIQUER LA TRADUCTION
  [--------------------------------------------------------------------------
  [
  [ getTrans() retourne une traduction à partir de la clé qu’elle
  [ prend en paramètre, depuis la catégorie courante.
  [
  */
  public static function getSetLocale($local)
  {
    self::can_sess_start();
    $_SESSION[
      Cntrl::iphpConfig(
        "language.change_key"
        )
      ] = $local;
  }

  /**
   * Détermine si la langue que tente utiliser l’application
   * est bien une langue définie.
   *
   * @param  string  $locale
   * @return bool
   */
  public function isLocale($locale)
  {
    return self::isAnLocal(
      $locale
  );
  }

  /*
  [--------------------------------------------------------------------------
  [ LANGUE ACTIVE
  [--------------------------------------------------------------------------
  [
  [ GetLocale() retourne la langue en cours d’utilisation
  [ par notre application.
  [
  */
  public function getLocale(){

    return self::localStart(
      Cntrl::iphpConfig(
        "language.change_key"
        )
    );
  }

  /*
  [--------------------------------------------------------------------------
  [ LANGUE ACTIVE
  [--------------------------------------------------------------------------
  [
  [ localStart() retourne la langue en cours d’utilisation
  [ par notre application.
  [
  */
  public function localStart($localRef)
  {
    self::can_sess_start();

    if (array_key_exists($localRef, $_SESSION)) {
      return $_SESSION[$localRef] ?? Cntrl::iphpConfig(
        "language.default"
      );
    }

    return Cntrl::iphpConfig(
      "language.default"
    );
  }
  /**
   * Cette méthode de la Classe Controller retourne un contenu par
   * défaut à générer pour nos fichiers PHP entêtes.
   */
  public static function __hPHPcontent($data):string
  {
    return $contents = '<?php
/**
 * Ici, du PHP pour notre vue ' . $data . '.html
 * @var $variables -	Définitions de variables qui seront
 * réutiliser plus-tard dans cette vue.
 * @see ' . $data . '.html		Notre vue
 * {@link '.RESOURCES_DIR. IPHP_DS . $data . '.html}		Chemin vers la vue
 * @since '.date('Y-m-d - H:i:s'). '
 */

 use Model\Modelstatement\ModelClass;

 /*
 [--------------------------------------------------------------------------
 [ ÇA COMMENCE ICI
 [--------------------------------------------------------------------------
 [
 [ Ci-dessous, notre code PHP pour la vue ' . $data . '.html
 [
 */

// Connexion à notre base de donnée
// $db = Model\Modelstatement\ModelClass::DB_connection();

';
  }

  /**
   * Cette méthode de la Classe Controller retourne un contenu par
   * défaut à générer pour nos fichiers de vues HTML (client).
   */
  public static function __hViews_content()
  {
    return '<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bienvenue !</title>
  </head>

  <body>
    Salut Le Monde!
  </body>

</html>';
  }

}
