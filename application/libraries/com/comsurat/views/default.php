<style type="text/css">
	select[name=pilsurat]{
		float:left;
	}
	#gbox_gridcomsurat th.ui-th-column-header {
	    font-family: Calibri;
	    font-size: 150%;
	    font-weight: bold;
	    text-align: center;
	    text-transform: uppercase;
	}
</style>
<script>
	$("#btncari").click(function () {
		var nilai = $('#cari').val();
		var type_cari = $('#pilih_cari').val();
		<?=$class_name;?>grid.extra.cari({'valcari':nilai,'typecari':type_cari});
	});		
	var head_content = jQuery("#header_caption_content").hasClass('head-content');
	if(! head_content){
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
	}else{
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
	}	

		$(function(){

			setTimeout(function(){

				$('#gridcomsurat').trigger('reloadGrid');
			},1000);

			$('select[name=pilsurat]').change(function(){
				var type_surat = $('select[name=pilsurat] option:selected').val();
				$.post("<?php echo site_url('admin/com/surat/set_typesurat')?>",{'type_surat':type_surat},function(){
					$("#gridcomsurat").trigger('reloadGrid');
				});
			});
			$('#cari').autocomplete('<?=site_url('admin/com/surat');?>/autocomplete',
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
<h3 class="grid-title"><i class="fa icon-envelope"></i>&nbsp;Surat Masuk &amp; Keluar</h3>
<div class="toolbar-grid" style="width:247px">
	
	<a href="javascript:;" onclick="$('#gridcomsurat').trigger('reloadGrid');" style="float:right">
	 	<i class="fa icon-refresh"></i>&nbsp;Refresh
	 </a>

	 <a href="javascript:;" onclick="<?=$class_name;?>grid.extra.tambah({type_surat:$('select[name=pilsurat]').val()});">
	 	<i class="fa icon-plus-sign"></i>&nbsp;Tambah Data
	 </a>

	 <a href="javascript:;" onclick="$('.toolbar-search').toggle();">
	 	<i class="fa icon-search"></i>&nbsp;Cari
	 </a>
	 <div class="cb"></div>
</div>
<div class="toolbar-filter" style="display:block">
	<label style="float:left">Jenis Surat : &nbsp;</label>
	<?php echo form_dropdown('pilsurat',array('masuk'=>'Masuk','keluar'=>'Keluar'), $this->session->userdata('cgd_typesurat'));?>
	
</div>
<div class="toolbar-search comsurat">
<select name='pilih_cari' id='pilih_cari'>
	<!-- <option value=''>--pilih--</option> -->
	<option value='no_surat'>Nomor Surat</option>	
	<option value='kode'>Kode</option>	
	
	</select>
	<input type='text' name='cari' id='cari'><input type='button' name='btncari' id='btncari' value='Cari'/>
</div>
<style type="text/css">
.toolbar-search, .toolbar-filter{width:484px}
.content .toolbar-grid{width: 178px;}
#gview_gridcomsurat tr.jqg-first-row-header{
	display: none;
}
</style>

