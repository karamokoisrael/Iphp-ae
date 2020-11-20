<?php
namespace Controller;
/**
 *
 */
use Controller\{Users};
use Controller\Controller\{AppController as Cntrl};

class Main extends Users
{

	use \Controller\Extended\Main;

  /*
   [--------------------------------------------------------------------------
   [ CHARGEMENT DE VOS CLASSES
   [--------------------------------------------------------------------------
   [
   [ requireClass() fait chemin vers le répertoire stockant vos
   [ différentes classes afin de les auto charger via la
   [ méthode de chargement automatique de classes.
   [
  */
	static function requireClass(string $className): void
	{
    $file = __DIR__ . '/../' . PHP_CLASS . IPHP_DS . $className . ".class." . "php";

    $file = str_replace(
			'\\/', DIRECTORY_SEPARATOR, $file
		);
    if (file_exists($file)){
       require_once $file;
		}else {
			IphpThrowError(
				"errcd21224", $className, PHP_CLASS
			);
		}

	}

	/*
   [--------------------------------------------------------------------------
   [ DISPONIBILITÉ D'OPTION DE TRADUCTION
   [--------------------------------------------------------------------------
   [
   [ avalabilityOfLocalCat() permet de vérifier la disponibilité
   [ d’une Catégorie de traduction donnée.
   [
  */
	static function can_sess_start()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	/*
  [--------------------------------------------------------------------------
  [ DISPONIBILITÉ D'OPTION DE TRADUCTION
  [--------------------------------------------------------------------------
  [
  [ avalabilityOfLocalCat() permet de vérifier la disponibilité
  [ d’une Catégorie de traduction donnée.
  [
  */
  public function isAnLocal(string $dirname): string
  {
    $retval = false;
    $langFileOpt = TRANSLATION_FILES . IPHP_DS . $dirname . IPHP_DS;
    if(is_dir($langFileOpt))
      $retval = true;

    return $retval;
  }
}
