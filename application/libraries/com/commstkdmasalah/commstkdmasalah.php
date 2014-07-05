<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Commstkdmasalah extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/mstkdmasalah/';
		$params->lib['class_name'] = 'commstkdmasalah';
		$params->lib['header_caption'] = 'Data Master &raquo; Kode Masalah';
		
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		// ============================================================
		$this->content_default['segments']['head'] = $this->CI->load->com($params->lib['class_name'],'view',array('name'=>'default','data'=>@$this->content ,'return'=>false));	
		
		parent::__construct($params);
	}
    function comjs_features(){
        parent::comjs_features();
        $gridcomplete_config = array('name'=>'comjs_gridcomplete_tree','return'=>true);
        $this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$gridcomplete_config);

        $extra_config = array('name'=>'comjs_extra','return'=>true);
        $this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->lib['class_name'],'view',$extra_config);

        unset($this->content['grid']['toolbar']['word']);
        unset($this->content['grid']['toolbar']['excel']);
        unset($this->content['grid']['toolbar']['pdf']);
        
	}
}	
?>
