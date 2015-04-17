<?
$config['model_main']['table_name'] = 'catatan_administrator';
$config['model_main']['table_prikey'] = 'id_catatan_admin';

$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.*,b.nama_lengkap as nama_pengirim, c.nama_lengkap as nama_penerima',false),
		    'from'=>array($config['model_main']['table_name'].' a'),
			array('method'=>'join','params'=>array('m_skpd b ','a.id_pengirim=b.id_skpd','left')),
			array('method'=>'join','params'=>array('m_skpd c ','a.id_penerima=c.id_skpd','left')),
	    ), 
	'query_filter' => array(
		 'id_pengirim'=>array(
            'type'=>'where'
            ,'field'=>'a.id_pengirim'
            ,'name'=>'id_pengirim'
         ),	
	)	 
);

?>
