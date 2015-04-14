<?
$config['gridlib']['grid']['opt']['caption'] = "Galery";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_galery";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['formprop']['left'] = 30;
$config['gridlib']['grid']['formprop']['top'] = 650;

$config['gridlib']['arr_colModel']["id_galery"] = array(
	'name'=>"id_galery",
	'index'=>"id_galery",
	'label'=>"ID Galery",
	'hidden'=>true,
	'key'=>true,
	);
$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"PROSES",
	'align'=>"center",
	'width'=>40,
	'viewable'=>false,
	'search'=>false,
	);

$config['gridlib']['arr_colModel']["keterangan"] = array(
	'name'=>"keterangan",
	'index'=>"keterangan",
	'label'=>"Keterangan",
	'editable'=>true,
	'width'=>100,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);

?>