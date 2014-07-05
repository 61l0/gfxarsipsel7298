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
			$report = $this->db->insert('galeri_kategori');
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
			$this->db->where('id_kategori',$this->input->post('id_kategori'));
			$report = $this->db->update('galeri_kategori');
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
			$this->db->where('id_kategori',$this->input->post('id_kategori'));
			$report = $this->db->delete('galeri_kategori');
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
		$this->db->set("nama_kategori",$this->input->post('nama_kategori'));
		$this->db->set("status",$this->input->post('status'));
		$this->db->set("urutan",$this->input->post('urutan'));
		$this->db->set("tgl_buat",$this->input->post('tgl_buat'));
		$this->db->set("tampil_utama","Y");
		// $this->db->set("nama_kategori",$this->input->post('nama_kategori'));
		// $this->db->set("foto_publish",$this->input->post('foto_publish'));
		// $this->db->set("foto_urutan",$this->input->post('foto_urutan'));
		// $this->db->set("user_id",$this->session->userdata('user_id'));
		// $this->db->set("tgl_buat",$this->input->post('tgl_buat'));
		// $this->db->set("tampil_utama","Y");
	}
//========================================================= untuk upload gambar ==========================================
	function getdata($id_kategori=false){
		$this->db->where('id_kategori',@$id_kategori);
		$this->db->order_by('foto_urutan','asc');
		$data = $this->db->get('galeri')->result();
		return @$data;
	}
	
	function removeimage($id=false){
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->where('id_galeri', $id);
		$row = $this->db->get()->row();
		// dump($row);
		$file = 'assets/media/file/galeri_foto/'.$row->id_kategori.'/'.$row->foto;
		$file_thumbs = 'assets/media/file/galeri_foto/'.$row->id_kategori.'/_thumbs/'.$row->foto_thumbs;
		if(is_file($file))unlink($file);
		if(is_file($file_thumbs))unlink($file_thumbs);
		$this->db->where('id_galeri', $id);
		$this->db->delete('galeri'); 
			
	}
	
	function saveimagedata($id_kategori=false){
		$date = now();
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->where('id_kategori', $id_kategori);
		$res = $this->db->get()->result_array();
		foreach($res as $row):
			$this->db->set("judul_foto", $this->input->post("judul_foto_".$row['id_galeri']));
			$this->db->set("ket_foto", $this->input->post("image_note_".$row['id_galeri']));
			$this->db->set("foto_urutan", $this->input->post("urutan_".$row['id_galeri']));
			$this->db->set("foto_publish", $this->input->post("status_".$row['id_galeri']));
			$this->db->set("fotografer", $this->input->post("fotografer_".$row['id_galeri']));
			$this->db->set("foto_from", $this->input->post("from_".$row['id_galeri']));
			$this->db->set("tgl_buat", $date);
			$this->db->where('id_galeri', $row['id_galeri']);
			$this->db->update("galeri");
		endforeach;
		echo "sukses";	
	}
	
	function saveupload($id=false){
		if(strlen($_FILES['img_file']['name'])>0){
			$dir_name = 'galeri_foto';
			$result = $this->uploadFile($_FILES['img_file'],$id, $dir_name);
			$path = PATH_BASE.'arsip/assets/media/file/'.$dir_name.'/'.$id.'/_thumbs/';
			$config['thumb_marker']='';
			$config['source_image'] = 'assets/media/file/'.$dir_name.'/'.$id.'/'.$this->upload->file_name;
			$config['new_image'] = 'assets/media/file/'.$dir_name.'/'.$id.'/_thumbs/thumbs_'.$this->upload->file_name;
			$cek = createImageThumbnail(250,150,$config);
			if(!empty($cek)):
				echo "error-<b>File Thumbnail gagal di buat</b> : <br />".$cek;
			else:
				if($result['foto_publish']=='error'){
					echo "error-<b>File gagal di upload</b> : <br />".$result['error'];
				}else{
					echo "success-".$result['id'];
				}
			endif;	
		}else{
			echo "error-<b>Tidak ada file</b>";
		}
	}
	
	function uploadFile($file=false,$id=false,$menu_name=false){
		$this->load->helper('file');
		$path2 = PATH_BASE.'arsip/assets/media/file/'.$menu_name.'/'.$id.'/_thumbs/';
		MakeDir($path2);
		$config['upload_path'] = PATH_BASE.'arsip/assets/media/file/'.$menu_name.'/'.$id;
		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
		$config['max_size']	= '2048';
		$config['remove_spaces']=true;
        $config['overwrite']    =true;
		$this->load->library('upload', $config);
		$this->db->set("foto", $this->upload->file_name);
		$this->db->set("foto_thumbs", "thumbs_".$this->upload->file_name);
		$this->db->set("id_kategori", $id);
		$this->db->insert("galeri");
		$id_galeri = $this->db->insert_id();
		$_FILES['img_file']['name'] = $id_galeri."_".$_FILES['img_file']['name'];
		if ( ! $this->upload->do_upload('img_file'))
		{
			$this->db->where('id_galeri', $id_galeri);
			$this->db->delete("galeri");
			$data= array('foto_publish' => 'error', 'error' => $this->upload->display_errors());
			return $data;
		}	
		else
		{
			$this->db->set("foto", $this->upload->file_name);
			$this->db->set("foto_thumbs", "thumbs_".$this->upload->file_name);
			$this->db->where('id_galeri', $id_galeri);
			$this->db->update("galeri");
			$data = array('foto_publish'=>'success','error' =>'', 'id' => $id_galeri);
			return $data;
		}
	}

}
?>