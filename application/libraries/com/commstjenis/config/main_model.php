<?
$config['model_main']['table_name'] = 'arsip_jenis_cat';
$config['model_main']['table_prikey'] = 'id_jenis';

$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.*',false),
		    'from'=>array($config['model_main']['table_name'].' a'),
	    ), 
);