<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_surat_masuk{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/lap_surat_masuk/';
		$params->lib['class_name'] = 'comlap_surat_masuk';
		
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'lap_surat_masuk_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	function index(){
		$this->content['header_caption'] = 'Laporan &raquo; Surat &raquo; Surat Masuk';
		$this->content['pengolah'] = $this->CI->com_model->unit_pengolah();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		// dump($this->content['depo']);
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_surat_masuk','view',array('name'=>'default','data'=>@$this->content ,'return'=>false));		
	}	

	function rptsuratmasuk()
	{	
		$pengolah = $_SESSION['id_skpd'];

		$data = array(
			'bulan' => $this->CI->input->post('bulan'),
			'tahun' => $this->CI->input->post('tahun'),
			'mode'  => 'admin'
		);

		if($data['bulan'] != 'ALL' && !empty($data['bulan'] ))
			$this->CI->db->where('MONTH(a.tanggal_surat)',$data['bulan']);
		if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
			$this->CI->db->where('YEAR(a.tanggal_surat)',$data['tahun']);
		$this->CI->db->_protect_identifiers=false;

		if($_SESSION['user_group'] != 2 && !empty($pengolah))
		{
			$data['instansi'] = $this->CI->db->where('id_skpd',$pengolah)->select('nama_lengkap as instansi')->get('m_skpd')->row()->instansi;
			$this->CI->db->where("d.id_skpd='$pengolah'");
			$data['mode'] = 'skpd';

		}

		$surat_masuk_list = $this->CI->db->select("a.perihal,a.no_surat,a.sistem_penyimpanan,a.lokasi_penyimpanan")
										 ->select("d.nama_lengkap as instansi")
										 ->select("b.kode as s_kode, c.kode as p_kode,b.name as s_masalah,c.name as p_masalah")
							  			 ->select("DATE_FORMAT(a.tanggal_surat,'%d-%m-%Y') as tanggal_surat")
							  			 ->select("YEAR(a.tanggal_surat) as tahun")
							  			 ->join('arsip_kode_masalah b','b.kode=a.kode','left')
							  			 ->join('arsip_kode_masalah c',"c.kode=SUBSTRING_INDEX(b.path, '*',1 )",'left')
							  			 ->join('m_skpd d','d.id_skpd=a.id_skpd','left')
							  			 ->from('arsip_lap_skpd a')
							  			 ->where('a.type_surat','masuk')
							  			 ->get()->result_object();
									     //;

		// print_r($surat_masuk_list);
		// print_r($_SESSION);
		// die();

		$data['no'] 			= 1;			
		$data['surat_masuk_list'] 	= $surat_masuk_list;
		$count 	= count($retensi_list );
		$html 	= $this->CI->load->com('comlap_surat_masuk','view',array('name'=>'excel_surat_masuk','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_surat_masuk'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAPORAN SURAT MASUK";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		$objReader->generateFile();
		$objReader->redirectDownload();
	}		
}