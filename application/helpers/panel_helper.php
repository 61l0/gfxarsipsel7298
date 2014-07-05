<?
defined('BASEPATH') or die('Access Denied');
if(!function_exists('panel_loadmodul')){
	function panel_loadmodul($modul_name=false,$ver=false){
		//echo DOC_PATH_APP."libraries/modul/$modul_name/$modul_name.php";
		require_once(DOC_PATH_APP."libraries/modul/$modul_name/$modul_name.php");
	}
}
    
?>
