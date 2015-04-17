<?php
class Lap_pencarian_unit_pengolah_model extends CI_Model {
    function __construct (){
        parent::__construsct();
	}

	function depo(){
		$this->db->select('id_lokasi_simpan, name');
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_lokasi_simpan')->result();
		return $data;
	}
 	function tahun(){
		$arr_tahun = array();
		$th = '2025';
		for($i=1980; $i <= $th	; $i++){
			$arr_tahun[] = $i;
		}
		return $arr_tahun;
	}	
	function klasifikasi(){
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_kode_masalah')->result();
		return $data;
	}
	function klasifikasi_kondisi($id=false){
		$this->db->where('id_kode_masalah',$id);
		$data = $this->db->get('arsip_kode_masalah')->result();
		return $data;
	}
	
	function unit_pengolah(){
		$this->db->select("id_skpd id_unit_pengolah,nama_lengkap name")->order_by('nama_lengkap','asc');
		$data = $this->db->get('m_skpd')->result();
		// dump($data);
		return $data;
	}
	function unit_pengolah_cek($id){
		$this->db->where('id_unit_pengolah',$id);
		$this->db->order_by('name','asc');
		$data = $this->db->get('arsip_unit_pengolah')->result();
		// dump($data);
		return $data;
	}


	function lokasi_simpan($id){
		$stack = array();
		$parent = $id;
		while($parent != 0){
			$data = $this->db->select('id_lokasi_simpan,id_parent,name,type')->where('id_lokasi_simpan',$parent)->get('arsip_lokasi_simpan')->row();
			$parent = $data->id_parent;
			$stack[] = $data;
		}
		$stack = array_reverse($stack);
		return @$stack;
	}		
	
	function get_data_laporan($depo, $kode_klasifikasi, $tahun, $unit_pengolah){
		if($depo != '' && $kode_klasifikasi != '' && $tahun != '' && $unit_pengolah != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where('b.id_kode_masalah',$kode_klasifikasi);
			$this->db->where('d.id_unit_pengolah',$unit_pengolah);
			$this->db->where('a.tgl_input like',$tahun.'%');
		}
		if($depo == '' && $kode_klasifikasi != '' && $tahun == '' && $unit_pengolah == ''){
			$this->db->where('b.id_kode_masalah',$kode_klasifikasi);
		}
		if($kode_klasifikasi =='' && $depo == '' && $tahun != '' && $unit_pengolah == ''){
			$this->db->where('a.tahun',$tahun);
		}
		if($kode_klasifikasi =='' && $depo == '' && $tahun == '' && $unit_pengolah != ''){
			$this->db->where('d.id_unit_pengolah',$unit_pengolah);
		}
		if($kode_klasifikasi =='' && $depo != '' && $tahun == '' && $unit_pengolah == ''){
			$this->db->where('a.depo',$depo);
		}
		if($kode_klasifikasi =='' && $depo != '' && $tahun != '' && $unit_pengolah != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where('a.tahun',$tahun);
			$this->db->where('d.id_unit_pengolah',$unit_pengolah);
		}
		if($tahun =='' && $kode_klasifikasi != '' && $depo != '' && $unit_pengolah != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where('b.id_kode_masalah',$kode_klasifikasi);
			$this->db->where('d.id_unit_pengolah',$unit_pengolah);
		}
		if($depo == '' && $kode_klasifikasi != '' && $tahun != '' && $unit_pengolah != ''){
			$this->db->where('a.tahun',$tahun);
			$this->db->where('b.id_kode_masalah',$kode_klasifikasi);
			$this->db->where('d.id_unit_pengolah',$unit_pengolah);
		}
		if($depo != '' && $kode_klasifikasi != '' && $tahun != '' && $unit_pengolah == ''){
			$this->db->where('a.tahun',$tahun);
			$this->db->where('b.id_kode_masalah',$kode_klasifikasi);
			$this->db->where('a.depo',$depo);
		}
		
		
		if($kode_klasifikasi =='' && $depo != '' && $tahun == '' && $unit_pengolah != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where('d.id_unit_pengolah',$unit_pengolah);
		}
	
	
			
		$this->db->select('a.desc,a.id_lokasisimpan, a.judul,a.no_arsip,a.tahun, b.id_kode_masalah, b.name, d.name as pengolah');
		$this->db->from('arsip_data a');
		$this->db->join('arsip_kode_masalah b','a.id_kode_masalah=b.id_kode_masalah');
		$this->db->join('arsip_lokasi_simpan c','a.id_lokasisimpan=c.id_lokasi_simpan');
		$this->db->join('arsip_unit_pengolah d','a.id_unit_pengolah=d.id_unit_pengolah','left');
		$data = $this->db->get()->result();
		// dump($this->db->last_query());
		return $data;
	}	
}