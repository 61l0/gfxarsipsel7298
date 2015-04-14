<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Pilihskpd extends Grid {
	function __construct($config=array()){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['class_name'] = 'pilihskpd';
		$params->lib['header_caption'] ='';

        $params->lib['master_class_name'] = $config['master_class_name'];
		$params->lib['master_com_url'] = $config['master_com_url'];
		$params->lib['com_url'] = $config['master_com_url'].$params->lib['class_name'].'/';		

		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		// ============================================================
		$this->content['master_class_name'] =  $params->lib['master_class_name'];
		parent::__construct($params);
	}

	
	function comjs_features($params=false){
	    parent::comjs_features($params);
		unset($this->content['comjs_features']['toolbar']);
		$conf_view_features = array(
			'name'=>'comjs_extra',
			'data'=>$this->content,
			'return'=>true
		);
		$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->content['master_class_name'].'/subcom/pilihskpd','view',$conf_view_features);
		$conf_view_features = array(
			'name'=>'comjs_gridcomplete',
			'data'=>$this->content,
			'return'=>true
		);
		$this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->content['master_class_name'].'/subcom/pilihskpd','view',$conf_view_features);		
		
	}
	
}
