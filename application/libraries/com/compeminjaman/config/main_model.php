<?
$config['model_main']['table_name'] = 'arsip_peminjaman';
$config['model_main']['table_prikey'] = 'id_peminjaman';
$sql = " concat(b.no_arsip,'/','{agenda}','.',b.kode_komponen,'/',b.tahun) as no_berkas, b.agenda";
$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.*,b.judul,'.$sql,false),
		    'from'=>array($config['model_main']['table_name'].' a'),
			'join'=>array('arsip_data b','a.id_data=b.id_data'),
	    ), 
	'query_filter' => array(
		 'status'=>array(
            'type'=>'where'
            ,'field'=>'a.status'
            ,'name'=>'status'
         ),			
		 'judul'=>array(
            'type'=>'where'
            ,'field'=>'a.judul'
            ,'name'=>'judul'
         ),			
	),
);
$config['model_main']['query_count'] = array(
        'select' => array( "count('a.id_data') as count"),
        'from'=>array($config['model_main']['table_name'].' a'),
);
?>
