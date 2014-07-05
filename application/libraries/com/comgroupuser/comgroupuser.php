<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comgroupuser extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/groupuser/';
		$params->lib['class_name'] = 'comgroupuser';
		$params->lib['header_caption'] = 'Pengaturan Pengguna &raquo; Grup Pengguna';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->content_default['segments']['head'] = $this->CI->load->com($params->lib['class_name'],'view',array('name'=>'default','data'=>@$this->content ,'return'=>false));	
		
		parent::__construct($params);
	}
}
