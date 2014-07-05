<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Panel_menu {
	function __construct($params=false){
		$this->CI =& get_instance();
	}
	function index(){
		$this->CI->load->widget('panel_menu','model',array('name'=>'panel_menu_model','alias'=>'panel_menu_model') );
		$content = $this->CI->panel_menu_model->get_menu();
		$content['menu_list'] = $this->CI->load->widget('panel_menu','view',array('name'=>'default','data'=>$content,'return'=>true) );
		// dump($content);
		return $content;
	}
}	
?>
