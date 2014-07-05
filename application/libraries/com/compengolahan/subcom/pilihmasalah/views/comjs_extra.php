if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.pilih = function(data,settings){
//console.log(data);
	jQuery("#kode_kls").val(data.kode);
	jQuery("#nama_kls").val(data.name);
	jQuery("input[name=kode]").val(data.code)
	//jQuery("input[name=id_kode_masalah]").val(data.id_kode_masalah);
	jQuery("input[name=nama_masalah]").val(data.name);
	jQuery("#dialogArea2").dialog('close');		
}
