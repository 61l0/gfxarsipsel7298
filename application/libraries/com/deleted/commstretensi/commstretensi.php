<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
class Commstretensi extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/mstretensi/';
		$params->lib['class_name'] = 'commstretensi';
		$params->lib['header_caption'] = 'Data Master &raquo; Retensi';
		
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'retensi_model','alias'=>'com_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');
		
		$params->lib['gf_form'] = $this->CI->config->item('lib');
		if($params->lib['gf_form']){
    		$params->lib = array_merge($params->lib,$params->lib['gf_form']);		
		}
		// ============================================================
		parent::__construct($params);
	}
	function griddata(){
		parent::griddata();
		$data = array();
		$data = $this->CI->output->get_output(); 
		$hasil = json_decode($data); 
		// dump($hasil);
		foreach($hasil->rows as $key=>$row){
			$ad = strtotime($row->aktif_dari);
			$as = strtotime($row->aktif_sampai);
			$aktif_dari = date("d-m-Y", $ad);
			$aktif_sampai = date("d-m-Y", $as);
			$ha = $this->CI->com_model->jumlah_tahun($aktif_dari,$aktif_sampai);

			$iad = strtotime($row->inaktif_dari);
			$ias = strtotime($row->inaktif_sampai);
			$inaktif_dari = date("d-m-Y", $iad);
			$inaktif_sampai = date("d-m-Y", $ias);
			$hia = $this->CI->com_model->jumlah_tahun($inaktif_dari,$inaktif_sampai);
			
			$hasil->rows[$key]->aktif = $ha['years'].' '.'<font color=red>Tahun</font>'.' '.$ha['months'].' '.'<font color=red>Bulan</font>'.' '.$ha['days'].' '.'<font color=red>Hari</font>';
			$hasil->rows[$key]->inaktif = $hia['years'].' '.'<font color=red>Tahun</font>'.' '.$hia['months'].' '.'<font color=red>Bulan</font>'.' '.$hia['days'].' '.'<font color=red>Hari</font>';
		}
		$new_data->rows = $hasil->rows;
		$this->CI->output->set_output(json_encode($new_data)); 		
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
        unset($this->content['grid']['toolbar']['plus']);
        
	}
	function index_segments($params=false){
		parent::index_segments($params);	

		$this->content_default['segments']['head'] = $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'default','data'=>$this->content ,'return'=>true));		
	}	
	function tambah_data(){
		 $this->content['class_name'] = $this->lib['class_name'];
		 $hasil = @$this->CI->com_model->get_parent($this->CI->input->post('id_parent'));
		 $this->content['id_parent'] = $this->CI->input->post('id_parent');
		 $this->content['name_parent'] = @$hasil[0]->desc;
		 $this->content['oper'] = 'add';
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'tambah_data','data'=>$this->content));
	}	
	function formaction(){
		$oper = $this->CI->input->post('oper');
		if($oper != 'del'){
			$this->CI->form_validation->set_rules('deskripsi','Deskripsi','trim|required');
			$this->CI->form_validation->set_rules('aktif_dari','Aktif Dari','trim|required');
			$this->CI->form_validation->set_rules('aktif_sampai','Aktif Sampai','trim|required');
			$this->CI->form_validation->set_rules('inaktif_dari','Inaktif Dari','trim|required');
			$this->CI->form_validation->set_rules('inaktif_sampai','Inaktif Sampai','trim|required');
		
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
	function edit(){
		 $id_retensi = $this->CI->input->post('id_retensi');
		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $hasil = @$this->CI->com_model->get_parent($this->CI->input->post('id_parent'));
		 $this->content['name_parent'] = @$hasil[0]->desc;
		 $this->content['id_retensi'] = $id_retensi;
		 $this->content['data'] = $this->CI->com_model->get_data($id_retensi);
		 // dump($this->content['data'][0]->desc);
		 $this->content['id_parent'] = $this->content['data'][0]->id_parent;
		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'edit_data','data'=>$this->content));
	}		
}	
?>
