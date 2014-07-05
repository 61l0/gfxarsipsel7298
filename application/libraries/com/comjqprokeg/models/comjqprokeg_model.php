<?php
class Comjqprokeg_model extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	
	function aturan_on($id_prokeg_aturan=false){
        	return $this->db->where('id_prokeg_aturan',$id_prokeg_aturan)->get('m_prokeg_aturan')->row()->status;
	}

}
?>