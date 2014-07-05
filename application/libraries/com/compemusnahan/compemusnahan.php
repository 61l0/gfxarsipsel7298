<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('grid');
function displayMasa($diff)
{
	$o =  $diff->y ? $diff->y . " tahun " : "";
	$o .= $diff->m ? $diff->m . " bulan " : "";
	$o .= $diff->d ? $diff->d . " hari " : "";
	return $o;
}
class Compemusnahan extends Grid{
	function __construct(){
		$this->CI = & get_instance();
		$params = new stdClass;
		$params->lib['com_url'] = 'admin/com/pemusnahan/';
		$params->lib['class_name'] = 'compemusnahan';
		$params->lib['header_caption'] = 'Pemusnahan';
		// =========================================================
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'main_model'));
		$params->model = $this->CI->config->item('model_main');

		$this->CI->load->com($params->lib['class_name'],'model',array('name'=>'model_pemusnahan'));
		$this->CI->load->com($params->lib['class_name'],'config',array('name'=>'grid'));
		$params->gridlib = $this->gridlib = $this->CI->config->item('gridlib');

		$date = "'". date('Y-m-d') ."'";
		// echo $date;
		$status = $this->CI->input->post('status');	
		unset($params->model['query']['query_filter']);
		if($status == 'all' || !$status){
			$params->model['query']['query_filter']=array(
				'inaktif_sampai'=>array(
					'type'=>'where'
					,'field'=>"( a.inaktif_sampai < ".$date." and  (a.status IS NULL OR a.status = 'tinjau') )     OR " . 
							  "( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' ) OR " .  
							  "( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan')"
					),
			);
		}
		else if($status == 'inaktif'){
			$params->model['query']['query_filter']=array(
				'inaktif_sampai'=>array(
					'type'=>'where'
				,'field'=>"( a.inaktif_sampai < ".$date." and  (a.status IS NULL OR a.status = 'tinjau') ) "
					),
			);
		}
		else if($status == 'tinjau'){
			$params->model['query']['query_filter']=array(
				'inaktif_sampai'=>array(
					'type'=>'where'
					,'field'=>"( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' )" 
					),
			);		
		}else if($status=='musnahkan'){
			$params->model['query']['query_filter']=array(
				'status'=>array(
					'type'=>'where'
					,'field'=>"( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan')"
					// ,'value'=>'musnahkan'
					),					
			);		
		}else if($status=='permanen'){
			$params->model['query']['query_filter']=array(
				'status'=>array(
					'type'=>'where'
					,'field'=>"(( a.inaktif_sampai < ".$date." and  a.status IS NULL )     OR " . 
							  "( a.inaktif_sampai > ".$date." and  a.status = 'tinjau' ) OR " .  
							  "( a.inaktif_sampai < ".$date." and  a.status = 'musnahkan')) AND a.rt_desc = 'permanen'"
					// ,'value'=>'musnahkan'
					),					
			);		
		}		

		// ============================================================
		//dropdown jenis skpd
		$this->com_name = $params->lib['class_name'];
		parent::__construct($params);
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
	
	function tinjau(){

		 $this->content['class_name'] = $this->lib['class_name'];
		 $this->content['oper'] = $this->CI->input->post('oper');
		 $this->content['id_data'] = $this->CI->input->post('id_data');
		 $this->CI->load->com('compengolahan','model',array('name'=>'pengolahan_model'));
		 $this->content['data_edit'] = $this->CI->pengolahan_model->get_data($this->content['id_data']);
		 // $this->content['tahun'] = $this->CI->pengolahan_model->tahun();
		 // $this->content['jenis_arsip'] = $this->CI->pengolahan_model->jenis_arsip();
		 // $this->content['sifat_arsip'] = $this->CI->pengolahan_model->sifat_arsip();
		 // $this->content['lokasi_simpan'] = $this->CI->pengolahan_model->rak($this->content['data_edit'][0]->id_lokasisimpan);
		// / print_r($this->content['data_edit']);

		 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'frm_tinjau','data'=>$this->content));
	}	
	function formaction(){
		$oper = $this->CI->input->post('oper');
	
		$hasil = $this->CI->model_pemusnahan->simpan();
	
		echo json_encode($hasil);
	}	
	// function edit(){
	// 	 $this->content['class_name'] = $this->lib['class_name'];
	// 	 $this->content['oper'] = $this->CI->input->post('oper');
	// 	 $this->content['id_surat'] = $this->CI->input->post('id_surat');
	// 	 $this->content['data_edit'] = $this->CI->model_pemusnahan->get_data($this->content['id_surat']);
	// 	 $this->CI->load->com($this->lib['class_name'],'view',array('name'=>'edit_data','data'=>$this->content));
	// }	
	function view(){
		$hasil = $this->CI->model_pemusnahan->view($this->CI->input->post('id_surat'));
		$this->content['data'] = $hasil;
		$this->CI->load->com($this->lib['class_name'],'view',array('name'=>'view_data','data'=>$this->content));
	}
	function formaction_tinjau()
	{
		$oper = $this->CI->input->post('oper');
		$id_data = $this->CI->input->post('id_data');
		$rt_aktif = $this->CI->input->post('rt_aktif');
		$rt_inaktif = $this->CI->input->post('rt_inaktif');
		$rt_desc = $this->CI->input->post('rt_desc');
		$jml_tinjauan = $this->CI->input->post('jml_tinjauan');
		$tgl_dinilai_kembali = date('Y-m-d');
		if($oper == 'tinjau'){
			$hasil= $this->CI->model_pemusnahan->tinjau($id_data,$rt_aktif,$rt_inaktif,$rt_desc,$tgl_dinilai_kembali,$jml_tinjauan);
			echo json_encode($hasil);
		}else{
			echo json_encode(array('result'=>'failed','message'=>'Operasi Penilaian kembali mengalami kegagalan','oper'=>'tinjau'));
		}
	}
	function griddata(){
		parent::griddata();
		$grid_data = json_decode($this->CI->output->get_output());
		$this->CI->output->set_output('');
		


		$now = strtotime(date('Y-m-d 00:00:00'));
		//echo $now;
		//die();

		foreach( $grid_data->rows as $key => $row )
		{

			if( strtotime($grid_data->rows[$key]->inaktif_sampai . ' 00:00:00') < $now ) 
			{
		//		echo strtotime($grid_data->rows[$key]->inaktif_sampai . ' 00:00:00');
				if($grid_data->rows[$key]->status != 'musnahkan')
					$grid_data->rows[$key]->status = '';	
				//$grid_data->rows[$key]->keterangan = '<font color=red>Retensi</font>';
			}
			else
			{
				//$grid_data->rows[$key]->keterangan = '<font color=green>Aktif</font>';
			}

			/*
			$date1 = new DateTime("2008-01-02");
			$date2 = new DateTime("2012-07-05");
			$diff = $date1->diff($date2);

			echo "difference " . $diff->y . " years, " . $diff->m." months, ".$diff->d." days "
			*/

			if( $grid_data->rows[$key]->status == 'tinjau' )
			{
				$tanggal_berkas = new DateTime($grid_data->rows[$key]->tgl_dinilai_kembali);
			}
			else 
			{
				$tanggal_berkas = new DateTime($grid_data->rows[$key]->tanggal);
			}
			// $aktif_sampai = new DateTime($grid_data->rows[$key]->aktif_sampai);
			// $inaktif_sampai = new DateTime($grid_data->rows[$key]->inaktif_sampai);

			// $diffAktif = $tanggal_berkas->diff($aktif_sampai);
			// $diffInaktif = $tanggal_berkas->diff($inaktif_sampai);

			$grid_data->rows[$key]->rt_aktif .=  ' tahun';
			$grid_data->rows[$key]->rt_inaktif .=  ' tahun';

			$grid_data->rows[$key]->rt_desc = strtoupper(str_replace('_', ' ', $grid_data->rows[$key]->rt_desc ) ) ;
			$grid_data->rows[$key]->status_text = $grid_data->rows[$key]->status;
			if( $grid_data->rows[$key]->status == 'tinjau')
				$grid_data->rows[$key]->status =  "DINILAI KEMBALI (".$grid_data->rows[$key]->jml_tinjauan.")";
		}
		
		$this->CI->output->set_output(json_encode($grid_data));
		unset($grid_data); 
	}		
}	
?>
