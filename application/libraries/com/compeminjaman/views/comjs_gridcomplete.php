<?=$class_name;?>grid.opt.gridComplete = function(){
    var w = jQuery(".main-content").width();
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGridWidth',w-(w*0.035));
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
		var agenda = row.agenda.length ? row.agenda : '-';

		row.no_berkas = row.no_berkas.replace(/\{agenda\}/ig,agenda);

		row.tanggal_pinjam = $.datepicker.formatDate('dd-mm-yy',new Date(row.tanggal_pinjam))
			if(row.tanggal_kembali == 'NaN-NaN-NaN' || row.tanggal_pinjam == '01-01-1970')
				row.tanggal_pinjam = '-'
		row.tanggal_kembali = $.datepicker.formatDate('dd-mm-yy',new Date(row.tanggal_kembali))
			if(row.tanggal_kembali == 'NaN-NaN-NaN' || row.tanggal_kembali == '01-01-1970')
				row.tanggal_kembali = '-'		
		row.status = row.status.toUpperCase();		
		//console.log(row);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',cl,row);
		// if(row.act == ""){
			var fnView = "<?=$class_name;?>grid.btn_grid_view({id_peminjaman:"+row.id_peminjaman+", oper:'view'});";
			var insView = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Lihat");
			insView.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spView = jQuery("<span />").addClass("ui-icon ui-icon-document").attr('onclick',fnView);
			insView.append(spView);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insView);
			
			var fnEdit = "<?=$class_name;?>grid.btn_grid_edit({id_peminjaman:"+row.id_peminjaman+",oper:'edit'});";
			var insEdit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Ubah");
			insEdit.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spEdit = jQuery("<span />").addClass("ui-icon ui-icon-pencil").attr('onclick',fnEdit);
			insEdit.append(spEdit);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insEdit);

			var fnDel = "<?=$class_name;?>grid.btn_grid_del({id_peminjaman:"+row.id_peminjaman+",oper:'del'});";
			var insDel = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Hapus");
			insDel.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spDel = jQuery("<span />").addClass("ui-icon ui-icon-trash").attr('onclick',fnDel);
			insDel.append(spDel);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDel);

			var fnImage = "<?=$class_name;?>grid.image({id_data:"+row.id_data+",oper:'del'});";
			var insImage = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Image");
			insImage.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spImage = jQuery("<span />").addClass("ui-icon ui-icon-image").attr('onclick',fnImage);
			insImage.append(spImage);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insImage);

			//console.log(row);	
			var fnDoc = "<?=$class_name;?>grid.btn_doc_view({id_row:"+row.id_data+",id_lokasi_simpan:"+row.id_lokasisimpan+", oper:'view'});";
			var insDoc = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Doc");
			insDoc.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
			var spDoc = jQuery("<span />").addClass("ui-icon ui-icon-document-b").attr('onclick',fnDoc);
			insDoc.append(spDoc);
			$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insDoc);
		// }
	}
};

