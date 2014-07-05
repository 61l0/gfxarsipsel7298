<?php
// require_once(PATH_APP.'models/com/jqgrid_model.php');
class Model_infopengguna extends CI_Model {
    function __construct (){
        parent::__construct();
	}
    function info($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$this->db->join('c_group b','b.id_group=a.group_id','left');
		$this->db->from('c_user a');
		$hasil = $this->db->get()->row_array();
		return $hasil;
	}
	function proses()
	{				
		// $this->db->set("user_name",$this->input->post('user_name'));
		$this->db->set("nama_pengguna",$this->input->post('nama_pengguna'));
		$this->db->where("user_id",$this->input->post('user_id'));
		$this->db->update("c_user");
		$_SESSION['nama_pengguna'] = $this->input->post('nama_pengguna');
	}
}
