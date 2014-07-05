<?php
class Model__prototype extends CI_Model {
    function __construct ($params=array()){
        parent::__construct();
		$this->vtable_name = false;
		$this->vtable_prikey = false;
	}
    function set_params($params){
		$this->params = $params;
		$this->vtable_name = $this->params['table_name'];
		$this->vtable_prikey = $this->params['table_prikey'];
	}	

    function get_count_all($params){
		$this->db->where('name',$this->vtable_name);
		$manpro = $this->db->get('manpro_data')->row();
		$encodeddata = json_decode(@$manpro->encodeddata);
		$count = @$encodeddata?count($encodeddata->records):0;
		return $count;
	}
    function griddata($params = false){
		if(! $params){
			return array();
		}
		// dump($this->vtable_name);
		$this->db->where('name',$this->vtable_name);
		$manpro = $this->db->get('manpro_data')->row();
		$encodeddata = json_decode(@$manpro->encodeddata);
		if(@$encodeddata){
		    if(!@$params->post['oper']){
    		    $rows = array_slice($encodeddata->records,$params->start,$params->rows);
		    }else{
    		    $rows = $encodeddata->records;
		    }
		}else{
		    $rows = array();
		}
		return $rows;
	}
	
	function simpan($params=array()) {
		$this->db->where('name',$this->vtable_name);
		$manpro = $this->db->get('manpro_data')->row();
		$encodeddata = json_decode($manpro->encodeddata);

		$records = @$encodeddata->records?$encodeddata->records:array();
		$vtable_prikey = $this->vtable_prikey;
	
		switch ($params['post']['oper']){
		case 'add':
			$last_id = @$encodeddata->last_id?$encodeddata->last_id:0;
			$rows = $this->_doset($params);
			$rows[$this->vtable_prikey] = ($last_id + 1);
			$encodeddata->last_id = $rows[$this->vtable_prikey];
			$encodeddata->records[] = $rows;
    		$this->responce = array('result'=>'succes','message'=>'Data berhasil ditambahkan','oper'=>'add');
		break;
		case 'edit':
			$rows = $this->_doset($params);
			foreach($encodeddata->records as $key=>$row):
				if($row->$vtable_prikey == $params['post']['colModel'][$this->vtable_prikey]){
					foreach($rows as $cM => $postUpdate){
					    $row->$cM = $postUpdate;
					}
					$encodeddata->records[$key] = $row;
				}
			endforeach;
    		$this->responce = array('result'=>'succes','message'=>'Data berhasil ditubah','oper'=>'edit');
		break;
		case 'del':
			foreach($encodeddata->records as $key=>$row):
				if($row->$vtable_prikey == $params['post']['colModel'][$this->vtable_prikey]){
					unset($encodeddata->records[$key]);
				}
			endforeach;
		break;
		}
		
		$this->db->where('name','gridcmsuser');
		$this->db->set('encodeddata',json_encode($encodeddata));
		$this->db->update('manpro_data');
		return $this->responce;
	}
	function hapus() {
		return $this->simpan();
	}
	function _doset($params=array()) {
		$rows = array();
		foreach($params['post']['colModel'] as $key => $colModel){
			$rows[$key] = $colModel;
		}
		return $rows;
	}
}
