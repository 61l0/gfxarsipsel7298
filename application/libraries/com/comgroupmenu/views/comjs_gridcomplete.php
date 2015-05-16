<?=$class_name;?>grid.opt.gridComplete = function(){
	var ids = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getDataIDs');
	var id_group = jQuery("#id_group").val();
	for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var row = jQuery("#"+<?=$class_name;?>grid.id).jqGrid('getRowData',cl);
        var sp = $("<input type='checkbox' id='cek"+cl+"' name='cek"+cl+"' onclick=\"<?=$class_name;?>cek({id_menu:"+cl+",id_group:"+id_group+"});\">");
		var ins = jQuery("<div />").addClass("ui-pg-div ui-inline-edit").css("float","left").css("cursor","pointer").attr("title","Klik untuk melihat data");
		if(row.id_group==id_group){
		    sp.attr('checked',true);
		}
		ins.append(sp);
		var dummy = jQuery("<div />").append(ins);
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid('setRowData',ids[i],{cek:dummy.html()});
	}
};

<?=$class_name;?>cek = function(data){
    var cek = jQuery("#cek"+data.id_menu+":checked").val();
//    console.log(cek);
    $.ajax({
        url:'<?=site_url($com_url.'formaction');?>',
        type:'POST',
        dataType:'json',
        data:{id_menu:data.id_menu,id_group:data.id_group,cek:cek},
        success: function(msg){
//            if(msg.result=='succes'){
//                alert(msg.message);
//            }else{
//                alert(msg.message);
//            }
        }
    });
}
