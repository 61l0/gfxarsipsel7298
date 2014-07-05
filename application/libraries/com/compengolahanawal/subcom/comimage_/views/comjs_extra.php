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
    gf.dialog.layer('<?=site_url('admin/com/perusahaan');?>/loadsub',data,options);
}

<?=$class_name;?>grid.mymethod.event['plus'] = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow","new",{
			width:500,
			closeAfterAdd:true,
			editData : {
						id_perusahaan:'<?=@$id_perusahaan;?>',
						},
			afterSubmit : function(response,postdata){
					eval("var result = " + response.responseText);
					var pri_key = <?=$class_name;?>grid.opt.prmNames.id;
					if(result.result == 'failed'){
						return [false,result.message];
					}else{
						return [true,'Data berhasil ditambahkan',result.rows[pri_key]];
					}
			}
		}
	);
};

<?=$class_name;?>grid.extra.btn_grid_edit = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_produk,{
			width:1000,
			closeAfterEdit:true,
			editData : {
						id_produk:params.id_produk,
						id_perusahaan:params.id_perusahaan,
						},
			
		}
	);
};

<?=$class_name;?>grid.extra.btn_grid_img = function(params,settings){
    // var data = {name:'comdetail1',id_kecamatan:params.id_kecamatan,id_jenisdagang:id_jenisdagang,tahun:tahun,bulan:bulan};
    // var data = {name:'comdetail1',data:data};
    // data.rowdata = {id:data.id};   
	var options = {
		width: '750',
		height: '430',
		title: 'Form Gambar Produk'
	};
	
	$.extend(options,settings);
	gf.dialog.layer('<?=site_url($com_url);?>/formgambar',{id_produk:params.id_produk},options);

	// loadFragment('#','<?=site_url("admin/com/lappedagangkakilima");?>/loadsub',{name:'comdetail2',id_jenisdagang:params.id_jenisdagang,id_kelurahan:params.id_kelurahan,tahun:params.tahun,bulan:params.tahun});
};

<?=$class_name;?>grid.extra.btn_grid_detail = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_produk,{
			width:700,
			savekey:{"view":false},
			editData : {
						id_produk:params.id_produk,
						id_perusahaan:params.id_perusahaan,
						},
			
		}
	);
};


<?=$class_name;?>grid.extra.btn_grid_del = function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_row,{
			width:300,
			top:0,
		}
	);
};
