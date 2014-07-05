<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		// console.log(cl);
		if(row.act == ""){
			var fnDet = "<?=$class_name;?>grid.extra.btn_grid_detail({id_kategori:"+cl+"});";
			var insDet = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Detail");
			insDet.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spDetail = jQuery("<span />").addClass("ui-icon ui-icon-gear").attr('onclick',fnDet);
			insDet.append(spDetail);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insDet);

			var fnEdit = "<?=$class_name;?>grid.extra.btn_grid_edit({id_kategori:"+cl+"});";
			var insEdit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Edit");
			insEdit.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spEdit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnEdit);
			insEdit.append(spEdit);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insEdit);

			var fnDel = "<?=$class_name;?>grid.extra.btn_grid_del({id_kategori:"+cl+"});";
			var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Hapus");
			insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
			insDel.append(spDel);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDel);

			var fnimg = "<?=$class_name;?>grid.extra.btn_grid_img({id_kategori:"+cl+"});";
			var insimg = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Gambar");
			insimg.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spimg = jQuery("<span />").addClass("ui-icon ui-icon-image").attr('onclick',fnimg);
			insimg.append(spimg);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insimg);
		}
	}
};

