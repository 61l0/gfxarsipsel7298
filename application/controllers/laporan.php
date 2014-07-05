<?php
class Laporan extends CI_Controller{
	function pemusnahan($parameter)
	{
		echo base64_encode($parameter);
	}
}