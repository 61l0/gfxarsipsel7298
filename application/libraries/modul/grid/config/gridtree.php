<?
$config['grid']['toolbar'] = array(
	'plus'=>array(
		'cls'=>'plus',
		'label'=>'Tambah',
	),
	//'search'=>array(
		//cls'=>'search',
		//'label'=>'Cari',
		//'onclick'=>"function(){}"
	//),
	'word'=>array(	
		'cls'=>'word',
		'label'=>'Export to Word',
	),	
	'excel'=>array(
		'cls'=>'excel',
		'label'=>'Export to Excel',	
	),
	'pdf'=>array(
		'cls'=>'pdf',
		'label'=>'Export to PDF',
	),
);
	$config['grid']['formprop']['width'] = 500;
	$config['grid']['formprop']['bottominfo'] = "(*) harus diisi";
	$config['grid']['formprop']['savekey'] = array(true,13);
	$config['grid']['formprop']['closeOnEscape'] = true;
	$config['grid']['formprop']['closeAfterAdd'] = true;
	$config['grid']['formprop']['closeAfterEdit'] = true;
	$config['grid']['formprop']['reloadAfterSubmit'] = false;
	$config['grid']['formprop']['top'] = 200;
	$config['grid']['formprop']['left'] = 350;
	$config['grid']['formprop']['modal'] = true;
	
	$config['grid']['opt']['autowidth'] = true;
	$config['grid']['opt']['rownumbers'] = false;
	$config['grid']['opt']['mtype'] = "POST";
	$config['grid']['opt']['datatype'] = "json";
	$config['grid']['opt']['jsonReader']['repeatitems'] = false;
	$config['grid']['opt']['jsonReader']['subgrid']['repeatitems'] = false;
	$config['grid']['opt']['altRows'] = false;
	$config['grid']['opt']['viewrecords'] = false;
	$config['grid']['opt']['headertitles'] = false;
	$config['grid']['opt']['url'] = false;
	$config['grid']['opt']['caption'] = "";
	$config['grid']['opt']['height'] = '300';
	$config['grid']['opt']['toolbar'] = array(true,'top');
	$config['grid']['opt']['treeGrid'] = true;
	$config['grid']['opt']['treeGridModel'] = "adjacency";
	$config['grid']['opt']['treeIcons'] = array("leaf"=>"ui-icon-document-b");
	$config['grid']['opt']['tree_root_level'] = 1;
	$config['grid']['opt']['treeReader']  = array(
		'level_field'=>"n_level",
		'parent_id_field'=>"id_parent",
		'leaf_field'=>"isLeaf",
		'expanded_field'=>"expanded",
		'parent_id_value'=>"0",
	);
?>