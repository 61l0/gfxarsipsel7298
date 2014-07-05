<?
$config['gridlib']['grid']['opt']['caption'] = "Kategori Galeri Foto";
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_video";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);

$config['gridlib']['arr_colModel']["id_video"] = array(
	'name'=>"id_video",
	'index'=>"id_video",
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
$config['gridlib']['arr_colModel']["judul_video"] = array(
	'name'=>"judul_video",
	'index'=>"judul_video",
	'label'=>"Judul Video",
	'editable'=>true,
	'width'=>100,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["tanggal"] = array(
	'name'=>"tanggal",
	'index'=>"tanggal",
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
$config['gridlib']['arr_colModel']["keterangan"] = array(
	'name'=>"keterangan",
	'index'=>"keterangan",
	'label'=>"Keterangan",
	'editable'=>true,
	'width'=>100,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["sumbet"] = array(
	'name'=>"sumber",
	'index'=>"sumber",
	'label'=>"Sumber",
	'editable'=>true,
	'width'=>50,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["video_file"] = array(
	'name'=>"video_file",
	'index'=>"video_file",
	'label'=>"Video File",
	'editable'=>true,
	'width'=>50,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
	);
$config['gridlib']['arr_colModel']["video_image"] = array(
	'name'=>"video_image",
	'index'=>"video_image",
	'label'=>"Video Image",
	'editable'=>true,
	'width'=>50,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'edittype'=>'text',
	'editoptions'=>array('size'=>40), 
	'editrules'=>array('required'=>true),
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
	'editoptions'=>array('size'=>10,'value'=>array('publish'=>'Publish','pending'=>'Pending')), 
	'editrules'=>array('required'=>true,'edithidden'=>true),
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
$config['lib']['gf_form']['params_dropdown'] = array(
    'id_kategori'=> array(
            'table_name'=>'video_kategori',
            'field_value'=>'id_kategori',
            'field_label'=>'nama_kategori',
      ),
);
$config['lib']['gf_form']['inputModel'] =  array(
    'id_kategori' => array(
			'name'=>"id_kategori",
			'index'=>"id_kategori",
			'label'=>"Kategori",
			'edittype'=>'select',
 		),

	);
?>