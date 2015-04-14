<?
$config['gridlib']['grid']['opt']['caption'] = "Kategori Galeri Foto";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_kategori";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'height';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);

$config['gridlib']['arr_colModel']["id_kategori"] = array(
	'name'=>"id_kategori",
	'index'=>"id_kategori",
	'label'=>"ID Perusahaan",
	'hidden'=>true,
	'key'=>true,
	);
$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"PROSES",
	'align'=>"center",
	'width'=>30,
	'viewable'=>false,
	'search'=>false,
	);
$config['gridlib']['arr_colModel']["nama_kategori"] = array(
	'name'=>"nama_kategori",
	'index'=>"nama_kategori",
	'label'=>"Nama Kategori",
	'editable'=>true,
	'width'=>200,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["urutan"] = array(
	'name'=>"urutan",
	'index'=>"urutan",
	'label'=>"Urutan",
	'editable'=>true,
	'width'=>30,
	'align'=>'center',
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>10), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["tgl_buat"] = array(
	'name'=>"tgl_buat",
	'index'=>"tgl_buat",
	'label'=>"Tanggal",
	'align'=>'center',
	'editable'=>true,
	'width'=>30,
	'formatter'=>'date',
	'formatoptions'=>array('srcformat'=>"Y-m-d H:i:s", 'newformat'=>"Y-m-d"),
	'editoptions'=>array('size'=>10,'maxlengh'=>10,
						 'dataInit'=>"function(element){
							$(element).datepicker({dateFormat: 'yy-mm-dd'
												   ,changeMonth:true	
													,changeYear:true
													,closeText:'X'
												})
							$('.ui-datepicker').css('z-index','9000')
							
						 }"
					),
	'formoptions'=>array('elmsuffix'=>'(*)'),
	);
$config['gridlib']['arr_colModel']["status"] = array(
	'name'=>"status",
	'index'=>"status",
	'label'=>"Status",
	'align'=>'center',
	'editable'=>true,
	'width'=>30,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'select',
	'editoptions'=>array('size'=>10,'value'=>array('show'=>'Show','hide'=>'Hide')), 
	'editrules'=>array('required'=>true,'edithidden'=>true),
	);
?>