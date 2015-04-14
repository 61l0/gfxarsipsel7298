<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Cominfopengguna {
	function Cominfopengguna(){
		$this->CI =& get_instance();
		$this->class_name = strtolower(get_class($this));
		$this->class_name = $this->content['class_name'] = str_replace('com','',$this->class_name);
		$this->com_url =  $this->content['com_url'] = $_SESSION['section'].'/com/'.$this->class_name.'/';
		$this->header_caption =  $this->content['header_caption'] = 'Pengguna &raquo; Info Pengguna';
		$this->params = false;
	}
	function index(){
		$this->CI->load->com('cominfopengguna','model',array('name'=>'model_infopengguna','alias'=>'com_model') );
		$user_id = $_SESSION['user_id'];
		$this->content['data'] = $this->CI->com_model->info($user_id);
		$this->CI->load->com('cominfopengguna','view',array('name'=>'info_pengguna','data'=>$this->content) );
	}
	function proses_confirm() {
		$this->CI->load->com('cominfopengguna','model',array('name'=>'model_infopengguna','alias'=>'com_model') );
		$this->CI->com_model->proses(); 

	}
	
}

?>
