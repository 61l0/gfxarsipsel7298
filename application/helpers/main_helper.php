<?php
	defined('BASEPATH') or die('Access Denied');

	function encodeURIComponent($string) {
	   $result = "";
	   for ($i = 0; $i < strlen($string); $i++) {
	      $result .= encodeURIComponentbycharacter(urlencode($string[$i]));
	   }
	   return $result;
	}
	function encodeURIComponentbycharacter($char) { if ($char == "+") { return "%20"; } if ($char == "%21") { return "!"; } if ($char == "%27") { return '"'; } if ($char == "%28") { return "("; } if ($char == "%29") { return ")"; } if ($char == "%2A") { return "*"; } if ($char == "%7E") { return "~"; } if ($char == "%80") { return "%E2%82%AC"; } if ($char == "%81") { return "%C2%81"; } if ($char == "%82") { return "%E2%80%9A"; } if ($char == "%83") { return "%C6%92"; } if ($char == "%84") { return "%E2%80%9E"; } if ($char == "%85") { return "%E2%80%A6"; } if ($char == "%86") { return "%E2%80%A0"; } if ($char == "%87") { return "%E2%80%A1"; } if ($char == "%88") { return "%CB%86"; } if ($char == "%89") { return "%E2%80%B0"; } if ($char == "%8A") { return "%C5%A0"; } if ($char == "%8B") { return "%E2%80%B9"; } if ($char == "%8C") { return "%C5%92"; } if ($char == "%8D") { return "%C2%8D"; } if ($char == "%8E") { return "%C5%BD"; } if ($char == "%8F") { return "%C2%8F"; } if ($char == "%90") { return "%C2%90"; } if ($char == "%91") { return "%E2%80%98"; } if ($char == "%92") { return "%E2%80%99"; } if ($char == "%93") { return "%E2%80%9C"; } if ($char == "%94") { return "%E2%80%9D"; } if ($char == "%95") { return "%E2%80%A2"; } if ($char == "%96") { return "%E2%80%93"; } if ($char == "%97") { return "%E2%80%94"; } if ($char == "%98") { return "%CB%9C"; } if ($char == "%99") { return "%E2%84%A2"; } if ($char == "%9A") { return "%C5%A1"; } if ($char == "%9B") { return "%E2%80%BA"; } if ($char == "%9C") { return "%C5%93"; } if ($char == "%9D") { return "%C2%9D"; } if ($char == "%9E") { return "%C5%BE"; } if ($char == "%9F") { return "%C5%B8"; } if ($char == "%A0") { return "%C2%A0"; } if ($char == "%A1") { return "%C2%A1"; } if ($char == "%A2") { return "%C2%A2"; } if ($char == "%A3") { return "%C2%A3"; } if ($char == "%A4") { return "%C2%A4"; } if ($char == "%A5") { return "%C2%A5"; } if ($char == "%A6") { return "%C2%A6"; } if ($char == "%A7") { return "%C2%A7"; } if ($char == "%A8") { return "%C2%A8"; } if ($char == "%A9") { return "%C2%A9"; } if ($char == "%AA") { return "%C2%AA"; } if ($char == "%AB") { return "%C2%AB"; } if ($char == "%AC") { return "%C2%AC"; } if ($char == "%AD") { return "%C2%AD"; } if ($char == "%AE") { return "%C2%AE"; } if ($char == "%AF") { return "%C2%AF"; } if ($char == "%B0") { return "%C2%B0"; } if ($char == "%B1") { return "%C2%B1"; } if ($char == "%B2") { return "%C2%B2"; } if ($char == "%B3") { return "%C2%B3"; } if ($char == "%B4") { return "%C2%B4"; } if ($char == "%B5") { return "%C2%B5"; } if ($char == "%B6") { return "%C2%B6"; } if ($char == "%B7") { return "%C2%B7"; } if ($char == "%B8") { return "%C2%B8"; } if ($char == "%B9") { return "%C2%B9"; } if ($char == "%BA") { return "%C2%BA"; } if ($char == "%BB") { return "%C2%BB"; } if ($char == "%BC") { return "%C2%BC"; } if ($char == "%BD") { return "%C2%BD"; } if ($char == "%BE") { return "%C2%BE"; } if ($char == "%BF") { return "%C2%BF"; } if ($char == "%C0") { return "%C3%80"; } if ($char == "%C1") { return "%C3%81"; } if ($char == "%C2") { return "%C3%82"; } if ($char == "%C3") { return "%C3%83"; } if ($char == "%C4") { return "%C3%84"; } if ($char == "%C5") { return "%C3%85"; } if ($char == "%C6") { return "%C3%86"; } if ($char == "%C7") { return "%C3%87"; } if ($char == "%C8") { return "%C3%88"; } if ($char == "%C9") { return "%C3%89"; } if ($char == "%CA") { return "%C3%8A"; } if ($char == "%CB") { return "%C3%8B"; } if ($char == "%CC") { return "%C3%8C"; } if ($char == "%CD") { return "%C3%8D"; } if ($char == "%CE") { return "%C3%8E"; } if ($char == "%CF") { return "%C3%8F"; } if ($char == "%D0") { return "%C3%90"; } if ($char == "%D1") { return "%C3%91"; } if ($char == "%D2") { return "%C3%92"; } if ($char == "%D3") { return "%C3%93"; } if ($char == "%D4") { return "%C3%94"; } if ($char == "%D5") { return "%C3%95"; } if ($char == "%D6") { return "%C3%96"; } if ($char == "%D7") { return "%C3%97"; } if ($char == "%D8") { return "%C3%98"; } if ($char == "%D9") { return "%C3%99"; } if ($char == "%DA") { return "%C3%9A"; } if ($char == "%DB") { return "%C3%9B"; } if ($char == "%DC") { return "%C3%9C"; } if ($char == "%DD") { return "%C3%9D"; } if ($char == "%DE") { return "%C3%9E"; } if ($char == "%DF") { return "%C3%9F"; } if ($char == "%E0") { return "%C3%A0"; } if ($char == "%E1") { return "%C3%A1"; } if ($char == "%E2") { return "%C3%A2"; } if ($char == "%E3") { return "%C3%A3"; } if ($char == "%E4") { return "%C3%A4"; } if ($char == "%E5") { return "%C3%A5"; } if ($char == "%E6") { return "%C3%A6"; } if ($char == "%E7") { return "%C3%A7"; } if ($char == "%E8") { return "%C3%A8"; } if ($char == "%E9") { return "%C3%A9"; } if ($char == "%EA") { return "%C3%AA"; } if ($char == "%EB") { return "%C3%AB"; } if ($char == "%EC") { return "%C3%AC"; } if ($char == "%ED") { return "%C3%AD"; } if ($char == "%EE") { return "%C3%AE"; } if ($char == "%EF") { return "%C3%AF"; } if ($char == "%F0") { return "%C3%B0"; } if ($char == "%F1") { return "%C3%B1"; } if ($char == "%F2") { return "%C3%B2"; } if ($char == "%F3") { return "%C3%B3"; } if ($char == "%F4") { return "%C3%B4"; } if ($char == "%F5") { return "%C3%B5"; } if ($char == "%F6") { return "%C3%B6"; } if ($char == "%F7") { return "%C3%B7"; } if ($char == "%F8") { return "%C3%B8"; } if ($char == "%F9") { return "%C3%B9"; } if ($char == "%FA") { return "%C3%BA"; } if ($char == "%FB") { return "%C3%BB"; } if ($char == "%FC") { return "%C3%BC"; } if ($char == "%FD") { return "%C3%BD"; } if ($char == "%FE") { return "%C3%BE"; } if ($char == "%FF") { return "%C3%BF"; } return $char; }

	function verbose_log($content,$type="lib",$path="grid")
	{
		// $data  = "-------------------------------------------------------------------------------------------------------------------". "\r\n";
	 //    $data .= date('d/m/Y H:i:s') . "\r\n";
	 //   	$data .= $content . "\r\n";
	 //   	$data .= "-------------------------------------------------------------------------------------------------------------------". "\r\n\r\n";

	 //   	$filename = APPPATH .'logs/'. $type ;

	 //   	if(!is_dir($filename))
	 //   	{
	 //   		@mkdir($filename);
	 //   	}

	 //   	$filename .= '/' . $path . '.log';
	 //   	//die($filename);
	 //   	file_put_contents($filename, $data, FILE_APPEND);
	}

	function tgl_srt_to_mysql($date){
		$dt = explode('-', $date);

		return "$dt[2]-$dt[1]-$dt[0]";
	}
	function bln_indo($bln){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$bln_index = preg_replace('/^0/', '', $bln);
		$bln_index = $bln_index - 1;
		if(!isset($BulanIndo[$bln_index]))
			return $bln;
		return $BulanIndo[(int)$bln-1];
	}
	function tgl_indo($date,$zero=false){
	
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
	if(!$zero)
		$tgl = preg_replace('/^0/', '', $tgl);
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}
	function orminus($str){
	if(strlen(trim($str)) > 0 )
		return $str;
	else
		return '-';
	} 
	function Dump($variable,$is_exit=false){
		echo '<pre>';
		var_dump($variable);
		echo '</pre>';
		if($is_exit) exit;
	}
	
	function PopulateForm(){
		$CI = &get_instance();
		$post = array();
		foreach(array_keys($_POST) as $key){
			$post[$key] = $CI->input->post($key);
		}
		return $post;
	}
	
	function now($isFull=false){
		return date($isFull?"Y-m-d H:i:s":"Y-m-d");
	}
	
	function getPosts($var){
		$post = array();
		$CI = &get_instance();
		foreach($var as $v){
		  $post[$v] = $CI->input->post($v);
		}
		return $post;
	}
	
	function hr(){
		return "<hr size=0 color=#000066 />";
	}
	
	function script($fileName){
		return "<script language='JavaScript' type='text/javascript' src='".base_url().JS_PATH.$fileName."'></script>";
	}
	
	function segment($index){
		$CI = &get_instance();
		return $CI->uri->segment($index);
	}
	
	function setError($message,$varName='errorMessage'){	
		$CI = &get_instance();
		$CI->session->set_userdata($varName, $message);
	}
	
	function showErrors($varName='errorMessage'){
		$CI = &get_instance();
		if($varName == 'errorMessage')
		 echo validation_errors('<div class="errorMessage">','</div>');
		$err = $CI->session->userdata($varName);
		if($err)	
		 echo errorMessage($err);
		$CI->session->unset_userdata($varName);
	}
	function errorMessage($err){
		return '<div class="errorMessage">'.$err.'</div>';
	}
	function setLang($lang=''){
            $CI = &get_instance();
            $CI->session->set_userdata('lang', $lang);
	}
	function getLang(){
            $CI = &get_instance();
            $lang = @$CI->session->userdata('lang');
            $lang = ($lang)?$lang:$CI->config->item('languange');
            return $lang;
	}
	function lineLang($language_key=false){
		$CI = &get_instance();
		return $CI->lang->line($language_key);
	}
	function goButton($id,$label,$url){
		return form_button($id, $label,'id="'.$id.'" onClick="document.location=\''.site_url($url).'\'"' );
	}
	
	if(!function_exists('json_encode')){
		function json_encode($variable){
			include_once('application/libraries/JSON.php');
			$json = new Services_JSON;
			return $json->encode($variable);
		}
	}	
	
	/*
	 * createImageThumbnail
	 *
	 * membuat image thumbnail 
	 *
	 * @access	public
	 * @param	$path string, width  int, height int
	 * @return	optional string
	*/

	function createImageThumbnail($width =60,$height=50,$config){
		$CI = &get_instance();
		if(!is_array($config)) {
		$config = array();
		}
		$config['image_library'] = 'gd2';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$CI->load->library('image_lib', $config);
		if(!$CI->image_lib->resize()):
		return $CI->image_lib->display_errors();
		endif;
	}	
	/*
	 * getIntroText
	 *
	 * memotong string text sesuai batas max yang dikehendaki  
	 *
	 * @access	public
	 * @param	$text string,  $max int , default 100
	 * @return	string
	*/
	function getIntroText($text, $max =100){
		$intro = '';
		$text = strip_tags($text);
		if(strlen($text)>$max){
				$intro = substr($text,0,$max);
				$pos = strlen($intro) - strpos(strrev($intro), " "); 
				$intro = substr($text,0, $pos);
				if(strlen($intro) <= $max)$intro .= "...";
		}else{
			$intro =$text;
		}
		return $intro;
	}
	/*
	 * getStatusComponent
	 *
	 * mengecek status On/Off Component (Modul) 
	 *
	 * @access	public
	 * @param	$text string 
	 * @return	boolean
	*/
	function cekComponentStatus($nama_komponen = '', $cekby = 'menu_name'){
		$CI = &get_instance();
		$CI->db->select('*');
		$CI->db->from('public_menu a');
		$CI->db->join('public_component b', 'a.id_component = b.id_component');
		if($cekby == 'menu_name'):
			$CI->db->like('menu_name', $nama_komponen );
		else:
			$CI->db->where('b.component_name', $nama_komponen );
		endif;
		$row = $CI->db->get()->row_array();
		//echo $row['menu_name']."--".$row['status'].'<br />';
		if(!empty($row)):
			if($row['status']=='on'):
				return true;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	
	function MakeDir($dir){
		$dir = explode('/', $dir);
		$tmp = "";
		foreach($dir as $rec){
			if(!empty($rec)){
				$dest = $rec.'/';
				$tmp .= $dest;
				if(!is_dir($tmp)){
					mkdir($tmp, 0755,true);
				}
			}
		}
	}