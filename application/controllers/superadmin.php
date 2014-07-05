<?php
class Superadmin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$params = array('sectionName'=>'admin','templateName'=>'admin');
		$this->load->library('lib/Template', $params);
		$this->load->helper('Template');
	}
	public function index(){ 
		$user = $this->check_user();
		$content['menu'] = $this->menu_top();
	//	dump($content['menu']);
		$this->load->vars($content['menu']);

		$this->templateName = 'admin';
		$this->htmlVarFolder = 'htmlvar/';
		$this->viewPath = 'assets/templates/'.$this->templateName.'/';
		$ori_ci_view_path = $this->load->_ci_view_path;
		$this->load->_ci_view_path = TEMPLATES_PATH.$this->templateName."/html/";
		$this->load->view('index',$content['menu']);
		$this->load->_ci_view_path = $ori_ci_view_path;
	}
	public function com(){
		$numargs = func_num_args();
		$arg_list = func_get_args();
		$libName = GF_COM_PREFIX.$arg_list[0];
		$funcName = (isset($arg_list[1]))?$arg_list[1]:'index';
		$params = array();
		for ($i = 2; $i < $numargs; $i++) {
			$params[] = $arg_list[$i];
		}	
		$this->load->library(GF_COMPATH.$libName."/".$libName);
		return call_user_func_array(array($this->$libName, $funcName), $params);
	}
	
	private function check_user(){
		$this->load->library('auth/auth');
		$this->auth->restrict();
		@$user_id = $_SESSION['user_id'];
		@$nama = $_SESSION['nama'];

		$this->db->select('user_name, group_id');
		$this->db->from('c_user');
		$this->db->where('user_id',@$user_id);
		$hasil=$this->db->get()->row();
		//dump($this->db->last_query());
		// exit;
		if(!$hasil){
			echo "<script type=\"text/javascript\">alert('Maaf user anda belum diproses. Silahkan hubungi admin sistem.');location.href = '".BASE_URL."' + 'login'; </script>";
			exit;
		}

	}
	
	private function menu_top(){
		// $this->load->widget('panel_menu','library','admin');
		$data = array(
			'id_section'=>1
		);
		$this->load->widget('panel_menu','library');
		return $this->panel_menu->index($data);
	}
	
	
}

/* End of file com.php */
/* Location: ./system/application/controllers/cpanel/com.php */
