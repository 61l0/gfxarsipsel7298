<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Compeminjaman extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/peminjaman/';
		$params->lib['class_name'] = 'compeminjaman';
		$params->lib['header_caption'] = 'Peminjaman';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'peminjaman_model','alias'=>'com_model'));
		
		$status = $this->CI->input->post('status');
		//$cari_judul = $this->CI->input->post('judul');
		
		$typecari = $this->CI->input->post('typecari');
		
		$cari_judul = $this->CI->input->post('judul');
		if($status == 'pinjam'){
			unset($params->model['query']['query_filter']);
			$params->model['query']['query_filter']=array(
				'status'=>array(
					'type'=>'where'
					,'field'=>'a.status'
					,'name'=>'status'
					,'value'=>'pinjam'
					),
			);
		}elseif($status == 'kembali'){
			unset($params->model['query']['query_filter']);
			$params->model['query']['query_filter']=array(
				'status'=>array(
					'type'=>'where'
					,'field'=>'a.status'
					,'name'=>'status'
					,'value'=>'kembali'
					),
			);		
		}else{
			unset($params->model['query']['query_filter']);
			if($cari_judul != "" && $typecari=='judul'){
				unset($params->model['query']['query_filter']);
				$params->model['query']['query_filter']=array(
					$cari_judul=>array(
						'type'=>'like'
						,'field'=>'b.'.$typecari
						,'name'=>'judul'// harus sesuai dengan yg di post
						,'extra'=>'after'
						//,'value'=>$cari_judul
						),
				);
			}elseif($cari_judul != "" && $typecari=='nama'){
				unset($params->model['query']['query_filter']);
				$params->model['query']['query_filter']=array(
					$cari_judul=>array(
						'type'=>'like'
						,'field'=>'a.nama_peminjam'
						,'name'=>'judul'// harus sesuai dengan yg di post
						,'extra'=>'after'
						//,'value'=>$cari_judul
						),
				);				
				}	
				
			
		}		
	
		// ============================================================
		$this->com_name = $params->lib['class_name'];
		parent::__construct($params);
	}
	// function griddata(){
	// 	parent::griddata();
		
	// 	// dump($this->CI->db->last_query());
	// }
	
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
		 $this->content['oper'] = 'add';	
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'tambah_data','data'=>$this->content));
	}
	
	function edit(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $this->content['id_peminjaman'] = $this->CI->input->post('id_peminjaman');
		 $this->content['data_edit'] = $this->CI->com_model->get_data();
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'edit_data','data'=>$this->content));
	}
	
	function formaction(){
		$oper = $this->CI->input->post('oper');
		if($oper != 'del'){	
			$this->CI->form_validation->set_rules('status','Status','trim|required');
			$this->CI->form_validation->set_rules('kode_arsip','Judul','trim|required');
			
			if($this->CI->form_validation->run() == FALSE){
				$hasil = array('result'=>'failed','message'=>validation_errors(),'oper'=>$oper);
			}else{			
				$hasil = $this->CI->com_model->simpan();
			}
		}else{
				$hasil = $this->CI->com_model->simpan();
		}		
		echo json_encode($hasil);
	}	

	function view(){
		$hasil = $this->CI->com_model->view();
		if( !empty($hasil[0]->id_skpd) )
		{
			$hasil[0]->id_skpd=$this->CI->db->select('nama_lengkap')
						 ->where('id_skpd',$hasil[0]->id_skpd)
						 ->get('m_skpd')
						 ->row()->nama_lengkap;
			 //= 'HAI';
		}
		$this->content['data'] = $hasil;
		

		//dump($this->content['data']);
		$this->content['image'] = @$this->CI->com_model->data_image($hasil[0]->id_data);
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'view_data','data'=>$this->content));
	}	

	function autocomplete_(){
		$param = $this->CI->input->post('q');
		$responce = $this->CI->com_model->autocomplete($param);

		echo json_encode($responce);
	}

	function autocomplete(){
		$param1 = $this->CI->input->get('q');
		$param2 = $this->CI->input->get('type_cari');
		
		$responce = $this->CI->com_model->autocomplete($param1,$param2);

		echo json_encode($responce);
	}
	function autocomplete_daftar_arsip()
	{
		$term  = $this->CI->input->get('q');
		$limit = $this->CI->input->get('limit');
		$sql   = "SELECT CONCAT(id_data, ':=:', `judul`, ':=:', `no_arsip`, ':=:', `tahun`, ':=:', `lokasi`) as hasil FROM (`arsip_data`) WHERE `judul` LIKE '%$term%' OR `no_arsip` LIKE '%$term%' OR `tahun` LIKE '%$term%' OR `lokasi` LIKE '%$term%' LIMIT 10";	

		// $rs = $this->CI->db->select("CONCAT(id_data,'::',judul,'::',no_arsip,'::',tahun,'::',lokasi) as hasil" )
		// 			 ->from('arsip_data')
		// 			 ->or_like('judul',$term)
		// 			 ->or_like('no_arsip',$term)
		// 			 ->or_like('tahun',$term)
		// 			 ->or_like('lokasi',$term)
		// 			 ->limit(10,0)
		// 			 ->get()->result_object();
		$rs = $this->CI->db->query($sql)->result_object();
		//echo $this->CI->db->last_query();			 
		echo json_encode($rs);			 
	}
    function cetak_pdf($id_daftar=false){

	$chk_image = $this->CI->input->post('chk');

	
	if($chk_image){
		$chk_val = '';
		//dump($chk_image);
		foreach(@$chk_image as $i=>$rw){
			$chk_val .= $rw['value'].',';
		
		}	
	}

	$get_ck = $this->CI->input->get('chk');
	if($get_ck)
	{
		$chk_val = str_replace('_', ',', $get_ck );
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
		if(!$id_data)
			$id_data = $this->CI->input->get('id_data');
		$this->content['lihat_data'] = $this->CI->com_model->data_cetak($id_data);
		$id_lokasi_simpan = $this->CI->input->post('id_lokasi_simpan');
		if(!$id_lokasi_simpan)
			$id_lokasi_simpan = $this->CI->input->get('id_lokasi_simpan');
		$this->content['tree'] = @$this->CI->com_model->rak($id_lokasi_simpan);
		$this->content['image'] = @$this->CI->com_model->data_image1($id_data,$chk_val);

		$idp = $this->CI->input->get('idp');

		$this->content['p'] = $this->CI->com_model->view($idp);
		//print_r($this->content['p'] );
		// dump($this->content['lihat_data']);
		$html =	$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'peminjaman_pdf','data'=>$this->content,'return'=>true));
		$this->CI->mypdf->writeHTML($html, true, 0, true, 0);
		// ---------------------------------------------------------
		$this->CI->mypdf->Output('peminjaman_detail_pdf.pdf', 'I');
	}

	function viewgambar(){
		$id_data = $this->CI->input->post('id_data');
		$this->CI->load->com('compengolahan','model',array('name'=>'pengolahan_model','alias'=> 'pengolahan_model'));

		$this->content['id_data'] = @$id_data;


		
		//$arsip_peminjaman = $this->CI->com_model->view($id_data);
		$this->content['data']	  = $this->CI->pengolahan_model->data_image($id_data);
		//echo $id_data;
		//print_r($arsip_peminjaman);
		//print_r($arsip_image);
		//$this->content['data']
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'viewimage','data'=>$this->content));
	}
}	
