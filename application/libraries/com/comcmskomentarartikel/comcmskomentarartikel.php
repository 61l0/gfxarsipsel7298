<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcmskomentarartikel extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'cms/com/cmskomentarartikel/';
		$params->lib['class_name'] = 'comcmskomentarartikel';
		$params->lib['header_caption'] = 'Saran dan Kritik &raquo; Komentar Artikel';
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
        	$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->lib['class_name'],'view',$conf_view_features);
		    $conf_view_features = array(
			    'name'=>'comjs_gridcomplete',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$conf_view_features);
		    unset($this->content['grid']['toolbar']['search']);
		    unset($this->content['grid']['toolbar']['word']);
		    unset($this->content['grid']['toolbar']['excel']);
		    unset($this->content['grid']['toolbar']['pdf']);
		    unset($this->content['grid']['toolbar']['plus']);
	}
	function formaction(){
		$hasil = $this->CI->com_model->simpan();
		echo json_encode($hasil);
	}
}
?>
