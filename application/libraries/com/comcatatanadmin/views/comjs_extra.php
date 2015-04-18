if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.cari = function(data,settings){
	jQuery('#gridcomcatatanadmin').jqGrid('setPostDataItem','judul',data.valcari);
	jQuery('#gridcomcatatanadmin').jqGrid('setPostDataItem','typecari',data.typecari);
	jQuery("#gridcomcatatanadmin").trigger('reloadGrid');	
}
<?=$class_name;?>grid.extra.change = function(data,settings){
	jQuery('#gridcomcatatanadmin').jqGrid('setPostDataItem','status',data.dd);
	jQuery("#gridcomcatatanadmin").trigger('reloadGrid');	
}


<?=$class_name;?>grid.extra.tambah = function(data,settings){
	 var options = {
        title: 'Form Tambah Data Catatan',
        width: '870',
        height: '370'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/catatanadmin');?>/tambah_data',data,options);
}

<?=$class_name;?>grid.extra.pilih_skpd = function(data,settings){
    var options = {
		title: 'Detail Data',
        width: '600',
        height: '500'
    };
	if(!data){
		var data = {}; 
	}
	data.name = "pilihskpd";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url($com_url);?>/loadsub',data,options);
}

<?=$class_name;?>grid.btn_grid_view = function(data,settings){
    var options = {
		title: 'Detail Data Catatan',
        width: '515',
        height: '180'
    };
	gf.dialog.layer('<?=site_url($com_url);?>/view',data,options);
}

<?=$class_name;?>grid.btn_grid_edit = function(data,settings){
    var options = {
		title: 'Form Edit Data Catatan',
         width: '870',
        height: '370'
    };
	gf.dialog.layer('<?=site_url('admin/com/catatanadmin');?>/edit',data,options);
}

<?=$class_name;?>grid.extra.simpan_data_edit = function(data,settings){

	$("form").attr('action','<?=site_url($com_url)?>/formaction').ajaxSubmit({
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcomcatatanadmin").trigger('reloadGrid');	
			}
			
		}
	});
	// var str = $("form").serialize();
// 	$.ajax({
// 		url : '<?=site_url($com_url)?>/formaction',
// 		data : str,
// 		type : 'POST',
// 		dataType : 'json',
// 		success : function(msg){
// 			if(msg.result=='failed'){
// 				$('#responceArea').html(msg.message).css("color","red");
// ;	
// 			}else{
// 				jQuery('#dialogArea1').dialog('close');
// 				jQuery("#gridcomcatatanadmin").trigger('reloadGrid');	
// 			}
			
// 		}
// 	});
}


<?=$class_name;?>grid.btn_grid_del=function(params){
	<?=$class_name;?>grid.formprop.delData.id_catatan_admin = params.id_catatan_admin;
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_catatan_admin,<?=$class_name;?>grid.formprop);	

}
<?=$class_name;?>grid.extra.simpan_data = function(data,settings){
	$("form").attr('action','<?=site_url($com_url)?>/formaction').ajaxSubmit({
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcomcatatanadmin").trigger('reloadGrid');	
			}
			
		}
	});
// 	var str = $("form").serialize();	
// 	$.ajax({
// 		url : '<?=site_url($com_url)?>/formaction',
// 		data : str,
// 		type : 'POST',
// 		dataType : 'json',
// 		success : function(msg){
// 			if(msg.result=='failed'){
// 				$('#responceArea').html(msg.message).css("color","red");
// ;	
// 			}else{
// 				jQuery('#dialogArea1').dialog('close');
// 				jQuery("#gridcomcatatanadmin").trigger('reloadGrid');	
// 			}
			
// 		}
// 	});
}
