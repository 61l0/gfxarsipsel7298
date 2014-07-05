<script type='text/javascript'>   
<?=$class_name;?>grid = <?=convert_js_serialize($grid);?>;

<?=$class_name;?>grid.formprop.afterSubmit  = function(response, postdata){
	eval("var result = " + response.responseText);
//  id_menu diganti dengan colmodel yg dijadikan 
	return [true,'Data berhasil ditambahkan',result.rows.id_menu];
};
<?=$class_name;?>grid.opt.datatype = function(pdata){
		if(pdata.nodeid){
			var rowData = jQuery("#"+<?=$class_name;?>grid.id).jqGrid("getRowData",pdata.nodeid);
			rowData.girista = "huya";
			jQuery.extend(pdata,rowData);
		}
		$.ajax({
			url:<?=$class_name;?>grid.opt.url,
			data:pdata,
			type:"POST",
			dataType:"json",
			beforeSend : function(){
				if(pdata.nodeid){
				}
			},
			complete: function(jsondata,stat){
				if(stat=="success") {
					var thegrid = jQuery("#"+<?=$class_name;?>grid.id)[0];
					thegrid.addJSONData(eval("("+jsondata.responseText+")"))
				}
			}
		});
};
<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		var fnName = "<?=$class_name;?>.main.btn_grid_plus.click({id_parent:"+row.id_menu+"});";
		var sp = jQuery("<span />").addClass("ui-icon ui-icon-plus").attr('onclick',fnName);
		var ins = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk menyisipkan data");
		ins.append(sp);
		var dummy = jQuery("<div />").append(ins);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{ins:dummy.html()});
		// dipersipakan utuk contextMenu, rightClick on row
		// jQuery("tr#"+cl,"#"+<?=$class_name;?>grid.id).contextMenu('jqContextMenu',{});
	}
	jQuery(".ui-inline-edit").bind("mouseover",function(){jQuery(this).addClass('ui-state-hover');});
	jQuery(".ui-inline-edit").bind("mouseout",function(){jQuery(this).removeClass('ui-state-hover');});
};




<?=$class_name;?> =  {
	main:{
		init:function(){
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid( <?=$class_name;?>grid.opt );
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid("navGrid",
				"#"+<?=$class_name;?>grid.pager	,
				{
					edit:false,
					search:false,
					add:false,
					del:false
					}
			); 
// start add toolbar
			var liList1 = jQuery("<li/>").addClass("plus").attr("id","<?=$class_name;?>_menutambah").append('<a href="javascript:void(0);">Tambah</a>');
			liList1.css('margin-left','10px');
			liList1.mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			liList1.mouseover(function(){jQuery(this).addClass('ui-state-hover');});
			var ulList = jQuery("<ul />").append(liList1);
			var divList = jQuery("<div />").addClass('tools').css('float','left').append(ulList);
			$("#t_"+<?=$class_name;?>grid.id).append(divList); 
			$("ul li#<?=$class_name;?>_menutambah","#t_"+<?=$class_name;?>grid.id).click(function(){<?=$class_name;?>.main.btn_grid_plus.click({id_parent:"0"});}); 

// end add toolbar
		},
		btn_grid_plus:{
			click:function(params){
				if(params.id_parent == 0){ // untuk menambahkan root node, maka terlebih dahulu reset row yang terpilih
					jQuery("#"+<?=$class_name;?>grid.id).jqGrid("resetSelection");
				}
				jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow","new",<?=$class_name;?>grid.formprop);
			}
		}
	}
};
</script>
