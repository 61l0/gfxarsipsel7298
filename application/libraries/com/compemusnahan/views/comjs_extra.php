if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}


<?=$class_name;?>grid.extra.musnahatautinjau = function(data,settings){
	jQuery('#gridcompemusnahan').jqGrid('setPostDataItem','status',data.data);
	jQuery("#gridcompemusnahan").trigger('reloadGrid');	
}
<?=$class_name;?>grid.extra.inaktif = function(data,settings){
	jQuery('#gridcompemusnahan').jqGrid('setPostDataItem','status',data.data);
	jQuery("#gridcompemusnahan").trigger('reloadGrid');	
}

<?=$class_name;?>grid.extra.tambah = function(data,settings){
	 var options = {
        title: 'Form Tambah Data',
        width: '640',
        height: '430'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/surat');?>/tambah_data',data,options);
}

<?=$class_name;?>grid.extra.btn_cari = function(data,settings){
    var options = {
		title: 'Detail Data',
        width: '800',
        height: '500'
    };
	if(!data){
		var data = {}; 
	}
	data.name = "pilihmasalah";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url($com_url);?>/loadsub',data,options);
}



<?=$class_name;?>grid.btn_grid_edit = function(data,settings){
    var options = {
		title: 'Form Edit Data',
        width: '640',
        height: '440'
    };
	gf.dialog.layer('<?=site_url('admin/com/surat');?>/edit',data,options);
}


<?=$class_name;?>grid.btn_grid_musnahkan=function(params){
	<?=$class_name;?>grid.formprop.delData.id_data = params.id_data;
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_data,<?=$class_name;?>grid.formprop);	

}

<?=$class_name;?>grid.simpan_data = function(data,settings){
	
	
	//return false;

	if( data.oper == 'musnahkan' && confirm('Apakah anda yakin ?'))
	{
		$.ajax({
			url : '<?=site_url($com_url)?>/formaction',
			data : data,
			type : 'POST',
			dataType : 'json',
			success : function(msg){
					alert(msg.message);
					jQuery('#dialogArea1').dialog('close');
					jQuery("#gridcompemusnahan").trigger('reloadGrid');	
				
			}
		});
	}
	else if(data.oper == 'tinjau')
	{
		var options = {
			title: 'Form Penilaian Kembali',
	        width: '720',
       		height: '278'
	    };
		gf.dialog.layer('<?=site_url('admin/com/pemusnahan');?>/tinjau',data,options);
	}
	else
	{
		console.log(data.oper)
	}
	return;
}

<?=$class_name;?>grid.extra.reloadGrid = function(mode){
	if(!mode){
		if(typeof window.LAST_MODE_PMSNHN != 'undefined')
			mode = window.LAST_MODE_PMSNHN
		else	
			mode = 'inaktif';
	}else{
		window.LAST_MODE_PMSNHN = mode;
	}
	jQuery('#gridcompemusnahan').jqGrid('setPostDataItem','status',mode);
	jQuery("#gridcompemusnahan").trigger('reloadGrid');	
};

<?=$class_name;?>grid.extra.pilih_retensi = function(data,settings){
    var options = {
		title: 'Pilih Retensi',
        width: '379',
        height: '251'
    };
	if(!data){
		var data = {}; 
	}
	data.name = "pilihretensi";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url('admin/com/pengolahan');?>/loadsub',data,options);
};

<?=$class_name;?>grid.extra.simpan_data_edit = function(data,settings){

	var str = $("form").serialize();	
	$.ajax({
		url : '<?=site_url($com_url)?>/formaction_tinjau',
		data : str,
		type : 'POST',
		dataType : 'json',
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcompemusnahan").trigger('reloadGrid');	
			}
			
		}
	});
};