<?=$class_name;?>grid.opt.gridComplete = function(){
    // var w = jQuery("#main_panel_container").width();
    // jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGridWidth',w-(w*0.02));
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		if(row.act == ""){
			var fnview = "<?=$class_name;?>grid.extra.btn_grid_detail({id_produk:"+row.id_produk+",id_perusahaan:'<?=@$id_perusahaan?>'});";
			var spview = jQuery("<span />").addClass("ui-icon ui-icon-gear").attr('onclick',fnview);
			var insview = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Detail");	
			
			var fnedit = "<?=$class_name;?>grid.extra.btn_grid_edit({id_produk:"+row.id_produk+",id_perusahaan:'<?=@$id_perusahaan?>'});";
			var spedit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnedit);
			var insedit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Edit");
			
			var fndel = "<?=$class_name;?>grid.extra.btn_grid_del({id_row:"+cl+"});";
			var spdel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fndel);
			var insdel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Hapus");
			
			var fnimg = "<?=$class_name;?>grid.extra.btn_grid_img({id_produk:"+row.id_produk+"});";
			var spimg = jQuery("<span />").addClass("ui-icon ui-icon-image").attr('onclick',fnimg);
			var insimg = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Gambar");
			
			insview.append(spview);
			insedit.append(spedit);
			insdel.append(spdel);
			insimg.append(spimg);
			var dummy = jQuery("<div />").append(insview).append(insedit).append(insdel).append(insimg);
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{act:dummy.html()});

		}
	}
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
};

