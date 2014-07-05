<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_rda{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/lap_rda/';
		$params->lib['class_name'] = 'comlap_rda';
		$params->lib['header_caption'] = '';
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'laporanbulanan_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}
	function bulanan()
	{
		$this->content['header_caption'] = 'Laporan Rekapitulasi Arsip Bulanan';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		$this->content['unit_pengolah'] = $this->CI->com_model->unit_pengolah();
	
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_rda','view',array('name'=>'html_bulanan','data'=>@$this->content ,'return'=>false));
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
		$this->CI->db->_protect_identifiers=false;
	
		$data = $request;		
		$sql = "
				SELECT
				
				SUBSTRING_INDEX( K.`path`, '*',1  )  p_kode,
				
				COUNT(A.id_data) j_data,
				COUNT(DISTINCT SUBSTRING_INDEX(F.`path_name`,'*',2))  j_rak,
				COUNT(DISTINCT SUBSTRING_INDEX(F.`path_name`,'*',3))  j_box,
				COUNT(DISTINCT F.`path_name`)  j_folder
				
				FROM 
					arsip_data A,
					arsip_lokasi_simpan F,
					arsip_kode_masalah K
				
				WHERE
				
					A.`id_lokasisimpan` = F.`id_lokasi_simpan` 
					AND A.`id_kode_masalah` = K.`id_kode_masalah` 
					AND F.`type` = 'folder' 
			   "
			   .
			   // DEPO CHOOSER
			   ( ( !empty($data['depo']) && $data['depo'] != 'ALL') ? "\t\tAND SUBSTRING_INDEX(F.`path_name`, '*',1 ) = '{$data[depo]}' \n" : "" )
			   .
			   // BULAN ENTRY
			   ( ( !empty($data['bulan']) && $data['bulan'] != 'ALL') ? "\t\tAND MONTH(A.`tgl_input`) = {$data[bulan]}\n" : "" )
			   .
		
			   // KODE KLASIFIKASI
			   ( ( !empty($data['klasifikasi_kode']) && $data['klasifikasi_kode'] != 'ALL') ? "\t\t\tAND SUBSTRING_INDEX( K.`path`, '*',1  ) = '{$data[klasifikasi_kode]}'\n" : "" )
			   .
			   // TAHUN ARSIP
			   ( ( !empty($data['tahun']) && $data['tahun'] != 'ALL') ? "\t\tAND A.`tahun` = {$data[tahun]}\n" : "" )
			   .
			   "
				GROUP BY SUBSTRING_INDEX( K.`path`, '*',1  ) 
			   ";
		
					  
		$rda_list = array();	
		$klasifikasi_l = array();   
		$rekap_list = $this->CI->db->query($sql)->result_object();
	 	//echo $this->CI->db->last_query();	
		$arsip_kode_masalah = $this->CI->db->select('kode as p_code,name')
										   ->where('level','1')
										   ->get('arsip_kode_masalah')
										   ->result_object();
	 	$data['total_data'] = 0;
	 	$data['total_rak'] = 0;
	 	$data['total_boks'] = 0;
	 	$data['total_sampul'] = 0;

		foreach ($arsip_kode_masalah as $r)
		{
			$klasifikasi_l[$r->p_code] = $r->name;
			$rda_list[$r->p_code] = array();

			$rda_list[$r->p_code]['kode'] = $r->p_code;
			$rda_list[$r->p_code]['masalah'] = strtoupper($r->name);
			
			
			$rda_list[$r->p_code]['data'] = 0;
			$rda_list[$r->p_code]['rak'] = 0;
			$rda_list[$r->p_code]['boks'] = 0;
			$rda_list[$r->p_code]['sampul'] = 0;
			$rda_list[$r->p_code]['tahun'] = 'ALL';
			$rda_list[$r->p_code]['depo'] = "ALL";
			if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
				$rda_list[$r->p_code]['tahun'] = $data['tahun'];
			if($data['depo'] != 'ALL' && !empty($data['depo'] ))
				$rda_list[$r->p_code]['depo'] = $data['depo'];
		}
		foreach($rekap_list as $r)
		{

			// if(empty($r->p_code))
			// 	continue;
			//print_r($rda_list[$r->p_kode]);
			$key = trim(''.$r->p_kode);
			if(strlen($key) > 0){
				
				$rda_list[$key]['data'] = $r->j_data;
				$rda_list[$key]['rak'] = $r->j_rak;
				$rda_list[$key]['boks'] = $r->j_box;
				$rda_list[$key]['sampul'] = $r->j_folder;

				if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
					$rda_list[$r->p_code]['tahun'] = $data['tahun'];
				if($data['depo'] != 'ALL' && !empty($data['depo'] ))
					$rda_list[$r->p_code]['depo'] = $data['depo'];

				$data['total_data'] += $r->j_data;
				$data['total_rak'] += $r->j_rak;
				$data['total_boks'] += $r->j_box;
				$data['total_sampul'] += $r->j_folder;


			}
		}
		unset($rda_list['']);
		// print_r($rda_list);
		// die();		
		//print_r($rekap_list);

		$data['no'] 			= 1;			
		$data['rda_list'] 	= $rda_list;
		// unset($arsip_kode_masalah);
		// unset($rekap_list);

		
		$html 	= $this->CI->load->com('comlap_rda','view',array('name'=>'excel_bulanan','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_rda'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP REKAP DATA ARSIP";	
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
	


		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_rda','view',array('name'=>'html_identitas','data'=>@$this->content ,'return'=>false));	
	}		
	function excel_identitas()
	{
		$request = array(
			'title' => 'Laporan Daftar Pencarian Arsip',
			'lokasi' => $this->CI->input->post('lokasi'),
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
		$this->CI->db->_protect_identifiers=false;
		/*
SUBSTRING_INDEX( K.`path`, '*',1  )  c_kode,
				
				COUNT(A.id_data) j_data,
				COUNT(DISTINCT SUBSTRING_INDEX(F.`path_name`,'*',2))  j_rak,
				COUNT(DISTINCT SUBSTRING_INDEX(F.`path_name`,'*',3))  j_box,
				COUNT(DISTINCT F.`path_name`)  j_folder
		*/
		$data = $request;		
		$sql = "
				SELECT
				
				SUBSTRING_INDEX( K.`path`, '*',1  )  p_kode,
				
				COUNT(A.id_data) j_data,
				COUNT(DISTINCT SUBSTRING_INDEX(F.`path_name`,'*',2))  j_rak,
				COUNT(DISTINCT SUBSTRING_INDEX(F.`path_name`,'*',3))  j_box,
				COUNT(DISTINCT F.`path_name`)  j_folder
				
				FROM 
					arsip_data A,
					arsip_lokasi_simpan F,
					arsip_kode_masalah K
				
				WHERE
				
					A.`id_lokasisimpan` = F.`id_lokasi_simpan` 
					AND A.`id_kode_masalah` = K.`id_kode_masalah` 
					AND F.`type` = 'folder' 
			   "
			   .
			   // DEPO CHOOSER
			   ( ( !empty($data['depo']) && $data['depo'] != 'ALL') ? "\t\tAND SUBSTRING_INDEX(F.`path_name`, '*',1 ) = '{$data[depo]}' \n" : "" )
			   .
			   // BULAN ENTRY
			   (  !empty($data['lokasi'])  ? "\t\tAND A.`lokasi` LIKE '%{$data[lokasi]}%'\n" : "" )
			   .
		
			   // KODE KLASIFIKASI
			   ( ( !empty($data['klasifikasi_kode']) && $data['klasifikasi_kode'] != 'ALL') ? "\t\t\tAND SUBSTRING_INDEX( K.`path`, '*',1  ) = '{$data[klasifikasi_kode]}'\n" : "" )
			   .
			   // TAHUN ARSIP
			   ( ( !empty($data['tahun']) && $data['tahun'] != 'ALL') ? "\t\tAND A.`tahun` = {$data[tahun]}\n" : "" )
			   .
			   "
				GROUP BY SUBSTRING_INDEX( K.`path`, '*',1  ) 
			   ";
		
					  
		$rda_list = array();	
		$klasifikasi_l = array();   
		$rekap_list = $this->CI->db->query($sql)->result_object();
	 	//echo $this->CI->db->last_query();	
		$arsip_kode_masalah = $this->CI->db->select('kode as p_code,name')
										   ->where('level','1')
										   ->get('arsip_kode_masalah')
										   ->result_object();
	 	$data['total_data'] = 0;
	 	$data['total_rak'] = 0;
	 	$data['total_boks'] = 0;
	 	$data['total_sampul'] = 0;

		foreach ($arsip_kode_masalah as $r)
		{
			$klasifikasi_l[$r->p_code] = $r->name;
			$rda_list[$r->p_code] = array();

			$rda_list[$r->p_code]['kode'] = $r->p_code;
			$rda_list[$r->p_code]['masalah'] = strtoupper($r->name);
			
			
			$rda_list[$r->p_code]['data'] = 0;
			$rda_list[$r->p_code]['rak'] = 0;
			$rda_list[$r->p_code]['boks'] = 0;
			$rda_list[$r->p_code]['sampul'] = 0;
			$rda_list[$r->p_code]['tahun'] = 'ALL';
			$rda_list[$r->p_code]['depo'] = "ALL";
			if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
				$rda_list[$r->p_code]['tahun'] = $data['tahun'];
			if($data['depo'] != 'ALL' && !empty($data['depo'] ))
				$rda_list[$r->p_code]['depo'] = $data['depo'];
		}
		foreach($rekap_list as $r)
		{

			// if(empty($r->p_code))
			// 	continue;
			//print_r($rda_list[$r->p_kode]);
			$key = trim(''.$r->p_kode);
			if(strlen($key) > 0){
				
				$rda_list[$key]['data'] = $r->j_data;
				$rda_list[$key]['rak'] = $r->j_rak;
				$rda_list[$key]['boks'] = $r->j_box;
				$rda_list[$key]['sampul'] = $r->j_folder;

				if($data['tahun'] != 'ALL' && !empty($data['tahun'] ))
					$rda_list[$r->p_code]['tahun'] = $data['tahun'];
				if($data['depo'] != 'ALL' && !empty($data['depo'] ))
					$rda_list[$r->p_code]['depo'] = $data['depo'];

				$data['total_data'] += $r->j_data;
				$data['total_rak'] += $r->j_rak;
				$data['total_boks'] += $r->j_box;
				$data['total_sampul'] += $r->j_folder;


			}
		}
		unset($rda_list['']);
		// print_r($rda_list);
		// die();		
		//print_r($rekap_list);

		$data['no'] 			= 1;			
		$data['rda_list'] 	= $rda_list;
		// unset($arsip_kode_masalah);
		// unset($rekap_list);

		
		$html 	= $this->CI->load->com('comlap_rda','view',array('name'=>'excel_identitas','data'=>$data ,'return'=>true));

		require_once(CLASSES_PATH.'PHPExcel.php');		
		require_once(APPPATH.'libraries/HtmlExcel.php');

		$token = md5('comlap_rda'.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
		$input_filename  = 'assets/media/file/excel/html_template/'.$token.'.html';
		$output_filename = 'assets/media/file/excel/'.$token.'.xls';
		file_put_contents($input_filename, $html);
		
		$title = "LAP REKAP DATA ARSIP";	
		$objReader = new HtmlExcel($title,$token,$input_filename,$output_filename,$count,4);

		
		//echo $html;
	 	$objReader->generateFile();
		$objReader->redirectDownload();
	}
}	
