<?=$class_name;?>grid.mymethod = {
	toolbar:function(grid){
		var ulList = jQuery("<ul />");
		$.each(grid,function(i,item){
				// console.log(item);
				var liList1 = jQuery("<li/>").addClass(item.cls).attr("id",<?=$class_name;?>grid.id+"_menu"+i).append('<a href="javascript:void(0);">'+item.label+'</a>');
				liList1.css('margin-left','10px');
				liList1.mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
				liList1.mouseover(function(){jQuery(this).addClass('ui-state-hover');});
				if(!item.onclick){
					liList1.click(<?=$class_name;?>grid.mymethod.event[i]);
				}
				ulList.append(liList1);
				var divList = jQuery("<div />").addClass('tools').css('float','left').append(ulList);
				$("#t_"+<?=$class_name;?>grid.id).append(divList); 
		});
		// jQuery("#dialog_print, .ui-dialog-content").html("");
		jQuery("#dialog_print").html("");
	},
	event:{
		plus:function(){
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid("resetSelection");
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow","new",<?=$class_name;?>grid.formprop);
		},
		search:function(){
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid( 'searchGrid',{
					multipleSearch:false, 
					multipleGroup:false
				} 
			);
		},
		pilih:function(){
			<?=$class_name;?>grid.toolbar.pilih.onclick = function(){
				jQuery("#main_panel_container").load('<?=site_url($com_url.'detail');?>',params);
			};
		},
		word:function(){
			$("#dialog_print").attr("title","Print Word");
			var dv = $("<div />").attr('id','formWord');
			var frm = $("<form></form>").attr('action',<?=$class_name;?>grid.opt.url).attr('id','myFormWord').attr('target','_blank').attr('method','POST');
			var tbl = $("<table />");
			var lbl = $("<label />").html("Apakah and yakin akan mencetek word !");
			var oper = $("<input />").attr('id','oper').attr('name','oper').attr('value','word').attr('type','hidden');
			var post = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getGridParam','postData');
			$.each(post,function(i,val){
				tbl.append($("<input />").attr('id',i).attr('name',i).attr('type','hidden').attr('value',val));
			});
			tbl.append(oper).append(lbl);
			frm.append(tbl);
			dv.append(frm);
			$( "#dialog_print" ).html(dv).dialog({
				buttons: { 
					"Ok": function() { 
						$("form#myFormWord").submit();
						// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
						$(this).dialog("destroy");
					},
					"Batal": function(){
						// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
						$(this).dialog("destroy");
					}
				},
				closeOnEscape: false,
				close: function(event, ui) {
					// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
					$(this).dialog("destroy");
				}
			});
		},
		excel:function(){
			$("#dialog_print").attr("title","Print Excel");
			var dv = $("<div />").attr('id','formExcel');
			var frm = $("<form></form>").attr('action',<?=$class_name;?>grid.opt.url).attr('id','myFormExcel').attr('target','_blank').attr('method','POST');
			var tbl = $("<table />");
			var lbl = $("<label />").html("Apakah and yakin akan mencetek excel !");
			var oper = $("<input />").attr('id','oper').attr('name','oper').attr('value','excel').attr('type','hidden');
			var post = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getGridParam','postData');
			$.each(post,function(i,val){
				tbl.append($("<input />").attr('id',i).attr('name',i).attr('type','hidden').attr('value',val));
			});
			tbl.append(oper).append(lbl);
			frm.append(tbl);
			dv.append(frm);
			$( "#dialog_print" ).html(dv).dialog({
				buttons: { 
					"Ok": function() { 
						$("form#myFormExcel").submit();
						// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
						$(this).dialog("destroy");
					},
					"Batal": function(){
						// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
						$(this).dialog("destroy");
					}
				},
				closeOnEscape: false,
				close: function(event, ui) {
					// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
					$(this).dialog("destroy");
				}
			});
		},
		pdf:function(){
			$("#dialog_print").attr("title","Print PDF");
			var dv = $("<div />").attr('id','formPdf');
			var frm = $("<form></form>").attr('action',<?=$class_name;?>grid.opt.url).attr('id','myFormPdf').attr('target','_blank').attr('method','POST');
			var tbl = $("<table />");
			var lbl = $("<label />").html("Apakah anda yakin akan mencetek PDF !");
			var oper = $("<input />").attr('id','oper').attr('name','oper').attr('value','pdf').attr('type','hidden');
			var post = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getGridParam','postData');
			$.each(post,function(i,val){
				tbl.append($("<input />").attr('id',i).attr('name',i).attr('type','hidden').attr('value',val));
			});
			tbl.append(oper).append(lbl);
				
			frm.append(tbl);
			dv.append(frm);
			$( "#dialog_print" ).html(dv).dialog({
				buttons: { 
					"Ok": function() { 
						$("form#myFormPdf").submit();
						// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
						$(this).dialog("destroy");
					},
					"Batal": function(){
						// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
						$(this).dialog("destroy");
					}
				},
				closeOnEscape: false,
				close: function(event, ui) {
					// $("#dialog_print, .ui-dialog-content").html("");
						$("#dialog_print").html("");
					$(this).dialog("destroy");
				}
			});
		}
	}
};

