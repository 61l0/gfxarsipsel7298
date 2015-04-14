<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Daftar SKPD Per SOTK";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_skpd_sotk";
$config['gridlib']['grid']['opt']['rowNum'] = 10000;
$config['gridlib']['grid']['opt']['rownumbers'] = true;
$config['gridlib']['grid']['opt']['pginput'] = false;
$config['gridlib']['grid']['opt']['pgbuttons'] = false;

$config['gridlib']['arr_colModel']["id_skpd_sotk"] = array(
	'name'=>"id_skpd_sotk",
	'index'=>"id_skpd_sotk",
	'key'=>true,
	'hidden'=>true,
	);
$config['gridlib']['arr_colModel']["id_skpd"] = array(
	'name'=>"id_skpd",
	'index'=>"id_skpd",
	'hidden'=>true,
	);

$config['gridlib']['arr_colModel']["nama_lengkap"] = array(
	'name'=>"nama_lengkap",
	'index'=>"nama_lengkap",
	'label'=>"Nama Lengkap",
	'width'=>200,
	'editable'=>false,
	);
$config['gridlib']['arr_colModel']["nama_singkat"] = array(
	'name'=>"nama_singkat",
	'index'=>"nama_singkat",
	'label'=>"Nama Singkat",
	'width'=>100,
	'editable'=>false,
	);
$config['gridlib']['arr_colModel']["urutan"] = array(
	'name'=>"urutan",
	'index'=>"urutan",
	'label'=>'Urutan',
	'align'=>'center',
	'width'=>40,
	'editable'=>false
	);

$config['lib']['gf_form']['params_dropdown'] = array(
    'id_aturan_skpd'=> array(
            'table_name'=>'m_sotk',
            'field_value'=>'id_aturan_skpd',
            'field_label'=>'nama_aturan',
      ),
);
$config['lib']['gf_form']['inputModel'] =  array(
    'id_aturan_skpd' => array(
			'name'=>"id_aturan_skpd",
			'index'=>"id_aturan_skpd",
			'label'=>"SOTK",
			'edittype'=>'select',
 		),
	);
?>
