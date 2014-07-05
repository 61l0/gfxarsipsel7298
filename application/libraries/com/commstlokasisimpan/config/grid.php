<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['treeGrid'] = true;
$config['gridlib']['grid']['opt']['caption'] = "Master Lokasi Simpan";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_lokasi_simpan";
$config['gridlib']['grid']['opt']['jsonReader']['id'] = "id_lokasi_simpan"; // primary key
$config['gridlib']['grid']['opt']['ExpandColumn'] = "name";
$config['gridlib']['grid']['opt']['rowNum'] = "500";

$config['gridlib']['grid']['formprop']['dataheight'] = '80';

$config['grid']['opt']['treeReader']  = array(
	'level_field'=>"n_level",
	'parent_id_field'=>"id_parent",
	'leaf_field'=>"isLeaf",
	'expanded_field'=>"expanded",
	'parent_id_value'=>"0",
);

$config['gridlib']['arr_colModel']["id_lokasi_simpan"] = array(
	'name'=>"id_lokasi_simpan",
	'index'=>"id_lokasi_simpan",
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

$config['gridlib']['arr_colModel']["name"] = array(
	'name'=>"name",
	'index'=>"name",
	'label'=>"NAMA LOKASI SIMPAN",
	'width'=>60,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>30), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Nama Lokasi Simpan (*)</strong>')
	);
$config['gridlib']['arr_colModel']["type"] = array(
	'name'=>"type",
	'index'=>"type",
	'label'=>"TYPE",
	'width'=>20,
	'editable'=>true,
	'hidden'=>true,
	'edittype'=>'select',
	'editrules'=>array('required'=>true,'edithidden'=>true), 
	);

$config['gridlib']['arr_colModel']["type_text"] = array(
	'name'=>"type_text",
	'index'=>"type_text",
	'label'=>"JENIS",
	'width'=>40,
	'editable'=>false,
	);

?>
