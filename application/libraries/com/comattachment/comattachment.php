<?php

class comattachment {
	function comattachment(){
		 $this->CI = &get_instance();		
		
	}
	
	function index(){
		$this->CI->load->com('comattachment','view',array('name'=>'index'));
	}
}