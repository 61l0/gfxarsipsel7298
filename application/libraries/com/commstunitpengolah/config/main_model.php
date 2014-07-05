<?
$config['model_main']['table_name'] = 'm_skpd';
$config['model_main']['table_prikey'] = 'id_skpd';

$config['model_main']['query'] = array(
    'query_table'=>array(
	    'select'=>array('a.id_skpd,a.nama_lengkap'),
	    'from'=>array($config['model_main']['table_name'].' a'),
	
    ), 
);

?>
