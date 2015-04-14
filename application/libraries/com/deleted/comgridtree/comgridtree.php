<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class Comgridtree extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/gridtree/';
		$params->lib['class_name'] = 'comgridtree';
		$params->lib['header_caption'] = 'Tree Grid';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		// ============================================================
		parent::__construct($params);
	}
	function index_segments($params=false){
	    parent::index_segments($params=false);
	    $this->CI->load->helper('security');
	    $sc = file_get_contents(DOC_PATH_ROOT.'application/libraries/com/comgridtree/comgridtree.php', TRUE, NULL, 1);
        $grid = file_get_contents(DOC_PATH_ROOT.'application/libraries/com/comgridtree/config/grid.php', TRUE, NULL, 1);
        $model = file_get_contents(DOC_PATH_ROOT.'application/libraries/com/comgridtree/config/main_model.php', TRUE, NULL, 1);
        
        $this->content['head'] = 'Contoh Simple TreeGrid dengan menggunakan config';
        $foot = "<pre><b>Script libraries Com</b><br><br>".$sc."</pre><pre><b>Config libraries/com/config untuk grid</b><br><br>".$grid."</pre><pre><b>Config libraries/com/config untuk grid_model</b><br><br>".$model."</pre>";
        $this->content_default['segments']['head'] = $this->CI->load->modul('grid','view',array('name'=>'default_head','data'=>$this->content));
        $this->content_default['segments']['footer'] = $foot;
    }

    function comjs_features(){
        parent::comjs_features();
        $gridcomplete_config = array('name'=>'comjs_gridcomplete_tree','return'=>true);
        $btn = array('name'=>'comjs_btn_plus_tree','return'=>true);
        $this->content['comjs_features']['gridcomplete'] = $this->CI->load->modul('grid','view',$gridcomplete_config);
        $this->content['comjs_features']['btn_plus_tree'] = $this->CI->load->modul('grid','view',$btn);
	}
}	
?>
