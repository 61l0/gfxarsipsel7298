<h3 class="grid-title"><i class="fa icon-tasks"></i>&nbsp;<?=$header_caption?></h3>

<div class="toolbar-grid">
	 
	 <div class="cb"></div>
</div>
<div class="toolbar-filter form">
	
	<table width="100%" align="center" cellpadding="4" colspacing="4">
		<tr>
			<td width="91px">Depo</td><td width="10px">:</td>
			<td>
				<select name='pilihdepo' id='pilihdepo'>
				<option value='ALL'>ALL</option>
				<? foreach($depo as $row){?>
				<option value='<?=$row->name?>'><?=$row->name?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Lokasi</td><td>:</td>
			<td><input type="text" name="pilih_lokasi" id="pilih_lokasi" style="width:231px"/>
			</td>
		</tr>
<!-- 		<tr><td>Bulan</td><td>:</td>
			<td>
				<select name='pilihbulan' id='pilihbulan'>
					<option value='ALL'>ALL</option>
					<? foreach($bulan as $row){?>
					<option value='<?=$row?>'><?=$row?></option>
					<? } ?>
				</select>
			</td>
		</tr> -->
		<tr><td>Tahun Arsip</td><td>:</td><td>
			<select name='pilihtahun' id='pilihtahun'>
				<option value='ALL'>ALL</option>
				<? foreach($tahun as $row){?>
				<option value='<?=$row?>'><?=$row?></option>
				<? } ?>
			</select>
		</td></tr>
		<tr><td>Kode Klasifikasi</td><td>:</td>
			<td><select name='pilihklasifikasi' id='pilihklasifikasi'>
		<option value='ALL'>ALL</option>
		<? foreach($klasifikasi as $row){?>
		<option value='<?=$row->id_kode_masalah?>' kode="<?php echo $row->kode?>"><?= $row->kode.' - '.$row->name?></option>
		<? } ?>
	</select></td>
		</tr>
		<tr><td>Instansi</td><td>:</td>
			<td><select name='pilihinstansi' id='pilihinstansi'>
		<option value=''>ALL</option>
		<? foreach($unit_pengolah as $row){?>
		<option value='<?=$row->id_unit_pengolah?>'><?=$row->name?></option>
		<? } ?>
	</select></td>
		</tr>
		
	</table>
	<div>
		<form id="myForm" action="<?=site_url('admin/com/lap_dpa');?>/excel_identitas" target="_blank" method="post">
		<!-- 	<input type="hidden" id="depo" name="depo">
			<input type="hidden" id="klasifikasi2" name="klasifikasi2" > -->
		<!-- 	<input type="hidden" id="bulan" name="bulan" > -->
			<input type="hidden" id="tahun" name="tahun" >
			<input type="hidden" id="depo" name="depo" >
			<input type="hidden" id="lokasi" name="lokasi" >
			<input type="hidden" id="id_kode_masalah" name="id_kode_masalah" >
			<input type="hidden" id="id_unit_pengolah" name="id_unit_pengolah" >
		<!-- 	<input type="hidden" id="status" name="status" > -->
			<input type="submit" class="bt-blue-common" value="PROSES">

			<input type="hidden" id="depo_text" name="depo_text" >
			<input type="hidden" id="unit_pengolah_text" name="unit_pengolah_text" >
			<input type="hidden" id="klasifikasi_text" name="klasifikasi_text" >
			<input type="hidden" id="klasifikasi_kode" name="klasifikasi_kode" >
		</form>
	</div>
</div>
<style type="text/css">
.content .toolbar-grid{width: 243px}
#gbox_gridcomonline{
	width: auto !important;
	margin-left: 2%;
}
.toolbar-filter{
	display: block !important;
	padding: 29px;
	text-align: left;

	border: solid 1px orange;
	border-radius: 4px; 
	width: 600px;
}
.content .toolbar-grid{
	height: 25px;
}
#myForm > select{
	cursor: pointer;
}
#myForm{
	height: 33px;
    padding: 18px;
    text-align: center;
/*    padding-left: 69px;
    padding-top: 33px;*/
}
#myForm > .bt-blue-common{
	float: none;
}
</style>
<script>
	$('#pilihdepo').change(function(){
		var depo = $(this).val()
		$('#depo').val(depo);
		$('#depo_text').val($(this).find('option:selected').text());
	}).trigger('change');
	$('#pilihklasifikasi').change(function(){
		var klasifikasi = $(this).val()
		$('#id_kode_masalah').val(klasifikasi);
		$('#klasifikasi_text').val($(this).find('option:selected').text());
		$('#klasifikasi_kode').val($(this).find('option:selected').attr('kode'));
	}).trigger('change');
	// $('#pilihbulan').change(function(){
	// 	var bulan = $(this).val()
	// 	$('#bulan').val(bulan);
	// }).trigger('change');
	$('#pilihtahun').change(function(){
		var tahun = $(this).val()
		$('#tahun').val(tahun);
	}).trigger('change');	
	$('#pilihstatus').change(function(){
		var status = $(this).val()
		$('#status').val(status);
	}).trigger('change');	
	$('#pilihinstansi').change(function(){
		var id_unit_pengolah = $(this).val()
		$('#id_unit_pengolah').val(id_unit_pengolah);
		$('#unit_pengolah_text').val($(this).find('option:selected').text());
	}).trigger('change');
	$('#pilih_lokasi').change(function(){
		var pilih_lokasi = $(this).val()
		$('#lokasi').val(pilih_lokasi);
	});	
	var head_content = jQuery("#header_caption_content").hasClass('head-content');
	if(! head_content){
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
	}else{
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
	}	


	$(function(){

			$('#pilih_lokasi').autocomplete('<?=site_url('admin/com/pengolahan');?>/autocomplete',
				{
					
					extraParams: {
						type_cari : function() { return 'lokasi'},					  
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
					
						$('#pilih_lokasi').val(data.hasil).trigger('change'); 
						
						
					}	
			);
		});
</script>