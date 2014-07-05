<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {

	var $sectionName;
	var $templateName ;
	var $data = array();
	public function __construct($params)
    {
		$this->CI =& get_instance();
		$this->sectionName = $params['sectionName'];
		$this->templateName = $params['templateName'];
		$this->htmlVarFolder = 'htmlvar/';
		$this->viewPath = $this->sectionName.'/templates/'. $this->templateName.'/';
		$this->baseHref = base_url().'application/views/'.$this->viewPath;
		log_message('debug', "Template Class Initialized");
    }	
	function loadHtmlVar($name=false,$data=false){
		return $this->CI->load->view($this->viewPath.$this->htmlVarFolder.$name,$data,true);
	}

}


/* End of file Template.php */
/* Location: ./system/application/libraries/lib/Template.php */