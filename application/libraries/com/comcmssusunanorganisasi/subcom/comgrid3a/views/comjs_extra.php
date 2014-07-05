if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.pilih = function(aa){
//    jQuery("#gridcomadminmstakunitemisi").jqGrid("resetSelection");
	var dd = $("input:checked");
	var status = $("select:selected");
	var skpd_aturan = $("#id_aturan_skpd").val();
	var data = {};
	$.each(dd, function(i, field){
		var nilai = field.value;
		// $.each(status, function(z, fld){
			// var nl = fld.value;
			// data['status['+nilai+']'] = nl;
		// var st	= jQuery("#gridcomgrid3a").jqGrid('getRowData',nilai).kode_path;
			data['check['+nilai+']'] = nilai;
			data['status['+nilai+']'] = $("select#select"+nilai+"").val();;
			data['id_aturan_skpd'] = skpd_aturan;
			
		// });
		// console.log(data['status['+nilai+']']);
	});
	// console.log(data);
	$.ajax({
		type	: "POST",
		url		: '<?=site_url($com_url);?>/pilih',  
		data	: data,
		dataType: 'json',	
		success	: function(msg){
			jQuery("#dialogArea1").dialog('close');
			jQuery("#gridcomadminmstskpdpersotk").trigger('reloadGrid');
			
			// $.each(msg.rows , function(key, val){
			    // jQuery("#gridcomadminmstskpdpersotk").jqGrid('addChildNode',val.id,aa.id,val);
			// });
		}
	});
	
}

<?=$class_name;?>grid.extra.back = function(){
	$("#dialogArea1").dialog('close');
}
