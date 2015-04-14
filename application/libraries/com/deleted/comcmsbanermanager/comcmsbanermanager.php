<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcmsbanermanager extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/cmsbanermanager/';
		$params->lib['class_name'] = 'comcmsbanermanager';
		$params->lib['header_caption'] = 'Pengaturan Tutan &raquo; Banner';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model','alias'=>'com_model'));
		// $params->lib['gf_form'] = $this->CI->config->item('lib');
		// if($params->lib['gf_form']){
    		// $params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		// }
		$params->gridlib['grid']['opt']['postData']['id_kanal'] = 0;
		parent::__construct($params);
	}
	function index_segments($params=false){
		parent::index_segments($params);
		$this->content['arrkanal'] 	= $this->CI->com_model->optkanal();
		$this->content['idkanal']  	= $this->CI->com_model->optkanal($this->content['arrkanal']['default']);
		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'default','data'=>$this->content ,'return'=>true));
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
	
	function form(){
		$id		= $this->CI->input->post('id_banner');
		$this->content['oper']	= $this->CI->input->post('oper');
		$this->content['id_banner']	= @$id?@$id:0;
		$this->content['data'] 	= $this->CI->com_model->getdata($id);
		$this->content['arrkanal'] 	= $this->CI->com_model->optkanal($this->CI->input->post('id_kanal'));
		$this->content['idkanal']  	= $this->CI->com_model->optkanal($this->content['arrkanal']['default']);
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'forminput','data'=>$this->content));
	}
	function formaction(){
		$hasil = $this->CI->com_model->simpan();
		echo json_encode($hasil);
	}
	function saveupload(){
		$hasil = $this->CI->com_model->saveupload();
		echo json_encode($hasil);
	}
	
	function removeimage(){
		$id =$this->CI->input->post("id_banner");
		$this->CI->com_model->removeimage($id);
		$pesan = 'Gambar telah di hapus';
		echo json_encode($pesan);
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