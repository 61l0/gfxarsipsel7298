<?php
class Model_sys_menu extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->responce = array();
		$this->table_name = 'c_menu';
		$this->table_prikey = 'id_menu';
	}
    function griddata($params = false){
		if(! $params){
			return array();
		}
		
		$params->n_level++;
		// $params->n_level = ($params->n_level == 'root' )?0:$params->n_level++;
		$str = 'a.*,count(b.id_menu) as countchild';
		$this->db->select($str,false);
		$this->db->from('c_menu a');
		$this->db->join('c_menu b','a.id_menu=b.id_parent','left');
		$this->db->group_by('a.id_menu');
		$this->db->order_by('a.menu_index');
		$this->db->where('a.id_parent',$params->nodeid);

		$data = $this->db->get()->result();
		foreach($data as $key=>$row){
			$data[$key]->n_level = $params->n_level;
			$data[$key]->parent = $row->id_parent;
			if($row->countchild > 0){
				$data[$key]->expanded = false;
				$data[$key]->isLeaf = false;
			}else{
				$data[$key]->expanded = false;
				$data[$key]->isLeaf = true;
			}
		}
		
		return $data;
	}
	
	function simpan($params=array()) {
		switch ($params['oper']):
		// ====================== penamabhan data ==============================
		case 'add':
			// $this->db->set($this->table_prikey,$params[$this->table_prikey]);
			$this->db->set('id_parent',$params['id_parent']);
			$this->_doset($params);
			if($this->db->insert($this->table_name)):
				$id = $this->db->insert_id();
				$this->responce['rows'] = $this->db->where('id_menu',$id)->get('c_menu')->row();
				// $this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');
			else:
				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil ditambahkan','oper'=>'add');
			endif;
			break;
		// ====================== pengeditan data ==============================
		case 'edit':
			$this->_doset($params);
			$this->db->where($this->table_prikey,$params[$this->table_prikey]);
			if($this->db->update($this->table_name)):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');
			else:
				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil diubah','oper'=>'edit');
			endif;
			break;
		// ====================== penghapusan data ==============================
		case 'del':
			$this->db->where($this->table_prikey,$params[$this->table_prikey]);
			if($this->db->delete($this->table_name)):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil dihapus','oper'=>'del');
			else:
				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil dihapus','oper'=>'del');
			endif;
			break;
		// ====================== tidak ada oper ==============================
		default:
			$this->responce = array('result'=>'failed','message'=>'Cannot identify oper type','oper'=>$oper);
		endswitch;
		return $this->responce;
	}
	function _doset($params=array()) {
		$this->db->set('menu_name',	$params['menu_name']);
		$this->db->set('menu_index',		$params['menu_index']);
		$this->db->set('menu_path',		$params['menu_path']);
		$this->db->set('icon_menu',		$params['icon_menu']);
		$this->db->set('status',	$params['status']);

	}
	function hapus() {
		return $this->simpan();
	}
}
