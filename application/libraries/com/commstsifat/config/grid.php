<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Master Sifat";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_sifat";

$config['gridlib']['grid']['formprop']['width'] = '650';
$config['gridlib']['grid']['formprop']['left'] = '250';
$config['gridlib']['grid']['formprop']['top'] = '150';

$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();


$config['gridlib']['arr_colModel']["id_sifat"] = array(
	'name'=>"id_sifat",
	'index'=>"id_sifat",
	'hidden'=>true,
	'key'=>true,
	'editable'=>true,
	);

$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>20,
	'viewable'=>false
	);

$config['gridlib']['arr_colModel']["name"] = array(
	'name'=>"name",
	'index'=>"name",
	'label'=>"SIFAT",
	'width'=>200,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Sifat(*)</strong>')
	);


?>
