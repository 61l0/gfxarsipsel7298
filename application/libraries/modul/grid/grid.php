<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
panel_loadmodul('modul');
class Grid extends Modul{
/*	protected $CI;
	protected $com_name = false;
	protected $lib = array(
		'class_name' => '',
		'com_url' => '',

	);
	protected $params = array(
		'gridlib' => '',
		'model'	  => '',	 
	);

	protected $content = array(
		'com_url'=>'',
		'class_name'=>''
	);

	protected $class_name;
	protected $com_url;

*/
	function __construct($params=false){
		$this->lib = $params->lib;
		$this->params['gridlib'] = $params->gridlib;
		$this->params['model'] = $params->model;
		$this->CI =& get_instance();
		$this->content['com_url'] = $this->com_url = $this->lib['com_url'];
		$this->content['class_name'] = $this->class_name = $this->lib['class_name'];
		$this->CI->load->helper('convert');
	}
	function comjs_form($params=false){
		$model_name = 'g1_model';
	    if(isset($this->params['gridlib']['grid']['opt']['treeGrid'])){
	        if($this->params['gridlib']['grid']['opt']['treeGrid']){
        	    $model_name = 'gt1_model';
	        }
	    }
		if(@$this->lib['modelcom_name']){
			$this->CI->load->model($this->lib['modelcom_name'],$model_name);
		}else{
			$this->CI->load->modul('grid','model',array('name'=>$model_name,'alias'=>$model_name) );
		}
		$this->CI->$model_name->set_params($this->params['model']);	
            $conf_view1 = array(
		    'name'=>'formjs',
		    'data'=>$this->content,
		    'return'=>true
	    );
	    $this->content['formjs'] = $this->CI->load->modul('grid','view',$conf_view1);
		$this->lib['gf_form']['dropdown_options'] = $this->CI->$model_name->get_dropdown($this->lib['gf_form']['params_dropdown']);
		// 20111123  RELATION - PENAMBAHAN UNMTUK DROPDOW RELATION
		$arr_relation = array();
		foreach($this->lib['gf_form']['inputModel'] as $key=>$dd){
			$this->lib['gf_form']['inputModel'][$key]['editoptions']['value'] = $this->lib['gf_form']['dropdown_options'][$key]['options'];
			if(isset($this->lib['gf_form']['params_dropdown'][$key]['relation'])){
				$relation_parent = $key;
				$relation_value = $this->lib['gf_form']['dropdown_options'][$key]['default'];
				$relation_child = $this->lib['gf_form']['params_dropdown'][$key]['relation'];
				$arr_relation[$relation_child] = array(
					'value' => $relation_value,
					'parent'=> $relation_parent
				);

				if(!isset($this->lib['gf_form']['inputModel'][$key]['extra'])){
					$this->lib['gf_form']['inputModel'][$key]['extra'] = array();
				}
				$this->lib['gf_form']['inputModel'][$key]['extra']['relation'] = array('name'=>$relation_child);
			}
		}
		foreach($arr_relation as $rel_key=>$rel_param){
			$this->lib['gf_form']['params_dropdown'][$rel_key]['db_query']['where'][1] = $rel_param['value'];
			$ext_dd[$rel_key] = $this->lib['gf_form']['params_dropdown'][$rel_key];
			$new_set = $this->CI->$model_name->get_dropdown($ext_dd);
			$this->lib['gf_form']['inputModel'][$rel_key]['editoptions']['value'] = $new_set[$rel_key]['options'];
		}
		// 20111123 END
		$this->content['form']['inputModel'] = $this->lib['gf_form']['inputModel'];
	}
	function comjs($params=false){
	    $grid_config_name = 'grid';
	    if(isset($this->params['gridlib']['grid']['opt']['treeGrid'])){
	        if($this->params['gridlib']['grid']['opt']['treeGrid']){
        	    $grid_config_name = 'gridtree';
	        }
	    }
		$this->CI->load->modul('grid','config',array('name'=>$grid_config_name));
		$this->grid = $this->CI->config->item('grid');
		// 20111123 cek if exist act
		if(isset($this->params['gridlib']['arr_colModel']['act'])){
			$this->params['gridlib']['arr_colModel']['act']['formatoptions']['editOptions']  = $this->grid['formprop'];
		}

		// create an ext properties (sufix _ext)
		foreach($this->params['gridlib']['grid'] as $g_key=>$g_prop){
			$this->grid[$g_key.'_ext'] = $g_prop;
		}
		/* $this->grid['opt_ext'] = $this->params['gridlib']['grid']['opt'];
        if(@$this->params['gridlib']['grid']['formprop']){
            $this->grid['formprop_ext'] = $this->params['gridlib']['grid']['formprop'];
        } */
        // ============= jika ada gf_form ==================================
        if(@$this->lib['gf_form']){
            $this->comjs_form($params);
		}
		// =================================================================
		$this->grid['id'] = "grid".$this->lib['class_name'];
		$this->grid['pager'] = "grid".$this->lib['class_name']."Pager";
		$this->grid['opt']['pager'] = $this->grid['pager'];
		
		$this->grid['opt']['url'] = site_url($this->com_url."griddata");
		$this->grid['opt']['editurl'] = site_url($this->com_url."formaction");
		$this->grid['colModel'] = $this->params['gridlib']['arr_colModel'];
		$this->grid['opt']['colModel'] = array();

        if($this->grid['opt']['treeGrid']==true){
            $this->grid['opt']['treeReader']['parent_id_field'] = $this->params['model']['table_parentkey'];
	        $this->grid['opt']['prmNames']['id'] = $this->params['gridlib']['grid']['opt']['prmNames']['id'];        
        }
    
		$this->content['grid'] = $this->grid;

        $this->comjs_features();				
		$conf_view1 = array(
			'name'=>'comjs',
			'data'=>$this->content,
			'return'=>true
		);
		if(@$this->lib['custom_view']['comjs']){
	        $conf_view1['name'] = $this->lib['custom_view']['comjs'];
		    $com_name = @$this->lib['custom_view']['com_name']?$this->lib['custom_view']['com_name']:$this->class_name;
    		$this->content['comjs'] = $this->CI->load->com($com_name,'view',$conf_view1);		
		}else{
    		$this->content['comjs'] = $this->CI->load->modul('grid','view',$conf_view1);		
		}
	}
	function comjs_features(){
	    $features_name = 'grid';
	    if(isset($this->params['gridlib']['grid']['opt']['treeGrid'])){
	        if($this->params['gridlib']['grid']['opt']['treeGrid']){
        	    $features_name = 'treegrid';
	        }
	    }
	    
		$this->CI->load->modul('grid','config',array('name'=>'comjs_features'));
		$features = $this->CI->config->item('features');
		if(isset($this->lib['gf_form'])){
    	    $features[$features_name]['forminit'] = array('name'=>'forminit');        	    
	    }
		foreach($features[$features_name] as $features_key=>$features_config){
		    $conf_view_features = array(
			    'name'=>'comjs_'.$features_config['name'],
			    'data'=>$this->content,
			    'return'=>true
		    );
		    if(isset($features_config['data'])){
		         array_push($conf_view_features['data'],$features_config['data']); 
		    }
        	$this->content['comjs_features'][$features_key] = $this->CI->load->modul('grid','view',$conf_view_features);
		}
	}
	
