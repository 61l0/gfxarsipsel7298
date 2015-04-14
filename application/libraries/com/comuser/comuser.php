<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comuser extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		// setting tambahan untuk sub_com
		$this->com_name = 'comuser';
		$params->lib['com_url'] = 'admin/com/user/';
		$params->lib['class_name'] = 'comuser';
		$params->lib['header_caption'] = 'Pengaturan Pengguna &raquo; Daftar Pengguna';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');

		if( $this->CI->uri->segment(4) != 'selectgroup' )
		{
			$this->content_default['segments']['head'] = $this->CI->load->com($params->lib['class_name'],'view',array('name'=>'default','data'=>@$this->content ,'return'=>false));	
		}
		parent::__construct($params);
	}
	
	function comjs_features($params=false){
	    parent::comjs_features($params);
	    
	    $skpd = array();
	    $upl = array();	
	    $m_skpd = $this->CI->db->select('a.id_skpd,a.nama_lengkap')
	    					 ->from('m_skpd  a')
	    					 ->get()->result_object();
	    					 
	    foreach ( $m_skpd as $r) {
	    	$skpd[$r->id_skpd] = $r->nama_lengkap;
	    }
	    // foreach($this->CI->db->get('arsip_unit_pengolah')->result_object() as $r){
	    // 	$upl[$r->id_unit_pengolah] = $r->name;
	    // }
		
		$this->content['aux'] =  array( 'skpd_list'  => $skpd );
		$conf_view_features = array(
			'name'=>'comjs_extra',
			'data'=>$this->content,
			'return'=>true

		);
		$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com('comuser','view',$conf_view_features);
		
		// unset($this->content['comjs_features']['toolbar']);
		unset($this->content['grid']['toolbar']['search']);
		unset($this->content['grid']['toolbar']['word']);
		unset($this->content['grid']['toolbar']['pdf']);
		unset($this->content['grid']['toolbar']['excel']);
	}
	function selectgroup(){
		$data=$this->CI->db->get('c_group')->result();	
		$this->CI->load->com('comuser','model',array('name'=>'user_model','alias'=>'com_model'));
		$this->content['data'] = $this->CI->com_model->group();
		$this->CI->load->com('comuser','view',array('name'=>'selectgroup','data'=>$this->content));
	}
	
#overide formaction user	
	function formaction(){
		if($this->CI->input->post('oper')=='edit'){
			$this->CI->load->com('comuser','model',array('name'=>'user_model','alias'=>'com_model'));
			$dataUser = $this->CI->com_model->userAccount();
			echo json_encode($dataUser);
			die();
		}else{
			parent::formaction();
		}
	}
	function checkgroup(){
			$this->responce = array('result'=>'success','group_id'=>$this->CI->input->post('group_id'));
			echo json_encode($this->responce);
	}
	// function aux (){

	// }
}
