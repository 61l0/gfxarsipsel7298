<?php
class Lap_surat_keluar_model extends CI_Model {
    function __construct (){
        parent::__construct();
	}

 	function tahun(){
		$arr_tahun = array();
		$th = '2025';
		for($i=1980; $i <= $th	; $i++){
			$arr_tahun[] = $i;
		}
		return $arr_tahun;
	}	
 	function bulan(){
		$arr_bulan = array();
		$bl = 12;
		for($i=1; $i <= $bl	; $i++){
			$arr_bulan[] = ($i < 10)?'0'.$i:$i;
		}
		return $arr_bulan;
	}	

	function unit_pengolah(){
		$this->db->select("id_skpd id_unit_pengolah,nama_lengkap name")->order_by('nama_lengkap','asc');
		$data = $this->db->get('m_skpd')->result();
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
	
	function display_children($parent, $id) {
		if($parent == 0){
			$this->db->where('id_kode_masalah',$id);
		}
		$this->db->where('id_parent',$parent);
		$data =  $this->db->get('arsip_kode_masalah')->result();
		$arr = array();
		foreach($data as $row){
					$arr[] = array(
						$row->id_kode_masalah,
						$this->display_children($row->id_kode_masalah, $id)
					 );
		}		
		return $arr;
	} 
	
	function get_data_laporan(){
		$data = $this->db->where('id_parent',0)->get('arsip_kode_masalah')->result();
		return $data;
	}	

	function get_data_laporan_jml($klasifikasi, $bulan, $tahun){
		$data = $this->display_children($aa=0,$klasifikasi);
		$arr = array_values($data);
		
		$objTmp = (object) array('aFlat' => array());
		array_walk_recursive($arr, create_function('&$v, $k, &$t', '$t->aFlat[] = $v;'), $objTmp);
		$val = $objTmp->aFlat;
		// dump($val);
	
		//untuk menghitung jumlah surat masuk
		$this->db->select('a.*,year(a.tanggal) as tgl, b.kode,b.name');
		$this->db->where_in('a.id_kode_masalah',$val);
		$this->db->where('a.type_surat','keluar');
		$this->db->from('arsip_surat a');
		$this->db->join('arsip_kode_masalah b','b.id_kode_masalah=a.id_kode_masalah');
		$surat_masuk = $this->db->get_where()->result();
		
		// dump($surat_masuk);
		return $surat_masuk;
		
	}	
}