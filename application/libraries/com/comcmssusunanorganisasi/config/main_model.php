<?
//$config['model_main'] = new stdClass;
$config['model_main']['table_name'] = 'm_skpd_sotk';
$config['model_main']['table_prikey'] = 'id_skpd_sotk';
$config['model_main']['table_parentkey'] = 'id_parent';

$config['model_main']['query'] = array(
    'query_table'=>array(
		'select'=>array('a.*,a.urutan as no_urut,c.nama_lengkap,c.nama_singkat,d.status as status_sotk
		',false),
		'from'=>array($config['model_main']['table_name'].' a'),
		array('method'=>'join','params'=>array('m_skpd c ','a.id_skpd=c.id_skpd','left')),
		array('method'=>'join','params'=>array('m_sotk d ','d.id_aturan_skpd=a.id_aturan_skpd','left')),
		'order_by'=>array('a.urutan')
	    ), 
    'query_filter' => array(
		 'id_aturan_skpd'=>array(
			'type'=>'where'
			,'field'=>'a.id_aturan_skpd'
			,'name'=>'id_aturan_skpd'
		 ),
    ),
);

?>
