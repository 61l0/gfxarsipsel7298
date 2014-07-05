if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(params,settings){
		var options = {
			width: '540',
			height: '300',
			title: 'Form Perencanaan'
		};
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/form',{id_perencanaan:params.id_perencanaan,oper:params.oper},options);
}

<?=$class_name;?>grid.mymethod.event.plus = function(){
    var data = {id_perencanaan:'0',oper:'add'};
    <?=$class_name;?>grid.extra.loadsub(data);
};	
<?=$class_name;?>grid.btn_grid_view=function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_perencanaan,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
	var data = {id_perencanaan:params.id_perencanaan,oper:params.oper};
    <?=$class_name;?>grid.extra.loadsub(data);
		
}
<?=$class_name;?>grid.extra.del = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('delGridRow',data.id_perencanaan,<?=$class_name;?>grid.formprop);
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
		data:{id_perencanaan:params.id_perencanaan},
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
		data:{id_perencanaan:params.id_perencanaan,oper:'refresh',status:params.status},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/formaction',
		success:function(data){
			jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
			alert(data.message);
		}
	})
};
<?=$class_name;?>grid.extra.loadFormImageEditingGaleri = function(id_perencanaan){
		loadFragment('#dialogArea1','<?=site_url($com_url);?>/form',{id_perencanaan:id_perencanaan,oper:'edit'});
}

