<?php

class Calculate extends CI_Controller{
	public function retensi($tanggal='1980-01-01',$tahun='0',$fmt="Y-m-d")
	{
		//echo 'this is test.';
		$this->output->set_content_type('text/javascript');

		echo date($fmt, strtotime('+'.$tahun." year", strtotime($tanggal)) );
		
	}
}