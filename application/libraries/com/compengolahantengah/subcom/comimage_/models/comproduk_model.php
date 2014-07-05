<?php
class Comproduk_model extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	function simpan_produk(){
		switch ($this->input->post('oper')):
		// ====================== penambahan data ==============================
		case 'add':		   
			$this->_doset();
			$report = $this->db->insert('r_produk');
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
			$this->db->where('id_produk',$this->input->post('id_produk'));
			$report = $this->db->update('r_produk');
			if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');
			    $this->responce['rows'] = @$data?$data:array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil diubah':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'edit');
			endif;
			break;
		// ====================== penghapusan data ==============================
		case 'del':
			$this->db->where('id_produk',$this->input->post('id_produk'));
			$report = $this->db->delete('r_produk');
			if($report['result']):
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
	function _doset() {

		$this->db->set('id_jenis_komoditi',$this->input->post('id_jenis_komoditi'));
		$this->db->set('id_perusahaan',$this->input->post('id_perusahaan'));	
		$this->db->set('merk',$this->input->post('merk'));
		$this->db->set('id_satuan',$this->input->post('id_satuan'));
		$this->db->set('harga_jual',$this->input->post('harga_jual'));
		$this->db->set('jumlah_pertahun',$this->input->post('jumlah_pertahun'));
		$this->db->set('keterangan',$this->input->post('keterangan'));
	}

	function getdropdownsatuan(){
		$res = $this->db->get('m_satuan')->result_array();
		$str_opt = '';
		foreach($res as $row):
			$str_opt .= $row['id_satuan'].':'.$row['nama_satuan'].";";
		endforeach;
		$str_opt = substr($str_opt,0,strlen($str_opt)-1);
		return $str_opt;
	}
	
	function getdata($id_produk=false){
		$this->db->where('id_produk',@$id_produk);
		$data = $this->db->get('r_produk_gambar')->result();
		return @$data;
	}
}

?>