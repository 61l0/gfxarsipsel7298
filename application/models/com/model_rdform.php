<?php
class Model_rdform extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->responce = array();	
#		$this->table_name = 'm_kecamatan';
#		$this->table_prikey = 'id_kecamatan';
	}	
	function simpan($hasil=false){
	    dump($hasil);
	}
}
