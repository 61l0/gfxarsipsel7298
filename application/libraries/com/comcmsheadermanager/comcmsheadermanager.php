<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcmsheadermanager extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/cmsheadermanager/';
		$params->lib['class_name'] = 'comcmsheadermanager';
		$params->lib['header_caption'] = 'Pengaturan Tampilan &raquo; Header';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model','alias'=>'com_model'));

		parent::__construct($params);
	}
	function index_segments($params=false){
		parent::index_segments($params);
		$row = $this->CI->com_model->headerconfig();
		$data['banner_effect_opt']='';
		$data['banner_position_opt']='';
		$data['banner_direction_opt']='';
		$banner_effect = array('wave','zipper','curtain');
		$banner_position = array('top','bottom','alternate','curtain');
		$banner_direction = array('left','right','alternate','random','fountain','fountainAlternate');
		if(!empty($row)):
			foreach($banner_effect as $val):
				$selected = '';
				if($val == $row['banner_effect'])$selected = 'selected="selected"';
				$data['banner_effect_opt'] .= '<option value="'.$val.'" '.$selected.'>'.ucfirst($val).'</option>';
			endforeach;
			foreach($banner_position as $val):
				$selected = '';
				if($val == $row['banner_position'])$selected = 'selected="selected"';
				$data['banner_position_opt'] .= '<option value="'.$val.'" '.$selected.'>'.ucfirst($val).'</option>';
			endforeach;
			foreach($banner_direction as $val):
				$selected = '';
				if($val == $row['banner_direction'])$selected = 'selected="selected"';
				$data['banner_direction_opt'] .= '<option value="'.$val.'" '.$selected.'>'.ucfirst($val).'</option>';
			endforeach;
			$data['banner_width'] = $row['banner_width'];
			$data['banner_height'] = $row['banner_height'];
			$data['banner_strips'] = $row['banner_strips'] ;
			$data['banner_delay'] = $row['banner_delay'];
		endif;
		$data['id_config'] = $row['id_config'];
		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'default','data'=>$data,'return'=>true));
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
		$id		= $this->CI->input->post('id_header');
		$this->content['oper']	= $this->CI->input->post('oper');
		$this->content['id_header']	= @$id?@$id:0;
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
	
	function saveimagedata(){
		$id_header = $this->CI->input->post("id_header");
		$this->CI->com_model->saveimagedata($id_header);
	}
	
	function removeimage(){
		$id =$this->CI->input->post("id_header");
		$this->CI->com_model->removeimage($id);
		$pesan = 'Gambar telah di hapus';
		echo json_encode($pesan);
	}

}
?>