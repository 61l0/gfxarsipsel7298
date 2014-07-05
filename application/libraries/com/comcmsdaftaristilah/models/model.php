<?php
class Model extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->table_name = 'm_daftar_istilah';
	}
	function simpan(){
		switch ($this->input->post('oper')):
		// ====================== penambahan data ==============================
		case 'add':		   
			$this->_doset();
			$report = $this->db->insert($this->table_name);
			if($report){
				$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');
				$this->responce['rows'] = @$data?$data:array();
			}else{
				$this->responce = array('result'=>'failed','message'=>'data tidak bisa diinput','oper'=>'add');		
			}
			
			break;
		// ====================== pengeditan data ==============================
		case 'edit':
			$this->_doset();
			$this->db->where('id_daftar_istilah',$this->input->post('id_daftar_istilah'));
			$report = $this->db->update($this->table_name);
			if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');
			    $this->responce['rows'] = @$data?$data:array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil diubah':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'edit');
			endif;
			break;
		// ====================== mengubah status==============================
		case 'refresh':
			$status = @$this->db->select('status')->where('id_daftar_istilah',@$this->input->post('id_daftar_istilah'))->get($this->table_name)->row()->status;
			if($status=='publish'){
				$status = 'pending';
			}else{
				$status = 'publish';
			}
			$this->db->set('status',@$status);
			$this->db->where('id_daftar_istilah',@$this->input->post('id_daftar_istilah'));
			if($this->db->update($this->table_name)):
				$this->responce = array('result'=>'succes','message'=>'Status berhasil diubah','oper'=>'refresh');
				$this->responce['rows'] = array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil dihapus':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'del');
			endif;
			break;
		// ====================== penghapusan data ==============================
		case 'del':
				$this->db->where('id_daftar_istilah',$this->input->post('id_daftar_istilah'));
			if($this->db->delete($this->table_name)):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil dihapus','oper'=>'del');
				$this->responce['rows'] = array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil dihapus':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'del');
			endif;
			break;
		// ====================== tidak ada oper ==============================
		default:
			$this->responce = array('result'=>'failed','message'=>'Cannot identify oper type','oper'=>$oper);
		endswitch;

		return $this->responce;
	}
	function optabjad(){
		$res = array('A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E','F'=>'F','G'=>'G','H'=>'H','I'=>'I','J'=>'J','K'=>'K','L'=>'L','M'=>'M','N'=>'N','O'=>'O','P'=>'P','Q'=>'Q','R'=>'R','S'=>'S','T'=>'T','U'=>'U','V'=>'V','W'=>'W','X'=>'X','Y'=>'Y','Z'=>'Z');
		$str_opt = '';
		foreach($res as $key=>$row):
			$str_opt .= $key.':'.$row.";";
		endforeach;
		$str_opt = substr($str_opt,0,strlen($str_opt)-1);
		return $str_opt;
	}

	function _doset() {
		$this->db->set("abjad",$this->input->post('abjad'));
		$this->db->set("istilah",$this->input->post('istilah'));
		$this->db->set("penjelasan",$this->input->post('penjelasan'));
		$this->db->set("status",$this->input->post('status'));
	}
	
}
?>