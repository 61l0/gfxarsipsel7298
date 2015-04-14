<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		
		var fnNameSv = "view({id_tautan:'"+cl+"'});";
		var sv = jQuery("<span />").addClass("ui-icon ui-icon-gear").attr('onclick',fnNameSv);
		var inssv = jQuery("<div />").addClass("ui-pg-div ui-inline-view").css("float","left").css("cursor","pointer").attr("title","Klik untuk melihat detail data");
		
		var fnName3 = "<?=$class_name;?>grid.btn_grid_edit({id_tautan:"+cl+",oper:'edit'});";
		var sp3 = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnName3);
		var ins3 = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk merubah data");		

		var fnDel = "<?=$class_name;?>grid.extra.del({id_tautan:"+cl+"});";
		var del = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
		var insdel = jQuery("<div />").addClass("ui-pg-div ui-inline-delete").css("float","left").css("cursor","pointer").attr("title","Klik untuk menghapus data");

		//================================= no_urut =========================================================================
        var no_urut = jQuery("#"+<?=$class_name;?>grid.id+" tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_menu_index']").html();
        
		var fnUp = "<?=$class_name;?>grid.extra.urut({index:"+i+",oper:'naik'});";
		var up = jQuery("<span />").addClass("ui-icon ui-icon-arrowthick-1-n").attr('onclick',fnUp);
		var urutanUp = jQuery("<div />").addClass("ui-pg-div ui-inline-urut").css("float","left").css("cursor","pointer").attr("title","Naik").append(up);

		var fnDown = "<?=$class_name;?>grid.extra.urut({index:"+i+",oper:'turun'});";
		var down = jQuery("<span />").addClass("ui-icon ui-icon-arrowthick-1-s").attr('onclick',fnDown);
		var urutanDown = jQuery("<div />").addClass("ui-pg-div ui-inline-urut").css("float","left").css("cursor","pointer").attr("title","Turun").append(down);
		if(row.urutans == "max"){
			var urut = jQuery("<div />").append(urutanUp);
		}else if(row.urutans == "min"){
			var urut = jQuery("<div />").append(urutanDown);
		}else if(row.urutans == "false"){
			var urut = jQuery("<div />").append(urutanUp).append(urutanDown);
		}else{
			var urut = jQuery("<div />");
		}
		// console.log(row.urutans);
		//================================= end urut =========================================================================

		inssv.append(sv);
		ins3.append(sp3);
		insdel.append(del);
		var dummy = jQuery("<div />").append(inssv).append(ins3).append(insdel);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{ins:dummy.html(),ins_urut:urut.html()});
		
	}
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-view").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-view").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-delete").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-delete").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-urut").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-urut").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
}; 
