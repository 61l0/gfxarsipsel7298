if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.pilih = function(data,settings){
	//	console.log(data)
	jQuery("input[name=id_skpd]").val(data.id_skpd);
	jQuery("input[name=instansi]").val(data.nama_lengkap);
	
	jQuery("#dialogArea2").dialog('close');		
}
