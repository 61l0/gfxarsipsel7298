<?
	defined('BASEPATH') or die('Access Denied');
	
    function formHandler($key,$value='',$option='',$return = false){
		$data = array('id'=>$key,'name'=>$key);
		if(count(explode(':',$option['element'])) > 1 ):
			list($option['element'],$data['size']) = split(':',$option['element']);
		endif;
		$rules = explode('|',$option['rules']);
		
		$CI = &get_instance();
		$data['value'] = set_value($key,$value);
		
			//dump($option);die;
		
		switch ($option['element']):
		case 'input':
			$form = form_input($data);
			break;
		case 'dropdown':
			$CI->config->load('enum',TRUE);
			$option = $CI->config->item('enum');
			$option = ($option)?$option:array();
			$form = form_dropdown($key,$option[$key],$data['value']);
			break;
		default:
			$data['value'] = set_value($key,$value);
			$form = form_input($data);
			break;
		endswitch;
		if(in_array('required',$rules)) $form .= nbs().'*';
		if($return):
			return $form;
		else:
			echo $form;
		endif;
		//echo form_input($key,$value);
    }
    function dataHandler($key,$value='',$option='',$return = false){
		
		switch ($option['handler']):
		case 'enum':
		$CI = &get_instance();
			$CI->config->load('enum',TRUE);
			$option = $CI->config->item('enum');
			$option = ($option)?$option:array();
			$value = (@$option[$key][$value])?(@$option[$key][$value]):'<span style="color:red;">Unlisted Value</span>';
			break;
		case 'date':
			$value = mysqlToDate($value);
			break;
		default:
			break;
		endswitch;

		if($return):
			return $value;
		else:
			echo $value;
		endif;
		//echo form_input($key,$value);
    }
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
   
?>
