<?php

/*
[--------------------------------------------------------------------------
[ IMPORT
[--------------------------------------------------------------------------
[
[ Utilisez import() pour effectuer les importations des modules
[ IPHP que vous souhaitez utiliser dans votre script…
[
*/
function import() {

  $__ref = explode(
      BY_COLON, [$__ref] = str_replace(
      BY_UNIX_DS, BY_COLON, func_get_arg( ZERO )
      )
  );

  $setup_1 = $__ref [ZERO] == 'module';
  $setup_2 = $__ref [ONE] == 'iphpmodules';

  if ( $setup_1 && $setup_2 ) {
    get_import ( $__ref[TWO] );
  }else {
    IphpThrowError(
      "errcd21227", $__ref [TWO]
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
function getStylesheet() {

  if(!defined('FROM')){
    define(
    'FROM', func_get_arg( ZERO )
    );
  }

  $ref = func_get_arg( ONE );
  $from = str_replace(
    [
    '/','\\'
    ], IPHP_DS, FROM
  );
  if (is_dir ($from))  {
    return getApplyStylesheet(func_get_arg( TWO ), $ref, $from, func_get_arg( THREE ), func_get_arg( FOUR ));
  }else {
    IphpThrowError(
      "errcd21228", FROM, strtoupper(
        func_get_arg( ONE )
        )
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
function getLoadCssJsFiles(string $fileType, array $files, string $base){
  $output = null;

  for ($i=0; $i < count($files); $i++) {
    $output .= (
      $fileType == 'js'
      )
    ?'<script type="application/javascript" src="' . \Controller\Controller\AppController::pdynamic_URI($base.$files[$i].JS_EXT) . '"></script>'
    :'<link rel="stylesheet" type="text/css" href="' . \Controller\Controller\AppController::pdynamic_URI($base.$files[$i].CSS_EXT) . '">';
    continue;
  }
  return $output;
}
