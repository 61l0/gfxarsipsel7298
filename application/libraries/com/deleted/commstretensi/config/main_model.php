<?
//$config['model_main'] = new stdClass;
$config['model_main']['table_name'] = 'arsip_retensi';
$config['model_main']['table_prikey'] = 'id_retensi';
$config['model_main']['table_parentkey'] = 'id_parent';

$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.*',false),
		    'from'=>array($config['model_main']['table_name'].' a'),
			'order_by'=>array('a.id_retensi desc'),
	    ), 
    'query_filter' => array(
        'id_parent'=>array(
            'type'=>'where'
            ,'field'=>'a.id_parent'
            ,'name'=>'id_retensi'
         ),
    ),
);

?>
