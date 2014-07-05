<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		
		var fnNameSv = "<?=$class_name;?>grid.btn_grid_view({id_perencanaan:'"+cl+"'});";
		var sv = jQuery("<span />").addClass("ui-icon ui-icon-gear").attr('onclick',fnNameSv);
		var inssv = jQuery("<div />").addClass("ui-pg-div ui-inline-view").css("float","left").css("cursor","pointer").attr("title","Klik untuk melihat detail data");
		
		var fnName3 = "<?=$class_name;?>grid.btn_grid_edit({id_perencanaan:"+cl+",oper:'edit'});";
		var sp3 = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnName3);
		var ins3 = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk merubah data");		

		var fnref = "<?=$class_name;?>grid.extra.refresh({id_perencanaan:"+cl+",status:'"+row.status+"'});";
		var ref = jQuery("<span />").addClass("ui-icon ui-icon-refresh").attr('onclick',fnref);
		var insref = jQuery("<div />").addClass("ui-pg-div ui-inline-refresh").css("float","left").css("cursor","pointer").attr("title","Klik untuk mengubah status");

		var fnDel = "<?=$class_name;?>grid.extra.del({id_perencanaan:"+cl+"});";
		var del = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
		var insdel = jQuery("<div />").addClass("ui-pg-div ui-inline-delete").css("float","left").css("cursor","pointer").attr("title","Klik untuk menghapus data");
		
		inssv.append(sv);
		ins3.append(sp3);
		insref.append(ref);
		insdel.append(del);
		var dummy = jQuery("<div />").append(inssv).append(ins3).append(insref).append(insdel);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{ins:dummy.html()});
		
	}
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-view").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-view").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-refresh").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-refresh").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-delete").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-delete").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
}; 
