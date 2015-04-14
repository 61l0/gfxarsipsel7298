<?
$config['gridlib']['grid']['opt']['caption'] = "Tautan Manager";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_tautan";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);

$config['gridlib']['grid']['formprop']['width'] = 500;

$config['gridlib']['arr_colModel']["id_tautan"] = array(
	'name'=>"id_tautan",
	'index'=>"id_tautan",
	'hidden'=>true,
	'key'=>true,
	);
$config['gridlib']['arr_colModel']["ins"] = array(
	'name'=>"ins",
	'index'=>"ins",
	'label'=>"PROSES",
	'align'=>"center",
	'width'=>20,
	'viewable'=>false,
	'search'=>false,
	);
$config['gridlib']['arr_colModel']["id_kanal"] = array(
	'name'=>"id_kanal",
	'index'=>"id_kanal",
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["urutans"] = array(
	'name'=>"urutans",
	'index'=>"urutans",
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["ins_urut"] = array(
	'name'=>"ins_urut",
	'index'=>"ins_urut",
	'label'=>"URUTAN",
	'width'=>20,
	'viewable'=>true
	);
$config['gridlib']['arr_colModel']["tautan_link"] = array(
	'name'=>"tautan_link",
	'index'=>"tautan_link",
	'label'=>"Tautan Text",
	'editable'=>true,
	'width'=>100,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["tautan_url"] = array(
	'name'=>"tautan_url",
	'index'=>"tautan_url",
	'label'=>"Tatutan URL",
	'editable'=>true,
	'width'=>100,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["id_kanal"] = array(
	'name'=>"id_kanal",
	'index'=>"id_kanal",
	'label'=>"Kanal",
	'editable'=>true,
	'viewable'=>false,
	'hidden'=>true,
	'width'=>50,
	'formoptions'=>array('label'=>'<strong>Kanal(*)</strong>'),
	'edittype'=>'select',
	'editrules'=>array('edithidden'=>true), 
	);
$config['gridlib']['arr_colModel']["urutan"] = array(
	'name'=>"urutan",
	'index'=>"urutan",
	'label'=>"Urutan",
	'editable'=>true,
	'width'=>30,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>5), 
	'editrules'=>array('required'=>true),
	);

$config['gridlib']['arr_colModel']["status"] = array(	
	'name'=>"status",	
	'index'=>"status",	
	'label'=>"Status",	
	'editable'=>true,	
	'width'=>30,
	'align'=>'center',
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'checkbox',
	'editoptions'=>array(
	    'size'=>40,
	    ),
 	);
$config['lib']['gf_form']['params_dropdown'] = array(
    'id_menus'=> array(
            'table_name'=>'public_menu',
            'field_value'=>'id_menu',
            'field_label'=>'menu_name',
			'db_query' =>array(	
			            'order_by'=>array('menu_index'),
	                    'where'=>array('level',1)
	                )
      ),
);
$config['lib']['gf_form']['inputModel'] =  array(
    'id_menus' => array(
			'name'=>"id_menus",
			'index'=>"id_menus",
			'label'=>"Kanal",
			'edittype'=>'select',
 		),

	);
?>