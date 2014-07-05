<?php
class Model_mstunitpengolah extends CI_Model {
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
		
		$id_skpd = $this->input->post('id_skpd');
		$nama_lengkap = $this->input->post('skpd');
		
	
		$this->responce = '';
		switch($oper){
			case 'add':
				
				$this->db->set('nama_lengkap',$nama_lengkap);	
				$this->db->insert('m_skpd');
				
				$this->db->set('name',$nama_lengkap);	
				$this->db->insert('arsip_unit_pengolah');
				
				
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diinput','oper'=>$oper);
			break;	
			case 'edit':
				$this->db->where('id_skpd',$this->input->post('id_skpd'));				
				$this->db->set('nama_lengkap',$nama_lengkap);
				$this->db->update('m_skpd');
				
				$this->db->where('id_unit_pengolah',$this->input->post('id_skpd'));				
				$this->db->set('name',$nama_lengkap);
				$this->db->update('arsip_unit_pengolah');
				
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diedit','oper'=>$oper);
			break;
			case 'del':
				$this->db->where('id_skpd',$this->input->post('id_skpd'));
				$this->db->delete('m_skpd');
				
				$this->db->where('id_unit_pengolah',$this->input->post('id_skpd'));
				$this->db->delete('arsip_unit_pengolah');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Dihapus','oper'=>$oper);
			break;
		}	
			return $this->responce;	
	}	

	function get_data($id){
		
		$this->db->where('id_skpd',$id);	
		$this->db->from('m_skpd');
		$data = $this->db->get()->result();
		return $data;
	}	
	function view($id){
		$this->db->select('a.*,b.nama_lengkap as nama_penerima, c.nama_lengkap as nama_pengirim');
		$this->db->where('id_catatan_admin',$id);	
		$this->db->from('catatan_administrator a');
		$this->db->join('m_skpd b','a.id_penerima=b.id_skpd','left');
		$this->db->join('m_skpd c','a.id_pengirim=c.id_skpd','left');
		$data = $this->db->get()->result();
		// dump($this->db->last_query());
		return $data;
	}	
	function autocomplete($param=false,$type=false, $id_group, $id_pengirim){
		if($id_group==3 && $type=='judul'){
			$sql = "select judul as hasil from catatan_administrator where judul like "."'%$param%' and id_pengirim=".$id_pengirim;
		}else{ 
		if($type=='judul'){
			$sql = "select judul as hasil from catatan_administrator where judul like "."'%$param%'";
			
		}else if($type=='instansi'){
			$sql = "select b.nama_lengkap as hasil from arsip_ba a join m_skpd b on b.id_skpd=a.id_skpd where b.nama_lengkap like "."'%$param%' group by b.id_skpd";		
		}
	}
		
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();  
	}				
}
