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
        title: 'Form Tambah Data ',
        width: '570',
        height: '170'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/mstunitpengolah');?>/tambah_data',data,options);
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
		title: 'Form Edit pengolah',
      width: '570',
        height: '170'
    };
	gf.dialog.layer('<?=site_url('admin/com/mstunitpengolah');?>/edit',data,options);
}

<?=$class_name;?>grid.extra.simpan_data_edit = function(data,settings){

	var str = $("form").serialize();
	$.ajax({
		url : '<?=site_url($com_url)?>/formaction',
		data : str,
		type : 'POST',
		dataType : 'json',
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
;	
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcommstunitpengolah").trigger('reloadGrid');	
			}
			
		}
	});
}


<?=$class_name;?>grid.btn_grid_del=function(params){
	<?=$class_name;?>grid.formprop.delData.id_skpd = params.id_skpd;
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_skpd,<?=$class_name;?>grid.formprop);	

}
<?=$class_name;?>grid.extra.simpan_data = function(data,settings){

	var str = $("form").serialize();	
	$.ajax({
		url : '<?=site_url($com_url)?>/formaction',
		data : str,
		type : 'POST',
		dataType : 'json',
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
;	
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcomcatatanadmin").trigger('reloadGrid');	
			}
			
		}
	});
}
