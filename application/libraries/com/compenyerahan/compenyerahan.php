<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Compenyerahan extends Grid{
	
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/penyerahan/';
		$params->lib['class_name'] = 'compenyerahan';
		$params->lib['header_caption'] = 'Penyerahan';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'penyerahan_model','alias'=>'com_model'));
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$typecari = $this->CI->input->post('typecari');
		
		$cari_judul = $this->CI->input->post('judul');

		
		$filter_id_skpd = $this->CI->input->post('id_skpd');
		
	
			
		if($_SESSION['user_group'] == 6){
			unset($params->model['query']['query_filter']);
				$params->model['query']['query_filter']=array(
					'id_skpd'=>array(
						'type'=>'where'
						,'field'=>'a.id_skpd'
						,'name'=>'id_skpd'
						,'value'=>$_SESSION['id_skpd']
						),
				);	
				
			
					
		}
			if($filter_id_skpd != ''){
				unset($params->model['query']['query_filter']);
				$params->model['query']['query_filter']=array(
					'id_skpd'=>array(
						'type'=>'where'
						,'field'=>'a.id_skpd'
						,'name'=>'id_skpd'
						,'value'=>$filter_id_skpd
						),
				);
			
			}else{
				//unset($params->model['query']['query_filter']);

				if($typecari != 'instansi'){
					if($cari_judul != ""){
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
					}
				}else{
					if($cari_judul != ""){
						unset($params->model['query']['query_filter']);
						$params->model['query']['query_filter']=array(
							$cari_judul=>array(
								'type'=>'like'
								,'field'=>'a.instansi'
								,'name'=>'judul'// harus sesuai dengan yg di post
								,'extra'=>'after'
								//,'value'=>$cari_judul
								),
						);
					}
				}					
			}
				
		
		$this->com_name = $params->lib['class_name'];
		parent::__construct($params);
	}
	function griddata(){
		parent::griddata();
		//error_log('arsip'.$this->CI->db->last_query(),3,'/var/www/arsip.log');
		$data = array();
		$data = $this->CI->output->get_output(); 
		$hasil = json_decode($data); 
		
		$new_data = new stdClass();
		$new_data->page = $data['page'] = $this->CI->input->post('page');
		$new_data->rows = $data['rows'] = $this->CI->input->post('rows');
		$new_data->sord = $data['sord'] = $this->CI->input->post('sord');		
		foreach($hasil->rows as $key=>$row){
			$this->CI->db->where('id_ba',$row->id_ba);
			$totaol_row = $this->CI->db->from('arsip_data')->count_all_results();
			$hasil->rows[$key]->jumlah = @$totaol_row;

			$jumlah_box = $this->CI->db->distinct()->select('distinct(box)')->where('id_ba',$row->id_ba)->get('arsip_data')->num_rows();
			$hasil->rows[$key]->jumlah_box = $jumlah_box;
			
			$hasil->rows[$key]->tanggal = date('d-m-Y',strtotime($hasil->rows[$key]->tanggal));

			if( empty($hasil->rows[$key]->instansi))
				$hasil->rows[$key]->instansi = $hasil->rows[$key]->nama_lengkap;
		}
		$new_data->rows = $hasil->rows;
		//$new_data->total = @$totaol_row;
		$this->CI->output->set_output(json_encode($new_data)); 		
	}
	function index_segments($params=false){
		parent::index_segments($params);	
		$this->content['data_skpd'] = $this->CI->com_model->get_skpd();
		$this->content['group'] = $_SESSION['user_group'];
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
		 $this->content['tahun'] = $this->CI->com_model->tahun();
		 $this->content['oper'] = 'add';
		 $this->content['group'] = $_SESSION['user_group'];
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'tambah_data','data'=>$this->content));
	}
	function edit(){
		 $id_ba = $this->CI->input->post('id_ba');
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $this->content['id_ba'] = $id_ba;
		 $this->content['tahun'] = $this->CI->com_model->tahun();
		 $this->content['data'] = $this->CI->com_model->get_data($id_ba);

		 if(empty($this->content['data'][0]->instansi))
		 	$this->content['data'][0]->instansi = $this->content['data'][0]->nama_lengkap;

		 //print_r($this->content['data']);

		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'edit_data','data'=>$this->content));
	}	
	function formaction(){
		$oper = $this->CI->input->post('oper');
		if($oper != 'del'){	
			$this->CI->form_validation->set_rules('tanggal','Tanggal','trim|required');
			$this->CI->form_validation->set_rules('no','Nomor','trim|required');
			$this->CI->form_validation->set_rules('agenda','Agenda','trim|required');
			$this->CI->form_validation->set_rules('kode_komponen','Kode Komponen','trim|required');
			$this->CI->form_validation->set_rules('tahun','Tahun','trim|required');
			$this->CI->form_validation->set_rules('pertelaan','Disertasi Pertelaan','trim|required');
			if($_SESSION['user_group']!=3){
				$this->CI->form_validation->set_rules('instansi','Instansi','trim|required');
			}
			if($this->CI->form_validation->run() == FALSE){
				$hasil = array('result'=>'failed','message'=>validation_errors(),'oper'=>$oper);
			}else{
				$hasil = $this->CI->com_model->simpan();
			}
		}else{
				$hasil = $this->CI->com_model->simpan();
		}
		
		echo json_encode($hasil);
	}	
	function view(){
		//$id_lokasi_simpan = $this->CI->input->post('id_lokasi_simpan');
		$hasil = $this->CI->com_model->view();
		$this->content['data'] = @$hasil;
		if(empty($this->content['data'][0]->instansi))
		 	$this->content['data'][0]->instansi = $this->content['data'][0]->nama_lengkap;
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'view_data','data'=>$this->content));
	}	
	function upload(){
		$msg = "";
		$error = "";
		$fname = "";
		$config['upload_path'] = DOC_PATH_ROOT.'assets/media/berita_acara/';
		$config['allowed_types'] = 'pdf|gif|jpg|png|zip|xls|xlsx|word';
		$config['max_size']	  = '1000';
		$config['max_width']  = '1024';
		$config['max_height'] = '768';
		$config['overwrite']  = true;
		$config['remove_spaces']=true;
		$this->CI->load->library('upload', $config);
		if ( ! $this->CI->upload->do_upload('berita_acr')):
			$error = $this->CI->upload->display_errors();
			$msg = "File".$data['full_path']." Tidak Berhasil";
		else:
			$data = $this->CI->upload->data();
			$msg = "File ".$data['file_name']." Berhasil";
			$fname = $data['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = 'assets/media/berita_acara/'.$data['file_name'];
			$config['new_image'] = PATH_BASE.'assets/media/berita_acara/'.$data['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 400;
			$config['height'] = 250;
			$this->CI->load->library('image_lib', $config);
			$this->CI->image_lib->resize();

		endif;
		$this->responce = array('error'=>$error,'fname'=>$fname,'msg'=>$msg);
		echo json_encode($this->responce);
	}	

	function autocomplete(){
		$param1 = $this->CI->input->get('q');
		$param2 = $this->CI->input->get('type_cari');
		$group = $_SESSION['id_skpd'];
		$id_group = $_SESSION['user_group'];
		
		$responce = $this->CI->com_model->autocomplete($param1,$param2, $group, $id_group);

		echo json_encode($responce);
	}
				
}