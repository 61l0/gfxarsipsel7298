<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Loader extends CI_Loader {

	function __construct()
	{
		parent::__construct();
	}
	function modul($modul_name=false,$method = false,$params=array())
	{
		if($method == 'view'){
			return $this->gf_lib($modul_name,$method ,$params,'modul');
		}else{
			$this->gf_lib($modul_name,$method ,$params,'modul');
		}
	}
	function com($com_name=false,$method = false,$params=array())
	{
		if($method == 'view'){
			return $this->gf_lib($com_name,$method ,$params,'com');
		}else{
			$this->gf_lib($com_name,$method ,$params,'com');
		}
	}
	function widget($widget_name=false,$method = false,$params=array())
	{
		$widget_name_arr = explode('::',$widget_name);
		
		$params['template_name'] = (isset($widget_name_arr[1]))?$widget_name_arr[1]:false;
		if($method == 'view'){
			return $this->gf_lib($widget_name_arr[0],$method ,$params,'widget');
		}else{
			$this->gf_lib($widget_name_arr[0],$method ,$params,'widget');
		}
	}
	function gf_lib($modul_name=false,$method = false,$params=array(),$type=false)
	{
		if(!$method) {
			show_error('Anda belum mendefinisikan modul method!');
		}
		switch ($method):
			case 'library':
				$library_name = @$params['name']?$params['name']:$modul_name;
				$library_params = @$params['data']?@$params['data']:NULL;
				$library_alias = @$params['alias']?$params['alias']:NULL;
				$this->library($type."/".$modul_name."/".$library_name,$library_params,$library_alias);
				break;
			case 'model':
				$model_name = @$params['name']?$params['name']:false;
				$model_alias = @$params['alias']?$params['alias']:'';
				$model_db_conn = @$params['db_conn']?@$params['db_conn']:false;

				$this->_ci_model_paths[] = APPPATH."libraries/".$type."/".$modul_name."/";
				$this->model($model_name,$model_alias,$model_db_conn);
				break;
			case 'view':
				$view_name = @$params['name']?$params['name']:false;
				$view_vars = @$params['data']?$params['data']:array();
				$view_return = @$params['return']?@$params['return']:false;
				
				$ori_ci_view_path = $this->_ci_view_path;
				$this->_ci_view_path = APPPATH."libraries/".$type."/".$modul_name."/views/";
				$view = $this->view($view_name,$view_vars,$view_return);
				$this->_ci_view_path = $ori_ci_view_path;
				return $view;
				break;
			case 'config':
				$config_file = @$params['name']?$params['name']:false;
				$config_use_sections = @$params['use_sections']?$params['use_sections']:false;
				$config_fail_gracefully = @$params['fail_gracefully']?$params['fail_gracefully']:false;
				
				$CI =& get_instance();
				$CI->config->_config_paths[$type.$modul_name] = APPPATH."libraries/".$type."/".$modul_name."/";
				$CI->config->load($config_file, $config_use_sections, $config_fail_gracefully);
				unset($CI->config->_config_paths[$type.$modul_name]);
				break;
			default:
				show_error($method.' belum suport!');
				break;
		endswitch;
	}

	function database($params = '', $return = FALSE, $active_record = NULL)
    {
        // Grab the super object
        $CI =& get_instance();
 
        // Do we even need to load the database class?
        if (class_exists('CI_DB') AND $return == FALSE AND $active_record == NULL AND isset($CI->db) AND is_object($CI->db)) {
            return FALSE;
        }
 
        require_once(BASEPATH.'database/DB'.EXT);
 
        // Load the DB class
        $db =& DB($params, $active_record);
 
        $my_driver = config_item('subclass_prefix').'DB_'.$db->dbdriver.'_driver';
        $my_driver_file = APPPATH.'core/'.$my_driver.EXT;
 
        if (file_exists($my_driver_file)) {
            require_once($my_driver_file);
            $db = new $my_driver(get_object_vars($db));
        }
 
        if ($return === TRUE) {
            return $db;
        }
 
        // Initialize the db variable.  Needed to prevent
        // reference errors with some configurations
        $CI->db = '';
        $CI->db = $db;
    }

}
