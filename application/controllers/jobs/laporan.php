<?php 

class Laporan extends CI_Controller{

	var $_is_cli = FALSE;
	var $_params  = '';
	var $_query_string = '';
	var $_tmpfile = '';
	var $_tmp_filename = '';
	var $_download_url = '';
	var $_input_filename = '';
	

	var $_auth = '';
	var $_token = '';
	var $_job_name = '';

	function _auth()
	{
		// DO AUTH HERE
		if(empty($this->_auth))
		{
			die('Authentication Failed.');
		}
	}
	function _generate_tmp_file()
	{

	}
	function _get_download_url()
	{

	}
	function _extract_params()
	{
		$this->_params = json_decode(base64_decode($_SERVER['argv'][3]));
		if(isset($this->_params->auth))
		{
			$this->_auth = $this->_params->auth;
			unset($this->_params->auth);
		}
		print_r($this->_params);
	}
	function _start_entry_point()
	{
		// START ENTRY POINT HERE
		$this->output->set_output('');
	}
	function _generate_excel()
	{
		// START EXCEL GENERATION	
	}
	public function __construct()
	{
		parent::__construct();
		
		$this->is_cli =  $this->input->is_cli_request();
		$this->_extract_params();
		$this->_auth();
		$this->_start_entry_point();
	}
	public function generate()
	{

		//echo 'Hello World';
	}
}