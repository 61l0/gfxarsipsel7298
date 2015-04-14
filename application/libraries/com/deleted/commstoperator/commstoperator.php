<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Commstoperator extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/mstoperator/';
		$params->lib['class_name'] = 'commstoperator';
		$params->lib['header_caption'] = 'Master Pengolah';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		parent::__construct($params);
	}
	function comjs_features($params=false){
	    parent::comjs_features($params);
		$conf_view_features = array(
			'name'=>'comjs_extra',
			'data'=>$this->content,
			'return'=>true
		);
		$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com('commstoperator','view',$conf_view_features);
		
		$conf_view_features = array(
			'name'=>'comjs_gridcomplete',
			'data'=>$this->content,
			'return'=>true
		);
		$this->content['comjs_features']['gridcomplete'] = $this->CI->load->com('commstoperator','view',$conf_view_features);
		unset($this->content['comjs_features']['toolbar']);
	}
}
