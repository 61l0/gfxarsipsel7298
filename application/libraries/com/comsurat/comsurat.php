<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comsurat extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/surat/';
		$params->lib['class_name'] = 'comsurat';
		$params->lib['header_caption'] = 'Surat &raquo; Surat Masuk dan surat Keluar';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model_surat'));
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$typecari = $this->CI->input->post('typecari');
		$cari_judul = $this->CI->input->post('judul');
		//$this->CI->load->helper('form');
		if($_SESSION['user_group'] == 6){
			unset($params->model['query']['query_filter']);
			$params->model['query']['query_filter']=array(
				'id_pengirim'=>array(
					'type'=>'where'
					,'field'=>'a.id_skpd'
					,'name'=>'id_skpd'
					,'value'=>$_SESSION['id_skpd']
					),
			);
			
		}
		if($typecari == 'no_surat'){
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
						,'field'=>'a.'.$typecari
						,'name'=>'judul'// harus sesuai dengan yg di post
						,'extra'=>'after'
						//,'value'=>$cari_judul
						),
				);
			}			
		}			
		// ============================================================
		//dropdown jenis skpd
		$this->com_name = $params->lib['class_name'];
		parent::__construct($params);
	}
	function griddata(){
		parent::griddata();
		//echo $this->CI->db->last_query();
		$data = array();
		$data = $this->CI->output->get_output(); 
		$hasil = json_decode($data); 
		
		$new_data = new stdClass();
		$new_data->page = $data['page'] = $this->CI->input->post('page');
		$new_data->rows = $data['rows'] = $this->CI->input->post('rows');
		$new_data->sord = $data['sord'] = $this->CI->input->post('sord');
		$total_record = $this->CI->model_surat->get_count_all();
		
		foreach($hasil->rows as $key=>$row){

			$hasil->rows[$key]->seri = (@$row->sistem_penyimpanan=='Seri'?'V':'');
			$hasil->rows[$key]->rubrik = (@$row->sistem_penyimpanan=='Rubrik'?'V':'');
			$hasil->rows[$key]->dosir = (@$row->sistem_penyimpanan=='Dosir'?'V':'');

			$hasil->rows[$key]->cabinet = (@$row->lokasi_penyimpanan=='Cabinet'?'V':'');
			$hasil->rows[$key]->rak = (@$row->lokasi_penyimpanan=='Rak'?'V':'');
			$hasil->rows[$key]->boks = (@$row->lokasi_penyimpanan=='Boks'?'V':'');

			$hasil->rows[$key]->tanggal_surat = date('d-m-Y',strtotime($hasil->rows[$key]->tanggal_surat));
			$hasil->rows[$key]->tanggal_diteruskan = date('d-m-Y',strtotime($hasil->rows[$key]->tanggal_diteruskan));
			
		}
		$new_data->rows = $hasil->rows;
		$new_data->total = ceil($total_record/10);
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
	
	function set_typesurat()
	{
		$avail_type_surat = array('masuk','keluar'); 
		$type_surat = $this->CI->input->post('type_surat');
		if(!in_array($type_surat, $avail_type_surat))
			$type_surat = 'masuk';
		$this->CI->session->set_userdata('cgd_typesurat',$type_surat);
	}
	function update_disposisi()
	{
		$id_disposisi = $this->CI->input->post('id_disposisi');
		//$disposisi = 

		$disposisi = array(
			'tanggal_penyelesaian' => tgl_srt_to_mysql($this->CI->input->post('tanggal_penyelesaian')),
			'tanggal_kembali' => tgl_srt_to_mysql($this->CI->input->post('tanggal_kembali')),
			'kepada' => $this->CI->input->post('kepada'),
			'diteruskan_kepada' => $this->CI->input->post('diteruskan_kepada'),
			'instruksi' => $this->CI->input->post('instruksi')
		);
		$this->CI->db->where('id_disposisi',$id_disposisi)->update('arsip_lap_skpd_disposisi',$disposisi);
		$this->responce['rows'] = array('result'=>'succes','message'=>'Data  Berhasil Diedit','oper'=>'edit');
		echo  json_encode($this->responce);	
	}
	function disposisi()
	{
		$id_lap_skpd = $this->CI->input->post('id_lap_skpd');
		$disposisi = $this->CI->db->where('id_lap_skpd',$id_lap_skpd)->get('arsip_lap_skpd_disposisi')->row();
		$disposisi->tanggal_penyelesaian = date('d-m-Y',strtotime($disposisi->tanggal_penyelesaian));
		$disposisi->tanggal_kembali = date('d-m-Y',strtotime($disposisi->tanggal_kembali));
		$data = array(
			'r' => $this->CI->model_surat->get_data($id_lap_skpd,1),
			'd' => $disposisi,
			'class_name' => $this->lib['class_name']
		);
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'frm_disposisi' ,'data'=>$data));
	}
	function tambah_data(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = 'add';	
		 $this->content['type_surat'] = $this->CI->input->post('type_surat');
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'frm_surat' ,'data'=>$this->content));
	}	
	function formaction(){
		$oper = $this->CI->input->post('oper');
		if($oper != 'del'){	
			$this->CI->form_validation->set_rules('indeks','Indeks','trim|required');
			$this->CI->form_validation->set_rules('tanggal_surat','Tanggal Surat','trim|required');
			$this->CI->form_validation->set_rules('no_surat','No Surat','trim|required');
			$this->CI->form_validation->set_rules('sistem_penyimpanan','Sistem Penyimpanan','trim|required');
			$this->CI->form_validation->set_rules('lokasi_penyimpanan','Lokasi Penyimpanan','trim|required');
			
			if($this->CI->form_validation->run() == FALSE){
				$hasil = array('result'=>'failed','message'=>validation_errors(),'oper'=>$oper);
			}else{
				$hasil = $this->CI->model_surat->simpan();
			}
		}else{
				$hasil = $this->CI->model_surat->simpan();
		}	
		echo json_encode($hasil);
	}	
	function edit(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $this->content['id_lap_skpd'] = $this->CI->input->post('id_lap_skpd');
		 $this->content['r'] = $this->CI->model_surat->get_data($this->content['id_lap_skpd'],1);
		 $this->content['type_surat']= $this->content['r']->type_surat;
		// print_r($this->content['r']);
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'frm_surat','data'=>$this->content));
	}	
	function view(){
		$id_lap_skpd = $this->CI->input->post('id_lap_skpd');
		$hasil = $this->CI->model_surat->view($id_lap_skpd);
		$lap = $hasil[0];
		if($lap->type_surat=='masuk')
			$this->content['d'] = $this->CI->db->where('id_lap_skpd',$id_lap_skpd)->get('arsip_lap_skpd_disposisi')->row();

		$this->content['lap'] = $lap;
		unset($hasil);
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'view_data','data'=>$this->content));
	}	

	function autocomplete(){
		$param1 = $this->CI->input->get('q');
		$param2 = $this->CI->input->get('type_cari');
		
		$responce = $this->CI->model_surat->autocomplete($param1,$param2);

		echo json_encode($responce);
	}

	function cetak($what,$id)
	{
		$filename 	= 0;
		$data 		= 0;
		//$view 		= 0;

		if($what == 'disposisi')
		{
			$filename = "kartu_penerus_disposisi_${id}";
			$data = $this->CI->db->where('id_disposisi',$id)
								  ->select('a.*,b.*,c.nama_lengkap as skpd')	
								  ->from('arsip_lap_skpd_disposisi a')
								  ->join('arsip_lap_skpd b','a.id_lap_skpd = b.id_lap_skpd','left')
								  ->join('m_skpd c','b.id_skpd = c.id_skpd','left')
								  ->get()->row();
			//$view = $what;
		}
		else if ($what == 'surat')
		{
			$data = $this->CI->db->select('a.*,b.nama_lengkap as skpd')
								 ->where('id_lap_skpd',$id)
								 ->from('arsip_lap_skpd a')
								 ->join('m_skpd b','a.id_skpd = b.id_skpd')
								 ->get()
								 ->row();

			$filename = "surat_".$data->type_surat."_${id}";
			//$view = "surat_$data->type_surat";
		}

		
		
		$view_data = array(
			'data' => $data 
		);
		$html =	$this->CI->load->com($this->lib['class_name'],'view',array('name'=>"${what}_pdf",'data'=>$view_data,'return'=>true));
		// echo "$html";
		// die();
		$this->CI->load->helper(array('dompdf', 'file'));
		$dompdf = load_dompdf();
		$dompdf->load_html($html);
	    $dompdf->set_paper($what=='disposisi'?'a5':'a5', $what=='disposisi'?'portrait':'landscape'); 
	    $dompdf->render();
	    $dompdf->stream("${filename}.pdf", array("Attachment" => true));
		//pdf_create($html, 'filename',TRUE);
	}	

	function attachment($oper="ls",$param="")
	{
		//die($oper);
		$parent_id = $this->CI->input->post('parent_id');
		$attachment_for = $this->CI->input->post('attachment_for');
		$view_data = array(
			'parent_id' => $parent_id,
			'attachment_for' => $attachment_for
		);
		if($oper=="ls")
		{
			$attachment_list = $this->CI->db->where(array('parent_id'=>$parent_id,'attachment_for'=>$attachment_for))
										  ->get('arsip_attachment')
										  ->result_object();
			$view_data['attachment_list'] = $attachment_list;
										  
			$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'attachment','data'=>$view_data));
			unset($attachment_list);
		}
		else if($oper == 'upload')
		{
			$this->CI->load->library('fileupload');
			
			$upload_path = FCPATH . 'assets/media/file/attachments/';

			// echo realpath($upload_path);
			// die();
			
			$result = $this->CI->fileupload->handleUpload( $upload_path);

			// $response = array(
			// 	'fullpath'	=> '',
			// 	'success'	=> TRUE
			// );
			if($result['success'])
			{
				$attachment = array(
					'parent_id' => $this->CI->input->get('parent_id'),
					'attachment_for' => $this->CI->input->get('attachment_for'),
					'filename' => $this->CI->input->get('qqfile'),
					'path' =>  $result['filename'],
					'date_uploaded' => date('Y-m-d',time())
				);
				

				$this->CI->db->insert('arsip_attachment',$attachment);
				$attachment['id_attachment'] = $this->CI->db->insert_id();
			}
			$result = array_merge($result,$attachment);
			echo json_encode($result);
		}
		else if($oper=='thumb')
		{
			$this->CI->load->library('image_lib');
			$config['image_library'] = 'gd2';
			$upload_path = FCPATH . 'assets/media/file/attachments/';

			$config['source_image'] = $upload_path . $param;
			$config['new_image']     = FCPATH.'assets/media/file/attachments/'.md5($param).'_thumb.jpg';
       	 	$config['maintain_ratio']   = TRUE;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 240;
			$config['height'] = 320;
			//$config['dynamic_output']=TRUE;
			$this->CI->image_lib->initialize($config);
			$this->CI->image_lib->resize();
			$this->CI->image_lib->clear;
			header('Content-Type: image/jpg');
        	readfile($config['new_image']);
		}
		else if($oper=="delete")
		{
			$where = array( 'id_attachment'=>$this->CI->input->get('id_attachment'),
											 'attachment_for'=>$this->CI->input->get('attachment_for')) ;
			//$rs =;

			$row =  $this->CI->db->where($where)->get('arsip_attachment')->row();

			if($row)
			{
				if(file_exists(FCPATH.$row->path))
					@unlink(FCPATH.$row->path);
				$thumb = explode('/',$row->path);
				$thumb = implode('__SEP__', $thumb);
				$thumb = FCPATH .'assets/media/file/attachments/'. md5($thumb).'.jpg';
				


				//die($thumb);
				if(file_exists($thumb))
					@unlink($thumb);
			}
			
			//die();
			$this->CI->db->where($where)->delete('arsip_attachment');

			$response = array(
				'success' => TRUE,
				'id_attachment' => $where['id_attachment']
			);
			echo json_encode($response);			  
		}
		else if($oper=='pdf')
		{
			$gambar = '';

			$attachmentIds = explode('_', $param);
			//$where = array();

			foreach($attachmentIds as $id)
			{
				$this->CI->db->or_where('id_attachment',$id);
			}

			$attachment_list = $this->CI->db->get('arsip_attachment')->result_object();

			foreach ($attachment_list as $attachment) {
				$upload_path = FCPATH . 'assets/media/file/attachments/';

				$img_src = $upload_path . $attachment->path;
				$gambar .= '<div style="margin:0 auto;width:18cm;height:25cm;text-align:center"><img src="'.$img_src.'" style="width:100%"/></div><br/>';
			}
			$html="<html>
			<head>
				<title>Attachment</title>
			</head>
			<body>
				$gambar
			</body>
			</html>";
			$filename = 'attachment_gambar';
			$this->CI->load->helper(array('dompdf', 'file'));
			$dompdf = load_dompdf();
			$dompdf->load_html($html);
		    $dompdf->set_paper('a4','portrait'); 
		    $dompdf->render();
		    $dompdf->stream("${filename}.pdf", array("Attachment" => true));
		}
	}			
}