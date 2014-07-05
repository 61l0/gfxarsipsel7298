<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_DB_active_record extends CI_DB_active_record {
	var $using_triggers = true;
	var $triggers_folder = 'triggers/';

	
	function my_query($arr=array())
	{
		foreach($arr as $type=>$params){
			if (isset($params['method'])){
				call_user_func_array(array($this,$params['method']),$params['params']);
			}else{
				call_user_func_array(array($this,$type),$params);
			}
		}
		return $this;
	}
	function _check_trigger_exist($table = '')
	{
			$trigger_folder = APPPATH.$this->triggers_folder;
			$trigger_file = $trigger_folder.$table.EXT;
			return file_exists($trigger_file);
	}
	function _trigger_before($table = '', $data = array(),$act=false,$sql="")
	{
		$act .= "_before";
		$trigger_file = APPPATH.$this->triggers_folder.$table.EXT;
		require_once(APPPATH.'core/trigger'.EXT);
		require_once($trigger_file);
		// $report = array('result'=>false,'message'=>'');
		eval("
			\$trigger_class_before_$table = new \$table;
			\$report = array('result'=>true,'message'=>'before');
			if (method_exists(\$trigger_class_before_$table,'$act')){
				 \$report = \$trigger_class_before_$table->\$act(\$this,\$table,\$data,\$sql);
			}
		");
		return $report;
	}
	function _trigger_after($table = '', $data = array(),$act=false,$sql="")
	{
		$act .= "_after";
		$trigger_file = APPPATH.$this->triggers_folder.$table.EXT;
		require_once(APPPATH.'core/trigger'.EXT);
		require_once($trigger_file);
		// $report = array('result'=>true,'message'=>'');
		eval("
			\$trigger_class_after_$table = new \$table;
			\$report = array('result'=>true,'message'=>'afterdd');
			if (method_exists(\$trigger_class_after_$table,'$act')){
				 \$report = \$trigger_class_after_$table->\$act(\$this,\$table,\$data,\$sql);
			}
		");
		return $report;
	}
	function _do_trigger($table = '', $sql = NULL, $type = false)
	{
		$report = array('result'=>true,'message'=>'');
		$table = str_replace('`','',$table);
		$ar_where = array();
		$ar_set = array();
		foreach($this->ar_where as $key_where=>$val_where){
			$ar_where[str_replace('`','',$key_where)] = str_replace('`','',$val_where);
		}
		foreach($this->ar_set as $key_set=>$val_set){
			$ar_set[str_replace('`','',$key_set)] = str_replace('`','',$val_set);
		}
		if($this->using_triggers){
			if($this->_check_trigger_exist($table)){
				$data = array('ar_where'=>$ar_where,'ar_set'=>$ar_set);
				$this->_reset_write();
				$t_report = $this->_trigger_before($table,$data,$type,$sql);
				if(isset($t_report['extra'])){
					$data['extra'] = $t_report['extra'];
					unset($t_report['extra']);
				}
				if(! $t_report['result']) return $t_report;

				if(! $this->query($sql)){
					$report['result'] = false;
					return $report;
				}
				if($type == 'insert'){
					$data['insert_id'] = $this->insert_id();
					$report['insert_id'] = $this->insert_id();
				}
				$t_report = $this->_trigger_after($table,$data,$type,$sql);
				if(! $t_report['result']) return $t_report;
			
			}else{
				$this->_reset_write();
				if(! $this->query($sql)){
					$report['result'] = false;
				}
				if($type == 'insert'){
					$report['insert_id'] = $this->insert_id();
				}
			}
		}else{
			$this->_reset_write();
			if(! $this->query($sql)){
				$report['result'] = false;
			}
			if($type == 'insert'){
				$report['insert_id'] = $this->insert_id();
			}
		}
		return $report;
	}
	function insert($table = '', $set = NULL)
	{
		if ( ! is_null($set))
		{
			$this->set($set);
		}

		if (count($this->ar_set) == 0)
		{
			if ($this->db_debug)
			{
				return $this->display_error('db_must_use_set');
			}
			return FALSE;
		}

		if ($table == '')
		{
			if ( ! isset($this->ar_from[0]))
			{
				if ($this->db_debug)
				{
					return $this->display_error('db_must_set_table');
				}
				return FALSE;
			}

			$table = $this->ar_from[0];
		}

		$sql = $this->_insert($this->_protect_identifiers($table, TRUE, NULL, FALSE), array_keys($this->ar_set), array_values($this->ar_set));
		return $this->_do_trigger($table , $sql ,'insert');
	}
	function update($table = '', $set = NULL, $where = NULL, $limit = NULL)
	{
		// Combine any cached components with the current statements
		$this->_merge_cache();

		if ( ! is_null($set))
		{
			$this->set($set);
		}

		if (count($this->ar_set) == 0)
		{
			if ($this->db_debug)
			{
				return $this->display_error('db_must_use_set');
			}
			return FALSE;
		}

		if ($table == '')
		{
			if ( ! isset($this->ar_from[0]))
			{
				if ($this->db_debug)
				{
					return $this->display_error('db_must_set_table');
				}
				return FALSE;
			}

			$table = $this->ar_from[0];
		}

		if ($where != NULL)
		{
			$this->where($where);
		}

		if ($limit != NULL)
		{
			$this->limit($limit);
		}

		$sql = $this->_update($this->_protect_identifiers($table, TRUE, NULL, FALSE), $this->ar_set, $this->ar_where, $this->ar_orderby, $this->ar_limit);
		return $this->_do_trigger($table , $sql ,'update');

		// $this->_reset_write();
		// return $this->query($sql);
	}
	function delete($table = '', $where = '', $limit = NULL, $reset_data = TRUE)
	{
		$this->_merge_cache();

		if ($table == '')
		{
			if ( ! isset($this->ar_from[0]))
			{
				if ($this->db_debug)
				{
					return $this->display_error('db_must_set_table');
				}
				return FALSE;
			}

			$table = $this->ar_from[0];
		}
		elseif (is_array($table))
		{
			foreach ($table as $single_table)
			{
				$this->delete($single_table, $where, $limit, FALSE);
			}

			$this->_reset_write();
			return;
		}
		else
		{
			$table = $this->_protect_identifiers($table, TRUE, NULL, FALSE);
		}

		if ($where != '')
		{
			$this->where($where);
		}

		if ($limit != NULL)
		{
			$this->limit($limit);
		}

		if (count($this->ar_where) == 0 && count($this->ar_wherein) == 0 && count($this->ar_like) == 0)
		{
			if ($this->db_debug)
			{
				return $this->display_error('db_del_must_use_where');
			}

			return FALSE;
		}

		$sql = $this->_delete($table, $this->ar_where, $this->ar_like, $this->ar_limit);
		
		return $this->_do_trigger($table , $sql ,'delete');

		// if ($reset_data)
		// {
			// $this->_reset_write();
		// }

		// return $this->query($sql);
	}
}

