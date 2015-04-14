if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(params,settings){
		var id_kanal = $("#id_kanal").val();
		var options = {
			width: '850',
			height: '400',
			title: 'Form Banner Manager'
		};
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/form',{id_banner:params.id_banner,id_kanal:id_kanal,oper:params.oper},options);
}

<?=$class_name;?>grid.mymethod.event.plus = function(){
    var data = {id_banner:'0',oper:'add'};
    <?=$class_name;?>grid.extra.loadsub(data);
};	
<?=$class_name;?>grid.btn_grid_view = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_banner,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
	var data = {id_banner:params.id_banner,oper:params.oper};
    <?=$class_name;?>grid.extra.loadsub(data);
		
}
<?=$class_name;?>grid.extra.del = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('delGridRow',data.id_banner,<?=$class_name;?>grid.formprop);
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
<?=$class_name;?>grid.extra.remove_image = function(params){
	$.ajax({
		type:'POST',
		data:{id_banner:params.id_banner},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/removeimage',
		success:function(data){
			alert(data);
		}
	})
};
<?=$class_name;?>grid.extra.loadFormImageEditingGaleri = function(id_banner){
		loadFragment('#dialogArea1','<?=site_url($com_url);?>/form',{id_banner:id_banner,oper:'edit'});
} 
<?=$class_name;?>grid.extra.optkanal = function(){
	var kanal= $("#id_kanal").val(); 
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setPostDataItem','id_kanal',kanal);
	jQuery("#"+<?=$class_name;?>grid.id).trigger("reloadGrid");							
} 
<?=$class_name;?>grid.extra.urut = function(data){
    var dataAll = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData');
    var pdata = {};
    $.each(dataAll ,function(i,val){
	    if(data.index == i){
	        pdata.id_self = val.id_banner;
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
            pdata.id_banner = val.id_banner;
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


