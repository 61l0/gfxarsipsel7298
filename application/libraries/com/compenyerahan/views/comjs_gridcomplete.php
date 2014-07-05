<?=$class_name;?>grid.opt.gridComplete = function(){
    var w = jQuery(".main-content").width();
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGridWidth',w-(w*0.035));
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		
		//console.log(row)

		if(!row.jumlah_box.length)
			row.jumlah_box = 0
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',cl,row);
		// if(row.act == ""){
			var fnPlus = "loadFragment('#main_panel_container','<?=site_url($com_url);?>/loadsub',{name:'pertelaanarsip',id_ba:"+row.id_ba+"});";
			var insPlus = jQuery("<div />").addClass("ui-pg-div ui-inline-plus").css("float","left").css("cursor","pointer").attr("title","Tambah Arsip");
			insPlus.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spPlus = jQuery("<span />").addClass("ui-icon ui-icon-plus").attr('onclick',fnPlus);
			insPlus.append(spPlus);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insPlus);

			var fnView = "<?=$class_name;?>grid.btn_grid_view({id_ba:"+row.id_ba+", oper:'view'});";
			var insView = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Lihat");
			insView.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spView = jQuery("<span />").addClass("ui-icon ui-icon-document").attr('onclick',fnView);
			insView.append(spView);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insView);
			
			var fnEdit = "<?=$class_name;?>grid.btn_grid_edit({id_ba:"+row.id_ba+",oper:'edit'});";
			var insEdit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Ubah");
			insEdit.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spEdit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnEdit);
			insEdit.append(spEdit);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insEdit);

			var fnImage = "<?=$class_name;?>grid.extra.attachment({'parent_id':"+row.id_ba+",oper:'attachment',attachment_for:'arsip_ba'});";
			var insImage = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Image/File");
			insImage.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spImage = jQuery("<span />").addClass("ui-icon ui-icon-image").attr('onclick',fnImage);
			insImage.append(spImage);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insImage);

			//console.log(row)

			if(parseInt(row.jumlah) <= 0 )
			{
				var fnDel = "<?=$class_name;?>grid.btn_grid_del({id_ba:"+row.id_ba+",oper:'del'});";
				var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Hapus");
				insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
				var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
				insDel.append(spDel);
				$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDel);
			}
		// }
	}
};

