<?
$config['model_main']['table_name'] = 'arsip_data';
$config['model_main']['table_prikey'] = 'id_data';

$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.*,b.name as sifat, c.inaktif_sampai',false),
		    'from'=>array($config['model_main']['table_name'].' a'),
				array('method'=>'join','params'=>array('arsip_sifat_cat b','b.id_sifat=a.id_sifat','left')),
				array('method'=>'join','params'=>array('arsip_retensi c','c.id_retensi=a.id_retensi')),
				array('method'=>'join','params'=>array('m_skpd d','d.id_skpd=a.id_unit_pengolah')),

			'order_by'=>array('a.id_data desc'),
	    ), 
);

?>
