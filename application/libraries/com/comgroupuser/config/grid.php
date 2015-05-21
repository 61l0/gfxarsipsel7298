<?
$config['gridlib']['grid']['opt']['caption'] = "Daftar Grup Pengguna";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_group";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = false;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['formprop']['width'] = 500;
$config['gridlib']['arr_colModel']["id_group"] = array(
	'name'=>"id_group",
	'index'=>"id_group",
	'hidden'=>true,
	'key'=>true,
	);
$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>30,
	'viewable'=>false,
	'search'=>false,
	);
$config['gridlib']['arr_colModel']["group_name"] = array(
	'name'=>"group_name",
	'index'=>"group_name",
	'label'=>"Nama Grup",
	'editable'=>true,
	'width'=>30,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40),
 	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["nama_singkat"] = array(
	'name'=>"nama_singkat",
	'index'=>"nama_singkat",
	'label'=>"Nama Singkat",
	'editable'=>true,
	'width'=>40,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40),
 	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["section_name"] = array(
	'name'=>"section_name",
	'index'=>"section_name",
	'label'=>"Bagian",
	'editable'=>true,
	'width'=>40,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40),
 	'editrules'=>array('required'=>true),
	);
?>