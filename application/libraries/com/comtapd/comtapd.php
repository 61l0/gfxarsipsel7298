<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comtapd extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/tapd/';
		$params->lib['class_name'] = 'comtapd';
		$params->lib['header_caption'] = 'Data Master &raquo; Pejabat &raquo; Tim Anggaran Pemerintah Daerah';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');

		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model_tapd'));
		$periode = $this->CI->model_tapd->periode();
		$params->gridlib['arr_colModel']['id_periode']['editoptions']['value'] = $periode;
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    			$params->lib = array_merge($params->lib,$params->lib['gf_form']);	
		}
		parent::__construct($params);
	}
	    
    function comjs_features(){
        parent::comjs_features();
	$conf_extra = array(
		'name'=>'comjs_extra',
		'data'=>$this->content,
		'return'=>true
	);
	$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->lib['class_name'],'view',$conf_extra);
	    unset($this->content['grid']['toolbar']['excel']);
	    unset($this->content['grid']['toolbar']['word']);
	    unset($this->content['grid']['toolbar']['pdf']);
	    unset($this->content['grid']['toolbar']['search']);
    }
}
