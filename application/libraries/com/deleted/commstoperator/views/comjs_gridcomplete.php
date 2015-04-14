<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		//console.log(row);
		var fnNameSv = "<?=$class_name;?>grid.extra.loadsub({id:"+cl+",name:'"+row.name+"'});";
		var sv = jQuery("<span />").addClass("ui-icon ui-icon-search").attr('onclick',fnNameSv);
		var inssv = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk menyisipkan data");
		inssv.append(sv);
		
		var dummy = jQuery("<div />").append(inssv);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{ins:dummy.html()});
	}
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
};

