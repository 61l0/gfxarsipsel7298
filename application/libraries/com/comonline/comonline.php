<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comonline extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/online/';
		$params->lib['class_name'] = 'comonline';
		$params->lib['header_caption'] = 'Pengguna &raquo; Pengguna Online';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->content_default['segments']['head'] = $this->CI->load->com($params->lib['class_name'],'view',array('name'=>'default','data'=>@$this->content ,'return'=>false));	
		
		parent::__construct($params);
	}
	function comjs_features($params=false){
		parent::comjs_features($params);
		unset($this->content['comjs_features']['toolbar']);
		// unset($this->content['grid']['toolbar']['search']);
		// unset($this->content['grid']['toolbar']['word']);
		// unset($this->content['grid']['toolbar']['pdf']);
		// unset($this->content['grid']['toolbar']['excel']);
	}
}
