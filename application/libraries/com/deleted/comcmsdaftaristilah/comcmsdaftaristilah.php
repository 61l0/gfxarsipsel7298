<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class Comcmsdaftaristilah extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comcmsgroup';
		$params->lib['com_url'] = 'admin/com/cmsdaftaristilah/';
		$params->lib['class_name'] = 'comcmsdaftaristilah';
		$params->lib['header_caption'] = 'Pengaturan Konten &raquo; Konten Khusus &raquo; Daftar Istilah';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model','alias'=>'com_model'));
		$abjad = $this->CI->input->post('abjad');
		$params->gridlib['grid']['opt']['postData']['abjad'] = @$abjad?@$abjad:'A';
		$params->gridlib['arr_colModel']['abjad']['editoptions']['value'] = $this->CI->com_model->optabjad();  
		parent::__construct($params);
	}
	function index_segments($params=false){
		parent::index_segments($params);
		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'default','data'=>@$this->content ,'return'=>true));
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
}
?>