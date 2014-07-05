if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.pilih = function(data,settings){
	jQuery("#kode_arsip").val(data.id_data);
	jQuery("#judul_arsip").val(data.judul);
	
	jQuery("#dialogArea2").dialog('close');		
}
