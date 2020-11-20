<?php
namespace Controller\Bootstrap;
/**
 *
 */
use Controller\Roots\{MainRoot as Root};

trait Manager
{

		/*
		[-------------------------------------------------------------------------
		[ CONVERTISSEUR DE DONNÉES DE ROUTES
		[-------------------------------------------------------------------------
		[
		[ cette méthode  permet d'analyser et convertir notre Route puis
		[ renvoie une route valide pour la navigation.
		[
		*/
	public function IphpRootConverter(string $rootData, string $switchData)
	{

		if (setlocale(LC_TIME, 'fr_FR') == '')
				setlocale(LC_TIME, 'FRA');

			if (!self::navigationDataValidate($rootData))		{

				$rootData = iconv(
					"UTF-8", "US-ASCII//TRANSLIT", $rootData
				);
				$rootData = preg_replace(
					'#[^.0-9a-zA-Z\_-]+#i', ',', $rootData
				);
				$rootData = strtolower(
					$rootData
				);

				return trim(
					$rootData, ','
				);
			}

			IphpThrowError(
				"errcd21216", $switchData
			);
		}

			/*
			[-------------------------------------------------------------------------
			[ ANALYSEUR  PARTIELLE DE DONNÉES DE ROUTES
			[-------------------------------------------------------------------------
			[
			[ cette méthode arrête l’analyse et la conversion de façons globale
			[ des Routes puis renvoie une partie de données de route valide.
			[
			*/
		public function uncheckRules(string $string): string
		{

			$string = preg_replace(
				'#[^.0-9a-zA-ZâäàéèùêëîïôöçñÂÄÀÉÈÙÊËÎÏÔÖÇÑ\_-]+#i', ',', $string
			);
			$string = strtolower(
				$string
			);

			return trim(
				$string, ','
			);
		}

			/** @return bool|string val */
		private static function iffls(string $data)
		{
			return (
				$data == 'false' || $data == 'null'
				) ?FALSE:$data;
		}

			/**
			 * @return bool val
			 */
		public static function ifHPHP($hphp, $data)
		{
			/**
			 * @var string $hd_file	-	chemin vers header_php
			 * @var string $vw_file	-	chemin vers content-pages
			 */

			$hd_file = HEADER_PHP . IPHP_DS . $data . '.php';
			$vw_file = RESOURCES_DIR . IPHP_DS . $data . '.html';
			if ($hphp !== FALSE)

			/** @var bool $app vaut TRUE */
			{
				if (!file_exists( $hd_file )) {
					file_put_contents(
						$hd_file, Root::__hPHPcontent($data)
					);
				}else {
					if (!file_exists( $vw_file )) {
						file_put_contents(
							$vw_file, Root::__hViews_content()
						);
					}else {
						return false;
					}
				}
			}

			/** @var bool $app vaut FALSE */

			else {
				if (file_exists( $hd_file )) {
					unlink($hd_file);
				}else {
					if (!file_exists( $vw_file )) {
						file_put_contents(
							$vw_file, Root::__hViews_content()
						);
					}else {
						return false;
					}
					}
				}

		}

				/*
				[--------------------------------------------------------------------------
				[ Si
				[--------------------------------------------------------------------------
				[
				[ mettons en place un générateur de titre dynamique pour notre application
				[
				*/
			public function isSortation(?string $sortable)
			{
				return (
					!is_null($sortable)?$sortable . '.' : null
				);
			}

				/*
				[--------------------------------------------------------------------------
				[ GÉNÉRATEUR DE TITRE
				[--------------------------------------------------------------------------
				[
				[ mettons en place un générateur de titre dynamique pour notre application
				[
				*/
			public function dynamicPageTitle(bool $from_route = true)
			{

				$curr_pg = $_GET['page'] ?? DEFAULT_PAGE;
				$retval = "Bienvenue!";
				$boolVal = count(
					self::navigationData(
						$curr_pg, false
						)
					) >= 11;

				if ($from_route === false)
						return defined(
							"DEFAULT_PG_TITLE"
							) ? self::customizedArr($curr_pg) : $retval;

				if ($boolVal)
				{

					$data  = self::rootDatas(
						self::navigationData(
							$curr_pg, false
						), 11 , 1
					);

					$retval = (
						$data[
							self::NINE
							] == PG_TITLE_KEY
						) ?
					$retval = str_replace(
						"_", " ", $data[
							self::ONE . self::ZERO
						]
						) ?? DEFAULT_PG_TITLE :
					$retval = DEFAULT_PG_TITLE;

					return $retval;
				}

				else
				{
					if (defined("DEFAULT_PG_TITLE") && !empty(DEFAULT_PG_TITLE) )
							return DEFAULT_PG_TITLE;

					IphpThrowError("errcd21215", $curr_pg);
				}

			}


	}
