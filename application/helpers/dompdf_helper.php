<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function load_dompdf() 
{
    require_once("dompdf/dompdf_config.inc.php");
    return new DOMPDF();
}