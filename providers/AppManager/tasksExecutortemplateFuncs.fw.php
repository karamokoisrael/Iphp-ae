<?php
use \Whoops\{Run as HandlerThrower};
use \Controller\Handler\IphpExceptions;

/*
[--------------------------------------------------------------------------
[ EST-CE UN TEMPLATE ?
[--------------------------------------------------------------------------
[
[ Cette fonction tente de nous avertir de l’existence d’un
[ Template dans le répertoire /output/.
[
*/
function is_template(){

  $baseDir = dirname(
    dirname(__DIR__)
    ) . IPHP_DS;

  $CT = func_get_arg(0);

  $dir = $baseDir . 'output' . IPHP_DS . $CT;
  if (is_dir ($dir)) {
    return is_valid_template($CT);
  }else {
    $errors = new HandlerThrower;
    $errors->pushHandler(new \Whoops\Handler\PrettyPageHandler)->register();
    $handler = new \Controller\Handler\IphpExceptions();
    $handler->_errMsg = "Je ne trouve pas de Template inscrit sous le nom de ". mb_strtoupper($CT) ." dans [/output/] ».";
    $handler->IphpHandlerThrower();
  }
}


/*
[--------------------------------------------------------------------------
[ EST-CE UN TEMPLATE ?
[--------------------------------------------------------------------------
[
[ La fonction is_valid_template() nous permet de confirmer que
[ le répertoire trouvé dans /output/ est bien un Template.
[
*/
function is_valid_template(){
  $retval = true;
  $baseDir = dirname(
    dirname(__DIR__)
    ) . IPHP_DS;

  $CT = func_get_arg(0);

  $dir = $baseDir . 'output' . IPHP_DS . $CT. IPHP_DS;
  $validTemplates = ['application', 'contents', 'media', 'public', 'public_alt'];
  foreach ($validTemplates as $value) {
    if (!in_array($value, listDir($dir))) {
      $retval = false;
    }
  }

  return $retval;
  // return true;
}

function listDir($userTemplate)
{
  /**
  * Description de method
  *
  * @param <const> NAVIGATOR output/contents/switchers
  *
  * @return array list of files got from @param directory
  */
  $dir = opendir(
    $userTemplate
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
