<script>
	$("#btncari").click(function () {
		var nilai = $('#cari').val();
		var type_cari = $('#pilih_cari').val();
		<?=$class_name;?>grid.extra.cari({'valcari':nilai,'typecari':type_cari});
	});	
	$("#typecatatan").change(function () {
		var n = $('#typecatatan').val();
		<?=$class_name;?>grid.extra.change({'dd':n});
	});
	var head_content = jQuery("#header_caption_content").hasClass('head-content');
	if(! head_content){
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
	}else{
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
	}
	
		$(function(){

			$('#cari').autocomplete('<?=site_url('admin/com/catatanadmin');?>/autocomplete',
				{
					
					extraParams: {
						type_cari : function() { return $('#pilih_cari option:selected').val()},					  
					 },
					parse: function(data){ 
						
					var parsed = [];
						for (var i=0; i < data.length; i++) {
							parsed[i] = {
								data: data[i],
								value: data[i].hasil 
							};
						}
						return parsed;				
					},
					formatItem: function(data,i,max){
						
						var str = '<div class="search_content">';
						
						str += '<u>'+data.hasil+'</u>';
						str += '</div>';
						return str;
					},
					width: 270, 
					dataType: 'json' 	
					
					
				}
			
			).result(
					function(event,data,formated){
					
						$('#cari').val(data.hasil); 
						
						
					}	
			);
			
});					
		
</script>
<h3 class="grid-title"><i class="fa icon-hdd"></i>&nbsp;Master Instansi</h3>

<div class="toolbar-grid">
	 <a href="javascript:;" onclick="<?=$class_name;?>grid.extra.tambah({});">
	 	<i class="fa icon-plus-sign"></i>&nbsp;Tambah Data
	 </a>
	 <div class="cb"></div>
</div>
<style type="text/css">
.content .toolbar-grid{width: 123px}
.ui-jqgrid-view .ui-userdata.ui-state-default{
	display: none;
}
</style>