if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
};

<?=$class_name;?>grid.formprop.afterComplete = function (response, postdata, formid) { 
	if(response.status == 200){
		
		//console.log(response);

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

<?=$class_name;?>grid.formprop.beforeShowForm = function(formId){
	var grid = $("#"+<?=$class_name;?>grid.id);
	var defaultSelectType = '<select role="select" id="type" name="type" size="1" class="FormElement"><option role="option" value="depo">Depo</option><option role="option" value="rak">Rak</option><option role="option" value="box">Box</option><option role="option" value="folder">Sampul</option><option role="option" value="rool">Rool</option></select>';
	//console.log(formId);
 	var selectNode = formId.find("#type");
 	selectNode.replaceWith($(defaultSelectType).css('background','#dedede'));

 	function removeOption(remove){

		var selectNode = formId.find("#type");
		//console.log(remove);

		$.each(remove,function(i,key){
			//console.log(key);
			var query = 'option[value='+key+']';
			selectNode.find(query).remove();
		});
 	}

	setTimeout(function(){
		var MODE = 0;
		if(typeof commstlokasisimpangrid.MODE != 'undefined')
			MODE = commstlokasisimpangrid.MODE;
		
		
		var id_lokasi_simpan = grid.jqGrid('getGridParam','selrow');	

		//console.log('id_lokasi_simpan = ' + id_lokasi_simpan);

		var url_info = '<?php echo base_url()?>admin/com/mstlokasisimpan/get_info/' + id_lokasi_simpan;

		//console.log(MODE);

		switch(MODE){
			// ADD FROM PARENT
			case 1 :
			// EDIT
			case 2 :
			{
				$.getJSON(url_info,function(obj){
					var STRG = obj.data;

					
					if(MODE == 1)
					{
						switch(STRG.type){
							case 'depo':
								removeOption(['depo','box','folder']);
							break;
							case 'rak':
							case 'rool':
								removeOption(['depo','rak','rool','folder']);
							break;
							case 'box':
								removeOption(['depo','rak','rool','box']);
							break;
							case 'folder':
							case 'sampul':
								//console.log(STRG.type);
								removeOption(['depo','rak','rool','box','folder']);
								
								try{$('a.ui-jqdialog-titlebar-close').trigger('click');}catch(e){alert('Tidak dapat menambah data untuk level ini.');}
								
								
							break;
						}
					}
					else
					{
						var selectNode = formId.find("#type");	
						var query = 'option[value='+STRG.type+']';
						selectNode.find(query).attr('selected','selected');
						switch(STRG.type){
							case 'depo':
								removeOption(['rak','rool','box','folder']);
							break;
							case 'rak':
							case 'rool':
								removeOption(['depo','box','folder']);
							break;
							case 'box':
								removeOption(['depo','rak','rool','folder']);
							break;
							case 'folder':
							case 'sampul':
								removeOption(['depo','rak','rool','box']);
							break;
						}
					}
				});
			}
			break;
			// ADD
			case 3 :
				removeOption(['rak','box','folder','rool']);
			break;
		}
		
	},300);
	
};