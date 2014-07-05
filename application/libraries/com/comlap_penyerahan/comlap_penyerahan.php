<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_penyerahan{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/comlap_penyerahan/';
		$params->lib['class_name'] = 'comlap_penyerahan';
		$params->lib['header_caption'] = '';
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'laporanbulanan_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	
	function excel_daftar_arsip()
	{
		$request = array(
			'title' => 'Laporan Penyerahan Daftar Arsip',
			///'lokasi' => $this->CI->input->post('lokasi'),
			'tahun' => $this->CI->input->post('tahun'),
			//'status' => $this->CI->input->post('status'),
			//'depo' => $this->CI->input->post('depo'),
			'id_kode_masalah' => $this->CI->input->post('id_kode_masalah'),
			'id_unit_pengolah' => $this->CI->input->post('id_unit_pengolah'),

		//	'depo_text' => $this->CI->input->post('depo_text'),
			'klasifikasi_text' => $this->CI->input->post('klasifikasi_text'),
			'klasifikasi_kode' => $this->CI->input->post('klasifikasi_kode'),
			'unit_pengolah_text' => $this->CI->input->post('unit_pengolah_text'),
		);
		//print_r($data);
		$date = "'". date('Y-m-d') ."'";
		$request['klasifikasi_l'] = $this->CI->com_model->klasifikasi_kode_list();
		$this->CI->db->_protect_identifiers=false;
		$this->CI->db->distinct()->select("t.type,a.tahun,a.judul,d.nama_lengkap as instansi,a.desc as keterangan,
							   a.sistem_penyimpanan,				 
							   a.id_lokasisimpan,
							   SUBSTRING_INDEX(c.path, '*',1 ) kode_masalah
							   ")
					  ->select("replace(substring(substring_index(l.path_name, '*', 2), length(substring_index(l.path_name, '*', 2 - 1)) + 1), '*', '') as rak")
					  ->select("replace(substring(substring_index(l.path_name, '*', 3), length(substring_index(l.path_name, '*', 3 - 1)) + 1), '*', '') as boks")
					  ->select("replace(substring(substring_index(l.path_name, '*', 4), length(substring_index(l.path_name, '*', 4 - 1)) + 1), '*', '') as sampul")	
			 		  ->from('arsip_data a')
					  //->join('arsip_data a','b.id_ba=a.id_ba','right')
					//  ->join('arsip_sifat_cat b','b.id_sifat=a.id_sifat','left')
			 		  //->join('arsip_kode_masalah k',"k.kode=SUBSTRING_INDEX(c.path, '*',1 )",'left')
					  ->join('arsip_kode_masalah c','c.id_kode_masalah=a.id_kode_masalah','left')
					  ->join('arsip_lokasi_simpan l','l.id_lokasi_simpan=a.id_lokasisimpan','left')
					  ->join('arsip_lokasi_simpan t',"t.id_lokasi_simpan=replace(substring(substring_index(l.path, '*', 2), length(substring_index(l.path, '*', 2 - 1)) + 1), '*', '')",'left')
					  ->join('m_skpd d','d.id_skpd=a.id_unit_pengolah','left')
					  //->where("(t.type = 'rak' OR t.type='rool' OR t.type='')")
					  ->where('a.id_ba !=','0');
		
		
		$data = $request;
		//$data['status'] = strtoupper(str_replace('_', ' ', $data['status'] ) );
		if($data['id_unit_pengolah'] != 'ALL' && !empty($data['id_unit_pengolah'] ))
			$this->CI->db->where('a.id_unit_pengolah',$data['id_unit_pengolah']);
		if($data['id_kode_masalah'] != 'ALL' && !empty($data['id_kode_masalah'] ))
			$this->CI->db->where("SUBSTRING_INDEX(c.path, '*',1 ) ='".$data['klasifikasi_kode']."'");
		
		if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
			$this->CI->db->where('YEAR(a.tanggal)',$data['tahun']);


		$ba_list = $this->CI->db->order_by('a.id_data desc')->get()->result();
		//echo $this->CI->db->last_query();
		

		$data['no'] 			= 1;			
		$data['ba_list'] 	= $ba_list;
		$count 	= count($retensi_list );
		$html 	= $this->CI->load->com('comlap_penyerahan','view',array('name'=>'excel_daftar_arsip','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_penyerahan'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP PENYERAHAN DAFTAR ARSIP";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		 $objReader->generateFile();
		 $objReader->redirectDownload();

	}
	function gui($mode='')
	{	
		if($mode=='rekap')
			$this->content['header_caption'] = 'Laporan Rekap Penyerahan';
		else
			$this->content['header_caption'] = 'Laporan Daftar Arsip';
		$this->content['mode'] = $mode;
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['unit_pengolah'] = $this->CI->com_model->unit_pengolah();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		$this->CI->load->com('comlap_penyerahan','view',array('name'=>'html_gui','data'=>@$this->content ,'return'=>false));	
	}		
	function excel_rekap()
	{

		$request = array(
			'title' => 'Laporan Retensi Identitas Arsip',
			'mode' => $this->CI->input->post('mode'),
			'tahun' => $this->CI->input->post('tahun'),
			'instansi_text' => $this->CI->input->post('pilihinstansi_text'),
			//'depo' => $this->CI->input->post('depo'),
			'id_kode_masalah' => $this->CI->input->post('id_kode_masalah'),
			'id_unit_pengolah' => $this->CI->input->post('id_unit_pengolah'),

		//	'depo_text' => $this->CI->input->post('depo_text'),
			'klasifikasi_text' => $this->CI->input->post('klasifikasi_text'),
			'klasifikasi_kode' => $this->CI->input->post('klasifikasi_kode'),
			'unit_pengolah_text' => $this->CI->input->post('unit_pengolah_text'),
		);
		//print_r($data);
		$date = "'". date('Y-m-d') ."'";
		$this->CI->db->_protect_identifiers=false;
		/*
	'select'=>array(''),
		    'from'=>array($config['model_main']['table_name'].' a'),
		    array('method'=>'join','params'=>array()),
			
			'order_by'=>array('a.id_ba desc'),
		*/
		$data = $request;
		$this->CI->db->distinct()->select('a.id_ba, a.kepada,b.nama_lengkap skpd, a.instansi,a.tanggal_ba as tanggal')
					 			 ->from('arsip_ba a')
					  			 ->join('m_skpd b','a.id_skpd=b.id_skpd','left');
		if($data['mode'] == 'text')
		{
			if($data['instansi_text'] != '' && !empty($data['instansi_text'] ))
				$this->CI->db->like("a.instansi",$data['instansi_text']);

			$data['unit_pengolah_text'] = $data['instansi_text'];
		}
		else if($data['mode'] == 'select')
		{
			if($data['id_unit_pengolah'] != 'ALL' && !empty($data['id_unit_pengolah'] )){
				$this->CI->db->or_like("a.instansi",$data['unit_pengolah_text']);
				// $this->CI->db->or_where("1=",'0');
				// $this->CI->db->or_where("b.id_skpd",$data['id_unit_pengolah'],'OR');
			}
		}
		
		//$data['status'] = strtoupper(str_replace('_', ' ', $data['status'] ) );
		// if($data['id_unit_pengolah'] != 'ALL' && !empty($data['id_unit_pengolah'] ))
		// 	$this->CI->db->where('a.id_unit_pengolah',$data['id_unit_pengolah']);
		// 
		// 	$this->CI->db->where("SUBSTRING_INDEX(c.path, '*',1 ) ='".$data['klasifikasi_kode']."'");
		
		

		$ba_list = $this->CI->db->order_by('a.id_ba desc')->get()->result();

		// $query = $this->CI->db->get_compiled_select();
		// echo $query;
		// echo $this->CI->db->last_query();

		foreach ($ba_list as &$ba) {
			$this->CI->db->where('a.id_ba',$ba->id_ba);
			/////
			if($data['id_kode_masalah'] != 'ALL' && !empty($data['id_kode_masalah'] )){
				$this->CI->db->where("SUBSTRING_INDEX(b.path, '*',1 ) ='".$data['klasifikasi_kode']."'");
				$ba->klasifikasi_kode = $data['klasifikasi_kode'];
				$ba->klasifikasi_text = str_replace($data['klasifikasi_kode'].' - ', '', $data['klasifikasi_text'] );
			}else{
				$ba->klasifikasi_kode = 'ALL';
				$ba->klasifikasi_text = 'ALL';
			}
			if($data['tahun'] != 'ALL' && !empty($data['tahun'] )){
				$this->CI->db->where('YEAR(a.tanggal)',$data['tahun']);
				$ba->tahun = $data['tahun'];
			}
			else
				$ba->tahun = 'ALL';
			//////
			$total_row = $this->CI->db->select('COUNT(a.id_data) as total')->from('arsip_data a')
									  ->join('arsip_kode_masalah b','b.id_kode_masalah=a.id_kode_masalah')
									  ->get()->row()->total;
			
			$ba->jumlah_arsip = $total_row;
			/////




			$this->CI->db->where('a.id_ba',$ba->id_ba);
			if($data['id_kode_masalah'] != 'ALL' && !empty($data['id_kode_masalah'] )){
				//$this->CI->db->where("id_kode_masalah",$data['id_kode_masalah']);
				$this->CI->db->where("SUBSTRING_INDEX(b.path, '*',1 ) ='".$data['klasifikasi_kode']."'");
			}
			if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
				$this->CI->db->where('YEAR(a.tanggal)',$data['tahun']);
			//////
			$ba->jumlah_box = $this->CI->db->distinct()->select('distinct(a.box)')
													   ->from('arsip_data a')
													   ->join('arsip_kode_masalah b','b.id_kode_masalah=a.id_kode_masalah')
													   ->get()->num_rows();
			
			$ba->tanggal = date('d-m-Y',strtotime($ba->tanggal));

			if( empty($ba->instansi))
				$ba->instansi = $ba->skpd;
			unset($ba->skpd);
		}
		// print_r($ba_list);
		// die();

		$data['no'] 			= 1;			
		$data['ba_list'] 	= $ba_list;
		$count 	= count($ba_list );
		$html 	= $this->CI->load->com('comlap_penyerahan','view',array('name'=>'excel_rekap','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_penyerahan'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP PENYERAHAN REKAP";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		$objReader->generateFile();
		$objReader->redirectDownload();
	}
	public function instansi_ac($value='')
	{
		$q = $this->CI->input->get('q');

		$rs = $this->CI->db->select('instansi as  hasil')
					 ->from('arsip_ba')
					 ->like('instansi',$q)
					 ->limit(10)
					 ->get()
					 ->result();
		echo json_encode($rs);
		die();
	}
}	
