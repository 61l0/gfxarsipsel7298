if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
};

<?=$class_name;?>grid.extra.loadsub = function(data,settings){
    var options = {
        width: '1000',
        height: '400'
    };
    data.rowdata = {id:data.id};   
    $.extend(options,settings);
    gf.dialog.layer('<?=site_url('cms/com/cmsgalerifoto');?>/loadsub',data,options);
};

<?=$class_name;?>grid.extra.btn_grid_edit = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_kategori,{
			width:400,
			closeAfterEdit:true,
			editData : {
						id_kategori:params.id_kategori,
						},
			
		}
	);
};

<?=$class_name;?>grid.extra.btn_grid_detail = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_kategori,{
			width:400,
			savekey:{"view":false},
			editData : {
						id_kategori:params.id_kategori,
						},
			
		}
	);
};
<?=$class_name;?>grid.extra.btn_grid_del = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_kategori,{
			width:300,
		}
	);
};

//========================= untuk upload gambar ========================================
<?=$class_name;?>grid.extra.btn_grid_img = function(params,settings){
	var options = {
		width: '750',
		height: '430',
		title: 'Form Gambar Perusahaan'
	};
	
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url($com_url);?>/formgambar',{id_kategori:params.id_kategori},options);

};

<?=$class_name;?>grid.extra.remove_image = function(params){
	$.ajax({
		type:'POST',
		data:{id_galeri:params.id_galeri},
		dataType:'JSON',
		url :'<?=site_url("admin/com/cmsgalerifoto/removeimage");?>',
		success:function(data){
			alert(data);
		}
	})
};
<?=$class_name;?>grid.extra.loadFormImageEditingGaleri = function(id_kategori){
		loadFragment('#dialogArea1','<?=site_url('admin/com/cmsgalerifoto/formgambar');?>',{id_kategori:id_kategori});
} 


