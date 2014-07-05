if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.cari = function(data,settings){
	jQuery('#gridcompengolahan').jqGrid('setPostDataItem','judul',data.valcari);
	jQuery('#gridcompengolahan').jqGrid('setPostDataItem','typecari',data.typecari);
	jQuery("#gridcompengolahan").trigger('reloadGrid');	
}
<?=$class_name;?>grid.extra.filter = function(data,settings){
	jQuery('#gridcompengolahan').jqGrid('setPostDataItem','status',data.filter);
	jQuery("#gridcompengolahan").trigger('reloadGrid');	
}

<?=$class_name;?>grid.btn_grid_view = function(data,settings){
    var options = {
		title: 'Detail Data',
        width: '650',
        height: '470'
    };
	gf.dialog.layer('<?=site_url('admin/com/pengolahan');?>/view',data,options);
}


<?=$class_name;?>grid.priview = function(data,settings){
alert('test');
    var options = {
		title: 'Detail Data',
        width: '650',
        height: '470'
    };
	gf.dialog.layer('<?=site_url('admin/com/pengolahan');?>/priview',data,options);
}

<?=$class_name;?>grid.btn_grid_edit = function(data,settings){
    var options = {
		title: 'Form Edit Data',
        width: '1000',
        height: '600'
    };
	gf.dialog.layer('<?=site_url('admin/com/pengolahan');?>/edit',data,options);
}


<?=$class_name;?>grid.extra.tambah = function(data,settings){
	 var options = {
        title: 'Form Tambah Data',
        width: '1000',
        height: '600'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/pengolahan');?>/tambah_data',data,options);
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

<?=$class_name;?>grid.extra.pilih_retensi = function(data,settings){
    var options = {
		title: 'Detail Data',
        width: '800',
        height: '500'
    };
	if(!data){
		var data = {}; 
	}
	data.name = "pilihretensi";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url($com_url);?>/loadsub',data,options);
}

<?=$class_name;?>grid.image = function(data,settings){
  	var options = {
		width: '750',
		height: '430',
		title: 'Form Image'
	};
	
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url($com_url);?>/formgambar',{id_data:data.id_data},options);
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
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcompengolahan").trigger('reloadGrid');	
			}
			
		}
	});
}

<?=$class_name;?>grid.extra.cetak_pdf = function(data,settings){

	var chk = $('#form-b').serializeArray();
	// 	console.log(chk);
	$.ajax({
		url : '<?=site_url($com_url)?>/cetak_pdf',
		data : {'id_data':data.id,'id_lokasi_simpan':data.id_lokasi_simpan,'chk':chk},
		type : 'POST',
		
	});
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
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcompengolahan").trigger('reloadGrid');	
			}
		}
	});
}

<?=$class_name;?>grid.btn_grid_del=function(params){
	<?=$class_name;?>grid.formprop.delData.id_data = params.id_data;

	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_data,<?=$class_name;?>grid.formprop);	
}
<?=$class_name;?>grid.formprop.afterComplete = function (response) { 
// console.log(response);
	alert('sukses');
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
