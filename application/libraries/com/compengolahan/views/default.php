<script>

	$("#btncari").click(function () {
		var nilai = $('#cari').val();
		var type_cari = $('#pilih_cari').val();
		<?=$class_name;?>grid.extra.cari({'valcari':nilai,'typecari':type_cari});
	});
	$("#filter").change(function () {
		var n = $('#filter').val();
		<?=$class_name;?>grid.extra.filter({'filter':n});
	});	
	var head_content = jQuery("#header_caption_content").hasClass('head-content');
	if(! head_content){
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
	}else{
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
	}
	

	
		$(function(){

			$('#cari').autocomplete('<?=site_url('admin/com/pengolahan');?>/autocomplete',
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

<h3 class="grid-title"><i class="fa icon-retweet"></i>&nbsp;Data Pengolahan</h3>

<div class="toolbar-grid">
	 <a href="javascript:;" onclick="<?=$class_name;?>grid.extra.tambah({});">
	 	<i class="fa icon-plus-sign"></i>&nbsp;Tambah Data
	 </a>
	 <a href="javascript:;" onclick="$('.toolbar-filter').toggle();">
	 	<i class="fa icon-filter"></i>&nbsp;Filter
	 </a>
	 <a href="javascript:;" onclick="$('.toolbar-search').toggle();">
	 	<i class="fa icon-search"></i>&nbsp;Cari
	 </a>
	 <a href="javascript:;" onclick="$('#gridcompengolahan').trigger('reloadGrid')" style="float:right">
	 	<i class="fa icon-refresh"></i>&nbsp;Refresh
	 </a>
	 <div class="cb"></div>
</div>
<div class="toolbar-filter">
<span>Filter : &nbsp;</span><select name='filter' id='filter'>
		<option value=''>Default All</option>
		<option value='inaktif'>Inaktif</option>
		<option value='aktif'>Aktif</option>
	</select>
</div>
<div class="toolbar-search">
<select name='pilih_cari' id='pilih_cari'>
	<!-- <option value=''>--pilih--</option> -->
	<option value='judul'>Judul</option>	
	<option value='id_unit_pengolah'>Instansi</option>	
	<option value='tahun'>Tahun</option>
	<option value='lokasi'>Lokasi</option>
	</select>
	<input type='text' name='cari' id='cari'><input type='button' name='btncari' id='btncari' value='Cari'/>

	
</div>
<div class="search-info">
	</div>
<style type="text/css">
.toolbar-search, .toolbar-filter{width:466px}
.content .toolbar-grid{width: 334px}
.search-info{display: none;padding: 4px;margin: 0 auto;text-align: center;
	font-style: italic;font-size: 130%;
}
</style>
