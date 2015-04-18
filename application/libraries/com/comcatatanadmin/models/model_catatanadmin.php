<?php
class Model_catatanadmin extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	function get_skpd($id){
		return $_SESSION['id_skpd'];
	} 

	function simpan($id=false){
		$oper = $this->input->post('oper');
		$typepilih = $this->input->post('typepilih');
			if($typepilih == 'personal'){
				$id_skpd = $this->input->post('id_skpd');
				$judul = $this->input->post('judul');
				$uraian = $this->input->post('uraian');
			}else{
				$id_skpd = '';
				$judul = $this->input->post('judul_umum');
				$uraian = $this->input->post('uraian_umum');	
			}
		
	
		$this->responce = '';
		switch($oper){
			case 'add':
				$this->db->set('id_pengirim',$id);	
				$this->db->set('id_penerima',$id_skpd);	
				$this->db->set('judul',$judul);	
				$this->db->set('type',$typepilih);	
				$this->db->set('uraian',$uraian);	
				$this->db->insert('catatan_administrator');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diinput','oper'=>$oper);
			break;	
			case 'edit':
				$this->db->where('id_catatan_admin',$this->input->post('id_catatan_admin'));
				$this->db->set('id_pengirim',$id);
				$this->db->set('id_penerima',$id_skpd);
				$this->db->set('judul',$judul);
				$this->db->set('uraian',$uraian);
				$this->db->update('catatan_administrator');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diedit','oper'=>$oper);
			break;
			case 'del':
				$this->db->where('id_catatan_admin',$this->input->post('id_catatan_admin'));
				$this->db->delete('catatan_administrator');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Dihapus','oper'=>$oper);
			break;
		}	
			return $this->responce;	
	}	

	function get_data($id){
		$this->db->select('a.*,c.nama_lengkap,b.nama_lengkap as nama_pengirim,d.path,d.filename');
		$this->db->where('id_catatan_admin',$id);	
		$this->db->from('catatan_administrator a');
		$this->db->join('m_skpd b','a.id_pengirim=b.id_skpd','left');
		$this->db->join('m_skpd c','a.id_penerima=c.id_skpd','left');
		$this->db->join('arsip_attachment d','d.parent_id=a.id_catatan_admin','left');
		$data = $this->db->get()->result();


		return $data;
	}	
	function view($id){
		$this->db->select('a.*,b.nama_lengkap as nama_penerima, c.nama_lengkap as nama_pengirim,d.path,d.filename');
		$this->db->where('id_catatan_admin',$id);	
		$this->db->from('catatan_administrator a');
		$this->db->join('m_skpd b','a.id_penerima=b.id_skpd','left');
		$this->db->join('m_skpd c','a.id_pengirim=c.id_skpd','left');
		$this->db->join('arsip_attachment d','d.parent_id=a.id_catatan_admin','left');
		
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
