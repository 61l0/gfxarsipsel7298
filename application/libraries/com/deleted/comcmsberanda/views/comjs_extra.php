if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

function view(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_menu,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_menu,<?=$class_name;?>grid.formprop);		
}
<?=$class_name;?>grid.extra.del = function(data){
	$.ajax({
		type: 'POST',
		url: '<?=site_url($com_url);?>/formaction',
		dataType: 'json',
		data: {id_menu:data.id_menu,oper:'del'},
		success: function(jsondata){
			if(jsondata.result=='succes'){
				alert(jsondata.message);
				$("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
			}else{
				alert(jsondata.message);
			}
		}
	});
}
<?=$class_name;?>grid.formprop.afterComplete = function (response, postdata, formid) { 
    eval("var responseText ="+response.responseText+"");
    $.each(responseText.rows, function(i, val){
        jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',val.id_menu,{menu_index:val.menu_index,urutans:val.urutans});
        if(val.urutans == 'max'){
            jQuery("tr#"+val.id_menu+" td[aria-describedby="+<?=$class_name;?>grid.id+"_ins_urut] div span.ui-icon-arrowthick-1-s").hide();
        }else if(val.urutans=='min'){
            jQuery("tr#"+val.id_menu+" td[aria-describedby="+<?=$class_name;?>grid.id+"_ins_urut] div span.ui-icon-arrowthick-1-n").hide();
        }
    });
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	if(ids.length == 0){
	    jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
	}
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		var leaf = jQuery("tr#"+cl+" div.tree-wrap div.ui-icon").hasClass('tree-leaf');
		if(leaf == true){
		    jQuery("tr#"+cl+" .ui-inline-trash").show();			        
		}else{
			jQuery("tr#"+cl+" .ui-inline-trash").hide();
		}
	}
};
<?=$class_name;?>grid.extra.urut = function(data){
    var dataAll = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData');
    var pdata = {};
    $.each(dataAll ,function(i,val){
	    if(data.index == i){
	        pdata.id_self = val.id_menu;
	        pdata.id_parent = val.id_parent;
	        pdata.menu_index = val.menu_index;
	        pdata.oper = data.oper;
	        if(data.oper == 'naik'){
	            pdata.urutan_dest = parseInt(val.menu_index) - 1;
	            pdata.id_parent_dest = val.id_parent;
	        }else{
	            pdata.urutan_dest = parseInt(val.menu_index) + 1;
	            pdata.id_parent_dest = val.id_parent;
	        }
	    }
    });
    $.each(dataAll ,function(i,val){
        if(pdata.urutan_dest == val.menu_index && pdata.id_parent_dest == val.id_parent){
            pdata.id_menu = val.id_menu;
        }
    });
    var cek_trash_self = jQuery("tr#"+pdata.id_self+" .ui-icon-trash").is(":hidden");
    var cek_trash_dest = jQuery("tr#"+pdata.id_menu+" .ui-icon-trash").is(":hidden");

    var cek_tree_cond = jQuery("table#"+<?=$class_name;?>grid.id+" tbody tr#"+pdata.id_self+" td[aria-describedby="+<?=$class_name;?>grid.id+"_menu_name]").attr('class');
    var next_tree_cond = jQuery("table#"+<?=$class_name;?>grid.id+" tbody tr#"+pdata.id_menu+" td[aria-describedby="+<?=$class_name;?>grid.id+"_menu_name]").attr('class');

	$.ajax({
		url: '<?=site_url($com_url);?>/urut',
		type: 'POST',
		dataType: 'json',
		data: pdata,
		success: function(jsondata){
			$("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
		}
	});
};

