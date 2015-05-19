<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Catatan Masuk";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_catatan_admin";

$config['gridlib']['grid']['formprop']['width'] = '650';
$config['gridlib']['grid']['formprop']['left'] = '250';
$config['gridlib']['grid']['formprop']['top'] = '150';

$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();


$config['gridlib']['arr_colModel']["id_catatan_admin"] = array(
	'name'=>"id_catatan_admin",
	'index'=>"id_catatan_admin",
	'hidden'=>true,
	'key'=>true,
	'editable'=>true,
	);

	
$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>50,
	'viewable'=>false
	);

$config['gridlib']['arr_colModel']["nama_pengirim"] = array(
	'name'=>"nama_pengirim",
	'index'=>"nama_pengirim",
	'label'=>"NAMA PENGIRIM",
	'width'=>200,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);

$config['gridlib']['arr_colModel']["nama_penerima"] = array(
	'name'=>"nama_penerima",
	'index'=>"nama_penerima",
	'label'=>"SKPD",
	'width'=>200,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
	
$config['gridlib']['arr_colModel']["judul"] = array(
	'name'=>"judul",
	'index'=>"judul",
	'label'=>"JUDUL",
	'width'=>200,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);
	
$config['gridlib']['arr_colModel']["tanggal"] = array(
	'name'=>"tanggal",
	'index'=>"tanggal",
	'label'=>"TANGGAL",
	'width'=>80,
	'editable'=>true,
	'edittype'=>'text',
	'align'=>'center',
	'editoptions'=>array('size'=>50), 
	);




?>
