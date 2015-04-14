<?
$config['gridlib']['grid']['opt']['autowidth'] = true;
 $config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['treeGrid'] = false;
$config['gridlib']['grid']['opt']['caption'] = "Daftar Pilihan SKPD";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);

$config['gridlib']['arr_colModel']["id_skpd"] = array(
	'name'=>"id_skpd",
	'index'=>"id_skpd",
	'hidden'=>true,
	'key'=>true,
	);

$config['gridlib']['arr_colModel']["id_skpd_2"] = array(
	'name'=>"id_skpd_2",
	'index'=>"id_skpd_2",
	'hidden'=>true,
	);

$config['gridlib']['arr_colModel']["ins"] = array(
	'name'=>"ins",
	'index'=>"ins",
	'label'=>"PILIH",
	'align'=>"center",
	'width'=>15,
	'editable'=>false,
	'viewable'=>false,
	);
/*
$config['gridlib']['arr_colModel']["stat"] = array(
	'name'=>"stat",
	'index'=>"stat",
	'label'=>"Status ON/OFF",
	'align'=>"center",
	'width'=>35,
	'editable'=>false,
	'viewable'=>false,
	);
$config['gridlib']['arr_colModel']["status"] = array(
	'name'=>"status",
	'index'=>"status",
	'hidden'=>true,
	'align'=>'center'
	);
*/
$config['gridlib']['arr_colModel']["nama_lengkap"] = array(
	'name'=>"nama_lengkap",
	'index'=>"nama_lengkap",
	'label'=>"NAMA LENGKAP",
	'width'=>200,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true), 
	);
$config['gridlib']['arr_colModel']["nama_singkat"] = array(
	'name'=>"nama_singkat",
	'index'=>"nama_singkat",
	'label'=>"NAMA SINGKAT",
	'width'=>100,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true), 
	);

?>
