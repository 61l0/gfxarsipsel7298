<h3 class="grid-title"><i class="fa icon-tasks"></i>&nbsp;<?=$header_caption?></h3>

<div class="toolbar-grid">
	 
	 <div class="cb"></div>
</div>
<div class="toolbar-filter">
	
	<table width="100%" align="center" cellpadding="4" colspacing="4">
		
		<tr><td width="80px">Bulan</td><td width="5px">:</td>
			<td>
				<select name='pilihbulan' id='pilihbulan'>
					<option value='ALL'>ALL</option>
					<? foreach($bulan as $row){?>
					<option value='<?=$row?>'><?=$row?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr><td>Tahun Arsip</td><td>:</td><td>
			<select name='pilihtahun' id='pilihtahun'>
				<option value='ALL'>ALL</option>
				<? foreach($tahun as $row){?>
				<option value='<?=$row?>'><?=$row?></option>
				<? } ?>
			</select>
		</td></tr>
		
		<tr><td>Status</td><td>:</td><td>
			<select name='pilihstatus' id='pilihstatus'>
				<option value='ALL'>ALL</option>
				<option value='inaktif'>INAKTIF</option>
				<option value='dinilai_kembali'>DINILAI KEMBALI</option>
				<option value='musnah'>MUSNAH</option>
				<option value='permanen'>PERMANEN</option>
			</select>
		</td></tr>
	</table>
	<div>
		<form id="myForm" action="<?=site_url('admin/com/lap_retensi');?>/excel_bulanan" target="_blank" method="post">
		<!-- 	<input type="hidden" id="depo" name="depo">
			<input type="hidden" id="klasifikasi2" name="klasifikasi2" > -->
			<input type="hidden" id="bulan" name="bulan" >
			<input type="hidden" id="tahun" name="tahun" >
			<input type="hidden" id="status" name="status" >
			<input type="submit" class="bt-blue-common" value="PROSES">
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
    padding-left: 69px;
    padding-top: 33px;
}
#myForm > .bt-blue-common{
	float: none;
}
</style>
<script>
	// $('#pilihdepo').change(function(){
	// 	var depo = $(this).val()
	// 	$('#depo').val(depo);
	// });
	// $('#pilihklasifikasi').change(function(){
	// 	var klasifikasi = $(this).val()
	// 	$('#klasifikasi2').val(klasifikasi);
	// });
	$('#pilihbulan').change(function(){
		var bulan = $(this).val()
		$('#bulan').val(bulan);
	}).trigger('change');
	$('#pilihtahun').change(function(){
		var tahun = $(this).val()
		$('#tahun').val(tahun);
	}).trigger('change');	
	$('#pilihstatus').change(function(){
		var status = $(this).val()
		$('#status').val(status);
	}).trigger('change');	
	var head_content = jQuery("#header_caption_content").hasClass('head-content');
	if(! head_content){
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
	}else{
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
	}	
</script>