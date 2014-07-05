<?
$config['model_main']['table_name'] = 'c_user';
$config['model_main']['table_prikey'] = 'user_id';
$config['model_main']['query'] = 
	array( 
		'query_table'=>array(	 
			'select'=>array('a.*,b.group_name'),
			'from'=>array($config['model_main']['table_name'].' a'),
			'join'=>array('c_group b','a.group_id=b.id_group'),
		), 
	);
?>