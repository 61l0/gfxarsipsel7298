<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		
		var fnNameSv = "<?=$class_name;?>grid.btn_grid_view({id_komentar:'"+cl+"'});";
		var sv = jQuery("<span />").addClass("ui-icon ui-icon-gear").attr('onclick',fnNameSv);
		var inssv = jQuery("<div />").addClass("ui-pg-div ui-inline-view").css("float","left").css("cursor","pointer").attr("title","Klik untuk melihat detail data");
		
		var fnName3 = "<?=$class_name;?>grid.btn_grid_opt({id_komentar:"+cl+",oper:'edit'});";
		var sp3 = jQuery("<span />").addClass("ui-icon ui-icon-refresh").attr('onclick',fnName3);
		var ins3 = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk merubah status");		

		var fnDel = "<?=$class_name;?>grid.btn_grid_opt({id_komentar:"+cl+",oper:'del'});";
		var del = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
		var insdel = jQuery("<div />").addClass("ui-pg-div ui-inline-delete").css("float","left").css("cursor","pointer").attr("title","Klik untuk menghapus data");
		inssv.append(sv);
		ins3.append(sp3);
		insdel.append(del);
		var dummy = jQuery("<div />").append(inssv).append(ins3).append(insdel);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{act:dummy.html()});
		
	}
	jQuery(".ui-inline-view").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-view").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-delete").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-delete").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
}; 
