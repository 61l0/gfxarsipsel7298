<?
$config['model_main']['table_name'] = 'arsip_data';
$config['model_main']['table_prikey'] = 'id_data';

$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array('a.id_data,a.agenda,a.kode_komponen,
		   	a.id_lokasisimpan,
		    				
		    a.id_unit_pengolah,
		    			
		    a.id_retensi,
		    				
		    a.lokasi,
		    a.judul,
		    a.no_arsip,
		    				 
		    a.tahun,

		    				 a.inaktif_sampai'),
		    'from'=>array($config['model_main']['table_name'].' a'),
				array('method'=>'join','params'=>array('arsip_sifat_cat b','b.id_sifat=a.id_sifat','left')),
			//	array('method'=>'join','params'=>array('arsip_retensi c','c.id_retensi=a.id_retensi','left')),
				array('method'=>'join','params'=>array('m_skpd d','d.id_skpd=a.id_unit_pengolah','left')),

			'order_by'=>array('a.id_data desc'),
	    ), 
);
$config['model_main']['query_count'] = array(
    	'select' => array( "count('a.id_data') as count"),
    	'from'=>array($config['model_main']['table_name'].' a'),
    	array('method'=>'join','params'=>array('m_skpd d','d.id_skpd=a.id_unit_pengolah','left')),
);
?>
