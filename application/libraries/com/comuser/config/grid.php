<?
$config['gridlib']['grid']['opt']['caption'] = "Daftar Pengguna";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "user_id";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['width'] = 'auto';
$config['gridlib']['grid']['formprop']['width'] = 750;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);

$config['gridlib']['arr_colModel']["user_id"] = array(
	'name'=>"user_id",
	'index'=>"user_id",
	'label'=>"ID user",
	'hidden'=>true,
	'key'=>true,
	);
$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>60,
	'viewable'=>false,
	'search'=>false,
	);
$config['gridlib']['arr_colModel']["group_id"] = array(
	'name'=>"group_id",
	'index'=>"group_id",
	'label'=>"Group",
	'hidden'=>true,
	'editable'=>true,
	'width'=>200,
	'formoptions'=>array('elmsuffix'=>'(*)','label'=>'Group'),
	'edittype'=>'select',
	'editoptions'=>array('dataUrl'=>site_url('admin/com/user/selectgroup'),
						 'dataInit'=>"function(element){
							$(element).change(function(){
								//comusergrid.extra.btnmember();
							})
						 }"
	), 
	'editrules'=>array('edithidden'=>true,'required'=>true),
	'viewable'=>false,
	);
$config['gridlib']['arr_colModel']["user_name"] = array(
	'name'=>"user_name",
	'index'=>"user_name",
	'label'=>"USERNAME",
	'editable'=>true,
	'width'=>75,
	'formoptions'=>array('elmsuffix'=>'(*)','label'=>'Username'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["user_password"] = array(
	'name'=>"user_password",
	'index'=>"user_password",
	'label'=>"User Password",
	'hidden'=>true,
	'editable'=>true,
	'width'=>200,
	'formoptions'=>array('elmsuffix'=>'(*)','label'=>'Password'),
	'edittype'=>'password',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('edithidden'=>true,'required'=>true),
	);
$config['gridlib']['arr_colModel']["instansi"] = array(
	'name'=>"instansi",
	'index'=>"instansi",
	'label'=>"NAMA",
	'editable'=>true,
//	'hidden'=>true,
	'width'=>225,
	'formoptions'=>array('elmsuffix'=>'(*)','label'=>'Nama'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>80), 
	'editrules'=>array('required'=>true),
	);

// $url = site_url('admin/com/mstskpd');
$config['gridlib']['arr_colModel']["id_skpd_sotk"] = array(
	'name'=>"id_skpd_sotk",
	'index'=>"id_skpd_sotk",
	'label'=>"id_skpd_sotk",
	'hidden'=>true,
	'editable'=>true,
	'width'=>200,
	'formoptions'=>array('elmsuffix'=>"<input class=\"FormElement ui-widget-content ui-corner-all\" id=\"txt_skpd\"/><button id=btn_skpd onclick=comusergrid.extra.pilihskpd({name:'comansggota'})>Pilih</button>",
			'label'=>'Skpd'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>10,'maxlengh'=>10,'readonly'=>true),
	'editrules'=>array('edithidden'=>true,'required'=>true),
	'viewable'=>false,
	);
	
$config['gridlib']['arr_colModel']["id_unit_pengolah"] = array(
	'name'=>"id_unit_pengolah",
	'index'=>"id_unit_pengolah",
	'label'=>"id_unit_pengolah",
	'hidden'=>true,
	'editable'=>true,
	'width'=>200,
	'formoptions'=>array('elmsuffix'=>"<input class=\"FormElement ui-widget-content ui-corner-all\" id=\"txt_pengolah\"/><button  id=btn_operator onclick=comusergrid.extra.pilihoperator({name:'commstoperator'})>Pilih</button>",
			'label'=>'Operator'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>10,'maxlengh'=>10,'readonly'=>true),
	'editrules'=>array('edithidden'=>true,'required'=>true),
	'viewable'=>false,
	);
		
$config['gridlib']['arr_colModel']["nama_pengguna"] = array(
	'name'=>"nama_pengguna",
	'index'=>"nama_pengguna",
	'label'=>"Nama Pengguna",
	'hidden'=>true,
	'editable'=>true,
	'width'=>200,
	'formoptions'=>array('elmsuffix'=>'(*)','label'=>'Nama Pengguna'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>80), 
	'editrules'=>array('edithidden'=>true,'required'=>true),
	);
$config['gridlib']['arr_colModel']["group_name"] = array(
	'name'=>"group_name",
	'index'=>"group_name",
	'label'=>"GROUP",
	'editable'=>false,
	'width'=>200,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
?>
