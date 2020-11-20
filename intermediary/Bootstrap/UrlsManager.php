<?php
namespace Controller\Bootstrap;
/**
 *
 */
trait UrlsManager
{
	/*
	[--------------------------------------------------------------------------
	[ Web URLS
	[--------------------------------------------------------------------------
	[
	[ Des chemins dynamiques l'accès aux différents repertoires de l'app
	[
	*/


	/**
	 * Retourne la racine du projet
	 * @example: /
	 * @return /
	 */
	public static function pdynamic_URI()
	{
			[$dest] = func_get_args(
			);
			return IPHP_DS . ltrim(
				dirname($_SERVER['PHP_SELF']) . IPHP_DS . $dest, FIXED_DS
			);
	}

	/**
	 * Retourne le chemin relatif vers le dossier /media
	 * @link: /output/media/
	 */
	public static function mdynamic_URI()
	{
			[$dest] = func_get_args(
			);
			return IPHP_DS . str_replace(['/','\\'], IPHP_DS, ltrim(
				dirname($_SERVER['PHP_SELF']) . IPHP_DS . parent::MEDIA_DIR . $dest, FIXED_DS)
			);
	}

	/**
	 * Retourne le chemin relatif vers le dossier /public
	 * @link: /output/public/
	 */
	public static function pbc_dynamicaly()
	{
			[$dest] = func_get_args(
			);
			return IPHP_DS . str_replace(['/','\\'], IPHP_DS, ltrim(
				dirname($_SERVER['PHP_SELF']) . IPHP_DS . parent::PUBL_DIR . $dest, FIXED_DS)
			);
	}

	/**
	 * Retourne le chemin absolu vers votre projet
	 * @example: "/home/site/www/admin/iphp/file"
	 */
	public static function base_URI()
	{
			[$address] = func_get_args(

			);
			return $_SERVER[
				'DOCUMENT_ROOT'
				] . IPHP_DS . str_replace(['/','\\'], IPHP_DS, ltrim(
				dirname($_SERVER['PHP_SELF']) . IPHP_DS . str_replace('/', IPHP_DS, $address), FIXED_DS)
			);
	}


	/**
	 * @return complet URI with conditions (when $_SERVER['REQUEST_URI'] > 4)
	 * @example http||https//:www.mysite.com
	 */
	public static function dynamic_url()
	{
		[$dest] = func_get_args(

		);
		$uriVerify = explode(
			IPHP_DS  , $_SERVER[
				'REQUEST_URI'
			]
		);

		$url = dirname(
			$_SERVER[
				'PHP_SELF'
			]
			). IPHP_DS  .$dest;

		if (array_key_exists(4, $uriVerify))
				$url = $_SERVER[
					'REQUEST_SCHEME'
					] . '://' . $_SERVER['HTTP_HOST'] . dirname(
					$_SERVER[
						'PHP_SELF'
					]
					).  IPHP_DS  . $dest;

		return $url;
	}


	/**
	 * @return domaine name
	 * @example http||https//:www.mysite.com
	 */
	public static function domaine_name()
	{
		[$dest] = func_get_args();
		return $_SERVER[
			'REQUEST_SCHEME'
			].'://'.$_SERVER[
				'HTTP_HOST'
				].dirname(
					$_SERVER['PHP_SELF']
					). IPHP_DS  .$dest;
	}


}
