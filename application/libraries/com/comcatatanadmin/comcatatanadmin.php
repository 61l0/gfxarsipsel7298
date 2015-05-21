<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Comcatatanadmin extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/catatanadmin/';
		$params->lib['class_name'] = 'comcatatanadmin';
		$params->lib['header_caption'] = 'Catatan Admin &raquo; Catatan Masuk';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model_catatanadmin'));
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$status = $this->CI->input->post('status');
		
		$typecari = $this->CI->input->post('typecari');
		$cari_judul = $this->CI->input->post('judul');
		
		// if($status == 'masuk'){
		$id_user = $this->CI->model_catatanadmin->get_skpd($_SESSION['user_id']);
			// $params->gridlib['grid']['opt']['postData']['id_pengirim'] = $id_pengirim;
		// }	
		
		if($_SESSION['user_group'] == 6){
			unset($params->model['query']['query_filter']);
			$params->model['query']['query_filter']=array(
				'id_pengirim'=>array(
					'type'=>'where'
					,'field'=>'a.id_pengirim'
					,'name'=>'id_pengirim'
					,'value'=>$_SESSION['id_skpd']
					),
			);
			$params->model['query']['query_filter']=array(
				'id_pengirim'=>array(
					'type'=>'where'
					,'field'=>'a.id_penerima'
					,'name'=>'id_penerima'
					,'value'=>$id_user
					),
			);
		}
		if($status == 'all' || empty($status)){
			unset($params->model['query']['query_filter']);
			$params->model['query']['query_filter']=array(
				'id_pengirim'=>array(
					'type'=>'or_where'
					,'field'=>'a.id_penerima'
					,'name'=>'id_penerima'
					,'value'=>$id_user
					),
				'id_penerima'=>array(
					'type'=>'or_where'
					,'field'=>'a.id_pengirim'
					,'name'=>'id_pengirim'
					,'value'=>$id_user
					),
			);
		}
		elseif($status == 'masuk'){
			unset($params->model['query']['query_filter']);
			$params->model['query']['query_filter']=array(
				'id_pengirim'=>array(
					'type'=>'where'
					,'field'=>'a.id_penerima'
					,'name'=>'id_penerima'
					,'value'=>$id_user
					),

			);
		}elseif($status == 'keluar'){
			unset($params->model['query']['query_filter']);
			$params->model['query']['query_filter']=array(
				'id_penerima'=>array(
					'type'=>'where'
					,'field'=>'a.id_pengirim'
					,'name'=>'id_pengirim'
					,'value'=>$id_user
					),
			);		
		}else if($cari_judul != ""){
			if($typecari != 'instansi'){
				//if($cari_judul != ""){
					unset($params->model['query']['query_filter']);
					$params->model['query']['query_filter']=array(
						$cari_judul=>array(
							'type'=>'like'
							,'field'=>'a.'.$typecari
							,'name'=>'judul'// harus sesuai dengan yg di post
							,'extra'=>'after'
							//,'value'=>$cari_judul
							),
					);
				//}
			}
		}
	
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		// ============================================================
		//dropdown jenis skpd
		$this->com_name = $params->lib['class_name'];
		parent::__construct($params);
	}
	function griddata(){
		parent::griddata();
		// dump($this->CI->db->last_query());
	}
	
	function index_segments($params=false){
		parent::index_segments($params);	

		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'default','data'=>$this->content ,'return'=>true));		
	}			
	
    function comjs_features(){
        parent::comjs_features();
        $gridcomplete_config = array('name'=>'comjs_gridcomplete','return'=>true);
        $this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->lib['class_name'],'view',$gridcomplete_config);
		$this->content['comjs_features']['extra'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'comjs_extra','return'=>true));
        unset($this->content['grid']['toolbar']['word']);
        unset($this->content['grid']['toolbar']['excel']);
        unset($this->content['grid']['toolbar']['pdf']);
		unset($this->content['grid']['toolbar']['search']);
		unset($this->content['grid']['toolbar']['plus']);
	}
	
	function tambah_data(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = 'add';	
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'tambah_data','data'=>$this->content));
	}	
	function formaction(){

			// print_r($_FILES);
			// die();
		$oper = $this->CI->input->post('oper');
		$typepilih = $this->CI->input->post('typepilih');
		if($oper != 'del'){	

			if($typepilih == 'personal'){
				$this->CI->form_validation->set_rules('id_skpd','Instansi','trim|required');
				$this->CI->form_validation->set_rules('judul','Judul','trim|required');
			}else{
				//$this->CI->form_validation->set_rules('id_skpd','Instansi','trim|required');
				$this->CI->form_validation->set_rules('judul_umum','Judul','trim|required');
			}
			
			//$this->CI->form_validation->set_rules('uraian','Uraian','trim|required');
			
			if($this->CI->form_validation->run() == FALSE){
				$hasil = array('result'=>'failed','message'=>validation_errors(),'oper'=>$oper);
			}else{
				$id_pengirim = $_SESSION['id_skpd'];
				$hasil = $this->CI->model_catatanadmin->simpan(@$id_pengirim);
			}
		}else{
				$id_pengirim = $this->CI->model_catatanadmin->get_skpd($_SESSION['user_id']);
				$hasil = $this->CI->model_catatanadmin->simpan(@$id_pengirim);
		}

		// upload

		$this->CI->load->library('fileupload');
			
		$upload_path = FCPATH . 'assets/media/file/attachments/';

		// echo realpath($upload_path);
		$oper = $this->CI->input->post('oper') ;
		if ( $oper == 'add') 
		{
			//print_r($_FILES);

			if( $_FILES['attachment'] )
			{
				$ok = move_uploaded_file($_FILES['attachment']['tmp_name'], $upload_path . $_FILES['attachment']['name']);
				//$result = $this->CI->fileupload->handleUpload( $upload_path);
				$parent_id = $this->CI->db->insert_id();
				$attachment_for = 'catatan_admin';
				$filename;
				// $response = array(
				// 	'fullpath'	=> '',
				// 	'success'	=> TRUE
				// );
				if($ok)
				{
					$attachment = array(
						'parent_id' => $parent_id,
						'attachment_for' => $attachment_for,
						'filename' => $_FILES['attachment']['name'] ,
						'path' =>  $_FILES['attachment']['name'],
						'date_uploaded' => date('Y-m-d',time())
					);
					

					$this->CI->db->insert('arsip_attachment',$attachment);
					$attachment['id_attachment'] = $this->CI->db->insert_id();
				}
				//echo json_encode(array_merge($result,$attachment));	
			}
		}
		else if ($oper == 'edit') 
		{
			
			if( $_FILES['attachment'] )
			{
				//$new_name = 
				$ok = move_uploaded_file($_FILES['attachment']['tmp_name'], $upload_path . $_FILES['attachment']['name']);
				//$result = $this->CI->fileupload->handleUpload( $upload_path);
				$parent_id = $this->CI->input->post('id_catatan_admin');
				$attachment_for = 'catatan_admin';
				// $filename;
				// $response = array(
				// 	'fullpath'	=> '',
				// 	'success'	=> TRUE
				// );
				$exist = $this->CI->db->where('parent_id',$parent_id)
								  ->where('attachment_for',$attachment_for)
								  ->get('arsip_attachment')
								  ->num_rows() > 0;
				if($ok)
				{
					$attachment = array(
						'parent_id' => $parent_id,
						'attachment_for' => $attachment_for,
						'filename' => $_FILES['attachment']['name'] ,
						'path' =>  $_FILES['attachment']['name'],
						'date_uploaded' => date('Y-m-d',time())
					);
					
					if(!$exist)
					{
						$this->CI->db->insert('arsip_attachment',$attachment);
						$attachment['id_attachment'] = $this->CI->db->insert_id();
					}
					else
					{
						$this->CI->db->where('parent_id',$parent_id)
										  ->where('attachment_for',$attachment_for)
										  ->update('arsip_attachment',$attachment);

					}

					
				}
				//echo json_encode(array_merge($result,$attachment));	
			}
		}
		
		echo json_encode($hasil);
	}	
	function edit(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $this->content['id_catatan_admin'] = $this->CI->input->post('id_catatan_admin');
		 $this->content['data_edit'] = $this->CI->model_catatanadmin->get_data($this->content['id_catatan_admin']);
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'edit_data','data'=>$this->content));
	}	
	function view(){
		$hasil = $this->CI->model_catatanadmin->view($this->CI->input->post('id_catatan_admin'));
		$this->content['data'] = $hasil;
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'view_data','data'=>$this->content));
	}	
	function autocomplete(){
		$param1 = $this->CI->input->get('q');
		$param2 = $this->CI->input->get('type_cari');
		$id_group = $_SESSION['user_group'];
		$id_skpd = $_SESSION['id_skpd'];
		
		$responce = $this->CI->model_catatanadmin->autocomplete($param1,$param2, $id_group, $id_skpd);

		echo json_encode($responce);
	}					
}