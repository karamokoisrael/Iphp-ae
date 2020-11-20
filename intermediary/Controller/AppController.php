<?php
namespace Controller\Controller;
/**
 *
 */

use Controller\Roots\{Router, MainRoot as Root};
use Model\Modelstatement\{ModelClass as Model};

class AppController extends Router
{

use \Controller\Bootstrap\Helper, \Controller\Bootstrap\Manager, Manager, \Controller\Bootstrap\UrlsManager, \Controller\Bootstrap\ConfManager, \Controller\Bootstrap\ClassManager;

const ZERO = 0,	 ONE = 1,	 TWO = 2,	 THREE = 3,	 FOUR = 4, FIVE = 5, SIX = 6, SEVEN = 7, EIGHT = 8, NINE = 9;

 /*
 [--------------------------------------------------------------------------
 [ GÉNÉRATEUR DE VUES
 [--------------------------------------------------------------------------
 [
 [ mettons en place un générateur de vue pour la création de l'application
 [
 */

public function viewGenerator()
{
	[$switchData] = func_get_args();

	// $boolVal = count( $this->navigationData($switchData) ) <=> 10;
	// $boolVal = $boolVal == 0 || $boolVal == 1 ? $boolVal: FALSE;

	$boolVal = count( $this->navigationData($switchData) ) >= 10;
	$boolVal = $boolVal == 0 || $boolVal == 1 ? $boolVal: FALSE;

	if ($boolVal)
	{

		$data  = $this->rootDatas(
			$this->navigationData(
				$switchData
			), 10 , 2
		);

		return $this->Application(parent::assemblyView(
					self::iffls(
						$data[self::ONE]
					),
					self::iffls(
						$data[self::TWO]
					),
					self::iffls(
						$data[self::THREE]
					),
					self::iffls(
						$data[self::ZERO]
					),
					self::iffls(
						$data[self::FOUR
					])
		));

	}

	IphpThrowError(
		"errcd21217", $switchData
	);

}


 /*
 [--------------------------------------------------------------------------
 [ CRÉATION DE L'APPLICATION
 [--------------------------------------------------------------------------
 [
 [ Enfin notre belle application est créee. nous allons pouvoir l'afficher
 [ pour nos utilisateurs qui vont la découvir!
 [
 */

	public function Application()
	{
		[$sections] = func_get_args();

		IPHPGetLoadElements();

		if(Root::isPageExisted(
			$sections
			))
			 Router::CreateView(
				 $sections
			 );

	}

}
