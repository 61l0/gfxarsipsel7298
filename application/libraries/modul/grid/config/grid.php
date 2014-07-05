<?
//$config['grid'] = new stdClass;
$config['grid'] = array(
        'toolbar' => array(
			'plus'=>array(
				'cls'=>'plus',
				'label'=>'Tambah',
	        ),
	        'search'=>array(
				'cls'=>'search',
				'label'=>'Cari',
			),
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
			),     
			'formprop' => array(
				'width'=>500,
				'bottominfo'=>"(*) harus diisi", 
				'savekey' => array(true,13),
				'closeOnEscape' => true,   
				'closeAfterAdd' => true,
				'closeAfterEdit' => true,
				'top' => 200,
				'left' => 350,
				'modal' => true
			),    
			'opt' => array(   
				'autowidth' => true,
				'rownumbers' => false,
				'mtype' => "POST", 
				'datatype' => "json",
				'jsonReader'=>array(
				'repeatitems' => false,
				'subgrid' => array(    
					'repeatitems'=>false    
					)    
				),  
				'altRows'		=>false,
				'viewrecords'	=>true,
				'treeGrid'      =>false,
				'headertitles'  => false,
				'url'           => false,
				'height'        => 300,
				// 'height'        => 'auto',   
				'toolbar'       => array(true,'top')
				) 
			);    
?>