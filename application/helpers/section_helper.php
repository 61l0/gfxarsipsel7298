<?
	defined('BASEPATH') or die('Access Denied');
	
    function section_environment($env){
        
        $config['sections'] = array(
                'sikda_gaji'=>E_ALL,
                'sikda'=>E_ALL,
                'development'=>E_ALL,
                'production'=>0,
                'postgre'=>0,
        );
    	define('ENVIRONMENT', $env);
//    	dump($config[$env]);
    	if(isset($config['sections'][$env])){
	        error_reporting($config['sections'][$env]);
    	}
    }
  
?>
