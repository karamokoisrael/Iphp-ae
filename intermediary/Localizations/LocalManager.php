<?php
namespace Controller\Localizations;
/**
 *
 */

use Controller\Controller\{AppController as Cntrl};
use Controller\{Main as General};

class LocalManager implements LocalizationMap
{

  /*
  [--------------------------------------------------------------------------
  [ RÉFÉRENCE DE TRADUCTION
  [--------------------------------------------------------------------------
  [
  [ getLocalRef nous retourne un format de référence valide pour
  [	la traduction de nos textes.
  [
  */
  public function getLocalRef(string $ref): string
  {

  $dataValidate = count(explode(".", $ref));
   if ($dataValidate == Cntrl::TWO)
      return $ref;

  IphpThrowError("errcd21221", $ref);
  }

  /*
  [--------------------------------------------------------------------------
  [ CATÉGORIE DE TRADUCTION
  [--------------------------------------------------------------------------
  [
  [ getLocalCat nous retourne un nom de fichier de traduction comme
  [ Catégorie à partir d’une référence donnée.
  [
  */
  public function getLocalCat(string $ref): string
  {

    $ref = self::getLocalRef($ref);
    $ref = explode(
      ".", $ref
    );
    return self::avalabilityOfLocalCat(
      $ref[0], $ref[1]
    );
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
  public function avalabilityOfLocalCat(string $refCat, string $index): string
  {

    $langDefault = Cntrl::iphpConfig(
      "language.default"
    );

    $lang = self::settedLocal(
      Cntrl::iphpConfig(
        "language.change_key"
        )
      ) ?? $langDefault;

    $langFileOpt = TRANSLATION_FILES . IPHP_DS . $lang . IPHP_DS . $refCat . ".php";
    if(file_exists($langFileOpt))
      return self::getTrans($index, $langFileOpt);

    IphpThrowError("errcd21222", $refCat, $lang);
  }

  /*
  [--------------------------------------------------------------------------
  [ CHANGEMENT DE LA LANGUE
  [--------------------------------------------------------------------------
  [
  [ La méthode settedLocal() ci-dessous retourne la valeur de la
  [ nouvelle langue défini par l’utilisateur
  [ pour le service de traduction.
  [
  */
  public function settedLocal(string $indexKey): ?string
  {
    General::can_sess_start();
    return $lang = (
      array_key_exists($indexKey, $_SESSION)
      ) ?
           $lang = $_SESSION[$indexKey] :
           $lang = null;
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
  public function getTrans(string $index, string $ref): string
  {
    $transData = require $ref;
    if ( array_key_exists($index, $transData) )
       return $transData[$index];

    IphpThrowError("errcd21223", $index, $ref);
  }

}
