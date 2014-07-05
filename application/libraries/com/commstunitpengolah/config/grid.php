<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Master Pengolahan";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_skpd";

$config['gridlib']['grid']['formprop']['width'] = '650';
$config['gridlib']['grid']['formprop']['left'] = '250';
$config['gridlib']['grid']['formprop']['top'] = '150';

$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();


$config['gridlib']['arr_colModel']["id_skpd"] = array(
	'name'=>"id_skpd",
	'index'=>"id_skpd",
	'hidden'=>true,
	'key'=>true,
	'editable'=>true,
	);

$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>35,
	'viewable'=>false
	);

$config['gridlib']['arr_colModel']["nama_lengkap"] = array(
	'name'=>"nama_lengkap",
	'index'=>"nama_lengkap",
	'label'=>"NAMA LENGKAP",
	'width'=>200,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	);





?>
