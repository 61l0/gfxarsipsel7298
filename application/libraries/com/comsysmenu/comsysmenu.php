<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Comsysmenu {
	function __construct(){

		$this->CI =& get_instance();
		$this->view_path = 'com/comsysmenu/';
		$this->content['com_url'] = $this->com_url = 'admin/com/sysmenu/';
		$this->content['class_name'] = $this->class_name = 'comsysmenu';
		$this->CI->load->helper('convert');
		
		$this->gridlib_name = "treegrid_sys_menu";
		$this->modelcom_name = "model_sys_menu";
	}
	function comjs(){
		$this->CI->load->library('grid/'.$this->gridlib_name,'','gridlib');
		$this->grid = $this->CI->gridlib->grid;
		$this->grid->opt->url = site_url($this->com_url."griddata");
		$this->grid->opt->editurl = site_url($this->com_url."formaction");
		$this->grid->opt->caption = "Daftar Menu";
		

		$this->grid->opt->colModel = array_values($this->CI->gridlib->arr_colModel);
		$this->content['grid'] = $this->grid;
				
		$this->content['comjs'] = $this->CI->load->com('comsysmenu','view',array('name'=>'comjs','data'=>$this->content,'return'=>true) );
		// $this->content['comjs'] = $this->CI->load->view($this->view_path.'comjs',$this->content,true);
	}
	function index(){
		$this->comjs();
		$this->content['header_caption'] = 'Konfigurasi Menu';
		// $this->CI->load->view($this->view_path.'default',$this->content);
		$this->CI->load->com('comsysmenu','view',array('name'=>'default','data'=>$this->content) );
	}
	function griddata(){
		$params = new stdClass();
		$params->nodeid = ($this->CI->input->post('nodeid'))?$this->CI->input->post('nodeid'):0;
		$params->n_level = ($this->CI->input->post('n_level'))?$this->CI->input->post('n_level'):0;
	
		// $this->CI->load->model('com/'.$this->modelcom_name,'modelcom');
		$this->CI->load->com('comsysmenu','model',array('name'=>'model_sys_menu','alias'=>'modelcom') );
		
		$data['rows'] = $this->CI->modelcom->griddata($params);
		$this->CI->output->set_header('Contents-Type:application/json');
		$this->CI->output->set_output(json_encode($data)); 
	}
	function formaction(){
		// $this->CI->load->model('com/'.$this->modelcom_name,'modelcom');
		$this->CI->load->com('comsysmenu','model',array('name'=>'model_sys_menu','alias'=>'modelcom') );

		$params['oper'] = $this->CI->input->post('oper');
		
		$params['id_parent'] = $this->CI->input->post('id_parent');
		$params['id_menu'] = $this->CI->input->post('id_menu');
		
		$params['menu_index'] = $this->CI->input->post('menu_index');
		$params['menu_name'] = $this->CI->input->post('menu_name');
		$params['menu_path'] = $this->CI->input->post('menu_path');
		$params['icon_menu'] = $this->CI->input->post('icon_menu');
		$params['status'] = $this->CI->input->post('status');
		
		$responce = $this->CI->modelcom->simpan($params);
		$this->CI->output->set_header('Contents-Type:application/json');
		$this->CI->output->set_output(json_encode($responce)); 
	}

	
}	
?>