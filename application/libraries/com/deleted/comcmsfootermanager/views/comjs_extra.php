if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(params,settings){
		var options = {
			width: '950',
			height: '200',
			title: 'Form Footer Manager'
		};
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/form',{id_footer:params.id_footer,oper:params.oper},options);
}

<?=$class_name;?>grid.mymethod.event.plus = function(){
    var data = {id_footer:'0',oper:'add'};
    <?=$class_name;?>grid.extra.loadsub(data);
};	
function view(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_footer,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
	var data = {id_footer:params.id_footer,oper:params.oper};
    <?=$class_name;?>grid.extra.loadsub(data);
		
}
<?=$class_name;?>grid.extra.del = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('delGridRow',data.id_footer,<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_close_dialog = function(){
	$("#dialogArea1").dialog('close');
}

<?=$class_name;?>grid.extra.btn_simpan = function(settings){
	var link = $("#footer_link").val();
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
			alert('Data telah disimpan');
			jQuery("#dialogArea1").dialog('close');
		} 
	};
	jQuery.extend(options,settings);
	jQuery('#myForm').ajaxForm(options); 
}
<?=$class_name;?>grid.extra.remove_image = function(params){
	$.ajax({
		type:'POST',
		data:{id_footer:params.id_footer},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/removeimage',
		success:function(data){
			alert(data);
		}
	})
};
<?=$class_name;?>grid.extra.refresh = function(id_footer){
	$.ajax({
		type:'POST',
		data:{id_footer:id_footer,oper:'refresh'},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/formaction',
		success:function(data){
			jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
			alert(data.message);
		}
	})
};
<?=$class_name;?>grid.extra.loadFormImageEditingGaleri = function(id_footer){
		loadFragment('#dialogArea1','<?=site_url($com_url);?>/form',{id_footer:id_footer,oper:'edit'});
} 

