<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_pelayanan_bulanan{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/lap_pelayanan_bulanan/';
		$params->lib['class_name'] = 'comlap_pelayanan_bulanan';
		
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'lap_pelayanan_bulanan_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	function index(){
		$this->content['header_caption'] = 'Laporan &raquo; Data pelayanan Arsip &raquo; Laporan Bulanan';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		// dump($this->content['depo']);
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_pelayanan_bulanan','view',array('name'=>'default','data'=>@$this->content ,'return'=>false));		
	}	

	function rptbulanan()
	{	
		//$pengolah = $_SESSION['id_skpd'];

		$data = array(
			'bulan' => $this->CI->input->post('bulan'),
			'tahun' => $this->CI->input->post('tahun'),
			//'mode'  => 'admin'
		);

		if($data['bulan'] != 'ALL' && !empty($data['bulan'] ))
			$this->CI->db->where('MONTH(a.tanggal_pinjam)',$data['bulan']);
		if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
			$this->CI->db->where('YEAR(a.tanggal_pinjam)',$data['tahun']);
		$this->CI->db->_protect_identifiers=false;

		// if($_SESSION['user_group'] != 2 && !empty($pengolah))
		// {
		// 	$data['instansi'] = $this->CI->db->where('id_skpd',$pengolah)->select('nama_lengkap as instansi')->get('m_skpd')->row()->instansi;
		// 	$this->CI->db->where("d.id_skpd='$pengolah'");
		// 	$data['mode'] = 'skpd';

		// }

		$pelayanan_list = $this->CI->db->select("a.*,b.judul,b.no_arsip,b.tahun,b.agenda,b.kode_komponen")
										 // ->select("d.nama_lengkap as instansi")
										 // ->select("b.kode as s_kode, c.kode as p_kode,b.name as s_masalah,c.name as p_masalah")
							  		// 	 ->select("DATE_FORMAT(a.tanggal_surat,'%d-%m-%Y') as tanggal_surat")
							  		// 	 ->select("YEAR(a.tanggal_surat) as tahun")
							  		 	 ->join('arsip_data b','b.id_data=a.id_data','left')
							  		// 	 ->join('arsip_kode_masalah c',"c.kode=SUBSTRING_INDEX(b.path, '*',1 )",'left')
							  		// 	 ->join('m_skpd d','d.id_skpd=a.id_skpd','left')
							  		 	 ->from('arsip_peminjaman a')
							  		// 	 ->where('a.type_surat','masuk')
							  			 ->get()->result_object();
									     //;

		// print_r($surat_masuk_list);
		// print_r($_SESSION);
		// die();
		
		foreach($pelayanan_list as &$r)
		{
			$no_arsip  = $r->no_arsip;
			$agenda    = $r->agenda;
			$kode_komp = $r->kode_komponen;
			$tahun 	   = $r->tahun;

			//print_r($grid_data->rows[$key]);
			//exit;
			
			// $r->is_copy = $r->type_arsip == 'copy' ? 'V' : '-'; 
			// $r->is_asli = $r->type_arsip == 'asli' ? 'V' : '-';
			$r->status_ada = $r->status_hasil == 'ada' ? 'V' : '-'; 
			$r->status_tidak_ada = $r->status_hasil != 'ada' ? 'V' : '-';
			$r->nama_alamat_status = orminus($r->nama_peminjam) . '/' . orminus($r->alamat) . '/' . orminus(strtoupper($r->type_client));
			$r->no_berkas =  orminus($no_arsip) .'/'.orminus($agenda).'.'.orminus($kode_komp).'/'.orminus($tahun); 
			$r->tanggal_pinjam = date('d-m-Y',strtotime($r->tanggal_pinjam));
			$r->tanggal_kembali = date('d-m-Y',strtotime($r->tanggal_kembali));
		}							  			 

		$data['no'] 			= 1;			
		$data['pelayanan_list'] 	= $pelayanan_list;
		$count 	= count($retensi_list );
		$html 	= $this->CI->load->com('comlap_pelayanan_bulanan','view',array('name'=>'excel_bulanan','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_pelayanan_bulanan'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP PELAYANAN BULANAN";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		$objReader->generateFile();
		$objReader->redirectDownload();		
	
	}		
		


}	
?>
