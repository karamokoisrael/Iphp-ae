<?php
namespace Module\IPHP_Utility;
use PDO;
/**
 ** #TITRE: des fonctions raccourcies pour votre script **
 ** #DESCRIPTION:
 * Ces fonctions retournent les méthodes de nos classes à
 * partir des noms plus courts qui vont vous permettre
 * d'écrire moins en les appelants dans votre Script !
 **
 *
 * @package IPHP
 * @author Stéphane N'cho <contact@geniecodeurspro.group>
 * {@link https://www.skytech.org}
*/


/**
 * @return func_num_args	nombre d'arguments passés en fonction
 */
function hm_args():int
{
	return func_num_args();
}


/**
 * @return func_get_args	liste d'arguments passés en fonction
 */
function all_args():array
{
	return func_get_args();
}


/**
 ** Fonction raccourcie de notre système de navigation **
 * @param string $root		nom de la Route dont l'on veut afficher la page
 * @param array $uri_data		nom de la Route dont l'on veut afficher la page
 * @param string $ref_statut		nom de la Route dont l'on veut afficher la page
 * @var s $rootName, $in_array, $ref, $uri_data
 * @return Routes 	des Routes associées à leurs vues
 */

function __nav(string $root = DEFAULT_NAV, ?string $ref = null, ?array $uri_data = []):string
{

 	$rootName = $root;
	$in_array = @in_array('iphp', explode('.', $rootName));
	$rootName = ($in_array) ? $rootName : $rootName . null;

	return \Controller\Controller\AppController::Iphp_navigation($rootName, $ref, $uri_data);
}


/**
 ** Fonction raccourcie de notre système de chargement de fichiers de Script "ClientSide" **
 * @param string $mark 	marque de trie.
 * @param string $dirname 	Nom du dossier à partir duquel nous souhaitons charger ces fichiers.
 * @param string $to_load_ext	Marque permettant d’indiquer les fichiers que nous souhaitons charger
 * @var string/null $mark, $is_not_empty, $dirname, $ext
 * @since output\public		chemin du dossier parent par defaut
 * @return \Controller\Controller\AppController::GetClientSideScriptSheets ();
 */

function __GCSSS(?string $mark = null, ?string $dirname = 'css', ?string $ext = "css"):?string
{
	$is_not_empty = (!is_null($mark));
	$mark = ($is_not_empty) ? $mark : null;

	return \Controller\Controller\AppController::GetClientSideScriptSheets($mark, $dirname, $ext);
}

	/*
	[--------------------------------------------------------------------------
	[ MISE EN PAGE
	[--------------------------------------------------------------------------
	[
	[ La vue, c’est aussi l’ergonomie et l’interactivité. La méthode
	[ suivante nous permet d’importer nos fichiers de css pour
	[ la mise en page statique de notre belle application
	[
	*/
function __getCssFiles(?string $group, ?string $from = "css"):?string
{
	/**
	 * @param $from 	Nom du dossier duquel nous souhaitons charger nos fichiers css.
	 * @param $group 	liste de fichiers que vous souhaitez charger du @param $from.
	 *                par ordre d'appels...
	 */

	return \Controller\Controller\AppController::loadCssFiles($group, $from);
}


/*
[--------------------------------------------------------------------------
[ PROGRAMATION AVANT-PLAN
[--------------------------------------------------------------------------
[
[ La vue, c’est aussi l’ergonomie et l’interactivité. La méthode
[ suivante nous permet d’importer nos fichiers de js pour
[ la mise en page dynamique de notre belle application
[
*/
function __getJsFiles(?string $group, ?string $from = "js"):?string
{
	/**
	 * @param $from 	Nom du dossier duquel nous souhaitons charger nos fichiers css.
	 * @param $group 	liste de fichiers que vous souhaitez charger du @param $from.
	 *                par ordre d'appels...
	 */

	return \Controller\Controller\AppController::loadJsFiles($group, $from);
}

/**
 ** Fonction raccourcie pour création de titre de façon dynamique  **
 * @param bool	Cette fonction n'attend aucun paramètre
 * @return \Controller\Controller\AppController::dynamicPageTitle();
 */
