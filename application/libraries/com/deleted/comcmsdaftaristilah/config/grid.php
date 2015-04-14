<?
$config['gridlib']['grid']['opt']['caption'] = "Daftar Istilah";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_daftar_istilah";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);

$config['gridlib']['grid']['formprop']['width'] = 500;

$config['gridlib']['arr_colModel']["id_daftar_istilah"] = array(
	'name'=>"id_daftar_istilah",
	'index'=>"id_daftar_istilah",
	'hidden'=>true,
	'key'=>true,
	);
$config['gridlib']['arr_colModel']["ins"] = array(
	'name'=>"ins",
	'index'=>"ins",
	'label'=>"PROSES",
	'align'=>"center",
	'width'=>30,
	'viewable'=>false,
	'search'=>false,
	);
$config['gridlib']['arr_colModel']["abjad"] = array(	
	'name'=>"abjad",	
	'index'=>"abjad",	
	'label'=>"Abjad",	
	'editable'=>true,
	'hidden'=>true,
	'editrules'=>array('required'=>true,'edithidden'=>true),
	'width'=>50,
	'align'=>'center',
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'select',
	'editoptions'=>array('size'=>40),
 	);
$config['gridlib']['arr_colModel']["istilah"] = array(
	'name'=>"istilah",
	'index'=>"istilah",
	'label'=>"Istilah",
	'editable'=>true,
	'width'=>100,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["penjelasan"] = array(
	'name'=>"penjelasan",
	'index'=>"penjelasan",
	'label'=>"Penjelasan",
	'editable'=>true,
	'align'=>'justify',
	'width'=>200,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'textarea',
	'editoptions'=>array('cols'=>40,'rows'=>5), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["status"] = array(	
	'name'=>"status",	
	'index'=>"status",	
	'label'=>"Status",	
	'editable'=>true,	
	'width'=>30,
	'align'=>'center',
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'select',
	'editoptions'=>array('size'=>40,'value'=>array('pending'=>'Pending','publish'=>'Publish')),
 	);
?>