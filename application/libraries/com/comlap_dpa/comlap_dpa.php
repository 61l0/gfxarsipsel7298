<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_dpa{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/lap_dpa/';
		$params->lib['class_name'] = 'comlap_dpa';
		$params->lib['header_caption'] = '';
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'laporanbulanan_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}
	function bulanan()
	{
		$this->content['header_caption'] = 'Laporan Daftar Pencarian Arsip Bulanan';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		$this->content['unit_pengolah'] = $this->CI->com_model->unit_pengolah();
	
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_dpa','view',array('name'=>'html_bulanan','data'=>@$this->content ,'return'=>false));
	}
	
	function excel_bulanan()
	{
		$request = array(
			'title' => 'Laporan Daftar Pencarian Arsip',
			'bulan' => $this->CI->input->post('bulan'),
			'tahun' => $this->CI->input->post('tahun'),
			//'status' => $this->CI->input->post('status'),
			'depo' => $this->CI->input->post('depo'),
			'id_kode_masalah' => $this->CI->input->post('id_kode_masalah'),
			'id_unit_pengolah' => $this->CI->input->post('id_unit_pengolah'),

			'depo_text' => $this->CI->input->post('depo_text'),
			'klasifikasi_text' => $this->CI->input->post('klasifikasi_text'),
			'klasifikasi_kode' => $this->CI->input->post('klasifikasi_kode'),
			'unit_pengolah_text' => $this->CI->input->post('unit_pengolah_text'),
		);
		//print_r($data);
		$date = "'". date('Y-m-d') ."'";
		$data = $request;
		$data['klasifikasi_l'] = $this->CI->com_model->klasifikasi_kode_list();
		$this->CI->db->_protect_identifiers=false;
		$this->CI->db->distinct()->select("t.type,a.tahun,a.judul,d.nama_lengkap as instansi,a.desc as keterangan,
							   a.sistem_penyimpanan,				 
							   a.id_lokasisimpan,
							   SUBSTRING_INDEX(c.path, '*',1 ) kode_masalah,
							   ")
					  ->select("replace(substring(substring_index(l.path_name, '*', 2), length(substring_index(l.path_name, '*', 2 - 1)) + 1), '*', '') as rak")
					  ->select("replace(substring(substring_index(l.path_name, '*', 3), length(substring_index(l.path_name, '*', 3 - 1)) + 1), '*', '') as boks")
					  ->select("replace(substring(substring_index(l.path_name, '*', 4), length(substring_index(l.path_name, '*', 4 - 1)) + 1), '*', '') as sampul")	
			 		  ->from('arsip_data a')
					  //->join('arsip_data a','b.id_ba=a.id_ba','right')
					//  ->join('arsip_sifat_cat b','b.id_sifat=a.id_sifat','left')
			 		 // ->join('arsip_kode_masalah k',"k.kode=SUBSTRING_INDEX(c.path, '*',1 )",'left')
					  ->join('arsip_kode_masalah c','c.id_kode_masalah=a.id_kode_masalah','left')
					  ->join('arsip_lokasi_simpan l','l.id_lokasi_simpan=a.id_lokasisimpan','left')
					  ->join('arsip_lokasi_simpan t',"t.id_lokasi_simpan=replace(substring(substring_index(l.path, '*', 2), length(substring_index(l.path, '*', 2 - 1)) + 1), '*', '')",'left')
					  ->join('m_skpd d','d.id_skpd=a.id_unit_pengolah','left')
					  //->where("(t.type = 'rak' OR t.type='rool' OR t.type='')")
					  ;//->limit(12);	
		
		
		
		//$data['status'] = strtoupper(str_replace('_', ' ', $data['status'] ) );
		if($data['id_unit_pengolah'] != 'ALL' && !empty($data['id_unit_pengolah'] ))
			$this->CI->db->where('a.id_unit_pengolah',$data['id_unit_pengolah']);
		if($data['id_kode_masalah'] != 'ALL' && !empty($data['id_kode_masalah'] ))
			$this->CI->db->where("SUBSTRING_INDEX(c.path, '*',1 ) ='".$data['klasifikasi_kode']."'");
		
		if($data['depo'] != 'ALL' && !empty($data['depo'] ))
		{
			//$this->db->select('b.name as depo');
			//$this->CI->db->join('arsip_lokasi_simpan b','a.id_lokasisimpan=b.id_lokasi_simpan','left');
			$this->CI->db->where("SUBSTRING_INDEX(l.path_name, '*',1 ) ='".$data['depo']."'");
		}

		if($data['bulan'] != 'ALL' && !empty($data['bulan'] ))
			$this->CI->db->where('MONTH(a.tanggal)',$data['bulan']);
		if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
			$this->CI->db->where('a.tahun',$data['tahun']);


		$dpa_list = $this->CI->db->order_by('a.id_data desc')->get()->result();
		//echo $this->CI->db->last_query();
		

		$data['no'] 			= 1;			
		$data['dpa_list'] 	= $dpa_list;
		$html 	= $this->CI->load->com('comlap_dpa','view',array('name'=>'excel_bulanan','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_dpa'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP DAFTAR PENCARIAN ARSIP";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		$objReader->generateFile();
		$objReader->redirectDownload();

	}
	function identitas()
	{	
		$this->content['header_caption'] = 'Laporan Rekapitulasi Arsip / Identitas Arsip';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['unit_pengolah'] = $this->CI->com_model->unit_pengolah();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
	


		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_dpa','view',array('name'=>'html_identitas','data'=>@$this->content ,'return'=>false));	
	}		
	function excel_identitas()
	{
		$request = array(
			'title' => 'Laporan Daftar Pencarian Arsip',
			'bulan' => $this->CI->input->post('bulan'),
			'tahun' => $this->CI->input->post('tahun'),
			//'status' => $this->CI->input->post('status'),
			'depo' => $this->CI->input->post('depo'),
			'id_kode_masalah' => $this->CI->input->post('id_kode_masalah'),
			'id_unit_pengolah' => $this->CI->input->post('id_unit_pengolah'),

			'depo_text' => $this->CI->input->post('depo_text'),
			'klasifikasi_text' => $this->CI->input->post('klasifikasi_text'),
			'klasifikasi_kode' => $this->CI->input->post('klasifikasi_kode'),
			'unit_pengolah_text' => $this->CI->input->post('unit_pengolah_text'),
		);
		//print_r($data);
		$date = "'". date('Y-m-d') ."'";
		$data = $request;
		$data['klasifikasi_l'] = $this->CI->com_model->klasifikasi_kode_list();
		$this->CI->db->_protect_identifiers=false;
		$this->CI->db->distinct()->select("t.type,a.tahun,a.judul,d.nama_lengkap as instansi,a.desc as keterangan,
							   a.sistem_penyimpanan,				 
							   a.id_lokasisimpan,
							   SUBSTRING_INDEX(c.path, '*',1 ) kode_masalah,
							   ")
					  ->select("replace(substring(substring_index(l.path_name, '*', 2), length(substring_index(l.path_name, '*', 2 - 1)) + 1), '*', '') as rak")
					  ->select("replace(substring(substring_index(l.path_name, '*', 3), length(substring_index(l.path_name, '*', 3 - 1)) + 1), '*', '') as boks")
					  ->select("replace(substring(substring_index(l.path_name, '*', 4), length(substring_index(l.path_name, '*', 4 - 1)) + 1), '*', '') as sampul")	
			 		  ->from('arsip_data a')
					  //->join('arsip_data a','b.id_ba=a.id_ba','right')
					//  ->join('arsip_sifat_cat b','b.id_sifat=a.id_sifat','left')
			 		 // ->join('arsip_kode_masalah k',"k.kode=SUBSTRING_INDEX(c.path, '*',1 )",'left')
					  ->join('arsip_kode_masalah c','c.id_kode_masalah=a.id_kode_masalah','left')
					  ->join('arsip_lokasi_simpan l','l.id_lokasi_simpan=a.id_lokasisimpan','left')
					  ->join('arsip_lokasi_simpan t',"t.id_lokasi_simpan=replace(substring(substring_index(l.path, '*', 2), length(substring_index(l.path, '*', 2 - 1)) + 1), '*', '')",'left')
					  ->join('m_skpd d','d.id_skpd=a.id_unit_pengolah','left')
					  //->where("(t.type = 'rak' OR t.type='rool' OR t.type='')")
					  ;//->limit(12);	
		
		
		
		//$data['status'] = strtoupper(str_replace('_', ' ', $data['status'] ) );
		if($data['id_unit_pengolah'] != 'ALL' && !empty($data['id_unit_pengolah'] ))
			$this->CI->db->where('a.id_unit_pengolah',$data['id_unit_pengolah']);
		if($data['id_kode_masalah'] != 'ALL' && !empty($data['id_kode_masalah'] ))
			$this->CI->db->where("SUBSTRING_INDEX(c.path, '*',1 ) ='".$data['klasifikasi_kode']."'");
		
		if($data['depo'] != 'ALL' && !empty($data['depo'] ))
		{
			//$this->db->select('b.name as depo');
			//$this->CI->db->join('arsip_lokasi_simpan b','a.id_lokasisimpan=b.id_lokasi_simpan','left');
			$this->CI->db->where("SUBSTRING_INDEX(l.path_name, '*',1 ) ='".$data['depo']."'");
		}

		if($data['bulan'] != 'ALL' && !empty($data['bulan'] ))
			$this->CI->db->where('MONTH(a.tanggal)',$data['bulan']);
		if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
			$this->CI->db->where('a.tahun',$data['tahun']);
		if($data['lokasi'] != '' && !empty($data['lokasi'] ))
			$this->CI->db->like('a.lokasi',$data['lokasi']);

		$dpa_list = $this->CI->db->order_by('a.id_data desc')->get()->result();
		//echo $this->CI->db->last_query();
		

		$data['no'] 			= 1;			
		$data['dpa_list'] 	= $dpa_list;
		$html 	= $this->CI->load->com('comlap_dpa','view',array('name'=>'excel_identitas','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_dpa'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP DPA IDENTITAS ARSIP";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		$objReader->generateFile();
		$objReader->redirectDownload();
	}
}	
