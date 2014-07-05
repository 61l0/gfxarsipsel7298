<?
$config['model_main']['table_name'] = 'arsip_ba';
$config['model_main']['table_prikey'] = 'id_ba';

$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.id_ba, a.kepada,b.nama_lengkap, a.instansi,a.tanggal_ba as tanggal, b.id_skpd'),
		    'from'=>array($config['model_main']['table_name'].' a'),
		    array('method'=>'join','params'=>array('m_skpd b','a.id_skpd=b.id_skpd','left')),
			
			'order_by'=>array('a.id_ba desc'),
	    ), 
);
$config['model_main']['query_count'] = array(
    	'select' => array( "count('a.id_ba') as count"),
    	'from'=>array($config['model_main']['table_name'].' a'),
);
?>
