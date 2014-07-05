<?php
class Model extends CI_Model {
    function __construct (){
        parent::__construct();
	}
	function simpan(){
		switch ($this->input->post('oper')):
		// ====================== penambahan data ==============================
		case 'add':		   
			$this->_doset();
			$this->db->set("id_kategori",$this->input->post('id_kategori'));
			$report = $this->db->insert('video');
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
			$this->db->where('id_video',$this->input->post('id_video'));
			$report = $this->db->update('video');
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
			$this->db->where('id_video',$this->input->post('id_video'));
			$report = $this->db->delete('video');
			if($report['result']):
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
	function _doset() {
		$this->db->set("judul_video",$this->input->post('judul_video'));
		$this->db->set("tanggal",$this->input->post('tanggal'));
		$this->db->set("keterangan",$this->input->post('keterangan'));
		$this->db->set("sumber",$this->input->post('sumber'));
		$this->db->set("urutan",$this->input->post("urutan"));
		$this->db->set("status",$this->input->post("status"));
	}
//========================================================= untuk upload gambar ==========================================
	function getdata($id_video=false){
		$this->db->where('id_video',@$id_video);
		$this->db->order_by('urutan','asc');
		$data = $this->db->get('video')->row();
		return @$data;
	}
	
	function removeupload($id=false){
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('id_video', $id);
		$row = $this->db->get()->row();
		$file_path = 'assets/media/file/galeri_video/foto/';
		$file = $file_path.$row->video_image;
		if(is_file($file))unlink($file);
		$this->db->set("video_image",'');
		$this->db->where("id_video",$id);
		$this->db->update("video");

		}
	
	function saveupload(){
		$id = $this->input->post("id_video");
		$id_kategori = $this->input->post('id_kategori');
		$type = $this->input->post('type');
		$name = '';
		if($type=='video'){
			$name ='video_file';
		}else{
			$name ='video_image';
		}
		if(strlen($_FILES[$name]['name'])>0){
			if(empty($id))$id=0;
			if(!empty($id)){
				$this->db->select('*');
				$this->db->from('video');
				$this->db->where('id_video',$id);
				$row = $this->db->get()->row();
				$file_path = PATH_BASE.'arsip/assets/media/file/galeri_video/'.$type.'/';
				$old_file = $file_path.$row->video_file;
				if(is_file($old_file))unlink($old_file);
			}
			$result = $this->uploadFile($_FILES[$name],$id,$id_kategori,$type);
			if($result['status']=='error'){
				echo "error#".$result['error']."#".$result['id_video']."#";
				// echo $_FILES['video_file']['name']."Gagal karena, ".$result['error'].$_FILES['video_file']['name'];
			}else{
				echo "success#none#".$result['id_video']."#";
			}
		}else{
			echo "error#Tidak ada file#0#";
		}

	}
	function uploadFile($file=false,$id=false,$id_kategori=false,$type=false){
		$this->load->helper('file');
		$path2 = PATH_BASE.'arsip/assets/media/file/galeri_video/'.$type.'/';
		MakeDir($path2);
		$upload = '';
		$name = '';
		$config['upload_path'] = PATH_BASE.'arsip/assets/media/file/galeri_video/'.$type;
		if($type=='video'){
			$config['allowed_types'] = 'flv|mp4';
			$upload ='do_upload_non_mime_types';
			$name ='video_file';
		}else{
			$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
			$upload ='do_upload';
			$name ='video_image';
		}
		$config['max_size']	= '102400	';
		$config['remove_spaces']=true;
        $config['overwrite']    =true;
		$this->load->library('upload', $config);
		if ( ! $this->upload->$upload($name))
		{
			$data= array('status' => 'error', 'error' => $this->upload->display_errors());
			return $data;
		}	
		else
		{
			if(!empty($id)):
				$this->db->set(@$name, $this->upload->file_name);
				$this->db->where("id_video", $id);
				$this->db->update("video");
			else:
				$this->db->set(@$name, $this->upload->file_name);
				$this->db->set("id_kategori", $id_kategori);
				$this->db->insert("video");
				$id = $this->db->insert_id();
			endif;
			$data = array('status'=>'success','error' =>'', 'id_video' => $id);
			return $data;
		}
	}

}
?>