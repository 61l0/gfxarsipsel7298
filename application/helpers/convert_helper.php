<?
	defined('BASEPATH') or die('Access Denied');
	
 	function mysqlToDate($date){	
		if(empty($date) || strpos($date,'0000') !== false) return '';
		return date(strpos($date,' ')?"d/m/Y H:i":"d/m/Y",strtotime($date));
	}

	function dateToMysql($date){	
		if(substr($date,4,1) == '-') return $date;
		if(empty($date)) return NULL;
		@list($_date,$_hour) = explode(' ',$date);
		@list($d,$m,$y) = explode('/',$_date);		
		$return = $y.'-'.$m.'-'.$d;
		if(!empty($_hour)) $return .= ' '.$_hour;
		return $return;
	}
	function convert_array_extend( $arr_ori, $arr_ext_arr = array() ) { 
            function rec_arr($arr_ori, $arr_ext){
	            foreach($arr_ext as $key=>$val){
//	            dump(array('rec',$arr_ext));
	                if(is_array($val)){
	                    $arr_ori[$key] =  rec_arr($arr_ori, $val);
	                }else{
	                    $arr_ori[$key] = $val;
	                }
	            }
	            return $arr_ori;
	        }
        
	    foreach($arr_ext_arr as $key_c=>$arr_ext){
	        foreach($arr_ext as $key=>$val){
//	            dump($obj_ext);
	            if(is_object($val)){
	                $arr_ori[$key] = rec_arr($arr_ori, $val);
	            }else{
	                $arr_ori[$key] = $val;
	            }
	        }
	    }
	    return $arr_ori;
	}
	function convert_is_assoc_array( $var ) { 
		//false if not an array or empty 
		if ( (!is_array($var)) || (!count($var)) ) return false; 
		
		foreach($var as $k=>$v) 
			if (! is_int($k)) return true; 
			
		return false; 
	}
	function convert_js_serialize($var, $recursed = false,$lev=1) { 
		$CI =& get_instance();
		$CI->load->helper('string');
		if (is_null($var) || is_resource($var)) return 'null'; 

		$js = ''; 
		
		//object or assoc. array 
		if (is_object($var) || convert_is_assoc_array($var)) { 
			//typecast to array in the case it could be an object 
			$props = (array)$var; 
				
			foreach($props as $k=>$v) { 
				//index values are preffixed with 'idx_' 
				if (is_int($k)) $k = "idx_$k"; 
				$js .= "\r".repeater("\t",$lev).$k.':'.convert_js_serialize($v, true,($lev+1)).","; 
			} 
			if (count($props)) 
				 $js = substr($js, 0, strlen($js)-1); 
			 
			 $js = "{".$js."\n".repeater("\t",$lev)."}"; 
			 if (! $recursed) $js = "($js)"; 
				 
		} elseif (is_array($var)) { 
			foreach($var as $v) 
				$js .= "\r".repeater("\t",$lev).convert_js_serialize($v, true,($lev+1)).","; 
			if (count($var)) 
				$js = substr($js, 0, strlen($js)-1); 
			$js = "[".$js."\r".repeater("\t",$lev)."]"; 
			
		} elseif (is_string($var)) { 
			// check if realy a string or a function
			if(substr($var, 0,8) === 'function'):
				$js = $recursed ? "$var" : "(new String($var))"; 
			else:
				//escape the string 
				$var = str_replace( array('"', "\n", "\r"), array('\\"', '\\n'), $var ); 
				$js = $recursed ? "\"$var\"" : "(new String(\"$var\"))"; 
			endif;
		
		} elseif (is_bool($var)) { 

			$var = ($var)?'true':'false'; 

			$js = $recursed ? $var : "(new Boolean($var))"; 
		
		} else { //should be an int or a float in theory        

			$js = $recursed ? $var : "(new Number($var))"; 
		} 

		return $js; 
	}
	function convert_arrayToObject($array) {
		if(!is_array($array)) {
			return $array;
		}
		
		$object = new stdClass();
		if (is_array($array) && count($array) > 0) {
		  foreach ($array as $name=>$value) {
			 $name = strtolower(trim($name));
			 if (!empty($name)) {
				$object->$name = convert_arrayToObject($value);
			 }else{
				$object->$name = array();
				$object->$name[$name] = convert_arrayToObject($value);
			 }
		  }
		  return $object; 
		}
		else {
		  return FALSE;
		}
	}
?>
