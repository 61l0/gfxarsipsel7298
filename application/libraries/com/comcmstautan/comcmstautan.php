<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class Comcmstautan extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comcmstautan';
		$params->lib['com_url'] = 'cms/com/cmstautan/';
		$params->lib['class_name'] = 'comcmstautan';
		$params->lib['header_caption'] = 'Pengaturan Tautan &raquo; Tautan';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model','alias'=>'com_model'));
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		$optkanal = $this->CI->com_model->optkanal();
		$params->gridlib['arr_colModel']['id_kanal']['editoptions']['value'] = $optkanal;  
		// $params->gridlib['grid']['opt']['postData']['id_parent'] = $this->CI->input->post('id_menu');
		parent::__construct($params);
	}
	function comjs_features($params=false){
	    parent::comjs_features($params);
		$conf_view_features = array(
			'name'=>'comjs_extra',
			'data'=>$this->content,
			'return'=>true
		);
		$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->content['class_name'],'view',$conf_view_features);	    
		    $conf_view_features = array(
			    'name'=>'comjs_gridcomplete',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$conf_view_features);
		unset($this->content['grid']['toolbar']['excel']);
		unset($this->content['grid']['toolbar']['word']);
		unset($this->content['grid']['toolbar']['pdf']);
		unset($this->content['grid']['toolbar']['search']);
	}
	function formaction(){
		$hasil=$this->CI->com_model->simpan();
		echo json_encode($hasil);
	}	
	function urut(){
		$oper = $this->CI->input->post('oper');
		$id_kanal = $this->CI->input->post('id_kanal');
		$urutan = $this->CI->input->post('urutan');
		$data = $this->CI->com_model->urutan($oper,$id_kanal,$urutan);
		return $data;
	}
}
?>