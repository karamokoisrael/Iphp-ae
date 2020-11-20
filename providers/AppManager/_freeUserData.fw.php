<?php
use \Whoops\{Run as HandlerThrower};
use \Controller\Handler\IphpExceptions;

$baseDir = dirname(
  dirname(__DIR__)
  ) . DIRECTORY_SEPARATOR;

include_once 'tasksExecutortemplateFuncs.fw.php';
include_once $baseDir . 'config/app.php';

function currTemplate(){
  $currentTemplate = TEMPLATE;
  if (is_template($currentTemplate)) {
    return $currentTemplate;
  }else {
    $errors = new HandlerThrower;
    $errors->pushHandler(new \Whoops\Handler\PrettyPageHandler)->register();
    $handler = new \Controller\Handler\IphpExceptions();
    $handler->_errMsg = "Le Template " . mb_strtoupper($currentTemplate) . " n'est pas valide dans [/output/] ";
    $handler->IphpHandlerThrower();
  }
}
