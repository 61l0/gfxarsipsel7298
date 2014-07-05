<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		// console.log(row.id_akun_2);
		var sp = "<input type='checkbox' id='check["+cl+"]' name='check["+cl+"]' value='"+cl+"' style='height:22px;width:20px;float:left;' title='PILIH'>";
		var ins = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Pilih Item");
		// var sp2 = "<input type='radio' id='stat"+cl+"' value='' name='stat["+cl+"]' style='height:22px;width:20px;float:left;' title='PILIH'>";
		// var ins2 = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Pilih Item");
		var sp2 = "<select id='select"+cl+"' name='select["+cl+"]' style='height:22px;width:60px;float:center;' title='PILIH'> <option value=''>-Pilih-</option><option value='off'>OFF</option><option value='on' >ON</option></select>";
		var ins2 = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Pilih Status");

		ins.append(sp);
		ins2.append(sp2);
	
		// console.log(row.status);
		
		var dummy = jQuery("<div />").append(ins);
		var dummy2= jQuery("<div />").append(ins2);
		if(row.id_skpd_2 == 0 || row.id_skpd_2 ==''){
			// if(row.isLeaf == 'true'){
				jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{ins:dummy.html(),stat:dummy2.html()});
			// }
		}
		else{
				jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{stat:row.status});
		}
	}
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
}; 
