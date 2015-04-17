<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Www_static extends CI_Controller{

	public function index($t)
	{

		$key  	= $_GET['t']; $keys 	= explode('.', $key); $module = $keys[0]; $ext 	= $keys[1];

		header("Content-Type: text/" . ($ext == 'css' ? 'css' : 'javascript'));
		
		$method_name =  $module . '_' . $ext;
		
		$this->load->model('static_file');

		if(method_exists($this->static_file, $method_name))
		{
			echo $this->static_file->{$method_name}();
		}
		
	}
}