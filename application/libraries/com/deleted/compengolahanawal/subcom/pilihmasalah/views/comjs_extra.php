if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.pilih = function(data,settings){
	jQuery("#kode_kls").val(data.kode);
	jQuery("#nama_kls").val(data.name);
	
	jQuery("#dialogArea2").dialog('close');		
}
