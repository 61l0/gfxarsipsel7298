if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.cari = function(data,settings){
	jQuery('#gridcompenyerahan').jqGrid('setPostDataItem','judul',data.valcari);
	jQuery('#gridcompenyerahan').jqGrid('setPostDataItem','typecari',data.typecari);
	jQuery("#gridcompenyerahan").trigger('reloadGrid');	
}
<?=$class_name;?>grid.extra.filter_skpd = function(data,settings){
	jQuery('#gridcompenyerahan').jqGrid('setPostDataItem','id_skpd',data.id_skpd);
	jQuery("#gridcompenyerahan").trigger('reloadGrid');	
}

<?=$class_name;?>grid.extra.tambah = function(data,settings){
	 var options = {
        title: 'Form Tambah Data Penyerahan',
        width: '1020',
        height: '280'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/penyerahan');?>/tambah_data',data,options);
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
	var namafile = jQuery('#berita_acr').val();
	var tanggal = $('#tanggal').val();
	var no = $('#no').val();
	var agenda = $('#agenda').val();
	var kode_komponen = $('#kode_komponen').val();
	var tahun = $('#tahun').val();
	var pertelaan = $('#pertelaan').val();
	var id_skpd = $('#id_skpd').val();
	var uraian = $('#uraian').val();
	var oper = $('#oper').val();
	var kepada = $('#kepada').val();
	var instansi = $('#instansi').val();
	jQuery.ajaxFileUpload({
		url:'<?=site_url('admin/com/penyerahan');?>/upload',
		secureuri:false,
		fileElementId:'berita_acr',
		dataType: 'json',
		success: function (jsondata, status) {
			// console.log(jsondata);
		}

	});

	$.ajax({
		url : '<?=site_url($com_url)?>/formaction',
		data : {'kepada':kepada,'instansi':instansi,'uraian':uraian,'berita_acr':namafile,'oper':oper,'tanggal':tanggal,'no':no,'agenda':agenda,'kode_komponen':kode_komponen,'tahun':tahun,'pertelaan':pertelaan,'id_skpd':id_skpd},
		type : 'POST',
		dataType : 'json',
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcompenyerahan").trigger('reloadGrid');	
			}
		}
	});
}
<?=$class_name;?>grid.btn_grid_plus = function(data,settings){
    var options = {
		title: 'Daftar Pertelaan Arsip',
        width: '1020',
        height: '500'
    };
	if(!data){
		var data = {}; 
	}
	data.name = "pertelaanarsip";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url($com_url);?>/loadsub',data,options);
}
<?=$class_name;?>grid.btn_grid_view = function(data,settings){
    var options = {
		title: 'Detail Data',
        width: '503',
        height: '230'
    };
	gf.dialog.layer('<?=site_url($com_url);?>/view',data,options);
}

<?=$class_name;?>grid.btn_grid_edit = function(data,settings){
    var options = {
		title: 'Form Edit Data Penyerahan',
       width: '1000',
        height: '280'
    };
	gf.dialog.layer('<?=site_url('admin/com/penyerahan');?>/edit',data,options);
}

<?=$class_name;?>grid.extra.simpan_data_edit = function(data,settings){
	var namafile = jQuery('#berita_acr').val();
	if(namafile ==false){
		var namafile = jQuery('#file1').val();
	}else{
		var namafile = jQuery('#berita_acr').val();
	}
	var id_ba = $('#id_ba').val();
	var tanggal = $('#tanggal').val();
	var no = $('#no').val();
	var agenda = $('#agenda').val();
	var kode_komponen = $('#kode_komponen').val();
	var tahun = $('#tahun').val();
	var pertelaan = $('#pertelaan').val();
	var id_skpd = $('#id_skpd').val();
	var uraian = $('#uraian').val();
	var kepada = $('#kepada').val();
	var instansi = $('#instansi').val();
	var oper = $('#oper').val();	
	
	jQuery.ajaxFileUpload({
		url:'<?=site_url('admin/com/penyerahan');?>/upload',
		secureuri:false,
		fileElementId:namafile,
		dataType: 'json',
		success: function (jsondata, status) {
		
		}

	});

	$.ajax({
		url : '<?=site_url($com_url)?>/formaction',
		data : {'kepada':kepada,'instansi':instansi,'id_ba':id_ba,'uraian':uraian,'berita_acr':namafile,'oper':oper,'tanggal':tanggal,'no':no,'agenda':agenda,'kode_komponen':kode_komponen,'tahun':tahun,'pertelaan':pertelaan,'id_skpd':id_skpd},
		type : 'POST',
		dataType : 'json',
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcompenyerahan").trigger('reloadGrid');	
			}
		}
	});	
}
<?=$class_name;?>grid.btn_grid_del=function(params){
	<?=$class_name;?>grid.formprop.delData.id_ba = params.id_ba;
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_ba,<?=$class_name;?>grid.formprop);	
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
    gf.dialog.layer('<?=base_url();?>admin/com/surat/attachment',data,options);
};

