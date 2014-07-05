<?php
class Model extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->table_name = 'public_menu';
	}
	function simpan(){
		switch ($this->input->post('oper')):
		// ====================== penambahan data ==============================
		case 'add':		   
			$this->_doset();
			$this->db->set("level",2);
			$report = $this->db->insert($this->table_name);
			if($report){
				$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');
				$this->responce['rows'] = @$data?$data:array();
			}else{
				$this->responce = array('result'=>'failed','message'=>'data tidak bisa diinput','oper'=>'add');		
			}
			
			break;
		// ====================== pengeditan data ==============================
		case 'edit':
			$this->_doset();
			$this->db->where('id_menu',$this->input->post('id_menu'));
			$report = $this->db->update($this->table_name);
			if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');
			    $this->responce['rows'] = @$data?$data:array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil diubah':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'edit');
			endif;
			break;
		// ====================== penghapusan data ==============================
		case 'del':
			if($this->_cekGroupRubrik($this->input->post('id_menu'))):
				$this->	_delSubMenuGroupKanal($this->input->post('id_menu'));
				$this->db->where('id_menu',$this->input->post('id_menu'));
				$this->db->delete($this->table_name);
				$this->responce = array('result'=>'succes','message'=>'Data berhasil dihapus','oper'=>'del');
				$this->responce['rows'] = array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil dihapus':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'del');
			endif;
			break;
		// ====================== tidak ada oper ==============================
		default:
			$this->responce = array('result'=>'failed','message'=>'Cannot identify oper type','oper'=>$oper);
		endswitch;

		return $this->responce;
	}
	function _getAutoIndex(){
		$this->db->select_max('menu_index', 'max');
		$this->db->where('id_parent',$this->input->post('id_menus'));
		$this->db->where('level', 2);
		$row = $this->db->get($this->table_name)->row_array();
		$new_index = 10;
		if(!empty($row)):
			$new_index = $row['max'] + 10;
			return $new_index;
		else:
			return $new_index;
		endif;
	}

	function _doset() {
		$urutan = $this->input->post('menu_index');
		if(empty($urutan))$urutan=$this->_getAutoIndex();
		$this->db->set("menu_index",$urutan);
		$this->db->set("id_parent",$this->input->post('id_menus'));
		$this->db->set("menu_name",$this->input->post('menu_name'));
		$this->db->set("menu_tipe",$this->input->post('menu_tipe'));
		$this->db->set("status",$this->input->post('status'));
	}
	function _cekGroupRubrik($id_group = 0){
		$this->db->select('*');
		$this->db->from('public_menu_rubrik');
		$this->db->where('id_group', $id_group);
		$jml =  $this->db->count_all_results();
		if($jml == 0):
			return true;
		else:
			return false;
		endif;
	}
	
	function _delSubMenuGroupKanal($id_parent){
		//get sub menu
		$this->db->select('*');
		$this->db->where('id_parent', $id_parent);
		$this->db->where('level >=', 2);
		$res = $this->db->get($this->table_name)->result_array();
		foreach($res as $row):
			//cek child menu
			$this->db->select_sum('id_menu','jml');
			$this->db->where('id_parent', $row['id_menu']);
			$this->db->where('level >=', 2);
			$rec = $this->db->get($this->table_name)->row();
			if($rec->jml > 0):
				$this->_delSubMenuGroupKanal($row['id_menu']);
			else:
				$this->db->where('id_menu', $row['id_menu']);
				$this->db->delete($this->table_name); 
			endif;
		endforeach;		
	}
	function urutan($oper=false,$id_parent=false,$level=false,$menu_index=false){
		$urutan_new = '';
		if($oper=="turun"){
			$urutan_new = $menu_index + 10;
		}else{
			$urutan_new = $menu_index - 10;
		}
		// data self
		$this->db->where('menu_index',$menu_index);
		$this->db->where('id_parent',$id_parent);
		$this->db->where('level',$level);
		$id_self = $this->db->get($this->table_name)->row()->id_menu;
		// data will replaced
		$this->db->where('menu_index',$urutan_new);
		$this->db->where('id_parent',$id_parent);
		$this->db->where('level',$level);
		$id_replace = $this->db->get($this->table_name)->row()->id_menu;
		
		$this->db->set('menu_index',$urutan_new);
		$this->db->where('id_menu',$id_self);
		$up1 = $this->db->update($this->table_name);
		$this->db->set('menu_index',$menu_index);
		$this->db->where('id_menu',$id_replace);
		$up2 = $this->db->update($this->table_name);

		
		if($up1 && $up2){
		    $this->db->select('a.*');
		    return $this->db->where('a.id_parent',$id_parent)->where('a.level',$level)->order_by('a.menu_index')->get($this->table_name.' a')->result();
		}
	}
}
?>