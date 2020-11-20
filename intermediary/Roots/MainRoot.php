<?php
namespace Controller\Roots;
/**
 *
 */

 use Controller\Controller as Controller, Controller\Members as MemberClass, Model\php\ModelClass as GetOutPut, \Whoops\Run as HandlerThrower;


include  __DIR__ . '/../../providers/Resources/iphp.conf.php';

class MainRoot
{
  use \Controller\Extended\Main;

  private $_lang;

  const PHP_EXT = '.php';
  const HTML_EXT = '.html';
  const INCLUDES_DIR = INCLUDES_DIR . IPHP_DS;
  const CONSTS_DIR = CONSTS_DIR . IPHP_DS;
  const MEDIA_DIR = 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'media' . IPHP_DS;
  const CONFIG = 'config' . IPHP_DS;
  const SCRIPTMANAGER = 'providers' . IPHP_DS . 'AppManager' . IPHP_DS;
  const LOCAL_FUNCTIONS = 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'application' . IPHP_DS . 'application' . IPHP_DS . 'Functions' . IPHP_DS;
  const PUBL_DIR = 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS .  'public' . IPHP_DS;
  const PUBL_ALT_DIR = 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS .  'public_alt' . IPHP_DS;
  const PHP_CLASS = 'output' . IPHP_DS . CURRENTTEMPLATE . IPHP_DS . 'application' . IPHP_DS . 'application' . IPHP_DS . 'Class' . IPHP_DS;

  public static function debug($params, $etat)
  {
    echo "<pre class=\"bg-black text-white\">";
    echo print_r($params, true);
    echo "</pre>";
  }
}
