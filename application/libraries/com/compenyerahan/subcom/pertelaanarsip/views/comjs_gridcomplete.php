<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		if(!row.box.length)
			row.box = 0
		if(!row.sampul.length)
			row.sampul = 0


		//	row.sampul = 0	

		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',cl,row);		
		var fnEdit = "<?=$class_name;?>grid.btn_grid_edit({id_data:"+row.id_data+",id_ba:"+row.id_ba+",oper:'edit'});";
			var insEdit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Ubah");
			insEdit.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spEdit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnEdit);
			insEdit.append(spEdit);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_ins']").append(insEdit);

		var fnImage = "<?=$class_name;?>grid.image({id_data:"+row.id_data+",oper:'del'});";
			var insImage = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Image");
			insImage.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spImage = jQuery("<span />").addClass("ui-icon ui-icon-image").attr('onclick',fnImage);
			insImage.append(spImage);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_ins'] ").append(insImage);
		//console.log(row);	
		
		if(parseInt(row.id_lokasisimpan) <= 0){	
			var fnDel = "<?=$class_name;?>grid.btn_grid_del({id_data:"+row.id_data+",oper:'del'});";
			var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Hapus");
			insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
			insDel.append(spDel);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_ins'] ").append(insDel);
		} 

		
	}
};