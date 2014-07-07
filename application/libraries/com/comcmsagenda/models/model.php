<?phpclass Model extends CI_Model {    function __construct (){        parent::__construct();		$this->table_name = 'agenda';	}	function simpan() {		$oper = $this->input->post('oper');		switch ($oper):		// ====================== penamabhan data ==============================		case 'add':		    			$this->db->set("judul_agenda",$this->input->post('judul_agenda'));			$this->db->set("tanggal_mulai",$this->input->post('tanggal_mulai'));			$this->db->set("tanggal_selesai",$this->input->post('tanggal_selesai'));			$this->db->set("lokasi",$this->input->post('lokasi'));			$this->db->set("penyelenggara",$this->input->post('penyelenggara'));			$this->db->set("keterangan",$this->input->post('keterangan'));			$this->db->set("status",$this->input->post('status'));			if($this->db->insert($this->table_name)):					$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');				$data = $this->db->get($this->table_name)->row();			    $this->responce['rows'] = @$data?$data:array();			else:				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil ditambahkan','oper'=>'add');			endif;						break;		// ====================== pengeditan data ==============================		case 'edit':			$this->db->set("judul_agenda",$this->input->post('judul_agenda'));			$this->db->set("tanggal_mulai",$this->input->post('tanggal_mulai'));			$this->db->set("tanggal_selesai",$this->input->post('tanggal_selesai'));			$this->db->set("lokasi",$this->input->post('lokasi'));			$this->db->set("penyelenggara",$this->input->post('penyelenggara'));			$this->db->set("keterangan",$this->input->post('keterangan'));			$this->db->set("status",$this->input->post('status'));			$this->db->where('id_agenda',$this->input->post('id_agenda'));			if($this->db->update($this->table_name)):				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');				$data = $this->db->get($this->table_name)->row();			    $this->responce['rows'] = @$data?$data:array();			else:				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil diubah','oper'=>'edit');			endif;			break;		// ====================== penghapusan data ==============================		case 'del':		    // $this->query_action('delete',$params);			$this->db->where('id_agenda',$this->input->post('id_agenda'));			if($this->db->delete($this->table_name)):				$this->responce = array('result'=>'succes','message'=>'Data berhasil dihapus','oper'=>'del');				$this->responce['rows'] = array();			else:				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil dihapus','oper'=>'del');			endif;			break;		// ====================== tidak ada oper ==============================		default:			$this->responce = array('result'=>'failed','message'=>'Cannot identify oper type','oper'=>$oper);		endswitch;		return $this->responce;	}	function getdata($id=false){		$data = $this->db->where('id_agenda',@$id)->get('agenda')->row();		return @$data;	}	function saveupload(){		$id = $this->input->post("id_agenda");		if(strlen($_FILES['agenda_file']['name'])>0){			if(empty($id))$id=0;			if(!empty($id)){				$this->db->select('*');				$this->db->from('agenda');				$this->db->where('id_agenda',$id);				$row = $this->db->get()->row();				$file_path = DOC_PATH_ROOT . 'assets/media/file/agenda/';				$old_file = $file_path.$row->file_image;				if(is_file($old_file))unlink($old_file);			}			$result = $this->uploadFile($_FILES['agenda_file'],$id);			$path = DOC_PATH_ROOT . 'assets/media/file/agenda/_thumbs/';			$config['thumb_marker']='';			$config['source_image'] = 'assets/media/file/agenda/'.$this->upload->file_name;			$config['new_image'] = 'assets/media/file/agenda/_thumbs/thumbs_'.$this->upload->file_name;			createImageThumbnail(250,150,$config);			if($result['status']=='error'){				echo "error#".$result['error']."#".$result['id_agenda']."#";			}else{				echo "success#none#".$result['id_agenda']."#";			}		}else{			echo "error#Tidak ada file#0#";		}							}	function uploadFile($file=false,$id=false){		$this->load->helper('file');		$path2 = DOC_PATH_ROOT . 'assets/media/file/agenda/_thumbs/';		MakeDir($path2);		$config['upload_path'] = DOC_PATH_ROOT . 'assets/media/file/agenda';		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';		$config['max_size']	= '2048';		$config['remove_spaces']=true;        $config['overwrite']    =true;		$this->load->library('upload', $config);		if ( ! $this->upload->do_upload('agenda_file'))		{			$data= array('status' => 'error', 'error' => $this->upload->display_errors());			return $data;		}			else		{			if(!empty($id)):				$this->db->set("file_image", $this->upload->file_name);				$this->db->where("id_agenda", $id);				$this->db->update("agenda");			else:				$this->db->set("file_image", $this->upload->file_name);				$this->db->insert("agenda");				$id = $this->db->insert_id();			endif;			$data = array('status'=>'success','error' =>'', 'id_agenda' => $id);			return $data;		}	}	function removeimage($id=false){		$this->db->select('*');		$this->db->from('agenda');		$this->db->where('id_agenda', $id);		$row = $this->db->get()->row();		$file_path = 'assets/media/file/agenda/';		$filethumb = $file_path.'_thumbs/thumbs_'.$row->file_image;		$file = $file_path.$row->file_image;		if(is_file($filethumb))unlink($filethumb);		if(is_file($file))unlink($file);		$this->db->set("file_image",'');		$this->db->where("id_agenda",$id);		$this->db->update("agenda");		}}?>