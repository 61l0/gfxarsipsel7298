<?php

class ComSidebar {

	function ComSidebar(){
		$this->CI =& get_instance();
	}
	
	function index($id_menu=100){	 // 100 = default-> Dashboard	
			$arr_menu_group = $this->getMenuGroup();
			$this->CI->db->select('a.*,count(b.id_menu) juml');
			$this->CI->db->from('c_menu a');
			$this->CI->db->join('c_menu b','a.id_menu=b.id_parent','left');
			$this->CI->db->group_by('a.id_menu');
			$this->CI->db->where('a.id_parent',$id_menu);
			$this->CI->db->where('a.status','on');
			if(is_array($arr_menu_group) AND !empty($arr_menu_group)):
				$this->CI->db->where_in('a.id_menu', $arr_menu_group);
			endif;
			$this->CI->db->order_by('a.menu_index','asc');
			$data = $this->CI->db->get()->result();
			//dump($data);
			$menu_sidebar = "";
			if(count($data) > 0){
				$menu_sidebar .=  '<script type="text/javascript">
					$(".sidebar").show();
					$(".content-box").css("margin","-3px 5px 0 215px");
					</script>
				';
			}else{
				$menu_sidebar .=  '<script type="text/javascript">
					$(".sidebar").hide();
					$(".content-box").css("margin","-3px 5px 0 10px");
					</script>
				';
			}
			foreach($data as $row){
				$child = $this->getChild($row->id_menu);
				if(strlen($child)>0){
					$menu_sidebar .= "<li> <a href=\"javascript:void(0)\">".$row->menu_name."</a>";
					$menu_sidebar .= "<ul>".$child."</ul>";
					$menu_sidebar .= "</li>";
				}else{
					$menu_sidebar .= "<li> <a href=\"javascript:void(0)\">".$row->menu_name."</a></li>";
				}
			}
			$menu_sidebar .= "</ul>";
		//}
		
		echo $menu_sidebar;
	}
	
	function getChild($id_menu){
		$arr_menu_group = $this->getMenuGroup();
		$this->CI->db->select('a.*,count(b.id_menu) juml');
		$this->CI->db->from('c_menu a');
		$this->CI->db->join('c_menu b','a.id_menu=b.id_parent','left');
		$this->CI->db->group_by('a.id_menu');
		$this->CI->db->where('a.id_parent',$id_menu);
		$this->CI->db->where('a.status','on');
		if(is_array($arr_menu_group) AND !empty($arr_menu_group)):
			$this->CI->db->where_in('a.id_menu', $arr_menu_group);
		endif;
		$this->CI->db->order_by('a.menu_index','asc');
		$data = $this->CI->db->get()->result();
		$list_menu = '';
		foreach($data as $i => $row):
			$list_menu .= "<li><a id=m".$row->id_menu." href=\"javascript:void(0)\" onClick=\"loadFragment('#main_panel_container','".site_url($row->menu_path)."'); getActiveSidebar(".$row->id_menu.");return false;\">".$row->menu_name."</a></li>";
						
		endforeach;
		return $list_menu;
	}
	
	function getDateToDay(){
		$this->CI->load->library('lib/datetimeclass');
		$tanggal = $this->CI->datetimeclass->GetFullDateWithDay(date('Y-m-d')); 
		return $tanggal;
	}
	
	function getMenuGroup(){
		$arr_menu = array();
		if($this->CI->session->userdata('user_group') == 1):
			return $arr_menu;
		endif;
		$this->CI->db->select('*');
		$this->CI->db->from('c_menu');
#		$this->CI->db->where('id_group',$this->CI->session->userdata('user_group'));
		$res = $this->CI->db->get()->result_array();
		if(!empty($res)):
			foreach($res as $row):
				$arr_menu[] = $row['id_menu'];
			endforeach;
		endif;
		return $arr_menu;
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
