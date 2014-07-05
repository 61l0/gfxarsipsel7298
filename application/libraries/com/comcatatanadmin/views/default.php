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
<h3 class="grid-title"><i class="fa icon-list-alt"></i>&nbsp;Catatan SKPD</h3>

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
	 <div class="cb"></div>
</div>
<div class="toolbar-filter">
<span>Catatan SKPD : &nbsp;</span><select name='typecatatan' id='typecatatan'>
		<option value='' selected="selected">All</option>
		<option value='masuk'>Masuk</option>
		<option value='keluar'>Keluar</option>
	</select>
</div>
<div class="toolbar-search">
<select name='pilih_cari' id='pilih_cari'>
	<!-- <option value=''>--pilih--</option> -->
	<option value='judul'>Judul</option>	
	
	</select>
	<input type='text' name='cari' id='cari'><input type='button' name='btncari' id='btncari' value='Cari'/>
</div>

<style type="text/css">
.toolbar-search, .toolbar-filter{width:438px}
.content .toolbar-grid{width: 246px}
</style>
