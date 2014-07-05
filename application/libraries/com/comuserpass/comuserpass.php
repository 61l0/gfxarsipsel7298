<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Comuserpass {
	function Comuserpass(){
		$this->CI = &get_instance();		
		$this->class_name = strtolower(get_class($this));
		$this->class_name = $this->content['class_name'] = str_replace('com','',$this->class_name);
		$this->com_url =  $this->content['com_url'] = $_SESSION['section'].'/com/'.$this->class_name.'/';
		$this->header_caption = $this->content['header_caption'] = 'Pengguna &raquo; Ganti Password';
		// $this->viewPath = $this->content['viewPath'] = 'com/com'.$this->class_name.'/';
		$this->params = false;
	}
	function index(){
		$this->content['id_user'] = $_SESSION['user_id'];
		$this->content['user_name'] = $_SESSION['user_name'];
		$this->CI->load->com('comuserpass','view',array('name'=>'user_changepassform','data'=>$this->content));
	}
	
	function saveaccount(){
		$this->CI->load->library('encrypt');
		$id_user = $_SESSION['user_id'];
		if($this->CI->input->post('useracc_password') != $this->CI->input->post('useracc_password_2')){
			echo 'gagal-Password pertama dan ke dua tidak sama!';
		}else{
			// $this->CI->load->com('com/model_user','com2_model');
			$this->CI->load->com('comuserpass','model',array('name'=>'model_user','alias'=>'com_model'));
			$change_pass = $this->CI->com_model->change_password();
		}
		
	}
}

?>
