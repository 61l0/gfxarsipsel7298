<?php
class Pertelaanarsip_model extends CI_Model {
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
		
		$box = $this->input->post('box');
		$sampul = $this->input->post('sampul');

		$kode_masalah = $this->input->post('kode_kls');
		$nama_klasifikasi = $this->input->post('nama_kls');
		$oper = $this->input->post('oper');
		$tanggal = tgl_srt_to_mysql($this->input->post('tanggal'));
		$no_arsip = $this->input->post('no_arsip');
		$agenda = $this->input->post('agenda');
		$kode_komponen = $this->input->post('kode_komponen');
		$tahun = $this->input->post('tahun');
		$id_ba = $this->input->post('id_ba');
		$desc = $this->input->post('desc');
		if($_SESSION['user_group'] == 3){
			$id_unit_pengolah = $_SESSION['id_skpd'];
		}else{
			$id_unit_pengolah = $this->input->post('id_unit_pengolah');
		}
		//$desc = $this->input->post('desc');
		$this->responce = '';
		switch($oper){
			case 'add':
				$this->db->set('box',$box);
				$this->db->set('sampul',$sampul);
				$this->db->set('id_kode_masalah',$kode_masalah);
				$this->db->set('tanggal',$tanggal);
				$this->db->set('no_arsip',$no_arsip);
				$this->db->set('agenda',$agenda);
				$this->db->set('kode_komponen',$kode_komponen);
				$this->db->set('tahun',$tahun);
				$this->db->set('id_ba',$id_ba);
				$this->db->set('id_unit_pengolah',$id_unit_pengolah);
				$this->db->set('desc',$desc);
				$this->db->set('judul',$this->input->post('judul'));
				$this->db->insert('arsip_data');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Diinput','oper'=>$oper);
			break;
			
			case 'edit':
				$this->db->set('box',$box);
				$this->db->set('sampul',$sampul);
				$this->db->set('id_kode_masalah',$kode_masalah);
				$this->db->where('id_data',$this->input->post('id_data'));
				$this->db->set('judul',$this->input->post('judul'));
				$this->db->set('tanggal',$tanggal);
				$this->db->set('no_arsip',$no_arsip);
				$this->db->set('agenda',$agenda);
				$this->db->set('kode_komponen',$kode_komponen);
				$this->db->set('tahun',$tahun);
				//$this->db->set('disertai_pertelaan',$pertelaan);
				$this->db->set('id_unit_pengolah',$id_unit_pengolah);
				$this->db->set('desc',$desc);
				$this->db->update('arsip_data');
				// dump($this->db->last_query());
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Diedit','oper'=>$oper);
			break;
			
			case 'del':
				$this->db->where('id_data',$this->input->post('id_data'));
				$this->db->delete('arsip_data');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Didelet','oper'=>$oper);
			break;
		}	
		
		return $this->responce;
	}	
	
	function view(){
		$id_data = $this->input->post('id_data');
		$this->db->select('a.*,b.nama_lengkap,c.name nama_masalah');
		$this->db->where('a.id_data',$id_data);
		$this->db->from('arsip_data a');
		$this->db->join('m_skpd b','a.id_unit_pengolah=b.id_skpd','left');
		$this->db->join('arsip_kode_masalah c','a.id_kode_masalah=c.id_kode_masalah','left');
		$data = $this->db->get()->result();
		return $data;
	}
	function get_data($id){
		$this->db->select('a.*,b.nama_lengkap as unit_pengolah,c.name nama_masalah');
		$this->db->where('a.id_data',$id);
		$this->db->from('arsip_data a');
		$this->db->join('m_skpd b','a.id_unit_pengolah=b.id_skpd','left');
		$this->db->join('arsip_kode_masalah c','a.id_kode_masalah=c.id_kode_masalah','left');
		$data = $this->db->get()->result();
		return $data;
	}
	
	
	
}	