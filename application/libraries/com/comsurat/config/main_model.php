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
		    'select'=>array("a.*,c.name as nama_masalah"),
		    'from'=>array($config['model_main']['table_name'].' a'),
			// array('method'=>'join','params'=>array('m_skpd b ','a.id_pengirim=b.id_skpd')),
			array('method'=>'join','params'=>array('arsip_kode_masalah c ','a.kode=c.kode','left')),
			'where' => array('a.type_surat',$type_surat)
	    )
);

?>
