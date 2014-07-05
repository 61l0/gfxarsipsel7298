if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(params,settings){
		var id_kategori = $("#id_kategori").val();
		var options = {
			width: '850',
			height: '500',
			title: 'Form Video'
		};
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/form',{id_kategori:id_kategori,id_video:params.id_video,oper:params.oper},options);
}

<?=$class_name;?>grid.mymethod.event.plus = function(){
    var data = {id_video:'0',oper:'add'};
    <?=$class_name;?>grid.extra.loadsub(data);
};	
function view(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_video,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
	var data = {id_video:params.id_video,oper:params.oper};
    <?=$class_name;?>grid.extra.loadsub(data);
		
}
<?=$class_name;?>grid.extra.del = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('delGridRow',data.id_video,<?=$class_name;?>grid.formprop);
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
<?=$class_name;?>grid.extra.remove_upload = function(params){
	$.ajax({
		type:'POST',
		data:{id_video:params.id_video},
		dataType:'JSON',
		url :'<?=site_url("admin/com/cmsvideo/removeupload");?>',
		success:function(data){
			alert(data);
		}
	})
};
<?=$class_name;?>grid.extra.loadFormImageEditingGaleri = function(id_video){
		loadFragment('#dialogArea1','<?=site_url('admin/com/cmsvideo/form');?>',{id_video:id_video,oper:'edit'});
} 

