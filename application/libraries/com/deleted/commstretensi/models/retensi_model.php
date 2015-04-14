<?php
class Retensi_model extends CI_Model {
    function __construct (){
        parent::__construct();
//		$this->responce = array();
	}
 	function tahun(){
		$arr_tahun = array();
		$th = '2025';
		for($i=1980; $i <= $th	; $i++){
			$arr_tahun[] = $i;
		}
		return $arr_tahun;
	}
	

	function simpan(){
		$oper = $this->input->post('oper');
		$id_parent = ($this->input->post('id_parent')=='')?0:$this->input->post('id_parent');
		$deskripsi = $this->input->post('deskripsi');
		$stamp_ad = strtotime($this->input->post('aktif_dari'));
		$aktif_dari = date("Y-m-d", $stamp_ad);
		$stamp_as = strtotime($this->input->post('aktif_sampai'));
		$aktif_sampai = date("Y-m-d", $stamp_as);
		$stamp_id = strtotime($this->input->post('inaktif_dari'));
		$inaktif_dari = date("Y-m-d", $stamp_id);
		$stamp_is = strtotime($this->input->post('inaktif_sampai'));
		$inaktif_sampai = date("Y-m-d", $stamp_is);
		$keterangan = $this->input->post('keterangan');
	
		$this->responce = '';
		switch($oper){
			case 'add':
				$this->db->set('desc',$deskripsi);
				$this->db->set('id_parent',$id_parent);
				$this->db->set('aktif_dari',$aktif_dari);
				$this->db->set('aktif_sampai',$aktif_sampai);
				$this->db->set('inaktif_dari',$inaktif_dari);
				$this->db->set('inaktif_sampai',$inaktif_sampai);
				$this->db->set('keterangan',$keterangan);
				$this->db->insert('arsip_retensi');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Diinput','oper'=>$oper);
			break;
			
			case 'edit':
				$this->db->where('id_retensi',$this->input->post('id_retensi'));
				$this->db->set('desc',$deskripsi);
				$this->db->set('id_parent',$id_parent);
				$this->db->set('aktif_dari',$aktif_dari);
				$this->db->set('aktif_sampai',$aktif_sampai);
				$this->db->set('inaktif_dari',$inaktif_dari);
				$this->db->set('inaktif_sampai',$inaktif_sampai);
				$this->db->set('keterangan',$keterangan);
				$this->db->update('arsip_retensi');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Diedit','oper'=>$oper);
			break;
			
			case 'del':
				$this->db->where('id_retensi',$this->input->post('id_retensi'));
				$this->db->delete('arsip_retensi');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Didelet','oper'=>$oper);
			break;
		}	
		
		return $this->responce;
	}	
	
	function view(){
		$id_ba = $this->input->post('id_ba');
		$this->db->select('a.*,b.nama_lengkap');
		$this->db->where('a.id_ba',$id_ba);
		$this->db->from('arsip_ba a');
		$this->db->join('m_skpd b','a.id_skpd=b.id_skpd');
		$data = $this->db->get()->result();
		return $data;
	}
	function get_data($id){
		$this->db->where('id_retensi',$id);
		$data = $this->db->get('arsip_retensi')->result();
		return $data;
	}
	
	function get_skpd(){
		$this->db->select('a.id_skpd, a.nama_lengkap');
		$this->db->from('m_skpd a');
		$this->db->join('m_skpd_sotk b','a.id_skpd=b.id_skpd');
		$this->db->where('b.id_aturan_skpd',1);
		$this->db->order_by('a.nama_lengkap','asc');
		$data = $this->db->get()->result();
		return $data;
	}
	function get_parent($id=false){
		$this->db->where('id_retensi',$id);
		$data = $this->db->get('arsip_retensi')->result();
		return $data;
	}
	function jumlah_tahun($tgl1, $tgl2){
		// echo $tgl2;
		 $tgl1 = (is_string($tgl1) ? strtotime($tgl1) : $tgl1);
		 $tgl2 = (is_string($tgl2) ? strtotime($tgl2) : $tgl2);
		 $diff_secs = abs($tgl1 - $tgl2);
		 $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
		 $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		 return array( "years" => date("Y", $diff) - $base_year,
						"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
						"months" => date("n", $diff) - 1,
						"days_total" => floor($diff_secs / (3600 * 24)),
						"days" => date("j", $diff) - 1,
						"hours_total" => floor($diff_secs / 3600),
						"hours" => date("G", $diff),
						"minutes_total" => floor($diff_secs / 60),
						"minutes" => (int) date("i", $diff),
						"seconds_total" => $diff_secs,
						"seconds" => (int) date("s", $diff));
	}
}	