<?=$class_name;?>grid.opt.datatype = function(pdata){
		data = pdata;
		if(pdata.nodeid){
			var rowData = jQuery("#"+<?=$class_name;?>grid.id).jqGrid("getRowData",pdata.nodeid);
			jQuery.extend(data,rowData);
		}else{
			data = <?=$class_name;?>grid.opt.postData;
		}
		$.ajax({
			url:<?=$class_name;?>grid.opt.url,
			data:data,
			type:"POST",
			dataType:"json",
			complete: function(jsondata,stat){
				if(stat=="success") {
					var thegrid = jQuery("#"+<?=$class_name;?>grid.id)[0];
					thegrid.addJSONData(eval("("+jsondata.responseText+")"))
				}
			}
		});
};

