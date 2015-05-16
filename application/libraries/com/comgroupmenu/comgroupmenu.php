<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comgroupmenu extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/groupmenu/';
		$params->lib['class_name'] = 'comgroupmenu';
		$params->lib['header_caption'] = 'Pengaturan Menu &raquo; Daftar Menu Tiap Pengguna';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		if(! $this->CI->input->post('id_group')){
    		unset($params->model['query']['query_table'][0]['arr_params'][2]);
		}
		$this->content_default['segments']['head'] = $this->CI->load->com($params->lib['class_name'],'view',array('name'=>'default','data'=>@$this->content ,'return'=>false));	
		
		parent::__construct($params);
	}
	function comjs_features(){
        parent::comjs_features();
        $gridcomplete_config = array('name'=>'comjs_gridcomplete','return'=>true);
        $this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$gridcomplete_config);
	    unset($this->content['grid']['toolbar']['excel']);
	    unset($this->content['grid']['toolbar']['word']);
	    unset($this->content['grid']['toolbar']['pdf']);
	}
	function formaction(){
		$this->CI->load->com($this->lib['class_name'],'model',array('name'=>'model_groupmenu','alias'=>'com_model'));
		$hasil = $this->CI->com_model->simpan();
		echo json_encode($hasil);
	}
	function griddata(){
	    parent::griddata();
//	    $this->gridlib['grid']['opt']['postData']['id_group'] = $this->id_group;
//	    dump($this->CI->db->last_query());
	}
}
