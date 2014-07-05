<?php
class Pengolahan_model extends CI_Model {
    function __construct (){
        parent::__construct();
//		$this->responce = array();
	}
 	function tahun(){
		$arr_tahun = array();
		$th = '2025';
		for($i=1980; $i <= $th	; $i++){
			$arr_tahun[] = $i;
		}
		return $arr_tahun;
	}
	
	function lokasi_penyimpanan(){
		$this->db->select('id_lokasi_simpan, name');
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_lokasi_simpan')->result();
		return $data;
	}
	
	function data_combobox($type, $id_parent){
		switch($type){
			case 'rak' :
				$data = $this->db->where(array('id_parent'=>$id_parent,'type'=>$type))->get('arsip_lokasi_simpan')->result();
				break;
			case 'rool' :
				$data = $this->db->where(array('id_parent'=>$id_parent,'type'=>$type))->get('arsip_lokasi_simpan')->result();
				break;				
			case 'box' :
				$data = $this->db->where(array('id_parent'=>$id_parent,'type'=>$type))->get('arsip_lokasi_simpan')->result();
				break;
			case 'folder' :
				$data = $this->db->where(array('id_parent'=>$id_parent,'type'=>$type))->get('arsip_lokasi_simpan')->result();
				break;			
			case 'box_rool' :
				$data = $this->db->where(array('id_parent'=>$id_parent,'type'=>'box'))->get('arsip_lokasi_simpan')->result();
				break;
			case 'folder_rool' :
				$data = $this->db->where(array('id_parent'=>$id_parent,'type'=>'folder'))->get('arsip_lokasi_simpan')->result();
				break;							
			default :
				$data = $this->db->where('id_parent',0)->get('arsip_lokasi_simpan')->result();
		}
		// dump($this->db->last_query());
		return $data;
	}

	function jenis_arsip(){
		$data = $this->db->get('arsip_jenis_cat')->result();
		return $data;
	}

	function sifat_arsip(){
		$data = $this->db->get('arsip_sifat_cat')->result();
		return $data;
	}
	
