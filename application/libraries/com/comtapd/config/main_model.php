<?
$config['model_main']['table_name'] = 'm_tapd';
$config['model_main']['table_prikey'] = 'id_tapd';
$config['model_main']['query'] = array(    
	'query_table'=>array(	    
		'select'=>array('a.*,b.tahun'),	    	
		'from'=>array($config['model_main']['table_name'].' a'),    
		array('method'=>'join','params'=>array('m_periode b','b.id_periode=a.id_periode','left'))
		), 
	'query_filter' => array(
        	'id_periode'=>array(
            		'type'=>'where'
            		,'field'=>'a.id_periode'
            		,'name'=>'id_periode'
			)
		)
);
        

?>