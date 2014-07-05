<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcmsberanda extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'cms/com/cmsberanda/';
		$params->lib['class_name'] = 'comcmsberanda';
		$params->lib['header_caption'] = 'Pengaturan Tampilan &raquo; Beranda';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model','alias'=>'com_model'));
		// ===================dropdown jenis izin======================
		$opt_komponen = $this->CI->com_model->optkomponen();
		$params->gridlib['arr_colModel']['id_component']['editoptions']['value'] = $opt_komponen;  
		// ============================================================
		parent::__construct($params);
	}
    function comjs_features(){
        parent::comjs_features();
			$conf_view_features = array(
			    'name'=>'comjs_extra',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->lib['class_name'],'view',$conf_view_features);
		    $conf_view_features = array(
			    'name'=>'comjs_gridcomplete',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$conf_view_features);
	    unset($this->content['grid']['toolbar']['excel']);
	    unset($this->content['grid']['toolbar']['word']);
	    unset($this->content['grid']['toolbar']['pdf']);
    }
	function formaction(){
		$hasil = $this->CI->com_model->simpan();
		echo json_encode($hasil);
	}
	
	function urut(){
		$oper = $this->CI->input->post('oper');
		$id_parent = $this->CI->input->post('id_parent');
		$menu_index = $this->CI->input->post('menu_index');
		$data = $this->CI->com_model->urutan($oper,$id_parent,$menu_index);
		$new_data = array();
		foreach($data as $row){
		    $new_data[] = $row;
		}
		echo json_encode($new_data);
	}
}
?>