	function simpan(){
		$oper = $this->input->post('oper');
		$kode_masalah = $this->input->post('kode_kls');
		$nama_klasifikasi = $this->input->post('nama_kls');
		$judul_arsip = $this->input->post('judul');
		$no_arsip = $this->input->post('no_arsip');
		$agenda = $this->input->post('agenda');
		$kode_komponen = $this->input->post('kode_komp');
		$tahun = $this->input->post('tahun');
		// $tanggal = $this->input->post('tanggal');
		$stamp = strtotime($this->input->post('tanggal'));
		$tanggal = date("Y-m-d", $stamp);
		$id_skpd = $this->input->post('id_skpd');
		$unit_pengolah = $this->input->post('unit_pengolah');
		$lokasi = $this->input->post('lokasi');
		$keterangan = $this->input->post('keterangan');
		$lokasi_penyimpanan_depo = $this->input->post('lokasi_penyimpanan_depo');
		$rdpilih = $this->input->post('rdpilih');
		$arr_id_rak = array();
		$arr_rak = array();
		$type_rak = array();
		if($rdpilih == 'rak'){
			
			$folder = $this->input->post('folder');			
			
		}else{
			
			$folder = $this->input->post('folder_rool');
			
		}
		// echo $folder;
		$id_retensi = $this->input->post('id_retensi');
		$jenis_arsip = $this->input->post('jenis_arsip');
		$sifat_arsip = $this->input->post('sifat_arsip');
		$this->responce = '';
		switch($oper){
			case 'add':
				$this->db->set('id_kode_masalah',$kode_masalah);
				$this->db->set('judul',$judul_arsip);
				$this->db->set('no_arsip',$no_arsip);
				$this->db->set('agenda',$agenda);
				$this->db->set('kode_komponen',$agenda);
				$this->db->set('tahun',$tahun);
				$this->db->set('tgl_input',$tanggal);
				$this->db->set('id_unit_pengolah',$id_skpd);
				$this->db->set('lokasi',$lokasi);
				$this->db->set('desc',$keterangan);
				$this->db->set('depo',$lokasi_penyimpanan_depo);
				$this->db->set('id_retensi',$id_retensi);
				$this->db->set('id_jenis',$jenis_arsip);
				$this->db->set('id_sifat',$sifat_arsip);
				$this->db->set('id_lokasisimpan',$folder);
				$this->db->insert('arsip_data');
			
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  berhasil Diinput','oper'=>$oper);
				
			break;
			
			case 'edit':
				$this->db->where('id_data',$this->input->post('id_data'));
				$this->db->set('id_kode_masalah',$kode_masalah);
				$this->db->set('judul',$judul_arsip);
				$this->db->set('no_arsip',$no_arsip);
				$this->db->set('agenda',$agenda);
				$this->db->set('kode_komponen',$agenda);
				$this->db->set('tahun',$tahun);
				$this->db->set('tgl_input',$tanggal);
				$this->db->set('id_unit_pengolah',$id_skpd);
				$this->db->set('depo',$lokasi_penyimpanan_depo);
				$this->db->set('lokasi',$lokasi);
				$this->db->set('desc',$keterangan);
				$this->db->set('id_retensi',$id_retensi);
				$this->db->set('id_jenis',$jenis_arsip);
				$this->db->set('id_sifat',$sifat_arsip);
				$this->db->set('id_lokasisimpan',$folder);
				$this->db->update('arsip_data');				
				
				
				$this->responce['rows']= array('result'=>'succes','message'=>'Data  berhasil Diedit','oper'=>$oper);
			break;
			case 'del':
				$this->db->where('id_data',$this->input->post('id_data'));
				$this->db->delete('arsip_data');
				// dump($this->db->last_query());
				$this->responce['rows']= array('result'=>'succes','message'=>'Data  berhasil Didelet','oper'=>$oper);
			break;
			
			
		}
			return $this->responce;
	}

	function view(){
		$id_data = $this->input->post('id_row');
		$this->db->select('a.*,b.name as depo,c.name as nama_masalah,d.nama_lengkap, e.desc as nama_retensi, f.name as nama_jenis, g.name as nama_sifat');
		$this->db->where('a.id_data',$id_data);
		$this->db->from('arsip_data a');
		$this->db->join('arsip_lokasi_simpan b','a.id_lokasisimpan=b.id_lokasi_simpan','left');
		$this->db->join('arsip_kode_masalah c','a.id_kode_masalah=c.id_kode_masalah','left');
		$this->db->join('m_skpd d','a.id_unit_pengolah=d.id_skpd','left');
		$this->db->join('arsip_retensi e','a.id_retensi=e.id_retensi','left');
		$this->db->join('arsip_jenis_cat f','a.id_jenis=f.id_jenis','left');
		$this->db->join('arsip_sifat_cat g','a.id_sifat=g.id_sifat','left');
		$data = $this->db->get()->result();
		return $data;	
	}

	function data_cetak(){
		$id_data = $this->input->post('id_data');
		$this->db->select('a.*,b.name as depo,c.name as nama_masalah,d.nama_lengkap, e.desc as nama_retensi, f.name as nama_jenis, g.name as nama_sifat');
		$this->db->where('a.id_data',$id_data);
		$this->db->from('arsip_data a');
		$this->db->join('arsip_lokasi_simpan b','a.id_lokasisimpan=b.id_lokasi_simpan','left');
		$this->db->join('arsip_kode_masalah c','a.id_kode_masalah=c.id_kode_masalah','left');
		$this->db->join('m_skpd d','a.id_unit_pengolah=d.id_skpd','left');
		$this->db->join('arsip_retensi e','a.id_retensi=e.id_retensi','left');
		$this->db->join('arsip_jenis_cat f','a.id_jenis=f.id_jenis','left');
		$this->db->join('arsip_sifat_cat g','a.id_sifat=g.id_sifat','left');
		$data = $this->db->get()->result();
		return $data;	
	}	


	
	function rak($id){
		$stack = array();
		$parent = $id;
		while($parent != 0){
			$data = $this->db->select('id_lokasi_simpan,id_parent,name,type')->where('id_lokasi_simpan',$parent)->get('arsip_lokasi_simpan')->row();
			$parent = $data->id_parent;
			$stack[] = $data;
			//dump($this->db->last_query());
		}
		$stack = array_reverse($stack);
		// dump($stack);
		return @$stack;
	}		
	
