<?
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Tim Anggaran Pemerintah Daerah";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_tapd";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);


$config['gridlib']['arr_colModel']["id_tapd"] = array(	
	'name'=>"id_tapd",	
	'index'=>"id_tapd",	
	'hidden'=>true,	
	'key'=>true,	
	);
$config['gridlib']['arr_colModel']["act"] = array(	
	'name'=>"act",	
	'index'=>"act",	'
	label'=>"AKSI",	
	'align'=>"center",
	'width'=>20,	
	'viewable'=>false,		
	'search'=>false,	
	);
$config['gridlib']['arr_colModel']["nama"] = array(	
	'name'=>"nama",	
	'index'=>"nama",	
	'label'=>"NAMA",	
	'editable'=>true,	
	'width'=>130,	
	'formoptions'=>array('elmsuffix'=>'(*)'),	
	'edittype'=>'text',	
	'editoptions'=>array('size'=>50), 	
	'editrules'=>array('required'=>true),	
	);

$config['gridlib']['arr_colModel']["nip"] = array(
	'name'=>"nip",
	'index'=>"nip",
	'label'=>"NIP",
	'editable'=>true,
	'edittype'=>'text',	
	'width'=>70,
	'formoptions'=>array(
		'elmsuffix'=>'(*)'
	),
	'editrules'=>array('required'=>true,'number'=>true),
	'align'=>'center'
	);
$config['gridlib']['arr_colModel']["jabatan"] = array(
	'name'=>"jabatan",
	'index'=>"jabatan",
	'label'=>"JABATAN",
	'editable'=>true,	
	'width'=>120,
	'formoptions'=>array(
		'elmsuffix'=>'(*)'
	),
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["id_periode"] = array(
	'name'=>"id_periode",
	'index'=>"id_periode",
	'label'=>"id_periode",
	'editable'=>true,
	'hidden'=>true,	
	'width'=>100,
	'edittype'=>'text',
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["tahun"] = array(
	'name'=>"tahun",
	'index'=>"tahun",
	'label'=>"TAHUN ANGGARAN",
	'editable'=>false,	
	'width'=>75,
	'edittype'=>'text',
	'editrules'=>array('required'=>true),
	'align'=>'center'
	);
$config['lib']['gf_form']['params_dropdown'] = array(
    'id_periode'=> array(
            'table_name'=>'m_periode a',
            'field_value'=>'a.id_periode',
            'field_label'=>'tahun',
      ),
);
$config['lib']['gf_form']['inputModel'] =  array(
    'id_periode' => array(
			'name'=>"id_periode",
			'index'=>"id_periode",
			'label'=>"Filter Data >> Pilih Tahun Anggaran ",
			'edittype'=>'select',
 		),
	);

?>