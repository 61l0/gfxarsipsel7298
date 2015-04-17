<script>

	$('#pilihbulan').change(function(){
		var bulan = $(this).val()
		$('#bulan').val(bulan);
	});
	$('#pilihtahun').change(function(){
		var tahun = $(this).val()
		$('#tahun').val(tahun);
	});
	
var head_content = jQuery("#header_caption_content").hasClass('head-content');
if(! head_content){
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
}else{
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
}
		
</script>
<table align='center' border=0 class="toolbar-filter form">
<tr><td colspan=9 align='center'>LAPORAN PELAYANAN BULANAN</td></tr>
<tr><td colspan=9><hr></td></tr>
<tr>


<td>Bulan Entri</td><td> :</td><td>
<select name='pilihbulan' id='pilihbulan'>
		<option value=''>ALL</option>
		<? foreach($bulan as $row){?>
		<option value='<?=$row?>'><?=$row?></option>
		<? } ?>
	</select>
</td>

<td>Tahun Entri</td><td> : </td>
<td>
<select name='pilihtahun' id='pilihtahun'>
		<option value=''>ALL</option>
		<? foreach($tahun as $row){?>
		<option value='<?=$row?>'><?=$row?></option>
		<? } ?>
</select>
</td>
	</tr>
<tr>
	<td colspan=9 align='center'>		
	<form id="myForm" action="<?=site_url('admin/com/lap_pelayanan_bulanan');?>/rptbulanan/" target="_blank" method="post">
			<input type="hidden" id="bulan" name="bulan" >
			<input type="hidden" id="tahun" name="tahun" >
			<input type="submit" class="bt-blue-common" value="PROSES">
		</form>
		</td>
</tr>	
</table>
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
.toolbar-search, .toolbar-filter {width:400px}
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