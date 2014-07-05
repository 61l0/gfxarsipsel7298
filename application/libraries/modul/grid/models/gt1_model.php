<?php
class Gt1_model extends CI_Model {
    function __construct (){
        parent::__construct();
		$this->responce = array();	
		$this->table_name = false;
		$this->table_prikey = false;
		$this->table_parentkey = false;
		$this->params = false;
	}	
	
    function set_params($params){
	    $this->params = $params;
	    $this->table_prikey = $this->params['table_prikey'];
	    $this->table_parentkey = $this->params['table_parentkey'];
        if(@$params['multiGroup']){
            $startGroup = $params['startGroup'];
            $this->table_name = $startGroup;
            $this->query = $this->params[$startGroup]['query'];
        }else{
		    if(isset($this->params['table_name'])){
		        $this->table_name = $this->params['table_name'];
		    }  
		    $this->query = $this->params['query'];
		}
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
				if (isset($query_param['params'])){
			        	call_user_func_array(array($this->db,$query_param['method']),$query_param['params']);
			    	}else{
					call_user_func_array(array($this->db,$query_name),$query_param);
				}
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
	function query_table($parampost=false){
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
			            $param2 = @$parampost->post[$row_param[2]]?@$parampost->post[$row_param[2]]:"";
                        if(is_array($row_param)){
						// dump($param2);
                            if($row_param[0]=='on'){
													
									$new_param1 .= $row_param[1].'='.@$row_param[2];
								
                            }else if($row_param[0]=='and'){
								if($param2=='null'){
									$new_param1 .= ' and '.$row_param[1].' is '.@$param2;
								}else{
									$new_param1 .= ' and '.$row_param[1].'='.@$param2;
								}
                            }
                        }else{
                            $new_param[] = $row_param;
                        }        
			        }
			        $new_params = array($new_param[0],$new_param1,@$new_param[1]);
			        call_user_func_array(array($this->db,$param['method']),$new_params);
			    }else{
				    call_user_func_array(array($this->db,$type),$param);
				}
			}
		}
		 //dump($this->db->last_query());
	}
	
	function query_filter($parampost=false){
        if(@$this->query['query_filter']){
			foreach($this->query['query_filter'] as $name=>$param_filter){
			    $filter_name = $param_filter['name'];
			    $filter_field = $param_filter['field'];
			    $filter_type = $param_filter['type'];
			    $filter_value = @$param_filter['value']?$param_filter['value']:@$parampost->post[$filter_name];
			    if(@$this->table_parentkey){
			        if($name == $this->table_parentkey){
			            $filter_value = (@$filter_value)?$filter_value: 0;
			        }
		           }
			    if(@$param_filter['extra']){
				 call_user_func_array(array($this->db,$filter_type),array($filter_field,$filter_value,@$param_filter['extra']));
			    }else{
				 call_user_func_array(array($this->db,$filter_type),array($filter_field,$filter_value));
			    }	
			}
		}
	}
	
    function griddata($params = false,$config=false){
		if(! $params){
			return array();
		}
        $parentKey = $this->table_parentkey;
        $priKey = $this->table_prikey;
	    @$params->n_level++;
		if(@$this->params['multiGroup']){
		    $alias = @$this->params['alias'];
		    foreach($alias as $key_alias=>$row_alias){
		        if(substr_count(@$params->post[$priKey],$row_alias)==1){
		            $params->post[$priKey] = str_replace($row_alias,'',@$params->post[$priKey]);
		            $check = $this->check_data($params);
                    if($check==0){
                        if(@$this->params[$this->params['group'][($key_alias+1)]]['query']){
                            $this->query = $this->params[$this->params['group'][($key_alias+1)]]['query'];
                            $params->post[$priKey] = 0;
                            unset($this->table_name);
                            $this->table_name = $this->params['group'][($key_alias+1)];
                        }else{
                            $this->query = $this->params[$this->params['group'][($key_alias)]]['query'];
                            unset($this->table_name);
                            $this->table_name = $this->params['group'][$key_alias];
                        }
                    }else{
                        $this->query = $this->params[$this->params['group'][$key_alias]]['query'];
                        unset($this->table_name);
                        $this->table_name = $this->params['group'][$key_alias];
                    }
                }
		    }
		}
		$this->query_table($params);
		$this->query_filter($params);	
		$data = $this->db->get()->result();
// dump($this->db->last_query());
		$data = $this->preptreedata($data,@$params);
		return $data;
	}
    function check_data($params){
	    $this->query_table($params);
        $this->query_filter($params);	
        $data = $this->db->get()->result();
        return count($data);
    }
    function preptreedata($data = array(),$params){
        $n_level = @$params->n_level?$params->n_level:1;
        $parentKey = $this->table_parentkey;
        $priKey = $this->table_prikey;
        $alias = @$this->params['alias'];
        if(@$this->params['group']){
	        $arr_keys = array_keys($this->params['group'],$this->table_name);
        }else{
            $arr_keys = "";
        }
		foreach($data as $key=>$row){
			$data[$key]->n_level = $n_level;
            $row->$parentKey = @$params->post['nodeid']?$params->post['nodeid']:0;			
            if(isset($this->query['query_filter'][$parentKey])){
                $parentKey_field = $this->query['query_filter'][$parentKey]['field'];
                unset($this->query['query_filter'][$parentKey]);
            }
            if(@$this->params['multiGroup']){
                foreach($alias as $key_alias=>$row_alias){
		            if(substr_count(@$row->$priKey,$row_alias)==1){
		                $row->$priKey = str_replace($row_alias,'',$row->$priKey);
		                $x_alias = $row_alias;
		                unset($this->query);
                        $this->query = $this->params[$this->params['group'][$key_alias]]['query'];
                    }
		        }                
		    }
            $this->query_table($params);
		    if(@$parentKey_field){
		        $this->db->where($parentKey_field,$row->$priKey);
		    }
            
		    $data_child = $this->db->get()->result();
		    $jml_data_child = count($data_child);
		    if(@$this->params['multiGroup']){
		        $row->$priKey = $x_alias.$row->$priKey;
		    }
			if($jml_data_child > 0){
				$data[$key]->expanded = false;
				$data[$key]->isLeaf = false;
			}else{
				$data[$key]->expanded = false;	
    			if(@$this->params['multiGroup']){
    			    if(isset($this->query['relation'])){
				        unset($this->table_name);
				        $this->table_name=$this->query['relation'];
                    }
        		        $params->post[$priKey] = 0;
                        // =============================================
                        if(@$row->id_rinci){
        				    $params->post['id_rinci'] = $row->id_rinci;
                        }
                        if(@$row->id_skpd){
        				    $params->post['id_skpd'] = $row->id_skpd;
                        }
                        if(@$row->id_prokeg){
        				    $params->post['id_prokeg'] = $row->id_prokeg;
                        }
                            // =============================================
                        
			            $this->query = $this->params[$this->table_name]['query'];
			            $this->query_table($params);
			            $this->query_filter($params);
	                    $data_child2 = $this->db->get()->result();
	                    $jml_data_child2 = count($data_child2);
                        if(@$arr_keys[0]==0){
                            if($jml_data_child2 > 0){
                                $data[$key]->isLeaf = false;
                            }else{
                                $data[$key]->isLeaf = true;
                            }
                        }else{
                            $data[$key]->isLeaf = true;
                        }
				}else{
				    $data[$key]->isLeaf = true;
				}
			}
		}
		return $data;
	}

	function simpan($params=array()) {
		switch ($params['post']['oper']):
		// ====================== penamabahan data ==============================
		case 'add':
		    if(@$this->params['multiGroup']){
    		    unset($params['post']['colModel'][$this->table_prikey]);
    		    unset($this->table_prikey);
			    if(@$params['post'][$this->table_prikey]){
			        if(substr_count('akun',@$params['post'][$this->table_prikey])==1){
			            $this->table_prikey = 'id_rinci';
			        }else if(substr_count('detail',@$params['post'][$this->table_prikey])==1){
			            $this->table_prikey = 'id_detail';
			        }				    
			    }else{
			        $this->table_prikey = 'id_rinci';
			    }
			}
			$this->db->set($this->table_parentkey,$params['post'][$this->table_parentkey]);
			$this->_doset($params);
			$report = $this->db->insert($this->table_name);
			if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');
				$id = $this->db->insert_id();
				$this->query_table($params);
				$data = $this->db->where($this->table_prikey,$id)->get()->row();
				$this->responce['rows'] = @$data?$data:array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil ditambahkan':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'add');
			endif; 	
			break;
		// ====================== pengeditan data ==============================
		case 'edit':
			if(@$this->params['multiGroup']){
			    if(substr_count('akun',$params['post']['id_key'])==1){
			        unset($this->table_name);
			        $this->table_name = 'r_rinci_sample';
			    }
			    if(substr_count('detail',$params['post']['id_key'])==1){
			        unset($this->table_name);
			        $this->table_name = 'r_detail_sample';
			    }
			    $priKey = $this->table_prikey;
    		    unset($params['post']['colModel'][$this->table_prikey]);
                unset($this->table_prikey);
			    if(@$params['post'][$this->table_prikey]){
			        if(substr_count('akun',@$params['post'][$this->table_prikey])==1){
			            $this->table_prikey = 'id_rinci';
			        }else if(substr_count('detail',@$params['post'][$this->table_prikey])==1){
			            $this->table_prikey = 'id_detail';
			        }				    
			    }else{
			        $this->table_prikey = 'id_rinci';
			    }
			    $this->db->where($this->table_prikey,str_replace('detail','',$params['post'][$priKey]));
			}else{
			    $this->db->where($this->table_prikey,$params['post']['colModel'][$this->table_prikey]);
			}
			$this->_doset($params);
			$report = $this->db->update($this->table_name);
			if($report['result']):
				$this->responce = array('result'=>'succes','message'=>'Data berhasil diubah','oper'=>'edit');
				$this->query_table($params);
				$data = $this->db->where($this->table_prikey,$params['post']['colModel'][$this->table_prikey])->get()->row();
				$this->responce['rows'] = @$data?$data:array();
			else:
				$msg = ($report['message'] == '')?'Data tidak berhasil diubah':$report['message'];
				$this->responce = array('result'=>'failed','message'=>$msg,'oper'=>'edit');
			endif;
			break;
		// ====================== penghapusan data ==============================
		case 'del':
		    if(@$this->params['multiGroup']){
    		    	unset($params['post']['colModel'][$this->table_prikey]);
    		    	unset($this->table_prikey);
			if(@$params['post'][$this->table_prikey]){
			    if(substr_count('akun',@$params['post'][$this->table_prikey])==1){
			        $this->table_prikey = 'id_rinci';
			    }else if(substr_count('detail',@$params['post'][$this->table_prikey])==1){
			        $this->table_prikey = 'id_detail';
			    }				    
			}else{
			    $this->table_prikey = 'id_rinci';
			}
			$this->db->where($this->table_prikey,$params['post'][$this->table_prikey]);
		    }else{
			$this->db->where($this->table_prikey,$params['post']['colModel'][$this->table_prikey]);
		    }
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
