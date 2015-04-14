<?=$class_name;?>grid.opt.gridComplete = function(){
    var w = jQuery(".head-content").width();
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGridWidth',w-(w*0.035));
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		
		var fnPlus = "<?=$class_name;?>grid.btn_grid_plus({id_menu:'"+cl+"',id_parent:"+row.id_parent+"});";
		
		var plus = jQuery("<span />").addClass("ui-icon ui-icon-plus").attr('onclick',fnPlus);
		var pls = jQuery("<div />").addClass("ui-pg-div ui-inline-plus").css("float","left").css("cursor","pointer").attr("title","Klik untuk menyisipkan data");

		var fnName = "<?=$class_name;?>view({id_aturan_skpd:"+cl+"});";		
		var sp = jQuery("<span />").addClass("ui-icon ui-icon-search").attr('onclick',fnName);
		var ins = jQuery("<div />").addClass("ui-pg-div ui-inline-search").css("float","left").css("cursor","pointer").attr("title","Klik untuk melihat data");
		pls.append(plus);
		ins.append(sp);
		
		var dummy = jQuery("<div />").append(ins).append(pls);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{ins:dummy.html()});
	}
	jQuery(".ui-inline-search").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-search").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
	jQuery(".ui-inline-plus").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-plus").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
};