function __dynamicPageTitle(bool $from_route = true):?string
{
	return \Controller\Controller\AppController::dynamicPageTitle($from_route);
}


/**
 ** Fonction raccourcie de notre middleware (connexion BDD) **
 * @param void/null	Cette fonction n'attend aucun paramètre
 * @return \Model\Modelstatement\ModelClass::DB_connection ();
 */

function __DB_conn():PDO
{
	return \Model\Modelstatement\ModelClass::DB_connection();
}




/*
[---------------------------------------------------------------------------
[ MODULES CHEMIN DYNAMIQUE & SECURISÉ
[---------------------------------------------------------------------------
[
[ Les Modules ci-dessous vous permettront d'acceder à vos repertoires de fi-
[ chiers de façons dynamique et assez sécurisé.
[
*/

/**
 * @param	string $dest	 Le dossier de destination pour cette appelle
 * @return /@param $dest
 * @example: "/home/site/www/admin/iphp/file"
 */

  function __absolute_dir($dest)
  {
 	 $dest = preg_replace('#[^./0-9a-zA-Z\_-]+#i', '', $dest);
 	 return \Controller\Controller\AppController::base_URI($dest);
  }

/**
 * @param	string $dest	 Le dossier de destination pour cette appelle
 * @return /output/public/@param string $dest;
 */

 function __public_dir($dest)
 {
	 $dest = preg_replace('#[^./0-9a-zA-Z\_-]+#i', '', $dest);
	 return \Controller\Controller\AppController::pbc_dynamicaly($dest);
 }

/**
 * @param	string $dest	 Le dossier de destination pour cette appelle
 * @return /output/media/@param string $dest;
 */

  function __media_dir($dest)
  {
 	 $dest = preg_replace('#[^./0-9a-zA-Z\_-]+#i', '', $dest);
 	 return \Controller\Controller\AppController::mdynamic_URI($dest);
  }

/**
 * @param	string $dest	 Le dossier de destination pour cette appelle
 * @return domain/basedir + /@param $dest
 *
 * commentaire: la valeur que renvoit ce module  varie en fonction du nombre de
 * paramètre passé à l'url: s'il vaut 4, elle renvoit un chemin précédé de votre
 * nom de domaine (http/s:votre_site.com sinon le chemin de base est renvoyé (/)
 *
 * // NOTE: si vous voulez une url accompagnée de votre nom de domaine, veuillez
 *					utiliser le module __myDomaine(@param string $dest) ci-après;
 */

  function __dynamic_url($dest)
  {
 	 $dest = preg_replace('#[^./0-9a-zA-Z\_-]+#i', '', $dest);
 	 return \Controller\Controller\AppController::dynamic_url($dest);
  }


	/**
	 * @param	string $dest	 Le dossier de destination pour cette appelle
	 * @return NOM_DE_DOMAINE - EX: https/nom_de_domaine.com/@param string $dest
	 */

	 function __withDomaine($dest)
	 {
		 $dest = preg_replace('#[^./0-9a-zA-Z\_-]+#i', '', $dest);
		 return \Controller\Controller\AppController::domaine_name($dest);
	 }

	 /**
	  * Utiliser le module raccourcis trans(@param $ref) pour traduire vos textes...
		*/
	 function trans($data)
	 {
		 return \Controller\Localizations\Translation::get($data);
	 }

	 /**
	  * Utiliser le module raccourcis __(@param $ref) pour traduire vos textes...
		*/
	 function __($data)
	 {
		 return trans($data);
	 }

	 /**
	  * Utiliser le module raccourcis __(@param $ref) pour traduire vos textes...
		*/
	 function isLocal($data)
	 {
		 return \Controller\Localizations\Translation::isLocale($localName);
	 }

	 /**
	  * Utiliser le module raccourcis __(@param $ref) pour traduire vos textes...
		*/
	 function setLocale($data)
	 {
		 return \Controller\Localizations\Translation::setLocale($data);
	 }

	 /**
	  * Utiliser le module raccourcis __(@param $ref) pour traduire vos textes...
		*/
	 function getLocal($data)
	 {
		 return \Controller\Localizations\Translation::get($data);
	 }
