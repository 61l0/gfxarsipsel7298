<?
$config['gridlib']['grid']['opt']['caption'] = "Daftar Pengguna Online";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_user";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['formprop']['width'] = 500;
$config['gridlib']['grid']['opt']['rownumbers'] = true;

$config['gridlib']['arr_colModel']["id_user"] = array(
	'name'=>"id_user",
	'index'=>"id_user",
	'hidden'=>true,
	'key'=>true,
	);
// $config['gridlib']['arr_colModel']["act"] = array(
	// 'name'=>"act",
	// 'index'=>"act",
	// 'label'=>"AKSI",
	// 'align'=>"center",
	// 'width'=>30,
	// 'viewable'=>false,
	// 'search'=>false,
	// );
$config['gridlib']['arr_colModel']["user_name"] = array(
	'name'=>"user_name",
	'index'=>"user_name",
	'label'=>"NAMA USER",
	'editable'=>true,
	'width'=>20,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40),
 	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["nama_lengkap"] = array(
	'name'=>"nama_lengkap",
	'index'=>"nama_lengkap",
	'label'=>"SKPD",
	'editable'=>true,
	'width'=>40,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40),
 	'editrules'=>array('required'=>true),
	);

// $config['gridlib']['arr_colModel']["ip_address"] = array(
	// 'name'=>"ip_address",
	// 'index'=>"ip_address",
	// 'label'=>"IP ADDRESS",
	// 'editable'=>true,
	// 'width'=>80,
	// 'formoptions'=>array('elmsuffix'=>'(*)'),
	// 'edittype'=>'text',
	// 'editoptions'=>array('size'=>40),
 	// 'editrules'=>array('required'=>true),
	// );

$config['gridlib']['arr_colModel']["last_activity"] = array(
	'name'=>"last_activity",
	'index'=>"last_activity",
	'label'=>"Last Activity",
	'editable'=>true,
	'width'=>40,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40),
 	'editrules'=>array('required'=>true),
 	// 'hidden'=>true
	);
