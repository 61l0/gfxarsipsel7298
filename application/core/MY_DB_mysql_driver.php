<?php
 function full_url()
{
   $ci=& get_instance();
   $return = $ci->config->site_url().$ci->uri->uri_string();
   if(count($_GET) > 0)
   {
      $get =  array();
      foreach($_GET as $key => $val)
      {
         $get[] = $key.'='.$val;
      }
      $return .= '?'.implode('&',$get);
   }
   return $return;
}  
class MY_DB_mysql_driver extends CI_DB_mysql_driver
{
	
	function query($sql, $binds = FALSE, $return_object = TRUE) {

		
		// $request_uri = full_url();

	 //    $CI =& get_instance();
	 //    $filename = $CI->uri->segment(1). '_' .$CI->uri->segment(2). '_' . $CI->uri->segment(3) . '.log';
	   
	 //    $filename = APPPATH . 'logs/db/'. $filename;
	   
	 //    $data  = "-------------------------------------------------------------------------------------------------------------------". "\r\n";
	 //    $data .= date('d/m/Y H:i:s') . "\r\n";
	 //   	$data .= 'REQ : ' .$request_uri . "\r\n\r\n";
	 //   	$data .= 'SQL : ' . $sql . "\r\n";
	 //   	$data .= "-------------------------------------------------------------------------------------------------------------------". "\r\n\r\n";


		// file_put_contents($filename, $data,FILE_APPEND);	    
	 //   unset($filename);

	    return parent::query( $sql, $binds, $return_object );
	}
}