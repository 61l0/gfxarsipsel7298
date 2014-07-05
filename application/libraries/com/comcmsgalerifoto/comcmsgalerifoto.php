<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class comcmsgalerifoto extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comcmsgalerifoto';
		$params->lib['com_url'] = 'cms/com/cmsgalerifoto/';
		$params->lib['class_name'] = 'comcmsgalerifoto';
		$params->lib['header_caption'] = 'Pengaturan Konten &raquo; Konten Umum &raquo; Galeri Foto';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model','alias'=>'com_model'));
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
	
	function formgambar(){
		$id_kategori = $this->CI->input->post('id_kategori');
		$this->content['id_kategori'] = @$id_kategori;
		$this->content['data'] = $this->CI->com_model->getdata(@$id_kategori);
		
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'formimage','data'=>@$this->content));
	}

	function saveupload(){
		$id = @$this->CI->input->post("id_kategori");
		$this->CI->com_model->saveupload($id);
	}
	
	function saveimagedata(){
		$id_kategori = $this->CI->input->post("id_kategori");
		$this->CI->com_model->saveimagedata($id_kategori);
	}
	
	function removeimage(){
		$id =$this->CI->input->post("id_galeri");
		$this->CI->com_model->removeimage($id);
		$pesan = 'Gambar telah di hapus';
		echo json_encode($pesan);
	}
}
?>