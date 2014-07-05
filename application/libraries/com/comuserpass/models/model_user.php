<?php
class Model_user extends CI_Model {
    function __construct (){
        parent::__construct();
		// $this->CI = &get_instance();
	}
	function change_password(){
		$pwd = $this->encrypt->sha1($this->input->post('useracc_password'));
		$id_user = $_SESSION['user_id'];
		$this->db->set('user_password', $pwd);
		$this->db->where('user_id', $id_user);
		$this->db->update('c_user');
		echo "sukses-".$id_user;
	}
}
