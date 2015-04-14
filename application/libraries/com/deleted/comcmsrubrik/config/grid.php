<?
$config['gridlib']['grid']['opt']['caption'] = "Master Jenis Komoditi";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_menu";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);

$config['gridlib']['grid']['formprop']['width'] = 500;

$config['gridlib']['arr_colModel']["id_menu"] = array(
	'name'=>"id_menu",
	'index'=>"id_menu",
	'hidden'=>true,
	'key'=>true,
	);
$config['gridlib']['arr_colModel']["ins"] = array(
	'name'=>"ins",
	'index'=>"ins",
	'label'=>"PROSES",
	'align'=>"center",
	'width'=>30,
	'viewable'=>false,
	'search'=>false,
	);
$config['gridlib']['arr_colModel']["level"] = array(
	'name'=>"level",
	'index'=>"level",
    'width'=>10,
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["id_group"] = array(
	'name'=>"id_group",
	'index'=>"id_group",
    'width'=>10,
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["urutans"] = array(
	'name'=>"urutans",
	'index'=>"urutans",
    'width'=>10,
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["ins_urut"] = array(
	'name'=>"ins_urut",
	'index'=>"ins_urut",
	'label'=>"URUTAN",
	'width'=>30,
	'viewable'=>true
	);
$config['gridlib']['arr_colModel']["menu_name"] = array(
	'name'=>"menu_name",
	'index'=>"menu_name",
	'label'=>"Kanal",
	'editable'=>false,
	'width'=>200,
	);
$config['gridlib']['arr_colModel']["menu_index"] = array(
	'name'=>"menu_index",
	'index'=>"menu_index",
	'label'=>"Urutan",
	'editable'=>false,
	'align'=>'center',
	'width'=>50,
	);
$config['gridlib']['arr_colModel']["status"] = array(	
	'name'=>"status",	
	'index'=>"status",	
	'label'=>"Status",	
	'editable'=>true,	
	'width'=>50,
	'align'=>'center',
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'checkbox',
	'editoptions'=>array(
	    'size'=>40,
	    ),
 	);
?>