<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}	
	private function menu_top(){
		// $this->load->widget('panel_menu','library','admin');
		$this->load->widget('panel_menu','library');
		return $this->panel_menu->index();
	}
	public function index(){
		$content['menu'] = $this->menu_top();
		$content['menu'] = $this->menu_top();
		$this->load->vars($content['menu']);
		
		$params = array('sectionName'=>'mockup','templateName'=>'test');

		// $this->sectionName = $params['sectionName'];
		$this->templateName = 'test';
		$this->htmlVarFolder = 'htmlvar/';
		$this->viewPath = 'assets/templates/'. $this->templateName.'/';
		// $this->baseHref = base_url().'application/views/'.$this->viewPath;

		// $this->load->library('lib/Template', $params);
		// $this->load->helper('Template');
		// $content['load'] = $this->load;
		$ori_ci_view_path = $this->load->_ci_view_path;
		$this->load->_ci_view_path = TEMPLATES_PATH.$this->templateName."/html/";
		// dump(BASEPATH.$this->viewPath."html/");
		$this->load->view('index',$content['menu']);
		$this->load->_ci_view_path = $ori_ci_view_path;
	}
	function loadHtmlVar($name=false,$data=false){
		return $this->CI->load->view($this->viewPath.$this->htmlVarFolder.$name,$data,true);
	}
	public function com(){
		$caller_params = array('caller_section'=>'panel','caller_func'=>'com');
		$numargs = func_num_args();
		$arg_list = func_get_args();
		$libName = GF_COM_PREFIX.$arg_list[0];
		$funcName = (isset($arg_list[1]))?$arg_list[1]:'index';
		$params = array();
		for ($i = 2; $i < $numargs; $i++) {
			$params[] = $arg_list[$i];
		}	
		$this->load->library(GF_COMPATH.$libName."/".$libName,$caller_params);
		return call_user_func_array(array($this->$libName, $funcName), $params);
	}
}

