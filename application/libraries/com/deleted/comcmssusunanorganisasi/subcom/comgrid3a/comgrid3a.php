<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class Comgrid3a extends Grid {
	function __construct($config=array()){
		$this->CI = & get_instance();
		$params = new stdClass;
        $params->lib['master_class_name'] = $config['master_class_name'];
		$params->lib['master_com_url'] = $config['master_com_url'];
		$params->lib['class_name'] = 'comgrid3a';
		$params->lib['header_caption'] = 'Input SKPD Per SOTK';
		$params->lib['com_url'] = $config['master_com_url'].$params->lib['class_name'].'/';		
		$params->lib['subcom'] = $params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'];

		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$id_akun = $this->CI->input->post('id_akun'); 
		// $params->gridlib['grid']['opt']['postData']['id'] = $this->CI->input->post('id');  
		$dd = $this->CI->input->post('rowdata');
		$params->gridlib['grid']['opt']['postData']['id_aturan_skpd'] = $dd['id_aturan_skpd'];

		parent::__construct($params);
	}
	function pilih(){
	        $this->CI->load->com($this->lib['subcom'],'model',array('name'=>'comgrid3a_model'));
		$id = $this->CI->input->post();
		$this->CI->comgrid3a_model->simpan($id);
	}
    function index_segments($params=false){
		parent::index_segments($params);
		$this->content['id_aturan_skpd'] = $id_aturan_skpd = $this->params['gridlib']['grid']['opt']['postData']['id_aturan_skpd'];
		$this->CI->load->com($this->lib['subcom'],'model',array('name'=>'comgrid3a_model'));
		$skpd_aturan = $this->CI->comgrid3a_model->data($id_aturan_skpd);
		
		$this->content['skpd_aturan'] 	= $skpd_aturan;
		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['subcom'],'view',array('name'=>'default','data'=>$this->content ,'return'=>true));
	}
	function comjs_features($params=false){
	    parent::comjs_features($params);
		 
        $gridcomplete_config = array('name'=>'comjs_gridcomplete','return'=>true);
        $this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['subcom'],'view',$gridcomplete_config);
		
		$conf_view_features = array(
			'name'=>'comjs_extra',
			'data'=>$this->content,
			'return'=>true
		);
		$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->lib['subcom'],'view',$conf_view_features);		
		unset($this->content['comjs_features']['toolbar']);

		}

}
