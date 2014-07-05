
if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}


<?=$class_name;?>grid.extra.pilih = function(data,settings){
	jQuery("#id_skpd").val(data.id_skpd);
	jQuery("#instansi").val(data.nama_lengkap);
	
	jQuery("#dialogArea2").dialog('close');		
}
<?=$class_name;?>grid.btn_grid_plus=function(params){
	<?=$class_name;?>grid.extra.tambah({id_ba:params.id_ba});
	//<?=$class_name;?>grid.formprop.editData.id_ba = params.id_ba;
	//jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow","new",<?=$class_name;?>grid.formprop);	
}
<?=$class_name;?>grid.btn_grid_edit=function(params){
	<?=$class_name;?>grid.formprop.editData.id_data = params.id_data;
	<?=$class_name;?>grid.formprop.editData.id_ba = params.id_ba;
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_data,<?=$class_name;?>grid.formprop);	
}
<?=$class_name;?>grid.btn_grid_del=function(params){
	<?=$class_name;?>grid.formprop.delData.id_data = params.id_data;
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_data,<?=$class_name;?>grid.formprop);	
}

<?=$class_name;?>grid.extra.tambah = function(data,settings){
	 var options = {
        title: 'Form Tambah Data Pertelaan',
        width: '1000',
        height: '310'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url($com_url);?>/tambah_data',data,options);
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
    gf.dialog.layer('<?=site_url('admin/com/penyerahan');?>/loadsub',data,options);
}

<?=$class_name;?>grid.extra.simpan_data = function(data,settings){

	var tanggal = $('#tanggal').val();
	var no_arsip = $('#no_arsip').val();
	var box = $('#box').val();
	var sampul = $('#sampul').val();
	var agenda = $('#agenda').val();
	var kode_komponen = $('#kode_komponen').val();
	var tahun = $('#tahun').val();
	var judul = $('#judul').val();
	var id_unit_pengolah = $('#id_skpd').val();
	var kode_kls = $('#kode_kls').val();
	var desc = $('#desc').val();
	var oper = $('#oper').val();
	var id_ba=$('#id_ba').val();

	$.ajax({
		url : '<?=site_url($com_url)?>/formaction',
		data : {'box':box,'sampul':sampul,'kode_kls':kode_kls,'judul':judul,'id_ba':id_ba,'desc':desc,'oper':oper,'tanggal':tanggal,'no_arsip':no_arsip,'agenda':agenda,'kode_komponen':kode_komponen,'tahun':tahun,'id_unit_pengolah':id_unit_pengolah},
		type : 'POST',
		dataType : 'json',
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridpertelaanarsip").trigger('reloadGrid');	
			}
		}
	});
}

<?=$class_name;?>grid.btn_grid_edit = function(data,settings){
    var options = {
		title: 'Form Edit Data Pertelaan',
       width: '1000',
        height: '310'
    };
	gf.dialog.layer('<?=site_url($com_url);?>/edit',data,options);
}

<?=$class_name;?>grid.extra.simpan_data_edit = function(data,settings){
	var tanggal = $('#tanggal').val();
	var no_arsip = $('#no_arsip').val();
	var box = $('#box').val();
	var sampul = $('#sampul').val();
	var agenda = $('#agenda').val();
	var kode_komponen = $('#kode_komponen').val();
	var tahun = $('#tahun').val();
	var kode_kls = $('#kode_kls').val();
	var id_unit_pengolah = $('#id_skpd').val();
	var desc = $('#desc').val();
	var oper = $('#oper').val();
	var id_ba= $('#id_ba').val();
	var id_data = $('#id_data').val();
	var judul = $('#judul').val();
	$.ajax({
		url : '<?=site_url($com_url)?>/formaction',
		data : {'box':box,'sampul':sampul,'kode_kls':kode_kls,'judul':judul,'id_data':id_data,'id_ba':id_ba,'desc':desc,'oper':oper,'tanggal':tanggal,'no_arsip':no_arsip,'agenda':agenda,'kode_komponen':kode_komponen,'tahun':tahun,'id_unit_pengolah':id_unit_pengolah},
		type : 'POST',
		dataType : 'json',
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridpertelaanarsip").trigger('reloadGrid');	
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
    gf.dialog.layer('<?=base_url();?>admin/com/surat/attachment',data,options);
};

<?=$class_name;?>grid.image = function(data,settings){
  	var options = {
		width: '750',
		height: '430',
		title: 'Form Image'
	};
	
	$.extend(options,settings);
	gf.dialog.layer('<?=base_url();?>admin/com/pengolahan/formgambar',{id_data:data.id_data},options);
};

<?=$class_name;?>grid.extra.btn_cari = function(data,settings){
    var options = {
		title: 'Detail Data',
        width: '500',
        height: '464'
    };
	if(!data){
		var data = {}; 
	}
	data.name = "pilihmasalah";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url('admin/com/pengolahan');?>/loadsub',data,options);
};