<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(DOC_PATH_APP.'libraries/modul/grid/grid.php');
class comimage extends Grid {
	function __construct($config=array()){
		$this->CI = & get_instance();
		$params = new stdClass;
		$this->com_name = 'comimage';
        $params->lib['master_class_name'] = $config['master_class_name'];
		$params->lib['master_com_url'] = $config['master_com_url'];
		$params->lib['class_name'] = 'comimage';
		$params->lib['header_caption'] = 'Image';
		$params->lib['com_url'] = $config['master_com_url'].$params->lib['class_name'].'/';		
		$this->CI->load->com('compengolahan/subcom/comimage','model',array('name'=>'comimage_model','alias'=>'com_model'));

		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$id_data=$this->CI->input->post('id_data');
		$params->model['query']['query_table'][2]['method']='where';
		$params->model['query']['query_table'][2]['params'][0]='a.id_data';
		$params->model['query']['query_table'][2]['params'][1]=$id_data;
		
		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		// $params->gridlib['grid']['opt']['postData']['id_perusahaan'] = $this->content['id_perusahaan'] = $this->CI->input->post('id_perusahaan'); 

		// ===================dropdown jenis izin======================
		// $options_satuan = $this->CI->com_model->getdropdownsatuan();
		// $params->gridlib['arr_colModel']['id_satuan']['editoptions']['value'] = $options_satuan;  
		// ============================================================
		$this->content['master_class_name'] =  $params->lib['master_class_name'];
		parent::__construct($params);
	}
	
	function comjs_features($params=false){
	    parent::comjs_features($params);
			$id_data = $this->CI->input->post('id_data');  
			//==========mengirim data  ke default================
			$this->content['id_data'] = $id_data;		
	   
			$conf_view_features = array(
			    'name'=>'comjs_extra',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->content['master_class_name'].'/subcom/comimage','view',$conf_view_features);
			
		    $conf_view_features = array(
			    'name'=>'comjs_gridcomplete',
			    'data'=>$this->content,
			    'return'=>true
		    );
        	$this->content['comjs_features']['comjs_gridcomplete'] = $this->CI->load->com($this->content['master_class_name'].'/subcom/comimage','view',$conf_view_features);

			unset($this->content['grid']['toolbar']['search']);
			unset($this->content['grid']['toolbar']['excel']);
			unset($this->content['grid']['toolbar']['pdf']);
			unset($this->content['grid']['toolbar']['word']);
	}
	function formgambar(){
		$id_produk = $this->CI->input->post('id_produk');
		$this->content['id_produk'] = @$id_produk;
		$this->content['data'] = $this->CI->com_model->getdata(@$id_produk);
		
		$this->CI->load->com($this->lib['master_class_name'].'/subcom/'.$this->lib['class_name'],'view',array('name'=>'formimage','data'=>@$this->content));
	}
	
	function formaction(){
		$hasil=$this->CI->com_model->simpan_produk();
		echo json_encode($hasil);
	}
	
