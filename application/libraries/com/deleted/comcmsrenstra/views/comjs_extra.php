if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(params,settings){
		var options = {
			width: '540',
			height: '300',
			title: 'Form Renstra'
		};
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/form',{id_renstra:params.id_renstra,oper:params.oper},options);
}

<?=$class_name;?>grid.mymethod.event.plus = function(){
    var data = {id_renstra:'0',oper:'add'};
    <?=$class_name;?>grid.extra.loadsub(data);
};	
<?=$class_name;?>grid.btn_grid_view=function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_renstra,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
	// jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_renstra,<?=$class_name;?>grid.formprop);
	var data = {id_renstra:params.id_renstra,oper:params.oper};
    <?=$class_name;?>grid.extra.loadsub(data);
		
}
<?=$class_name;?>grid.extra.del = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('delGridRow',data.id_renstra,<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_close_dialog = function(){
	$("#dialogArea1").dialog('close');
}

<?=$class_name;?>grid.extra.btn_simpan = function(settings){
	var options = { 
		dataType: 'json',
		type:      'POST',
		success : function(data) { 
			if(data.result == 'succes'){
				jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
				if(data.oper == 'add'){
					jQuery('#myForm').clearForm();
				}
			}
			jQuery("#dialogArea1").dialog('close');
			alert('Data telah disimpan');
		} 
	};
	jQuery.extend(options,settings);
	jQuery('#myForm').ajaxForm(options); 
}
<?=$class_name;?>grid.extra.remove_file = function(params){
	$.ajax({
		type:'POST',
		data:{id_renstra:params.id_renstra},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/removefile',
		success:function(data){
			alert(data);
		}
	})
};
<?=$class_name;?>grid.extra.refresh = function(params){
	$.ajax({
		type:'POST',
		data:{id_renstra:params.id_renstra,oper:'refresh'},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/formaction',
		success:function(data){
			jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
			alert(data.message);
		}
	})
};
<?=$class_name;?>grid.extra.loadFormImageEditingGaleri = function(id_renstra){
		loadFragment('#dialogArea1','<?=site_url($com_url);?>/form',{id_renstra:id_renstra,oper:'edit'});
}

<?=$class_name;?>grid.extra.urut = function(data){
    var dataAll = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData');
    var pdata = {};
    $.each(dataAll ,function(i,val){
	    if(data.index == i){
	        pdata.id_self = val.id_renstra;
	        pdata.tanggal = val.tanggal;
	        pdata.urutan = val.urutan;
	        pdata.oper = data.oper;
	        if(data.oper == 'naik'){
	            pdata.urutan_dest = parseInt(val.urutan) - 10;
	            pdata.id_parent_dest = val.tanggal;
	        }else{
	            pdata.urutan_dest = parseInt(val.urutan) + 10;
	            pdata.id_parent_dest = val.tanggal;
	        }
	    }
    });
    $.each(dataAll ,function(i,val){
        if(pdata.urutan_dest == val.urutan){
            pdata.id_renstra = val.id_renstra;
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


