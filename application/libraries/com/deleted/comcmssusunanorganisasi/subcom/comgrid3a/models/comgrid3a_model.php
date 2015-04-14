<?php
class comgrid3a_model extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	function data($id_aturan_skpd=false){
		if($id_aturan_skpd){
			$this->db->where('id_aturan_skpd',@$id_aturan_skpd);
			$data = $this->db->get('m_sotk')->row()->nama_aturan;
			return @$data;
		}
	}
    function simpan($id=false){
		$id_aturan_skpd = $this->input->post('id_aturan_skpd');
		$check 			= $this->input->post('check');
		if($check):
			foreach($check as $key=>$id_skpd):
				$this->db->set("id_skpd",$id_skpd);
				$this->db->set("id_aturan_skpd",$id_aturan_skpd);
				$this->db->set("status",'on');
				$this->db->insert("m_skpd_sotk");
				$id_insert_xx = $this->db->insert_id();

				$this->db->select('a.*,b.nama_lengkap, b.nama_singkat,c.status',false);
				$this->db->join('m_skpd b','b.id_skpd=a.id_skpd','left');
				$this->db->join('m_sotk c','a.id_aturan_skpd=c.id_aturan_skpd','left');
				$data = $this->db->where('a.id_skpd_sotk',$id_insert_xx)->get('m_skpd_sotk a')->row();
				$arr_data[$key] = $data;
			endforeach;
				$data = array();
				foreach($arr_data as $key_data=>$row_data){
					$data[] = $row_data;
				}
				$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');
				$this->responce['rows'] = @$data?@$data:array();
				echo json_encode($this->responce);
		endif;     
		
    } 
}
