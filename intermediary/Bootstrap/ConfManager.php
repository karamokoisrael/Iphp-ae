<?php
namespace Controller\Bootstrap;
/**
 *
 */
 use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};
 use Controller\Controller\{AppController};
trait ConfManager
{

  /**
	*[--------------------------------------------------------------------------
	*[ Fichier de configuration
	*[--------------------------------------------------------------------------
	*[
	*[ Cette option détermine l’accès au fichiers de configuration (/config)
	*[ @return /config/*.php
	*/
	public static function iphpConfig()
	{
    $data = false;
		[$ref] = func_get_args(

    );

    $configFile = __DIR__ . '/../../config' . IPHP_DS;
    $ref = explode(
      ".", $ref
    );
    $configFile = $configFile . $ref[0] . '.php';

    if (file_exists($configFile)) {
      $configData = require $configFile;
      $data = $configData[
        $ref[1]
      ];
    }

    return $data;
	}

  /**
   * customizedArr() nous permet d'accueillir et de gérer notre fichier
   * de configuration nommé "titles.php"
   */
  public static function customizedArr($curr_pg)
  {
    $app = self::iphpConfig(
      "titles.Routes"
    );
    $defaultTT = DEFAULT_PG_TITLE;

    $pageTitle = array_key_exists(
      $curr_pg, $app
      ) ?
    $pageTitle = $app[
      $curr_pg
      ] :
    $pageTitle = $defaultTT;

    return $pageTitle;
  }

}
