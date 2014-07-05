if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.cari = function(data,settings){
	jQuery('#gridcomsurat').jqGrid('setPostDataItem','judul',data.valcari);
	jQuery('#gridcomsurat').jqGrid('setPostDataItem','typecari',data.typecari);
	jQuery("#gridcomsurat").trigger('reloadGrid');	
}

<?=$class_name;?>grid.extra.change = function(data,settings){
	jQuery('#gridcomsurat').jqGrid('setPostDataItem','status',data.dd);
	jQuery("#gridcomsurat").trigger('reloadGrid');	
}


<?=$class_name;?>grid.extra.tambah = function(data,settings){
	// console.log(data)
	 var options = {
        title: 'Form Tambah Kartu Kendali Surat ' + data.type_surat,
        width: '990',
        height: '450'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/surat');?>/tambah_data',data,options);
}

<?=$class_name;?>grid.extra.btn_cari = function(data,settings){
    var options = {
		title: 'Detail Kartu Kendali ',
        width: '410',
        height: '450'
    };
	if(!data){
		var data = {}; 
	}
	data.name = "pilihmasalah";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url('admin/com/pengolahan');?>/loadsub',data,options);
}

<?=$class_name;?>grid.btn_grid_view = function(data,settings){
    var options = {
		title: 'Detail Data',
        width: '615',
        height: '450'
    };
	gf.dialog.layer('<?=site_url($com_url);?>/view',data,options);
}

<?=$class_name;?>grid.btn_grid_edit = function(data,settings){
    var options = {
		title: 'Form Edit Kartu Kendali Surat ' + data.type_surat,
         width: '990',
        height: '450'
    };
	gf.dialog.layer('<?=site_url('admin/com/surat');?>/edit',data,options);
}
<?=$class_name;?>grid.btn_grid_disposisi = function(data,settings){
    var options = {
		title: 'Form Input Kartu Penerus Disposisi',
         width: '747',
        height: '360'
    };
	gf.dialog.layer('<?=site_url('admin/com/surat');?>/disposisi',data,options);
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
				jQuery("#gridcomsurat").trigger('reloadGrid');	
			}
			
		}
	});
}


<?=$class_name;?>grid.btn_grid_del=function(params){
	<?=$class_name;?>grid.formprop.delData.id_lap_skpd = params.id_lap_skpd;
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_lap_skpd,<?=$class_name;?>grid.formprop);	

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
				jQuery("#gridcomsurat").trigger('reloadGrid');	
			}
			
		}
	});

};

<?=$class_name;?>grid.extra.attachment = function(data,settings){
    var options = {
		title: 'Attachment Image / File',
        width: '600',
        height: '500'
    };
	if(!data){
		var data = {}; 
	}
	//data.name = "pilihskpd";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url($com_url);?>/attachment',data,options);
};