<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlaporan_klasifikasi{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/laporan_klasifikasi/';
		$params->lib['class_name'] = 'comlaporan_klasifikasi';
		$params->lib['header_caption'] = '';
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'laporanklasifikasi_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	function index(){
		$this->content['header_caption'] = 'Laporan &raquo; Rekapitulasi Data Arsip &raquo; Laporan Klasifikasi';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		// dump($this->content['depo']);
		$this->content_default['segments']['head'] = $this->CI->load->com('comlaporan_klasifikasi','view',array('name'=>'default','data'=>@$this->content ,'return'=>false));		
	}	

	function rptklasifikasi()
	{	
		$depo = $this->CI->input->post('depo');
		$klasifikasi = $this->CI->input->post('klasifikasi2');
		
		// echo $klasifikasi;
		$this->CI->load->library('myexcel_klasifikasi');
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
		$style_data_jml = array('font' => array('size' => 10, 'bold' =>false, 'name' => 'Calibri'), 
							'alignment' => array('horizontal' => 'right', 'vertical'  => 'center', 'wrap' => true));	
		$style_data_total = array('font' => array('size' => 10, 'bold' =>false, 'name' => 'Calibri'), 
							'alignment' => array('horizontal' => 'center', 'vertical'  => 'center', 'wrap' => true));								
		$style_data_kolom = array('font' => array('size' => 10, 'bold' =>false, 'name' => 'Calibri'), 
							'alignment' => array( 'vertical'  => 'center', 'wrap' => true));		
							
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


		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('A')->setWidth(4.43);		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('B')->setWidth(1.85);		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('C')->setWidth(1.85);		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('D')->setWidth(1.85);		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('E')->setWidth(1.85);		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('F')->setWidth(1.80);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('G')->setWidth(1.80);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('H')->setWidth(8.38);		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('I')->setWidth(8.38);		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('J')->setWidth(8.38);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('K')->setWidth(8.38);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('L')->setWidth(8.38);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('M')->setWidth(14.86);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('N')->setWidth(14.86);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('O')->setWidth(14.86);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('P')->setWidth(14.86);	
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getColumnDimension('Q')->setWidth(14.86);	
		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getPageSetup()->setScale(75);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getPageMargins()->setTop(0.5);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getPageMargins()->setRight(0.2);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getPageMargins()->setLeft(0.3);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getPageMargins()->setBottom(3);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getPageMargins()->setHeader(0.5);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getPageMargins()->setFooter(3);		
		//------------------

		$this->CI->myexcel_klasifikasi->writeRow('A1:Q1','KANTOR ARSIP DAERAH KOTA TANGERANG');
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($style_header_rka);
		$this->CI->myexcel_klasifikasi->writeRow('A2:Q2','REKAPITULASI DATA ARSIP');
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A2:Q2')->applyFromArray($style_header_rka);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->mergeCells('A1:Q1');			
		$this->CI->myexcel_klasifikasi->getActiveSheet()->mergeCells('A2:Q2');			

		


		$this->CI->myexcel_klasifikasi->writeRow('A6:A7', 'DEPO');		
		$this->CI->myexcel_klasifikasi->writeRow('B6:G7', 'KLASIFIKASI');		
		$this->CI->myexcel_klasifikasi->writeRow('H6:M7', 'MASALAH');		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A6:N7')->applyFromArray($style_header_form);
		$this->CI->myexcel_klasifikasi->writeRow('N6:Q6', 'JUMLAH ARSIP');		
		$this->CI->myexcel_klasifikasi->writeRow('N7', 'DATA ARSIP');		
		$this->CI->myexcel_klasifikasi->writeRow('O7', 'RAK');		
		$this->CI->myexcel_klasifikasi->writeRow('P7', 'BOX');		
		$this->CI->myexcel_klasifikasi->writeRow('Q7', 'FOLDER');		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('N6:Q6')->applyFromArray($style_header_form);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('N7:Q7')->applyFromArray($style_header_form);
		//looping
		/*
		if($klasifikasi==''){
			$data = @$this->CI->com_model->get_data_laporan($depo, $klasifikasi);
		}else{
			$data = @$this->CI->com_model->get_data_laporan_kondisi($depo, $klasifikasi);
		}
		*/
		$data = @$this->CI->com_model->get_data_laporan($depo, $klasifikasi);
		// dump($data);
		$no = 1;
		$loop = 8;
	
			$data_depo = $this->CI->com_model->depo_kondisi($depo);
	
		$colom_depo = count($data)-1;
		// dump($jml_data['jml_arsip']);
		//foreach($data_depo as $row){
		if($depo==""){
				$this->CI->myexcel_klasifikasi->writeRow('A'.$loop.':'.'A'.$loop, 'ALL');		
			}else{
				$this->CI->myexcel_klasifikasi->writeRow('A'.$loop.':'.'A'.$loop, $data_depo[0]->name);		
		}	
			$this->CI->myexcel_klasifikasi->getActiveSheet()->mergeCells('A'.$loop.':'.'A'.($colom_depo+$loop));		
			$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A'.$loop.':'.'A20')->applyFromArray($style_data_kolom);
			foreach(@$data as $rowdata){
				$jml_data = $this->CI->com_model->get_data_laporan_jml($depo,($klasifikasi=='')?$rowdata['id_kode_masalah']:$klasifikasi); 
				$this->CI->myexcel_klasifikasi->writeRow('B'.$loop.':'.'G'.$loop, $rowdata['kode']);		
				$this->CI->myexcel_klasifikasi->writeRow('H'.$loop.':'.'M'.$loop, $rowdata['masalah']);		
				$this->CI->myexcel_klasifikasi->writeRow('N'.$loop, (($rowdata['id_kode_masalah']==$klasifikasi)||($klasifikasi==''))?$jml_data['jml_arsip']:"");			
				$this->CI->myexcel_klasifikasi->writeRow('O'.$loop, (($rowdata['id_kode_masalah']==$klasifikasi)||($klasifikasi==''))?$jml_data['jml_rak']:"");			
				$this->CI->myexcel_klasifikasi->writeRow('P'.$loop, (($rowdata['id_kode_masalah']==$klasifikasi)||($klasifikasi==''))?$jml_data['jml_box']:'');		
				$this->CI->myexcel_klasifikasi->writeRow('Q'.$loop,  (($rowdata['id_kode_masalah']==$klasifikasi)||($klasifikasi==''))?$jml_data['jml_folder']:'');			
		
				$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A'.$loop.':'.'G'.$loop)->applyFromArray($style_data);
				$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('H')->applyFromArray($style_data);
				
				$no++;	
				$loop++;	
			}
		//}	
		$this->CI->myexcel_klasifikasi->writeRow('A'.($loop).':M'.($loop), 'JUMLAH');		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->setCellValue('N'.($loop), '=SUM(N8:N'.($loop-1).')');			
		$this->CI->myexcel_klasifikasi->getActiveSheet()->setCellValue('O'.($loop), '=SUM(O8:O'.($loop-1).')');			
		$this->CI->myexcel_klasifikasi->getActiveSheet()->setCellValue('P'.($loop), '=SUM(P8:P'.($loop-1).')');			
		$this->CI->myexcel_klasifikasi->getActiveSheet()->setCellValue('Q'.($loop), '=SUM(Q8:Q'.($loop-1).')');			
		
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A'.($loop).':'.'M'.($loop))->applyFromArray($style_data_jml);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('N'.($loop).':'.'Q'.($loop))->applyFromArray($style_data_total);
		
		//OUTTER
		$this->CI->myexcel_klasifikasi->getDefaultStyle()->getFont()->setName('Arial');
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A6:Q'.($loop).'')->applyFromArray($style_table_outter);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A6:Q6')->getBorders()->getTop()->setBorderStyle( 	
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('Q6:Q'.($loop).'')->getBorders()->getRight()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A6:A'.($loop).'')->getBorders()->getLeft()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A'.($loop).':Q'.($loop).'')->getBorders()->getBottom()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A'.($loop-1).':Q'.($loop-1).'')->getBorders()->getBottom()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		// $this->CI->myexcel_klasifikasi->getActiveSheet()->getStyle('A'.$row.':O'.($row).'')->getBorders()->getBottom()->setBorderStyle(
															// PHPExcel_Style_Border::BORDER_THICK);
		
	
		
		$this->CI->myexcel_klasifikasi->download();		
	
	}		
		


}	
?>
