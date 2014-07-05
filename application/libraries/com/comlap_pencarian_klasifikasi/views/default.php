<script>
	$('#pilihdepo').change(function(){
		var depo = $(this).val()
		$('#depo').val(depo);
	});
	
	$('#pilihtahun').change(function(){
		var tahun = $(this).val()
		$('#tahun').val(tahun);
	});

	$('#pilihklasifikasi').change(function(){
		var klasifikasi = $(this).val()
		$('#klasifikasi2').val(klasifikasi);
	});	
	
var head_content = jQuery("#header_caption_content").hasClass('head-content');
if(! head_content){
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
}else{
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
}
		
</script>
<table align='center' border=0 class="toolbar-filter">
<tr><td colspan=9 align='center'>LAPORAN DAFTAR PENCARIAN DATA ARSIP->KODE KLASIFIKASI</td></tr>
<tr><td colspan=9><hr></td></tr>
<tr>
<td>KODE KLASIFIKASI</td><td> :</td><td>
<select name='pilihklasifikasi' id='pilihklasifikasi'>
		<option value=''>ALL</option>
		<? foreach($klasifikasi as $row){?>
		<option value='<?=$row->id_kode_masalah?>'><?=$row->name?></option>
		<? } ?>
	</select>
</td>

<td>TAHUN ARSIP</td><td> : </td>
<td>
<select name='pilihtahun' id='pilihtahun'>
		<option value=''>ALL</option>
		<? foreach($tahun as $row){?>
		<option value='<?=$row?>'><?=$row?></option>
		<? } ?>
</select>
</td>

<td>DEPO</td>
<td>:</td> 
<td>
<select name='pilihdepo' id='pilihdepo'>
		<option value=''>ALL</option>
		<? foreach($depo as $row){?>
		<option value='<?=$row->id_lokasi_simpan?>'><?=$row->name?></option>
		<? } ?>
	</select>
</td>


	</tr>
<tr>
	<td colspan=9 align='center'>		
	<form id="myForm" action="<?=site_url('admin/com/lap_pencarian_klasifikasi');?>/rptklasifikasi/" target="_blank" method="post">
			<input type="hidden" id="depo" name="depo">
			<input type="hidden" id="klasifikasi2" name="klasifikasi2" >
			<input type="hidden" id="tahun" name="tahun" >
			<input type="submit" class="bt-blue-common" value="PROSES">
		</form>
		</td>
</tr>	
</table>

<div class="page-break" />

<style type="text/css">
.content .toolbar-grid{width: 243px}
#gbox_gridcomonline{
	width: auto !important;
	margin-left: 2%;
}
.toolbar-filter{
	display: block !important;
	padding: 29px;
	text-align: center;

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
}
#myForm > .bt-blue-common{
	float: none;
}
.toolbar-search, .toolbar-filter {width:700px}
</style>
<script type="text/javascript">
$(document).ready(function () {
	var head = $('table.toolbar-filter tr:first');
	var text = head.find('>td:first').text().replace(/\-\>/,'/');
	$('table.toolbar-filter hr').parent().parent().remove();
	head.remove();
	console.log(text);

	var html = '<h3 class="grid-title"><i class="fa icon-tasks"></i>&nbsp;' + text + '</h3>' +'<div class="toolbar-grid"><div class="cb"></div></div>';
	$('#main_panel_container').prepend(html);
})
</script>