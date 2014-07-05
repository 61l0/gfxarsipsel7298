if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.btn_grid_view = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_komentar,<?=$class_name;?>grid.formprop);
};	
<?=$class_name;?>grid.btn_grid_opt=function(params){
	$.ajax({
		type:'POST',
		data:{id_komentar:params.id_komentar,oper:params.oper},
		dataType:'JSON',
		url :'<?=site_url($com_url);?>/formaction',
		success:function(data){
			jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid')
			alert(data.message);
		}
	})
};


