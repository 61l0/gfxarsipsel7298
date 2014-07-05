<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Commstunitpengolah extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/mstunitpengolah/';
		$params->lib['class_name'] = 'commstunitpengolah';
		$params->lib['header_caption'] = 'Unit &raquo; Pengolah';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model_mstunitpengolah'));
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
	
	
	
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		// ============================================================
		//dropdown jenis skpd
		$this->com_name = $params->lib['class_name'];
		parent::__construct($params);
	}
	function griddata(){
		parent::griddata();
		// dump($this->CI->db->last_query());
	}
	
	function index_segments($params=false){
		parent::index_segments($params);	

		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'default','data'=>$this->content ,'return'=>true));		
	}			
	
    function comjs_features(){
        parent::comjs_features();
        $gridcomplete_config = array('name'=>'comjs_gridcomplete','return'=>true);
        $this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$gridcomplete_config);
		$this->content['comjs_features']['extra'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'comjs_extra','return'=>true));
        unset($this->content['grid']['toolbar']['word']);
        unset($this->content['grid']['toolbar']['excel']);
        unset($this->content['grid']['toolbar']['pdf']);
		unset($this->content['grid']['toolbar']['search']);
		unset($this->content['grid']['toolbar']['plus']);
	}
	
	function tambah_data(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = 'add';	
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'tambah_data','data'=>$this->content));
	}	
	function formaction(){
		$oper = $this->CI->input->post('oper');
		$id_skpd = $this->CI->input->post('id_skpd');
		if($oper != 'del'){	
			//$this->CI->form_validation->set_rules('id_skpd','Instansi','trim|required');
			$this->CI->form_validation->set_rules('skpd','Nama Lengkap','trim|required');
			//$this->CI->form_validation->set_rules('uraian','Uraian','trim|required');
			
			if($this->CI->form_validation->run() == FALSE){
				$hasil = array('result'=>'failed','message'=>validation_errors(),'oper'=>$oper);
			}else{
				
				$hasil = $this->CI->model_mstunitpengolah->simpan(@$id_skpd);
			}
		}else{
				
				$hasil = $this->CI->model_mstunitpengolah->simpan(@$id_skpd);
		}	
		echo json_encode($hasil);
	}	
	function edit(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $this->content['id_skpd'] = $this->CI->input->post('id_skpd');
		 $this->content['data_edit'] = $this->CI->model_mstunitpengolah->get_data($this->content['id_skpd']);
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'edit_data','data'=>$this->content));
	}	
	function view(){
		$hasil = $this->CI->model_catatanadmin->view($this->CI->input->post('id_catatan_admin'));
		$this->content['data'] = $hasil;
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'view_data','data'=>$this->content));
	}	
	function autocomplete(){
		$param1 = $this->CI->input->get('q');
		$param2 = $this->CI->input->get('type_cari');
		$id_group = $_SESSION['user_group'];
		$id_skpd = $_SESSION['id_skpd'];
		
		$responce = $this->CI->model_catatanadmin->autocomplete($param1,$param2, $id_group, $id_skpd);

		echo json_encode($responce);
	}					
}	
?>
