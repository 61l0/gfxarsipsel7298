<?=$class_name;?>grid.opt.gridComplete = function(){
    var w = jQuery(".main-content").width();
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGridWidth',w-(w*0.035));
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');

	var header = jQuery("#gview_"+<?=$class_name;?>grid.id+" .jqg-second-row-header th.ui-th-column-header").html();
	if(header == null){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGroupHeaders', {
		  useColSpanStyle: true, 
		  groupHeaders:[
			{startColumnName: 'seri', numberOfColumns: 3, titleText: 'Sistem Penyimpanan'},
			{startColumnName: 'cabinet', numberOfColumns: 3, titleText: 'Lokasi Penyimpanan'}
		  ]	
		});
	}		
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
			var fnView = "<?=$class_name;?>grid.btn_grid_view({id_lap_skpd:"+row.id_lap_skpd+", oper:'view'});";
			var insView = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Lihat");
			insView.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spView = jQuery("<span />").addClass("ui-icon ui-icon-document").attr('onclick',fnView);
			insView.append(spView);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insView);
			

			var fnEdit = "<?=$class_name;?>grid.btn_grid_edit({id_lap_skpd:"+row.id_lap_skpd+",oper:'edit',type_surat:'"+row.type_surat+"'});";
			var insEdit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Ubah");
			insEdit.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spEdit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnEdit);
			insEdit.append(spEdit);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insEdit);

			if(row.type_surat == 'masuk'){

				var fnDisposisi = "<?=$class_name;?>grid.btn_grid_disposisi({id_lap_skpd:"+row.id_lap_skpd+",oper:'edit'});";
				var insDisposisi = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Disposisi");
				insDisposisi.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
				var spDisposisi = jQuery("<span />").addClass("ui-icon ui-icon-arrowthickstop-1-e").attr('onclick',fnDisposisi);
				insDisposisi.append(spDisposisi);
				$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insDisposisi);
			}
			var fnImage = "<?=$class_name;?>grid.extra.attachment({'parent_id':"+row.id_lap_skpd+",oper:'attachment',attachment_for:'arsip_lap_skpd'});";
			var insImage = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Image/File");
			insImage.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spImage = jQuery("<span />").addClass("ui-icon ui-icon-image").attr('onclick',fnImage);
			insImage.append(spImage);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insImage);

			var fnDel = "<?=$class_name;?>grid.btn_grid_del({id_lap_skpd:"+row.id_lap_skpd+",oper:'del'});";
			var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Hapus");
			insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
			insDel.append(spDel);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDel);
	}
};

