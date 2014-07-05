if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}

<?=$class_name;?>grid.extra.loadsub = function(params,settings){
		var id_rubrik = $("#id_rubrik").val();
		// alert(id_rubrik);
		var options = {
			width: '800',
			height: '500',
			title: 'Form Manage Artikel Rubrik Berita Utama'
		};
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/form',{id_berita:params.id_berita,oper:params.oper,id_rubrik:id_rubrik},options);
}

<?=$class_name;?>grid.mymethod.event.plus = function(){
    var data = {id_berita:'0',oper:'add'};
    <?=$class_name;?>grid.extra.loadsub(data);
};	
<?=$class_name;?>grid.btn_grid_view=function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_berita,<?=$class_name;?>grid.formprop);
};	

<?=$class_name;?>grid.btn_grid_edit=function(params){
	// jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_berita,<?=$class_name;?>grid.formprop);
	var data = {id_berita:params.id_berita,oper:params.oper};
    <?=$class_name;?>grid.extra.loadsub(data);
		
}
<?=$class_name;?>grid.extra.del = function(data){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('delGridRow',data.id_berita,<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_close_dialog = function(){
	$("#dialogArea1").dialog('close');
}

<?=$class_name;?>grid.extra.btn_simpan = function(settings){
	var options = { 
		dataType: 'json',
		type:      'POST',
		success : function(data) { 
			if(data.result == 'succes'){
				jQuery("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
				if(data.oper == 'add'){
					jQuery('#myForm').clearForm();
				}
			}
			jQuery("#dialogArea1").dialog('close');
			alert('Data telah disimpan');
		} 
	};
	jQuery.extend(options,settings);
	jQuery('#myForm').ajaxForm(options); 
}
<?=$class_name;?>grid.extra.remove_file = function(params){
	$.ajax({
		type:'POST',
		data:{id_berita:params.id_berita},
		dataType:'JSON',
		url :'<?=site_url("admin/com/cmspengumuman/removefile");?>',
		success:function(data){
			alert(data);
		}
	})
};
<?=$class_name;?>grid.extra.loadFormImageEditingGaleri = function(id_berita){
		loadFragment('#dialogArea1','<?=site_url('admin/com/cmspengumuman/form');?>',{id_berita:id_berita,oper:'edit'});
}
<?=$class_name;?>grid.extra.btn_upload = function(params){
	var btnUploadImage=$('#file') , interval; 
		var status=$('#notification');	
	// var id_peng = jQuery('#'+<?=$class_name;?>grid.id).jqGrid('getGridParam','selrow'); 
	var id_peng = $("#id_berita").val();
	new AjaxUpload(btnUploadImage, {
		action: '<?=site_url($com_url);?>/saveupload',
		name: 'pengumuman_file',
		data: {id_berita: id_peng},
		onSubmit: function(file, ext){
			if (! (ext && /^(pdf|zip|rar|doc|xls|docx)$/.test(ext))){ 
				status.text('Hanya File dengan ext PDF,ZIP,RAR.DOC, dan XLS yang dapat diupload !');
				return false;
			}
			status.text('Uploading').addClass('notification-ok'); 
			interval = window.setInterval(function(){
				var text = status.text();
				if (text.length < 17){
					status.text(text + '.');					
				} else {
					status.text('Uploading');				
				}
			}, 200);
		},
		onComplete: function(file, response){
			window.clearInterval(interval);
			status.html('');
			status.text(''); 
			var arr_result = response.split("#");
			/////////===Add uploaded file to list===
			if(arr_result[0]=="success"){
				jQuery('#id_berita').val(arr_result[2]);
				jQuery('#oper').val('edit');
				status.removeClass('msg-box-false');
				status.addClass('msg-box-true');
				status.html('<ul><li>' + file  + ', success di upload !' + '</li></ul>' ).addClass('notification-ok');
			} else{
				status.removeClass('msg-box-true');
				status.addClass('msg-box-false');
				status.html('<ul><li>' + file  + ', gagal di upload ! <br />' + arr_result[1] + '</li></ul>').addClass('notification-error');					
			} 
		}
	});//===============end image upload script

} 

<?=$class_name;?>grid.extra.urut = function(data){
    var dataAll = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData');
    var pdata = {};
    $.each(dataAll ,function(i,val){
	    if(data.index == i){
	        pdata.id_self = val.id_berita;
	        pdata.id_menu = val.id_menu;
	        pdata.urutan = val.urutan;
	        pdata.oper = data.oper;
	        if(data.oper == 'naik'){
	            pdata.urutan_dest = parseInt(val.urutan) - 10;
	            pdata.id_parent_dest = val.id_menu;
	        }else{
	            pdata.urutan_dest = parseInt(val.urutan) + 10;
	            pdata.id_parent_dest = val.id_menu;
	        }
	    }
    });
    $.each(dataAll ,function(i,val){
        if(pdata.urutan_dest == val.urutan){
            pdata.id_berita = val.id_berita;
        }
    });
	$.ajax({
		url: '<?=site_url($com_url);?>/urut',
		type: 'POST',
		dataType: 'json',
		data: pdata,
		success: function(jsondata){
			$("#"+<?=$class_name;?>grid.id).trigger('reloadGrid');
		}
	});
};
<?=$class_name;?>grid.extra.optrubrik = function(){
	var id_rubrik= $("#id_rubrik").val(); 
	
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setPostDataItem','id_rubrik',id_rubrik);
	jQuery("#"+<?=$class_name;?>grid.id).trigger("reloadGrid");		
}