	function get_data(){
		$id_data = $this->input->post('id_row');
		$this->db->select('a.*,b.name as depo,c.name as nama_masalah,d.nama_lengkap,d.id_skpd, e.id_retensi, e.desc as nama_retensi, f.name as nama_jenis, g.id_sifat, g.name as nama_sifat');
		$this->db->where('a.id_data',$id_data);
		$this->db->from('arsip_data a');
		$this->db->join('arsip_lokasi_simpan b','a.id_lokasisimpan=b.id_lokasi_simpan','left');
		$this->db->join('arsip_kode_masalah c','a.id_kode_masalah=c.id_kode_masalah','left');
		$this->db->join('m_skpd d','a.id_unit_pengolah=d.id_skpd','left');
		$this->db->join('arsip_retensi e','a.id_retensi=e.id_retensi','left');
		$this->db->join('arsip_jenis_cat f','a.id_jenis=f.id_jenis','left');
		$this->db->join('arsip_sifat_cat g','a.id_sifat=g.id_sifat','left');
		$data = $this->db->get()->result();
		return $data;
	}
	
	function get_count_all1(){
		$this->db->select('count(a.id_data) as jml');
		$this->db->from('arsip_data a');
		$this->db->join('arsip_sifat_cat b','b.id_sifat=a.id_sifat');
		$this->db->join('arsip_retensi c','c.id_retensi=a.id_retensi');
		$data = $this->db->get()->row()->jml;
		return $data;
	}	
    function set_params($params){

		$this->params = $params;
		$this->table_name = $this->params['table_name'];
		$this->table_prikey = $this->params['table_prikey'];
		@$this->com_name = $this->params['com_name'];
		$this->query = @$this->params['query'];
		
	}	
	function query_filter($parampost){
		if(@$this->query['query_filter']){
			foreach($this->query['query_filter'] as $name=>$param_filter){
			    $filter_name = @$param_filter['name'];
			    $filter_field = $param_filter['field'];
			    $filter_type = $param_filter['type'];
			    $filter_value = isset($param_filter['value'])?$param_filter['value']:@$this->input->post('judul');
			    if($name == $this->table_prikey){
			        $filter_value = (@$filter_value)?$filter_value:0;
			    }
			    if(@$param_filter['extra']){
				call_user_func_array(array($this->db,$filter_type),array($filter_field,$filter_value,@$filter_extra));
			    }else{
					call_user_func_array(array($this->db,$filter_type),array($filter_field,$filter_value));
			    }
			}
		}
		if(@$parampost->post['_search'] == 'true'){
		    if(@$parampost->post['filters'] != FALSE){
			$filters = json_decode(@$parampost->post['filters']);
                	$this->search($filters);
		    }else{
			$obj = new stdClass;
                	$obj->groupOp = "AND";
                	$obj->filters->rules->op = @$parampost->post['searchOper'];
                	$obj->filters->rules->field = @$parampost->post['searchField'];
                	$obj->filters->rules->data = @$parampost->post['searchString'];
		        $this->search($obj);
		    }
		}
		// dump($this->db->last_query());
	}	
	private function query_table($params){
		if(!@$this->query['query_table']){
			if(isset($params['table_name'])) $this->db->from($this->table_name.' a');
		}else{
			foreach($this->query['query_table'] as $type=>$param){
			    $new_param = array();
			    $new_param1 = "";
			    if (isset($param['params'])){
			        call_user_func_array(array($this->db,$param['method']),$param['params']);
			    }else if(isset($param['arr_params'])){
			        foreach($param['arr_params'] as $row_param){
			            $param2 = @$params->post[$row_param[2]]?@$params->post[$row_param[2]]:"";
                        		if(is_array($row_param)){
                            			if($row_param[0]=='on'){
                                			$new_param1 .= $row_param[1].'='.$row_param[2];
                           			}
						if($row_param[0]=='and'){
                                			$new_param1 .= ' and '.$row_param[1].'='.$param2;
                            			}
						if($row_param[0]=='and_like'){
							if($row_param[3] == 'after'){
                                				$new_param1 .= " and ".$row_param[1]." like "."'".$param2."%'";
							}else if($row_param[3] == 'before'){
                                				$new_param1 .= ' and '.$row_param[1].' like %'.$param2;
							}else if($row_param[3] == '' || $row_param[3] == 'both'){
                                				$new_param1 .= ' and '.$row_param[1].' like %'.$param2.'%';
							}
                            			}
                        		}else{
                            			$new_param[] = $row_param;
                        		}        
			        }
			        $new_params = array($new_param[0],$new_param1,@$new_param[1]);
					// dump($new_params);
			        call_user_func_array(array($this->db,$param['method']),$new_params);
			    }else{
				    call_user_func_array(array($this->db,$type),$param);
				}
			}
		}
		
	}			
   function get_count_all($params=false){
      
		$this->query_table($params);
		$this->query_filter($params);
		if(!@$this->query['query_count']){
			$countdata = count($this->db->get()->result());
		}else{
			foreach($this->query['query_count'] as $type=>$param){
				if($type == 'label') continue;
				call_user_func_array(array($this->db,$type),$param);
			}
			$label = $this->query['query_count']['label'];
			$data = $this->db->get()->row();
			$countdata = $data->$label;
		}
		
		return $countdata;
	}	
	function data_image($id){
		$this->db->where('id_data',$id);
		$data = $this->db->get('arsip_galery')->result();
		// dump($this->db->last_query());
		return $data;
	}
	
