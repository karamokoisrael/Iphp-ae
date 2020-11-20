<?php
use Symfony\Component\VarDumper\Cloner\VarCloner;
namespace Controller\Bootstrap;
/**
 *
 */

trait ClassManager
{

  /**
      * Enregistre notre autoloader et inclut le fichier correspondant à notre classe
      */
     static function getAutoloadClassFromApplicationDir(){
       try
       {
         // spl_autoload_register(array(__CLASS__, 'loaderFuncName'));

         /**
          * @return {@link /application/application/class/*.class.php}
          * (*) sera dynamiquement remplacer par la classe appelée
          */
         spl_autoload_register( function( ?string $classname ) {
           if ('Symfony\Component\VarDumper\Cloner\VarCloner' != $classname) {
             \Controller\Main::requireClass($classname);
           }

         });
       }

       // lorsque nous trouvons des Erreurs
       catch (\Exception $e)       {
         throw new \Exception($e);
       }

     }

}
