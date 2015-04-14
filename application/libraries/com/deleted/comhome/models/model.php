<?php
class Model extends CI_Model {
    function __construct (){
        parent::__construct();
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
		$data = @$this->db->get('c_menu a')->result();
		$menu['menu_list'] = '';
		foreach($data as $row):
			$child = $this->getChild(@$row->id_menu);
			$menu .= '<ul>';
			if(strlen($child)>0){
				$menu .= "<li><a  onclick=\"loadFragment('#main_panel_container','".site_url(@$row->menu_path)."');return false;\"><font color=\"black\">".@$row->menu_name."</font></a>";
				$menu .= '<ul>'.$child.'</ul>';
			}else{
				$menu .= "<li><a onclick=\"loadFragment('#main_panel_container','".site_url(@$row->menu_path)."');return false;\"><font color=\"black\">".@$row->menu_name."</font></a>";
			}
			$menu .= '</li></ul>';
		endforeach;
		return $menu;
	}
	function getChild($id_menu=false){
		$this->db->select('a.*,count(b.id_menu) as jml');
		$this->db->join('c_menu b','a.id_menu=b.id_parent','left');
		$this->db->where('a.id_parent',@$id_menu);
		$this->db->where('a.status','on');
		$this->db->group_by('a.id_menu');
		$this->db->order_by('a.urutan','asc');
		$data = $this->db->get('c_menu a')->result();
		$list_menu = '';
		foreach($data as $row):
			$child = $this->getChild(@$row->id_menu);
			if(strlen($child)>0){
				$list_menu .= "<li><a onclick=\"loadFragment('#main_panel_container','".site_url(@$row->menu_path)."');return false;\"><font color=\"white\">".@$row->menu_name."</font></a>";
				$list_menu .= "<ul>".$child."</ul>";
			} else {
				$list_menu .= "<li><a onclick=\"loadFragment('#main_panel_container','".site_url(@$row->menu_path)."');return false;\"><font color=\"white\">".@$row->menu_name."<font></a>";				
			}
			$list_menu .= "</li>";
		endforeach;
		return @$list_menu;
	}
}
?>