<?php
class Model_pemusnahan extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	
	function simpan($id=false){
		$oper = $this->input->post('oper');
		
	
		$this->responce = '';
		switch($oper){
			
			// case 'tinjau':
			// 	$this->db->where('id_data',$this->input->post('id_data'));	
			// 	$this->db->set('status',$oper);
			// 	$this->db->update('arsip_data');
			// 	$this->responce = array('result'=>'succes','message'=>'Data  Berhasil Diedit','oper'=>$oper);
			// break;
			case 'musnahkan':
				$this->db->where('id_data',$this->input->post('id_data'));	
				$this->db->set('status',$oper);
				$this->db->update('arsip_data');
				$this->responce = array('result'=>'succes','message'=>'Data  Berhasil Diedit','oper'=>$oper);
			break;
		}	
			return $this->responce;	
	}	

	function tinjau($id_data,$rt_aktif,$rt_inaktif,$rt_desc,$tgl_dinilai_kembali,$jml_tinjauan)
	{
		$this->db->where('id_data',$id_data);	
		$this->db->set('rt_inaktif',$rt_inaktif);
		$this->db->set('rt_aktif',$rt_aktif);
		$this->db->set('rt_desc',$rt_desc);
		$this->db->set('tgl_dinilai_kembali',$tgl_dinilai_kembali);
		$this->db->set('jml_tinjauan',$jml_tinjauan);
		$this->db->set('status','tinjau');

		$aktif_sampai = date('Y-m-d', strtotime('+'.$rt_aktif." year", strtotime($tgl_dinilai_kembali)) );
		$inaktif_sampai = date('Y-m-d', strtotime('+'.$rt_inaktif." year", strtotime($tgl_dinilai_kembali)) );
		
		$this->db->set('aktif_sampai',$aktif_sampai);
		$this->db->set('inaktif_sampai',$inaktif_sampai);

		$this->db->update('arsip_data');
		return array('result'=>'succes','message'=>'Data  Berhasil Diedit','oper'=>'tinjau');
	}
	function get_count_all(){
		$this->db->select('count(id_surat) as jml');
		$data = $this->db->get('arsip_surat')->row()->jml;
		return $data;
	}		
}