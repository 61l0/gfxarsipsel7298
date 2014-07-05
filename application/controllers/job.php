<?php

class Job extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_job');
	}

	function __createJob($ticket)
	{

	}
	function __createTicket($param)
	{

	}
	function __hasTicket()
	{

	}
	function __getProgress($jobId)
	{

	}
	function __setProgress($jobId,$percentage)
	{

	}
	function __isJobComplete($jobId)
	{

	}

	function __getToken($jobName)
	{
		return md5($jobName.$_SESSION['user_id'] . $this->browser->user_agent . date('Y-m-d'));
	}
	function __getJob($jobName)
	{
		return $this->m_job->getJobByToken($this->__getToken($jobName));
	}
	// function __createJob($jobName)
	// {
	// 	return $this->m_job->createJob($this->__getToken($jobName),$jobName);
	// }
	// WEB INTERFACE
	public function index()
	{
		$data = array(
			'job_queues' => array()
		);
		$this->load->view('job/index', $data);
	}
	
	// AJAX INTERFACE
	// public function create_job($jobName)
	// {
	// 	# code...
	// }
	public function delete_job($jobName)
	{
		# code...
	}
	public function do_job($jobName)
	{
		$token = $this->__getToken($jobName);
		$rs = array(
			'status' => 'JOB_EXECUTED',
			'token' => $token
		);
		$this->m_job->createJob($this->__getToken($jobName),$jobName);

		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		    //system( "cmd /c start php {$this->cli_path} {$route_cls}/{$method}/{$params} {$auth_token}" );
		} else {
		    //echo 'This is a server not using Windows!';
		}
		echo json_encode($rs);
	}
	public function display_progress($jobName)
	{
		echo $this->m_job->jobProgress($this->__getToken($jobName),$jobName);
	}
	public function job_complete($jobName)
	{
		# code...
	}
}