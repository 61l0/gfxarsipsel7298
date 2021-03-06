<?php
class Laporanklasifikasi_model extends CI_Model {
    function __construct (){
        parent::__construct();
	}

	function depo(){
		$this->db->select('id_lokasi_simpan, name');
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_lokasi_simpan')->result();
		return $data;
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

	function get_data_laporan_jml($depo, $klasifikasi){
		$data = $this->display_children($aa=0,$klasifikasi);
		$arr = array_values($data);
		
		
		$objTmp = (object) array('aFlat' => array());
		array_walk_recursive($arr, create_function('&$v, $k, &$t', '$t->aFlat[] = $v;'), $objTmp);
		$val = $objTmp->aFlat;
		 //dump($val);
		$arr_depo = $this->db->select('id_lokasi_simpan')->where('id_parent',0)->get('arsip_lokasi_simpan')->result();
		
		
		$arr_d = array();
		foreach($arr_depo as $ls){
			$arr_d[] = $ls->id_lokasi_simpan;
		}
		
		$aa = implode(',',$arr_d);
		//dump($aa);
		//untuk menghitung jumlah arsip
		$this->db->select('id_lokasisimpan');
		$this->db->where_in('id_kode_masalah',$val);
		if($depo!=""){			
			$this->db->where('depo', $depo);
		}
		$arr_id_lokasi_simpan = $this->db->get_where('arsip_data')->result_array();
		//dump($this->db->last_query());
		if($arr_id_lokasi_simpan){
			$objTmp1 = (object) array('aFlat1' => array());
			array_walk_recursive($arr_id_lokasi_simpan, create_function('&$v, $k, &$t', '$t->aFlat1[] = $v;'), $objTmp1);
			$id_lokasi_simpan = $objTmp1->aFlat1;
			
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