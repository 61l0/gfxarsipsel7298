<?php
		// session_destroy();

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$params = array('sectionName'=>'login','templateName'=>'login');
		$this->load->library('lib/Template', $params);
		$this->load->helper('Template');
	}
	public function index(){
		$this->templateName = 'login';
		$this->htmlVarFolder = 'htmlvar/';
		$this->viewPath = 'assets/templates/'. $this->templateName.'/';
		$ori_ci_view_path = $this->load->_ci_view_path;
		$this->load->_ci_view_path = TEMPLATES_PATH.$this->templateName."/html/";
		$this->load->view('index');

		$this->load->_ci_view_path = $ori_ci_view_path;
	}
	public function dologin(){
		$this->load->library('auth/auth');
		$this->form_validation->set_rules('user_name',"Nama User",'trim|required');
		$this->form_validation->set_rules('user_password',"Password",'trim|required');
		if($this->form_validation->run() == false):
			$responce = array('result'=>'failed','message'=>'Username dan Password harus diisi');
		else:
			$this->load->library('auth');	
			$datalogin = array(
							'user_name'=>$this->input->post('user_name'),
							'user_password'=>$this->input->post('user_password')
			);
			if($this->auth->process_login($datalogin)==FALSE):  
				$responce = array('result'=>'failed','message'=>'Username atau Password yang anda masukkan salah');
				// echo $this->fungsi->warning('Maaf, username dan password yang Anda masukkan tidak cocok...',site_url());     
			else:		
				$responce = array('result'=>'succes','message'=>'Login anda diterima. Mohon menunggu..','section'=>$_SESSION['nama']);
			endif;
		endif;
				// dump($_SESSION);
		echo json_encode($responce);

	}
	public function out(){
		$this->db->delete('c_online',array('user_id'=>$_SESSION['user_id']));
		session_destroy();
		echo "<script type=\"text/javascript\">location.href = '".site_url()."' + 'login'; </script>";
	}
}

