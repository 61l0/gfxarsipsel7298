<?
// setting untuk treegrid
$config['gridlib']['grid']['opt']['autowidth'] = true;
$config['gridlib']['grid']['opt']['height'] = 'auto';
$config['gridlib']['grid']['opt']['caption'] = "Data Peminjaman";
$config['gridlib']['grid']['opt']['rowNum'] = 10;
$config['gridlib']['grid']['opt']['rowList'] = array(10,30,50,100);
$config['gridlib']['grid']['opt']['prmNames']['id'] = "id_peminjaman";

$config['gridlib']['grid']['formprop']['width'] = '650';
$config['gridlib']['grid']['formprop']['left'] = '250';
$config['gridlib']['grid']['formprop']['top'] = '150';

$config['gridlib']['grid']['formprop']['editData'] = array();
$config['gridlib']['grid']['formprop']['delData'] = array();


$config['gridlib']['arr_colModel']["id_peminjaman"] = array(
	'name'=>"id_peminjaman",
	'index'=>"id_peminjaman",
	'hidden'=>true,
	'key'=>true,
	);

$config['gridlib']['arr_colModel']["act"] = array(
	'name'=>"act",
	'index'=>"act",
	'label'=>"AKSI",
	'align'=>"center",
	'width'=>16,
	'viewable'=>false
	);



$config['gridlib']['arr_colModel']["id_data"] = array(
	'name'=>"id_data",
	'index'=>"id_data",
	'label'=>"ID DATA",
	'hidden'=>true,
	'width'=>5,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'editoptions'=>array('size'=>10,'readonly'=>true), 
	'editrules'=>array('required'=>true),
	);	
	
$config['gridlib']['arr_colModel']["no_berkas"] = array(
	'name'=>"no_berkas",
	'index'=>"no_berkas",
	'label'=>"NOMOR BERKAS",
	'hidden'=>false,
	'width'=>30,
	'formoptions'=>array('elmsuffix'=>'(*)'),
	'editoptions'=>array('size'=>10,'readonly'=>true), 
	'editrules'=>array('required'=>false),
	);	
$config['gridlib']['arr_colModel']["agenda"] = array(
	'name'=>"agenda",
	'index'=>"agenda",
	'label'=>"AGENDA",
	'hidden'=>true,
	'width'=>5,
	'formoptions'=>array(),
	'editoptions'=>array('size'=>10,'readonly'=>true), 
	'editrules'=>array('required'=>false),
	);		
$config['gridlib']['arr_colModel']["judul"] = array(
	'name'=>"judul",
	'index'=>"judul",
	'label'=>"JUDUL ARSIP",
	'width'=>60,
	'editable'=>true,
	'edittype'=>'text',
	);
	
$config['gridlib']['arr_colModel']["nama_peminjam"] = array(
	'name'=>"nama_peminjam",
	'index'=>"nama_peminjam",
	'label'=>"NAMA PEMINJAM",
	'width'=>30,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Nama Peminjam(*)</strong>')
	);

$config['gridlib']['arr_colModel']["keperluan"] = array(
	'name'=>"keperluan",
	'index'=>"keperluan",
	'label'=>"KEPERLUAN",
	'width'=>30,
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Keperluan(*)</strong>')
	);
$config['gridlib']['arr_colModel']["status"] = array(
	'name'=>"status",
	'index'=>"status",
	'label'=>"STATUS",
	'width'=>15,'align'=>'center',
	'editable'=>true,
	'edittype'=>'text',
	'editoptions'=>array('size'=>50), 
	'editrules'=>array('required'=>true), 
	'formoptions'=>array('label'=>'<strong>Nama Petugas(*)</strong>')
	);	

$config['gridlib']['arr_colModel']["tanggal_pinjam"] = array(
	'name'=>"tanggal_pinjam",
	'index'=>"tanggal_pinjam",
	'label'=>"TGL PINJAM",
	'width'=>15,
	'editable'=>true,
	'edittype'=>'text',
	'editrules'=>array('required'=>true), 
	'align'=>'center',

	);

$config['gridlib']['arr_colModel']["tanggal_kembali"] = array(
	'name'=>"tanggal_kembali",
	'index'=>"tanggal_kembali",
	'label'=>"TGL KEMBALI",
	'width'=>15,
	'align'=>'center',
	'editable'=>true,
	'edittype'=>'text',
	'editrules'=>array('required'=>true), 
	);	
?>
