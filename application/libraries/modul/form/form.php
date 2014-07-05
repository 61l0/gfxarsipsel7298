<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/modul.php');
class Form extends modul{
	function __construct(){
		$this->CI = & get_instance();
	}

    function index(){
	    $this->master_data = $this->CI->input->post('rowdata');
	    $this->content['data'] = $this->getdata($this->master_data,$this->inputmodel);
        $this->content['inputmodel'] = $this->inputmodel;
	    $this->content['class_name'] = $this->class_name;
	    $this->content['editurl'] = $this->content['com_url'].'formaction'; 
	    $this->content['jsobj'] = array('inputmodel'=>$this->inputmodel);
		$this->CI->load->modul('form','view',array('name'=>'default','data'=>$this->content,'alias'=>'default') );	    
	}
	function getdata(){
		$this->CI->load->modul('form','model',array('name'=>'kk_model','alias'=>'kk_model') );	    
	    return $this->CI->kk_model->getdata($this->master_data,$this->inputmodel);
	}
	function formaction(){
	    $data = $this->CI->input->post();
	    $params['post'] = $data;
	    $params['query'] = $this->inputmodel['query'];
	    $this->CI->load->modul('form','model',array('name'=>'kk_model','alias'=>'kk_model') );
	    return $this->CI->kk_model->simpan('update',$params);
	}}
