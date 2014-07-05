<?
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['treeGrid'] = true;
$config['gridlib']['grid']['opt']['caption'] = "Daftar Menu";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_menu";
$config['gridlib']['grid']['opt']['jsonReader']['id'] = "id_menu"; // primary key
$config['gridlib']['grid']['opt']['ExpandColumn'] = "menu_name";
//$config['gridlib']['grid']['opt']['postData'] = array();
$config['gridlib']['arr_colModel']["id_menu"] = array(
	'name'=>"id_menu",
	'index'=>"id_menu",
	'hidden'=>true,
	'key'=>true,
	);
$config['gridlib']['arr_colModel']["id_group"] = array(
	'name'=>"id_group",
	'index'=>"id_group",
	'label'=>"id_group",
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["cek"] = array(
	'name'=>"cek",
	'index'=>"cek",
	'label'=>"cek",
	'align'=>"center",
	'width'=>'20'
	);
$config['gridlib']['arr_colModel']["menu_name"] = array(
	'name'=>"menu_name",
	'index'=>"menu_name",
	'label'=>"Nama Menu",
	'editable'=>true,
	'width'=>300,
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
	'width'=>20,
	'edittype'=>'checkbox',
	'editoptions'=>array('size'=>40),
 	'editrules'=>array('required'=>true),
	);
$config['lib']['gf_form']['params_dropdown'] = array(
    'id_group'=> array(
            'table_name'=>'c_group',
            'field_value'=>'id_group',
            'field_label'=>'nama_singkat',
      ),
);
$config['lib']['gf_form']['inputModel'] =  array(
	'id_group' => array(
	'name'=>"id_group",
	'index'=>"id_group",
	'label'=>"Grup ",
	'edittype'=>'select',
	),
);
?>