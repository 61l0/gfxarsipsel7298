<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_retensi{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/comlap_retensi/';
		$params->lib['class_name'] = 'comlap_retensi';
		$params->lib['header_caption'] = '';
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'laporanbulanan_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		$this->CI->db->_protect_identifiers=false;
		$this->com_name = $params->lib['class_name'];
	}
	function bulanan()
	{
		$this->content['header_caption'] = 'Laporan Retensi Arsip Bulanan';
		$this->content['depo'] = $this->CI->com_model->depo();
		//$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
	
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_retensi','view',array('name'=>'html_bulanan','data'=>@$this->content ,'return'=>false));
	}
	
	function excel_bulanan()
	{
		$request = array(
			'title' => 'Laporan Retensi Arsip Bulanan',
			'bulan' => $this->CI->input->post('bulan'),
			'tahun' => $this->CI->input->post('tahun'),
			'status' => $this->CI->input->post('status'),

		);
		//print_r($data);
		$date = "'". date('Y-m-d') ."'";
		//$this->CI->db->_protect_identifier = false
		$this->CI->db->select("a.id_data,a.agenda,a.kode_komponen,a.status,a.tanggal,
										   	a.id_lokasisimpan,		    				
										    a.id_unit_pengolah,
										    a.id_retensi,
										    a.lokasi,
										    a.judul,
										    a.no_arsip,				 
										    a.tahun,
										    a.desc,
										    a.rt_desc,
										    a.rt_aktif,
										    a.rt_inaktif,
										    a.jml_tinjauan,
										    a.inaktif_sampai,
										    SUBSTRING_INDEX(c.path, '*',1 )  kode_masalah")
			 
					  ->from('arsip_data a')
					//  ->join('arsip_sifat_cat b','b.id_sifat=a.id_sifat','left')
					  ->join('arsip_kode_masalah c','c.id_kode_masalah=a.id_kode_masalah','left');
					//  ->join('m_skpd d','d.id_skpd=a.id_unit_pengolah','left');
		
		switch($request['status'])
		{
			case 'inaktif':
				$this->CI->db->where( "( a.inaktif_sampai < ".$date." and  (a.status IS NULL OR a.status = 'tinjau') ) ");
				break;
			case 'dinilai_kembali':
				$this->CI->db->where( "( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' )");
				break;
			case 'musnah':
				$this->CI->db->where( "( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan')");
				break;
			case 'permanen':
				$this->CI->db->where( "(( a.inaktif_sampai < ".$date." and  a.status IS NULL )     OR " . 
							  "( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' ) OR " .  
							  "( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan')) AND a.rt_desc = 'permanen'");
				break;
			default :
				$this->CI->db->where( "( a.inaktif_sampai < ".$date." and  (a.status IS NULL OR a.status = 'tinjau') )     OR " . 
							  "( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' ) OR " .  
							  "( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan')");
				break;
		}			  
		
		$data = $request;
		$data['status'] = strtoupper(str_replace('_', ' ', $data['status'] ) );

		if($data['bulan'] != 'ALL' && !empty($data['bulan'] ))
			$this->CI->db->where('MONTH(a.tanggal)',$data['bulan']);
		if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
			$this->CI->db->where('a.tahun',$data['tahun']);

		//print_r($data);

		$retensi_list = $this->CI->db->order_by('a.id_data desc')->get()->result();
	 
		$STATUS_TEXT = array(
			'' 			=> 'INAKTIF',
			'tinjau' 	=> 'SUDAH DINILAI KEMBALI',
			'musnahkan' => 'SUDAH DIMUSNAHKAN'
		);

		foreach ($retensi_list as &$r) 
		{
			$no_arsip  = $r->no_arsip;
			$agenda    = $r->agenda;
			$kode_komp = $r->kode_komponen;
			$tahun 	   = $r->tahun;
			$r->rt_inaktif 	   = $r->rt_inaktif . ' Tahun';
			$r->rt_aktif 	   = $r->rt_aktif . ' Tahun';
			if($r->status == 'tinjau')
				$r->status = $STATUS_TEXT[$r->status] . " $r->jml_tinjauan KALI ";
			else	
				$r->status = $STATUS_TEXT[$r->status];

			$r->rt_desc = strtoupper(str_replace('_', ' ', $r->rt_desc ) ) ;
			
			$r->no_berkas = orminus($no_arsip) .'/'.orminus($agenda).'.'.orminus($kode_komp).'/'.orminus($tahun); 
		}
		$data['klasifikasi_l'] = $this->CI->com_model->klasifikasi_kode_list();
		$data['no'] 			= 1;			
		$data['retensi_list'] 	= $retensi_list;
		$count 	= count($retensi_list );
		$html 	= $this->CI->load->com('comlap_retensi','view',array('name'=>'excel_bulanan','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_retensi'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP RETENSI ARSIP BULANAN";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		$objReader->generateFile();
		$objReader->redirectDownload();

	}
	function identitas()
	{	
		$this->content['header_caption'] = 'Laporan Retensi  Identitas Arsip';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['unit_pengolah'] = $this->CI->com_model->unit_pengolah();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
	


		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_retensi','view',array('name'=>'html_identitas','data'=>@$this->content ,'return'=>false));	
	}		
	function excel_identitas()
	{
		/*
		<input type="hidden" id="tahun" name="tahun" >
			<input type="hidden" id="depo" name="depo" >
			<input type="hidden" id="lokasi" name="lokasi" >
			<input type="hidden" id="kode_klasifikasi" name="kode_klasifikasi" >
			<input type="hidden" id="id_unit_pengolah" name="id_unit_pengolah" >
			<input type="hidden" id="status" name="status" >
		*/
		$request = array(
			'title' => 'Laporan Retensi Identitas Arsip',
			'lokasi' => $this->CI->input->post('lokasi'),
			'tahun' => $this->CI->input->post('tahun'),
			'status' => $this->CI->input->post('status'),
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
		$this->CI->db->select("a.id_data,a.agenda,a.kode_komponen,a.status,a.tanggal,d.nama_lengkap as instansi,
										   	a.id_lokasisimpan,		    				
										    a.id_unit_pengolah,
										    a.id_retensi,
										    a.lokasi,
										    a.judul,
										    a.no_arsip,				 
										    a.tahun,
										    a.desc,
										    a.rt_desc,
										    a.rt_aktif,
										    a.rt_inaktif,
										    a.jml_tinjauan,
										    a.inaktif_sampai,
										    SUBSTRING_INDEX(c.path, '*',1 )  kode_masalah,
										    ")
			 
					  ->from('arsip_data a')
					// ->join('arsip_sifat_cat b','b.id_sifat=a.id_sifat','left')
					  ->join('arsip_kode_masalah c','c.id_kode_masalah=a.id_kode_masalah','left')
					  ->join('m_skpd d','d.id_skpd=a.id_unit_pengolah','left');
		
		$data = $request;

		if($data['depo'] != 'ALL' && !empty($data['depo'] ))
		{
			//$this->db->select('b.name as depo');
			$this->CI->db->join('arsip_lokasi_simpan b','a.id_lokasisimpan=b.id_lokasi_simpan','left');
			$this->CI->db->where("SUBSTRING_INDEX(b.path_name, '*',1 ) ='".$data['depo']."'");
		}
		if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
			$this->CI->db->where('a.tahun',$data['tahun']);	
		if($data['lokasi'] != '' && !empty($data['lokasi'] ))
			$this->CI->db->like('a.lokasi',$data['lokasi']);
		if($data['id_unit_pengolah'] != 'ALL' && !empty($data['id_unit_pengolah'] ))
			$this->CI->db->where('a.id_unit_pengolah',$data['id_unit_pengolah']);
		if($data['id_kode_masalah'] != 'ALL' && !empty($data['id_kode_masalah'] ))
			$this->CI->db->where("SUBSTRING_INDEX(c.path, '*',1 ) ='".$data['klasifikasi_kode']."'");

		switch($request['status'])
		{
			case 'inaktif':
				$this->CI->db->where( "( a.inaktif_sampai < ".$date." and  (a.status IS NULL OR a.status = 'tinjau') ) ");
				break;
			case 'dinilai_kembali':
				$this->CI->db->where( "( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' )");
				break;
			case 'musnah':
				$this->CI->db->where( "( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan')");
				break;
			case 'permanen':
				$this->CI->db->where( "(( a.inaktif_sampai < ".$date." and  a.status IS NULL )     OR " . 
							  "( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' ) OR " .  
							  "( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan')) AND a.rt_desc = 'permanen'");
				break;
			default :
				$this->CI->db->where( "(( a.inaktif_sampai < ".$date." and  (a.status IS NULL OR a.status = 'tinjau') )     OR " . 
							  "( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' ) OR " .  
							  "( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan'))");
				break;
		}			  
		
		
		$data['status'] = strtoupper(str_replace('_', ' ', $data['status'] ) );

		

		//print_r($data);

		$retensi_list = $this->CI->db->order_by('a.id_data desc')->get()->result();
	 
	 	//echo $this->CI->db->last_query();

		$STATUS_TEXT = array(
			'' 			=> 'INAKTIF',
			'tinjau' 	=> 'SUDAH DINILAI KEMBALI',
			'musnahkan' => 'SUDAH DIMUSNAHKAN'
		);

		foreach ($retensi_list as &$r) 
		{
			$no_arsip  = $r->no_arsip;
			$agenda    = $r->agenda;
			$kode_komp = $r->kode_komponen;
			$tahun 	   = $r->tahun;

			$r->rt_inaktif 	   = $r->rt_inaktif . ' Tahun';
			$r->rt_aktif 	   = $r->rt_aktif . ' Tahun';

			if($r->status == 'tinjau')
				$r->status = $STATUS_TEXT[$r->status] . " $r->jml_tinjauan KALI ";
			else	
				$r->status = $STATUS_TEXT[$r->status];

			$r->rt_desc = strtoupper(str_replace('_', ' ', $r->rt_desc ) ) ;
			
			$r->no_berkas = orminus($no_arsip) .'/'.orminus($agenda).'.'.orminus($kode_komp).'/'.orminus($tahun); 
		}
		$data['klasifikasi_l'] = $this->CI->com_model->klasifikasi_kode_list();
		$data['no'] 			= 1;			
		$data['retensi_list'] 	= $retensi_list;
		$count 	= count($retensi_list );
		$html 	= $this->CI->load->com('comlap_retensi','view',array('name'=>'excel_identitas','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_retensi'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP RETENSI ARSIP IDENTITAS";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		//echo $html;
		$objReader->generateFile();
		$objReader->redirectDownload();
	}
}	
