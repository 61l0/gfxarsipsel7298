<?php
class Kk_model extends CI_Model {
    function __construct (){
        parent::__construct();
        $this->table_name = false;
	}
    function getdata($datapost=false,$inputmodel=false){
	    foreach($inputmodel as $key_model=>$row_model){
            if(@$row_model['key']){
                if($inputmodel['query']['query_table']['where']){
                    $inputmodel['query']['query_table']['where'][1] = $datapost[$key_model];
                }
            }
        }
        foreach($inputmodel['query']['query_table'] as $type=>$param){
		    if (isset($param['params'])){
		        call_user_func_array(array($this->db,$param['method']),$param['params']);
		    }else{
			    call_user_func_array(array($this->db,$type),$param);
			}			
		}

        $data = $this->db->get()->row(); 
        return $data;       
    }    
    function simpan($type=false,$params=false){
        $this->query_action('update',$params);
        $this->db->update($this->table_name);
    }
    function query_action($type=false,$params=false){
	    if(isset($params['query']['query_'.$type])){
	        if(isset($params['query']['query_'.$type]['set'])){
	            foreach($params['query']['query_'.$type]['set'] as $key_set=>$val_set){
	                $set_name = $val_set['name'];
	                $set_field = $val_set['field'];
	                $set_value = @$val_set['value']?$val_set['value']:@$params['post'][$set_name];
		            if($set_value){
	                    $this->db->set($set_field,$set_value);
		            }
	            }
	        }
	        if(isset($params['query']['query_'.$type]['where'])){
                foreach($params['query']['query_'.$type]['where'] as $name=>$param_filter){
		            $filter_name = $param_filter['name'];
		            $filter_field = $param_filter['field'];
		            $filter_value = @$param_filter['value']?$param_filter['value']:@$params['post'][$filter_name];
			        if($filter_value){
				        call_user_func_array(array($this->db,'where'),array($filter_field,$filter_value));
			        }
		        }
	        }
	        if(isset($params['query']['query_'.$type]['from'])){
	            $this->table_name = $params['query']['query_'.$type]['from']; 
		    }
	    }
	}
}
