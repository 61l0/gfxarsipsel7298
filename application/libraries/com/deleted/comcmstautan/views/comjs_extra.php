if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

function view(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_tautan,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_tautan,<?=$class_name;?>grid.formprop);		
}
<?=$class_name;?>grid.extra.del = function(data){
	$.ajax({
		type: 'POST',
		url: '<?=site_url($com_url);?>/formaction',
		dataType: 'json',
		data: {id_tautan:data.id_tautan,oper:'del'},
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
        jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',val.id_tautan,{urutan:val.urutan,urutans:val.urutans});
        if(val.urutans == 'max'){
            jQuery("tr#"+val.id_tautan+" td[aria-describedby="+<?=$class_name;?>grid.id+"_ins_urut] div span.ui-icon-arrowthick-1-s").hide();
        }else if(val.urutans=='min'){
            jQuery("tr#"+val.id_tautan+" td[aria-describedby="+<?=$class_name;?>grid.id+"_ins_urut] div span.ui-icon-arrowthick-1-n").hide();
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
	        pdata.id_self = val.id_tautan;
	        pdata.urutan = val.urutan;
	        pdata.id_kanal = val.id_kanal;
	        pdata.oper = data.oper;
	        if(data.oper == 'naik'){
	            pdata.urutan_dest = parseInt(val.urutan) - 10;
	            pdata.id_parent_dest = val.id_kanal;
	        }else{
	            pdata.urutan_dest = parseInt(val.urutan) + 10;
	            pdata.id_parent_dest = val.id_kanal;
	        }
	    }
    });
    $.each(dataAll ,function(i,val){
        if(pdata.urutan_dest == val.urutan){
            pdata.id_tautan = val.id_tautan;
        }
    });
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
