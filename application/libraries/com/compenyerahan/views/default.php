<script>
	$("#btncari").click(function () {
		var nilai = $('#cari').val();
		var type_cari = $('#pilih_cari').val();
		<?=$class_name;?>grid.extra.cari({'valcari':nilai,'typecari':type_cari});
	});	
	$("#filter_skpd").change(function () {
		var n = $('#filter_skpd').val();
		<?=$class_name;?>grid.extra.filter_skpd({'id_skpd':n});
	});
	var head_content = jQuery("#header_caption_content").hasClass('head-content');
	if(! head_content){
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
	}else{
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
	}	
	
		$(function(){

			$('#cari').autocomplete('<?=site_url('admin/com/penyerahan');?>/autocomplete',
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
<h3 class="grid-title"><i class="fa icon-exchange"></i>&nbsp;Penyerahan / Akuisisi</h3>

<div class="toolbar-grid">
	 <a href="javascript:;" onclick="<?=$class_name;?>grid.extra.tambah({});">
	 	<i class="fa icon-plus-sign"></i>&nbsp;Tambah Data
	 </a>
	<!--  <a href="javascript:;" onclick="$('.toolbar-filter').toggle();">
	 	<i class="fa icon-filter"></i>&nbsp;Filter
	 </a> -->
	 <a href="javascript:;" onclick="$('.toolbar-search').toggle();">
	 	<i class="fa icon-search"></i>&nbsp;Cari
	 </a>
	 <a href="javascript:;" onclick="$('#gridcompenyerahan').trigger('reloadGrid')" style="float:right">
	 	<i class="fa icon-refresh"></i>&nbsp;Refresh
	 </a>
	 <div class="cb"></div>
</div>
<div class="toolbar-filter">
<div <? if($group==3) {?> style='display:none' <? } ?>>
	<span>FILTER BERDASARKAN SKPD : &nbsp;</span><select name='filter_skpd' id='filter_skpd'>
		<option value=''>Default All</option>
		<? foreach($data_skpd as $row){?>
		<option value='<?=$row->id_skpd?>'><?=$row->nama_lengkap?></option>
		<? } ?>
	</select>

</div>	
</div>
<div class="toolbar-search">
<select name='pilih_cari' id='pilih_cari'>
	<!-- <option value=''>--pilih--</option> -->
	<option value='kepada'>Kepada</option>	
	<option value='instansi' <? if($group==3) {?> style='display:none' <? } ?>>Instansi</option>	
	
	</select>
	<input type='text' name='cari' id='cari'><input type='button' name='btncari' id='btncari' value='Cari'/>
</div>


<style type="text/css">
.toolbar-search, .toolbar-filter{width:460px}
.content .toolbar-grid{width: 263px}
</style>