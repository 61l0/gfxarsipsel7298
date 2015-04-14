<?php
class Model extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->table_name = 'public_menu_rubrik';
	}
	function simpan(){
		switch ($this->input->post('oper')):
		// ====================== penambahan data ==============================
		case 'add':		
			$id_group = $this->input->post('id_group');
			$id_menu_arr = $this->input->post('id_menu');
			if($id_menu_arr){
				foreach($id_menu_arr as $key=>$id_menu){
					$urutan = $this->_getAutoIndex($id_group);
					$this->db->set("id_group",$id_group);
					$this->db->set("id_menu", $id_menu);
					$this->db->set("menu_index", $urutan);
					$this->db->set("status",'off');
					$this->db->insert("public_menu_rubrik");
				}
				$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');
				$this->responce['rows'] = @$data?$data:array();
			}else{
				$this->responce = array('result'=>'failed','message'=>'data tidak bisa diinput','oper'=>'add');		
			}
			
			break;
		// ====================== pengeditan data ==============================
		case 'edit':
			$id = $this->input->post("id_menu");
			$this->db->select('*');
			$this->db->from('public_menu_rubrik');
			$this->db->where('id_menu',$id);
			$row = $this->db->get()->row_array();
			if(!empty($row)):
				if($row['status']== 'off'):
					$status = 'on';
				else:
					$status = 'off';
				endif;
				$this->db->set("status",$status);
				$this->db->where('id_menu',$id);
				$this->db->update($this->table_name);
			// if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');
			    $this->responce['rows'] = @$data?$data:array();
			else:
				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil diubah','oper'=>'edit');
			endif;
			break;
		// ====================== penghapusan data ==============================
		case 'del':
			$this->db->where('id_group', $this->input->post('id_group'));
			$this->db->where('id_menu', $this->input->post('id_menu'));
			if($this->db->delete($this->table_name)):
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
	function _getAutoIndex($id_group=false){
		$this->db->select_max('menu_index', 'max');
		$this->db->where('id_group', @$id_group);
		$row = $this->db->get('public_menu_rubrik')->row_array();
		$new_index = 10;
		if(!empty($row)):
			$new_index = $row['max'] + 10;
			return $new_index;
		else:
			return $new_index;
		endif;
	}

	// function _doset() {
		// $urutan = $this->input->post('menu_index');
		// if(empty($urutan))$urutan=$this->_getAutoIndex();
		// $this->db->set("menu_index",$urutan);
		// $this->db->set("id_parent",$this->input->post('id_menus'));
		// $this->db->set("menu_name",$this->input->post('menu_name'));
		// $this->db->set("menu_tipe",$this->input->post('menu_tipe'));
		// $this->db->set("status",$this->input->post('status'));
	// }
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
	function urutan($oper=false,$id_group=false,$menu_index=false){
		$urutan_new = '';
		if($oper=="turun"){
			$urutan_new = $menu_index + 10;
		}else{
			$urutan_new = $menu_index - 10;
		}
		// data self
		$this->db->where('menu_index',$menu_index);
		$this->db->where('id_group',$id_group);
		// $this->db->where('level',$level);
		$id_self = $this->db->get($this->table_name)->row()->id_menu;
		// data will replaced
		$this->db->where('menu_index',$urutan_new);
		$this->db->where('id_group',$id_group);
		// $this->db->where('level',$level);
		$id_replace = $this->db->get($this->table_name)->row()->id_menu;
		
		$this->db->set('menu_index',$urutan_new);
		$this->db->where('id_menu',$id_self);
		$up1 = $this->db->update($this->table_name);
		$this->db->set('menu_index',$menu_index);
		$this->db->where('id_menu',$id_replace);
		$up2 = $this->db->update($this->table_name);

		
		if($up1 && $up2){
		    $this->db->select('a.*');
		    return $this->db->where('a.id_group',$id_group)->order_by('a.menu_index')->get($this->table_name.' a')->result();
		}
	}
	function optkanal(){

		$arr['default'] = false;
		$this->db->where('level',1);
		$data = $this->db->get('public_menu')->result();
		// $arr['options'] = array(''=>'Pilih');
		foreach($data as $row):
			$arr['options'][$row->id_menu] = $row->menu_name;
		endforeach;
		return @$arr;	
	} 
	function optgroup($idkanal=false){
		$arr['default'] = false;
		if($idkanal!=''){
			$this->db->where('id_parent',@$idkanal);
			$this->db->where('level',2);
			$data = $this->db->get('public_menu')->result();
			$arr['options'] = @$data?array(0=>'Pilih'):array(''=>'Tidak ada data');
			foreach($data as $row):
				$arr['options'][$row->id_menu] = $row->menu_name;
			endforeach;
		}else{
			$arr['options'] = array(''=>'Pilih');
		}
		return @$arr;	
	}
	function getlistmenugroup(){
		$arr_menu = array();
		//get menu yg sudah ada dalam group 
		$this->db->select("id_menu");
		$this->db->from("public_menu_rubrik");
		//$this->CI->db->where("id_group", $this->CI->session->userdata('mgroup'));
		$res = $this->db->get()->result_array();
		foreach($res as $row):
			$arr_menu[] = $row['id_menu'];
		endforeach;
		//end get menu 
		
		//set list menu yang tidak ada di dalam group 
		$this->db->select("*");
		$this->db->from("public_menu");
		$this->db->where("level", 3);
		$this->db->where("id_component >", 0);
		if(!empty($arr_menu))$this->db->where_not_in('id_menu', $arr_menu);
		$res = @$this->db->get()->result();
		return @$res;
		// $str_menu = '';
		// foreach($res as $row):
			// $str_menu .= '<label><input type="checkbox" name="rubrik[]" id="rubrik[]" value="'.$row['id_menu'].'" /> '.$row['menu_name'].'</label><br />';
		// endforeach;
		// return $str_menu;
	}
}
?>