<?php
namespace Model\Modelstatement;

// header('Content-type: text/html; charset=utf-8');


require_once dirname( dirname(__DIR__) ) . '/config/database.php';


use PDO;
use Controller\Handler\IphpExceptions as Iphphandler;

 class ModelClass
 {

   function __construct()   {
     // code...
   }


  /**
   *@return $db   database connexion objet
   */


   public static function DB_connection():PDO
   {     try     {
       $db = new PDO(HOSTING, DB_USER, DB_PASSWORD, array(
         PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHARSET,
         PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
       ));
     }

     catch(\PDOException | \Throwable $e)     {
       $handler = new \Controller\Handler\IphpExceptions(DBCONN_ERR_MSG . ' : '.$e->getMessage());
       $handler->IphpHandlerThrower();
     }

     return $db;
   }

 }
