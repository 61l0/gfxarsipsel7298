<?php
class c_user  extends Trigger{
    function __construct (){
        parent::__construct();
		$this->CI =& get_instance();
	}	
    function insert_before ($db , $table = '', $data = array(),$sql){
		$this->report = array('result'=>false,'message'=>$sql);
        return $this->report;
	}	
    function update_before ($db , $table = '', $data = array(),$sql){
		$sql = json_encode($data);
		$this->report = array('result'=>true,'message'=>$sql);
        return $this->report;
	}	
	function delete_before ($db , $table = '', $data = array(),$sql){
		$this->report = array('result'=>true,'message'=>$sql);
        return $this->report;
	}	
}
