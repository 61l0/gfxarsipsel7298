<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class Comcmsgroup extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comcmsgroup';
		$params->lib['com_url'] = 'admin/com/cmsgroup/';
		$params->lib['class_name'] = 'comcmsgroup';
		$params->lib['header_caption'] = 'Pengaturan Kanal &raquo; Group';
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
		$params->gridlib['grid']['opt']['postData']['id_parent'] = $this->CI->input->post('id_menu');
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
		$id_parent = $this->CI->input->post('id_parent');
		$menu_index = $this->CI->input->post('menu_index');
		$level = $this->CI->input->post('level');
		$data = $this->CI->com_model->urutan($oper,$id_parent,$level,$menu_index);
		$new_data = array();
		foreach($data as $row){
		    $new_data[] = $row;
		}
		echo json_encode($new_data);
	}
}
?>