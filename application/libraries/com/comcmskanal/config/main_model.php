<? $config['model_main']['table_name'] = 'public_menu';$config['model_main']['table_prikey'] = 'id_menu';$config['model_main']['query'] = array(    'query_table'=>array(	    'select'=>array('a.*,		(			if(b.maxB=a.menu_index, "max", 				if(b.minB=a.menu_index, "min", "false")			)		) as urutans		',false),	    'from'=>array($config['model_main']['table_name'].' a'),  		array('method'=>'join','params'=>array('(SELECT max(menu_index) as maxB,level, min(menu_index) as minB FROM public_menu GROUP BY `level`) b','a.level=b.level')),		'where'=>array('a.level',1),		'order_by'=>array('a.menu_index','asc')    ), ); ?>