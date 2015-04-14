<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
panel_loadmodul('grid');
class Comcmsperencanaan extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/cmsperencanaan/';
		$params->lib['class_name'] = 'comcmsperencanaan';
		$params->lib['header_caption'] = 'Pengaturan Konten &raquo; Konten Khusus &raquo; Perencanaan';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model','alias'=>'com_model'));

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
	    unset($this->content['grid']['toolbar']['search']);
    }
	
	function form(){
		$id		= $this->CI->input->post('id_perencanaan');
		$this->content['oper']	= $this->CI->input->post('oper');
		$this->content['id_perencanaan']	= @$id?@$id:0;
		$this->content['data'] 	= $this->CI->com_model->getdata($id);
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
	
	function removefile(){
		$id =$this->CI->input->post("id_perencanaan");
		$this->CI->com_model->removefile($id);
		$pesan = 'File telah di hapus';
		echo json_encode($pesan);
	}
	function urut(){
		$oper = $this->CI->input->post('oper');
		$tanggal = $this->CI->input->post('tanggal');
		$id_perencanaan = $this->CI->input->post('id_perencanaan');
		$urutan = $this->CI->input->post('urutan');
		$data = $this->CI->com_model->urutan($oper,$id_perencanaan,$urutan,$tanggal);
		return @$data;
	} 
}
?>