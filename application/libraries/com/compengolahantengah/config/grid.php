<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Data Pengolahan";
$config['gridlib']['grid']['opt']['pgbuttons'] = true;
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['record'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_data";

$config['gridlib']['grid']['formprop']['width'] = '650';
$config['gridlib']['grid']['formprop']['left'] = '250';
$config['gridlib']['grid']['formprop']['top'] = '150';

$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();

$config['gridlib']['grid']['formprop']['delData'] = array();
$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>20,
	'viewable'=>false
	);



$config['gridlib']['arr_colModel']["no_arsip"] = array(
	'name'=>"no_arsip",
	'index'=>"no_arsip",
	'label'=>"NO ARSIP",
	'width'=>30,
	'edittype'=>'text',
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>No Arsip(*)</strong>')

	);	
$config['gridlib']['arr_colModel']["id_data"] = array(
	'name'=>"id_data",
	'index'=>"id_data",
	'width'=>30,
	'hidden'=>true,

	);	
$config['gridlib']['arr_colModel']["id_lokasisimpan"] = array(
	'name'=>"id_lokasisimpan",
	'index'=>"id_lokasisimpan",
	'width'=>30,
	'hidden'=>true,

	);	
$config['gridlib']['arr_colModel']["judul"] = array(
	'name'=>"judul",
	'index'=>"judul",
	'label'=>"JUDUL ARSIP",
	'width'=>100,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true,'edithidden'=>false),
	'formoptions'=>array('label'=>'<strong>Judul Arsip(*)</strong>')
	);

$config['gridlib']['arr_colModel']["tahun"] = array(
	'name'=>"tahun",
	'index'=>"tahun",
	'label'=>"TAHUN",
	'width'=>15,
	'editable'=>true,
	'edittype'=>'text',
	'editrules'=>array('required'=>true), 
	);	
	
$config['gridlib']['arr_colModel']["rak_rool"] = array(
	'name'=>"rak_rool",
	'index'=>"rak_rool",
	'label'=>"RAK/ROOL O'PEEK",
	'width'=>20,
	);
$config['gridlib']['arr_colModel']["box"] = array(
	'name'=>"box",
	'index'=>"box",
	'label'=>"BOX",
	'width'=>20,
	);
$config['gridlib']['arr_colModel']["folder"] = array(
	'name'=>"folder",
	'index'=>"folder",
	'label'=>"FOLDER",
	'width'=>20,
	);
$config['gridlib']['arr_colModel']["status"] = array(
	'name'=>"status",
	'index'=>"status",
	'label'=>"STATUS",
	'width'=>20,
	);
$config['gridlib']['arr_colModel']["keterangan"] = array(
	'name'=>"keterangan",
	'index'=>"keterangan",
	'label'=>"KETERANGAN",
	'width'=>20,
	);



?>
