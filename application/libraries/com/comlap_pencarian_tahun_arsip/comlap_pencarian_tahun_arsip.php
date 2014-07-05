<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlap_pencarian_tahun_arsip{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/lap_pencarian_tahun_arsip/';
		$params->lib['class_name'] = 'comlap_pencarian_tahun_arsip';
		
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'lap_pencarian_tahun_arsip_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	function index(){
		$this->content['header_caption'] = 'Laporan &raquo; Daftar Pencarian Arsip &raquo; Tahun Arsip';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		// dump($this->content['depo']);
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_pencarian_tahun_arsip','view',array('name'=>'default','data'=>@$this->content ,'return'=>false));		
	}	

	function rptklasifikasi()
	{	
		$klasifikasi = $this->CI->input->post('klasifikasi2');
		// echo $klasifikasi;
		$depo = $this->CI->input->post('depo');
		$tahun = $this->CI->input->post('tahun');
		// echo $tahun;
		$this->CI->load->library('myexcel_dpa_tahun');
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


		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('A')->setWidth(4.43);		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('B')->setWidth(1.85);		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('C')->setWidth(1.85);		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('D')->setWidth(1.85);		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('E')->setWidth(1.85);		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('F')->setWidth(1.80);	
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('G')->setWidth(1.80);	
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('H')->setWidth(15.38);		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('I')->setWidth(15.38);		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('J')->setWidth(39.43);	
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('N')->setWidth(14.86);	
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('O')->setWidth(13.14);	
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('P')->setWidth(23.50);	
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getColumnDimension('Q')->setWidth(11.38);	
		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getPageSetup()->setScale(75);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getPageMargins()->setTop(0.5);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getPageMargins()->setRight(0.2);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getPageMargins()->setLeft(0.3);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getPageMargins()->setBottom(3);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getPageMargins()->setHeader(0.5);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getPageMargins()->setFooter(3);		
		//------------------

		$this->CI->myexcel_dpa_tahun->writeRow('A1:Q1','KANTOR ARSIP DAERAH KOTA TANGERANG SELATAN');
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($style_header_rka);
		$this->CI->myexcel_dpa_tahun->writeRow('A2:Q2','DAFTAR PENCARIAN ARSIP');
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A2:Q2')->applyFromArray($style_header_rka);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->mergeCells('A1:Q1');			
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->mergeCells('A2:Q2');			

		
		$this->CI->myexcel_dpa_tahun->writeRow('A3:C3', 'Depo');
		$this->CI->myexcel_dpa_tahun->writeRow('D3',':');
		$this->CI->myexcel_dpa_tahun->writeRow('E3:Q3',($depo=='')?'All':$depo);
		
		$th = ($tahun=='')?'All':$tahun;
		$this->CI->myexcel_dpa_tahun->writeRow('A4:C4', 'Tahun');
		$this->CI->myexcel_dpa_tahun->writeRow('D4',':');
		$this->CI->myexcel_dpa_tahun->writeRow('E4:Q4',$th);
		// $this->CI->myexcel_dpa_tahun->getActiveSheet()->mergeCells('A5:Q5');		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('D3:F4')->applyFromArray($style_data);
		
		$nmklasifikasi = $this->CI->com_model->klasifikasi_kondisi($klasifikasi);
		$this->CI->myexcel_dpa_tahun->writeRow('A5:C5', 'Klasifikasi');
		$this->CI->myexcel_dpa_tahun->writeRow('D5',':');
		$this->CI->myexcel_dpa_tahun->writeRow('E5:Q5',($klasifikasi=='')?'All':$nmklasifikasi[0]->name);
		// $this->CI->myexcel_dpa_tahun->getActiveSheet()->mergeCells('A5:Q5');		

		$this->CI->myexcel_dpa_tahun->writeRow('A6:A7', 'NO');		
		$this->CI->myexcel_dpa_tahun->writeRow('B6:G7', 'KD KLASIFIKASI');		
		$this->CI->myexcel_dpa_tahun->writeRow('H6:H7', 'NAMA KLASIFIKASI');		
		$this->CI->myexcel_dpa_tahun->writeRow('I6:I7', 'NO ARSIP');		
		$this->CI->myexcel_dpa_tahun->writeRow('J6:J7', 'URAIAN');		
		$this->CI->myexcel_dpa_tahun->writeRow('K6:K7', 'TAHUN');		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A6:K7')->applyFromArray($style_header_form);
		$this->CI->myexcel_dpa_tahun->writeRow('L6:O6', 'NOMOR');		
		$this->CI->myexcel_dpa_tahun->writeRow('L7', 'DEPO');		
		$this->CI->myexcel_dpa_tahun->writeRow('M7', 'RAK');		
		$this->CI->myexcel_dpa_tahun->writeRow('N7', 'BOX');		
		$this->CI->myexcel_dpa_tahun->writeRow('O7', 'FOLDER');		
		$this->CI->myexcel_dpa_tahun->writeRow('P6:P7', 'UNIT PENGOLAH');		
		$this->CI->myexcel_dpa_tahun->writeRow('Q6:Q7', 'KETERANGAN');		
		$this->CI->myexcel_dpa_tahun->writeRow('A8', '1');		
		$this->CI->myexcel_dpa_tahun->writeRow('B8:G8', '2');		
		$this->CI->myexcel_dpa_tahun->writeRow('H8', '3');		
		$this->CI->myexcel_dpa_tahun->writeRow('I8', '4');		
		$this->CI->myexcel_dpa_tahun->writeRow('J8', '5');		
		$this->CI->myexcel_dpa_tahun->writeRow('K8', '6');		
		$this->CI->myexcel_dpa_tahun->writeRow('L8', '7');		
		$this->CI->myexcel_dpa_tahun->writeRow('M8', '8');		
		$this->CI->myexcel_dpa_tahun->writeRow('N8', '9');		
		$this->CI->myexcel_dpa_tahun->writeRow('O8', '10');		
		$this->CI->myexcel_dpa_tahun->writeRow('P8', '11');		
		$this->CI->myexcel_dpa_tahun->writeRow('Q8', '12');		
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A8:Q8')->applyFromArray($style_th_no);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('J6:Q6')->applyFromArray($style_header_form);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('J7:Q7')->applyFromArray($style_header_form);
		//looping
		$data = $this->CI->com_model->get_data_laporan($depo, $klasifikasi, $tahun);
		// dump($data);
		$no = 1;
		$loop = 9;
			foreach($data as $rowdata){
				$lokasi_simpan = $this->CI->com_model->lokasi_simpan($rowdata->id_lokasisimpan);
			// dump($lokasi_simpan);
				$this->CI->myexcel_dpa_tahun->writeRow('A'.$loop.':'.'A'.$loop, $no);		
				$this->CI->myexcel_dpa_tahun->writeRow('B'.$loop.':'.'G'.$loop, $rowdata->id_kode_masalah);		
				$this->CI->myexcel_dpa_tahun->writeRow('H'.$loop, $rowdata->name);		
				$this->CI->myexcel_dpa_tahun->writeRow('I'.$loop, $rowdata->no_arsip.' ');		
				$this->CI->myexcel_dpa_tahun->writeRow('J'.$loop, $rowdata->judul);		
				$this->CI->myexcel_dpa_tahun->writeRow('K'.$loop, $rowdata->tahun);		
				$this->CI->myexcel_dpa_tahun->writeRow('L'.$loop, $lokasi_simpan[0]->name);		
				$this->CI->myexcel_dpa_tahun->writeRow('M'.$loop, $lokasi_simpan[1]->name);		
				$this->CI->myexcel_dpa_tahun->writeRow('N'.$loop, $lokasi_simpan[2]->name);		
				$this->CI->myexcel_dpa_tahun->writeRow('O'.$loop, $lokasi_simpan[3]->name);		
				$this->CI->myexcel_dpa_tahun->writeRow('P'.$loop, $rowdata->pengolah);		
				$this->CI->myexcel_dpa_tahun->writeRow('Q'.$loop, $rowdata->desc);					
				$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A'.$loop.':'.'Q'.$loop)->applyFromArray($style_data);
				$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('H')->applyFromArray($style_data);
				
				$no++;	
				$loop++;	
			}
		//OUTTER
		$this->CI->myexcel_dpa_tahun->getDefaultStyle()->getFont()->setName('Arial');
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A6:Q'.($loop-1).'')->applyFromArray($style_table_outter);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A6:Q6')->getBorders()->getTop()->setBorderStyle( 	
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('Q6:Q'.($loop-1).'')->getBorders()->getRight()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A6:A'.($loop-1).'')->getBorders()->getLeft()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A'.($loop-1).':Q'.($loop-1).'')->getBorders()->getBottom()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		// $this->CI->myexcel_dpa_tahun->getActiveSheet()->getStyle('A'.$row.':O'.($row).'')->getBorders()->getBottom()->setBorderStyle(
															// PHPExcel_Style_Border::BORDER_THICK);
		
	
		
		$this->CI->myexcel_dpa_tahun->download();		
	
	}		
		


}	
?>
