<?php
namespace Controller\Handler;

/**
 *
 */
use \Exception as IPHPHandlerException;

class IphpExceptions extends \Exception
{
	public $_errMsg;

	function __construct($message = 'Une erreur d’Exception a été lancée: Aucun message à afficher')
	{
		$this->_errMsg = $message;
	}

	public function IphpHandlerThrower():self
	{
		throw new IPHPHandlerException(
			$this->_errMsg, 1
		);
		return $this;
	}

}
