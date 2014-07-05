<?php
class Lap_pelayanan_bulanan_model extends CI_Model {
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
	
	function get_data_laporan($bulan, $tahun){
		if( $bulan != '' && $tahun != ''){
			$this->db->where('a.tgl_pinjam like',$tahun.'-'.$bulan.'%');
		}
		
		if($bulan != '' && $tahun == ''){
			$this->db->where('a.tgl_pinjam like','%'.'-'.$bulan.'%');
		}
		
		if($bulan ==''  && $tahun != ''){
			$this->db->where('a.tgl_pinjam like',$tahun.'-'.'%');
		}
			
		$this->db->select('a.*,b.no_arsip,b.judul');
		$this->db->from('arsip_peminjaman a');
		$this->db->join('arsip_data b','a.id_data=b.id_data');
		$data = $this->db->get()->result();
		return $data;
	}	
}