<?
$config['model_main']['table_name'] = 'arsip_lap_skpd';
$config['model_main']['table_prikey'] = 'id_lap_skpd';

$ci =& get_instance();
$type_surat = $ci->session->userdata('cgd_typesurat');
$avail_type_surat = array('masuk','keluar'); 
if(!in_array($type_surat, $avail_type_surat))
	$type_surat = 'masuk';


$config['model_main']['query'] = array(
    'query_table'=>array(
		    'select'=>array("b.*,c.name as nama_masalah"),
		    'from'=>array($config['model_main']['table_name'].' b'),
			// array('method'=>'join','params'=>array('m_skpd b ','a.id_pengirim=b.id_skpd')),
			array('method'=>'join','params'=>array('arsip_kode_masalah c ','b.kode=c.kode','left')),
			'where' => array('b.type_surat',$type_surat)
	    )
);

?>