	function data_image1($id,$chk){
		$a = explode(',',$chk);
		foreach($a as $i){
		$this->db->or_where('id_galery',$i);
		}
		$this->db->where('id_data',$id);
		$data = $this->db->get('arsip_galery')->result();
		//dump($this->db->last_query());
		return $data;
	}	
	function autocomplete($param=false,$type=false){
		
		if($type=='judul'){
			$sql = "select judul as hasil from arsip_data where judul like "."'%$param%'";
			
		}else if($type=='id_unit_pengolah'){
			$sql = "select b.nama_lengkap as hasil from arsip_data a join m_skpd b on b.id_skpd=a.id_unit_pengolah where b.nama_lengkap like "."'%$param%' group by b.id_skpd";	
			
			
		}else if($type=='no_surat'){
			$sql = "select judul as hasil from arsip_data where judul like "."'%$param%'";	
		}else if($type=='id'){
			$sql = "select judul as hasilfrom arsip_data where judul like "."'%$param%'";	
		}else if($type=='tahun'){
			$sql = "select tahun as hasil from arsip_data where tahun like "."'%$param%'";	
		}else if($type=='lokasi'){
			$sql = "select lokasi as hasil from arsip_data where lokasi like "."'%$param%'";
		}
		
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();  
	}		
	
	function autocomplete_judularsip($param=false){
		$sql = "select judul from arsip_data where judul like "."'%$param%'";
		$query = $this->db->query($sql);
		//dump($this->db->last_query());
		return $query->result();  
	}		
	
}	
