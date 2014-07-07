<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Commstkdmasalah extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/mstkdmasalah/';
		$params->lib['class_name'] = 'commstkdmasalah';
		$params->lib['header_caption'] = 'Data Master &raquo; Kode Masalah';
		
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		// ============================================================
		$this->content_default['segments']['head'] = $this->CI->load->com($params->lib['class_name'],'view',array('name'=>'default','data'=>@$this->content ,'return'=>false));	
		
		parent::__construct($params);
	}
    function comjs_features(){
        parent::comjs_features();
        $gridcomplete_config = array('name'=>'comjs_gridcomplete_tree','return'=>true);
        $this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$gridcomplete_config);

        $extra_config = array('name'=>'comjs_extra','return'=>true);
        $this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->lib['class_name'],'view',$extra_config);

        unset($this->content['grid']['toolbar']['word']);
        unset($this->content['grid']['toolbar']['excel']);
        unset($this->content['grid']['toolbar']['pdf']);
        
	}
	function formaction()
	{
		$oper = $this->CI->input->post('oper');
		$old_data ;
		$old_path_str;
		$old_path = array();
		
		if($oper == 'edit')
		{
			$id_kode_masalah = $this->CI->input->post('id_kode_masalah');
			$old_data = $this->CI->db->where('id_kode_masalah',$id_kode_masalah)
									->get('arsip_kode_masalah')
									->row();
		}
		$r  = parent::formaction(true);
		if( $oper == 'del')
		{
			echo json_encode($r['data']);
			die();
		}

		$id_kode_masalah = $r['data']['rows']->id_kode_masalah;

		$actual_data = $this->CI->db->where('id_kode_masalah',$id_kode_masalah)
									->get('arsip_kode_masalah')
									->row();
		
		$parent_id = $actual_data->id_parent;
		$new_level     = 1;
		$new_path  = array();

		if($parent_id){
			$new_path[] = $actual_data->kode;
			if($oper == 'edit')
			{
				$old_path[] = $old_data->kode;
			}
		}	
		$new_path_str = $actual_data->kode;
		if($oper == 'edit')
		{
			$old_path_str = $old_data->kode;
		}
		while($parent_id)
		{
			$parent = $this->CI->db->where('id_kode_masalah',$parent_id)
									->get('arsip_kode_masalah')
									->row();
			$parent_id = $parent->id_parent;
			//if($parent_id)
			if($oper == 'edit')
			{
				$old_path[] = $parent->kode;
			}
			$new_path[] = $parent->kode;
			$new_level += 1;  
		} 

		

		if(count($new_path) > 0 )
		{
			$new_path_reverse = array_reverse($new_path);
			$new_path_str = implode('*', $new_path_reverse);
		}
		
		if($oper == 'edit')
		{
			if(count($old_path) > 0 )
			{
				$old_path_reverse = array_reverse($old_path);
				$old_path_str = implode('*', $old_path_reverse);
			}
		}
		$new_data = array(
			'id_parent' => $actual_data->id_parent? $actual_data->id_parent : '0',
			'level' => $new_level,
			'path' => $new_path_str
		);
		// print_r($new_data);

		// die();

		$this->CI->db->where('id_kode_masalah',$id_kode_masalah)
					 ->update('arsip_kode_masalah',$new_data);

		
		if( $oper == 'edit')
		{
			// DO ALL RECURSIVE EDIT
			$path_chk = $old_path_str .'*';
			$need_update = $this->CI->db->like('path',$path_chk)->get('arsip_kode_masalah')->result_object();

			foreach($need_update as $d)
			{
				$new_path = str_replace($path_chk, $new_path_str.'*', $d->path);
				$new_data_path = array(
					'path' => $new_path
				);
				$this->CI->db->where('id_kode_masalah',$d->id_kode_masalah)
						 ->update('arsip_kode_masalah',$new_data_path);
			}
			// print_r($need_update);
			// die();
		}

		$r['data']['rows']->parent_id = $new_data['parent_id'];	
		$r['data']['rows']->level = $new_data['level'];	
		$r['data']['rows']->path = $new_data['path'];	

		echo json_encode($r['data']);
		die();
	}
}	
?>
