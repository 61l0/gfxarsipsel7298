if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.pilih = function(data,settings){
	jQuery("#kode_kls").val(data.judul);
	jQuery("#nama_kls").val(data.id_data);
	
	jQuery("#dialogArea1").dialog('close');		
}
