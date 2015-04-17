<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class comlaporan_bulanan{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/laporan_klasifikasi/';
		$params->lib['class_name'] = 'comlaporan_bulanan';
		$params->lib['header_caption'] = '';
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'Laporanbulanan_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	function index(){
		$this->content['header_caption'] = 'Laporan &raquo; Rekapitulasi Data Arsip &raquo; Laporan Bulanan';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['klasifikasi'] = $this->CI->com_model->klasifikasi();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
	
		$this->content_default['segments']['head'] = $this->CI->load->com('comlaporan_bulanan','view',array('name'=>'default','data'=>@$this->content ,'return'=>false));		
	}	

	function rptbulanan()
	{	
		$depo = $this->CI->input->post('depo');
		$klasifikasi = $this->CI->input->post('klasifikasi2');
		$bulan = $this->CI->input->post('bulan');
		// echo $bulan;
		$tahun = $this->CI->input->post('tahun');
		
		// echo $klasifikasi;
		$this->CI->load->library('myexcel_bulanan');
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
		$style_data_kolom_depo = array('font' => array('size' => 10, 'bold' =>false, 'name' => 'Calibri'), 
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


		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('A')->setWidth(4.43);		
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('B')->setWidth(1.85);		
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('C')->setWidth(1.85);		
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('D')->setWidth(1.85);		
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('E')->setWidth(1.85);		
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('F')->setWidth(1.80);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('G')->setWidth(1.80);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('H')->setWidth(8.38);		
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('I')->setWidth(8.38);		
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('J')->setWidth(8.38);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('K')->setWidth(8.38);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('L')->setWidth(8.38);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('M')->setWidth(14.86);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('N')->setWidth(14.86);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('O')->setWidth(14.86);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('P')->setWidth(14.86);	
		$this->CI->myexcel_bulanan->getActiveSheet()->getColumnDimension('Q')->setWidth(14.86);	
		
		$this->CI->myexcel_bulanan->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$this->CI->myexcel_bulanan->getActiveSheet()->getPageSetup()->setScale(75);
		$this->CI->myexcel_bulanan->getActiveSheet()->getPageMargins()->setTop(0.5);
		$this->CI->myexcel_bulanan->getActiveSheet()->getPageMargins()->setRight(0.2);
		$this->CI->myexcel_bulanan->getActiveSheet()->getPageMargins()->setLeft(0.3);
		$this->CI->myexcel_bulanan->getActiveSheet()->getPageMargins()->setBottom(3);
		$this->CI->myexcel_bulanan->getActiveSheet()->getPageMargins()->setHeader(0.5);
		$this->CI->myexcel_bulanan->getActiveSheet()->getPageMargins()->setFooter(3);		
		//------------------

		$this->CI->myexcel_bulanan->writeRow('A1:Q1','KANTOR ARSIP DAERAH KOTA TANGERANG SELATAN');
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($style_header_rka);
		$this->CI->myexcel_bulanan->writeRow('A2:Q2','REKAPITULASI DATA ARSIP');
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A2:Q2')->applyFromArray($style_header_rka);
		$this->CI->myexcel_bulanan->getActiveSheet()->mergeCells('A1:Q1');			
		$this->CI->myexcel_bulanan->getActiveSheet()->mergeCells('A2:Q2');			

		


		$this->CI->myexcel_bulanan->writeRow('A5:C5', 'Bulan');		
		$this->CI->myexcel_bulanan->writeRow('D5', ':');		
		$this->CI->myexcel_bulanan->writeRow('E5:F5', ($bulan=="")?'ALL':$bulan);
		
		$this->CI->myexcel_bulanan->writeRow('H5:H5', 'Tahun :');		
		$this->CI->myexcel_bulanan->writeRow('I5:I5', ($tahun=="")?'ALL':$tahun);
		
		$this->CI->myexcel_bulanan->writeRow('A6:A7', 'DEPOss');		
		$this->CI->myexcel_bulanan->writeRow('B6:G7', 'KLASIFIKASI');		
		$this->CI->myexcel_bulanan->writeRow('H6:M7', 'MASALAH');		
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A6:N7')->applyFromArray($style_header_form);
		$this->CI->myexcel_bulanan->writeRow('N6:Q6', 'JUMLAH ARSIP');		
		$this->CI->myexcel_bulanan->writeRow('N7', 'DATA ARSIP');		
		$this->CI->myexcel_bulanan->writeRow('O7', 'RAK');		
		$this->CI->myexcel_bulanan->writeRow('P7', 'BOX');		
		$this->CI->myexcel_bulanan->writeRow('Q7', 'FOLDER');		
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('N6:Q6')->applyFromArray($style_header_form);
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('N7:Q7')->applyFromArray($style_header_form);
		//looping
		if($klasifikasi==''){
			$data = @$this->CI->com_model->get_data_laporan($depo, $klasifikasi);
		}else{
			$data = @$this->CI->com_model->get_data_laporan_kondisi($depo, $klasifikasi);
		}
		// dump($data);
		$no = 1;
		$loop = 8;
		
			$data_depo = $this->CI->com_model->depo_kondisi($depo);
		
		$colom_depo = count($data)-1;
		// dump($jml_data['jml_arsip']);
		//foreach($data_depo as $row){
		if($depo==""){
			$this->CI->myexcel_bulanan->writeRow('A'.$loop.':'.'A'.$loop, 'ALL');		
			$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A'.$loop.':'.'A20')->applyFromArray($style_data_kolom_depo);
		}else{
			$this->CI->myexcel_bulanan->writeRow('A'.$loop.':'.'A'.$loop, $data_depo[0]->name);		
			$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A'.$loop.':'.'A20')->applyFromArray($style_data_kolom_depo);
			}		
			$this->CI->myexcel_bulanan->getActiveSheet()->mergeCells('A'.$loop.':'.'A'.($colom_depo+$loop));		
			
			foreach(@$data as $rowdata){
				$jml_data = $this->CI->com_model->get_data_laporan_jml($depo, $rowdata['id_kode_masalah'], $bulan, $tahun); 
				$this->CI->myexcel_bulanan->writeRow('B'.$loop.':'.'G'.$loop, $rowdata['kode']);		
				$this->CI->myexcel_bulanan->writeRow('H'.$loop.':'.'M'.$loop, $rowdata['masalah']);		
				$this->CI->myexcel_bulanan->writeRow('N'.$loop, ($jml_data['jml_arsip']=='')?0:$jml_data['jml_arsip']);		
				$this->CI->myexcel_bulanan->writeRow('O'.$loop, ($jml_data['jml_rak']=='')?0:$jml_data['jml_rak']);		
				$this->CI->myexcel_bulanan->writeRow('P'.$loop, ($jml_data['jml_box']=='')?0:$jml_data['jml_box']);		
				$this->CI->myexcel_bulanan->writeRow('Q'.$loop, ($jml_data['jml_folder']=='')?0:$jml_data['jml_folder']);		
		
				$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A'.$loop.':'.'G'.$loop)->applyFromArray($style_data);
				$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('H')->applyFromArray($style_data);
				
				$no++;	
				$loop++;	
			}
		//}	
		$this->CI->myexcel_bulanan->writeRow('A'.($loop).':M'.($loop), 'JUMLAH');		
		$this->CI->myexcel_bulanan->getActiveSheet()->setCellValue('N'.($loop), '=SUM(N8:N'.($loop-1).')');			
		$this->CI->myexcel_bulanan->getActiveSheet()->setCellValue('O'.($loop), '=SUM(O8:O'.($loop-1).')');			
		$this->CI->myexcel_bulanan->getActiveSheet()->setCellValue('P'.($loop), '=SUM(P8:P'.($loop-1).')');			
		$this->CI->myexcel_bulanan->getActiveSheet()->setCellValue('Q'.($loop), '=SUM(Q8:Q'.($loop-1).')');	
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A'.($loop).':'.'M'.($loop))->applyFromArray($style_data_jml);
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('N'.($loop).':'.'Q'.($loop))->applyFromArray($style_data_total);
		//OUTTER
		$this->CI->myexcel_bulanan->getDefaultStyle()->getFont()->setName('Arial');
		
			
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A6:Q'.($loop).'')->applyFromArray($style_table_outter);
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A6:Q6')->getBorders()->getTop()->setBorderStyle( 	
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('Q6:Q'.($loop).'')->getBorders()->getRight()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A6:A'.($loop).'')->getBorders()->getLeft()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A'.($loop-1).':Q'.($loop-1).'')->getBorders()->getBottom()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A'.($loop).':Q'.($loop).'')->getBorders()->getBottom()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);													
		// $this->CI->myexcel_bulanan->getActiveSheet()->getStyle('A'.$row.':O'.($row).'')->getBorders()->getBottom()->setBorderStyle(
															// PHPExcel_Style_Border::BORDER_THICK);
		
	
		
		$this->CI->myexcel_bulanan->download();		
	
	}		
		


}	
?>
