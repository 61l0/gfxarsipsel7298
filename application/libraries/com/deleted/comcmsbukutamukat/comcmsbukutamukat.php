<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcmsbukutamukat extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'cms/com/cmsbukutamukat/';
		$params->lib['class_name'] = 'comcmsbukutamukat';
		$params->lib['header_caption'] = 'Saran dan Kritik &raquo; Kategori Buku Tamu';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		parent::__construct($params);
	}
	function comjs_features($params=false){
	    parent::comjs_features($params);
		    unset($this->content['grid']['toolbar']['search']);
		    unset($this->content['grid']['toolbar']['word']);
		    unset($this->content['grid']['toolbar']['excel']);
		    unset($this->content['grid']['toolbar']['pdf']);
	}
	
}
