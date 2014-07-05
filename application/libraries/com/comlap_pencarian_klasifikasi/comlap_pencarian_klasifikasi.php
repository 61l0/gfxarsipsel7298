<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_pencarian_klasifikasi{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/lap_pencarian_klasifikasi/';
		$params->lib['class_name'] = 'comlap_pencarian_klasifikasi';
		
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'lap_pencarian_klasifikasi_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	function index(){
		$this->content['header_caption'] = 'Laporan &raquo; Rekapitulasi Data Arsip &raquo; Kode Klasifikasi';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		// dump($this->content['depo']);
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_pencarian_klasifikasi','view',array('name'=>'default','data'=>@$this->content ,'return'=>false));		
	}	

	function rptklasifikasi()
	{	
		$klasifikasi = $this->CI->input->post('klasifikasi2');
		// echo $klasifikasi;
		$depo = $this->CI->input->post('depo');
		$tahun = $this->CI->input->post('tahun');
		// echo $tahun;
		$this->CI->load->library('myexcel_dpa_klasifikasi');
		$style_table_outter	= array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,
									'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLACK),)));
		
		$style_header_rka = array('alignment' => array('horizontal' => 'center'), 'font' => array('bold' => true, 
									'size' => 12, 'name' => 'Calibri'));
		#header rka pemkot
		$style_header_rka_pemkot = array('alignment' => array('horizontal' => 'center'), 'font' => array('bold' => false, 
									'size' => 16, 'name' => 'Calibri'));
		#header formulir
		$style_header_form = array('alignment' => array('horizontal' => 'center', 'vertical'   => 'center'), 
									'font' => array('bold' => true, 'size' => 11, 'name' => 'Calibri'));
		
		$style_th_no = array('font' => array('size' => 7, 'bold' =>true, 'name' => 'Calibri'), 
							'alignment' => array('horizontal' => 'center', 'vertical'  => 'center'));								
		
		$style_data = array('font' => array('size' => 10, 'bold' =>false, 'name' => 'Calibri'), 
							'alignment' => array('horizontal' => 'left', 'vertical'  => 'center', 'wrap' => true));		
							
		$noborder = array('border' => array('size' => 0, 'color' => array('argb' => PHPExcel_Style_Color::COLOR_WHITE)));
									
		$right = array('alignment' => array('horizontal' => 'right', 'vertical' => 'center'));
		
		$center = array('alignment' => array('horizontal' => 'center', 'vertical' => 'center'));
		
		$outlines = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THICK, 
							'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLACK))));
	
		$noborderno = array('borders' => array('vertical' => array('style' => PHPExcel_Style_Border::BORDER_THICK, 
							'color' => array('argb' => PHPExcel_Style_Color::COLOR_WHITE)),'horizontal' => array(
							'style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array(
							'argb' => PHPExcel_Style_Color::COLOR_WHITE))));
		
		$style_footer = array('font' => array('bold' => true, 'name' => 'Arial'));
		// END DECLARE STYLE
		
		// PANGGIL LIB MY_EXCEL_DRAWING
		$objDrawing = new PHPExcel_Worksheet_HeaderFooterDrawing();


	
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getColumnDimension('C')->setWidth(47);	
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getColumnDimension('B')->setWidth(11.88);	
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getColumnDimension('I')->setWidth(13.75);	
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getColumnDimension('J')->setWidth(13.75);	
		
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getPageSetup()->setScale(75);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getPageMargins()->setTop(0.5);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getPageMargins()->setRight(0.2);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getPageMargins()->setLeft(0.3);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getPageMargins()->setBottom(3);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getPageMargins()->setHeader(0.5);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getPageMargins()->setFooter(3);		
		//------------------

		$this->CI->myexcel_dpa_klasifikasi->writeRow('A1:J1','KANTOR ARSIP DAERAH KOTA TANGERANG');
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A1:J1')->applyFromArray($style_header_rka);
		$this->CI->myexcel_dpa_klasifikasi->writeRow('A2:J2','DAFTAR PENCARIAN ARSIP');
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A2:J2')->applyFromArray($style_header_rka);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->mergeCells('A1:J1');			
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->mergeCells('A2:J2');			

		$nmklasifikasi = $this->CI->com_model->klasifikasi_kondisi($klasifikasi);
		if($klasifikasi==''){
			$aa = 'ALL';
		}else{
			$aa = $nmklasifikasi[0]->name;
		}
		if($depo==''){
			$a1 = 'ALL';
		}else{
			$a1 = $depo;
		}
		$this->CI->myexcel_dpa_klasifikasi->writeRow('A3:C3', 'Klasifikasi  : '.$aa);
		
		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('A4:C4', 'Depo    : '.$a1);
		
	
		
		
		// $this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->mergeCells('A5:Q5');		

		$this->CI->myexcel_dpa_klasifikasi->writeRow('A6:A7', 'NO');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('B6:B7', 'KD KLASIFIKASI');		
		//$this->CI->myexcel_dpa_klasifikasi->writeRow('H6:H7', 'NAMA KLASIFIKASI');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('C6:C7', 'URAIAN');		
		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('D6:D7', 'TAHUN');		
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A6:K7')->applyFromArray($style_header_form);
		$this->CI->myexcel_dpa_klasifikasi->writeRow('E6:H6', 'NOMOR');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('E7', 'DEPO');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('F7', 'RAK');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('G7', 'BOX');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('H7', 'FOLDER');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('I6:I7', 'UNIT PENGOLAH');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('J6:J7', 'KETERANGAN');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('A8', '1');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('B8', '2');		
		//$this->CI->myexcel_dpa_klasifikasi->writeRow('H8', '3');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('C8', '3');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('D8', '4');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('E8', '5');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('F8', '6');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('G8', '7');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('H8', '8');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('I8', '9');		
		$this->CI->myexcel_dpa_klasifikasi->writeRow('J8', '10');		
		
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A8:J8')->applyFromArray($style_th_no);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('J6:J6')->applyFromArray($style_header_form);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('J7:J7')->applyFromArray($style_header_form);
		//looping
		$data = $this->CI->com_model->get_data_laporan($depo, $klasifikasi, $tahun);
		// dump($data);
		$no = 1;
		$loop = 9;
			foreach($data as $rowdata){
				$lokasi_simpan = $this->CI->com_model->lokasi_simpan($rowdata->id_lokasisimpan);
			// dump($lokasi_simpan);
				$this->CI->myexcel_dpa_klasifikasi->writeRow('A'.$loop, $no);		
				$this->CI->myexcel_dpa_klasifikasi->writeRow('B'.$loop, $rowdata->id_kode_masalah."    ".$rowdata->name);		
				//$this->CI->myexcel_dpa_klasifikasi->writeRow('H'.$loop, $rowdata->name);		
				$this->CI->myexcel_dpa_klasifikasi->writeRow('C'.$loop, $rowdata->no_arsip.' '.$rowdata->judul);		
				
				$this->CI->myexcel_dpa_klasifikasi->writeRow('D'.$loop, $rowdata->tahun);		
				$this->CI->myexcel_dpa_klasifikasi->writeRow('E'.$loop, $lokasi_simpan[0]->name);		
				$this->CI->myexcel_dpa_klasifikasi->writeRow('F'.$loop, $lokasi_simpan[1]->name);		
				$this->CI->myexcel_dpa_klasifikasi->writeRow('G'.$loop, $lokasi_simpan[2]->name);		
				$this->CI->myexcel_dpa_klasifikasi->writeRow('H'.$loop, $lokasi_simpan[3]->name);		
				$this->CI->myexcel_dpa_klasifikasi->writeRow('I'.$loop, $rowdata->pengolah);		
				$this->CI->myexcel_dpa_klasifikasi->writeRow('J'.$loop, $rowdata->desc);					
				$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A'.$loop.':'.'J'.$loop)->applyFromArray($style_data);
				$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('H')->applyFromArray($style_data);
				
				$no++;	
				$loop++;	
			}
		//OUTTER
		$this->CI->myexcel_dpa_klasifikasi->getDefaultStyle()->getFont()->setName('Arial');
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A6:J'.($loop-1).'')->applyFromArray($style_table_outter);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A6:J6')->getBorders()->getTop()->setBorderStyle( 	
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('J6:J'.($loop-1).'')->getBorders()->getRight()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A6:A'.($loop-1).'')->getBorders()->getLeft()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A'.($loop-1).':J'.($loop-1).'')->getBorders()->getBottom()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		// $this->CI->myexcel_dpa_klasifikasi->getActiveSheet()->getStyle('A'.$row.':O'.($row).'')->getBorders()->getBottom()->setBorderStyle(
															// PHPExcel_Style_Border::BORDER_THICK);
		
	
		
		$this->CI->myexcel_dpa_klasifikasi->download();		
	
	}		
		


}	
?>
