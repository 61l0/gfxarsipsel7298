<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Pertelaanarsip extends Grid {
	function __construct($config=array()){
	    // ===============================
		$this->CI = & get_instance();
		$params = new stdClass;
	
	//	$config['master_class_name'] = 'penyerahan';

		$params->lib['class_name'] = 'pertelaanarsip';
		$params->lib['header_caption'] ='';

        $params->lib['master_class_name'] = $config['master_class_name'];
		$params->lib['master_com_url'] = $config['master_com_url'];
		$params->lib['com_url'] = $config['master_com_url'].$params->lib['class_name'].'/';		

		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'config',array('name'=>'grid'));
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'peminjaman_model','alias'=>'com_model'));
		
		$this->CI->load->com($params->lib['master_class_name'].'/subcom/'.$params->lib['class_name'],'model',array('name'=>'pertelaanarsip_model'));
		
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		// ============================================================
		$this->content['master_class_name'] =  $params->lib['master_class_name'];
		$params->gridlib['grid']['opt']['postData']['id_ba'] = $this->CI->input->post('id_ba');  
		
		$tahun = $this->CI->com_model->tahun();
        $arr_tahun = array();
        foreach($tahun as $key=>$row){
            $arr_tahun['"'.$row.'"'] = $row;
        }
      
        $params->gridlib['arr_colModel']['tahun']['editoptions']['value'] = $arr_tahun;
        $params->gridlib['arr_colModel']['id_unit_pengolah']['editoptions']['value'] = $_SESSION['id_skpd'];
        $params->gridlib['arr_colModel']['id_ba']['editoptions']['value'] =  $this->CI->input->post('id_ba');  
		parent::__construct($params);
	}
	function index_segments($params=false){
		parent::index_segments($params);
		$this->content['id_ba'] = $this->CI->input->post('id_ba');
		$this->content_default['segments']['head'] = $this->CI->load->com($this->content['master_class_name'].'/subcom/pertelaanarsip','view',array('name'=>'default','data'=>$this->content ,'return'=>true));			
	}
	
	function comjs_features($params=false){
	    parent::comjs_features($params);
		unset($this->content['comjs_features']['toolbar']);
		$conf_view_features = array(
			'name'=>'comjs_extra',
			'data'=>$this->content,
			'return'=>true
		);
		$this->content['comjs_features']['comjs_extra'] = $this->CI->load->com($this->content['master_class_name'].'/subcom/pertelaanarsip','view',$conf_view_features);
		
		$this->content['id_ba'] = $this->CI->input->post('id_ba');
		$conf_view_features = array(
			'name'=>'comjs_gridcomplete',
			'data'=>$this->content,
			'return'=>true
		);
		$this->content['comjs_features']['gridcomplete'] = $this->CI->load->com($this->content['master_class_name'].'/subcom/pertelaanarsip','view',$conf_view_features);		
		
	}
	function formaction(){
		$oper = $this->CI->input->post('oper');
		if($oper != 'del'){	
			$this->CI->form_validation->set_rules('judul','Judul','trim|required');
			$this->CI->form_validation->set_rules('tanggal','Tanggal','trim|required');
			$this->CI->form_validation->set_rules('no_arsip','Nomor Arsip','trim|required');
			$this->CI->form_validation->set_rules('agenda','Agenda','trim|required');
			$this->CI->form_validation->set_rules('kode_komponen','Kode Komponen','trim|required');
			$this->CI->form_validation->set_rules('tahun','Tahun','trim|required');
			$this->CI->form_validation->set_rules('box','Box','trim|required|numeric|greater_than[0]');
			$this->CI->form_validation->set_rules('sampul','Sampul','trim|numeric|greater_than[0]');

			$this->CI->form_validation->set_message('required', '%s Tidak boleh kosong.');
			$this->CI->form_validation->set_message('numeric', '%s Harus berupa digit.');
			$this->CI->form_validation->set_message('greater_than', '%s Harus lebih besar dari 0.');

		//	$this->CI->form_validation->set_rules('pertelaan','Disertasi Pertelaan','trim|required');
			if($_SESSION['user_group']!=6){
				//$this->CI->form_validation->set_rules('id_unit_pengolah','Instansi','trim|required');
			}
			if($this->CI->form_validation->run() == FALSE){
				$hasil = array('result'=>'failed','message'=>validation_errors(),'oper'=>$oper);
			}else{
				$hasil = $this->CI->pertelaanarsip_model->simpan();
			}
		}else{
				$hasil = $this->CI->pertelaanarsip_model->simpan();
		}
		
		echo json_encode($hasil);
	}
	// function formaction(){
		// $hasil = $this->CI->com_model->simpan();
		// echo json_encode($hasil);
	// }
	function tambah_data(){
		//print_r($this->lib);
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['tahun'] = $this->CI->pertelaanarsip_model->tahun();
		 $this->content['oper'] = 'add';
		 $this->content['id_ba'] = $this->CI->input->post('id_ba');
		 $this->content['group'] = $_SESSION['user_group'];
		
		$this->CI->load->com($this->content['master_class_name'].'/subcom/pertelaanarsip','view',array('name'=>'tambah_data','data'=>$this->content ));	
	}
	function edit(){
		 $id_ba = $this->CI->input->post('id_ba');
		 $id_data = $this->CI->input->post('id_data');

		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $this->content['id_ba'] = $id_ba;
		 $this->content['id_data'] = $id_data;
		 $this->content['tahun'] = $this->CI->pertelaanarsip_model->tahun();
		 $this->content['data'] = $this->CI->pertelaanarsip_model->get_data($id_data);
		// print_r(get_class_methods($this->CI->pertelaanarsip_model));
		//print_r($this->content['data']);
		 $this->CI->load->com($this->content['master_class_name'].'/subcom/pertelaanarsip','view',array('name'=>'edit_data','data'=>$this->content ));	
	
	}
	function griddata()
	{
		parent::griddata();
		$grid_data = json_decode($this->CI->output->get_output());
		$this->CI->output->set_output('');
		foreach( $grid_data->rows as $key => $row )
		{
			$no_arsip  = $grid_data->rows[$key]->no_arsip;
			$agenda    = $grid_data->rows[$key]->agenda;
			$kode_komp = $grid_data->rows[$key]->kode_komponen;
			$tahun 	   = $grid_data->rows[$key]->tahun;

			$grid_data->rows[$key]->no_berkas =  orminus($no_arsip) .'/'.orminus($agenda).'.'.orminus($kode_komp).'/'.orminus($tahun); 
		}
		$this->CI->output->set_output(json_encode($grid_data));
		unset($grid_data); 
	}
}
