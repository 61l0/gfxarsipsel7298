<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comjqprokeg extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comjqprokeg';
		$params->lib['com_url'] = 'admin/com/jqprokeg/';//
		$params->lib['class_name'] = 'comjqprokeg';
		$params->lib['header_caption'] = 'Setting &raquo; Program dan Kegiatan ';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');

		if(! @$this->CI->input->post('n_level')){
			$params->model['query']['query_table'] = array_merge($params->model['query']['query_table'],array('where'=>array('c.kode_path !=','x')));
		}
		
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
	    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);	
		}
		$params->gridlib['grid']['opt']['postData']['id'] = 0;

		parent::__construct($params);
	}
	function comjs_features($params=false){
	    parent::comjs_features($params);
	    
		    $conf_view_features = array(
			    'name'=>'comjs_extra',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com('comjqprokeg','view',$conf_view_features);
		    $conf_view_features = array(
			    'name'=>'comjs_gridcomplete',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['gridcomplete'] = $this->CI->load->com('comjqprokeg','view',$conf_view_features);
			unset($this->content['grid']['toolbar']['plus']);
	        unset($this->content['grid']['toolbar']['excel']);
	        unset($this->content['grid']['toolbar']['word']);
	        unset($this->content['grid']['toolbar']['pdf']);
	}
}	
?>
