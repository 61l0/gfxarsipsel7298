<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Surat Masuk dan Surat Keluar";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_lap_skpd";

$config['gridlib']['grid']['formprop']['width'] = '850';
$config['gridlib']['grid']['formprop']['height'] = '800';
$config['gridlib']['grid']['formprop']['left'] = '250';
$config['gridlib']['grid']['formprop']['top'] = '150';

$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();


$config['gridlib']['arr_colModel']["id_lap_skpd"] = array(
	'name'=>"id_lap_skpd",
	'index'=>"id_lap_skpd",
	'hidden'=>true,
	'key'=>true,
	'editable'=>true,
	);
$config['gridlib']['arr_colModel']["type_surat"] = array(
	'name'=>"type_surat",
	'index'=>"type_surat",
	'hidden'=>true,
	'key'=>true,
	'editable'=>false,
	);
$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>25,
	'viewable'=>false
	);

$config['gridlib']['arr_colModel']["kode"] = array(
	'name'=>"kode",
	'index'=>"kode",
	'label'=>"KODE",
	'width'=>25,
	'editable'=>true,
	'align' => 'center',
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);

// $config['gridlib']['arr_colModel']["tanggal_diteruskan"] = array(
// 	'name'=>"tanggal_diteruskan",
// 	'index'=>"tanggal_diteruskan",
// 	'label'=>"TANGGAL DITERUSKAN",
// 	'width'=>25,
// 	'editable'=>true,
// 	'edittype'=>'text','formatter'=>'date',
// 	'editoptions'=>array('size'=>50), 
// 	'datefmt'=>'d-m-Y'
// 	);
$config['gridlib']['arr_colModel']["tanggal_surat"] = array(
	'name'=>"tanggal_surat",
	'index'=>"tanggal_surat",
	'label'=>"TANGGAL SURAT",
	'width'=>25,
	'editable'=>true,
	'edittype'=>'text',
	'align'=>'center',
	'editoptions'=>array('size'=>50), 
	//'datefmt'=>'d/m/Y'
	);

$config['gridlib']['arr_colModel']["no_surat"] = array(
	'name'=>"no_surat",
	'index'=>"no_surat",
	'label'=>"NOMOR",
	'width'=>25,
	'editable'=>true,
	'edittype'=>'text',

	'editoptions'=>array('size'=>50), 
	);

$config['gridlib']['arr_colModel']["perihal"] = array(
	'name'=>"perihal",
	'index'=>"perihal",
	'label'=>"PERIHAL",
	'width'=>25,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
	
$config['gridlib']['arr_colModel']["seri"] = array(
	'name'=>"seri",
	'index'=>"seri",
	'label'=>"SERI",
	'width'=>25,
	'align'=>'center',
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50,'align'=>'center'), 
	);

$config['gridlib']['arr_colModel']["rubrik"] = array(
	'name'=>"rubrik",
	'index'=>"rubrik",
	'label'=>"RUBRIK",
	'width'=>25,
	'align'=>'center',
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);

$config['gridlib']['arr_colModel']["dosir"] = array(
	'name'=>"dosir",
	'index'=>"dosir",
	'label'=>"DOSIR",
	'width'=>25,
	'align'=>'center',
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
	
$config['gridlib']['arr_colModel']["cabinet"] = array(
	'name'=>"cabinet",
	'index'=>"cabinet",
	'label'=>"CABINET",
	'width'=>25,
	'align'=>'center',
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);

	$config['gridlib']['arr_colModel']["rak"] = array(
	'name'=>"rak",
	'index'=>"rak",
	'label'=>"RAK",
	'width'=>25,
	'align'=>'center',
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);

$config['gridlib']['arr_colModel']["boks"] = array(
	'name'=>"boks",
	'index'=>"boks",
	'label'=>"BOKS",
	'width'=>25,
	'align'=>'center',
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
	

?>
