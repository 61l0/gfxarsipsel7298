<?php
class Model_surat extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	function get_skpd($id){
		return $_SESSION['id_skpd'];
		
	} 

	function simpan($id=false){
		$oper = $this->input->post('oper');
		
		$surat = array(
			'indeks'	=> $this->input->post('indeks'),
			'kode'	=> $this->input->post('kode'),
			'perihal'	=> $this->input->post('perihal'),
			'no_surat'	=> $this->input->post('no_surat'),
			'no_urut'	=> $this->input->post('no_urut'),
			'lampiran'	=> $this->input->post('lampiran'),
			'lampiran2'	=> $this->input->post('lampiran2'),
			'id_skpd'	=> $this->input->post('id_skpd'),
			'isi_ringkas'	=> $this->input->post('isi_ringkas'),
			'catatan'	=> $this->input->post('catatan'),
			'pengolah'	=> $this->input->post('pengolah'),
			'tanggal_diteruskan'	=> tgl_srt_to_mysql($this->input->post('tanggal_diteruskan')),
			'tanggal_surat'	=> tgl_srt_to_mysql($this->input->post('tanggal_surat')),
			'sistem_penyimpanan'	=> $this->input->post('sistem_penyimpanan'),
			'lokasi_penyimpanan'	=> $this->input->post('lokasi_penyimpanan'),
			
		);
		//print_r($surat);

		// die();

		// $type_surat = $this->input->post('typesurat');
		// $kode = $this->input->post('kode_kls');
		// $stamp = strtotime($this->input->post('tanggal'));
		// $tanggal = date("Y-m-d", $stamp);
		// $no_surat = $this->input->post('no_surat');
		// $sistem_penyimpanan = $this->input->post('sp');
		// $lokasi_penyimpanan = $this->input->post('lp');
		// $perihal = $this->input->post('perihal');
		// $ket = $this->input->post('keterangan');
		
	
		$this->responce = '';
		switch($oper){
			case 'add':
				$surat['type_surat'] = $this->input->post('type_surat');
				$this->db->insert('arsip_lap_skpd',$surat);
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diinput','oper'=>$oper);

				/// CREATE DISPOSISI RECORD HERE
				if($surat['type_surat'] == 'masuk')
					$this->db->insert('arsip_lap_skpd_disposisi',array('id_lap_skpd'=> $this->db->insert_id()));
			break;	
			case 'edit':
				$this->db->where('id_lap_skpd',$this->input->post('id_lap_skpd'));	
				foreach ($surat as $key => $value) {
					$this->db->set($key,$value);
				}
				//die('komporgas');
				$this->db->update('arsip_lap_skpd');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diedit','oper'=>$oper);
			break;
			case 'del':
				$this->db->where('id_lap_skpd',$this->input->post('id_lap_skpd'));
				$this->db->delete('arsip_lap_skpd');
				// Also del disposisi
				$this->db->where('id_lap_skpd',$this->input->post('id_lap_skpd'));
				$this->db->delete('arsip_lap_skpd_disposisi');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Dihapus','oper'=>$oper);
			break;
		}	
			return $this->responce;	
	}	

	function get_data($id,$one=FALSE){
		$this->db->select("a.*,c.name as nama_masalah,DATE_FORMAT(a.tanggal_surat,'%d-%m-%Y') as tanggal_surat,DATE_FORMAT(a.tanggal_diteruskan,'%d-%m-%Y') as tanggal_diteruskan,b.nama_lengkap as instansi",FALSE);
		$this->db->where('id_lap_skpd',$id);	
		$this->db->from('arsip_lap_skpd a');
		$this->db->join('m_skpd b','a.id_skpd=b.id_skpd','left');
		$this->db->join('arsip_kode_masalah c','a.kode=c.kode','left');
		if($one)
			$data = $this->db->get()->row();
		else
			$data = $this->db->get()->result();	
		//$data->tanggal_surat = date('d-m-Y',strtotime($data->tanggal_surat));
		//$data->tanggal_diteruskan = date('d-m-Y',strtotime($data->tanggal_diteruskan));
		return $data;
	}	
	function view($id){
		$this->db->select('a.*, s.nama_lengkap as skpd,c.name as nama_masalah');
		$this->db->where('id_lap_skpd',$id);	
		$this->db->from('arsip_lap_skpd a');
	//	$this->db->join('arsip_kode_masalah b','a.kode=b.kode');
		$this->db->join('m_skpd s','a.id_skpd = s.id_skpd','left');

		$this->db->join('arsip_kode_masalah c','a.kode=c.kode','left');
		$data = $this->db->get()->result();
		//dump($this->db->last_query());
		return $data;
	}	
	function get_count_all(){
		$type_surat = $this->session->userdata('cgd_typesurat');
		$avail_type_surat = array('masuk','keluar'); 
		if(!in_array($type_surat, $avail_type_surat))
			$type_surat = 'masuk';
		$this->db->select('count(id_lap_skpd) as jml')->where('type_surat',$type_surat);
		$data = $this->db->get('arsip_lap_skpd')->row()->jml;
		return $data;
	}		

	function autocomplete($param=false,$type=false){
		
		if($type=='no_surat'){
			$sql = "select no_surat as hasil from arsip_lap_skpd where no_surat like "."'%$param%'";
			
		}else if($type=='kode'){
			$sql = "select b.kode as hasil from arsip_lap_skpd a join arsip_kode_masalah b on b.kode=a.kode where b.kode like "."'%$param%' group by b.kode";		
		}
		
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();  
	}					
}
