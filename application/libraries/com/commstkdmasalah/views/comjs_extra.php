if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
};

<?=$class_name;?>grid.formprop.afterComplete = function (response, postdata, formid) { 
	if(response.status == 200){
		eval("var responseText ="+response.responseText+"");
	    var cek = responseText.rows.cek;
		var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	    for(var i=0;i < ids.length;i++){
		    var cl = ids[i];
		    var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		    var leaf = jQuery("tr#"+cl+" td .tree-wrap div").hasClass("tree-leaf");
		    if(leaf==true){
		        var fnDel = "<?=$class_name;?>grid.btn_grid_del({id_row:"+cl+",act:'del'});";
				var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk menghapus data");
				insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
				var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
				insDel.append(spDel);
				var actDelContainer = $("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] span.ui-icon-trash");
				if(actDelContainer){
					actDelContainer.remove();
				}

				if(row.jml_hirarki == 0){
				    $("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDel);
				}
		    }
		}
	}
};