	function index_segments($params=false){
		$this->comjs();
		$this->content['header_caption'] = $this->lib['header_caption'];
		$this->CI->load->modul('grid','config',array('name'=>'default_segments'));
		$segments = $this->CI->config->item('segments');

		foreach($segments as $segment_key=>$segment_config){
		    $conf_view_segment = array(
			    'name'=>'default_'.$segment_key,
			    'data'=>$this->content,
			    'return'=>true
		    );
		    
		    if(isset($features_config['data'])){
		         array_push($conf_view_features['data'],$features_config['data']); 
		    }
    		$this->content_default['segments'][$segment_key] = $this->CI->load->modul('grid','view',$conf_view_segment);
		}
	}
	
	function index($params=false){
		$this->index_segments($params);
		$view_default = 'default';
		if(@$this->lib['custom_view']['default']){
	        $view_default = $this->lib['custom_view']['default'];
		    $com_name = @$this->lib['custom_view']['com_name']?$this->lib['custom_view']['com_name']:$this->class_name;
    		$this->CI->load->com($com_name,'view',array('name'=>$view_default,'data'=>$this->content_default));		
		}else{
    		$this->CI->load->modul('grid','view',array('name'=>$view_default,'data'=>$this->content_default));		
		}

	}
	function griddata($params=false){
	    $model_name = 'g1_model';
	    if(isset($this->params['gridlib']['grid']['opt']['treeGrid'])){
	        if($this->params['gridlib']['grid']['opt']['treeGrid']){
        	    $model_name = 'gt1_model';
	        }
	    }// PASSED
	    if(@$this->lib['modelcom_name']){
	        $this->CI->load->model($this->lib['modelcom_name'],$model_name);
	    }else{
	    	//echo $model_name;
	    	//die();

	    	// HERE
    		$this->CI->load->modul('grid','model',array('name'=>$model_name,'alias'=>$model_name) );
    		// $this->g1_model
	    }
		
		$this->CI->$model_name->set_params($this->params['model']); // $this->g1_model


        if($model_name == 'g1_model'){
        	// HERE karena bukan treegrid
            $this->griddata_basic($model_name);
        }elseif($model_name == 'gt1_model'){
            $this->griddata_tree($model_name);
        }	
		//dump($this->CI->db->last_query());
	}

