if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(params,settings){
		var kanal= $("#id_kanal").val(); 
		var group= $("#id_group").val(); 
		var options = {
			width: '500',
			height: '400',
			title: 'Form Rubrik'
		};
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/form',{id_group:group,id_kanal:kanal,id_menu:params.id_menu,oper:params.oper},options);
}
<?=$class_name;?>grid.btn_view = function(params){
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_menu,<?=$class_name;?>grid.formprop);
};	
<?=$class_name;?>grid.mymethod.event.plus = function(){
	var group= $("#id_group").val(); 
	if(group=='' || group==0){
		alert('Pilih Group!');
	}else{
		var data = {id_menu:'0',oper:'add'};
		<?=$class_name;?>grid.extra.loadsub(data);
	}
};
<?=$class_name;?>grid.btn_grid_status=function(params){
	$.ajax({
		type: 'POST',
		url: '<?=site_url($com_url);?>/formaction',
		dataType: 'json',
		data: {id_menu:params.id_menu,oper:params.oper},
		success: function(jsondata){
			if(jsondata.result=='succes'){
				$("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
			}else{
				alert(jsondata.message);
			}
		}
	});
}
<?=$class_name;?>grid.extra.del = function(data){
	$.ajax({
		type: 'POST',
		url: '<?=site_url($com_url);?>/formaction',
		dataType: 'json',
		data: {id_menu:data.id_menu,id_group:data.id_group,oper:'del'},
		success: function(jsondata){
			if(jsondata.result=='succes'){
				$("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
				alert(jsondata.message);
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
	        pdata.id_group = val.id_group;
	        pdata.menu_index = val.menu_index;
	        pdata.oper = data.oper;
	        if(data.oper == 'naik'){
	            pdata.urutan_dest = parseInt(val.menu_index) - 10;
	            pdata.id_parent_dest = val.id_parent;
	        }else{
	            pdata.urutan_dest = parseInt(val.menu_index) + 10;
	            pdata.id_parent_dest = val.id_parent;
	        }
	    }
    });
    $.each(dataAll ,function(i,val){
        if(pdata.urutan_dest == val.menu_index && pdata.id_parent_dest == val.id_parent){
            pdata.id_menu = val.id_menu;
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

<?=$class_name;?>grid.extra.optgroup = function(){
	var kanal= $("#id_kanal").val(); 
	var group= $("#id_group").val(); 
	// if(group!=0){
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setPostDataItem','id_group',group);
		// jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setPostDataItem','id_kanal',kanal);
		jQuery("#"+<?=$class_name;?>grid.id).trigger("reloadGrid");		
	// }else{
		// jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setPostDataItem','id_group','');
		// jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setPostDataItem','id_kanal','');
		// jQuery("#"+<?=$class_name;?>grid.id).trigger("reloadGrid");		
	// }
}
<?=$class_name;?>grid.extra.optkanal = function(){
	var kanal= $("#id_kanal").val(); 
	var group= $("#id_group").val(); 
	$.ajax({
		type: "POST",
		url : "<?=site_url($com_url.'getoptgroup');?>",
		data: {kanal:kanal},
		dataType:'json',
		success: function(jsondata){
			$('#id_group').html(0);
			var optdefault = false;
			jQuery.each(jsondata.dropdown.options,function(id_menu,menu_name){
				var opt = jQuery("<option/>").val(id_menu).html(menu_name); 
				$('#id_group').append(opt);
				if(optdefault == false){
					$('#id_group').val(id_menu);
					optdefault = true;
					jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setPostDataItem','id_group',id_menu);
					jQuery("#"+<?=$class_name;?>grid.id).trigger("reloadGrid");		
					
				}
			});
		}
	});
}

<?=$class_name;?>grid.extra.btn_simpan = function(settings){
	var options = { 
		dataType: 'json',
		type:      'POST',
		success : function(data) { 
			if(data.result == 'succes'){
				jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
				// if(data.oper == 'add'){
					jQuery('#myForm').clearForm();
				// }
			}
			alert('Data telah disimpan');
			jQuery("#dialogArea1").dialog('close');
		} 
	};
	jQuery.extend(options,settings);
	jQuery('#myForm').ajaxForm(options); 
}

