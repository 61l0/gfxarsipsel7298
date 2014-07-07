<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Compengolahan extends Grid{
	
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/pengolahan/';
		$params->lib['class_name'] = 'compengolahan';
		$params->lib['header_caption'] = 'Pengolahan';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'pengolahan_model','alias'=>'com_model'));
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$tahun = 0;
		$typecari = $this->CI->input->post('typecari');
		
		$cari_judul = $this->CI->input->post('judul');
		if($typecari != 'id_unit_pengolah'){
			if($cari_judul != ""){
				unset($params->model['query']['query_filter']);
				$params->model['query']['query_filter']=array(
					$cari_judul=>array(
						'type'=>'like'
						,'field'=>'a.'.$typecari
						,'name'=>'judul'// harus sesuai dengan yg di post
						,'extra'=>'after'
						//,'value'=>$cari_judul
						),
				);
			}
		}else{
			if($cari_judul != ""){
				unset($params->model['query']['query_filter']);
				$params->model['query']['query_filter']=array(
					$cari_judul=>array(
						'type'=>'like'
						,'field'=>'d.nama_lengkap'
						,'name'=>'judul'// harus sesuai dengan yg di post
						,'extra'=>'after'
						//,'value'=>$cari_judul
						),
				);
			}
		}		
		$filter = $this->CI->input->post('status');
		$date = "'".date('Y-m-d')."'";
		if($filter == 'retensi'){
		unset($params->model['query']['query_filter']);
				$params->model['query']['query_filter']=array(
				'inaktif_sampai'=>array(
					'type'=>'where'
					,'field'=>'c.inaktif_sampai < '.$date
					),
			);
		}else if($filter == 'aktif'){
		unset($params->model['query']['query_filter']);
				$params->model['query']['query_filter']=array(
				'inaktif_sampai'=>array(
					'type'=>'where'
					,'field'=>'c.inaktif_sampai >= '.$date
					),
			);
		}		
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		// ============================================================
		$this->com_name = $params->lib['class_name'];
		parent::__construct($params);
	}
	
	function griddata(){
		parent::griddata();
		//dump($this->CI->db->Last_query());
		$this->CI->com_model->set_params($this->params['model']);
		$params = new stdClass();
				
		$params->records = $this->CI->com_model->get_count_all($params);
	
		$total_record = $params->records;
		
		$data = array();
		$data = $this->CI->output->get_output(); 
		$hasil = json_decode($data); 
		
	
		$new_data = new stdClass();
		
		$new_data->page = $data['page'] = $this->CI->input->post('page');
		$new_data->rows = $data['rows'] = $this->CI->input->post('rows');
		
		$new_data->sord = $data['sord'] = $this->CI->input->post('sord');
		
		

	
	//	$total_record = $this->CI->g1_model->get_count_all($params);
		
		foreach($hasil->rows as $key=>$row){

			$data = @$this->CI->com_model->rak($row->id_lokasisimpan);
			$data_type = array();
			foreach($data as $row){	
				@$data_type[] = $row->name;
			}
			$hasil->rows[$key]->rak_rool = @$data_type[1];
			$hasil->rows[$key]->box = @$data_type[2];
			$hasil->rows[$key]->folder = @$data_type[3];
			if(!$data){
			$hasil->rows[$key]->status = 'Belum Pengolahan';
			}else{
			$hasil->rows[$key]->status = 'Pengolahan';
			}
			if($hasil->rows[$key]->inaktif_sampai < date('Y-m-d')) {
			$hasil->rows[$key]->keterangan = '<font color=red>Retensi</font>';
			}else{
			$hasil->rows[$key]->keterangan = '<font color=green>Aktif</font>';
			}
		}
		$new_data->rows = $hasil->rows;
		$new_data->total = ceil($total_record/count($hasil->rows));
		$new_data->records = $total_record;
		$this->CI->output->set_output(json_encode($new_data)); 
	}
	function index_segments($params=false){
		parent::index_segments($params);	

		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'default','data'=>$this->content ,'return'=>true));		
	}	
    function comjs_features(){
        parent::comjs_features();
        $gridcomplete_config = array('name'=>'comjs_gridcomplete','return'=>true);
        $this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$gridcomplete_config);
		$this->content['comjs_features']['extra'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'comjs_extra','return'=>true));
        unset($this->content['grid']['toolbar']['word']);
        unset($this->content['grid']['toolbar']['excel']);
        unset($this->content['grid']['toolbar']['pdf']);
		unset($this->content['grid']['toolbar']['search']);
		unset($this->content['grid']['toolbar']['plus']);
	}
	
	function tambah_data(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['tahun'] = $this->CI->com_model->tahun();
		 // $this->content['lokasi_penyimpanan'] = $this->CI->com_model->lokasi_penyimpanan();
		 $this->content['jenis_arsip'] = $this->CI->com_model->jenis_arsip();
		 $this->content['sifat_arsip'] = $this->CI->com_model->sifat_arsip();
		 $this->content['oper'] = 'add';
		 
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'tambah_data','data'=>$this->content));
	}
	
	function combobox(){
		$type = $this->CI->input->post('data_type');		
		$id_parent = $this->CI->input->post('parent_id');		
		 $data = $this->CI->com_model->data_combobox($type, $id_parent);
		 $respon = array();
		 if($data){
			$respon = $data;
		 }else{
			$respon['error'] = 'data kosong';
		 }
		 // echo $respon;
		 echo json_encode($respon);
	}
	function edit(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['tahun'] = $this->CI->com_model->tahun();
		 $this->content['lokasi_penyimpanan'] = $this->CI->com_model->lokasi_penyimpanan();
		 $this->content['jenis_arsip'] = $this->CI->com_model->jenis_arsip();
		 $this->content['sifat_arsip'] = $this->CI->com_model->sifat_arsip();
		 $this->content['data_edit'] = $this->CI->com_model->get_data();
		 $this->content['lokasi_simpan'] = @$this->CI->com_model->rak($this->CI->input->post('id_lokasi_simpan'));
		 // dump($this->content['lokasi_simpan'][0]->name);
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $this->content['id_data'] = $this->CI->input->post('id_row');
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'edit_data','data'=>$this->content));
	}
	
	function my_validation($rak=false,$box=false,$folder=false){
		if($rak == $box && $rak == $folder){
			$hasil = FALSE;
			return $hasil;
		}else{
			$hasil = TRUE;
		}
			return $hasil;
	}
	function formaction(){
		$oper = $this->CI->input->post('oper');
		$cekrool_or_rak = $this->CI->input->post('rdpilih');
		if($cekrool_or_rak == 'rak'){
		$rak = $this->CI->input->post('rak');
		$box = $this->CI->input->post('box');
		$folder = $this->CI->input->post('folder');
		}else{
		$rak = $this->CI->input->post('rool');
		$box = $this->CI->input->post('box_rool');
		$folder = $this->CI->input->post('folder_rool');
		}
		// echo $rak;
		if($oper != 'del'){
			$cek = $this->my_validation($rak,$box,$folder);
			$this->CI->form_validation->set_rules('judul','Judul','trim|required');
			$this->CI->form_validation->set_rules('no_arsip','No Arsip','trim|required');
			$this->CI->form_validation->set_rules('agenda','Agenda','trim|required');
			$this->CI->form_validation->set_rules('kode_komp','Kode Komponen','trim|required');
			$this->CI->form_validation->set_rules('tahun','Tahun','trim|required');
			$this->CI->form_validation->set_rules('tanggal','Tanggal','trim|required');
			$this->CI->form_validation->set_rules('id_skpd','Unit Pengolah','trim|required');
			if($this->CI->input->post('rdpilih')=='rak'){
				$this->CI->form_validation->set_rules('rak','Rak','trim|required|integer');
				$this->CI->form_validation->set_rules('box','Box','trim|required|integer');
				$this->CI->form_validation->set_rules('folder','Folder','trim|required|integer');
			}else{
				$this->CI->form_validation->set_rules('rool','Rool','trim|required|integer');
				$this->CI->form_validation->set_rules('box_rool','Box','trim|required|integer');
				$this->CI->form_validation->set_rules('folder_rool','Folder','trim|required|integer');		
			}
			$this->CI->form_validation->set_rules('id_retensi','Retensi','trim|required');
			if($this->CI->form_validation->run() == FALSE ){
			// dump(validation_errors());
				$hasil = array('result'=>'failed','message'=>validation_errors(),'oper'=>$oper);
			}else if($cek == FALSE){
				$hasil = array('result'=>'failed','message'=>'Rak Box dan Folder Harus Ada Satu yang berbeda','oper'=>$oper);
			}else{		
				$hasil = $this->CI->com_model->simpan();
			}
		}else{
				$hasil = $this->CI->com_model->simpan();
		}
		echo json_encode($hasil);
	}
	
	function view(){
		$id_lokasi_simpan = $this->CI->input->post('id_lokasi_simpan');
		$id_data = $this->CI->input->post('id_row');
		$hasil = $this->CI->com_model->view();
		$this->content['tree'] = @$this->CI->com_model->rak($id_lokasi_simpan);
		$this->content['image'] = @$this->CI->com_model->data_image($id_data);
		
		$this->content['lihat_data'] = @$hasil;
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'view_data','data'=>$this->content));
	}
	
	function priview(){
		$id_lokasi_simpan = $this->CI->input->post('id_lokasi_simpan');
		$hasil = $this->CI->com_model->view();
		// dump($hasil[0]->id_lokasisimpan);
		$this->content['tree'] = @$this->CI->com_model->rak($id_lokasi_simpan);
		$this->content['lihat_data'] = @$hasil;
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'priview_data','data'=>$this->content));
	}	
	
	function formgambar(){
		$id_data = $this->CI->input->post('id_data');
		$this->content['id_data'] = @$id_data;
		$this->content['data'] = $this->CI->com_model->data_image(@$id_data);
		
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'formimage','data'=>@$this->content));
	}	
	function saveupload(){
		$id = $this->CI->input->post("id_data");
		if(strlen($_FILES['img_file']['name'])>0){
				$dir_name = 'arsip_galery';
				$result = $this->uploadFile($_FILES['img_file'],$id, $dir_name);
				// dump($this->CI->db->last_query());
				$path = DOC_PATH_ROOT . 'assets/media/file/'.$dir_name.'/'.$id.'/_thumbs/';
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
		// $path = 'arsip/assets/media/file/'.$menu_name.'/'.$id.'/';
		$path2 = DOC_PATH_ROOT . 'assets/media/file/'.$menu_name.'/'.$id.'/_thumbs/';
		// MakeDir($path);
		MakeDir($path2);
		$config['upload_path'] = DOC_PATH_ROOT . 'assets/media/file/'.$menu_name.'/'.$id;
		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
		$config['max_size']	= '2048';
		$config['remove_spaces']=true;
        $config['overwrite']    =true;
		$this->CI->load->library('upload', $config);
		$this->CI->db->set("foto", $this->CI->upload->file_name);
		$this->CI->db->set("foto_thumbs", "thumbs_".$this->CI->upload->file_name);
		$this->CI->db->set("id_data", $id);
		$this->CI->db->insert("arsip_galery");
		$id_galery = $this->CI->db->insert_id();
		$_FILES['img_file']['name'] = $id_galery."_".$_FILES['img_file']['name'];
		if ( ! $this->CI->upload->do_upload('img_file'))
		{
			$this->CI->db->where('id_galery', $id_galery);
			$this->CI->db->delete("arsip_galery");
			$data= array('status' => 'error', 'error' => $this->CI->upload->display_errors());
			return $data;
		}	
		else
		{
			$this->CI->db->set("foto", $this->CI->upload->file_name);
			$this->CI->db->set("foto_thumbs", "thumbs_".$this->CI->upload->file_name);
			$this->CI->db->where('id_galery', $id_galery);
			$this->CI->db->update("arsip_galery");
			$data = array('status'=>'success','error' =>'', 'id' => $id_galery);
			return $data;
		}
	}
	function saveimagedata(){
		$id_data = $this->CI->input->post("id_data");
		$this->CI->db->select('*');
		$this->CI->db->from('arsip_galery');
		$this->CI->db->where('id_data', $id_data);
		$res = $this->CI->db->get()->result_array();
		foreach($res as $row):
			$this->CI->db->set("judul", $this->CI->input->post("judul_foto_".$row['id_galery']));
			$this->CI->db->set("keterangan", $this->CI->input->post("image_note_".$row['id_galery']));
			$this->CI->db->where('id_galery', $row['id_galery']);
			$this->CI->db->update("arsip_galery");
		endforeach;
		echo "sukses";
	}
	function formeditingimage(){
		$id = $this->CI->input->post('id_data');
		$this->CI->db->select('*');
			$this->CI->db->from('arsip_galery');
			$this->CI->db->where('id_data',$id);
			$this->CI->db->order_by('id_data','asc');
			$res = $this->CI->db->get()->result();
			$list_image_form = '';
			$list_image_form = '<tr><th colspan="2">Edit Data Gambar</th></tr>
								<tr><td colspan="2"><input type="submit" name="save_data" value="Simpan Perubahan" />&nbsp;
								<input type=button value=Keluar name=cancel onclick=$("#dialogArea1").dialog("close"); /></td></tr>';
								///<input type="button" #dialogarea1").dialog("close");"="" onclick="$(" name="cancel" value="Keluar">
			if(!empty($res)){
				foreach($res as $rowx){
					//diganti list gambar dan kotak text area sesuai field galery ky 
					
						$path = PATH_BASE.'arsip/assets/media/file/arsip_galery/'.$rowx->id_data.'/'.$rowx->foto;
						$image_thumb = '';
						if(is_file($path)):
							$path = BASE_URL.'assets/media/file/arsip_galery/'.$rowx->id_data.'/'.$rowx->foto;
							$image_thumb .= '<span id="image_'.$rowx->id_galery.'"><img src="'.$path.'" width="300">';
							$image_thumb .= '<br /><a onclick="Remove_Image('.$rowx->id_galery.');" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
						endif;
						
					
						
						$list_image_form .= '<tr><td width="25%" style="border-bottom:1px solid #C0D6ED">'.$image_thumb.'</td>
							<td valign="top" style="border-bottom:1px solid #C0D6ED">
								<input type="hidden" name="id_galery" value="'.$rowx->id_galery.'"  />
								Judul Foto <input type="text" name="judul_foto_'.$rowx->id_galery.'" id="judul_foto_'.$rowx->id_galery.'" size="30" value="'.$rowx->judul.'" /><br />
								Keterangan Gambar : <br />
								<textarea name="image_note_'.$rowx->id_galery.'" id="image_note_'.$rowx->id_galery.'" rows="3" cols="40">'.$rowx->keterangan.'</textarea>				
							</td></tr>';
				}
				$data['id_data'] = $id;
				$data['tr_list_image'] = $list_image_form;
				echo $list_image_form;
			}
	}
	
	function removeimage(){
		$id =$this->CI->input->post("id_galery");
		$this->CI->db->select('*');
		$this->CI->db->from('arsip_galery');
		$this->CI->db->where('id_galery', $id);
		$row = $this->CI->db->get()->row();
		
		$file = 'assets/media/file/arsip_galery/'.$row->id_data.'/'.$row->foto;
		$file_thumbs = 'assets/media/file/arsip_galery/'.$row->id_data.'/'.$row->foto_thumbs;
		if(is_file($file))unlink($file);
		if(is_file($file_thumbs))unlink($file_thumbs);
		$this->CI->db->where('id_galery', $id);
		$this->CI->db->delete('arsip_galery'); 
		echo "sukses";
	}	
	function autocomplete(){
		$param1 = $this->CI->input->get('q');
		$param2 = $this->CI->input->get('type_cari');
		
		$responce = $this->CI->com_model->autocomplete($param1,$param2);

		echo json_encode($responce);
	}	
	function autocomplete_judularsip(){
		$param1 = $this->CI->input->get('q');
		$param2 = $this->CI->input->get('type_cari');
		
		$responce = $this->CI->com_model->autocomplete_judularsip($param1,$param2);

		echo json_encode($responce);
	}	
	
	



    function cetak_pdf($id_daftar=false){
		$chk_image = @$this->CI->input->post('chk');
		$chk_val = '';
		//dump($chk_image);
		if($chk_image){
			foreach(@$chk_image as $i=>$rw){
				$chk_val .= @$rw['value'].',';
			
			}
		}
		
		$this->CI->load->library('mypdf');
		$this->CI->mypdf->SetCreator(PDF_CREATOR);
		$tglCetak = date("s:i:H d/m/Y",mktime(date('s'),date('i'),date('H'),date('d'),date('h'),date('Y')));
		// $this->CI->mypdf->SetHeaderData('', '', '', '');

		// set header and footer fonts
		$this->CI->mypdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->CI->mypdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->CI->mypdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->CI->mypdf->SetMargins(3, 3, 3);
		$this->CI->mypdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->CI->mypdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		//set auto page breaks
		$this->CI->mypdf->SetAutoPageBreak(TRUE, 10);

		//set image scale factor
		$this->CI->mypdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		// set font
		$this->CI->mypdf->SetFont('times', '', 9);

		// add a page
		$this->CI->mypdf->AddPage();

		// set color for background
		$this->CI->mypdf->SetFillColor(255, 255, 127);
		$id_data = $this->CI->input->post("id_data");
		$this->content['lihat_data'] = $this->CI->com_model->data_cetak();
		$id_lokasi_simpan = $this->CI->input->post('id_lokasi_simpan');
		$this->content['tree'] = @$this->CI->com_model->rak($id_lokasi_simpan);
		if($chk_image){
		$this->content['image'] = @$this->CI->com_model->data_image1($id_data,$chk_val);
		}
		// dump($this->content['lihat_data']);
		$html =	$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'pengolahan_pdf','data'=>$this->content,'return'=>true));
		$this->CI->mypdf->writeHTML($html, true, 0, true, 0);
		// ---------------------------------------------------------
		$this->CI->mypdf->Output('pengolahan_detail_pdf.pdf', 'I');
	}	
	
}	
?>
