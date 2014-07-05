window.aux = <?php echo json_encode($aux)?>;

if(!<?=$class_name;?>grid.extra){
    <?=$class_name;?>grid.extra = {};
}
<?=$class_name;?>grid.extra.btnmember = function(){
	var group_id = jQuery('#group_id').val();
	$.ajax({
			url:'<?=site_url('admin/com/user/checkgroup');?>',
			type:'POST',
			dataType:'json',
			data:{group_id:group_id},
			success:function(jsondata){
				console.log(jsondata.group_id);
				if(jsondata.result ='success'){
					switch(jsondata.group_id){
						case '3':
						jQuery('#id_skpd_sotk').val('').removeAttr('readonly');
						jQuery('button').show();
						jQuery('#btn_operator').hide();
						break;
						case '2':
						jQuery('#id_skpd_sotk').val('').removeAttr('readonly');
						jQuery('button').show();
						jQuery('#btn_operator').hide();
						break;
						case '6':
						jQuery('#id_unit_pengolah').val('').removeAttr('readonly');
						jQuery('#btn_operator').show();
						jQuery('#btn_skpd').hide();
						break;
						case '':
						jQuery('#id_skpd_sotk').val('');
						//jQuery('button').hide();
						break;
						default:
						jQuery('#id_skpd_sotk').val('0');
						jQuery('button').hide();
						
						jQuery('#btn_operator').hide();
						break;
					}
				}
			}
	});
}
<?=$class_name;?>grid.extra.pilihskpd = function(settings){
	var options = {
		width: '800',
		height: '500',
		title: '"Pilih Skpd"'
	};
   // gf.content.fragment('#main_panel_container','<?=site_url('admin/com/mstskpd');?>/loadsub',data);
    $.extend(options,settings);
    gf.dialog.layer('<?=site_url('admin/com/mstskpd');?>','',options);
}

<?=$class_name;?>grid.extra.pilihoperator = function(settings){
	var options = {
		width: '800',
		height: '500',
		title: '"Pilih Pengolah"'
	};
   // gf.content.fragment('#main_panel_container','<?=site_url('admin/com/mstoperator');?>/loadsub',data);
    $.extend(options,settings);
    gf.dialog.layer('<?=site_url('admin/com/mstoperator');?>','',options);
}

setTimeout(function(){
	//$('input#id_skpd_sotk,input#id_unit_pengolah').hide();
	//console.log('HELLO')
},500);