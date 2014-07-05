<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Data Penyerahan";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['record'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_ba";

$config['gridlib']['grid']['formprop']['width'] = '650';
$config['gridlib']['grid']['formprop']['left'] = '250';
$config['gridlib']['grid']['formprop']['top'] = '150';

$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();


$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>20,
	'viewable'=>false
	);



$config['gridlib']['arr_colModel']["id_ba"] = array(
	'name'=>"id_ba",
	'index'=>"id_ba",
	'width'=>30,
	'hidden'=>true,

	);
	
$config['gridlib']['arr_colModel']["kepada"] = array(
	'name'=>"kepada",
	'index'=>"kepada",
	'label'=>"KEPADA",
	'width'=>60,
	'edittype'=>'text',

	);	
$config['gridlib']['arr_colModel']["tanggal"] = array(
	'name'=>"tanggal",
	'index'=>"tanggal",
	'label'=>"TANGGAL",
	'width'=>30,
	'editable'=>true,
	'edittype'=>'text','align'=>"center",
	);

$config['gridlib']['arr_colModel']["jumlah"] = array(
	'name'=>"jumlah",
	'index'=>"jumlah",
	'label'=>"JUMLAH ARSIP",
	'width'=>30,
	'editable'=>true,
	'edittype'=>'text','align'=>"center",
	'editrules'=>array('required'=>true), 
	);
$config['gridlib']['arr_colModel']["jumlah_box"] = array(
	'name'=>"jumlah_box",
	'index'=>"jumlah_box",
	'label'=>"JUMLAH BOX",
	'width'=>30,
	'editable'=>true,
	'edittype'=>'text','align'=>"center",
	'editrules'=>array('required'=>true), 
	);		
	
$config['gridlib']['arr_colModel']["instansi"] = array(
	'name'=>"instansi",
	'index'=>"instansi",
	'label'=>"INSTANSI",
	'width'=>60,
	);

$config['gridlib']['arr_colModel']["id_skpd"] = array(
	'name'=>"id_skpd",
	'index'=>"id_skpd",
	'label'=>"ID SKPD",
	'width'=>60,
	'hidden'=>true
	);

?>
