<?
$config['gridlib']['grid']['opt']['caption'] = "Log Aktifitas Pengguna";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_log";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = false;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['formprop']['width'] = 500;
$config['gridlib']['arr_colModel']["id_log"] = array(
	'name'=>"id_log",
	'index'=>"id_log",
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
$config['gridlib']['arr_colModel']["user_id"] = array(
	'name'=>"user_id",
	'index'=>"user_id",
	'label'=>"User ID",
	'width'=>30,
	);
$config['gridlib']['arr_colModel']["username"] = array(
	'name'=>"username",
	'index'=>"username",
	'label'=>"Username",
	'width'=>30,
	);
$config['gridlib']['arr_colModel']["user_group"] = array(
	'name'=>"user_group",
	'index'=>"user_group",
	'label'=>"User Group",
	'width'=>30,
	);
$config['gridlib']['arr_colModel']["oper"] = array(
	'name'=>"oper",
	'index'=>"oper",
	'label'=>"Operasi",
	'width'=>30,
	);
$config['gridlib']['arr_colModel']["module"] = array(
	'name'=>"module",
	'index'=>"module",
	'label'=>"Modul",
	'width'=>30,
	);

$config['gridlib']['arr_colModel']["id_data"] = array(
	'name'=>"id_data",
	'index'=>"id_data",
	'label'=>"ID Data",
	'width'=>30,
	);

$config['gridlib']['arr_colModel']["tgl_oper"] = array(
	'name'=>"tgl_oper",
	'index'=>"tgl_oper",
	'label'=>"Tanggal Operasi",
	'width'=>30,
	);