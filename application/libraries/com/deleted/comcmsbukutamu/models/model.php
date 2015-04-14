<?php
class Model extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->table_name = 'bukutamu';
	}

	function simpan() {
		$oper = $this->input->post('oper');
		switch ($oper):
		// ====================== pengeditan data ==============================
		case 'edit':
			$this->db->set('status',$this->input->post('status'));
			$this->db->where('id_isian',$this->input->post('id_isian'));
			if($this->db->update($this->table_name)):
				$tgl = now();
				$this->db->set('tanggapan',$this->input->post('tanggapan'));
				$this->db->set('tanggal_tanggapan',$tgl);
				$this->db->set('status',$this->input->post('status'));
				$this->db->set('id_isian',$this->input->post('id_isian'));
				$this->db->set('user_id',$_SESSION['user_id']);
				$this->db->insert('bukutamu_tanggapan');
				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');
				$data = $this->db->get($this->table_name)->row();
			    $this->responce['rows'] = @$data?$data:array();
			else:
				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil diubah','oper'=>'edit');
			endif;
			break;
		// ====================== penghapusan data ==============================
		case 'del':
			$this->db->where('id_isian',$this->input->post('id_isian'));
			if($this->db->delete($this->table_name)):
				$this->db->where('id_isian',$this->input->post('id_isian'));
				$this->db->delete('bukutamu_tanggapan');
				$this->responce = array('result'=>'succes','message'=>'Data berhasil dihapus','oper'=>'del');
				$this->responce['rows'] = array();
			else:
				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil dihapus','oper'=>'del');
			endif;
			break;
		// ====================== tidak ada oper ==============================
		default:
			$this->responce = array('result'=>'failed','message'=>'Cannot identify oper type','oper'=>$oper);
		endswitch;

		return $this->responce;
	}
	
	
}
?>