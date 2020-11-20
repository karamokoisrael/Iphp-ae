<?php

/*
[--------------------------------------------------------------------------
[ FOCUS
[--------------------------------------------------------------------------
[
[ La fonction suivante permet d'indiquer la page active via une classe css
[ "active" par exemple, fournie par le Framework css Bootstrap par exemple.
[
*/
function active()
{

  [$callable, $clsName] = func_get_args();

  return (
    isset($_GET['page']) && $_GET['page'] == $callable
    )?$clsName:null;

}

  /*
  [--------------------------------------------------------------------------
  [ IMPORT
  [--------------------------------------------------------------------------
  [
  [ Utilisez import() pour effectuer les importations des modules
  [ IPHP que vous souhaitez utiliser dans votre script…
  [
  */
function get_import (string $__ref) {
  $baseDir = dirname(
    dirname(__DIR__)
    ) . IPHP_DS;

  $dir = $baseDir.MODULE . IPHP_DS . $__ref;

  if (is_dir ($dir))  {

    if (!defined('FILE')) {
      define(
        'FILE', $baseDir . MODULE . IPHP_DS . $__ref . IPHP_DS . 'main' . PHP_EXT
      );
    }

    if(is_file(FILE)) { require_once FILE;
      }else {
      IphpThrowError(
        "errcd21226", $__ref
      );
    }
  }
  else {
    IphpThrowError(
      "errcd21225", $__ref
    );
  }

}


/*
[--------------------------------------------------------------------------
[ MISE EN PAGE & PROGRAMATION AVANT-PLAN
[--------------------------------------------------------------------------
[
[ Utilisez loadCssFiles() ou loadJsFiles() pour charger les fichiers css
[ ou javascripts que vous souhaitez utiliser pour la mise en page
[ et la programmation avant-plan de de votre script…
[
*/
function getApplyStylesheet() {

  [$dataType, $ref, $from, $baseFrom, $group] = func_get_args();
  $base = $baseFrom . $dataType . PHP_EXT;

  if (file_exists($base))
  {

    $data = require($base);
    if (is_int($data)) {
      return IphpThrowError(
        "errcd21232", $baseFrom, strtoupper($dataType)
      );
    }

    if (array_key_exists(
      $ref, $data
      )) {
        return pool($group, $data, $ref, $from, $dataType, $base);

    }else {
      IphpThrowError(
        "errcd21230", $ref, $base, strtoupper($dataType)
      );
    }
  }else {
    IphpThrowError(
      "errcd21229", $baseFrom, strtoupper($dataType)
    );
  }
}



/*
[--------------------------------------------------------------------------
[ MISE EN PAGE & PROGRAMATION AVANT-PLAN
[--------------------------------------------------------------------------
[
[ Utilisez loadCssFiles() ou loadJsFiles() pour charger les fichiers css
[ ou javascripts que vous souhaitez utiliser pour la mise en page
[ et la programmation avant-plan de de votre script…
[
*/
function pool($group, $data, $ref, $from, $dataType, $base){
  if (array_key_exists(
    $group, $data[$ref]
  )) {
    $from = str_replace(['/', '\\'], IPHP_DS, $from . $ref . IPHP_DS);
    return getLoadCssJsFiles(
      $dataType, $data[$ref][$group], $from
    );

  }else {
    IphpThrowError(
      "errcd21231", $group, $ref, $base, strtoupper($dataType)
    );
  }
}
