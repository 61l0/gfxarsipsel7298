<?php

class Test extends CI_Controller{
	public function MakeDir()
	{
		error_reporting(E_ALL);
		$dir_name = 'test';
		$id = '2009';

		$path = DOC_PATH_ROOT . 'assets/media/file/'.$dir_name.'/'.$id.'/_thumbs/';
		//echo $path. "\n";
		MakeDir($path);
	}
	public function index()
	{
		echo 'CEK gd function' . "\n";

		if (extension_loaded('gd') && function_exists('gd_info')) {
		    echo "PHP GD library is installed on your web server";
		}
		else {
		    echo "PHP GD library is NOT installed on your web server";
		}
	}
	public function indexsx()
	{
		set_include_path(CLASSES_PATH . 'ExcelWriter');

		require_once 'Spreadsheet/Excel/Writer.php';
		$workbook = new Spreadsheet_Excel_Writer();
		$worksheet = $workbook->addWorksheet('SetMerge');

		// Sets the color of a cell's content
		$format = $workbook->addFormat();
		$format->setFgColor(10);
		$worksheet->write(0, 0, 'Cell Start', $format);

		// Merge cells from row 0, col 0 to row 2, col 2
		$worksheet->setMerge(0, 0, 2, 2);
		   
		$workbook->send('SetMerge.xls');
		$workbook->close();

	}
	public function indexx()
	{
		print_r($_SESSION);
		print_r($this->input);

		$needTicket = FALSE;
		$jobStatus = 'JOB_NOT_RUNNING';

		$jobTicket = array(
			'user_id' =>'',
			'job_name' => '',
			'progress' => '',
			'hash' => '',
			'start_date',''
		);

		if( $hasTicket )
		{
			if( $ticketExpired )
			{
				$jobStatus = 'JOB_EXPIRED';
				// CREATE TICKET
				$needTicket = TRUE;
			}
			else
			{
				//echo 'You only allowed do long running proc at once';
				$jobStatus = 'JOB_IS_ALREADY_RUNNING';
			}
		}
		else
		{
			// CREATE TICKET
			$needTicket = TRUE;
		}

		if( $jobStatus == 'JOB_NOT_RUNNING' || $jobStatus == 'JOB_EXPIRED' )
		{
			// INFORM USER 
			// DO THE JOB
		}
		else
		{
			// JOB IS RUNNING
			// INFORM USER ABOUT THE PROGRESS
		}

		// $this->load->helper('excel');
		// $this->output->enable_profiler(TRUE);
		// $table = '<table border="1">';

		// $rs = $this->db->select('a.*')
		// 							 ->limit(1000)
		// 							 ->from('arsip_data_siada a')->get();
		// foreach ($rs->next_row() as $r) 
		// {
		// 	$table .= '<tr><td>' . implode('</td><td>', array_values($r)) . '</td></tr>';
		// }							 
		// $table .= '</table>';
		// echo $table;					
		// echo 'Elapsed time: ' . $this->benchmark->elapsed_time();
		//htmlTableToExcel($table);		 
	}
	public function lap_surat()
	{
		$params = array(
			'tahun' 	 => '2014',
			'bulan' 	 => '06',
			'type_surat' => 'masuk',
		);

		// YEAR IS MUST BE SPECIFIED FOR MONTH

		if($params['tahun']!='all')
			$this->db->where('YEAR(tanggal_surat)',$params['tahun']);
		if($params['bulan']!='all')
			$this->db->where('MONTH(tanggal_surat)',$params['bulan']);

		$records = $this->db->get('arsip_lap_skpd')->result();

		//print_r($record);

		// START EXCEL
		require_once CLASSES_PATH . 'PHPExcel.php';

		// SET DOCUMENT TITLE
		$document_title = "Laporan Surat " . ucfirst($params['type_surat']);
		if($params['bulan'] != 'all')
			$document_title .= ' ' . bln_indo($params['bulan']);
		if($params['tahun'] != 'all')
			$document_title .= ($params['bulan'] != 'all' ? ' ' : ' Tahun ' ) . $params['tahun'];
		
		// echo $document_title;
		// die(); 
		// END SET DOCUMENT TITLE

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator('Malink Corporation')
									 ->setLastModifiedBy('Putra Budiman')
									 ->setTitle('Office 2007 XLSX Test Document')
									 ->setSubject('Office 2007 XLSX Test Document')
									 ->setDescription('Test Doc for Office 2007 XLSX')
									 ->setKeywords('Office 2007 open xml php')
									 ->setCategory('Test result file');
		// SET DOC TITLE							 
		$objPHPExcel->getActiveSheet()->setTitle($document_title);

		// WRITE TABLE CELL
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A8','NO')		->mergeCells('A8:A9')
					->setCellValue('B8','KODE')		->mergeCells('B8:C9');//->mergeCells('B8:C9');
		foreach ($record as $rec) {
			# code...
		}
		// END WRITE TABLE CELL			
		require_once CLASSES_PATH . 'PHPExcel/IOFactory.php';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		$objWriter->save('assets/media/file/excel/'.$document_title.'.xlsx');	
		// END EXCEL
	}
	public function excel()
	{
		require_once CLASSES_PATH . 'PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator('Malink Corporation')
									 ->setLastModifiedBy('Putra Budiman')
									 ->setTitle('Office 2007 XLSX Test Document')
									 ->setSubject('Office 2007 XLSX Test Document')
									 ->setDescription('Test Doc for Office 2007 XLSX')
									 ->setKeywords('Office 2007 open xml php')
									 ->setCategory('Test result file');
		$objPHPExcel->getActiveSheet()->setTitle('Minimalistic Demo');
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1','Hello')
					->setCellValue('B1','world!');

		require_once CLASSES_PATH . 'PHPExcel/IOFactory.php';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');



		$objWriter->save('assets/media/file/excel/MyExcel.xlsx');					

		//$objPHPExcel->setCellValueByColumnAndRow($column, $row, $value);

	}
	public function __export()
	{
		$this->output->set_content_type('text/javascript');
		$rs = $this->db->order_by('id_data','asc')
									 ->get('arsip_data_siada')
									 ->result_object();
		// $max_row = $rs->num_rows();
		// $i = 0;
		foreach ($rs as $arsip_data) 
		{
			//$arsip_data = $rs->row();	
			$arsip_data_n = array(
				//'id_data' => $arsip_data->id_data,
				'id_lokasisimpan' => $arsip_data->id_lokasisimpan,
				'id_sifat' => $arsip_data->id_sifat,
				'id_jenis' => $arsip_data->id_jenis,
				'id_unit_pengolah' => $arsip_data->id_unit_pengolah,
				'id_kode_pembantu' => $arsip_data->id_kode_pembantu,
				'kode_komponen' => $arsip_data->kode_komponen ? $arsip_data->kode_komponen : 0,
				'id_retensi' => 0,
				'id_kode_masalah' => $arsip_data->id_kode_masalah,
				'kd_kec' => $arsip_data->kd_kec,
				'lokasi' => $arsip_data->lokasi,
				'judul' => $arsip_data->judul,
				'no_arsip' => $arsip_data->no_arsip,
				'tanggal' => $arsip_data->tanggal,
				'desc' => $arsip_data->desc,
				'tgl_input' => $arsip_data->tgl_input,
				'user_id' => $arsip_data->user_id,
				'kodelama' => $arsip_data->kodelama,
				'depo' => $arsip_data->depo,
				'tahun' => date('Y',strtotime($arsip_data->tanggal))
			);
			// print_r($arsip_data_n);
			// die();
			echo $arsip_data->judul . "\n";
			$this->db->insert('arsip_data',$arsip_data_n);
		}
		echo 'DONE ' . $max_row . ' copied to arsip_data table.';	 
	}
	public function __export2($value='')
	{
		//echo 'this is test.';
		$this->output->set_content_type('text/javascript');

		$arsip_data = $this->db->select('a.id_data,a.tanggal,a.rt_inaktif,a.rt_aktif')
							   ->from('arsip_data a')
							   //->join('arsip_retensi r','a.id_retensi=r.id_retensi','left')
							   ->get()->result();

		foreach($arsip_data as $data)
		{
			//$end = date('Y-m-d', strtotime('+5 years'));
			if(!$data->tanggal)
				$data->tanggal = '1980-01-01';
			$up = array(
				'aktif_sampai' => date('Y-m-d', strtotime('+'.$data->rt_aktif." year", strtotime($data->tanggal)) ),
				'inaktif_sampai' => date('Y-m-d', strtotime('+'.$data->rt_inaktif." year", strtotime($data->tanggal)) )  
			);
			// print_r($data);
			// print_r($up);
			// die();
			$this->db->where('id_data',$data->id_data)->update('arsip_data',$up);
			//echo json_encode($data) . "\n";
		}
		echo 'DONE.';
		// $new_data = array(
		// 	'rt_aktif' => '1',
		// 	'rt_inaktif' => '2',
		// 	'rt_desc' => 'permanen',
		// 	'sistem_penyimpanan' => 'dosir',
		// 	'jml_tinjauan' => '0'
		// );
		
	}
}