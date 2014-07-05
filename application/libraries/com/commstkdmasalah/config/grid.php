<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['treeGrid'] = true;
$config['gridlib']['grid']['opt']['caption'] = "Master Kode Masalah";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_kode_masalah";
$config['gridlib']['grid']['opt']['jsonReader']['id'] = "id_kode_masalah"; // primary key
$config['gridlib']['grid']['opt']['ExpandColumn'] = "name";
$config['gridlib']['grid']['opt']['rowNum'] = 1000;

$config['gridlib']['grid']['formprop']['dataheight'] = '80';

$config['grid']['opt']['treeReader']  = array(
	'level_field'=>"n_level",
	'parent_id_field'=>"id_parent",
	'leaf_field'=>"isLeaf",
	'expanded_field'=>"expanded",
	'parent_id_value'=>"0",
);

$config['gridlib']['arr_colModel']["id_kode_masalah"] = array(
	'name'=>"id_kode_masalah",
	'index'=>"id_kode_masalah",
	'hidden'=>true,
	'key'=>true,
	'editable'=>true,
	);

$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>10,
	'viewable'=>false
	);

$config['gridlib']['arr_colModel']["kode"] = array(
	'name'=>"kode",
	'index'=>"kode",
	'label'=>"KODE",
	'width'=>10,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>10), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Kode (*)</strong>')
	);
$config['gridlib']['arr_colModel']["name"] = array(
	'name'=>"name",
	'index'=>"name",
	'label'=>"NAMA KODE MASALAH",
	'width'=>60,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>30), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Nama Kode Masalah (*)</strong>')
	);



?>
