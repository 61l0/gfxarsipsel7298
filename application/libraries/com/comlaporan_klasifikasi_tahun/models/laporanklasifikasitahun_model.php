<?php
class Laporanklasifikasitahun_model extends CI_Model {
    function __construct (){
        parent::__construct();
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
 	function bulan(){
		$arr_bulan = array();
		$bl = 12;
		for($i=1; $i <= $bl	; $i++){
			$arr_bulan[] = ($i < 10)?'0'.$i:$i;
		}
		return $arr_bulan;
	}		
 	function depo_kondisi($id){
		$this->db->select('id_lokasi_simpan, name');
		$this->db->where('id_lokasi_simpan',$id);
		$data = $this->db->get('arsip_lokasi_simpan')->result();
		return $data;
	}
 
	function klasifikasi(){
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_kode_masalah')->result();
		return $data;
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

	function get_data_laporan_jml($depo, $kode_klasifikasi, $tahun){
		$data = $this->display_children($aa=0,$kode_klasifikasi);
		$arr = array_values($data);
		
		$objTmp = (object) array('aFlat' => array());
		array_walk_recursive($arr, create_function('&$v, $k, &$t', '$t->aFlat[] = $v;'), $objTmp);
		$val = $objTmp->aFlat;
		//dump($val);
		
		$arr_depo = $this->db->select('id_lokasi_simpan')->where('id_parent',0)->get('arsip_lokasi_simpan')->result();
		
		//dump($arr_depo);
		$arr_d = array();
		foreach($arr_depo as $ls){
			$arr_d[] = $ls->id_lokasi_simpan;
		}
		
		$aa = implode(',',$arr_d);

		if($depo != '' && $kode_klasifikasi != '' && $tahun != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where_in('b.id_kode_masalah',$val);
			$this->db->where('a.tahun',$tahun);
		}
		
		if($depo == '' && $kode_klasifikasi != '' && $tahun == ''){
			$this->db->where_in('b.id_kode_masalah',$val);
		}
		if($depo == '' && $kode_klasifikasi != '' && $tahun != ''){
			$this->db->where('a.tahun',$tahun);
			$this->db->where_in('b.id_kode_masalah',$val);
		}
		
		
		if($kode_klasifikasi =='' && $depo == '' && $tahun != ''){
			$this->db->where('a.tahun',$tahun);
		}
		if($kode_klasifikasi =='' && $depo != '' && $tahun == ''){
			$this->db->where('a.depo',$depo);
		}
		if($kode_klasifikasi =='' && $depo != '' && $tahun != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where('a.tahun',$tahun);
		}
		if($tahun =='' && $kode_klasifikasi != '' && $depo != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where_in('b.id_kode_masalah',$val);
		}
		if($tahun =='' && $kode_klasifikasi == '' && $depo == ''){
			
			$this->db->where_in('b.id_kode_masalah',$val);
		}
			
		$this->db->select('a.id_lokasisimpan');
		$this->db->from('arsip_data a');
		$this->db->join('arsip_kode_masalah b','a.id_kode_masalah=b.id_kode_masalah','left');
		$this->db->join('arsip_lokasi_simpan c','a.id_lokasisimpan=c.id_lokasi_simpan','left');
		$this->db->join('arsip_unit_pengolah d','a.id_unit_pengolah=d.id_unit_pengolah','left');
		$arr_id_lokasi_simpan = $this->db->get()->result_array();
		
		
	//	dump($this->db->last_query());
	
		if($arr_id_lokasi_simpan){
			$objTmp1 = (object) array('aFlat1' => array());
			array_walk_recursive($arr_id_lokasi_simpan, create_function('&$v, $k, &$t', '$t->aFlat1[] = $v;'), $objTmp1);
			$id_lokasi_simpan = $objTmp1->aFlat1;
			
			//dump($id_lokasi_simpan);
			
			//untuk menghitung folder
			$this->db->where_in('id_lokasi_simpan',$id_lokasi_simpan);
			$folder = $this->db->get_where('arsip_lokasi_simpan')->result();
			
			//untuk menghitung box
			$this->db->select('distinct(b.id_lokasi_simpan)');
			$this->db->from('arsip_lokasi_simpan a');
			$this->db->join('arsip_lokasi_simpan b', 'b.id_lokasi_simpan = a.id_parent', 'left outer');
			$this->db->where_in('a.id_lokasi_simpan',$id_lokasi_simpan);
			$box = $this->db->get()->result();
			
			//untuk menghitung rak
			$this->db->select('distinct(c.id_lokasi_simpan)');
			$this->db->from('arsip_lokasi_simpan a');
			$this->db->join('arsip_lokasi_simpan b', 'b.id_lokasi_simpan = a.id_parent', 'left outer');
			$this->db->join('arsip_lokasi_simpan c', 'c.id_lokasi_simpan = b.id_parent', 'left outer');
			$this->db->where_in('a.id_lokasi_simpan',$id_lokasi_simpan);
			$rak = $this->db->get()->result();
			// dump($this->db->last_query());
			
			$jumlah_data_arsip = array('jml_arsip'=>count($arr_id_lokasi_simpan));
			$jumlah_folder = array('jml_folder'=>count($folder),'jml_box'=>count($box),'jml_rak'=>count($rak));
			$this->array_push_associative($jumlah_data_arsip,$jumlah_folder);
		}
		
		$data_awal = $this->db->select('id_kode_masalah,kode,name as masalah')->where('id_parent',0)->get('arsip_kode_masalah')->result_array();	
		$this->array_push_associative($data_awal,@$jumlah_data_arsip);	

		return @$jumlah_data_arsip;
	}	
	
	
	function get_data_laporan($depo, $klasifikasi){
		$data = $this->db->select('id_kode_masalah,kode,name as masalah')->where('id_parent',0)->get('arsip_kode_masalah')->result_array();
	return @$data;
	}	
	
	function get_data_laporan_kondisi($depo, $klasifikasi){
		$data = $this->db->select('id_kode_masalah,kode,name as masalah')->where(array('id_kode_masalah'=>$klasifikasi,'id_parent'=>0))->get('arsip_kode_masalah')->result_array();
	return @$data;
	}	
	
	function array_push_associative(&$arr) {
	   $args = func_get_args();
	   foreach ($args as $arg) {
		   if (is_array($arg)) {
			   foreach ($arg as $key => $value) {
				   $arr[$key] = $value;
				   @$ret++;
			   }
		   }else{
			   $arr[$arg] = "";
		   }
	   }
	   return $ret;
	}	
}