<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcmsartikel extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/cmsartikel/';
		$params->lib['class_name'] = 'comcmsartikel';
		$params->lib['header_caption'] = 'Pengaturan Konten &raquo; Konten Umum &raquo; Artikel';
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
		$params->gridlib['grid']['opt']['postData']['id_rubrik'] = $this->CI->input->post('id_rubrik');
		// $params->lib['gf_form']['params_dropdown']['id_group']['db_query']['where']['1'] = $_SESSION['user_group'];
		parent::__construct($params);
	}
 	function index_segments($params=false){
		parent::index_segments($params);
		// $arrrubrik = $this->CI->com_model->optrubrik();
		// $this->content['arrrubrik']= @$arrrubrik['arr'];
		// $this->content['idrubrik'] = @$arrrubrik['default']?$arrrubrik['default']:'';
		// $this->content['arrrubrik'] 	= $this->CI->com_model->optrubrik('',$_SESSION['user_group']);
		// $this->content['idrubrik']  	= $this->CI->com_model->optrubrik($this->content['arrrubrik']['default'],$_SESSION['user_group']);
		$arrrubrik = $this->CI->com_model->optrubrik($this->CI->input->post('id_rubrik'),$_SESSION['user_group']);
		$this->content['arrrubrik']= @$arrrubrik['arr'];
		$this->content['idrubrik'] = @$arrrubrik['default']?$arrrubrik['default']:'0';
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
	    unset($this->content['grid']['toolbar']['search']);
    }
	
	function form(){
		// $this->CI->com_model->optrubrik($this->CI->input->post('id_rubrik'),$_SESSION['user_group']);
		// dump($this->CI->com_model->optrubrik($this->CI->input->post('id_rubrik'),$_SESSION['user_group']));
		$arrrubrik = $this->CI->com_model->optrubrik($this->CI->input->post('id_rubrik'),$_SESSION['user_group']);
		$this->content['arrrubrik']= @$arrrubrik['arr'];
		$this->content['idrubrik'] = @$arrrubrik['default']?$arrrubrik['default']:'0';
		// $this->content['arrrubrik']	= $this->CI->com_model->optrubrik($this->CI->input->post('id_rubrik'),$_SESSION['user_group']);
		// $this->content['idrubrik'] 	= $this->CI->com_model->optrubrik($this->content['arrrubrik']['default'],$_SESSION['user_group']);
		$id		  = @$this->CI->input->post('id_berita');
		$this->content['oper']	= $this->CI->input->post('oper');
		$this->content['id_berita']	= @$id?@$id:0;
		$this->content['data'] 	= @$this->CI->com_model->getdata($id);
		$id_penulis = @$this->content['data']->id_penulis;
		$arrpenulis = @$this->CI->com_model->optpenulis($id_penulis);
		$this->content['arrpenulis']= @$arrpenulis['arr'];
		$this->content['idrubrik'] = @$arrpenulis['default']?$arrpenulis['default']:'';
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
		$id =$this->CI->input->post("id_berita");
		$this->CI->com_model->removefile($id);
		$pesan = 'File telah di hapus';
		echo json_encode($pesan);
	}
	function urut(){
		$oper = $this->CI->input->post('oper');
		$id_menu = $this->CI->input->post('id_menu');
		$id_berita = $this->CI->input->post('id_berita');
		$urutan = $this->CI->input->post('urutan');
		$data = $this->CI->com_model->urutan($oper,$id_berita,$urutan,$id_menu);
		return $data;
	}
}
?>