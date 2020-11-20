<?php
use Controller\Roots\MainRoot;
use Controller\Controller\AppController;
/*
 [--------------------------------------------------------------------------
 [ DEMARER L’AUTOLOADER
 [--------------------------------------------------------------------------
 [
 [ Composer fournit un loader de classe pratique et généré automatiquement
 [ pour notre application. Nous avons juste besoin de l'utiliser! Nous allons
 [ simplement le require dans le script
 [ ici afin que nous n'ayons pas à nous soucier
 [ du chargement manuel de nos classes plus tard. Cela fait du bien de se détendre.
 [
*/
require_once __DIR__ . '/../../../providers/Resources/autoload.php';


/*
 [--------------------------------------------------------------------------
 [ ZONES D’ÉLÉMENTS
 [--------------------------------------------------------------------------
 [
 [ ici nous preparont et chargeons tous les éléments
 [ à inclure par défaut pour nos vues.
 [
*/
function IPHPGetLoadElements()
{
  //Creating Object $parent
  $parent = new MainRoot();

  $output = null;
  $outputCloud = null;

  $baseDir = dirname(
    dirname(dirname(__DIR__))
    ) . IPHP_DS;

  $urls = [
      /** {@link /output/contents/includes/_header.php} */
      'super_header' => $baseDir . $parent::INCLUDES_DIR.'_header' . $parent::PHP_EXT,
      /** {@link /config/errors.php} */
      'errorHundler' => $baseDir . $parent::CONFIG.'errors' . $parent::PHP_EXT,
  ];

  /** {@link /application/application/Functions/[*].php} */
  $contents1 = glob(
    $baseDir.$parent::LOCAL_FUNCTIONS . '*.{php}', GLOB_BRACE
  );

  /** {@link /application/application/Consts/[*].php} */
  $contents3 = glob(
    $baseDir.$parent::CONSTS_DIR . '*.{php}', GLOB_BRACE
  );
  /** {@link /providers/AppManager/[*fw].php} */
  $contents2 = glob(
     $baseDir.$parent::SCRIPTMANAGER. '*fw.{php}', GLOB_BRACE
  );

  Controller\Controller\AppController::getAutoloadClassFromApplicationDir(

  );

  /*
   [--------------------------------------------------------------------------
   [ REGROUPEMENT DE DONNEES
   [--------------------------------------------------------------------------
   [
   [ Les lignes ci-dessous regroupe les données (fichiers) de chaque contents
   [ ci-dessus dans la mémoire d’output puis y crée une liste
   [ de fichiers à charger grâce un seul coup de require…
   [
  */
  $output .= $parent::generator(
    $contents1
  );
  $outputCloud .= $parent::generator(
    $contents2
  );
  $output .= $parent::generator(
    $contents3
  );

  $outputCloud = trim(
    $outputCloud, ','
  );

  $output = trim(
    $output, ','
  );
  $output = explode(
    ',', $output
  );
  $outputCloud = explode(
    ',', $outputCloud
  );

  /*
   [--------------------------------------------------------------------------
   [ CHARGEMENT DE DONNEES
   [--------------------------------------------------------------------------
   [
   [ Nous invitons à présent la méthode load() à procéder au chargement
   [ de la liste de nos fichiers stockés en mémoire dans $outputCloud.
   [
  */
  $parent::load(
    $outputCloud
  );

    /*
     [--------------------------------------------------------------------------
     [ CHARGEMENT DE DONNEES
     [--------------------------------------------------------------------------
     [
     [ Nous invitons à présent la méthode load() à procéder au chargement
     [ de la liste de nos fichiers stockés en mémoire dans $outputCloud.
     [
    */
  $parent::load(
    $output
  );

  /*
   [--------------------------------------------------------------------------
   [ CHARGEMENT DE DONNEES
   [--------------------------------------------------------------------------
   [
   [ Nous invitons à présent la méthode load() à procéder au chargement
   [ de la liste de nos fichiers stockés en mémoire dans $urls.
   [
  */
  $parent::load(
    $urls
  );
}
