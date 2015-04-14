<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcmssusunanorganisasi extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comcmssusunanorganisasi';
		$params->lib['com_url'] = 'cms/com/cmssusunanorganisasi/';
		$params->lib['class_name'] = 'comcmssusunanorganisasi';
		$params->lib['header_caption'] = 'Pengaturan Konten &raquo; Konten Khusus &raquo; Dinamika Organisasi &raquo; Susunan Organisasi';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);	
		}
		$params->gridlib['grid']['opt']['postData']['id_skpd_sotk'] = 0;
		parent::__construct($params);
	}
	function comjs_features($params=false){
	    parent::comjs_features($params);
			$conf_view_features = array(
			    'name'=>'comjs_extra',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com('comcmssusunanorganisasi','view',$conf_view_features);
	        unset($this->content['grid']['toolbar']['plus']);
	        unset($this->content['grid']['toolbar']['excel']);
	        unset($this->content['grid']['toolbar']['word']);
	        unset($this->content['grid']['toolbar']['pdf']);
		    unset($this->content['grid']['toolbar']['search']);
	}
	
	
}	
?>
