<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Menumodel extends CI_Model
{
	function __construct (){
		parent::__construct();
	}
	function getMenu($level)
	{
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->like('menu_level',"+".$level."+");
		$this->db->where('menu_aktif',1);
		$this->db->order_by('menu_grup asc, menu_urutan asc');
		return $this->db->get();
	}
	function getMenuManagement()
	{
		$this->db->select('*');
		$this->db->from('menu');
		return $this->db->get();
	}
	function getMenuById($id)
	{
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->where('menu_id',$id);
		return $this->db->get();
	}
	function update($id,$data)
	{
		$this->db->where('menu_id',$id);
		$this->db->update('menu',$data);
	}
	function getArrayMenu($id,$active=true)
	{
		$this->db->select('menu_level');
		$this->db->from('menu');
		$this->db->where('menu_id',$id);
		if($active)
			$this->db->where('menu_aktif',1);
		$data = $this->db->get();
		if($data->num_rows>0)
		{
    		$row=$data->row();
    		$lev=$row->menu_level;
    		$arr=explode('+',$lev);
    		return remove_empty_values($arr);
    	}
    	else
    	{
    	   die();
    	}
	}
}
