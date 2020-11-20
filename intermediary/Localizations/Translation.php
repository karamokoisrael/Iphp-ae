<?php
namespace Controller\Localizations;
/**
 *
 */
use \Whoops\{Run as HandlerThrower};
use Controller\{Main as General};

class Translation
{

  /*
  [--------------------------------------------------------------------------
  [ RTRADUIRE UN MESSAGE.
  [--------------------------------------------------------------------------
  [
  [ Utilisez la méthode get() pour appliquer la traduction de vos textes.
  [
  */
  static function get(string $ref)
  {
    return LocalManager::getLocalCat(
      $ref
    );
  }

  /*
  [--------------------------------------------------------------------------
  [ CHANGEMENT PERSONNALISÉ OU MANUEL DU LOCAL
  [--------------------------------------------------------------------------
  [
  [ Lorsque le visiteur choisit une langue, autre que celui définit
  [ par défaut, vous utilisez la méthode setLocale du
  [ Framework pour appliquer ce choix.
  [
  */
  static function setLocale(string $locale)
  {
    return General::getSetLocale(
      $locale
    );
  }

  /*
  [--------------------------------------------------------------------------
  [ LANGUE ACTIVE
  [--------------------------------------------------------------------------
  [
  [ GetLocale() retourne la langue en cours
  [ d’utilisation par l’application
  [
  */
  static function getLocale()
  {
    return General::getLocale();
  }

  /*
  [--------------------------------------------------------------------------
  [ TEST DE DISPONIBILITÉ DE LANGUE
  [--------------------------------------------------------------------------
  [
  [ Détermine si la langue que tente utiliser l’application
  [ est bien une langue définie.
  [
  */
  static function isLocale(
    $localName
    )
  {
    return General::isLocale(
      $localName
    );
  }
}
