<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		var fnNameSp = "<?=$class_name;?>grid.extra.pilih({name:'piliharsip',id_data:"+row.id_data+",judul:'"+row.judul+"'});";
		var sp = jQuery("<span />").addClass("ui-icon ui-icon-gear").attr('onclick',fnNameSp);
		var ins = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk memilih data");
		ins.append(sp);
		var dummy = jQuery("<div />").append(ins);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{ins:dummy.html()});
	}
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
};

