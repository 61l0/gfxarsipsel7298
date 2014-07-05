<?=$class_name;?>grid.opt.gridComplete = function(){
    var w = jQuery(".content").width();
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGridWidth',w-(w*0.02));
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		if(row.act == ""){
			var fnView = "<?=$class_name;?>grid.btn_grid_view({id_row:"+cl+"});";
			var insView = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Lihat");
			insView.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spView = jQuery("<span />").addClass("ui-icon ui-icon-document").attr('onclick',fnView);
			insView.append(spView);
			// $("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insView);
			
			var fnEdit = "<?=$class_name;?>grid.btn_grid_edit({id_row:"+cl+"});";
			var insEdit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Ubah");
			insEdit.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spEdit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnEdit);
			insEdit.append(spEdit);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insEdit);

			var fnDel = "<?=$class_name;?>grid.btn_grid_del({id_row:"+cl+"});";
			var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Hapus");
			insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
			insDel.append(spDel);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDel);
		}
	}
};

