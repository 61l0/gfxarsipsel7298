<?php
class Model__prototypetree extends CI_Model {
    function __construct ($params=array()){
        parent::__construct();
		$this->vtable_name = false;
		$this->vtable_prikey = false;
	}
    function set_params($params){
		$this->params = $params;
		$this->vtable_name = $this->params['table_name'];
		$this->vtable_prikey = $this->params['table_prikey'];
		$this->vtable_parentkey = $this->params['table_parentkey'];	}	
    function get_count_all(){
		$this->db->where('name',$this->vtable_name);
		$manpro = $this->db->get('prototypetree')->row();
		$encodeddata = json_decode($manpro->encodeddata);
		$countdata = @$encodeddata?count($encodeddata->records):0;
		return $countdata;
	}
    function griddata($params = false){
		if(! $params){
			return array();
		}
		@$params->n_level++;
		$this->db->where('name',$this->vtable_name);
		$manpro = $this->db->get('prototypetree')->row();
		$encodeddata = json_decode($manpro->encodeddata);
		$record = @$encodeddata->records;
		if($record){
        foreach($record as $key=>$row){
                $arrGroup[$row->id_parent][] = $row;
	        }
	        $config = array(
                    'root'=> 0,
                    'start_level' => 1,
                    'parent_field' => 'id_parent',
                    'id_field' => 'id',
                    );
	        $data = $this->map_hirarki($arrGroup,$config);
	        $rows = $data; 
		}else{
		    $rows = array();
		}
		if(@$params->post['oper']){
		    $rows = $rows;
		}else{
		    $rows = $rows['rows'];
		}
//        dump($data);
		return $rows;
	}
	public function map_hirarki($arrGroup,$config=array()){ 
	    $root = $config['root'];
	    $parent_field = $config['parent_field'];
	    $id_field = $config['id_field'];
	    $start_level = $config['start_level'];
	    function set_child($arrGroup,$parent,$arr,$id_field,$n_level){
	        $n_level++;
            foreach($arrGroup[$parent] as $row_child){
                $row_child->n_level = $n_level;
                if($arr['info']['max_depth'] < $n_level){
                    $arr['info']['max_depth'] = $n_level;
                }
                $row_child->parent = $parent;
                $row_child->expanded = 'false';
                $row_child->isLeaf = (isset($arrGroup[$row_child->$id_field]))?"false":"true";
                $arr['rows'][]  = $row_child;
                if(isset($arrGroup[$row_child->$id_field])){
                    $arr = set_child($arrGroup,$row_child->$id_field,$arr,$id_field,$n_level);
                }
            }
            return $arr;
	    }
	    if(isset($arrGroup[$root])){
            $arr = array('info'=>array(),'rows'=>array());
            foreach($arrGroup[$root] as $parent=>$row){
                $row->n_level = $start_level;
                if(!isset($arr['info']['max_depth'])){
                    $arr['info']['max_depth'] = $start_level;
                }else{
                    if($arr['info']['max_depth'] < $row->n_level){
                        $arr['info']['max_depth'] = $row->n_level;
                    }
                }
            
                $row->parent = $parent;
                $row->expanded = 'false';
                $row->isLeaf = (isset($arrGroup[$row->$id_field]))?"false":"true";
                $arr['rows'][] = $row;
                if(isset($arrGroup[$row->$id_field])){
                    $arr = set_child($arrGroup,$row->$id_field,$arr,$id_field,$start_level);
                }
            }
            return $arr;
	    }else{
    	    return array();
	    }
	}
	function simpan($params=array()) {
		$this->db->where('name',$this->vtable_name);
		$manpro = $this->db->get('prototypetree')->row();
		$encodeddata = json_decode(@$manpro->encodeddata);

		$records = @$encodeddata->records?$encodeddata->records:array();
	
		$vtable_prikey = $this->vtable_prikey;
		switch ($params['post']['oper'] ){
		case 'add':
		    $params['row']['colModel'] = new stdClass;
			$last_id = @$encodeddata->last_id?$encodeddata->last_id:0;
			$rows = $this->_doset($params);
			$rows[$this->vtable_parentkey] = $params['post'][$this->vtable_parentkey];
			$rows[$this->vtable_prikey] = ($last_id + 1);

			$encodeddata->last_id = $rows[$this->vtable_prikey];
			$encodeddata->records[] = $rows;
			$message = 'Data berhasil ditambahkan';
			$oper = 'add';
		break;
		case 'edit':
			$rows = $this->_doset($params);
			foreach($encodeddata->records as $key=>$row):
				if($row->$vtable_prikey ==$params['post']['colModel'][$this->vtable_prikey]){
					foreach($rows as $cM => $postUpdate){
					    if($cM == $this->vtable_parentkey) continue;
					    $row->$cM = $postUpdate;
					}
					$encodeddata->records[$key] = $row;
				}
			endforeach;
			$message = 'Data berhasil diubah';
			$oper = 'edit';
			$rows=array();
		break;
		case 'del':
			foreach($encodeddata->records as $key=>$row):
				if($row->$vtable_prikey ==$params['post']['colModel'][$this->vtable_prikey]){
					// dump($key);
					// dump($encodeddata->records);
					unset($encodeddata->records[$key]);
					$encodeddata->records = array_values($encodeddata->records);
				}
			endforeach;
			$message = 'Data berhasil dihapus';
			$oper = 'del';
			$rows=array();
		break;
		}
		
#		dump(json_encode($encodeddata));
		$this->db->where('name',$this->vtable_name);
		$this->db->set('encodeddata',json_encode($encodeddata));
		$this->db->update('prototypetree');
		$this->responce = array('result'=>'succes','message'=>$message,'oper'=>$oper,'rows'=>$rows);
		return $this->responce;
	}
	function _doset($params=array()) {
		$rows = array();
		foreach($params['post']['colModel'] as $key => $colModel){
			$rows[$key] = $colModel;
		}
		return $rows;
	}
	function hapus() {
		return $this->simpan();
	}
	
}
