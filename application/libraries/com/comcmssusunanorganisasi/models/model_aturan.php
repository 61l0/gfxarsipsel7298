<?php
class Model_aturan extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	function aturan_on($id_aturan_skpd=false){
        	return $this->db->where('id_aturan_skpd',$id_aturan_skpd)->get('m_sotk')->row()->status;
	}
	function urutan($oper=false,$no_urut=false,$no_urut_dest=false){
		// data self
		$this->db->where('urutan',$no_urut);
		$id_self = $this->db->get('m_skpd_sotk')->row()->id_skpd_sotk;

		// data will replaced
		$this->db->where('urutan',$no_urut_dest);
		$id_replace = $this->db->get('m_skpd_sotk')->row()->id_skpd_sotk;

		// update self with new 'urutan'
		$this->db->set('urutan',$no_urut_dest);
		$this->db->where('id_skpd_sotk',$id_self);
		$up1 = $this->db->update('m_skpd_sotk');

		// next or prev 'urutan'
		$this->db->set('urutan',$no_urut);
		$this->db->where('id_skpd_sotk',$id_replace);
		$up2 = $this->db->update('m_skpd_sotk');
		
		if($up1 && $up2){
		    $this->db->select('a.*,b.nama_lengkap,b.nama_singkat');
		    $this->db->join('m_skpd b','b.id_skpd=a.id_skpd');
		    return $this->db->order_by('a.urutan')->get('m_skpd_sotk a')->result();
		}
	}

}
