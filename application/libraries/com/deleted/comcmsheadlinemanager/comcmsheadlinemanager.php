<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Comcmsheadlinemanager {

	function Comcmsheadlinemanager(){
		$this->CI = &get_instance();	
		$this->classname = 'pubsettings';
	}
	
	function index(){
		$this->CI->db->select('*');
		$this->CI->db->from('public_settings');
		$row = $this->CI->db->get()->row();
		$data['running_text'] = $row->running_text;
		$data['runon_cek'] = '';
		if($row->runtext_status == 'on'):
			$data['runon_cek'] = 'checked="checked"';
		endif;
		$data['headline_menu'] = $row->headline_menu;
		// headline manager 
		$this->CI->db->select('a.*,b.component_name');
		$this->CI->db->from('public_menu a');
		$this->CI->db->join('public_component b','a.id_component = b.id_component');
		$this->CI->db->where('component_name','artikel');
		//$this->CI->db->where('status','on');
		$res = $this->CI->db->get()->result_array();
		$data['rubrik_options'] = '';
		foreach($res as $row):
			if($row['id_menu'] == $data['headline_menu']):
				$data['rubrik_options'] .= '<option value="'.$row['id_menu'].'" selected="selected">'.ucfirst($row['menu_name']).'</option>';
			else:
				$data['rubrik_options'] .= '<option value="'.$row['id_menu'].'">'.ucfirst($row['menu_name']).'</option>';
			endif;
		endforeach;
		$data['com_url'] = 'admin/com/cmsheadlinemanager/';
		$this->CI->load->com('comcmsheadlinemanager','view',array('name'=>'formsettings','data'=>$data));
	}
	
	function save(){
		$this->CI->load->library("form_validation");
		$this->CI->form_validation->set_rules("headline_menu","Headline Manager","required");
		$run_status = $this->CI->input->post('run_status');
		if(empty($run_status))$run_status='off';
		if($this->CI->form_validation->run()) {
			$this->CI->db->set("headline_menu",$this->CI->input->post('headline_menu'));
			$this->CI->db->set("running_text",$this->CI->input->post('run_text'));
			$this->CI->db->set("runtext_status",$run_status);
			$this->CI->db->update("public_settings");
			echo "sukses";
		}else{
			echo "<ul><li><b>Tidak berhasil disimpan</b> : <br />".validation_errors().$err."</li></ul>";
		}
	}
}

?>