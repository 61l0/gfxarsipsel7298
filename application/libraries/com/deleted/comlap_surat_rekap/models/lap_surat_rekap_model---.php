<?php
class Lap_surat_rekap_model extends CI_Model {
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
		$this->db->order_by('name','asc');
		$data = $this->db->get('arsip_unit_pengolah')->result();
		// dump($data);
		return $data;
	}
	function klasifikasi(){
		$this->db->select('kode,id_kode_masalah,name as nama_masalah');
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_kode_masalah')->result();
		return $data;
	}	

	function lokasi_simpan($id){
		$stack = array();
		$parent = $id;
		while($parent != 0){
			$data = $this->db->select('id_surat,id_parent,name,type')->where('id_surat',$parent)->get('arsip_lokasi_simpan')->row();
			$parent = $data->id_parent;
			$stack[] = $data;
		}
		$stack = array_reverse($stack);
		return @$stack;
	}		
	
	function get_data_laporan($bulan, $tahun){
		if( $bulan != '' && $tahun != ''){
			$this->db->where('a.tanggal like',$tahun.'-'.$bulan.'%');
		}
		
		if($bulan != '' && $tahun == ''){
			$this->db->where('a.tanggal like','%'.'-'.$bulan.'%');
		}
		
		if($bulan ==''  && $tahun != ''){
			$this->db->where('a.tanggal like',$tahun.'-'.'%');
		}
			
		$this->db->select('a.*,b.*');
		$this->db->from('arsip_surat a');
		$this->db->join('arsip_kode_masalah b','a.id_kode_masalah=b.id_kode_masalah');
		$data = $this->db->get()->result();
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
		
		// if($pengolah != '' && $bulan != '' && $tahun != ''){
			// $this->db->where('a.pengolah',$pengolah);
			// $this->db->where('a.tgl_input like',$tahun.'-'.$bulan.'%');
		// }
		
		// if($pengolah == '' && $bulan != '' && $tahun == ''){
			// $this->db->where('a.tgl_input like','%'.'-'.$bulan.'%');
		// }
		// if($pengolah == '' && $bulan != '' && $tahun != ''){
			// $this->db->where('a.tgl_input like',$tahun.'-'.$bulan.'%');
		// }
		
		// if($tahun =='' && $bulan != '' && $tahun != ''){
			// $this->db->where('a.tgl_input like','%'.'-'.$bulan.'-'.'%');
		// }
		// if($bulan =='' && $pengolah == '' && $tahun != ''){
			// $this->db->where('a.tgl_input like',$tahun.'-'.'%');
		// }
		// if($bulan =='' && $pengolah != '' && $tahun == ''){
			// $this->db->where('a.pengolah',$pengolah);
		// }
		// if($bulan =='' && $pengolah != '' && $tahun != ''){
			// $this->db->where('a.pengolah',$pengolah);
			// $this->db->where('a.tgl_input like',$tahun.'-'.'%');
		// }
		// if($tahun =='' && $bulan != '' && $pengolah != ''){
			// $this->db->where('a.pengolah',$pengolah);
			// $this->db->where('a.tgl_input like','%'.'-'.$bulan.'%');
		// }
		
		//untuk menghitung jumlah arsip
		$this->db->select('id_surat');
		$this->db->where_in('id_kode_masalah',$val);
		$arr_id_surat = $this->db->get_where('arsip_surat')->result_array();
		if($arr_id_surat){
			$objTmp1 = (object) array('aFlat1' => array());
			array_walk_recursive($arr_id_surat, create_function('&$v, $k, &$t', '$t->aFlat1[] = $v;'), $objTmp1);
			$id_surat = $objTmp1->aFlat1;
		// dump($id_surat);
			
			//untuk menghitung jumlah surat masuk
			$this->db->where_in('id_surat',$id_surat);
			$this->db->where('type_surat','masuk');
			$surat_masuk = $this->db->get_where('arsip_surat')->result();
			//untuk menghitung jumlah surat keluar
			$this->db->where_in('id_surat',$id_surat);
			$this->db->where('type_surat','keluar');
			$surat_keluar = $this->db->get_where('arsip_surat')->result();		
			//cek sistem penyimpanan seri
			$this->db->where_in('id_surat',$id_surat);	
			$this->db->where('sistem_penyimpanan','Seri');
			$seri = $this->db->get('arsip_surat')->result();	
			//cek sistem penyimpanan Rubrik
			$this->db->where_in('id_surat',$id_surat);	
			$this->db->where('sistem_penyimpanan','Rubrik');
			$rubrik = $this->db->get('arsip_surat')->result();				
			// dump($this->db->last_query());
			//cek sistem penyimpanan Dosir
			$this->db->where_in('id_surat',$id_surat);	
			$this->db->where('sistem_penyimpanan','Dosir');
			$dosir = $this->db->get('arsip_surat')->result();		

			//cek lokasi penyimpanan Cabinet
			$this->db->where_in('id_surat',$id_surat);	
			$this->db->where('lokasi_penyimpanan','Cabinet');
			$cabinet = $this->db->get('arsip_surat')->result();	
			//cek sistem penyimpanan Rak
			$this->db->where_in('id_surat',$id_surat);	
			$this->db->where('lokasi_penyimpanan','Rak');
			$rak = $this->db->get('arsip_surat')->result();				
			// dump($this->db->last_query());
			//cek sistem penyimpanan Dosir
			$this->db->where_in('id_surat',$id_surat);	
			$this->db->where('lokasi_penyimpanan','Boks');
			$boks = $this->db->get('arsip_surat')->result();					

			// $jumlah_data_arsip = array('jml_arsip'=>count($arr_id_surat));
			$jumlah_surat = array('jml_cabinet'=>count($cabinet),'jml_rak'=>count($rak),'jml_boks'=>count($boks),'jml_rubrik'=>count($rubrik),'jml_dosir'=>count($dosir),'jml_seri'=>count($seri),'jml_surat_masuk'=>count($surat_masuk),'jml_surat_keluar'=>count($surat_keluar),'tahun'=>$surat_masuk[0]->tanggal);
			// $this->array_push_associative($jumlah_peminjam);
		}
		// $data_awal = $this->db->select('id_kode_masalah,kode,name as masalah')->where('id_parent',0)->get('arsip_kode_masalah')->result_array();	
		// $this->array_push_associative($data_awal,@$jumlah_data_arsip);	

		return @$jumlah_surat;
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