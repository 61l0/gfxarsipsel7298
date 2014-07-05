<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Web extends CI_Controller {
	function __construct(){
		parent::__construct();
		$params = array('sectionName'=>'web','templateName'=>'web');
		$this->load->library('lib/Template', $params);
		$this->load->helper('Template');
	}
	public function index(){ 
		$this->load->library('lib/datetimeclass');
		$data['tanggal'] = $this->datetimeclass->GetFullDateWithDay(date('Y-m-d')); 
		$data['menu_list'] = $this->getmenu();
		$this->templateName = 'web';
		$this->htmlVarFolder = 'htmlvar/';
		$this->viewPath = 'assets/templates/'.$this->templateName.'/';
		$ori_ci_view_path = $this->load->_ci_view_path;
		$this->load->_ci_view_path = TEMPLATES_PATH.$this->templateName."/html/";
		$this->load->view('index',$data);
		$this->load->_ci_view_path = $ori_ci_view_path;

	}
	
	function getmenu(){
		$this->db->select('a.*,count(b.id_menu) as jml');
		$this->db->join('c_menu b','a.id_menu=b.id_parent',false);
		$this->db->join('c_menu_acl d','d.id_menu=a.id_menu');
		$this->db->join('c_group c','c.id_group=d.id_group');
		$this->db->where('c.section_name','public');
		$this->db->where('a.status','on');
		$this->db->where('a.id_parent',0);
		$this->db->group_by('a.id_menu');
		$this->db->order_by('a.menu_index','asc');
		$data = $this->db->get('c_menu a')->result();
		// dump($this->db->last_query());
		$menu = '';
		foreach($data as $row):
			$child = $this->getChild(@$row->id_menu);
			// dump($child);
			// $menu .= '<ul>';
			if(strlen($child)>0){
			// if(@$row->count>0){
				$menu .= "<li><a  onclick=\"loadFragment('#main_panel_container','".site_url(@$row->menu_path)."');return false;\">".$row->menu_name."</a>";
				$menu .= '<ul>'.$child.'</ul>';
			}else{
				$menu .= "<li><a onclick=\"loadFragment('#main_panel_container','".site_url(@$row->menu_path)."');return false;\">".@$row->menu_name."</a>";
			}
			$menu.= '</li>';
			// $menu.= '</li></ul>';
		endforeach;
		return @$menu;
	}
	function getChild($id_menu=false){
		$this->db->select('a.*,count(b.id_menu) as jml');
		$this->db->join('c_menu b','a.id_menu=b.id_parent','left');
		$this->db->where('a.id_parent',@$id_menu);
		$this->db->where('a.status','on');
		$this->db->group_by('a.id_menu');
		$this->db->order_by('a.menu_index','asc');
		$data = $this->db->get('c_menu a')->result();
		$list_menu = '';
		foreach($data as $row):
			$child = $this->getChild($row->id_menu);
			if(strlen($child)>0){
				$list_menu .= "<li><a onclick=\"loadFragment('#main_panel_container','".site_url($row->menu_path)."');return false;\">".$row->menu_name."</a>";
				$list_menu .= "<ul>".$child."</ul>";
			} else {
				$list_menu .= "<li><a onclick=\"loadFragment('#main_panel_container','".site_url($row->menu_path)."');return false;\">".$row->menu_name."</a>";				
			}
			$list_menu .= "</li>";
		endforeach;
		return $list_menu;
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
		// dump(array($this->$libName, $funcName));
		// dump($params);
		return call_user_func_array(array($this->$libName, $funcName), $params);
	}
	

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */

// =======================================================================================================


