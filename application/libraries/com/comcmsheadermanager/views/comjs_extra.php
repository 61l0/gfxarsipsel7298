if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(params,settings){
		var options = {
			width: '950',
			height: '220',
			title: 'Form Header Manager'
		};
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/form',{id_header:params.id_header,oper:params.oper},options);
}

<?=$class_name;?>grid.mymethod.event.plus = function(){
    var data = {id_header:'0',oper:'add'};
    <?=$class_name;?>grid.extra.loadsub(data);
};	
function view(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_header,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
	var data = {id_header:params.id_header,oper:params.oper};
    <?=$class_name;?>grid.extra.loadsub(data);
		
}
<?=$class_name;?>grid.extra.del = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('delGridRow',data.id_header,<?=$class_name;?>grid.formprop);
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
			jQuery("#dialogArea1").dialog('close');
			alert('Data telah disimpan');
		} 
	};
	jQuery.extend(options,settings);
	jQuery('#myForm').ajaxForm(options); 
}
<?=$class_name;?>grid.extra.btn_simpan_config = function(settings){
	var data_post = $('form#myForm2').serialize();
	$.ajax({
		url: "<?=site_url($com_url);?>/formaction", 
		type: 'post',
		data: data_post, 
		dataType: 'json', 
		success: function(data){
			if(data.result == 'succes'){
				alert('Data telah disimpan!');
				<?=$class_name;?>grid.data({oper:''});
				$("#main-content").load("<?=site_url($com_url)?>");
			}		
		}
	});

}
<?=$class_name;?>grid.extra.remove_image = function(params){
	$.ajax({
		type:'POST',
		data:{id_header:params.id_header},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/removeimage',
		success:function(data){
			alert(data);
		}
	})
};
<?=$class_name;?>grid.extra.refresh = function(id_header){
	$.ajax({
		type:'POST',
		data:{id_header:id_header,oper:'refresh'},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/formaction',
		success:function(data){
			jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
			alert(data.message);
		}
	})
};
<?=$class_name;?>grid.extra.loadFormImageEditingGaleri = function(id_header){
		loadFragment('#dialogArea1','<?=site_url($com_url);?>/form',{id_header:id_header,oper:'edit'});
} 

