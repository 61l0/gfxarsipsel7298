<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Modul {
	/*protected $CI;
	protected $com_name = false;
	protected $lib = array(
		'class_name' => '',
		'com_url' => '',

	);*/
	function __construct($params=false){
		//$this->com_name = false;
		$this->CI =& get_instance();
	}

	// LOAD SUB MODUL
	function loadsub(){ // $_POST['name'], $_POST['rowdata']
	    $lib_name = $this->CI->input->post('name');
	    $config['row_data'] = $this->CI->input->post('rowdata');
        $this->subfn($lib_name,'index',$config);
	}
	// EXECUTE SUBMODULE
	function subfn($lib_name,$method_name,$config=array()){
        $config['master_class_name'] = $this->lib['class_name'];
        $config['master_com_url']=$this->lib['com_url'].'subfn/';
        $lib_name = 'subcom/'.$lib_name.'/'.$lib_name;
		$this->CI->load->com($this->com_name,'library',array('name'=>$lib_name,'data'=>$config,'alias'=>'sublib'));
        $this->CI->sublib->$method_name();
	}
}
