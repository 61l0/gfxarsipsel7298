<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Pemusnahan";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_data";

$config['gridlib']['grid']['formprop']['width'] = '650';
$config['gridlib']['grid']['formprop']['left'] = '250';
$config['gridlib']['grid']['formprop']['top'] = '150';

$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();


$config['gridlib']['arr_colModel']["id_data"] = array(
	'name'=>"id_data",
	'index'=>"id_data",
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
$config['gridlib']['arr_colModel']["no_arsip"] = array(
	'name'=>"no_arsip",
	'index'=>"no_arsip",
	'label'=>"NOMOR BERKAS",
	'width'=>25,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
$config['gridlib']['arr_colModel']["judul"] = array(
	'name'=>"judul",
	'index'=>"judul",
	'label'=>"JUDUL ARSIP",
	'width'=>80,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true,'edithidden'=>false),
	'formoptions'=>array('label'=>'<strong>Judul Arsip(*)</strong>')
	);

$config['gridlib']['arr_colModel']["status_text"] = array(
	'name'=>"status_text",
	'index'=>"status_text",
	'label'=>"status_text",
	'width'=>25,
	'hidden'=>true,
	'editable'=>false,
	'edittype'=>'hidden',
	'align'=>'center'
	);

$config['gridlib']['arr_colModel']["agenda"] = array(
	'name'=>"agenda",
	'index'=>"agenda",
	'label'=>"AGENDA",
	'width'=>25,
	'hidden'=>true,
	'editable'=>false,
	'edittype'=>'hidden',
	'align'=>'center'
	);
$config['gridlib']['arr_colModel']["kode_komponen"] = array(
	'name'=>"kode_komponen",
	'index'=>"kode_komponen",
	'label'=>"KODE KOMPONEN",
	'width'=>25,
	'hidden'=>true,
	'editable'=>false,
	'edittype'=>'hidden',
	'align'=>'center'
	);
$config['gridlib']['arr_colModel']["tahun"] = array(
	'name'=>"tahun",
	'index'=>"tahun",
	'label'=>"TAHUN",
	'width'=>10,
	// 'hidden'=>true,
	'editable'=>false,
	'edittype'=>'hidden',
	'align'=>'center'
	);
// $config['gridlib']['arr_colModel']["tanggal"] = array(
// 	'name'=>"tanggal",
// 	'index'=>"tanggal",
// 	'label'=>"TANGGAL ARSIP",
// 	'width'=>20,
// 	'editable'=>true,
// 	'align'=>'center',
// 	'edittype'=>'text',
// 	'editoptions'=>array('size'=>50), 
// 	);
$config['gridlib']['arr_colModel']["rt_aktif"] = array(
	'name'=>"rt_aktif",
	'index'=>"rt_aktif",
	'label'=>"AKTIF",
	'width'=>20,
	'editable'=>true,
	'align'=>'center',
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
$config['gridlib']['arr_colModel']["rt_inaktif"] = array(
	'name'=>"rt_inaktif",
	'index'=>"rt_inaktif",
	'label'=>"INAKTIF",
	'width'=>20,
	'editable'=>true,
	'align'=>'center',
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
$config['gridlib']['arr_colModel']["rt_desc"] = array(
	'name'=>"rt_desc",
	'index'=>"rt_desc",
	'label'=>"KETERANGAN",
	'width'=>20,
	'editable'=>true,
	'align'=>'center',
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
$config['gridlib']['arr_colModel']["status"] = array(
	'name'=>"status",
	'index'=>"status",
	'label'=>"STATUS",
	'width'=>25,
	'editable'=>true,
	'edittype'=>'text',
	'align'=>'center',
	'editoptions'=>array('size'=>50), 
	);
	
?>
