<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comlap_pelayanan_rekap{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/lap_pelayanan_rekap/';
		$params->lib['class_name'] = 'comlap_pelayanan_rekap';
		
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'lap_pelayanan_rekap_model','alias'=>'com_model'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
	
		$this->com_name = $params->lib['class_name'];
	}

	function index(){
		$this->content['header_caption'] = 'Laporan &raquo; Rekap Pelayanan Arsip';
		$this->content['depo'] = $this->CI->com_model->depo();
		$this->content['bulan'] = $this->CI->com_model->bulan();
		$this->content['tahun'] = $this->CI->com_model->tahun();
		// dump($this->content['depo']);
		$this->content_default['segments']['head'] = $this->CI->load->com('comlap_pelayanan_rekap','view',array('name'=>'default','data'=>@$this->content ,'return'=>false));		
	}	

	function rptbulanan()
	{	
		$depo = $this->CI->input->post('depo');
		$bulan = $this->CI->input->post('bulan');
		$tahun = $this->CI->input->post('tahun');
		// echo $tahun;
		$this->CI->load->library('myexcel_pelayanan_rekap');
		$style_table_outter	= array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,
									'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLACK),)));
		
		$style_header_rka = array('alignment' => array('horizontal' => 'center'), 'font' => array('bold' => true, 
									'size' => 16, 'name' => 'Calibri'));
		#header rka pemkot
		$style_header_rka_pemkot = array('alignment' => array('horizontal' => 'center'), 'font' => array('bold' => false, 
									'size' => 16, 'name' => 'Calibri'));
		#header formulir
		$style_header_form = array('alignment' => array('horizontal' => 'center', 'vertical'   => 'center'), 
									'font' => array('bold' => true, 'size' => 10, 'name' => 'Calibri'));
		
		$style_th_no = array('font' => array('size' => 10, 'bold' =>true, 'name' => 'Calibri'), 
							'alignment' => array('horizontal' => 'center', 'vertical'  => 'center'));

		$style_th_no_item = array('font' => array('size' => 8, 'bold' =>false, 'name' => 'Arial'), 
							'alignment' => array('horizontal' => 'center', 'vertical'  => 'center'));								
		
		$style_data = array('font' => array('size' => 10, 'bold' =>true, 'name' => 'Calibri'), 
							'alignment' => array('horizontal' => 'left', 'vertical'  => 'center', 'wrap' => true));		
		$style_data_m = array('font' => array('size' => 8, 'bold' =>true, 'name' => 'Arial'), 
							'alignment' => array('horizontal' => 'left', 'vertical'  => 'center', 'wrap' => true));		
							
		$style_data_kode = array('font' => array('size' => 8, 'bold' =>true, 'name' => 'Arial'), 
							'alignment' => array('horizontal' => 'center', 'vertical'  => 'center', 'wrap' => true));

		$style_data_kode_r = array('font' => array('size' => 10, 'bold' =>false, 'name' => 'Calibri'), 
							'alignment' => array('horizontal' => 'center', 'vertical'  => 'center', 'wrap' => true));		
							
		$style_data_jumlah1 = array('font' => array('size' => 10, 'bold' =>true, 'name' => 'Calibri'), 
							'alignment' => array('horizontal' => 'center', 'vertical'  => 'center', 'wrap' => true));		
							
		$style_data_jumlah2 = array('font' => array('size' => 10, 'bold' =>false, 'name' => 'Calibri'), 
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


		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('A')->setWidth(4.43);		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('B')->setWidth(1.85);		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('C')->setWidth(1.85);		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('D')->setWidth(1.85);		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('E')->setWidth(2.13);		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('F')->setWidth(1.80);	
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('G')->setWidth(2.80);	
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('H')->setWidth(39.43);	
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('I')->setWidth(16.38);		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('J')->setWidth(15.38);	
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getColumnDimension('K')->setWidth(15.38);		
		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getPageSetup()->setScale(75);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getPageMargins()->setTop(0.5);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getPageMargins()->setRight(0.2);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getPageMargins()->setLeft(0.3);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getPageMargins()->setBottom(3);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getPageMargins()->setHeader(0.5);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getPageMargins()->setFooter(3);		
		//------------------

		$this->CI->myexcel_pelayanan_rekap->writeRow('A1:K1','KANTOR ARSIP DAERAH KOTA TANGERANG SELATAN');
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A1:K1')->applyFromArray($style_header_rka);
		$this->CI->myexcel_pelayanan_rekap->writeRow('A2:K2','REKAP PELAYANAN ARSIP');
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A2:K2')->applyFromArray($style_header_rka);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->mergeCells('A1:K1');			
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->mergeCells('A2:K2');			

		
		$this->CI->myexcel_pelayanan_rekap->writeRow('A3:F3', 'LAYANAN BULAN :');
		// $this->CI->myexcel_pelayanan_rekap->writeRow('F3',':');
		$this->CI->myexcel_pelayanan_rekap->writeRow('G3:K3',($bulan=='')?'ALL':$bulan);
		
		$this->CI->myexcel_pelayanan_rekap->writeRow('A4:F4', 'LAYANAN TAHUN :');
		// $this->CI->myexcel_pelayanan_rekap->writeRow('F4',':');
		$this->CI->myexcel_pelayanan_rekap->writeRow('G4:K4',($tahun=='')?'ALL':$tahun);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->mergeCells('A5:Q5');		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A3:K4')->applyFromArray($style_data);

		$this->CI->myexcel_pelayanan_rekap->writeRow('A6:A7', 'NO');		
		$this->CI->myexcel_pelayanan_rekap->writeRow('B6:G7', 'KLASIFIKASI');		
		$this->CI->myexcel_pelayanan_rekap->writeRow('H6:H7', 'MASALAH');		
		$this->CI->myexcel_pelayanan_rekap->writeRow('I6:I7', 'JUMLAH PEMINJAM');		
		$this->CI->myexcel_pelayanan_rekap->writeRow('J6:K6', 'HASIL LAYANAN');		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A6:K7')->applyFromArray($style_header_form);
		$this->CI->myexcel_pelayanan_rekap->writeRow('J7', 'ADA');		
		$this->CI->myexcel_pelayanan_rekap->writeRow('K7', 'TIDAK ADA');		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A8:K8')->applyFromArray($style_th_no);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('J6:K6')->applyFromArray($style_header_form);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('J7:K7')->applyFromArray($style_header_form);
		//looping
		// dump($data);
		$no = 1;
		$loop = 8;
	
		$data_klasifikasi = $this->CI->com_model->klasifikasi();
		foreach($data_klasifikasi as $row){
		$data = $this->CI->com_model->get_data_laporan($depo, $bulan, $tahun);
				$jml_data = $this->CI->com_model->get_data_laporan_jml($row->id_kode_masalah, $bulan, $tahun); 
			foreach($data as $rowdata){
			// dump($jml_data);
				
				// $jml_peminjam += $jml_data['jml_peminjam'];	
				
				$this->CI->myexcel_pelayanan_rekap->writeRow('A'.$loop.':'.'A'.$loop, $no);	

			//	$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A'.$loop.':'.'A'.$loop)->applyFromArray($style_th_no_item);

				$this->CI->myexcel_pelayanan_rekap->writeRow('B'.$loop.':'.'G'.$loop, $row->kode.' ');		
				$this->CI->myexcel_pelayanan_rekap->writeRow('H'.$loop, strtoupper($row->nama_masalah));		
				$this->CI->myexcel_pelayanan_rekap->writeRow('I'.$loop, ($jml_data['jml_peminjam'])?$jml_data['jml_peminjam']:'-');		
				$this->CI->myexcel_pelayanan_rekap->writeRow('J'.$loop, ($jml_data['jml_ada'])?$jml_data['jml_ada']:'-');		
				$this->CI->myexcel_pelayanan_rekap->writeRow('K'.$loop, ($jml_data['jml_tidakada'])?$jml_data['jml_tidakada']:'-');		
				$pinjam = strtotime($rowdata->tanggal_pinjam);
				$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('B'.$loop.':'.'G'.$loop)->applyFromArray($style_data_kode);
				$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('I'.$loop.':'.'K'.$loop)->applyFromArray($style_data_kode_r);
				// $this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('H'.$loop.':'.'K'.$loop)->applyFromArray($style_data);
				$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A'.$loop)->applyFromArray($style_th_no_item);
				$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('H'.$loop)->applyFromArray($style_data_m);
				
				$this->CI->myexcel_pelayanan_rekap->getActiveSheet()
				    ->getRowDimension($loop)
				    ->setRowHeight(25);
			}
				$no++;	
				$loop++;	
		}	
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()
				    ->getRowDimension(18)
				    ->setRowHeight(25);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()
				    ->getRowDimension(6)
				    ->setRowHeight(25);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()
				    ->getRowDimension(7)
				    ->setRowHeight(25);		    
		$this->CI->myexcel_pelayanan_rekap->writeRow('A'.($loop).':'.'H'.($loop), 'JUMLAH');			
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->setCellValue('I'.($loop), '=SUM(I8:I'.($loop-1).')');		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->setCellValue('J'.($loop), '=SUM(J8:J'.($loop-1).')');		
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->setCellValue('K'.($loop), '=SUM(K8:K'.($loop-1).')');		
		// $this->CI->myexcel_pelayanan_rekap->writeRow('J'.($loop), $jml_ada);			
		// $this->CI->myexcel_pelayanan_rekap->writeRow('K'.($loop), $jml_tidakada);			
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('I'.$loop.':'.'K'.$loop)->applyFromArray($style_data_kode);
				$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A'.$loop)->applyFromArray($style_data_jumlah1);
				$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('H'.$loop)->applyFromArray($style_data_jumlah2);
		//OUTTER
		$this->CI->myexcel_pelayanan_rekap->getDefaultStyle()->getFont()->setName('Arial');
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A6:K'.($loop).'')->applyFromArray($style_table_outter);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A6:K6')->getBorders()->getTop()->setBorderStyle( 	
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('K6:K'.($loop).'')->getBorders()->getRight()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A6:A'.($loop).'')->getBorders()->getLeft()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
		$this->CI->myexcel_pelayanan_rekap->getActiveSheet()->getStyle('A'.($loop).':K'.($loop).'')->getBorders()->getBottom()->setBorderStyle(
															PHPExcel_Style_Border::BORDER_THICK);
	
		
		$this->CI->myexcel_pelayanan_rekap->download();		
	
	}		
		


}	
?>
