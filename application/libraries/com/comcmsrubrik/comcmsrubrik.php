<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class Comcmsrubrik extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comcmsrubrik';
		$params->lib['com_url'] = 'admin/com/cmsrubrik/';
		$params->lib['class_name'] = 'comcmsrubrik';
		$params->lib['header_caption'] = 'Pengaturan Kanal &raquo; Group';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model','alias'=>'com_model'));
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		// if($params->lib['gf_form']){
    		// $params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		// }
		$idkanal = @$this->CI->input->post('id_group');
		// dump($idkanal);
		// $idgroup_awal = @$this->CI->com_model->first_group_menu($idkanal);
		// dump($idgroup_awal);
		// $params->gridlib['grid']['opt']['postData']['id_parent'] = $this->CI->input->post('id_menu');
		// $params->lib['gf_form']['params_dropdown']['id_menu_group']['db_query']['where']['1'] = 80;
		parent::__construct($params);
	}
	function index_segments($params=false){
		parent::index_segments($params);
		$this->content['arrkanal'] 	= $this->CI->com_model->optkanal();
		$this->content['idkanal']  	= $this->CI->com_model->optkanal($this->content['arrkanal']['default']);
		$this->content['arrgroup'] 	= $this->CI->com_model->optgroup();
		$this->content['idgroup']  	= $this->CI->com_model->optgroup($this->content['arrgroup']['default']);
		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'default','data'=>$this->content ,'return'=>true));
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
        	$this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$conf_view_features);
		unset($this->content['grid']['toolbar']['excel']);
		unset($this->content['grid']['toolbar']['word']);
		unset($this->content['grid']['toolbar']['pdf']);
		unset($this->content['grid']['toolbar']['search']);
	}
	function formaction(){
		$hasil=$this->CI->com_model->simpan();
		echo json_encode($hasil);
	}	
	function getoptgroup(){
		$idkanal	= $this->CI->input->post('kanal');
		$data['dropdown'] = $this->CI->com_model->optgroup($idkanal);
		echo json_encode($data);
	}
	function urut(){
		$oper = $this->CI->input->post('oper');
		$id_group = $this->CI->input->post('id_group');
		$menu_index = $this->CI->input->post('menu_index');
		$data = $this->CI->com_model->urutan($oper,$id_group,$menu_index);
		$new_data = array();
		foreach($data as $row){
		    $new_data[] = $row;
		}
		echo json_encode($new_data);
	}
	
	function form(){
		$this->content['data'] = $this->CI->com_model->getlistmenugroup();
		$this->content['id_group'] = $this->CI->input->post('id_group');
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'form_input','data'=>@$this->content));
	
	}
	
}
?>