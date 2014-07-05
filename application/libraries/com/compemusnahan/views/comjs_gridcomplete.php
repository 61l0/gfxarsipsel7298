<?=$class_name;?>grid.opt.gridComplete = function(){
    var w = jQuery(".main-content").width();
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setGridWidth',w-(w*0.035));
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');

		
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
			// UPDATE ROW DATA
			//console.log(row)
			var status = row.status_text;
			if(row.status.length <= 0)
				row.status  = '<span style="color:brown">INAKTIF</span>';
			else if(row.status == 'tinjau')
				row.status = '<span style="color:green">DINILAI KEMBALI</span>';
			else if(row.status == 'musnahkan')
				row.status = '<span style="color:red">SUDAH DIMUSNAHKAN</span>';
			row.tanggal = $.datepicker.formatDate('dd-mm-yy',new Date(row.tanggal))
			if(row.tanggal == 'NaN-NaN-NaN')
				row.tanggal = '-'	
			row.no_arsip = row.no_arsip +'/'+ row.agenda+'.'+row.kode_komponen+'/'+row.tahun;
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',cl,row);


			if(status != 'musnahkan' && status != 'tinjau'){
				var fnView = "<?=$class_name;?>grid.simpan_data({id_data:"+row.id_data+", oper:'musnahkan'});";
				var insView = jQuery("<div />&nbsp;&nbsp;").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Musnahkan");
				insView.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
				var spView = jQuery("<span />").html("<i class='fa icon-trash'></i>&nbsp;").attr('onclick',fnView).css('color','red');
				insView.append(spView);
				$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act'] ").append(insView);
			}
			if(status != 'tinjau'){
				var fnEdit = "<?=$class_name;?>grid.simpan_data({id_data:"+row.id_data+",oper:'tinjau'});";
				var insEdit = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Nilai Kembali");
				insEdit.mouseover(function(){jQuery(this).addClass('ui-state-hover');}).mouseout(function(){jQuery(this).removeClass('ui-state-hover');});
				var spEdit = jQuery("<span />").html("<i class='fa icon-edit'></i>&nbsp;").attr('onclick',fnEdit).css('color','green');
				insEdit.append(spEdit);
				$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append(insEdit);

			}
			if(status == 'tinjau')
			{
				$("tr#"+cl+" td[aria-describedby='"+<?=$class_name;?>grid.id+"_act']").append('<i>-</i>')
			}
	}
};

