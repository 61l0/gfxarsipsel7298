<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mytable {
    function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->library('table');
		$this->tmpl = array (	'table_open'=> '<table border="1" cellpadding="4" cellspacing="0">', 'table_close'         => '</table>' );
	}
	function _set_template()
	{
		$this->CI->table->set_template($this->tmpl);
	}
	function generate_form($params)
	{
		foreach($params['colModel'] as $key=>$conf){
			$val = form_input($key,@$params['data']->$key);
			$this->CI->table->add_row($conf['label'],':',$val);
		}
		$this->_set_template();
		$table = $this->CI->table->generate();
		$this->CI->table->clear();
		return $table;
	}
	function generate_detail($params)
	{
		foreach($params['colModel'] as $key=>$conf){
			$this->CI->table->add_row($conf['label'],':',@$params['data']->$key);
		}
		$this->_set_template();
		$table = $this->CI->table->generate();
		$this->CI->table->clear();
		return $table;
	}
}	
?>
