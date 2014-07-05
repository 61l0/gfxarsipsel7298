<?php
class Model_tapd extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->table_name = 'm_periode';
	}

	function periode() {
		$periode = $this->db->where('status','ON')->get('m_periode')->row()->id_periode;
		return $periode;
	}

	
}
?>