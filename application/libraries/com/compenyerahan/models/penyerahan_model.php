<?php
class Penyerahan_model extends CI_Model {
    function __construct (){
        parent::__construct();
//		$this->responce = array();
	}
 	function tahun(){
		$arr_tahun = array();
		$th = '2025';
		for($i=1980; $i <= $th	; $i++){
			$arr_tahun[] = $i;
		}
		return $arr_tahun;
	}
	

	function simpan(){
		$oper = $this->input->post('oper');
		$tanggal = tgl_srt_to_mysql($this->input->post('tanggal'));
		$no = $this->input->post('no');
		$agenda = $this->input->post('agenda');
		$kode_komponen = $this->input->post('kode_komponen');
		$tahun = $this->input->post('tahun');
		$pertelaan = $this->input->post('pertelaan');
		$id_skpd = $this->input->post('id_skpd');
		$instansi = $this->input->post('instansi');

		if($_SESSION['user_group'] == 3){
			$id_skpd = $_SESSION['id_skpd'];
		}
		if($oper != 'del'){
			if( !empty($instansi) ){
				$id_skpd = 0;
			}else{
				$instansi = $this->db->select('nama_lengkap')
									 ->where('id_skpd',$id_skpd)
	    							 ->from('m_skpd')
									 ->get()->row()->nama_lengkap;
			}
		}

		$uraian = $this->input->post('uraian');
		$kepada = $this->input->post('kepada');
		$this->responce = '';
		switch($oper){
			case 'add':
				$this->db->set('tanggal_ba',$tanggal);
				$this->db->set('nomor_ba',$no);
				$this->db->set('agenda',$agenda);
				$this->db->set('komponen',$kode_komponen);
				$this->db->set('tahun',$tahun);
				$this->db->set('disertai_pertelaan',$pertelaan);
				$this->db->set('id_skpd',$id_skpd);
				$this->db->set('instansi',$instansi);
				$this->db->set('uraian',$uraian);
				$this->db->set('kepada',$kepada);
			//	$this->db->set('file',$this->input->post('berita_acr'));
				$this->db->insert('arsip_ba');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Diinput','oper'=>$oper);
			break;
			
			case 'edit':
				$this->db->where('id_ba',$this->input->post('id_ba'));
			//	$this->db->set('file',$this->input->post('berita_acr'));
				$this->db->set('instansi',$instansi);
				$this->db->set('tanggal_ba',$tanggal);
				$this->db->set('nomor_ba',$no);
				$this->db->set('agenda',$agenda);
				$this->db->set('komponen',$kode_komponen);
				$this->db->set('tahun',$tahun);
				$this->db->set('disertai_pertelaan',$pertelaan);
				$this->db->set('id_skpd',$id_skpd);
				$this->db->set('uraian',$uraian);
				$this->db->set('kepada',$kepada);
				$this->db->update('arsip_ba');
				// dump($this->db->last_query());
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Diedit','oper'=>$oper);
			break;
			
			case 'del':
				$this->db->where('id_ba',$this->input->post('id_ba'));
				$this->db->delete('arsip_ba');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data berhasil Didelet','oper'=>$oper);
			break;
		}	
		
		return $this->responce;
	}	
	
	function view(){
		$id_ba = $this->input->post('id_ba');
		$this->db->select('a.*,b.nama_lengkap');
		$this->db->where('a.id_ba',$id_ba);
		$this->db->from('arsip_ba a');
		$this->db->join('m_skpd b','a.id_skpd=b.id_skpd','left');
		$data = $this->db->get()->result();
		return $data;
	}
	function get_data($id){
		$this->db->select('a.*,b.nama_lengkap');
		$this->db->where('a.id_ba',$id);
		$this->db->from('arsip_ba a');
		$this->db->join('m_skpd b','a.id_skpd=b.id_skpd','left');
		$data = $this->db->get()->result();
		return $data;
	}
	
	function get_skpd(){
		$this->db->select('a.id_skpd, a.nama_lengkap');
		$this->db->from('m_skpd a');
		$this->db->join('m_skpd_sotk b','a.id_skpd=b.id_skpd','left');
		$this->db->where('b.id_aturan_skpd',1);
		$this->db->order_by('a.nama_lengkap','asc');
		$data = $this->db->get()->result();
		return $data;
	}
	
	function autocomplete($param=false,$type=false, $group=false, $id_group){
		//if($type=='kepada')

		if($id_group==3 && in_array($type,array('uraian','kepada')) ){
			$sql = "select uraian as hasil from arsip_ba where uraian like "."'%$param%' and id_skpd=".$group;
		}else{ 
			if(in_array($type,array('uraian','kepada','instansi')) && $id_group!='3'){
				$sql = "select $type as hasil from arsip_ba where $type like "."'%$param%'";
				
			// }else if($type=='instansi'){
			// 	$sql = "select b.nama_lengkap as hasil from arsip_ba a join m_skpd b on b.id_skpd=a.id_skpd where b.nama_lengkap like "."'%$param%' group by b.id_skpd";		
			}
		}
		$sql .= "LIMIT 10";
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();  
	}			
}	
