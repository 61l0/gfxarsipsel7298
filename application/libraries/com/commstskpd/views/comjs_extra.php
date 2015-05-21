if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(data){
		//console.log(data);

		console.log(data)
		data.rowdata = {id:data.id};

		
		jQuery('#dialogArea1').dialog('close');
		jQuery('#id_skpd_sotk').val(data.id);
		jQuery('#id_unit_pengolah').val(data.id);
		jQuery('#txt_skpd').val(data.nama_lengkap);
		jQuery('#txt_pengolah').val(data.nama_lengkap);
}

setTimeout(function(){
	$('#gbox_gridcommstskpd').css({display:'block'}).parent().prev().hide();
	$('#gridcommstskpd').css({margin:'3px'});
	//$('#gridcommstskpdPager').css({'margin-top':' 17px !important'});
},50);