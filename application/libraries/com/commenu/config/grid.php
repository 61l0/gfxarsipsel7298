<?
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['treeGrid'] = true;
$config['gridlib']['grid']['opt']['caption'] = "Daftar Menu";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_menu";
$config['gridlib']['grid']['opt']['jsonReader']['id'] = "id_menu"; // primary key
$config['gridlib']['grid']['opt']['ExpandColumn'] = "menu_name";
$config['gridlib']['grid']['opt']['rowNum'] = 'auto';
$config['gridlib']['arr_colModel']["id_menu"] = array(	
	'name'=>"id_menu",	
	'index'=>"id_menu",	
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
$config['gridlib']['arr_colModel']["menu_name"] = array(	
	'name'=>"menu_name",	
	'index'=>"menu_name",	
	'label'=>"Nama Menu",	
	'editable'=>true,	
	'width'=>100,	
	'formoptions'=>array('elmsuffix'=>'(*)'),	
	'edittype'=>'text',	
	'editoptions'=>array(
		'size'=>40), 	
		'editrules'=>array('required'=>true),	
		);
$config['gridlib']['arr_colModel']["menu_path"] = array(	
	'name'=>"menu_path",	
	'index'=>"menu_path",
	'label'=>"Nama Path",	
	'editable'=>true,	
	'width'=>100,	
	'formoptions'=>array('elmsuffix'=>'(*)'),	
	'edittype'=>'text',		
	'editoptions'=>array('size'=>40), 	
		'editrules'=>array('required'=>true),	
	);
$config['gridlib']['arr_colModel']["menu_icon"] = array(	
	'name'=>"menu_icon",	
	'index'=>"menu_icon",	
	'label'=>"Nama Icon",	
	'editable'=>true,	
	'width'=>100,	
	'formoptions'=>array('elmsuffix'=>'(*)'),	
	'edittype'=>'text',	
	'editoptions'=>array('size'=>40), 	
	'editrules'=>array('required'=>true),	
	);
$config['gridlib']['arr_colModel']["menu_index"] = array(	
	'name'=>"menu_index",	
	'index'=>"menu_index",	
	'label'=>"Nama Index",	
	'editable'=>true,	
	'width'=>100,	
	'formoptions'=>array('elmsuffix'=>'(*)'),	
	'edittype'=>'text',	
	'editoptions'=>array('size'=>40), 	
	'editrules'=>array('required'=>true),	
	);
$config['gridlib']['arr_colModel']["status"] = array(	
	'name'=>"status",	
	'index'=>"status",	
	'label'=>"Status",	
	'editable'=>true,	
	'width'=>100,	
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'checkbox',
	'editoptions'=>array(
	    'size'=>40,
	    ),
 	);
?>