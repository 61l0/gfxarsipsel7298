<?php
class User_model extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	function userAccount(){
		$this->db->where('user_id',$this->input->post('user_id'));
		$hasil = $this->db->get('c_user')->row();
		if($hasil->user_password === $this->input->post('user_password')){
			// dump('data password tidak diubah');
			$this->db->set('group_id',$this->input->post('group_id'));
			$this->db->set('user_name',$this->input->post('user_name'));
			// $this->db->set('user_password',$this->input->post('user_password'));
			$this->db->set('instansi',$this->input->post('instansi'));
			$this->db->set('id_skpd_sotk',$this->input->post('id_skpd_sotk'));
			$this->db->set('nama_pengguna',$this->input->post('nama_pengguna'));
			$this->db->where('user_id',$this->input->post('user_id'));
			$this->db->update('c_user');
		}else{
			// dump('data password diubah');
			$this->db->set('group_id',$this->input->post('group_id'));
			$this->db->set('user_name',$this->input->post('user_name'));
			$this->db->set('user_password',sha1($this->input->post('user_password')));
			$this->db->set('instansi',$this->input->post('instansi'));
			$this->db->set('id_skpd_sotk',$this->input->post('id_skpd_sotk'));
			$this->db->set('nama_pengguna',$this->input->post('nama_pengguna'));
			$this->db->where('user_id',$this->input->post('user_id'));
			$this->db->update('c_user');
		}
		$responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit','rows'=>array());
		return $responce;
	}
	function group(){
		return $this->db->get('c_group')->result();
	}
}

