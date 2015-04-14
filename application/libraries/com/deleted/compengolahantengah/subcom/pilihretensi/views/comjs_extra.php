if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.pilih = function(data,settings){
	jQuery("#id_retensi").val(data.id_retensi);
	jQuery("#retensi").val(data.desc);
	
	jQuery("#dialogArea2").dialog('close');		
}
