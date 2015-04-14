<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcmslokasi extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'cms/com/cmslokasi/';
		$params->lib['class_name'] = 'comcmslokasi';
		$params->lib['header_caption'] = 'Pengaturan Konten &raquo; Konten Khusus &raquo; Lokasi';
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
