<?php
class Model_lap_skpd extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	function get_skpd($id){
		$this->db->select('b.id_skpd');	
		$this->db->where('user_id',$id);	
		$this->db->from('c_user a');	
		$this->db->join('m_skpd_sotk b','a.id_skpd_sotk=b.id_skpd_sotk');
		$data = @$this->db->get()->row()->id_skpd;
		// dump($this->db->last_query());
		return $data;
	} 

	function simpan($id=false){
		$oper = $this->input->post('oper');
		$type_surat = $this->input->post('typesurat');
		$kode_kls = $this->input->post('kode_kls');
		$stamp = strtotime($this->input->post('tanggal'));
		$tanggal = date("Y-m-d", $stamp);
		$no_surat = $this->input->post('no_surat');
		$sistem_penyimpanan = $this->input->post('sp');
		$lokasi_penyimpanan = $this->input->post('lp');
		$perihal = $this->input->post('perihal');
		$ket = $this->input->post('keterangan');
		
	
		$this->responce = '';
		switch($oper){
			case 'add':
				$this->db->set('kode',$kode_kls);	
				$this->db->set('type_surat',$type_surat);	
				$this->db->set('no_surat',$no_surat);	
				$this->db->set('tanggal',$tanggal);	
				$this->db->set('sistem_penyimpanan',$sistem_penyimpanan);	
				$this->db->set('lokasi_penyimpanan',$lokasi_penyimpanan);	
				$this->db->set('perihal',$perihal);	
				$this->db->set('keterangan',$ket);	
				$this->db->insert('arsip_surat');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diinput','oper'=>$oper);
			break;	
			case 'edit':
				$this->db->where('id_surat',$this->input->post('id_surat'));	
				$this->db->set('kode',$kode_kls);	
				$this->db->set('type_surat',$type_surat);	
				$this->db->set('no_surat',$no_surat);	
				$this->db->set('tanggal',$tanggal);	
				$this->db->set('sistem_penyimpanan',$sistem_penyimpanan);	
				$this->db->set('lokasi_penyimpanan',$lokasi_penyimpanan);	
				$this->db->set('perihal',$perihal);	
				$this->db->set('keterangan',$ket);	
				$this->db->update('arsip_surat');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diedit','oper'=>$oper);
			break;
			case 'del':
				$this->db->where('id_surat',$this->input->post('id_surat'));
				$this->db->delete('arsip_surat');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Dihapus','oper'=>$oper);
			break;
		}	
			return $this->responce;	
	}	

	function get_data($id){
		$this->db->select('a.*,b.name as nama_masalah');
		$this->db->where('id_surat',$id);	
		$this->db->from('arsip_surat a');
		$this->db->join('arsip_kode_masalah b','a.kode=b.kode','left');
		$data = $this->db->get()->result();
		return $data;
	}	
	function view($id){
		$this->db->select('a.*,b.name as nama_masalah');
		$this->db->where('id_surat',$id);	
		$this->db->from('arsip_surat a');
		$this->db->join('arsip_kode_masalah b','a.kode=b.kode','left');
		$data = $this->db->get()->result();
		// dump($this->db->last_query());
		return $data;
	}	
	function get_count_all(){
		$this->db->select('count(id_surat) as jml');
		$data = $this->db->get('arsip_surat')->row()->jml;
		return $data;
	}		

	function autocomplete($param=false,$type=false){
		
		if($type=='no_surat'){
			$sql = "select no_surat as hasil from arsip_surat where no_surat like "."'%$param%'";
			
		}else if($type=='kode'){
			$sql = "select b.kode as hasil from arsip_surat a join arsip_kode_masalah b on b.kode=a.kode where b.kode like "."'%$param%' group by b.kode";		
		}
		
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();  
	}					
}
