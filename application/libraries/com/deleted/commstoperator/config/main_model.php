<?
$config['model_main']['table_name'] = 'arsip_unit_pengolah';
$config['model_main']['table_prikey'] = 'id_unit_pengolah';
$config['model_main']['query'] = array(
    'query_table'=>array(
	    'select'=>array('a.*'),
	    'from'=>array($config['model_main']['table_name'].' a'),
	  //  array('method'=>'join','params'=>array('m_skpd b','a.id_skpd=b.id_skpd')),
	   // array('method'=>'join','params'=>array('m_sotk c','a.id_aturan_skpd=c.id_aturan_skpd')),
	   // 'where'=>array('c.status','on'),
    ), 
);
?>
