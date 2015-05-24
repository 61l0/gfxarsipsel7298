<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comproxyurl extends Grid {
	function __construct(){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/proxyurl/';
		$params->lib['class_name'] = 'comoproxyurl';
		// $params->lib['header_caption'] = 'Pengguna &raquo; Pengguna Online';
		// // =========================================================
		// $this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		// $params->model = $this->CI->config->item('model_main');
		// $this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		// $params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		// $this->content_default['segments']['head'] = $this->CI->load->com($params->lib['class_name'],'view',array('name'=>'default','data'=>@$this->content ,'return'=>false));	
		
		parent::__construct($params);
	}
	public function load($directory,$base64)
	{
		if(!isset($_SESSION['user_id']))
		{
			die('Sorry, we are unable to process your request, Please Contact Administrator !');
		}
		$filename = $directory . '/' . base64_decode($base64);
		$path = DOC_PATH_ROOT . 'assets/media/file/' . $filename;

		if(file_exists($path))
		{
			$this->CI->load->helper('file');

			$mime = get_mime_by_extension($path);
			ob_clean();

			header('Content-Type: ',$mime);

			echo read_file($path);
		}
		else
		{
			echo 'FILE NOT FOUND : ' . $path;
		}
	}
}