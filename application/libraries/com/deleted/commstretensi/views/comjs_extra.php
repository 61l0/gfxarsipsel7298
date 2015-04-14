if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
};


<?=$class_name;?>grid.btn_grid_del=function(params){
	<?=$class_name;?>grid.formprop.delData.id_retensi = params.id_retensi;
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_retensi,<?=$class_name;?>grid.formprop);	
}
<?=$class_name;?>grid.btn_grid_edit = function(data,settings){
	var options = {
        title: 'Form Tambah Data',
        width: '700',
        height: '340'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/mstretensi');?>/edit',data,options);	
}

<?=$class_name;?>grid.btn_grid_plus = function(data,settings){
	 var options = {
        title: 'Form Tambah Data',
        width: '700',
        height: '340'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/mstretensi');?>/tambah_data',data,options);
};

<?=$class_name;?>grid.extra.tambah = function(data,settings){
	 var options = {
        title: 'Form Tambah Data',
        width: '700',
        height: '330'
    };
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url('admin/com/mstretensi');?>/tambah_data',data,options);
}

<?=$class_name;?>grid.extra.simpan_data = function(data,settings){
	var str = $('form#formretensi').serialize();
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
				jQuery("#gridcommstretensi").trigger('reloadGrid');	
			}
		}
	});
}
<?=$class_name;?>grid.extra.simpan_data_edit = function(data,settings){
	var str = $('form#formretensi').serialize();
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
				jQuery("#gridcommstretensi").trigger('reloadGrid');	
			}
		}
	});
}
<?=$class_name;?>grid.formprop.afterComplete = function (response, postdata, formid) { 
	if(response.status == 200){
		eval("var responseText ="+response.responseText+"");
	    var cek = responseText.rows.cek;
		var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	    for(var i=0;i < ids.length;i++){
		    var cl = ids[i];
		    var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		    var leaf = jQuery("tr#"+cl+" td .tree-wrap div").hasClass("tree-leaf");
		    if(leaf==true){
		        var fnDel = "<?=$class_name;?>grid.btn_grid_del({id_row:"+cl+",act:'del'});";
				var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk menghapus data");
				insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
				var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
				insDel.append(spDel);
				var actDelContainer = $("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] span.ui-icon-trash");
				if(actDelContainer){
					actDelContainer.remove();
				}

				if(row.jml_hirarki == 0){
				    $("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDel);
				}
		    }
		}
	}
};
