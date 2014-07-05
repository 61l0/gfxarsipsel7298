<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Commstlokasisimpan extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/mstlokasisimpan/';
		$params->lib['class_name'] = 'commstlokasisimpan';
		$params->lib['header_caption'] = 'Data Master &raquo; Lokasi Simpan';
		
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'lokasisimpan_model','alias'=>'com_model'));
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$params->gridlib['arr_colModel']['type']['editoptions']['value'] = array('depo'=>'Depo','rak'=>'Rak','box'=>'Box', 'folder'=>'Folder', 'rool'=>'Rool');
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
	
	function formaction(){
		$hasil = parent::formaction();
		$id_lokasi_simpan = $this->CI->input->post('id_lokasi_simpan'); 
		$id_parent	= $this->CI->input->post('id_parent');
		$name = $this->CI->input->post('name');
		$oper = $this->CI->input->post('oper');
		$type = $this->CI->input->post('type');

		$data = array( 'name' => $name,
					   'type' => $type,
					   'id_parent' => $id_parent );

		switch ($oper) {
				case 'add':
					switch ($type) {
						case 'depo':
							$r = $this->CI->db->select('a.id_lokasi_simpan id_depo,a.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->where('a.type',$type)
												 ->where('a.name',$name)
												 ->where('a.id_parent','0')
											     ->get()
											     ->row();

							$new_data = array();
							$new_data['path_name'] = $name;
							$new_data['path'] = $r->id_depo;
							$data['id_parent'] = '0';
							$data['id_lokasi_simpan'] = $r->id_depo;

							$this->CI->db->where('id_lokasi_simpan',$r->id_depo)->update('arsip_lokasi_simpan',$new_data);
							# code...
							break;
						case 'rak':
						case 'rool':
							$r = $this->CI->db->select('a.id_lokasi_simpan id_rak,b.id_lokasi_simpan id_depo,a.name rak,b.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
												 ->where('a.type',$type)
												 ->where('a.name',$name)
												 ->where('a.id_parent',$id_parent)
											     ->get()
											     ->row();
							$new_data = array();
							$new_data['path_name'] = $r->depo .'*'. $r->rak;
							$new_data['path'] = $r->id_depo . '*'. $r->id_rak;
							$data['id_lokasi_simpan'] = $r->id_rak;
							$this->CI->db->where('id_lokasi_simpan',$r->id_rak)->update('arsip_lokasi_simpan',$new_data);
							break;
						case 'box':
							$r = $this->CI->db->select('a.id_lokasi_simpan id_box,
														b.id_lokasi_simpan id_rak,
														c.id_lokasi_simpan id_depo,
														a.name box,
														b.name rak,
														c.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
												 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
												 ->where('a.type',$type)
												 ->where('a.name',$name)
												 ->where('a.id_parent',$id_parent)
											     ->get()
											     ->row();
							$new_data = array();
							$data['id_lokasi_simpan'] = $r->id_box;
							$new_data['path_name'] = $r->depo .'*'. $r->rak .'*' . $r->box;
							$new_data['path'] = $r->id_depo . '*'. $r->id_rak .'*' . $r->id_box;
							// print_r($r);
							// print_r($new_data);	
							$this->CI->db->where('id_lokasi_simpan',$r->id_box)->update('arsip_lokasi_simpan',$new_data);
							break;
						case 'folder':
							$r = $this->CI->db->select('a.id_lokasi_simpan id_folder,
														b.id_lokasi_simpan id_box,
														c.id_lokasi_simpan id_rak,
														d.id_lokasi_simpan id_depo,
														a.name folder,
														b.name box,
														c.name rak,
														d.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
												 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
												 ->join('arsip_lokasi_simpan d','d.id_lokasi_simpan = c.id_parent','left')
												 ->where('a.type',$type)
												 ->where('a.name',$name)
												 ->where('a.id_parent',$id_parent)
											     ->get()
											     ->row();
							$data['id_lokasi_simpan'] = $r->id_folder;
							$new_data['path_name'] = $r->depo .'*'. $r->rak .'*' . $r->box .'*' . $r->folder;
							$new_data['path'] = $r->id_depo . '*'. $r->id_rak .'*' . $r->id_box .'*' . $r->id_folder;

							$this->CI->db->where('id_lokasi_simpan',$r->id_folder)->update('arsip_lokasi_simpan',$new_data);
							break;
					}
					break;
				
				case 'edit':
					switch ($type) {
						case 'depo':
							# code...
							$data_edit = array(); 
							$data_edit['id_parent'] = '0';
							$data_edit['path_name'] = $name;
							$data_edit['path'] = $id_lokasi_simpan;

							$this->CI->db->where('id_lokasi_simpan',$id_lokasi_simpan)->update('arsip_lokasi_simpan',$data_edit);

							//UPDATE CHILDREN PATHNAME

							$rak_list = $this->CI->db->select('a.id_lokasi_simpan id_rak,b.id_lokasi_simpan id_depo,a.name rak,b.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
												 ->where('a.id_parent',$id_lokasi_simpan)
											     ->get()->result();

							foreach ($rak_list as $rk ) {
								$data_edit = array(); 
								$data_edit['path_name'] = $rk->depo .'*'. $rk->rak;
								$this->CI->db->where('id_lokasi_simpan',$rk->rak)->update('arsip_lokasi_simpan',$data_edit);


								// UPDATE PATH NAME FOREACH CHILDREN
								$box_list = $this->CI->db->select('a.id_lokasi_simpan id_box,
															b.id_lokasi_simpan id_rak,
															c.id_lokasi_simpan id_depo,
															a.name box,
															b.name rak,
															c.name depo')
													 ->from('arsip_lokasi_simpan a')
													 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
													 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
													 ->where('a.id_parent',$rk->id_rak)
												     ->get()->result();
								foreach ($box_list as $r) {
									$data_edit = array();
									$data_edit['path_name'] = $r->depo .'*'. $r->rak .'*' . $r->box ;

									$this->CI->db->where('id_lokasi_simpan',$r->id_box)->update('arsip_lokasi_simpan',$data_edit);

									// UPDATE FOLDER
									$folder_list = $this->CI->db->select('a.id_lokasi_simpan id_folder,
																			b.id_lokasi_simpan id_box,
																			c.id_lokasi_simpan id_rak,
																			d.id_lokasi_simpan id_depo,
																			a.name folder,
																			b.name box,
																			c.name rak,
																			d.name depo')
															 ->from('arsip_lokasi_simpan a')
															 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
															 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
															 ->join('arsip_lokasi_simpan d','d.id_lokasi_simpan = c.id_parent','left')
															 ->where('a.type','folder')
															 ->where('a.id_parent',$r->id_box)
															 ->get()->result();
									foreach ($folder_list as $f) {
										$data_edit = array();
										$data_edit['path_name'] = $f->depo .'*'. $f->rak .'*' . $f->box .'*' . $f->folder;

										$this->CI->db->where('id_lokasi_simpan',$f->id_folder)->update('arsip_lokasi_simpan',$data_edit);
									}
								}

							}				     
							break;
						
						case 'rak':
						case 'rool':
							$r = $this->CI->db->select('a.id_lokasi_simpan id_rak,b.id_lokasi_simpan id_depo,a.name rak,b.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
												 
												 ->where('a.id_lokasi_simpan',$id_lokasi_simpan)
											     ->get()
											     ->row();
							
							$data['id_parent'] = $r->id_depo;
							$data_edit = array(); 
							$data_edit['path_name'] = $r->depo .'*'. $r->rak;
							$data_edit['path'] = $r->id_depo . '*'. $r->id_rak;
							
							$this->CI->db->where('id_lokasi_simpan',$id_lokasi_simpan)->update('arsip_lokasi_simpan',$data_edit);
							// UPDATE PATH NAME FOREACH CHILDREN
							$box_list = $this->CI->db->select('a.id_lokasi_simpan id_box,
														b.id_lokasi_simpan id_rak,
														c.id_lokasi_simpan id_depo,
														a.name box,
														b.name rak,
														c.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
												 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
												 ->where('a.id_parent',$r->id_rak)
											     ->get()->result();
							foreach ($box_list as $r) {
								$data_edit = array();
								$data_edit['path_name'] = $r->depo .'*'. $r->rak .'*' . $r->box ;

								$this->CI->db->where('id_lokasi_simpan',$r->id_box)->update('arsip_lokasi_simpan',$data_edit);

								// UPDATE FOLDER
								$folder_list = $this->CI->db->select('a.id_lokasi_simpan id_folder,
																		b.id_lokasi_simpan id_box,
																		c.id_lokasi_simpan id_rak,
																		d.id_lokasi_simpan id_depo,
																		a.name folder,
																		b.name box,
																		c.name rak,
																		d.name depo')
														 ->from('arsip_lokasi_simpan a')
														 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
														 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
														 ->join('arsip_lokasi_simpan d','d.id_lokasi_simpan = c.id_parent','left')
														 ->where('a.type','folder')
														 ->where('a.id_parent',$r->id_box)
														 ->get()->result();
								foreach ($folder_list as $f) {
									$data_edit = array();
									$data_edit['path_name'] = $f->depo .'*'. $f->rak .'*' . $f->box .'*' . $f->folder;

									$this->CI->db->where('id_lokasi_simpan',$f->id_folder)->update('arsip_lokasi_simpan',$data_edit);
								}
							}				     
							break;
						case 'box':
							$r = $this->CI->db->select('a.id_lokasi_simpan id_box,
														b.id_lokasi_simpan id_rak,
														c.id_lokasi_simpan id_depo,
														a.name box,
														b.name rak,
														c.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
												 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
												 ->where('a.id_lokasi_simpan',$id_lokasi_simpan)
											     ->get()
											     ->row();
							$data_edit = array();
							$data_edit['path_name'] = $r->depo .'*'. $r->rak .'*' . $r->box;
							$data_edit['path'] = $r->id_depo . '*'. $r->id_rak .'*' . $r->id_box;



							$this->CI->db->where('id_lokasi_simpan',$id_lokasi_simpan)->update('arsip_lokasi_simpan',$data_edit);
							// UPDATE PATH NAME FOR EACH CHILDREN
							if(TRUE )
							{
								//echo 'HERE';
								// UPDATE path_name all the folder
								$folder_list = $this->CI->db->select('a.id_lokasi_simpan id_folder,
																		b.id_lokasi_simpan id_box,
																		c.id_lokasi_simpan id_rak,
																		d.id_lokasi_simpan id_depo,
																		a.name folder,
																		b.name box,
																		c.name rak,
																		d.name depo')
														 ->from('arsip_lokasi_simpan a')
														 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
														 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
														 ->join('arsip_lokasi_simpan d','d.id_lokasi_simpan = c.id_parent','left')
														 ->where('a.type','folder')
														 ->where('a.id_parent',$r->id_box)
														 ->get()->result();
								foreach ($folder_list as $r) {
									$data_edit = array();
									$data_edit['path_name'] = $r->depo .'*'. $r->rak .'*' . $r->box .'*' . $r->folder;
									//$data_edit['path'] = $r->id_depo . '*'. $r->id_rak .'*' . $r->id_box .'*' . $r->id_folder;

									$this->CI->db->where('id_lokasi_simpan',$r->id_folder)->update('arsip_lokasi_simpan',$data_edit);
								}
							}
							break;
						case 'folder':
							$r = $this->CI->db->select('a.id_lokasi_simpan id_folder,
														b.id_lokasi_simpan id_box,
														c.id_lokasi_simpan id_rak,
														d.id_lokasi_simpan id_depo,
														a.name folder,
														b.name box,
														c.name rak,
														d.name depo')
												 ->from('arsip_lokasi_simpan a')
												 ->join('arsip_lokasi_simpan b','b.id_lokasi_simpan = a.id_parent','left')
												 ->join('arsip_lokasi_simpan c','c.id_lokasi_simpan = b.id_parent','left')
												 ->join('arsip_lokasi_simpan d','d.id_lokasi_simpan = c.id_parent','left')
												 ->where('a.id_lokasi_simpan',$id_lokasi_simpan)
											     ->get()
											     ->row();
							$data_edit = array();
							$data_edit['path_name'] = $r->depo .'*'. $r->rak .'*' . $r->box .'*' . $r->folder;
							$data_edit['path'] = $r->id_depo . '*'. $r->id_rak .'*' . $r->id_box .'*' . $r->id_folder;

							$this->CI->db->where('id_lokasi_simpan',$id_lokasi_simpan)->update('arsip_lokasi_simpan',$data_edit);
							break;
						}
					break;

			}	
		$hasil = array('succes'=>true,'rows'=>$data);
		//$hasil = array_merge($hasil,$data);
		echo json_encode($hasil);
		die();
	}

	public function get_info($id_lokasi_simpan,$what='type')
	{
		// switch ($what) {
		// 	case 'type':
		// 		# code...
		// 		break;
		// 	case 'data':
		// 		# code...
		// 		break;
		// 	case 'path':
		// 		# code...
		// 		break;
		// 	case 'path_name':
		// 		# code...
		// 		break;	
		// 	default:
		// 		# code...
		// 		break;
		// }
		$row = array('data'=>$this->CI->db->where('id_lokasi_simpan',$id_lokasi_simpan)->get('arsip_lokasi_simpan')->row());
		echo json_encode($row);
		die();
	}
}