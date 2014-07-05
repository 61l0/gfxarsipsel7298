<?php
class G1_model extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->responce = array();	
		$this->table_name = false;
		$this->table_prikey = false;
		$this->params = false;
		$this->com_name = false;
	}	
	
    function set_params($params){
		$this->params = $params;
		$this->table_name = $this->params['table_name'];
		$this->table_prikey = $this->params['table_prikey'];
		@$this->com_name = $this->params['com_name'];
		$this->query = @$this->params['query'];
		
	}	
	function get_dropdown($params_arr = array(),$valueArray=false){
		$result = array();
		foreach($params_arr as $key=>$params){
		    $field_value = $params['field_value'];
		    $field_label = $params['field_label'];

		    $this->db->select($field_value.' as data_value,'.$field_label.' as data_label',false);
		    $this->db->from($params['table_name']);
		    if(isset($params['db_query'])){
		        foreach($params['db_query'] as $query_name=>$query_param){
					call_user_func_array(array($this->db,$query_name),$query_param);
		        }
		    }
		    $data = $this->db->get()->result();
		    $result[$key] = array('options'=> new stdClass,'default'=>false);
		    foreach($data as $row){
		        $value = $row->data_value;
		        $label = $row->data_label;

			    if(!$result[$key]['default']){
				    $result[$key]['default'] = $value;
			    }
			    if($valueArray==false){
			        $result[$key]['options']->$value = $label;
			    }else{
                    $result[$key]['options']->$value = array('label'=>$label,'value'=>$value);			
			    }
		    }
		}
		return $result;
	}
	private function query_table($params){
		if(!@$this->query['query_table']){
			if(isset($params['table_name'])) $this->db->from($this->table_name.' a');
		}else{
			foreach($this->query['query_table'] as $type=>$param){
			    $new_param = array();
			    $new_param1 = "";
			    if (isset($param['params'])){
			        call_user_func_array(array($this->db,$param['method']),$param['params']);
			    }else if(isset($param['arr_params'])){
			        foreach($param['arr_params'] as $row_param){
			            $param2 = @$params->post[$row_param[2]]?@$params->post[$row_param[2]]:"";
                        		if(is_array($row_param)){
                            			if($row_param[0]=='on'){
                                			$new_param1 .= $row_param[1].'='.$row_param[2];
                           			}
						if($row_param[0]=='and'){
                                			$new_param1 .= ' and '.$row_param[1].'='.$param2;
                            			}
						if($row_param[0]=='and_like'){
							if($row_param[3] == 'after'){
                                				$new_param1 .= " and ".$row_param[1]." like "."'".$param2."%'";
							}else if($row_param[3] == 'before'){
                                				$new_param1 .= ' and '.$row_param[1].' like %'.$param2;
							}else if($row_param[3] == '' || $row_param[3] == 'both'){
                                				$new_param1 .= ' and '.$row_param[1].' like %'.$param2.'%';
							}
                            			}
                        		}else{
                            			$new_param[] = $row_param;
                        		}        
			        }
			        $new_params = array($new_param[0],$new_param1,@$new_param[1]);
					// dump($new_params);
			        call_user_func_array(array($this->db,$param['method']),$new_params);
			    }else{
			    	if($type == 'or_like' && is_array($param[0]))
			    	{
			    		foreach ($param as $prm_like) {
			    			call_user_func_array(array($this->db,$type),$prm_like);
			    		}
			    	}
			    	else
				    	call_user_func_array(array($this->db,$type),$param);
				}
			}
		}
		
	}	
    function get_count_all($params=false){
    	//echo 'HERE';
       // print_r($this->params);
        //die();
        if(is_array($this->params['query_count']))
        {
        	foreach($this->params['query_count'] as $type=>$param){
				//if($type == 'label') continue;
				if (isset($param['params']))
				{
					//echo 'HERE';
					//print_r($param['params']);
					//$this->db->$param['method']()
			        call_user_func_array(
			        	array( $this->db, $param['method'] ),
			        					  $param['params']
			        	);
			    }
			    else
			    {
					call_user_func_array(array($this->db,$type),$param);
				}
			}

			$this->query_filter($params);
    		//echo $this->db->_compile_select();
    //     	if(is_array($this->params['query']['query_filter']))
    //     	{

    //     		// print_r($this->params['query']['query_filter']);
    //     		// die();
    //     		//$this->query_filter($params);
    //     		foreach($this->params['query']['query_filter'] as $field => $item){
					
				// 	$this->db->where($item['field']);
				// }
    //     	}
			//echo $this->db->_compile_select() . "\n";
        	$count =  $this->db->get()->row()->count;
        	//echo "\n$count\n";
        	return $count;
        }

		$this->query_table($params);
		$this->query_filter($params);
		if(!@$this->query['query_count']){
			//echo $this->db->_compile_select();
			//die();
			$countdata = count($this->db->get()->result());
		}else{
			foreach($this->query['query_count'] as $type=>$param){
				if($type == 'label') continue;
				call_user_func_array(array($this->db,$type),$param);
			}
			$label = $this->query['query_count']['label'];
			$data = $this->db->get()->row();
			$countdata = $data->$label;
		}
		return $countdata;
	}
	function query_filter($parampost){
		if(@$this->query['query_filter']){
			foreach($this->query['query_filter'] as $name=>$param_filter){
				//echo $name;

			    $filter_name = @$param_filter['name'];
			    $filter_field = $param_filter['field'];
			    $filter_type = $param_filter['type'];
			    $filter_value = isset($param_filter['value'])?$param_filter['value']:@$parampost->post[$filter_name];
			    if($name == $this->table_prikey){
			        $filter_value = (@$filter_value)?$filter_value:0;
			    }
			    if(@$param_filter['extra']){
				call_user_func_array(array($this->db,$filter_type),array($filter_field,$filter_value,@$filter_extra));
			    }else{
					call_user_func_array(array($this->db,$filter_type),array($filter_field,$filter_value));
			    }
			}
		}
		if(@$parampost->post['_search'] == 'true'){
		    if(@$parampost->post['filters'] != FALSE){
			$filters = json_decode(@$parampost->post['filters']);
                	$this->search($filters);
		    }else{
			$obj = new stdClass;
                	$obj->groupOp = "AND";
                	$obj->filters->rules->op = @$parampost->post['searchOper'];
                	$obj->filters->rules->field = @$parampost->post['searchField'];
                	$obj->filters->rules->data = @$parampost->post['searchString'];
		        $this->search($obj);
		    }
		}
		// dump($this->db->last_query());
	}
	private function search($filters=false){
		$this->load->helper('query_helper');
		foreach(@$filters->filters as $rule){
			$sopt = query_search($rule->op);
			if($filters->groupOp == "OR")
			{
				if($sopt['fn_filter'] == 'where'){
					$sopt['fn_filter'] = "or_".$sopt['fn_filter'];
				}
			}
			$data = explode(';',$rule->data);
			if(count($data)>1){
				$this->db->$sopt['fn_filter']($rule->field.@$sopt['operator'],$data);
			}else{
				$this->db->$sopt['fn_filter']($rule->field.@$sopt['operator'],@$sopt['prefix'].$rule->data.@$sopt['suffix']);
			}
			if(@$filters->groups){
				// dipersiakan untuk sub query
			}   
		}
	}
	
    function griddata($params = false){

		if(! $params){
			return array();
		}
		$this->query_table($params);
		

		//echo 'HERE';
		$this->query_filter($params);		
		
		if(! @$params->post['oper']){
		    $this->db->limit($params->rows,$params->start);
		}
        //$sql = $this->db->_compile_select();		
		return $this->db->get()->result();
		//dump($this->db->last_query());
		//exit();
		//return $data;
	}
	
	function simpan($params=array()) {
		switch ($params['post']['oper']):
		// ====================== penamabhan data ==============================
		case 'add':		    
		    $this->query_action('insert',$params);
			$this->_doset($params);
			$report = $this->db->insert($this->table_name);
			if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');
				$data = $this->db->where($this->table_prikey,$params['post']['colModel'][$this->table_prikey])->get($this->table_name)->row();
			    $this->responce['rows'] = @$data?$data:array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil ditambahkan':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'add');
			endif;
			
			break;
		// ====================== pengeditan data ==============================
		case 'edit':
		    $this->query_action('update',$params);
			$this->_doset($params);
			$this->db->where($this->table_prikey,$params['post']['colModel'][$this->table_prikey]);
			$report = $this->db->update($this->table_name);
			if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');
				$data = $this->db->where($this->table_prikey,$params['post']['colModel'][$this->table_prikey])->get($this->table_name)->row();
			    $this->responce['rows'] = @$data?$data:array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil diubah':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'edit');
			endif;
			break;
		// ====================== penghapusan data ==============================
		case 'del':
		    $this->query_action('delete',$params);
			$this->db->where($this->table_prikey,$params['post']['colModel'][$this->table_prikey]);
			$report = $this->db->delete($this->table_name);
			if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil dihapus','oper'=>'del');
				$this->responce['rows'] = array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil dihapus':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'del');
			endif;
			break;
		// ====================== tidak ada oper ==============================
		default:

			$this->responce = array('result'=>'failed','message'=>'Cannot identify oper type','oper'=>$oper);
		endswitch;

		return $this->responce;
	}
	function _doset($params=array()) {
		foreach($params['post']['colModel'] as $key => $colModel){
			if(isset($this->table_prikey)){
				if($key == $this->table_prikey) continue;
			}
			$this->db->set($key,$colModel);
		}
	}
	function query_action($type=false,$params=false){
	    if(isset($this->query['query_'.$type])){
	        if(isset($this->query['query_'.$type]['set'])){
	            foreach($this->query['query_'.$type]['set'] as $key_set=>$val_set){
	                $set_name = $val_set['name'];
	                $set_field = $val_set['field'];
	                $set_value = @$val_set['value']?$val_set['value']:@$params['post'][$set_name];
		            if($set_value){
	                    $this->db->set($set_field,$set_value);
		            }
	            }
	        }
	        if(isset($this->query['query_'.$type]['where'])){
                foreach($this->query['query_'.$type]['where'] as $name=>$param_filter){
		            $filter_name = $param_filter['name'];
		            $filter_field = $param_filter['field'];
		            $filter_type = $param_filter['type'];
		            $filter_value = @$param_filter['value']?$param_filter['value']:@$params->post[$filter_name];
			        if($filter_value){
				        call_user_func_array(array($this->db,$filter_type),array($filter_field,$filter_value));
			        }
		        }
	        }
	        if(isset($this->query['query_'.$type]['from'])){
	            $this->table_name = $this->query['query_'.$type]['from']; 
		    }
	    }
	}
	function hapus() {
		return $this->simpan();
	}
}
