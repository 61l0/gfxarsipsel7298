<?
//$config['model_main'] = new stdClass;
$config['model_main']['table_name'] = 'm_prokeg_aturan_item';
$config['model_main']['table_prikey'] = 'id_prokeg_aturan_item';
$config['model_main']['table_parentkey'] = 'id_parent';

$config['model_main']['query'] = array(
    'query_table'=>array(
	'select'=>array('a.*,a.urutan as no_urut,c.uraian,c.kode_path,c.id_prokeg_jenis,d.status, 
	if((select max(id_parent) from m_prokeg_jenis) = g.id_parent,"true","false") as parent_jenis,
	if(a.id_parent=0,(select if(max(urutan)=a.urutan,"max",if(min(urutan)=a.urutan,"min","false")) from m_prokeg_aturan_item where id_parent=a.id_parent and id_prokeg != 3385),
	(select if(max(urutan)=a.urutan,"max",if(min(urutan)=a.urutan,"min","false")) from m_prokeg_aturan_item where id_parent=a.id_parent)) as urutan,
	(select count(h.id_prokeg) from m_prokeg_setting_item h where h.id_prokeg=a.id_prokeg and h.id_prokeg_aturan=a.id_prokeg_aturan) as jml_prokeg,
	(select uraian from m_prokeg_jenis where id_prokeg_jenis = c.id_prokeg_jenis) as jenis',false),
	'from'=>array($config['model_main']['table_name'].' a'),
	array('method'=>'join','params'=>array('m_prokeg c ','a.id_prokeg=c.id_prokeg')),
	array('method'=>'join','params'=>array('m_prokeg_aturan d ','d.id_prokeg_aturan=a.id_prokeg_aturan')),
	array('method'=>'join','params'=>array('m_prokeg_jenis g ','c.id_prokeg_jenis=g.id_prokeg_jenis')),
	'order_by'=>array('a.urutan')
    ), 
    'query_filter' => array(
        'id_parent'=>array(
            'type'=>'where'
            ,'field'=>'a.id_parent'
            ,'name'=>'id_prokeg_aturan_item'

         ),
		  'id_prokeg_aturan'=>array(
			 'type'=>'where'
			 ,'field'=>'a.id_prokeg_aturan'
			 ,'name'=>'id_prokeg_aturan'
		  ),
    ),
);


?>
