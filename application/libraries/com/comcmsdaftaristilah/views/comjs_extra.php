if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

function view(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_daftar_istilah,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_daftar_istilah,<?=$class_name;?>grid.formprop);		
}
<?=$class_name;?>grid.extra.act = function(data){
	$.ajax({
		type: 'POST',
		url: '<?=site_url($com_url);?>/formaction',
		dataType: 'json',
		data: {id_daftar_istilah:data.id_daftar_istilah,oper:data.oper},
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
<?=$class_name?>grid.extra.optabjad = function(){
	var abjad= $("#abjad").val(); 
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setPostDataItem','abjad',abjad);
	jQuery("#"+<?=$class_name;?>grid.id).trigger("reloadGrid");							
}

