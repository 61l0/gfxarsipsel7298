if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(data){
		data.rowdata = {id:data.id};
		//console.log(data.rowdata);
		jQuery('#dialogArea1').dialog('close');
		jQuery('#id_unit_pengolah').val(data.id);
		jQuery('#txt_pengolah').val(data.name);
}
setTimeout(function(){
	$('#gbox_gridcommstoperator').css({display:'block'}).parent().prev().hide();
	$('#gridcommstoperator').css({margin:'3px'});
	//$('#gridcommstskpdPager').css({'margin-top':' 17px !important'});
},50);