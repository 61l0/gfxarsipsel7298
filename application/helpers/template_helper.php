<?
	defined('BASEPATH') or die('Access Denied');
	
    function baseHref(){
        $CI = &get_instance();
        return $CI->template->baseHref;
    }
    function htmlVar($name=false,$data=false){
        $CI = &get_instance();
        return $CI->template->loadHtmlVar($name,$data);
    }
	if(!function_exists('loadCom')){
		function loadCom(){
			$numargs = func_num_args();
			$arg_list = func_get_args();
			$libName = $arg_list[0];
			$funcName = $arg_list[1];
			$params = array();
			for ($i = 2; $i < $numargs; $i++) {
				$params[] = $arg_list[$i];
			}
			
			$CI = &get_instance();
			//if( ! isset($CI->$libName)):
				$CI->load->library('com/'.$libName,'',$libName);
			///endif;
			return call_user_func_array(array($CI->$libName, $funcName), $params);
		}
	}
	if(!function_exists('loadComCI')){
		function loadComCI(){
			$numargs = func_num_args();
			$arg_list = func_get_args();
			$libName = $arg_list[0];
			$funcName = $arg_list[1];
			$params = array();
			for ($i = 2; $i < $numargs; $i++) {
				$params[] = $arg_list[$i];
			}
			
			$CI = &get_instance();
			if( ! isset($CI->$libName)):
				$CI->load->library('com/'.$libName);
			endif;
			return call_user_func_array(array($CI->libName, $funcName), $params);
		}
	}
	function getThemes(){
        $CI = &get_instance();
        $CI->db->select('template_dir');
		$CI->db->from('public_template');
		$CI->db->where('status', 'on');
		$template = $CI->db->get()->row();
		return $template->template_dir;
    }

/*if(!function_exists('loadCom')){
	function loadCom(){
		$numargs = func_num_args();
		$arg_list = func_get_args();
		$libName = $arg_list[0];
		$funcName = $arg_list[1];
		$params = array();
		for ($i = 2; $i < $numargs; $i++) {
			$params[] = $arg_list[$i];
		}
		
		$CI = &get_instance();
		if( ! isset($CI->$libName)):
			$CI->load->library($libName);
		endif;
		return call_user_func_array(array($CI->$libName, $funcName), $params);
	}
}*/
    
?>
