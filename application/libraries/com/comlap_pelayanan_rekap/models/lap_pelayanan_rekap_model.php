<?php
class Lap_pelayanan_rekap_model extends CI_Model {
    function __construct (){
        parent::__construct();
	}

	function depo(){
		$this->db->select('id_lokasi_simpan, name as nama_klasifikasi');
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_lokasi_simpan')->result();
		return $data;
	}
	function klasifikasi(){
		$this->db->select('kode,id_kode_masalah,name as nama_masalah');
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_kode_masalah')->result();
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
	
	function get_data_laporan($bulan, $tahun){
		if( $bulan != '' && $tahun != ''){
			$this->db->where('a.tanggal_pinjam like',$tahun.'-'.$bulan.'%');
		}
		
		if($bulan != '' && $tahun == ''){
			$this->db->where('a.tanggal_pinjam like','%'.'-'.$bulan.'%');
		}
		
		if($bulan ==''  && $tahun != ''){
			$this->db->where('a.tanggal_pinjam like',$tahun.'-'.'%');
		}
			
		$this->db->select('a.*,b.no_arsip,b.judul, c.id_kode_masalah, c.kode,c.name as nama_klasifikasi');
		$this->db->from('arsip_peminjaman a');
		$this->db->join('arsip_data b','a.id_data=b.id_data');
		$this->db->join('arsip_kode_masalah c','c.id_kode_masalah=b.id_kode_masalah');
		$data = $this->db->get()->result();
		// dump($this->db->last_query());
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

	function get_data_laporan_jml($klasifikasi, $bulan, $tahun){
		$data = $this->display_children($aa=0,$klasifikasi);
		$arr = array_values($data);
		// dump($arr);
		
		$objTmp = (object) array('aFlat' => array());
		array_walk_recursive($arr, create_function('&$v, $k, &$t', '$t->aFlat[] = $v;'), $objTmp);
		$val = $objTmp->aFlat;
		
		//untuk menghitung jumlah arsip
		$this->db->select('id_data');
		$this->db->where_in('id_kode_masalah',$val);
		$arr_id_lokasi_simpan = $this->db->get_where('arsip_data')->result_array();
		if($arr_id_lokasi_simpan){
			$objTmp1 = (object) array('aFlat1' => array());
			array_walk_recursive($arr_id_lokasi_simpan, create_function('&$v, $k, &$t', '$t->aFlat1[] = $v;'), $objTmp1);
			$id_lokasi_simpan = $objTmp1->aFlat1;
		// dump($id_lokasi_simpan);
			
			//untuk menghitung peminjam
			$this->db->where_in('id_data',$id_lokasi_simpan);
			$this->db->where('status','pinjam');
			$peminjam = $this->db->get_where('arsip_peminjaman')->result();
			// dump($this->db->last_query());
			//untuk menghitung ada
			$this->db->where_in('id_data',$id_lokasi_simpan);
			$this->db->where('status','pinjam');
			$this->db->where('status_hasil','ada');
			$ada = $this->db->get_where('arsip_peminjaman')->result();
			//untuk menghitung tidakada
			$this->db->where_in('id_data',$id_lokasi_simpan);
			$this->db->where('status','pinjam');
			$this->db->where('status_hasil','tidakada');
			$tidakada = $this->db->get_where('arsip_peminjaman')->result();			
			

			// $jumlah_data_arsip = array('jml_arsip'=>count($arr_id_lokasi_simpan));
			$jumlah_peminjam = array('jml_peminjam'=>count($peminjam),'jml_ada'=>count($ada),'jml_tidakada'=>count($tidakada));
			// $this->array_push_associative($jumlah_peminjam);
		}
		$data_awal = $this->db->select('id_kode_masalah,kode,name as masalah')->where('id_parent',0)->get('arsip_kode_masalah')->result_array();	
		$this->array_push_associative($data_awal,@$jumlah_data_arsip);	

		return @$jumlah_peminjam;
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