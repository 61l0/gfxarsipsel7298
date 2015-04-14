<?
$config['model_main']['table_name'] = 'm_skpd';
$config['model_main']['table_prikey'] = 'id_skpd';
// $isi = $config['model_main']['extra_join']['value'] = '';
$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.id_skpd,a.nama_lengkap,a.nama_singkat,b.id_skpd as id_skpd_2,b.status',false),
		    'from'=>array($config['model_main']['table_name'].' a'),
			array('method'=>'join',
			        'arr_params'=>array(
		                'm_skpd_sotk b',
		                array('on','a.id_skpd','b.id_skpd'),
		                array('and','b.id_aturan_skpd','id_aturan_skpd'),
		                'left'
		                )
			),
		    'order_by'=>array('a.nama_lengkap')
	    ),
);

?>
