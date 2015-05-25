<?
$config['model_main']['table_name'] = 'catatan_administrator';
$config['model_main']['table_prikey'] = 'id_catatan_admin';

$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.*,b.nama_lengkap as nama_pengirim,a.id_pengirim, c.nama_lengkap as nama_penerima,d.path,d.filename file',false),
		    'from'=>array($config['model_main']['table_name'].' a'),
		    'order_by' => array('a.tanggal','desc'),
			array('method'=>'join','params'=>array('m_skpd b ','a.id_pengirim=b.id_skpd','left')),
			array('method'=>'join','params'=>array('m_skpd c ','a.id_penerima=c.id_skpd','left')),
			array('method'=>'join', 'params' => array('arsip_attachment d','d.parent_id=a.id_catatan_admin','left'))
	    ), 
	'query_filter' => array(
		 'id_pengirim'=>array(
            'type'=>'where'
            ,'field'=>'a.id_pengirim'
            ,'name'=>'id_pengirim'
         ),	
	)	 
);