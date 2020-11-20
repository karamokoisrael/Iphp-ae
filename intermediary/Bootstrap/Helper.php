<?php
namespace Controller\Bootstrap;
/**
 *
 */
 use PDO;
trait Helper
{

	/*
	[-------------------------------------------------------------------------
	[ GÉNÉRATEUR DE DONNÉES DE ROUTES VALIDE
	[-------------------------------------------------------------------------
	[
	[ cette méthode permet d’analyser et générer
	[ une route valide pour la navigation.
	[
	*/
	public function navigationData($switchData, bool $convertData = true)
	{

		$file = !file_exists(
      NAVIGATOR . IPHP_DS . $switchData . '.iphp'
      ) ?
		$file = file_get_contents(
      NAVIGATOR . IPHP_DS . DEFAULT_PAGE . '.iphp'
      ) :
		$file = file_get_contents(
      NAVIGATOR . IPHP_DS . $switchData . '.iphp'
    );

		$file = (
      $convertData === false
      ) ?
		$file = self::uncheckRules(
      $file
      ) :
		$file = self::IphpRootConverter(
      $file, $switchData
    );

		$file = explode(
      ',', $file
    );

		return $file;
	}

	/*
	[-------------------------------------------------------------------------
	[ ANALYSEUR DE DONNÉES DE NAVIGATIONS
	[-------------------------------------------------------------------------
	[
	[ cette méthode d’analyse le contenu de notre
	[ Route et renvoie un booléen.
	[
	*/
	private static function navigationDataValidate($rootData)
	{

		$retval = false;
		$data = null;

		if (count(self::rootDatasValues($rootData)) >= 10)
				for ($i=9; $i >= 0; $i--)
						 $data .= self::rootDatasValues($rootData)[$i]. ' ';

		if (preg_match("#â|ä|à|é|è|ù|ê|ë|î|ï|ô|ö|ç|ñ|Â|Ä|À|É|È|Ù|Ê|Ë|Î|Ï|Ô|Ö|Ç|Ñ#", $data) == 1)
				$retval = true;

		return $retval;
	}

	/*
	[-------------------------------------------------------------------------
	[ DESIGN (Font Office)
	[-------------------------------------------------------------------------
	[
	[ Du PHP, mais notre Application sans eux (CSS, JS), ne serait
	[ pas du tout accueillante. La méthode suivante permettra
	[ D’importer nos fichiers CSS & JS.
	[
	*/
	public static function scriptSheetFormat(string $dir, array $sheets)
	{
		$output = null;
		foreach (
      $sheets as $key => $value
    )		{
			$output .= ($dir == 'js')
			?'<script type="application/javascript" src="' . \Controller\Controller\AppController::pdynamic_URI($value) . '"></script>'
			:'<link rel="stylesheet" href="' . \Controller\Controller\AppController::pdynamic_URI($value) . '">';
		}

		return $output;
	}

	/*
	[-------------------------------------------------------------------------
	[ REQUETTE SQL
	[-------------------------------------------------------------------------
	[
	[ Cette méthode nous permet d’effectuer des requêtes SQL vers
	[ notre notre base de données pour y récupérer des données.
	[
	*/
	public function sqlFetch(string $request, array $data = [], $selectedDB)
	{
		if ($selectedDB) {
			$req = $selectedDB->prepare(
        $request
      );
			$req->execute(
        $data
      );

			return $req->fetchAll(
        PDO::FETCH_OBJ);
		}

		IphpThrowError(
      "errcd21212"
    );

		return false;
	}


		/*
		[-------------------------------------------------------------------------
		[ REQUETTE SQL
		[-------------------------------------------------------------------------
		[
		[ Cette méthode nous permet d’exécuter ou envoyer des données vers
		[ les tables de notre base de données pour les stokers
		[
		*/
	public function sqlSend(string $request, $data = [], $selectedDB)
	{
		if ($selectedDB)		{

			$retval = (
								 $selectedDB->prepare(
                   $request
                   )
														->execute(
                              $data
                              )) ?
			$retval = $selectedDB :
			$retval = false;

			return $retval;
		}

		IphpThrowError(
      "errcd21212"
    );

		return false;
 	}


	//Pour l'autochargment de nos classes
	// public static function ClassAutoloader()
	// {
	// 	try {
	// 		return spl_autoload_register("getAutoLoading");
	// 	}
	// 	catch (\Exception $e) {
  //
	// 	IphpThrowError("errcd21211");
	// 	}
  //
	// }


}
