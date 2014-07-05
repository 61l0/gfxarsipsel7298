<?php

class m_job extends CI_Model{
	var $table = 'arsip_job';
	
	public function getJobByToken($token)
	{
		return $this->db->select('*')->where('token',$token)->get($this->table)->row();
	}
	public function createJob($token,$jobName)
	{
		if(!$this->jobExists($token))
			$this->db->insert($this->table,array('token'=>$token,'name'=>$jobName));
		return $this->getJobByToken($token);
	}
	public function jobExists($token)
	{
		return $this->db->select('job_id')->where('token',$token)->get($this->table)->num_rows() > 0;
	}
	//////////
	public function getJobByName($jobName)
	{
		return $this->db->select('*')->where('name',$jobName)->get($this->table)->row();
	}
	public function getJobById($jobId)
	{
		return $this->db->select('*')->where('job_id',$jobId)->get($this->table)->row();
	}
	
	public function jobProgress($token)
	{
		return $this->db->select('progress')->where('token',$token)->get($this->table)->row()->progress;
	}
	public function jobProgressUpdate($jobName,$percentage)
	{
		return $this->db->set('progress',$percentage)->where('name',$jobName)->update($this->table);
	}
}