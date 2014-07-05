<?=$class_name;?>grid.opt.gridComplete = function(){
    var w = jQuery(".main-content").width();
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGridWidth',w-(w*0.035));
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		if(row.act == ""){
			var fnAdd = "<?=$class_name;?>grid.btn_grid_plus({id_parent:"+cl+",act:'ins'});";
			var insAdd = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk menyisipkan data");
			insAdd.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spAdd = jQuery("<span />").addClass("ui-icon ui-icon-plus").attr('onclick',fnAdd);
			insAdd.append(spAdd);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insAdd);

			var fnEdit = "<?=$class_name;?>grid.btn_grid_edit({id_retensi:"+row.id_retensi+",id_row:"+cl+",oper:'edit'});";
			var insEdit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk mengubah data");
			insEdit.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spEdit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnEdit);
			insEdit.append(spEdit);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insEdit);
			if(row.isLeaf == 'true'){
				var fnDel = "<?=$class_name;?>grid.btn_grid_del({id_retensi:"+row.id_retensi+",id_row:"+cl+",act:'del'});";
				var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk menghapus data");
				insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
				var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
				insDel.append(spDel);
					$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDel);
				
				// var actDelContainer = $("tr#"+row.id_parent+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] span.ui-icon-trash").parent();
				// if(actDelContainer){
					// actDelContainer.remove();
				// }
			}
		}
	}
};
