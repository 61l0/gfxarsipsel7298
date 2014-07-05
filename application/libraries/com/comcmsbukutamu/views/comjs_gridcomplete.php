<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		
		var fnEd = "<?=$class_name;?>grid.extra.edit({id_isian:"+cl+",oper:'edit'});";
		var edit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnEd);
		var insedit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk mengubah data");
		
		var fnDel = "<?=$class_name;?>grid.extra.del({id_isian:"+cl+"});";
		var del = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
		var insdel = jQuery("<div />").addClass("ui-pg-div ui-inline-delete").css("float","left").css("cursor","pointer").attr("title","Klik untuk menghapus data");
		
		insedit.append(edit);
		insdel.append(del);
		var dummy = jQuery("<div />").append(insedit).append(insdel);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{act:dummy.html()});
	}
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-delete").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-delete").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
};

