<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['treeGrid'] = true;
$config['gridlib']['grid']['opt']['caption'] = "Master Retensi";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_retensi";
$config['gridlib']['grid']['opt']['jsonReader']['id'] = "id_retensi"; // primary key
$config['gridlib']['grid']['opt']['ExpandColumn'] = "desc";

$config['gridlib']['grid']['formprop']['dataheight'] = '80';
$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();

$config['grid']['opt']['treeReader']  = array(
	'level_field'=>"n_level",
	'parent_id_field'=>"id_parent",
	'leaf_field'=>"isLeaf",
	'expanded_field'=>"expanded",
	'parent_id_value'=>"0",
);

$config['gridlib']['arr_colModel']["id_retensi"] = array(
	'name'=>"id_retensi",
	'index'=>"id_retensi",
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

$config['gridlib']['arr_colModel']["desc"] = array(
	'name'=>"desc",
	'index'=>"desc",
	'label'=>"DESCRIPSI",
	'width'=>60,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>30), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Nama Lokasi Simpan (*)</strong>')
	);
$config['gridlib']['arr_colModel']["aktif"] = array(
	'name'=>"aktif",
	'index'=>"aktif",
	'label'=>"AKTIF",
	'width'=>20,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>20), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Aktif (*)</strong>')
	);

$config['gridlib']['arr_colModel']["inaktif"] = array(
	'name'=>"inaktif",
	'index'=>"inaktif",
	'label'=>"INAKTIF",
	'width'=>20,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>20), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Inaktif (*)</strong>')
	);
	
$config['gridlib']['arr_colModel']["keterangan"] = array(
	'name'=>"keterangan",
	'index'=>"keterangan",
	'label'=>"KETERANGAN",
	'width'=>60,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>20), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Keterangan (*)</strong>')
	);



?>
