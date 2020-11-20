<?php
namespace Controller\Extended;
/**
 *
 */

use Controller\Controller\{AppController as Cntrl};

trait Router
{

use \Controller\Extended\Main;

	public static function getStartRooting()
	{
		/**
		* @var boolean $match verifie que le nom de la page à afficher soit valide.
		* Envoi de notre requêtte vers l'executeur si @var boolean $match vaut true.
		* Si @var boolean $match vaut false, le fichier d'erreur 404.html est appéllé
		*/

		$match = (\Controller\Roots\Route::match(self::$_currentPage, \Controller\Roots\Route::paginations())) ?true:false;

		self::iphp_welcome(

		);

		if($match)
		{
			self::run(
				self::$_currentPage
			);
		}
		else
		{
			$NOTE_FOUND_PAGE = NOTE_FOUND_PAGE;

			if (file_exists($NOTE_FOUND_PAGE)) {
				IPHPGetLoadElements();
				require_once $NOTE_FOUND_PAGE;
			}
			else {
				IphpThrowError(
					"errcd21220"
				);
			}
		 }

	}

	 /*
	 [--------------------------------------------------------------------------
	 [ ASSEMBLAGE DE VUE
	 [--------------------------------------------------------------------------
	 [
	 [ comme son nom l'indique, cette methode vas se charger d'assembler tout Les
	 [ éléments réçus et nécessaires pour notre vue: c'est ici que tout se passe.
	 [
	 */
	public function assemblyView()
	{

		[$h_php, $h, $sub_h, $p, $f] = func_get_args(

		);

		$controller = new Cntrl();
		$controller::ifhphp(
			$h_php, $p
		);
		$h_php = (
			$h_php === FALSE ? $controller->Is404_Err(
				$h_php, 'hphp'
				) . parent::PHP_EXT : $controller->Is404_Err(
					$p, 'hphp'
					) . parent::PHP_EXT
		);

		$contents = glob(
			RESOURCES_DIR. IPHP_DS . '*.{html,php}', GLOB_BRACE
		);

		return	[
			'h_php' => HEADER_PHP . IPHP_DS . $h_php,
			'h' => parent::INCLUDES_DIR . $controller->Is404_Err(
				$h, 'header'
				) . parent::HTML_EXT,
			'sub_h' => parent::INCLUDES_DIR . $controller->Is404_Err(
				$sub_h, 'sub_header'
				) . parent::HTML_EXT,
			'p' => RESOURCES_DIR . IPHP_DS . $controller->Is404_Err(
				$p, 'content'
				) . parent::HTML_EXT,
			'f' => parent::INCLUDES_DIR . $controller->Is404_Err(
				$f, 'footer'
				) . parent::HTML_EXT,
		];
	}


		 /*
		 [--------------------------------------------------------------------------
		 [ DÉMARRAGE DE L'APPLICATION
		 [--------------------------------------------------------------------------
		 [
		 [ Alimentation de tous les modules via le Controlleur et démarrage de toute
		 [ notre Application avec la première Route réçus par défaut au premier
		 [ démarrage de notre belle application.
		 [
		 */
	public static function run(?string $callable)
	{
		$ctrl = new Cntrl();
		return $ctrl->viewGenerator(
			$callable
		);
	}


}
