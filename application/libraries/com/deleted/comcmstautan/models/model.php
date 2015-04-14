<?php
class Model extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->table_name = 'public_tautan';
	}
	function simpan(){
		switch ($this->input->post('oper')):
		// ====================== penambahan data ==============================
		case 'add':		   
			$this->_doset();
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
			$this->db->where('id_tautan',$this->input->post('id_tautan'));
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
				$this->db->where('id_tautan',$this->input->post('id_tautan'));				
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
	function optkanal(){
		$this->db->where('level',1);
		$this->db->order_by('menu_index','asc');
		$res = $this->db->get('public_menu')->result_array();
		$str_opt = '';
		foreach($res as $row):
			$str_opt .= $row['id_menu'].':'.$row['menu_name'].";";
		endforeach;
		$str_opt = substr($str_opt,0,strlen($str_opt)-1);
		return $str_opt;
	}
	function _getAutoIndex(){
		$this->db->select_max('urutan', 'max');
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
		$urutan = $this->input->post('urutan');
		if(empty($urutan))$urutan=$this->_getAutoIndex();
		$this->db->set("urutan",$urutan);
		$this->db->set("tautan_link",$this->input->post('tautan_link'));
		$this->db->set("tautan_url",$this->input->post('tautan_url'));
		$this->db->set("status",$this->input->post('status'));
		$this->db->set("id_kanal",$this->input->post('id_kanal'));
	}
	function urutan($oper=false,$id_kanal=false,$urutan=false){
		$urutan_new = '';
		if($oper=="turun"){
			$urutan_new = $urutan + 10;
		}else{
			$urutan_new = $urutan - 10;
		}
		// data self
		$this->db->where('urutan',$urutan);
		$this->db->where('id_kanal',$id_kanal);
		$id_self = $this->db->get($this->table_name)->row()->id_tautan;
		// data will replaced
		$this->db->where('urutan',$urutan_new);
		$this->db->where('id_kanal',$id_kanal);
		$id_replace = $this->db->get($this->table_name)->row()->id_tautan;
		
		$this->db->set('urutan',$urutan_new);
		$this->db->where('id_tautan',$id_self);
		$up1 = $this->db->update($this->table_name);
		$this->db->set('urutan',$urutan);
		$this->db->where('id_tautan',$id_replace);
		$up2 = $this->db->update($this->table_name);

		
		// if($up1 && $up2){
		    // $this->db->select('a.*');
		    // return $this->db->where('a.id_kanal',$id_kanal)->order_by('a.menu_index')->get($this->table_name.' a')->result();
		// }
	}
}
?>