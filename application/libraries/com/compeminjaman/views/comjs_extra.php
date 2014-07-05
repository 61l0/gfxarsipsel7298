if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}
	

compengolahangrid={extra:{}};
compengolahangrid.extra.cetak_pdf = function(data,settings){

	var chk = $('#form-b').serializeArray();
	var chks=[];
	$.each(chk,function(i,o){
		chks.push(o.value);
	});
	//console.log(chks)
	var url ='<?=site_url('admin/com/pengolahan')?>/cetak_pdf' + '?id_data=' + data.id + '&id_lokasi_simpan='+data.id_lokasi_simpan+'&chk='+chks.join('_')
	window.open(url);
	//var newTab = $('<a>PRINT</a>').css({display:'block'}).attr('href',url).attr('target','_blank');
	//$('body').prepend(newTab);
	//newTab.click();
	/*$.ajax({
		url : '<?=site_url($com_url)?>/cetak_pdf',
		data : {'id_data':data.id,'id_lokasi_simpan':data.id_lokasi_simpan,'chk':chk},
		type : 'POST',
		
	});*/
}
<?=$class_name;?>grid.image = function(data,settings){
  	var options = {
		width: '750',
		height: '430',
		title: 'Gambar Arsip'
	};
	
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url($com_url);?>/viewgambar',{id_data:data.id_data},options);
}

<?=$class_name;?>grid.extra.short_status = function(data,settings){
	jQuery('#gridcompeminjaman').jqGrid('setPostDataItem','status',data.status);
	jQuery("#gridcompeminjaman").trigger('reloadGrid');	
}

<?=$class_name;?>grid.extra.cari = function(data,settings){
	jQuery('#gridcompeminjaman').jqGrid('setPostDataItem','judul',data.valcari);
	jQuery('#gridcompeminjaman').jqGrid('setPostDataItem','typecari',data.typecari);
	jQuery("#gridcompeminjaman").trigger('reloadGrid');	
}

<?=$class_name;?>grid.btn_doc_view = function(data,settings){
    var options = {
		title: 'Detail Dokumen',
        width: '650',
        height: '470'
    };
	gf.dialog.layer('<?=site_url('admin/com/pengolahan');?>/view',data,options);
}

<?=$class_name;?>grid.extra.tambah = function(data,settings){
	 var options = {
        title: 'Form Tambah Data',
        width: '600',
        height: '600'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/peminjaman');?>/tambah_data',data,options);
}

<?=$class_name;?>grid.extra.pilih_arsip = function(data,settings){
    var options = {
		title: 'Detail Data',
        width: '750',
        height: '500'
    };
    // data.rowdata = {id:data.id};
	if(!data){
		var data = {}; 
	}
	// data.name = "pilihmstskpdjenis";
	data.name = "piliharsip";
	
    $.extend(true,options,settings);
    gf.dialog.layer('<?=site_url($com_url);?>/loadsub',data,options);
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
		title: 'Detail Data',
        width: '600',
        height: '500'
    };
	gf.dialog.layer('<?=site_url($com_url);?>/view',data,options);
}

<?=$class_name;?>grid.btn_grid_edit = function(data,settings){
    var options = {
		title: 'Form Edit Data',
        width: '600',
        height: '600'
    };
	gf.dialog.layer('<?=site_url('admin/com/peminjaman');?>/edit',data,options);
}

<?=$class_name;?>grid.extra.cetak_pdf = function(data,settings){

	var chk = $('#form-b1').serializeArray();
	//alert(chk);
	// 	console.log(chk);
	//$.ajax({
	//	url : '<?=site_url($com_url)?>/cetak_pdf',
	//	data : {'id_data':data.id,'id_lokasi_simpan':data.id_lokasi_simpan,'chk':chk,id:id},
	//	type : 'POST',
		
	//});
	var chk = $('#form-b').serializeArray();
	var chks=[];
	$.each(chk,function(i,o){
		chks.push(o.value);
	});
	//console.log(chks)
	var url ='<?=site_url($com_url)?>/cetak_pdf' + '?idp='+data.idp+'&id_data=' + data.id + '&id_lokasi_simpan='+data.id_lokasi_simpan+'&chk='+chks.join('_')
	window.open(url);
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
			jQuery("#gridcompeminjaman").trigger('reloadGrid');	
			}
		}
	});
}

<?=$class_name;?>grid.btn_grid_del=function(params){
	<?=$class_name;?>grid.formprop.delData.id_peminjaman = params.id_peminjaman;

	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_peminjaman,<?=$class_name;?>grid.formprop);	
}
<?=$class_name;?>grid.extra.simpan_data_peminjaman = function(data,settings){

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
			jQuery("#gridcompeminjaman").trigger('reloadGrid');	
			}
			
		}
	});
}


