<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_surat_rekap{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/lap_surat_rekap/';
		$params->lib['class_name'] = 'comlap_surat_rekap';
		
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'lap_surat_rekap_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	function index(){
		$this->content['header_caption'] = 'Laporan &raquo; Surat &raquo; Surat Rekap';
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		$this->content['unit_pengolah'] = $this->CI->com_model->unit_pengolah();
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_surat_rekap','view',array('name'=>'default','data'=>@$this->content ,'return'=>false));		
	}	

	function rptsuratrekap()
	{	
		if($_SESSION['user_group'] != 2)
			$pengolah = $_SESSION['id_skpd'];
		else
			$pengolah = $this->CI->input->post('pengolah');
		$data = array(
			'bulan' => $this->CI->input->post('bulan'),
			'tahun' => $this->CI->input->post('tahun'),
			'mode'  => 'admin',
			'tahunan' => FALSE
		);

		if($data['bulan'] != 'ALL' && !empty($data['bulan'] ))
			$this->CI->db->where('MONTH(a.tanggal_surat)',$data['bulan']);
		if($data['tahun'] != 'ALL' && !empty($data['tahun'] )){
			$data['tahunan'] = TRUE;
			$this->CI->db->where('YEAR(a.tanggal_surat)',$data['tahun']);
		}
		$this->CI->db->_protect_identifiers=false;

		if( !empty($pengolah))
		{
			$data['instansi'] = $this->CI->db->where('id_skpd',$pengolah)->select('nama_lengkap as instansi')->get('m_skpd')->row()->instansi;
			$this->CI->db->where("d.id_skpd",$pengolah);
			$data['mode'] = 'skpd';

		}

		$surat_rekap_list_tmp = $this->CI->db->select("DISTINCT SUBSTRING_INDEX(b.path,'*',1 ) AS p_code")
										 ->select("a.type_surat")
										 ->select("Count(a.id_lap_skpd) AS jml")
							  			 ->select("a.sistem_penyimpanan")
							  			 ->select("a.lokasi_penyimpanan")
							  			 ->select("YEAR(a.tanggal_surat) as tahun")
							  			 ->join('arsip_kode_masalah b','b.kode=a.kode','left')
							  			 //->join('arsip_kode_masalah c',"c.kode=SUBSTRING_INDEX(b.path, '*',1 )",'right')
							  			 ->join('m_skpd d','d.id_skpd=a.id_skpd','left')
							  			 ->from('arsip_lap_skpd a')
							  			 //->where('a.type_surat','masuk')
							  			 ->group_by('a.type_surat, a.sistem_penyimpanan,a.lokasi_penyimpanan,p_code')
							  			 ->order_by('b.kode','asc')
							  			 ->get()->result_object();
									     //;
		$surat_rekap_list = array();
		$arsip_kode_masalah = $this->CI->db->select('kode as p_code')
										   ->where('level','1')
										   ->get('arsip_kode_masalah')
										   ->result_object();
		foreach ($arsip_kode_masalah as $r)
		{
			if($r->p_code == '')
				continue;
			$surat_rekap_list[$r->p_code] = array(
					'jml_surat_masuk'  => 0,
					'jml_surat_keluar' => 0,
					'is_rubrik' => 0,
					'is_seri' => 0,
					'is_dosir' => 0,
					'is_cabinet' => 0,
					'is_rak' => 0,
					'is_boks' => 0,
					'tahun' => "ALL"

				);
				if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
					$surat_rekap_list[$r->p_code]['tahun'] = $data['tahun'];
				
		}
							   					  			 
		foreach($surat_rekap_list_tmp as $r)
		{
			if($r->p_code == '')
				continue;
			
			if($r->type_surat == 'masuk')
				$surat_rekap_list[$r->p_code]['jml_surat_masuk'] += $r->jml;
			if($r->type_surat == 'keluar')
				$surat_rekap_list[$r->p_code]['jml_surat_keluar'] += $r->jml;

			if($r->sistem_penyimpanan == 'Seri')
				$surat_rekap_list[$r->p_code]['is_seri'] += $r->jml;
			if($r->sistem_penyimpanan == 'Rubrik')
				$surat_rekap_list[$r->p_code]['is_rubrik'] += $r->jml;
			if($r->sistem_penyimpanan == 'Dosir')
				$surat_rekap_list[$r->p_code]['is_dosir'] += $r->jml;

			if($r->lokasi_penyimpanan == 'Cabinet')
				$surat_rekap_list[$r->p_code]['is_cabinet'] += $r->jml;
			if($r->lokasi_penyimpanan == 'Rak')
				$surat_rekap_list[$r->p_code]['is_rak'] += $r->jml;
			if($r->lokasi_penyimpanan == 'Boks')
				$surat_rekap_list[$r->p_code]['is_boks'] += $r->jml;
		}
		
		unset($surat_rekap_list_tmp);

		// print_r( $surat_rekap_list );
		// die();

		$data['no'] 			= 1;			
		$data['surat_rekap_list'] 	= $surat_rekap_list;
		$count 	= count($retensi_list );
		$html 	= $this->CI->load->com('comlap_surat_rekap','view',array('name'=>'excel_surat_rekap','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('LAPORAN REKAP SURAT'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		unset($html);
		$title = "LAPORAN REKAP SURAT";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		$objReader->generateFile();
		$objReader->redirectDownload();	
		
	}		
}