	// HERE
	protected function griddata_basic($model_name=false){

		verbose_log( 
			__LINE__ .' : '.__FILE__ . ': '. __METHOD__. ' : '. $model_name . "\r\n" .
			'$this->params : ' . print_r($this->params,1) ."\r\n"
		);
		//echo $model_name;
		//die();

		$this->CI->$model_name->set_params($this->params['model']);
		$params = new stdClass();
		$params->post = $this->CI->input->post();
		$params->page = $data['page'] = $this->CI->input->post('page');
		$params->rows = $data['rows'] = $this->CI->input->post('rows');
		$params->sord = $data['sord'] = $this->CI->input->post('sord');

		$params->records = $this->CI->$model_name->get_count_all($params);

		$this->CI->load->helper('query_helper');
		$params = query_getlimit($params);
		$data['rows'] = $this->CI->$model_name->griddata($params);

		$oper = @$this->CI->input->post('oper');
		switch ($oper):
		case 'excel':
		    $params->data = $data;
			$params->colModel = $this->params['gridlib']['arr_colModel'];
			$this->CI->load->modul('goutput','config',array('name'=>'main_excel'));
            $params->excel = $this->CI->config->item('excel');
		    
    		$this->CI->load->modul('goutput','library',array('name'=>'goutput') );
    		$this->CI->goutput->excel($params);
			break;
		case 'word':
		    $params->data = $data['rows'];
			$params->colModel = $this->params['gridlib']['arr_colModel'];
			$this->CI->load->modul('goutput','config',array('name'=>'main_word'));
            $params->word = $this->CI->config->item('word');
            
    		$this->CI->load->modul('goutput','library',array('name'=>'goutput') );
    		$this->CI->goutput->word($params);
			break;
		case 'pdf':
		    $params->data = $data['rows'];
			$params->colModel = $this->params['gridlib']['arr_colModel'];
			$this->CI->load->modul('goutput','config',array('name'=>'main_pdf'));
            $params->pdf = $this->CI->config->item('pdf');
            
    		$this->CI->load->modul('goutput','library',array('name'=>'goutput') );
    		$this->CI->goutput->pdf($params);
			break;
		default:
			$data['total'] 		= $params->total;

			$data['records'] 	= $params->records;
			$data['start'] 		= $params->start;
			$this->CI->output->set_header('Contents-Type:application/json');
			$this->CI->output->set_output(json_encode($data)); 
			break;
		endswitch;
	}
	function griddata_tree($model_name=false){
		$this->CI->$model_name->set_params($this->params['model']);
		$params = new stdClass();
		$params->post = $this->CI->input->post();
		$params->nodeid = ($this->CI->input->post('nodeid'))?$this->CI->input->post('nodeid'):0;
		$params->n_level = ($this->CI->input->post('n_level'))?$this->CI->input->post('n_level'):0;
		
		
		$oper = @$this->CI->input->post('oper');
		switch ($oper):
		case 'excel':
		    $params->treeGrid = $this->params['gridlib']['grid']['opt']['treeGrid'];
			$params->colModel = $this->params['gridlib']['arr_colModel'];
			$this->CI->load->modul('goutput','config',array('name'=>'main_excel'));
            $params->excel = $this->CI->config->item('excel');
			// to return all data, then we should unset the id_parent filter
			$hir_parentkey = $this->CI->$model_name->table_parentkey;
			if(!isset($params->post[$hir_parentkey])){
				if(isset($this->CI->$model_name->query['query_filter'][$hir_parentkey])){
					unset($this->CI->$model_name->query['query_filter'][$hir_parentkey]);
				}
			}
		    $data['rows'] = $this->CI->$model_name->griddata($params,$this->params['gridlib']['excel']['config']);
		    $params->data = $data['rows'];
            $params->ExpandColumn = $this->params['gridlib']['grid']['opt']['ExpandColumn'];
    		$this->CI->load->modul('goutput','library',array('name'=>'goutput') );
    		$this->CI->goutput->excel($params);
			break;
		case 'word':
		    $params->treeGrid = $this->params['gridlib']['grid']['opt']['treeGrid'];
			$params->colModel = $this->params['gridlib']['arr_colModel'];
			$this->CI->load->modul('goutput','config',array('name'=>'main_word'));
            $params->word = $this->CI->config->item('word');
			// to return all data, then we should unset the id_parent filter
			$hir_parentkey = $this->CI->$model_name->table_parentkey;
			if(!isset($params->post[$hir_parentkey])){
				if(isset($this->CI->$model_name->query['query_filter'][$hir_parentkey])){
					unset($this->CI->$model_name->query['query_filter'][$hir_parentkey]);
				}
			}
            $data['rows'] = $this->CI->$model_name->griddata($params,$this->params['gridlib']['word']['config']);
		    $params->data = $data['rows'];
            $params->ExpandColumn = $this->params['gridlib']['grid']['opt']['ExpandColumn'];
    		$this->CI->load->modul('goutput','library',array('name'=>'goutput') );
    		$this->CI->goutput->word($params);
			break;
		case 'pdf':
		    $params->treeGrid = $this->params['gridlib']['grid']['opt']['treeGrid'];
			$params->colModel = $this->params['gridlib']['arr_colModel'];
			$this->CI->load->modul('goutput','config',array('name'=>'main_pdf'));
            $params->pdf = $this->CI->config->item('pdf');
			// to return all data, then we should unset the id_parent filter
			$hir_parentkey = $this->CI->$model_name->table_parentkey;
			if(!isset($params->post[$hir_parentkey])){
				if(isset($this->CI->$model_name->query['query_filter'][$hir_parentkey])){
					unset($this->CI->$model_name->query['query_filter'][$hir_parentkey]);
				}
			}
            $data['rows'] = $this->CI->$model_name->griddata($params,$this->params['gridlib']['pdf']['config']);
		    $params->data = $data['rows'];
            $params->ExpandColumn = $this->params['gridlib']['grid']['opt']['ExpandColumn'];
    		$this->CI->load->modul('goutput','library',array('name'=>'goutput') );
    		$this->CI->goutput->pdf($params);
			break;
		default:
			$data['rows'] = $this->CI->$model_name->griddata($params);
			$this->CI->output->set_header('Contents-Type:application/json');
			$this->CI->output->set_output(json_encode($data)); 
			break;
		endswitch;
	    // dump($this->CI->db->last_query());
 	}
 	function get_dropdown_option($params=false,$outputJson=true){
		$arr = array();
		foreach($params as $key => $val){
			$arr = $key;
		}
		$model_name = 'g1_model';
	    if(isset($this->params['gridlib']['grid']['opt']['treeGrid'])){
	        if($this->params['gridlib']['grid']['opt']['treeGrid']){
        	    $model_name = 'gt1_model';
	        }
	    }
	    if(@$this->lib['modelcom_name']){
	        $this->CI->load->model($this->lib['modelcom_name'],$model_name);
	    }else{
    		$this->CI->load->modul('grid','model',array('name'=>$model_name,'alias'=>$model_name) );
	    }
		$dropdown_options = $this->CI->$model_name->get_dropdown($params);
		if($outputJson){
    		echo json_encode($dropdown_options[$arr]);
		}else{
		    return $dropdown_options;
		}
	}
	function formaction(){
	    $model_name = 'g1_model';
	    if(isset($this->params['gridlib']['grid']['opt']['treeGrid'])){
	        if($this->params['gridlib']['grid']['opt']['treeGrid']){
        	    $model_name = 'gt1_model';
	        }
	    }
	    if(@$this->lib['modelcom_name']){
	        $this->CI->load->model($this->lib['modelcom_name'],$model_name);
	    }else{
    		$this->CI->load->modul('grid','model',array('name'=>$model_name,'alias'=>$model_name) );
	    }
	    
		$this->CI->$model_name->set_params($this->params['model']);
		
		$params['post'] = $this->CI->input->post();
		$params['post']['oper'] = $this->CI->input->post('oper');
		$params['post']['colModel'] = $this->get_formpost();

		$responce = $this->CI->$model_name->simpan($params);

		$this->CI->output->set_header('Contents-Type:application/json');
		$this->CI->output->set_output(json_encode($responce)); 
	}
	function get_formpost(){
		$colModel = $this->params['gridlib']['arr_colModel'];
		$rows = array();
		foreach($colModel as $index=>$col){
			if(@$col['editable']==true){
				$rows[$col['name']] = $this->CI->input->post($col['name']);
			}
			if(@$col['key']==true){
				$rows[$col['name']] = $this->CI->input->post($col['name']);
			}
			if(@$col['edittype']=='password'){
				$rows[$col['name']] = sha1($this->CI->input->post($col['name']));
			}
		}
		return $rows;
	}
}	
?>
