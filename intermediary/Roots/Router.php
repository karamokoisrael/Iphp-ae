<?php
namespace Controller\Roots;
/**
 *
 */

use Controller\Controller\AppController as GetController;
include_once __DIR__ . '/../../config/routes.php';
class Router extends MainRoot
{
  /**
  * @var private static $_currentPage  la requette du client
  * @var private static $_header  l'entête
  * @var private static $_footer  le pied de page
  */

  use \Controller\Extended\Router;

  private static $_currentPage;
  private static $_header, $_footer;

  public function __construct($currentPage = DEFAULT_PAGE)
  {
    $currentPage = isset(
      $_GET['page']
      ) ? $_GET['page']:$currentPage;
    self::$_currentPage = trim($currentPage, IPHP_DS);
  }

  /*
  [---------------------------------------------------------------------------
  [ PAGINATION
  [---------------------------------------------------------------------------
  [
  [ Préparons aussi un système pour notre navigation sur les différentes pages
  [ de notre belle application !
  [
  */

  public static function Iphp_navigation()
  {
    /**
    * Description de method
    *
    * @param <const> NAVIGATOR output/contents/switchers
    *
    * @return array list of files got from @param directory
    */
    $navdata = (
      !empty(DEFAULT_NAV)
    );

    if ($navdata)
        return DEFAULT_NAV;

    $dir = opendir(
      NAVIGATOR
    );
    $page = [];

    while ($pages = readdir($dir))    {

      $test = (
        !in_array($pages, array('.', '..'))
        ) ?
      $test = true :
      $test = false ;

      if ($test)
          $page[] = $pages;
    }

    return $page;
  }


    /*
    [----------------------------------------------------------------------------
    [ CRÉATION DE VUE
    [----------------------------------------------------------------------------
    [
    [ comme son nom nous l'indique cette methode crée probablement notre vue sans
    [ faire trop de bruit...
    [
    */

  public static function CreateView($sections)
  {
    foreach ($sections as $key => $values)
            require_once $values;
  }
}
