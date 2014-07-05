<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Comjqhome {

	function Comjqhome(){
		 $this->CI = &get_instance();		
		
	}
	
	function index(){
		$this->CI->load->com('comjqhome','view',array('name'=>'index'));
	}
	
	
}

?>