	function saveupload(){
		$id = $this->CI->input->post("id_produk");
		if(strlen($_FILES['img_file']['name'])>0){
				$dir_name = 'produk_perusahaan';
				$result = $this->uploadFile($_FILES['img_file'],$id, $dir_name);
				// dump($this->CI->db->last_query());
				$path = PATH_BASE.'modul_indagkop/assets/media/file/'.$dir_name.'/'.$id.'/_thumbs/';
				// MakeDir($path);
				$config['thumb_marker']='';
				$config['source_image'] = 'assets/media/file/'.$dir_name.'/'.$id.'/'.$this->CI->upload->file_name;
				$config['new_image'] = 'assets/media/file/'.$dir_name.'/'.$id.'/_thumbs/thumbs_'.$this->CI->upload->file_name;
				$cek = createImageThumbnail(250,150,$config);
				if(!empty($cek)):
					echo "error-<b>File Thumbnail gagal di buat</b> : <br />".$cek;
				else:
					if($result['status']=='error'){
						echo "error-<b>File gagal di upload</b> : <br />".$result['error'];
					}else{
						echo "success-".$result['id'];
					}
				endif;
				
		}else{
			echo "error-<b>Tidak ada file</b>";
		}
		
	}
	function uploadFile($file, $id, $menu_name){
		$this->CI->load->helper('file');
		// $path = 'modul_indagkop/assets/media/file/'.$menu_name.'/'.$id.'/';
		$path2 = PATH_BASE.'modul_indagkop/assets/media/file/'.$menu_name.'/'.$id.'/_thumbs/';
		// MakeDir($path);
		MakeDir($path2);
		$config['upload_path'] = PATH_BASE.'modul_indagkop/assets/media/file/'.$menu_name.'/'.$id;
		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
		$config['max_size']	= '2048';
		$config['remove_spaces']=true;
        $config['overwrite']    =true;
		$this->CI->load->library('upload', $config);
		$this->CI->db->set("foto", $this->CI->upload->file_name);
		$this->CI->db->set("foto_thumbs", "thumbs_".$this->CI->upload->file_name);
		$this->CI->db->set("id_produk", $id);
		$this->CI->db->insert("r_produk_gambar");
		$id_produk_gambar = $this->CI->db->insert_id();
		$_FILES['img_file']['name'] = $id_produk_gambar."_".$_FILES['img_file']['name'];
		if ( ! $this->CI->upload->do_upload('img_file'))
		{
			$this->CI->db->where('id_produk_gambar', $id_produk_gambar);
			$this->CI->db->delete("r_produk_gambar");
			$data= array('status' => 'error', 'error' => $this->CI->upload->display_errors());
			return $data;
		}	
		else
		{
			$this->CI->db->set("foto", $this->CI->upload->file_name);
			$this->CI->db->set("foto_thumbs", "thumbs_".$this->CI->upload->file_name);
			$this->CI->db->where('id_produk_gambar', $id_produk_gambar);
			$this->CI->db->update("r_produk_gambar");
			$data = array('status'=>'success','error' =>'', 'id' => $id_produk_gambar);
			return $data;
		}
	}
	function saveimagedata(){
		$id_produk = $this->CI->input->post("id_produk");
		$this->CI->db->select('*');
		$this->CI->db->from('r_produk_gambar');
		$this->CI->db->where('id_produk', $id_produk);
		$res = $this->CI->db->get()->result_array();
		foreach($res as $row):
			$this->CI->db->set("judul_foto", $this->CI->input->post("judul_foto_".$row['id_produk_gambar']));
			$this->CI->db->set("ket_foto", $this->CI->input->post("image_note_".$row['id_produk_gambar']));
			// $this->CI->db->set("urutan", $this->CI->input->post("urutan_".$row['id_produk_gambar']));
			// $this->CI->db->set("status", $this->CI->input->post("status_".$row['id_produk_gambar']));
			$this->CI->db->where('id_produk_gambar', $row['id_produk_gambar']);
			$this->CI->db->update("r_produk_gambar");
		endforeach;
		echo "sukses";
	}
	function formeditingimage(){
		$id = $this->CI->input->post('id_produk');
		$this->CI->db->select('*');
			$this->CI->db->from('r_produk_gambar');
			$this->CI->db->where('id_produk',$id);
			$this->CI->db->order_by('urutan','asc');
			$res = $this->CI->db->get()->result();
			$list_image_form = '';
			$list_image_form = '<tr><th colspan="2">Edit Data Gambar</th></tr>
								<tr><td colspan="2"><input type="submit" name="save_data" value="Simpan Perubahan" />&nbsp;
								<input type=button value=Keluar name=cancel onclick=$("#dialogArea1").dialog("close"); /></td></tr>';
								///<input type="button" #dialogarea1").dialog("close");"="" onclick="$(" name="cancel" value="Keluar">
			if(!empty($res)){
				foreach($res as $rowx){
					//diganti list gambar dan kotak text area sesuai field galery ky 
					
						$path = PATH_BASE.'modul_indagkop/assets/media/file/produk_perusahaan/'.$rowx->id_produk.'/'.$rowx->foto;
						$image_thumb = '';
						if(is_file($path)):
							$path = BASE_URL.'assets/media/file/produk_perusahaan/'.$rowx->id_produk.'/'.$rowx->foto;
							$image_thumb .= '<span id="image_'.$rowx->id_produk_gambar.'"><img src="'.$path.'" width="300">';
							$image_thumb .= '<br /><a onclick="Remove_Image('.$rowx->id_produk_gambar.');" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
						endif;
						
						if($rowx->status == 'on'){
							$slc_s = 'selected="selected"';
							$slc_h = '';
						}else{
							$slc_s = '';
							$slc_h = 'selected="selected"';
						}
						
						$list_image_form .= '<tr><td width="25%" style="border-bottom:1px solid #C0D6ED">'.$image_thumb.'</td>
							<td valign="top" style="border-bottom:1px solid #C0D6ED">
								<input type="hidden" name="id_produk_gambar" value="'.$rowx->id_produk_gambar.'"  />
								Judul Foto <input type="text" name="judul_foto_'.$rowx->id_produk_gambar.'" id="judul_foto_'.$rowx->id_produk_gambar.'" size="30" value="'.$rowx->judul_foto.'" /><br />
								Keterangan Gambar : <br />
								<textarea name="image_note_'.$rowx->id_produk_gambar.'" id="image_note_'.$rowx->id_produk_gambar.'" rows="3" cols="40">'.$rowx->ket_foto.'</textarea><br />								
								Urutan <input type="text" name="urutan_'.$rowx->id_produk_gambar.'" id="urutan_'.$rowx->id_produk_gambar.'" size="5" value="'.$rowx->urutan.'" /><br />
								Status <select name="status_'.$rowx->id_produk_gambar.'">
								<option value="on" '.$slc_s.'>On</option>
								<option value="off" '.$slc_h.'>Off</option>
								</select>							
							</td></tr>';
				}
				$data['id_produk'] = $id;
				$data['tr_list_image'] = $list_image_form;
				echo $list_image_form;
				// $this->CI->load->view(GF_COM_VIEWPATH.'galerifoto/form_img_list',$data);
				// $this->CI->load->com($this->lib['master_class_name'].'/subcom/'.$this->lib['class_name'],'view',array('name'=>'formimage','data'=>@$data));
			}
	}
	
	function removeimage(){
		$id =$this->CI->input->post("id_produk_gambar");
		$this->CI->db->select('*');
		$this->CI->db->from('r_produk_gambar');
		$this->CI->db->where('id_produk_gambar', $id);
		$row = $this->CI->db->get()->row();
		
		$file = 'assets/media/file/produk_perusahaan/'.$row->id_produk.'/'.$row->foto;
		$file_thumbs = 'assets/media/file/produk_perusahaan/'.$row->id_produk.'/'.$row->foto_thumbs;
		if(is_file($file))unlink($file);
		if(is_file($file_thumbs))unlink($file_thumbs);
		$this->CI->db->where('id_produk_gambar', $id);
		$this->CI->db->delete('r_produk_gambar'); 
		echo "sukses";
	}

}
?>