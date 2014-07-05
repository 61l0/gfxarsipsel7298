<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
		require_once('classes/PHPExcel.php');
		require_once('classes/PHPExcel/IOFactory.php');
		require_once('classes/PHPExcel/Writer/HTML.php');

class Myexcel_pelayanan_rekap extends PHPExcel {

    var $cell = array();
    var $insertRow = array();
	var $excel;
	var $style;
	
    function Myexcel_pelayanan_rekap()
    {
		parent::__construct();
    }
	function writeRow($position='',$value = '',$option=array())
    {
		if(! is_array(@$position)):
			$checkMerge = explode(':',@$position);
			if(count($checkMerge) == 1):
				$this->getActiveSheet()->setCellValue(@$position, @$value);
				if(@$option['style']):
					//$this->getActiveSheet()->getStyle(@$position)->applyFromArray(@$option['style']);
				endif;
			else:
				$this->getActiveSheet()->setCellValue($checkMerge[0], @$value);
				$this->getActiveSheet()->mergeCells(@$position);
				if(@$option['style']):
					//$this->getActiveSheet()->getStyle(@$position)->applyFromArray(@$option['style']);
				endif;
			endif;
		else:
			$this->getActiveSheet()->setCellValueByColumnAndRow(@$position[0],@$position[1], @$value);
		endif;
		//if(@$option['style']) $this->setStyle($position,$option['style']);
    }
	function setStyle($position='',$style=array()){
		$position = (is_array($position))?('A' + $position[0]).$position[1]:$position;
		
	}
	function writeRows($rows = array(),$option=array())
    {
		foreach($rows as $row):
			$this->writeRow($row[0],$row[1],@$row[2]);
		endforeach;
	}
	
	function download()
    {
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$this->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="laporan_pelayanan_rekap.xls"');
		header('Cache-Control: max-age=0');

		$this->writer = PHPExcel_IOFactory::createWriter($this, 'Excel5');
		$this->writer->save('php://output'); 
    }
}

?>