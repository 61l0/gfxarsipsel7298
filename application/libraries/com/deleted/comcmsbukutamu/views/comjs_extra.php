if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

function view(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_isian,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.extra.del = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('delGridRow',data.id_isian,<?=$class_name;?>grid.formprop);
};
<?=$class_name;?>grid.extra.edit = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('editGridRow',data.id_isian,<?=$class_name;?>grid.formprop);
};

<?=$class_name;?>grid.extra.btn_simpan = function(){
	var data_post = $('form').serialize();
	$.ajax({
		url: "<?=site_url($com_url);?>/formaction", 
		type: 'post',
		data: data_post, 
		dataType: 'json', 
		success: function(data){
			if(data.result == 'succes'){
				$("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
				if(data.oper=='add'){
					alert('Data telah disimpan!');
				}else if(data.oper=='edit'){
					alert('Data telah diubah!');
				}
				jQuery('form#myForm').clearForm();
				$("#dialogArea1").dialog('close');
			}		
		}
	});
	return false;

};

