<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cek extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}	
	function m_prokeg_aturan_item(){
		$this->db->like('path','3385','after');
		$prokeg = $this->db->get('m_prokeg_aturan_item')->result();
		foreach($prokeg as $key=>$row){
			$path_exp = explode('*',$row->path);
			$path_exp_new = array();
			foreach($path_exp as $keys=>$rows){
				if($keys == 0){
					$path_exp_new[] = '3059';
				}else{
					$path_exp_new[] = $rows;
				}
			}
			$new_path = implode('*',$path_exp_new);
			$this->db->set('path',$new_path);
			$this->db->where('id_prokeg_aturan_item',$row->id_prokeg_aturan_item);
			// $this->db->update('m_prokeg_aturan_item');
		}
	}
	function cek_m_prokeg_aturan_item(){
		// CEK PATH
		$urusan = $this->db->where('id_prokeg_jenis','2')->get('m_prokeg')->result();
		foreach($urusan as $key=>$row){
			// dump($row->id_prokeg);

			$this->db->where('id_prokeg_jenis',4);
			$this->db->like('kode_path','x.xx.xx','after');
			$non_urusan = $this->db->get('m_prokeg')->result();

			$cek_data1 = $this->db->where('id_prokeg',$row->id_prokeg)->get('m_prokeg_aturan_item')->row();
			foreach($non_urusan as $key_non=>$row_non){
				$this->db->set('id_prokeg',$row_non->id_prokeg);
				$this->db->set('id_prokeg_aturan',1);
				$this->db->set('id_parent',$cek_data1->id_prokeg_aturan_item);
				$this->db->insert('m_prokeg_aturan_item');

				$insert_id = $this->db->insert_id();

				$this->db->set('path',$cek_data1->path.$insert_id.'*');
				$this->db->where('id_prokeg_aturan_item',$insert_id);
				$this->db->update('m_prokeg_aturan_item');

				$this->db->where('id_parent',$row_non->id_prokeg);
				$last_urusan = $this->db->get('m_prokeg')->result();

				$cek_data2 = $this->db->where('id_prokeg_aturan_item',$insert_id)->get('m_prokeg_aturan_item')->row();

				foreach(@$last_urusan as $key_last=>$row_last){
					$this->db->set('id_prokeg',$row_last->id_prokeg);
					$this->db->set('id_prokeg_aturan',1);
					$this->db->set('id_parent',$insert_id);
					$this->db->insert('m_prokeg_aturan_item');

					$insert_id_last = $this->db->insert_id();

					$this->db->set('path',$cek_data2->path.$insert_id_last.'*');
					$this->db->where('id_prokeg_aturan_item',$insert_id_last);
					$this->db->update('m_prokeg_aturan_item');
				}
		
			}
		}
	}

	function cek_urutan_akun(){
		$this->db->select('id,id_parent,urutan');
		$this->db->where('id_parent',0);
		$data = $this->db->get('m_akun_aturan_item')->result();
		$urut = 1;
		foreach($data as $key=>$row){
			// parent
			echo $row->id.br();
			$this->db->set('urutan',$urut)->where('id',$row->id)->update('m_akun_aturan_item');
			$child = $this->next_akun($row->id,0);
			$urut++;
		}
	}
	private function next_akun($id=false,$no=false){
		$no++;
		$this->db->select('id,id_parent,urutan');
		$this->db->where('id_parent',$id);
		$next_data = $this->db->get('m_akun_aturan_item')->result();
		if(@$next_data){
			$urut1 = 1;
			foreach($next_data as $key=>$row){
				// child
				$space = 4*$no;
				$this->db->set('urutan',$urut1)->where('id',$row->id)->update('m_akun_aturan_item');
				echo nbs($space).$row->id.br();
			
				// next child
				$this->next_akun($row->id,$no);
				$urut1++;
			}
		}
	}
	function cek_urutan_prokeg_item(){
		$this->db->select('a.id_prokeg_aturan_item,a.id_parent,a.urutan,b.kode_path');
		$this->db->join('m_prokeg b','b.id_prokeg=a.id_prokeg');
		$this->db->where('a.id_parent',0);
		$this->db->order_by('b.kode_path');
		$data = $this->db->get('m_prokeg_aturan_item a')->result();
		$urut = 1;
		$level = 1;
		foreach($data as $key=>$row){
			// parent
			echo $row->id_prokeg_aturan_item.'#   path: '.$row->kode_path.'#  level: '.$level.br();
			$this->db->set('urutan',$urut)->where('id_prokeg_aturan_item',$row->id_prokeg_aturan_item)->update('m_prokeg_aturan_item');
			$child = $this->next_prokeg_item($row->id_prokeg_aturan_item,0,$level);
			$urut++;
		}
	}
	private function next_prokeg_item($id_prokeg_aturan_item=false,$no=false,$level=false){
		$level++;
		if($level == 2){
			$length = 3;
		}else if($level == 3){
			$length = 9;
		}else if($level == 4){
			$length = 12;
		}
		$no++;
		if($level <= 4){
			// ===========================================================================
			$select = "select a.id_prokeg_aturan_item,a.id_parent,a.urutan,b.kode_path,
				if(length(rtrim(mid(b.kode_path,$length,3)))=2,right(rtrim(b.kode_path),2)+1000,right(rtrim(b.kode_path),3)+1000) as path_new
				from m_prokeg_aturan_item a
				join m_prokeg b on b.id_prokeg=a.id_prokeg
				where a.id_parent = ".$id_prokeg_aturan_item."
				order by path_new";
			$next_data = $this->db->query($select)->result_array();
			// ===========================================================================
			// dump($next_data);
			if(@$next_data){
				$urut1 = 1;
				foreach($next_data as $key=>$row){
					// child
					$space = 4*$no;
					$this->db->set('urutan',$urut1)->where('id_prokeg_aturan_item',$row['id_prokeg_aturan_item'])->update('m_prokeg_aturan_item');
					echo nbs($space).$row["id_prokeg_aturan_item"].'# kode_path '.$row['kode_path'].'#   path: '.$row["path_new"].'#  level: '.$level.br();
			
					// next child
					$this->next_prokeg_item($row['id_prokeg_aturan_item'],$no,$level);
					$urut1++;
				}
			}
		}
	}
}

