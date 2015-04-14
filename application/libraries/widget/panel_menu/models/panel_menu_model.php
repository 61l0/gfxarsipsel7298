<?php
class Panel_menu_model extends CI_Model {
    function __construct (){
        parent::__construct();
	}	
    function get_menu(){
		$menu['menuUrl'] = site_url('admin/menu');
		$menu['user_name'] = $_SESSION['user_name'];
		$this->db->where('id_group',$_SESSION['user_group']);
		$hasil=$this->db->get('c_group')->row_array();
//		dump($_SESSION['user_group']);
		$menu['group_name'] = @$hasil['group_name'];
//		 $id_skpd = $_SESSION['id_skpd'];
//		 $this->db->where('id_skpd',$id_skpd);
//		 $skpd=$this->db->get('q_skpd')->row_array();
//		 dump($skpd);
//		if(!$hasil){
//			echo "<script type=\"text/javascript\">alert('Maaf user anda belum diproses. Silahkan hubungi admin sistem.');location.href = '".BASE_URL."' + 'login'; </script>";
//		}
		$menu['skpd'] = @$hasil['group_name'];
		$this->db->select('a.*,count(a.id_menu) juml');
		$this->db->from('c_menu a');
		$this->db->join('c_menu_acl c','c.id_menu=a.id_menu');
		$this->db->where('a.id_parent',0);
		$this->db->where('c.id_group',$hasil['id_group']);
		$this->db->where('a.status','on');
//		$this->db->where('a.keterangan',$hasil['section_name']);
		$this->db->group_by('a.id_menu');
		$this->db->order_by('a.menu_index','asc');
		$data = $this->db->get()->result();
//		 dump($this->db->last_query());
		$menu['menu_list'] = "";
		
		foreach($data as $row):
			$child = $this->_getChild($row->id_menu);
			$active = ($row->id_menu==1) ? 'active' : 'pasive' ;
				$cls = 'menu-'. $row->id_menu;

			if($hasil['group_name']=="superadmin"){ @$hasil['group_name'] = "admin";}

			if(strlen($child)>0){
				$menu['menu_list'] .= "<li>
				<div class=\"$cls\" id=\"mnav".$row->id_menu."\" class=\"".$active."\"><a onclick=\"loadFragment('#main_panel_container','".site_url($row->menu_path)."');return false;\"><span class=\"pmn\">
				<img src=\"assets/templates/".@$hasil['group_name']."/resources/img/common/".$row->menu_icon."\" /></span><span class=\"mn\">".$row->menu_name."</span><div class=\"cb\"></div></a></div>";
				$menu['menu_list'] .= '<ul>'.$child.'</ul>';
			}else{
				$menu['menu_list'] .= "<li>
				<div class=\"$cls\" id=\"mnav".$row->id_menu."\" class=\"".$active."\"><a onclick=\"loadFragment('#main_panel_container','".site_url($row->menu_path)."');getActiveNav(".$row->id_menu.");return false;\"><span class=\"pmn\">
				<img src=\"assets/templates/".@$hasil['group_name']."/resources/img/common/".$row->menu_icon."\" /></span><span class=\"mn\">".$row->menu_name."</span><div class=\"cb\"></div></a></div>";
			}
			$menu['menu_list'] .= '</li>';
		endforeach;
//		dump($menu['menu_list']);
		return $menu;
	}	
	private function getMenuGroup(){
		$arr_menu = array();
		if($_SESSION['user_group'] == 1):
			return $arr_menu;
		endif;
		$this->db->select('*');
		$this->db->from('c_menu');
		$res = $this->db->get()->result_array();
		if(!empty($res)):
			foreach($res as $row):
				$arr_menu[] = $row['id_menu'];
			endforeach;
		endif;
		return $arr_menu;
	}
	function _getChild($id_menu,$id_parent=''){
//	    dump($id_menu);
		$this->db->select('a.*,count(a.id_menu) juml');
		$this->db->from('c_menu a');
		$this->db->join('c_menu_acl c','c.id_menu=a.id_menu');
		$this->db->where('a.id_parent',$id_menu);
		$this->db->where('a.status','on');
		$this->db->where('c.id_group',$_SESSION['user_group']);
		$this->db->group_by('a.id_menu');
		$this->db->order_by('a.menu_index','asc');
		$data = $this->db->get()->result();
		$list_menu = '';
		foreach($data as $row):
			$child = $this->_getChild($row->id_menu,$id_menu);
			
			
			if(strlen($child)>0){			
				$list_menu .= "<li><a onclick=\"loadFragment('#main_panel_container','".site_url($row->menu_path)."');return false;\">".$row->menu_name."</a>";
				$list_menu .= '<ul>'.$child.'</ul>';
			}else{
				$list_menu .= "<li><a onclick=\"loadFragment('#main_panel_container','".site_url($row->menu_path)."');getActiveNav(".$id_parent.");return false;\">".$row->menu_name."</a>";
			}
			
			$list_menu .= '<div class="sp-sub-nav"></div></li>';
		endforeach;
		return $list_menu;
	}	
}
