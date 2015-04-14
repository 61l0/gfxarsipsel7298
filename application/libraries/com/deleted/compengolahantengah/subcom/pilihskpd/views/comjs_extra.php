if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.pilih = function(data,settings){
	jQuery("#id_skpd").val(data.id_skpd);
	jQuery("#unit_pengolah").val(data.nama_lengkap);
	
	jQuery("#dialogArea2").dialog('close');		
}
