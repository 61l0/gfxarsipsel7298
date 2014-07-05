<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Comhome {
	function __construct(){
		$this->CI = & get_instance();
		$this->com_url = 'admin/com/home/';
		$this->class_name = 'comhome';
	}
	
	function index($arr_par=array()){
		$data = $arr_par;
		$this->CI->load->view($this->CI->template->viewPath."home/index",$data);
	}
	
}