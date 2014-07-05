if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
};
jQuery("#id_prokeg_aturan").attr('onchange','dropdown()');
<?=$class_name;?>grid.extra.loadsub = function(data,settings){
    var aturan = $("#id_prokeg_aturan").val();
	if(aturan=='' || aturan==0){
		alert('Pilih dahulu Aturan!');
	} else{
		var options = {
			width: '850',
			height: '450',
			title: 'Penambahan Data'
		};
		data.rowdata = {id_prokeg_aturan:aturan,id_prokeg_aturan_item:data.id_prokeg_aturan_item,id_prokeg:'0'};   
		$.extend(options,settings);
		gf.dialog.layer('<?=site_url($com_url);?>/loadsub',data,options);
    }
};
$(".page-link").html("<ul><li><a>Data Master</a></li><li><a class='active'>Program dan Kegiatan Tiap Aturan</a></li></ul>");