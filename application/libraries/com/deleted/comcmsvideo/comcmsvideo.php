<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class Comcmsvideo extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comcmsvideo';
		$params->lib['com_url'] = 'cms/com/cmsvideo/';
		$params->lib['class_name'] = 'comcmsvideo';
		$params->lib['header_caption'] = 'Pengaturan Konten &raquo; Konten Umum &raquo; Galeri Video &raquo; Isi Video';
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
		$params->gridlib['grid']['opt']['postData']['id_video'] = $this->CI->input->post('id_video');
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
		$this->content['comjs_features']['comjs_gridcomplete'] = $this->CI->load->com($this->content['class_name'],'view',$conf_view_features);
			
		unset($this->content['grid']['toolbar']['excel']);
		unset($this->content['grid']['toolbar']['word']);
		unset($this->content['grid']['toolbar']['pdf']);
		unset($this->content['grid']['toolbar']['search']);
	}
	function formaction(){
		$hasil=$this->CI->com_model->simpan();
		echo json_encode($hasil);
	}	
	
	function form(){
		$id_video = $this->CI->input->post('id_video');
		$this->content['id_video'] = @$id_video?@$id_video:0;
		$this->content['oper'] = @$this->CI->input->post('oper');
		$this->content['data'] = $this->CI->com_model->getdata(@$id_video);
		
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'forminput','data'=>@$this->content));
	}

	function saveupload(){
		$this->CI->com_model->saveupload();
	}
	
	function removeupload(){
		$id =$this->CI->input->post("id_video");
		$this->CI->com_model->removeupload($id);
		$pesan = 'Telah di hapus';
		echo json_encode($pesan);
	}
}
?>