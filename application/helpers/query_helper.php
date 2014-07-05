<?
	defined('BASEPATH') or die('Access Denied');
	
	function query_getlimit($responce = false){
		if(! $responce ){
			return false;
		}
		if( $responce->records > 0 ) {
			$responce->rows = ($responce->rows > 0)?$responce->rows:1;
			$responce->total = ceil($responce->records/$responce->rows);
		} else {
			$responce->total = 0;
		}
		if ($responce->page > $responce->total) $responce->page=$responce->total;
		$responce->start = $responce->rows*$responce->page - $responce->rows; 
		// do not put $limit*( $post->page - 1)
		if ($responce->start<0) $responce->start = 0;
		return $responce;
	}
	
	function query_search($sopt){
	    $operator = array();
	    switch($sopt):
            case 'eq':
                $fn_filter = 'where';
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = "";
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'ne':
                $fn_filter = 'where';
                $operand = " != ";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'lt':
                $fn_filter = 'where';
                $operand = " < ";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'le':
                $fn_filter = 'where';
                $operand = " <= ";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'gt':
                $fn_filter = 'where';
                $operand = " > ";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'ge':
                $fn_filter = 'where';
                $operand = " >= ";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'bw':
                $fn_filter = 'where';
                $operand = " like"; 
                $suffix = "%";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "";
                $operator['suffix'] = $suffix;
                break;
            case 'bn':
                $fn_filter = 'where';
                $operand = " not like"; 
                $suffix = "%";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['suffix'] = $suffix;
                $operator['prefix'] = "";
                break;
            case 'in':
                $fn_filter = 'where_in';
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = "";
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'ni':
                $fn_filter = 'where_not_in';
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = "";
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'ew':
                $fn_filter = 'where';
                $operand = " like"; 
                $prefix = "%";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = $prefix;
                $operator['suffix'] = "";
                break;
            case 'en':
                $fn_filter = 'where';
                $operand = " not like"; 
                $prefix = "%";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "%";
                $operator['suffix'] = "";
                break;
            case 'cn':
                $fn_filter = 'where';
                $operand = " like"; 
                $prefix = "%";
                $suffix = "%";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = $prefix;
                $operator['suffix'] = $suffix;
                break;
            case 'nc':
                $fn_filter = 'where';
                $operand = " not like"; 
                $prefix = "%";
                $suffix = "%";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = $prefix;
                $operator['suffix'] = $suffix;
                break;
            case 'nu':
                $fn_filter = 'where';
                $operand = "";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
            case 'nn':
                $fn_filter = 'where';
                $operand = " !=";
                $operator['fn_filter'] = $fn_filter;
                $operator['operator'] = $operand;
                $operator['prefix'] = "";
                $operator['suffix'] = "";
                break;
        endswitch;
        return $operator;
	}
    
?>
