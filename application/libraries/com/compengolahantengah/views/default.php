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

<table border=0 class="table-flat" >
<tr>
	<td>Cari Berdasarkan</td><td>:</td>
	
	<td> 
	<select name='pilih_cari' id='pilih_cari'>
	<!-- <option value=''>--pilih--</option> -->
	<option value='judul'>Judul</option>	
	<option value='id_unit_pengolah'>Pengolah</option>	
	<option value='tahun'>Tahun</option>
	<option value='lokasi'>Lokasi</option>
	</select>
	<input type='text' name='cari' id='cari'><input type='button' name='btncari' id='btncari' value='Cari'></td>
</tr>	
<tr>
	<td>FILTER</td><td>:</td><td><select name='filter' id='filter'>
		<option value=''>Default All</option>
		<option value='retensi'>Retensi</option>
		<option value='aktif'>Aktif</option>
	</select>
	</td>
</tr>	
</table>	
<div class="page-break" />
<div class="button-box-skyblue">	
	<button class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.tambah({});"><span class="icon-plus-bt-blue"><span>Tambah Data</span></button>	
	
</div>
<div class="page-break" />
