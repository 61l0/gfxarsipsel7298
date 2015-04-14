<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['treeGrid'] = true;
$config['gridlib']['grid']['opt']['caption'] = "Daftar Isi Program dan Kegiatan Berdasarkan Aturan";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_prokeg_aturan_item";
$config['gridlib']['grid']['opt']['jsonReader']['id'] = "id_prokeg_aturan_item"; // primary key
$config['gridlib']['grid']['opt']['ExpandColumn'] = "uraian";
$config['gridlib']['grid']['opt']['rowNum'] = "100000";

$config['grid']['opt']['treeReader']  = array(
	'level_field'=>"n_level",
	'leaf_field'=>"isLeaf",
	'expanded_field'=>"expanded",
	'parent_id_value'=>"0",
);

$config['gridlib']['arr_colModel']["id_prokeg_aturan_item"] = array(
	'name'=>"id_prokeg_aturan_item",
	'index'=>"id_prokeg_aturan_item",
	'hidden'=>true,
	'key'=>true,
	'editable'=>true,
	);
$config['gridlib']['arr_colModel']["id_prokeg_aturan"] = array(
	'name'=>"id_prokeg_aturan",
	'index'=>"id_prokeg_aturan",
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["id_prokeg"] = array(
	'name'=>"id_prokeg",
	'index'=>"id_prokeg",
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["id_prokeg_jenis"] = array(
	'name'=>"id_prokeg_jenis",
	'index'=>"id_prokeg_jenis",
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["no_urut"] = array(
	'name'=>"no_urut",
	'index'=>"no_urut",
    'width'=>10,
	'hidden'=>true
	);
$config['gridlib']['arr_colModel']["urutan"] = array(
	'name'=>"urutan",
	'index'=>"urutan",
	'width'=>'5',
	'hidden'=>true
	);
$config['gridlib']['arr_colModel']["parent_jenis"] = array(
	'name'=>"parent_jenis",
	'index'=>"parent_jenis",
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["kode_path"] = array(
	'name'=>"kode_path",
	'index'=>"kode_path",
	'label'=>"KODE",
	'width'=>30,
	'editable'=>false,
	);
$config['gridlib']['arr_colModel']["uraian"] = array(
	'name'=>"uraian",
	'index'=>"uraian",
	'label'=>"NAMA ISI HIRARKI",
	'width'=>200,
	'editable'=>false,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true), 
	);
$config['gridlib']['arr_colModel']["jenis"] = array(
	'name'=>"jenis",
	'index'=>"jenis",
	'label'=>"NAMA HIRARKI",
	'width'=>30,
	'editable'=>false,
	'align'=>'center'
	);
$config['gridlib']['arr_colModel']["status"] = array(
	'name'=>"status",
	'index'=>"status",
	'hidden'=>true
	);
$config['gridlib']['arr_colModel']["jml_prokeg"] = array(
	'name'=>"jml_prokeg",
	'index'=>"jml_prokeg",
	'hidden'=>true
	);
 $config['lib']['gf_form']['params_dropdown'] = array(
     'id_prokeg_aturan'=> array(
             'table_name'=>'m_prokeg_aturan',
             'field_value'=>'id_prokeg_aturan',
             'field_label'=>'nama_aturan',
			
       ),
 );
 $config['lib']['gf_form']['inputModel'] =  array(
     'id_prokeg_aturan' => array(
			 'name'=>"id_prokeg_aturan",
			 'index'=>"id_prokeg_aturan",
			 'label'=>"Aturan ",
			 'edittype'=>'select',
 		 ),

	 );
$config['gridlib']['excel'] = array(
    'config' => array(
                'root'=> 0,
                'start_level' => 1,
                'parent_field' => 'id_parent',
                'id_field' => 'id',
                ),
    );
$config['gridlib']['word'] = array(
    'config' => array(
                'root'=> 0,
                'start_level' => 1,
                'parent_field' => 'id_parent',
                'id_field' => 'id',
                )
    );
$config['gridlib']['pdf'] = array(
    'config' => array(
                'root'=> 0,
                'start_level' => 1,
                'parent_field' => 'id_parent',
                'id_field' => 'id',
                )
    );
?>
