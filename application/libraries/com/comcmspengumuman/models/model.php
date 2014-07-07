<?phpclass Model extends CI_Model {    function __construct (){        parent::__construct();		$this->table_name = 'pengumuman';	}	function simpan() {		$oper = $this->input->post('oper');		switch ($oper):		// ====================== penamabhan data ==============================		case 'add':		    			$this->doset();			$this->db->set("id_menu",68);			if($this->db->insert($this->table_name)):					$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');				$data = $this->db->get($this->table_name)->row();			    $this->responce['rows'] = @$data?$data:array();			else:				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil ditambahkan','oper'=>'add');			endif;						break;		// ====================== pengeditan data ==============================		case 'edit':			$this->doset();			$this->db->where('id_pengumuman',$this->input->post('id_pengumuman'));			if($this->db->update($this->table_name)):				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');				$data = $this->db->get($this->table_name)->row();			    $this->responce['rows'] = @$data?$data:array();			else:				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil diubah','oper'=>'edit');			endif;			break;		// ====================== penghapusan data ==============================		case 'del':			$this->removefile($this->input->post('id_pengumuman'));			$this->db->where('id_pengumuman',$this->input->post('id_pengumuman'));			if($this->db->delete($this->table_name)):				$this->responce = array('result'=>'succes','message'=>'Data berhasil dihapus','oper'=>'del');				$this->responce['rows'] = array();			else:				$this->responce = array('result'=>'failed','message'=>'Data tidak berhasil dihapus','oper'=>'del');			endif;			break;		// ====================== tidak ada oper ==============================		default:			$this->responce = array('result'=>'failed','message'=>'Cannot identify oper type','oper'=>$oper);		endswitch;		return $this->responce;	}	function doset(){		$tanggal = $this->input->post('tanggal');		$urutan = $this->input->post('urutan');		$this->db->set("judul",$this->input->post('judul'));		$this->db->set("tanggal",$tanggal);		$this->db->set("tahun",$this->input->post('tahun'));		if(empty($urutan) AND strlen($urutan)==0):			$urutan = $this->_setDefaultUrutan($tanggal);		else:			$urutan = $this->input->post('urutan');		endif;		$this->db->set("urutan",$urutan);		$this->db->set("status",$this->input->post('status'));	}	function _setDefaultUrutan($tanggal){		if(empty($tanggal))$tanggal = date('Y-m-d');		$this->db->select_max('urutan');		$this->db->from('pengumuman');		$this->db->where('tanggal', $tanggal);		$row = $this->db->get()->row();		if($row->urutan > 0){			$urutan = $row->urutan + 10;		}else{			$urutan = 10;		}		return $urutan;	}	function getdata($id=false){		$data = $this->db->where('id_pengumuman',@$id)->get('pengumuman')->row();		return @$data;	}	function saveupload(){		$id = $this->input->post("id_pengumuman");		if(strlen($_FILES['pengumuman_file']['name'])>0){			if(empty($id))$id=0;			if(!empty($id)){				$this->db->select('*');				$this->db->from('pengumuman');				$this->db->where('id_pengumuman',$id);				$row = $this->db->get()->row();				$file_path = DOC_PATH_ROOT . 'assets/media/file/pengumuman/';				$old_file = $file_path.$row->file;				if(is_file($old_file))unlink($old_file);			}			$result = $this->uploadFile($_FILES['pengumuman_file'],$id);			if($result['status']=='error'){				echo "error#".$result['error']."#".$result['id_pengumuman']."#";			}else{				echo "success#none#".$result['id_pengumuman']."#";			}		}else{			echo "error#Tidak ada file#0#";		}			}	function uploadFile($file=false,$id=false){		$this->load->helper('file');		$path2 = DOC_PATH_ROOT . 'assets/media/file/pengumuman/';		MakeDir($path2);		$config['upload_path'] = DOC_PATH_ROOT . 'assets/media/file/pengumuman';		$config['allowed_types'] = 'pdf|zip|rar|doc|docx|xls|xlsx';		$config['max_size']	= '2048';		$config['remove_spaces']=true;        $config['overwrite']    =true;		$this->load->library('upload', $config);		if ( ! $this->upload->do_upload('pengumuman_file'))		{			$data= array('status' => 'error', 'error' => $this->upload->display_errors());			return $data;		}			else		{			if($id > 0 ):				$this->db->set("id_menu",68);				$this->db->set("file",$this->upload->file_name);				$this->db->where("id_pengumuman",@$id);				$this->db->update("pengumuman");			else:				$this->db->set("id_menu",68);				$this->db->set("file",$this->upload->file_name);				$this->db->set("status",$this->input->post('status'));				$this->db->insert("pengumuman");				$act = 'edit';				$id = $this->db->insert_id();				$this->session->set_userdata('act','edit');				$this->session->set_userdata('id_pengumuman',$id);							endif;			$data = array('status'=>'success','error' =>'', 'id_pengumuman' => $id);			return $data;		}	}	function removefile($id=false){		$this->db->select('*');		$this->db->from('pengumuman');		$this->db->where('id_pengumuman',$id);		$row = $this->db->get()->row();		$file_path = 'assets/media/file/pengumuman/';		$file = $file_path.$row->file;		if(is_file($file))unlink($file);		$this->db->set("file",'');		$this->db->where("id_pengumuman",$id);		$this->db->update("pengumuman");		}	function urutan($oper=false,$id_pengumuman=false,$urutan=false,$tanggal=false){		$urutan_new = '';		if($oper=="turun"){			$urutan_new = $urutan + 10;		}else{			$urutan_new = $urutan - 10;		}		// data self		$this->db->where('urutan',$urutan);		$this->db->where('tanggal',$tanggal);		$id_self = $this->db->get($this->table_name)->row()->id_pengumuman;		// data will replaced		$this->db->where('urutan',$urutan_new);		$this->db->where('tanggal',$tanggal);		$id_replace = $this->db->get($this->table_name)->row()->id_pengumuman;				$this->db->set('urutan',$urutan_new);		$this->db->where('id_pengumuman',$id_self);		$up1 = $this->db->update($this->table_name);		$this->db->set('urutan',$urutan);		$this->db->where('id_pengumuman',$id_replace);		$up2 = $this->db->update($this->table_name);	}}?>