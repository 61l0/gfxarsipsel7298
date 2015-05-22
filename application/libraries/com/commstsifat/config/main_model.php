<?
$config['model_main']['table_name'] = 'arsip_sifat_cat';
$config['model_main']['table_prikey'] = 'id_sifat';

$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.*',false),
		    'from'=>array($config['model_main']['table_name'].' a'),
	    ), 
);