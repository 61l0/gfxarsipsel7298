<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(CLASSES_PATH.'PHPExcel.php');
require_once(CLASSES_PATH.'PHPExcel/IOFactory.php');

class Myexcel extends PHPExcel {

    var $cell = array();
    var $insertRow = array();
	var $excel;
	var $style;
	
    function Myexcel()
    {
		parent::__construct();
    }
	function writeRow($position='',$value = '',$option=array())
    {
		if(! is_array(@$position)):
			$checkMerge = explode(':',@$position);
			if(count($checkMerge) == 1):
				$this->getActiveSheet()->setCellValue(@$position, @$value);
			else:
				$this->getActiveSheet()->setCellValue($checkMerge[0], @$value);
				$this->getActiveSheet()->mergeCells(@$position);
			endif;
		else:
			$this->getActiveSheet()->setCellValueByColumnAndRow(@$position[0],@$position[1], @$value);
		endif;
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
		$this->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan_bulanan.xls"');
		header('Cache-Control: max-age=0');

		$this->writer = PHPExcel_IOFactory::createWriter($this, 'Excel5');
		$this->writer->save('php://output');
    }
}

?>
