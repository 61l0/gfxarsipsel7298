<?php
class Lap_pencarian_bulanan_model extends CI_Model {
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

	/* function lokasi_simpan($id){
		$this->db->select('a.*',false);
		$this->db->where('a.id_lokasi_simpan',$id);
		$this->db->from('arsip_lokasi_simpan a');
		$data = @$this->db->get()->result();
		$id_parent = explode('*',$data[0]->path);
		// dump($this->db->last_query());
		$name = array();
		foreach($id_parent as $row){
			$this->db->select('name, type');
			$this->db->where('id_lokasi_simpan',$row);
			$name[] = $this->db->get('arsip_lokasi_simpan')->row();
		}
		return @$name;
	}		 */

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
	
	function get_data_laporan($depo, $bulan, $tahun){
		if($depo != '' && $bulan != '' && $tahun != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where('a.tgl_input like',$tahun.'-'.$bulan.'%');
		}
		
		if($depo == '' && $bulan != '' && $tahun == ''){
			$this->db->where('a.tgl_input like','%'.'-'.$bulan.'%');
		}
		if($depo == '' && $bulan != '' && $tahun != ''){
			$this->db->where('a.tgl_input like',$tahun.'-'.$bulan.'%');
		}
		
		if($tahun =='' && $bulan != '' && $tahun != ''){
			$this->db->where('a.tgl_input like','%'.'-'.$bulan.'-'.'%');
		}
		if($bulan =='' && $depo == '' && $tahun != ''){
			$this->db->where('a.tgl_input like',$tahun.'-'.'%');
		}
		if($bulan =='' && $depo != '' && $tahun == ''){
			$this->db->where('a.depo',$depo);
		}
		if($bulan =='' && $depo != '' && $tahun != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where('a.tgl_input like',$tahun.'-'.'%');
		}
		if($tahun =='' && $bulan != '' && $depo != ''){
			$this->db->where('a.depo',$depo);
			$this->db->where('a.tgl_input like','%'.'-'.$bulan.'%');
		}
			
		$this->db->select('a.desc,a.id_lokasisimpan, a.judul,a.no_arsip,a.tahun, b.id_kode_masalah, b.name, d.name as pengolah');
		$this->db->from('arsip_data a');
		$this->db->join('arsip_kode_masalah b','a.id_kode_masalah=b.id_kode_masalah');
		$this->db->join('arsip_lokasi_simpan c','a.id_lokasisimpan=c.id_lokasi_simpan');
		$this->db->join('arsip_unit_pengolah d','a.id_unit_pengolah=d.id_unit_pengolah','left');
		$data = $this->db->get()->result();
		//dump($this->db->last_query());
		return $data;
	}	
}