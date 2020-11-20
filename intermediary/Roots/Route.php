<?php
namespace Controller\Roots;

 /*
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for our application. These
 | routes are loaded by the RouteServiceProvider within a group which
 | contains the "web" middleware group. Now create something great!
 |
 */

class Route extends MainRoot
{

  function __construct()
  {
    // code...
  }

	public function is_validate_url($url)
	{
    $url = trim($url, IPHP_DS);
    if ($url = explode(IPHP_DS, $url))
        return $url = $url[0];
	}

	public static function match($switchData, $pages)
	{

    $switchData = NAVIGATOR. IPHP_DS .$switchData;

    $switchData = explode(
      IPHP_DS, $switchData
    );
    $switchData = NAVIGATOR . IPHP_DS . $switchData[5] . '.iphp';
		$switchData = trim(
      $switchData,  IPHP_DS
    );
    
		$match = in_array(
      $switchData, $pages
    );

		if ($match)
        return true;

		return false;
	}

	public static function paginations()
	{
		return glob(
      NAVIGATOR. IPHP_DS . '*.{iphp,php}', GLOB_BRACE
    );
	}

}
